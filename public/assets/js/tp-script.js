/*
* end datatable in permission page.!
* **/
"use strict";
var KTDatatablesPermission = function() {

    var initTablePermission = function() {
        var table = $('#permission');

        // begin first table
        table.DataTable({
            responsive: true,

            lengthMenu: [5, 10, 25, 50],

            pageLength: 10,

            language: {
                'lengthMenu': 'Hiển thị _MENU_',
            },

        });


    };

    return {

        //main function to initiate the module
        init: function() {
            initTablePermission();
        },

    };

}();

jQuery(document).ready(function() {
    KTDatatablesPermission.init();
});
