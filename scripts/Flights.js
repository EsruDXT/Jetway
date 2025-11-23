let currentIndex = 0;

function changeSlide(direction) {
    const wrapper = document.querySelector('.testimonial-wrapper');
    const testimonials = document.querySelectorAll('.testimonial');

    const visibleCount = 3;
    const total = testimonials.length;

    currentIndex += direction;

    if (currentIndex < 0) currentIndex = total - visibleCount;
    else if (currentIndex > total - visibleCount) currentIndex = 0;

    wrapper.style.transform = `translateX(${-currentIndex * 280}px)`;
}

// Scroll using logo click
document.getElementById("logo").addEventListener("click", function (e) {
    e.preventDefault();
    const slideshow = document.getElementById("Slideshow");
    const yOffset = -100;
    const y = slideshow.getBoundingClientRect().top + window.pageYOffset + yOffset;
    window.scrollTo({ top: y, behavior: "smooth" });
});

// Loading animation
function startDotAnimation(element) {
    let dots = 0;
    return setInterval(() => {
        dots = (dots + 1) % 4;
        element.textContent = "🛫" + ".".repeat(dots);
    }, 400);
}

window.addEventListener("load", () => {
    const overlay = document.getElementById("loading-overlay");
    const loadingText = document.getElementById("loading-text");

    const dotAnimation = startDotAnimation(loadingText);

    setTimeout(() => {
        clearInterval(dotAnimation);
        overlay.classList.add("hidden");
    }, 1200);
});

// Show loading when navigating pages
document.addEventListener("DOMContentLoaded", () => {
    const links = document.querySelectorAll("a");
    const overlay = document.getElementById("loading-overlay");
    const loadingText = document.getElementById("loading-text");

    links.forEach(link => {
        link.addEventListener("click", e => {
            const href = link.getAttribute("href");
            if (href && !href.startsWith("#") && !href.startsWith("mailto:")) {
                e.preventDefault();
                overlay.classList.remove("hidden");
                const dotAnimation = startDotAnimation(loadingText);
                setTimeout(() => {
                    clearInterval(dotAnimation);
                    window.location.href = href;
                }, 800);
            }
        });
    });
});

// Sorting dropdown
const sortBtn = document.getElementById("sortToggle");
const sortDropdown = document.getElementById("sortDropdown");

sortBtn.addEventListener("click", (e) => {
    e.stopPropagation();
    sortDropdown.style.display = sortDropdown.style.display === "flex" ? "none" : "flex";
});

document.addEventListener("click", () => {
    sortDropdown.style.display = "none";
});

// Handle selection
const sortOptions = document.querySelectorAll(".sort-option");
sortOptions.forEach(option => {
    option.addEventListener("click", () => {
        sortOptions.forEach(o => o.classList.remove("selected"));
        option.classList.add("selected");

        sortBtn.textContent = `Sort ▼ (${option.textContent.trim()})`;

        const sortType = option.getAttribute("data-sort");
        if (sortType) sortFlights(sortType);
    });
});

function sortFlights(order) {
    const list = document.querySelector(".flight-list");
    const cards = Array.from(list.querySelectorAll(".flight-card"));

    cards.sort((a, b) => {
        const priceA = parseInt(a.querySelector(".price").textContent.replace(/\D/g, ""));
        const priceB = parseInt(b.querySelector(".price").textContent.replace(/\D/g, ""));
        return order === "asc" ? priceA - priceB : priceB - priceA;
    });

    cards.forEach(card => list.appendChild(card));
}

// Filter dropdown
const filterToggle = document.getElementById("filterToggle");
const filterDropdown = document.getElementById("filterDropdown");

filterToggle.addEventListener("click", (e) => {
    e.stopPropagation();
    filterDropdown.classList.toggle("show");
});

document.addEventListener("click", (e) => {
    if (!filterDropdown.contains(e.target) && !filterToggle.contains(e.target)) {
        filterDropdown.classList.remove("show");
    }
});

/* ===================== BOOKING API ===================== */

document.addEventListener("DOMContentLoaded", () => {
    const chooseButtons = document.querySelectorAll(".choose-btn");

    chooseButtons.forEach(btn => {
        btn.addEventListener("click", () => {
            const flightCard = btn.closest(".flight-card");
            const flightId = flightCard.getAttribute("data-flight-id");

            if (!flightId) {
                alert("❌ Flight ID not found!");
                return;
            }

            const formData = new FormData();
            formData.append("action", "create_booking");
            formData.append("flight_id", flightId);
            formData.append("passenger_count", 1); // hardcode dulu 1 orang

            fetch("/backend/booking-api.php", {
                method: "POST",
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                console.log("Booking Response:", data);

                if (data.status === "success") {
                    window.location.href = "/pages/ticket-info.php?flight_id=" + flightId;
                } else {
                    alert(data.message || "Booking failed");
                }
            })
            .catch(err => {
                console.error(err);
                alert("Terjadi kesalahan saat booking!");
            });
        });
    });
});


