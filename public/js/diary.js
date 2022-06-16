$.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

// Method for turning the poops brown
$(document).on('click', 'i', function () {    
        let poopClicked = $(this).attr('id');
        $('#poops').val(poopClicked);
        for (let i = poopClicked; i >= 0; i--){
            $('#' + i).addClass('brown');
        console.log('#' + poopClicked);
        }
});

//Reset the input fields and make the poops untouched again
$(document).ready(function(){
    $(".btn-close").click(function(){
        $("#diaryForm").trigger("reset");
        $("i").removeClass("brown");

    });
});


// AJAX POST REQUEST WHEN SUBMITTING
$('.form-green-border').submit(function(e) {
    e.preventDefault();
    let message_food = $('form').children().children('#message_food').val();
    let sleep_message = $('form').children().children('#sleep_message').val(); 
    let activity_message = $('form').children().children('#activity_message').val();
    


    let dataString = "message_food="+message_food+"activity_message="+activity_message;
    $.ajax({
        type:"POST",
        url: '/diary',
        data: dataString,
        success:function() {
        },
        error:function() {
        }
    });


  })
