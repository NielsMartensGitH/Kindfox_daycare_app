

// Method for turning the poops brown
$(document).on('click', 'i.fa-poo', function (e) {

        var modal_id = $(this).closest('.modal_id')[0].id
        $("i.poop" + modal_id).removeClass("brown");
        let poopClicked = $(this).attr('id');
        $('#poops' + modal_id).val(poopClicked);
        for (let j = poopClicked; j >= 0; j--){
            $('#' + j + '.poop' + modal_id).addClass('brown');
        }
});

// Method for turning smileys yellow

$(document).on('click', 'i.happy_smile_sleep', function() {
    var modal_id = $(this).closest('.modal_id')[0].id
    $('i#sad_smile_sleep' + modal_id).removeClass('text-warning');
    let smileyClicked = $(this).attr('id');
    $('#sleep_smile' + modal_id)[0].value = 1;
    $('i#happy_smile_sleep' + modal_id).toggleClass('text-warning');
});

$(document).on('click', 'i.sad_smile_sleep', function() {
    var modal_id = $(this).closest('.modal_id')[0].id
    $('i#happy_smile_sleep' + modal_id).removeClass('text-warning');
    let smileyClicked = $(this).attr('id');
    $('#sleep_smile' + modal_id)[0].value = 0;
    $('i#sad_smile_sleep' + modal_id).toggleClass('text-warning');
});

$(document).on('click', 'i.happy_smile_food', function() {
    var modal_id = $(this).closest('.modal_id')[0].id
    $('i#sad_smile_food' + modal_id).removeClass('text-warning');
    let smileyClicked = $(this).attr('id');
    $('#food_smile'+ modal_id)[0].value = 1;
    $('i#happy_smile_food' + modal_id).toggleClass('text-warning');
});

$(document).on('click', 'i.sad_smile_food', function() {
    var modal_id = $(this).closest('.modal_id')[0].id
    $('i#happy_smile_food' + modal_id).removeClass('text-warning');
    let smileyClicked = $(this).attr('id');
    $('#food_smile' + modal_id)[0].value = 0;
    $('i#sad_smile_food' + modal_id).toggleClass('text-warning');
});

//Reset the input fields and make the poops untouched again
$(document).ready(function(){
    $(".btn-close").click(function(){
        $("#diaryForm").trigger("reset");
        $("i.fa-poo").removeClass("brown");
        $('i#happy_smile_food').removeClass('text-warning');
        $('i#sad_smile_food').removeClass('text-warning');
        $('i#happy_smile_sleep').removeClass('text-warning');
        $('i#sad_smile_sleep').removeClass('text-warning');

    });
});



