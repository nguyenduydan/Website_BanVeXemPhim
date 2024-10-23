
function showSuccessToast(message) {
    toast({
        title: "Thành công!",
        message: message,
        type: "success",
        duration: 1000
    });
};

function showErrorToast(message) {
    toast({
        title: "Thất bại!",
        message: message,
        type: "error",
        duration: 1000
    });
}

function toast({
    title = "",
    message = "",
    type = "info",
    duration = 500
}) {
    const main = document.getElementById("toast");
    if (main) {
        const toast = document.createElement("div");
        main.appendChild(toast);

        const autoRemoveId = setTimeout(function () {
            main.removeChild(toast);
        }, duration + 500);

        toast.onclick = function (e) {
            if (e.target.closest(".toast__close")) {
                main.removeChild(toast);
                clearTimeout(autoRemoveId);
            }
        };

        const icons = {
            success: "fas fa-check-circle",
            error: "fas fa-exclamation-circle",
        };
        const icon = icons[type];

        toast.classList.add("toast", `toast--${type}`);
        toast.style.animation = `slideInLeft ease .3s forwards, fadeOut linear 0.3s ${duration / 1000}s forwards`;

        toast.innerHTML = `
                <div class="toast__icon">
                    <i class="${icon}"></i>
                </div>
                <div class="toast__body">
                    <h3 class="toast__title">${title}</h3>
                    <p class="toast__msg">${message}</p>
                </div>
                <div class="toast__close">
                    <i class="fas fa-times"></i>
                </div>
            `;
    }
}
