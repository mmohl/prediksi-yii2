$(document).ready(function() {
    let parent = $('#teknik-parent');

    let kode = $('#teknik-kode');

    let check = $('#parent-check');

    if (parent.val()) {
        parent.attr('disabled', false);
        check.attr('checked', true);
    } else {
        parent.attr('disabled', true);
    }

    check.on('click', function() {
        if (this.checked) {
            parent.attr('disabled', false);

            kode.attr('readonly', true);

            kode.val("");
        } else {
            kode.attr('readonly', false);

            parent.attr('disabled', true);
            parent.val("");
        }
    });

});