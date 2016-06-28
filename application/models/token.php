<?php

class Token
{
    private $Ok = false;
    private $UserName = '';
    private $RelatedIds = false;
    private $BrandId = false;
    private $Type = false;
    private $AccessToken = false;
    public function __construct($response)
    {
        /** @var Token $jsonResponse */
        $jsonResponse = json_decode($response);
        if(isset($jsonResponse->Ok) && $jsonResponse->Ok == true) {
            $this->Ok = $jsonResponse->Ok;
            $this->UserName = $jsonResponse->UserName;
            $this->RelatedIds = $jsonResponse->RelatedIds;
            $this->BrandId = $jsonResponse->BrandId;
            $this->Type = $jsonResponse->Type;
            $this->AccessToken = $jsonResponse->AccessToken;
        }
    }

    public function getBearer() {
        return "Authorization: Bearer " . $this->AccessToken;
    }
}