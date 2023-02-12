
document.getElementById("checkout").addEventListener("click", function(event) {
    event.preventDefault();
    if (document.getElementById("saveinfo").checked) {
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "update_info.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
                console.log("Checkout and Information Update Successful");
                window.location.href = "/neatest/scripts/php/shop/checkedout.php";
            } else {
                console.log("Checkout and Information Update Failed");
            }
        };
        xhr.send("name=" + name + "&email=" + email + "&phone=" + phone + "&residence=" + residence + "&billingad=" + billingad + "&shippingad=" + shippingad + "&city=" + city + "&postcode=" + postcode + "&user_id=" + user_id);
    } else {
        console.log("Not saving the info to the database");
        window.location.href = "/neatest/scripts/php/shop/checkedout.php";
    }
});

function validatePhoneNumber(phone) {
    var phoneRegEx = /^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/;
    return phoneRegEx.test(phone);
 }

