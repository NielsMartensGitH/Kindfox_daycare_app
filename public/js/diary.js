// Method for turning the poops brown
$(document).on('click', 'i', function (e) {    
        let poopClicked = $(this).attr('id');
        for (let i = poopClicked; i >= 0; i--){
            $('#' + i).addClass('brown');
        console.log('#' + poopClicked);
        }
});

$(document).ready(function(){
    $(".btn-close").click(function(){
        $("#diaryForm").trigger("reset");
    });
});
