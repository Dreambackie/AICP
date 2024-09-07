// Function to handle form submissions with AJAX
function handleFormSubmission(formId, url, successMessage, errorMessage) {
    const form = document.getElementById(formId);
    
    if (!form) return;

    form.addEventListener('submit', function(event) {
        event.preventDefault();

        const formData = new FormData(form);

        fetch(url, {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showMessage('success', successMessage);
                if (data.redirect) {
                    window.location.href = data.redirect;
                }
            } else {
                showMessage('error', errorMessage);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showMessage('error', errorMessage);
        });
    });
}

// Function to show messages
function showMessage(type, message) {
    const messageContainer = document.querySelector('.message');
    if (messageContainer) {
        messageContainer.textContent = message;
        messageContainer.className = `message ${type}`;
    }
}

// Initialize form handling
document.addEventListener('DOMContentLoaded', function() {
    // Example usage for login and signup forms
    handleFormSubmission('login-form', 'controllers/auth.php', 'Login successful! Redirecting...', 'Login failed. Please try again.');
    handleFormSubmission('signup-form', 'controllers/auth.php', 'Signup successful! Redirecting...', 'Signup failed. Please try again.');
});
