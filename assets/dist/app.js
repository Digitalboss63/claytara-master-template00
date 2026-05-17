/* Claytara Master — UI JS v1.1 */
(function () {
  'use strict';

  /* ── Mobile menu ── */
  var burger = document.querySelector('.ct-burger');
  var mobileMenu = document.getElementById('ct-mobile-menu');

  function setExpanded(val) {
    if (burger) burger.setAttribute('aria-expanded', val ? 'true' : 'false');
  }

  function openMenu() {
    if (!mobileMenu) return;
    mobileMenu.hidden = false;
    document.body.classList.add('ct-menu-open');
    setExpanded(true);
  }

  function closeMenu() {
    if (!mobileMenu) return;
    mobileMenu.hidden = true;
    document.body.classList.remove('ct-menu-open');
    setExpanded(false);
  }

  if (burger && mobileMenu) {
    burger.addEventListener('click', function () {
      var isOpen = !mobileMenu.hidden;
      if (isOpen) closeMenu(); else openMenu();
    });

    mobileMenu.addEventListener('click', function (e) {
      if (e.target && e.target.matches('a')) closeMenu();
    });

    document.addEventListener('keydown', function (e) {
      if (e.key === 'Escape') closeMenu();
    });
  }

  /* ── Smooth scroll (respects prefers-reduced-motion) ── */
  var prefersReduced = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  function smoothToHash(hash) {
    var el = document.querySelector(hash);
    if (!el) return;
    var header = document.querySelector('.ct-header');
    var headerH = header ? header.offsetHeight : 0;
    var y = el.getBoundingClientRect().top + window.pageYOffset - headerH - 16;
    if (prefersReduced) { window.scrollTo(0, y); return; }
    window.scrollTo({ top: y, behavior: 'smooth' });
  }

  document.addEventListener('click', function (e) {
    var a = e.target && e.target.closest ? e.target.closest('a[href^="#"]') : null;
    if (!a) return;
    var hash = a.getAttribute('href');
    if (!hash || hash === '#') return;
    var target = document.querySelector(hash);
    if (!target) return;
    e.preventDefault();
    smoothToHash(hash);
    history.pushState(null, '', hash);
  });

  window.addEventListener('load', function () {
    if (location.hash) smoothToHash(location.hash);
  });
})();
