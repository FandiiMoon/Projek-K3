<?php
/**
 * K3 QUEST — Materi 4: Kesehatan Mental dan Manajemen Stres
 */
define('BASE_URL', '');
require_once __DIR__ . '/../includes/init.php';
require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/footer.php';
require_once __DIR__ . '/../includes/materi-template.php';

if (!sudahIdentitas()) redirect('../identitas.php');

$meta = [
    'no'       => 4,
    'slug'     => 'kesehatan-mental',
    'title'    => 'Kesehatan Mental dan Manajemen Stres',
    'subtitle' => 'Seimbangkan Kerja dan Kehidupan',
    'waktu'    => '~8 menit',
    'prev'     => ['href' => BASE_URL . '/materi/keselamatan-listrik.php', 'label' => 'Materi 3: Keselamatan Listrik'],
    'next'     => null,
];

$keyPoints = [
    'Atur waktu kerja: gunakan teknik Pomodoro atau batch processing untuk menghindari kelelahan mental.',
    'Jaga kualitas tidur: hindari kerja larut malam dan ciptakan kebiasaan tidur yang teratur.',
    'Lakukan istirahat pendek: beri otak waktu istirahat setiap 60‑90 menit dengan gerakan ringan atau meditasi.',
    'Gunakan teknik pernapasan dalam bila merasa stres atau tertekan.',
    'Komunikasikan beban kerja ke tim atau mentor untuk mendapatkan dukungan dan menghindari isolasi.',
];

$content = function() { ?>
<div class="flex flex-col gap-6">
    <!-- Ilustrasi SVG mental health -->
    <div class="bg-surface-container-low rounded-xl p-4 flex justify-center">
        <svg class="w-full max-w-sm h-auto" viewBox="0 0 200 200" fill="none" xmlns="http://www.w3.org/2000/svg">
            <circle cx="100" cy="100" r="80" fill="#396662"/>
            <path d="M70 80 a30 30 0 0 1 60 0" stroke="#BCECE7" stroke-width="6" fill="none"/>
            <path d="M60 130 q40 20 80 0" stroke="#BCECE7" stroke-width="6" fill="none"/>
            <circle cx="85" cy="85" r="5" fill="#002530"/>
            <circle cx="115" cy="85" r="5" fill="#002530"/>
        </svg>
    </div>

    <!-- Apa itu Kesehatan Mental di Kerja? -->
    <div>
        <h3>Apa itu Kesehatan Mental di Tempat Kerja?</h3>
        <p>
            Kesehatan mental mencakup kesejahteraan emosional, psikologis, dan sosial. Dalam pengembangan software, tekanan deadline, bug yang sulit, dan kolaborasi tim dapat menjadi pemicu stres.
        </p>
    </div>

    <!-- Teknik Manajemen Stres -->
    <div>
        <h3>Teknik Manajemen Stres</h3>
        <ul>
            <li><strong>Pomodoro:</strong> Bekerja 25 menit, istirahat 5 menit, ulangi 4 kali lalu ambil istirahat panjang.</li>
            <li><strong>Latihan Pernapasan 4‑7‑8:</strong> Tarik napas 4 detik, tahan 7 detik, hembuskan 8 detik.</li>
            <li><strong>Mindfulness Singkat:</strong> Luangkan 2‑3 menit untuk fokus pada pernapasan atau suara sekitar.</li>
            <li><strong>Olahraga Ringan:</strong> Jalan kaki 5‑10 menit di luar ruangan dapat menurunkan kortisol.</li>
        </ul>
    </div>

    <!-- Keseimbangan Kerja‑Hidup -->
    <div>
        <h3>Keseimbangan Kerja‑Hidup (Work‑Life Balance)</h3>
        <p>
            Tetapkan batas waktu kerja, matikan notifikasi di luar jam kerja, dan alokasikan waktu untuk hobi atau keluarga. Menggunakan teknik "time‑boxing" membantu memisahkan pekerjaan dan waktu pribadi.
        </p>
    </div>

    <!-- Dukungan Sosial -->
    <div>
        <h3>Dukungan Sosial dan Komunikasi</h3>
        <p>
            Diskusikan tantangan dengan rekan tim, mentor, atau konselor. Membangun budaya terbuka di mana anggota tim dapat berbagi beban mental meningkatkan resilien seluruh tim.
        </p>
    </div>
</div>
<?php };

renderMateri($meta, $content, $keyPoints);
?>
