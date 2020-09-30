const userIconBtns = document.querySelectorAll('.js-usericon-btn');
const userIcon = document.querySelector('.js-usericon');
const mobileMenuIcon = document.querySelector('.js-mobile-menu__icon');

const chooseFile = () =>
  new Promise((resolve) => {
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

userIconBtns.forEach((userIconBtn) => {
  userIconBtn.addEventListener('click', (evt) => {
    console.log('axios');
    chooseFile().then((f) => {
      const body = new FormData();
      body.append('user_icon_image', f);

      axios.post('./controller/update_user_icon.php', body).then((resp) => {
        console.log(resp);
        console.log(resp.data);
        userIcon.innerHTML = resp.data;
        mobileMenuIcon.innerHTML = resp.data;
      });
    });
  });
});
