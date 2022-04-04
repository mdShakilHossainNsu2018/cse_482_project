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
                                                   `idprofile` INT NOT NULL AUTO_INCREMENT,
                                                   `number` VARCHAR(45) NOT NULL,
                                                   `address` VARCHAR(45) NOT NULL,
                                                   `name` VARCHAR(45) NOT NULL,
                                                   PRIMARY KEY (`idprofile`))
    ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db`.`users` (
                                            `iduser` INT NOT NULL AUTO_INCREMENT,
                                            `email` VARCHAR(45) NOT NULL,
                                            `password` VARCHAR(256) NOT NULL,
                                            `CreatedAt` DATETIME NOT NULL,
                                            `user_profile_idprofile` INT NOT NULL,
                                            PRIMARY KEY (`iduser`, `user_profile_idprofile`),
                                            INDEX `fk_users_user_profile_idx` (`user_profile_idprofile` ASC) VISIBLE,
                                            CONSTRAINT `fk_users_user_profile`
                                                FOREIGN KEY (`user_profile_idprofile`)
                                                    REFERENCES `db`.`user_profile` (`idprofile`)
                                                    ON DELETE NO ACTION
                                                    ON UPDATE NO ACTION)
    ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db`.`coords`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db`.`coords` (
                                             `idcoords` INT NOT NULL,
                                             `lat` DOUBLE NOT NULL,
                                             `long` DOUBLE NOT NULL,
                                             PRIMARY KEY (`idcoords`))
    ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db`.`details`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db`.`details` (
                                              `idDetails` INT NOT NULL AUTO_INCREMENT,
                                              `Type` VARCHAR(45) NOT NULL,
                                              `Area` INT NOT NULL,
                                              `Bed` INT NOT NULL,
                                              `Content` VARCHAR(45) NOT NULL,
                                              `CreatedAt` TIMESTAMP NOT NULL,
                                              `bath` INT NOT NULL,
                                              `coords_idcoords` INT NOT NULL,
                                              PRIMARY KEY (`idDetails`, `coords_idcoords`),
                                              INDEX `fk_details_coords1_idx` (`coords_idcoords` ASC) VISIBLE,
                                              CONSTRAINT `fk_details_coords1`
                                                  FOREIGN KEY (`coords_idcoords`)
                                                      REFERENCES `db`.`coords` (`idcoords`)
                                                      ON DELETE NO ACTION
                                                      ON UPDATE NO ACTION)
    ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db`.`property_info`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db`.`property_info` (
                                                    `idProperty` INT NOT NULL AUTO_INCREMENT,
                                                    `address` VARCHAR(45) NOT NULL,
                                                    `price` INT NOT NULL,
                                                    `users_iduser` INT NOT NULL,
                                                    `users_user_profile_idprofile` INT NOT NULL,
                                                    `details_idDetails` INT NOT NULL,
                                                    `title` VARCHAR(45) NOT NULL,
                                                    PRIMARY KEY (`idProperty`, `users_iduser`, `users_user_profile_idprofile`, `details_idDetails`),
                                                    INDEX `fk_property_info_users1_idx` (`users_iduser` ASC, `users_user_profile_idprofile` ASC) VISIBLE,
                                                    INDEX `fk_property_info_details1_idx` (`details_idDetails` ASC) VISIBLE,
                                                    CONSTRAINT `fk_property_info_users1`
                                                        FOREIGN KEY (`users_iduser` , `users_user_profile_idprofile`)
                                                            REFERENCES `db`.`users` (`iduser` , `user_profile_idprofile`)
                                                            ON DELETE NO ACTION
                                                            ON UPDATE NO ACTION,
                                                    CONSTRAINT `fk_property_info_details1`
                                                        FOREIGN KEY (`details_idDetails`)
                                                            REFERENCES `db`.`details` (`idDetails`)
                                                            ON DELETE NO ACTION
                                                            ON UPDATE NO ACTION)
    ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db`.`image`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db`.`image` (
                                            `idimage` INT NOT NULL AUTO_INCREMENT,
                                            `url` VARCHAR(255) NOT NULL,
                                            `alt` VARCHAR(255) NOT NULL,
                                            `property_info_idProperty` INT NOT NULL,
                                            `property_info_users_iduser` INT NOT NULL,
                                            `property_info_users_user_profile_idprofile` INT NOT NULL,
                                            PRIMARY KEY (`idimage`, `property_info_idProperty`, `property_info_users_iduser`, `property_info_users_user_profile_idprofile`),
                                            INDEX `fk_image_property_info1_idx` (`property_info_idProperty` ASC, `property_info_users_iduser` ASC, `property_info_users_user_profile_idprofile` ASC) VISIBLE,
                                            CONSTRAINT `fk_image_property_info1`
                                                FOREIGN KEY (`property_info_idProperty` , `property_info_users_iduser` , `property_info_users_user_profile_idprofile`)
                                                    REFERENCES `db`.`property_info` (`idProperty` , `users_iduser` , `users_user_profile_idprofile`)
                                                    ON DELETE NO ACTION
                                                    ON UPDATE NO ACTION)
    ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
