DROP DATABASE IF EXISTS `GameStore`;
CREATE DATABASE `GameStore` ;
USE `GameStore` ;

-- -----------------------------------------------------
-- Table `GameStore`.`user`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `GameStore`.`user` (
  `iduser` INT NOT NULL,
  `username` VARCHAR(45) NOT NULL,
  `password` VARCHAR(45) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`iduser`),
  UNIQUE INDEX `username_UNIQUE` (`username` ASC),
  UNIQUE INDEX `password_UNIQUE` (`password` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `GameStore`.`game_store`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `GameStore`.`game_store` (
  `gameid` INT NOT NULL,
  `gamename` VARCHAR(45) NOT NULL,
  `price` INT(3) NOT NULL,
  PRIMARY KEY (`gameid`, `gamename`),
  UNIQUE INDEX `gamename_UNIQUE` (`gamename` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `GameStore`.`game_library`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `GameStore`.`game_library` (
  `gameid` INT NOT NULL,
  `gamename` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`gameid`, `gamename`),
  INDEX `gamename_idx` (`gamename` ASC),
  UNIQUE INDEX `gamename_UNIQUE` (`gamename` ASC),
  CONSTRAINT `gameid`
    FOREIGN KEY (`gameid`)
    REFERENCES `GameStore`.`game_store` (`gameid`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `gamename`
    FOREIGN KEY (`gamename`)
    REFERENCES `GameStore`.`game_store` (`gamename`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `GameStore`.`games`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `GameStore`.`games` (
  `genre` VARCHAR(45) NOT NULL,
  `developer` VARCHAR(45) NOT NULL,
  `num_players` INT(3) UNSIGNED NULL,
  `systemtype` VARCHAR(45) NOT NULL,
  `games_name` VARCHAR(45) NOT NULL,
  UNIQUE INDEX `games_name_UNIQUE` (`games_name` ASC),
  PRIMARY KEY (`games_name`),
  CONSTRAINT `games_name`
    FOREIGN KEY (`games_name`)
    REFERENCES `GameStore`.`game_library` (`gamename`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `GameStore`.`user_library`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `GameStore`.`user_library` (
  `id_user` INT NOT NULL,
  `game_id` INT NOT NULL,
  `game_name` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id_user`, `game_id`, `game_name`),
  -- UNIQUE INDEX `game_name_UNIQUE` (`game_name` ASC),
  INDEX `gameid_idx` (`game_id` ASC),
  CONSTRAINT `id_user`
    FOREIGN KEY (`id_user`)
    REFERENCES `GameStore`.`user` (`iduser`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `game_name`
    FOREIGN KEY (`game_name`)
    REFERENCES `GameStore`.`game_store` (`gamename`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `game_id`
    FOREIGN KEY (`game_id`)
    REFERENCES `GameStore`.`game_store` (`gameid`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

COMMIT;