
document.getElementById("checkout").addEventListener("click", function(event) {
    event.preventDefault();

    // Get the user information from the form
    var name = document.getElementById("name").value;
    var email = document.getElementById("email").value;
    var phone = document.getElementById("phone").value;
    var residence = document.getElementById("residence").value;
    var billingad = document.getElementById("billingad").value;
    var shippingad = document.getElementById("shippingad").value;
    var city = document.getElementById("city").value;
    var postcode = document.getElementById("postcode").value;
    var user_id = document.getElementById("user_id").value;

    if (document.getElementById("saveinfo").checked) {
        // Update the user information in the database
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "update_info.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
                console.log("Information Update Successful");

                // Read the "bag" cookie
                var bag = getCookie('bag');

                // Send an AJAX request to the order processing PHP page
                $.ajax({
                    url: 'order-processing.php',
                    type: 'POST',
                    data: {
                        bag: bag,
                    },
                    success: function(response) {
                        console.log('Order processed:', response);
                        window.location.href = "/neatest/scripts/php/shop/checkedout.php";
                    }
                });
            } else {
                console.log("Information Update Failed");
            }
        };
        xhr.send("name=" + name + "&email=" + email + "&phone=" + phone + "&residence=" + residence + "&billingad=" + billingad + "&shippingad=" + shippingad + "&city=" + city + "&postcode=" + postcode + "&user_id=" + user_id);
    } else {
        console.log("Not saving the info to the database");
        window.location.href = "/neatest/scripts/php/shop/checkedout.php";
    }
});

function getCookie(name) {
    var value = "; " + document.cookie;
    var parts = value.split("; " + name + "=");
    if (parts.length == 2) return parts.pop().split(";").shift();
}


function validatePhoneNumber(phone) {
    var phoneRegEx = /^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/;
    return phoneRegEx.test(phone);
 }

