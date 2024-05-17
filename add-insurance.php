<?php require_once "partials/header.php";?>

    
    <div id="response-message"></div>

    <div class="container">

        <h2 class="h2">Unos novog osiguranja</h2>

        <form action="/register.php" method="POST" class="form col-md-6" id="insurance-form">

            <div class="form">
                <div class="form-group">
                    <label for="first-name">Ime</label>    
                    <input name="first-name" class="form-control" required>

                    <p><span id="first-name-err" class="text-danger"></span></p>
                </div>

                <div class="form-group">
                    <label for="lastname">Prezime</label>    
                    <input name="lastname" class="form-control" required>

                    <p><span id="last-name-err" class="text-danger"></span></p>
                </div>

                <div class="form-group">
                    <label for="birthdate">Datum rodjenja</label>    
                    <input type="date" name="birthdate" class="form-control" min="1920-01-01" max="2004-01-01" required>

                    <p><span id="birthdate-err" class="text-danger"></span></p>
                </div>

                <div class="form-group">
                    <label for="passport-number">Broj pasosa</label>    
                    <input type="text" name="passport-number" class="form-control" required>

                    <p><span id="passport-number-err" class="text-danger"></span></p>
                </div>

                <div class="form-group">
                    <label for="phone-number">Broj telefona</label>    
                    <input type="tel" name="phone-number" class="form-control">

                    <p><span id="phone-number-err" class="text-danger"></span></p>
                </div>

                <div class="form-group">
                    <label for="email">Mejl adresa</label>    
                    <input type="email" name="email" class="form-control" required>

                    <p><span id="email-err" class="text-danger"></span></p>
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
                <p><span id="date-diff-err" class="text-danger"></span></p>

                <div class="form-group">
                    <label for="insurance-type">Tip osiguranja</label>    
                    <select id="insurance-type" name="insurance-type" class="form-control" required>
                        <option value="individual">Individualno Osiguranje</option>
                        <option value="group" id="group-insurance-selection">Grupno Osiguranje</option>
                    </select>

                    <p><span id="insurance-type-err" class="text-danger"></span></p>
                    
                    <div id="additional-persons" class="additional-persons mt-5">
                        <h3>Dodaj Osiguraonika</h3>
                        <div id="additional-persons-container"></div>
                        <button type="button" id="add-person-btn" class="btn btn-warning">Dodaj Osiguraonika</button>
                    </div>
                    
                <input type="submit" id="submit-btn" name="submit" class="btn btn-success mt-2" value="Sacuvaj osiguranje"/>
            </div>

        </form>
        
    </div>
    
<?php require_once "partials/footer.php";?>