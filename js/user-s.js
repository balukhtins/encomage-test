jQuery(document).ready(function($) {

    $('.table-warning th').on ("click", function (e) {
        e.stopPropagation();
        e.preventDefault();

        let name = $(this).attr('name');
        let desc = $(this).attr('desc');




        let id;
        if (Boolean($('input[name="id"]').val())) {
            id = $('input[name="id"]').val();
        }

        let first_name;
        if (Boolean($('input[name="first_name"]').val())) {
            first_name = $('input[name="first_name"]').val();
        }

        let last_name;
        if (Boolean($('input[name="last_name"]').val())) {
            last_name = $('input[name="last_name"]').val();
        }

        let email;
        if (Boolean($('input[name="email"]').val())) {
            email = $('input[name="email"]').val();
        }

        let create_date;
        if (Boolean($('input[name="create_date"]').val())) {
            create_date = $('input[name="create_date"]').val();
        }

        let update_date;
        if (Boolean($('input[name="update_date"]').val())) {
            update_date = $('input[name="update_date"]').val();
        }

        //console.log(id);






        let icon = $(this).attr('icon');
        let data = {
            'field':name,
            'desc':desc,
            'id':id,
            'first_name':first_name,
            'last_name':last_name,
            'email':email,
            'create_date':create_date,
            'update_date':update_date
        };

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
                    /*aaa.toggleClass('loaders-none');
                    let td = $('.table .tb-body');
                    let obj = respond;
                    let j = 0;
                    console.log(respond);*/
                    /*for (let elem of td){
                        for (let i = 0; i < elem.children['length']; i++) {
                            if (elem.children[i].className == 'user_id'){
                                elem.children[i].innerHTML = `<a class="edit" href="user_edit.php?id=${obj[j]['id']}">Edit</a>`
                            }
                            else {
                                elem.children[i].innerHTML = obj[j][elem.children[i].className];
                            }
                        }
                        j++;
                    }*/




                aaa.toggleClass('loaders-none');
                let td = $('.table .tb-body').remove();
                let obj = respond;
                let j = 0;

                for (let elem of obj){
                    console.log(elem);
                    let ff = $('tbody').append(
                        '<tr class="tb-body">' +
                        `<th class="id" scope="row">${elem["id"]}</th>` +
                        `<td class="first_name">${elem["first_name"]}</td>` +
                        `<td class="last_name">${elem["last_name"]}</td>` +
                        `<td class="email">${elem["email"]}</td>` +
                        `<td class="create_date">${elem["create_date"]}</td>` +
                        `<td class="update_date">${elem["update_date"]}</td>` +
                        `<td class="user_id"><a class="edit" href="user_edit.php?id=${elem["id"]}">Edit</a></td>
                    </tr>`);
                }



            },
            // функция ошибки ответа сервера
            error: function( jqXHR, status,){
                aaa.toggleClass('loaders-none');
                //setTimeout(() => alert( jqXHR['responseJSON']),300);
            }
        });
    });

    /*$('.table-warning th').on ("click", function (e) {
        e.stopPropagation();
        e.preventDefault();

        let name = $(this).attr('name');
        let tr = $('tbody tr');
        console.log(tr);
    });*/
});