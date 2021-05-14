document.addEventListener('DOMContentLoaded', () => {
  if (document.querySelector('.header__profile')) {
    const profile = document.querySelector('.header__profile');
    
    profile.addEventListener('click', e => {
      if (!e.target.closest('.profile-menu__link'))
      profile.classList.toggle('active');
    })
    
    document.addEventListener('click', e => {
      if (!e.target.closest('.header__profile')) {
        profile.classList.remove('active');
      }
    });
    
  } else {
    const profile = document.querySelector('.header__auth');
    
    profile.addEventListener('click', e => {
      if (!e.target.closest('.header__links a'))
      profile.classList.toggle('active');
    })
    
    document.addEventListener('click', e => {
      if (!e.target.closest('.header__auth')) {
        profile.classList.remove('active');
      }
    });
  }
})

