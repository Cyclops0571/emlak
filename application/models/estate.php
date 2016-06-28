<?php

/**
 * Created by PhpStorm.
 * User: p1027
 * Date: 22.06.2016
 * Time: 17:02
 */
class Estate
{
    public $AdBaseId;
    public $Image;
    public $OriginalImage;
    public $Title;
    public $Slogan;
    public $Summary;
    public $Country;
    public $City;
    public $County;
    public $District;
    public $AdTypeId;
    public $AdType;
    public $EstateStatusId;
    public $EstateStatusType;
    public $AdPropertyTypeId;
    public $AdPropertyType;
    public $RoomCountTypeId;
    public $RoomCount;
    public $UsageAreaClean;
    public $UsageAreaCleanType;
    public $UsageAreaCleanTypeId;
    public $UsageAreaGross;
    public $Price;
    public $FormattedPrice;
    public $Currency;
    public $Longitude;
    public $Latitude;
    public $ConsultantId;
    public $OfficeName;
    public $OfficeCityName;
    public $OfficeId;
    public $ConsultantPhoto;
    public $ConsultantFirstName;
    public $ConsultantLastName;
    public $AssigmentProfileId;
    public $DistanceKm;
    public $ConsultantFullName;
    public $ConsultantTitle;
    public $Url;
    public $CreatedDate;
    public $UpdatedDate;
    public $FavoriteState;
    public $Rating;
    public $ItemStatusValue;
    public $AdCloseStatusValue;
    public $PriceIsHidden;
    public $ReidinUrl;
    public $EngReidinUrl;
    public $HouseBathroomCount;
    public $FullnessStatus;
    public $FullnessStatusId;
    public $BathroomCountId;
    public $ExchangeForFlat;
    public $BuildAgeId;
    public $BuildAge;
    public $ExchangeForFlatText;
    public $CommRoomCount;
    public $TouristicResortRoomCount;
    public $TouristicResortStarCount;
    public $HurriyetPortalRealtyNo;
    public $HurriyetPortalUrl;
    public $MilliyetPortalRealtyNo;
    public $MilliyetPortalUrl;
    public $IsOfficialOwner;
    public $GoogleMarketingCode;
    public $ViewCount;


    public function __construct($item)
    {
        $this->AdBaseId = $item->AdBaseId;
        $this->Image = $item->Image;
        $this->OriginalImage = $item->OriginalImage;
        $this->Title = $item->Title;
        $this->Slogan = $item->Slogan;
        $this->Summary = $item->Summary;
        $this->Country = $item->Country;
        $this->City = $item->City;
        $this->County = $item->County;
        $this->District = $item->District;
        $this->AdTypeId = $item->AdTypeId;
        $this->AdType = $item->AdType;
        $this->EstateStatusId = $item->EstateStatusId;
        $this->EstateStatusType = $item->EstateStatusType;
        $this->AdPropertyTypeId = $item->AdPropertyTypeId;
        $this->AdPropertyType = $item->AdPropertyType;
        $this->RoomCountTypeId = $item->RoomCountTypeId;
        $this->RoomCount = $item->RoomCount;
        $this->UsageAreaClean = $item->UsageAreaClean;
        $this->UsageAreaCleanType = $item->UsageAreaCleanType;
        $this->UsageAreaCleanTypeId = $item->UsageAreaCleanTypeId;
        $this->UsageAreaGross = $item->UsageAreaGross;
        $this->Price = $item->Price;
        $this->FormattedPrice = $item->FormattedPrice;
        $this->Currency = $item->Currency;
        $this->Longitude = $item->Longitude;
        $this->Latitude = $item->Latitude;
        $this->ConsultantId = $item->ConsultantId;
        $this->OfficeName = $item->OfficeName;
        $this->OfficeCityName = $item->OfficeCityName;
        $this->OfficeId = $item->OfficeId;
        $this->ConsultantPhoto = $item->ConsultantPhoto;
        $this->ConsultantFirstName = $item->ConsultantFirstName;
        $this->ConsultantLastName = $item->ConsultantLastName;
        $this->AssigmentProfileId = $item->AssigmentProfileId;
        $this->DistanceKm = $item->DistanceKm;
        $this->ConsultantFullName = $item->ConsultantFullName;
        $this->ConsultantTitle = $item->ConsultantTitle;
        $this->Url = $item->Url;
        $this->CreatedDate = $item->CreatedDate;
        $this->UpdatedDate = $item->UpdatedDate;
        $this->FavoriteState = $item->FavoriteState;
        $this->Rating = $item->Rating;
        $this->ItemStatusValue = $item->ItemStatusValue;
        $this->AdCloseStatusValue = $item->AdCloseStatusValue;
        $this->PriceIsHidden = $item->PriceIsHidden;
        $this->ReidinUrl = $item->ReidinUrl;
        $this->EngReidinUrl = $item->EngReidinUrl;
        $this->HouseBathroomCount = $item->HouseBathroomCount;
        $this->FullnessStatus = $item->FullnessStatus;
        $this->FullnessStatusId = $item->FullnessStatusId;
        $this->BathroomCountId = $item->BathroomCountId;
        $this->ExchangeForFlat = $item->ExchangeForFlat;
        $this->BuildAgeId = $item->BuildAgeId;
        $this->BuildAge = $item->BuildAge;
        $this->ExchangeForFlatText = $item->ExchangeForFlatText;
        $this->CommRoomCount = $item->CommRoomCount;
        $this->TouristicResortRoomCount = $item->TouristicResortRoomCount;
        $this->TouristicResortStarCount = $item->TouristicResortStarCount;
        $this->HurriyetPortalRealtyNo = $item->HurriyetPortalRealtyNo;
        $this->HurriyetPortalUrl = $item->HurriyetPortalUrl;
        $this->MilliyetPortalRealtyNo = $item->MilliyetPortalRealtyNo;
        $this->MilliyetPortalUrl = $item->MilliyetPortalUrl;
        $this->IsOfficialOwner = $item->IsOfficialOwner;
        $this->GoogleMarketingCode = $item->GoogleMarketingCode;
        $this->ViewCount = $item->ViewCount;
    }

}