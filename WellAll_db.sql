-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema wellall_db
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema wellall_db
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `wellall_db` DEFAULT CHARACTER SET utf8mb3 ;
USE `wellall_db` ;

-- -----------------------------------------------------
-- Table `wellall_db`.`patient_table`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `wellall_db`.`patient_table` (
  `PatientID` INT NOT NULL AUTO_INCREMENT,
  `BarcodeID` VARCHAR(50) NOT NULL,
  `FirstName` VARCHAR(100) NOT NULL,
  `LastName` VARCHAR(100) NOT NULL,
  `DateOfBirth` DATE NOT NULL,
  `Gender` VARCHAR(10) NULL DEFAULT NULL,
  `ContactNumber` VARCHAR(20) NULL DEFAULT NULL,
  `Address` VARCHAR(255) NULL DEFAULT NULL,
  `BloodType` VARCHAR(10) NULL DEFAULT NULL,
  `Allergies` VARCHAR(45) NULL DEFAULT NULL,
  `ExistingConditions` VARCHAR(45) NULL DEFAULT NULL,
  `EmergencyContact` VARCHAR(100) NULL DEFAULT NULL,
  `EmergencyPhone` VARCHAR(20) NULL DEFAULT NULL,
  `DateRegistered` DATE NULL DEFAULT NULL,
  PRIMARY KEY (`PatientID`),
  UNIQUE INDEX `BarcodeID_UNIQUE` (`BarcodeID` ASC) VISIBLE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb3;


-- -----------------------------------------------------
-- Table `wellall_db`.`doctor_table`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `wellall_db`.`doctor_table` (
  `DoctorID` INT NOT NULL AUTO_INCREMENT,
  `DoctorCode` VARCHAR(50) NOT NULL,
  `FirstName` VARCHAR(100) NOT NULL,
  `LastName` VARCHAR(100) NOT NULL,
  `Specialization` VARCHAR(100) NULL DEFAULT NULL,
  `ContactNumber` VARCHAR(20) NULL DEFAULT NULL,
  `Email` VARCHAR(100) NULL DEFAULT NULL,
  `Address` VARCHAR(255) NULL DEFAULT NULL,
  `DateRegistered` DATE NULL DEFAULT NULL,
  PRIMARY KEY (`DoctorID`),
  UNIQUE INDEX `DoctorCode_UNIQUE` (`DoctorCode` ASC) VISIBLE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb3;


-- -----------------------------------------------------
-- Table `wellall_db`.`appointment_table`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `wellall_db`.`appointment_table` (
  `AppointmentID` INT NOT NULL AUTO_INCREMENT,
  `AppointmentCode` VARCHAR(50) NOT NULL,
  `PatientID` INT NULL DEFAULT NULL,
  `DoctorID` INT NULL DEFAULT NULL,
  `AppointmentDate` DATE NULL DEFAULT NULL,
  `AppointmentTime` TIME NULL DEFAULT NULL,
  `Reason` TEXT NULL DEFAULT NULL,
  `Status` ENUM('Scheduled', 'Completed', 'Cancelled') NULL DEFAULT 'Scheduled',
  `DateCreated` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`AppointmentID`),
  UNIQUE INDEX `AppointmentCode` (`AppointmentCode` ASC) VISIBLE,
  INDEX `PatientID` (`PatientID` ASC) VISIBLE,
  INDEX `DoctorID` (`DoctorID` ASC) VISIBLE,
  CONSTRAINT `appointment_table_ibfk_1`
    FOREIGN KEY (`PatientID`)
    REFERENCES `wellall_db`.`patient_table` (`PatientID`)
    ON DELETE CASCADE,
  CONSTRAINT `appointment_table_ibfk_2`
    FOREIGN KEY (`DoctorID`)
    REFERENCES `wellall_db`.`doctor_table` (`DoctorID`)
    ON DELETE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb3;


-- -----------------------------------------------------
-- Table `wellall_db`.`doctors_table`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `wellall_db`.`doctors_table` (
  `DoctorID` INT NOT NULL AUTO_INCREMENT,
  `DoctorBarcode` VARCHAR(50) NOT NULL,
  `DoctorFirstName` VARCHAR(100) NOT NULL,
  `DoctorLastName` VARCHAR(100) NOT NULL,
  `Specialization` VARCHAR(100) NULL DEFAULT NULL,
  `DoctorContactNumber` VARCHAR(20) NULL DEFAULT NULL,
  `DoctorEmail` VARCHAR(100) NULL DEFAULT NULL,
  `DoctorAddress` VARCHAR(255) NULL DEFAULT NULL,
  `DoctorDateRegistered` DATE NULL DEFAULT NULL,
  `DoctorAvailability` VARCHAR(150) NULL DEFAULT NULL,
  PRIMARY KEY (`DoctorID`))
ENGINE = InnoDB
AUTO_INCREMENT = 3
DEFAULT CHARACTER SET = utf8mb3;


-- -----------------------------------------------------
-- Table `wellall_db`.`patients_table`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `wellall_db`.`patients_table` (
  `PatientID` INT NOT NULL AUTO_INCREMENT,
  `PatientBarcodeID` VARCHAR(50) NOT NULL,
  `PatientFirstName` VARCHAR(100) NOT NULL,
  `PatientLastName` VARCHAR(100) NOT NULL,
  `PatientDateOfBirth` DATE NOT NULL,
  `PatientGender` VARCHAR(10) NULL DEFAULT NULL,
  `PatientContactNumber` VARCHAR(20) NULL DEFAULT NULL,
  `PatientAddress` VARCHAR(255) NULL DEFAULT NULL,
  `PatientBloodType` VARCHAR(10) NULL DEFAULT NULL,
  `PatientAllergies` VARCHAR(45) NULL DEFAULT NULL,
  `PatientExistingConditions` VARCHAR(45) NULL DEFAULT NULL,
  `PatientEmergencyContact` VARCHAR(200) NULL DEFAULT NULL,
  `PatientEmergencyPhone` VARCHAR(20) NULL DEFAULT NULL,
  `PatientDateRegistered` DATE NULL DEFAULT NULL,
  PRIMARY KEY (`PatientID`))
ENGINE = InnoDB
AUTO_INCREMENT = 7
DEFAULT CHARACTER SET = utf8mb3;


-- -----------------------------------------------------
-- Table `wellall_db`.`appointments_table`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `wellall_db`.`appointments_table` (
  `AppointmentID` INT NOT NULL AUTO_INCREMENT,
  `PatientID` INT NOT NULL,
  `DoctorID` INT NOT NULL,
  `AppointmentBarcodeID` VARCHAR(50) NOT NULL,
  `AppointmentDate` DATE NULL DEFAULT NULL,
  `AppointmentTime` TIME NULL DEFAULT NULL,
  `Reason` TEXT NULL DEFAULT NULL,
  `DateCreated` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `Status` VARCHAR(50) NULL DEFAULT 'Pending',
  PRIMARY KEY (`AppointmentID`),
  UNIQUE INDEX `AppointmentBarcodeID_UNIQUE` (`AppointmentBarcodeID` ASC) VISIBLE,
  INDEX `fk_appointments_table_patients_table_idx` (`PatientID` ASC) VISIBLE,
  INDEX `fk_appointments_table_doctors_table1_idx` (`DoctorID` ASC) VISIBLE,
  CONSTRAINT `fk_appointments_table_doctors_table1`
    FOREIGN KEY (`DoctorID`)
    REFERENCES `wellall_db`.`doctors_table` (`DoctorID`),
  CONSTRAINT `fk_appointments_table_patients_table`
    FOREIGN KEY (`PatientID`)
    REFERENCES `wellall_db`.`patients_table` (`PatientID`))
ENGINE = InnoDB
AUTO_INCREMENT = 12
DEFAULT CHARACTER SET = utf8mb3;


-- -----------------------------------------------------
-- Table `wellall_db`.`cache`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `wellall_db`.`cache` (
  `key` VARCHAR(255) NOT NULL,
  `value` MEDIUMTEXT NOT NULL,
  `expiration` INT NOT NULL,
  PRIMARY KEY (`key`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `wellall_db`.`cache_locks`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `wellall_db`.`cache_locks` (
  `key` VARCHAR(255) NOT NULL,
  `owner` VARCHAR(255) NOT NULL,
  `expiration` INT NOT NULL,
  PRIMARY KEY (`key`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `wellall_db`.`check_in_table`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `wellall_db`.`check_in_table` (
  `CheckInID` INT NOT NULL AUTO_INCREMENT,
  `PatientID` INT NOT NULL,
  `DoctorID` INT NOT NULL,
  `AppointmentID` INT NOT NULL,
  `CheckInTime` DATETIME NOT NULL,
  `CheckInRemarks` TEXT NULL DEFAULT NULL,
  `CheckInDateCreated` DATE NULL DEFAULT NULL,
  PRIMARY KEY (`CheckInID`),
  INDEX `fk_check_in_table_patients_table1_idx` (`PatientID` ASC) VISIBLE,
  INDEX `fk_check_in_table_doctors_table1_idx` (`DoctorID` ASC) VISIBLE,
  INDEX `fk_check_in_table_appointments_table1_idx` (`AppointmentID` ASC) VISIBLE,
  CONSTRAINT `fk_check_in_table_appointments_table1`
    FOREIGN KEY (`AppointmentID`)
    REFERENCES `wellall_db`.`appointments_table` (`AppointmentID`),
  CONSTRAINT `fk_check_in_table_doctors_table1`
    FOREIGN KEY (`DoctorID`)
    REFERENCES `wellall_db`.`doctors_table` (`DoctorID`),
  CONSTRAINT `fk_check_in_table_patients_table1`
    FOREIGN KEY (`PatientID`)
    REFERENCES `wellall_db`.`patients_table` (`PatientID`))
ENGINE = InnoDB
AUTO_INCREMENT = 12
DEFAULT CHARACTER SET = utf8mb3;


-- -----------------------------------------------------
-- Table `wellall_db`.`failed_jobs`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `wellall_db`.`failed_jobs` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` VARCHAR(255) NOT NULL,
  `connection` TEXT NOT NULL,
  `queue` TEXT NOT NULL,
  `payload` LONGTEXT NOT NULL,
  `exception` LONGTEXT NOT NULL,
  `failed_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `failed_jobs_uuid_unique` (`uuid` ASC) VISIBLE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `wellall_db`.`job_batches`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `wellall_db`.`job_batches` (
  `id` VARCHAR(255) NOT NULL,
  `name` VARCHAR(255) NOT NULL,
  `total_jobs` INT NOT NULL,
  `pending_jobs` INT NOT NULL,
  `failed_jobs` INT NOT NULL,
  `failed_job_ids` LONGTEXT NOT NULL,
  `options` MEDIUMTEXT NULL DEFAULT NULL,
  `cancelled_at` INT NULL DEFAULT NULL,
  `created_at` INT NOT NULL,
  `finished_at` INT NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `wellall_db`.`jobs`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `wellall_db`.`jobs` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `queue` VARCHAR(255) NOT NULL,
  `payload` LONGTEXT NOT NULL,
  `attempts` TINYINT UNSIGNED NOT NULL,
  `reserved_at` INT UNSIGNED NULL DEFAULT NULL,
  `available_at` INT UNSIGNED NOT NULL,
  `created_at` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `jobs_queue_index` (`queue` ASC) VISIBLE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `wellall_db`.`medical_records_table`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `wellall_db`.`medical_records_table` (
  `medicalID` INT NOT NULL AUTO_INCREMENT,
  `PatientID` INT NOT NULL,
  `DoctorID` INT NOT NULL,
  `diagnosis` TEXT NULL DEFAULT NULL,
  `treatment` TEXT NULL DEFAULT NULL,
  `prescription` TEXT NULL DEFAULT NULL,
  `MedicalDateRegistered` DATE NULL DEFAULT NULL,
  PRIMARY KEY (`medicalID`),
  INDEX `fk_medical_records_table_patients_table1_idx` (`PatientID` ASC) VISIBLE,
  INDEX `fk_medical_records_table_doctors_table1_idx` (`DoctorID` ASC) VISIBLE,
  CONSTRAINT `fk_medical_records_table_doctors_table1`
    FOREIGN KEY (`DoctorID`)
    REFERENCES `wellall_db`.`doctors_table` (`DoctorID`),
  CONSTRAINT `fk_medical_records_table_patients_table1`
    FOREIGN KEY (`PatientID`)
    REFERENCES `wellall_db`.`patients_table` (`PatientID`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb3;


-- -----------------------------------------------------
-- Table `wellall_db`.`migrations`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `wellall_db`.`migrations` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` VARCHAR(255) NOT NULL,
  `batch` INT NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 4
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `wellall_db`.`password_reset_tokens`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `wellall_db`.`password_reset_tokens` (
  `email` VARCHAR(255) NOT NULL,
  `token` VARCHAR(255) NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`email`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `wellall_db`.`queue_table`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `wellall_db`.`queue_table` (
  `QueueID` INT NOT NULL AUTO_INCREMENT,
  `AppointmentID` INT NULL DEFAULT NULL,
  `DoctorID` INT NOT NULL,
  `PatientID` INT NULL DEFAULT NULL,
  `QueueNumber` INT NULL DEFAULT NULL,
  `Status` ENUM('Waiting', 'In Progress', 'Done') NULL DEFAULT 'Waiting',
  `TimeAdded` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`QueueID`),
  INDEX `DoctorID` (`DoctorID` ASC) VISIBLE,
  INDEX `AppointmentID` (`AppointmentID` ASC) VISIBLE,
  INDEX `PatientID` (`PatientID` ASC) VISIBLE,
  CONSTRAINT `queue_table_ibfk_1`
    FOREIGN KEY (`DoctorID`)
    REFERENCES `wellall_db`.`doctors_table` (`DoctorID`),
  CONSTRAINT `queue_table_ibfk_2`
    FOREIGN KEY (`AppointmentID`)
    REFERENCES `wellall_db`.`appointments_table` (`AppointmentID`),
  CONSTRAINT `queue_table_ibfk_3`
    FOREIGN KEY (`PatientID`)
    REFERENCES `wellall_db`.`patients_table` (`PatientID`))
ENGINE = InnoDB
AUTO_INCREMENT = 12
DEFAULT CHARACTER SET = utf8mb3;


-- -----------------------------------------------------
-- Table `wellall_db`.`sessions`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `wellall_db`.`sessions` (
  `id` VARCHAR(255) NOT NULL,
  `user_id` BIGINT UNSIGNED NULL DEFAULT NULL,
  `ip_address` VARCHAR(45) NULL DEFAULT NULL,
  `user_agent` TEXT NULL DEFAULT NULL,
  `payload` LONGTEXT NOT NULL,
  `last_activity` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `sessions_user_id_index` (`user_id` ASC) VISIBLE,
  INDEX `sessions_last_activity_index` (`last_activity` ASC) VISIBLE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `wellall_db`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `wellall_db`.`users` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `email_verified_at` TIMESTAMP NULL DEFAULT NULL,
  `password` VARCHAR(255) NOT NULL,
  `remember_token` VARCHAR(100) NULL DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `users_email_unique` (`email` ASC) VISIBLE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
