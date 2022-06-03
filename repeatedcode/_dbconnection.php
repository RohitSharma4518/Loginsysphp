<?php
$connection = new mysqli("localhost","root","","users_loginsys");
if ($connection -> connect_errno) {
    echo "Failed to connect to MySQL: " . $connection -> connect_error;
    exit();
}
else{
}

?>