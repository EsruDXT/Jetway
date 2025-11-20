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

let slideIndex = 0;
autoShowSlides();

function autoShowSlides() {
  const slides = document.getElementsByClassName("slide");
  for (let i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";
  }
  slideIndex++;
  if (slideIndex > slides.length) { slideIndex = 1 }
  slides[slideIndex - 1].style.display = "block";
  setTimeout(autoShowSlides, 4000); // Ganti gambar setiap 4 detik
}

const micButton = document.querySelector('.searchbar button:nth-child(3)'); // tombol mic
const micPopup = document.getElementById('mic-popup');

// Saat tombol mic diklik
micButton.addEventListener('click', () => {
  micPopup.style.display = 'flex';

  // Tutup otomatis setelah 3 detik
  setTimeout(() => {
    micPopup.style.display = 'none';
  }, 3000);
});

// Klik di luar gambar untuk menutup popup
micPopup.addEventListener('click', (e) => {
  if (e.target === micPopup) {
    micPopup.style.display = 'none';
  }
});

const notifIcon = document.querySelector('img[alt="iconnotif"]');
const popupSetNotif = document.getElementById('popup-setnotif');
const popupNotifSet = document.getElementById('popup-notifset');
const btnYes = document.getElementById('notif-yes');
const btnCancel = document.getElementById('notif-cancel');
const btnConfirm = document.getElementById('notif-confirm');

// Klik ikon → tampil popup Set Notification
notifIcon.addEventListener('click', () => {
  popupSetNotif.style.display = 'flex';
});

// Klik Yes → tutup popup pertama, buka popup kedua
btnYes.addEventListener('click', () => {
  popupSetNotif.style.display = 'none';
  popupNotifSet.style.display = 'flex';
});

// Klik Cancel → tutup popup pertama
btnCancel.addEventListener('click', () => {
  popupSetNotif.style.display = 'none';
});

// Klik Confirm → tutup popup kedua
btnConfirm.addEventListener('click', () => {
  popupNotifSet.style.display = 'none';
});

const toggleBtn = document.querySelector('.lang-dropdown-toggle');
const modal = document.getElementById('langCurrencyModal');
const closeBtn = document.querySelector('.lang-close');

toggleBtn.addEventListener('click', () => {
    modal.style.display = "block";
});

closeBtn.addEventListener('click', () => {
    modal.style.display = "none";
});

// klik area hitam untuk menutup
window.addEventListener('click', (e) => {
    if (e.target === modal) {
        modal.style.display = "none";
    }
});
