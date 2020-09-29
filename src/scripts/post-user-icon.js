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

// input DOM element の files プロパティの中身はオブジェクトになっていて、0 というキーと、length というキーがある。
// FileList {0: File, length: 1}
// 0: File
// lastModified: 1595046030724
// lastModifiedDate: Sat Jul 18 2020 13:20:30 GMT+0900 (日本標準時) {}
// name: "myIcon.jpg"
// size: 10776
// type: "image/jpeg"
// webkitRelativePath: ""
// __proto__: File
// length: 1
// __proto__: FileList
