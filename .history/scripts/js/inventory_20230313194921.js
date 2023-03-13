document.querySelector('.close').addEventListener('click', function() {
    document.querySelector('.product-modali').style.display = 'none';
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

        document.querySelector('.product-modali input[name="product_id"]').value = productID;
        document.querySelector('.product-modali input[name="title"]').value = ProductTitle;
        document.querySelector('.product-modali input[name="brand"]').value = Brand;
        document.querySelector('.product-modali input[name="description"]').value = Description;
        document.querySelector('.product-modali input[name="category"]').value = category;
        document.querySelector('.product-modali input[name="subcategory"]').value = Subcategory;
        document.querySelector('.product-modali input[name="price"]').value = Price;
        document.querySelector('.product-modali input[name="stock"]').value = Stock;

        // display the form
        document.querySelector('.product-modali').style.display = 'flex';

        // get the form data
        var form = document.querySelector('.product-modali form');
        var formData = new FormData(form);

        // We send the form data to the server using fetch
        fetch('/neatest/scripts/php/staff/buttons/editinventory.php', {
            method: 'POST',
            body: formData
        });
    }
});

document.querySelector('#inventory_table').addEventListener('click', function(event) {
    // check if the clicked element is the "delete" button
    if (event.target.matches('#delete_product_button')) {
        // ask for confirmation before deleting the product
        if (confirm("Are you sure you want to delete this product?")) {
            // get the row element containing the clicked button
            var row = event.target.closest('tr');
            

            // We need to get the product ID from the first column in the row
            var product_id = row.cells[0].textContent;

            // We have to send an AJAX request to delete the product
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "/neatest/scripts/php/staff/buttons/deleteproduct.php", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                    // reload the page to show the inventory table with the product removed
                    location.reload();
                }
            };

            xhr.send("&product_id=" + product_id);
        }
      



    }
}
);

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