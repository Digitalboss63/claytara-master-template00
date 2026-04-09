(() => {
  const settings = window.leadgenTracking || {};
  const endpoint = settings.endpoint;
  const pageId = settings.pageId;
  const blueprintId = settings.blueprintId;

  if (!endpoint) {
    return;
  }

  function emit(eventName, payload = {}) {
    const body = JSON.stringify({
      page_id: pageId,
      blueprint_id: blueprintId,
      event: eventName,
      timestamp: new Date().toISOString(),
      ...payload
    });

    if (navigator.sendBeacon) {
      const blob = new Blob([body], { type: 'application/json' });
      navigator.sendBeacon(endpoint, blob);
    } else {
      fetch(endpoint, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body
      }).catch(() => {});
    }

    window.dispatchEvent(
      new CustomEvent(eventName, {
        detail: JSON.parse(body)
      })
    );
  }

  document.addEventListener('click', (event) => {
    const cta = event.target.closest('[data-leadgen-cta]');
    if (!cta) {
      return;
    }
    emit('leadgen_cta_click', {
      anchor: cta.getAttribute('href') || '#',
      label: cta.textContent?.trim() || '',
      source: cta.getAttribute('data-leadgen-cta') || 'cta'
    });
  });

  const formBlock = document.querySelector('[data-leadgen-block="form"] form');
  if (formBlock) {
    let started = false;
    formBlock.addEventListener('focusin', () => {
      if (started) return;
      started = true;
      emit('leadgen_form_start', { form_id: formBlock.getAttribute('id') || 'leadgen-form' });
    });

    formBlock.addEventListener('submit', () => {
      emit('leadgen_form_submit', { form_id: formBlock.getAttribute('id') || 'leadgen-form' });
    });
  }
})();
