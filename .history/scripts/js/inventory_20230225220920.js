document.querySelector('#orders_table').addEventListener('click', function(event) {
    // check if the clicked element is the "edit order" button
    if (event.target.matches('#edit_product_button')) {
        // get the row element containing the clicked button
        var row = event.target.closest('tr');

        // populate the form with the row's data
        var orderId = row.cells[0].textContent;
        var username = row.cells[1].textContent;
        var productId = row.cells[2].textContent;
        var quantity = row.cells[3].textContent;
        var price = row.cells[4].textContent;
        var status = row.cells[5].textContent;

        document.querySelector('.product-modal input[name="order_id"]').value = orderId;
        document.querySelector('.product-modal input[name="username"]').value = username;
        document.querySelector('.product-modal input[name="product_id"]').value = productId;
        document.querySelector('.product-modal input[name="quantity"]').value = quantity;
        document.querySelector('.product-modal input[name="price"]').value = price;
        document.querySelector('.product-modal input[name="status"]').value = status;

        // display the form
        document.querySelector('.product-modal').style.display = 'flex';

        // get the form data
        var form = document.querySelector('.product-modal form');
        var formData = new FormData(form);

        // send the form data to the server using fetch
        fetch('/neatest/scripts/php/staff/buttons/editorder.php', {
            method: 'POST',
            body: formData
        });
    }
});