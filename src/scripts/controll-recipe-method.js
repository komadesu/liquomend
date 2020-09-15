class ControllRecipeMethod {
  constructor() {
    this.addBtn = document.querySelector('.js-add-btn');
    this.deleteBtns = document.querySelectorAll('.js-delete-btn');
    this.recipeMethod = document.querySelector('.js-recipe-method');
    this.children = this.recipeMethod.children;
    this._init();
  }

  _init() {
    this._initValidAddBtn();
    this._initValidDeleteBtns();
  }

  _initValidAddBtn() {
    this._validAddBtn();
  }

  _validAddBtn() {
    this.childeren = this.recipeMethod.children;

    this.addBtn.addEventListener('click', () => {
      let lastMethodItem = this.childeren[this.childeren.length - 1];

      let nextId = Number(lastMethodItem.id) + 1;

      const newMethodItem = lastMethodItem.cloneNode(true);
      newMethodItem.id = nextId;

      nextId = String(nextId);
      nextId = this._hankaku2Zenkaku(nextId);
      newMethodItem.firstElementChild.firstElementChild.textContent = `材料${nextId}`;
      newMethodItem.firstElementChild.nextElementSibling.firstElementChild.textContent = `分量${nextId}`;

      this.recipeMethod.appendChild(newMethodItem);

      this._validNewDeleteBtn(newMethodItem);
    });
  }

  _initValidDeleteBtns() {
    this.deleteBtns.forEach((deleteBtn) => {
      this._validDeleteBtn(deleteBtn);
    });
  }

  _validNewDeleteBtn(newMethodItem) {
    const methodItemChildren = newMethodItem.children;
    const newDeleteBtn = methodItemChildren[methodItemChildren.length - 1];

    this._validDeleteBtn(newDeleteBtn);
  }

  _validDeleteBtn(deleteBtn) {
    this.children = this.recipeMethod.children;

    deleteBtn.addEventListener('click', (e) => {
      const target = e.target.parentNode.parentNode;

      for (let methodItem of this.children) {
        if (methodItem.id === target.id) {
          this.recipeMethod.removeChild(methodItem);
          break;
        }
      }

      let methodItemId = 1;
      let ingredientNum = 1;
      let quantitiesNum = 1;
      for (let methodItem of this.children) {
        ingredientNum = this._hankaku2Zenkaku(String(ingredientNum));
        quantitiesNum = this._hankaku2Zenkaku(String(quantitiesNum));

        methodItem.id = methodItemId;
        methodItem.firstElementChild.firstElementChild.textContent = `材料${ingredientNum}`;
        methodItem.firstElementChild.nextElementSibling.firstElementChild.textContent = `分量${quantitiesNum}`;

        ingredientNum = Number(this._zenkaku2Hankaku(ingredientNum));
        quantitiesNum = Number(this._zenkaku2Hankaku(quantitiesNum));

        methodItemId += 1;
        ingredientNum += 1;
        quantitiesNum += 1;
      }
      console.log('finish!');
    });
  }

  _hankaku2Zenkaku(str) {
    return str.replace(/[A-Za-z0-9]/g, function (s) {
      return String.fromCharCode(s.charCodeAt(0) + 0xfee0);
    });
  }

  _zenkaku2Hankaku(str) {
    return str.replace(/[Ａ-Ｚａ-ｚ０-９]/g, function (s) {
      return String.fromCharCode(s.charCodeAt(0) - 0xfee0);
    });
  }
}

export default ControllRecipeMethod;
