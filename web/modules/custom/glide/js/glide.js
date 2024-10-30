document.addEventListener('DOMContentLoaded', function() {
    // Initialize Glide.js carousel when the DOM is fully loaded
    const config = {
        type: 'slider',
        autoplay: 3000,
        hoverpause: true
    };
    new Glide('.glide', config).mount();
});
