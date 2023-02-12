

function validatePhoneNumber(phone) {
    var phoneRegEx = /^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/;
    return phoneRegEx.test(phone);
 }

 document.getElementById("checkout").addEventListener("click", function(event) {
    event.preventDefault();
    if (document.getElementById("saveinfo").checked) {
        // Get the current time
        $current_time = time();
        // Create a cookie that records the time the user clicks the button
        $current_time = date("H:i:s", $current_time);
        setcookie("button_press_time", $current_time, time() + (30 * 24 * 60 * 60));
        $current_date = date("l jS");
        setcookie("last_visit_date", $current_date, time() + (30 * 24 * 60 * 60));
        //use sql to update the user with id = ?
        $sql = "UPDATE users SET name=?, username=?, phone=?, country=?, address_line_1=?, address_line_2=?, city=?, postcode=? WHERE id=?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ssssssssi", $name, $email, $phone, $residence, $billingad, $shippingad, $city, $postcode, $user_id);
        if (mysqli_stmt_execute($stmt)) {
        header('location: /neatest/scripts/php/shop/checkedout.php');
        } else {
            alert('Sorry. But you have been un-able to checkout this time');
        }
    } else {
      // Do not save the info to the database
      
      console.log("Not saving the info to the database");
    }
});
