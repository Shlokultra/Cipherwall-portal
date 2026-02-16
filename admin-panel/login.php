<?php
include 'db_connect.php';
?>


<!-- login.php -->
<form method="POST" action="login_process.php">
    <input type="text" name="username" placeholder="Enter Username" required />
    <input type="password" name="password" placeholder="Enter Password" required />
    <button type="submit" name="login">Login</button>
</form>

