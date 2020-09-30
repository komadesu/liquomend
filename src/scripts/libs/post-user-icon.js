class PostUserIcon {
  constructor() {
    this.userIconBtns = document.querySelectorAll('.js-usericon-btn');
    this.userIcon = document.querySelector('.js-usericon');
    this.mobileMenuIcon = document.querySelector('.js-mobile-menu__icon');
    this._init();
  }

  _init() {
    this.userIconBtns.forEach((userIconBtn) => {
      this.validUserIconBtn(userIconBtn);
    });
  }

  _chooseFile() {
    return new Promise((resolve) => {
      const input = document.createElement('input');
      input.setAttribute('type', 'file');
      input.style.display = 'none';
      document.body.appendChild(input);

      input.addEventListener('change', () => {
        const f = input.files[0];
        document.body.removeChild(input);
        resolve(f);
      });
      input.click();
    });
  }

  validUserIconBtn(userIconBtn) {
    userIconBtn.addEventListener('click', (evt) => {
      this._chooseFile().then((f) => {
        const body = new FormData();
        body.append('user_icon_image', f);

        axios.post('./controller/update_user_icon.php', body).then((resp) => {
          this.userIcon.innerHTML = resp.data;
          this.mobileMenuIcon.innerHTML = resp.data;
        });
      });
    });
  }
}

export default PostUserIcon;
