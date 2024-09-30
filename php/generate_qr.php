<?php
require __DIR__ . '/vendor/autoload.php'; // Adjust path to autoload.php

use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelLow;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;

if (isset($_POST['data'])) {
    $data = $_POST['data'];

    // Generate QR code
    $qrImage = Builder::create()
        ->writer(new PngWriter())
        ->data($data)
        ->encoding(new Encoding('UTF-8'))
        ->errorCorrectionLevel(new ErrorCorrectionLevelLow())
        ->roundBlockSizeMode(new RoundBlockSizeModeMargin())
        ->build();

    // Output the QR code as a PNG image
    header('Content-Type: image/png');
    echo $qrImage->getString();
}
?>
