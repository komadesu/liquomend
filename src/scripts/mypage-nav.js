const navBtns = document.querySelectorAll('.js-nav__link');
const targets = document.querySelectorAll('.js-target');

navBtns.forEach((navBtn) => {
  navBtn.addEventListener('click', (e) => {
    e.preventDefault();
    if (navBtn.classList.contains('js-nav-recipe')) {
      targets.forEach((target) => {
        if (target.classList.contains('js-target-recipe')) {
          console.log('recipe is active');
          target.classList.remove('inactive');
          target.classList.add('active');
        } else {
          console.log('not recipe is inactive');
          target.classList.remove('active');
          target.classList.add('inactive');
        }
      });
    }
    if (navBtn.classList.contains('js-nav-favo')) {
      targets.forEach((target) => {
        if (target.classList.contains('js-target-favo')) {
          console.log('favo is active');
          target.classList.remove('inactive');
          target.classList.add('active');
        } else {
          console.log('not favo is inactive');
          target.classList.remove('active');
          target.classList.add('inactive');
        }
      });
    }
    if (navBtn.classList.contains('js-nav-settings')) {
      targets.forEach((target) => {
        if (target.classList.contains('js-target-settings')) {
          console.log('setting is active');
          target.classList.remove('inactive');
          target.classList.add('active');
        } else {
          console.log('not setting is inactive');
          target.classList.remove('active');
          target.classList.add('inactive');
        }
      });
    }
  });
});
