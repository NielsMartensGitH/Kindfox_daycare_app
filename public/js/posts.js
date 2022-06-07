$(document).on('click', '.commentbutton', function (e) {
    $('#' + e.target.id + '.comment').toggleClass('hidden');
});