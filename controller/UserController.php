<?php

include "HomeController.php";

class  UserController extends Controller
{

    //Methods which goes to a view//

//****************************************************************************************************<<

    public function main($userId, $log = null)
    {
        //Action si l'id de la session correspond à l'id entré en paramètre
        if (isset($_SESSION["user_id"]) && $_SESSION["user_id"] > 0 && $_SESSION["user_id"] == $userId)
        {
            //Remplissage de l'objet user
            $UserObject = $this->readAndCard($_SESSION["user_id"]);

            //Action si l'user_token est valide
            if ($_SESSION["user_token"] == $UserObject->getUserConnectedToken())
            {
                $d["log"] = $log;
                $d["user"] = $UserObject;
                $this->set($d);
                $this->render("User", 'main', $_SESSION["user_id"]);
            }
            else
            {
                $d["log"] = "Il y a un soucis avec le token.";
                $this->set($d);
                $this->render("Home", "main", $_SESSION["user_id"]);
            }
        }
        // Action si l'id de la session ne correspond pas à l'id entré en paramètre
        elseif (isset($_SESSION["user_id"]) && $_SESSION["user_id"] > 0 && $_SESSION["user_id"] != $userId)
        {
            $this->player($userId);
        }
        else
        {
            $d["log"] = "Veuillez vous inscrire ou vous connecter afin de profiter de cette fonctionnalité.";
            $this->set($d);
            $this->render("Home", "main");
        }
    }

    public function player($playerId, $log = null)
    {
        if (isset($_SESSION["user_id"]) && $_SESSION["user_id"] > 0)
        {
            // Action si l'id de la session correspond à l'id entré en paramètre
            if ($_SESSION["user_id"] == $playerId)
            {
                $this->main($_SESSION["user_id"]);
            }
            // Action si l'id de la session ne correspond pas à l'id entré en paramètre
            elseif ($_SESSION["user_id"] != $playerId)
            {
                // Remplissage de l'objet user
                $UserObject = $this->readAndCard($_SESSION["user_id"]);

                // Remplissage de l'objet player
                $PlayerObject = $this->readAndCard($playerId);

                //Action si l'user_token est valide
                if ($_SESSION["user_token"] == $UserObject->getUserConnectedToken())
                {
                    $d["log"] = $log;
                    $d["user"] = $UserObject;
                    $d["player"] = $PlayerObject;
                    $this->set($d);
                    $this->render("User", 'player', $playerId);
                }
                else
                {
                    $d["log"] = "Il y a un soucis avec le token.";
                    $this->set($d);
                    $this->render("Home", "main");
                }
            }
        }
        else
        {
            $d["log"] = "Veuillez vous inscrire ou vous connecter afin de profiter de cette fonctionnalité.<br>";
            $this->set($d);
            $this->render("Home", "main");
        }
    }

    public function inscription($log = null)
    {
        //Action si utilisateur non connecté
        if (isset($_SESSION["user_id"]) && $_SESSION["user_id"] == 0)
        {
            isset($log) ? $d["log"] = $log : null;
            isset($d) ? $this->set($d) : "";
            $this->render("User", "inscription");
        }
        //Action si utilisateur connecté
        elseif (isset($_SESSION["user_id"]) && $_SESSION["user_id"] > 0)
        {
            $UserObject = $this->readAndCard($_SESSION["user_id"]);

            $d["user"] = $UserObject;
            isset($log) ? $d["log"] = $log : null;
            isset($d) ? $this->set($d) : "";
            $this->render("Home", "main");
        }
        else
        {
            isset($log) ? $d["log"] = $log : null;
            isset($d) ? $this->set($d) : "";
            $this->render("Home", "main");
        }
    }

    public function connection($log = null)
    {
        //Action si utilisateur non connecté
        if (isset($_SESSION["user_id"]) && $_SESSION["user_id"] == 0)
        {
            isset($log) ? $d["log"] = $log : null;
            isset($d) ? $this->set($d) : "";
            $this->render("User", "connection");
        }
        //Action si utilisateur connecté
        elseif (isset($_SESSION["user_id"]) && $_SESSION["user_id"] > 0)
        {
            $UserObject = $this->readAndCard($_SESSION["user_id"]);

            $log = "Vous êtes déjà connecté à un compte utilisateur";

            $d["user"] = $UserObject;

            isset($log) ? $d["log"] = $log : null;
            isset($d) ? $this->set($d) : "";
            $this->render("Home", "main");
        }
        else
        {
            $d["log"] = "Veuillez vous inscrire ou vous connecter afin de profiter de cette fonctionnalité.<br>";
            $this->set($d);
            $this->render("Home", "main");
        }
    }

    public function disconnect($log = null)
    {
        //Action si l'id de la session n'est pas égal à 0
        if (isset($_SESSION["user_id"]) && $_SESSION["user_id"] > 0)
        {

            //Remplissage de l'objet user
            $UserObject = $this->read($_SESSION["user_id"]);

            //Action si l'user_token est valide
            if ($_SESSION["user_token"] === $UserObject->getUserConnectedToken())
            {
                // Changement de la valeur du connected token de la bdd en null
                $this->UserDao->unsetConnectedToken($_SESSION["user_id"]);

                // Destruction de la session
                $this->destroySession();
                // Démarrage de la session et création des valeurs pour le session id et session token
                @session_start();
                $_SESSION["user_id"] = 0;
                $_SESSION["user_token"] = null;


                $d["log"] = "Vous êtes bien déconnecté de votre compte, à la prochaine !";
                $this->set($d);
                $this->render("Home", "main");

            }
            // Action si le connected token n'est pas valide
            else
            {
                $log = "Problème de token.";
                $this->goToHomeMain($log);
            }
        }
        // Action si l'utilisateur n'est pas connecté
        else
        {
            $log = "Vous devez être connecté pour accéder à ce contenu.";
            $this->connection($log);
        }
    }

    public function avatarChange($userId, $log = null)
    {
        //Action si id de session est égal a l'id en paramètres
        if (isset($_SESSION["user_id"]) && $_SESSION["user_id"] > 0 && $_SESSION["user_id"] == $userId)
        {
            $UserObject = $this->readAndCard($userId);

            //Action si l'user_token est valide
            if ($_SESSION["user_token"] == $UserObject->getUserConnectedToken())
            {
                $d["user"] = $UserObject;
                isset($log) ? $d["log"] = $log : null;
                $this->set($d);

                $this->render("User", "avatarChange", $userId);
            }
            else
            {
                $d["log"] = "Il y a un soucis avec le token.";
                $this->set($d);
                $this->render("Home", "main");
            }
        }
        else
        {
            $d["log"] = "Vous n'avez pas l'autorisation pour accéder à ce contenu";
            $this->main($_SESSION["user_id"]);
        }
    }

    public function modification($userId, $log = null)
    {
        if (isset($userId) && isset($_SESSION["user_id"]) && $userId == $_SESSION["user_id"])
        {
            $UserObject = $this->readAndCard($userId);
            if ($_SESSION["user_token"] == $UserObject->getUserConnectedToken())
            {
                $d["user"] = $UserObject;

                isset ($log) ? $d["log"] = $log : "";
                $this->set($d);

                $this->render("User", "modification", $userId);
            }
            else
            {
                $d["log"] = "Il y a un soucis avec le token.";
                $this->set($d);
                $this->render("Home", "main");
            }
        }
        else
        {
            $log = "Vous n'avez pas l'autorisation requise pour effectuer cette action.<br>";
            $this->zoom($userId, $log);
        }
    }

    public function suppression($log = null)
    {
        if (isset($_SESSION["user_id"]) && $_SESSION["user_id"] > 0)
        {
            $UserObject = $this->readAndCard($_SESSION["user_id"]);

            if ($_SESSION["user_token"] == $UserObject->getUserConnectedToken())
            {
                $d["user"] = $UserObject;
                isset($log) ? $d["log"] = $log : null;
                $this->set($d);
                $this->render("User", "suppression");
            }
            else
            {
                $d["log"] = "Il y a un soucis avec le token.";
                $this->set($d);
                $this->render("Home", "main");
            }
        }
        else
        {
            $d["log"] = "Veuillez vous inscrire ou vous connecter afin de profiter de cette fonctionnalité.";
            $this->set($d);
            $this->render("Home", "main");
        }
    }

    public function recuperation($log = null)
    {
        if (isset($_SESSION["user_id"]) && $_SESSION["user_id"] == 0)
        {
            isset($log) ? $d["log"] = $log : null;
            isset($d) ? $this->set($d) : "";
            $this->render("User", "recuperation");
        }
        elseif (isset($_SESSION["user_id"]) && $_SESSION["user_id"] > 0)
        {
            $UserObject = $this->readAndCard($_SESSION["user_id"]);

            $log = "Vous devez vous déconnecter afin de pouvoir récupérer un compte";

            $this->goToHomeMain($log);
        }
        else
        {
            $d["log"] = "Veuillez vous inscrire ou vous connecter afin de profiter de cette fonctionnalité.";
            $this->set($d);
            $this->render("Home", "main");
        }
    }

    public function security($userId, $log = null)
    {
        if (isset($_SESSION["user_id"]) && $_SESSION["user_id"] > 0)
        {
            $this->loadDao("UserDao");

            $UserObject = $this->readAndCard($userId);

            if ($_SESSION["user_token"] == $UserObject->getUserConnectedToken())
            {
                $d["user"] = $UserObject;
                isset($log) ? $d["log"] = $log : null;
                $this->set($d);
                $this->render("User", "security", $userId);
            }
            else
            {
                $d["log"] = "Il y a un soucis avec le token.";
                $this->set($d);
                $this->render("Home", "main");
            }
        }
        else
        {
            $d["log"] = "Vous n'avez pas accès à cette fonctionnalité";
            $this->set($d);
            $this->render("Home", "main");
        }
    }

    public function passwordForgotten($log = null)
    {
        isset($log) ? $d["log"] = $log : null;
        isset($d) ? $this->set($d) : "";
        $this->render("User", "passwordForgotten");
    }

    public function passwordResetForm($token, $userId, $log = null)
    {
        $UserObject = $this->read($userId);

        if ($token === $UserObject->getUserToken())
        {
            $_SESSION["user_id"] = $userId;

            $UserObject = $this->addCardInfos($UserObject);

            $d["user"] = $UserObject;
            isset($log) ? $d["log"] = $log : null;
            isset($d) ? $this->set($d) : "";
            $this->render("User", "passwordReset");
        }
        else
        {
            $d["log"] = "Vous n'avez pas l'autorisation pour accéder à ce contenu";
            $this->set($d);
            $this->render("Home", "main");
        }
    }

    public function zoom($userId, $log = null)
    {
        if (isset($_SESSION["user_id"]) && $_SESSION["user_id"] > 0 && $_SESSION["user_id"] == $userId)
        {
            $UserObject = $this->readAndCard($_SESSION["user_id"]);

            if ($_SESSION["user_token"] == $UserObject->getUserConnectedToken())
            {
                $d["user"] = $UserObject;
                isset($log) ? $d["log"] = $log : null;
                $this->set($d);
                $this->render("User", "zoom", $userId);
            }
            else
            {
                $d["log"] = "Il y a un soucis avec le token.";
                $this->set($d);
                $this->render("Home", "main");
            }
        }
        else
        {
            $d["log"] = "Veuillez vous inscrire ou vous connecter afin de profiter de cette fonctionnalité.<br>";
            $this->set($d);
            $this->render("Home", "main");
        }
    }

    public function playerZoom($playerId, $log = null)
    {
        if (isset($_SESSION["user_id"]) && $_SESSION["user_id"] > 0 && $_SESSION["user_id"] != $playerId)
        {
            $UserObject = $this->readAndCard($_SESSION["user_id"]);

            $playerObject = $this->readAndCard($playerId);

            if ($_SESSION["user_token"] == $UserObject->getUserConnectedToken())
            {
                $d["user"] = $UserObject;
                $d["player"] = $playerObject;

                isset($log) ? $d["log"] = $log : null;
                $this->set($d);
                $this->render("User", "playerZoom", $playerId);
            }
            else
            {
                $d["log"] = "Il y a un soucis avec le token.";
                $this->set($d);
                $this->render("Home", "main");
            }
        }
        elseif (isset($_SESSION["user_id"]) && $_SESSION["user_id"] > 0 && $_SESSION["user_id"] == $playerId)
        {
            $this->zoom($_SESSION["user_id"]);
        }
        else
        {
            $d["log"] = "Veuillez vous inscrire ou vous connecter afin de profiter de cette fonctionnalité.<br>";
            $this->set($d);
            $this->render("Home", "main");
        }
    }

    public function archived($userId)
    {
        $this->loadDao("UserDao");

        $userObject = $this->read($userId);

        $userObject->setUserArchived(1);

        $this->UserDao->updateUser($userId, $userObject);

        $this->UserDao->unsetUserConnectedToken($userId);

        $this->destroySession();

        @session_start();
        $_SESSION["user_id"] = 0;

        $d["log"] = "Votre compte à été supprimé partiellement, il le sera entièrement dans 6 mois. Merci d'avoir utilisé notre service.";
        $this->set($d);
        $this->render("Home", "main");
    }

    public function messages($log = null)
    {
        if (isset($_SESSION["user_id"]) && $_SESSION["user_id"] > 0)
        {
            $UserObject = (new UserController)->readAndCard($_SESSION["user_id"]);

            if ($_SESSION["user_token"] === $UserObject->getUserConnectedToken())
            {
                $d["log"] = $log;
                $d["user"] = $UserObject;
                $this->set($d);
                $this->render("User", 'messages');
            }
        }
        else
        {
            $d["log"] = "Vous devez vous connecter pour accéder à ce service.";
            $this->set($d);
            $this->render("Home", "main");
        }
    }

    public function social($log = null)
    {
        if (isset($_SESSION["user_id"]) && $_SESSION["user_id"] > 0)
        {
            $UserObject = (new UserController)->readAndCard($_SESSION["user_id"]);

            if ($_SESSION["user_token"] === $UserObject->getUserConnectedToken())
            {
                $d["log"] = $log;
                $d["user"] = $UserObject;
                $this->set($d);
                $this->render("User", 'social');
            }
        }
        else
        {
            $d["log"] = "Vous devez vous connecter pour accéer à ce service.";
            $this->set($d);
            $this->render("Home", "main");
        }
    }

    public function goToHomeMain($log = null)
    {
        if (isset($_SESSION["user_id"]) && $_SESSION["user_id"] > 0)
        {
            $FreeNextEvents = (new HomeController)->setFreeNextEvents();
            if (isset($FreeNextEvents) && $FreeNextEvents != null)
            {
                foreach ($FreeNextEvents as $key => $NextEvent)
                {
                    $Creators[] = $this->readAndCard($NextEvent->getEventCreatorId());
                }
                $d["freeNextEventsCreators"] = $Creators;
            }
            $d["freeNextEvents"] = $FreeNextEvents;

            $UserObject = $this->readAndCard($_SESSION["user_id"]);
            $d["user"] = $UserObject;
            isset($log) ? $d["log"] = $log : null;
            isset($d) ? $this->set($d) : "";
            $this->render("Home", "main");
        }
        else
        {
            $log = "Une erreur est survenue lors de la connection à votre compte";
            $this->connection($log);
        }
    }


//****************************************************************************************************>>


    //Actions qui renvoient vers les affichages de vue


    public Function connect() //Spécial avec header
    {
        // Test des entrées avec les regex
        $pseudoRegex = "#[\w\-\.]{3,15}#";
        $pseudoRegexState = preg_match($pseudoRegex, htmlspecialchars($this->input["login"]));
        $emailRegex = "/^([\w\.-]+)@([\w\.-]+)\.([A-z]{2,6})$/";
        $emailRegexState = preg_match($emailRegex, htmlspecialchars($this->input["login"]));
        $passwordRegex = "/^(?=.{6,})(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*[&?\\²|°¬\[\]`µ¦¨:€}{\/=%*_\-;+\.'~><,§^¤£@\#!()\"$]).*$/";
        $passwordRegexState = preg_match($passwordRegex, htmlspecialchars($this->input["password"]));

        // Action si le regex du login est validé
        if ($pseudoRegexState === 1 || $emailRegexState === 1)
        {
            // Action si le regex du mot de passe est validé
            if ($passwordRegexState === 1)
            {
                // Action si aucun compte n'est connecté
                if (isset($_SESSION["user_id"]) && $_SESSION["user_id"] == 0 && isset($this->input["login"]))
                {
                    $this->loadDao("UserDao");

                    // Test pour savoir si le login est dans la bdd
                    $user = $this->UserDao->checkLogin(htmlspecialchars($this->input["login"]));

                    // Action si le login est dans la bdd
                    if (!empty($user))
                    {
                        // Action si le login est archivé
                        if ($user[0]["user_archived"] === 1)
                        {
                            $log = 'Le compte associé à ce login a été supprimé, voulez-vous le récupérer ?';
                            $this->recuperation($log);
                        }
                        else
                        {
                            // Vérification du mot de passe avec le hach en bdd
                            if (password_verify(htmlspecialchars($this->input["password"]), $user[0]["user_password"]))
                            {
                                @session_start();
                                $_SESSION["user_id"] = $user[0]["user_id"];
//                            $_SESSION["user_pseudo"] = $user[0]["user_pseudo"];
                                $UserObject = $this->readAndCard($_SESSION["user_id"]);
                                $this->setUserConnectedToken($UserObject);
                                $log = "Vous êtes bien connecté à votre compte.";


//                                header("Location: https://www.partynow.eu/Home/main/");
                                $this->goToHomeMain($log);
                            }
                            // Action si le mot de passe n'est pas correct
                            else
                            {
                                $log = "Mot de passe incorrect.";
                                $this->connection($log);
                            }
                        }
                    }
                    // Action si le login n'est pas dans la bdd
                    else
                    {
                        $log = "Login incorrect.";
                        $this->connection($log);
                    }

                }
                // Action si un compte est déjà connecté
                elseif (isset($_SESSION["user_id"]) && $_SESSION["user_id"] > 0)
                {
                    $log = "Vous êtes déjà connectés à un compte";
                    $this->goToHomeMain($log);
                }
                else
                {
                    $d["log"] = "Veuillez vous inscrire ou vous connecter afin de profiter de cette fonctionnalité.<br>";
                    $this->set($d);
                    $this->render("Home", "main");
                }
            }
            // Action si le regex du mot de passe est refusé
            else
            {
                $log = "Mot de passe au mauvais format.";
                $this->connection($log);
            }
        }
        // Action si le regex du login est refusé
        else
        {
            $log = "Login au mauvais format.";
            $this->connection($log);
        }
    }

    public function create()
    {
        if (isset($_SESSION["user_id"]) && $_SESSION["user_id"] === 0)
        {
            $this->loadDao("UserDao");

            $emailRegex = "/^([\w\.-]+)@([\w\.-]+)\.([A-z]{2,6})$/";
            $emailRegexState = preg_match($emailRegex, htmlspecialchars($this->input["email"]));

            if ($emailRegexState === 1)
            {
                $emailVerified = $this->emailControl(htmlspecialchars($this->input["email"]), htmlspecialchars($this->input["email_verification"]));

                if ($emailVerified)
                {
                    $passwordRegex = "/^(?=.{6,})(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*[&?\\²|°¬\[\]`µ¦¨:€}{\/=%*_\-;+\.'~><,§^¤£@\#!()\"$]).*$/";
                    $passwordRegexState = preg_match($passwordRegex, htmlspecialchars($this->input["password"]));

                    if ($passwordRegexState === 1)
                    {
                        $passwordVerified = $this->passwordControl(htmlspecialchars($this->input["password"]), htmlspecialchars($this->input["password_verification"]));

                        if ($passwordVerified)
                        {
                            $pseudoRegex = "#[\w\-\.]{3,15}#";
                            $pseudoRegexState = preg_match($pseudoRegex, htmlspecialchars($this->input["pseudo"]));

                            if ($pseudoRegexState === 1)
                            {
                                $user = $this->UserDao->checkLogin(htmlspecialchars($this->input["pseudo"]));
                                if (empty($user))
                                {
                                    $user = $this->UserDao->checkLogin(htmlspecialchars($this->input["email"]));

                                    if (empty($user))
                                    {
                                        $newUserObject = new User(htmlspecialchars($this->input["pseudo"]), htmlspecialchars($this->input["email"]), password_hash(htmlspecialchars($this->input["password"]), PASSWORD_DEFAULT));

                                        $this->UserDao->createNewUser($newUserObject);

                                        $_SESSION["user_id"] = DataBase::databaseLastId();

                                        $this->createUserDataFk($_SESSION["user_id"]);

                                        $this->accountVerify(htmlspecialchars($this->input["email"]));

                                        $log = 'Votre compte à bien été créé et un email de vérification vous a été envoyé.';

                                        $this->goToHomeMain($log);
//                                        $this->main($_SESSION["user_id"], $log);
                                    }
                                    else
                                    {
                                        if ($user[0]["user_archived"] === 1)
                                        {
                                            $log = 'Le compte associé à cet email a été supprimé, voulez-vous le récupérer ?';
                                            $this->recuperation($log);
                                        }
                                        else
                                        {
                                            $log = "Un utilisateur avec cet email existe déjà.";
                                            $this->inscription($log);
                                        }
                                    }
                                }
                                else
                                {
                                    if ($user[0]["user_archived"] === 1)
                                    {
                                        $log = 'Le compte associé à ce pseudo a été supprimé, voulez-vous le récupérer ?';
                                        $this->recuperation($log);
                                    }
                                    else
                                    {
                                        $log = "Un utilisateur avec ce pseudo existe déjà.";
                                        $this->inscription($log);
                                    }
                                }
                            }
                            else
                            {
                                $log = "Le format du pseudo n'est pas valide.";
                                $this->inscription($log);
                            }
                        }
                        else
                        {
                            $log = "Les champs mot de passe ne correspondent pas.";
                            $this->inscription($log);
                        }
                    }
                    else
                    {
                        $log = "Le format du mot de passe n'est pas valide.";
                        $this->inscription($log);
                    }
                }
                else
                {
                    $log = "Les champs emails ne correspondent pas.";
                    $this->inscription($log);
                }
            }
            else
            {
                $log = "Le format d'email n'est pas valide.";
                $this->inscription($log);
            }
        }
        else
        {
            $this->render("Home", 'main');
        }
    }

    public function update($id)
    {
        $UserObject = $this->read($id);

        // conflit si le pseudo est celui de l'utilisateur
        if ($UserObject->getUserPseudo() === $this->input["pseudo"] || !$this->loginExist($this->input["pseudo"]))
        {
            if ($UserObject->getUserEmail() === $this->input["email"] || !$this->loginExist($this->input["email"]))
            {
                $newData = $this->fillObject($id);

                $this->UserDao->updateUserData($id, $newData);

                $log = "Vos informations de compte ont bien été mises à jour.";

                $this->zoom($id, $log);
            }
            elseif ($this->loginExist($this->input["email"]))
            {
                $log = "Un utilisateur avec cet email existe déjà.";
                $this->modification($id, $log);
            }
        }
        elseif ($this->loginExist($this->input["pseudo"]))
        {
            $log = "Un utilisateur avec ce pseudo existe déjà.";
            $this->modification($id, $log);
        }
    }

    public function updateUserAvatar($userId)
    {
        if ($userId == $_SESSION["user_id"])
        {
            $this->loadDao("UserDao");

            $userPseudo = $this->UserDao->getPseudo($userId);
            $folder = ROOT . 'public/images/users_avatars/';
            $nameArray = explode(".", $this->files["new_avatar_image"]["name"]);
            $extension = $nameArray[count($nameArray) - 1];
            $filename = basename($userId . "." . $userPseudo . "." . $extension);


            //Suppression de l'ancienne image
            if (file_exists($filename))
            {
                unlink($filename);
            }

            if (move_uploaded_file($this->files['new_avatar_image']['tmp_name'], $folder . $filename))
            {
                $this->UserDao->updateUserAvatar($filename, $userId);
                $log = "Votre image de profil à bien été changée. Elle sera visible dans quelques instants.";
                $this->main($userId, $log);
            }
            else
            {
                $log = "Votre image de profil n'as pas pu être changée. Veuillez réessayer.";
                $this->avatarChange($userId, $log);
            }
        }
        else
        {
            $log = "Vous n'êtes pas autorisé à faire cette action";
            $this->main($_SESSION["user_id"], $log);
        }
    }

    public function recup()
    {
        if (isset($_SESSION["user_id"]) && $_SESSION["user_id"] == 0)
        {
            $pseudoRegex = "#[\w\-\.]{3,15}#";
            $emailRegex = "/^([\w\.-]+)@([\w\.-]+)\.([A-z]{2,6})$/";

            $pseudoRegexState = preg_match($pseudoRegex, htmlspecialchars($this->input["login"]));
            $emailRegexState = preg_match($emailRegex, htmlspecialchars($this->input["login"]));

            if ($pseudoRegexState === 1 || $emailRegexState === 1)
            {
                $this->loadDao("UserDao");

                $user = $this->UserDao->checkLogin(htmlspecialchars($this->input["login"]));

                if (!empty($user))
                {
                    if (password_verify(htmlspecialchars($_POST["password"]), $user[0]["user_password"]))
                    {
                        $_SESSION["user_id"] = $user[0]["user_id"];

                        $userObject = $this->UserDao->readUserInfos($_SESSION["user_id"]);

                        $userObject = $this->addCardInfos($userObject);
                        $this->setUserConnectedToken($userObject);
                        $userObject->setUserArchived(0);

                        $this->UserDao->updateUser($user[0]["user_id"], $userObject);
                        $d["log"] = "Votre compte a bien été récupéré";
                        $d["user"] = $userObject;
                        $this->set($d);
                        $this->render("Home", "main");

                    }
                    else
                    {
                        $log = "Mot de passe incorrect.";
                        $this->recuperation($log);
                    }
                }
                else
                {
                    $log = "Login incorrect.";
                    $this->recuperation($log);
                }
            }
            elseif ($pseudoRegexState === 0 && $emailRegexState === 1)
            {
                $log = "Le format du pseudo n'est pas valide.";
                $this->recuperation($log);
            }
            elseif ($pseudoRegexState === 1 && $emailRegexState === 0)
            {
                $log = "Le format de l'email n'est pas valide.";
                $this->recuperation($log);
            }
            else
            {
                $log = "Le format du login n'est pas valide.";
                $this->recuperation($log);
            }
        }
        else
        {
            $log = 'Vous devez être déconnecté afin de récupérer un compte.';
            $this->main($_SESSION["user_id"], $log);
        }
    }

    public function newPassword($id)
    {
        $passwordRegex = "/^(?=.{6,})(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*[&?\\²|°¬\[\]`µ¦¨:€}{\/=%*_\-;+\.'~><,§^¤£@\#!()\"$]).*$/";
        $passwordRegexState = preg_match($passwordRegex, htmlspecialchars($this->input["password"]));

        if ($passwordRegexState === 1)
        {

            $passwordVerified = $this->passwordControl(htmlspecialchars($this->input["password"]), htmlspecialchars($this->input["password_verification"]));

            if ($passwordVerified)
            {
                if (isset($_SESSION["user_id"]) && $_SESSION["user_id"] > 0)
                {
                    $this->loadDao("UserDao");
                    $userObject = $this->read($id);

                    if (password_verify(htmlspecialchars($this->input["old_password"]), $userObject->getUserPassword()))
                    {
                        $userObject->setUserPassword(password_hash(htmlspecialchars($this->input["password"]), PASSWORD_DEFAULT));
                        $this->UserDao->updateUser($id, $userObject);

                        $log = "Votre mot de passe à bien été changé";

                        $this->main($id, $log);
                    }
                    else
                    {
                        $log = "Votre ancien mot de passe est erroné";
                        $this->security($_SESSION["user_id"], $log);
                    }
                }
            }
            else
            {
                $log = "Les champs du nouveau mot de passe ne correspondent pas";
                $this->security($_SESSION["user_id"], $log);
            }
        }
        else
        {
            $log = "Le format du nouveau mot de passe n'est pas valide.";
            $this->security($_SESSION["user_id"], $log);
        }
    }

    public function passwordReset()
    {
        if (isset($_SESSION["user_id"]) && $_SESSION["user_id"] == 0 && isset($this->input["login"]) && strlen($this->input["login"]) > 0)
        {
            $this->loadDao("UserDao");

            $user = $this->UserDao->checkLogin($this->input["login"]);

            if (is_array($user) && count($user) > 0)
            {
                $userObject = $this->read($user[0]["user_id"]);

                $token = uniqid();

                $userObject->setUserToken($token);

                $this->updateUser($user[0]["user_id"], $userObject);

                $link = "https://www.partynow.eu/User/passwordResetForm/" . $token . "/" . $user[0]["user_id"];

                $message = "Voici le lien vous permettant de réinitialiser votre mot de passe : " . $link;

                ini_set("SMTP", "smtp.ionos.fr");
                mail(utf8_decode($userObject->getuserEmail()), utf8_decode("Réinitialisation du mot de passe Party Now"), utf8_decode($message),
                    utf8_decode("From : PartyNow <contact@partynow.eu>"));

                $d["log"] = "Un lien vous permettant de réinitialiser votre mot de passe à été envoyé sur votre adresse mail.";
                $this->set($d);
                $this->render("Home", "main");
            }
            else
            {
                $log = "Votre login (pseudo/email) n'est pas dans la base de donnée";
                $this->passwordForgotten($log);
            }
        }
        else
        {
            $log = "Vous n'avez pas accès à ce contenu";
            $this->main($_SESSION["user_id"], $log);
        }
    }

    public function passwordChange($id)
    {
        $passwordRegex = "/^(?=.{6,})(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*[&?\\²|°¬\[\]`µ¦¨:€}{\/=%*_\-;+\.'~><,§^¤£@\#!()\"$]).*$/";
        $passwordRegexState = preg_match($passwordRegex, htmlspecialchars($this->input["password"]));

        $this->loadDao("UserDao");
        $UserObject = $this->read($id);

        if ($passwordRegexState === 1)
        {

            $passwordVerified = $this->passwordControl(htmlspecialchars($this->input["password"]), htmlspecialchars($this->input["password_verification"]));

            if ($passwordVerified)
            {

                $UserObject->setUserPassword(password_hash(htmlspecialchars($this->input["password"]), PASSWORD_DEFAULT));

                $UserObject->setUserToken(null);

                $this->UserDao->updateUser($id, $UserObject);

                $this->destroySession();

                $log = "Votre mot de passe à bien été changé";
                $this->connection($log);


/*                @session_start();

                $_SESSION["user_id"] = $id;

                $UserObject = $this->readAndCard($_SESSION["user_id"]);
                $this->setUserConnectedToken($UserObject);


                $this->zoom($id, $log);*/
//                $this->goToHomeMain($log);
            }
            else
            {
                $d["log"] = "les champs mot de passe ne correspondent pas";
                $this->set($d);

            }
        }
        else
        {
            $log = "Le format du nouveau mot de passe n'est pas valide.";
            $this->passwordResetForm($UserObject->getUserToken(), $_SESSION["user_id"], $log);
        }
    }

    public function accountValidation($token, $id)
    {
        $userObject = $this->read($id);

        if (isset($_SESSION["user_id"]) && $_SESSION["user_id"] === null)
        {
            $_SESSION["user_id"] = $id;
        }

        if ($token === $userObject->getUserToken() && $userObject->getUserVerified() === 0)
        {
            $userObject->setUserVerified(1);
            $userObject->setUserToken(null);
            $this->updateUser($id, $userObject);
            $_SESSION["user_id"] = $id;
            $log = "Votre compte à bien été vérifié.";
            $this->security($id, $log);
        }
        elseif ($token === $userObject->getUserToken() && $userObject->getUserVerified() === 1)
        {
            $userObject->setUserToken(null);
            $this->updateUser($id, $userObject);
            $_SESSION["user_id"] = $id;
            $log = "Votre compte à déjà été vérifié";
            $this->security($id, $log);
        }
        else
        {
            $log = "Impossible de vérifier votre compte, veuillez réessayer";
            $this->security($id, $log);
        }
    }

    public function getUserRealIdFile($userId)
    {
        $this->loadDao("UserDao");

        $userPseudo = $this->UserDao->getPseudo($userId);

        $folder = ROOT . 'private/images/real_id/';

        $nameArray = explode(".", $this->files["real_id"]["name"]);

        $extension = $nameArray[count($nameArray) - 1];

        $filename = basename($userId . "." . $userPseudo . "." . $extension);

        $this->UserDao->createRealIdFile($userId, $filename);
        $this->UserDao->changeRealIdStatus(1, $userId);

        if (move_uploaded_file($this->files['real_id']['tmp_name'], $folder . $filename))
        {
            $log = "Votre pièce d'identité a bien été uploadée, un modérateur va la vérifier sous peu.";
            $this->security($userId, $log);
        }
        else
        {
            $log = "Il y a eu un problème avec l'upload du fichier, veuillez réessayer.";
            $this->security($userId, $log);
        }
    }

    public function deleteUser($id)
    {
        if ($_SESSION["user_id"] == $id)
        {
            $this->loadDao("UserDao");
            $userObject = $this->read($id);
            $avatarFile = ROOT . 'public/images/users_avatars/' . ($userObject->getUserAvatar() != null) ? $userObject->getUserAvatar() : "noimage.jpg";
            if (file_exists($avatarFile))
            {
                unlink($avatarFile);
            }
            $this->UserDao->deleteUser($id);
            $this->destroySession();

            $d["log"] = "Vous avez bien supprimé votre compte.";
            $this->set($d);
            $this->render("Home", "main");
        }
    }


    //Actions
    public function destroySession()
    {
        $_SESSION = "";
        @session_destroy();
        @session_start();
        $_SESSION["user_id"] = 0;
    }

    public function createUserDataFk($id)
    {
        $this->loadDao("UserDao");

        $this->UserDao->createNewUserDataFk($id);
    }

    public function updateUser($id, $UserObject)
    {
        $this->UserDao->updateUser($id, $UserObject);
    }

    public function sendVerificationEmail($id)
    {
        $this->loadDao("UserDao");

        $userObject = $this->read($id);

        $token = uniqid() . uniqid();

        $userObject->setUserToken($token);

        $this->updateUser($id, $userObject);

        $email = $userObject->getUserEmail();

        $link = "https://partynow.eu/" . WEBROOT . "User/accountValidation/" . $token . "/" . $id;

        $message = "Voici le lien vous permettant de vérifier votre compte : " . $link;

        $log = "Un lien vous permettant de vérifier votre compte vous a été envoyé par email.<br/>";

        ini_set("SMTP", "smtp.ionos.fr");

        mail(utf8_decode($email), utf8_decode("Vérification d'email"), utf8_decode($message), utf8_decode("From : PartyNow <contact@partynow.eu>"));

        $this->security($_SESSION["user_id"], $log);
    }

    public function accountVerify($email)
    {
        $UserObject = $this->read($_SESSION["user_id"]);

        $token = uniqid() . uniqid();

        $UserObject->setUserToken($token);

        $this->updateUser($_SESSION["user_id"], $UserObject);

        $log = "Un lien vous permettant de vérifier votre compte vous a été envoyé par email.";

        $link = "https://partynow.eu/" . WEBROOT . "User/accountValidation/" . $token . "/" . $_SESSION["user_id"];

        $message = "Voici le lien vous permettant de vérifier votre email : " . $link;

        ini_set("SMTP", "smtp.ionos.fr");

        mail(utf8_decode($email), utf8_decode("Vérification d'email"), utf8_decode($message), utf8_decode("From : PartyNow <contact@partynow.eu>"));
    }


    //Actions renvoyant un objet
    public function fillObject($id)
    {
        $this->loadDao("UserDao");

        $userObject = $this->UserDao->readUserInfos($id);

        if (empty($this->input["pseudo"]))
        {
            $this->input["pseudo"] = $userObject->getUserPseudo();
        }
        if (empty($this->input["email"]))
        {
            $this->input["email"] = $userObject->getUserEmail();
        }
        if (empty($this->input["firstname"]))
        {
            $this->input["firstname"] = $userObject->getUserDataFirstname();
        }
        if (empty($this->input["lastname"]))
        {
            $this->input["lastname"] = $userObject->getUserDataLastname();
        }
        if (empty($this->input["birthdate"]))
        {
            if ($userObject->getUserDataBirthdate() != null)
            {
                $this->input["birthdate"] = date_format(new DateTime($userObject->getUserDataBirthdate()), "Y-m-d");
            }
            else
            {
                $this->input["birthdate"] = "1900-01-01";
            }
        }
        if (empty($this->input["gender"]))
        {
            $this->input["gender"] = $userObject->getUserDataGender();
        }
        if (empty($this->input["address"]))
        {
            $this->input["address"] = $userObject->getUserDataAddress();
        }
        if (empty($this->input["postcode"]))
        {
            $this->input["postcode"] = $userObject->getUserDataPostcode();
        }
        if (empty($this->input["city"]))
        {
            $this->input["city"] = $userObject->getUserDataCity();
        }
        if (empty($this->input["country"]))
        {
            $this->input["country"] = $userObject->getUserDataCountry();
        }
        if (empty($this->input["phone"]))
        {
            $this->input["phone"] = $userObject->getUserDataPhone();
        }

        $newUserDataObject = new User($this->input["pseudo"], $this->input["email"], "");
        $newUserDataObject->setId($_SESSION["user_id"]);
        $newUserDataObject->setUserDataFirstname($this->input["firstname"]);
        $newUserDataObject->setUserDataLastname($this->input["lastname"]);
        $newUserDataObject->setUserDataBirthdate($this->input["birthdate"]);
        $newUserDataObject->setUserDataGender($this->input["gender"]);
        $newUserDataObject->setUserDataAddress($this->input["address"]);
        $newUserDataObject->setUserDataPostcode($this->input["postcode"]);
        $newUserDataObject->setUserDataCity($this->input["city"]);
        $newUserDataObject->setUserDataCountry($this->input["country"]);
        $newUserDataObject->setUserDataPhone($this->input["phone"]);

        return $newUserDataObject;
    }

    public function read($id)
    {
        $this->loadDao("UserDao");

        $userObject = $this->UserDao->readUserInfos($id);

        return $userObject;
    }

    public function readAndCard($id)
    {
        $userObject = $this->read($id);

        $userObject = $this->setReputationStars($userObject);
        $userObject = $this->setStatusName($userObject);
        $userObject = $this->setUserIncomingEventsNumber($userObject);

        return $userObject;
    }

    public function addCardInfos($userObject)
    {
        $userObject = $this->setReputationStars($userObject);
        $userObject = $this->setStatusName($userObject);
        $userObject = $this->setUserIncomingEventsNumber($userObject);

        return $userObject;
    }


    //Actions renvoyant un tableau


    //Actions renvoyant une variable

    public function loginExist($login)
    {
        $this->loadDao("UserDao");

        $userArray = $this->UserDao->checkLogin($login);

        if (is_array($userArray) && count($userArray) > 0)
        {
            $loginExist = true;
        }
        else
        {
            $loginExist = false;
        }

        return $loginExist;
    }


    //Ajoutent des valeurs aux objets
    public function setReputationStars($userObject)
    {
        if ($userObject->getUserReputation() > 4)
        {
            $userObject->setUserReputationStars('<img src="'.WEBROOT.'public/images/reputation_5.png" alt="Réputation 5 étoiles" style="height: 10px">');
        }
        elseif ($userObject->getUserReputation() > 3)
        {
            $userObject->setUserReputationStars('<img src="'.WEBROOT.'public/images/reputation_4.png" alt="Réputation 4 étoiles" style="height: 10px">');
        }
        elseif ($userObject->getUserReputation() > 2)
        {
            $userObject->setUserReputationStars('<img src="'.WEBROOT.'public/images/reputation_3.png" alt="Réputation 3 étoiles" style="height: 10px">');
        }
        elseif ($userObject->getUserReputation() > 1)
        {
            $userObject->setUserReputationStars('<img src="'.WEBROOT.'public/images/reputation_2.png" alt="Réputation 2 étoiles" style="height: 10px">');
        }
        elseif ($userObject->getUserReputation() > 0)
        {
            $userObject->setUserReputationStars('<img src="'.WEBROOT.'public/images/reputation_1.png" alt="Réputation 1 étoiles" style="height: 10px">');
        }
        return $userObject;
    }

    public function setStatusName($userObject)
    {
        if ($userObject->getUserStatus() === 0)
        {
            $userObject->setUserStatusName("Utilisateur");
        }
        elseif ($userObject->getUserStatus() === 1)
        {
            $userObject->setUserStatusName("Modérateur");
        }
        elseif ($userObject->getUserStatus() === 99)
        {
            $userObject->setUserStatusName("Administrateur");
        }

        return $userObject;
    }

    public function setGenderName($userObject)
    {
        if ($userObject->getUserDataGender() === 4)
        {
            $userObject->setUserDataGenderName("Non spécifié");
        }
        elseif ($userObject->getUserDataGender() === 1)
        {
            $userObject->setUserDataGenderName("Homme");
        }
        elseif ($userObject->getUserDataGender() === 2)
        {
            $userObject->setUserDataGenderName("Femme");
        }
        elseif ($userObject->getUserDataGender() === 3)
        {
            $userObject->setUserDataGenderName("Autre");
        }

        return $userObject;
    }

    public function setUserAge($userBirthDate)
    {
        $am = explode('/', $userBirthDate);
        $an = explode('/', date('d/m/Y'));
        if (($am[1] < $an[1]) || (($am[1] == $an[1]) && ($am[0] <= $an[0]))) return $an[2] - $am[2];
        return $an[2] - $am[2] - 1;
    }

    public function setUserIncomingEventsNumber($userObject)
    {
        $this->loadDao("EventPlayersDao");
        $playerEventsArray = $this->EventPlayersDao->getPlayerEvents($userObject->getId());

        if (isset($playerEventsArray))
        {
            $this->loadDao("EventDao");
            foreach ($playerEventsArray as $key => $playerEvent)
            {
                $playerEventOnlineObject = $this->EventDao->readOnlineEventById($playerEvent["event_fk"]);
                if (!empty($playerEventOnlineObject))
                {
                    $this->setEventTimestamp($playerEventOnlineObject);
                    $dayTimestamp = date_format(new DateTime(), "U");

                    if ($dayTimestamp < $playerEventOnlineObject->getEventTimestamp())
                    {
                        $playerEventsOnlineArray[] = $playerEventOnlineObject;
                    }
                }
            }
        }

        if (isset($playerEventsOnlineArray))
        {
            $userEventsNumber = count($playerEventsOnlineArray);
        }
        else
        {
            $userEventsNumber = 0;
        }

        $userObject->setUserEventsNumber($userEventsNumber);
        return $userObject;
    }

    public function setEventTimestamp($eventObject)
    {
        if (is_array($eventObject))
        {
            foreach ($eventObject as $key => $event)
            {
                $datetime = $event->getEventDate() . " " . $event->getEventTime();
                $timestamp = date_format(new DateTime($datetime), "U");
                $event->setEventTimestamp($timestamp);
            }
        }
        else
        {
            $datetime = $eventObject->getEventDate() . " " . $eventObject->getEventTime();
            $timestamp = date_format(new DateTime($datetime), "U");
            $eventObject->setEventTimestamp($timestamp);
        }
        return $eventObject;
    }

    public function setUserConnectedToken($UserObject)
    {
        $token = uniqid() . uniqid();
        $UserObject->setUserConnectedToken($token);
        $this->updateUser($UserObject->getId(), $UserObject);
        $_SESSION["user_token"] = $token;
        return $UserObject;
    }

    // Contrôles d'entrées utilisateur
    public function emailControl($email, $emailVerification)
    {
        if ($email === $emailVerification)
        {
            $emailVerified = true;
            return $emailVerified;
        }
    }


    public function passwordControl($password, $passwordVerification)
    {
        if ($password === $passwordVerification)
        {
            $passwordVerified = true;
            return $passwordVerified;
        }
    }

}
