
function enableItem(clickedButton) {
    // Select all elements with the class 'my-class'
    const elements = document.querySelectorAll('.form-control');

    // Add click event to each element
    elements.forEach(element => {
        element.addEventListener('click', () => {
            // Disable all elements
            elements.forEach(el => {
                el.disabled = true;
            });

            // Enable the clicked element
            clickedButton.disabled = false;
        });
    });
}