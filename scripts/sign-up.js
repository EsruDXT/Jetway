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

document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('registerForm');
    const submitBtn = form.querySelector('button[type="submit"]');
    const inputs = form.querySelectorAll('input');

    // Password field (no complexity enforced)
    const password = document.getElementById('password');

    // Check if passwords match only when confirm is provided
    const confirmPassword = document.getElementById('confirm_password');
    confirmPassword.addEventListener('input', function() {
        if (this.value && this.value !== password.value) {
            this.setCustomValidity('Passwords do not match');
        } else {
            this.setCustomValidity('');
        }
    });

    // Form submission
    form.addEventListener('submit', async function(e) {
        e.preventDefault();
        
        // Validate username
        const username = document.getElementById('username').value;
        if (!/^[a-zA-Z0-9_]{3,50}$/.test(username)) {
            alert('Username must be 3-50 characters and contain only letters, numbers, and underscores');
            return;
        }

        // Validate email
        const email = document.getElementById('email').value;
        if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
            alert('Please enter a valid email address');
            return;
        }

        // No password complexity required (allow any password)

        // Show loading state
        submitBtn.classList.add('loading');
        const spinner = document.createElement('div');
        spinner.className = 'spinner';
        submitBtn.appendChild(spinner);
        spinner.style.display = 'inline-block';
        submitBtn.disabled = true;

        try {
            const formData = new FormData(form);
            const response = await fetch('/handlers/register.php', {
                method: 'POST',
                body: formData
            });

            const result = await response.json();
            
            if (result.success) {
                window.location.href = '/pages/sign-in.php';
            } else {
                alert(result.message || 'Registration failed. Please try again.');
            }
        } catch (error) {
            alert('An error occurred. Please try again.');
        } finally {
            submitBtn.classList.remove('loading');
            spinner.remove();
            submitBtn.disabled = false;
        }
    });
});

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