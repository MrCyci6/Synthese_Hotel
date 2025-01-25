document.addEventListener('DOMContentLoaded', event => {
    const selector = document.getElementById("selectHotel");
    selector.addEventListener("change", event => {
        const hotelId = event.target.value;
        window.location.href = `dashboard.php?hotel_id=${hotelId}`;
    });

    // const toast = document.getElementById('toast');
    // const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toast);
    // toastBootstrap.show();
});