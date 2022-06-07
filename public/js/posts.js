// Method for opening and closing comments for each post dynamically
$(document).on('click', '.commentbutton', function (e) {
    $('#' + e.target.id + '.comment').toggleClass('hidden');
});


// textarea autogrow and post by pressing enter

// function autogrow(el) {
//     el.style.height = el.scrollHeight + 'px';
//   }

// function triggerFunction(e, el) {
//     if(e.key === 'Enter') {
//       this.onAddComment(this.commentText)
//       this.commentText = ""; // the clear the input
//     } else {
//       this.autogrow(el) // by typing something autogrow will calculate the height of our textarea to make all text fit
//     }
//   }

  $(document).on('keydown', '.commentinput', function(e) {
      console.log($(this).get());
      if(e.key == 'Enter') {
          console.log("you pressed enter");
      } else {
          $(this)[0].style.height = $(this)[0].scrollHeight + 'px';
      }
  })