window.addEventListener('scroll', () => {
  const header = document.querySelector('.nailtool-header');
  if (window.scrollY > 0) {
    header.classList.add('fixed');
  } else {
    header.classList.remove('fixed');
  }
});

