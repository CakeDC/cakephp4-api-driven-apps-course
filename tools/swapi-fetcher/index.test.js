const {
    generatePeopleInsertStatements,
    generatePlanetsInsertStatements,
    generateSpeciesInsertStatements,
    generateVehiclesInsertStatements,
} = require('./index');

describe('generatePeopleInsertStatements', () => {
    it('should generate SQL INSERT statements for people table', () => {
        const people = [
            {
                id: 1,
                name: 'Luke Skywalker',
                birth_year: '19BBY',
                eye_color: 'Blue',
                hair_color: 'Blond',
                height: '172',
                mass: '77',
                homeworld: 'https://swapi.dev/api/planets/1/',
                species: ['https://swapi.dev/api/species/1/'],
            },
            // Add more sample data here
        ];

        const expectedStatements = [
            "INSERT INTO people (id, name, birth_year, eye_color, hair_color, height, mass, planet_id, species_id) VALUES (1, 'Luke Skywalker', '19BBY', 'Blue', 'Blond', '172', '77', 1, 1);",
            // Add more expected statements here
        ];

        const statements = generatePeopleInsertStatements(people);

        expect(statements).toEqual(expectedStatements);
    });
});

describe('generatePlanetsInsertStatements', () => {
    it('should generate SQL INSERT statements for planets table', () => {
        const planets = [
            {
                id: 1,
                name: 'Tatooine',
                climate: 'Arid',
                diameter: '10465',
                orbital_period: '304',
                gravity: '1 standard',
                terrain: 'Desert',
                population: '200000',
            },
            // Add more sample data here
        ];

        const expectedStatements = [
            "INSERT INTO planets (id, name, climate, diameter, orbital_period, gravity, terrain, population) VALUES (1, 'Tatooine', 'Arid', '10465', '304', '1 standard', 'Desert', '200000');",
            // Add more expected statements here
        ];

        const statements = generatePlanetsInsertStatements(planets);

        expect(statements).toEqual(expectedStatements);
    });
});

describe('generateSpeciesInsertStatements', () => {
    it('should generate SQL INSERT statements for species table', () => {
        const species = [
            {
                id: 1,
                name: 'Human',
                classification: 'Mammal',
                designation: 'Sentient',
                average_height: '180',
                average_lifespan: '120',
                language: 'Galactic Basic',
                homeworld: 'https://swapi.dev/api/planets/9/',
            },
            // Add more sample data here
        ];

        const expectedStatements = [
            "INSERT INTO species (id, name, classification, designation, average_height, average_lifespan, language, planet_id) VALUES (1, 'Human', 'Mammal', 'Sentient', '180', '120', 'Galactic Basic', 9);",
            // Add more expected statements here
        ];

        const statements = generateSpeciesInsertStatements(species);

        expect(statements).toEqual(expectedStatements);
    });
});

describe('generateVehiclesInsertStatements', () => {
    it('should generate SQL INSERT statements for vehicles table', () => {
        const vehicles = [
            {
                id: 1,
                name: 'X-wing',
                manufacturer: 'Incom Corporation',
                model: 'T-65 X-wing',
                vehicle_class: 'Starfighter',
                passengers: '1',
                crew: '1',
                cargo_capacity: '110',
                pilots: ['https://swapi.dev/api/people/1/'],
            },
            // Add more sample data here
        ];

        const expectedStatements = [
            "INSERT INTO vehicles (id, name, manufacturer, model, vehicle_class, passengers, crew, cargo_capacity, owner_id) VALUES (1, 'X-wing', 'Incom Corporation', 'T-65 X-wing', 'Starfighter', '1', '1', '110', 1);",
            // Add more expected statements here
        ];

        const statements = generateVehiclesInsertStatements(vehicles);

        expect(statements).toEqual(expectedStatements);
    });
});
