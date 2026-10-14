<?php
/**
 * K3 QUEST — Quiz Page
 */
define('BASE_URL', '');
require_once __DIR__ . '/includes/init.php';
require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/footer.php';

if (!sudahIdentitas()) redirect('identitas.php');

// Ensure all materi completed before allowing quiz
if (!semuaMateriSelesai()) {
    renderHeader('Kuis K3', 'kuis', ['Kuis' => null]);
    ?>
    <main class="max-w-2xl mx-auto px-4 sm:px-6 py-10">
        <div class="card p-6 text-center">
            <h2 class="font-display text-2xl font-bold text-primary mb-4">Kuis belum dapat diakses</h2>
            <p class="text-on-surface-variant mb-6">Anda harus menyelesaikan semua materi terlebih dahulu.</p>
            <a href="ringkasan.php" class="btn btn-primary btn-lg">
                <span class="material-symbols-outlined icon-md">summarize</span>
                Lihat Ringkasan Materi
            </a>
        </div>
    </main>
    <?php
    renderFooter();
    exit;
}

// All materi done – render quiz
$soalList = getSoalKuis();
renderHeader('Kuis K3', 'kuis', ['Kuis' => null]);
?>
<main class="max-w-3xl mx-auto px-4 sm:px-6 py-10">
    <h1 class="font-display text-3xl font-bold text-primary mb-6">Kuis K3 – Evaluasi Pengetahuan</h1>
    <form action="proses-kuis.php" method="post" class="space-y-8">
        <?php foreach ($soalList as $idx => $s): ?>
            <div class="card p-5">
                <h3 class="font-display font-bold text-lg text-primary-container mb-2">
                    <?php echo e($s['no'] . '. ' . $s['kategori']); ?>
                </h3>
                <p class="mb-3 text-on-surface-variant"><?php echo e($s['soal']); ?></p>
                <div class="space-y-2">
                    <?php foreach ($s['opsi'] as $optKey => $optVal): ?>
                        <label class="flex items-center gap-2">
                            <input type="radio" name="q<?php echo $s['no']; ?>" value="<?php echo e($optKey); ?>" required class="form-radio">
                            <span class="text-on-surface-variant"><strong><?php echo e($optKey); ?>.</strong> <?php echo e($optVal); ?></span>
                        </label>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endforeach; ?>
        <div class="flex justify-center">
            <button type="submit" class="btn btn-primary btn-lg">
                <span class="material-symbols-outlined icon-md">send</span>
                Kirim Jawaban
            </button>
        </div>
    </form>
</main>
<?php
renderFooter();
?>
