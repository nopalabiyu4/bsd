-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 25 Feb 2024 pada 13.52
-- Versi server: 10.4.21-MariaDB
-- Versi PHP: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nopal`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `buku`
--

CREATE TABLE `buku` (
  `cover` varchar(255) NOT NULL,
  `id_buku` varchar(25) NOT NULL,
  `kategori` varchar(255) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `pengarang` varchar(255) NOT NULL,
  `penerbit` varchar(255) NOT NULL,
  `thn_terbit` date NOT NULL,
  `jml_halaman` int(11) NOT NULL,
  `deskripsi` text NOT NULL,
  `isi_buku` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `buku`
--

INSERT INTO `buku` (`cover`, `id_buku`, `kategori`, `judul`, `pengarang`, `penerbit`, `thn_terbit`, `jml_halaman`, `deskripsi`, `isi_buku`) VALUES
('65d1f4c83efe9.png', 'KB0001', 'Romance', 'Dilan 1990', 'Pidi Baiq', 'Bandung Mizan Pustaka 2018', '2014-02-18', 348, '“Dilan : Dia Adalah Dilanku Tahun 1990” bercerita tentang kisah cinta dua remaja Bandung pada tahun 90an. Berawal dari seorang siswa bernama Dilan yang jatuh cinta dengan siswi pindahan dari SMA di Jakarta bernama Milea. Dilan memiliki beragam cara untuk mendekati dan mencuri perhatian Milea.', 'Dilan 1990.pdf'),
('65d1fea4800c6.png', 'KB0002', 'Romance', 'Dilan 1991', 'Pidi Baiq', 'Pastel Books', '2015-02-18', 344, 'Dilan 1991 merupakan salah satu novel bergenre teenlit yang didalamnya menceritakan kisah cinta para remaja SMA dan cerita-cerita tentang persahabatan antar tokohnya. Novel ini mengisahkan cerita lanjutan dari novel pertamanya yaitu Dilan 1990, di novel ini diceritakan tentang Dilan dan Milea yang sudah menjalani hubungan pacaran.', 'Dilan 1991.pdf'),
('65d1fff67ebc3.jpeg', 'KB0003', 'Sejarah', 'Sejarah Dunia Yang Disembunyikan', 'Jonathan Black', 'Alvabet', '2015-05-15', 636, 'Buku Sejarah Dunia Yang Disembunyikan yang ditulis oleh Jonathan Black merupakan buku yang mengungkapkan tentang keraguan dan kepercayaan kita akan sejarah mitologi Yunani dan Mesir Kuno serta cerita rakyat Yahudi yang tidak dapat kita lihat langsung kebenarannya.', 'Sejarah Dunia Yang Disembunyikan.pdf'),
('65d20147c69a7.jpeg', 'KB0004', 'Dongeng', 'Kalah Oleh Si Cerdik', 'Atisah', 'Badan Pengembangan dan Pembinaan Bahasa ', '2017-02-18', 54, 'Di sebuah hutan ada sumber air yang tidak pernah kering. Airnya jernih dan mengalir ke sebuah telaga. Semua binatang yang menjadi warga di hutan itu minum dari  sumber  air yang sama. Setiap golongan binatang sudah mempunyai jadwal tidak tertulis untuk bergiliran minum.', 'Kalah Oleh Si Cerdik.pdf'),
('65d202d44b596.jpeg', 'KB0005', 'Dongeng', 'Timun Emas', 'Bening Sanubari', 'PT Balai Pustaka (Persero)', '2011-02-18', 56, 'Timun Mas atau Timun Emas (Jawa: &quot;mentimun emas&quot;). Adalah cerita rakyat Jawa menceritakan kisah seorang gadis pemberani yang mencoba untuk bertahan dan melarikan diri dari raksasa hijau jahat yang mencoba untuk menangkap dan memakannya.', 'Timun Mas.pdf'),
('65d203b631b8a.jpeg', 'KB0006', 'Komedi', 'Si Juki Komik Strip', 'Faza Meonk', 'Bukune', '2014-10-12', 164, 'Buku ini merupakan komik yang mengisahkan perjalanan berkarya komikus dan Juki sebagai tokoh utama komiknya dari tahun 2012 hingga 2014. Dalam membuat komik, Faza Meonk sebagai komikus mengambil ide cerita dari isu-isu yang hangat dibicarakan atau bahasa gaulnya ngetrend. Ia tak hanya ingin membuat komik untuk tujuan lucu-lucuan, tapi juga ingin menyampaikan pesan untuk anak muda mengenai isu-isu sosial dengan gaya sarkasme yang ringan tak seberat isu politik.', 'Si Juki Komik Strip.pdf'),
('65d205f4811c7.png', 'KB0007', 'Biografi', 'Sebuah Seni Untuk Bersikap Bodoamat', 'Mark Manson', 'Gramedia Widiasarana Indonesia', '2009-04-19', 256, '“Dalam hidup ini, kita hanya punya kepedulian dalam jumlah yang terbatas. Makanya, Anda harus bijaksana dalam menentukan kepedulian Anda.” Manson menciptakan momen perbincangan yang serius dan mendalam, dibungkus dengan cerita-cerita yang menghibur dan “kekinian”, serta humor yang cadas. Buku ini merupakan tamparan di wajah yang menyegarkan untuk kita semua, supaya kita bisa mulai menjalani kehidupan yang lebih memuaskan, dan apa adanya.&quot;', 'Sebuah Seni Untuk Bersikap Bodo Amat.pdf'),
('65d2069653987.jpeg', 'KB0008', 'Biografi', 'Rich Dad Poor Dad', 'Robert Kiyosaki ', 'Gramedia Pustaka Utama', '2016-09-21', 244, 'Rich Dad Poor Dad adalah buku tahun 1997 karya Robert Kiyosaki dan Sharon Lechter. Rich Dad, Poor Dad adalah buku yang membahas masalah finansial yang dihadapi banyak orang dikarenakan ajaran keliru orang tua mereka mengenai keuangan, yang juga dialaminya semasa kecil dan remaja.', 'Rich Dad Poor Dad.pdf'),
('65d2072157491.jpeg', 'KB0009', 'Biografi', 'Nunchi Seni Membaca Pikiran dan Perasaan Orang Lain', 'Euny Hong', 'Gramedia Pustaka Utama', '2020-05-14', 271, 'Nunchi, indra keenam orang Korea untuk membaca keadaan dan memahami apa yang dipikirkan dan dirasakan orang lain, telah dipraktikkan selama lebih dari 5.000 tahun dan diyakini telah melambungkan Korea dari salah satu negara termiskin menjadi salah satu negara paling maju di dunia.', 'Nunchi Seni Membaca Pikiran dan Perasaan Orang Lain.pdf'),
('65d207bbf2998.jpeg', 'KB0010', 'Biografi', 'Berani Tidak Disukai', 'Ichiro Kishimi dan Fumitake Koga', 'Gramedia Pustaka Utama', '2019-10-08', 350, 'Berani Tidak Disukai, mengungkap rahasia mengeluarkan kekuatan terpendam yang memungkinkan Anda meraih kebahagiaan yang hakiki dan menjadi sosok yang Anda idam-idamkan.', 'Berani Tidak Disukai.pdf');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori_buku`
--

CREATE TABLE `kategori_buku` (
  `kategori` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kategori_buku`
--

INSERT INTO `kategori_buku` (`kategori`) VALUES
('Biografi'),
('Dongeng'),
('Komedi'),
('Romance'),
('Sejarah');

-- --------------------------------------------------------

--
-- Struktur dari tabel `member`
--

CREATE TABLE `member` (
  `nisn` int(50) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `kelas` varchar(50) NOT NULL,
  `jurusan` varchar(50) NOT NULL,
  `alamat` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `member`
--

INSERT INTO `member` (`nisn`, `nama`, `password`, `kelas`, `jurusan`, `alamat`) VALUES
(212210141, 'noval', '123', 'XII', 'Rekayasa Perangkat Lunak', 'Bogor');

-- --------------------------------------------------------

--
-- Struktur dari tabel `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id` int(11) NOT NULL,
  `id_buku` varchar(20) NOT NULL,
  `nisn` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `tgl_pinjam` date NOT NULL,
  `tgl_kembali` date NOT NULL,
  `harga` varchar(50) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `sebagai` varchar(50) NOT NULL,
  `no_tlp` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `nama`, `sebagai`, `no_tlp`) VALUES
(36, 'novalabiyu', '123', 'abiyuuuu', 'petugas', '0895337027010'),
(41, 'admin', '123', 'novalabiyu', 'admin', '089573823182');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id_buku`),
  ADD KEY `kategori` (`kategori`);

--
-- Indeks untuk tabel `kategori_buku`
--
ALTER TABLE `kategori_buku`
  ADD PRIMARY KEY (`kategori`);

--
-- Indeks untuk tabel `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`nisn`);

--
-- Indeks untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nis` (`nisn`),
  ADD KEY `id_buku` (`id_buku`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `member`
--
ALTER TABLE `member`
  MODIFY `nisn` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=212210142;

--
-- AUTO_INCREMENT untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `buku`
--
ALTER TABLE `buku`
  ADD CONSTRAINT `buku_ibfk_1` FOREIGN KEY (`kategori`) REFERENCES `kategori_buku` (`kategori`);

--
-- Ketidakleluasaan untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD CONSTRAINT `peminjaman_ibfk_1` FOREIGN KEY (`nisn`) REFERENCES `member` (`nisn`),
  ADD CONSTRAINT `peminjaman_ibfk_3` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `peminjaman_ibfk_4` FOREIGN KEY (`id_buku`) REFERENCES `buku` (`id_buku`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
