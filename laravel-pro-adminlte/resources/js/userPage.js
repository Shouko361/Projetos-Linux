setTimeout(function() {
    var successMessage = document.getElementById('success-message');
    var errorMessage = document.getElementById('error-message');

    if (successMessage) {
        successMessage.style.display = 'none';
    }

    if (errorMessage) {
        errorMessage.style.display = 'none';
    }
}, 5000);
