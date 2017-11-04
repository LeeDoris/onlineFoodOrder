<?php
session_start();
if (isset($_SESSION)) {
    if ($_SESSION['role'] == "Admin") {
        $_SESSION = array();
        session_unset();
        header('Location: admin/login.php');
    } else {
        $_SESSION = array();
        session_unset();
        header('Location: index.php');
    }
} else {
    echo "You should login first!";
}
?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title></title>
</head>
<body>
</body>
</html>
