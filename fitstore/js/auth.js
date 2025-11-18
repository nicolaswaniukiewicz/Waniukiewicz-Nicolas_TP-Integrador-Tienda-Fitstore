// js/auth.js
// Manejo simple de usuarios y sesión con localStorage

const LS_KEYS = {
  USERS: 'fitstore_users',     // lista de usuarios [{name, email, password}]
  SESSION: 'fitstore_session', // {email}
};

// =====================
// Helpers de almacenamiento
// =====================
function getUsers() {
  try {
    return JSON.parse(localStorage.getItem(LS_KEYS.USERS)) || [];
  } catch {
    return [];
  }
}

function setUsers(list) {
  localStorage.setItem(LS_KEYS.USERS, JSON.stringify(list));
}

function setSession(email) {
  localStorage.setItem(LS_KEYS.SESSION, JSON.stringify({ email }));
}

function getSession() {
  try {
    return JSON.parse(localStorage.getItem(LS_KEYS.SESSION));
  } catch {
    return null;
  }
}

function clearSession() {
  localStorage.removeItem(LS_KEYS.SESSION);
}

// =====================
// Lógica de usuarios
// =====================
function findUserByEmail(email) {
  const users = getUsers();
  return users.find(u => u.email === email) || null;
}

// Registrar usuario nuevo
// Recibe: { name, email, password }
// Retorna: { ok: true } o { ok: false, msg: '...' }
function registerUser({ name, email, password }) {
  const users = getUsers();

  if (findUserByEmail(email)) {
    return { ok: false, msg: 'Ya existe un usuario con ese correo.' };
  }

  users.push({ name, email, password });
  setUsers(users);
  return { ok: true };
}

// Validar login
// Recibe: { email, password }
// Retorna: { ok: true, user } o { ok: false, msg: '...' }
function loginUser({ email, password }) {
  const u = findUserByEmail(email);
  if (!u) return { ok: false, msg: 'Usuario no encontrado.' };
  if (u.password !== password) return { ok: false, msg: 'Contraseña incorrecta.' };

  setSession(u.email);
  return { ok: true, user: u };
}

// ¿Hay sesión?
function isLoggedIn() {
  return !!getSession();
}

// Obtener usuario logueado actual
function getCurrentUser() {
  const s = getSession();
  if (!s) return null;
  return findUserByEmail(s.email) || null;
}

// Cerrar sesión y volver al inicio de login
function logoutAndGoHome() {
  clearSession();
  location.href = 'login.php';
}

// =====================
// Protección de páginas
// =====================
//
// Se usa en las páginas “protegidas” con:
//   <script src="js/auth.js"></script>
//   <script> requireAuth(); </script>
//
function requireAuth() {
  const u = getCurrentUser();
  if (!u) {
    // armo la URL de retorno (por ejemplo /fitstore/listado_box.php?id=2)
    const next = location.pathname + location.search;
    location.href = 'login.php?next=' + encodeURIComponent(next);
  }
}
