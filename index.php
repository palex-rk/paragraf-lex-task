<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Polise</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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


    <div class="container">

    <h2 class="h2">Unos novog osiguranja</h2>

        <form action="/register.php" method="POST">

            <div class="form">
                <div class="form-group">
                    <label for="first-name">Ime</label>    
                    <input name="first-name" class="form-control" required>

                    <?php $error['first-name'] ?? '' ?>
                </div>

                <div class="form-group">
                    <label for="lastname">Prezime</label>    
                    <input name="lastname" class="form-control" required>

                    <?php $error['last-name'] ?? '' ?>
                </div>

                <div class="form-group">
                    <label for="birthdate">Datum rodjenja</label>    
                    <input type="date" name="birthdate" class="form-control" min="1920-01-01" max="2004-01-01" required>

                    <?php $error['birthdate'] ?? '' ?>
                </div>

                <div class="form-group">
                    <label for="passport-number">Broj pasosa</label>    
                    <input type="text" name="passport-number" class="form-control" required>

                    <?php $error['passport-number'] ?? '' ?>
                </div>

                <div class="form-group">
                    <label for="phone-number">Broj telefona</label>    
                    <input type="tel" name="phone-number" class="form-control">

                    <?php $error['phone-number'] ?? '' ?>
                </div>

                <div class="form-group">
                    <label for="email">Mejl adresa</label>    
                    <input type="email" name="email" class="form-control" required>

                    <?php $error['email'] ?? '' ?>
                </div>

                <div class="form-group">
                    <label for="od">Datum Putovanja (OD)</label>
                    <input type="date" id="travel-date-from" name="travel-date-from" required>
                </div>

                <div class="form-group">
                    <label for="od">Datum Putovanja (DO)</label>
                    <input type="date" id="travel-date-to" name="travel-date-to" required>
                </div>

                <p id="number-of-days" class="text-"></p>

                <div class="form-group">
                    <label for="insurance-type">Tip osiguranja</label>    
                    <select id="insurance-type" name="insurance-type" class="form-control" required>
                        <option value="individual">Individualno Osiguranje</option>
                        <option value="group">Grupno Osiguranje</option>
                    </select>

                    <?php $error['insurance-type'] ?? '' ?>
                    
                    <div id="additional-persons" class="additional-persons mt-5">
                        <h3>Dodaj Osiguraonika</h3>
                        <div id="additional-persons-container"></div>
                        <button type="button" id="add-person-btn" class="btn btn-warning">Add New Person</button>
                    </div>
                    
                <button type="submit" class="btn btn-success mt-2" name="save">Snimi polisu</button>
            </div>

        </form>
        
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="insurance-policy.js"></script>
</body>
</html>