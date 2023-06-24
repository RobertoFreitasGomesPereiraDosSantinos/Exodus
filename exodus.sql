-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 18, 2021 at 11:44 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.3.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 
--
drop database  if exists exodus;
CREATE DATABASE exodus;
USE exodus;
-- --------------------------------------------------------

--
-- 
--

CREATE TABLE messages (
  msg_id int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
  incoming_msg_id int(255) NOT NULL,
  outgoing_msg_id int(255) NOT NULL,
  msg varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
--
--

CREATE TABLE users (
  user_id int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
  unique_id int(255) NOT NULL UNIQUE,
  fname varchar(255) NOT NULL,
  lname varchar(255) NOT NULL,
  email varchar(255) NOT NULL,
  password varchar(32) NOT NULL,
  img varchar(255) NOT NULL,
  status varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE friendships
(
	id int(11) primary key auto_increment not null,
    sender int(255) not null,
    receiver int(255) not null,
    accepted boolean not null,
    constraint fk_UserSender foreign key (sender) references users(unique_id),
    constraint fk_UserReceiver foreign key (receiver) references users(unique_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
--


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
