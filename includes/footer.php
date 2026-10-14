<?php
/**
 * K3 QUEST - Footer Template
 */
function renderFooter(): void {
    $year = date('Y');
?>
<!-- ═══════════════════════════════════════════
     FOOTER
═══════════════════════════════════════════ -->
<footer class="mt-16 bg-primary text-white">
  <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-10 py-10">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

      <!-- Brand -->
      <div class="flex flex-col gap-3">
        <div class="flex items-center gap-2.5">
          <div class="w-9 h-9 rounded-xl bg-white/10 flex items-center justify-center">
            <svg class="w-5 h-5 text-white" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M12 2L3 6V12C3 16.55 6.84 20.74 12 22C17.16 20.74 21 16.55 21 12V6L12 2Z" fill="currentColor" opacity="0.9"/>
              <path d="M9 12l2 2 4-4" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
          </div>
          <span class="font-display font-bold text-lg tracking-tight">K3 QUEST</span>
        </div>
        <p class="text-sm text-white/70 leading-relaxed">
          Platform edukasi Keselamatan dan Kesehatan Kerja (K3) untuk siswa SMK Rekayasa Perangkat Lunak.
        </p>
        <p class="text-xs text-white/50">
          Dibuat untuk keperluan edukasi — Tahun <?= $year ?>
        </p>
      </div>

      <!-- Materi Links -->
      <div class="flex flex-col gap-3">
        <h4 class="font-display font-semibold text-sm text-white/90 uppercase tracking-wider">Materi K3</h4>
        <ul class="flex flex-col gap-2">
          <?php
          $materiLinks = [
              'Ergonomi dan Posisi Kerja'        => BASE_URL . '/materi/ergonomi.php',
              'Kesehatan Mata'                   => BASE_URL . '/materi/kesehatan-mata.php',
              'Keselamatan Listrik dan Perangkat' => BASE_URL . '/materi/keselamatan-listrik.php',
              'Kesehatan Mental dan Stres'        => BASE_URL . '/materi/kesehatan-mental.php',
          ];
          foreach ($materiLinks as $label => $href): ?>
          <li>
            <a href="<?= $href ?>" class="text-sm text-white/65 hover:text-white transition-colors flex items-center gap-1.5">
              <span class="material-symbols-outlined text-[13px] opacity-60">arrow_right</span>
              <?= htmlspecialchars($label, ENT_QUOTES) ?>
            </a>
          </li>
          <?php endforeach; ?>
        </ul>
      </div>

      <!-- Navigasi -->
      <div class="flex flex-col gap-3">
        <h4 class="font-display font-semibold text-sm text-white/90 uppercase tracking-wider">Navigasi</h4>
        <ul class="flex flex-col gap-2">
          <?php
          $navLinks = [
              'Beranda'             => BASE_URL . '/index.php',
              'Pengantar Belajar'   => BASE_URL . '/pengantar.php',
              'Ringkasan Materi'    => BASE_URL . '/ringkasan.php',
              'Kuis K3'             => BASE_URL . '/kuis.php',
              'Tentang'             => BASE_URL . '/tentang.php',
          ];
          foreach ($navLinks as $label => $href): ?>
          <li>
            <a href="<?= $href ?>" class="text-sm text-white/65 hover:text-white transition-colors flex items-center gap-1.5">
              <span class="material-symbols-outlined text-[13px] opacity-60">arrow_right</span>
              <?= htmlspecialchars($label, ENT_QUOTES) ?>
            </a>
          </li>
          <?php endforeach; ?>
        </ul>
      </div>
    </div>

    <!-- Bottom bar -->
    <div class="mt-8 pt-6 border-t border-white/10 flex flex-col sm:flex-row items-center justify-between gap-3 text-xs text-white/40">
      <span>© <?= $year ?> K3 QUEST · Media Pembelajaran K3 SMK RPL</span>
      <span class="flex items-center gap-1.5">
        <span class="material-symbols-outlined text-[14px]">school</span>
        Pahami K3, Kerja Lebih Aman.
      </span>
    </div>
  </div>
</footer>

<!-- App JS -->
<script src="<?= BASE_URL ?>/assets/js/app.js"></script>
</body>
</html>
<?php
} // end renderFooter
