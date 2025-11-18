(function(){
  const body = document.body;
  const btn = document.getElementById('modo-toggle');

  // Si el botón no existe en esta página, salimos (evita errores en páginas sin header)
  if(!btn) return;

  // Preferencia guardada o preferencia del sistema como fallback
  const preferSaved = localStorage.getItem('modo'); 
  const preferSystemLight = window.matchMedia &&
    window.matchMedia('(prefers-color-scheme: light)').matches;

  if(preferSaved === 'light' || (!preferSaved && preferSystemLight)){
    body.classList.add('light-mode');
  }

  // Sincroniza iconos del botón según estado actual
  function syncButton(){
    const light = body.classList.contains('light-mode');
    btn.setAttribute('aria-pressed', light ? 'true' : 'false');
    btn.title = light ? 'Cambiar a modo oscuro' : 'Cambiar a modo claro';
  }
  syncButton();

  // Toggle al clicar
  btn.addEventListener('click', () => {
    body.classList.toggle('light-mode');
    const light = body.classList.contains('light-mode');
    localStorage.setItem('modo', light ? 'light' : 'dark');
    syncButton();
  });
})();
