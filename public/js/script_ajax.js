
//Ajax sur zoom d'évènement (inscription ou retrait à un event)
/*
$("#inscription_to_event_button").click(function(event)
{

    event.preventDefault();
    let button = document.querySelector("#inscription_to_event_button");

    let action = button.getAttribute("href");

    let actionArray = action.split("/");

    let arrayLength = actionArray.length;


    $.ajax({url : action}).done(function()
    {
        let url = new URL(window.location.protocol+"//"+window.location.host+"'.ROOT.'/partynow/Event/zoom/" + actionArray[arrayLength-2]);
        console.log(url);

        $("#div_event_players_list").load(url.href +" #event_players_list");
        $("#div_players_number").load(url.href +" #players_number");
    });
});
*/

/*$("#remove_from_event_button").click(function(event)
{
    event.preventDefault();
    let button = document.querySelector("#remove_from_event_button");

    let action = button.getAttribute("href");

    let actionArray = action.split("/");

    let arrayLength = actionArray.length;


    $.ajax({url : action}).done(function()
    {
        let url = new URL(window.location.protocol+"//"+window.location.host+"'.ROOT.'/partynow/Event/zoom/" + actionArray[arrayLength-2]);

        $("#div_event_players_list").load(url.href +" #event_players_list");
        $("#div_players_number").load(url.href +" #players_number");
    });
});*/

/*
function readURL(input)
{
    if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function (e) {
        $('#blah')
            .attr('src', e.target.result)
            .width(150)
            .height(200);
    };
    reader.readAsDataURL(input.files[0]);
}}
*/

/*$("#new_avatar_image").change(function(event)
{
    event.preventDefault();

    let input = document.querySelector("#new_avatar_image");

    let newImage = input.files[0];

    let action = "'.ROOT.'/partynow/User/previewUserAvatar/87/";*/


//    let formData = new FormData();

//    formData.append("new_avatar_image", newImage);



    /*console.log(formData);
    $.ajax({url : action, method : "post", data : formData, enctype : "multipart/form-data"}).done(function()
    {
        let previewImageUrl = new URL(window.location.protocol + "//" + window.location.host + "'.WEBROOT.'public/images/users_avatars_previews/87.Yep.jpg");

        // console.log(previewImageUrl);

        $("#div_avatar_image").html('<img class="user_avatar_image" id="avatar_image" src="'+previewImageUrl.pathname+'">');
    });
});*/


/*
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('.preview')
                .attr('src', e.target.result)
                .height(100)
        };
        reader.readAsDataURL(input.files[0]);
    }
}
*/

/*
    function preview_image(event)
    {
        let reader = new FileReader();
        reader.onload = function()
        {
            var output = document.getElementById('output_image');
            output.src = reader.result;
        }
        reader.readAsDataURL(event.target.files[0]);
    }
*/
