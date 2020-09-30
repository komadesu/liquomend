import PreviewImage from './preview-image.js';
import AppearBaseSelect from './appear-base-select.js';
import ControllRecipeMethod from './controll-recipe-method.js';
import PostUserIcon from './libs/post-user-icon.js';

document.addEventListener('DOMContentLoaded', () => {
  const io = new AppearBaseSelect();


  const fileInput = document.querySelector('.js-recipe-img-input');
  const io2 = new PreviewImage(fileInput);


  const io3 = new ControllRecipeMethod();


  const postUserIconInstance = new PostUserIcon();
  const observer = new MutationObserver((mutationList, observer) => {
    mutationList.forEach((mutationRecord) => {
      let userIconBtn = mutationRecord.target.querySelector('.js-usericon-btn');
      postUserIconInstance.validUserIconBtn(userIconBtn);
    });
  });
  const config = {
    childList: true,
  };
  // const userIcon = postUserIconInstance.userIcon;
  const mobileMenuIcon = postUserIconInstance.mobileMenuIcon;
  // observer.observe(userIcon, config);
  observer.observe(mobileMenuIcon, config);
});
