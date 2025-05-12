document.addEventListener("DOMContentLoaded", () => {
    const zoomInBtn = document.getElementById("zoom-in");
    const zoomOutBtn = document.getElementById("zoom-out");
    const printBtn = document.getElementById("print");
    const modal = document.getElementById("profile-modal");
    const modalTitle = document.getElementById("modal-title");
    const modalDetails = document.getElementById("modal-details");
    const modalClose = document.getElementById("modal-close");

    let zoomLevel = 1;
    const chart = document.getElementById("org-chart");

    zoomInBtn.addEventListener("click", () => {
        zoomLevel += 0.1;
        chart.style.transform = `scale(${zoomLevel})`;
    });

    zoomOutBtn.addEventListener("click", () => {
        if (zoomLevel > 0.5) {
            zoomLevel -= 0.1;
            chart.style.transform = `scale(${zoomLevel})`;
        }
    });

    printBtn.addEventListener("click", () => {
        window.print();
    });

    const employeeCards = document.querySelectorAll(".employee");
    employeeCards.forEach(card => {
        card.addEventListener("click", () => {
            const name = card.getAttribute("data-name") || "Employee Title";
            const details = card.getAttribute("data-details") || "Details go here...";
            modalTitle.textContent = name;
            modalDetails.textContent = details;
            modal.style.display = "block";
        });
    });

    modalClose.addEventListener("click", () => {
        modal.style.display = "none";
    });

    window.addEventListener("click", (event) => {
        if (event.target === modal) {
            modal.style.display = "none";
        }
    });
});
