/*
 * @Author: Angra Mainyu
 * @Date: 2018-12-29 19:29:17
 * @LastEditors: Angra Mainyu
 * @LastEditTime: 2018-12-31 00:40:40
 * @Description: file content
 */

-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema storage
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema storage
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `storage` DEFAULT CHARACTER SET utf8 ;
USE `storage` ;

-- -----------------------------------------------------
-- Table `storage`.`input`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `storage`.`input` (
  `iid` INT(11) NOT NULL,
  `id` INT(11) NULL DEFAULT NULL,
  `name` VARCHAR(45) NULL DEFAULT NULL,
  `count` INT(11) NULL DEFAULT NULL,
  `price` INT(11) NULL DEFAULT NULL,
  `manager` VARCHAR(45) NULL DEFAULT NULL,
  `date` DATE NULL,
  `time` TIME NULL,
  PRIMARY KEY (`iid`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `storage`.`output`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `storage`.`output` (
  `oid` INT(11) NOT NULL,
  `id` INT(11) NULL DEFAULT NULL,
  `name` VARCHAR(45) NULL DEFAULT NULL,
  `count` INT(11) NULL DEFAULT NULL,
  `price` INT(11) NULL DEFAULT NULL,
  `manager` VARCHAR(45) NULL DEFAULT NULL,
  `date` DATE NULL,
  `time` TIME NULL,
  PRIMARY KEY (`oid`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `storage`.`stock`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `storage`.`stock` (
  `id` INT(11) NOT NULL,
  `name` VARCHAR(45) NULL DEFAULT NULL,
  `count` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `storage`.`user`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `storage`.`user` (
  `manager` VARCHAR(45) NOT NULL,
  `passwd` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`manager`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `storage`.`goods`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `storage`.`goods` (
  `id` INT NOT NULL,
  `name` VARCHAR(45) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;

USE `storage` ;

-- -----------------------------------------------------
-- Placeholder table for view `storage`.`show_input`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `storage`.`show_input` (`iid` INT, `id` INT, `name` INT, `count` INT, `price` INT, `manager` INT, `date` INT, `time` INT, `total` INT);

-- -----------------------------------------------------
-- Placeholder table for view `storage`.`show_output`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `storage`.`show_output` (`oid` INT, `id` INT, `name` INT, `count` INT, `price` INT, `manager` INT, `date` INT, `time` INT, `total` INT);

-- -----------------------------------------------------
-- View `storage`.`show_input`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `storage`.`show_input`;
USE `storage`;
CREATE  OR REPLACE VIEW `show_input` AS
select iid,id,name,count,price,manager,date,time,count*price as total 
from input;

-- -----------------------------------------------------
-- View `storage`.`show_output`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `storage`.`show_output`;
USE `storage`;
CREATE  OR REPLACE VIEW `show_output` AS
select oid,id,name,count,price,manager,date,time,count*price as total 
from output;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
