-- MySQL Script generated by MySQL Workbench
-- Tue Nov  1 10:36:19 2022
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema portafoliodb
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema portafoliodb
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `portafoliodb` DEFAULT CHARACTER SET utf8 ;
USE `portafoliodb` ;

-- -----------------------------------------------------
-- Table `portafoliodb`.`Proyecto`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `portafoliodb`.`Proyecto` ;

CREATE TABLE IF NOT EXISTS `portafoliodb`.`Proyecto` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(60) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `portafoliodb`.`proyectos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `portafoliodb`.`proyectos` ;

CREATE TABLE IF NOT EXISTS `portafoliodb`.`proyectos` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(60) NULL,
  `descripcion` VARCHAR(255) NULL,
  `imagen` VARCHAR(32) NULL,
  `url` VARCHAR(255) NULL,
  `fecha_alta` DATE NULL,
  `estatus` TINYINT(1) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `portafoliodb`.`clientes`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `portafoliodb`.`clientes` ;

CREATE TABLE IF NOT EXISTS `portafoliodb`.`clientes` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(40) NULL,
  `apellido` VARCHAR(40) NULL,
  `email` VARCHAR(40) NULL,
  `direccion` VARCHAR(200) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `portafoliodb`.`usuarios`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `portafoliodb`.`usuarios` ;

CREATE TABLE IF NOT EXISTS `portafoliodb`.`usuarios` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(40) NULL,
  `apellido` VARCHAR(40) NULL,
  `email` VARCHAR(40) NULL,
  `password` VARCHAR(60) NULL,
  `confirmado` TINYINT(1) NULL,
  `token` VARCHAR(13) NULL,
  `admin` TINYINT(1) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `portafoliodb`.`cliente_proyectos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `portafoliodb`.`cliente_proyectos` ;

CREATE TABLE IF NOT EXISTS `portafoliodb`.`cliente_proyectos` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `idcliente` INT NULL,
  `idproyecto` INT NULL,
  INDEX `fk_proyecto_idx` (`idproyecto` ASC) VISIBLE,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_cliente`
    FOREIGN KEY (`idcliente`)
    REFERENCES `portafoliodb`.`clientes` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_proyecto`
    FOREIGN KEY (`idproyecto`)
    REFERENCES `portafoliodb`.`proyectos` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `portafoliodb`.`tecnologías`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `portafoliodb`.`tecnologías` ;

CREATE TABLE IF NOT EXISTS `portafoliodb`.`tecnologías` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `tecnologia` VARCHAR(45) NULL,
  `icono` VARCHAR(65) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `portafoliodb`.`proyeto_tecnologia`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `portafoliodb`.`proyeto_tecnologia` ;

CREATE TABLE IF NOT EXISTS `portafoliodb`.`proyeto_tecnologia` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `idproyecto` INT NULL,
  `idtecnologia` INT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_tecnologias_idx` (`idtecnologia` ASC) VISIBLE,
  CONSTRAINT `fk_proyecto`
    FOREIGN KEY (`idproyecto`)
    REFERENCES `portafoliodb`.`proyectos` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tecnologias`
    FOREIGN KEY (`idtecnologia`)
    REFERENCES `portafoliodb`.`tecnologías` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
