// Smooth scroll to section with offset for fixed header and additional space
document.querySelectorAll('a.button').forEach(button => {
  button.addEventListener('click', function(e) {
    e.preventDefault();
    const targetId = this.getAttribute('href').substring(1); // Remove '#'
    const targetElement = document.getElementById(targetId);
    const headerHeight = document.querySelector('header').offsetHeight;
    const additionalSpace = 30; // Adjust this value as needed
    const offset = targetElement.getBoundingClientRect().top + window.scrollY - headerHeight - additionalSpace;
    window.scroll({
      top: offset,
      behavior: 'smooth'
    });
  });
});

// Scrolling Animation
const fadeIns = document.querySelectorAll(".fade-in");

const fadeInObserver = new IntersectionObserver(
  (entries, observer) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        entry.target.classList.add("active");
      } else {
        entry.target.classList.remove("active");
      }
    });
  },
  {
    threshold: 0.5, // Adjust the threshold as needed
  }
);

fadeIns.forEach((fadeIn) => {
  fadeInObserver.observe(fadeIn);
});
