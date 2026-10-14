<?php
/**
 * K3 QUEST - Header Template
 * Dipanggil di awal setiap halaman
 *
 * @param string $pageTitle    Judul tab browser
 * @param string $activePage   Slug halaman aktif untuk nav: beranda|materi|tentang
 * @param array  $breadcrumb   Array ['label' => 'url'] untuk breadcrumb (opsional)
 */
function renderHeader(string $pageTitle = 'K3 QUEST', string $activePage = 'beranda', array $breadcrumb = []): void {
    $pesertaNama  = e(sess('peserta_nama', ''));
    $pesertaKelas = e(sess('peserta_kelas', ''));
    $fullTitle    = e($pageTitle) . ' — K3 QUEST';
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <meta name="description" content="K3 QUEST — Platform edukasi Keselamatan dan Kesehatan Kerja untuk siswa SMK Rekayasa Perangkat Lunak."/>
  <title><?= $fullTitle ?></title>

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com"/>
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Plus+Jakarta+Sans:wght@600;700;800&display=swap" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet"/>

  <!-- Tailwind CDN -->
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
  tailwind.config = {
    theme: {
      extend: {
        colors: {
          'primary':                '#002530',
          'primary-container':      '#193B46',
          'on-primary':             '#ffffff',
          'secondary':              '#396662',
          'secondary-fixed':        '#BCECE7',
          'secondary-fixed-dim':    '#A1CFCB',
          'on-secondary-fixed':     '#00201E',
          'on-secondary-fixed-variant': '#204E4B',
          'surface':                '#F4FAFE',
          'surface-bright':         '#F4FAFE',
          'surface-container-lowest': '#ffffff',
          'surface-container-low':  '#EEF4F8',
          'surface-container':      '#E9EFF3',
          'surface-container-high': '#E3E9ED',
          'surface-container-highest': '#DDE3E7',
          'on-surface':             '#161C1F',
          'on-surface-variant':     '#41484B',
          'outline':                '#72787B',
          'outline-variant':        '#C1C7CB',
          'error':                  '#BA1A1A',
          'error-container':        '#FFDAD6',
          'correct':                '#23866D',
          'correct-bg':             '#D8F0E8',
          'wrong':                  '#D9535D',
          'wrong-bg':               '#FFEAEB',
        },
        fontFamily: {
          'sans': ['Inter', 'system-ui', 'sans-serif'],
          'display': ['Plus Jakarta Sans', 'sans-serif'],
        },
        borderRadius: {
          'card': '14px',
          'btn':  '10px',
          'pill': '9999px',
        },
        boxShadow: {
          'card': '0 1px 4px rgba(23,43,52,0.06), 0 4px 16px rgba(23,43,52,0.04)',
          'card-hover': '0 4px 16px rgba(23,43,52,0.10)',
          'header': '0 1px 8px rgba(23,43,52,0.05)',
        },
      }
    }
  }
  </script>

  <!-- Custom CSS -->
  <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style.css"/>
</head>
<body class="bg-surface text-on-surface font-sans antialiased">

<!-- ═══════════════════════════════════════════
     HEADER / NAVIGATION
═══════════════════════════════════════════ -->
<header class="fixed top-0 left-0 right-0 z-50 bg-surface-container-lowest/95 backdrop-blur-md shadow-header border-b border-outline-variant/30">
  <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-10 h-16 flex items-center justify-between gap-4">

    <!-- Logo -->
    <a href="<?= BASE_URL ?>/index.php" class="flex items-center gap-2.5 flex-shrink-0" aria-label="K3 QUEST Beranda">
      <div class="w-9 h-9 rounded-xl bg-primary-container flex items-center justify-center flex-shrink-0">
        <svg class="w-5 h-5 text-white" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M12 2L3 6V12C3 16.55 6.84 20.74 12 22C17.16 20.74 21 16.55 21 12V6L12 2Z" fill="currentColor" opacity="0.9"/>
          <path d="M9 12l2 2 4-4" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
          <circle cx="8" cy="9" r="1" fill="white" opacity="0.6"/>
          <circle cx="16" cy="9" r="1" fill="white" opacity="0.6"/>
        </svg>
      </div>
      <div class="hidden sm:flex flex-col leading-tight">
        <span class="font-display font-bold text-primary text-base tracking-tight">K3 QUEST</span>
        <span class="text-[10px] text-on-surface-variant font-medium tracking-wide">Software Engineering</span>
      </div>
    </a>

    <!-- Desktop Nav -->
    <nav class="hidden md:flex items-center gap-1" aria-label="Navigasi utama">
      <?php
      $navItems = [
          ['label' => 'Beranda',   'href' => BASE_URL . '/index.php',   'slug' => 'beranda'],
          ['label' => 'Materi K3', 'href' => BASE_URL . '/pengantar.php', 'slug' => 'materi'],
          ['label' => 'Tentang',   'href' => BASE_URL . '/tentang.php',  'slug' => 'tentang'],
      ];
      foreach ($navItems as $item):
          $isActive = ($activePage === $item['slug']);
      ?>
      <a href="<?= $item['href'] ?>"
         class="px-4 py-2 rounded-btn text-sm font-semibold transition-all duration-200
                <?= $isActive
                    ? 'bg-primary-container text-white'
                    : 'text-on-surface-variant hover:bg-surface-container hover:text-on-surface' ?>"
         <?= $isActive ? 'aria-current="page"' : '' ?>>
        <?= $item['label'] ?>
      </a>
      <?php endforeach; ?>
    </nav>

    <!-- Right: peserta info + hamburger -->
    <div class="flex items-center gap-3">
      <?php if ($pesertaNama): ?>
      <div class="hidden sm:flex items-center gap-2 px-3 py-1.5 rounded-pill bg-secondary-fixed/50 text-on-secondary-fixed-variant">
        <span class="material-symbols-outlined text-[16px] text-secondary">person</span>
        <span class="text-xs font-semibold"><?= $pesertaNama ?></span>
        <?php if ($pesertaKelas): ?>
        <span class="text-xs text-on-surface-variant">· <?= $pesertaKelas ?></span>
        <?php endif; ?>
      </div>
      <?php endif; ?>

      <!-- Hamburger (mobile) -->
      <button id="menuToggle" type="button" aria-label="Buka menu" aria-expanded="false" aria-controls="mobileMenu"
              class="md:hidden p-2 rounded-btn text-on-surface-variant hover:bg-surface-container transition-colors">
        <span class="material-symbols-outlined text-[22px]">menu</span>
      </button>
    </div>
  </div>

  <!-- Mobile Menu -->
  <div id="mobileMenu" class="md:hidden hidden border-t border-outline-variant/30 bg-surface-container-lowest" role="navigation" aria-label="Menu mobile">
    <div class="max-w-6xl mx-auto px-4 py-3 flex flex-col gap-1">
      <?php foreach ($navItems as $item):
          $isActive = ($activePage === $item['slug']); ?>
      <a href="<?= $item['href'] ?>"
         class="px-4 py-3 rounded-btn text-sm font-semibold transition-colors
                <?= $isActive
                    ? 'bg-primary-container text-white'
                    : 'text-on-surface-variant hover:bg-surface-container hover:text-on-surface' ?>">
        <?= $item['label'] ?>
      </a>
      <?php endforeach; ?>
      <?php if ($pesertaNama): ?>
      <div class="mt-2 px-4 py-3 rounded-btn bg-surface-container text-xs text-on-surface-variant font-medium">
        Peserta: <strong class="text-on-surface"><?= $pesertaNama ?></strong> · <?= $pesertaKelas ?>
      </div>
      <?php endif; ?>
    </div>
  </div>
</header>

<!-- Spacer for fixed header -->
<div class="h-16"></div>

<?php if (!empty($breadcrumb)): ?>
<!-- ═══════════════════════════════════════════
     BREADCRUMB
═══════════════════════════════════════════ -->
<div class="bg-surface-container-low border-b border-outline-variant/20">
  <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-10 py-2.5">
    <nav aria-label="Breadcrumb" class="flex items-center gap-1.5 text-xs text-on-surface-variant flex-wrap">
      <a href="<?= BASE_URL ?>/index.php" class="hover:text-secondary transition-colors font-medium">Beranda</a>
      <?php foreach ($breadcrumb as $label => $url): ?>
      <span class="material-symbols-outlined text-[14px] opacity-40">chevron_right</span>
      <?php if ($url): ?>
      <a href="<?= e($url) ?>" class="hover:text-secondary transition-colors font-medium"><?= e($label) ?></a>
      <?php else: ?>
      <span class="text-on-surface font-semibold"><?= e($label) ?></span>
      <?php endif; ?>
      <?php endforeach; ?>
    </nav>
  </div>
</div>
<?php endif; ?>

<?php
} // end renderHeader
