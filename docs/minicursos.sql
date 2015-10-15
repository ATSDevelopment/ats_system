-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema minicursos-sct
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `minicursos-sct` ;

-- -----------------------------------------------------
-- Schema minicursos-sct
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `minicursos-sct` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `minicursos-sct` ;

-- -----------------------------------------------------
-- Table `minicursos-sct`.`minicursos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `minicursos-sct`.`minicursos` ;

CREATE TABLE IF NOT EXISTS `minicursos-sct`.`minicursos` (
  `codigo` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `titulo` VARCHAR(45) NOT NULL COMMENT '',
  `data_inicio` DATETIME NOT NULL COMMENT '',
  `data_fim` DATETIME NOT NULL COMMENT '',
  `local` LONGTEXT NOT NULL COMMENT '',
  `n_vagas` VARCHAR(45) NOT NULL COMMENT '',
  `inscricao_fechada` TINYINT(1) NOT NULL COMMENT '',
  PRIMARY KEY (`codigo`)  COMMENT '')
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `minicursos-sct`.`participantes`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `minicursos-sct`.`participantes` ;

CREATE TABLE IF NOT EXISTS `minicursos-sct`.`participantes` (
  `matricula` VARCHAR(20) NOT NULL COMMENT '',
  `nome` VARCHAR(100) NOT NULL COMMENT '',
  `telefone` VARCHAR(13) NOT NULL COMMENT '',
  `e-mail` VARCHAR(100) NOT NULL COMMENT '',
  `cod_minicurso` INT NOT NULL COMMENT '',
  PRIMARY KEY (`matricula`)  COMMENT '',
  INDEX `fk_participantes_minicursos_idx` (`cod_minicurso` ASC)  COMMENT '',
  CONSTRAINT `fk_participantes_minicursos`
    FOREIGN KEY (`cod_minicurso`)
    REFERENCES `minicursos-sct`.`minicursos` (`codigo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
