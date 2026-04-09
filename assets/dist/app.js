/* Claytara UI JS
   - Sticky nav (handled by CSS)
   - Mobile menu toggle
   - Smooth scroll for anchor links
*/
(function () {
  const burger = document.querySelector('.ct-burger');
  const mobile = document.getElementById('ct-mobile-menu');

  function setExpanded(val) {
    burger.setAttribute('aria-expanded', val ? 'true' : 'false');
  }

  function openMenu() {
    if (!mobile) return;
    mobile.hidden = false;
    document.body.classList.add('ct-menu-open');
    setExpanded(true);
  }

  function closeMenu() {
    if (!mobile) return;
    mobile.hidden = true;
    document.body.classList.remove('ct-menu-open');
    setExpanded(false);
  }

  if (burger && mobile) {
    burger.addEventListener('click', () => {
      const isOpen = !mobile.hidden;
      if (isOpen) closeMenu();
      else openMenu();
    });

    // Close when clicking a mobile link
    mobile.addEventListener('click', (e) => {
      const t = e.target;
      if (t && t.matches('a')) closeMenu();
    });

    // Close on ESC
    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape') closeMenu();
    });
  }

  // Smooth scroll (respect reduced motion)
  const prefersReduced = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  function smoothToHash(hash) {
    const el = document.querySelector(hash);
    if (!el) return;

    const header = document.querySelector('.ct-header');
    const headerH = header ? header.offsetHeight : 0;

    const y = el.getBoundingClientRect().top + window.pageYOffset - headerH - 12;

    if (prefersReduced) {
      window.scrollTo(0, y);
      return;
    }

    window.scrollTo({ top: y, behavior: 'smooth' });
  }

  document.addEventListener('click', (e) => {
    const a = e.target && e.target.closest ? e.target.closest('a[href^="#"]') : null;
    if (!a) return;

    const hash = a.getAttribute('href');
    if (!hash || hash === '#') return;

    const target = document.querySelector(hash);
    if (!target) return;

    e.preventDefault();
    smoothToHash(hash);

    // keep URL nice
    history.pushState(null, '', hash);
  });

  // If page loads with hash, offset it
  window.addEventListener('load', () => {
    if (location.hash) smoothToHash(location.hash);
  });
})();