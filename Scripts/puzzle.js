/*
Andrew Deal
Puzzle Page Script
DUE DATE 
*/

"use strict";

let round = 1;
let scaleFactor = 10; // Set the initial scale factor to 10
let seconds = 20;
let timer;

// Run 8-bit Function for Image //
let img = new Image();
img.onload = function () {
    eightBit(document.getElementById('mycanvas'), img, scaleFactor);
};
img.src = '../Images/exampleCover.png';

// Start Timer Function //
function startTimer() {
    timer = setInterval(updateTimer, 100); // Update every decisecond
}

// Update Timer Function //
function updateTimer() {
    if (seconds > 0) {
        seconds -= 0.1; // Decrease by decisecond

        // Round to one decimal place
        seconds = Math.round(seconds * 10) / 10;

        // Update the 8-bit function with the new scale factor when an integer is reached
        if (Number.isInteger(seconds)) {
            // Adjust the scale factor increase over time
            scaleFactor += Math.pow(scaleFactor / 10, 1.2);

            // Ensure scaleFactor stays within the range 1-100
            scaleFactor = Math.min(Math.max(scaleFactor, 1), 100);

            // Update 8-bit function with the new scale factor
            eightBit(document.getElementById('mycanvas'), img, scaleFactor);
        }

        // Update the slider based on the current seconds
        updateSlider(seconds);
    } else {
        // Stop the timer when it reaches 0
        clearInterval(timer);
    }
}

function updateSlider(seconds) {
    let slider = document.getElementById('slider');
    let position = 100 - (seconds * 5); // Adjust the factor as needed
    slider.style.right = position + '%';
    slider.textContent = String(Math.ceil(seconds));
}
updateSlider(seconds);

// Guess Function //
function guess() {
    let guessContainer = document.getElementById('guessContainer');

    let seriesInput = document.getElementById('seriesInput');
    let numberInput = document.getElementById('numberInput');
    let guess = {
        series: seriesInput.value,
        number: numberInput.value
    };

    if (round <= 6) {
        // Guess functionality

        // Add p to guess list
        let guess_p = document.createElement("p");
        guess_p.classList.add("guess");
        guess_p.textContent = `${guess.series} ${guess.number}`;
        guessContainer.appendChild(guess_p);

        // Increment Round
        round++;
    }
}

// On Startup Functions to Run //
autocomplete(document.getElementById("seriesInput"));
