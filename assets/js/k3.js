/**
 * K3 QUEST — Core JavaScript Library
 * Menggantikan semua logika PHP dengan localStorage
 */

// ══════════════════════════════════════════════
//  STATE MANAGEMENT (localStorage)
// ══════════════════════════════════════════════
const K3 = {
  // ── Peserta ───────────────────────────────
  getPeserta() {
    return {
      nama:  localStorage.getItem('k3_nama')  || '',
      kelas: localStorage.getItem('k3_kelas') || '',
    };
  },
  setPeserta(nama, kelas) {
    localStorage.setItem('k3_nama',  nama);
    localStorage.setItem('k3_kelas', kelas);
  },
  sudahIdentitas() {
    const { nama, kelas } = this.getPeserta();
    return nama.trim() !== '' && kelas.trim() !== '';
  },

  // ── Progress Materi ───────────────────────
  getProgress() {
    const raw = localStorage.getItem('k3_progress');
    return raw ? JSON.parse(raw) : {
      ergonomi: false,
      'kesehatan-mata': false,
      'keselamatan-listrik': false,
      'kesehatan-mental': false,
    };
  },
  tandaiSelesai(slug) {
    const p = this.getProgress();
    p[slug] = true;
    localStorage.setItem('k3_progress', JSON.stringify(p));
  },
  jumlahSelesai() {
    return Object.values(this.getProgress()).filter(Boolean).length;
  },
  semuaSelesai() {
    return this.jumlahSelesai() === 4;
  },

  // ── Quiz Result ───────────────────────────
  setHasil(hasil) {
    localStorage.setItem('k3_hasil', JSON.stringify(hasil));
  },
  getHasil() {
    const raw = localStorage.getItem('k3_hasil');
    return raw ? JSON.parse(raw) : null;
  },

  // ── Redirect helper ───────────────────────
  redirect(path) {
    window.location.href = path;
  },

  // ── Auth guard ────────────────────────────
  requireIdentitas(redirectPath = '/identitas.html') {
    if (!this.sudahIdentitas()) {
      this.redirect(redirectPath);
      return false;
    }
    return true;
  },
  requireMateriSelesai(redirectPath = '/ringkasan.html') {
    if (!this.semuaSelesai()) {
      this.redirect(redirectPath);
      return false;
    }
    return true;
  },

  // ── Soal Kuis ─────────────────────────────
  getSoal() {
    return [
      {
        no: 1, kategori: 'Ergonomi',
        soal: 'Apa tujuan utama ergonomi dalam lingkungan kerja programmer?',
        opsi: {
          A: 'Membuat komputer bekerja lebih cepat',
          B: 'Menyesuaikan lingkungan kerja agar lebih nyaman dan aman bagi pengguna',
          C: 'Mengurangi kebutuhan menggunakan kursi',
          D: 'Membuat programmer tidak perlu beristirahat',
        },
        jawaban: 'B',
        penjelasan: 'Ergonomi bertujuan menyesuaikan lingkungan, alat, dan metode kerja dengan kemampuan serta keterbatasan manusia, sehingga pekerjaan menjadi lebih nyaman, aman, dan efisien.',
      },
      {
        no: 2, kategori: 'Ergonomi',
        soal: 'Berapakah sudut siku yang ideal saat mengetik di keyboard menurut prinsip ergonomi?',
        opsi: { A: '45° - 60°', B: '60° - 75°', C: '90° - 100°', D: '120° - 135°' },
        jawaban: 'C',
        penjelasan: 'Sudut siku antara 90° hingga 100° dianggap ideal karena mengurangi ketegangan pada otot lengan bawah dan pergelangan tangan saat mengetik.',
      },
      {
        no: 3, kategori: 'Ergonomi',
        soal: 'Apa risiko utama dari posisi duduk yang tidak ergonomis dalam jangka panjang bagi programmer?',
        opsi: {
          A: 'Komputer lebih cepat panas',
          B: 'Gangguan muskuloskeletal seperti nyeri punggung dan leher',
          C: 'Koneksi internet menjadi lambat',
          D: 'Keyboard cepat rusak',
        },
        jawaban: 'B',
        penjelasan: 'Posisi duduk yang tidak ergonomis dalam jangka panjang dapat menyebabkan gangguan muskuloskeletal, termasuk nyeri punggung, nyeri leher, dan cedera regangan berulang.',
      },
      {
        no: 4, kategori: 'Kesehatan Mata',
        soal: 'Apa yang dapat dilakukan untuk membantu mengurangi kelelahan mata saat menggunakan komputer dalam waktu lama?',
        opsi: {
          A: 'Menatap layar tanpa jeda untuk menjaga fokus',
          B: 'Meningkatkan kecerahan layar semaksimal mungkin',
          C: 'Mengistirahatkan mata secara berkala dengan melihat objek yang jauh',
          D: 'Mengurangi ukuran teks agar lebih banyak informasi yang terlihat',
        },
        jawaban: 'C',
        penjelasan: 'Mengistirahatkan mata secara berkala, misalnya dengan melihat objek yang jauh selama beberapa detik, membantu mengurangi ketegangan otot mata.',
      },
      {
        no: 5, kategori: 'Kesehatan Mata',
        soal: 'Apa yang dimaksud dengan aturan 20-20-20 dalam konteks kesehatan mata?',
        opsi: {
          A: 'Bekerja 20 jam, istirahat 20 menit, lalu bekerja 20 jam lagi',
          B: 'Setiap 20 menit, lihat objek sejauh 20 kaki selama 20 detik',
          C: 'Atur kecerahan layar ke 20%, kontras ke 20%, dan jarak 20 cm',
          D: 'Kedipkan mata 20 kali per menit dengan interval 20 detik',
        },
        jawaban: 'B',
        penjelasan: 'Aturan 20-20-20 menyarankan agar setiap 20 menit bekerja di depan komputer, kamu mengalihkan pandangan ke objek berjarak sekitar 20 kaki selama 20 detik.',
      },
      {
        no: 6, kategori: 'Keselamatan Listrik',
        soal: 'Apa tindakan yang tepat jika kamu menemukan kabel listrik yang rusak atau terkelupas di tempat kerja?',
        opsi: {
          A: 'Tetap menggunakannya selama komputer masih menyala',
          B: 'Memegang bagian kabel yang rusak saat perangkat masih aktif',
          C: 'Menghentikan penggunaan perangkat dan melaporkannya kepada pihak yang bertanggung jawab',
          D: 'Menutupi kerusakan dengan isolasi biasa tanpa memberi tahu siapa pun',
        },
        jawaban: 'C',
        penjelasan: 'Kabel yang rusak atau terkelupas merupakan bahaya listrik yang serius. Tindakan yang benar adalah menghentikan penggunaan dan melaporkannya kepada pihak yang berwenang.',
      },
      {
        no: 7, kategori: 'Keselamatan Listrik',
        soal: 'Mengapa cairan harus dijaga agar tidak berdekatan dengan perangkat elektronik di area kerja?',
        opsi: {
          A: 'Karena cairan dapat membuat layar monitor menjadi buram',
          B: 'Karena cairan dapat menyebabkan korsleting listrik yang berbahaya dan merusak perangkat',
          C: 'Karena cairan membuat keyboard menjadi lengket',
          D: 'Karena cairan dapat memperlambat kecepatan prosesor',
        },
        jawaban: 'B',
        penjelasan: 'Cairan bersifat konduktor listrik. Jika masuk ke dalam perangkat elektronik, dapat menyebabkan korsleting yang merusak perangkat dan menimbulkan bahaya kebakaran.',
      },
      {
        no: 8, kategori: 'Keselamatan Listrik',
        soal: 'Apa risiko yang ditimbulkan dari stopkontak yang kelebihan beban di ruang komputer?',
        opsi: {
          A: 'Internet menjadi lebih lambat karena bandwidth terbagi',
          B: 'Potensi kebakaran akibat panas berlebih pada instalasi listrik',
          C: 'Monitor menjadi terlalu terang',
          D: 'Hard disk menjadi lebih cepat aus',
        },
        jawaban: 'B',
        penjelasan: 'Stopkontak yang kelebihan beban akan menghasilkan panas berlebih pada kabel dan komponen listrik, yang dapat memicu kebakaran.',
      },
      {
        no: 9, kategori: 'Kesehatan Mental',
        soal: 'Apa tindakan yang baik saat menghadapi deadline proyek yang terasa terlalu berat untuk diselesaikan sendiri?',
        opsi: {
          A: 'Mengabaikan semua tugas dan berharap masalah selesai sendiri',
          B: 'Mengatur prioritas tugas dan berkomunikasi secara terbuka dengan tim atau guru',
          C: 'Tidak beristirahat sama sekali sampai seluruh pekerjaan selesai',
          D: 'Menyembunyikan kesulitan yang dialami agar tidak terlihat lemah',
        },
        jawaban: 'B',
        penjelasan: 'Mengatur prioritas dan berkomunikasi secara terbuka adalah pendekatan yang sehat dan bagian dari kerja tim yang efektif.',
      },
      {
        no: 10, kategori: 'Kesehatan Mental',
        soal: 'Mengapa istirahat yang cukup penting bagi seorang software developer?',
        opsi: {
          A: 'Agar komputer tidak terlalu panas saat ditinggalkan',
          B: 'Karena istirahat menurunkan produktivitas secara permanen',
          C: 'Istirahat membantu memulihkan konsentrasi, mengurangi stres, dan mencegah kelelahan mental',
          D: 'Karena perusahaan mewajibkan istirahat dalam kontrak kerja',
        },
        jawaban: 'C',
        penjelasan: 'Istirahat yang cukup adalah investasi produktivitas. Tanpa istirahat yang memadai, konsentrasi menurun, kesalahan coding meningkat, dan risiko burnout lebih tinggi.',
      },
    ];
  },
};

// ══════════════════════════════════════════════
//  HEADER & FOOTER RENDERER
// ══════════════════════════════════════════════
function renderHeader(activePage = 'beranda') {
  const { nama, kelas } = K3.getPeserta();
  const base = getBase();
  const nav = [
    { label: 'Beranda',   href: base + 'index.html',    slug: 'beranda' },
    { label: 'Materi K3', href: base + 'pengantar.html', slug: 'materi' },
    { label: 'Tentang',   href: base + 'tentang.html',  slug: 'tentang' },
  ];
  const navLinks = nav.map(n => `
    <a href="${n.href}" class="px-4 py-2 rounded-btn text-sm font-semibold transition-all duration-200
      ${activePage === n.slug ? 'bg-primary-container text-white' : 'text-on-surface-variant hover:bg-surface-container hover:text-on-surface'}"
      ${activePage === n.slug ? 'aria-current="page"' : ''}>${n.label}</a>
  `).join('');
  const mobileNavLinks = nav.map(n => `
    <a href="${n.href}" class="px-4 py-3 rounded-btn text-sm font-semibold transition-colors
      ${activePage === n.slug ? 'bg-primary-container text-white' : 'text-on-surface-variant hover:bg-surface-container hover:text-on-surface'}">${n.label}</a>
  `).join('');

  const pesertaBadge = nama ? `
    <div class="hidden sm:flex items-center gap-2 px-3 py-1.5 rounded-full bg-secondary-fixed/50 text-on-secondary-fixed-variant">
      <span class="material-symbols-outlined text-[16px] text-secondary">person</span>
      <span class="text-xs font-semibold">${nama}</span>
      ${kelas ? `<span class="text-xs text-on-surface-variant">· ${kelas}</span>` : ''}
    </div>` : '';

  document.getElementById('app-header').innerHTML = `
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-10 h-16 flex items-center justify-between gap-4">
      <a href="${base}index.html" class="flex items-center gap-2.5 flex-shrink-0" aria-label="K3 QUEST Beranda">
        <div class="w-9 h-9 rounded-xl bg-primary-container flex items-center justify-center flex-shrink-0">
          <svg class="w-5 h-5 text-white" viewBox="0 0 24 24" fill="none">
            <path d="M12 2L3 6V12C3 16.55 6.84 20.74 12 22C17.16 20.74 21 16.55 21 12V6L12 2Z" fill="currentColor" opacity="0.9"/>
            <path d="M9 12l2 2 4-4" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
        </div>
        <div class="hidden sm:flex flex-col leading-tight">
          <span class="font-display font-bold text-primary text-base tracking-tight">K3 QUEST</span>
          <span class="text-[10px] text-on-surface-variant font-medium tracking-wide">Software Engineering</span>
        </div>
      </a>
      <nav class="hidden md:flex items-center gap-1">${navLinks}</nav>
      <div class="flex items-center gap-3">
        ${pesertaBadge}
        <button id="menuToggle" type="button" aria-label="Buka menu" aria-expanded="false"
          class="md:hidden p-2 rounded-btn text-on-surface-variant hover:bg-surface-container transition-colors">
          <span class="material-symbols-outlined text-[22px]">menu</span>
        </button>
      </div>
    </div>
    <div id="mobileMenu" class="md:hidden hidden border-t border-outline-variant/30 bg-surface-container-lowest">
      <div class="max-w-6xl mx-auto px-4 py-3 flex flex-col gap-1">
        ${mobileNavLinks}
        ${nama ? `<div class="mt-2 px-4 py-3 rounded-btn bg-surface-container text-xs text-on-surface-variant font-medium">
          Peserta: <strong class="text-on-surface">${nama}</strong>${kelas ? ' · ' + kelas : ''}
        </div>` : ''}
      </div>
    </div>`;

  // Mobile menu toggle
  document.getElementById('menuToggle')?.addEventListener('click', function() {
    const menu = document.getElementById('mobileMenu');
    const open = !menu.classList.contains('hidden');
    menu.classList.toggle('hidden', open);
    this.setAttribute('aria-expanded', String(!open));
  });
}

function renderFooter() {
  const base = getBase();
  document.getElementById('app-footer').innerHTML = `
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-10 py-8">
      <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
        <div class="flex items-center gap-2.5">
          <div class="w-7 h-7 rounded-lg bg-primary-container flex items-center justify-center">
            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none">
              <path d="M12 2L3 6V12C3 16.55 6.84 20.74 12 22C17.16 20.74 21 16.55 21 12V6L12 2Z" fill="white" opacity="0.9"/>
              <path d="M9 12l2 2 4-4" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
          </div>
          <span class="font-display font-bold text-primary text-sm">K3 QUEST</span>
        </div>
        <div class="flex items-center gap-4 text-xs text-on-surface-variant">
          <a href="${base}index.html" class="hover:text-secondary transition-colors">Beranda</a>
          <a href="${base}pengantar.html" class="hover:text-secondary transition-colors">Materi</a>
          <a href="${base}tentang.html" class="hover:text-secondary transition-colors">Tentang</a>
        </div>
        <p class="text-xs text-on-surface-variant">© 2026 K3 QUEST · SMK RPL</p>
      </div>
    </div>`;
}

function renderBreadcrumb(items) {
  const base = getBase();
  const crumbs = items.map((item, i) => {
    const isLast = i === items.length - 1;
    return `
      <span class="material-symbols-outlined text-[14px] opacity-40">chevron_right</span>
      ${isLast
        ? `<span class="text-on-surface font-semibold">${item.label}</span>`
        : `<a href="${item.href}" class="hover:text-secondary transition-colors font-medium">${item.label}</a>`}
    `;
  }).join('');

  document.getElementById('app-breadcrumb').innerHTML = `
    <div class="bg-surface-container-low border-b border-outline-variant/20">
      <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-10 py-2.5">
        <nav aria-label="Breadcrumb" class="flex items-center gap-1.5 text-xs text-on-surface-variant flex-wrap">
          <a href="${base}index.html" class="hover:text-secondary transition-colors font-medium">Beranda</a>
          ${crumbs}
        </nav>
      </div>
    </div>`;
}

function getBase() {
  // Detect if we're in a subdirectory (materi/)
  const path = window.location.pathname;
  return path.includes('/materi/') ? '../' : './';
}

// ══════════════════════════════════════════════
//  FADE-UP ANIMATION (IntersectionObserver)
// ══════════════════════════════════════════════
function initFadeUp() {
  const els = document.querySelectorAll('.fade-up');
  if (!('IntersectionObserver' in window)) {
    els.forEach(el => el.style.opacity = '1');
    return;
  }
  const obs = new IntersectionObserver(entries => {
    entries.forEach(e => { if (e.isIntersecting) { e.target.style.opacity = '1'; obs.unobserve(e.target); } });
  }, { threshold: 0.1 });
  els.forEach(el => { el.style.opacity = '0'; obs.observe(el); });
}

document.addEventListener('DOMContentLoaded', initFadeUp);
