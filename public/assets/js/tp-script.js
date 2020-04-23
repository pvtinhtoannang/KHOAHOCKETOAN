/* end datatable in permission page.! **/
"use strict";
var KTDatatablesPermission = function () {
    var initTablePermission = function () {
        var table = $('#permission');
        table.DataTable({
            responsive: true,
            lengthMenu: [5, 10, 25, 50],
            pageLength: 10,
            language: {'lengthMenu': 'Hiển thị _MENU_',},
        });
    };
    return {
        init: function () {
            initTablePermission();
        },
    };
}();

// Class definition
var KTSelect2Permission = function() {
    // Private functions
    var permission = function() {
        // multi select
        $('.admin_settings_tp_permissions').select2({
            placeholder: "  __Chọn nhóm quyền truy cập - Bạn có thể chọn nhiều option",
        });
    }


    return {
        init: function () {
            permission();
        },
    };
}();

jQuery(document).ready(function () {
    KTDatatablesPermission.init();
    KTSelect2Permission.init();
});
