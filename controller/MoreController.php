<?php

include "UserController.php";

class MoreController extends Controller
{

    //Methods who goes to a view//

//****************************************************************************************************<<
    public function research($log = null)
    {
        if (isset($_SESSION["user_id"]) && $_SESSION["user_id"] > 0)
        {
            $UserObject = (new UserController)->readAndCard($_SESSION["user_id"]);

            if ($_SESSION["user_token"] === $UserObject->getUserConnectedToken())
            {
                $d["log"] = $log;
                $d["user"] = $UserObject;
                $this->set($d);
                $this->render("More", 'research');
            }
        }
        else
        {
            $d["log"] = $log;
            $this->set($d);
            $this->render("More", 'research');
        }
    }

    public function contests($log = null)
    {
        if (isset($_SESSION["user_id"]) && $_SESSION["user_id"] > 0)
        {
            $UserObject = (new UserController)->readAndCard($_SESSION["user_id"]);

            if ($_SESSION["user_token"] === $UserObject->getUserConnectedToken())
            {
                $d["log"] = $log;
                $d["user"] = $UserObject;
                $this->set($d);
                $this->render("More", 'contests');
            }
        }
        else
        {
            $d["log"] = "Vous devez vous connecter pour accéder à ce service.";
            $this->set($d);
            $this->render("Home", "main");
        }
    }

    public function contact($log = null)
    {
        if (isset($_SESSION["user_id"]) && $_SESSION["user_id"] > 0)
        {
            $UserObject = (new UserController)->readAndCard($_SESSION["user_id"]);

            if ($_SESSION["user_token"] === $UserObject->getUserConnectedToken())
            {
                $d["log"] = $log;
                $d["user"] = $UserObject;
                $this->set($d);
                $this->render("More", 'contact');
            }
        }
        else
        {
            $d["log"] = $log;
            $this->set($d);
            $this->render("More", 'contact');
        }
    }

    public function legalMentions($log = null)
    {
        if (isset($_SESSION["user_id"]) && $_SESSION["user_id"] > 0)
        {
            $UserObject = (new UserController)->readAndCard($_SESSION["user_id"]);

            if ($_SESSION["user_token"] === $UserObject->getUserConnectedToken())
            {
                $d["log"] = $log;
                $d["user"] = $UserObject;
                $this->set($d);
                $this->render("More", 'legalMentions');
            }
        }
        else
        {
            $d["log"] = $log;
            $this->set($d);
            $this->render("More", 'legalMentions');
        }
    }

    public function termsOfService($log = null)
    {
        if (isset($_SESSION["user_id"]) && $_SESSION["user_id"] > 0)
        {
            $UserObject = (new UserController)->readAndCard($_SESSION["user_id"]);

            if ($_SESSION["user_token"] === $UserObject->getUserConnectedToken())
            {
                $d["log"] = $log;
                $d["user"] = $UserObject;
                $this->set($d);
                $this->render("More", 'termsOfService');
            }
        }
        else
        {
            $d["log"] = $log;
            $this->set($d);
            $this->render("More", 'termsOfService');
        }
    }

}
