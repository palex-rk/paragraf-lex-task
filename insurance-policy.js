document.getElementById('insurance-type').addEventListener('change', function() {
    var additionalFields = document.getElementById('additional-persons');
    if (this.value === 'group') {
        additionalFields.style.display = 'block';
    } else {
        additionalFields.style.display = 'none';
        document.getElementById('additional-persons-container').innerHTML = '';
    }
});

document.getElementById('add-person-btn').addEventListener('click', function() {
    
    var container = document.getElementById('additional-persons-container');

    var personDiv = document.createElement('div');
    personDiv.className = 'person';

    var firstnameLabel = document.createElement('label');
    firstnameLabel.textContent = 'First Name:';
    var firstnameInput = document.createElement('input');
    firstnameInput.type = 'text';
    firstnameInput.classList = 'form-control';
    firstnameInput.name = 'additionalFirstname[]';
    firstnameInput.required = true;

    var lastnameLabel = document.createElement('label');
    lastnameLabel.textContent = 'Last Name:';
    var lastnameInput = document.createElement('input');
    lastnameInput.type = 'text';
    lastnameInput.classList = 'form-control';
    lastnameInput.name = 'additionalLastname[]';
    lastnameInput.required = true;

    var passportNumberLabel = document.createElement('label');
    passportNumberLabel.textContent = 'Passport Number:';
    var passportNumberInput = document.createElement('input');
    passportNumberInput.type = 'text';
    passportNumberInput.classList = "form-control";
    passportNumberInput.name = 'additionalPassportNumber[]';
    passportNumberInput.required = true;

    var removeButton = document.createElement('button');
    removeButton.type = 'button';
    removeButton.classList = "btn btn-danger";
    removeButton.textContent = 'Remove';
    removeButton.addEventListener('click', function() {
        container.removeChild(personDiv);
    });

    personDiv.appendChild(firstnameLabel);
    personDiv.appendChild(firstnameInput);
    personDiv.appendChild(document.createElement('br'));

    personDiv.appendChild(lastnameLabel);
    personDiv.appendChild(lastnameInput);
    personDiv.appendChild(document.createElement('br'));

    personDiv.appendChild(passportNumberLabel);
    personDiv.appendChild(passportNumberInput);
    personDiv.appendChild(document.createElement('br'));

    personDiv.appendChild(removeButton);

    container.appendChild(personDiv);
    container.appendChild(document.createElement('br'));
});