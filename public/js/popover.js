$(function () {
    $('[data-toggle="popover"]').popover();
})

$("#new-tender-p").popover({
    html: true,
    content:  function() {
        return $('#new-tender-label').html();
    }
})

$("#new-customer-p").popover({
    html: true,
    content:  function() {
        return $('#new-customer-label').html();
    }
})

$("#add-customers-p").popover({
    html: true,
    content:  function() {
        return $('#add-customers-label').html();
    }
})
