/**
 * K3 QUEST — app.js
 * JavaScript vanilla untuk seluruh interaksi website
 */

'use strict';

/* ═══════════════════════════════════════
   1. MOBILE MENU TOGGLE
═══════════════════════════════════════ */
const menuToggle = document.getElementById('menuToggle');
const mobileMenu = document.getElementById('mobileMenu');

if (menuToggle && mobileMenu) {
  menuToggle.addEventListener('click', () => {
    const isOpen = !mobileMenu.classList.contains('hidden');
    mobileMenu.classList.toggle('hidden', isOpen);
    menuToggle.setAttribute('aria-expanded', String(!isOpen));
  });

  // Tutup menu saat klik di luar
  document.addEventListener('click', (e) => {
    if (!menuToggle.contains(e.target) && !mobileMenu.contains(e.target)) {
      mobileMenu.classList.add('hidden');
      menuToggle.setAttribute('aria-expanded', 'false');
    }
  });
}

/* ═══════════════════════════════════════
   2. FORM IDENTITAS PESERTA
═══════════════════════════════════════ */
const formIdentitas = document.getElementById('formIdentitas');
if (formIdentitas) {
  formIdentitas.addEventListener('submit', (e) => {
    let valid = true;

    const namaInput = document.getElementById('nama');
    const kelasInput = document.getElementById('kelas');
    const namaErr   = document.getElementById('namaError');
    const kelasErr  = document.getElementById('kelasError');

    // Reset errors
    [namaInput, kelasInput].forEach(el => el && el.classList.remove('error'));
    if (namaErr) namaErr.textContent = '';
    if (kelasErr) kelasErr.textContent = '';

    if (!namaInput.value.trim()) {
      namaInput.classList.add('error');
      if (namaErr) namaErr.textContent = 'Nama lengkap wajib diisi.';
      valid = false;
    }

    if (!kelasInput.value.trim()) {
      kelasInput.classList.add('error');
      if (kelasErr) kelasErr.textContent = 'Kelas wajib diisi.';
      valid = false;
    }

    if (!valid) {
      e.preventDefault();
    }
  });
}

/* ═══════════════════════════════════════
   3. KUIS INTERAKTIF (app state)
═══════════════════════════════════════ */
const kuisContainer = document.getElementById('kuisContainer');

if (kuisContainer) {
  // Data state kuis — diinisialisasi dari PHP lewat window.kuisData
  const soalList   = window.kuisData?.soal   || [];
  const totalSoal  = soalList.length;
  let currentIdx   = 0; // indeks soal yang sedang ditampilkan (0-based)
  let jawaban      = new Array(totalSoal).fill(null); // ['A','B',null,...]

  /* ── Render soal ── */
  function renderSoal(idx) {
    const soal = soalList[idx];
    if (!soal) return;

    // Update progress bar
    const answered = jawaban.filter(j => j !== null).length;
    document.getElementById('progressBar').style.width = `${((idx + 1) / totalSoal) * 100}%`;
    document.getElementById('soalCounter').textContent  = `Soal ${idx + 1} dari ${totalSoal}`;
    document.getElementById('kategoriLabel').textContent = soal.kategori;
    document.getElementById('tekssoal').textContent = soal.soal;

    // Render opsi
    const opsiWrap = document.getElementById('opsiWrap');
    opsiWrap.innerHTML = '';
    const keys = ['A', 'B', 'C', 'D'];
    keys.forEach(key => {
      const btn = document.createElement('button');
      btn.type = 'button';
      btn.className = 'quiz-option fade-up' + (jawaban[idx] === key ? ' selected' : '');
      btn.dataset.key = key;
      btn.innerHTML = `<span class="option-key">${key}</span><span>${soal.opsi[key]}</span>`;
      btn.addEventListener('click', () => pilihJawaban(idx, key));
      opsiWrap.appendChild(btn);
    });

    // Tombol navigasi
    document.getElementById('btnPrev').disabled = (idx === 0);
    const btnNext  = document.getElementById('btnNext');
    const btnSelesai = document.getElementById('btnSelesai');

    if (idx === totalSoal - 1) {
      btnNext.classList.add('hidden');
      btnSelesai.classList.remove('hidden');
    } else {
      btnNext.classList.remove('hidden');
      btnSelesai.classList.add('hidden');
    }

    // Render nomor soal navigator
    renderNomorNav(idx);
  }

  function pilihJawaban(idx, key) {
    jawaban[idx] = key;
    // Visual update opsi
    document.querySelectorAll('#opsiWrap .quiz-option').forEach(btn => {
      btn.classList.toggle('selected', btn.dataset.key === key);
      btn.querySelector('.option-key').style.background = btn.dataset.key === key ? '#193B46' : '';
      btn.querySelector('.option-key').style.borderColor = btn.dataset.key === key ? '#193B46' : '';
      btn.querySelector('.option-key').style.color = btn.dataset.key === key ? '#fff' : '';
    });
    renderNomorNav(idx);
    updateAnsweredCount();
  }

  function renderNomorNav(activeIdx) {
    const nav = document.getElementById('nomorNav');
    if (!nav) return;
    nav.innerHTML = '';
    for (let i = 0; i < totalSoal; i++) {
      const btn = document.createElement('button');
      btn.type = 'button';
      btn.textContent = i + 1;
      btn.className = [
        'w-9 h-9 rounded-lg text-sm font-semibold border-2 transition-all',
        i === activeIdx
          ? 'bg-primary-container text-white border-primary-container'
          : jawaban[i] !== null
            ? 'bg-secondary-fixed text-on-secondary-fixed border-secondary-fixed'
            : 'bg-white text-on-surface border-outline-variant hover:border-secondary',
      ].join(' ');
      btn.addEventListener('click', () => { currentIdx = i; renderSoal(i); });
      nav.appendChild(btn);
    }
  }

  function updateAnsweredCount() {
    const count = jawaban.filter(j => j !== null).length;
    const el = document.getElementById('answeredCount');
    if (el) el.textContent = count;
  }

  // Tombol navigasi prev/next
  document.getElementById('btnPrev')?.addEventListener('click', () => {
    if (currentIdx > 0) { currentIdx--; renderSoal(currentIdx); }
  });
  document.getElementById('btnNext')?.addEventListener('click', () => {
    if (currentIdx < totalSoal - 1) { currentIdx++; renderSoal(currentIdx); }
  });

  // Tombol Selesaikan Kuis → buka modal konfirmasi
  document.getElementById('btnSelesai')?.addEventListener('click', () => {
    const answered = jawaban.filter(j => j !== null).length;
    const unanswered = totalSoal - answered;
    document.getElementById('modalAnswered').textContent   = answered;
    document.getElementById('modalUnanswered').textContent = unanswered;

    const warningEl = document.getElementById('modalWarning');
    if (warningEl) {
      warningEl.classList.toggle('hidden', unanswered === 0);
    }
    openModal('modalKonfirmasiKuis');
  });

  // Konfirmasi submit kuis
  document.getElementById('btnKonfirmasiSubmit')?.addEventListener('click', () => {
    submitKuis();
  });

  document.getElementById('btnKonfirmasiKembali')?.addEventListener('click', () => {
    closeModal('modalKonfirmasiKuis');
  });

  function submitKuis() {
    // Kirim jawaban ke proses-kuis.php via POST
    const form = document.createElement('form');
    form.method = 'POST';
    form.action = BASE_URL + '/proses-kuis.php';

    jawaban.forEach((j, i) => {
      const input = document.createElement('input');
      input.type  = 'hidden';
      input.name  = `jawaban[${i + 1}]`;
      input.value = j || '';
      form.appendChild(input);
    });

    // CSRF token
    const csrf = document.createElement('input');
    csrf.type  = 'hidden';
    csrf.name  = 'csrf_token';
    csrf.value = window.kuisData?.csrf || '';
    form.appendChild(csrf);

    document.body.appendChild(form);
    form.submit();
  }

  // Init
  renderSoal(0);
  updateAnsweredCount();
}

/* ═══════════════════════════════════════
   4. MODAL HELPERS
═══════════════════════════════════════ */
function openModal(id) {
  const overlay = document.getElementById(id);
  if (overlay) {
    overlay.classList.add('open');
    overlay.removeAttribute('hidden');
    // Fokus ke tombol utama modal
    const firstBtn = overlay.querySelector('button');
    if (firstBtn) setTimeout(() => firstBtn.focus(), 50);
  }
}

function closeModal(id) {
  const overlay = document.getElementById(id);
  if (overlay) {
    overlay.classList.remove('open');
  }
}

// Tutup modal dengan klik overlay (bukan modal box)
document.querySelectorAll('.modal-overlay').forEach(overlay => {
  overlay.addEventListener('click', (e) => {
    if (e.target === overlay) closeModal(overlay.id);
  });
});

// Tutup modal dengan tombol close (data-close-modal)
document.querySelectorAll('[data-close-modal]').forEach(btn => {
  btn.addEventListener('click', () => {
    const targetId = btn.dataset.closeModal;
    closeModal(targetId);
  });
});

/* ═══════════════════════════════════════
   5. SMOOTH SCROLL untuk anchor link
═══════════════════════════════════════ */
document.querySelectorAll('a[href^="#"]').forEach(link => {
  link.addEventListener('click', (e) => {
    const target = document.querySelector(link.getAttribute('href'));
    if (target) {
      e.preventDefault();
      target.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }
  });
});

/* ═══════════════════════════════════════
   6. PROGRESS MATERI (checklist di ringkasan)
═══════════════════════════════════════ */
function animateProgressBar() {
  document.querySelectorAll('[data-progress]').forEach(el => {
    const target = parseInt(el.dataset.progress, 10);
    el.style.width = '0%';
    setTimeout(() => { el.style.width = target + '%'; }, 100);
  });
}
animateProgressBar();

/* ═══════════════════════════════════════
   7. SCORE RING ANIMASI
═══════════════════════════════════════ */
const scoreRing = document.getElementById('scoreRingCircle');
if (scoreRing) {
  const score = parseInt(scoreRing.dataset.score, 10) || 0;
  const r = parseFloat(scoreRing.getAttribute('r'));
  const circumference = 2 * Math.PI * r;
  scoreRing.style.strokeDasharray  = circumference;
  scoreRing.style.strokeDashoffset = circumference;

  setTimeout(() => {
    const offset = circumference - (score / 100) * circumference;
    scoreRing.style.transition = 'stroke-dashoffset 1s cubic-bezier(0.4, 0, 0.2, 1)';
    scoreRing.style.strokeDashoffset = offset;
  }, 300);
}

/* ═══════════════════════════════════════
   8. AUTO-HIDE SUCCESS/ERROR ALERT
═══════════════════════════════════════ */
document.querySelectorAll('[data-autohide]').forEach(el => {
  const delay = parseInt(el.dataset.autohide, 10) || 4000;
  setTimeout(() => {
    el.style.transition = 'opacity 0.4s';
    el.style.opacity = '0';
    setTimeout(() => el.remove(), 400);
  }, delay);
});
