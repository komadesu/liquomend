import SwitchComponent from './libs/switch-component.js';
import PostUserIcon from './libs/post-user-icon.js';

document.addEventListener('DOMContentLoaded', () => {
  const io = new SwitchComponent();


  const postUserIconInstance = new PostUserIcon();
  const observer = new MutationObserver((mutationList, observer) => {
    mutationList.forEach(mutationRecord => {
      let userIconBtn = mutationRecord.target.querySelector('.js-usericon-btn');
      postUserIconInstance.validUserIconBtn(userIconBtn);
    })
  });
  const config = {
    childList: true,
  };
  const userIcon = postUserIconInstance.userIcon;
  const mobileMenuIcon = postUserIconInstance.mobileMenuIcon;
  observer.observe(userIcon, config);
  observer.observe(mobileMenuIcon, config);
});
