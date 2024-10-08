-- MySQL Script generated by MySQL Workbench
-- Wed May  1 15:43:42 2024
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `biblioteca` ;

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `biblioteca` DEFAULT CHARACTER SET utf8 ;
USE `biblioteca` ;

-- -----------------------------------------------------
-- Table `PAIS`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `PAIS` ;

CREATE TABLE IF NOT EXISTS `PAIS` (
  `id_pais` INT NOT NULL AUTO_INCREMENT,
  `nombre_pais` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id_pais`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `DEPARTAMENTO`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `DEPARTAMENTO` ;

CREATE TABLE IF NOT EXISTS `DEPARTAMENTO` (
  `id_departamento` INT NOT NULL AUTO_INCREMENT,
  `nombre_departamento` VARCHAR(45) NOT NULL,
  `PAIS_id_pais` INT NOT NULL,
  PRIMARY KEY (`id_departamento`, `PAIS_id_pais`),
  INDEX `fk_DEPARTAMENTO_PAIS1_idx` (`PAIS_id_pais` ASC) VISIBLE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `CIUDAD`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `CIUDAD` ;

CREATE TABLE IF NOT EXISTS `CIUDAD` (
  `id_ciudad` INT NOT NULL AUTO_INCREMENT,
  `nombre_ciudad` VARCHAR(45) NOT NULL,
  `DEPARTAMENTO_id_departamento` INT NOT NULL,
  `DEPARTAMENTO_PAIS_id_pais` INT NOT NULL,
  PRIMARY KEY (`id_ciudad`, `DEPARTAMENTO_id_departamento`, `DEPARTAMENTO_PAIS_id_pais`),
  INDEX `fk_CIUDAD_DEPARTAMENTO1_idx` (`DEPARTAMENTO_id_departamento` ASC, `DEPARTAMENTO_PAIS_id_pais` ASC) VISIBLE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `AUTOR`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `AUTOR` ;

CREATE TABLE IF NOT EXISTS `AUTOR` (
  `id_autor` VARCHAR(10) NOT NULL,
  `nombre` VARCHAR(45) NOT NULL,
  `apellido` VARCHAR(45) NOT NULL,
  `CIUDAD_id_ciudad` INT NOT NULL,
  `CIUDAD_DEPARTAMENTO_id_departamento` INT NOT NULL,
  `CIUDAD_DEPARTAMENTO_PAIS_id_pais` INT NOT NULL,
  PRIMARY KEY (`id_autor`, `CIUDAD_id_ciudad`, `CIUDAD_DEPARTAMENTO_id_departamento`, `CIUDAD_DEPARTAMENTO_PAIS_id_pais`),
  INDEX `fk_AUTOR_CIUDAD1_idx` (`CIUDAD_id_ciudad` ASC, `CIUDAD_DEPARTAMENTO_id_departamento` ASC, `CIUDAD_DEPARTAMENTO_PAIS_id_pais` ASC) VISIBLE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `CATEGORIA`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `CATEGORIA` ;

CREATE TABLE IF NOT EXISTS `CATEGORIA` (
  `id_categoria` INT NOT NULL AUTO_INCREMENT,
  `nombre_categoria` VARCHAR(80) NOT NULL,
  PRIMARY KEY (`id_categoria`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `LIBRO`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `LIBRO` ;

CREATE TABLE IF NOT EXISTS `LIBRO` (
  `ISBN` VARCHAR(20) NOT NULL,
  `titulo` VARCHAR(80) NOT NULL,
  `autor` VARCHAR(80) NULL,
  `n_paginas` INT NOT NULL,
  `n_copias` INT NOT NULL,
  `AUTOR_id_autor` VARCHAR(10) NOT NULL,
  `CATEGORIA_id_categoria` INT NOT NULL,
  PRIMARY KEY (`ISBN`, `AUTOR_id_autor`, `CATEGORIA_id_categoria`),
  INDEX `fk_LIBRO_AUTOR_idx` (`AUTOR_id_autor` ASC) VISIBLE,
  INDEX `fk_LIBRO_CATEGORIA1_idx` (`CATEGORIA_id_categoria` ASC) VISIBLE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `EDITORIAL`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `EDITORIAL` ;

CREATE TABLE IF NOT EXISTS `EDITORIAL` (
  `id_editorial` VARCHAR(7) NOT NULL,
  `nombre_editorial` VARCHAR(45) NOT NULL,
  `direccion_editorial` VARCHAR(45) NOT NULL,
  `telefono` VARCHAR(10) NOT NULL,
  `correo` VARCHAR(45) NOT NULL,
  `CIUDAD_id_ciudad` INT NOT NULL,
  `CIUDAD_DEPARTAMENTO_id_departamento` INT NOT NULL,
  `CIUDAD_DEPARTAMENTO_PAIS_id_pais` INT NOT NULL,
  PRIMARY KEY (`id_editorial`, `CIUDAD_id_ciudad`, `CIUDAD_DEPARTAMENTO_id_departamento`, `CIUDAD_DEPARTAMENTO_PAIS_id_pais`),
  INDEX `fk_EDITORIAL_CIUDAD1_idx` (`CIUDAD_id_ciudad` ASC, `CIUDAD_DEPARTAMENTO_id_departamento` ASC, `CIUDAD_DEPARTAMENTO_PAIS_id_pais` ASC) VISIBLE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ESTADO`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ESTADO` ;

CREATE TABLE IF NOT EXISTS `ESTADO` (
  `id_estado` INT NOT NULL,
  `nombre_estado` VARCHAR(60) NOT NULL,
  PRIMARY KEY (`id_estado`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `COPIAS`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `COPIAS` ;

CREATE TABLE IF NOT EXISTS `COPIAS` (
  `id_copia` VARCHAR(6) NOT NULL,
  `LIBRO_ISBN` VARCHAR(20) NOT NULL,
  `LIBRO_AUTOR_id_autor` VARCHAR(10) NOT NULL,
  `ESTADO_id_estado` INT NOT NULL,
  PRIMARY KEY (`id_copia`, `LIBRO_ISBN`, `LIBRO_AUTOR_id_autor`, `ESTADO_id_estado`),
  INDEX `fk_COPIAS_LIBRO1_idx` (`LIBRO_ISBN` ASC, `LIBRO_AUTOR_id_autor` ASC) VISIBLE,
  INDEX `fk_COPIAS_ESTADO1_idx` (`ESTADO_id_estado` ASC) VISIBLE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `LIBRO_has_EDITORIAL`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `LIBRO_has_EDITORIAL` ;

CREATE TABLE IF NOT EXISTS `LIBRO_has_EDITORIAL` (
  `LIBRO_ISBN` VARCHAR(20) NOT NULL,
  `LIBRO_AUTOR_id_autor` VARCHAR(10) NOT NULL,
  `EDITORIAL_id_editorial` VARCHAR(7) NOT NULL,
  PRIMARY KEY (`LIBRO_ISBN`, `LIBRO_AUTOR_id_autor`, `EDITORIAL_id_editorial`),
  INDEX `fk_LIBRO_has_EDITORIAL_EDITORIAL1_idx` (`EDITORIAL_id_editorial` ASC) VISIBLE,
  INDEX `fk_LIBRO_has_EDITORIAL_LIBRO1_idx` (`LIBRO_ISBN` ASC, `LIBRO_AUTOR_id_autor` ASC) VISIBLE)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
