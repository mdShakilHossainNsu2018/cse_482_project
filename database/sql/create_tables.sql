-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema db
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `db` ;

-- -----------------------------------------------------
-- Schema db
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `db` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci ;
USE `db` ;

-- -----------------------------------------------------
-- Table `db`.`users`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `db`.`users` ;

CREATE TABLE IF NOT EXISTS `db`.`users` (
  `user_id` INT NOT NULL AUTO_INCREMENT,
  `email` VARCHAR(256) NOT NULL,
  `password` TEXT NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_admin` TINYINT NULL DEFAULT 0,
  PRIMARY KEY (`user_id`),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC) VISIBLE)
ENGINE = InnoDB
AUTO_INCREMENT = 39
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `db`.`channels`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `db`.`channels` ;

CREATE TABLE IF NOT EXISTS `db`.`channels` (
  `channel_id` INT NOT NULL AUTO_INCREMENT,
  `users_user_id` INT NOT NULL,
  PRIMARY KEY (`channel_id`),
  UNIQUE INDEX `channel_id_UNIQUE` (`channel_id` ASC) VISIBLE,
  INDEX `fk_channels_users1_idx` (`users_user_id` ASC) VISIBLE,
  CONSTRAINT `fk_channels_users1`
    FOREIGN KEY (`users_user_id`)
    REFERENCES `db`.`users` (`user_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `db`.`properties`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `db`.`properties` ;

CREATE TABLE IF NOT EXISTS `db`.`properties` (
  `property_id` INT NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(45) NOT NULL,
  `address` TEXT NOT NULL,
  `price` INT(100) UNSIGNED ZEROFILL NOT NULL,
  `area` INT NOT NULL,
  `beds` INT NOT NULL,
  `baths` INT NOT NULL,
  `details` TEXT NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `image` TEXT NULL DEFAULT NULL,
  `users_user_id` INT NOT NULL,
  PRIMARY KEY (`property_id`),
  INDEX `fk_properties_users1_idx` (`users_user_id` ASC) VISIBLE,
  CONSTRAINT `fk_properties_users1`
    FOREIGN KEY (`users_user_id`)
    REFERENCES `db`.`users` (`user_id`))
ENGINE = InnoDB
AUTO_INCREMENT = 58
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `db`.`coords`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `db`.`coords` ;

CREATE TABLE IF NOT EXISTS `db`.`coords` (
  `coords_id` INT NOT NULL AUTO_INCREMENT,
  `lat` DOUBLE NOT NULL,
  `long` DOUBLE NOT NULL,
  `properties_property_id` INT NOT NULL,
  PRIMARY KEY (`coords_id`),
  INDEX `fk_coords_properties1_idx` (`properties_property_id` ASC) VISIBLE,
  CONSTRAINT `fk_coords_properties1`
    FOREIGN KEY (`properties_property_id`)
    REFERENCES `db`.`properties` (`property_id`))
ENGINE = InnoDB
AUTO_INCREMENT = 57
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `db`.`images`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `db`.`images` ;

CREATE TABLE IF NOT EXISTS `db`.`images` (
  `image_id` INT NOT NULL AUTO_INCREMENT,
  `url` VARCHAR(255) NOT NULL,
  `alt` VARCHAR(255) NULL DEFAULT NULL,
  `properties_property_id` INT NOT NULL,
  PRIMARY KEY (`image_id`),
  INDEX `fk_images_properties1_idx` (`properties_property_id` ASC) VISIBLE,
  CONSTRAINT `fk_images_properties1`
    FOREIGN KEY (`properties_property_id`)
    REFERENCES `db`.`properties` (`property_id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `db`.`messages`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `db`.`messages` ;

CREATE TABLE IF NOT EXISTS `db`.`messages` (
  `create_time` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `update_time` TIMESTAMP NULL DEFAULT NULL,
  `message_id` INT NOT NULL AUTO_INCREMENT,
  `message` TEXT NULL DEFAULT NULL,
  `channels_channel_id` INT NOT NULL,
  `is_admin` VARCHAR(45) NULL DEFAULT NULL,
  `sender` INT NOT NULL,
  PRIMARY KEY (`message_id`, `sender`),
  UNIQUE INDEX `message_id_UNIQUE` (`message_id` ASC) VISIBLE,
  INDEX `fk_messages_channels1_idx` (`channels_channel_id` ASC) VISIBLE,
  CONSTRAINT `fk_messages_channels1`
    FOREIGN KEY (`channels_channel_id`)
    REFERENCES `db`.`channels` (`channel_id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `db`.`user_profile`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `db`.`user_profile` ;

CREATE TABLE IF NOT EXISTS `db`.`user_profile` (
  `profile_id` INT NOT NULL AUTO_INCREMENT,
  `phone` VARCHAR(45) NULL DEFAULT NULL,
  `address` TEXT NULL DEFAULT NULL,
  `name` VARCHAR(256) NULL DEFAULT NULL,
  `image` TEXT NULL DEFAULT NULL,
  `users_user_id` INT NOT NULL,
  PRIMARY KEY (`profile_id`),
  UNIQUE INDEX `idprofile_UNIQUE` (`profile_id` ASC) VISIBLE,
  UNIQUE INDEX `phone_UNIQUE` (`phone` ASC) VISIBLE,
  INDEX `fk_user_profile_users1_idx` (`users_user_id` ASC) VISIBLE,
  CONSTRAINT `fk_user_profile_users1`
    FOREIGN KEY (`users_user_id`)
    REFERENCES `db`.`users` (`user_id`))
ENGINE = InnoDB
AUTO_INCREMENT = 39
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
