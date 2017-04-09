const name = document.getElementById('name');
const value = document.getElementById('value');
const btn = document.querySelector('button[name="inscription"]');
const form = document.querySelector('.form__inscription');

const handleClick = function handleClick(e) {
  e.preventDefault();
  const body = new FormData(form);
  body.append('inscription', true);
  const method = 'post';

  fetch('./inscription.php', { method, body })
    .then(res => res.json())
    .then(obj => console.log(obj));
};

btn.addEventListener('click', handleClick);
