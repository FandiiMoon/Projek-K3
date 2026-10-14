<?php
/**
 * K3 QUEST — Template Helper untuk Halaman Materi
 * Menyediakan fungsi renderMateri() yang dipakai oleh setiap halaman materi.
 */

/**
 * Render halaman materi dengan konten yang diberikan.
 *
 * @param array $meta          Info materi: slug, no, title, subtitle, waktu, prev, next, nextLabel
 * @param callable $contentFn  Fungsi yang me-render konten utama materi (echo HTML)
 * @param array $keyPoints     Array string poin penting
 */
function renderMateri(array $meta, callable $contentFn, array $keyPoints): void {
    // Tandai materi sebagai selesai saat halaman ini dibuka
    tandaiMateriSelesai($meta['slug']);

    $progress     = getProgressMateri();
    $slugList     = ['ergonomi', 'kesehatan-mata', 'keselamatan-listrik', 'kesehatan-mental'];
    $jumlahSelesai = count(array_filter($progress));

    $breadcrumb = ['Materi K3' => BASE_URL . '/pengantar.php', $meta['title'] => null];
    renderHeader($meta['title'], 'materi', $breadcrumb);
?>

<main class="max-w-4xl mx-auto px-4 sm:px-6 py-10">

  <!-- Header materi -->
  <div class="flex flex-col gap-3 mb-8 fade-up">
    <div class="flex items-center gap-2">
      <span class="badge badge-primary">Modul <?= $meta['no'] ?></span>
      <span class="badge badge-teal">
        <span class="material-symbols-outlined icon-sm">schedule</span>
        <?= htmlspecialchars($meta['waktu']) ?>
      </span>
    </div>
    <h1 class="font-display text-3xl font-bold text-primary"><?= htmlspecialchars($meta['title']) ?></h1>
    <p class="text-on-surface-variant text-base"><?= htmlspecialchars($meta['subtitle']) ?></p>
    <!-- Progress bar modul -->
    <div class="flex items-center gap-3 mt-1">
      <div class="progress-wrap flex-1">
        <div class="progress-bar" style="width:<?= ($meta['no'] / 4) * 100 ?>%"></div>
      </div>
      <span class="text-xs text-on-surface-variant font-medium flex-shrink-0">Modul <?= $meta['no'] ?>/4</span>
    </div>
  </div>

  <!-- Konten materi -->
  <div class="card p-6 sm:p-8 mb-6 materi-content fade-up delay-1">
    <?php $contentFn(); ?>
  </div>

  <!-- Kartu Poin Penting -->
  <div class="key-point-card mb-8 fade-up delay-2">
    <div class="flex items-center gap-2 mb-4">
      <span class="material-symbols-outlined text-secondary icon-lg">star</span>
      <h2 class="font-display font-bold text-base text-primary-container">Poin Penting</h2>
    </div>
    <ul class="flex flex-col gap-2">
      <?php foreach ($keyPoints as $poin): ?>
      <li class="flex items-start gap-2.5 text-sm text-on-surface-variant">
        <span class="w-5 h-5 rounded-full bg-secondary flex items-center justify-center flex-shrink-0 mt-0.5">
          <span class="material-symbols-outlined text-white" style="font-size:13px;">check</span>
        </span>
        <span><?= htmlspecialchars($poin) ?></span>
      </li>
      <?php endforeach; ?>
    </ul>
  </div>

  <!-- Navigasi bawah -->
  <div class="flex flex-col sm:flex-row gap-3 justify-between fade-up delay-3">
    <div>
      <?php if ($meta['prev']): ?>
      <a href="<?= $meta['prev']['href'] ?>" class="btn btn-secondary">
        <span class="material-symbols-outlined icon-sm">arrow_back</span>
        <?= htmlspecialchars($meta['prev']['label']) ?>
      </a>
      <?php else: ?>
      <a href="<?= BASE_URL ?>/pengantar.php" class="btn btn-secondary">
        <span class="material-symbols-outlined icon-sm">arrow_back</span>
        Pengantar
      </a>
      <?php endif; ?>
    </div>
    <div>
      <?php if ($meta['next']): ?>
      <a href="<?= $meta['next']['href'] ?>" class="btn btn-primary">
        <?= htmlspecialchars($meta['next']['label']) ?>
        <span class="material-symbols-outlined icon-sm">arrow_forward</span>
      </a>
      <?php else: ?>
      <a href="<?= BASE_URL ?>/ringkasan.php" class="btn btn-primary">
        Lanjut ke Ringkasan
        <span class="material-symbols-outlined icon-sm">arrow_forward</span>
      </a>
      <?php endif; ?>
    </div>
  </div>
</main>

<?php
    renderFooter();
}
