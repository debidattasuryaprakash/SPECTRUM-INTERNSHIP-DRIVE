let navbar =  document.querySelector('.navbar-links');

console.log(navbar);
window.addEventListener('scroll', function () {
    if (window.scrollY >= 240) {
      navbar.classList.add('onscroll');
    } else {
      navbar.classList.remove('onscroll');
    }
  });