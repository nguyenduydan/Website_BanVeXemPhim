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
    const currentlyShowing = document.getElementById('currently-showing');
    const comingSoon = document.getElementById('coming-soon');
    const currentlyShowingTab = document.getElementById('currently-showing-tab');
    const comingSoonTab = document.getElementById('coming-soon-tab');

    if (tab === 'currently-showing') {
        currentlyShowing.classList.add('show', 'active');
        comingSoon.classList.remove('show', 'active');
        currentlyShowingTab.classList.add('active');
        comingSoonTab.classList.remove('active');
    } else {
        comingSoon.classList.add('show', 'active');
        currentlyShowing.classList.remove('show', 'active');
        comingSoonTab.classList.add('active');
        currentlyShowingTab.classList.remove('active');
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
