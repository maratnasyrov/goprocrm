$(function () {
    $('[data-toggle="popover"]').popover();
})

$("#new-tender-p").popover({
    html: true,
    content:  function() {
        return $('#new-tender-label').html();
    }
})
