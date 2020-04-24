"use strict";
var PostTable = function () {
    var initTablePosts = function () {
        var table = $('#posts');

        // begin first table
        table.DataTable({
            responsive: true,
            pagingType: 'full_numbers',
        });

    };

    return {

        //main function to initiate the module
        init: function () {
            initTablePosts();
        },

    };

}();

var CategoriesTable = function () {

    var initTableCategories = function () {
        var table = $('#categories');

        // begin first table
        table.DataTable({
            responsive: true,
            bSort: false,
            columnDefs: [
                {
                    targets: 0,
                    orderable: false
                }
            ]
        });

    };

    return {

        //main function to initiate the module
        init: function () {
            initTableCategories();
        },

    };

}();

let TreeView = function () {

    let category = function () {
        $('#category-list').jstree({
            "core": {
                "themes": {
                    "responsive": false,
                    "icons": false
                }
            },
            "plugins": ["types"]
        });
    };


    return {
        //main function to initiate the module
        init: function () {
            category();
        }
    };
}();

jQuery(document).ready(function () {
    PostTable.init();
    CategoriesTable.init();
    // TreeView.init();
});

function remove_unicode(str) {
    str = str.toLowerCase();
    str = str.replace(/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ/g, "a");
    str = str.replace(/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ/g, "e");
    str = str.replace(/ì|í|ị|ỉ|ĩ/g, "i");
    str = str.replace(/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ/g, "o");
    str = str.replace(/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ/g, "u");
    str = str.replace(/ỳ|ý|ỵ|ỷ|ỹ/g, "y");
    str = str.replace(/đ/g, "d");
    str = str.replace(/!|@|%|\^|\*|\(|\)|\+|\=|\<|\>|\?|\/|,|\.|\:|\;|\'| |\"|\&|\#|\[|\]|~|$|_/g, "-");
    str = str.replace(/-+-/g, "-"); //thay thế 2- thành 1-
    str = str.replace(/^\-+|\-+$/g, "");
    return str;
}

function slugGenerator() {
    let termName = $('form #term-name');
    let termSlug = $('form #term-slug');
    termName.blur(function () {
        let term = remove_unicode(termName.val());
        let slug = term.replace(/\ /g, "-");
        if (termSlug.val().length === 0) {
            $.ajax({
                url: '/admin/slug-generator/' + slug,
                type: 'get',
                dataType: 'json',
                success: function (response) {
                    termSlug.val(response);
                }
            });
        }
    });
}

function postNameGenerator() {
    let postName = $('form#post #post-name');
    let postTitle = $('form#post #post-title');
    postTitle.blur(function () {
        let title = remove_unicode(postTitle.val());
        let post_name = title.replace(/\ /g, "-");
        if (postName.val().length === 0) {
            $.ajax({
                url: '/admin/post-name-generator/' + post_name,
                type: 'get',
                dataType: 'json',
                success: function (response) {
                    postName.val(response);
                }
            });
        }
    });
}

function featured_image_select() {
    let attachment = $('li.attachment');
    let thumbnail = $('#thumbnail_id');
    let media_button_select = $('#media-button-select');
    let featured_image_modal = $('#featured-image-modal');
    let featured_image = $('.featured-image');
    attachment.click(function () {
        //reset status
        attachment.removeClass('selected');
        attachment.attr('aria-checked', 'false');

        $(this).addClass('selected');
        if (attachment.hasClass('selected')) {
            $(this).attr('aria-checked', 'true');
            media_button_select.removeAttr('disabled');
        } else {
            $(this).attr('aria-checked', 'false');
            media_button_select.attr('disabled', 'disabled');
        }
    });

    attachment.dblclick(function () {
        if ($(this).hasClass('selected')) {
            thumbnail.attr('value', $(this).attr('data-id'));
            featured_image.append('<img src="' + $(this).attr('data-src') + '" />');
            featured_image_modal.modal('hide');
        }
    });

    media_button_select.click(function () {
        attachment.each(function (index, value) {
            if ($(this).hasClass('selected')) {
                thumbnail.attr('value', $(this).attr('data-id'));
                featured_image.append('<img src="' + $(this).attr('data-src') + '" />');
                featured_image_modal.modal('hide');
            }
        });
    });
}

jQuery(function ($) {
    try {
        $(document).ready(function () {
            slugGenerator();
            postNameGenerator();
            featured_image_select();
        });
    } catch (e) {
        console.log(e);
    }
});
