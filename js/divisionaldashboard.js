// divisionaldashboard.js
// Function to show selected sections in the dashboard
function showSection(sectionId) {
    const sections = document.querySelectorAll('.dashboard-content section');
    sections.forEach(section => {
        if (section.id === sectionId) {
            section.classList.remove('hidden');
        } else {
            section.classList.add('hidden');
        }
    });
}
