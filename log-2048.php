<?php
    require_once 'functions.php';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="refresh" content="5"/>
    <link href="style.css" rel="stylesheet">
    <title>log-2048</title>
</head>
<body>
    <div class="main-page">
        <h1>Les logs</h1>
        
        <?php  
        read_log(); 
        ?>

    </div>
</body>
</html>