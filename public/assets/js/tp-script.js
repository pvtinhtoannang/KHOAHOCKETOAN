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
var KTSelect2Permission = function () {
    // Private functions
    var permission = function () {
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

var KTFormPermissionUpdateForRole = function () {

    var updateForRole = function () {
        var role = $('#update_permission_for_role #role').val();
        // console.log($('#admin_settings_tp_permissions').find('optgroup option').attr('value'));
        if(role != null){
            $.ajax({
                url: "/admin/ajax-permission-by-role/" + role,
                method: "GET"
            }).done(function (data) {
                // var dataJson = JSON.stringify(data);
                $('#admin_settings_tp_permissions optgroup').each(function (i) {
                    $(this).find('option').each(function (i) {
                        var option_value = $(this).val();
                        var option_ele = $(this);
                        console.log(option_value);
                        $.each(data, function (key, value) {
                            if (parseInt(option_value) === parseInt(value.id)) {
                                option_ele.attr('selected', 'selected');
                                console.log(option_ele);
                            }
                        });
                    });
                });
                $("#admin_settings_tp_permissions").select2("destroy");
                $("#admin_settings_tp_permissions").select2();
            });
        }
    }

    var getPermisionForRole = function () {
        $('#update_permission_for_role #role').click(function () {
            var role = $(this).val();
            console.log(role);

            // console.log($('#admin_settings_tp_permissions').find('optgroup option').attr('value'));

            $.ajax({
                url: "/admin/ajax-permission-by-role/" + role,
                method: "GET"
            }).done(function (data) {
                // var dataJson = JSON.stringify(data);
                $('#admin_settings_tp_permissions optgroup').each(function (i) {
                    $(this).find('option').each(function (i) {
                        var option_value = $(this).val();
                        var option_ele = $(this);
                        $.each(data, function (key, value) {
                            if (parseInt(option_value) == parseInt(value.id)) {
                                option_ele.attr('selected', 'selected');
                            } else {
                                option_ele.removeAttr('selected');
                            }
                        });
                    });
                });
                $("#admin_settings_tp_permissions").select2("destroy");
                $("#admin_settings_tp_permissions").select2();
            });
        });
    }

    return {
        init: function () {
            updateForRole();
            getPermisionForRole();
        }
    };
}();


jQuery(document).ready(function () {
    KTDatatablesPermission.init();
    KTSelect2Permission.init();
    KTFormPermissionUpdateForRole.init();
});


