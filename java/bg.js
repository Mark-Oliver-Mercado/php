// Function to load the background image from local storage
function loadBackgroundImage() {
    const backgroundImage = localStorage.getItem('backgroundImage');
    if (backgroundImage) {
        document.body.style.backgroundImage = `url(${backgroundImage})`;
        document.body.style.backgroundSize = 'cover';  // Ensure the image covers the entire screen
        document.body.style.backgroundPosition = 'center center';  // Center the image
        document.body.style.backgroundRepeat = 'no-repeat';  // Prevent image repeating
        console.log('Background image loaded from local storage:', backgroundImage);
    } else {
        console.log('No background image found in local storage.');
    }
}

// Load the background image when the page loads
window.onload = loadBackgroundImage;
