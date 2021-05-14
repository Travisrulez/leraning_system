// Modal
const modal = document.querySelector('.modal');
const closeBtn = document.querySelector('.modal__close');
const overlay = document.querySelector('.overlay');
const subscribeBtn = document.querySelector('.subscribe__btn');

subscribeBtn.addEventListener('click', () => {
  modal.style.display = 'block';
  overlay.style.display = 'block';
})

function closeModal() {
  modal.style.display = '';
  overlay.style.display = '';
}

closeBtn.addEventListener('click', closeModal);
overlay.addEventListener('click', closeModal);