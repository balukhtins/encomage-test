/*document.addEventListener('DOMContentLoaded', function (event) {

    // Поиск товаров
    async function searchProduct() {
        let search = document.querySelector('input[name="s"]').value;
        let response = await fetch(`../product/search.php?s=${search}`);
        let text = await response.json();
        if(response.ok){
            console.log(text);
            let content = document.querySelector('.content');
            if(document.querySelector('.request')) {
                for(el of document.querySelectorAll('.request')){
                    el.remove();
                }
                for(el of document.querySelectorAll('br')){
                    el.remove();
                }
            }
            content.insertAdjacentHTML('beforeend',
                `<p class="request">Результат поиска:</p><br>`);
            let p = document.createElement('p');
            for (el of text){
                a = document.createElement('a');
                a.setAttribute('href', `product/read_one.php?id=${el.id}`);
                a.classList.add('product');
                p = document.createElement('p');
                p.innerHTML = `${el.brand_name} ${el.name} <br> цена: ${el.price} <br>`;
                p.classList.add('request');
                p.setAttribute('product-id', el.product_id);
                a.append(p);
                content.append(a);
            }
            for(let el of document.querySelectorAll('a')) el.addEventListener('click',
                (e) => {
                    e.preventDefault();
                    console.log(e.path[1].href);
                    readOne(e.path[1].href);
                });
       }
        else console.log('err: ' + response.starus);
    }

    // Вывод всех продуктов
    async function getProduct(url) {
        let response = await fetch(url);
        let text = await response.json();
        if(response.ok){
            console.log(text);
            let content = document.querySelector('.content');
            if(document.querySelector('.request')) {
                for(el of document.querySelectorAll('.request')){
                    el.remove();
                }
                for(el of document.querySelectorAll('br')){
                    el.remove();
                }
            }
            let p;
            let a;
            for (el of text){
                a = document.createElement('a');
                a.setAttribute('href', `product/read_one.php?id=${el.product_id}`);
                a.classList.add('product');
                p = document.createElement('p');
                p.innerHTML = `${el.brand_name} ${el.name} <br> цена: ${el.price} <br>`;
                if(el.sale) p.innerHTML += `скидка: ${el.sale}% <br>`;
                if(el.top) p.innerHTML += `ХИТ ПРОДАЖ <br>`;
                p.classList.add('request');
                p.setAttribute('product-id', el.product_id);
                a.append(p);
                content.append(a);
            }
            for(let el of document.querySelectorAll('a')) el.addEventListener('click',
                (e) => {
                    e.preventDefault();
                    console.log(e.path[1].href);
                    readOne(e.path[1].href);
                });
        }
        else console.log('err: ' + response.starus);
    }

    // Вывод всех категорий
    async function getCategories() {
        let response = await fetch(`../category/read.php`);
        let text = await response.json();
        if(response.ok){
            console.log(text);
            let content = document.querySelector('.content');
            if(document.querySelector('.request')) {
                for(el of document.querySelectorAll('.request')){
                    el.remove();
                }
                for(el of document.querySelectorAll('br')){
                    el.remove();
                }
            }
            let p;
            let a;
            for (el of text){
                a = document.createElement('a');
                a.setAttribute('href', `category/select.php?category_id=${el.category_id}`);
                a.classList.add('category');
                p = document.createElement('p');
                p.innerHTML = `${el.name} <br><br>`;
                p.classList.add('request');
                a.append(p);
                content.append(a);
            }
            for(let el of document.querySelectorAll('a')) el.addEventListener('click',
                (e) => {
                e.preventDefault();
                getProduct(e.path[1].href);
            });
         }
        else console.log('err: ' + response.starus);
    }

     async function readOne(url){
         let response = await fetch(url);
         let text = await response.json();
         if(response.ok){
             console.log(text);
             let content = document.querySelector('.content');
             if(document.querySelector('.request')) {
                 for(el of document.querySelectorAll('.request')){
                     el.remove();
                 }
                 for(el of document.querySelectorAll('br')){
                     el.remove();
                 }
             }
             let p;
             let a;
             let color = '';
             for (el of text){
                 p = document.createElement('p');
                 for(col of el.color){
                     color += ` ${col}  `
                 }
                 p.innerHTML = `Бренд: ${el.brand_name} <br> Название: ${el.name} <br> Характеристики: ${el.description} <br> Цвет: ${color} <br> Цена: ${el.price} <br> Количество: ${el.quantity} <br>`;
                 if(el.sale) p.innerHTML += `скидка: ${el.sale}% <br>`;
                 if(el.top) p.innerHTML += `ХИТ ПРОДАЖ <br>`;
                 p.classList.add('request');
                 content.append(p);
             }
         }
         else console.log('err: ' + response.starus);
     }

     /!*function userAdd() {
        let userData = jQuery('#user-add').serialize();
         jQuery.ajax({
            type: 'POST',
            url: './users/add.php',
            data: userData,
            success: function(dataResp) {
                console.log(dataResp);
            }
        });
    }*!/

    document.querySelector('.search').addEventListener('click', searchProduct);
    document.querySelector('.button_product').addEventListener('click',() => getProduct(`../product/read.php`));
    document.querySelector('.button_category').addEventListener('click', getCategories);

});*/

jQuery(document).ready(function($) {

    $('#user-edit').on ("submit", function (e) {
        e.stopPropagation();
        e.preventDefault();

        let aaa = $('.loaders');
        aaa.toggleClass('loaders-none');

        let data = new FormData(e.target);

        $.ajax({
            url         : 'users/edit.php',
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
                    $('.alert').addClass('alert-info').text(respond);
            },
            // функция ошибки ответа сервера
            error: function( jqXHR, status,){
                aaa.toggleClass('loaders-none');
                $('.alert').addClass('alert-danger').text(jqXHR['responseJSON']);
                //console.log(jqXHR['responseJSON']);
            }
        });
    });
});