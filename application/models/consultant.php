<?php

/**
 * Created by PhpStorm.
 * User: p1027
 * Date: 21.06.2016
 * Time: 17:12
 */
class Consultant
{
    public $UserBaseId = 0;
    public $FullName = '';
    public $City = '';
    public $County = '';
    public $Phone = '';
    public $Email = '';
    public $Photo = '';
    public $RoleId = 0;
    public $UserUrl = '';
    public $OfficeName = '';
    public $OfficeId = '';
    public $OfficeUrl = '';
    public $OfficeLatitude = '';
    public $OfficeLongitude = '';
    public $OfficeNameUrlList = array();
    public $UserTitle = '';
    public $UserAbout = '';
    public $TwitterUrl = '';
    public $FacebookUrl = '';
    public $GooglePlusUrl = '';
    public $YoutubeUrl = '';
    public $LinkedInUrl = '';
    public $PinterestUrl = '';
    public $FlickrUrl = '';
    public $InstagramUrl = '';
    public $OrderForList = '';
    public $RoleDescription = '';

    /**
     * Consultant constructor.
     * @param $responseObj
     */
    public function __construct($responseObj)
    {
        /** @var Consultant $responseObj */
        $this->UserBaseId = $responseObj->UserBaseId;
        $this->FullName = $responseObj->FullName;
        $this->City = $responseObj->City;
        $this->County = $responseObj->County;
        $this->Phone = $responseObj->Phone;
        $this->Email = $responseObj->Email;
        $this->Photo = $responseObj->Photo;
        $this->RoleId = $responseObj->RoleId;
        $this->UserUrl = $responseObj->UserUrl;
        $this->OfficeName = $responseObj->OfficeName;
        $this->OfficeId = $responseObj->OfficeId;
        $this->OfficeUrl = $responseObj->OfficeUrl;
        $this->OfficeLatitude = $responseObj->OfficeLatitude;
        $this->OfficeLongitude = $responseObj->OfficeLongitude;
        $this->OfficeNameUrlList = $responseObj->OfficeNameUrlList;
        $this->UserTitle = $responseObj->UserTitle;
        $this->UserAbout = $responseObj->UserAbout;
        $this->TwitterUrl = $responseObj->TwitterUrl;
        $this->FacebookUrl = $responseObj->FacebookUrl;
        $this->GooglePlusUrl = $responseObj->GooglePlusUrl;
        $this->YoutubeUrl = $responseObj->YoutubeUrl;
        $this->LinkedInUrl = $responseObj->LinkedInUrl;
        $this->PinterestUrl = $responseObj->PinterestUrl;
        $this->FlickrUrl = $responseObj->FlickrUrl;
        $this->InstagramUrl = $responseObj->InstagramUrl;
        $this->OrderForList = $responseObj->OrderForList;
        $this->RoleName = $responseObj->RoleName;
    }
}