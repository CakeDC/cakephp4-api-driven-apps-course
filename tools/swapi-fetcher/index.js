const axios = require('axios');

// Fetch data from SWAPI and process it
async function fetchData(url) {
    try {
        const response = await axios.get(url);
        return response.data;
    } catch (error) {
        console.error('Error fetching data:', error).message;
        // throw error;
    }
}

// Generate SQL INSERT statements for people table
function generatePeopleSql(people) {
    return people.map((person) => {
        const { name, birth_year, eye_color, hair_color, height, mass, homeworld, species } = person;
        const planetId = homeworld?.match(/\d+/);
        const speciesId = species.length > 0 ? species[0].match(/\d+/) : 'NULL';

        return `INSERT INTO people (name, birth_year, eye_color, hair_color, height, mass, planet_id, species_id) VALUES ('${name}', '${birth_year}', '${eye_color}', '${hair_color}', '${height}', '${mass}', ${planetId}, ${speciesId});`;
    });
}

// Generate SQL INSERT statements for planets table
function generatePlanetsSql(planets) {
    return planets.map((planet) => {
        const { name, climate, diameter, orbital_period, gravity, terrain, population } = planet;

        return `INSERT INTO planets (name, climate, diameter, orbital_period, gravity, terrain, population) VALUES ('${name}', '${climate}', '${diameter}', '${orbital_period}', '${gravity}', '${terrain}', '${population}');`;
    });
}

// Generate SQL INSERT statements for species table
function generateSpeciesSql(species) {
    return species.map((specie) => {
        const { name, classification, designation, average_height, average_lifespan, language, homeworld } = specie;
        const planetId = homeworld?.match(/\d+/);

        return `INSERT INTO species (name, classification, designation, average_height, average_lifespan, language, planet_id) VALUES ('${name}', '${classification}', '${designation}', '${average_height}', '${average_lifespan}', '${language}', ${planetId});`;
    });
}

// Generate SQL INSERT statements for vehicles table
function generateVehiclesSql(vehicles) {
    return vehicles.map((vehicle) => {
        const { name, manufacturer, model, vehicle_class, passengers, crew, cargo_capacity, pilots } = vehicle;
        const ownerId = pilots.length > 0 ? pilots[0].match(/\d+/) : 'NULL';

        return `INSERT INTO vehicles (name, manufacturer, model, vehicle_class, passengers, crew, cargo_capacity, owner_id) VALUES ('${name}', '${manufacturer}', '${model}', '${vehicle_class}', '${passengers}', '${crew}', '${cargo_capacity}', ${ownerId});`;
    });
}

// Main function to fetch SWAPI data and generate SQL INSERT statements
async function generateSqlInsertStatements() {
    try {
        let peopleData = [];
        const peopleCount = 10;
        for (let i = 0; i < peopleCount; i++) {
            data = await fetchData(`https://swapi.dev/api/people/${i}`)
                .then((data) => data && peopleData.push(data));
        }

        let planetsData = [];
        const planetCount = 10;
        for (let i = 0; i < planetCount; i++) {
            data = await fetchData(`https://swapi.dev/api/planets/${i}`)
                .then((data) => data && planetsData.push(data));
        }

        let speciesData = [];
        const speciesCount = 10;
        for (let i = 0; i < speciesCount; i++) {
            data = await fetchData(`https://swapi.dev/api/species/${i}`)
                .then((data) => data && speciesData.push(data));
        }

        let vehiclesData = [];
        const vehicleCount = 10;
        for (let i = 0; i < vehicleCount; i++) {
            await fetchData(`https://swapi.dev/api/vehicles/${i}`)
                .then((data) => data && vehiclesData.push(data));
        }

        const peopleInsertStatements = generatePeopleSql(peopleData);
        const planetsInsertStatements = generatePlanetsSql(planetsData);
        const speciesInsertStatements = generateSpeciesSql(speciesData);
        const vehiclesInsertStatements = generateVehiclesSql(vehiclesData);

        // Output the SQL INSERT statements to stdout
        console.log('-- INSERT statements for people table --');
        peopleInsertStatements.forEach((statement) => console.log(statement));

        console.log('\n-- INSERT statements for planets table --');
        planetsInsertStatements.forEach((statement) => console.log(statement));

        console.log('\n-- INSERT statements for species table --');
        speciesInsertStatements.forEach((statement) => console.log(statement));

        console.log('\n-- INSERT statements for vehicles table --');
        vehiclesInsertStatements.forEach((statement) => console.log(statement));
    } catch (error) {
        console.error('Error generating SQL insert statements:', error);
    }
}

// Run the script
generateSqlInsertStatements();
