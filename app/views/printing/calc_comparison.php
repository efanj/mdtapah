<?php

use Dompdf\Dompdf;
use Dompdf\Options;

$options = new Options();
$options->set('isPhpEnabled', true);
$dompdf = new Dompdf($options);

$rows = $this->controller->informations->getCalcInfo($siriNo);
$date = date('d/m/Y');

$gt = 0;
$i = 1;


$html = '<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kertas Penilaian</title>
  <style>
  .title {
    font-family: Tahoma, Arial, sans-serif;
    border-collapse: collapse;
    width: 700px;
    text-align: center;
    font-size: 14px;
    margin-bottom: 10px;

  }

  .print-table {
    text-align: left;
    font-family: Tahoma, Arial, sans-serif;
    font-size: 14px;
    width: 700px;
  }

  .print-table td,
  .print-table th {
    padding: 6px 0;
  }
  </style>
</head>

<body>';
$html .= '<div style="width:700px; margin-left:auto; margin-right:auto;">';
$html .= '<table class="title"><tr><td>MAJLIS DAERAH TAPAH</td></tr></table><hr>';
$html .= '<table class="title"><tr><td colspan="4" style="font-size:14px;font-weight:bold; padding-bottom:20px;text-decoration:underline;">';
$html .= 'JABATAN PENILAIAN DAN PENGURUSAN HARTA</td></tr><tr><td colspan="3" style="font-size:14px;font-weight:bold;padding-bottom:10px;text-decoration:underline;">';
$html .= 'KERTAS PENILAIAN</td></tr>';
$html .= '<tr><td style="width:228px;"></td><td style="width:228px;"></td><td style="width:230px;font-size:14px;font-weight:bold;border:2px solid #000">';
$html .= 'LOT HUJUNG</td></tr></table>';
$html .= '<table class="print-table"><tr><td style="width:145px">ALAMAT HARTA</td><td style="width:5px">:</td>';
$html .= '<td style="width:602px">TAMAN SAUJANA INDAH, 35400 TAPAH ROAD</td></tr><tr><td>NILAIAN</td><td>:</td><td>BANGUNAN UTAMA</td></tr>';
$html .= '<tr><td colspan="3"><table style="width: 700px">';
foreach ($rows as $row) {
  $html .= '<tr><td style="width:145px">TINGKAT BAWAH</td><td style="width:90px; text-align:right;border-bottom:1px solid #000;">68.00</td>';
  $html .= '<td style="width:70px;word-spacing: 5px;">MP X RM</td><td style="width:90x; text-align:right;border-bottom:1px solid #000;">1.30</td>';
  $html .= '<td style="width:72px;word-spacing: 4px;">SMP : RM</td><td style="width:90px; text-align:right;border-bottom:1px solid #000;">88.40</td>';
  $html .= '<td style="width:25px;"></td><td style="width:105px;"></td></tr>';
}
$html .= '<tr><td colspan="6"></td><td style="text-align:right;">RM</td><td style="text-align:right;border-bottom:2px solid #000;">88.40</td></tr></table>';
$html .= '</td></tr><tr><td>NILAIAN</td><td>:</td><td>BANGUNAN LUAR</td></tr>';
$html .= '<tr><td colspan="3"><table style="width: 700px"><tr><td style="width:145px"></td>';
$html .= '<td style="width:90px; text-align:right;border-bottom:1px solid #000;">68.00</td><td style="width:70px;word-spacing: 5px;">MP X RM</td>';
$html .= '<td style="width:90x; text-align:right;border-bottom:1px solid #000;">1.30</td><td style="width:72px;word-spacing: 4px;">SMP : RM</td>';
$html .= '<td style="width:90px; text-align:right;border-bottom:1px solid #000;">88.40</td><td style="width:25px;"></td><td style="width:100px;"></td></tr>';
$html .= '<tr><td colspan="6"></td><td style="text-align:right;">RM</td><td style="text-align:right;border-bottom:2px solid #000;">88.40</td></tr></table></td></tr></table>';
$html .= '<table class="print-table"><tr><td style="width:537px; text-align:right;font-size: 14px; font-weight: bold; ">ANGGARAN SEWA BULANAN</td>';
$html .= '<td style="width:30px;text-align:center;">:</td><td style="width:25px;text-align:right;">RM</td>';
$html .= '<td style="width:100px;text-align:right; border-bottom:1px solid #000;">105.31</td></tr><tr>';
$html .= '<td style="text-align:right;font-size: 14px;">+Corner Lot 10 %</td><td style="text-align:center;">:</td>';
$html .= '<td style="text-align:right;">RM</td><td style="text-align:right; border-bottom:1px solid #000;">115.84</td></tr>';
$html .= '<tr><td style="text-align:right;font-size: 14px;">SEWA SEBULAN DIGENABKAN</td><td style="text-align:center;">:</td>';
$html .= '<td style="text-align:right;">RM</td><td style="text-align:right; border-bottom:1px solid #000;">115.84</td></tr>';
$html .= '<tr><td style="text-align:right;font-size: 14px; font-weight: bold; ">NILAI TAHUNAN</td><td style="text-align:center;">:</td>';
$html .= '<td style="text-align:right;">RM</td><td style="text-align:right; border-bottom:1px solid #000;">105.31</td></tr>';
$html .= '<tr><td style="text-align:right;font-size: 14px;">KADAR</td><td style="text-align:center;">:</td>';
$html .= '<td style="text-align:right;">RM</td><td style="text-align:right; border-bottom:1px solid #000;">115.84</td></tr>';
$html .= '<tr><td style="text-align:right;font-size: 14px; font-weight: bold; ">CUKAI TAKSIRAN</td><td style="text-align:center;">:</td>';
$html .= '<td style="text-align:right;">RM</td><td style="text-align:right; border-bottom:1px solid #000;">105.31</td></tr></table>';
$html .= '<table class="print-table"><tr><td style="width:125px;">NILAI TAHUNAN</td><td style="width:20px;">:</td>';
$html .= '<td style="width:20px;font-weight: bold;">RM</td><td style="width:110px;text-align:right;font-weight: bold;">1,300.80</td>';
$html .= '<td style="width:120px;text-align:center;">MULAI</td><td style="font-weight: bold;">01.07.2022</td></tr></table>';
$html .= '<table class="print-table"><tr><td style="width:400px; text-align:right;font-size: 14px;">DINILAI OLEH</td>';
$html .= '<td style="width:5%;text-align:right;">:</td><td style="text-align:right; border-bottom:1px dotted #000;"></td></tr>';
$html .= '<tr><td style="width:65%; text-align:right;font-size: 14px;"></td><td style="width:5%;text-align:right;"></td>';
$html .= '<td style="text-align:center; font-weight: bold;">(PEN.PEGAWAI PENILAIAN)</td></tr>';
$html .= '<tr><td style="width:65%; text-align:right;font-size: 14px;">TARIKH</td><td style="width:5%;text-align:right;">:</td><td style="text-align:center;"></td></tr>';
$html .= '<tr><td colspan="3"></td></tr><tr><td colspan="3"></td></tr>';
$html .= '<tr><td style="width:65%; text-align:right;font-size: 14px;font-weight: bold;">DILULUSKAN / TIDAK DILULUSKAN</td>';
$html .= '<td style="width:5%;text-align:right;">:</td><td style="text-align:right; border-bottom:1px dotted #000;"></td></tr>';
$html .= '<tr><td style="width:65%; text-align:right;font-size: 14px;"></td><td style="width:5%;text-align:right;"></td>';
$html .= '<td style="text-align:center; font-weight: bold;">(PEN. PEGAWAI PENILAIAN KANAN)</td></tr>';
$html .= '<tr><td style="width:65%; text-align:right;font-size: 14px;">TARIKH</td><td style="width:5%;text-align:right;">:</td>';
$html .= '<td style="text-align:center;"></td></tr></table></div></body></html>';

$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'potrait');
$dompdf->render();
$dompdf->stream('dataserahan.pdf', ['Attachment' => 0]);
?>



<!-- <div style="width:752px; margin-left:auto; margin-right:auto;">
  <table class="title">
    <tr>
      <td>MAJLIS DAERAH TAPAH</td>
    </tr>
  </table>
  <hr>
  <table class="title">
    <tr>
      <td colspan="4" style="font-size: 14px; font-weight: bold; padding-bottom: 20px;text-decoration: underline;">
        JABATAN PENILAIAN DAN PENGURUSAN HARTA</td>
    </tr>
    <tr>
      <td colspan="3" style="font-size: 14px; font-weight: bold; padding-bottom: 10px;text-decoration: underline;">
        KERTAS PENILAIAN</td>
    </tr>
    <tr>
      <td style="width:33%;"></td>
      <td style="width:33%;"></td>
      <td style="width:34%;font-size: 14px;font-weight:bold; border:2px solid #000">LOT HUJUNG</td>
    </tr>
  </table>
  <table class="print-table">
    <tr>
      <td style="width:145px">ALAMAT HARTA</td>
      <td style="width:5px">:</td>
      <td style="width:602px">TAMAN SAUJANA INDAH, 35400 TAPAH ROAD</td>
    </tr>
    <tr>
      <td>NILAIAN</td>
      <td>:</td>
      <td>BANGUNAN UTAMA</td>
    </tr>
    <tr>
      <td colspan="3">
        <table style="width: 100%">
          <tr>
            <td style="width:145px">TINGKAT BAWAH</td>
            <td style="width:105px; text-align:right;border-bottom:1px solid #000;">68.00</td>
            <td style="width:70px;word-spacing: 7px;">MP X RM</td>
            <td style="width:105x; text-align:right;border-bottom:1px solid #000;">1.30</td>
            <td style="width:72px;word-spacing: 6px;">SMP : RM</td>
            <td style="width:105px; text-align:right;border-bottom:1px solid #000;">88.40</td>
            <td style="width:25px;"></td>
            <td style="width:120px;"></td>
          </tr>
          <tr>
            <td colspan="6"></td>
            <td style="text-align:right;">RM</td>
            <td style="text-align:right;border-bottom:2px solid #000;">88.40</td>
          </tr>
        </table>
      </td>
    </tr>
    <tr>
      <td>NILAIAN</td>
      <td>:</td>
      <td>BANGUNAN LUAR</td>
    </tr>
    <tr>
      <td colspan="3">
        <table style="width: 100%">
          <tr>
            <td style="width:145px"></td>
            <td style="width:105px; text-align:right;border-bottom:1px solid #000;">68.00</td>
            <td style="width:70px;word-spacing: 7px;">MP X RM</td>
            <td style="width:105x; text-align:right;border-bottom:1px solid #000;">1.30</td>
            <td style="width:72px;word-spacing: 6px;">SMP : RM</td>
            <td style="width:105px; text-align:right;border-bottom:1px solid #000;">88.40</td>
            <td style="width:25px;"></td>
            <td style="width:120px;"></td>
          </tr>
          <tr>
            <td colspan="6"></td>
            <td style="text-align:right;">RM</td>
            <td style="text-align:right;border-bottom:2px solid #000;">88.40</td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
  <table class="print-table">
    <tr>
      <td style="width:582px; text-align:right;font-size: 14px; font-weight: bold; ">ANGGARAN SEWA BULANAN</td>
      <td style="width:20px;text-align:right;">:</td>
      <td style="width:25px;text-align:right;">RM</td>
      <td style="width:125px;text-align:right; border-bottom:1px solid #000;">105.31</td>
    </tr>
    <tr>
      <td style="text-align:right;font-size: 14px;">+Corner Lot 10 %</td>
      <td style="text-align:right;">:</td>
      <td style="text-align:right;">RM</td>
      <td style="text-align:right; border-bottom:1px solid #000;">115.84</td>
    </tr>
    <tr>
      <td style="text-align:right;font-size: 14px;">SEWA SEBULAN DIGENABKAN</td>
      <td style="text-align:right;">:</td>
      <td style="text-align:right;">RM</td>
      <td style="text-align:right; border-bottom:1px solid #000;">115.84</td>
    </tr>
    <tr>
      <td style="text-align:right;font-size: 14px; font-weight: bold; ">NILAI TAHUNAN</td>
      <td style="text-align:right;">:</td>
      <td style="text-align:right;">RM</td>
      <td style="text-align:right; border-bottom:1px solid #000;">105.31</td>
    </tr>
    <tr>
      <td style="text-align:right;font-size: 14px;">KADAR</td>
      <td style="text-align:right;">:</td>
      <td style="text-align:right;">RM</td>
      <td style="text-align:right; border-bottom:1px solid #000;">115.84</td>
    </tr>
    <tr>
      <td style="text-align:right;font-size: 14px; font-weight: bold; ">CUKAI TAKSIRAN</td>
      <td style="text-align:right;">:</td>
      <td style="text-align:right;">RM</td>
      <td style="text-align:right; border-bottom:1px solid #000;">105.31</td>
    </tr>
  </table>
  <table class="print-table">
    <tr>
      <td style="width:125px;">NILAI TAHUNAN</td>
      <td style="width:20px;">:</td>
      <td style="width:20px;font-weight: bold;">RM</td>
      <td style="width:110px;text-align:right;font-weight: bold;">1,300.80</td>
      <td style="width:120px;text-align:center;">MULAI</td>
      <td style="font-weight: bold;">01.07.2022</td>
    </tr>
  </table>
  <table class="print-table">
    <tr>
      <td style="width:65%; text-align:right;font-size: 14px;">DINILAI OLEH</td>
      <td style="width:5%;text-align:right;">:</td>
      <td style="text-align:right; border-bottom:1px dotted #000;"></td>
    </tr>
    <tr>
      <td style="width:65%; text-align:right;font-size: 14px;"></td>
      <td style="width:5%;text-align:right;"></td>
      <td style="text-align:center; font-weight: bold;">(PEN.PEGAWAI PENILAIAN)</td>
    </tr>
    <tr>
      <td style="width:65%; text-align:right;font-size: 14px;">TARIKH</td>
      <td style="width:5%;text-align:right;">:</td>
      <td style="text-align:center;"></td>
    </tr>
    <tr>
      <td colspan="3"></td>
    </tr>
    <tr>
      <td colspan="3"></td>
    </tr>
    <tr>
      <td style="width:65%; text-align:right;font-size: 14px;font-weight: bold;">DILULUSKAN / TIDAK DILULUSKAN</td>
      <td style="width:5%;text-align:right;">:</td>
      <td style="text-align:right; border-bottom:1px dotted #000;"></td>
    </tr>
    <tr>
      <td style="width:65%; text-align:right;font-size: 14px;"></td>
      <td style="width:5%;text-align:right;"></td>
      <td style="text-align:center; font-weight: bold;">(PEN. PEGAWAI PENILAIAN KANAN)</td>
    </tr>
    <tr>
      <td style="width:65%; text-align:right;font-size: 14px;">TARIKH</td>
      <td style="width:5%;text-align:right;">:</td>
      <td style="text-align:center;"></td>
    </tr>
  </table>
</div> -->