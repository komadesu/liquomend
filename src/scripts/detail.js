import PostUserIcon from './libs/post-user-icon.js';
import UpdateFavoState from './libs/update-favo-state.js';

document.addEventListener('DOMContentLoaded', () => {
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



  new UpdateFavoState();
});
