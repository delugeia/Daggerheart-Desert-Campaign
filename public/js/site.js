(() => {
  const button = document.querySelector('.menu-button');
  const navigation = document.querySelector('#navigation');
  function closeMenu() {
    navigation.classList.remove('is-open');
    document.documentElement.classList.remove('menu-open');
    button.setAttribute('aria-expanded', 'false');
  }
  button.addEventListener('click', () => {
    const open = navigation.classList.toggle('is-open');
    document.documentElement.classList.toggle('menu-open', open);
    button.setAttribute('aria-expanded', String(open));
  });
  document.addEventListener('keydown', event => {
    if (event.key === 'Escape' && navigation.classList.contains('is-open')) {
      closeMenu(); button.focus();
    }
  });
  navigation.addEventListener('click', event => { if (event.target.closest('a')) closeMenu(); });
  matchMedia('(max-width: 760px)').addEventListener('change', closeMenu);
})();
