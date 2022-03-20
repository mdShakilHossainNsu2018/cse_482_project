-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `db` DEFAULT CHARACTER SET utf8 ;
USE `db` ;

-- -----------------------------------------------------
-- Table `mydb`.`UserProfile`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db`.`UserProfile`(
  `profileID` INT NOT NULL,
  `number` VARCHAR(45) NOT NULL,
  `address` VARCHAR(45) NOT NULL,
  `name` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`profileID`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`User`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db`.`User`(
  `idUser` INT NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `password` VARCHAR(45) NOT NULL,
  `table1_name` INT NOT NULL,
  `CreatedAt` DATETIME NOT NULL,
  PRIMARY KEY (`idUser`, `table1_name`),
  INDEX `fk_User_table1_idx` (`table1_name` ASC) VISIBLE,
  CONSTRAINT `fk_User_table1`
    FOREIGN KEY (`table1_name`)
    REFERENCES `db`.`UserProfile` (`profileID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Details`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db`.`Details`(
  `idDetails` INT NOT NULL,
  `Type` VARCHAR(45) NOT NULL,
  `Area` INT NOT NULL,
  `Title` VARCHAR(45) NOT NULL,
  `Content` VARCHAR(45) NOT NULL,
  `CreatedAt` DATETIME NULL,
  PRIMARY KEY (`idDetails`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`property info`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db`.`property info`(
  `idProperty` INT NOT NULL,
  `Location` VARCHAR(45) NOT NULL,
  `img` VARCHAR(45) NOT NULL,
  `price` INT NULL,
  `` VARCHAR(45) NULL,
  `User_idUser` INT NOT NULL,
  `User_table1_name` INT NOT NULL,
  `Details_idDetails` INT NOT NULL,
  PRIMARY KEY (`idProperty`, `User_idUser`, `User_table1_name`, `Details_idDetails`),
  INDEX `fk_property info_User1_idx` (`User_idUser` ASC, `User_table1_name` ASC) VISIBLE,
  INDEX `fk_property info_Details1_idx` (`Details_idDetails` ASC) VISIBLE,
  CONSTRAINT `fk_property info_User1`
    FOREIGN KEY (`User_idUser` , `User_table1_name`)
    REFERENCES `db`.`User` (`idUser` , `table1_name`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_property info_Details1`
    FOREIGN KEY (`Details_idDetails`)
    REFERENCES `db`.`Details` (`idDetails`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
