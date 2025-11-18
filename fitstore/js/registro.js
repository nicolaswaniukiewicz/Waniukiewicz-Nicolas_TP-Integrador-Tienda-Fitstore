// js/registro.js
// Requiere: auth.js cargado antes
document.getElementById('register-form').addEventListener('submit', function(e) {
  e.preventDefault();

  const name = document.getElementById('name').value.trim();
  const email = document.getElementById('email').value.trim();
  const password = document.getElementById('password').value;
  const confirmPassword = document.getElementById('confirm-password').value;

  if (!name || !email || !password || !confirmPassword) {
    alert('Por favor, completa todos los campos.');
    return;
  }

  const emailPattern = /^[\w.+-]+@[\w.-]+\.[A-Za-z]{2,}$/;
  if (!emailPattern.test(email)) {
    alert('Por favor, ingresa un correo electrónico válido.');
    return;
  }

  if (password.length < 6) {
    alert('La contraseña debe tener al menos 6 caracteres.');
    return;
  }

  if (password !== confirmPassword) {
    alert('Las contraseñas no coinciden.');
    return;
  }

  const res = registerUser({ name, email, password });
  if (!res.ok) {
    alert(res.msg);
    return;
  }

  alert('Cuenta creada con éxito. Ahora iniciá sesión.');
  location.href = 'login.php';
});

// Si ya está logueado, redirigir
(function autoSkipIfLogged() {
  if (isLoggedIn()) location.href = 'index.php';
})();

