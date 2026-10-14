<?php
/**
 * K3 QUEST — Pengantar Pembelajaran (pengantar.php)
 */
define('BASE_URL', '');
require_once __DIR__ . '/includes/init.php';
require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/footer.php';

// Harus mengisi identitas dulu
if (!sudahIdentitas()) {
    redirect('identitas.php');
}

$progress = getProgressMateri();
$jumlahSelesai = count(array_filter($progress));
$persenSelesai = ($jumlahSelesai / 4) * 100;

renderHeader('Pengantar Pembelajaran', 'materi', ['Materi K3' => null]);
?>

<main class="max-w-4xl mx-auto px-4 sm:px-6 py-10">

  <!-- Greeting -->
  <div class="flex flex-col gap-2 mb-8 fade-up">
    <span class="section-label">Selamat Datang, <?= e(sess('peserta_nama')) ?>!</span>
    <h1 class="font-display text-3xl font-bold text-primary">Kenali K3 Software Engineering</h1>
    <p class="text-on-surface-variant leading-relaxed max-w-2xl">
      K3 (Keselamatan dan Kesehatan Kerja) adalah hak sekaligus tanggung jawab setiap pekerja,
      termasuk <em>software engineer</em>. Meski tidak bersentuhan dengan mesin berat,
      pekerjaan coding melibatkan risiko ergonomi, kesehatan mata, keselamatan listrik,
      dan kesehatan mental yang nyata jika tidak dikelola dengan baik.
    </p>
  </div>

  <!-- Progress -->
  <div class="card p-5 mb-8 fade-up delay-1">
    <div class="flex items-center justify-between mb-3">
      <span class="font-display font-semibold text-sm text-primary-container">Progress Pembelajaran</span>
      <span class="badge badge-teal"><?= $jumlahSelesai ?>/4 Selesai</span>
    </div>
    <div class="progress-wrap">
      <div class="progress-bar" data-progress="<?= $persenSelesai ?>" style="width:<?= $persenSelesai ?>%"></div>
    </div>
    <p class="text-xs text-on-surface-variant mt-2">
      <?= $jumlahSelesai === 4 ? 'Semua materi sudah selesai! Kamu siap mengerjakan kuis.' : 'Pelajari semua materi untuk membuka kuis.' ?>
    </p>
  </div>

  <!-- Roadmap materi -->
  <div class="flex flex-col gap-4 mb-8">
    <h2 class="font-display font-bold text-lg text-primary-container">Roadmap Materi</h2>
    <?php
    $materiList = [
      [
        'no'     => 1,
        'slug'   => 'ergonomi',
        'icon'   => 'chair',
        'title'  => 'Ergonomi dan Posisi Kerja',
        'desc'   => 'Pelajari cara mengatur posisi duduk, meja, dan monitor agar nyaman dan tidak menimbulkan cedera.',
        'waktu'  => '~8 menit',
        'href'   => 'materi/ergonomi.php',
      ],
      [
        'no'     => 2,
        'slug'   => 'kesehatan-mata',
        'icon'   => 'visibility',
        'title'  => 'Kesehatan Mata',
        'desc'   => 'Pahami penyebab kelelahan mata dan cara menjaganya saat bekerja di depan layar.',
        'waktu'  => '~7 menit',
        'href'   => 'materi/kesehatan-mata.php',
      ],
      [
        'no'     => 3,
        'slug'   => 'keselamatan-listrik',
        'icon'   => 'bolt',
        'title'  => 'Keselamatan Listrik dan Perangkat',
        'desc'   => 'Ketahui cara aman menggunakan perangkat elektronik dan menghindari bahaya listrik di tempat kerja.',
        'waktu'  => '~7 menit',
        'href'   => 'materi/keselamatan-listrik.php',
      ],
      [
        'no'     => 4,
        'slug'   => 'kesehatan-mental',
        'icon'   => 'psychology',
        'title'  => 'Kesehatan Mental dan Manajemen Stres',
        'desc'   => 'Pelajari cara mengelola stres, deadline, dan menjaga keseimbangan kerja-kehidupan.',
        'waktu'  => '~8 menit',
        'href'   => 'materi/kesehatan-mental.php',
      ],
    ];
    foreach ($materiList as $i => $m):
      $selesai = $progress[$m['slug']] ?? false;
    ?>
    <div class="card p-5 flex items-start gap-4 fade-up delay-<?= $i+1 ?> <?= $selesai ? 'border-correct/30 bg-correct-bg/30' : '' ?>">
      <!-- Nomor / status -->
      <div class="flex-shrink-0 w-10 h-10 rounded-xl flex items-center justify-center font-display font-bold text-sm
                  <?= $selesai ? 'bg-correct text-white' : 'bg-surface-container text-on-surface-variant' ?>">
        <?php if ($selesai): ?>
          <span class="material-symbols-outlined icon-md">check</span>
        <?php else: ?>
          <?= $m['no'] ?>
        <?php endif; ?>
      </div>
      <!-- Konten -->
      <div class="flex-1 min-w-0">
        <div class="flex items-start justify-between gap-2 flex-wrap">
          <h3 class="font-display font-bold text-sm text-primary-container"><?= $m['title'] ?></h3>
          <div class="flex items-center gap-2 flex-shrink-0">
            <span class="badge <?= $selesai ? 'badge-mint' : 'badge-gray' ?>">
              <?= $selesai ? '✓ Selesai' : 'Belum dipelajari' ?>
            </span>
          </div>
        </div>
        <p class="text-xs text-on-surface-variant mt-1 leading-relaxed"><?= $m['desc'] ?></p>
        <div class="flex items-center gap-4 mt-2">
          <span class="flex items-center gap-1 text-xs text-on-surface-variant">
            <span class="material-symbols-outlined icon-sm">schedule</span>
            <?= $m['waktu'] ?>
          </span>
          <a href="<?= $m['href'] ?>" class="btn btn-sm <?= $selesai ? 'btn-secondary' : 'btn-primary' ?>">
            <?= $selesai ? 'Baca Ulang' : 'Pelajari' ?>
            <span class="material-symbols-outlined icon-sm">arrow_forward</span>
          </a>
        </div>
      </div>
    </div>
    <?php endforeach; ?>
  </div>

  <!-- CTA -->
  <div class="flex flex-col sm:flex-row gap-3 fade-up">
    <a href="materi/ergonomi.php" class="btn btn-primary btn-lg">
      <span class="material-symbols-outlined icon-md">play_circle</span>
      Mulai Pelajari Materi
    </a>
    <?php if ($jumlahSelesai === 4): ?>
    <a href="ringkasan.php" class="btn btn-secondary btn-lg">
      <span class="material-symbols-outlined icon-md">summarize</span>
      Lanjut ke Ringkasan
    </a>
    <?php endif; ?>
  </div>
</main>

<?php renderFooter(); ?>
