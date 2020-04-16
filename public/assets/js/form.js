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

jQuery(document).ready(function () {
    PostTable.init();
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

jQuery(function ($) {
    try {
        $(document).ready(function () {
            autoSlug();
        });
    } catch (e) {
        console.log(e);
    }
});
