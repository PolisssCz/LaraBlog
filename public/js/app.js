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
                    var el = $(document).find(".btn-primary");
                    el.after($('<span class="arrow-up err">'+error[0]+'</span>'));
                });
            }
            if (err.status == 401) { //when status code is 401, there is a problem validating the rules
                // display errors
                var el = $(document).find(".btn-primary");
                el.after($('<span class="arrow-up err">'+err.responseJSON.message+'</span>'));
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
