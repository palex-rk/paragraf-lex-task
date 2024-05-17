<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Polise</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href=" https://cdn.jsdelivr.net/npm/sweetalert2@11.11.0/dist/sweetalert2.min.css " rel="stylesheet">
</head>
<body>

    <?php if (isset($_GET['msg-type'])): ?>
    <div class="mt-3 alert alert-<?php echo $_GET['msg-type']; ?>">
        <p class="text- <?php echo $_GET['msg-type'] ?> "> 
            <?php  echo $_GET['message']; ?>
        </p>
        <button type="button" class="close" data-dismiss="alert">X</button>
    </div>
        <?php  echo '<script> window.history.replaceState({}, document.title, "/index.php")</script>'; ?>

    <?php endif ?>
    <!-- <li class="nav-item">
        <a class="nav-link active" href="#">Active</a>
    </li> -->
    <nav class="navbar navbar-dark bg-dark text-light sticky-top p-1 mb-5" style="background-color: #e3f2fd;">
        <a class="navbar-brand" href="https://www.paragraf.rs">
            <img src="https://is2-ssl.mzstatic.com/image/thumb/Purple113/v4/d3/bf/5a/d3bf5aa9-b4a5-0733-991e-1f591a6af801/source/256x256bb.jpg" width="50" height="50" class="d-inline-block align-left" alt="">
            Paragraf Lex
        </a>
        <div class="d-flex">
            <a class="nav-link m-1 p-3 bg-dark link-opacity-75" href="index.php">Pocetna</a>
            <a class="nav-link m-1 p-3 bg-dark rounded-circle" href="add-insurance.php">Novo Osiguranje</a>
        </div>
    </nav>

