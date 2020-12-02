<?php
session_id(null);
session_start();
session_destroy();
header("Location: ../index.php");

?>