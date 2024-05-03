
// Function to check if an element is in the viewport
const isInViewport = (element) => {
  const rect = element.getBoundingClientRect();
  return (
    rect.top >= 0 &&
    rect.left >= 0 &&
    rect.bottom <=
      (window.innerHeight || document.documentElement.clientHeight) &&
    rect.right <= (window.innerWidth || document.documentElement.clientWidth)
  );
};

// Function to add 'active' class when element is in viewport
const addActiveClass = (entries, observer) => {
  entries.forEach((entry) => {
    if (entry.isIntersecting) {
      entry.target.classList.add("active");
    } else {
      entry.target.classList.remove("active");
    }
  });
};

// Initialize Intersection Observer
const observer = new IntersectionObserver(addActiveClass, {
  root: null,
  threshold: 0.35, // Adjust as needed
});

// Get all elements with class 'fade-in'
const fadeElements = document.querySelectorAll(".fade-in");

// Observe each fade-in element
fadeElements.forEach((element) => {
  observer.observe(element);
});
