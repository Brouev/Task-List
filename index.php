<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
</head>
<body>
<?php
if (isset($_SESSION['user_id'])){
    echo '<a href="tasklist.php"></a>';
    echo '<a href="logout.php"></a>';
}else{ 
    echo '<a href="connection.php"></a>';
    echo '<a href="inscription.php"></a>';

}
?>
</body>