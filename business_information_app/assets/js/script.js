// JavaScript code for the application

// Function to handle user login
document.getElementById('login-form')?.addEventListener('submit', function(event) {
    event.preventDefault();
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;

    // AJAX request to server-side login script
    fetch('controllers/auth.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: new URLSearchParams({
            email: email,
            password: password
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            window.location.href = 'views/home.php';
        } else {
            alert(data.message);
        }
    })
    .catch(error => console.error('Error:', error));
});

// Function to handle user signup
document.getElementById('signup-form')?.addEventListener('submit', function(event) {
    event.preventDefault();
    const name = document.getElementById('name').value;
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;
    const confirmPassword = document.getElementById('confirm-password').value;
    const city = document.getElementById('city').value;
    const address = document.getElementById('address').value;

    if (password !== confirmPassword) {
        alert('Passwords do not match');
        return;
    }

    // AJAX request to server-side signup script
    fetch('controllers/auth.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: new URLSearchParams({
            name: name,
            email: email,
            password: password,
            city: city,
            address: address
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            window.location.href = 'views/home.php';
        } else {
            alert(data.message);
        }
    })
    .catch(error => console.error('Error:', error));
});

// Function to handle profile update
document.getElementById('update-profile-form')?.addEventListener('submit', function(event) {
    event.preventDefault();
    const name = document.getElementById('name').value;
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;
    const confirmPassword = document.getElementById('confirm-password').value;
    const city = document.getElementById('city').value;
    const address = document.getElementById('address').value;

    if (password !== confirmPassword) {
        alert('Passwords do not match');
        return;
    }

    // AJAX request to server-side profile update script
    fetch('controllers/user.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: new URLSearchParams({
            action: 'update',
            name: name,
            email: email,
            password: password,
            city: city,
            address: address
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Profile updated successfully');
        } else {
            alert(data.message);
        }
    })
    .catch(error => console.error('Error:', error));
});

// Function to handle business search
document.getElementById('search-form')?.addEventListener('submit', function(event) {
    event.preventDefault();
    const searchQuery = document.getElementById('search-query').value;

    // AJAX request to server-side search script
    fetch('controllers/search.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: new URLSearchParams({
            query: searchQuery
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Update search results on the page
            document.getElementById('search-results').innerHTML = data.results;
        } else {
            alert(data.message);
        }
    })
    .catch(error => console.error('Error:', error));
});
