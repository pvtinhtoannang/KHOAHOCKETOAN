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
        if (role != null) {
            $.ajax({
                url: "/admin/ajax-permission-by-role/" + role,
                method: "GET"
            }).done(function (data) {
                $('#admin_settings_tp_permissions optgroup option').each(function (i) {
                    var option_value = parseInt($(this).val());
                    var option_ele = $(this);
                    $.each(data, function (key, value) {
                        if (option_value === value.id) {
                            option_ele.attr('selected', 'selected');
                        }
                    });
                });
                $("#admin_settings_tp_permissions").select2("destroy");
                $("#admin_settings_tp_permissions").select2();
            });
        }
    }

    var getPermisionForRole = function () {
        $('#update_permission_for_role #role, #update_permission_for_role .reset-permission').click(function () {
            var role = $('#update_permission_for_role #role').val();
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


var PvtinhPermissionModal = function () {
    var deletePermission = function () {
        $('#kt_sweetalert_delete_permission').click(function(e) {
            swal.fire({
                title: "Good job!",
                text: "You clicked the button!",
                type: "success",
                confirmButtonText: "Confirm me!",
                confirmButtonClass: "btn btn-focus--pill--air"
            });
        });
    }

    var updatePermission = function () {
        $('.btn-edit-permission').click(function () {
            var permission = parseInt($(this).attr('data-id'));
            if (permission != null) {
                $.ajax({
                    url: "/admin/ajax-permission-by-id/" + permission,
                    method: "GET"
                }).done(function (data) {
                    $('#kt_modal_update_permission_settings #update_name').val(data.name);
                    $('#kt_modal_update_permission_settings #update_display_name').val(data.display_name);
                    $('#kt_modal_update_permission_settings #update_group_id option').each(function (i) {
                        var option_value = parseInt($(this).val());
                        var option_ele = $(this);
                        option_ele.removeAttr('selected');
                        if (option_value === data.group_id) {
                            option_ele.attr('selected', 'selected');
                        }
                    });
                });
            }
        });
    }
    return {
        init: function () {
            updatePermission();
        }
    }
}();

jQuery(document).ready(function () {
    KTDatatablesPermission.init();
    KTSelect2Permission.init();
    KTFormPermissionUpdateForRole.init();
    PvtinhPermissionModal.init();
});


