/*
SQLyog Community v12.15 (32 bit)
MySQL - 5.1.30-community : Database - travelelo
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`travelelo` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `travelelo`;

/*Table structure for table `bandara_tbl` */

DROP TABLE IF EXISTS `bandara_tbl`;

CREATE TABLE `bandara_tbl` (
  `kode` varchar(3) DEFAULT NULL,
  `keterangan` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `bandara_tbl` */

insert  into `bandara_tbl`(`kode`,`keterangan`) values 
('BTH','Bandar Udara Internasional Hang Nadim, Batam'),
('BTJ','Bandar Udara Internasional Sultan Iskandar Muda , Banda Aceh'),
('KNO','Bandar Udara Internasional Kualanamu, Deli Serdang'),
('DTB','Bandar Udara Internasional Silangit, Siborong-borong'),
('LSW','Bandar Udara Internasional Malikus Saleh, Lhokseumawe'),
('RGT','Bandar Udara Internasional Japura, Rengat'),
('MEQ','Bandar Udara Internasional Cut Nyak Dhien Nagan Raya, Nagan Raya'),
('PDG','Bandar Udara Internasional Minangkabau, Kota Padang'),
('PKU','Bandar Udara Internasional Sultan Syarif Kasim II, Pekanbaru'),
('PLM','Bandar Udara Internasional Sultan Mahmud Badaruddin II, Palembang'),
('TNJ','Bandar Udara Internasional Raja Haji Fisabilillah, Tanjungpinang'),
('TKG','Bandar Udara Internasional Radin Inten II Lampung Selatan, Lampung Selatan'),
('DJB','Bandar Udara Internasional Sultan Thaha, Kota Jambi'),
('BDO','Bandar Udara Internasional Husein Sastranegara, Bandung'),
('HLP','Bandar Udara Halim Perdanakusuma, Jakarta'),
('CGK','Bandar Udara Internasional Soekarno-Hatta, Tangerang'),
('JOG','Bandar Udara Internasional Adi Sucipto, Yogyakarta'),
('SOC','Bandar Udara Internasional Adisumarmo, Solo'),
('SRG','Bandar Udara Internasional Achmad Yani, Semarang'),
('SUB','Bandar Udara Internasional Juanda, Surabaya'),
('JBB','Bandar Udara Notohadinegoro, Jember'),
('BWX','Bandar Udara Blimbingsari, Banyuwangi'),
('DPS','Bandar Udara Internasional Ngurah Rai, Denpasar'),
('LOP','Bandar Udara Internasional Lombok, Lombok Tengah'),
('KOE','Bandar Udara Internasional El Tari, Kupang'),
('SWQ','Bandar Udara Sultan Muhammad Kaharuddin III, Sumbawa Besar'),
('PNK','Bandar Udara Internasional Supadio, Pontianak'),
('MLK','Bandar Udara Internasional Melalan, Sendawar, Kabupaten Kutai Barat'),
('PKY','Bandar Udara Internasional Tjilik Riwut , Palangka Raya'),
('SRI','Bandar Udara Temindung, Samarinda'),
('TRK','Bandar Udara Internasional Juwata, Tarakan'),
('BEJ','Bandar Udara Internasional Kalimarau, Berau'),
('BPN','Bandar Udara Internasional Sultan Aji Muhammad Sulaiman, Balikpapan'),
('PNK','Bandar Udara Internasional Supadio, Pontianak'),
('NNX','Bandar Udara Internasional Warukin, Tabalong'),
('BDJ','Bandar Udara Internasional Syamsuddin Noor, Banjarbaru'),
('MTW','Bandar Udara Internasional Beringin, Muara Teweh'),
('PLW','Bandar Udara Mutiara Sis Aljufri, Palu'),
('MDC','Bandar Udara Internasional Sam Ratulangi, Manado'),
('UPG','Bandar Udara Internasional Sultan Hasanuddin, Makassar'),
('KDI','Bandar Udara Internasional Haluoleo, Kendari'),
('LUW','Bandar Udara Syukuran Aminuddin Amir, Luwuk'),
('GTO','Bandar Udara Jalaluddin, Gorontalo'),
('WKB','Bandar Udara Matahora, Wangi-wangi'),
('TMI','Bandar Udara Maranggo, Pulau Tomia'),
('NBX','Bandar Udara Internasional Yos Sudarso, Nabire'),
('DJJ','Bandar udara Sentani, Jayapura'),
('BIK','Bandar Udara Frans Kaisiepo, Biak'),
('ORG','Bandara Internasional Iskak, Oksibil'),
('TMH','Bandar Udara Tanah Merah, Tanah Merah');

/*Table structure for table `detail_tbl` */

DROP TABLE IF EXISTS `detail_tbl`;

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

/*Data for the table `detail_tbl` */

insert  into `detail_tbl`(`no_invoice`,`jenis`,`tanggal_flight`,`asal`,`tujuan`,`harga_asli`,`markup`,`fee_azhar`) values 
('INV/2016/JUL/002','1','0000-00-00 00:00:00','','',500000,300000,0),
('INV/2016/JUL/002','0','2016-08-01 00:00:00','JOG','CGK',800000,450000,200000),
('INV/2016/JUL/002','0','2016-07-25 00:00:00','CGK','BPN',650000,500000,150000);

/*Table structure for table `invoice_tbl` */

DROP TABLE IF EXISTS `invoice_tbl`;

CREATE TABLE `invoice_tbl` (
  `no_invoice` varchar(16) DEFAULT NULL,
  `tgl_invoice` datetime DEFAULT NULL,
  `nama` varchar(40) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `invoice_tbl` */

insert  into `invoice_tbl`(`no_invoice`,`tgl_invoice`,`nama`) values 
('INV/2016/JUL/002','2016-07-16 00:00:00','Panji');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
