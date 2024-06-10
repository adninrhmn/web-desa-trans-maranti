-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 07 Jun 2023 pada 15.38
-- Versi server: 10.4.17-MariaDB
-- Versi PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_webdesa`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin', '0192023a7bbd73250516f069df18b500');

-- --------------------------------------------------------

--
-- Struktur dari tabel `biodata_admin`
--

CREATE TABLE `biodata_admin` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `nik` varchar(20) NOT NULL,
  `tempat_lahir` varchar(50) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') NOT NULL,
  `alamat` varchar(200) NOT NULL,
  `gambar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `biodata_admin`
--

INSERT INTO `biodata_admin` (`id`, `nama`, `nik`, `tempat_lahir`, `tanggal_lahir`, `jenis_kelamin`, `alamat`, `gambar`) VALUES
(1, 'Adnin Rahman', '13341234', 'Tamon Jaya', '2004-06-19', 'Laki-laki', 'Ds. Trans Maranti, Kec. Teupah Selatan, Kab. Simeulue\r\n', 'himatif.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `gambar_struktur`
--

CREATE TABLE `gambar_struktur` (
  `id` int(11) NOT NULL,
  `nama_file` varchar(255) NOT NULL,
  `path_file` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `gambar_struktur`
--

INSERT INTO `gambar_struktur` (`id`, `nama_file`, `path_file`) VALUES
(14, 'himatif.png', '../images/himatif.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `penduduk`
--

CREATE TABLE `penduduk` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `alamat` varchar(100) DEFAULT NULL,
  `pekerjaan` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `penduduk`
--

INSERT INTO `penduduk` (`id`, `nama`, `tanggal_lahir`, `alamat`, `pekerjaan`) VALUES
(2, 'kurniawan', '2004-06-19', 'ujong padang', 'petani');

-- --------------------------------------------------------

--
-- Struktur dari tabel `penduduk_desa`
--

CREATE TABLE `penduduk_desa` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `NIK` varchar(50) NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `tempat_lahir` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `status_perkawinan` enum('Belum Menikah','Menikah','Cerai') NOT NULL,
  `pekerjaan` varchar(100) NOT NULL,
  `pendidikan` varchar(100) NOT NULL,
  `kewarganegaraan` varchar(100) NOT NULL,
  `agama` varchar(100) NOT NULL,
  `etnis_suku` varchar(100) NOT NULL,
  `status_kependudukan` enum('Penduduk Tetap','Penduduk Sementara') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `penduduk_desa`
--

INSERT INTO `penduduk_desa` (`id`, `nama`, `NIK`, `jenis_kelamin`, `tanggal_lahir`, `tempat_lahir`, `alamat`, `status_perkawinan`, `pekerjaan`, `pendidikan`, `kewarganegaraan`, `agama`, `etnis_suku`, `status_kependudukan`) VALUES
(9, 'kurniawan', '256522334', 'Laki-laki', '2004-02-12', 'tamon jaya', 'dgafdd', 'Menikah', 'polisi', 'Strata 2', 'MALAYSIA', 'Islam', 'batak', 'Penduduk Sementara');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengaduan_saran`
--

CREATE TABLE `pengaduan_saran` (
  `id_pengaduan` int(11) NOT NULL,
  `nama_pengirim` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `pesan` text NOT NULL,
  `tanggal_pengaduan` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pengaduan_saran`
--

INSERT INTO `pengaduan_saran` (`id_pengaduan`, `nama_pengirim`, `email`, `pesan`, `tanggal_pengaduan`) VALUES
(1, 'adnin', 'awalawalkali@gmail.com', 'saya suka ini', '2023-06-01 22:14:18'),
(7, 'ridwan', 'awalawalkali@gmail.com', 'saya sangat sedih, karena pelayanan kantor desa kurang baik terhadap kami', '2023-06-04 21:27:19'),
(8, 'eko', 'awalawalkali@gmail.com', 'trans jernge', '2023-06-05 14:33:07');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pesan`
--

CREATE TABLE `pesan` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `pesan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pesan`
--

INSERT INTO `pesan` (`id`, `nama`, `email`, `pesan`) VALUES
(2, 'adnin rahman', 'eparostika@gmail.com', 'saya senang'),
(4, 'ilham ramanda', 'awalawalkali@gmail.com', 'saya suka web ini'),
(5, 'saya', 'eparostika@gmail.com', 'saya senang banget');

-- --------------------------------------------------------

--
-- Struktur dari tabel `profil`
--

CREATE TABLE `profil` (
  `id` int(11) NOT NULL,
  `nama_desa` varchar(100) NOT NULL,
  `alamat` varchar(200) NOT NULL,
  `kode_pos` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `profil`
--

INSERT INTO `profil` (`id`, `nama_desa`, `alamat`, `kode_pos`) VALUES
(5, 'Trans Maranti', 'Ds. Trans maranti, Kec. Teupah Selatan, Kab. Simeulue', '12421');

-- --------------------------------------------------------

--
-- Struktur dari tabel `profil_desa`
--

CREATE TABLE `profil_desa` (
  `id` int(11) NOT NULL,
  `nama_desa` varchar(100) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `kode_pos` varchar(10) NOT NULL,
  `gambar_struktur` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `profil_desa`
--

INSERT INTO `profil_desa` (`id`, `nama_desa`, `alamat`, `kode_pos`, `gambar_struktur`) VALUES
(1, 'trans maranti', 'trans maranti, teupah selatan, simeulue', '12321', '1685914166_Selamat Hari Raya Idul Fitri (4).png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `program_pembangunan`
--

CREATE TABLE `program_pembangunan` (
  `id_program_pembangunan` int(11) NOT NULL,
  `program_pembangunan` varchar(255) NOT NULL,
  `anggaran` decimal(10,2) NOT NULL,
  `gambar_kegiatan` varchar(255) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `program_pembangunan`
--

INSERT INTO `program_pembangunan` (`id_program_pembangunan`, `program_pembangunan`, `anggaran`, `gambar_kegiatan`, `status`) VALUES
(4, 'Gotong Royong', '12000000.00', 'mantap.jpg', 'lancar'),
(5, 'Buka Bersama Alumni SMP', '200000.00', 'IMG-20220430-WA0022.jpg', 'lancar');

-- --------------------------------------------------------

--
-- Struktur dari tabel `struktur_organisasi_desa`
--

CREATE TABLE `struktur_organisasi_desa` (
  `id` int(11) NOT NULL,
  `nama_gambar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `wisata_lokal`
--

CREATE TABLE `wisata_lokal` (
  `id_wisata` int(11) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `deskripsi` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `wisata_lokal`
--

INSERT INTO `wisata_lokal` (`id_wisata`, `gambar`, `alamat`, `deskripsi`) VALUES
(2, 'mantap.jpg', 'trans maranti, teupah selatan, simeulue', 'saya suka'),
(3, 'oke.png', 'masjid', NULL),
(4, 'IMG-20200107-WA0008.jpg', 'pantai Latiung', NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `biodata_admin`
--
ALTER TABLE `biodata_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `gambar_struktur`
--
ALTER TABLE `gambar_struktur`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `penduduk`
--
ALTER TABLE `penduduk`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `penduduk_desa`
--
ALTER TABLE `penduduk_desa`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pengaduan_saran`
--
ALTER TABLE `pengaduan_saran`
  ADD PRIMARY KEY (`id_pengaduan`);

--
-- Indeks untuk tabel `pesan`
--
ALTER TABLE `pesan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `profil`
--
ALTER TABLE `profil`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `profil_desa`
--
ALTER TABLE `profil_desa`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `program_pembangunan`
--
ALTER TABLE `program_pembangunan`
  ADD PRIMARY KEY (`id_program_pembangunan`);

--
-- Indeks untuk tabel `struktur_organisasi_desa`
--
ALTER TABLE `struktur_organisasi_desa`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `wisata_lokal`
--
ALTER TABLE `wisata_lokal`
  ADD PRIMARY KEY (`id_wisata`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `biodata_admin`
--
ALTER TABLE `biodata_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `gambar_struktur`
--
ALTER TABLE `gambar_struktur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `penduduk`
--
ALTER TABLE `penduduk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `penduduk_desa`
--
ALTER TABLE `penduduk_desa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `pengaduan_saran`
--
ALTER TABLE `pengaduan_saran`
  MODIFY `id_pengaduan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `pesan`
--
ALTER TABLE `pesan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `profil`
--
ALTER TABLE `profil`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `profil_desa`
--
ALTER TABLE `profil_desa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `program_pembangunan`
--
ALTER TABLE `program_pembangunan`
  MODIFY `id_program_pembangunan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `struktur_organisasi_desa`
--
ALTER TABLE `struktur_organisasi_desa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `wisata_lokal`
--
ALTER TABLE `wisata_lokal`
  MODIFY `id_wisata` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
