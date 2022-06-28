
let headerMenuChildrenEvents = document.querySelector("#header_menu_children_events");
let headerMenuChildrenMore = document.querySelector("#header_menu_children_more");
let headerMenuChildrenProfile = document.querySelector("#header_menu_children_profile");
let headerMenuParents = document.querySelector("#header_menu_parents");

let inscriptionFormPseudo = document.querySelector("#inscription_form_pseudo");
let inscriptionFormEmail = document.querySelector("#inscription_form_email");
let inscriptionFormEmailVerification = document.querySelector("#inscription_form_email_verification");
let inscriptionFormPassword = document.querySelector("#inscription_form_password");
let inscriptionFormPasswordVerification = document.querySelector("#inscription_form_password_verification");

let modificationFormPseudo = document.querySelector("#modification_form_pseudo");
let modificationFormEmail = document.querySelector("#modification_form_email");
let modificationFormFirstname = document.querySelector("#modification_form_firstname");
let modificationFormLastname = document.querySelector("#modification_form_lastname");
let modificationFormBirthdate = document.querySelector("#modification_form_birthdate");
let modificationFormAddress = document.querySelector("#modification_form_address");
let modificationFormPostcode = document.querySelector("#modification_form_postcode");
let modificationFormCity = document.querySelector("#modification_form_city");
let modificationFormCountry = document.querySelector("#modification_form_country");
let modificationFormPhone = document.querySelector("#modification_form_phone");

let securityFormPassword = document.querySelector("#security_form_password");
let securityFormPasswordVerification = document.querySelector("#security_form_password_verification");

let passwordResetFormPassword = document.querySelector("#password_reset_form_password");
let passwordResetFormPasswordVerification = document.querySelector("#password_reset_form_password_verification");

let newEventFormName = document.querySelector("#new_event_name_input");
let newEventFormDate = document.querySelector("#new_event_date_input");
let newEventFormTime = document.querySelector("#new_event_time_input");
let newEventFormDescription = document.querySelector("#new_event_description_input");
let newEventFormGame = document.querySelector("#new_event_game_input");
let newEventFormMaxPlayers = document.querySelector("#new_event_max_players_input");

// let descriptionModification regex a faire on verra vu que je vais modifier tout l'event

let logDiv = document.querySelector("#log_div");

let regexPseudo = /^[\w-.]{3,15}$/;
let regexEmail = /^[a-z0-9._-]+@[a-z0-9._-]+\.[a-z0-9]{2,6}$/;
let regexName = /^[A-Za-zÀ-ÖØ-öø-ÿ][A-Za-zÀ-ÖØ-öø-ÿ- ]{0,18}[A-Za-zÀ-ÖØ-öø-ÿ]$/;
let regexPassword = /^(?=.{6,})(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*[&?\\²|°¬\[\]`µ¦¨:€}{\/=%*_\-;+\.'~><,§^¤£@\#!()"$]).*$/;
let regexAddress = /^[A-Za-zÀ-ÖØ-öø-ÿ0-9][A-Za-zÀ-ÖØ-öø-ÿ0-9-, ]{0,38}[A-Za-zÀ-ÖØ-öø-ÿ0-9]$/;
let regexPostcode = /^[A-Za-zÀ-ÖØ-öø-ÿ0-9][A-Za-zÀ-ÖØ-öø-ÿ- ]{0,10}[A-Za-zÀ-ÖØ-öø-ÿ0-9]$/;
let regexCity = /^[A-Za-zÀ-ÖØ-öø-ÿ][A-Za-zÀ-ÖØ-öø-ÿ- ]{0,18}[A-Za-zÀ-ÖØ-öø-ÿ]$/;
let regexCountry = /^[A-Za-zÀ-ÖØ-öø-ÿ][A-Za-zÀ-ÖØ-öø-ÿ- ]{0,18}[A-Za-zÀ-ÖØ-öø-ÿ]$/;
let regexPhone = /^[0-9+][0-9 ]{5,18}[0-9]$/;
let regexEventName = /^[A-Za-zÀ-ÖØ-öø-ÿ0-9][ A-Za-zÀ-ÖØ-öø-ÿ0-9:;',.!?\-]{8,38}[A-Za-zÀ-ÖØ-öø-ÿ0-9.!?]$/;
let regexEventDate = /^20[0-9]{2}-[0-1]{1}[0-9]{1}-[0-3]{1}[0-9]{1}$/;
let regexEventTime = /^[0-9]{2}:[0-9]{2}$/;
let regexEventDescription = /^[A-Za-zÀ-ÖØ-öø-ÿ0-9][A-Za-zÀ-ÖØ-öø-ÿ0-9:;',.!?()/^\-\n ]{48,198}[A-Za-zÀ-ÖØ-öø-ÿ0-9:;',/.!?()^\-]$/;
let regexEventGame = /^[1-9][0-9]{0,2}$/;
let regexEventMaxPlayers = /^[1-9][0-9]{0,2}$/;

let messageErrorPseudo = "Votre pseudo doit avoir entre 3 et 15 caractères et peut contenir les symboles suivant - . _";
let messageErrorEmail = "Mauvaise syntaxe d'email, écrire en minuscule";
let messageErrorEmailVerification = "Les emails ne correspondent pas";
let messageErrorFirstame = "Votre prénom peut avoir entre 2 et 20 caractères et peut contenir un espace ou un tiret au milieu";
let messageErrorLastname = "Votre nom peut avoir entre 2 et 20 caractères et peut contenir un espace ou un tiret au milieu";
let messageErrorPassword = "Votre mot de passe peut contenir au minimum 6 caractères dont 1 MAJUSCULE, 1 minuscule, 1 chiffre et 1 symbole";
let messageErrorPasswordVerification = "Les mots de passes ne correspondent pas";
let messageErrorBirthdate = "Votre date de naissance ne peut pas être dans le futur";
let messageErrorAddress = "Votre adresse peut avoir entre 2 et 40 caractères et peut contenir un espace, une virgule ou un tiret au milieu";
let messageErrorPostcode = "Votre code postal doit avoir entre 2 et 12 caractères alphanumériques. Tirets et espaces autorisés.";
let messageErrorCity = "Votre ville peut avoir entre 2 et 20 caractères et peut contenir un espace ou un tiret au milieu";
let messageErrorCountry = "Votre pays peut avoir entre 2 et 20 caractères et peut contenir un espace ou un tiret au milieu";
let messageErrorPhone = "Votre téléphone ne peut contenir que des caractères numériques, peut commencer par un + et contenir des espaces.";
let messageErrorEventName = "10 à 50 caractères\nautorisés au milieu\n espaces et : ; ' , . -";
let messageErrorEventDate = "Date non valide";
let messageErrorEventTime = "Vous devez entrer une heure au bon format";
let messageErrorEventDescription = "50 à 200 caractères\n autorisés au milieu\n espaces et : ; ' , . -";
let messageErrorEventGame = "Vous devez entrer un nom de jeu valide";
let messageErrorEventMaxPlayers = "Vous devez entrer un nombre uniquement";


if (logDiv.style.display === "block")
{
    setTimeout(closeLogDiv, 3000);
}

function closeLogDiv()
{
    logDiv.style.display = "none";
}


if (inscriptionFormPseudo)
{
    inscriptionFormPseudo.addEventListener("input", function ()
    {
        testFormInput(inscriptionFormPseudo, regexPseudo, logDiv, messageErrorPseudo);
    });

    inscriptionFormEmail.addEventListener("input", function ()
    {
        testFormInput(inscriptionFormEmail, regexEmail, logDiv, messageErrorEmail);
    });

    inscriptionFormEmailVerification.addEventListener("input", function ()
    {
        testFormInputVerification(inscriptionFormEmail, inscriptionFormEmailVerification, logDiv, messageErrorEmailVerification);
    });

    inscriptionFormPassword.addEventListener("input", function ()
    {
        testFormInput(inscriptionFormPassword, regexPassword, logDiv, messageErrorPassword);
    });

    inscriptionFormPasswordVerification.addEventListener("input", function ()
    {
        testFormInputVerification(inscriptionFormPassword, inscriptionFormPasswordVerification, logDiv, messageErrorPasswordVerification);
    });
}
else if (modificationFormPseudo)
{
    modificationFormPseudo.addEventListener("input", function ()
    {
        testFormModificationInput(modificationFormPseudo, regexPseudo, logDiv, messageErrorPseudo);
    });

    modificationFormEmail.addEventListener("input", function ()
    {
        testFormModificationInput(modificationFormEmail, regexEmail, logDiv, messageErrorEmail);
    });

    modificationFormFirstname.addEventListener("input", function ()
    {
        testFormModificationInput(modificationFormFirstname, regexName, logDiv, messageErrorFirstame);
    });

    modificationFormLastname.addEventListener("input", function ()
    {
        testFormModificationInput(modificationFormLastname, regexName, logDiv, messageErrorLastname);
    });

    modificationFormAddress.addEventListener("input", function ()
    {
        testFormModificationInput(modificationFormAddress, regexAddress, logDiv, messageErrorAddress);
    });

    modificationFormPostcode.addEventListener("input", function ()
    {
        testFormModificationInput(modificationFormPostcode, regexPostcode, logDiv, messageErrorPostcode);
    });

    modificationFormCity.addEventListener("input", function ()
    {
        testFormModificationInput(modificationFormCity, regexCity, logDiv, messageErrorCity);
    });

    modificationFormCountry.addEventListener("input", function ()
    {
        testFormModificationInput(modificationFormCountry, regexCountry, logDiv, messageErrorCountry);
    });

    modificationFormPhone.addEventListener("input", function ()
    {
        testFormModificationInput(modificationFormPhone, regexPhone, logDiv, messageErrorPhone);
    });
}
else if (securityFormPassword)
{
    securityFormPassword.addEventListener("input", function ()
    {
        testFormInput(securityFormPassword, regexPassword, logDiv, messageErrorPassword);
    });

    securityFormPasswordVerification.addEventListener("input", function ()
    {
        testFormInputVerification(securityFormPassword, securityFormPasswordVerification, logDiv, messageErrorPasswordVerification);
    });
}
else if (passwordResetFormPassword)
{
    passwordResetFormPassword.addEventListener("input", function ()
    {
        testFormInput(passwordResetFormPassword, regexPassword, logDiv, messageErrorPassword);
    });

    passwordResetFormPasswordVerification.addEventListener("input", function ()
    {
        testFormInputVerification(passwordResetFormPassword, passwordResetFormPasswordVerification, logDiv, messageErrorPasswordVerification);
    });
}
else if (newEventFormName)
{
    newEventFormName.addEventListener("input", function ()
    {
        testFormInput(newEventFormName, regexEventName, document.querySelector("#new_event_name_div"), messageErrorEventName);
    });
    newEventFormDate.addEventListener("input", function ()
    {
        testFormInput(newEventFormDate, regexEventDate, document.querySelector("#new_event_date_div"), messageErrorEventDate);
    });
    newEventFormTime.addEventListener("input", function ()
    {
        testFormInput(newEventFormTime, regexEventTime, document.querySelector("#new_event_time_div"), messageErrorEventTime);
    });
    newEventFormDescription.addEventListener("input", function ()
    {
        testFormInput(newEventFormDescription, regexEventDescription, document.querySelector("#new_event_description_div"), messageErrorEventDescription);
    });
    newEventFormGame.addEventListener("input", function ()
    {
        testFormInput(newEventFormGame, regexEventGame, logDiv, messageErrorEventGame);
    });
    newEventFormMaxPlayers.addEventListener("input", function ()
    {
        testFormInput(newEventFormMaxPlayers, regexEventMaxPlayers, logDiv, messageErrorEventMaxPlayers);
    });
}


/*Fonctions uniques*/
/****************************************************************************************************/
function changeUrl(url)
{
    let pathName = window.location.pathname;
    pathName = pathName.split('/');
    let folder = pathName[1];

    history.replaceState(null, null, window.location.protocol + "//" + window.location.host + '/' + url);
    // history.replaceState(null, null, window.location.protocol + "//" + window.location.host + '/' + folder + '/' + url);
}
/****************************************************************************************************/



/*Fonctions liées aux regex*/
/****************************************************************************************************/
function testFormInput(testedInput, regexInput, infosInput, messageErrorInput)
{
    if (testedInput.value.length > 0)
    {
        if(!regexInput.test(testedInput.value))
        {
            infosInput.innerText = messageErrorInput;
            infosInput.style.display = "block";
            infosInput.style.backgroundColor = "#ff4e4e";
            testedInput.style.backgroundColor = "#ff4e4e";
        }
        else
        {
            infosInput.innerText = "";
            infosInput.style.display = "none";
            infosInput.style.backgroundColor = "palegreen";
            testedInput.style.backgroundColor = "palegreen";
        }
    }
    else
    {
        infosInput.innerText = "Veuillez remplir le champ requis";
        infosInput.style.display = "block";
        infosInput.style.backgroundColor = "#ff4e4e";
        testedInput.style.backgroundColor = "";
    }
}
function testFormInputVerification(baseInput, verificationInput, infosInput, messageErrorInput)
{
    if(verificationInput.value.length > 0)
    {
        if(verificationInput.value !== baseInput.value)
        {
            infosInput.innerText = messageErrorInput;
            infosInput.style.display = "block";
            infosInput.style.backgroundColor = "#ff4e4e";
            verificationInput.style.backgroundColor = "#ff4e4e";
        }
        else
        {
            infosInput.innerText = "";
            infosInput.style.display = "none";
            infosInput.style.backgroundColor = "palegreen";
            verificationInput.style.backgroundColor = "#7EFF80";
        }
    }
    else
    {
        infosInput.innerText = "Veuillez remplir le champ requis";
        infosInput.style.display = "block";
        infosInput.style.backgroundColor = "#ff4e4e";
        baseInput.style.backgroundColor = "";
    }
}

function testFormModificationInput(testedInput, regexInput, infosInput, messageErrorInput)
{
    if (testedInput.value.length > 0)
    {
        if(!regexInput.test(testedInput.value))
        {
            infosInput.innerText = messageErrorInput;
            infosInput.style.display = "block";
            infosInput.style.backgroundColor = "#ff4e4e";
            testedInput.style.backgroundColor = "#ff4e4e";
        }
        else
        {
            infosInput.innerText = "";
            infosInput.style.display = "none";
            infosInput.style.backgroundColor = "palegreen";
            testedInput.style.backgroundColor = "#7EFF80";
        }
    }
    else
    {
        infosInput.innerText = "";
        infosInput.style.display = "none";
        infosInput.style.backgroundColor = "palegreen";
        testedInput.style.backgroundColor = "";
    }
}
/****************************************************************************************************/

let userCard = document.querySelector(".user_card_grid");
let creatorCard = document.querySelector(".creator_card_grid");
let creatorsCard = document.querySelector(".creators_card_grid");
let playerCard = document.querySelector(".player_card_grid");
let waiterCard = document.querySelector(".waiter_card_grid");


/*Fonctions pour afficher les cartes*/
/****************************************************************************************************/
if (creatorCard)
{
    function showCreatorCard(id)
    {
        let creatorCardList = document.querySelector("#creator_" + id + "_card");
        creatorCardList.style.display = "inline-grid";
    }

    function hideCreatorCard(id)
    {
        let creatorCardList = document.querySelector("#creator_" + id + "_card");
        creatorCardList.style.display = "none";
    }

    function toggleCreatorCard(id)
    {
        let creatorCardList = document.querySelector("#creator_" + id + "_card");
        if (creatorCardList.style.display === "none")
        {
            closeCards();
            creatorCardList.style.display = "inline-grid";
            showMobileBackground();
        } else
        {
            closeEverything();
        }
    }
}

if (creatorsCard)
{
    function showCreatorsCard(id)
    {
        let creatorsCardList = document.querySelector("#creators_" + id + "_card");
        creatorsCardList.style.display = "inline-grid";
    }

    function hideCreatorsCard(id)
    {
        let creatorsCardList = document.querySelector("#creators_" + id + "_card");
        creatorsCardList.style.display = "none";
    }
}

if (playerCard)
{
    function showPlayerCard(id)
    {
        let playerCardList = document.querySelector("#player_" + id + "_card");
        playerCardList.style.display = "inline-grid";
    }

    function hidePlayerCard(id)
    {
        let playerCardList = document.querySelector("#player_" + id + "_card");
        playerCardList.style.display = "none";
    }

    function togglePlayerCard(id)
    {
        let playerCardList = document.querySelector("#player_" + id + "_card");
        if (playerCardList.style.display === "none")
        {
            closeCards();
            playerCardList.style.display = "inline-grid";
            showMobileBackground();
        } else
        {
            closeEverything();
            playerCardList.style.display = "none";
        }
    }
}

if (userCard)
{
    function showUserCard()
    {
        userCard.style.display = "inline-grid";
        clearTimeout(userCardTimer);
    }

    function hideUserCard()
    {
        userCardTimer = setTimeout('userCard.style.display = "none";', 200);
    }
}

if (waiterCard)
{
    function showWaiterCard(id)
    {
        let waiterCardList = document.querySelector("#waiter_" + id + "_card");
        waiterCardList.style.display = "inline-grid";
    }

    function hideWaiterCard(id)
    {
        let waiterCardList = document.querySelector("#waiter_" + id + "_card");
        waiterCardList.style.display = "none";
    }

    function toggleWaiterCard(id)
    {
        let waiterCardList = document.querySelector("#waiter_" + id + "_card");
        if (waiterCardList.style.display === "none")
        {
            closeCards();
            waiterCardList.style.display = "inline-grid";
            showMobileBackground();
        } else
        {
            closeEverything();
        }
    }
}
/****************************************************************************************************/


/*Fonctions pour afficher le menu*/
/****************************************************************************************************/
function showHeaderMenuParents()
{
    headerMenuParents.style.display = "flex";
}

function hideHeaderMenuParents()
{
    headerMenuParents.style.display = "none";
    headerMenuChildrenEvents.style.display = "none";
    headerMenuChildrenMore.style.display = "none";
    headerMenuChildrenProfile.style.display = "none";
}

function showHeaderMenuChildrenEvents()
{
    headerMenuChildrenEvents.style.display = "flex";
    headerMenuChildrenMore.style.display = "none";
    headerMenuChildrenProfile.style.display = "none";
}

function hideHeaderMenuChildrenEvents()
{
    headerMenuChildrenEvents.style.display = "none";
    headerMenuChildrenMore.style.display = "none";
    headerMenuChildrenProfile.style.display = "none";
}

function showHeaderMenuChildrenProfile()
{
    headerMenuChildrenEvents.style.display = "none";
    headerMenuChildrenMore.style.display = "none";
    headerMenuChildrenProfile.style.display = "flex";
}

function hideHeaderMenuChildrenProfile()
{
    headerMenuChildrenEvents.style.display = "none";
    headerMenuChildrenMore.style.display = "none";
    headerMenuChildrenProfile.style.display = "none";
}

function showHeaderMenuChildrenMore()
{
    headerMenuChildrenEvents.style.display = "none";
    headerMenuChildrenMore.style.display = "flex";
    headerMenuChildrenProfile.style.display = "none";
}

function hideHeaderMenuChildrenMore()
{
    headerMenuChildrenEvents.style.display = "none";
    headerMenuChildrenMore.style.display = "none";
    headerMenuChildrenProfile.style.display = "none";
}
/****************************************************************************************************/

function showFullText(x)
{
    x.lastChild.innerText = x.innerText;
}
function hideFullText(x)
{
    x.lastChild.innerText = "";
}
