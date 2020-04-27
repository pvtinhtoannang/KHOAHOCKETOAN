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
        if (role != null) {
            $.ajax({
                url: "/admin/ajax-permission-by-role/" + role,
                method: "GET"
            }).done(function (data) {
                $.each(data, function (key, value) {
                    $('#admin_settings_tp_permissions optgroup option').each(function (i) {
                        var option_value = parseInt($(this).val());
                        var option_ele = $(this);
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
        $('#update_permission_for_role #role').change(function () {
            var role = $('#update_permission_for_role #role').val();
            $('#admin_settings_tp_permissions optgroup option').each(function (i) {
                $(this).removeAttr('selected');
            });
            $.ajax({
                url: "/admin/ajax-permission-by-role/" + role,
                method: "GET"
            }).done(function (data) {
                $.each(data, function (key, value) {
                    $('#admin_settings_tp_permissions optgroup option').each(function (i) {
                        var option_value = parseInt($(this).val());
                        var option_ele = $(this);
                        if (option_value === value.id) {
                            option_ele.attr('selected', 'selected');
                        }
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
        $('.kt_sweetalert_delete_permission').click(function (e) {
            swal.fire({
                title: "Xoá quyền truy cập!",
                text: "Bạn nên chỉnh sửa một quyền truy cập nào đó thay vì xoá nó đi, khi xoá có thể làm ảnh hưởng đến một số chức năng nhất định!",
                type: "success",
                confirmButtonText: "Xác nhận!",
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
                    $('#kt_modal_update_permission_settings #update_id').val(data.id);
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
            deletePermission();
            updatePermission();
        }
    }
}();


var PvtinhPermissionForUser = function () {
    var tb_tab3_user = function () {
        // multi select
        $('#tb_tab3_user').select2({
            placeholder: "Chọn người dùng",
        });
    }

    var getTabPermissionByUserID = function () {
        var user_id = $('#tb_tab3_user').val();
        if (user_id != null) {
            $('#admin_add_user_permission optgroup option').each(function (i) {
                $(this).removeAttr('selected');
            });
            $.ajax({
                url: "/admin/ajax-update-permission-by-user/" + user_id,
                method: "GET"
            }).done(function (data) {
                $.each(data, function (key, value) {
                    $('#admin_add_user_permission optgroup option').each(function (i) {
                        var option_value = parseInt($(this).val());
                        var option_ele = $(this);
                        if (option_value === value.id) {
                            option_ele.attr('selected', 'selected');
                        }
                    });
                });
                $("#admin_add_user_permission").select2("destroy");
                $("#admin_add_user_permission").select2();
            });
            $.ajax({
                url: "/admin/ajax-permission-by-user/" + user_id,
                method: "GET"
            }).done(function (data) {
                $.each(data, function (key, value) {
                    $('#admin_add_user_permission optgroup option').each(function (i) {
                        var option_value = parseInt($(this).val());
                        var option_ele = $(this);
                        if (option_value === value.id) {
                            option_ele.attr('selected', 'selected');
                        }
                    });
                });
                $("#admin_add_user_permission").select2("destroy");
                $("#admin_add_user_permission").select2();
            });


        }
    }

    var getPermissionByUserIDAfterChangeUser = function () {
        $('#tb_tab3_user').change(function () {
            var user_id = $(this).val();
            $('#admin_add_user_permission optgroup option').each(function (i) {
                $(this).removeAttr('selected');
            });

            $.ajax({
                url: "/admin/ajax-permission-by-user/" + user_id,
                method: "GET"
            }).done(function (data) {
                $.each(data, function (key, value) {
                    $('#admin_add_user_permission optgroup option').each(function (i) {
                        var option_value = parseInt($(this).val());
                        var option_ele = $(this);
                        if (option_value === value.id) {
                            option_ele.attr('selected', 'selected');
                        }
                    });
                });
                $("#admin_add_user_permission").select2("destroy");
                $("#admin_add_user_permission").select2();
            });
        });
    }
    return {
        init: function () {
            tb_tab3_user();
            getTabPermissionByUserID();
            getPermissionByUserIDAfterChangeUser();
        }
    }
}();

jQuery(document).ready(function () {
    KTDatatablesPermission.init();
    KTSelect2Permission.init();
    KTFormPermissionUpdateForRole.init();
    PvtinhPermissionModal.init();
    PvtinhPermissionForUser.init();
});


