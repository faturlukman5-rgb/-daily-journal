-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 12 Jan 2026 pada 13.41
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";



/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webdailyjournal`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `article`
--

CREATE TABLE `article` (
  `id` int(11) NOT NULL,
  `judul` text DEFAULT NULL,
  `isi` text DEFAULT NULL,
  `gambar` text DEFAULT NULL,
  `tanggal` datetime DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `article`
--

INSERT INTO `article` (`id`, `judul`, `isi`, `gambar`, `tanggal`, `username`) VALUES
(1, 'kuliah\r\n', 'kegiatan rutin saya saat ini adalah berkuliah di universitas Dian Nuswantoro\r\n\r\n', 'kuliah.jpg', '2025-12-10 09:10:50', 'admin'),
(2, 'Belajar Kelompok\r\n', 'belajar kelompok untuk mengerjakan tugas yg di berikan oleh dosen agar mendapat nilai yang bagusv', 'kerjakelompok.jpg', '2025-12-10 09:10:50', 'admin'),
(3, 'menonton bola', 'menonton pertandingan bola tentang timnas,club favorit yang telah ditunggu waktu bermainya\r\n\r\n', 'bola.jpg', '2025-12-10 09:10:50', 'admin'),
(4, 'Main Game', 'saat ada waktu kosong atau Setelah pulang kuliah teman-teman mengajak untuk bermain PS disekitar rumah salah satu teman\r\n\r\n', 'fc25.jpg', '2025-12-10 09:25:41', 'admin'),
(5, 'Belajar', 'Pada malam hari belajar materi yang dipelajari tadi dikelas dan untuk materi besok\r\n\r\n', 'Belajar.jpg', '2025-12-10 09:10:50', 'admin'),
(10, 'Timnas', 'Tinmas indonesia sedang berjuang untuk memdapatkan tiket menuju piala dunia', '20251226144208.jpg', '2025-12-26 14:42:08', 'admin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `gallery`
--

CREATE TABLE `gallery` (
  `id` int(11) NOT NULL,
  `judul` text NOT NULL,
  `isi` text NOT NULL,
  `gambar` text NOT NULL,
  `tanggal` datetime NOT NULL,
  `username` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `gallery`
--

INSERT INTO `gallery` (`id`, `judul`, `isi`, `gambar`, `tanggal`, `username`) VALUES
(1, 'Timnas\r\n', 'Tinmas indonesia sedang berjuang untuk memdapatkan tiket menuju piala dunia\r\n\r\n', 'timnas.jpg', '2026-01-11 15:30:40', 'admin'),
(2, 'Main Game\r\n', 'saat ada waktu kosong atau Setelah pulang kuliah teman-teman mengajak untuk bermain PS disekitar rumah salah satu teman\r\n\r\n', 'fc25.jpg', '2026-01-11 15:34:17', 'admin'),
(3, 'kuliah', 'kegiatan rutin saya saat ini adalah berkuliah di universitas Dian Nuswantoro', 'kuliah.jpg', '2026-01-11 15:35:05', 'admin'),
(4, 'Belajar Kelompok\r\n', 'belajar kelompok untuk mengerjakan tugas yg di berikan oleh dosen agar mendapat nilai yang bagusv', 'kerjakelompok.jpg', '2026-01-11 15:35:05', 'admin'),
(5, 'menonton bola indo', 'barca vs madrid', 'bola.jpg', '2026-01-12 16:09:48', 'admin'),
(6, 'Belajar', 'Pada malam hari belajar materi yang dipelajari tadi dikelas dan untuk materi besok', 'Belajar.jpg', '2026-01-11 15:37:13', 'admin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` text NOT NULL,
  `foto` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `foto`) VALUES
(3, 'bayu', '36272', ''),
(5, 'bagogo', '12', ''),
(9, 'bagogo', 'pagihari', ''),
(10, 'zaki', 'onicayam', ''),
(12, 'surya', 'abcde', ''),
(13, 'danny', 'admin', ''),
(14, 'admin', 'e10adc3949ba59abbe56e057f20f883e', '');

--
-- Indexes
--

ALTER TABLE `article`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT
--

ALTER TABLE `article`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

ALTER TABLE `gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;