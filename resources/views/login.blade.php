<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ingreso | Citas Médicas</title>
    <style>
        body { font-family: system-ui, sans-serif; background: #f7fafc; margin: 0; }
        .container { max-width: 420px; margin: 60px auto; background: #fff; padding: 24px; border-radius: 12px; box-shadow: 0 6px 20px rgba(0,0,0,0.08); }
        h1 { font-size: 20px; margin: 0 0 6px; }
        p { color: #4a5568; margin: 0 0 18px; }
        label { display:block; font-size: 14px; color:#2d3748; margin-bottom:6px; }
        input { width:100%; padding:10px 12px; border:1px solid #cbd5e0; border-radius:8px; font-size:14px; }
        .field { margin-bottom:14px; }
        .btn { width:100%; padding:10px 12px; background:#2563eb; color:#fff; border:none; border-radius:8px; font-weight:600; cursor:pointer; }
        .btn:hover { background:#1d4ed8; }
        .error { color:#b91c1c; background:#fee2e2; border:1px solid #fecaca; padding:10px; border-radius:8px; margin-bottom:12px; display:none; }
        .success { color:#065f46; background:#d1fae5; border:1px solid #a7f3d0; padding:10px; border-radius:8px; margin-bottom:12px; display:none; }
        .helper { font-size:12px; color:#718096; margin-top:6px; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Acceso al sistema de Citas Médicas</h1>
        <p>Ingresa con tu correo y contraseña para gestionar usuarios y citas.</p>

        <div id="alertError" class="error"></div>
        <div id="alertOk" class="success"></div>

        <form id="loginForm">
            <div class="field">
                <label for="email">Correo electrónico</label>
                <input type="email" id="email" name="email" placeholder="test@example.com" required>
                <div class="helper">Usuario de prueba: <code>test@example.com</code></div>
            </div>
            <div class="field">
                <label for="password">Contraseña</label>
                <input type="password" id="password" name="password" placeholder="password123" required>
                <div class="helper">Contraseña de prueba: <code>password123</code></div>
            </div>
            <button type="submit" class="btn">Ingresar</button>
        </form>
    </div>

    <script>
        const apiBase = '/api';
        const form = document.getElementById('loginForm');
        const alertError = document.getElementById('alertError');
        const alertOk = document.getElementById('alertOk');

        // Si ya hay token, ir directo a usuarios
        const existingToken = localStorage.getItem('authToken');
        if (existingToken) {
            window.location.href = '/usuarios';
        }

        function showError(msg) {
            alertOk.style.display = 'none';
            alertError.textContent = msg;
            alertError.style.display = 'block';
        }
        function showOk(msg) {
            alertError.style.display = 'none';
            alertOk.textContent = msg;
            alertOk.style.display = 'block';
        }

        form.addEventListener('submit', async (e) => {
            e.preventDefault();
            const email = document.getElementById('email').value.trim();
            const password = document.getElementById('password').value.trim();
            try {
                const res = await fetch(`${apiBase}/login`, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ email, password })
                });
                const data = await res.json();
                if (!res.ok) {
                    throw new Error(data?.message || 'Error al iniciar sesión');
                }
                localStorage.setItem('authToken', data.token);
                showOk('Ingreso exitoso. Redirigiendo...');
                setTimeout(() => { window.location.href = '/usuarios'; }, 600);
            } catch (err) {
                showError(err.message);
            }
        });
    </script>
</body>
</html>