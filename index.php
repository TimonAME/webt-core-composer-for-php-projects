<?php
//Install:
//composer init

//Update:
//composer self-update

//Get composer.lock:
//composer update

//Start Autoloader:
//composer dump-autoload

//endroid/qr-code:
//composer require endroid/qr-code

//require autoloader for composer:
require 'vendor/autoload.php';

//extension=gd auskommentiert in php.ini


use src\generateQR;

//for TWIG: composer require twig/twig =>
/*
use Twig\Environment;
use Twig\Loader\FilesystemLoader;
$loader = new FilesystemLoader('templates');
$twig = new Environment($loader);
*/


$qrImageSrc = '';

if (isset($_GET['data']) && !empty($_GET['data'])) {
    // Create a basic QR code
    $qrCode = new generateQR($_GET['data']);
    $result = $qrCode->getQR();

    // Get the QR code as a string
    $qrString = $result->getString();

    //Save to Test QR-Code Reader:
    $result->saveToFile(dirname(__DIR__).'/webt-test/QRScanner/files/qr-code.png');

    // Encode the QR code string as base64
    $qrBase64 = base64_encode($qrString);

    // Use the base64 string as the source for an image tag
    $qrImageSrc = 'data:'.$result->getMimeType().';base64,'.$qrBase64;
}

//for TWIG:
    /*
echo $twig->render('base.twig', [
    'qrImageSrc' => $qrImageSrc,
]);
*/

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>QR-Code</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
    <form class="mb-3">
        <div class="input-group">
            <input type="text" class="form-control" name="data" placeholder="Your Phone Number">
            <button class="btn btn-primary" type="submit">Generate</button>
        </div>
    </form>
    <?php if (!empty($qrImageSrc)): ?>
    <div class="text-center">
        <img src="<?php echo $qrImageSrc; ?>" class="img-fluid" alt="QR Code">
    </div>
    <?php endif; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>