import PreviewImage from './preview-image.js';

document.addEventListener('DOMContentLoaded', () => {
  const fileInput = document.querySelector('.js-recipe-img-input');
  const io = new PreviewImage(fileInput);
})