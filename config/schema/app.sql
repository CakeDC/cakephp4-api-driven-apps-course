/**
 * APPLICATION DATABASE SCHEMA V1
 * To create this schema, use a MySQL IDE like phpMyAdmin.
 */

CREATE TABLE `people` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `birth_year` varchar(255) NOT NULL,
  `eye_color` varchar(255) NOT NULL,
  `hair_color` varchar(255) NOT NULL,
  `height` varchar(255) NOT NULL,
  `mass` varchar(255) NOT NULL,
  `planet_id` int(11) NOT NULL,
  `species_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `planets` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `climate` varchar(255) NOT NULL,
  `diameter` varchar(255) NOT NULL,
  `orbital_period` varchar(255) NOT NULL,
  `gravity` varchar(255) NOT NULL,
  `terrain` varchar(255) NOT NULL,
  `population` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `species` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `classification` varchar(255) NOT NULL,
  `designation` varchar(255) NOT NULL,
  `average_height` varchar(255) NOT NULL,
  `average_lifespan` varchar(256) NOT NULL,
  `language` varchar(255) NOT NULL,
  `planet_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `vehicles` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `manufacturer` varchar(255) NOT NULL,
  `model` varchar(255) NOT NULL,
  `vehicle_class` varchar(255) NOT NULL,
  `passengers` varchar(255) NOT NULL,
  `crew` varchar(255) NOT NULL,
  `cargo_capacity` varchar(255) NOT NULL,
  `owner_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


ALTER TABLE `people`
  ADD PRIMARY KEY (`id`),
  ADD KEY `planet_id` (`planet_id`),
  ADD KEY `species_id` (`species_id`);

ALTER TABLE `planets`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `species`
  ADD PRIMARY KEY (`id`),
  ADD KEY `planet_id` (`planet_id`);

ALTER TABLE `vehicles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `owner_id` (`owner_id`);


ALTER TABLE `people`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `planets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `species`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `vehicles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;


ALTER TABLE `people`
  ADD CONSTRAINT `people_planets` FOREIGN KEY (`planet_id`) REFERENCES `planets` (`id`),
  ADD CONSTRAINT `people_species` FOREIGN KEY (`species_id`) REFERENCES `species` (`id`);

ALTER TABLE `species`
  ADD CONSTRAINT `species_planets` FOREIGN KEY (`planet_id`) REFERENCES `planets` (`id`);

ALTER TABLE `vehicles`
  ADD CONSTRAINT `vehicles_people` FOREIGN KEY (`owner_id`) REFERENCES `people` (`id`);
