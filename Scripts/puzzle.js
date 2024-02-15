/*
Andrew Deal
Puzzle Page Script
DUE DATE 
*/

/*
To Do:

Make Puzzles Loop After a Year (actually in php code)
Hide correct answer data better
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
 img.onload = function () {
     eightBit(document.getElementById('mycanvas'), img, scaleFactor[sfi]);
};
img.src = `../Images/altImg.jpg`; // Set a default alt image

let correctAnswer = {
    series: "Error",
    number: 0
}

// Function to encode a string using rot13
function rot13Encode(str) {
    let result = '';
    for (let i = 0; i < str.length; i++) {
      let c = str.charCodeAt(i);
      if (c >= 65 && c <= 90) {  // Upper case letters
        result += String.fromCharCode((c - 65 + 13) % 26 + 65);
      } else if (c >= 97 && c <= 122) {  // Lower case letters
        result += String.fromCharCode((c - 97 + 13) % 26 + 97);
      } else {  // Symbols and spaces
        result += str.charAt(i);
      };
    };
    result = "#" + result //If old import data is used, it will not have #, so does not need to be decoded
    return result;
};
  
// Function to decode a string using rot13
function rot13Decode(str) {
      if (str.slice(0, 1) === "#") {
          str = str.slice(1);
          let result = '';
          for (let i = 0; i < str.length; i++) {
              let c = str.charCodeAt(i);
              if (c >= 65 && c <= 90) {  // Upper case letters
                  result += String.fromCharCode((c - 65 + 13) % 26 + 65);
              } else if (c >= 97 && c <= 122) {  // Lower case letters
                  result += String.fromCharCode((c - 97 + 13) % 26 + 97);
              } else {  // Symbols and spaces
          result += str.charAt(i);
          };
      };
      return result;
    };
    return str; //If there is not # at beginning, it does not have to be decoded
};

//Function to actually set data correctly
function setAnswer(cover, series, number) {
    imgName = cover;
    correctAnswer.series = rot13Encode(series);
    correctAnswer.number = number;

    img.src = `../Images/Puzzles/${imgName}.jpg`; // Set based on database information from the day
    eightBit(document.getElementById('mycanvas'), img, scaleFactor[sfi]);

    //Delete the delete me script
    document.getElementById("deleteMe").remove();
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
        if (guess.series == rot13Decode(correctAnswer.series) && guess.number == correctAnswer.number) {
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
        roundText.innerHTML = `The correct answer was... ${rot13Decode(correctAnswer.series)} #${correctAnswer.number}`
    }
}


// On Startup Functions to Run //
guessBtn.onclick = guess;
autocomplete(document.getElementById("seriesInput"));
