const slider = document.querySelector('.slider');
const slides = document.querySelectorAll('.slide');
const dots = document.querySelectorAll('.dot');
let currentIndex = 0;
let interval;

// Function to update slider position
const updateSliderPosition = () => {
  slider.style.transform = `translateX(-${currentIndex * 100}%)`;
  dots.forEach(dot => dot.classList.remove('active'));
  dots[currentIndex].classList.add('active');
};

// Function to move to the next slide
const nextSlide = () => {
  currentIndex = (currentIndex + 1) % slides.length;
  updateSliderPosition();
};

// Function to start automatic sliding
const startAutoSlide = () => {
  interval = setInterval(nextSlide, 3000); // Change slide every 3 seconds
};

// Function to handle dot click
dots.forEach(dot => {
  dot.addEventListener('click', (e) => {
    currentIndex = parseInt(e.target.dataset.index);
    updateSliderPosition();
    clearInterval(interval); // Stop auto-slide on manual interaction
    startAutoSlide(); // Restart auto-slide
  });
});

// Drag functionality
let isDragging = false, startPos = 0, currentTranslate = 0, prevTranslate = 0;

slider.addEventListener('mousedown', (e) => {
  isDragging = true;
  startPos = e.clientX;
  slider.style.cursor = 'grabbing';
  clearInterval(interval); // Stop auto-slide on drag
});

slider.addEventListener('mousemove', (e) => {
  if (!isDragging) return;
  const currentPosition = e.clientX - startPos;
  slider.style.transform = `translateX(${prevTranslate + currentPosition}px)`;
});

slider.addEventListener('mouseup', () => {
  isDragging = false;
  slider.style.cursor = 'grab';
  const movedBy = currentTranslate - prevTranslate;
  if (movedBy < -100) nextSlide(); // Slide to next
  else if (movedBy > 100) currentIndex = (currentIndex - 1 + slides.length) % slides.length; // Slide to previous
  updateSliderPosition();
  startAutoSlide(); // Restart auto-slide
});

slider.addEventListener('mouseleave', () => {
  if (isDragging) {
    isDragging = false;
    updateSliderPosition();
    startAutoSlide();
  }
});

// Initialize slider
updateSliderPosition();
startAutoSlide();
