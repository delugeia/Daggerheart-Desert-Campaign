(() => {
  'use strict';
  const imagePath = /\.(?:png|jpe?g|gif|webp|avif|svg)$/i;
  const maximumZoom = 6;
  let dialog;
  let image;
  let message;
  let returnFocus;
  let zoom = 1;
  let panX = 0;
  let panY = 0;
  let drag = null;
  let suppressClick = false;

  function renderView() {
    // Keep the image within reach, without panning a dimension that still fits.
    const availableWidth = Math.max(1, dialog.clientWidth - 48);
    const availableHeight = Math.max(1, dialog.clientHeight - 80);
    const limitX = Math.max(0, (image.offsetWidth * zoom - availableWidth) / 2);
    const limitY = Math.max(0, (image.offsetHeight * zoom - availableHeight) / 2);
    panX = Math.max(-limitX, Math.min(limitX, panX));
    panY = Math.max(-limitY, Math.min(limitY, panY));
    image.style.transform = `translate(${panX}px, ${panY}px) scale(${zoom})`;
    image.classList.toggle('is-zoomed', zoom > 1);
  }

  function finishDrag() {
    if (!drag) return;
    const pointerId = drag.pointerId;
    drag = null;
    image.classList.remove('is-panning');
    if (image.hasPointerCapture(pointerId)) image.releasePointerCapture(pointerId);
  }

  function resetView() {
    finishDrag();
    zoom = 1;
    panX = 0;
    panY = 0;
    suppressClick = false;
    renderView();
  }

  function prepareDialog() {
    if (dialog) return;
    dialog = document.createElement('dialog');
    dialog.className = 'image-lightbox';
    dialog.setAttribute('aria-label', 'Full-size image');
    const close = document.createElement('button');
    close.className = 'image-lightbox-close';
    close.type = 'button';
    close.setAttribute('aria-label', 'Close image');
    close.textContent = '\u2715';
    image = document.createElement('img');
    image.className = 'image-lightbox-image';
    image.alt = '';
    image.draggable = false;
    message = document.createElement('p');
    message.className = 'image-lightbox-error';
    message.textContent = 'This image could not be loaded.';
    message.hidden = true;
    const hint = document.createElement('p');
    hint.className = 'image-lightbox-hint';
    hint.textContent = 'Scroll to zoom · Drag to pan';
    dialog.append(close, image, message, hint);
    document.body.append(dialog);
    close.addEventListener('click', () => dialog.close());
    dialog.addEventListener('pointerdown', () => { suppressClick = false; });
    dialog.addEventListener('click', event => {
      // A drag ending over the shaded area must not dismiss the image.
      if (suppressClick) {
        suppressClick = false;
        return;
      }
      if (event.target === dialog) dialog.close();
    });
    dialog.addEventListener('wheel', event => {
      if (event.target.closest('button') || image.hidden || !image.complete || !image.naturalWidth) return;
      event.preventDefault();
      finishDrag();
      const delta = event.deltaY * (event.deltaMode === 1 ? 16 : event.deltaMode === 2 ? dialog.clientHeight : 1);
      const nextZoom = Math.max(1, Math.min(maximumZoom, zoom * Math.exp(-Math.max(-100, Math.min(100, delta)) * .002)));
      if (nextZoom === zoom) return;
      const bounds = image.getBoundingClientRect();
      const ratio = nextZoom / zoom;
      // Keep the point under the cursor stationary until a pan boundary is reached.
      panX += (event.clientX - (bounds.left + bounds.width / 2)) * (1 - ratio);
      panY += (event.clientY - (bounds.top + bounds.height / 2)) * (1 - ratio);
      zoom = nextZoom;
      renderView();
    }, { passive: false });
    image.addEventListener('dragstart', event => event.preventDefault());
    image.addEventListener('pointerdown', event => {
      if (event.button !== 0 || zoom <= 1) return;
      event.preventDefault();
      drag = { pointerId: event.pointerId, x: event.clientX, y: event.clientY, panX, panY };
      image.setPointerCapture(event.pointerId);
      image.classList.add('is-panning');
    });
    image.addEventListener('pointermove', event => {
      if (!drag || drag.pointerId !== event.pointerId) return;
      const dx = event.clientX - drag.x;
      const dy = event.clientY - drag.y;
      if (Math.hypot(dx, dy) > 4) suppressClick = true;
      panX = drag.panX + dx;
      panY = drag.panY + dy;
      renderView();
    });
    image.addEventListener('pointerup', event => {
      if (drag?.pointerId === event.pointerId) finishDrag();
    });
    image.addEventListener('pointercancel', () => { finishDrag(); suppressClick = false; });
    image.addEventListener('lostpointercapture', finishDrag);
    dialog.addEventListener('close', () => {
      resetView();
      document.documentElement.classList.remove('image-lightbox-open');
      image.removeAttribute('src');
      image.alt = '';
      if (returnFocus && returnFocus.isConnected) returnFocus.focus();
      returnFocus = null;
    });
    image.addEventListener('load', resetView);
    image.addEventListener('error', () => {
      finishDrag();
      message.hidden = false;
      image.hidden = true;
    });
    window.addEventListener('resize', () => { if (dialog.open) resetView(); });
  }

  function open(url, label, trigger) {
    prepareDialog();
    returnFocus = trigger || document.activeElement;
    image.hidden = false;
    message.hidden = true;
    resetView();
    image.alt = label || 'Full-size image';
    dialog.setAttribute('aria-label', label || 'Full-size image');
    image.src = url;
    document.documentElement.classList.add('image-lightbox-open');
    if (!dialog.open) dialog.showModal();
  }

  window.CampaignLightbox = { open };

  for (const link of document.querySelectorAll('a[href]')) {
    if (imagePath.test(new URL(link.href).pathname)) {
      link.removeAttribute('target');
      link.setAttribute('aria-haspopup', 'dialog');
    }
  }

  document.addEventListener('click', event => {
    if (event.defaultPrevented || event.button !== 0 || event.ctrlKey || event.metaKey || event.shiftKey || event.altKey) return;
    const link = event.target.closest('a[href]');
    if (!link || link.hasAttribute('download') || !imagePath.test(new URL(link.href).pathname)) return;
    const label = link.querySelector('img')?.alt || link.getAttribute('aria-label') || 'Full-size image';
    event.preventDefault();
    // In the site shell, cover the whole window, including its navigation.
    // A standalone page (or a restricted local-file frame) uses its own dialog.
    try {
      if (window.parent !== window && window.parent.CampaignLightbox) {
        window.parent.CampaignLightbox.open(link.href, label, link);
        return;
      }
    } catch (_) {
      // Local file-origin isolation may prohibit access to the shell.
    }
    open(link.href, label, link);
  });
})();