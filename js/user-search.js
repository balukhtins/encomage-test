jQuery(document).ready(function($) {

    $('#search').on ("submit", function (e) {
        e.stopPropagation();
        e.preventDefault();

        let data = new FormData(e.target);

        let aaa = $('.loaders');
        aaa.toggleClass('loaders-none');

        $.ajax({
            url         : 'users/search.php',
            type        : 'POST',
            data        : data,
            cache       : false,
            dataType    : 'json',
            processData : false,
            contentType : false,
             // функция успешного ответа сервера
            success     : function( respond, status, jqXHR ){
                // ОК
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

                /*for (let elem of td) {

                    if (obj[j]) {
                    for (let i = 0; i < 7; i++) {
                        console.log(elem.children[i]);
                        switch (elem.children[i].className) {
                            case 'id' :
                                //elem.html(` <th class="id" scope="row">${obj[j]['id']}</th>`);
                                break;

                            case 'first_name' :
                                //elem.html(`<td class="first_name">${obj[j]['first_name']}</td>`);
                                break;

                            case 'last_name' :
                                //elem.html(`<td class="first_name">${obj[j]['last_name']}</td>`);
                                break;

                            case 'email' :
                                //elem.html(`<td class="first_name">${obj[j]['email']}</td>`);
                                break;

                            case 'create_date' :
                                //elem.html(`<td class="first_name">${obj[j]['create_date']}</td>`);
                                break;

                            case 'update_date' :
                                //elem.html(`<td class="first_name">${obj[j]['update_date']}</td>`);
                                break;

                            case 'user_id' :
                                //elem.html(`<td class="user_id"><a class="edit" href="user_edit.php?id=${obj[j]['id']}">Edit</a></td>`);
                                break;
                        }

                    }
                    }
                    else{

                    }
                    j++;
                }*/
            },
            // функция ошибки ответа сервера
            error: function( jqXHR, status,){
                aaa.toggleClass('loaders-none');
                console.log(jqXHR['responseJSON']);
            }
        });
    });
});