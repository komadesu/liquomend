import PreviewImage from './preview-image.js';
import AppearBaseSelect from './appear-base-select.js';
import ControllRecipeMethod from './controll-recipe-method.js';

document.addEventListener('DOMContentLoaded', () => {
  const io = new AppearBaseSelect();


  const fileInput = document.querySelector('.js-recipe-img-input');
  const io2 = new PreviewImage(fileInput);


  const io3 = new ControllRecipeMethod();
});
