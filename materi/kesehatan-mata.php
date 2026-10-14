<?php
/**
 * K3 QUEST — Materi 2: Kesehatan Mata
 */
define('BASE_URL', '');
require_once __DIR__ . '/../includes/init.php';
require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/footer.php';
require_once __DIR__ . '/../includes/materi-template.php';

if (!sudahIdentitas()) redirect('../identitas.php');

$meta = [
    'no'       => 2,
    'slug'     => 'kesehatan-mata',
    'title'    => 'Kesehatan Mata',
    'subtitle' => 'Jaga Kesehatan Mata saat Coding',
    'waktu'    => '~7 menit',
    'prev'     => ['href' => BASE_URL . '/materi/ergonomi.php', 'label' => 'Materi 1: Ergonomi'],
    'next'     => ['href' => BASE_URL . '/materi/keselamatan-listrik.php', 'label' => 'Materi 3: Keselamatan Listrik'],
];

$keyPoints = [
    'Kelelahan mata (Computer Vision Syndrome) sering dialami programmer yang bekerja lama di depan layar.',
    'Aturan 20-20-20: setiap 20 menit, lihat objek sejauh ±6 meter selama 20 detik.',
    'Atur kecerahan layar agar tidak terlalu terang maupun terlalu gelap dari lingkungan sekitar.',
    'Pastikan ukuran teks nyaman dibaca — jangan terlalu kecil untuk menghemat ruang layar.',
    'Kurangi pantulan cahaya dengan menggunakan filter layar atau mengubah sudut monitor.',
];

$content = function() { ?>
  <div class="flex flex-col gap-6">

    <!-- Ilustrasi SVG Kesehatan Mata -->
    <div class="bg-surface-container-low rounded-xl p-4 flex justify-center">
      <svg class="w-full max-w-xs h-auto" viewBox="0 0 280 180" fill="none" xmlns="http://www.w3.org/2000/svg">
        <!-- Monitor -->
        <rect x="40" y="20" width="200" height="120" rx="8" fill="#002530"/>
        <rect x="48" y="28" width="184" height="104" rx="5" fill="#EEF4F8"/>
        <!-- Eyes on screen content -->
        <ellipse cx="100" cy="75" rx="22" ry="13" fill="#BCECE7"/>
        <circle cx="100" cy="75" r="8" fill="#193B46"/>
        <circle cx="103" cy="72" r="2.5" fill="white"/>
        <ellipse cx="170" cy="75" rx="22" ry="13" fill="#BCECE7"/>
        <circle cx="170" cy="75" r="8" fill="#193B46"/>
        <circle cx="173" cy="72" r="2.5" fill="white"/>
        <!-- 20-20-20 text -->
        <text x="135" y="108" text-anchor="middle" font-size="10" fill="#396662" font-family="Plus Jakarta Sans" font-weight="700">20-20-20</text>
        <!-- Monitor base -->
        <rect x="125" y="140" width="30" height="12" fill="#84A5B2"/>
        <rect x="110" y="150" width="60" height="6" rx="2" fill="#193B46"/>
        <!-- Arrow showing distance -->
        <line x1="40" y1="165" x2="240" y2="165" stroke="#396662" stroke-width="1.5" stroke-dasharray="4 3"/>
        <text x="140" y="177" text-anchor="middle" font-size="9" fill="#396662" font-family="Inter">50 – 70 cm</text>
        <!-- Glare symbol -->
        <circle cx="230" cy="35" r="12" fill="#FFF8E1"/>
        <path d="M230 25 L230 22 M230 45 L230 48 M222 35 L219 35 M238 35 L241 35" stroke="#F59E0B" stroke-width="2" stroke-linecap="round"/>
        <circle cx="230" cy="35" r="6" fill="#FCD34D"/>
        <!-- X over glare (reduce glare) -->
        <line x1="226" y1="31" x2="234" y2="39" stroke="#D9535D" stroke-width="2" stroke-linecap="round"/>
        <line x1="234" y1="31" x2="226" y2="39" stroke="#D9535D" stroke-width="2" stroke-linecap="round"/>
      </svg>
    </div>

    <!-- Penyebab kelelahan mata -->
    <div>
      <h3>Penyebab Kelelahan Mata saat Menggunakan Komputer</h3>
      <p>
        <strong>Computer Vision Syndrome (CVS)</strong> atau Sindrom Penglihatan Komputer adalah kumpulan gejala
        yang dirasakan setelah menatap layar dalam waktu lama. Gejalanya meliputi:
        mata lelah, kering, perih, penglihatan buram, sakit kepala, dan nyeri leher.
      </p>
      <ul>
        <li>Frekuensi berkedip menurun drastis (dari ±20x/menit menjadi 5–7x/menit) saat menatap layar.</li>
        <li>Mata harus terus-menerus fokus dan menyesuaikan jarak pandang.</li>
        <li>Cahaya biru (<em>blue light</em>) dari layar LED bisa mempercepat kelelahan.</li>
        <li>Pencahayaan ruangan yang tidak seimbang dengan kecerahan layar.</li>
      </ul>
    </div>

    <!-- Aturan 20-20-20 -->
    <div class="p-5 rounded-xl bg-secondary-fixed/20 border border-secondary-fixed">
      <div class="flex items-center gap-2 mb-3">
        <span class="material-symbols-outlined text-secondary icon-lg">timer</span>
        <h3 class="mb-0">Aturan 20-20-20</h3>
      </div>
      <p>
        Salah satu kebiasaan sederhana yang dapat membantu mengurangi kelelahan mata adalah aturan <strong>20-20-20</strong>:
      </p>
      <div class="grid grid-cols-3 gap-3 mt-3">
        <?php
        $rules = [
          ['val'=>'20','unit'=>'menit','desc'=>'Bekerja di depan layar'],
          ['val'=>'20','unit'=>'kaki (~6m)','desc'=>'Jarak objek yang dilihat'],
          ['val'=>'20','unit'=>'detik','desc'=>'Durasi istirahat mata'],
        ];
        foreach ($rules as $r): ?>
        <div class="text-center p-3 rounded-xl bg-white/60">
          <p class="font-display font-extrabold text-2xl text-secondary"><?= $r['val'] ?></p>
          <p class="text-xs font-semibold text-on-secondary-fixed-variant"><?= $r['unit'] ?></p>
          <p class="text-xs text-on-surface-variant mt-1"><?= $r['desc'] ?></p>
        </div>
        <?php endforeach; ?>
      </div>
      <p class="text-xs text-on-surface-variant mt-3">
        <em>Catatan: Aturan ini adalah panduan umum yang berguna, bukan jaminan pencegahan semua gangguan mata. Jika keluhan berlanjut, konsultasikan ke dokter mata.</em>
      </p>
    </div>

    <!-- Pengaturan Layar -->
    <div>
      <h3>Pengaturan Kecerahan dan Ukuran Teks</h3>
      <ul>
        <li><strong>Kecerahan:</strong> Sesuaikan kecerahan layar agar serasi dengan pencahayaan ruangan — tidak terlalu terang dan tidak terlalu gelap.</li>
        <li><strong>Kontras:</strong> Pastikan teks dan latar belakang memiliki kontras yang cukup agar mudah dibaca.</li>
        <li><strong>Ukuran teks:</strong> Perbesar ukuran teks di IDE atau browser hingga nyaman dibaca tanpa memicingkan mata.</li>
        <li><strong>Mode gelap (Dark Mode):</strong> Di lingkungan dengan pencahayaan rendah, dark mode dapat mengurangi kelelahan, tetapi tidak cocok untuk semua orang. Temukan preferensimu sendiri.</li>
      </ul>
    </div>

    <!-- Mengurangi Pantulan -->
    <div>
      <h3>Mengurangi Pantulan Cahaya</h3>
      <ul>
        <li>Posisikan monitor agar tidak menghadap langsung ke jendela atau sumber cahaya terang.</li>
        <li>Gunakan tirai atau gorden untuk mengurangi silau dari sinar matahari.</li>
        <li>Pertimbangkan penggunaan filter layar anti-glare jika lingkungan kerja sangat terang.</li>
      </ul>
    </div>

    <!-- Pencahayaan ruangan -->
    <div>
      <h3>Pencahayaan Ruangan</h3>
      <p>
        Pencahayaan ruangan yang ideal untuk bekerja di depan komputer adalah cahaya tidak langsung
        (diffused light) yang merata, dengan intensitas sekitar <strong>300–500 lux</strong>.
        Hindari kondisi di mana layar jauh lebih terang dari ruangan sekitarnya (seperti bekerja di kamar gelap),
        karena kontras yang ekstrem membebani mata.
      </p>
    </div>

    <!-- Jarak pandang -->
    <div>
      <h3>Jarak Pandang yang Nyaman</h3>
      <p>
        Pertahankan jarak pandang antara mata dan layar sekitar <strong>50–70 cm</strong> (kurang lebih satu lengan).
        Jika kamu perlu lebih dekat karena teks terlalu kecil, perbesar ukuran teks daripada memajukan wajah ke layar.
      </p>
    </div>

  </div>
<?php };

renderMateri($meta, $content, $keyPoints);
