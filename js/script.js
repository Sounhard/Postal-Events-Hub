// script.js

// Function to handle login selection
function login(role) {
    alert(`You have selected the ${role} login.`);
    // Redirecting based on the role selected (this can be handled directly by the links in the HTML, but this adds an alert)
    switch(role) {
        case 'Post Office':
            window.location.href = 'loginpostoffice.php';
            break;
        case 'Divisional Office':
            window.location.href = 'logindivisional.php';
            break;
        case 'Ministry':
            window.location.href = 'loginministry.php';
            break;
        default:
            console.log('Invalid role');
    }
}
