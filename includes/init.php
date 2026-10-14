<?php
/**
 * K3 QUEST - Inisialisasi Session & Helper Global
 * Di-include pertama kali di setiap halaman PHP
 */

require_once __DIR__ . '/../config/database.php';

// Mulai session jika belum aktif
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// ──────────────────────────────────────────────────────────
// HELPER: Escape output untuk mencegah XSS
// ──────────────────────────────────────────────────────────
function e(string $str): string {
    return htmlspecialchars($str, ENT_QUOTES | ENT_HTML5, 'UTF-8');
}

// ──────────────────────────────────────────────────────────
// HELPER: Ambil nilai session dengan aman
// ──────────────────────────────────────────────────────────
function sess(string $key, mixed $default = null): mixed {
    return $_SESSION[$key] ?? $default;
}

// ──────────────────────────────────────────────────────────
// HELPER: Apakah peserta sudah mengisi identitas?
// ──────────────────────────────────────────────────────────
function sudahIdentitas(): bool {
    return !empty($_SESSION['peserta_nama']) && !empty($_SESSION['peserta_kelas']);
}

// ──────────────────────────────────────────────────────────
// HELPER: Status progress materi (sudah dibuka/belum)
// ──────────────────────────────────────────────────────────
function getProgressMateri(): array {
    return $_SESSION['materi_selesai'] ?? [
        'ergonomi'         => false,
        'kesehatan-mata'   => false,
        'keselamatan-listrik' => false,
        'kesehatan-mental' => false,
    ];
}

// ──────────────────────────────────────────────────────────
// HELPER: Tandai materi sebagai selesai
// ──────────────────────────────────────────────────────────
function tandaiMateriSelesai(string $slug): void {
    $valid = ['ergonomi', 'kesehatan-mata', 'keselamatan-listrik', 'kesehatan-mental'];
    if (in_array($slug, $valid, true)) {
        $_SESSION['materi_selesai'][$slug] = true;
    }
}

// ──────────────────────────────────────────────────────────
// HELPER: Apakah semua materi sudah selesai?
// ──────────────────────────────────────────────────────────
function semuaMateriSelesai(): bool {
    $progress = getProgressMateri();
    return $progress['ergonomi']
        && $progress['kesehatan-mata']
        && $progress['keselamatan-listrik']
        && $progress['kesehatan-mental'];
}

// ──────────────────────────────────────────────────────────
// HELPER: Daftar materi yang belum selesai
// ──────────────────────────────────────────────────────────
function getMateriYangBelumSelesai(): array {
    $labels = [
        'ergonomi'            => 'Ergonomi dan Posisi Kerja',
        'kesehatan-mata'      => 'Kesehatan Mata',
        'keselamatan-listrik' => 'Keselamatan Listrik dan Perangkat',
        'kesehatan-mental'    => 'Kesehatan Mental dan Manajemen Stres',
    ];
    $progress = getProgressMateri();
    $belum = [];
    foreach ($progress as $slug => $selesai) {
        if (!$selesai) {
            $belum[$slug] = $labels[$slug];
        }
    }
    return $belum;
}

// ──────────────────────────────────────────────────────────
// HELPER: Redirect dengan header Location
// ──────────────────────────────────────────────────────────
function redirect(string $url): void {
    header('Location: ' . $url);
    exit;
}

// ──────────────────────────────────────────────────────────
// SOAL KUIS — didefinisikan di sini agar bisa diakses
// dari proses-kuis.php tanpa mengirim kunci ke browser
// ──────────────────────────────────────────────────────────
function getSoalKuis(): array {
    return [
        // ── Ergonomi (3 soal) ──────────────────────────────
        [
            'no'       => 1,
            'kategori' => 'Ergonomi',
            'soal'     => 'Apa tujuan utama ergonomi dalam lingkungan kerja programmer?',
            'opsi'     => [
                'A' => 'Membuat komputer bekerja lebih cepat',
                'B' => 'Menyesuaikan lingkungan kerja agar lebih nyaman dan aman bagi pengguna',
                'C' => 'Mengurangi kebutuhan menggunakan kursi',
                'D' => 'Membuat programmer tidak perlu beristirahat',
            ],
            'jawaban'  => 'B',
            'penjelasan' => 'Ergonomi bertujuan menyesuaikan lingkungan, alat, dan metode kerja dengan kemampuan serta keterbatasan manusia, sehingga pekerjaan menjadi lebih nyaman, aman, dan efisien.',
        ],
        [
            'no'       => 2,
            'kategori' => 'Ergonomi',
            'soal'     => 'Berapakah sudut siku yang ideal saat mengetik di keyboard menurut prinsip ergonomi?',
            'opsi'     => [
                'A' => '45° - 60°',
                'B' => '60° - 75°',
                'C' => '90° - 100°',
                'D' => '120° - 135°',
            ],
            'jawaban'  => 'C',
            'penjelasan' => 'Sudut siku antara 90° hingga 100° dianggap ideal karena mengurangi ketegangan pada otot lengan bawah dan pergelangan tangan saat mengetik.',
        ],
        [
            'no'       => 3,
            'kategori' => 'Ergonomi',
            'soal'     => 'Apa risiko utama dari posisi duduk yang tidak ergonomis dalam jangka panjang bagi programmer?',
            'opsi'     => [
                'A' => 'Komputer lebih cepat panas',
                'B' => 'Gangguan muskuloskeletal seperti nyeri punggung dan leher',
                'C' => 'Koneksi internet menjadi lambat',
                'D' => 'Keyboard cepat rusak',
            ],
            'jawaban'  => 'B',
            'penjelasan' => 'Posisi duduk yang tidak ergonomis dalam jangka panjang dapat menyebabkan gangguan muskuloskeletal, termasuk nyeri punggung, nyeri leher, dan cedera regangan berulang.',
        ],

        // ── Kesehatan Mata (2 soal) ─────────────────────────
        [
            'no'       => 4,
            'kategori' => 'Kesehatan Mata',
            'soal'     => 'Apa yang dapat dilakukan untuk membantu mengurangi kelelahan mata saat menggunakan komputer dalam waktu lama?',
            'opsi'     => [
                'A' => 'Menatap layar tanpa jeda untuk menjaga fokus',
                'B' => 'Meningkatkan kecerahan layar semaksimal mungkin',
                'C' => 'Mengistirahatkan mata secara berkala dengan melihat objek yang jauh',
                'D' => 'Mengurangi ukuran teks agar lebih banyak informasi yang terlihat',
            ],
            'jawaban'  => 'C',
            'penjelasan' => 'Mengistirahatkan mata secara berkala, misalnya dengan melihat objek yang jauh selama beberapa detik, membantu mengurangi ketegangan otot mata yang terjadi saat menatap layar terlalu lama.',
        ],
        [
            'no'       => 5,
            'kategori' => 'Kesehatan Mata',
            'soal'     => 'Apa yang dimaksud dengan aturan 20-20-20 dalam konteks kesehatan mata saat menggunakan komputer?',
            'opsi'     => [
                'A' => 'Bekerja 20 jam, istirahat 20 menit, lalu bekerja 20 jam lagi',
                'B' => 'Setiap 20 menit, lihat objek sejauh 20 kaki selama 20 detik',
                'C' => 'Atur kecerahan layar ke 20%, kontras ke 20%, dan jarak 20 cm',
                'D' => 'Kedipkan mata 20 kali per menit dengan interval 20 detik',
            ],
            'jawaban'  => 'B',
            'penjelasan' => 'Aturan 20-20-20 menyarankan agar setiap 20 menit bekerja di depan komputer, kamu mengalihkan pandangan ke objek yang berjarak sekitar 20 kaki (±6 meter) selama 20 detik untuk membantu merelaksasi otot mata.',
        ],

        // ── Keselamatan Listrik (3 soal) ───────────────────
        [
            'no'       => 6,
            'kategori' => 'Keselamatan Listrik',
            'soal'     => 'Apa tindakan yang tepat jika kamu menemukan kabel listrik yang rusak atau terkelupas di tempat kerja?',
            'opsi'     => [
                'A' => 'Tetap menggunakannya selama komputer masih menyala',
                'B' => 'Memegang bagian kabel yang rusak saat perangkat masih aktif',
                'C' => 'Menghentikan penggunaan perangkat dan melaporkannya kepada pihak yang bertanggung jawab',
                'D' => 'Menutupi kerusakan dengan isolasi biasa tanpa memberi tahu siapa pun',
            ],
            'jawaban'  => 'C',
            'penjelasan' => 'Kabel yang rusak atau terkelupas merupakan bahaya listrik yang serius. Tindakan yang benar adalah menghentikan penggunaan perangkat tersebut segera dan melaporkannya kepada pihak yang berwenang untuk ditangani dengan aman.',
        ],
        [
            'no'       => 7,
            'kategori' => 'Keselamatan Listrik',
            'soal'     => 'Mengapa cairan harus dijaga agar tidak berdekatan dengan perangkat elektronik di area kerja?',
            'opsi'     => [
                'A' => 'Karena cairan dapat membuat layar monitor menjadi buram',
                'B' => 'Karena cairan dapat menyebabkan korsleting listrik yang berbahaya dan merusak perangkat',
                'C' => 'Karena cairan membuat keyboard menjadi lengket',
                'D' => 'Karena cairan dapat memperlambat kecepatan prosesor',
            ],
            'jawaban'  => 'B',
            'penjelasan' => 'Cairan bersifat konduktor listrik. Jika masuk ke dalam perangkat elektronik, dapat menyebabkan korsleting (short circuit) yang berpotensi merusak perangkat secara permanen dan menimbulkan bahaya kebakaran atau sengatan listrik.',
        ],
        [
            'no'       => 8,
            'kategori' => 'Keselamatan Listrik',
            'soal'     => 'Apa risiko yang ditimbulkan dari stopkontak yang kelebihan beban (overloaded) di ruang komputer?',
            'opsi'     => [
                'A' => 'Internet menjadi lebih lambat karena bandwidth terbagi',
                'B' => 'Potensi kebakaran akibat panas berlebih pada instalasi listrik',
                'C' => 'Monitor menjadi terlalu terang',
                'D' => 'Hard disk menjadi lebih cepat aus',
            ],
            'jawaban'  => 'B',
            'penjelasan' => 'Stopkontak yang kelebihan beban akan mengalirkan arus melebihi kapasitasnya, menghasilkan panas berlebih pada kabel dan komponen listrik, yang dapat memicu kebakaran. Itulah mengapa penting untuk tidak menyambungkan terlalu banyak perangkat pada satu stopkontak.',
        ],

        // ── Kesehatan Mental (2 soal) ───────────────────────
        [
            'no'       => 9,
            'kategori' => 'Kesehatan Mental',
            'soal'     => 'Apa tindakan yang baik saat menghadapi deadline proyek yang terasa terlalu berat untuk diselesaikan sendiri?',
            'opsi'     => [
                'A' => 'Mengabaikan semua tugas dan berharap masalah selesai sendiri',
                'B' => 'Mengatur prioritas tugas dan berkomunikasi secara terbuka dengan tim atau guru',
                'C' => 'Tidak beristirahat sama sekali sampai seluruh pekerjaan selesai',
                'D' => 'Menyembunyikan kesulitan yang dialami agar tidak terlihat lemah',
            ],
            'jawaban'  => 'B',
            'penjelasan' => 'Mengatur prioritas dan berkomunikasi secara terbuka adalah pendekatan yang sehat. Meminta bantuan atau mendiskusikan beban kerja bukan tanda kelemahan, melainkan bagian dari kerja tim yang efektif.',
        ],
        [
            'no'       => 10,
            'kategori' => 'Kesehatan Mental',
            'soal'     => 'Mengapa istirahat yang cukup penting bagi seorang software developer, terutama saat sedang mengerjakan proyek besar?',
            'opsi'     => [
                'A' => 'Agar komputer tidak terlalu panas saat ditinggalkan',
                'B' => 'Karena istirahat menurunkan produktivitas secara permanen',
                'C' => 'Istirahat membantu memulihkan konsentrasi, mengurangi stres, dan mencegah kelelahan mental yang dapat menurunkan kualitas kerja',
                'D' => 'Karena perusahaan mewajibkan istirahat dalam kontrak kerja',
            ],
            'jawaban'  => 'C',
            'penjelasan' => 'Istirahat yang cukup adalah investasi produktivitas. Tanpa istirahat yang memadai, konsentrasi menurun, kesalahan coding meningkat, dan risiko burnout (kelelahan mental kronis) menjadi lebih tinggi.',
        ],
    ];
}
