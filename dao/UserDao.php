<?php

require_once ("model/UserClass.php");

class UserDao
{
    public function createNewUser($user)
    {
        DataBase::databaseRequest("INSERT INTO users (user_pseudo, user_email, user_password) VALUES (?, ?, ?)", array($user->getUserPseudo(), $user->getUserEmail(), $user->getUserPassword()));
    }

    public function createNewUserDataFk($id)
    {
        DataBase::databaseRequest("INSERT INTO users_data (user_data_fk) VALUE ($id)");
    }

    public function createNewUserData($userData)
    {
        DataBase::databaseRequest("INSERT INTO users_data (user_data_fk, user_data_firstname, user_data_lastname, user_data_birthdate, user_data_gender, user_data_address, user_data_postcode, user_data_city, user_data_country, user_data_geo, user_data_phone, user_data_real_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)", array($userData->getUserDataFk(), $userData->getUserDataFirstname(), $userData->getUserDataLastname(), $userData->getUserDataBirthdate(), $userData->getUserDataGender(), $userData->getUserDataAddress(), $userData->getUserDataPostcode(), $userData->getUserDataCity(), $userData->getUserDataCountry(), $userData->getUserDataGeo(), $userData->getUserDataPhone(), $userData->getUserDataRealId()));
    }

    public function createRealIdFile($userId, $realIdFilename)
    {
        DataBase::databaseRequest("INSERT INTO real_id_moderation (user_id, real_id_filename) VALUES (?, ?)", array($userId, $realIdFilename));
    }

    public function updateUser($id, $user)
    {
        DataBase::databaseRequest("UPDATE users SET user_pseudo = ?, user_email = ?, user_password = ?, user_reputation = ?, user_status = ?,
            user_archived = ?, user_verified = ?, user_token = ?, user_connected_token = ? WHERE user_id = ?", array($user->getUserPseudo(),
            $user->getUserEmail(), $user->getUserPassword(), $user->getUserReputation(), $user->getUserStatus(), $user->getUserArchived(),
            $user->getUserVerified(), $user->getUserToken(), $user->getUserConnectedToken(), $id));
    }

    public function unsetConnectedToken($id)
    {
        DataBase::databaseRequest("UPDATE users SET user_connected_token = null WHERE user_id = ?", array($id));
    }

    public function updateUserData($id, $userData)
    {
        DataBase::databaseRequest("UPDATE users SET user_pseudo = ?, user_email = ? WHERE user_id = ?", array($userData->getUserPseudo(), $userData->getUserEmail(), $id));
        DataBase::databaseRequest("UPDATE users_data SET user_data_firstname = ?, user_data_lastname = ?, user_data_birthdate = ?, user_data_gender = ?, user_data_address = ?, user_data_postcode = ?, user_data_city = ?, user_data_country = ?, user_data_geo = ?, user_data_phone = ? WHERE user_data_fk = ?", array($userData->getUserDataFirstname(), $userData->getUserDataLastname(), $userData->getUserDataBirthdate(), $userData->getUserDataGender(), $userData->getUserDataAddress(), $userData->getUserDataPostcode(), $userData->getUserDataCity(), $userData->getUserDataCountry(), $userData->getUserDataGeo(), $userData->getUserDataPhone(), $id));
    }

    public function updateUserAvatar($avatarFilename, $userId)
    {
        DataBase::databaseRequest("UPDATE users SET user_avatar = ? WHERE user_id =?", array($avatarFilename, $userId));
    }

    public function readUserInfos($id)
    {
        $userArray = DataBase::databaseRequest("SELECT * from users INNER JOIN users_data ON users.user_id = users_data.user_data_fk WHERE users.user_id = ?", array($id));

        $userObject = new User($userArray[0]["user_pseudo"], $userArray[0]["user_email"], $userArray[0]["user_password"]);
        $userObject->setId((int)$id);
        $userObject->setUserReputation($userArray[0]["user_reputation"]);
        $userObject->setUserAvatar($userArray[0]["user_avatar"]);
        $userObject->setUserStatus($userArray[0]["user_status"]);
        $userObject->setUserArchived($userArray[0]["user_archived"]);
        $userObject->setUserVerified($userArray[0]["user_verified"]);
        $userObject->setUserToken($userArray[0]["user_token"]);
        $userObject->setUserConnectedToken($userArray[0]["user_connected_token"]);
        $userObject->setUserAccountCreationDatetime(date_create($userArray[0]["user_account_creation_datetime"]));
        $userObject->setUserDataFk($userArray[0]["user_data_fk"]);
        $userObject->setUserDataFirstname($userArray[0]["user_data_firstname"]);
        $userObject->setUserDataLastname($userArray[0]["user_data_lastname"]);
        $userObject->setUserDataBirthdate($userArray[0]["user_data_birthdate"]);
        $userObject->setUserDataGender($userArray[0]["user_data_gender"]);
        $userObject->setUserDataAddress($userArray[0]["user_data_address"]);
        $userObject->setUserDataPostcode($userArray[0]["user_data_postcode"]);
        $userObject->setUserDataCity($userArray[0]["user_data_city"]);
        $userObject->setUserDataCountry($userArray[0]["user_data_country"]);
        $userObject->setUserDataGeo($userArray[0]["user_data_geo"]);
        $userObject->setUserDataPhone($userArray[0]["user_data_phone"]);
        $userObject->setUserDataRealId($userArray[0]["user_data_real_id"]);


        return $userObject;
    }

    public function getPseudo($id)
    {
        $pseudo = DataBase::databaseRequest("SELECT user_pseudo FROM users WHERE user_id = ?", array($id));
        $pseudo = $pseudo[0]["user_pseudo"];
        return $pseudo;
    }

    public function getReputation($id)
    {
        $reputation = DataBase::databaseRequest("SELECT user_reputation FROM users WHERE user_id = ?", array($id));
        $reputation = $reputation[0]["user_reputation"];

        return $reputation;
    }

    public function getRealIdFilename($userId)
    {
        $realIdFilename = DataBase::databaseRequest("SELECT real_id_filename FROM real_id_moderation WHERE user_id = ?", array($userId));

        return $realIdFilename;
    }

    public function checkLogin($login)
    {
        $userArray = DataBase::databaseRequest("SELECT * from users WHERE user_email = ? OR user_pseudo = ?", array($login, $login));

        if (!empty($userArray))
        {
            return $userArray;
        }
        else
        {
            $userArray = "";
            return $userArray;
        }
    }

    public function recupUser($login, $password)
    {
        DataBase::databaseRequest("UPDATE users SET user_archived = 0 WHERE user_pseudo = ? OR user_email = ? AND user_password = ?", array($login, $login, $password));
    }

    public function changeRealIdStatus($newStatus, $userId)
    {
        DataBase::databaseRequest("UPDATE users_data SET user_data_real_id = ? WHERE user_data_fk = ?", array($newStatus, $userId));
    }

    public function deleteUser($userId)
    {
        DataBase::databaseRequest("DELETE FROM users WHERE user_id = ?", array($userId));
        DataBase::databaseRequest("DELETE FROM users_data WHERE user_data_fk = ?", array($userId));
        DataBase::databaseRequest("DELETE FROM real_id_moderation WHERE user_id = ?", array($userId));
        DataBase::databaseRequest("DELETE FROM events WHERE event_creator_id = ?", array($userId));
        DataBase::databaseRequest("DELETE FROM events_chat_messages WHERE chat_message_user_fk = ?", array($userId));
        DataBase::databaseRequest("DELETE FROM events_players WHERE event_player_fk = ?", array($userId));
        DataBase::databaseRequest("DELETE FROM events_waiters WHERE event_waiter_fk = ?", array($userId));
    }
}
