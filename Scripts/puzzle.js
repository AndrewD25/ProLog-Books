/*
Andrew Deal
Puzzle Page Script
DUE DATE 
*/

"use strict";

// Set initial variables
let roundText = document.getElementById("roundText");
let roundNum = document.getElementById("roundNum");
const guessBtn = document.getElementById("guessButton");
let round = 1;
let scaleFactor = [1, 2, 3, 5, 10, 25]; // Should go from 1, 2, 3, 5, 10, 25
let sfi = 0; //index for scale factor array
let correct = false;

//Set up confetti
const jsConfetti = new JSConfetti()

//Generate a cover based on the current date (used until database is set up)
let imgName;
let img = new Image();
// img.onload = function () {
//     eightBit(document.getElementById('mycanvas'), img, scaleFactor[sfi]);
// };
img.src = `../Images/altImg.jpg`; // Set a default alt image

// Create object with answer from database
let correctAnswer = {
    series: "Action Comics",
    number: 1
}

//echo "<script>setAnswer(" . $result["image_id"] . ", " . $result["answer_series"] . ", " . $result["answer_number"] . ")</script>";

//Function to actually set data correctly
function setAnswer(cover, series, number) {
    imgName = cover;
    correctAnswer.series = series;
    correctAnswer.number = number;

    img.src = `../Images/Puzzles/${imgName}.jpg`; // Set based on database information from the day
    eightBit(document.getElementById('mycanvas'), img, scaleFactor[sfi]);
}

// Run 8-bit Function for Image //
// let img = new Image();
// img.onload = function () {
//     eightBit(document.getElementById('mycanvas'), img, scaleFactor[sfi]);
// };
// console.log(imgName);
// img.src = `../Images/Puzzles/${imgName}.jpg`; // Set based on database information from the day


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
        guess_p.innerHTML = guess_p.innerHTML + `${guess.series} #${guess.number}`;
        guessContainer.appendChild(guess_p);

        // Clear the values of the guess inputs
        seriesInput.value = "";
        numberInput.value = "";

        // Increment Round
        round++;         
        sfi++;
        if (round <= 6) {roundNum.innerHTML = round;}
        eightBit(document.getElementById('mycanvas'), img, scaleFactor[sfi]);   
    }

    if (correct || round > 6) {
        eightBit(document.getElementById('mycanvas'), img, 100); //Make image fully visible 
        guessBtn.onclick = null;
        guessBtn.style.backgroundColor = "#555";
    }

    if (correct) { //Win
        jsConfetti.addConfetti()
        roundText.innerHTML = "You got it!"
    } else if (round > 6) { //Lose
        eightBit(document.getElementById('mycanvas'), img, 100); //Make image fully visible
        roundText.innerHTML = `The correct answer was... ${correctAnswer.series} #${correctAnswer.number}`
    }
}


// On Startup Functions to Run //
guessBtn.onclick = guess;
autocomplete(document.getElementById("seriesInput"));
