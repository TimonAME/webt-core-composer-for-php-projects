<?php
namespace src;
//require autoloader for composer:
require 'vendor/autoload.php';


use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\Writer\PngWriter;
class generateQR {
    public string $data;

    public function __construct(string $data) {
        $this->data = $data;
    }
    public function getQR() {
        return 
            Builder::create()
            ->writer(new PngWriter())
            ->data($this->data)
            ->encoding(new Encoding('UTF-8'))
            ->build();
    }
}