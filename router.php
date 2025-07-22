<?php
function feedback404() {
    header("HTTP/1.0 404 Not Found");
    echo "404 Not Found";
    exit;
}

$slug = isset($_GET['slug']) ? trim($_GET['slug']) : '';
if (!$slug) feedback404();

// Cek apakah list.txt ada
$filename = "list.txt";
if (!file_exists($filename)) feedback404();

$lines = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
$target_string = strtolower($slug);
$BRAND = '';

foreach ($lines as $item) {
    if (strtolower(trim($item)) === $target_string) {
        $BRAND = strtoupper($target_string);
        break;
    }
}

if (!$BRAND) feedback404();

// Variabel yang bisa dipakai di asd.php
$BRANDS = $BRAND;
$urlPath = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";

// Tampilkan landing
include("asd.php");
?>
