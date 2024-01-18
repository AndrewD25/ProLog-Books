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
      const button = document.createElement('div');
      button.classList.add('navigation-button');
      button.textContent = i + 1;
      button.addEventListener('click', () => showImage(i));
      navigationButtons.appendChild(button);
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

  updateGallery();