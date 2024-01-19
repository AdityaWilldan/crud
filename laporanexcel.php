<?php
require 'vendor/autoload.php'; // Pastikan autoload dari PhpSpreadsheet di-load dengan benar

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;

header("Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
header("Content-Disposition: attachment; filename=Data_Mahasiswa.xlsx");

// Load data mahasiswa
require 'functions.php';

$jumlahDataPerHalaman = 2;
$jumlahData = count(query("SELECT * FROM mahasiswa"));
$jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
$halamanAktif = (isset($_GET["halaman"])) ? $_GET["halaman"] : 1;
$awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;

$mahasiswa = query("SELECT * FROM mahasiswa ORDER BY id DESC LIMIT $awalData, $jumlahDataPerHalaman");

// Membuat objek spreadsheet
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Header tabel
$sheet->setCellValue('A1', 'No.');
$sheet->setCellValue('B1', 'Gambar');
$sheet->setCellValue('C1', 'NRP');
$sheet->setCellValue('D1', 'Nama');
$sheet->setCellValue('E1', 'Email');
$sheet->setCellValue('F1', 'Jurusan');

// Set style untuk header
$headerStyle = [
    'font' => ['bold' => true],
    'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
    'fill' => ['fillType' => Fill::FILL_SOLID, 'color' => ['rgb' => 'C0C0C0']],
];
$sheet->getStyle('A1:F1')->applyFromArray($headerStyle);

// Menyisipkan data
$i = 2; // Baris kedua
foreach ($mahasiswa as $row) {
    $sheet->setCellValue('A' . $i, $i - 1);
    // $sheet->setCellValue('B' . $i, ''); // Kosongkan kolom gambar untuk sementara, akan diisi di bawah
    $sheet->setCellValue('C' . $i, $row['nrp']);
    $sheet->setCellValue('D' . $i, $row['nama']);
    $sheet->setCellValue('E' . $i, $row['email']);
    $sheet->setCellValue('F' . $i, $row['jurusan']);

    // Menyisipkan gambar
    $imgPath = 'img/' . $row['gambar'];
    $objDrawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
    $objDrawing->setPath($imgPath);
    $objDrawing->setWidth(80);
    $objDrawing->setHeight(80);
    $objDrawing->setCoordinates('B' . $i);
    $objDrawing->setWorksheet($sheet);

    $i++;
}

// Auto size kolom
foreach (range('A', 'F') as $column) {
    $sheet->getColumnDimension($column)->setAutoSize(true);
}

// Menyimpan ke output
$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
exit();
?>
