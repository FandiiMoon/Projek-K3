<?php
/**
 * K3 QUEST — Halaman Identitas Peserta (identitas.php)
 * Peserta mengisi nama dan kelas sebelum mulai belajar
 */
define('BASE_URL', '');
require_once __DIR__ . '/includes/init.php';
require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/footer.php';

$errors = [];
$nama   = '';
$kelas  = '';

// Proses form
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama  = trim($_POST['nama']  ?? '');
    $kelas = trim($_POST['kelas'] ?? '');

    if ($nama === '') {
        $errors['nama'] = 'Nama lengkap wajib diisi.';
    } elseif (strlen($nama) > 100) {
        $errors['nama'] = 'Nama terlalu panjang (maksimal 100 karakter).';
    }

    if ($kelas === '') {
        $errors['kelas'] = 'Kelas wajib diisi.';
    } elseif (strlen($kelas) > 50) {
        $errors['kelas'] = 'Kelas terlalu panjang (maksimal 50 karakter).';
    }

    if (empty($errors)) {
        // Simpan ke session
        $_SESSION['peserta_nama']  = $nama;
        $_SESSION['peserta_kelas'] = $kelas;

        // Simpan ke database jika tersedia
        if (isDBAvailable()) {
            $db   = getDB();
            $stmt = $db->prepare('INSERT INTO peserta (nama, kelas) VALUES (:nama, :kelas)');
            $stmt->execute([':nama' => $nama, ':kelas' => $kelas]);
            $_SESSION['peserta_id'] = $db->lastInsertId();
        }

        // Reset progress materi untuk sesi baru
        $_SESSION['materi_selesai'] = [
            'ergonomi'            => false,
            'kesehatan-mata'      => false,
            'keselamatan-listrik' => false,
            'kesehatan-mental'    => false,
        ];

        redirect('pengantar.php');
    }
}

renderHeader('Identitas Peserta', 'beranda');
?>

<main class="min-h-screen flex items-center justify-center px-4 py-12">
  <div class="w-full max-w-md">

    <!-- Header card -->
    <div class="text-center flex flex-col gap-3 mb-8 fade-up">
      <div class="w-16 h-16 rounded-2xl bg-primary-container flex items-center justify-center mx-auto shadow-card">
        <span class="material-symbols-outlined text-white icon-xl">person_add</span>
      </div>
      <h1 class="font-display font-bold text-2xl text-primary">Sebelum Memulai</h1>
      <p class="text-on-surface-variant text-sm">Isi identitasmu sebelum mempelajari materi K3.</p>
    </div>

    <!-- Form card -->
    <div class="card p-6 sm:p-8 fade-up delay-1">
      <?php if (!empty($errors)): ?>
      <div class="alert alert-error mb-5">
        <span class="material-symbols-outlined icon-md flex-shrink-0">error</span>
        <span>Mohon periksa kembali isian formulir di bawah ini.</span>
      </div>
      <?php endif; ?>

      <form method="POST" id="formIdentitas" novalidate>
        <!-- Nama Lengkap -->
        <div class="mb-4">
          <label class="form-label" for="nama">Nama Lengkap <span class="text-wrong">*</span></label>
          <input
            type="text"
            id="nama"
            name="nama"
            value="<?= e($nama) ?>"
            class="form-input <?= isset($errors['nama']) ? 'error' : '' ?>"
            placeholder="Masukkan nama lengkap kamu"
            maxlength="100"
            autocomplete="name"
            required
          />
          <?php if (isset($errors['nama'])): ?>
          <p class="form-error" id="namaError"><?= e($errors['nama']) ?></p>
          <?php else: ?>
          <p class="form-error" id="namaError"></p>
          <?php endif; ?>
        </div>

        <!-- Kelas -->
        <div class="mb-6">
          <label class="form-label" for="kelas">Kelas <span class="text-wrong">*</span></label>
          <input
            type="text"
            id="kelas"
            name="kelas"
            value="<?= e($kelas) ?>"
            class="form-input <?= isset($errors['kelas']) ? 'error' : '' ?>"
            placeholder="Contoh: XII RPL 1"
            maxlength="50"
            required
          />
          <?php if (isset($errors['kelas'])): ?>
          <p class="form-error" id="kelasError"><?= e($errors['kelas']) ?></p>
          <?php else: ?>
          <p class="form-error" id="kelasError"></p>
          <?php endif; ?>
        </div>

        <!-- Info note -->
        <div class="alert alert-info mb-6">
          <span class="material-symbols-outlined icon-md flex-shrink-0">info</span>
          <span class="text-xs">Data ini hanya digunakan untuk menampilkan namamu pada hasil kuis. Tidak ada data sensitif yang diminta.</span>
        </div>

        <button type="submit" class="btn btn-primary btn-lg btn-full">
          <span class="material-symbols-outlined icon-md">play_arrow</span>
          Mulai Belajar
        </button>
      </form>

      <div class="mt-4 text-center">
        <a href="index.php" class="text-sm text-on-surface-variant hover:text-secondary transition-colors">
          ← Kembali ke Beranda
        </a>
      </div>
    </div>

    <!-- Progress preview -->
    <div class="mt-6 flex items-center gap-2 justify-center text-xs text-on-surface-variant fade-up delay-2">
      <span class="material-symbols-outlined icon-sm">route</span>
      <span>Identitas → Pengantar → Materi (4) → Ringkasan → Kuis → Hasil</span>
    </div>
  </div>
</main>

<?php renderFooter(); ?>
