CREATE TABLE `canteen_transactions`.`login` ( `loginID` INT NOT NULL AUTO_INCREMENT , `userName` VARCHAR(100) NOT NULL , `userPass` VARCHAR(100) NOT NULL , PRIMARY KEY (`loginID`)) ENGINE = InnoDB;

INSERT INTO `login`(`loginID`, `userName`, `userPass`) VALUES (null,'canteen','canteen')