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

document.addEventListener('DOMContentLoaded', function () {
  const form = document.getElementById('loginForm');
  if (!form) return;

  form.addEventListener('submit', function (e) {
    e.preventDefault();

    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;

    const data = new FormData();
    data.append('email', email);
    data.append('password', password);

    fetch('/handlers/login.php', {
      method: 'POST',
      body: data,
    })
      .then(res => res.json())
      .then(json => {
        if (json.status === 'success') {
          window.location.href = json.redirect || '/pages/Homepage.php';
        } else {
          alert(json.message || 'Login failed');
        }
      })
      .catch(err => {
        console.error(err);
        alert('An error occurred during login');
      });
  });
});
