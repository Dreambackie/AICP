document.getElementById('registrationForm').addEventListener('submit', function(event) {
    event.preventDefault();

    let isValid = true;
    const fields = ['fullName', 'dob', 'email', 'mobileNumber', 'gender', 'occupation', 'idType', 'idNumber', 'issueAuthority', 'issueDate', 'issueState', 'expiryDate'];

    fields.forEach(function(field) {
        const input = document.getElementById(field);
        const value = input.value.trim();
        if (value === '') {
            isValid = false;
            input.style.borderColor = 'red';
            input.nextElementSibling && input.nextElementSibling.remove();
            const error = document.createElement('span');
            error.style.color = 'red';
            error.textContent = 'This field is required';
            input.insertAdjacentElement('afterend', error);
        } else {
            input.style.borderColor = '#ccc';
            input.nextElementSibling && input.nextElementSibling.remove();
        }
    });

    if (isValid) {
        this.submit();
    } else {
        alert('Please fill out all fields.');
    }
});