<?php
/**
 * K3 QUEST — Halaman Beranda (index.php)
 */
define('BASE_URL', '');
require_once __DIR__ . '/includes/init.php';
require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/footer.php';

renderHeader('Beranda', 'beranda');
?>

<!-- ═══════════════════════════════════════════
     HERO SECTION
═══════════════════════════════════════════ -->
<section class="w-full px-4 sm:px-6 lg:px-10 py-14 lg:py-20 relative overflow-hidden">
  <!-- Dekoratif blur background -->
  <div class="absolute -top-20 -right-20 w-96 h-96 bg-secondary-fixed/30 rounded-full blur-3xl -z-0 pointer-events-none"></div>
  <div class="absolute -bottom-10 -left-10 w-72 h-72 bg-surface-container/60 rounded-full blur-2xl -z-0 pointer-events-none"></div>

  <div class="max-w-6xl mx-auto grid grid-cols-1 lg:grid-cols-12 gap-12 items-center relative z-10">
    <!-- Kolom kiri: Copy -->
    <div class="lg:col-span-7 flex flex-col gap-5 fade-up">
      <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-pill bg-surface-container w-fit">
        <span class="material-symbols-outlined text-secondary icon-sm">terminal</span>
        <span class="section-label">Edukasi K3 · Software Engineering</span>
      </div>

      <div class="flex flex-col gap-3">
        <h1 class="text-4xl lg:text-5xl font-display font-extrabold text-primary-container leading-tight tracking-tight">
          Pahami K3,<br/>Kerja Lebih Aman.
        </h1>
        <p class="text-base text-on-surface-variant max-w-xl leading-relaxed">
          Pelajari prinsip keselamatan dan kesehatan kerja dalam dunia software engineering
          sebelum menguji pemahamanmu melalui kuis interaktif.
        </p>
      </div>

      <!-- CTA Buttons -->
      <div class="flex flex-wrap gap-3 pt-1">
        <a href="identitas.php" class="btn btn-primary btn-lg">
          <span class="material-symbols-outlined icon-md">play_circle</span>
          Mulai Belajar
        </a>
        <a href="#tentang-k3" class="btn btn-secondary btn-lg">
          <span class="material-symbols-outlined icon-md text-secondary">info</span>
          Pelajari K3
        </a>
      </div>

      <!-- Prasyarat info card -->
      <div class="flex items-start gap-3 p-4 rounded-2xl bg-secondary-fixed/30 border border-secondary-fixed max-w-xl mt-1">
        <span class="material-symbols-outlined text-secondary icon-lg flex-shrink-0 mt-0.5">lock_clock</span>
        <div>
          <p class="font-display font-semibold text-sm text-on-secondary-fixed-variant mb-0.5">Prasyarat Wajib</p>
          <p class="text-sm text-on-surface-variant">Pelajari seluruh 4 modul materi secara berurutan. Kuis hanya bisa diakses setelah semua materi selesai dipelajari.</p>
        </div>
      </div>
    </div>

    <!-- Kolom kanan: Ilustrasi SVG Ergonomis -->
    <div class="lg:col-span-5 fade-up delay-2">
      <div class="card p-5 flex flex-col gap-4">
        <div class="flex items-center justify-between">
          <div class="flex items-center gap-2">
            <span class="w-3 h-3 rounded-full bg-secondary"></span>
            <span class="text-xs text-on-surface-variant font-semibold">Ergonomic Workstation</span>
          </div>
          <span class="badge badge-teal">ISO 9241-5</span>
        </div>
        <!-- SVG Ilustrasi Developer -->
        <div class="w-full flex items-center justify-center py-2 bg-surface-container-low rounded-xl">
          <svg class="w-full max-w-xs h-auto" viewBox="0 0 360 270" fill="none" xmlns="http://www.w3.org/2000/svg">
            <!-- Grid lines -->
            <line x1="20" y1="250" x2="340" y2="250" stroke="#193B46" stroke-opacity="0.10" stroke-width="1.5"/>
            <!-- Desk -->
            <rect x="60" y="150" width="210" height="10" rx="3" fill="#193B46"/>
            <rect x="80" y="160" width="10" height="85" rx="2" fill="#84A5B2" opacity="0.7"/>
            <rect x="250" y="160" width="10" height="85" rx="2" fill="#84A5B2" opacity="0.7"/>
            <!-- Monitor stand -->
            <rect x="162" y="135" width="16" height="15" fill="#84A5B2"/>
            <rect x="148" y="147" width="44" height="4" rx="2" fill="#193B46"/>
            <!-- Monitor -->
            <rect x="122" y="75" width="116" height="70" rx="5" fill="#002530"/>
            <rect x="128" y="81" width="104" height="58" rx="3" fill="#EEF4F8"/>
            <!-- Code lines on screen -->
            <rect x="134" y="87" width="35" height="4" rx="1.5" fill="#396662"/>
            <rect x="134" y="95" width="55" height="3" rx="1.5" fill="#84A5B2"/>
            <rect x="140" y="101" width="42" height="3" rx="1.5" fill="#84A5B2"/>
            <rect x="134" y="107" width="28" height="3" rx="1.5" fill="#396662"/>
            <rect x="134" y="113" width="48" height="3" rx="1.5" fill="#84A5B2"/>
            <rect x="140" y="119" width="30" height="3" rx="1.5" fill="#193B46" opacity="0.5"/>
            <!-- Keyboard -->
            <rect x="130" y="153" width="90" height="12" rx="3" fill="#193B46" opacity="0.4"/>
            <!-- Chair back -->
            <path d="M278 138 C278 123 263 112 248 112" stroke="#193B46" stroke-width="7" stroke-linecap="round"/>
            <!-- Chair seat -->
            <path d="M253 172 L285 172" stroke="#193B46" stroke-width="7" stroke-linecap="round"/>
            <!-- Chair leg -->
            <path d="M271 177 L271 240" stroke="#396662" stroke-width="6"/>
            <path d="M250 242 L292 242" stroke="#396662" stroke-width="5" stroke-linecap="round"/>
            <circle cx="250" cy="247" r="4" fill="#002530"/>
            <circle cx="292" cy="247" r="4" fill="#002530"/>
            <!-- Person: Head -->
            <circle cx="238" cy="78" r="16" fill="#193B46"/>
            <!-- Torso -->
            <path d="M238 96 C240 118 244 140 249 168" stroke="#193B46" stroke-width="13" stroke-linecap="round"/>
            <!-- Thigh -->
            <path d="M249 168 L198 170" stroke="#193B46" stroke-width="13" stroke-linecap="round"/>
            <!-- Lower leg -->
            <path d="M198 170 L200 242" stroke="#193B46" stroke-width="10" stroke-linecap="round"/>
            <!-- Arm -->
            <path d="M238 110 L222 145 L185 148" stroke="#396662" stroke-width="6" stroke-linecap="round" stroke-linejoin="round"/>
            <!-- Sightline -->
            <line x1="226" y1="78" x2="150" y2="78" stroke="#396662" stroke-dasharray="4 3" stroke-width="1.5" opacity="0.6"/>
            <!-- Checkmark badges -->
            <circle cx="148" cy="68" r="11" fill="#BCECE7"/>
            <path d="M144 68 L147 71 L153 65" stroke="#102521" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            <circle cx="222" cy="140" r="11" fill="#BCECE7"/>
            <path d="M218 140 L221 143 L227 137" stroke="#102521" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            <circle cx="272" cy="135" r="11" fill="#BCECE7"/>
            <path d="M268 135 L271 138 L277 132" stroke="#102521" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            <circle cx="203" cy="252" r="11" fill="#BCECE7"/>
            <path d="M199 252 L202 255 L208 249" stroke="#102521" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
        </div>
        <!-- Metric strip -->
        <div class="grid grid-cols-3 gap-2">
          <div class="p-2.5 rounded-xl bg-surface-container text-center">
            <p class="text-[10px] text-on-surface-variant font-medium">Sudut Siku</p>
            <p class="font-display font-bold text-primary text-sm">90–100°</p>
          </div>
          <div class="p-2.5 rounded-xl bg-surface-container text-center">
            <p class="text-[10px] text-on-surface-variant font-medium">Jarak Layar</p>
            <p class="font-display font-bold text-primary text-sm">50–70 cm</p>
          </div>
          <div class="p-2.5 rounded-xl bg-surface-container text-center">
            <p class="text-[10px] text-on-surface-variant font-medium">Siklus Rehat</p>
            <p class="font-display font-bold text-primary text-sm">20 menit</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ═══════════════════════════════════════════
     SECTION: Mengapa K3 Penting?
═══════════════════════════════════════════ -->
<section id="tentang-k3" class="w-full bg-surface-container-low px-4 sm:px-6 lg:px-10 py-14">
  <div class="max-w-6xl mx-auto flex flex-col gap-8">
    <div class="flex flex-col gap-2 max-w-2xl">
      <span class="section-label">Latar Belakang</span>
      <h2 class="font-display text-3xl font-bold text-primary">Mengapa K3 Penting bagi Software Engineer?</h2>
      <p class="text-on-surface-variant">Pekerjaan coding tidak melibatkan alat berat, namun paparan layar tanpa henti, postur statis berjam-jam, dan tekanan deadline dapat menimbulkan risiko yang nyata.</p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
      <?php
      $riskCards = [
        ['icon'=>'front_hand','title'=>'RSI & Carpal Tunnel','desc'=>'Cedera regangan berulang pada pergelangan tangan akibat posisi mengetik yang tidak netral.','tip'=>'Gunakan wrist rest yang netral'],
        ['icon'=>'visibility','title'=>'Computer Vision Syndrome','desc'=>'Mata lelah, kering, dan pusing akibat menatap layar terlalu lama tanpa istirahat.','tip'=>'Terapkan aturan 20-20-20'],
        ['icon'=>'bolt','title'=>'Risiko Listrik','desc'=>'Kabel rusak, stopkontak kelebihan beban, dan cairan dekat perangkat menjadi potensi bahaya.','tip'=>'Periksa perangkat secara rutin'],
        ['icon'=>'psychology','title'=>'Burnout & Stres','desc'=>'Deadline ketat dan jam kerja panjang tanpa istirahat cukup dapat menyebabkan kelelahan mental.','tip'=>'Kelola prioritas dan istirahat'],
      ];
      foreach ($riskCards as $i => $card): ?>
      <div class="card card-hover p-5 flex flex-col gap-3 fade-up delay-<?= $i+1 ?>">
        <div class="w-10 h-10 rounded-xl bg-secondary-fixed/50 flex items-center justify-center">
          <span class="material-symbols-outlined text-secondary icon-lg"><?= $card['icon'] ?></span>
        </div>
        <h3 class="font-display font-bold text-base text-primary-container"><?= $card['title'] ?></h3>
        <p class="text-sm text-on-surface-variant leading-relaxed flex-1"><?= $card['desc'] ?></p>
        <span class="inline-flex items-center gap-1 text-secondary font-semibold text-xs">
          <span class="material-symbols-outlined icon-sm">tips_and_updates</span>
          <?= $card['tip'] ?>
        </span>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ═══════════════════════════════════════════
     SECTION: Materi Pembelajaran
═══════════════════════════════════════════ -->
<section id="materi-belajar" class="w-full px-4 sm:px-6 lg:px-10 py-14">
  <div class="max-w-6xl mx-auto flex flex-col gap-8">
    <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4">
      <div class="flex flex-col gap-2">
        <span class="section-label">4 Modul Interaktif</span>
        <h2 class="font-display text-3xl font-bold text-primary">Materi Pembelajaran</h2>
        <p class="text-on-surface-variant text-sm">Pelajari keempat modul berikut sebelum mengerjakan kuis.</p>
      </div>
      <a href="pengantar.php" class="btn btn-secondary btn-sm self-start sm:self-auto">
        Lihat Semua Materi
        <span class="material-symbols-outlined icon-sm">arrow_forward</span>
      </a>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
      <?php
      $materiCards = [
        ['no'=>1,'icon'=>'chair','title'=>'Ergonomi dan Posisi Kerja','desc'=>'Atur posisi duduk, meja, dan monitor agar nyaman saat coding seharian.','href'=>'materi/ergonomi.php','color'=>'bg-blue-50 text-blue-700'],
        ['no'=>2,'icon'=>'visibility','title'=>'Kesehatan Mata','desc'=>'Lindungi matamu dari kelelahan dengan pengaturan layar yang tepat.','href'=>'materi/kesehatan-mata.php','color'=>'bg-emerald-50 text-emerald-700'],
        ['no'=>3,'icon'=>'bolt','title'=>'Keselamatan Listrik','desc'=>'Pahami cara aman menggunakan perangkat dan instalasi listrik di area kerja.','href'=>'materi/keselamatan-listrik.php','color'=>'bg-amber-50 text-amber-700'],
        ['no'=>4,'icon'=>'psychology','title'=>'Kesehatan Mental','desc'=>'Kelola stres dan deadline agar produktivitas dan kesejahteraan terjaga.','href'=>'materi/kesehatan-mental.php','color'=>'bg-purple-50 text-purple-700'],
      ];
      foreach ($materiCards as $i => $m): ?>
      <div class="card card-hover p-5 flex flex-col gap-4 fade-up delay-<?= $i+1 ?>">
        <div class="flex items-start justify-between">
          <div class="w-11 h-11 rounded-xl <?= $m['color'] ?> flex items-center justify-center">
            <span class="material-symbols-outlined icon-lg"><?= $m['icon'] ?></span>
          </div>
          <span class="badge badge-gray">Modul <?= $m['no'] ?></span>
        </div>
        <div class="flex flex-col gap-1 flex-1">
          <h3 class="font-display font-bold text-sm text-primary-container"><?= $m['title'] ?></h3>
          <p class="text-xs text-on-surface-variant leading-relaxed"><?= $m['desc'] ?></p>
        </div>
        <a href="<?= $m['href'] ?>" class="btn btn-outline-teal btn-sm">
          Pelajari
          <span class="material-symbols-outlined icon-sm">arrow_forward</span>
        </a>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ═══════════════════════════════════════════
     SECTION: Alur Pembelajaran
═══════════════════════════════════════════ -->
<section class="w-full bg-primary px-4 sm:px-6 lg:px-10 py-14">
  <div class="max-w-6xl mx-auto flex flex-col gap-8">
    <div class="text-center flex flex-col gap-2">
      <span class="section-label text-secondary-fixed-dim">Alur Pembelajaran</span>
      <h2 class="font-display text-3xl font-bold text-white">Cara Kerja K3 QUEST</h2>
      <p class="text-white/70 text-sm max-w-lg mx-auto">Ikuti alur ini untuk mendapatkan pengalaman belajar yang optimal dan terstruktur.</p>
    </div>

    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 lg:gap-6">
      <?php
      $steps = [
        ['icon'=>'menu_book','label'=>'01','title'=>'Pelajari Materi','desc'=>'Baca 4 modul K3 secara lengkap dan berurutan'],
        ['icon'=>'summarize','label'=>'02','title'=>'Baca Ringkasan','desc'=>'Tinjau poin-poin penting dari setiap materi'],
        ['icon'=>'quiz','label'=>'03','title'=>'Kerjakan Kuis','desc'=>'Uji pemahamanmu dengan 10 soal pilihan ganda'],
        ['icon'=>'workspace_premium','label'=>'04','title'=>'Lihat Hasil','desc'=>'Cek skor, review jawaban, dan pembahasan'],
      ];
      foreach ($steps as $s): ?>
      <div class="flex flex-col gap-3 text-center p-4 rounded-2xl bg-white/5 border border-white/10">
        <div class="w-12 h-12 rounded-2xl bg-secondary-fixed/20 flex items-center justify-center mx-auto">
          <span class="material-symbols-outlined text-secondary-fixed icon-xl"><?= $s['icon'] ?></span>
        </div>
        <div>
          <span class="text-secondary-fixed-dim text-xs font-display font-bold tracking-widest"><?= $s['label'] ?></span>
          <h3 class="font-display font-bold text-white text-sm mt-0.5"><?= $s['title'] ?></h3>
          <p class="text-white/60 text-xs leading-relaxed mt-1"><?= $s['desc'] ?></p>
        </div>
      </div>
      <?php endforeach; ?>
    </div>

    <!-- CTA -->
    <div class="text-center pt-2">
      <a href="identitas.php" class="btn btn-lg" style="background:#BCECE7;color:#102521;">
        <span class="material-symbols-outlined icon-md">play_circle</span>
        Mulai Pembelajaran Sekarang
      </a>
    </div>
  </div>
</section>

<!-- ═══════════════════════════════════════════
     SECTION: Preview Kuis
═══════════════════════════════════════════ -->
<section class="w-full px-4 sm:px-6 lg:px-10 py-14 bg-surface-container-low">
  <div class="max-w-3xl mx-auto text-center flex flex-col gap-6">
    <div class="flex flex-col gap-2">
      <span class="section-label">Evaluasi Pemahaman</span>
      <h2 class="font-display text-3xl font-bold text-primary">Preview Kuis K3</h2>
      <p class="text-on-surface-variant text-sm">Setelah mempelajari semua materi, uji pemahamanmu.</p>
    </div>
    <div class="grid grid-cols-3 gap-4">
      <?php
      $stats = [
        ['icon'=>'format_list_numbered','val'=>'10','label'=>'Pertanyaan'],
        ['icon'=>'check_box','val'=>'A–D','label'=>'Pilihan Ganda'],
        ['icon'=>'timer','val'=>'~5 mnt','label'=>'Estimasi Waktu'],
      ];
      foreach ($stats as $st): ?>
      <div class="card p-4 flex flex-col items-center gap-2">
        <span class="material-symbols-outlined text-secondary icon-xl"><?= $st['icon'] ?></span>
        <span class="font-display font-extrabold text-2xl text-primary"><?= $st['val'] ?></span>
        <span class="text-xs text-on-surface-variant font-medium"><?= $st['label'] ?></span>
      </div>
      <?php endforeach; ?>
    </div>
    <a href="identitas.php" class="btn btn-primary btn-lg mx-auto">
      <span class="material-symbols-outlined icon-md">school</span>
      Mulai Pembelajaran
    </a>
  </div>
</section>

<?php renderFooter(); ?>
