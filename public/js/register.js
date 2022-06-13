// image preview

function display(input) {
    if (input.files && input.files[0]) {
       Array.from(input.files).forEach((element, index) => {
        var reader = new FileReader();
        reader.onload = function(event) {
            var img = $('<img />',
             { id: 'Myid' + index,
               src: event.target.result,
               width: "150px"
             });
              img.appendTo($('#prevImages'));
        }
        reader.readAsDataURL(input.files[index]);

       });
       }
    }

 $("#company_pic, #user_pic").change(function() {
    $("#prevImages").empty();
    display(this);
 });

