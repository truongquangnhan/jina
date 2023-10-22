-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.28-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             12.5.0.6677
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for jina
DROP DATABASE IF EXISTS `jina`;
CREATE DATABASE IF NOT EXISTS `jina` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `jina`;

-- Dumping structure for procedure jina.add_donhang_shiper
DROP PROCEDURE IF EXISTS `add_donhang_shiper`;
DELIMITER //
CREATE PROCEDURE `add_donhang_shiper`(
dh int,
tk int
)
begin
DECLARE sql_error INT DEFAULT FALSE;
DECLARE CONTINUE HANDLER FOR SQLEXCEPTION
    SET sql_error = TRUE;
start transaction;
insert into shiperdonhang(iddh,idtk)
values(dh,tk);
if sql_error = true then
rollback;
else 
commit;
end if;
end//
DELIMITER ;

-- Dumping structure for procedure jina.admin_hienthidonhang
DROP PROCEDURE IF EXISTS `admin_hienthidonhang`;
DELIMITER //
CREATE PROCEDURE `admin_hienthidonhang`()
begin
DECLARE sql_error INT DEFAULT FALSE;
  DECLARE CONTINUE HANDLER FOR SQLEXCEPTION
    SET sql_error = TRUE;
start transaction;
select dh.iddh,tk.idtk,dh.tennguoinhan,dh.diachinhan,dh.sdtnhan,ttdh.mota as 'trangthai',dh.ngaytaodh,
	(select tk2.hovaten 
	from taikhoan tk2 inner join shiperdonhang sdh 
	on tk2.idtk = sdh.idtk inner join donhang dh2 
	on dh2.iddh = sdh.iddh 
	where dh2.iddh = dh.iddh) as 'nguoigiaohang',dh.tongtien
from donhang dh inner join taikhoan tk
on dh.idtk = tk.idtk
inner join trangthaidonhang ttdh
on dh.trangthaidh = ttdh.trangthaidh
-- đơn hàng đã xát nhận tiền sẽ được xem như là hoàng tất
where dh.trangthaidh != 'E' and dh.trangthaidh != 'A';
if sql_error = true then
rollback;
else 
commit;
end if;
end//
DELIMITER ;

-- Dumping structure for procedure jina.admin_hoangtatdonhang
DROP PROCEDURE IF EXISTS `admin_hoangtatdonhang`;
DELIMITER //
CREATE PROCEDURE `admin_hoangtatdonhang`(
madonhang int
)
begin
DECLARE sql_error INT DEFAULT FALSE;
  DECLARE CONTINUE HANDLER FOR SQLEXCEPTION
    SET sql_error = TRUE;
start transaction;
update donhang
set trangthaidh = 'E'
where iddh = madonhang;
if sql_error = true then
rollback;
else 
commit;
end if;
end//
DELIMITER ;

-- Dumping structure for procedure jina.admin_quanlytaikhoan
DROP PROCEDURE IF EXISTS `admin_quanlytaikhoan`;
DELIMITER //
CREATE PROCEDURE `admin_quanlytaikhoan`()
begin
DECLARE sql_error INT DEFAULT FALSE;
  DECLARE CONTINUE HANDLER FOR SQLEXCEPTION
    SET sql_error = TRUE;
start transaction;
select idtk,usname,q.mota as 'quyen', tthd.mota as 'trangthai',hovaten,diachi,sdt,email,ngaytaotk
from taikhoan t inner join quyennv q
on t.quyen = q.quyen
inner join trangthaihoatdong tthd
on t.trangthai = tthd.trangthai
where q.quyen <> "D";
if sql_error = true then
rollback;
else 
commit;
end if;
end//
DELIMITER ;

-- Dumping structure for procedure jina.admin_themsanpham
DROP PROCEDURE IF EXISTS `admin_themsanpham`;
DELIMITER //
CREATE PROCEDURE `admin_themsanpham`(
-- điện thoại
kho int,
ten varchar(30),
loai varchar(20) ,
tong int(11) ,
hang varchar(20) ,
gban decimal(18,0), 
gnhap decimal(18,0), 
-- chi tiết   --------------------------
hdh varchar(30), 
pb varchar(100) ,
dpgmh varchar(30), 
ct varchar(30) ,
cs varchar(30) ,
sim varchar(30) ,
wifi varchar(30) ,
bluetoolh varchar(30) ,
pin varchar(30) ,
baomat varchar(30), 
ram varchar(20) ,
bonhotrong varchar(20) ,
hinhanh varchar(100) ,
thongtinkhac varchar(100)
)
begin
declare idselect int;
DECLARE sql_error INT DEFAULT FALSE;
DECLARE CONTINUE HANDLER FOR SQLEXCEPTION
SET sql_error = TRUE;
start transaction;
 insert into dienthoai(idkho,tendt,loaimay,tongsl,soluongcon,hangdt,giaban,gianhap)
 values(kho,ten ,loai ,tong ,tong, hang  ,gban , gnhap);
 select iddt into idselect
 from dienthoai
 where idkho = kho and tendt = ten and loaimay = loai and tongsl = tong and hangdt = hang and gianhap = gnhap;
 insert into chitietdienthoai(iddt,hedieuhanh, phienban,dophangiaimh, cameratruoc,camerasau,sim,wifi,bluetoolh,pin,baomat,ram,bonhotrong,hinhanh,thongtinkhac)
 values(idselect,hdh, pb ,dpgmh, ct ,cs ,sim ,wifi ,bluetoolh ,pin ,baomat,ram,bonhotrong,hinhanh ,thongtinkhac);
 
if sql_error = true then
rollback;
else 
commit;
end if;
end//
DELIMITER ;

-- Dumping structure for procedure jina.admin_updatesanpham
DROP PROCEDURE IF EXISTS `admin_updatesanpham`;
DELIMITER //
CREATE PROCEDURE `admin_updatesanpham`(
iddtx int,
-- điện thoại
kho int,
ten varchar(30),
loai varchar(20) ,
tong int(11) ,
hang varchar(20) ,
gban decimal(18,0), 
gnhap decimal(18,0), 
-- chi tiết   --------------------------
hdh varchar(30), 
pb varchar(100) ,
dpgmh varchar(30), 
ct varchar(30) ,
cs varchar(30) ,
sim varchar(30) ,
wifi varchar(30) ,
bluetoolh varchar(30) ,
pin varchar(30) ,
baomat varchar(30), 
ram varchar(20) ,
bonhotrong varchar(20) ,
hinhanh varchar(100) ,
thongtinkhac varchar(100)
)
begin
declare idselect int;
DECLARE sql_error INT DEFAULT FALSE;
DECLARE CONTINUE HANDLER FOR SQLEXCEPTION
SET sql_error = TRUE;
start transaction;
update dienthoai
set idkho = kho,
tendt=ten,
loaimay =loai,
tongsl  =tong,
hangdt =hang,
giaban =gban,
gianhap =gnhap
where iddt = iddtx;
update chitietdienthoai
set hedieuhanh = hdh,
phienban = pb,
dophangiaimh = dpgmh,
cameratruoc = ct,
camerasau = cs,
sim = sim,
wifi = wifi,
bluetoolh = bluetoolh,
pin = pin,
baomat = baomat,
ram  = ram,
bonhotrong  = bonhotrong,
hinhanh  = hinhanh,
thongtinkhac = thongtinkhac
where iddt = iddtx;
if sql_error = true then
rollback;
else 
commit;
end if;
end//
DELIMITER ;

-- Dumping structure for procedure jina.admin_viewchitietsanpham
DROP PROCEDURE IF EXISTS `admin_viewchitietsanpham`;
DELIMITER //
CREATE PROCEDURE `admin_viewchitietsanpham`(
iddt int 
)
begin
DECLARE sql_error INT DEFAULT FALSE;
  DECLARE CONTINUE HANDLER FOR SQLEXCEPTION
    SET sql_error = TRUE;
start transaction;
select * 
from dienthoai dt inner join chitietdienthoai ctdt
on dt.iddt = ctdt.iddt
where dt.iddt = iddt;

if sql_error = true then
rollback;
else 
commit;
end if;
end//
DELIMITER ;

-- Dumping structure for procedure jina.admin_viewsanpham
DROP PROCEDURE IF EXISTS `admin_viewsanpham`;
DELIMITER //
CREATE PROCEDURE `admin_viewsanpham`()
begin
DECLARE sql_error INT DEFAULT FALSE;
  DECLARE CONTINUE HANDLER FOR SQLEXCEPTION
    SET sql_error = TRUE;
start transaction;
select * 
from dienthoai;
if sql_error = true then
rollback;
else 
commit;
end if;
end//
DELIMITER ;

-- Dumping structure for procedure jina.admin_xemchitietdonhang
DROP PROCEDURE IF EXISTS `admin_xemchitietdonhang`;
DELIMITER //
CREATE PROCEDURE `admin_xemchitietdonhang`(
id int 
)
begin
DECLARE sql_error INT DEFAULT FALSE;
  DECLARE CONTINUE HANDLER FOR SQLEXCEPTION
    SET sql_error = TRUE;
start transaction;
select dh.iddh,dh.idtk,dh.tennguoinhan,dh.diachinhan,dh.sdtnhan,
	(select tendt
	from dienthoai
    where iddt = ctdh.iddt) as 'tensanpham',
    (select loaimay
	from dienthoai
    where iddt = ctdh.iddt) as 'loaisanpham',
ctdh.soluong,ctdh.giaxuathoadon,
ttdh.mota as 'trangthaidonhang',
	(select tk2.hovaten 
	from taikhoan tk2 inner join shiperdonhang sdh 
	on tk2.idtk = sdh.idtk inner join donhang dh2 
	on dh2.iddh = sdh.iddh 
	where dh2.iddh = dh.iddh) as 'nguoigiaohang',
    dh.ngaytaodh    
from donhang dh inner join chitietdonhang ctdh
on dh.iddh = ctdh.iddh
inner join trangthaidonhang ttdh
on dh.trangthaidh = ttdh.trangthaidh
where dh.trangthaidh <> 'E' and dh.iddh = id;
if sql_error = true then
rollback;
else 
commit;
end if;
end//
DELIMITER ;

-- Dumping structure for procedure jina.admin_xoasanpham
DROP PROCEDURE IF EXISTS `admin_xoasanpham`;
DELIMITER //
CREATE PROCEDURE `admin_xoasanpham`(
iddtip int 
)
begin
DECLARE sql_error INT DEFAULT FALSE;
  DECLARE CONTINUE HANDLER FOR SQLEXCEPTION
    SET sql_error = TRUE;
start transaction;
delete from chitietdienthoai
where iddt = iddtip;
delete from dienthoai
where iddt = iddtip;
if sql_error = true then
rollback;
else 
commit;
end if;
end//
DELIMITER ;

-- Dumping structure for table jina.baohanh
DROP TABLE IF EXISTS `baohanh`;
CREATE TABLE IF NOT EXISTS `baohanh` (
  `idbaohanh` int(11) NOT NULL AUTO_INCREMENT,
  `iddt` int(11) NOT NULL,
  `iddh` int(11) NOT NULL,
  `ngaybaohanh` date NOT NULL DEFAULT curdate(),
  `ngaytra` datetime DEFAULT NULL,
  `noidungbh` varchar(100) NOT NULL,
  `chiphiphatsinh` decimal(18,0) DEFAULT NULL,
  `ghichu` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`idbaohanh`),
  KEY `BH_DT` (`iddt`),
  KEY `BH_DH` (`iddh`),
  CONSTRAINT `BH_DH` FOREIGN KEY (`iddh`) REFERENCES `chitietdonhang` (`iddh`),
  CONSTRAINT `BH_DT` FOREIGN KEY (`iddt`) REFERENCES `chitietdonhang` (`iddt`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table jina.baohanh: ~0 rows (approximately)

-- Dumping structure for table jina.chitietdienthoai
DROP TABLE IF EXISTS `chitietdienthoai`;
CREATE TABLE IF NOT EXISTS `chitietdienthoai` (
  `iddt` int(11) NOT NULL,
  `hedieuhanh` varchar(30) NOT NULL,
  `phienban` varchar(100) DEFAULT NULL,
  `dophangiaimh` varchar(30) DEFAULT NULL,
  `cameratruoc` varchar(30) DEFAULT NULL,
  `camerasau` varchar(30) DEFAULT NULL,
  `sim` varchar(30) DEFAULT NULL,
  `wifi` varchar(30) DEFAULT NULL,
  `bluetoolh` varchar(30) DEFAULT NULL,
  `pin` varchar(30) DEFAULT NULL,
  `baomat` varchar(30) DEFAULT NULL,
  `ram` varchar(20) DEFAULT NULL,
  `bonhotrong` varchar(20) DEFAULT NULL,
  `hinhanh` varchar(100) DEFAULT NULL,
  `thongtinkhac` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`iddt`),
  CONSTRAINT `DT_CT` FOREIGN KEY (`iddt`) REFERENCES `dienthoai` (`iddt`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table jina.chitietdienthoai: ~13 rows (approximately)
REPLACE INTO `chitietdienthoai` (`iddt`, `hedieuhanh`, `phienban`, `dophangiaimh`, `cameratruoc`, `camerasau`, `sim`, `wifi`, `bluetoolh`, `pin`, `baomat`, `ram`, `bonhotrong`, `hinhanh`, `thongtinkhac`) VALUES
	(1000, 'Android', 'V1.5-54', 'full HD', '24MP', '32MP', 'dual sim 4G late', 'Yes', 'Yes', '5000 MAH', 'Van tay face 3D', '12GP', '1T', 'site/image/product/google-pixel-3.png', 'khong có thông tin khác'),
	(1001, 'Android', 'V1.5-54', 'full HD', '24MP', '32MP', 'dual sim 4G late', 'Yes', 'Yes', '5000 MAH', 'Van tay face 3D', '12GP', '1T', 'site/image/product/huawei-nova-3i.png', 'khong có thông tin khác'),
	(1002, 'Android', 'V1.5-54', 'full HD', '24MP', '32MP', 'dual sim 4G late', 'Yes', 'Yes', '5000 MAH', 'Van tay face 3D', '12GP', '1T', 'site/image/product/huawei-y9-prime-2019-blue-2.png', 'khong có thông tin khác'),
	(1003, 'Android', 'V1.5-54', 'full HD', '24MP', '32MP', 'dual sim 4G late', 'Yes', 'Yes', '5000 MAH', 'Van tay face 3D', '12GP', '1T', 'site/image/product/xiaomi-mi-9-se-1.png', 'khong có thông tin khác'),
	(1004, 'Android', 'V1.5-54', 'full HD', '24MP', '32MP', 'dual sim 4G late', 'Yes', 'Yes', '5000 MAH', 'Van tay face 3D', '12GP', '1T', 'site/image/product/sieu-pham-galaxy-s-moi-2-512gb-black.png', 'khong có thông tin khác'),
	(1005, 'Android', 'V1.5-54', 'full HD', '24MP', '32MP', 'dual sim 4G late', 'Yes', 'Yes', '5000 MAH', 'Van tay face 3D', '12GP', '1T', 'site/image/product/samsung-galaxy-note-10-plus.png', 'khong có thông tin khác'),
	(1006, 'Android', 'V1.5-54', 'full HD', '24MP', '32MP', 'dual sim 4G late', 'Yes', 'Yes', '5000 MAH', 'Van tay face 3D', '12GP', '1T', 'site/image/product/samsung-galaxy-fold-black.png', 'khong có thông tin khác'),
	(1007, 'Android', 'V1.5-54', 'full HD', '24MP', '32MP', 'dual sim 4G late', 'Yes', 'Yes', '5000 MAH', 'Van tay face 3D', '12GP', '1T', 'site/image/product/iphone-xs-max-gold-200x200.png', 'khong có thông tin khác'),
	(1008, 'Android', 'V1.5-54', 'full HD', '24MP', '32MP', 'dual sim 4G late', 'Yes', 'Yes', '5000 MAH', 'Van tay face 3D', '12GP', '1T', 'site/image/product/iphone-xs-256gb-white.png', 'khong có thông tin khác'),
	(1009, 'Android', 'V1.5-54', 'full HD', '24MP', '32MP', 'dual sim 4G late', 'Yes', 'Yes', '5000 MAH', 'Van tay face 3D', '12GP', '1T', 'site/image/product/iphone-11-pro-max-512gb-gold-200x200.png', 'khong có thông tin khác'),
	(1010, 'IOS', 'I45-54', 'full HD', '12MP', '24MP', 'dual sim 4G late', 'Yes', 'Yes', '5000 MAH', 'Van tay face 3D', '12GP', '1T', 'site/image/product/ip-11.png', 'không có thông tin khác'),
	(1011, 'Android', 'I45-54', 'full HD', '12MP', '24MP', 'dual sim 4G late', 'Yes', 'Yes', '5000 MAH', 'Van tay face 3D', '12GP', '1T', 'site/image/product/google-pixel-3.png', 'không có thông tin khác'),
	(1012, 'Android', '12', '2k', '30MP', '30MP', 'Kép', 'Có', '5.0', '6000mAh', 'Vân Tay', '10Gb', '100Gb', 'http://localhost/shopsmart/site/image/product/htc-nexus-m1-200x200.png', 'jina được thành lập từ năm 2019, là website bán lẻ thiết bị di động (điện thoại di động, phụ k');

-- Dumping structure for table jina.chitietdonhang
DROP TABLE IF EXISTS `chitietdonhang`;
CREATE TABLE IF NOT EXISTS `chitietdonhang` (
  `iddt` int(11) NOT NULL,
  `iddh` int(11) NOT NULL,
  `soluong` int(11) NOT NULL CHECK (`soluong` > 0),
  `giaxuathoadon` decimal(18,0) NOT NULL CHECK (`giaxuathoadon` >= 0),
  PRIMARY KEY (`iddt`,`iddh`),
  KEY `DH_DTDH` (`iddh`),
  CONSTRAINT `DH_DTDH` FOREIGN KEY (`iddh`) REFERENCES `donhang` (`iddh`),
  CONSTRAINT `DT_DTDH` FOREIGN KEY (`iddt`) REFERENCES `dienthoai` (`iddt`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table jina.chitietdonhang: ~3 rows (approximately)
REPLACE INTO `chitietdonhang` (`iddt`, `iddh`, `soluong`, `giaxuathoadon`) VALUES
	(1010, 1001, 1, 34000000),
	(1011, 1000, 1, 34000000),
	(1012, 1000, 1, 14000000);

-- Dumping structure for procedure jina.dangkitaikhoan
DROP PROCEDURE IF EXISTS `dangkitaikhoan`;
DELIMITER //
CREATE PROCEDURE `dangkitaikhoan`(
us  varchar(30) ,
ps varchar(130) ,
s  char(10) ,
hvt varchar(50) ,
dc varchar(100) ,
em varchar(40)
)
begin
DECLARE sql_error INT DEFAULT FALSE;
DECLARE CONTINUE HANDLER FOR SQLEXCEPTION
    SET sql_error = TRUE;
start transaction;
insert into taikhoan(usname,psword,sdt,hovaten,diachi,email)
values(us,md5(ps),s, hvt,dc,em);
if sql_error = true then
rollback;
else 
commit;
end if;
end//
DELIMITER ;

-- Dumping structure for table jina.dienthoai
DROP TABLE IF EXISTS `dienthoai`;
CREATE TABLE IF NOT EXISTS `dienthoai` (
  `iddt` int(11) NOT NULL AUTO_INCREMENT,
  `idkho` int(11) NOT NULL,
  `tendt` varchar(30) NOT NULL,
  `loaimay` varchar(20) DEFAULT NULL,
  `tongsl` int(11) DEFAULT NULL CHECK (`tongsl` >= 0),
  `soluongcon` int(11) DEFAULT NULL CHECK (`soluongcon` >= 0),
  `hangdt` varchar(20) NOT NULL,
  `giaban` decimal(18,0) NOT NULL CHECK (`giaban` >= 0),
  `gianhap` decimal(18,0) NOT NULL CHECK (`gianhap` >= 0),
  `giamgia` decimal(18,0) DEFAULT 0 CHECK (`giamgia` >= 0 and `giamgia` <= 100),
  PRIMARY KEY (`iddt`),
  KEY `kho_DT` (`idkho`),
  CONSTRAINT `kho_DT` FOREIGN KEY (`idkho`) REFERENCES `kho` (`idkho`)
) ENGINE=InnoDB AUTO_INCREMENT=1013 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table jina.dienthoai: ~13 rows (approximately)
REPLACE INTO `dienthoai` (`iddt`, `idkho`, `tendt`, `loaimay`, `tongsl`, `soluongcon`, `hangdt`, `giaban`, `gianhap`, `giamgia`) VALUES
	(1000, 1, 'Xiaomi note 9', 'like new', 100, 99, 'Xiaomi', 19000000, 15000000, 0),
	(1001, 2, 'Xiaomi note 8', 'Fullbox', 100, 19, 'Xiaomi', 19000000, 15000000, 0),
	(1002, 2, 'Xiaomi A9', 'like new', 30, 9, 'Xiaomi', 19000000, 15000000, 0),
	(1003, 1, 'Xiaomi AL02', 'Full box', 200, 29, 'Xiaomi', 19000000, 15000000, 0),
	(1004, 2, 'Xiaomi MD6', 'like new', 200, 93, 'Xiaomi', 19000000, 15000000, 0),
	(1005, 1, 'Samsung R4', 'New', 500, 177, 'Samsung', 23500000, 20000000, 0),
	(1006, 2, 'Samsung R3', 'New', 200, 23, 'Samsung', 23500000, 20000000, 0),
	(1007, 1, 'Samsung note 8', 'New', 200, 59, 'Samsung', 23500000, 20000000, 0),
	(1008, 2, 'Samsung A900', 'New', 200, 89, 'Samsung', 23500000, 20000000, 0),
	(1009, 1, 'Samsung 12A', 'New', 200, 69, 'Samsung', 23500000, 20000000, 0),
	(1010, 2, 'Iphone x', 'Fullbox', 200, 28, 'Apple', 34000000, 25000000, 0),
	(1011, 2, 'Google PX', 'Fullbox', 200, 29, 'Google', 34000000, 25000000, 0),
	(1012, 1, 'Tst', 'New 100%', 2, 2, 'Google', 14000000, 10000000, 0);

-- Dumping structure for table jina.donhang
DROP TABLE IF EXISTS `donhang`;
CREATE TABLE IF NOT EXISTS `donhang` (
  `iddh` int(11) NOT NULL AUTO_INCREMENT,
  `idtk` int(11) NOT NULL,
  `trangthaidh` enum('A','B','C','D','E','F') NOT NULL,
  `ngaytaodh` date DEFAULT curdate(),
  `tongtien` decimal(18,0) DEFAULT NULL CHECK (`tongtien` >= 0),
  `tennguoinhan` varchar(50) NOT NULL,
  `diachinhan` varchar(100) NOT NULL,
  `sdtnhan` char(10) NOT NULL,
  PRIMARY KEY (`iddh`),
  KEY `tk_DH` (`idtk`),
  KEY `tt_DH` (`trangthaidh`),
  CONSTRAINT `tk_DH` FOREIGN KEY (`idtk`) REFERENCES `taikhoan` (`idtk`),
  CONSTRAINT `tt_DH` FOREIGN KEY (`trangthaidh`) REFERENCES `trangthaidonhang` (`trangthaidh`)
) ENGINE=InnoDB AUTO_INCREMENT=1002 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table jina.donhang: ~2 rows (approximately)
REPLACE INTO `donhang` (`iddh`, `idtk`, `trangthaidh`, `ngaytaodh`, `tongtien`, `tennguoinhan`, `diachinhan`, `sdtnhan`) VALUES
	(1000, 1000, 'A', '2023-10-08', 1, 'Quang nhân', '02 Thanh Sơn Hải Châu Đà Nẵng', '0962293731'),
	(1001, 1001, 'B', '2023-10-08', 34000000, 'Mr.user01', '106 Ông Ích Khiêm Hải Châu Đà Nẵng', '0123456789');

-- Dumping structure for table jina.feedback
DROP TABLE IF EXISTS `feedback`;
CREATE TABLE IF NOT EXISTS `feedback` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `noidung` varchar(200) NOT NULL,
  `thoigian` date DEFAULT curdate(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1000 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table jina.feedback: ~0 rows (approximately)

-- Dumping structure for procedure jina.gettrangthaimoinhat
DROP PROCEDURE IF EXISTS `gettrangthaimoinhat`;
DELIMITER //
CREATE PROCEDURE `gettrangthaimoinhat`(
tk int
)
begin
DECLARE sql_error INT DEFAULT FALSE;
DECLARE CONTINUE HANDLER FOR SQLEXCEPTION
    SET sql_error = TRUE;
start transaction;
select trangthaidh
from donhang dh
inner join taikhoan tk
on dh.idtk = tk.idtk
where tk.idtk = tk and dh.iddh = (select iddh from donhang where idtk = tk and trangthaidh <> 'A' and trangthaidh <> 'E' and trangthaidh <> 'F' order by ngaytaodh  desc , iddh desc limit 1);
if sql_error = true then
rollback;
else 
commit;
end if;
end//
DELIMITER ;

-- Dumping structure for procedure jina.index_viewsanpham
DROP PROCEDURE IF EXISTS `index_viewsanpham`;
DELIMITER //
CREATE PROCEDURE `index_viewsanpham`(
loaisp varchar(30)
)
begin
DECLARE sql_error INT DEFAULT FALSE;
  DECLARE CONTINUE HANDLER FOR SQLEXCEPTION
    SET sql_error = TRUE;
start transaction;
select dt.iddt,tendt,hangdt,loaimay,tongsl,soluongcon,giaban,ctdt.hinhanh
from dienthoai dt inner join chitietdienthoai ctdt
on dt.iddt = ctdt.iddt
where hangdt  like loaisp and soluongcon > 0;
if sql_error = true then
rollback;
else 
commit;
end if;
end//
DELIMITER ;

-- Dumping structure for table jina.kho
DROP TABLE IF EXISTS `kho`;
CREATE TABLE IF NOT EXISTS `kho` (
  `idkho` int(11) NOT NULL AUTO_INCREMENT,
  `tenkho` varchar(30) NOT NULL,
  PRIMARY KEY (`idkho`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table jina.kho: ~2 rows (approximately)
REPLACE INTO `kho` (`idkho`, `tenkho`) VALUES
	(1, 'KHO A'),
	(2, 'KHO B');

-- Dumping structure for table jina.quyennv
DROP TABLE IF EXISTS `quyennv`;
CREATE TABLE IF NOT EXISTS `quyennv` (
  `quyen` enum('A','B','C','D','E','F') NOT NULL,
  `mota` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`quyen`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table jina.quyennv: ~4 rows (approximately)
REPLACE INTO `quyennv` (`quyen`, `mota`) VALUES
	('A', 'Khách hàng'),
	('B', 'Nhân viên giao hàng'),
	('C', 'quản lý'),
	('D', 'admin');

-- Dumping structure for table jina.shiperdonhang
DROP TABLE IF EXISTS `shiperdonhang`;
CREATE TABLE IF NOT EXISTS `shiperdonhang` (
  `iddh` int(11) NOT NULL,
  `idtk` int(11) NOT NULL,
  PRIMARY KEY (`iddh`,`idtk`),
  UNIQUE KEY `iddh` (`iddh`),
  KEY `SHIP_TK` (`idtk`),
  CONSTRAINT `SHIP_TK` FOREIGN KEY (`idtk`) REFERENCES `taikhoan` (`idtk`),
  CONSTRAINT `shiperdonhang` FOREIGN KEY (`iddh`) REFERENCES `donhang` (`iddh`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table jina.shiperdonhang: ~0 rows (approximately)

-- Dumping structure for table jina.taikhoan
DROP TABLE IF EXISTS `taikhoan`;
CREATE TABLE IF NOT EXISTS `taikhoan` (
  `idtk` int(11) NOT NULL AUTO_INCREMENT,
  `trangthai` enum('A','B','C','D','E','F') NOT NULL DEFAULT 'A',
  `quyen` enum('A','B','C','D','E','F') NOT NULL DEFAULT 'A',
  `usname` varchar(30) NOT NULL,
  `psword` varchar(130) NOT NULL CHECK (octet_length(`psword`) >= 6),
  `anhnen` varchar(100) DEFAULT NULL,
  `sdt` char(10) NOT NULL,
  `hovaten` varchar(50) DEFAULT NULL,
  `diachi` varchar(100) DEFAULT NULL,
  `email` varchar(40) NOT NULL,
  `ngaytaotk` date DEFAULT curdate(),
  PRIMARY KEY (`idtk`),
  UNIQUE KEY `usname` (`usname`),
  UNIQUE KEY `sdt` (`sdt`),
  UNIQUE KEY `email` (`email`),
  KEY `quyen_tk` (`quyen`),
  KEY `trangthai_tk` (`trangthai`),
  CONSTRAINT `quyen_tk` FOREIGN KEY (`quyen`) REFERENCES `quyennv` (`quyen`),
  CONSTRAINT `trangthai_tk` FOREIGN KEY (`trangthai`) REFERENCES `trangthaihoatdong` (`trangthai`)
) ENGINE=InnoDB AUTO_INCREMENT=1005 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table jina.taikhoan: ~5 rows (approximately)
REPLACE INTO `taikhoan` (`idtk`, `trangthai`, `quyen`, `usname`, `psword`, `anhnen`, `sdt`, `hovaten`, `diachi`, `email`, `ngaytaotk`) VALUES
	(1000, 'A', 'D', 'quangnhan', '7b6ef215d4b849073b578d6bb9fd130e', 'C:UsersADMINDesktopLinh tinh', '0962293731', 'Quang nhân', '02 Thanh Sơn Hải Châu Đà Nẵng', 'quangnhan@jina.com', '2023-10-08'),
	(1001, 'A', 'A', 'user01', 'e10adc3949ba59abbe56e057f20f883e', 'C:UsersADMINDesktop', '0123456789', 'Mr.user01', '106 Ông Ích Khiêm Hải Châu Đà Nẵng', 'user01@gmail.com', '2023-10-08'),
	(1002, 'A', 'A', 'user02', 'e10adc3949ba59abbe56e057f20f883e', 'C:UsersADMINDesktopLinh tinh', '0102345654', 'Mr.user02', '133 Lê Duẫn Hải Châu Đà Nẵng', 'user02@gmail.com', '2023-10-08'),
	(1003, 'A', 'B', 'shiper01', 'e10adc3949ba59abbe56e057f20f883e', 'C:UsersADMINDesktop', '0123456784', 'Shiper Tuấn', '106 Ông Ích Khiêm Hải Châu Đà Nẵng', 'shiper01@gmail.com', '2023-10-08'),
	(1004, 'A', 'B', 'shiper02', 'e10adc3949ba59abbe56e057f20f883e', 'C:UsersADMINDesktopLinh tinh', '0102345652', 'Shiper Long', '133 Lê Duẫn Hải Châu Đà Nẵng', 'shiper02@gmail.com', '2023-10-08');

-- Dumping structure for table jina.trangthaidonhang
DROP TABLE IF EXISTS `trangthaidonhang`;
CREATE TABLE IF NOT EXISTS `trangthaidonhang` (
  `trangthaidh` enum('A','B','C','D','E','F') NOT NULL,
  `mota` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`trangthaidh`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table jina.trangthaidonhang: ~6 rows (approximately)
REPLACE INTO `trangthaidonhang` (`trangthaidh`, `mota`) VALUES
	('A', 'Đã tiếp nhận đơn hàng'),
	('B', 'Shiper đã lấy hàng'),
	('C', 'Đang giao hàng'),
	('D', 'Giao hàng thành công'),
	('E', 'JINA đã nhận tiền từ shiper'),
	('F', 'Khách hủy đơn hàng');

-- Dumping structure for table jina.trangthaihoatdong
DROP TABLE IF EXISTS `trangthaihoatdong`;
CREATE TABLE IF NOT EXISTS `trangthaihoatdong` (
  `trangthai` enum('A','B','C','D','E','F') NOT NULL,
  `mota` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`trangthai`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table jina.trangthaihoatdong: ~3 rows (approximately)
REPLACE INTO `trangthaihoatdong` (`trangthai`, `mota`) VALUES
	('A', 'bình thường'),
	('B', 'Khóa'),
	('C', 'tạm khóa');

-- Dumping structure for procedure jina.trusoluongdienthoai
DROP PROCEDURE IF EXISTS `trusoluongdienthoai`;
DELIMITER //
CREATE PROCEDURE `trusoluongdienthoai`(
dt int,
sl int
)
begin
DECLARE sql_error INT DEFAULT FALSE;
DECLARE CONTINUE HANDLER FOR SQLEXCEPTION
    SET sql_error = TRUE;
start transaction;
update dienthoai
set soluongcon = soluongcon - sl
where iddt = dt;
if sql_error = true then
rollback;
else 
commit;
end if;
end//
DELIMITER ;

-- Dumping structure for procedure jina.update_donhang_of_shiper
DROP PROCEDURE IF EXISTS `update_donhang_of_shiper`;
DELIMITER //
CREATE PROCEDURE `update_donhang_of_shiper`(
dh int,
tt char(1)
)
begin
DECLARE sql_error INT DEFAULT FALSE;
DECLARE CONTINUE HANDLER FOR SQLEXCEPTION
    SET sql_error = TRUE;
start transaction;
	update donhang 
    set trangthaidh = tt
    where iddh = dh;
if sql_error = true then
rollback;
else 
commit;
end if;
end//
DELIMITER ;

-- Dumping structure for procedure jina.user_addcart
DROP PROCEDURE IF EXISTS `user_addcart`;
DELIMITER //
CREATE PROCEDURE `user_addcart`(
tk int,
sp int
)
begin
DECLARE sql_error INT DEFAULT FALSE;
declare countdonhang int;
DECLARE CONTINUE HANDLER FOR SQLEXCEPTION
    SET sql_error = TRUE;
start transaction;
set countdonhang = (select count(*) from donhang where idtk = tk and trangthaidh = "A");
if countdonhang = 0 then
-- nếu chưa có id đơn hàng nào thì tạo id đơn hàng với giá trị mặt định của tài khoản
call user_taodonhangmatdinh(tk);
end if;
-- thêm sản phẩm vào bảng chi tiết đơn hàng
call user_themsanphamchitietdonhang(tk,sp);
if sql_error = true then
rollback;
else 
commit;
end if;
end//
DELIMITER ;

-- Dumping structure for function jina.user_checkdathang
DROP FUNCTION IF EXISTS `user_checkdathang`;
DELIMITER //
CREATE FUNCTION `user_checkdathang`(dh int ,
tk int
) RETURNS int(11)
begin
declare dacodon int;
declare dacodon2 int;
set dacodon = ( select count(*) from donhang where  idtk = tk  and trangthaidh = "C");
set dacodon2 = ( select count(*) from donhang where  idtk = tk  and trangthaidh = "B");
if	dacodon = 0 && dacodon2 = 0 then
return 1;
else 
return 0;
end if;
end//
DELIMITER ;

-- Dumping structure for procedure jina.user_dahang
DROP PROCEDURE IF EXISTS `user_dahang`;
DELIMITER //
CREATE PROCEDURE `user_dahang`(
dh int ,
tk int
)
begin
declare dacodon char(1);
declare dacodon2 int;
declare tongtienct decimal(18,0);
DECLARE sql_error INT DEFAULT FALSE;
DECLARE CONTINUE HANDLER FOR SQLEXCEPTION
    SET sql_error = TRUE;
start transaction;
set tongtienct = (select sum(giaxuathoadon * soluong) from chitietdonhang where iddh = dh  group by iddh);
set dacodon = (select trangthaidh from donhang where iddh = dh and idtk = tk);
set dacodon2 = ( select count(*) from donhang where  idtk = tk  and (trangthaidh = "C" or trangthaidh = "B"));
if dacodon2 = 0  then
 update donhang
set trangthaidh = "B",
tongtien = tongtienct
where iddh = dh and idtk = tk  and trangthaidh = "A";
else
set sql_error = true;
end if;
if sql_error = true then
rollback;
else 
commit;
end if;
end//
DELIMITER ;

-- Dumping structure for procedure jina.user_deletesanphamtrongdanhsach
DROP PROCEDURE IF EXISTS `user_deletesanphamtrongdanhsach`;
DELIMITER //
CREATE PROCEDURE `user_deletesanphamtrongdanhsach`(
dh int ,
dt int
)
begin
DECLARE sql_error INT DEFAULT FALSE;
DECLARE CONTINUE HANDLER FOR SQLEXCEPTION
    SET sql_error = TRUE;
start transaction;
delete from chitietdonhang
where iddt = dt and iddh = dh;
if sql_error = true then
rollback;
else 
commit;
end if;
end//
DELIMITER ;

-- Dumping structure for procedure jina.user_detailcart
DROP PROCEDURE IF EXISTS `user_detailcart`;
DELIMITER //
CREATE PROCEDURE `user_detailcart`(
idtk int
)
begin
DECLARE sql_error INT DEFAULT FALSE;
  DECLARE CONTINUE HANDLER FOR SQLEXCEPTION
    SET sql_error = TRUE;
start transaction;
select dh.idtk,dh.iddh,dt.iddt,dt.tendt,dt.hangdt,dt.loaimay,dt.giaban,hedieuhanh,phienban,ctdt.hinhanh,ctdh.soluong
from dienthoai dt inner join chitietdienthoai ctdt
on dt.iddt = ctdt.iddt
inner join chitietdonhang ctdh
on ctdh.iddt = dt.iddt
inner join donhang dh
on dh.iddh = ctdh.iddh
where dh.idtk = idtk and dh.trangthaidh = 'A'
;
if sql_error = true then
rollback;
else 
commit;
end if;
end//
DELIMITER ;

-- Dumping structure for procedure jina.user_detailproduct
DROP PROCEDURE IF EXISTS `user_detailproduct`;
DELIMITER //
CREATE PROCEDURE `user_detailproduct`(
iddt int
)
begin
DECLARE sql_error INT DEFAULT FALSE;
  DECLARE CONTINUE HANDLER FOR SQLEXCEPTION
    SET sql_error = TRUE;
start transaction;
select dt.iddt,dt.tendt,dt.hangdt,dt.loaimay,dt.giaban,hedieuhanh,phienban,dophangiaimh,cameratruoc,camerasau,sim,wifi,bluetoolh,pin,baomat,ram,bonhotrong,thongtinkhac,dt.soluongcon,ctdt.hinhanh
from dienthoai dt inner join chitietdienthoai ctdt
on dt.iddt = ctdt.iddt
where dt.iddt = iddt;
if sql_error = true then
rollback;
else 
commit;
end if;
end//
DELIMITER ;

-- Dumping structure for function jina.user_numberproduct
DROP FUNCTION IF EXISTS `user_numberproduct`;
DELIMITER //
CREATE FUNCTION `user_numberproduct`(idtk int
) RETURNS int(11)
begin
DECLARE counts int;
  set counts = 0;
select count(*) into counts
from donhang dh inner join chitietdonhang ctdh
on dh.iddh = ctdh.iddh
where dh.idtk = idtk and trangthaidh = 'A';
return counts;
end//
DELIMITER ;

-- Dumping structure for procedure jina.user_taodonhangmatdinh
DROP PROCEDURE IF EXISTS `user_taodonhangmatdinh`;
DELIMITER //
CREATE PROCEDURE `user_taodonhangmatdinh`(
tk int
)
begin
declare fullname varchar(50);
declare dc varchar(100);
declare sodienthoai char(10);
DECLARE sql_error INT DEFAULT FALSE;
declare countdonhang int;
DECLARE CONTINUE HANDLER FOR SQLEXCEPTION
    SET sql_error = TRUE;
start transaction;
set fullname  = (select hovaten  from taikhoan where idtk = tk);
set dc = (select diachi from taikhoan where idtk = tk);
set sodienthoai = (select sdt from taikhoan where idtk = tk);
insert into donhang(idtk,tongtien,tennguoinhan,diachinhan,sdtnhan)
values(tk,1,fullname,dc,sodienthoai);
if sql_error = true then
rollback;
else 
commit;
end if;
end//
DELIMITER ;

-- Dumping structure for procedure jina.user_themsanphamchitietdonhang
DROP PROCEDURE IF EXISTS `user_themsanphamchitietdonhang`;
DELIMITER //
CREATE PROCEDURE `user_themsanphamchitietdonhang`(
tk int,
sp int
)
begin
DECLARE countsmax int;
DECLARE madh int;
DECLARE giasp decimal(18,0);
DECLARE sql_error INT DEFAULT FALSE;
DECLARE CONTINUE HANDLER FOR SQLEXCEPTION
SET sql_error = TRUE;
start transaction;
-- lấy id don hang
set madh =  (select iddh from donhang where idtk = tk and trangthaidh = "A");
-- xem thử tài khoản đó đã thêm bao nhiêu sản phẩm vào giỏ hàng rồi 
set countsmax = (select count(*) from chitietdonhang where iddh = madh);
-- lấy giá sản phẩm
set giasp = (select giaban from dienthoai where iddt = sp);
-- insert
if countsmax < 6 then
insert into chitietdonhang(iddt,iddh,soluong,giaxuathoadon)
values(sp,madh,1,giasp);
end if;
if sql_error = true then
rollback;
else 
commit;
end if;
end//
DELIMITER ;

-- Dumping structure for procedure jina.user_updategiamsoluong
DROP PROCEDURE IF EXISTS `user_updategiamsoluong`;
DELIMITER //
CREATE PROCEDURE `user_updategiamsoluong`(
dh int,
dt int
)
begin
DECLARE sql_error INT DEFAULT FALSE;
DECLARE  minmax int;
  DECLARE CONTINUE HANDLER FOR SQLEXCEPTION
    SET sql_error = TRUE;
start transaction;
set minmax = (select soluong   from chitietdonhang where iddh = dh and iddt = dt);
if	minmax > 0  then
begin
update chitietdonhang
set soluong = soluong - 1
where iddt = dt and iddh = dh;
end;
else
rollback;
end if;
if sql_error = true then
rollback;
else 
commit;
end if;
end//
DELIMITER ;

-- Dumping structure for procedure jina.user_updatetangsoluong
DROP PROCEDURE IF EXISTS `user_updatetangsoluong`;
DELIMITER //
CREATE PROCEDURE `user_updatetangsoluong`(
dh int,
dt int
)
begin
DECLARE sql_error INT DEFAULT FALSE;
DECLARE  minmax int;
  DECLARE CONTINUE HANDLER FOR SQLEXCEPTION
    SET sql_error = TRUE;
start transaction;
set minmax = (select soluong   from chitietdonhang where iddh = dh and iddt = dt);
if	minmax < 9 then
begin
update chitietdonhang
set soluong = soluong + 1
where iddt = dt and iddh = dh;
end;
end if;
if sql_error = true then
rollback;
else 
commit;
end if;
end//
DELIMITER ;

-- Dumping structure for procedure jina.user_updatethongtinnhanhang
DROP PROCEDURE IF EXISTS `user_updatethongtinnhanhang`;
DELIMITER //
CREATE PROCEDURE `user_updatethongtinnhanhang`(
tk int,
ten varchar(50) ,
dc varchar(100) ,
sdt char(10)
)
begin
DECLARE sql_error INT DEFAULT FALSE;
DECLARE CONTINUE HANDLER FOR SQLEXCEPTION
    SET sql_error = TRUE;
start transaction;
update donhang
set tennguoinhan = ten,
diachinhan = dc,
sdtnhan = sdt
where idtk = tk and trangthaidh = "A";
if sql_error = true then
rollback;
else 
commit;
end if;
end//
DELIMITER ;

-- Dumping structure for procedure jina.user_viewdanhsachsanphammua
DROP PROCEDURE IF EXISTS `user_viewdanhsachsanphammua`;
DELIMITER //
CREATE PROCEDURE `user_viewdanhsachsanphammua`(
tk int 
)
begin
DECLARE sql_error INT DEFAULT FALSE;
DECLARE CONTINUE HANDLER FOR SQLEXCEPTION
    SET sql_error = TRUE;
start transaction;
select dh.iddh,dh.idtk,ctdh.iddt,dh.tennguoinhan,dh.diachinhan,dh.sdtnhan,dt.tendt,dt.loaimay,ctdh.soluong,ctdh.giaxuathoadon
 from donhang dh inner join chitietdonhang ctdh 
 on dh.iddh = ctdh.iddh
 inner join dienthoai dt
 on dt.iddt = ctdh.iddt
 where  dh.idtk = tk and dh.trangthaidh = "A";
if sql_error = true then
rollback;
else 
commit;
end if;
end//
DELIMITER ;

-- Dumping structure for procedure jina.user_viewdanhsachsanphammuadadathang
DROP PROCEDURE IF EXISTS `user_viewdanhsachsanphammuadadathang`;
DELIMITER //
CREATE PROCEDURE `user_viewdanhsachsanphammuadadathang`(
tk int 
)
begin
DECLARE sql_error INT DEFAULT FALSE;
DECLARE CONTINUE HANDLER FOR SQLEXCEPTION
    SET sql_error = TRUE;
start transaction;
select dh.iddh,dh.idtk,ctdh.iddt,dh.tennguoinhan,dh.diachinhan,dh.sdtnhan,dt.tendt,dt.loaimay,ctdh.soluong,ctdh.giaxuathoadon
 from donhang dh inner join chitietdonhang ctdh 
 on dh.iddh = ctdh.iddh
 inner join dienthoai dt
 on dt.iddt = ctdh.iddt
 where  dh.idtk = tk and dh.trangthaidh <> "A"  and dh.trangthaidh <> "E"and dh.trangthaidh <> "F";
if sql_error = true then
rollback;
else 
commit;
end if;
end//
DELIMITER ;

-- Dumping structure for procedure jina.user_viewsoluong
DROP PROCEDURE IF EXISTS `user_viewsoluong`;
DELIMITER //
CREATE PROCEDURE `user_viewsoluong`(
dh int,
dt int
)
begin
DECLARE sql_error INT DEFAULT FALSE;
DECLARE  minmax int;
  DECLARE CONTINUE HANDLER FOR SQLEXCEPTION
    SET sql_error = TRUE;
start transaction;
select soluong from chitietdonhang where iddh = dh and iddt = dt;
if sql_error = true then
rollback;
else 
commit;
end if;
end//
DELIMITER ;

-- Dumping structure for procedure jina.viewkey
DROP PROCEDURE IF EXISTS `viewkey`;
DELIMITER //
CREATE PROCEDURE `viewkey`(
loaisp varchar(30)
)
begin
DECLARE sql_error INT DEFAULT FALSE;
  DECLARE CONTINUE HANDLER FOR SQLEXCEPTION
    SET sql_error = TRUE;
start transaction;
select dt.iddt,tendt,hangdt,loaimay,tongsl,soluongcon,giaban,ctdt.hinhanh
from dienthoai dt inner join chitietdienthoai ctdt
on dt.iddt = ctdt.iddt
where hangdt  like loaisp and soluongcon > 0
order by giaban desc
;
if sql_error = true then
rollback;
else 
commit;
end if;
end//
DELIMITER ;

-- Dumping structure for procedure jina.viewname
DROP PROCEDURE IF EXISTS `viewname`;
DELIMITER //
CREATE PROCEDURE `viewname`(
ten varchar(50)
)
begin
DECLARE sql_error INT DEFAULT FALSE;
  DECLARE CONTINUE HANDLER FOR SQLEXCEPTION
    SET sql_error = TRUE;
start transaction;
select dt.iddt,tendt,hangdt,loaimay,tongsl,soluongcon,giaban,ctdt.hinhanh
from dienthoai dt inner join chitietdienthoai ctdt
on dt.iddt = ctdt.iddt
where  soluongcon > 0 and tendt like ten
order by giaban 
;
if sql_error = true then
rollback;
else 
commit;
end if;
end//
DELIMITER ;

-- Dumping structure for procedure jina.viewprice
DROP PROCEDURE IF EXISTS `viewprice`;
DELIMITER //
CREATE PROCEDURE `viewprice`(
tu decimal(18,0),
den decimal(18,0)
)
begin
DECLARE sql_error INT DEFAULT FALSE;
  DECLARE CONTINUE HANDLER FOR SQLEXCEPTION
    SET sql_error = TRUE;
start transaction;
select dt.iddt,tendt,hangdt,loaimay,tongsl,soluongcon,giaban,ctdt.hinhanh
from dienthoai dt inner join chitietdienthoai ctdt
on dt.iddt = ctdt.iddt
where  soluongcon > 0 and giaban >= tu and giaban <= den
order by giaban 
;
if sql_error = true then
rollback;
else 
commit;
end if;
end//
DELIMITER ;

-- Dumping structure for function jina.viewsoluongcon
DROP FUNCTION IF EXISTS `viewsoluongcon`;
DELIMITER //
CREATE FUNCTION `viewsoluongcon`(dt int,
sl int
) RETURNS int(11)
begin
DECLARE checksl int;
set checksl = (select soluongcon from dienthoai where iddt = dt);
if	sl < checksl then
return 1;
else
return 0;
end if;
end//
DELIMITER ;

-- Dumping structure for procedure jina.viewsoluongvadienthoaimua
DROP PROCEDURE IF EXISTS `viewsoluongvadienthoaimua`;
DELIMITER //
CREATE PROCEDURE `viewsoluongvadienthoaimua`(
in dh int
)
begin
select iddt as 'iddt',soluong as 'soluong'
from chitietdonhang
where iddh = dh;
end//
DELIMITER ;

-- Dumping structure for procedure jina.view_donhang_of_shiper
DROP PROCEDURE IF EXISTS `view_donhang_of_shiper`;
DELIMITER //
CREATE PROCEDURE `view_donhang_of_shiper`(
tk int
)
begin
DECLARE sql_error INT DEFAULT FALSE;
DECLARE CONTINUE HANDLER FOR SQLEXCEPTION
    SET sql_error = TRUE;
start transaction;
select dh.iddh,dh.idtk,dh.tennguoinhan,dh.diachinhan,dh.sdtnhan,dh.tongtien,dh.ngaytaodh,ttdh.mota
from donhang dh left join shiperdonhang sdh
on dh.iddh = sdh.iddh
inner join trangthaidonhang ttdh 
on dh.trangthaidh = ttdh.trangthaidh
where sdh.iddh is not null and sdh.idtk is not null and sdh.idtk = tk
and dh.trangthaidh != 'A'
and dh.trangthaidh != 'D'
and dh.trangthaidh != 'E'
and dh.trangthaidh != 'F'
;
if sql_error = true then
rollback;
else 
commit;
end if;
end//
DELIMITER ;

-- Dumping structure for procedure jina.view_donhang_shiper
DROP PROCEDURE IF EXISTS `view_donhang_shiper`;
DELIMITER //
CREATE PROCEDURE `view_donhang_shiper`()
begin
DECLARE sql_error INT DEFAULT FALSE;
DECLARE CONTINUE HANDLER FOR SQLEXCEPTION
    SET sql_error = TRUE;
start transaction;
select dh.iddh,dh.idtk,dh.tennguoinhan,dh.diachinhan,dh.sdtnhan,dh.tongtien,dh.ngaytaodh
from donhang dh left join shiperdonhang sdh
on dh.iddh = sdh.iddh
where sdh.iddh is null and sdh.idtk is null and dh.trangthaidh = 'B';
if sql_error = true then
rollback;
else 
commit;
end if;
end//
DELIMITER ;

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
