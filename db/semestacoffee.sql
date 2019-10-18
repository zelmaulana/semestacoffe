-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 19, 2019 at 12:07 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `semestacoffee`
--

-- --------------------------------------------------------

--
-- Table structure for table `l_jenis`
--

CREATE TABLE `l_jenis` (
  `jenis_id` int(11) NOT NULL,
  `jenis_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `l_jenis`
--

INSERT INTO `l_jenis` (`jenis_id`, `jenis_name`) VALUES
(1, 'Buku'),
(2, 'Jurnal'),
(3, 'Accecoris');

-- --------------------------------------------------------

--
-- Table structure for table `l_jenis_pemesanan`
--

CREATE TABLE `l_jenis_pemesanan` (
  `jenis_pemesanan_id` int(11) NOT NULL,
  `jenis_pemesanan_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `l_jenis_pemesanan`
--

INSERT INTO `l_jenis_pemesanan` (`jenis_pemesanan_id`, `jenis_pemesanan_name`) VALUES
(1, 'Pribadi'),
(2, 'Reseller');

-- --------------------------------------------------------

--
-- Table structure for table `l_kategori`
--

CREATE TABLE `l_kategori` (
  `kategori_id` int(11) NOT NULL,
  `kategori_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `l_kategori`
--

INSERT INTO `l_kategori` (`kategori_id`, `kategori_name`) VALUES
(1, 'Single Original'),
(2, 'Espresso Based'),
(3, 'Milk Based'),
(4, 'Food'),
(5, 'Snack');

-- --------------------------------------------------------

--
-- Table structure for table `l_level`
--

CREATE TABLE `l_level` (
  `level_id` int(11) NOT NULL,
  `level_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `l_level`
--

INSERT INTO `l_level` (`level_id`, `level_name`) VALUES
(1, 'Admin'),
(2, 'Pengguna');

-- --------------------------------------------------------

--
-- Table structure for table `l_meja`
--

CREATE TABLE `l_meja` (
  `id_meja` int(11) NOT NULL,
  `nama_meja` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `l_meja`
--

INSERT INTO `l_meja` (`id_meja`, `nama_meja`) VALUES
(1, 'Meja 1'),
(2, 'Meja 2'),
(3, 'Meja 3'),
(4, 'Meja 4'),
(5, 'Meja 5'),
(6, 'Meja 6'),
(7, 'Meja 7'),
(8, 'Meja 8'),
(9, 'Meja 9'),
(10, 'Meja 10'),
(11, 'Meja 11'),
(12, 'Meja 12'),
(13, 'Meja 13'),
(14, 'Meja 14'),
(15, 'Meja 15'),
(16, 'Meja 16'),
(17, 'Meja 17'),
(18, 'Meja 18'),
(19, 'Meja 19'),
(20, 'Meja 20');

-- --------------------------------------------------------

--
-- Table structure for table `l_status`
--

CREATE TABLE `l_status` (
  `status_id` int(11) NOT NULL,
  `status_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `l_status`
--

INSERT INTO `l_status` (`status_id`, `status_name`) VALUES
(1, '-'),
(2, 'Order'),
(3, 'Verified'),
(4, 'Dikirim'),
(5, 'Lunas');

-- --------------------------------------------------------

--
-- Table structure for table `m_alamat`
--

CREATE TABLE `m_alamat` (
  `user_id` int(11) NOT NULL,
  `alamat_spesifik` varchar(100) NOT NULL,
  `desa_id` char(11) NOT NULL,
  `rt` varchar(5) NOT NULL,
  `rw` varchar(5) NOT NULL,
  `kecamatan_id` char(11) NOT NULL,
  `kabupaten_id` char(11) NOT NULL,
  `propinsi_id` char(11) NOT NULL,
  `kode_pos` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_alamat`
--

INSERT INTO `m_alamat` (`user_id`, `alamat_spesifik`, `desa_id`, `rt`, `rw`, `kecamatan_id`, `kabupaten_id`, `propinsi_id`, `kode_pos`) VALUES
(1, '', '', '', '', '', '', '', ''),
(2, 'Purwokerto Utara', '', '', '', '', '', '', ''),
(3, 'uiu', '', '', '', '', '', '', ''),
(4, '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `m_barang`
--

CREATE TABLE `m_barang` (
  `brg_id` int(11) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `estimasi_menu` varchar(255) NOT NULL,
  `stok` int(11) NOT NULL,
  `jenis_id` int(11) DEFAULT NULL,
  `kategori_id` int(11) NOT NULL,
  `harga_beli` int(11) NOT NULL,
  `harga_jual` int(11) NOT NULL,
  `jml_terjual` int(11) NOT NULL,
  `diskon` double(8,2) NOT NULL,
  `image` varchar(100) NOT NULL,
  `deskripsi` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_barang`
--

INSERT INTO `m_barang` (`brg_id`, `judul`, `estimasi_menu`, `stok`, `jenis_id`, `kategori_id`, `harga_beli`, `harga_jual`, `jml_terjual`, `diskon`, `image`, `deskripsi`) VALUES
(5, 'Tubruk (Arabica)', '20 menit', 98, 1, 1, 6000, 9000, 4, 5.00, 'coffee-480x385.jpg', 'Coffee, Water'),
(7, 'Tubruk (Robusta)', '20 menit', 100, 1, 1, 6000, 8000, 0, 0.00, 'coffee-480x385.jpg', 'Coffee, Water'),
(8, 'V60 (Arabica)', '40 menit', 100, 1, 1, 6000, 11000, 0, 0.00, 'coffee-480x385.jpg', 'Using hario V60, has a clean extraction'),
(9, 'V60 (Robusta)', '20 menit', 97, 1, 1, 6000, 11000, 9, 0.00, 'coffee-480x385.jpg', 'Using hario V60, has a clean extraction'),
(10, 'Espresso (Hot)', '20 menit', 100, 1, 2, 6000, 10000, 0, 0.00, 'coffee-480x385.jpg', 'High pressure of hot water in 30 seconds'),
(11, 'Espresso (Ice)', '20 menit', 100, 1, 2, 6000, 11000, 0, 0.00, 'coffee-480x385.jpg', 'High pressure of hot water in 30 seconds'),
(12, 'Americano (Hot)', '20 menit', 100, 1, 2, 6000, 11000, 0, 0.00, 'coffee-480x385.jpg', 'Hot water and espresso, light taste and body'),
(21, 'Americano (Ice)', '40 menit', 100, 1, 2, 6000, 12000000, 0, 20.00, 'coffee-480x385.jpg', 'Hot water and espresso, light taste and body'),
(22, 'Susu Murni (Hot)', '20 menit', 100, 1, 3, 6000, 6000, 0, 0.00, 'coffee-480x385.jpg', 'Milk based'),
(23, 'Susu Murni (Ice)', '20 menit', 100, 1, 3, 6000, 7000, 0, 0.00, 'coffee-480x385.jpg', 'Milk based'),
(24, 'Susu Aren (Hot)', '40 menit', 100, 1, 3, 6000, 10000, 0, 0.00, 'coffee-480x385.jpg', 'Milk based'),
(25, 'Susu Aren (Ice)', '20 menit', 100, 1, 3, 6000, 11000, 0, 5.00, 'coffee-480x385.jpg', 'Milk based'),
(26, 'Ayam Senja', '40 menit', 100, 1, 2, 6000, 15000, 0, 5.00, 'coffee-480x385.jpg', 'Food'),
(27, 'Semesta Noodle', '40 menit', 100, 1, 2, 6000, 8000, 0, 0.00, 'coffee-480x385.jpg', 'Food'),
(28, 'Lele Balada', '40 menit', 100, 1, 5, 6000, 15000, 0, 0.00, 'coffee-480x385.jpg', 'Food'),
(29, 'French Fries', '20 menit', 100, 1, 3, 6000, 9000, 0, 0.00, 'coffee-480x385.jpg', 'Snack'),
(30, 'Oppa Toast', '40 menit', 100, 1, 4, 6000, 8000, 0, 10.00, 'coffee-480x385.jpg', 'Snack'),
(31, 'Ice Cream', '40 menit', 100, 1, 2, 6000, 8000, 0, 0.00, 'coffee-480x385.jpg', 'Snack'),
(32, 'Brownies', '20 menit', 99, 1, 3, 6000, 10000, 1, 0.00, 'brownies.jpg', 'Brownies'),
(33, 'Singkong Crispy', '20 menit', 100, 1, 3, 6000, 7000, 0, 0.00, 'coffee-480x385.jpg', 'Singkong Crispy'),
(34, 'Kopiko', '40 menit', 100, 1, 1, 6000, 9000, 0, 0.00, 'coffee-480x385.jpg', 'Kopiko'),
(35, 'Kopi Tubruk', '3', 100, 1, 1, 7000, 15000, 0, 10.00, 'coffee-480x385.jpg', 'Okok'),
(36, 'Coklat Semesta', '2', 100, 1, 4, 7000, 10000, 0, 30.00, 'coffee-480x385.jpg', 'coklat semesta'),
(37, 'Nasi Saus Padang', '15', 100, 1, 5, 7000, 10000, 0, 30.00, 'coffee-480x385.jpg', 'nasi saus padang semesta');

-- --------------------------------------------------------

--
-- Table structure for table `m_user`
--

CREATE TABLE `m_user` (
  `user_id` int(11) NOT NULL,
  `user_nama` varchar(100) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_nohp` varchar(13) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_jeniskelamin` varchar(255) DEFAULT NULL,
  `user_ttl` date DEFAULT NULL,
  `user_image` varchar(100) NOT NULL,
  `no_verif` varchar(6) NOT NULL,
  `status` varchar(100) NOT NULL,
  `level_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_user`
--

INSERT INTO `m_user` (`user_id`, `user_nama`, `user_password`, `user_nohp`, `user_email`, `user_jeniskelamin`, `user_ttl`, `user_image`, `no_verif`, `status`, `level_id`) VALUES
(1, 'Administrator', 'e10adc3949ba59abbe56e057f20f883e', '085642988418', 'semesta@gmail.com', '', '0000-00-00', 'nothing.png', '000000', 'verif', 1),
(2, 'Lukni Maulana', 'e10adc3949ba59abbe56e057f20f883e', '085642988418', 'lukni94@gmail.com', 'L', '1994-07-05', 'nothing.png', '000000', 'verif', 2),
(3, 'Aris', 'e10adc3949ba59abbe56e057f20f883e', '085642988418', 'aris@gmail.com', 'L', '2019-09-23', 'nothing.png', '000000', 'verif', 2),
(4, 'Fajar', 'e10adc3949ba59abbe56e057f20f883e', '085642988418', 'fajar@gmail.com', '', '0000-00-00', 'nothing.png', '000000', 'verif', 2);

-- --------------------------------------------------------

--
-- Table structure for table `t_keranjang`
--

CREATE TABLE `t_keranjang` (
  `keranjang_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `brg_id` int(11) NOT NULL,
  `hargabarang` int(11) DEFAULT NULL,
  `jumlah_trx` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `ip` varchar(20) DEFAULT NULL,
  `pemesanan_id` int(11) DEFAULT '1',
  `hargadiskon` double DEFAULT '0',
  `jenis_pemesanan_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_keranjang`
--

INSERT INTO `t_keranjang` (`keranjang_id`, `user_id`, `brg_id`, `hargabarang`, `jumlah_trx`, `total`, `ip`, `pemesanan_id`, `hargadiskon`, `jenis_pemesanan_id`) VALUES
(3, 2, 37, 10000, 1, 7000, '::1 ', 1, 7000, 1);

-- --------------------------------------------------------

--
-- Table structure for table `t_order`
--

CREATE TABLE `t_order` (
  `id` int(11) NOT NULL,
  `nobill` varchar(45) DEFAULT NULL,
  `catatan` varchar(500) DEFAULT NULL,
  `tanggal` varchar(20) DEFAULT NULL,
  `userid` int(11) DEFAULT NULL,
  `total` double DEFAULT NULL,
  `nomeja` varchar(2) DEFAULT NULL,
  `ip` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_order`
--

INSERT INTO `t_order` (`id`, `nobill`, `catatan`, `tanggal`, `userid`, `total`, `nomeja`, `ip`) VALUES
(1, '000001', '', '17-10-2019 21:01:27', 2, 33000, '6', '::1'),
(2, '000002', '', '17-10-2019 21:02:00', 2, 17100, '13', '::1'),
(3, '000003', '', '18-10-2019 16:46:29', 2, 10000, '19', '::1');

-- --------------------------------------------------------

--
-- Table structure for table `t_pemesanan`
--

CREATE TABLE `t_pemesanan` (
  `pemesanan_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `total` double NOT NULL,
  `status_id` int(11) NOT NULL DEFAULT '0',
  `tanggal` varchar(20) DEFAULT NULL,
  `nobill` varchar(45) DEFAULT NULL,
  `brg_id` int(11) DEFAULT NULL,
  `hargabarang` double DEFAULT NULL,
  `hargadiskon` double DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `ip` varchar(20) NOT NULL,
  `jenis_pemesanan_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_pemesanan`
--

INSERT INTO `t_pemesanan` (`pemesanan_id`, `user_id`, `total`, `status_id`, `tanggal`, `nobill`, `brg_id`, `hargabarang`, `hargadiskon`, `qty`, `ip`, `jenis_pemesanan_id`) VALUES
(1, 2, 33000, 5, '17-10-2019 21:01:27', '000001', 9, 11000, 11000, 3, '::1', 1),
(2, 2, 17100, 2, '17-10-2019 21:02:00', '000002', 5, 9000, 8550, 2, '::1', 1),
(3, 2, 10000, 4, '18-10-2019 16:46:29', '000003', 32, 10000, 10000, 1, '::1', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `l_jenis`
--
ALTER TABLE `l_jenis`
  ADD PRIMARY KEY (`jenis_id`);

--
-- Indexes for table `l_jenis_pemesanan`
--
ALTER TABLE `l_jenis_pemesanan`
  ADD PRIMARY KEY (`jenis_pemesanan_id`);

--
-- Indexes for table `l_kategori`
--
ALTER TABLE `l_kategori`
  ADD PRIMARY KEY (`kategori_id`);

--
-- Indexes for table `l_level`
--
ALTER TABLE `l_level`
  ADD PRIMARY KEY (`level_id`);

--
-- Indexes for table `l_meja`
--
ALTER TABLE `l_meja`
  ADD PRIMARY KEY (`id_meja`);

--
-- Indexes for table `l_status`
--
ALTER TABLE `l_status`
  ADD PRIMARY KEY (`status_id`);

--
-- Indexes for table `m_alamat`
--
ALTER TABLE `m_alamat`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `m_barang`
--
ALTER TABLE `m_barang`
  ADD PRIMARY KEY (`brg_id`);

--
-- Indexes for table `m_user`
--
ALTER TABLE `m_user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `t_keranjang`
--
ALTER TABLE `t_keranjang`
  ADD PRIMARY KEY (`keranjang_id`);

--
-- Indexes for table `t_order`
--
ALTER TABLE `t_order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_pemesanan`
--
ALTER TABLE `t_pemesanan`
  ADD PRIMARY KEY (`pemesanan_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `l_jenis`
--
ALTER TABLE `l_jenis`
  MODIFY `jenis_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `l_jenis_pemesanan`
--
ALTER TABLE `l_jenis_pemesanan`
  MODIFY `jenis_pemesanan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `l_kategori`
--
ALTER TABLE `l_kategori`
  MODIFY `kategori_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `l_level`
--
ALTER TABLE `l_level`
  MODIFY `level_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `l_meja`
--
ALTER TABLE `l_meja`
  MODIFY `id_meja` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `l_status`
--
ALTER TABLE `l_status`
  MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `m_alamat`
--
ALTER TABLE `m_alamat`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `m_barang`
--
ALTER TABLE `m_barang`
  MODIFY `brg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `m_user`
--
ALTER TABLE `m_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `t_keranjang`
--
ALTER TABLE `t_keranjang`
  MODIFY `keranjang_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `t_order`
--
ALTER TABLE `t_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `t_pemesanan`
--
ALTER TABLE `t_pemesanan`
  MODIFY `pemesanan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
