document.addEventListener('DOMContentLoaded', () => {
  const navToggle = document.querySelector('.nav-toggle');
  const navMenu = document.querySelector('.nav-menu');
  if (navToggle && navMenu) {
    navToggle.addEventListener('click', () => navMenu.classList.toggle('open'));
  }

  // Cookie consent banner: stores consent decision in localStorage.
  const cookieBanner = document.getElementById('cookieBanner');
  const consent = localStorage.getItem('cookieConsent');
  if (cookieBanner && !consent) cookieBanner.style.display = 'block';

  document.querySelectorAll('[data-cookie-action]').forEach(btn => {
    btn.addEventListener('click', () => {
      const action = btn.getAttribute('data-cookie-action');
      localStorage.setItem('cookieConsent', action);
      if (cookieBanner) cookieBanner.style.display = 'none';

      // Placeholder: load analytics scripts only if action === 'accept'.
      // Example future integration: Google Analytics / Matomo loader here.
    });
  });

  // Lightweight page view tracking.
  const body = document.body;
  if (body) {
    const payload = {
      page_visited: window.location.pathname,
      timestamp: new Date().toISOString(),
      referral_source: document.referrer || 'direct',
      device_type: /Mobi|Android/i.test(navigator.userAgent) ? 'mobile' : 'desktop',
      browser: navigator.userAgent
    };
    fetch('track.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify(payload)
    }).catch(() => {
      // Silently fail if tracking endpoint is unavailable.
    });
  }

  // Demo course progress localStorage helper.
  const saveBtn = document.getElementById('saveProgressBtn');
  const lessonInput = document.getElementById('lessonInput');
  const status = document.getElementById('progressStatus');
  if (saveBtn && lessonInput && status) {
    const savedLesson = localStorage.getItem('demoLastLesson');
    if (savedLesson) status.textContent = `Last saved lesson: ${savedLesson}`;

    saveBtn.addEventListener('click', () => {
      localStorage.setItem('demoLastLesson', lessonInput.value || 'Module 1 / Lesson 1');
      status.textContent = `Last saved lesson: ${localStorage.getItem('demoLastLesson')}`;
    });
  }
});
