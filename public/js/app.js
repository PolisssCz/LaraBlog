/*
* MY-POSTS
* copy address to share
*/
function copy() {
    var copyText = document.querySelector("#copy-link").value;
    navigator.clipboard.writeText(copyText);

    $('#share-profile').find("strong").on('click', function () {
        alertSymbol = $("#copy-success");

        if ( alertSymbol.is(':animated') ) return;

        alertSymbol.show().animate({
            opacity: "show",
        },{
            queue: false
        }).animate({
            opacity: "hide"
        }, {
            queue: false,
            duration: 1000
        });;
    });
}
;(function($, window, document, undefined){
/*
* ADD FORM
*/
$('#add-form').find('input[name=title]').focus();
/*
* DELETE FORM
*/
$('#delete-form').on('submit', function () 
{
    if( $('html')[0].lang  == 'cz' ){
        return confirm('Určitě?');
    }else{
        return confirm('For sure?');
    }
});
/*
* DISCUSSION
*/
var discussion = $('#discussion');
discussion.find('form').on('submit', function (event) {
    var form = $(this);
        errMess = $(document).find(".err");

    if ( errMess ){
        errMess.remove();
    }
    var req = $.ajax({
        url: form.attr('action'),
        type: "post",
        data: form.serialize(),
        dataType: 'json',
        error: function (err) {
            if (err.status == 422) { // when status code is 422, it's a validation issue
                // display errors on each form field
                $.each(err.responseJSON.errors, function (i, error) {
                    var el = $(document).find("textarea");
                    el.before($('<span class="arrow-up err">'+error[0]+'</span>'));
                });
            }
            if (err.status == 401) { //when status code is 401, there is a problem validating the rules
                // display errors
                var el = $(document).find("textarea");
                el.before($('<span class="arrow-up err">'+err.responseJSON.message+'</span>'));
            }
        }
    });
    // when the request passes validation, show comment
    req.done( function (data) { 
      $.ajax({
            url: 'comment/' + data.id,
            type: "get",
            success: function (html) { 
                var li = $(html).hide();
                discussion.find('.comments').append(li);
                li.fadeIn();
            }
        });
    });

    form.find('textarea').val('').focus();
    event.preventDefault();
});

/*
    * discussion *
    **************
    | EMOJI MENU |
    **************
*/
var emojiBtn = $(".emoji-btn");
emojiBtn.on('click', function () { 
    if ($(".emoji-btn.active").length == 0) {
        // opening the emoji menu
        emojiBtn.attr("src",''+ baseURL +'/img/app/a-emoji-icon-R.png')
                .addClass('active')
        $(".emoji-list").css('display', 'grid');
        $(".emoji-list").hide().fadeIn();
    } 
    else { 
        // close the emoji menu
        var emojiActive = $(".emoji-btn.active");
        emojiActive.attr("src",''+ baseURL +'/img/app/emoji-icon-R.png');
            
        $(".emoji-list").css('display', 'none');
        $(".emoji-list").show().fadeOut().queue(function(next){
            emojiActive.removeClass('active');
            next();
        });
    }
})  
// insert a smiley where the cursor is located
var emojiMenu = $('#discussion .emoji-list li');
emojiMenu.on('click', function() {
    var cursorPosition = $("#discussion textarea")[0].selectionStart;
    var FirstPart = $("#discussion textarea").val().substring(0, cursorPosition);
    var smile = $(this).text();
    var SecondPart = $("#discussion textarea").val().substring(cursorPosition, $("#discussion textarea").val().length);
    $("#discussion textarea").val(FirstPart+smile+SecondPart);
});


})(jQuery, window, document, undefined);