

document.querySelector('.close').addEventListener('click', function() {
    document.querySelector('.bg-modal').style.display = 'none';
});

// add click event listener to the table
document.querySelector('#orders_table').addEventListener('click', function(event) {
    // check if the clicked element is the "Change status" button
    if (event.target.matches('#edit_order_button')) {
        // get the row element containing the clicked button
        var row = event.target.closest('tr');
        document.querySelector('.product-modal').style.display = 'flex';
        
        // send an AJAX request to update the order status
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "/neatest/scripts/php/staff/buttons/editorder.php", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.send("row=" + row);


    }
});

// add click event listener to the table
document.querySelector('#orders_table').addEventListener('click', function(event) {
    // check if the clicked element is the "Change status" button
    if (event.target.matches('#change_order_status')) {
        // get the row element containing the clicked button
        var row = event.target.closest('tr');
        
        // get the order ID from the first column in the row
        var order_id = row.cells[0].textContent;
        // send an AJAX request to update the order status
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "/neatest/scripts/php/staff/buttons/updateorder.php", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                // reload the page to show the updated order status
                location.reload();
            }
        };
        xhr.send("order_id=" + order_id);


    }
}
);

// add click event listener to the table
document.querySelector('#orders_table').addEventListener('click', function(event) {
    // check if the clicked element is the "Change status" button
    if (event.target.matches('#delete_order_button')) {
        // get the row element containing the clicked button
        var row = event.target.closest('tr');
        
        // we need to get the order ID from the first column in the row
        var order_id = row.cells[0].textContent;

        // we also need to get the product ID from the third column in the row
        var product_id = row.cells[1].textContent;

        // send an AJAX request to update the order status
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "/neatest/scripts/php/staff/buttons/deleteorder.php", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                // reload the page to show the updated order status
                location.reload();
            }
        };

        xhr.send("order_id=" + order_id + "&product_id=" + product_id);
      



    }
}
);

