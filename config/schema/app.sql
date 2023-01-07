/**
 * APPLICATION DATABASE SCHEMA V1
 * To create this schema, use a MySQL IDE like phpMyAdmin.
 */

CREATE TABLE
    `my_app`.`people` (
        `id` INT NOT NULL AUTO_INCREMENT,
        `name` VARCHAR(255) NOT NULL,
        `birth_year` VARCHAR(255) NOT NULL,
        `eye_color` VARCHAR(255) NOT NULL,
        `hair_color` VARCHAR(255) NOT NULL,
        `height` VARCHAR(255) NOT NULL,
        `mass` VARCHAR(255) NOT NULL,
        `planet_id` INT NOT NULL,
        PRIMARY KEY (`id`)
    ) ENGINE = InnoDB;

CREATE TABLE
    `my_app`.`planets` (
        `id` INT NOT NULL AUTO_INCREMENT,
        `name` VARCHAR(255) NOT NULL,
        `climate` VARCHAR(255) NOT NULL,
        `diameter` VARCHAR(255) NOT NULL,
        `orbital_period` VARCHAR(255) NOT NULL,
        `gravity` VARCHAR(255) NOT NULL,
        `terrain` VARCHAR(255) NOT NULL,
        `population` VARCHAR(255) NOT NULL,
        PRIMARY KEY (`id`)
    ) ENGINE = InnoDB;

CREATE TABLE
    `my_app`.`vehicles` (
        `id` INT NOT NULL AUTO_INCREMENT,
        `name` VARCHAR(255) NOT NULL,
        `manufacturer` VARCHAR(255) NOT NULL,
        `model` VARCHAR(255) NOT NULL,
        `vehicle_class` VARCHAR(255) NOT NULL,
        `passengers` VARCHAR(255) NOT NULL,
        `crew` VARCHAR(255) NOT NULL,
        `cargo_capacity` VARCHAR(255) NOT NULL,
        PRIMARY KEY (`id`)
    ) ENGINE = InnoDB;

CREATE TABLE
    `my_app`.`species` (
        `id` INT NOT NULL AUTO_INCREMENT,
        `name` VARCHAR(255) NOT NULL,
        `classification` VARCHAR(255) NOT NULL,
        `designation` VARCHAR(255) NOT NULL,
        `average_height` VARCHAR(255) NOT NULL,
        `average_lifespan` VARCHAR(255) NOT NULL,
        `language` VARCHAR(255) NOT NULL,
        `planet_id` INT NOT NULL,
        PRIMARY KEY (`id`)
    ) ENGINE = InnoDB;