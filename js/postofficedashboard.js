// postofficedashboard.js
function showSection(sectionId) {
    // Hide all sections
    const sections = document.querySelectorAll('.dashboard-content section');
    sections.forEach(section => section.classList.add('hidden'));

    // Show the selected section
    document.getElementById(sectionId).classList.remove('hidden');
}

// Show a specific section when the page loads
document.addEventListener('DOMContentLoaded', function() {
    showSection('submission-form-section'); // Change this to the desired default section
});
