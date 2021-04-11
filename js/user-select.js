jQuery(document).ready(function($) {

    $('.table-warning th').on ("click", function (e) {
        e.stopPropagation();
        e.preventDefault();

        let name = $(this).attr('name');
        let desc = $(this).attr('desc');
        let icon = $(this).attr('icon');
        let data = {'field':name, 'desc':desc};

        if (desc == 'DESC'){
            $(this).attr('desc','ASC');
        }
        else $(this).attr('desc','DESC');

        let aaa = $('.loaders');
        aaa.toggleClass('loaders-none');

        $.ajax({
            url         : 'users/select.php',
            type        : 'POST',
            data        : data,
            cache       : false,
            dataType    : 'json',
             // функция успешного ответа сервера
            success     : function( respond, status, jqXHR ){
                // ОК
                    aaa.toggleClass('loaders-none');
                    let td = $('.table .tb-body');
                    let obj = respond;
                    let j = 0;
                    for (let elem of td){
                        for (let i = 0; i < elem.children['length']; i++) {
                            if (elem.children[i].className == 'user_id'){
                                elem.children[i].innerHTML = `<a class="edit" href="user_edit.php?id=${obj[j]['id']}">Edit</a>`
                            }
                            else {
                                elem.children[i].innerHTML = obj[j][elem.children[i].className];
                            }
                        }
                        j++;
                    }
            },
            // функция ошибки ответа сервера
            error: function( jqXHR, status,){
                aaa.toggleClass('loaders-none');
                setTimeout(() => alert( jqXHR['responseJSON']),300);
            }
        });
    });
});