"use strict";
var PostTable = function() {

    var initTablePosts = function() {
        var table = $('#posts');

        // begin first table
        table.DataTable({
            responsive: true,
            pagingType: 'full_numbers',
        });

    };

    return {

        //main function to initiate the module
        init: function() {
            initTablePosts();
        },

    };

}();

jQuery(document).ready(function() {
    PostTable.init();
});
