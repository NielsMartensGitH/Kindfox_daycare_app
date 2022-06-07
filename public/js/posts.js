// Method for opening and closing comments for each post dynamically
$(document).on('click', '.commentbutton', function (e) {
    $('#' + e.target.id + '.comment').toggleClass('hidden');
});

// AUTOGROW TEXTAREA

  $(document).on('keydown', '.commentinput', function(e) {
      console.log($(this).get());
      if (e.key == 'Enter') {
          console.log("you pressed enter");
      } else {
          $(this)[0].style.height = $(this)[0].scrollHeight + 'px';
      }
  })

  // SHOW/HIDE SELECT ELEMENT 'CHOOSE CHILD'

$('.child_input').hide();

  $('.privacy').change(function() {
    if ($(this).val() == "1") {
        $('.child_input').show();
    } else {
        $('.child_input').hide();
    }
  });


  $(document).on('click', '.edit_modal', function (e) {
      console.log($('#' + e.target.id + '.privacy').val())
    if ($('#' + e.target.id + '.privacy').val() == "1") {
        $('#' + e.target.id + '.child_input').show();
    } else {
        $('#' + e.target.id + '.child_input').hide();
    }
});