
document.addEventListener('DOMContentLoaded', function () {
    const container = document.getElementById('container');
    const registerBtn = document.getElementById('register');
    const loginBtn = document.getElementById('login');

    console.log('Container:', container);
    console.log('Register Button:', registerBtn);
    console.log('Login Button:', loginBtn);

    if (container && registerBtn && loginBtn) {
        registerBtn.addEventListener('click', () => {
            container.classList.add("active");
        });

        loginBtn.addEventListener('click', () => {
            container.classList.remove("active");
        });
    } else {
        console.error("One or more elements not found!");
    }
});

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

document.addEventListener('DOMContentLoaded', () => {
    let currentStartIndex = 0; // Track the current start index for displaying days
    const daysToShow = 5; // Number of days to show at a time
    const totalDays = 7; // Total number of days in a week
    const showtimes = {
        0: ['12:30', '14:00', '15:30'], // Showtimes for today
        1: ['13:00', '14:30', '16:00'], // Showtimes for day 1
        2: ['12:00', '13:30', '15:00'], // Showtimes for day 2
        3: ['14:00', '15:30', '17:00'], // Showtimes for day 3
        4: ['12:30', '13:00', '14:30'], // Showtimes for day 4
        5: ['13:30', '15:00', '16:30'], // Showtimes for day 5
        6: ['12:00', '13:00', '14:00']  // Showtimes for day 6
    };

    function generateDays() {
        const daysNav = document.getElementById('daysNav');
        const activeDayInput = document.getElementById('activeDay');
        const today = new Date();
        const weekdays = ['Thứ Hai', 'Thứ Ba', 'Thứ Tư', 'Thứ Năm', 'Thứ Sáu', 'Thứ Bảy', 'Chủ Nhật'];

        // Get the current day index and adjust for the weekdays array
        const currentDayIndex = today.getDay(); // 0 = Chủ Nhật
        const adjustedCurrentDayIndex = (currentDayIndex + 6) % 7; // Adjust to fit the weekdays array

        daysNav.innerHTML = ''; // Clear existing items

        // Generate days starting from today
        for (let i = 0; i < daysToShow; i++) {
            const index = (adjustedCurrentDayIndex + currentStartIndex + i) % totalDays; // Get the correct index for the weekday

            const li = document.createElement('li');
            li.classList.add('nav-item', 'day-item');
            const a = document.createElement('a');
            a.classList.add('nav-link', 'day-link');

            const dateToDisplay = new Date(today.getTime() + ((currentStartIndex + i) * 86400000)); // Calculate future date
            const dateString = `${dateToDisplay.toLocaleDateString('vi-VN', { year: 'numeric', month: '2-digit', day: '2-digit' })}`;
            a.innerHTML = `${weekdays[index]}<br>${dateToDisplay.toLocaleDateString('vi-VN', { day: '2-digit', month: '2-digit' })}`;

            // Set href attribute to prevent default link behavior
            a.href = "javascript:void(0);";

            // Add click event to show different showtimes based on the day
            a.onclick = () => {
                highlightActiveDay(a, index); // Highlight active day
                activeDayInput.value = dateString;
            };

            // Check if this day is today to mark it as active
            if (i === 0 && currentStartIndex === 0) {
                a.classList.add('active'); // Mark today as active
                a.innerHTML = `Hôm Nay<br>${today.toLocaleDateString('vi-VN', { day: '2-digit', month: '2-digit' })}`;
                activeDayInput.value = `${today.toLocaleDateString('vi-VN', { day: '2-digit', month: '2-digit' })}`;
            }

            li.appendChild(a);
            daysNav.appendChild(li);
        }

        addNavigationButtons();
        displayShowtimes(currentStartIndex); // Show the initial showtimes
    }

    function highlightActiveDay(activeElement, dayIndex) {
        // Remove active class from all day links
        const dayLinks = document.querySelectorAll('.day-link');
        dayLinks.forEach(link => link.classList.remove('active'));
        // Add active class to the clicked day link
        activeElement.classList.add('active');
        displayShowtimes(dayIndex);
    }

    function displayShowtimes(dayIndex) {
        const showtimeContainer = document.getElementById('showtimeContainer');
        showtimeContainer.innerHTML = ''; // Clear existing showtimes

        // Get the showtimes for the selected day
        const times = showtimes[dayIndex] || [];
        times.forEach(time => {
            const li = document.createElement('li');
            li.classList.add('time-link');
            li.textContent = time; // Add the showtime

            // Add click event to highlight the selected showtime
            li.onclick = () => {
                highlightActiveShowtime(li);
            };

            showtimeContainer.appendChild(li);
        });
    }

    function highlightActiveShowtime(activeElement) {
        // Remove active class from all showtime links
        const showtimeLinks = document.querySelectorAll('.time-link');
        showtimeLinks.forEach(link => link.classList.remove('active'));
        // Add active class to the clicked showtime link
        activeElement.classList.add('active');
    }

    function addNavigationButtons() {
        const daysNav = document.getElementById('daysNav');

        // Clear existing buttons
        const existingButtons = document.querySelectorAll('.nav-button');
        existingButtons.forEach(button => button.remove());

        if (currentStartIndex > 0) {
            const prevButton = document.createElement('button');
            prevButton.classList.add('nav-button', 'btn', 'me-2');
            prevButton.innerHTML = '<i class="bi bi-chevron-left"></i>'; // Bootstrap icon for Previous
            prevButton.onclick = () => {
                currentStartIndex -= daysToShow;
                generateDays();
            };
            daysNav.parentNode.insertBefore(prevButton, daysNav);
        }

        if (currentStartIndex + daysToShow < totalDays) {
            const nextButton = document.createElement('button');
            nextButton.classList.add('nav-button', 'btn');
            nextButton.innerHTML = '<i class="bi bi-chevron-right"></i>'; // Bootstrap icon for Next
            nextButton.onclick = () => {
                currentStartIndex += daysToShow;
                generateDays();
            };
            daysNav.parentNode.insertBefore(nextButton, daysNav.nextSibling);
        }
    }

    // Call the function to generate the days
    generateDays();
});
