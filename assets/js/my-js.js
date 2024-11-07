function togglePasswordVisibility(passwordFieldId, iconId) {
    const passwordInput = document.getElementById(passwordFieldId);
    const icon = document.getElementById(iconId);

    // Chuyển đổi giữa mật khẩu và văn bản
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    } else {
        passwordInput.type = 'password';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    }
}

document.addEventListener('DOMContentLoaded', function () {
    const togglePassword = document.getElementById('togglePassword');
    const toggleRePassword = document.getElementById('toggleRePassword');
    const togglePasswordLogin = document.getElementById('togglePasswordLogin');

    if (togglePassword) {
        togglePassword.addEventListener('click', function () {
            togglePasswordVisibility('password', 'togglePassword');
        });
    }

    if (toggleRePassword) {
        toggleRePassword.addEventListener('click', function () {
            togglePasswordVisibility('re_password', 'toggleRePassword');
        });
    }
    if (togglePasswordLogin) {
        togglePasswordLogin.addEventListener('click', function () {
            togglePasswordVisibility('password_login', 'togglePasswordLogin');
        });
    }
});

function showTab(tab) {
    const tabs = {
        // For movies.php
        'currently-showing': {
            content: document.getElementById('currently-showing'),
            tab: document.getElementById('currently-showing-tab')
        },
        'coming-soon': {
            content: document.getElementById('coming-soon'),
            tab: document.getElementById('coming-soon-tab')
        },
        // For account.php
        'transition-history': {
            content: document.getElementById('transition-history'),
            tab: document.getElementById('transition-history-tab')
        },
        'personal-infomation': {
            content: document.getElementById('personal-infomation'),
            tab: document.getElementById('personal-information-tab')
        }
    };

    // Hide all tabs and remove active class
    Object.keys(tabs).forEach(key => {
        if (tabs[key].content) { // Check if content exists
            tabs[key].content.classList.remove('show', 'active');
            tabs[key].tab.classList.remove('active');
        }
    });

    // Show the selected tab and add active class, if it exists
    if (tabs[tab]) {
        tabs[tab].content.classList.add('show', 'active');
        tabs[tab].tab.classList.add('active');
    } else {
        console.error(`Tab "${tab}" does not exist.`);
    }
}


function showMoreMovies() {
    const hiddenMovies = document.querySelectorAll('.movie-item.hidden');
    hiddenMovies.forEach(movie => movie.classList.remove('hidden'));
    document.getElementById('showMoreBtn').style.display = 'none'; // Hide "Show More" button
}

document.addEventListener('DOMContentLoaded', function () {
    const daysNav = document.querySelector('#daysNav');
    if (!daysNav) {
        console.error("One or more elements not found!");
        return;
    }

    window.selectDate = function (date) {
        // Fetch new showtimes
        fetch(window.location.href, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: 'selected_date=' + date
        })
            .then(response => response.text())
            .then(data => {
                // Parse the returned HTML
                const parser = new DOMParser();
                const doc = parser.parseFromString(data, 'text/html');

                // Update daysNav
                const newDaysNav = doc.querySelector('#daysNav');
                if (newDaysNav) {
                    daysNav.innerHTML = newDaysNav.innerHTML;
                }

                // Update showtimeContainer
                const newShowtimeContainer = doc.querySelector('#showtimeContainer');
                const showtimeContainer = document.querySelector('#showtimeContainer');
                if (newShowtimeContainer && showtimeContainer) {
                    showtimeContainer.innerHTML = newShowtimeContainer.innerHTML;
                }

                // Update active class
                const activeButtons = daysNav.querySelectorAll('.nav-link');
                activeButtons.forEach(button => button.classList.remove('active'));
                const currentActiveButton = daysNav.querySelector(`.nav-link[onclick*="${date}"]`);
                if (currentActiveButton) {
                    currentActiveButton.classList.add('active');
                }
            })
            .catch(error => console.error('Error:', error));
    };
});
