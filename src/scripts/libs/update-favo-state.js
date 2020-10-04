class UpdateFavoState {
  constructor() {
    this.starBtn = document.querySelector('.js-star-btn');
    this.favo = document.querySelector('.js-favo');
    this._init();
  }

  _init() {
    this.validFavoBtn();
  }

  _judgeStarState() {
    return new Promise((resolve) => {
      if (this.starBtn.classList.contains('far')) {
        resolve('active');
      }
      if (this.starBtn.classList.contains('fas')) {
        resolve('inactive');
      }
    });
  }

  validFavoBtn() {
    this.starBtn.addEventListener('click', (evt) => {
      this._judgeStarState().then((starState) => {
        const searchParams = new URLSearchParams;
        searchParams.append('star_state', starState);
        axios.post('./controller/update_favo_state.php', searchParams).then((resp) => {
          console.log(resp);
          console.log(resp.data);
          this.favo.innerHTML = resp.data;
        });
      });
    });
  }
}

export default UpdateFavoState;
