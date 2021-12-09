-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema 2122_ruanodaniel
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema 2122_ruanodaniel
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `2122_ruanodaniel` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ;
USE `2122_ruanodaniel` ;

-- -----------------------------------------------------
-- Table `2122_ruanodaniel`.`tbl_lugar`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `2122_ruanodaniel`.`tbl_lugar` (
  `id_lugar` INT NOT NULL AUTO_INCREMENT,
  `nom_lugar` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`id_lugar`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `2122_ruanodaniel`.`tbl_mesa`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `2122_ruanodaniel`.`tbl_mesa` (
  `id_mesa` INT NOT NULL AUTO_INCREMENT,
  `numero_mesa` INT NULL DEFAULT NULL,
  `id_lugar` INT NULL DEFAULT NULL,
  `estado_mesa` TINYINT NULL DEFAULT NULL,
  `num_sillas_mesa` VARCHAR(2) NULL DEFAULT NULL,
  PRIMARY KEY (`id_mesa`),
  INDEX `fk_lugar_mesa_idx` (`id_lugar` ASC) VISIBLE,
  CONSTRAINT `fk_lugar_mesa`
    FOREIGN KEY (`id_lugar`)
    REFERENCES `2122_ruanodaniel`.`tbl_lugar` (`id_lugar`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `2122_ruanodaniel`.`tbl_perfil`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `2122_ruanodaniel`.`tbl_perfil` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `perfil_usuario` VARCHAR(15) NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `2122_ruanodaniel`.`tbl_reserva`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `2122_ruanodaniel`.`tbl_reserva` (
  `id_reserva` INT NOT NULL AUTO_INCREMENT,
  `fecha_ini_reserva` DATETIME NULL DEFAULT NULL,
  `id_mesa` INT NULL DEFAULT NULL,
  `fecha_fin_reserva` DATETIME NULL DEFAULT NULL,
  `nom_cliente_reserva` VARCHAR(20) NULL DEFAULT NULL,
  `num_personas_reserva` VARCHAR(2) NULL DEFAULT NULL,
  PRIMARY KEY (`id_reserva`),
  INDEX `fk_fecha_mesa_idx` (`id_mesa` ASC) VISIBLE,
  CONSTRAINT `fk_fecha_mesa`
    FOREIGN KEY (`id_mesa`)
    REFERENCES `2122_ruanodaniel`.`tbl_mesa` (`id_mesa`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `2122_ruanodaniel`.`tbl_usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `2122_ruanodaniel`.`tbl_usuario` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nom_usuario` VARCHAR(20) NULL DEFAULT NULL,
  `apellido_usuario` VARCHAR(20) NULL DEFAULT NULL,
  `correo_usuario` VARCHAR(45) NULL DEFAULT NULL,
  `contra_usuario` VARCHAR(25) NULL DEFAULT NULL,
  `id_perfil_usuario` INT NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_perfil_usuario_idx` (`id_perfil_usuario` ASC) VISIBLE,
  CONSTRAINT `fk_perfil_usuario`
    FOREIGN KEY (`id_perfil_usuario`)
    REFERENCES `2122_ruanodaniel`.`tbl_perfil` (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
