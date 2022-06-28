//Preview d'avatar
function readURL(input)
{
    if (input.files && input.files[0])
    {
        let reader = new FileReader();
        reader.onload = function(e) {$('#avatar_image').attr('src', e.target.result);};
        reader.readAsDataURL(input.files[0]);
    }
}
$("#new_avatar_image").change(function() {readURL(this);});


//Calendrier
jQuery(function($)
{
    let currentDate = new Date();
    let current = currentDate.getMonth()+1;

    $(".month").hide();
    $("#month_"+current).show();
    $("#link_month_"+current).addClass("active");
    $(".months a").on("click", function()
    {
        let month = $(this).attr("id").replace("link_month_", "");
        if (month != current)
        {
            $("#month_"+current).slideUp();
            $("#month_"+month).slideDown();
            $(".months a").removeClass("active");
            $(".months a#link_month_"+month).addClass("active");
            current = month;
        }
    });
});


/*
$(document).on('mouseenter', '#test', function (args)
{
    alert(this.lastChild);
    this.lastChild.style.display = "inline-grid";
});*/
