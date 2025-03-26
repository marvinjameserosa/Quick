document.getElementById('loginForm').addEventListener('submit', function(e) {
    const username = document.getElementById('username');
    const password = document.getElementById('password');
    const errorMessage = document.getElementById('errorMessage');

    // Basic client-side validation
    if (username.value.trim() === '' || password.value.trim() === '') {
        e.preventDefault();
        errorMessage.style.display = 'block';
        errorMessage.textContent = 'Please enter both username and password';
        return;
    }

    // Optional: Add more complex validation
    if (password.value.length < 4) {
        e.preventDefault();
        errorMessage.textContent = 'Password must be at least 4 characters long';
        errorMessage.style.display = 'block';
        return;
    }

    // Hide error message if validation passes
    errorMessage.style.display = 'none';
});
