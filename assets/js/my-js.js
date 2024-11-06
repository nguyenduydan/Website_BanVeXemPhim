
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

// document.addEventListener('DOMContentLoaded', () => {
//     let currentStartIndex = 0; // Theo dõi chỉ số bắt đầu hiện tại để hiển thị ngày
//     const daysToShow = 5; // Số ngày hiển thị một lần
//     const totalDays = 7; // Tổng số ngày trong tuần
//     const showtimes = {
//         0: ['12:30', '14:00', '15:30'], // Giờ chiếu cho hôm nay
//         1: ['13:00', '14:30', '16:00'], // Giờ chiếu cho ngày 1
//         2: ['12:00', '13:30', '15:00'], // Giờ chiếu cho ngày 2
//         3: ['14:00', '15:30', '17:00'], // Giờ chiếu cho ngày 3
//         4: ['12:30', '13:00', '14:30'], // Giờ chiếu cho ngày 4
//         5: ['13:30', '15:00', '16:30'], // Giờ chiếu cho ngày 5
//         6: ['12:00', '13:00', '14:00']  // Giờ chiếu cho ngày 6
//     };

//     function generateDays() {
//         const daysNav = document.getElementById('daysNav');
//         const activeDayInput = document.getElementById('activeDay');
//         const today = new Date();
//         const weekdays = ['Thứ Hai', 'Thứ Ba', 'Thứ Tư', 'Thứ Năm', 'Thứ Sáu', 'Thứ Bảy', 'Chủ Nhật'];

//         const currentDayIndex = today.getDay(); // 0 = Chủ Nhật
//         const adjustedCurrentDayIndex = (currentDayIndex + 6) % 7; // Điều chỉnh để phù hợp với mảng weekdays

//         daysNav.innerHTML = ''; // Xóa các mục hiện có

//         for (let i = 0; i < daysToShow; i++) {
//             const index = (adjustedCurrentDayIndex + currentStartIndex + i) % totalDays;

//             const li = document.createElement('li');
//             li.classList.add('nav-item', 'day-item');
//             const a = document.createElement('a');
//             a.classList.add('nav-link', 'day-link');

//             const dateToDisplay = new Date(today.getTime() + ((currentStartIndex + i) * 86400000));
//             const dateString = `${dateToDisplay.toLocaleDateString('vi-VN', { year: 'numeric', month: '2-digit', day: '2-digit' })}`;
//             a.innerHTML = `${weekdays[index]}<br>${dateToDisplay.toLocaleDateString('vi-VN', { day: '2-digit', month: '2-digit' })}`;
//             a.href = "javascript:void(0);";

//             a.onclick = () => {
//                 highlightActiveDay(a, index); // Đánh dấu ngày hoạt động
//                 activeDayInput.value = dateString;

//                 // Gửi dateString đến server để lấy giờ chiếu
//                 const xhr = new XMLHttpRequest();
//                 xhr.open('POST', '../views/controllers/film-controller.php', true);
//                 xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
//                 xhr.onreadystatechange = function () {
//                     if (xhr.readyState === 4 && xhr.status === 200) {
//                         try {
//                             const showtimes = JSON.parse(xhr.responseText);
//                             updateShowtimes(showtimes);
//                         } catch (e) {
//                             console.error("Lỗi khi phân tích phản hồi:", e);
//                         }
//                     }
//                 };
//                 xhr.send('selected_date=' + encodeURIComponent(dateString));
//             };

//             if (i === 0 && currentStartIndex === 0) {
//                 a.classList.add('active'); // Đánh dấu hôm nay là hoạt động
//                 a.innerHTML = `Hôm Nay<br>${today.toLocaleDateString('vi-VN', { day: '2-digit', month: '2-digit' })}`;
//                 activeDayInput.value = `${today.toLocaleDateString('vi-VN', { day: '2-digit', month: '2-digit' })}`;
//                 displayShowtimes(currentStartIndex);
//             }

//             li.appendChild(a);
//             daysNav.appendChild(li);
//         }

//         addNavigationButtons();

//     }

//     function highlightActiveDay(activeElement, dayIndex) {
//         const dayLinks = document.querySelectorAll('.day-link');
//         dayLinks.forEach(link => link.classList.remove('active'));
//         activeElement.classList.add('active');
//         displayShowtimes(dayIndex);
//     }

//     function updateShowtimes(showtimes) {
//         const showtimeContainer = document.getElementById('showtimeContainer');
//         showtimeContainer.innerHTML = ''; // Xóa các giờ chiếu hiện tại

//         if (showtimes.length === 0) {
//             const li = document.createElement('li');
//             li.textContent = 'Không có giờ chiếu cho ngày đã chọn.';
//             showtimeContainer.appendChild(li);
//             return;
//         }

//         showtimes.forEach(showtime => {
//             const li = document.createElement('li');
//             li.classList.add('time-link');
//             li.textContent = `${showtime.start_time} - ${showtime.end_time}`; // Điều chỉnh nếu cần

//             li.onclick = () => highlightActiveShowtime(li);
//             showtimeContainer.appendChild(li);
//         });
//     }

//     function displayShowtimes(dayIndex) {
//         const showtimeContainer = document.getElementById('showtimeContainer');
//         showtimeContainer.innerHTML = '';

//         const times = showtimes[dayIndex] || [];
//         times.forEach(time => {
//             const li = document.createElement('li');
//             li.classList.add('time-link');
//             li.textContent = time;
//             li.onclick = () => highlightActiveShowtime(li);
//             showtimeContainer.appendChild(li);
//         });
//     }

//     function highlightActiveShowtime(activeElement) {
//         const showtimeLinks = document.querySelectorAll('.time-link');
//         showtimeLinks.forEach(link => link.classList.remove('active'));
//         activeElement.classList.add('active');
//     }

//     function addNavigationButtons() {
//         const daysNav = document.getElementById('daysNav');

//         const existingButtons = document.querySelectorAll('.nav-button');
//         existingButtons.forEach(button => button.remove());

//         if (currentStartIndex > 0) {
//             const prevButton = document.createElement('button');
//             prevButton.classList.add('nav-button', 'btn', 'me-2');
//             prevButton.innerHTML = '<i class="bi bi-chevron-left"></i>';
//             prevButton.onclick = () => {
//                 currentStartIndex -= daysToShow;
//                 generateDays();
//             };
//             daysNav.parentNode.insertBefore(prevButton, daysNav);
//         }

//         if (currentStartIndex + daysToShow < totalDays) {
//             const nextButton = document.createElement('button');
//             nextButton.classList.add('nav-button', 'btn');
//             nextButton.innerHTML = '<i class="bi bi-chevron-right"></i>';
//             nextButton.onclick = () => {
//                 currentStartIndex += daysToShow;
//                 generateDays();
//             };
//             daysNav.parentNode.insertBefore(nextButton, daysNav.nextSibling);
//         }
//     }

//     generateDays();
// });
