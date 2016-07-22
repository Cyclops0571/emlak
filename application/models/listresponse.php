<?php

/**
 * Created by PhpStorm.
 * User: p1027
 * Date: 22.06.2016
 * Time: 16:07
 */
abstract class ListResponse
{
    public $CurrentPageIndex;
    public $PageSize;
    public $TotalItemCount;
    public $TotalPageCount;
    public $StartRecordIndex;
    public $EndRecordIndex;
    public $requestUrl;

    public function __construct($requestUrl) {
        $this->requestUrl = $requestUrl;
    }

    public function checkResponse($response)
    {
//        var_dump($response); exit;
        $this->CurrentPageIndex = $response->CurrentPageIndex;
        $this->PageSize = $response->PageSize;
        $this->TotalItemCount = $response->TotalItemCount;
        $this->TotalPageCount = $response->TotalPageCount;
        $this->StartRecordIndex = $response->StartRecordIndex;
        $this->EndRecordIndex = $response->EndRecordIndex;
    }

    abstract protected function setItems($response);

    protected function makeRequest() {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->requestUrl);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($this->parameters));
        curl_setopt($ch, CURLOPT_HTTPHEADER,array('Content-Type: application/json', $this->token->getBearer()));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        $result = json_decode($response);
        if(!isset($result->ApiResult) || (isset($result->ApiResult) && $result->ApiResult != 0)) {
            throw new Exception("Unsuccessful Request");
        }

        return $result->Result;
    }
}