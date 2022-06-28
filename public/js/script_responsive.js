let headerButtonsDiv = document.querySelector("#header_buttons_mobile");

let headerMenuParentsDiv = document.querySelector("#header_menu_parents_mobile");
let headerMenuEvent = document.querySelector("#header_menu_children_events_mobile");
let headerMenuProfile = document.querySelector("#header_menu_children_profile_mobile");
let headerMenuMore = document.querySelector("#header_menu_children_more_mobile");
let mobileBackground = document.querySelector("#mobile_background");



let userCardMobile = document.querySelector("#user_card_mobile");

// mobileBackground.addEventListener("mouseup", closeEverything);

function toggleUserCard()
{
    if (userCardMobile.style.display === "none")
    {
        userCardMobile.style.display = "inline-grid";
    }
    else
    {
        userCardMobile.style.display = "none";
    }
}

function toggleHeaderButtonsDiv()
{
    let value = headerButtonsDiv.style.display;
    if (value === "none")
    {
        closeEventMenu();
        closeProfileMenu();
        closeMoreMenu();
        closeMenu();
        headerButtonsDiv.style.display = "flex";
        showMobileBackground();
    }
    else
    {
        closeHeaderButtons();
        closeMobileBackground();
    }
}


/*function toggleMenuChildrens(x)
{
    let parent = x.parentElement.parentElement;
    let children = parent.children[1];

    if (children.style.display === "none")
    {
        children.style.display = "flex";
    }
    else
    {
        children.style.display = "none";
    }
}*/


function toggleMenu()
{
    if (headerMenuParentsDiv.style.display === "none")
    {
        closeHeaderButtons();
        headerMenuParentsDiv.style.display = "flex";
        showMobileBackground();
    }
    else
    {
        closeMobileBackground();
        closeEventMenu();
        closeProfileMenu();
        closeMoreMenu();
        closeMenu();
    }
}

function toggleMenuEvents()
{
    if (headerMenuEvent.style.display === "none")
    {
        closeHeaderButtons();
        closeProfileMenu();
        closeMoreMenu();
        showMobileBackground();
        showMenu();
        showEventMenu();
    }
    else
    {
        closeHeaderButtons();
        closeProfileMenu();
        closeMoreMenu();
        showMobileBackground();
        showMenu();
        closeEventMenu();
    }
}

function toggleMenuProfile()
{
    if (headerMenuProfile.style.display === "none")
    {
        closeHeaderButtons();
        closeEventMenu();
        closeMoreMenu();
        showMobileBackground();
        showMenu();
        showProfileMenu();
    }
    else
    {
        closeHeaderButtons();
        closeEventMenu();
        closeMoreMenu();
        showMobileBackground();
        showMenu();
        closeProfileMenu();
    }
}

function toggleMenuMore()
{
    if (headerMenuMore.style.display === "none")
    {
        closeHeaderButtons();
        closeProfileMenu();
        closeEventMenu();
        showMobileBackground();
        showMenu();
        showMoreMenu();
    }
    else
    {
        closeHeaderButtons();
        closeEventMenu();
        closeProfileMenu();
        showMobileBackground();
        showMenu();
        closeMoreMenu();
    }
}

function showMenu()
{
    headerMenuParentsDiv.style.display = "flex";
}
function showEventMenu()
{
    headerMenuEvent.style.display = "flex";
}
function showProfileMenu()
{
    headerMenuProfile.style.display = "flex";
}
function showMoreMenu()
{
    headerMenuMore.style.display = "flex";
}
function showHeaderButtons()
{
    headerButtonsDiv.style.display = "flex";
}

function showMobileBackground()
{
    mobileBackground.style.display = "block";
}

function closeMenu()
{
    headerMenuParentsDiv.style.display = "none";
}
function closeEventMenu()
{
    headerMenuEvent.style.display = "none";
}
function closeProfileMenu()
{
    headerMenuProfile.style.display = "none";
}
function closeMoreMenu()
{
    headerMenuMore.style.display = "none";
}
function closeHeaderButtons()
{
    headerButtonsDiv.style.display = "none";
}
function closeMobileBackground()
{
    mobileBackground.style.display = "none";
}


function closeCards()
{
    if (userCard)
    {
        userCard.style.display = "none";
    }
    if (creatorCard)
    {
        creatorCard.style.display = "none";
    }
    if (playerCard)
    {
        playerCard.style.display = "none";
    }
    if (waiterCard)
    {
        waiterCard.style.display = "none";
    }
}

function closeEverything()
{
    console.debug(userCardMobile);
    if (userCardMobile != null && userCardMobile.style.display === "inline-grid")
    {
        userCardMobile.style.display = "none";
    }
    else
    {
        closeCards();
        closeMobileBackground();
        closeHeaderButtons();
        closeEventMenu();
        closeProfileMenu();
        closeMenu();
        closeMoreMenu();
    }
}
