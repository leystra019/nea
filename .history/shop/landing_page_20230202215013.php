<!DOCTYPE html>
<html>
<head>
</head>
<body>

<h1>Company Name</h1>

<h2>Products</h2>
<!--This displays the image inside the folder called "images"-->
<img src="/Applications/XAMPP/xamppfiles/htdocs/neatest/images/tshirt.jpeg" style="width:128px;height:128px;">

<br>

<!--basket button-->
<form action="basket.php">
    <input type="submit" value="Add to basket" />
</form>
<br>

<!--logout button-->
<form action="login.php" method="post">
    <input type="submit" name="logout" value="Logout" />
</form>

</body>
</html>