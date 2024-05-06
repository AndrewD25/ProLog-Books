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


//Modal Window Functions
const overlay = document.getElementById("overlay");

function showModal(id) {
    hideModal();
    const modal = document.getElementById(id);
    modal.classList.remove('hidden');
    overlay.classList.remove("hidden");
}

function hideModal() {
    let modals = document.getElementsByClassName("modal");
    for (let i = 0; i < modals.length; i++) {
        modals[i].classList.add("hidden");
    }
    overlay.classList.add("hidden");
}

overlay.onclick = hideModal;


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
        //Delete the delete me script
    document.getElementById("deleteMe").remove();

    imgName = cover;
    correctAnswer.series = rot13Encode(series);
    correctAnswer.number = parseInt(number);

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
        number: parseInt(numberInput.value)
    };

    if (round <= 6 && !correct) {
        // Guess functionality
        if (guess.series === rot13Decode(correctAnswer.series) && guess.number === correctAnswer.number) {
            correct = true;
        }

        // Add the guess to guess list
        let flex = document.createElement("div");
        flex.classList.add("flex");
        let guessSeries = document.createElement("p");
        guessSeries.classList.add("series");
        if (guess.series === rot13Decode(correctAnswer.series)) {
            guessSeries.innerHTML = `<i class="fa-solid fa-check" style='color: green'></i> ` + guess.series;
        } else {
            guessSeries.innerHTML = `<i class="fa-solid fa-x" style='color: red'></i> ` + guess.series;
        }
        flex.appendChild(guessSeries);


        let guessNumber = document.createElement("p");
        guessNumber.classList.add("number");
        
        //Variable to set arrow color
        let color;

        //Set guess arrow icon
        if (guess.number === correctAnswer.number) {
            color = "green";
            guessNumber.innerHTML = `<i class="fa-solid fa-check" style="color: ${color}"></i> ` + guess.number;
        } else if (guess.number === "" || isNaN(guess.number)) {
            color = "red";
            guessNumber.innerHTML = `<i class="fa-solid fa-x" style="color: ${color}"></i>`;
        } else {
            //Set distance "heat"
            color = "white";
            let diff = Math.abs(correctAnswer.number - guess.number);
            switch (true) {
                case (diff === 1):
                    color = "#6EEBA8";
                    break;
                case (diff > 1 && diff <= 10):
                    color = "#26F6C9";
                    break;
                case (diff > 10 && diff <= 50):
                    color = "#69DFEF";
                    break;
                case (diff > 50 && diff <= 100):
                    color = "#FFFFFF";
                    break;
                case (diff > 100 && diff <= 500):
                    color = "#ECF683";
                    break;
                case (diff > 500 && diff <= 1000):
                    color = "#F9BC4B";
                    break;
                case (diff > 1000):
                    color = "#E66A17";
                    break;
                default:
                    color = "white";
                    break;
            }

            //Set arrow icon
            if (guess.number < correctAnswer.number) {
                guessNumber.innerHTML = `<i class="fa-solid fa-arrow-up" style="color: ${color}"></i> ` + guess.number;
            } else if (guess.number > correctAnswer.number) {
                guessNumber.innerHTML = `<i class="fa-solid fa-arrow-down" style="color: ${color}"></i> ` + guess.number;
            }
        }
        flex.appendChild(guessNumber);
        //Finish guess number code
        
        guessContainer.appendChild(flex);

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