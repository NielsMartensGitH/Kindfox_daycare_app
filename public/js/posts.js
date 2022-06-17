$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});

// Method for opening and closing comments for each post dynamically
$(document).on('click', '.commentbutton', function (e) {
    $('#' + e.target.id + '.comment').toggleClass('hidden');
});

// AUTOGROW TEXTAREA AND COMMENT SUBMIT BY PRESSING ENTER

  $(document).on('keydown', '.commentinput', function(e) {
      if (e.key == 'Enter') { // submit form when pressing enter
        let form_id = e.target.parentElement.parentElement.id; // the form id where we submit
        $('form#' + form_id).submit(); // execute submit event
        e.preventDefault();
      } else {
          $(this)[0].style.height = $(this)[0].scrollHeight + 'px';
      }
  })

  // AJAX POST REQUEST WHEN SUBMITTING
  $('.comments').submit(function(e) {
    e.preventDefault();
    post_id = e.target.id; // id of form where we submit (in the foreach loop)
    post_id_num = post_id.slice(8); // GET NUMBERS
    let message = null;
    let commentPost_id = null;
    let name = null;
    let id = null;
    let profile_pic = null;
    let go_url = null;

    if(document.URL == "http://localhost:8000/messageboard"){
      //console.log('we are at the mainuserpage')
      message = $('form#' + post_id).children().children('#message').val(); // value of input with id #message
      commentPost_id = $('form#' + post_id).children().children('#commentPost_id').val(); // value of input with id #commentPost_id
      //let profile_pic = ($('img#profile_img_navbar')[0].src);
      name = $('form#' + post_id).children().children('#company_name').val();
      id = $('form#' + post_id).children().children('#main_user_id').val();
      go_url = '/mainusercomment';
    }
    else{    
      
      message = $('form#' + post_id).children().children('#message').val(); // value of input with id #message
      id = $('form#' + post_id).children().children('#company_id').val(); // value of input with id #company_id
      commentPost_id = $('form#' + post_id).children().children('#commentPost_id').val(); // value of input with id #commentPost_id
      name = $('form#' + post_id).children().children('#company_name').val();

      profile_pic = ($('img#profile_img_sidebar')[0].src);
      go_url = '/comment';

    }
    //THE COMMENT HTML
    let comment = `
    <div class="card-body comment-body">
    <div class="row">
      <div class="col-auto mx-3 my-1 avatarbox">

        <!-- if the commment has a parent_id we want to show the avatar of that parent -->
        <img src="${ profile_pic }" width="50px" class="mx-2 circular--landscape">

        <!-- else we show the avatar of the daycare -->
      </div>

      <div class="col-auto message">
        <div class="card-text px-3 py-2 my-1 comment-text">
          <div class="d-flex justify-content-between">
          <div class="commenthead">

            <!-- if the comment has a daycare_id we want to show the name of that daycare -->
              <h6>${ name }</h6>
            <!-- time since comment has been written below the name -->
            <small> Just now </small>

          </div>
          <div class="dropdown">
            <i class="fas fa-ellipsis-h" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false"></i>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
              <li><a class="dropdown-item">Delete</a></li>
              <!-- we don't want the daycares to edit parent message, only delete them -->
              <li><a class="dropdown-item">Edit</a></li>
            </ul>
          </div>
        </div>

        <!-- we don't want to show the comment when in editing mode for that comment -->
        <p> ${message} </p>
          <!-- instead when we are in editing mode this will be a textarea with the original comment in it which is now editable -->

        </div>
      </div>
    </div>`

    $('.comment'+post_id_num).append(comment); // APPEND THIS COMMENT TO THE POST
    //THIS IS SEND TO THE CONTROLLER TO SEND TO DB
    let dataString = "message="+message+"&company_id="+id+"&commentPost_id="+commentPost_id;
    //console.log(dataString);
    //console.log(go_url);
    $.ajax({
        type:"POST",
        url: go_url,
        data: dataString,
        success:function(comment_id) {
        },
        error:function() {
        }
    });
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
    if ($('#' + e.target.id + '.privacy').val() == "1") {
        $('#' + e.target.id + '.child_input').show();
    } else {
        $('#' + e.target.id + '.child_input').hide();
    }
});

// image preview

function display(input) {
    if (input.files && input.files[0]) {
       Array.from(input.files).forEach((element, index) => {
        var reader = new FileReader();
        reader.onload = function(event) {
            var img = $('<img />',
             { id: 'Myid' + index,
               src: event.target.result,
               width: "35px"
             });
              img.appendTo($('#prevImages'));
        }
        reader.readAsDataURL(input.files[index]);

       });
       }
    }

 $("#images").change(function() {
    $("#prevImages").empty();
    display(this);
 });

 $("#client_pic").change(function() {
  $("#prevImages").empty();
  display(this);
});

// INITIALIZING DATATables

$(document).ready( function () {
  $('#table_id').DataTable();
} );