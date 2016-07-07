/**
 * Created by Виктор on 07.07.2016.
 */
$(document).ready(function(){

    $('.crtbtn').click( function(e){
        e.preventDefault();
        //statements to validate the form
        var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        var email = document.getElementById('email');
        if (document.cform.email.value == "") {
            alert("Не заполнено поле \"Email\"");//$('.email-missing').show();
        }else if(!filter.test(email.value)) {
            alert("Не верно заполнено поле \"Email\"");
        }
        else {$('.email-missing').hide();}
        if (document.cform.name.value == "") {
            alert("Не заполнено поле \"Имя\"");//$('.name-missing').show();
        } else {$('.name-missing').hide();}
        if (document.cform.message.value == "") {
            alert("Не заполнено поле \"Текст сообщения\"");//$('.message-missing').show();
        } else {$('.message-missing').hide();}
        if ((document.cform.name.value == "") || (!filter.test(email.value)) || (document.cform.message.value == "")){
            return false;
        }

        if ((document.cform.name.value != "") && (filter.test(email.value)) && (document.cform.message.value != "")) {
            //hide the form
            var username = $.trim($('#name').val());
            var email = $.trim($('#email').val());
            var mess = $.trim($('#message').val());

            $.ajax({
                type: 'POST',
                url: 'http://guest-book/ajax/create_ajax',
                data: {username : username, email: email, message: mess},
                error: function(req, text, error) {
                    alert('Ошибка AJAX: ' + text + ' | ' + error);
                },
                success: function (html) {
                    $('#count_ent').text(parseInt($('#count_ent').text())+1);
                    $('#name').val("");
                    $('#email').val("");
                    $('#message').val("");
                    $(html).prependTo($(".media-list"));
                    ScrollUp();
                },
                dataType: 'text'
            });

            //stay on the page
            return false;
        }
    });
});
function ScrollUp(){
    var t,s;
    s=document.body.scrollTop||window.pageYOffset;
    t=setInterval(function(){if(s>0)window.scroll(0,s-=5);else clearInterval(t)},5);
}