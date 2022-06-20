$(document).on('click', 'img.client-img', function () {
   
});


//Method to check the checked_in status of each child and style the border green if checked in
$( document ).ready(function() {
    $status = $('#getCheckedInStatus').val();
   if($status == 1) {
    $('img.client-img').addClass('green-border');
   }

})