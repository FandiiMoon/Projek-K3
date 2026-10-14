<?php
/**
 * K3 QUEST — Ringkasan Materi (Summary)
 */
define('BASE_URL', '');
require_once __DIR__ . '/includes/init.php';
require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/footer.php';

if (!sudahIdentitas()) redirect('identitas.php');

$progress = getProgressMateri();
$jumlahSelesai = count(array_filter($progress));
$semuaSelesai = semuaMateriSelesai();

$materiList = [
    [
        'no'   => 1,
        'slug' => 'ergonomi',
        'title'=> 'Ergonomi dan Posisi Kerja',
        'href' => 'materi/ergonomi.php',
    ],
    [
        'no'   => 2,
        'slug' => 'kesehatan-mata',
        'title'=> 'Kesehatan Mata',
        'href' => 'materi/kesehatan-mata.php',
    ],
    [
        'no'   => 3,
        'slug' => 'keselamatan-listrik',
        'title'=> 'Keselamatan Listrik dan Perangkat',
        'href' => 'materi/keselamatan-listrik.php',
    ],
    [
        'no'   => 4,
        'slug' => 'kesehatan-mental',
        'title'=> 'Kesehatan Mental dan Manajemen Stres',
        'href' => 'materi/kesehatan-mental.php',
    ],
];

renderHeader('Ringkasan Materi', 'materi', ['Ringkasan' => null]);
?>
<main class="max-w-4xl mx-auto px-4 sm:px-6 py-10">
    <h1 class="font-display text-3xl font-bold text-primary mb-6">Ringkasan Belajar</h1>
    <p class="text-on-surface-variant mb-4">Berikut status penyelesaian materi K3. Lengkapi semua modul sebelum memulai kuis.</p>
    <div class="grid gap-4 md:grid-cols-2">
        <?php foreach ($materiList as $m):
            $selesai = $progress[$m['slug']] ?? false;
        ?>
        <div class="card p-5 flex flex-col justify-between <?php echo $selesai ? 'bg-correct-bg/30 border-correct/30' : '';?>">
            <h3 class="font-display font-bold text-sm text-primary-container"><?php echo e($m['title']); ?></h3>
            <div class="mt-2">
                <?php if ($selesai): ?>
                    <span class="badge badge-mint">✓ Selesai</span>
                <?php else: ?>
                    <span class="badge badge-gray">Belum dipelajari</span>
                <?php endif; ?>
            </div>
            <a href="<?php echo e($m['href']); ?>" class="mt-3 btn <?php echo $selesai ? 'btn-secondary' : 'btn-primary'; ?> btn-sm">
                <?php echo $selesai ? 'Baca Ulang' : 'Pelajari'; ?>
                <span class="material-symbols-outlined icon-sm">arrow_forward</span>
            </a>
        </div>
        <?php endforeach; ?>
    </div>

    <div class="mt-8 flex justify-center">
        <?php if ($semuaSelesai): ?>
            <a href="kuis.php" class="btn btn-primary btn-lg">
                <span class="material-symbols-outlined icon-md">quiz</span>
                Mulai Kuis
            </a>
        <?php else: ?>
            <button class="btn btn-secondary btn-lg" disabled>
                <span class="material-symbols-outlined icon-md">lock</span>
                Selesaikan Semua Materi untuk Membuka Kuis
            </button>
        <?php endif; ?>
    </div>
</main>
<?php
renderFooter();
?>
