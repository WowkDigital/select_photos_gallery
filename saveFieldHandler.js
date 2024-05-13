function showPopup(message, fileList) {
    $('#popup-message').text(message);
    var $fileList = $('#file-list');
    $fileList.empty();
    if (fileList.length > 0) {
        fileList.forEach(function(file) {
            $fileList.append('<li>' + file + '</li>');
        });
    }
    $('.popup-background').show();
}

$(document).ready(function() {
    $('.save-button').click(function() {
        var selectedPhotos = [];
        var authorName = $('#author-input').val().trim();
        if (authorName === '') {
            showPopup("Proszę wpisać nazwę osoby zapisującej.", []);
            return;
        }

        $('.photo-checkbox:checked').each(function() {
            selectedPhotos.push($(this).data('photo-name'));
        });

        if (selectedPhotos.length === 0) {
            showPopup("Nie zaznaczono żadnych zdjęć.", []);
            return;
        }

        $.ajax({
            type: "POST",
            url: "save_photos.php",
            data: {photos: selectedPhotos, author: authorName},
            success: function(response) {
                showPopup("Zapisano zaznaczone zdjęcia.", selectedPhotos);
            },
            error: function() {
                showPopup("Wystąpił błąd podczas zapisu.", []);
            }
        });
    });
});

$('#copy-button').click(function() {
    var fileListText = $('#file-list li').toArray().map(item => $(item).text()).join('\n');
    navigator.clipboard.writeText(fileListText).then(function() {
        $('#copy-message').show().fadeOut(3000);
    }, function(err) {
        console.error('Async: Could not copy text: ', err);
    });
});

$('.popup-button').click(function() {
    $('.popup-background').hide();
});

$('#author-input').on('input', function() {
    if ($('#author-input').val().trim() === '') {
        $('#copy-button').hide();
    } else {
        $('#copy-button').show();
    }
});
