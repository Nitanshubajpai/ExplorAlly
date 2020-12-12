<?php
session_start();
session_regenerate_id(true);

require 'classes/database.php';
require 'classes/user.php';
require 'classes/friend.php';
require 'classes/guide.php';
require 'classes/vendor.php';

// DATABASE CONNECTIONS
$db_obj = new Database();
$db_connection = $db_obj->dbConnection();

// USER OBJECT
$user_obj = new User($db_connection);
// FRIEND OBJECT
$frnd_obj = new Friend($db_connection);
// GUIDE OBJECT
$guide_obj = new guide($db_connection);
// VENDOR OBJECT
$vendor_obj = new vendor($db_connection);
?>