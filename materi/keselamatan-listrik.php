<?php
/**
 * K3 QUEST — Materi 3: Keselamatan Listrik dan Perangkat
 */
define('BASE_URL', '');
require_once __DIR__ . '/../includes/init.php';
require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/footer.php';
require_once __DIR__ . '/../includes/materi-template.php';

if (!sudahIdentitas()) redirect('../identitas.php');

$meta = [
    'no'       => 3,
    'slug'     => 'keselamatan-listrik',
    'title'    => 'Keselamatan Listrik dan Perangkat',
    'subtitle' => 'Bekerja Aman dengan Elektronik',
    'waktu'    => '~7 menit',
    'prev'     => ['href' => BASE_URL . '/materi/kesehatan-mata.php', 'label' => 'Materi 2: Kesehatan Mata'],
    'next'     => ['href' => BASE_URL . '/materi/kesehatan-mental.php', 'label' => 'Materi 4: Kesehatan Mental'],
];

$keyPoints = [
    'Jangan gunakan perangkat listrik yang rusak atau kabel terkelupas.',
    'Pastikan stop kontak dan peralatan memiliki grounding yang baik.',
    'Gunakan alat pelindung seperti sarung tangan isolasi saat bekerja dengan instalasi listrik.',
    'Matikan sumber listrik dan gunakan pengunci (lockout‑tagout) sebelum memperbaiki peralatan.',
    'Jangan menyentuh perangkat dengan tangan basah atau di lingkungan lembab.',
];

$content = function() { ?>
<div class="flex flex-col gap-6">
    <!-- Ilustrasi SVG listrik -->
    <div class="bg-surface-container-low rounded-xl p-4 flex justify-center">
        <svg class="w-full max-w-sm h-auto" viewBox="0 0 200 200" fill="none" xmlns="http://www.w3.org/2000/svg">
            <rect x="30" y="80" width="140" height="80" rx="5" fill="#193B46"/>
            <rect x="70" y="40" width="60" height="40" rx="4" fill="#396662"/>
            <path d="M100 40 V20" stroke="#BCECE7" stroke-width="4"/>
            <path d="M90 20 H110" stroke="#BCECE7" stroke-width="4"/>
            <path d="M100 120 L110 150" stroke="#E53935" stroke-width="6"/>
            <path d="M100 120 L90 150" stroke="#E53935" stroke-width="6"/>
        </svg>
    </div>

    <!-- Apa itu Keselamatan Listrik? -->
    <div>
        <h3>Apa itu Keselamatan Listrik?</h3>
        <p>
            Listrik adalah sumber energi yang sangat berguna, namun jika tidak ditangani dengan benar dapat menyebabkan luka serius, kebakaran, atau bahkan kematian. Di tempat kerja modern, perangkat elektronik dan instalasi listrik menjadi bagian tak terpisahkan dari proses pengembangan software.
        </p>
    </div>

    <!-- Praktik Aman -->
    <div>
        <h3>Praktik Aman saat Menggunakan Perangkat Elektronik</h3>
        <ul>
            <li>Periksa kabel dan adaptor secara visual sebelum dipakai – pastikan tidak ada keretakan atau expose wiring.</li>
            <li>Gunakan stop kontak dengan grounding (grounded) dan hindari penggunaan multipler yang berlebih.</li>
            <li>Jangan menumpuk perangkat di satu stop kontak yang melebihi kapasitas ampere.</li>
            <li>Saat bekerja dengan perangkat yang terhubung ke listrik, matikan dan cabut dulu kabelnya.</li>
            <li>Gunakan alat pelindung diri (APD) seperti sarung tangan isolasi bila bekerja pada instalasi listrik.</li>
        </ul>
    </div>

    <!-- Lockout‑Tagout (LOTO) -->
    <div>
        <h3>Lockout‑Tagout (LOTO)</h3>
        <p>
            Sebelum memperbaiki atau memelihara perangkat listrik, pastikan sumber listrik dimatikan dan dikunci. Pasang label/tag yang jelas untuk memberi tahu bahwa perangkat tidak boleh dihidupkan kembali sebelum prosedur selesai.
        </p>
    </div>

    <!-- Risiko Kebakaran -->
    <div>
        <h3>Risiko Kebakaran akibat Listrik</h3>
        <p>
            Kabel overheat, adaptor yang rusak, atau penggunaan charger tidak resmi bisa menjadi titik api. Selalu gunakan charger resmi dan jangan biarkan perangkat terisi listrik semalaman tanpa pengawasan.
        </p>
    </div>
</div>
<?php };

renderMateri($meta, $content, $keyPoints);
?>
