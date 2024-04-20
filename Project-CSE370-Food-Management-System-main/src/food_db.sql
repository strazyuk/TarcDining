-- Database creation and selection
CREATE DATABASE IF NOT EXISTS TarcDining;
USE TarcDining;

-- Create user table
CREATE TABLE IF NOT EXISTS `user` (
  `email` VARCHAR(45) NOT NULL,
  `username` VARCHAR(45) NULL,
  `password` VARCHAR(45) NULL,
  `role` VARCHAR(45) NULL,
  PRIMARY KEY (`email`),
  UNIQUE INDEX `user_email_UNIQUE` (`email`)
);

-- Create staff table
CREATE TABLE IF NOT EXISTS `staff` (
  `email` VARCHAR(45) NOT NULL,
  `Role` VARCHAR(45) NULL,
  `serv_iD` INT NULL,
  `staffcol` VARCHAR(45) NULL,
  PRIMARY KEY (`email`),
  CONSTRAINT `fk_staff_user`
    FOREIGN KEY (`email`)
    REFERENCES `user` (`email`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
);

-- Create admin table
CREATE TABLE IF NOT EXISTS `Admin` (
  `email` VARCHAR(45) NOT NULL,
  `password` VARCHAR(45) NULL,
  `revenue` DECIMAL(10,2) NULL,
  `wrkHrs` VARCHAR(45) NULL,
  PRIMARY KEY (`email`),
  CONSTRAINT `fk_admin_user`
    FOREIGN KEY (`email`)
    REFERENCES `user` (`email`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
);

-- Create student table
CREATE TABLE IF NOT EXISTS `student` (
  `email` VARCHAR(45) NOT NULL,
  `tokenCnt` INT NULL,
  PRIMARY KEY (`email`),
  CONSTRAINT `fk_student_user`
    FOREIGN KEY (`email`)
    REFERENCES `user` (`email`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
);

-- Create feedback table
CREATE TABLE IF NOT EXISTS `feedback` (
  `s_id` INT NOT NULL AUTO_INCREMENT,
  `text` VARCHAR(45) NULL,
  `mealRating` VARCHAR(45) NULL,
  PRIMARY KEY (`s_id`)
);

-- Create curMenu table
CREATE TABLE IF NOT EXISTS `curMenu` (
  `f_id` INT NOT NULL AUTO_INCREMENT,
  `img` VARCHAR(45) NULL,
  `name` VARCHAR(45) NULL,
  `type` VARCHAR(45) NULL,
  `rating` INT NULL,
  `adminEmail` VARCHAR(45) NULL,
  `token` INT NULL,
  `status` VARCHAR(45) NULL,
  `sellCount` INT NULL,
  PRIMARY KEY (`f_id`)
);

-- Create payment table
CREATE TABLE IF NOT EXISTS `payment` (
  `c_id` INT NOT NULL AUTO_INCREMENT,
  `status` VARCHAR(45) NULL,
  `amount` VARCHAR(45) NULL,
  `trn_id` VARCHAR(45) NULL,
  `method` VARCHAR(45) NULL,
  `email` VARCHAR(45) NULL,
  PRIMARY KEY (`c_id`),
  UNIQUE INDEX `trn_id_UNIQUE` (`trn_id`),
  CONSTRAINT `fk_payment_student`
    FOREIGN KEY (`email`)
    REFERENCES `student` (`email`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
);

-- Create cart table
CREATE TABLE IF NOT EXISTS `cart` (
  `email` VARCHAR(45) NOT NULL,
  `f_id` INT NOT NULL,
  `token` INT NULL,
  `name` VARCHAR(45) NULL,
  PRIMARY KEY (`email`, `f_id`),
  CONSTRAINT `fk_cart_student`
    FOREIGN KEY (`email`)
    REFERENCES `student` (`email`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_cart_curMenu`
    FOREIGN KEY (`f_id`)
    REFERENCES `curMenu` (`f_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
);

-- Insert admin data into the Admin table
-- Insert user data
INSERT INTO `user` (`email`, `username`, `password`, `role`) VALUES ('admin@gmail.com', 'Admin', '111', 'admin');

-- Insert admin data into the Admin table
INSERT INTO `Admin` (`email`, `password`, `revenue`, `wrkHrs`) VALUES ('admin@gmail.com', '111', NULL, NULL);
