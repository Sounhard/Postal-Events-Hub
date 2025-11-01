document.addEventListener("DOMContentLoaded", function() {
    // Initially hide all sections except the welcome message
    hideAllSections();
    document.getElementById('divisional-offices-section').style.display = 'block'; // Show Divisional Offices section by default

    // Add event listeners to menu items
    const divisionalOfficesMenu = document.querySelector('a[href="#divisional-offices"]');
    divisionalOfficesMenu.addEventListener('click', function(event) {
        event.preventDefault(); // Prevent default anchor behavior
        showSection('divisional-offices-section');
        fetchDivisionalOffices(); // Fetch Divisional Offices data when section is shown
    });

    const eventsMenu = document.querySelector('a[href="#celebrated-events"]');
    eventsMenu.addEventListener('click', function(event) {
        event.preventDefault(); // Prevent default anchor behavior
        showSection('events-section');
        fetchCelebratedEvents(); // Fetch celebrated events when section is shown
    });
});

// Function to show a specific section and hide others
function showSection(sectionId) {
    hideAllSections(); // Hide all sections
    document.getElementById(sectionId).style.display = 'block'; // Show the selected section
}

// Function to hide all sections
function hideAllSections() {
    const sections = document.querySelectorAll('.dashboard-content > section');
    sections.forEach(section => {
        section.style.display = 'none'; // Hide each section
    });
}

// Fetch Divisional Offices data
function fetchDivisionalOffices() {
    const divisionalOfficesList = document.getElementById('divisional-offices-list');
    divisionalOfficesList.innerHTML = ""; // Clear previous content

    fetch('fetch_divisional_offices.php') // Adjust this to your PHP endpoint
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                console.error(data.error);
                return;
            }

            data.forEach(division => {
                const divisionItem = document.createElement('li');
                divisionItem.innerHTML = `<strong>${division.divisionalname}</strong>`;
                divisionalOfficesList.appendChild(divisionItem);

                const postOfficesList = document.createElement('ul');
                divisionItem.appendChild(postOfficesList);

                // Fetch post offices for each division
                fetchPostOffices(division.divisionalname, postOfficesList);
            });
        })
        .catch(error => console.error('Error fetching divisional offices:', error));
}

// Fetch post offices for a specific division
function fetchPostOffices(divisionName, postOfficesList) {
    fetch(`fetch_post_offices.php?division=${encodeURIComponent(divisionName)}`) // Adjust this to your PHP endpoint
        .then(response => response.json())
        .then(data => {
            data.forEach(postOffice => {
                const postOfficeItem = document.createElement('li');
                postOfficeItem.textContent = postOffice.postname;
                postOfficesList.appendChild(postOfficeItem);
            });
        })
        .catch(error => console.error('Error fetching post offices:', error));
}

// Fetch celebrated events for Divisional Offices and Post Offices
function fetchCelebratedEvents() {
    const eventsContainer = document.getElementById('eventsContainer');
    eventsContainer.innerHTML = ""; // Clear previous content

    fetch('fetch_event_ministry.php') // Adjust this to your PHP endpoint
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                console.error(data.error);
                return;
            }

            data.forEach(event => {
                const eventItem = document.createElement('li');
                eventItem.innerHTML = `${event.source}: <strong>${event.eventname}</strong> - ${event.eventdate}`;
                eventsContainer.appendChild(eventItem);
            });
        })
        .catch(error => console.error('Error fetching celebrated events:', error));
}
