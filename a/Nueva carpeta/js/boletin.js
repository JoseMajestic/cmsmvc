(function () {
  const openBtn = document.getElementById('boletin-open');
  const closeBtn = document.getElementById('boletin-close');
  const hero = document.getElementById('boletin-hero');
  const formWrapper = document.getElementById('boletin-form');
  const card = formWrapper ? formWrapper.querySelector('.boletin-card') : null;
  const subscribe = document.getElementById('boletin-subscribe');

  if (!openBtn || !closeBtn || !hero || !formWrapper) return;

  function setHashOn() {
    try {
      history.replaceState(null, '', '#subscribe=on');
    } catch (_) {
      location.hash = 'subscribe=on';
    }
  }

  function clearHash() {
    try {
      history.replaceState(null, '', location.pathname + location.search);
    } catch (_) {
      location.hash = '';
    }
  }

  function openForm() {
    hero.hidden = true;
    formWrapper.hidden = false;
    document.body.classList.add('boletin-abierto');
    setHashOn();

    const focusTarget = document.getElementById('boletin-nombre');
    if (focusTarget) focusTarget.focus();
  }

  function closeForm() {
    formWrapper.hidden = true;
    hero.hidden = false;
    document.body.classList.remove('boletin-abierto');
    clearHash();
    openBtn.focus();
  }

  openBtn.addEventListener('click', openForm);
  closeBtn.addEventListener('click', closeForm);

  document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape' && !formWrapper.hidden) {
      closeForm();
    }
  });

  formWrapper.addEventListener('click', function (e) {
    if (!card) return;
    if (e.target === formWrapper) closeForm();
  });

  if (subscribe) {
    subscribe.addEventListener('change', function () {
      formWrapper.dataset.subscribe = subscribe.checked ? 'on' : 'off';
    });
    formWrapper.dataset.subscribe = subscribe.checked ? 'on' : 'off';
  }

  if (location.hash && location.hash.toLowerCase().includes('subscribe=on')) {
    openForm();
  }
})();
