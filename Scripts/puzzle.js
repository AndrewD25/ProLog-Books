"use strict";

let round = 1; // Initialize round to 1
let currentIndex = 0;
const images = document.querySelectorAll('.gallery-image');
const navigationButtons = document.getElementById('navigation-buttons');

function updateGallery() {
    // Hide all images
    images.forEach(image => image.classList.remove('active'));

    // Show the current image
    images[currentIndex].classList.add('active');

    // Clear existing navigation buttons
    navigationButtons.innerHTML = '';

    // Create navigation buttons based on the 'round' value
    for (let i = 0; i < round; i++) {
        if (i < 6) {
            const button = document.createElement('div');
            button.classList.add('navigation-button');
            button.textContent = i + 1;
            button.addEventListener('click', () => showImage(i));
            navigationButtons.appendChild(button);
        }
    }

    // Update active state
    updateActiveButton();
}

function showImage(index) {
    if (index < 0) {
        currentIndex = images.length - 1;
    } else if (index >= images.length) {
        currentIndex = 0;
    } else {
        currentIndex = index;
    }

    // Update the gallery
    updateGallery();
}

function updateActiveButton() {
    const buttons = document.querySelectorAll('.navigation-button');
    buttons.forEach((button, index) => {
        button.classList.remove('active');
        if (index === currentIndex) {
            button.classList.add('active');
        }
    });
}

function guess() {
    let guessContainer = document.getElementById('guessContainer');

    let seriesInput = document.getElementById('seriesInput');
    let numberInput = document.getElementById('numberInput');
    let guess = {
        series: seriesInput.value,
        number: numberInput.value
    };
    
    if (round <= 6) {
        //Guess functionality

        //Add p to guess list
        let guess_p = document.createElement("p");
        guess_p.classList.add("guess");
        guess_p.textContent = `${guess.series} ${guess.number}`;
        guessContainer.appendChild(guess_p);

        //Increment Round and Update Gallery
        round++;
        updateGallery();
    }
}


//On Startup Functions
updateGallery();