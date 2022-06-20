$(document).on('click', 'img.client-img', function (e) {
    $childId = $('input.childId').val();
    $status = $('input.getCheckedInStatus' +  $childId).val();
    
    
        if($status == 1){
            $('input.getCheckedInStatus'+ $childId).val('0');
            $newStatus = $('input.getCheckedInStatus' + $childId).val();
            console.log($newStatus);
        }
        else {
            $('input.getCheckedInStatus'+ $childId).val('1');
            $newStatus = $('input.getCheckedInStatus' + $childId).val();
            console.log($newStatus);
        }
    
    //$('img.client-img').toggleClass('green-border');
});


//Method to check the checked_in status of each child and style the border green if checked in
$( document ).ready(function() {
    $( "div.card-group" ).each(function() {
        let childId = $('input.childId').val();
        let status = $('input.getCheckedInStatus' + childId).val();
        let imgId = $('img.client-img').attr('id');
        console.log(imgId);
        console.log(status);
        if(status == 1) {
            $('img.client-img' + '#' + imgId).addClass('green-border');
        };
    
   })

});