$('#reults').html("<p>test</p>");
displayResults = function(results) {
    var i,
        displayData = '',
        result;
    for (i=0; i<results.length; i++) {
        result = results[i];
        displayData += '<div>';
        displayData += '<h3>'+result['displayName']+' <small>'+result['subtype']+'</small></h3>';
        displayData += '<div class="color-preview" style="background-color: rgb(';
        displayData += result['red'] + ', ' + result['green'] + ', ' + result['blue'] + ')"></div>';
        displayData += '</div>';
    }
    console.log(displayData);
    document.getElementById("results").innerHTML = displayData;
};

doSearch = function(hexCode) {
    $.get({
        url: 'endpoints/doSearch.php',
        data: {color: hexCode},
        success: displayResults,
        dataType: 'json'
    }).done(displayResults);
};

updateColorInput = function(change) {
    var cup = $(change.target).closest('*.color-input-section');
    cup.children('.color-preview').css('background-color', '#'+change.target.value);
    doSearch(change.target.value);
};
$('.hex-code input').keyup(updateColorInput);

