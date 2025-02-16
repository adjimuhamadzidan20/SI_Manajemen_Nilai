<?php 
    // Require composer autoload
    // require_once __DIR__ . '';
    // require(APPPATH . __DIR__ . '../vendor/autoload.php');

    require_once ROOTPATH . __DIR__ . 'vendor/autoload.php';

    // Create an instance of the class:
    $mpdf = new \Mpdf\Mpdf();

    // Write some HTML code:
    $mpdf->WriteHTML('Hello World');

    // Output a PDF file directly to the browser
    $mpdf->Output();


?>