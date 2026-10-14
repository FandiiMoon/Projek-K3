<?php
/**
 * K3 QUEST — Materi 1: Ergonomi dan Posisi Kerja
 */
define('BASE_URL', '');
require_once __DIR__ . '/../includes/init.php';
require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/footer.php';
require_once __DIR__ . '/../includes/materi-template.php';

if (!sudahIdentitas()) redirect('../identitas.php');

$meta = [
    'no'       => 1,
    'slug'     => 'ergonomi',
    'title'    => 'Ergonomi dan Posisi Kerja',
    'subtitle' => 'Bekerja Nyaman dengan Ergonomi',
    'waktu'    => '~8 menit',
    'prev'     => null,
    'next'     => ['href' => BASE_URL . '/materi/kesehatan-mata.php', 'label' => 'Materi 2: Kesehatan Mata'],
];

$keyPoints = [
    'Ergonomi menyesuaikan lingkungan kerja dengan kebutuhan dan kemampuan tubuh manusia.',
    'Posisi duduk ideal: punggung tegak dengan dukungan lumbar, kaki rata di lantai, sudut siku 90–100°.',
    'Posisi layar: bagian atas monitor setinggi mata, jarak 50–70 cm dari mata.',
    'Lakukan peregangan ringan setiap 30–60 menit untuk mencegah kekakuan otot.',
    'Risiko postur buruk jangka panjang: nyeri punggung, leher, RSI (Repetitive Strain Injury).',
];

$content = function() { ?>
  <div class="flex flex-col gap-6">

    <!-- Ilustrasi SVG ergonomi -->
    <div class="bg-surface-container-low rounded-xl p-4 flex justify-center">
      <svg class="w-full max-w-sm h-auto" viewBox="0 0 320 220" fill="none" xmlns="http://www.w3.org/2000/svg">
        <!-- Desk -->
        <rect x="40" y="120" width="200" height="9" rx="3" fill="#193B46"/>
        <rect x="60" y="129" width="9" height="75" rx="2" fill="#84A5B2" opacity="0.7"/>
        <rect x="220" y="129" width="9" height="75" rx="2" fill="#84A5B2" opacity="0.7"/>
        <!-- Monitor stand -->
        <rect x="143" y="108" width="14" height="12" fill="#84A5B2"/>
        <rect x="130" y="118" width="40" height="3" rx="1.5" fill="#193B46"/>
        <!-- Monitor -->
        <rect x="100" y="55" width="100" height="64" rx="5" fill="#002530"/>
        <rect x="106" y="61" width="88" height="52" rx="3" fill="#EEF4F8"/>
        <!-- Code on screen -->
        <rect x="112" y="67" width="30" height="4" rx="1.5" fill="#396662"/>
        <rect x="112" y="75" width="48" height="3" rx="1.5" fill="#A1CFCB"/>
        <rect x="118" y="81" width="36" height="3" rx="1.5" fill="#A1CFCB"/>
        <rect x="112" y="87" width="24" height="3" rx="1.5" fill="#396662"/>
        <rect x="112" y="93" width="40" height="3" rx="1.5" fill="#A1CFCB"/>
        <!-- Keyboard -->
        <rect x="108" y="122" width="84" height="9" rx="2" fill="#193B46" opacity="0.35"/>
        <!-- Chair -->
        <path d="M236 110 C236 97 222 88 210 88" stroke="#193B46" stroke-width="6" stroke-linecap="round"/>
        <path d="M215 142 L244 142" stroke="#193B46" stroke-width="6" stroke-linecap="round"/>
        <line x1="229" y1="146" x2="229" y2="196" stroke="#396662" stroke-width="5"/>
        <line x1="210" y1="198" x2="248" y2="198" stroke="#396662" stroke-width="4" stroke-linecap="round"/>
        <circle cx="210" cy="202" r="3.5" fill="#002530"/>
        <circle cx="248" cy="202" r="3.5" fill="#002530"/>
        <!-- Person -->
        <circle cx="198" cy="53" r="13" fill="#193B46"/>
        <path d="M198 68 C200 88 203 110 207 134" stroke="#193B46" stroke-width="11" stroke-linecap="round"/>
        <path d="M207 134 L165 136" stroke="#193B46" stroke-width="11" stroke-linecap="round"/>
        <path d="M165 136 L167 196" stroke="#193B46" stroke-width="9" stroke-linecap="round"/>
        <path d="M198 84 L184 114 L152 116" stroke="#396662" stroke-width="5.5" stroke-linecap="round" stroke-linejoin="round"/>
        <!-- Sightline -->
        <line x1="188" y1="53" x2="120" y2="54" stroke="#396662" stroke-dasharray="4 3" stroke-width="1.5" opacity="0.5"/>
        <!-- Check badges -->
        <circle cx="118" cy="45" r="9" fill="#BCECE7"/>
        <path d="M115 45 L117.5 47.5 L122.5 42.5" stroke="#102521" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
        <circle cx="184" cy="110" r="9" fill="#BCECE7"/>
        <path d="M181 110 L183.5 112.5 L188.5 107.5" stroke="#102521" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
        <circle cx="229" cy="107" r="9" fill="#BCECE7"/>
        <path d="M226 107 L228.5 109.5 L233.5 104.5" stroke="#102521" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
        <circle cx="168" cy="206" r="9" fill="#BCECE7"/>
        <path d="M165 206 L167.5 208.5 L172.5 203.5" stroke="#102521" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
      </svg>
    </div>

    <!-- Apa itu Ergonomi? -->
    <div>
      <h3>Apa itu Ergonomi?</h3>
      <p>
        <strong>Ergonomi</strong> adalah ilmu yang mempelajari cara menyesuaikan lingkungan, alat, dan metode kerja
        dengan kemampuan serta keterbatasan manusia. Tujuannya adalah membuat pekerjaan menjadi lebih
        <strong>nyaman, aman, dan efisien</strong> — sehingga pekerja dapat produktif tanpa mengorbankan kesehatan.
      </p>
      <p>
        Bagi <em>software engineer</em> yang menghabiskan 6–10 jam sehari di depan komputer,
        penerapan prinsip ergonomi sangat krusial untuk mencegah cedera jangka panjang.
      </p>
    </div>

    <!-- Pengaturan Kursi -->
    <div>
      <h3>Pengaturan Kursi yang Ideal</h3>
      <ul>
        <li><strong>Tinggi kursi:</strong> Sesuaikan agar kedua kaki menapak rata di lantai, lutut membentuk sudut ±90°.</li>
        <li><strong>Dukungan lumbar:</strong> Sandaran kursi harus mendukung lekukan alami punggung bawah.</li>
        <li><strong>Sandaran tangan (armrest):</strong> Atur agar siku berada pada sudut 90°–100° saat mengetik.</li>
        <li><strong>Hindari duduk menyilang kaki</strong> dalam jangka panjang karena mengganggu sirkulasi darah.</li>
      </ul>
    </div>

    <!-- Posisi Monitor -->
    <div>
      <h3>Posisi Monitor yang Benar</h3>
      <ul>
        <li><strong>Jarak:</strong> 50–70 cm dari mata (kira-kira satu lengan).</li>
        <li><strong>Ketinggian:</strong> Bagian atas layar sejajar atau sedikit di bawah garis pandang mata.</li>
        <li><strong>Kemiringan:</strong> Condongkan monitor sedikit ke belakang (10°–20°) agar tidak memaksakan otot leher.</li>
        <li><strong>Posisi tengah:</strong> Layar berada tepat di depan, hindari memutar kepala ke samping terus-menerus.</li>
      </ul>
    </div>

    <!-- Posisi Keyboard & Mouse -->
    <div>
      <h3>Posisi Keyboard dan Mouse</h3>
      <ul>
        <li>Keyboard diletakkan sehingga pergelangan tangan lurus (netral), tidak menekuk ke atas atau ke bawah.</li>
        <li>Mouse berada sejajar dan dekat dengan keyboard agar tidak perlu meraih jauh.</li>
        <li>Gunakan <em>wrist rest</em> sebagai sandaran saat tidak mengetik (bukan saat mengetik aktif).</li>
      </ul>
    </div>

    <!-- Risiko -->
    <div class="p-4 rounded-xl bg-surface-container-low border border-outline-variant">
      <h3 class="text-base mb-2">Risiko Postur Kerja yang Buruk</h3>
      <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
        <?php
        $risks = [
          ['icon'=>'back_hand','label'=>'Nyeri Punggung & Leher','desc'=>'Akibat posisi duduk membungkuk atau layar terlalu rendah.'],
          ['icon'=>'front_hand','label'=>'RSI / Carpal Tunnel','desc'=>'Cedera regangan berulang pada pergelangan tangan.'],
          ['icon'=>'headache','label'=>'Sakit Kepala','desc'=>'Dari tegangan otot leher dan bahu yang kronis.'],
          ['icon'=>'warning','label'=>'Gangguan Sirkulasi','desc'=>'Dari posisi kaki yang tidak tepat dalam waktu lama.'],
        ];
        foreach ($risks as $r): ?>
        <div class="flex items-start gap-2.5">
          <span class="material-symbols-outlined text-wrong icon-md flex-shrink-0 mt-0.5"><?= $r['icon'] ?></span>
          <div>
            <p class="font-semibold text-sm text-on-surface mb-0.5"><?= $r['label'] ?></p>
            <p class="text-xs text-on-surface-variant"><?= $r['desc'] ?></p>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
    </div>

    <!-- Gerakan & Peregangan -->
    <div>
      <h3>Pentingnya Bergerak dan Peregangan</h3>
      <p>
        Tubuh tidak dirancang untuk diam dalam satu posisi terlalu lama. Cobalah untuk:
      </p>
      <ul>
        <li>Berdiri dan berjalan singkat setiap <strong>30–60 menit</strong>.</li>
        <li>Lakukan <strong>peregangan leher dan bahu</strong>: putar kepala perlahan, angkat dan turunkan bahu.</li>
        <li>Regangkan <strong>jari dan pergelangan tangan</strong> dengan membuka-menutup tangan.</li>
        <li>Gunakan pengingat timer atau aplikasi untuk mengingatkan waktu istirahat.</li>
      </ul>
    </div>
  </div>
<?php };

renderMateri($meta, $content, $keyPoints);
