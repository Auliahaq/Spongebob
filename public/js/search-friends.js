// public/js/search-friends.js

document.addEventListener('DOMContentLoaded', function () {
  const input = document.getElementById('search-input');
  const list  = document.getElementById('friend-list');
  if (!input || !list) return;

  const items = Array.from(list.querySelectorAll('.friend-item'));

  input.addEventListener('input', function () {
    const q = this.value.toLowerCase().trim();
    items.forEach(item => {
      const name  = item.querySelector('.name').textContent.toLowerCase();
      const email = item.querySelector('.email').textContent.toLowerCase();
      item.style.display = (name.includes(q) || email.includes(q)) ? '' : 'none';
    });
  });
});
