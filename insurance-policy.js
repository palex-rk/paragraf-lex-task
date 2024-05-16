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
    firstnameLabel.textContent = 'Ime :';
    var firstnameInput = document.createElement('input');
    firstnameInput.type = 'text';
    firstnameInput.classList = 'form-control';
    firstnameInput.name = 'additional-first-name[]';
    firstnameInput.required = true;

    var lastnameLabel = document.createElement('label');
    lastnameLabel.textContent = 'Prezime:';
    var lastnameInput = document.createElement('input');
    lastnameInput.type = 'text';
    lastnameInput.classList = 'form-control';
    lastnameInput.name = 'additional-last-name[]';
    lastnameInput.required = true;

    var passportNumberLabel = document.createElement('label');
    passportNumberLabel.textContent = 'Broj pasosa:';
    var passportNumberInput = document.createElement('input');
    passportNumberInput.type = 'text';
    passportNumberInput.classList = "form-control";
    passportNumberInput.name = 'additional-passport-number[]';
    passportNumberInput.required = true;

    var removeButton = document.createElement('button');
    removeButton.type = 'button';
    removeButton.classList = "btn btn-danger";
    removeButton.textContent = 'Izbrisi';
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

document.getElementById('travel-date-from').addEventListener('change', caculateDays);
document.getElementById('travel-date-to').addEventListener('change', caculateDays);

function caculateDays() {
    let from = document.getElementById('travel-date-from').value;
    let to = document.getElementById('travel-date-to').value;
    console.log(from, to);

    if (from && to) {
        let fromDate = new Date(from);
        let toDate = new Date(to);
        let timeDifference = toDate - fromDate;
        let daysDifference = timeDifference / (1000 * 3600 * 24);

        if (daysDifference < 0) {
            alert('Travel Date TO cannot be earlier than Travel Date FROM');
            document.getElementById('travel-date-to').value = '';
            document.getElementById('number-of-days').textContent = '';
        }

        document.getElementById('number-of-days').textContent = 'Datum putovanja: ' + daysDifference + ' dana';
    } else {
        document.getElementById('number-of-days').textContent = '';
    }
}

function submitForm() {
    let formBtn = document.getElementById('submit-tbn');
}