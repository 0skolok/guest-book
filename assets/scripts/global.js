/**
 * Created by Виктор on 06.07.2016.
// */
$(document).ready(function() {

    $(".delbtn").click(function (e) {
        e.preventDefault();
        var clickedID = this.id.split("-"); //Разбиваем строку (Split работает аналогично PHP explode)
        var DbNumberID = clickedID[1]; //и получаем номер из массива
        var myData = 'recordToDelete='+ DbNumberID; //выстраиваем  данные для POST

        jQuery.ajax({
            type: "POST", // HTTP метод  POST или GET
            url: "http://guest-book:81/ajax/delete_ajax", //url-адрес, по которому будет отправлен запрос
            dataType: "text", // Тип данных
            data:myData, //post переменные
            success:function(response){
                // в случае успеха, скрываем, выбранный пользователем для удаления, элемент
                $('#med_'+DbNumberID).fadeOut("slow");
                $('#count_ent').text(parseInt($('#count_ent').text())-1);
            },
            error:function (xhr, ajaxOptions, thrownError){
                //выводим ошибку
                alert(thrownError);
            }
        });
    });
});
