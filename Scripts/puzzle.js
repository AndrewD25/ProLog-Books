/*
Andrew Deal
Puzzle Page Script
DUE DATE 
*/

"use strict";

require('dotenv').config()
const mysql = require('mysql2')
const connection = mysql.createConnection(process.env.DATABASE_URL)
console.log('Connected to PlanetScale!')
connection.end()

// Set initial variables
let round = 1;
let scaleFactor = [1, 2, 3, 5, 10, 25]; // Should go from 1, 2, 3, 5, 10, 25
let sfi = 0; //index for scale factor array
let correct = false;

// Create object with answer from database
let correctAnswer = {
    series: "Action Comics",
    number: 1
}

// Run 8-bit Function for Image //
let img = new Image();
img.onload = function () {
    eightBit(document.getElementById('mycanvas'), img, scaleFactor[sfi]);
};
img.src = '../Images/Puzzles/aa.jpg'; // Set based on database information from the day


// Guess Function //
function guess() { 
    let guessContainer = document.getElementById('guessContainer');

    let seriesInput = document.getElementById('seriesInput');
    let numberInput = document.getElementById('numberInput');
    let guess = {
        series: seriesInput.value,
        number: numberInput.value
    };

    if (round <= 6 && !correct) {
        // Guess functionality
        if (guess.series == correctAnswer.series && guess.number == correctAnswer.number) {
            correct = true;
        }

        // Add p to guess list
        let guess_p = document.createElement("p");
        guess_p.classList.add("guess");
        guess_p.innerHTML = correct ? `<i class="fa-solid fa-check green"></i> ` : `<i class="fa-solid fa-x red"></i> `;
        guess_p.innerHTML = guess_p.innerHTML + `${guess.series} ${guess.number}`;
        guessContainer.appendChild(guess_p);

        // Clear the values of the guess inputs
        seriesInput.value = "";
        numberInput.value = "";

        // Increment Round
        round++;         
        sfi++;
        eightBit(document.getElementById('mycanvas'), img, scaleFactor[sfi]);   
    }

    if (correct) {
        eightBit(document.getElementById('mycanvas'), img, 100); //Make image fully visible
    } else if (round > 6) {
        eightBit(document.getElementById('mycanvas'), img, 100); //Make image fully visible
    }
}


// On Startup Functions to Run //
autocomplete(document.getElementById("seriesInput"));
