const person1 = {
    name: 'Steve',
    age: 20,
    pets: [
        {name: 'Doggo', species: 'dog', toy: 'rubber bone'},
        {name: 'Catty', species: 'cat', attitude: 'witty'},
    ]
}

const person2 = {
    name: 'Myra',
    age: 20,
    pets: [
        {name: 'Marcell', species: 'cat', attitude: 'witty'},
        {name: 'Luna', species: 'cat', attitude: 'huggy'},
    ]
}

const person3 = {
    name: 'Flora',
    age: 18,
    pets: []
}

const person4 = {
    name: 'Thomas',
    age: 24,
    pets: [
        {name: 'Amy', species: 'dog', toy: 'playstation'},
    ]
}

let people =[ person1,person2,person3,person4]

// console.log(
//     people
//         .map(person => person.pets.find(pet => pet.species == "cat" && pet.attitude == "witty" ))
//         .filter(pet => pet !=undefined)
//         .map(pet => pet.name)
// )
// let b = 0
// let names = []

// people.forEach(person => {
//    person.pets.map(pet => {
//       if (pet.species == "cat" && pet.attitude == "witty" && pet.name != undefined) {
//          names.push(pet.name)
//       }
//    })
// })
// console.log(names)

let names = []

people.forEach(person => {
    person.pets.map(pet => {
        ((pet.species == "cat" && pet.attitude == "witty" && pet.name != undefined ) ? names.push(pet.name) : "")
    })
 })

 console.log(names)


