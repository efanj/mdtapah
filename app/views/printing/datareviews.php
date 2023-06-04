<?php
ini_set('memory_limit', '-1');

use Dompdf\Dompdf;
use Dompdf\Options;

$options = new Options();
$options->set('isPhpEnabled', true);
$dompdf = new Dompdf($options);


// $postdata = $fileId;

print_r($fileId);
