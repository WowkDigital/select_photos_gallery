<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galeria dynamiczna</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div id="loading-screen" class="loading-screen">
        <div class="loading-content">
            <h2>Ładowanie...</h2>
            <div class="spinner"></div>
        </div>
    </div>
    <h1 class="title">Wybór zdjęć do obrobienia</h1>
    <div class="gallery" id="gallery">
        <?php
        $photos_dir = './photos';
        $photos = array_diff(scandir($photos_dir), array('..', '.'));
        $photos = array_values($photos);

        $max_photos_to_display = 5;
        $count = 0;
        
        foreach ($photos as $index => $photo) {
            if ($count >= $max_photos_to_display) break;
            $photo_path = $photos_dir . '/' . $photo;
            if (is_file($photo_path)) {
                echo '<div class="gallery-item" data-index="' . $index . '">';
                echo '<input type="checkbox" class="photo-checkbox" data-photo-name="' . htmlspecialchars($photo) . '">';
                echo '<a href="' . htmlspecialchars($photo_path) . '" data-fancybox="gallery">';
                echo '<img src="' . htmlspecialchars($photo_path) . '" alt="' . htmlspecialchars($photo) . '">';
                echo '</a></div>';
                $count++;
            }
        }
        ?>
    </div>
    <div class="load-more-container" style="text-align: center; margin-top: 20px;">
        <button id="load-more" class="load-more-button">Załaduj więcej zdjęć</button>
    </div>
    <div class="save-section">
        <input type="text" id="author-input" class="author-input" placeholder="Twoje imię" />
        <button class="save-button">Zapisz zaznaczone zdjęcia</button>
    </div>
    <div class="popup-background">
        <div class="popup-content">
            <p id="popup-message">Komunikat</p>
            <ul id="file-list"></ul>
            <button class="copy-button" id="copy-button">Kopiuj listę</button>
            <p class="copy-message" style="font-weight: bold; " id="copy-message">Skopiowano!</p>
            <button class="popup-button">OK</button>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/masonry/4.2.2/masonry.pkgd.min.js" integrity="sha512-JRlcvSZAXT8+5SQQAvklXGJuxXTouyq8oIMaYERZQasB8SBDHZaUbeASsJWpk0UUrf89DP3/aefPPrlMR1h1yQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.imagesloaded/5.0.0/imagesloaded.pkgd.min.js" integrity="sha512-kfs3Dt9u9YcOiIt4rNcPUzdyNNO9sVGQPiZsub7ywg6lRW5KuK1m145ImrFHe3LMWXHndoKo2YRXWy8rnOcSKg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>
    <script>
        var msnry;

        $(window).on('load', function() {
            $('#loading-screen').fadeOut('slow');

            var elem = document.querySelector('.gallery');
            msnry = new Masonry(elem, {
                itemSelector: '.gallery-item',
                columnWidth: '.gallery-item',
                percentPosition: true
            });
            imagesLoaded(elem, function() {
                msnry.layout();
            });
        });

        function initializeFancybox() {
            $('[data-fancybox="gallery"]').fancybox({
                loop: true,
                buttons: ["zoom", "share", "slideShow", "fullScreen", "download", "thumbs", "close"]
            });
        }

        $(document).ready(function() {
            initializeFancybox();

            var photos = <?php echo json_encode($photos); ?>;
            var photos_dir = '<?php echo $photos_dir; ?>';
            var loaded_count = <?php echo $max_photos_to_display; ?>;

            $('#load-more').click(function() {
                var photos_to_load = 5;
                var total_photos = photos.length;
                var current_index = loaded_count;

                for (var i = 0; i < photos_to_load && loaded_count < total_photos; i++, loaded_count++) {
                    var photo = photos[loaded_count];
                    var photo_path = photos_dir + '/' + photo;
                    var gallery_item_html = '<div class="gallery-item" data-index="' + loaded_count + '">';
                    gallery_item_html += '<input type="checkbox" class="photo-checkbox" data-photo-name="' + photo + '">';
                    gallery_item_html += '<a href="' + photo_path + '" data-fancybox="gallery">';
                    gallery_item_html += '<img src="' + photo_path + '" alt="' + photo + '">';
                    gallery_item_html += '</a></div>';

                    $('#gallery').append(gallery_item_html);
                }

                var $new_items = $('.gallery-item[data-index]').slice(current_index, loaded_count);
                $new_items.imagesLoaded(function() {
                    msnry.appended($new_items.toArray());
                    msnry.layout();
                    initializeFancybox();
                });

                if (loaded_count >= total_photos) {
                    $('#load-more').hide();
                }
            });
        });
    </script>
    <script src="saveFieldHandler.js"></script> <!-- save button and popup -->
</body>
</html>
