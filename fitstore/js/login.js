// js/login.js
// Requiere: auth.js cargado antes
document.getElementById('login-form').addEventListener('submit', function(e) {
  e.preventDefault();

  const email = document.getElementById('email').value.trim();
  const password = document.getElementById('password').value;

  if (!email || !password) {
    alert('Por favor complete todos los campos');
    return;
  }

  const emailPattern = /^[\w.+-]+@[\w.-]+\.[A-Za-z]{2,}$/;
  if (!emailPattern.test(email)) {
    alert('Por favor ingrese un correo válido');
    return;
  }

  const res = loginUser({ email, password });
  if (!res.ok) {
    alert(res.msg);
    return;
  }

  // Redirigir al destino que venía en ?next= o al index
  const params = new URLSearchParams(location.search);
  const next = params.get('next') || 'index.php';
  location.href = next;
});

// Si ya está logueado, entrar directo al index
(function autoSkipIfLogged() {
  if (isLoggedIn()) location.href = 'index.php';
})();
