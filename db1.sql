CREATE DATABASE events;
USE events;
CREATE TABLE eventlogin
(
id INT(10),
username VARCHAR(50) PRIMARY KEY,
password VARCHAR(50),
status VARCHAR(20)
);

INSERT INTO eventlogin(`id`, `username`, `password`, `status`) VALUES (1, 'conatus', 'con01', 'active'), (2, 'csi', 'csi01', 'active');

create table eventall
(
evid int(10) primary key auto_increment,
evname varchar(50) not null,
evdesc varchar(2000) default 'No Description',
soc_id int(10),
soc_name varchar(50),
evcover blob,
evstdt date not null,
evsttm time not null,
evendtm time not null,
evvenue varchar(50) default 'AKGEC',
evstatus varchar(20)
);