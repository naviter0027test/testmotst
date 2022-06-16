$(document).ready(function() {
    $('.logout').on('click', function() {
        if(confirm('確定登出?') == false)
            return false;
    });
});
