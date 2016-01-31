updateColorInput = function(change) {
    var cup = $(change.target).closest('*.color-input-section');
    console.log(cup.children('.color-preview').next());
    cup.children('.color-preview').css('background-color', '#'+change.target.value);
};
$('.hex-code input').change(updateColorInput);

