<?php
session_start();
if (isset($_SESSION['now_playing'])) {
    echo json_encode([
        'status' => 'playing',
        'song' => $_SESSION['now_playing']['song'],
        'time' => $_SESSION['now_playing']['time']
    ]);
} else {
    echo json_encode(['status' => 'stopped']);
}
?>
