// トグルメニュー（モバイル）

const toggleButton = document.querySelector('.toggle-menu-button');
const headerSiteMenu = document.querySelector('.header-site-menu');

toggleButton.addEventListener('click',()=>{
  headerSiteMenu.classList.toggle('is-show');
});