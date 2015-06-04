SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `allameri_app` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `allameri_app` ;

-- -----------------------------------------------------
-- Table `allameri_app`.`tbl_roles`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `allameri_app`.`tbl_roles` (
  `role_id` TINYINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `description` VARCHAR(45) NULL,
  PRIMARY KEY (`role_id`),
  UNIQUE INDEX `description_UNIQUE` (`description` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `allameri_app`.`tbl_user`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `allameri_app`.`tbl_user` (
  `user_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(45) NULL,
  `pw_hash` VARCHAR(128) NULL,
  `first_name` VARCHAR(30) NULL,
  `last_name` VARCHAR(30) NULL,
  `role_id` TINYINT UNSIGNED NOT NULL,
  PRIMARY KEY (`user_id`),
  INDEX `username_index` (`username` ASC),
  INDEX `fk_tbl_user_tbl_roles1_idx` (`role_id` ASC),
  UNIQUE INDEX `username_UNIQUE` (`username` ASC),
  CONSTRAINT `fk_tbl_user_tbl_roles1`
    FOREIGN KEY (`role_id`)
    REFERENCES `allameri_app`.`tbl_roles` (`role_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `allameri_app`.`tbl_payment_terms`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `allameri_app`.`tbl_payment_terms` (
  `term_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `description` VARCHAR(120) NULL,
  PRIMARY KEY (`term_id`),
  UNIQUE INDEX `description_UNIQUE` (`description` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `allameri_app`.`tbl_company_type`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `allameri_app`.`tbl_company_type` (
  `comp_type_id` TINYINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `description` VARCHAR(50) NULL,
  PRIMARY KEY (`comp_type_id`),
  UNIQUE INDEX `description_UNIQUE` (`description` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `allameri_app`.`tbl_company`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `allameri_app`.`tbl_company` (
  `comp_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(128) NULL,
  `description` TEXT NULL,
  `website` VARCHAR(128) NULL,
  `updated` TIMESTAMP NULL,
  `comp_type_id` TINYINT UNSIGNED NOT NULL,
  `telephone` VARCHAR(15) NULL,
  PRIMARY KEY (`comp_id`),
  INDEX `fk_tbl_company_tbl_company_type1_idx` (`comp_type_id` ASC),
  UNIQUE INDEX `name_UNIQUE` (`name` ASC),
  CONSTRAINT `fk_tbl_company_tbl_company_type1`
    FOREIGN KEY (`comp_type_id`)
    REFERENCES `allameri_app`.`tbl_company_type` (`comp_type_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `allameri_app`.`tbl_purchase_order`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `allameri_app`.`tbl_purchase_order` (
  `po_number` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `maturity_date` DATE NULL,
  `created` TIMESTAMP NULL,
  `updated` TIMESTAMP NULL,
  `payment_term_id` INT UNSIGNED NOT NULL,
  `comp_id` INT UNSIGNED NOT NULL,
  `comments` TEXT NULL,
  `is_open` TINYINT(1) NOT NULL DEFAULT 1,
  `contact` VARCHAR(150) NULL,
  `contact_telephone` VARCHAR(15) NULL,
  PRIMARY KEY (`po_number`),
  INDEX `fk_tbl_purchase_order_tbl_payment_terms1_idx` (`payment_term_id` ASC),
  INDEX `fk_tbl_purchase_order_tbl_company1_idx` (`comp_id` ASC),
  CONSTRAINT `fk_tbl_purchase_order_tbl_payment_terms1`
    FOREIGN KEY (`payment_term_id`)
    REFERENCES `allameri_app`.`tbl_payment_terms` (`term_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tbl_purchase_order_tbl_company1`
    FOREIGN KEY (`comp_id`)
    REFERENCES `allameri_app`.`tbl_company` (`comp_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `allameri_app`.`tbl_material_category`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `allameri_app`.`tbl_material_category` (
  `cat_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `description` VARCHAR(120) NULL,
  PRIMARY KEY (`cat_id`),
  UNIQUE INDEX `description_UNIQUE` (`description` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `allameri_app`.`tbl_material`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `allameri_app`.`tbl_material` (
  `material_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `description` VARCHAR(150) NULL,
  `cat_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`material_id`),
  INDEX `fk_tbl_material_tbl_material_category1_idx` (`cat_id` ASC),
  UNIQUE INDEX `description_UNIQUE` (`description` ASC),
  CONSTRAINT `fk_tbl_material_tbl_material_category1`
    FOREIGN KEY (`cat_id`)
    REFERENCES `allameri_app`.`tbl_material_category` (`cat_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `allameri_app`.`tbl_po_items`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `allameri_app`.`tbl_po_items` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `material_id` INT UNSIGNED NOT NULL,
  `po_number` INT UNSIGNED NOT NULL,
  `qty` DECIMAL(12,3) UNSIGNED NULL,
  `qty_units` VARCHAR(15) NULL,
  `unit_price` DECIMAL(6,3) UNSIGNED NULL,
  `price_units` VARCHAR(15) NULL,
  `qty_recieved` DECIMAL(12,3) UNSIGNED NULL,
  `qty_diff` DECIMAL(12,3) NULL,
  `date` DATE NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_tbl_po_items_tbl_material_idx` (`material_id` ASC),
  INDEX `fk_tbl_po_items_tbl_purchase_order1_idx` (`po_number` ASC),
  CONSTRAINT `fk_tbl_po_items_tbl_material`
    FOREIGN KEY (`material_id`)
    REFERENCES `allameri_app`.`tbl_material` (`material_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tbl_po_items_tbl_purchase_order1`
    FOREIGN KEY (`po_number`)
    REFERENCES `allameri_app`.`tbl_purchase_order` (`po_number`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `allameri_app`.`tbl_country`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `allameri_app`.`tbl_country` (
  `ccode` VARCHAR(2) NOT NULL,
  `country` VARCHAR(200) NULL,
  PRIMARY KEY (`ccode`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `allameri_app`.`tbl_address`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `allameri_app`.`tbl_address` (
  `address_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `comp_id` INT UNSIGNED NOT NULL,
  `name` VARCHAR(70) NULL,
  `address1` VARCHAR(150) NULL,
  `address2` VARCHAR(150) NULL,
  `city` VARCHAR(150) NULL,
  `province` VARCHAR(150) NULL,
  `postal_code` VARCHAR(20) NULL,
  `updated` TIMESTAMP NULL,
  `country_code` VARCHAR(2) NOT NULL,
  PRIMARY KEY (`address_id`, `comp_id`),
  INDEX `fk_tbl_ship_address_tbl_company1_idx` (`comp_id` ASC),
  INDEX `fk_tbl_ship_address_tbl_country1_idx` (`country_code` ASC),
  CONSTRAINT `fk_tbl_ship_address_tbl_company1`
    FOREIGN KEY (`comp_id`)
    REFERENCES `allameri_app`.`tbl_company` (`comp_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_tbl_ship_address_tbl_country1`
    FOREIGN KEY (`country_code`)
    REFERENCES `allameri_app`.`tbl_country` (`ccode`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `allameri_app`.`tbl_sale_order`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `allameri_app`.`tbl_sale_order` (
  `sale_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `po_number` VARCHAR(30) NULL,
  `maturity_date` DATE NULL,
  `created` TIMESTAMP NULL,
  `updated` TIMESTAMP NULL,
  `comments` TEXT NULL,
  `comp_id` INT UNSIGNED NOT NULL,
  `payment_term_id` INT UNSIGNED NOT NULL,
  `is_open` TINYINT(1) NOT NULL DEFAULT 1,
  `address_id` INT UNSIGNED NOT NULL,
  `contact` VARCHAR(150) NULL,
  `contact_telephone` VARCHAR(15) NULL,
  PRIMARY KEY (`sale_id`),
  INDEX `fk_tbl_sale_order_tbl_company1_idx` (`comp_id` ASC),
  INDEX `fk_tbl_sale_order_tbl_payment_terms1_idx` (`payment_term_id` ASC),
  INDEX `fk_tbl_sale_order_tbl_address1_idx` (`address_id` ASC),
  CONSTRAINT `fk_tbl_sale_order_tbl_company1`
    FOREIGN KEY (`comp_id`)
    REFERENCES `allameri_app`.`tbl_company` (`comp_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tbl_sale_order_tbl_payment_terms1`
    FOREIGN KEY (`payment_term_id`)
    REFERENCES `allameri_app`.`tbl_payment_terms` (`term_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tbl_sale_order_tbl_address1`
    FOREIGN KEY (`address_id`)
    REFERENCES `allameri_app`.`tbl_address` (`address_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `allameri_app`.`tbl_sale_items`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `allameri_app`.`tbl_sale_items` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `material_id` INT UNSIGNED NOT NULL,
  `sale_id` INT UNSIGNED NOT NULL,
  `qty` DECIMAL(12,3) UNSIGNED NULL,
  `qty_units` VARCHAR(15) NULL,
  `unit_price` DECIMAL(6,3) UNSIGNED NULL,
  `price_units` VARCHAR(15) NULL,
  `qty_shipped` DECIMAL(12,3) UNSIGNED NULL,
  `qty_diff` DECIMAL(12,3) NULL,
  `date` DATE NULL,
  INDEX `fk_tbl_po_items_tbl_material_idx` (`material_id` ASC),
  INDEX `fk_tbl_shipment_items_tbl_shipment_order1_idx` (`sale_id` ASC),
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_tbl_po_items_tbl_material1`
    FOREIGN KEY (`material_id`)
    REFERENCES `allameri_app`.`tbl_material` (`material_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tbl_shipment_items_tbl_shipment_order1`
    FOREIGN KEY (`sale_id`)
    REFERENCES `allameri_app`.`tbl_sale_order` (`sale_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
