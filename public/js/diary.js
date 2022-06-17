

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



