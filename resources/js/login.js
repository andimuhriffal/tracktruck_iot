// Function to handle login form submission
function login(email, password) {
    fetch('/api/login', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ email: email, password: password }),
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Login failed');
        }
        return response.json();
    })
    .then(data => {
        // Save token to localStorage
        localStorage.setItem('token', data.token);
        // Redirect to dashboard or handle dashboard data fetching
        window.location.href = '/dashboard';
    })
    .catch(error => {
        console.error('Login error:', error);
        // Handle login error (show error message, redirect to login page, etc.)
    });
}
