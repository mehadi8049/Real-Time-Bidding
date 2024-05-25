<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Example</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
  <div class="container mt-5">
    <div class="col-8 text-center">
        <?php
         session_start();
         if (isset($_SESSION["message"]) && $_SESSION["message"]): 
         ?>
            <div class="alert alert-success" role="alert">
                <?= $_SESSION["message"]; ?>
            </div>
        <?php endif;
         unset($_SESSION["message"]);
        ?>
    </div>

