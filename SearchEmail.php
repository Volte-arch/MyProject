<?php
require_once('./DB/ini.php');
$stmt = $conn->prepare("SELECT * FROM `user_reg` WHERE 1");
