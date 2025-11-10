<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios | Citas Médicas</title>
    <style>
        body { font-family: system-ui, sans-serif; background:#f8fafc; margin:0; }
        header { background:#0ea5e9; color:#fff; padding:16px 20px; }
        .wrap { max-width:1100px; margin:20px auto; padding:0 16px; }
        h1 { margin:0; font-size:20px; }
        .card { background:#fff; border-radius:12px; box-shadow:0 6px 20px rgba(0,0,0,0.08); padding:16px; margin-bottom:20px; }
        .grid { display:grid; grid-template-columns:1fr 1fr; gap:16px; }
        label { display:block; font-size:13px; color:#334155; margin-bottom:6px; }
        input, select, textarea { width:100%; padding:10px 12px; border:1px solid #cbd5e0; border-radius:8px; font-size:14px; }
        textarea { min-height:80px; }
        .btn { padding:9px 12px; border:none; border-radius:8px; cursor:pointer; font-weight:600; }
        .btn-primary { background:#2563eb; color:#fff; }
        .btn-secondary { background:#6b7280; color:#fff; }
        .btn-danger { background:#dc2626; color:#fff; }
        table { width:100%; border-collapse:collapse; }
        th, td { border-bottom:1px solid #e5e7eb; padding:10px; text-align:left; font-size:14px; }
        th { background:#f1f5f9; }
        .actions { display:flex; gap:8px; }
        .alert { padding:10px; border-radius:8px; margin-bottom:12px; display:none; }
        .alert-error { color:#b91c1c; background:#fee2e2; border:1px solid #fecaca; }
        .alert-ok { color:#065f46; background:#d1fae5; border:1px solid #a7f3d0; }
    </style>
</head>
<body>
    <header>
        <div style="display:flex; align-items:center; justify-content:space-between">
            <h1>Gestión de Usuarios · Citas Médicas</h1>
            <nav style="display:flex; gap:10px; align-items:center">
                <button id="navList" class="btn btn-secondary" title="Lista">Lista</button>
                <button id="navCreate" class="btn btn-primary" title="Crear">Crear</button>
                <button id="logoutBtn" class="btn btn-secondary" title="Cerrar sesión">Cerrar sesión</button>
            </nav>
        </div>
    </header>
    <div class="wrap">
        <div id="alertError" class="alert alert-error"></div>
        <div id="alertOk" class="alert alert-ok"></div>

        <div class="card" id="createCard">
            <h2 style="margin-top:0">Crear nuevo usuario</h2>
            <form id="createForm">
                <div class="grid">
                    <div>
                        <label>Nombre</label>
                        <input type="text" id="c_nombre" required>
                    </div>
                    <div>
                        <label>Correo</label>
                        <input type="email" id="c_email" required>
                    </div>
                    <div>
                        <label>Contraseña</label>
                        <input type="password" id="c_password" placeholder="mínimo 8 caracteres" required>
                    </div>
                    <div>
                        <label>Fecha de nacimiento</label>
                        <input type="date" id="c_fecha_nacimiento" required>
                    </div>
                    <div>
                        <label>Sexo</label>
                        <select id="c_sexo" required>
                            <option value="Masculino">Masculino</option>
                            <option value="Femenino">Femenino</option>
                            <option value="Otro">Otro</option>
                        </select>
                    </div>
                    <div>
                        <label>Contacto de emergencia</label>
                        <input type="text" id="c_contacto_emergencia" placeholder="Teléfono" required>
                    </div>
                    <div>
                        <label>Número de seguro (opcional)</label>
                        <input type="text" id="c_numero_seguro">
                    </div>
                    <div>
                        <label>Historial médico (opcional)</label>
                        <textarea id="c_historial_medico" placeholder="Alergias, antecedentes…"></textarea>
                    </div>
                </div>
                <div style="margin-top:12px">
                    <button type="submit" class="btn btn-primary">Crear usuario</button>
                </div>
            </form>
        </div>

        <div class="card" id="listCard">
            <h2 style="margin-top:0">Listado</h2>
            <div style="overflow:auto">
                <table>
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Correo</th>
                            <th>Sexo</th>
                            <th>Nacimiento</th>
                            <th>Emergencia</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="usersBody"></tbody>
                </table>
            </div>
        </div>

        <div class="card" id="editCard" style="display:none">
            <h2 style="margin-top:0">Editar usuario</h2>
            <form id="editForm">
                <input type="hidden" id="e_id">
                <div class="grid">
                    <div>
                        <label>Nombre</label>
                        <input type="text" id="e_nombre">
                    </div>
                    <div>
                        <label>Correo</label>
                        <input type="email" id="e_email">
                    </div>
                    <div>
                        <label>Contraseña (dejar en blanco para no cambiar)</label>
                        <input type="password" id="e_password" placeholder="mínimo 8 caracteres">
                    </div>
                    <div>
                        <label>Fecha de nacimiento</label>
                        <input type="date" id="e_fecha_nacimiento">
                    </div>
                    <div>
                        <label>Sexo</label>
                        <select id="e_sexo">
                            <option value="Masculino">Masculino</option>
                            <option value="Femenino">Femenino</option>
                            <option value="Otro">Otro</option>
                        </select>
                    </div>
                    <div>
                        <label>Contacto de emergencia</label>
                        <input type="text" id="e_contacto_emergencia">
                    </div>
                    <div>
                        <label>Número de seguro</label>
                        <input type="text" id="e_numero_seguro">
                    </div>
                    <div>
                        <label>Historial médico</label>
                        <textarea id="e_historial_medico"></textarea>
                    </div>
                </div>
                <div style="margin-top:12px; display:flex; gap:8px">
                    <button type="submit" class="btn btn-primary">Guardar cambios</button>
                    <button type="button" id="cancelEdit" class="btn btn-secondary">Cancelar</button>
                </div>
            </form>
        </div>
        <div class="card" id="showCard" style="display:none">
            <h2 style="margin-top:0">Detalle de usuario</h2>
            <div id="showContent"></div>
        </div>
    </div>

    <script>
        const apiBase = '/api/usuarios';
        const alertError = document.getElementById('alertError');
        const alertOk = document.getElementById('alertOk');

        const token = localStorage.getItem('authToken');
        // Si no hay token, redirigir y NO lanzar llamadas para evitar abort del navegador
        if (!token) {
            window.location.href = '/login';
        }

        // Modo de UI según ruta
        const path = window.location.pathname;
        let mode = 'list';
        let currentId = null;
        const mEdit = path.match(/^\/usuarios\/(\d+)\/editar$/);
        const mShow = path.match(/^\/usuarios\/(\d+)$/);
        if (path === '/usuarios/crear') mode = 'create';
        else if (mEdit) { mode = 'edit'; currentId = mEdit[1]; }
        else if (mShow) { mode = 'show'; currentId = mShow[1]; }

        function setDisplay(el, show) { if (el) el.style.display = show ? 'block' : 'none'; }
        const createCard = document.getElementById('createCard');
        const listCard = document.getElementById('listCard');
        const editCard = document.getElementById('editCard');
        const showCard = document.getElementById('showCard');

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

        async function fetchUsers() {
            try {
                const res = await fetch(apiBase, { headers: { 'Authorization': `Bearer ${token}`, 'Accept': 'application/json' } });
                const json = await res.json();
                if (!res.ok) throw new Error(json?.message || 'Error al cargar usuarios');
                const items = json.data.data || json.data || [];
                const tbody = document.getElementById('usersBody');
                tbody.innerHTML = '';
                items.forEach(u => {
                    const tr = document.createElement('tr');
                    tr.innerHTML = `
                        <td>${u.nombre ?? ''}</td>
                        <td>${u.email ?? ''}</td>
                        <td>${u.sexo ?? ''}</td>
                        <td>${u.fecha_nacimiento ?? ''}</td>
                        <td>${u.contacto_emergencia ?? ''}</td>
                        <td class="actions">
                            <button class="btn btn-secondary" data-action="edit" data-id="${u.id}">Editar</button>
                            <button class="btn btn-danger" data-action="delete" data-id="${u.id}">Eliminar</button>
                        </td>`;
                    tbody.appendChild(tr);
                });
            } catch (err) {
                showError(err.message);
            }
        }

        // Crear usuario
        document.getElementById('createForm').addEventListener('submit', async (e) => {
            e.preventDefault();
            const payload = {
                nombre: document.getElementById('c_nombre').value.trim(),
                email: document.getElementById('c_email').value.trim(),
                password: document.getElementById('c_password').value.trim(),
                fecha_nacimiento: document.getElementById('c_fecha_nacimiento').value,
                sexo: document.getElementById('c_sexo').value,
                contacto_emergencia: document.getElementById('c_contacto_emergencia').value.trim(),
                numero_seguro: document.getElementById('c_numero_seguro').value.trim() || null,
                historial_medico: document.getElementById('c_historial_medico').value.trim() || null,
            };
            try {
                const res = await fetch(apiBase, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'Authorization': `Bearer ${token}` },
                    body: JSON.stringify(payload)
                });
                const data = await res.json();
                if (!res.ok) throw new Error(data?.message || 'Error al crear usuario');
                showOk('Usuario creado exitosamente');
                e.target.reset();
                fetchUsers();
            } catch (err) { showError(err.message); }
        });

        // Delegación para Editar/Eliminar
        document.getElementById('usersBody').addEventListener('click', async (e) => {
            const btn = e.target.closest('button');
            if (!btn) return;
            const id = btn.getAttribute('data-id');
            const action = btn.getAttribute('data-action');
            if (action === 'delete') {
                if (!confirm('¿Eliminar este usuario?')) return;
                try {
                    const res = await fetch(`${apiBase}/${id}`, { method: 'DELETE', headers: { 'Authorization': `Bearer ${token}` } });
                    if (!res.ok) throw new Error('Error al eliminar usuario');
                    showOk('Usuario eliminado');
                    fetchUsers();
                } catch (err) { showError(err.message); }
            } else if (action === 'edit') {
                window.location.href = `/usuarios/${id}/editar`;
            }
        });

        // Guardar edición
        document.getElementById('editForm').addEventListener('submit', async (e) => {
            e.preventDefault();
            const id = document.getElementById('e_id').value;
            const payload = {
                nombre: document.getElementById('e_nombre').value.trim() || undefined,
                email: document.getElementById('e_email').value.trim() || undefined,
                fecha_nacimiento: document.getElementById('e_fecha_nacimiento').value || undefined,
                sexo: document.getElementById('e_sexo').value || undefined,
                contacto_emergencia: document.getElementById('e_contacto_emergencia').value.trim() || undefined,
                numero_seguro: document.getElementById('e_numero_seguro').value.trim() || undefined,
                historial_medico: document.getElementById('e_historial_medico').value.trim() || undefined,
            };
            const pwd = document.getElementById('e_password').value.trim();
            if (pwd) payload.password = pwd;
            // limpiar claves undefined
            Object.keys(payload).forEach(k => payload[k] === undefined && delete payload[k]);
            try {
                const res = await fetch(`${apiBase}/${id}`, {
                    method: 'PUT',
                    headers: { 'Content-Type': 'application/json', 'Authorization': `Bearer ${token}` },
                    body: JSON.stringify(payload)
                });
                const data = await res.json();
                if (!res.ok) throw new Error(data?.message || 'Error al actualizar usuario');
                showOk('Cambios guardados');
                document.getElementById('editCard').style.display = 'none';
                fetchUsers();
            } catch (err) { showError(err.message); }
        });
        document.getElementById('cancelEdit').addEventListener('click', () => {
            document.getElementById('editCard').style.display = 'none';
        });

        // Inicializar mostrando según modo
        async function fetchUserAndFill(id) {
            const res = await fetch(`${apiBase}/${id}`, { headers: { 'Authorization': `Bearer ${token}` } });
            const json = await res.json();
            if (!res.ok) throw new Error(json?.message || 'No se pudo cargar el usuario');
            return json.data || json;
        }

        const navList = document.getElementById('navList');
        const navCreate = document.getElementById('navCreate');

        (async function init() {
            setDisplay(createCard, mode === 'create');
            setDisplay(listCard, mode === 'list');
            setDisplay(editCard, mode === 'edit');
            setDisplay(showCard, mode === 'show');

            // Marcar pestaña activa
            setActiveTab();

            if (mode === 'list') {
                await fetchUsers();
            } else if (mode === 'edit' && currentId) {
                try {
                    const u = await fetchUserAndFill(currentId);
                    document.getElementById('e_id').value = u.id;
                    document.getElementById('e_nombre').value = u.nombre ?? '';
                    document.getElementById('e_email').value = u.email ?? '';
                    document.getElementById('e_password').value = '';
                    document.getElementById('e_fecha_nacimiento').value = (u.fecha_nacimiento ?? '').substring(0,10);
                    document.getElementById('e_sexo').value = u.sexo ?? 'Otro';
                    document.getElementById('e_contacto_emergencia').value = u.contacto_emergencia ?? '';
                    document.getElementById('e_numero_seguro').value = u.numero_seguro ?? '';
                    document.getElementById('e_historial_medico').value = u.historial_medico ?? '';
                    window.scrollTo({ top: 0, behavior: 'smooth' });
                } catch (err) { showError(err.message); }
            } else if (mode === 'show' && currentId) {
                try {
                    const u = await fetchUserAndFill(currentId);
                    const el = document.getElementById('showContent');
                    el.innerHTML = `
                        <p><strong>Nombre:</strong> ${u.nombre ?? ''}</p>
                        <p><strong>Correo:</strong> ${u.email ?? ''}</p>
                        <p><strong>Sexo:</strong> ${u.sexo ?? ''}</p>
                        <p><strong>Nacimiento:</strong> ${(u.fecha_nacimiento ?? '').substring(0,10)}</p>
                        <p><strong>Emergencia:</strong> ${u.contacto_emergencia ?? ''}</p>
                        <p><strong>Número de seguro:</strong> ${u.numero_seguro ?? ''}</p>
                        <p><strong>Historial médico:</strong> ${u.historial_medico ?? ''}</p>
                    `;
                } catch (err) { showError(err.message); }
            }
        })();

        // Toggle entre lista y crear sin cambiar de URL
        if (navList) {
            navList.addEventListener('click', async (e) => {
                e.preventDefault();
                mode = 'list';
                setDisplay(createCard, false);
                setDisplay(editCard, false);
                setDisplay(showCard, false);
                setDisplay(listCard, true);
                setActiveTab();
                await fetchUsers();
            });
        }
        if (navCreate) {
            navCreate.addEventListener('click', (e) => {
                e.preventDefault();
                mode = 'create';
                setDisplay(listCard, false);
                setDisplay(editCard, false);
                setDisplay(showCard, false);
                setDisplay(createCard, true);
                setActiveTab();
            });
        }

        // Cambiar estilos de botones según el modo
        function setActiveTab() {
            if (!navList || !navCreate) return;
            const isList = mode === 'list';
            const isCreate = mode === 'create';
            // Lista
            navList.classList.toggle('btn-primary', isList);
            navList.classList.toggle('btn-secondary', !isList);
            // Crear
            navCreate.classList.toggle('btn-primary', isCreate);
            navCreate.classList.toggle('btn-secondary', !isCreate);
        }

        // Cerrar sesión
        const logoutBtn = document.getElementById('logoutBtn');
        if (logoutBtn) {
            logoutBtn.addEventListener('click', async () => {
                try {
                    await fetch('/api/logout', { method: 'POST', headers: { 'Authorization': `Bearer ${token}`, 'Accept': 'application/json' } });
                } catch (_) {
                    // Ignorar errores de red o token inválido al cerrar sesión
                } finally {
                    localStorage.removeItem('authToken');
                    window.location.href = '/login';
                }
            });
        }
    </script>
</body>
</html>