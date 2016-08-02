-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 02, 2016 at 08:47 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `travelelo`
--

-- --------------------------------------------------------

--
-- Table structure for table `bandara_tbl`
--

CREATE TABLE `bandara_tbl` (
  `kode` varchar(3) DEFAULT NULL,
  `keterangan` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bandara_tbl`
--

INSERT INTO `bandara_tbl` (`kode`, `keterangan`) VALUES
('BTH', 'Bandar Udara Internasional Hang Nadim, Batam'),
('BTJ', 'Bandar Udara Internasional Sultan Iskandar Muda , Banda Aceh'),
('KNO', 'Bandar Udara Internasional Kualanamu, Deli Serdang'),
('DTB', 'Bandar Udara Internasional Silangit, Siborong-borong'),
('LSW', 'Bandar Udara Internasional Malikus Saleh, Lhokseumawe'),
('RGT', 'Bandar Udara Internasional Japura, Rengat'),
('MEQ', 'Bandar Udara Internasional Cut Nyak Dhien Nagan Raya, Nagan Raya'),
('PDG', 'Bandar Udara Internasional Minangkabau, Kota Padang'),
('PKU', 'Bandar Udara Internasional Sultan Syarif Kasim II, Pekanbaru'),
('PLM', 'Bandar Udara Internasional Sultan Mahmud Badaruddin II, Palembang'),
('TNJ', 'Bandar Udara Internasional Raja Haji Fisabilillah, Tanjungpinang'),
('TKG', 'Bandar Udara Internasional Radin Inten II Lampung Selatan, Lampung Selatan'),
('DJB', 'Bandar Udara Internasional Sultan Thaha, Kota Jambi'),
('BDO', 'Bandar Udara Internasional Husein Sastranegara, Bandung'),
('HLP', 'Bandar Udara Halim Perdanakusuma, Jakarta'),
('CGK', 'Bandar Udara Internasional Soekarno-Hatta, Tangerang'),
('JOG', 'Bandar Udara Internasional Adi Sucipto, Yogyakarta'),
('SOC', 'Bandar Udara Internasional Adisumarmo, Solo'),
('SRG', 'Bandar Udara Internasional Achmad Yani, Semarang'),
('SUB', 'Bandar Udara Internasional Juanda, Surabaya'),
('JBB', 'Bandar Udara Notohadinegoro, Jember'),
('BWX', 'Bandar Udara Blimbingsari, Banyuwangi'),
('DPS', 'Bandar Udara Internasional Ngurah Rai, Denpasar'),
('LOP', 'Bandar Udara Internasional Lombok, Lombok Tengah'),
('KOE', 'Bandar Udara Internasional El Tari, Kupang'),
('SWQ', 'Bandar Udara Sultan Muhammad Kaharuddin III, Sumbawa Besar'),
('PNK', 'Bandar Udara Internasional Supadio, Pontianak'),
('MLK', 'Bandar Udara Internasional Melalan, Sendawar, Kabupaten Kutai Barat'),
('PKY', 'Bandar Udara Internasional Tjilik Riwut , Palangka Raya'),
('SRI', 'Bandar Udara Temindung, Samarinda'),
('TRK', 'Bandar Udara Internasional Juwata, Tarakan'),
('BEJ', 'Bandar Udara Internasional Kalimarau, Berau'),
('BPN', 'Bandar Udara Internasional Sultan Aji Muhammad Sulaiman, Balikpapan'),
('PNK', 'Bandar Udara Internasional Supadio, Pontianak'),
('NNX', 'Bandar Udara Internasional Warukin, Tabalong'),
('BDJ', 'Bandar Udara Internasional Syamsuddin Noor, Banjarbaru'),
('MTW', 'Bandar Udara Internasional Beringin, Muara Teweh'),
('PLW', 'Bandar Udara Mutiara Sis Aljufri, Palu'),
('MDC', 'Bandar Udara Internasional Sam Ratulangi, Manado'),
('UPG', 'Bandar Udara Internasional Sultan Hasanuddin, Makassar'),
('KDI', 'Bandar Udara Internasional Haluoleo, Kendari'),
('LUW', 'Bandar Udara Syukuran Aminuddin Amir, Luwuk'),
('GTO', 'Bandar Udara Jalaluddin, Gorontalo'),
('WKB', 'Bandar Udara Matahora, Wangi-wangi'),
('TMI', 'Bandar Udara Maranggo, Pulau Tomia'),
('NBX', 'Bandar Udara Internasional Yos Sudarso, Nabire'),
('DJJ', 'Bandar udara Sentani, Jayapura'),
('BIK', 'Bandar Udara Frans Kaisiepo, Biak'),
('ORG', 'Bandara Internasional Iskak, Oksibil'),
('TMH', 'Bandar Udara Tanah Merah, Tanah Merah');

-- --------------------------------------------------------

--
-- Table structure for table `detail_tbl`
--

CREATE TABLE `detail_tbl` (
  `no_invoice` varchar(16) DEFAULT NULL,
  `jenis` varchar(1) DEFAULT NULL,
  `tanggal_flight` datetime DEFAULT NULL,
  `asal` varchar(5) DEFAULT NULL,
  `tujuan` varchar(5) DEFAULT NULL,
  `harga_asli` int(9) DEFAULT NULL,
  `markup` int(9) DEFAULT NULL,
  `fee_azhar` int(9) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_tbl`
--

INSERT INTO `detail_tbl` (`no_invoice`, `jenis`, `tanggal_flight`, `asal`, `tujuan`, `harga_asli`, `markup`, `fee_azhar`) VALUES
('INV/2016/AGU/002', '0', '2016-08-15 00:00:00', 'BTH', 'BDO', 700000, 300000, 150000),
('INV/2016/AGU/001', '1', '0000-00-00 00:00:00', '', '', 500000, 200000, 100000),
('INV/2016/AGU/001', '0', '2016-08-15 00:00:00', 'BTH', 'BDO', 700000, 200000, 150000),
('INV/2016/AGU/003', '0', '2016-08-15 00:00:00', 'BTH', 'HLP', 600000, 400000, 150000),
('INV/2016/AGU/004', '0', '2016-08-08 00:00:00', 'BTH', 'BDO', 300000, 300000, 150000),
('INV/2016/AGU/004', '0', '2016-08-15 00:00:00', 'BDO', 'BTH', 400000, 200000, 150000),
('INV/2016/AGU/006', '0', '2016-08-22 00:00:00', 'BTH', 'CGK', 700000, 300000, 150000),
('INV/2016/AGU/005', '0', '2016-08-30 00:00:00', 'CGK', 'BDO', 200000, 100000, 150000),
('INV/2016/AGU/005', '0', '2016-08-29 00:00:00', 'CGK', 'BDO', 300000, 220000, 150000),
('INV/2016/AGU/007', '0', '2016-08-22 00:00:00', 'CGK', 'BDO', 300000, 300000, 150000),
('INV/2016/AGU/008', '0', '2016-08-29 00:00:00', 'BTH', 'BTJ', 900000, 400000, 150000),
('INV/2016/AGU/008', '0', '2016-08-30 00:00:00', 'BTJ', 'BTH', 1000000, 200000, 150000),
('INV/2016/AGU/009', '0', '2016-08-29 00:00:00', 'CGK', 'PKU', 600000, 300000, 150000);

-- --------------------------------------------------------

--
-- Table structure for table `invoice_tbl`
--

CREATE TABLE `invoice_tbl` (
  `no_invoice` varchar(16) DEFAULT NULL,
  `tgl_invoice` datetime DEFAULT NULL,
  `nama` varchar(40) DEFAULT NULL,
  `invoice_group` varchar(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoice_tbl`
--

INSERT INTO `invoice_tbl` (`no_invoice`, `tgl_invoice`, `nama`, `invoice_group`) VALUES
('INV/2016/AGU/001', '2016-08-02 00:00:00', 'Panji', 'AGU2016/001'),
('INV/2016/AGU/002', '2016-08-02 00:00:00', 'Migal', 'AGU2016/002'),
('INV/2016/AGU/003', '2016-08-02 00:00:00', 'Oji', 'AGU2016/002'),
('INV/2016/AGU/004', '2016-08-02 00:00:00', 'said', 'AGU2016/001'),
('INV/2016/AGU/006', '2016-08-02 00:00:00', 'panji', 'AGU2016/003'),
('INV/2016/AGU/005', '2016-08-02 00:00:00', '', 'AGU2016/002'),
('INV/2016/AGU/007', '2016-08-02 00:00:00', 'said', 'AGU2016/003'),
('INV/2016/AGU/008', '2016-08-02 00:00:00', 'migal', 'AGU2016/003'),
('INV/2016/AGU/009', '2016-08-02 00:00:00', 'lito', 'AGU2016/003');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
