<?php

require __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

use Cloudinary\Configuration\Configuration;
use Cloudinary\Api\Upload\UploadApi;

Configuration::instance(
    sprintf(
        'cloudinary://%s:%s@%s?secure=true',
        $_ENV['CLOUDINARY_API_KEY'],
        $_ENV['CLOUDINARY_API_SECRET'],
        $_ENV['CLOUDINARY_CLOUD_NAME']
    )
);

$upload = new UploadApi();

// todo potential options:
//'quality_analysis' => true,
//'colors' => true,
//'categorization' => 'google_tagging',
//'auto_tagging' => true

$uploadResult = $upload->upload(
    'sample.jpg',
    [
        //'public_id' => 'kox_cloudinary_upload_sample',
        'overwrite' => true,
        'folder' => 'product',
        'tags' => ['SKU_XXJB7501S']
    ]
);


echo '<pre>';
echo json_encode(
    $uploadResult,
    JSON_PRETTY_PRINT
);
echo '</pre>';
