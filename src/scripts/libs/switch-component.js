class SwitchComponent {
  constructor() {
    this.navBtns = document.querySelectorAll('.js-nav__link');
    this.targets = document.querySelectorAll('.js-target');
    this._init();
  }

  _init() {
    this._validNavBtns();
  }

  _validNavBtns() {
    this.navBtns.forEach((navBtn) => {
      navBtn.addEventListener('click', (e) => {
        e.preventDefault();
        if (navBtn.classList.contains('js-nav-recipe')) {
          this.targets.forEach((target) => {
            if (target.classList.contains('js-target-recipe')) {
              target.classList.remove('inactive');
              target.classList.add('active');
            } else {
              target.classList.remove('active');
              target.classList.add('inactive');
            }
          });
        }
        if (navBtn.classList.contains('js-nav-favo')) {
          this.targets.forEach((target) => {
            if (target.classList.contains('js-target-favo')) {
              target.classList.remove('inactive');
              target.classList.add('active');
            } else {
              target.classList.remove('active');
              target.classList.add('inactive');
            }
          });
        }
        if (navBtn.classList.contains('js-nav-settings')) {
          this.targets.forEach((target) => {
            if (target.classList.contains('js-target-settings')) {
              target.classList.remove('inactive');
              target.classList.add('active');
            } else {
              target.classList.remove('active');
              target.classList.add('inactive');
            }
          });
        }
      });
    });
  }
}

export default SwitchComponent;