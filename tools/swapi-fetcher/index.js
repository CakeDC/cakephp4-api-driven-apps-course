const axios = require('axios');

// Fetch data from SWAPI and process it
async function fetchData(url) {
  try {
    const response = await axios.get(url);
    return response.data;
  } catch (error) {
    console.error('Error fetching data:', error);
    throw error;
  }
}

// Generate SQL INSERT statements for people table
function generatePeopleSql(people) {
  return people.map(person => {
    return `INSERT INTO people (id, name, birth_year, eye_color, hair_color, height, mass, planet_id, species_id) VALUES (${person.id}, '${person.name}', '${person.birth_year}', '${person.eye_color}', '${person.hair_color}', '${person.height}', '${person.mass}', ${person.homeworld.match(/\d+/)}, ${person.species.length > 0 ? person.species[0].match(/\d+/) : 'NULL'});`;
  });
}

// Generate SQL INSERT statements for planets table
function generatePlanetsSql(planets) {
  return planets.map(planet => {
    return `INSERT INTO planets (id, name, climate, diameter, orbital_period, gravity, terrain, population) VALUES (${planet.id}, '${planet.name}', '${planet.climate}', '${planet.diameter}', '${planet.orbital_period}', '${planet.gravity}', '${planet.terrain}', '${planet.population}');`;
  });
}

// Generate SQL INSERT statements for species table
function generateSpeciesSql(species) {
  return species.map(specie => {
    return `INSERT INTO species (id, name, classification, designation, average_height, average_lifespan, language, planet_id) VALUES (${specie.id}, '${specie.name}', '${specie.classification}', '${specie.designation}', '${specie.average_height}', '${specie.average_lifespan}', '${specie.language}', ${specie.homeworld.match(/\d+/)});`;
  });
}

// Generate SQL INSERT statements for vehicles table
function generateVehiclesSql(vehicles) {
  return vehicles.map(vehicle => {
    return `INSERT INTO vehicles (id, name, manufacturer, model, vehicle_class, passengers, crew, cargo_capacity, owner_id) VALUES (${vehicle.id}, '${vehicle.name}', '${vehicle.manufacturer}', '${vehicle.model}', '${vehicle.vehicle_class}', '${vehicle.passengers}', '${vehicle.crew}', '${vehicle.cargo_capacity}', ${vehicle.pilots.length > 0 ? vehicle.pilots[0].match(/\d+/) : 'NULL'});`;
  });
}

// Main function to fetch SWAPI data and generate SQL INSERT statements
async function generateSqlInsertStatements() {
  try {
    const peopleData = await fetchData('https://swapi.dev/api/people');
    const planetsData = await fetchData('https://swapi.dev/api/planets');
    const speciesData = await fetchData('https://swapi.dev/api/species');
    const vehiclesData = await fetchData('https://swapi.dev/api/vehicles');

    const peopleInsertStatements = generatePeopleSql(peopleData.results);
    const planetsInsertStatements = generatePlanetsSql(planetsData.results);
    const speciesInsertStatements = generateSpeciesSql(speciesData.results);
    const vehiclesInsertStatements = generateVehiclesSql(vehiclesData.results);

    // Output the SQL INSERT statements to stdout
    console.log('-- INSERT statements for people table --');
    peopleInsertStatements.forEach(statement => console.log(statement));

    console.log('\n-- INSERT statements for planets table --');
    planetsInsertStatements.forEach(statement => console.log(statement));

    console.log('\n-- INSERT statements for species table --');
    speciesInsertStatements.forEach(statement => console.log(statement));

    console.log('\n-- INSERT statements for vehicles table --');
    vehiclesInsertStatements.forEach(statement => console.log(statement));
  } catch (error) {
    console.error('Error generating SQL insert statements:', error);
  }
}

// Run the script
generateSqlInsertStatements();
