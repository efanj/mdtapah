<?php
ini_set('memory_limit', '-1');

use Dompdf\Dompdf;
use Dompdf\Options;

$options = new Options();
$options->set('isPhpEnabled', true);
$dompdf = new Dompdf($options);

$rows = $this->controller->printing->datasubmition($id);
$date = $this->controller->printing->datesubmition($id);

$currentdate = date("d/m/Y");

$gt = 0;
$i = 1;

$html = '
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Semakan Tapak</title>
  <style>
    @page {
      margin: 50px 50px;
    }

    .title {
      font-family: Tahoma, Arial, sans-serif;
      border-collapse: collapse;
      width: 100%;
      text-align: center;
      font-size: 12px;
      margin-bottom: 10px;

    }

    .print-table {
      font-family: Tahoma, Arial, sans-serif;
      border-collapse: collapse;
      width: 100%;
      font-size: 10px;
      page-break-inside: auto;
    }

    .print-table td,
    .print-table th {
      border: 1px solid #444;
      padding: 2px 8px;
    }

    .print-table thead {
      background-color: #ddd;
    }

    .no-break {
      page-break-inside: avoid;
    }
  </style>
</head>

<body>';
$html .= '<table class="title">';
$html .= '<tr>
      <td style="width:20%; text-align:left"> </td>
      <td style="width:60%;font-size: 14px;font-weight:bold;">' . Config::get('PBT_NAME') . '</td>
      <td style="width:20%;text-align:right"></td>
    </tr>';
$html .= '<tr>
      <td style="width:20%; text-align:left">Tarikh Serah : ' . $date . '</td>
      <td></td>
      <td style="width:20%;text-align:right">Tarikh : ' . $currentdate . '</td>
    </tr>';
$html .= '</table>';
$html .= '<table class="print-table">
    <thead>
      <tr>
        <th rowspan="2">Bil</th>
        <th rowspan="2">Akaun</th>
        <th rowspan="2">Nama Pemilik & Alamat Harta</th>
        <th rowspan="2">No Lot</br>No PT</br>Hakmilik</th>
        <th rowspan="2">Luas Tanah Asal<br/>Luas Bgn Asal<br/>Luas Ans Asal</th>
        <th rowspan="2">Luas Bgn Tamb.</br>Luas Ans Tamb.</th>
        <th rowspan="2">Nilai Tahunan</br>Kadar</br>Cukai Taksiran</th>
        <th colspan="3">Berkaitan</th>
      </tr>
      <tr>
        <th>Nilaian</th>
        <th>Gambar</th>
        <th>Dokumen</th>
      </tr>
    </thead>
    <tbody>';

foreach ($rows as $row) {
  $html .= '<tr class="no-break">
        <td>' . $i . '</td>
        <td>' . $row['akaun'] . '</td>
        <td><strong>' . $row['pmk_nmbil'] . '</strong></br>' . $row['smk_adpg1'] . '</br>' . $row['smk_adpg2'] . '</br>' .
    $row['smk_adpg3'] . '</br>' . $row['smk_adpg4'] . '</td>
        <td>' . $row['smk_nolot'] . '</br>' . $row['smk_nompt'] . '</br>' . $row['pmk_hkmlk'] . '</td>
        <td>' . $row['peg_lstnh'] . ' mp</br>' . $row['peg_lsbgn'] . ' mp</br>' . $row['peg_lsans'] . ' mp</td>
        <td>' . $row['smk_lsbgn_tmbh'] . ' mp</br>' . $row['smk_lsans_tmbh'] . ' mp</td>
        <td>RM ' . number_format($row['peg_nilth'], 2) . '<br/>' . $row['kaw_kadar'] . '%<br/>RM ' . number_format($row['peg_tksir'], 2) . '</td>
        <td>' . $row['siri_no'] . '</td><td>' . $row['file'] . '</td><td>' . $row['doc'] . '</td>
      </tr>';
  $i++;
}

// $html .= '
//     </tbody>
//   </table>';

// foreach ($rows as $row) {
//   $html .= '<table style="width:100%;">
//     <tr>';
//   foreach ($row['files'] as $imgs) {
//     if ($imgs['hashed_filename'] != "") {
//       $imageraw = IMAGES . "big-lightgallry/" . $imgs['hashed_filename'];
//       $image = file_get_contents($imageraw);
//       $imagedata = base64_encode($image);
//       $imgpath = '<img src="data:image/png;base64, ' . $imagedata . '" width="400px">';
//     }
//     $html .= '<td style="width:50%;">' . $imgpath . '</td>';
//   }
//   $html .= '</tr>
//   </table>';
// }
$html .= '</tbody></table>';
$html .= '</body>

</html>';

$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'landscape');
$dompdf->render();
// Parametersx
$x = 782;
$y = 564;
$text = "{PAGE_NUM} of {PAGE_COUNT}";
$font = $dompdf->getFontMetrics()->get_font('Helvetica', 'normal');
$size = 9;
$color = array(0, 0, 0);
$word_space = 0.0;
$char_space = 0.0;
$angle = 0.0;

$dompdf->getCanvas()->page_text(
  $x,
  $y,
  $text,
  $font,
  $size,
  $color,
  $word_space,
  $char_space,
  $angle
);
$dompdf->stream('dataserahan.pdf', ['Attachment' => 0]);
