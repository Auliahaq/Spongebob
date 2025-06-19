// public/js/search-friends.js

document.addEventListener('DOMContentLoaded', function () {
  const input = document.getElementById('search-input');
  const list = document.getElementById('friend-list');
  if (!input || !list) return;

  input.addEventListener('input', function () {
    const q = this.value.toLowerCase().trim();
    const items = list.querySelectorAll('.friend-item');

    items.forEach(item => {
      const nameEl = item.querySelector('.name');
      const emailEl = item.querySelector('.email');
      const name = nameEl ? nameEl.textContent.toLowerCase() : '';
      const email = emailEl ? emailEl.textContent.toLowerCase() : '';

      if (name.includes(q) || email.includes(q)) {
        item.style.display = '';
      } else {
        item.style.display = 'none';
      }
    });
  });
});
