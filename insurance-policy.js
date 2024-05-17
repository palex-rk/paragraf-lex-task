document.getElementById('insurance-type').addEventListener('change', function() {
    var additionalFields = document.getElementById('additional-persons');
    if (this.value === 'group') {
        additionalFields.style.display = 'block';
    } else {
        additionalFields.style.display = 'none';
        document.getElementById('additional-persons-container').innerHTML = '';
    }
});

document.getElementById('add-person-btn').addEventListener('click', openMembersInputs);
document.getElementById('group-insurance-selection').addEventListener('click', openMembersInputs);

document.getElementById('travel-date-from').addEventListener('change', caculateDays);
document.getElementById('travel-date-to').addEventListener('change', caculateDays);

document.getElementById('submit-btn').addEventListener('click', submitForm);

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

function openMembersInputs() {
    
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
}

function submitForm(e) {
    e.preventDefault();

    let form = document.getElementById("insurance-form");
    const formData = new FormData(form);
    let jsonData = {};

    formData.forEach((value, key) => {
        if (jsonData[key]) {
            if (!Array.isArray(jsonData[key])) {
                jsonData[key] = [jsonData[key]];
            }
            jsonData[key].push(value);
        } else {
            jsonData[key] = value;
        }
    });

    fetch('register.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(jsonData)
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            console.log(data.message);
            Swal.fire({
                title: 'Success!',
                text: 'Data inserted successfully',
                icon: 'success',
                confirmButtonText: 'OK'
            });
        } else {
            renderErrors(data.errors);
            Swal.fire({
                title: 'Error!',
                text: 'Failed to insert data',
                icon: 'error',
                confirmButtonText: 'OK'
            });
            console.log(data.message);
        }
    })
    .catch(error => console.error('Error:', error));

}