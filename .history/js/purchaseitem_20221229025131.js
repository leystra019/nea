
// Add click event listeners to product links
document.querySelectorAll('.product-link').forEach(link => {
link.addEventListener('click', function(event) {
    event.preventDefault();

    // Get the product ID from the link's id attribute
    const productId = this.getAttribute('id').split('-')[1];

    // Make an AJAX request to the PHP script
    const xhr = new XMLHttpRequest();
    xhr.open('GET', 'my-script.php?id=' + productId);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
    if (xhr.status === 200) {
        // Update the page with the product details
        updateProductDetails(xhr.responseText);
    } else {
        // Display an error message
        displayError();
    }
    };
    xhr.send('id=' + productId);
});
});

// Update the product details on the page
function updateProductDetails(product) {
// Parse the JSON object
const productData = JSON.parse(product);

// Update the page elements with the product data
document.querySelector('#product-name').innerHTML = productData.name;
document.querySelector('#product-description').innerHTML = productData.description;
document.querySelector('#product-price').innerHTML = productData.price;
}

// Display an error message
function displayError() {
document.querySelector('#error').style.display = 'block';
}

document.getElementsByClassName('.backbtn').addEventListener('click', function(event) {
    event.preventDefault();
  
    // Send the user back to the previous page
    window.history.back();
});