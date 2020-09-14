class AppearBaseSelect {
  constructor() {
    this.base = document.querySelector('.js-base');
    this.target = document.querySelector('.js-toggle');
    this._addEvent();
  }

  _addEvent() {
    this.base.addEventListener('change', () => {
      if (this.base.value === 'liquor') {
        this.target.classList.remove('inactive');
        this.target.classList.add('active');
      } else {
        this.target.classList.remove('active');
        this.target.classList.add('inactive');
      }
    });
  }
}

export default AppearBaseSelect;
