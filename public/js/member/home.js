$(document).ready(function() {
    $('.gantt').gantt({
        'source': "/member/project/example",
        'scale': "weeks",
        'minScale': "months",
        'onItemClick': function(data) {
            console.log(data);
        },
        'onAddClick': function(dt, rowId) {
            console.log(dt);
            console.log(rowId);
        },
        'onRender': function() {
            console.log("chart rendered");
        }
    });
});
