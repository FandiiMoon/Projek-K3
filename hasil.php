<?php
/**
 * K3 QUEST — Hasil Kuis (Quiz Results and Review)
 */
define('BASE_URL', '');
require_once __DIR__ . '/includes/init.php';
require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/footer.php';

if (!sudahIdentitas()) {
    redirect('identitas.php');
}

// Ensure we have quiz result in session
if (empty($_SESSION['quiz_result'])) {
    // No result yet, redirect to quiz page
    redirect('kuis.php');
    exit;
}

$quiz = $_SESSION['quiz_result'];
$score = $quiz['score'];
$total = $quiz['total'];
$details = $quiz['details'];

renderHeader('Hasil Kuis', 'kuis', ['Hasil Kuis' => null]);
?>
<main class="max-w-3xl mx-auto px-4 sm:px-6 py-10">
    <h1 class="font-display text-3xl font-bold text-primary mb-6">Hasil Kuis K3</h1>
    <div class="card p-6 mb-8 text-center">
        <p class="text-2xl font-bold mb-2">Skor Anda: <span class="text-primary"><?php echo e($score); ?></span> / <?php echo e($total); ?></p>
        <?php
        $percentage = $total > 0 ? round(($score / $total) * 100) : 0;
        ?>
        <p class="text-lg text-on-surface-variant">(<?php echo e($percentage); ?>%)</p>
    </div>

    <h2 class="font-display text-2xl font-bold text-primary-container mb-4">Ulasan Jawaban</h2>
    <?php foreach ($details as $d): ?>
        <div class="card p-5 mb-4 <?php echo $d['isCorrect'] ? 'bg-correct-bg/30 border-correct/30' : 'bg-wrong-bg/30 border-wrong/30'; ?>">
            <h3 class="font-display font-bold text-sm text-primary-container mb-1">
                <?php echo e($d['no'] . '. ' . $d['kategori']); ?>
            </h3>
            <p class="mb-2 text-on-surface-variant"><?php echo e($d['soal']); ?></p>
            <p class="mb-1"><strong>Jawaban Anda:</strong> <?php echo $d['jawaban'] ? e($d['jawaban']) . ' - ' . e($d['opsi'][$d['jawaban']] ?? '') : '<em>tidak dijawab</em>'; ?></p>
            <p class="mb-1"><strong>Jawaban Benar:</strong> <?php echo e($d['benar']); ?> - <?php echo e($d['opsi'][$d['benar']] ?? ''); ?></p>
            <p class="mb-2"><strong>Penjelasan:</strong> <?php echo e($d['penjelasan']); ?></p>
            <?php if ($d['isCorrect']): ?>
                <span class="badge badge-mint">Benar</span>
            <?php else: ?>
                <span class="badge badge-wrong">Salah</span>
            <?php endif; ?>
        </div>
    <?php endforeach; ?>

    <div class="flex justify-center gap-4 mt-8">
        <a href="ringkasan.php" class="btn btn-primary btn-lg">
            <span class="material-symbols-outlined icon-sm">summarize</span>
            Ringkasan Materi
        </a>
        <a href="kuis.php" class="btn btn-secondary btn-lg">
            <span class="material-symbols-outlined icon-sm">replay</span>
            Ulangi Kuis
        </a>
    </div>
</main>
<?php
// Clear quiz result after displaying so a refresh doesn't resubmit
unset($_SESSION['quiz_result']);
renderFooter();
?>
