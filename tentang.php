<?php
/**
 * K3 QUEST — About Page (Tentang)
 */
define('BASE_URL', '');
require_once __DIR__ . '/includes/init.php';
require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/footer.php';

if (!sudahIdentitas()) redirect('identitas.php');

renderHeader('Tentang K3 QUEST', 'tentang', ['Tentang' => null]);
?>
<main class="max-w-4xl mx-auto px-4 sm:px-6 py-10">
    <h1 class="font-display text-3xl font-bold text-primary mb-6">Tentang K3 QUEST</h1>
    <div class="card p-6 space-y-4">
        <p class="text-on-surface-variant">
            K3 QUEST adalah platform edukasi interaktif yang dirancang khusus untuk siswa SMK Rekayasa Perangkat Lunak (RPL).
            Melalui serangkaian modul singkat, siswa mempelajari prinsip-prinsip Keselamatan dan Kesehatan Kerja (K3) yang relevan
            dengan dunia software engineering, mulai dari ergonomi, kesehatan mata, keselamatan listrik, hingga kesehatan mental.
        </p>
        <p class="text-on-surface-variant">
            Setiap materi dilengkapi dengan ilustrasi SVG, poin penting, dan latihan praktis sehingga pembelajaran menjadi menarik dan aplikatif.
            Setelah menyelesaikan semua modul, siswa dapat menguji pemahaman mereka dengan kuis pilihan ganda yang menilai
            pengetahuan secara menyeluruh.
        </p>
        <p class="text-on-surface-variant">
            Platform ini dibangun dengan PHP, TailwindCSS (via CDN) dan JavaScript, serta mengadopsi desain visual modern berwarna teal/mint
            yang memberikan kesan premium dan responsif pada berbagai perangkat.
        </p>
        <p class="text-on-surface-variant">
            <strong>Pengembang:</strong> LOQ (SMK Project K3) – © 2026. Semua hak dilindungi.
        </p>
    </div>
</main>
<?php
renderFooter();
?>
