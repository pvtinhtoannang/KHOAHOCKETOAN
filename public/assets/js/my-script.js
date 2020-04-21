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

jQuery(document).ready(function () {
    PostTable.init();
    CategoriesTable.init();
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

let i_slug = 1;
let i_tag_slug = 1;

function checkSlug(slug) {
    let categorySlug = $('form#category #category-slug');
    let categoryName = $('form#category #category-name');
    let catName = remove_unicode(categoryName.val());
    let slugFirst = catName.replace(/\ /g, "-");
    $.ajax({
        url: 'check-slug/' + slug,
        type: 'get',
        dataType: 'json',
        success: function (response) {
            if (response === false) {
                categorySlug.val(slug);
            } else {
                checkSlug(slugFirst + "-" + (i_slug++));
            }
        }
    });
}

function autoSlug() {
    let categoryName = $('form#category #category-name');
    let categorySlug = $('form#category #category-slug');
    categoryName.blur(function () {
        let catName = remove_unicode(categoryName.val());
        let slug = catName.replace(/\ /g, "-");
        if (categorySlug.val().length === 0) {
            checkSlug(slug);
        }
    });
}

function checkSlugTag(slug) {
    let tagSlug = $('form#tag #tag-slug');
    let tagName = $('form#tag #tag-name');
    let name = remove_unicode(tagName.val());
    let slugFirst = name.replace(/\ /g, "-");
    $.ajax({
        url: 'check-slug/' + slug,
        type: 'get',
        dataType: 'json',
        success: function (response) {
            if (response === false) {
                tagSlug.val(slug);
            } else {
                checkSlugTag(slugFirst + "-" + (i_tag_slug++));
            }
        }
    });
}

function autoSlugTag() {
    let tagSlug = $('form#tag #tag-slug');
    let tagName = $('form#tag #tag-name');
    tagName.blur(function () {
        let name = remove_unicode(tagName.val());
        let slug = name.replace(/\ /g, "-");
        if (tagSlug.val().length === 0) {
            checkSlugTag(slug);
        }
    });
}

let i_post_name = 1;

function checkPostName(post_name) {
    let postName = $('form#post #post-name');
    let postTitle = $('form#post #post-title');
    let name = remove_unicode(postTitle.val());
    let postNameFirst = name.replace(/\ /g, "-");
    $.ajax({
        url: 'check-post-name/' + post_name,
        type: 'get',
        dataType: 'json',
        success: function (response) {
            if (response === false) {
                postName.val(post_name);
            } else {
                checkPostName(postNameFirst + "-" + (i_post_name++));
            }
        }
    });
}

function autoPostName() {
    let postName = $('form#post #post-name');
    let postTitle = $('form#post #post-title');
    postTitle.blur(function () {
        let title = remove_unicode(postTitle.val());
        let pname = title.replace(/\ /g, "-");
        if (postName.val().length === 0) {
            checkPostName(pname);
        }
    });
}

jQuery(function ($) {
    try {
        $(document).ready(function () {
            autoSlug();
            autoSlugTag();
            autoPostName();
        });
    } catch (e) {
        console.log(e);
    }
});
