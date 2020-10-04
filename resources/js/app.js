require('./bootstrap');

let firstField = document.getElementById("password1");
let secondField = document.getElementById('password2');

function checkPasswordEquality() {
    if(firstField.value !== secondField.value) {
        document.getElementById('incorrectPasswordText').style.display = 'block';
    } else {
        document.getElementById('incorrectPasswordText').style.display = 'none';
    }
}
if(firstField  && secondField) {
    firstField.onchange = checkPasswordEquality;
    secondField.onchange = checkPasswordEquality;
}


//remove genre
if($('#removeGenreButton').length && $('#addGenreButton').length) {
    $('#removeGenreButton').preventDefault;
    $('#removeGenreButton').click(() => {
        let keyword = $('#oldGenreInput').val();
        window.location = `/removekeyword/${keyword}`;
    });

    $('#addGenreButton').preventDefault;
    $('#addGenreButton').click(() => {
        let keyword = $('#newGenreInput').val();
        window.location = `/addkeyword/${keyword}`;
    });
}

