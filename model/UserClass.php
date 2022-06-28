<?php
class User extends IdClass
{
    private $user_pseudo;
    private $user_email;
    private $user_password;
    private $user_reputation;
    private $user_reputation_stars;
    private $user_avatar;
    private $user_status;
    private $user_status_name;
    private $user_archived;
    private $user_verified;
    private $user_token;
    private $user_connected_token;
    private $user_account_creation_datetime;
    private $user_data_fk;
    private $user_data_firstname;
    private $user_data_lastname;
    private $user_data_birthdate;
    private $user_data_gender;
    private $user_date_gender_name;
    private $user_data_address;
    private $user_data_postcode;
    private $user_data_city;
    private $user_data_country;
    private $user_data_geo;
    private $user_data_phone;
    private $user_data_real_id;
    private $user_events_number;

    public function __construct($pseudo, $email, $password)
    {
        $this->user_pseudo = $pseudo;
        $this->user_email = $email;
        $this->user_password = $password;
    }


    public function getId()
    {
        return $this->id;
    }

    public function getUserPseudo()
    {
        return $this->user_pseudo;
    }
    public function setUserPseudo($user_pseudo)
    {
        $this->user_pseudo = $user_pseudo;
    }

    public function getUserEmail()
    {
        return $this->user_email;
    }
    public function setUserEmail($user_email)
    {
        $this->user_email = $user_email;
    }

    public function getUserPassword()
    {
        return $this->user_password;
    }
    public function setUserPassword($user_password)
    {
        $this->user_password = $user_password;
    }

    public function getUserReputation()
    {
        return $this->user_reputation;
    }
    public function setUserReputation($user_reputation)
    {
        $this->user_reputation = $user_reputation;
    }

    public function getUserReputationStars()
    {
        return $this->user_reputation_stars;
    }
    public function setUserReputationStars($user_reputation_stars)
    {
        $this->user_reputation_stars = $user_reputation_stars;
    }

    public function getUserAvatar()
    {
        return $this->user_avatar;
    }
    public function setUserAvatar($user_avatar)
    {
        $this->user_avatar = $user_avatar;
    }

    public function getUserStatus()
    {
        return $this->user_status;
    }
    public function setUserStatus($user_status)
    {
        $this->user_status = $user_status;
    }

    public function getUserStatusName()
    {
        return $this->user_status_name;
    }
    public function setUserStatusName($user_status_name)
    {
        $this->user_status_name = $user_status_name;
    }

    public function getUserArchived()
    {
        return $this->user_archived;
    }
    public function setUserArchived($user_archived)
    {
        $this->user_archived = $user_archived;
    }

    public function getUserVerified()
    {
        return $this->user_verified;
    }
    public function setUserVerified($user_verified)
    {
        $this->user_verified = $user_verified;
    }

    public function getUserToken()
    {
        return $this->user_token;
    }
    public function setUserToken($user_token)
    {
        $this->user_token = $user_token;
    }

    public function getUserConnectedToken()
    {
        return $this->user_connected_token;
    }
    public function setUserConnectedToken($user_connected_token): void
    {
        $this->user_connected_token = $user_connected_token;
    }

    public function getUserAccountCreationDatetime()
    {
        return $this->user_account_creation_datetime;
    }
    public function setUserAccountCreationDatetime($user_account_creation_datetime)
    {
        $this->user_account_creation_datetime = $user_account_creation_datetime;
    }

    public function getUserDataFk()
    {
        return $this->user_data_fk;
    }
    public function setUserDataFk($user_data_fk)
    {
        $this->user_data_fk = $user_data_fk;
    }

    public function getUserDataFirstname()
    {
        return $this->user_data_firstname;
    }
    public function setUserDataFirstname($user_data_firstname)
    {
        $this->user_data_firstname = $user_data_firstname;
    }

    public function getUserDataLastname()
    {
        return $this->user_data_lastname;
    }
    public function setUserDataLastname($user_data_lastname)
    {
        $this->user_data_lastname = $user_data_lastname;
    }

    public function getUserDataBirthdate()
    {
        return $this->user_data_birthdate;
    }
    public function setUserDataBirthdate($user_data_birthdate)
    {
        $this->user_data_birthdate = $user_data_birthdate;
    }

    public function getUserDataGender()
    {
        return $this->user_data_gender;
    }
    public function setUserDataGender($user_data_gender)
    {
        $this->user_data_gender = $user_data_gender;
    }

    public function getUserDataGenderName()
    {
        return $this->user_date_gender_name;
    }
    public function setUserDataGenderName($user_date_gender_name)
    {
        $this->user_date_gender_name = $user_date_gender_name;
    }

    public function getUserDataAddress()
    {
        return $this->user_data_address;
    }
    public function setUserDataAddress($user_data_address)
    {
        $this->user_data_address = $user_data_address;
    }

    public function getUserDataPostcode()
    {
        return $this->user_data_postcode;
    }
    public function setUserDataPostcode($user_data_postcode)
    {
        $this->user_data_postcode = $user_data_postcode;
    }

    public function getUserDataCity()
    {
        return $this->user_data_city;
    }
    public function setUserDataCity($user_data_city)
    {
        $this->user_data_city = $user_data_city;
    }

    public function getUserDataCountry()
    {
        return $this->user_data_country;
    }
    public function setUserDataCountry($user_data_country)
    {
        $this->user_data_country = $user_data_country;
    }

    public function getUserDataGeo()
    {
        return $this->user_data_geo;
    }
    public function setUserDataGeo($user_data_geo)
    {
        $this->user_data_geo = $user_data_geo;
    }

    public function getUserDataPhone()
    {
        return $this->user_data_phone;
    }
    public function setUserDataPhone($user_data_phone)
    {
        $this->user_data_phone = $user_data_phone;
    }

    public function getUserDataRealId()
    {
        return $this->user_data_real_id;
    }
    public function setUserDataRealId($user_data_real_id)
    {
        $this->user_data_real_id = $user_data_real_id;
    }

    public function getUserEventsNumber()
    {
        return $this->user_events_number;
    }
    public function setUserEventsNumber($user_events_number)
    {
        $this->user_events_number = $user_events_number;
    }
}
