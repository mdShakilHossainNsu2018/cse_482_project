-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema db
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema db
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `db` DEFAULT CHARACTER SET utf8 ;
USE `db` ;

-- -----------------------------------------------------
-- Table `db`.`user_profile`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db`.`user_profile` (
  `profileID` INT NOT NULL,
  `number` VARCHAR(45) NOT NULL,
  `address` VARCHAR(45) NOT NULL,
  `name` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`profileID`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db`.`users` (
  `id` INT NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `password` VARCHAR(256) NOT NULL,
  `CreatedAt` DATETIME NOT NULL,
  `user_profile_profileID` INT NOT NULL,
  PRIMARY KEY (`id`, `user_profile_profileID`),
  INDEX `fk_users_user_profile1_idx` (`user_profile_profileID` ASC) VISIBLE,
  CONSTRAINT `fk_users_user_profile1`
    FOREIGN KEY (`user_profile_profileID`)
    REFERENCES `db`.`user_profile` (`profileID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db`.`details`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db`.`details` (
  `idDetails` INT NOT NULL,
  `Type` VARCHAR(45) NOT NULL,
  `Area` INT NOT NULL,
  `Bed` INT NOT NULL,
  `Content` VARCHAR(45) NOT NULL,
  `CreatedAt` TIMESTAMP NOT NULL,
  `bath` INT NOT NULL,
  `lat` DOUBLE NOT NULL,
  `lang` DOUBLE NOT NULL,
  PRIMARY KEY (`idDetails`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db`.`coords`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db`.`coords` (
  `idcoords` INT NOT NULL,
  `lat` DOUBLE NOT NULL,
  `lang` DOUBLE NOT NULL,
  PRIMARY KEY (`idcoords`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db`.`property_info`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db`.`property_info` (
  `idProperty` INT NOT NULL,
  `Location` VARCHAR(45) NOT NULL,
  `price` INT ZEROFILL NOT NULL,
  `User_idUser` INT NOT NULL,
  `User_table1_name` INT NOT NULL,
  `Details_idDetails` INT NOT NULL,
  `coords_idcoords` INT NOT NULL,
  PRIMARY KEY (`idProperty`, `User_idUser`, `User_table1_name`, `Details_idDetails`),
  INDEX `fk_property info_User1_idx` (`User_idUser` ASC, `User_table1_name` ASC) VISIBLE,
  INDEX `fk_property info_Details1_idx` (`Details_idDetails` ASC) VISIBLE,
  INDEX `fk_property_info_coords1_idx` (`coords_idcoords` ASC) VISIBLE,
  CONSTRAINT `fk_property info_User1`
    FOREIGN KEY (`User_idUser`)
    REFERENCES `db`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_property info_Details1`
    FOREIGN KEY (`Details_idDetails`)
    REFERENCES `db`.`details` (`idDetails`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_property_info_coords1`
    FOREIGN KEY (`coords_idcoords`)
    REFERENCES `db`.`coords` (`idcoords`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db`.`image`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db`.`image` (
  `idimage` INT NOT NULL,
  `url` VARCHAR(255) NOT NULL,
  `alt` VARCHAR(255) NOT NULL,
  `property_info_idProperty` INT NOT NULL,
  `property_info_User_idUser` INT NOT NULL,
  `property_info_User_table1_name` INT NOT NULL,
  `property_info_Details_idDetails` INT NOT NULL,
  PRIMARY KEY (`idimage`, `property_info_idProperty`, `property_info_User_idUser`, `property_info_User_table1_name`, `property_info_Details_idDetails`),
  INDEX `fk_image_property_info1_idx` (`property_info_idProperty` ASC, `property_info_User_idUser` ASC, `property_info_User_table1_name` ASC, `property_info_Details_idDetails` ASC) VISIBLE,
  CONSTRAINT `fk_image_property_info1`
    FOREIGN KEY (`property_info_idProperty` , `property_info_User_idUser` , `property_info_User_table1_name` , `property_info_Details_idDetails`)
    REFERENCES `db`.`property_info` (`idProperty` , `User_idUser` , `User_table1_name` , `Details_idDetails`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
