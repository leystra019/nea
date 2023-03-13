document.querySelector('.close').addEventListener('click', function() {
    document.querySelector('.product-modal').style.display = 'none';
});


document.addEventListener('click', function(event) {
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
        document.querySelector('.product-modal').style.display = 'flex';

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