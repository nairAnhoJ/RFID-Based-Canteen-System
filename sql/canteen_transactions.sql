CREATE TABLE `canteen_transactions`.`emp_list` ( `emp_id` INT NOT NULL AUTO_INCREMENT , `emp_idNum` VARCHAR(100) NOT NULL ,  `emp_name` VARCHAR(100) NOT NULL , `emp_cardNum` VARCHAR(100) NOT NULL , `employer` VARCHAR(100) NOT NULL , PRIMARY KEY (`emp_id`)) ENGINE = InnoDB;

CREATE TABLE `canteen_transactions`.`tbl_trans_logs` ( `transaction_id` INT NOT NULL AUTO_INCREMENT , `emp_id` VARCHAR(100) NOT NULL ,  `emp_name` VARCHAR(100) NOT NULL , `emp_cardNum` VARCHAR(100) NOT NULL , `employer` VARCHAR(100) NOT NULL , `tran_date` DATE NOT NULL , `tran_time` VARCHAR(100) NOT NULL , PRIMARY KEY (`transaction_id`)) ENGINE = InnoDB;

CREATE TABLE `canteen_transactions`.`login` ( `loginID` INT NOT NULL AUTO_INCREMENT , `userName` VARCHAR(100) NOT NULL , `userPass` VARCHAR(100) NOT NULL , PRIMARY KEY (`loginID`)) ENGINE = InnoDB;

INSERT INTO `login`(`loginID`, `userName`, `userPass`) VALUES (null,'canteen','canteen');

CREATE TABLE `canteen_transactions`.`logbooksales` ( `logbook_ID` INT NOT NULL AUTO_INCREMENT , `lgbk_date` DATE NOT NULL , `lgbk_name` VARCHAR(100) NOT NULL , `lgbk_employer` VARCHAR(100) NOT NULL , PRIMARY KEY (`logbook_ID`)) ENGINE = InnoDB;

INSERT INTO `emp_list`(`emp_id`, `emp_idNum`, `emp_name`, `emp_cardNum`, `employer`) VALUES (null,'123','GLORY-TEST','123','GLORY');

INSERT INTO `emp_list`(`emp_id`, `emp_idNum`, `emp_name`, `emp_cardNum`, `employer`) VALUES (null,'1234','MAXIM-TEST','1234','MAXIM');

INSERT INTO `emp_list`(`emp_id`, `emp_idNum`, `emp_name`, `emp_cardNum`, `employer`) VALUES (null,'12345','NIPPI-TEST','12345','NIPPI');

INSERT INTO `emp_list`(`emp_id`, `emp_idNum`, `emp_name`, `emp_cardNum`, `employer`) VALUES (null,'123456','POWERLANE-TEST','123456','POWERLANE');
