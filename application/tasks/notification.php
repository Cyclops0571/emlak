<?php

class Notification_Task
{

    public function run()
    {
        //https://developer.apple.com/library/ios/documentation/NetworkingInternet/Conceptual/RemoteNotificationsPG/Introduction.html
        //https://developer.apple.com/library/ios/technotes/tn2265/_index.html
        $task = new MyTask();
        $task->taskName = "Push Notification";
        try {
            Locks::pushNotification();
            PushNotificationDevice::sendWaitingMessages();
            $task->taskStatus = "Successful";
            $task->save();
        } catch (Exception $e) {
            $task->taskStatus = "Failure";
            $task->errorStackTrace = $e->getTraceAsString();
            $task->save();
        }
    }
}
