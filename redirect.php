<?php
require 'includes/init.php';
if(isset($_SESSION['user_id'])){
    header("Location: userprofile.php");
    exit;
}
elseif (isset($_SESSION['guide_id'])) {
        header("Location: guideprofile.php");
        exit;
}
elseif (isset($_SESSION['vendor_id'])) {
    header("Location: vendorprofile.php");
    exit;
}
else{
    header("location: index.html");
    exit;
}
?>