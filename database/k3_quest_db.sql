-- ============================================================
-- K3 QUEST - Database Schema
-- Nama Database: k3_quest_db
-- Dibuat untuk keperluan edukasi K3 SMK RPL
-- ============================================================

CREATE DATABASE IF NOT EXISTS k3_quest_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE k3_quest_db;

-- ============================================================
-- Tabel: peserta
-- Menyimpan identitas peserta yang mengikuti pembelajaran
-- ============================================================
CREATE TABLE IF NOT EXISTS peserta (
    id          INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nama        VARCHAR(100)    NOT NULL,
    kelas       VARCHAR(50)     NOT NULL,
    created_at  DATETIME        DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================================
-- Tabel: hasil_kuis
-- Menyimpan hasil kuis setiap peserta
-- ============================================================
CREATE TABLE IF NOT EXISTS hasil_kuis (
    id              INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    peserta_id      INT UNSIGNED    NOT NULL,
    skor            TINYINT UNSIGNED NOT NULL DEFAULT 0,
    benar           TINYINT UNSIGNED NOT NULL DEFAULT 0,
    salah           TINYINT UNSIGNED NOT NULL DEFAULT 0,
    tidak_dijawab   TINYINT UNSIGNED NOT NULL DEFAULT 0,
    akurasi         DECIMAL(5,2)    NOT NULL DEFAULT 0.00,
    created_at      DATETIME        DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_hasil_peserta FOREIGN KEY (peserta_id) REFERENCES peserta(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================================
-- Tabel: jawaban_kuis
-- Menyimpan jawaban per soal dari setiap sesi kuis
-- ============================================================
CREATE TABLE IF NOT EXISTS jawaban_kuis (
    id              INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    hasil_id        INT UNSIGNED    NOT NULL,
    nomor_soal      TINYINT UNSIGNED NOT NULL,
    jawaban_peserta CHAR(1)         DEFAULT NULL COMMENT 'A, B, C, atau D. NULL jika tidak dijawab',
    jawaban_benar   CHAR(1)         NOT NULL,
    is_benar        TINYINT(1)      NOT NULL DEFAULT 0,
    CONSTRAINT fk_jawaban_hasil FOREIGN KEY (hasil_id) REFERENCES hasil_kuis(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
