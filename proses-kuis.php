<?php
/**
 * K3 QUEST — Proses Penilaian Kuis
 * Menerima POST data dari kuis.php, menghitung skor, menyimpan hasil di session, dan mengarahkan ke hasil.php.
 */

define('BASE_URL', '');
require_once __DIR__ . '/includes/init.php';
require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/footer.php';

if (!sudahIdentitas()) {
    redirect('identitas.php');
}

// Pastikan request method POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    // Invalid access, redirect to quiz page
    redirect('kuis.php');
    exit;
}

$soalList = getSoalKuis();
$total    = count($soalList);
$score    = 0;
$details  = [];

foreach ($soalList as $s) {
    $qKey   = 'q' . $s['no'];
    $jawaban = $_POST[$qKey] ?? null;
    $benar  = ($jawaban === $s['jawaban']);
    if ($benar) {
        $score++;
    }
    $details[] = [
        'no'       => $s['no'],
        'kategori' => $s['kategori'],
        'soal'     => $s['soal'],
        'jawaban'  => $jawaban,
        'benar'    => $s['jawaban'],
        'isCorrect'=> $benar,
        'penjelasan'=> $s['penjelasan'],
        'opsi'     => $s['opsi'],
    ];
}

// Simpan hasil di session untuk ditampilkan di hasil.php
$_SESSION['quiz_result'] = [
    'score'   => $score,
    'total'   => $total,
    'details' => $details,
];

// Arahkan ke halaman hasil
redirect('hasil.php');
?>
