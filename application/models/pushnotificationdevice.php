<?php
/**
 * @property int $pushNotificationID Description
 * @property int $clientDeviceTokenID Description
 * @property int $sent Description
 * @property int $errorCount Description
 * @property int $lastErrorDetail Description
 * @property int $statusID Description
 * @property ClientDeviceToken $clientDeviceToken Description
 * @property PushNotification $pushNotification Description
 */
class PushNotificationDevice extends Eloquent
{
	public static $timestamps = true;
	public static $table = 'PushNotificationDevice';
	public static $key = 'pushNotificationDeviceID';

    /**
     * @return PushNotificationDevice[]
     */
    public static function getWaitingNotifications() {
        if(strpos(php_sapi_name(), 'cli') !== false) {
            return PushNotificationDevice::where('sent', '=', 0)
                ->where('errorCount', '<', 2)
                ->where('statusID', '=', eStatus::Active)
                ->order_by('pushNotificationDeviceID', 'desc')
                ->get();
        }
        return PushNotificationDevice::where('statusID', '=', eStatus::Active)
            ->order_by('pushNotificationDeviceID', 'desc')
            ->get();
    }

    protected function clientDeviceToken() {
        return $this->belongs_to('ClientDeviceToken', 'clientDeviceTokenID');
    }

    protected function pushNotification() {
        return $this->belongs_to('PushNotification', 'pushNotificationID');
    }

    private function getCkPem() {
        //this key will change according to user
        return path('app') . 'keys/ck.pem';
    }

    private function sendNotificationMessage() {
        try {
            //strategy pattern burada uygulanabilir - Serdar
            $result = $this->clientDeviceToken->deviceType == eDeviceTypes::ios ? $this->iosInternal() : $this->androidInternal();
            if ($result) {
                $this->sent = 1;
                $this->save();
            }
        } catch (Exception $e) {
            $this->errorCount = $this->errorCount + 1;
            $this->lastErrorDetail = $e->getMessage();
            $this->save();
        }
    }

    public static function sendWaitingMessages() {
        $pushNotificationDevices = PushNotificationDevice::getWaitingNotifications();
        foreach($pushNotificationDevices as $pushNotificationDevice) {
            $pushNotificationDevice->sendNotificationMessage();
        }
    }


    public function iosInternal()
    {
        $cert = $this->getCkPem();
        $message = $this->pushNotification->getNotificationMessage();
        $deviceToken = $this->clientDeviceToken->deviceToken;
        //	$appID = 424;
        //	$udid1 = 'E6A7CFD9-FE39-4C33-B7F4-6651404ED040';
        //	$deviceToken1 = '22d08c4579f9a0d0e07fe7fdcd0a064989ecb93b06f7a1cf7c3a5f130b36c776';
        $result = '';

        // Put your private key's passphrase here:
        $passPhrase = Config::get('custom.passphrase');


        $ctx = stream_context_create();
        stream_context_set_option($ctx, 'ssl', 'local_cert', $cert);
        stream_context_set_option($ctx, 'ssl', 'passphrase', $passPhrase);

        // Open a connection to the APNS server
        $fp = stream_socket_client(
            'ssl://gateway.push.apple.com:2195', $err, $errorStr, 60, STREAM_CLIENT_CONNECT | STREAM_CLIENT_PERSISTENT, $ctx);

        if ($fp) {
            // Create the payload body
            $body['aps'] = array(
                'alert' => $message,
                'sound' => 'default'
            );

            // Encode the payload as JSON
            $payload = json_encode($body);

            // Build the binary notification
            $msg = chr(0) . pack('n', 32) . pack('H*', $deviceToken) . pack('n', strlen($payload)) . $payload;

            // Send it to the server
            $result = (boolean)fwrite($fp, $msg, strlen($msg));

            // Close the connection to the server
            fclose($fp);
        } else {
            //throw new Exception('Message not delivered!');
            $this->errorCount = $this->errorCount + 1;
            $this->lastErrorDetail = $errorStr;
            $this->save();
        }
        return (boolean)$result;
    }

    public function androidInternal()
    {
        $message = $this->pushNotification->getNotificationMessage();
        $deviceToken = $this->clientDeviceToken->deviceToken;
        $googleAPIKey = Config::get('custom.google_api_key');
        $success = '';

        $data = array(
            'headers' => array(
                'Authorization: key=' . $googleAPIKey,
                'Content-Type: application/json'
            ),
            'fields' => array(
                'registration_ids' => array(
                    $deviceToken
                ),
                'data' => array(
                    "message" => $message
                )
            )
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://android.googleapis.com/gcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $data['headers']);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Disabling SSL Certificate support temporarly
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data['fields']));
        $response = curl_exec($ch);
        if ($response === false) {
            //die('Curl failed: ' . curl_error($ch));
            throw new Exception('Curl failed: ' . curl_error($ch));
        } else {
            $responseArray = json_decode($response, TRUE);
            if (isset($responseArray['success'])) {
                $success = $responseArray['success'];
            }

            if (isset($responseArray['results'])) {
                foreach ($responseArray['results'] as $result) {
                    if (isset($result['registration_id'])) {
                        if ($deviceToken != $result['registration_id']) {
                            //if the device token changed delete the old device token
                            // for not sending push message twice
                            $this->clientDeviceToken->statusID = eStatus::Deleted;
                            $this->clientDeviceToken->save();
                        }
                    }
                }
            }
        }
        curl_close($ch);
        return (boolean)$success;
    }
}