document.querySelector('.close').addEventListener('click', function() {
    document.querySelector('.product-modal').style.display = 'none';
});




document.querySelector('#inventory_table').addEventListener('click', function(event) {
    // check if the clicked element is the "edit order" button
    if (event.target.matches('#edit_product_button')) {
        // get the row element containing the clicked button
        var row = event.target.closest('tr');

        // populate the form with the row's data
        var productID = row.cells[0].textContent;
        var ProductTitle = row.cells[1].textContent;
        var Brand = row.cells[2].textContent;
        var Description = row.cells[3].textContent;
        var category = row.cells[4].textContent;
        var Subcategory = row.cells[5].textContent;
        var Price = row.cells[6].textContent;
        var Stock = row.cells[7].textContent;

        document.querySelector('.product-modal input[name="product_id"]').value = productID;
        document.querySelector('.product-modal input[name="title"]').value = ProductTitle;
        document.querySelector('.product-modal input[name="brand"]').value = Brand;
        document.querySelector('.product-modal input[name="description"]').value = Description;
        document.querySelector('.product-modal input[name="category"]').value = category;
        document.querySelector('.product-modal input[name="subcategory"]').value = Subcategory;
        document.querySelector('.product-modal input[name="price"]').value = Price;
        document.querySelector('.product-modal input[name="stock"]').value = Stock;

        // display the form
        document.querySelector('.product-modali').style.display = 'flex';

        // get the form data
        var form = document.querySelector('.product-modal form');
        var formData = new FormData(form);

        // send the form data to the server using fetch
        fetch('/neatest/scripts/php/staff/buttons/editinventory.php', {
            method: 'POST',
            body: formData
        });
    }
});

// This function is the function used to select products if they match what a staff is typing/searching for
function searchproductsFunction() {
    var input = document.getElementById("prodsrch");
  
    // We need to get the value entered by the staff member
    var filter = input.value.toUpperCase();
  
    // Get the table rows
    var rows = document.getElementsByTagName("tr");
  
    // And loop through the rows and hide those that don't match the filter
    // It loops until something is found
    for (var i = 0; i < rows.length; i++) {
        var product_title = rows[i].getElementsByTagName("td")[1];
        if (product_title) {
          var title_str = product_title.innerHTML.toUpperCase();
          if (title_str.includes(filter)) {
            rows[i].style.display = "";
            found = true;
          } else {
            rows[i].style.display = "none";
          }
        }
    }
    // Show a message if no matching rows are found
    var message = document.getElementById("no-order-matches-message");

    // If no matches are found we need to display a message
    if (!found) {
        message.style.display = "";
    } else {
        message.style.display = "none";ch
    }
    
    // Also if the search input is cleared, we need to hide the message
    if (filter.length === 0) {
        message.style.display = "none"; 
    }
}