const numbers = [5, 2, 15, -3, 6, -8, -2];

//1
let b = numbers.map(x => x ** 2)

console.log("Square " + b)

let g = numbers[0]
//1
//2
for (let i = 0; i < numbers.length; i++) {

  if (g > numbers[i]){
    g = numbers[i]
  }
}
console.log("Smallest " + g)
// 2

const matrix = [
  [1, 0, 3],
  [0, 2, 0],
  [4, 5, 6],
  [0, 0, 0],
]
//3
let j = matrix.findIndex(x => x.every(x => x == 0));
console.log("Index: " + j)
//3
const searchResults = {
  "Search": [
    {
      "Title": "The Hobbit: An Unexpected Journey",
      "Year": "2012",
      "imdbID": "tt0903624",
      "Type": "movie"
    },
    {
      "Title": "The Hobbit: The Desolation of Smaug",
      "Year": "2013",
      "imdbID": "tt1170358",
      "Type": "movie"
    },
    {
      "Title": "The Hobbit: The Battle of the Five Armies",
      "Year": "2014",
      "imdbID": "tt2310332",
      "Type": "movie"
    },
    {
      "Title": "The Hobbit",
      "Year": "1977",
      "imdbID": "tt0077687",
      "Type": "movie"
    },
    {
      "Title": "Lego the Hobbit: The Video Game",
      "Year": "2014",
      "imdbID": "tt3584562",
      "Type": "game"
    },
    {
      "Title": "The Hobbit",
      "Year": "1966",
      "imdbID": "tt1686804",
      "Type": "movie"
    },
    {
      "Title": "The Hobbit",
      "Year": "2003",
      "imdbID": "tt0395578",
      "Type": "game"
    },
    {
      "Title": "A Day in the Life of a Hobbit",
      "Year": "2002",
      "imdbID": "tt0473467",
      "Type": "movie"
    },
    {
      "Title": "The Hobbit: An Unexpected Journey - The Company of Thorin",
      "Year": "2013",
      "imdbID": "tt3345514",
      "Type": "movie"
    },
    {
      "Title": "The Hobbit: The Swedolation of Smaug",
      "Year": "2014",
      "imdbID": "tt4171362",
      "Type": "movie"
    }
  ],
  "totalResults": "51",
  "Response": "True"
}

//d


searchResults.Search.map(film =>  parseInt(film.Year) > 2010 && film.Type == "movie" ? console.log(film.imdbID) :"")



//d




let fm = document.querySelector("form")
let form = document.querySelector('button')
let text = document.querySelector('#hslString')


console.log(fm[0].value)
console.log(fm[1].value)
console.log(fm[2].value)


function changeColor() {
  text.value = 'rgb(' + fm[0].value + ',' + fm[1].value + ',' + fm[2].value + ')'
  document.body.style.backgroundColor = 'rgb(' + fm[0].value + ',' + fm[1].value + ',' + fm[2].value + ')'

}


document.getElementById('hue').addEventListener('input', changeColor)
document.getElementById('saturation').addEventListener('input', changeColor)
document.getElementById('lightness').addEventListener('input', changeColor)






