document.getElementById('cbutton').addEventListener('click', function() {
    document.querySelector('.bg-modal').style.display = 'flex';
});

document.querySelector('.close').addEventListener('click', function() {
    document.querySelector('.bg-modal').style.display = 'none';
});

document.getElementById('change_order_status').addEventListener('click', function() {
    // get the order ID from the button's data attribute
    var order_id = this.target.dataset.orderId;

    // send an AJAX request to update the order status
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "/neatest/scripts/php/staff/manageorder.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
            // reload the page to show the updated order status
            location.reload();
        }
    };
    xhr.send("order_id=" + order_id);
});

