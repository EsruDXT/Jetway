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

const buttons = document.querySelectorAll('.menu button');
const pages = document.querySelectorAll('.page');

buttons.forEach(btn => {
  btn.addEventListener('click', () => {
    // hilangkan active dari semua tombol
    buttons.forEach(b => b.classList.remove('active'));
    btn.classList.add('active');

    // tampilkan konten sesuai data-page
    const target = btn.getAttribute('data-page');
    pages.forEach(p => p.classList.remove('active'));
    document.getElementById(target).classList.add('active');
  });
});
