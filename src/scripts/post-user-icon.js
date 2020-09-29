const userIconBtn = document.querySelector('.js-usericon-btn');
const userIcon = document.querySelector('.js-usericon');

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

userIconBtn.addEventListener('click', (evt) => {
  console.log('axios');
  chooseFile().then((f) => {
    const body = new FormData();
    body.append('user_icon_image', f);
    // body.append('foo', 'fuga');
    axios.post('./controller/update_user_icon.php', body).then((resp) => {
      console.log(resp);
      userIcon.innerHTML = resp.data;
    });
  });
});
