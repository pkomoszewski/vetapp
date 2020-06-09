/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});

$(function () {
    $('#adresSelect').change(function () {

        var id = $(this).children(":selected").attr("id");

        $('.data').hide();
        $('#div' + id).show();

    }).trigger('change');
});


$(function () {
    $(".autocomplete").autocomplete({
        source: base_url + "/searchCities",
        minLength: 2,
        select: function (event, ui) {


        }


    });
});


var Ajax = {

    get: function (url, success, data = null, beforeSend = null) {

        $.ajax({

            cache: false,
            url: base_url + '/' + url,
            type: "GET",
            data: data,
            success: function (response) {

                App[success](response);

            },
            beforeSend: function () {

                if (beforeSend)
                    App[beforeSend]();

            }

        });
    },



    set: function (data = {}, url, success = null) {

        $.ajax({

            cache: false,
            url: base_url + '/' + url,
            type: "GET",
            dataType: "json",
            data: data,
            success: function (response) {

                if (success)
                    App[success](response);

            }

        });
    }


};







$(document).on("click", ".unread_notification", function (event) {

    event.preventDefault();

    $(this).removeClass('unread_notification');

    var ncount = parseInt($('#app-notifications-count').html());

    if (ncount > 0) {
        $('#app-notifications-count').html(ncount - 1);

        if (ncount == 1)
            $('#app-notifications-count').hide();
    }

    var idOfNotification = $(this).children().attr('href');
    $(this).children().removeAttr('href');
    App.SetReadNotification(idOfNotification);

});



$(function () {

    App.GetNotShownNotifications();

});


