let lastScrollTop = 0;
const loginButton = document.querySelector('.header .login-button');

window.addEventListener('scroll', () => {
    const currentScroll = window.scrollY;

    if (currentScroll > lastScrollTop) {
        // Scrolling down
        loginButton.style.transform = 'translateY(-200%)';
        loginButton.style.transition = 'transform 0.3s ease-in-out';
    } else {
        // Scrolling up
        loginButton.style.transform = 'translateY(0)';
    }

    lastScrollTop = currentScroll <= 0 ? 0 : currentScroll; // For Mobile or negative scrolling
});
