

function validatePhoneNumber(phone) {
    var phoneRegEx = /^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/;
    return phoneRegEx.test(phone);
 }

 document.getElementById("checkout").addEventListener("click", function(event) {
    event.preventDefault();
    if (document.getElementById("saveinfo").checked) {
        //use sql to update the user with id = ?
        $sql = "UPDATE users SET name=?, username=?, phone=?, country=?, address_line_1=?, address_line_2=?, city=?, postcode=? WHERE id=?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ssssssssi", $name, $email, $phone, $residence, $billingad, $shippingad, $city, $postcode, $user_id);
        if (mysqli_stmt_execute($stmt)) {
        header('location: /neatest/scripts/php/shop/checkedout.php');
        } else {
        echo "<script>alert('Sorry. But you have been un-able to checkout this time');</script>";
        }
    } else {
      // Do not save the info to the database
      
      console.log("Not saving the info to the database");
    }
});
