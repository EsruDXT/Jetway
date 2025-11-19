let currentIndex = 0;

function changeSlide(direction) {
  const wrapper = document.querySelector('.testimonial-wrapper');
  const testimonials = document.querySelectorAll('.testimonial');
  
  const visibleCount = 3; // tampilkan 3 sekaligus
  const total = testimonials.length;

  currentIndex += direction;

  if (currentIndex < 0) {
    currentIndex = total - visibleCount;
  } else if (currentIndex > total - visibleCount) {
    currentIndex = 0;
  }

  wrapper.style.transform = `translateX(${-currentIndex * 280}px)`;
}



document.getElementById("logo").addEventListener("click", function (e) {
    e.preventDefault(); 
    const slideshow = document.getElementById("Slideshow");
    const yOffset = -100; 
    const y = slideshow.getBoundingClientRect().top + window.pageYOffset + yOffset;

    window.scrollTo({
        top: y,
        behavior: "smooth"
    });
});

// Fungsi animasi titik-titik
function startDotAnimation(element) {
  let dots = 0;
  return setInterval(() => {
    dots = (dots + 1) % 4;
    element.textContent = "🛫" + ".".repeat(dots);
  }, 400);
}

// Saat halaman selesai dimuat
window.addEventListener("load", () => {
  const overlay = document.getElementById("loading-overlay");
  const loadingText = document.getElementById("loading-text");
  const content = document.getElementById("content");

  // Mulai animasi titik-titik
  const dotAnimation = startDotAnimation(loadingText);

  // Sembunyikan overlay setelah sedikit delay
  setTimeout(() => {
    clearInterval(dotAnimation);
    overlay.classList.add("hidden");
    content.classList.add("visible");
  }, 1200);
});

// Saat user klik link, tampilkan overlay lagi
document.addEventListener("DOMContentLoaded", () => {
  const links = document.querySelectorAll("a");

  links.forEach(link => {
    link.addEventListener("click", e => {
      const href = link.getAttribute("href");
      if (href && !href.startsWith("#") && !href.startsWith("mailto:")) {
        e.preventDefault();
        const overlay = document.getElementById("loading-overlay");
        const loadingText = document.getElementById("loading-text");

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

// Toggle dropdown
const sortBtn = document.getElementById("sortToggle");
const sortDropdown = document.getElementById("sortDropdown");

sortBtn.addEventListener("click", (e) => {
  e.stopPropagation();
  sortDropdown.style.display = sortDropdown.style.display === "flex" ? "none" : "flex";
});

// Klik di luar dropdown → tutup
document.addEventListener("click", () => {
  sortDropdown.style.display = "none";
});

// Pilih opsi
const sortOptions = document.querySelectorAll(".sort-option");
sortOptions.forEach(option => {
  option.addEventListener("click", () => {
    // Hapus tanda dari sebelumnya
    sortOptions.forEach(o => o.classList.remove("selected"));
    option.classList.add("selected");

    // Tampilkan opsi terpilih di tombol
    sortBtn.textContent = `Sort ▼ (${option.textContent.trim()})`;

    // Ambil jenis sort (asc/desc)
    const sortType = option.getAttribute("data-sort");
    if (sortType) sortFlights(sortType); // panggil fungsi sort
  });
});

// Fungsi sort daftar penerbangan berdasarkan harga
function sortFlights(order) {
  const list = document.querySelector(".flight-list");
  const cards = Array.from(list.querySelectorAll(".flight-card"));

  cards.sort((a, b) => {
    const priceA = parseInt(a.querySelector(".price").textContent.replace(/\D/g, ""));
    const priceB = parseInt(b.querySelector(".price").textContent.replace(/\D/g, ""));
    return order === "asc" ? priceA - priceB : priceB - priceA;
  });

  // Susun ulang elemen
  cards.forEach(card => list.appendChild(card));
}

/* ===================== FILTER DROPDOWN ===================== */

const filterToggle = document.getElementById("filterToggle");     // tombol Filter ▼
const filterDropdown = document.getElementById("filterDropdown"); // panel dropdown

// Buka / tutup dropdown ketika tombol ditekan
filterToggle.addEventListener("click", (e) => {
    e.stopPropagation();                  
    filterDropdown.classList.toggle("show");
});

// Tutup dropdown ketika klik di luar
document.addEventListener("click", (e) => {
    if (!filterDropdown.contains(e.target) &&
        !filterToggle.contains(e.target)) {
        filterDropdown.classList.remove("show");
    }
});



