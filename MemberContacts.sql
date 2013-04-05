SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

CREATE SCHEMA IF NOT EXISTS `MemberContacts` DEFAULT CHARACTER SET utf8 ;
USE `MemberContacts` ;

-- -----------------------------------------------------
-- Table `MemberContacts`.`StaffMember`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `MemberContacts`.`StaffMember` ;

CREATE  TABLE IF NOT EXISTS `MemberContacts`.`StaffMember` (
  `idStaffMember` INT NOT NULL AUTO_INCREMENT ,
  `Team` VARCHAR(45) NULL ,
  `Program` VARCHAR(45) NULL ,
  PRIMARY KEY (`idStaffMember`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `MemberContacts`.`TotalHours`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `MemberContacts`.`TotalHours` ;

CREATE  TABLE IF NOT EXISTS `MemberContacts`.`TotalHours` (
  `idTotalHours` INT NOT NULL AUTO_INCREMENT ,
  `Direct` INT NULL ,
  `IndirectHours` INT NULL ,
  PRIMARY KEY (`idTotalHours`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `MemberContacts`.`LocationHours`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `MemberContacts`.`LocationHours` ;

CREATE  TABLE IF NOT EXISTS `MemberContacts`.`LocationHours` (
  `idLocationHours` INT NOT NULL AUTO_INCREMENT ,
  `idTotalContacts` INT NULL ,
  `idTotalHours` INT NULL ,
  PRIMARY KEY (`idLocationHours`) ,
  INDEX `fk_TotalHours` (`idTotalHours` ASC) ,
  CONSTRAINT `fk_TotalHours`
    FOREIGN KEY (`idTotalHours` )
    REFERENCES `MemberContacts`.`TotalHours` (`idTotalHours` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `MemberContacts`.`Service`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `MemberContacts`.`Service` ;

CREATE  TABLE IF NOT EXISTS `MemberContacts`.`Service` (
  `idService` INT NOT NULL AUTO_INCREMENT ,
  `ServiceType` VARCHAR(45) NULL ,
  `ServiceDescription` VARCHAR(45) NULL ,
  PRIMARY KEY (`idService`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `MemberContacts`.`ContactDemographics`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `MemberContacts`.`ContactDemographics` ;

CREATE  TABLE IF NOT EXISTS `MemberContacts`.`ContactDemographics` (
  `idContactDemographics` INT NOT NULL ,
  `Caucasion` INT NULL ,
  `FirstNation` INT NULL ,
  `VisibleMinority` INT NULL ,
  `12Younger` INT NULL ,
  `1314` INT NULL ,
  `1516` VARCHAR(45) NULL ,
  `1718` VARCHAR(45) NULL ,
  `18Plus` VARCHAR(45) NULL ,
  PRIMARY KEY (`idContactDemographics`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `MemberContacts`.`TotalContacts`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `MemberContacts`.`TotalContacts` ;

CREATE  TABLE IF NOT EXISTS `MemberContacts`.`TotalContacts` (
  `idTotalContacts` INT NOT NULL AUTO_INCREMENT ,
  `NumberContacts` INT NULL ,
  `idContactDemographics` INT NULL ,
  PRIMARY KEY (`idTotalContacts`) ,
  INDEX `fkContactDemographics` (`idContactDemographics` ASC) ,
  CONSTRAINT `fkContactDemographics`
    FOREIGN KEY (`idContactDemographics` )
    REFERENCES `MemberContacts`.`ContactDemographics` (`idContactDemographics` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `MemberContacts`.`Location`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `MemberContacts`.`Location` ;

CREATE  TABLE IF NOT EXISTS `MemberContacts`.`Location` (
  `idLocation` INT NOT NULL AUTO_INCREMENT ,
  `City` VARCHAR(45) NULL ,
  `idLocationHours` INT NULL ,
  `LocationName` VARCHAR(45) NULL ,
  PRIMARY KEY (`idLocation`) ,
  INDEX `fkLocationHours` (`idLocationHours` ASC) ,
  CONSTRAINT `fkLocationHours`
    FOREIGN KEY (`idLocationHours` )
    REFERENCES `MemberContacts`.`LocationHours` (`idLocationHours` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `MemberContacts`.`StaffServiceContacts`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `MemberContacts`.`StaffServiceContacts` ;

CREATE  TABLE IF NOT EXISTS `MemberContacts`.`StaffServiceContacts` (
  `idStaffServiceContacts` INT NOT NULL AUTO_INCREMENT ,
  `idTotalHours` INT NULL ,
  `idService` INT NULL ,
  `idTotalContacts` INT NULL ,
  `idStaffMember` INT NULL ,
  `idLocation` INT NULL ,
  PRIMARY KEY (`idStaffServiceContacts`) ,
  INDEX `fkTotalHours` (`idTotalHours` ASC) ,
  INDEX `fkService` (`idService` ASC) ,
  INDEX `fkTotalContacts` (`idTotalContacts` ASC) ,
  INDEX `fkStaffMember` (`idStaffMember` ASC) ,
  INDEX `fkLocation` (`idLocation` ASC) ,
  CONSTRAINT `fkTotalHours`
    FOREIGN KEY (`idTotalHours` )
    REFERENCES `MemberContacts`.`TotalHours` (`idTotalHours` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fkService`
    FOREIGN KEY (`idService` )
    REFERENCES `MemberContacts`.`Service` (`idService` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fkTotalContacts`
    FOREIGN KEY (`idTotalContacts` )
    REFERENCES `MemberContacts`.`TotalContacts` (`idTotalContacts` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fkStaffMember`
    FOREIGN KEY (`idStaffMember` )
    REFERENCES `MemberContacts`.`StaffMember` (`idStaffMember` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fkLocation`
    FOREIGN KEY (`idLocation` )
    REFERENCES `MemberContacts`.`Location` (`idLocation` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
er file contents here
