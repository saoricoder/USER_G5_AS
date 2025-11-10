<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Guardar Token</title>
    <style>
        body { font-family: system-ui, -apple-system, Segoe UI, Roboto, Ubuntu, Cantarell, Noto Sans, Arial, "Apple Color Emoji", "Segoe UI Emoji"; margin: 0; padding: 2rem; background: #f7fafc; }
        .card { max-width: 640px; margin: 0 auto; background: #fff; border-radius: 12px; box-shadow: 0 8px 24px rgba(0,0,0,0.08); padding: 24px; }
        h1 { margin-top: 0; font-size: 1.5rem; }
        label { display: block; font-weight: 600; margin-bottom: 8px; }
        input { width: 100%; padding: 10px 12px; border: 1px solid #cbd5e0; border-radius: 8px; font-size: 1rem; }
        .actions { margin-top: 16px; display: flex; gap: 12px; }
        button { padding: 10px 16px; border: none; border-radius: 8px; background: #2563eb; color: white; cursor: pointer; }
        button.secondary { background: #64748b; }
        .notice { background: #f1f5f9; border: 1px solid #e2e8f0; padding: 12px; border-radius: 8px; font-size: .95rem; }
        .ok { color: #16a34a; }
        .error { color: #dc2626; }
    </style>
</head>
<body>
    <div class="card">
        <h1>Guardar Token de Autenticación</h1>
        <p class="notice">Puedes pasar el token por query string (<code>?token=...</code>) o pegarlo manualmente debajo. Al guardarlo, serás redirigido a <code>/usuarios</code>.</p>

        <div id="status"></div>

        <label for="tokenInput">Token (Bearer)</label>
        <input type="text" id="tokenInput" placeholder="pegue aquí el token" />

        <div class="actions">
            <button id="saveBtn">Guardar token</button>
            <button class="secondary" id="clearBtn">Borrar token</button>
        </div>
    </div>

    <script>
        const params = new URLSearchParams(window.location.search);
        const qsToken = params.get('token');
        const status = document.getElementById('status');
        const input = document.getElementById('tokenInput');
        const saveBtn = document.getElementById('saveBtn');
        const clearBtn = document.getElementById('clearBtn');

        const setOk = (msg) => status.innerHTML = `<p class="ok">${msg}</p>`;
        const setErr = (msg) => status.innerHTML = `<p class="error">${msg}</p>`;

        // Si viene por query string, guardar directo
        if (qsToken) {
            try {
                localStorage.setItem('authToken', qsToken);
                setOk('Token guardado desde query string. Redirigiendo...');
                setTimeout(() => window.location.href = '/usuarios', 800);
            } catch (e) {
                setErr('No se pudo guardar el token desde la URL.');
            }
        } else {
            // Prefill si ya existe
            const existing = localStorage.getItem('authToken');
            if (existing) input.value = existing;
        }

        saveBtn.addEventListener('click', () => {
            const token = input.value.trim();
            if (!token) return setErr('Debes ingresar un token.');
            try {
                localStorage.setItem('authToken', token);
                setOk('Token guardado correctamente. Redirigiendo...');
                setTimeout(() => window.location.href = '/usuarios', 800);
            } catch (e) {
                setErr('No se pudo guardar el token en el navegador.');
            }
        });

        clearBtn.addEventListener('click', () => {
            localStorage.removeItem('authToken');
            input.value = '';
            setOk('Token borrado de localStorage.');
        });
    </script>
</body>
</html>