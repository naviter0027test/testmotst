$(document).ready(function() {
    $('.gantt').gantt({
        'source': "/member/project/task/all/gantt/json",
        'scale': "days",
        'maxScale': "months",
        'minScale': "days",
        'itemsPerPage': 25,
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
