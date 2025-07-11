<?php
session_start();
$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['song'])) {
    if ($data['song'] === null) {
        unset($_SESSION['now_playing']);
        echo json_encode(['status' => 'stopped']);
    } else {
        $_SESSION['now_playing'] = [
            'song' => $data['song'],
            'time' => floatval($data['time'])
        ];
        echo json_encode(['status' => 'success']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid data']);
}
?>
