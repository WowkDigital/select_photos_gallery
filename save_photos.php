<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['photos']) && !empty($_POST['author'])) {
    $photos = $_POST['photos'];
    $author = $_POST['author']; // Pobranie nazwy osoby zapisującej
    $file = 'selected_photos.txt';
    
    $date = new DateTime();
    $formattedDate = $date->format('Y-m-d H:i:s');
    
    // Zapis informacji o każdym zaznaczonym zdjęciu
    foreach ($photos as $photo) {
        // Dodanie informacji o autorze do pliku
        $line = $photo . " - " . $author . " - " . $formattedDate . "\n";
        file_put_contents($file, $line, FILE_APPEND);
    }
    
    echo json_encode(['status' => 'success', 'message' => 'Zdjęcia zostały zapisane.']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Brak danych do zapisu.']);
}
?>
