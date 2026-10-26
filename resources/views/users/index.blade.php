@extends('layout.app')

@section('title', 'Administración de Usuarios')

@section('content')
<style>
    .inv * { box-sizing: border-box; }
    .inv { max-width: 1100px; margin: 0 auto; padding: 32px 20px 60px; font-family: system-ui, -apple-system, "Segoe UI", Roboto, sans-serif; color: #1e293b; }

    .inv-hero { background: linear-gradient(135deg, #0D868C 0%, #0891b2 100%); border-radius: 18px; padding: 28px 32px; color: #fff; display: flex; align-items: center; justify-content: space-between; gap: 20px; flex-wrap: wrap; box-shadow: 0 10px 25px -8px rgba(79,70,229,.5); }
    .inv-hero h1 { margin: 0; font-size: 28px; font-weight: 800; }
    .inv-hero p { margin: 6px 0 0; font-size: 14px; opacity: .85; }
    .inv-top { display: flex; gap: 10px; flex-wrap: wrap; }
    .inv-new { display: inline-flex; align-items: center; gap: 8px; background: #fff; color: #080808; padding: 11px 20px; border-radius: 10px; font-weight: 700; font-size: 14px; text-decoration: none; transition: transform .15s, box-shadow .15s; }
    .inv-new:hover { transform: translateY(-2px); box-shadow: 0 6px 14px rgba(0,0,0,.2); }
    .inv-ghost { background: rgba(255,255,255,.18); color: #fff; border: 1px solid rgba(255,255,255,.4); }

    .inv-flash { margin-top: 18px; padding: 12px 16px; border-radius: 10px; background: #d1fae5; color: #065f46; font-weight: 600; font-size: 14px; border: 1px solid #6ee7b7; }

    .inv-bar { display: flex; align-items: center; justify-content: space-between; gap: 16px; margin: 24px 0 14px; flex-wrap: wrap; }
    .inv-count { font-size: 14px; color: #64748b; }
    .inv-count b { color: #0f172a; font-size: 18px; }
    .inv-search { padding: 10px 14px; width: 280px; max-width: 100%; border: 1px solid #cbd5e1; border-radius: 10px; font-size: 14px; outline: none; background: #fff; }
    .inv-search:focus { border-color: #6366f1; box-shadow: 0 0 0 3px rgba(99,102,241,.2); }

    .inv-card { background: #fff; border-radius: 16px; box-shadow: 0 4px 16px rgba(15,23,42,.08); border: 1px solid #e2e8f0; overflow: hidden; }
    .inv-scroll { overflow-x: auto; }
    .inv-table { width: 100%; border-collapse: collapse; min-width: 700px; }
    .inv-table thead th { background: #0f172a; color: #e2e8f0; padding: 15px 22px; text-align: left; font-size: 12px; text-transform: uppercase; letter-spacing: .08em; font-weight: 600; }
    .inv-table tbody td { padding: 16px 22px; font-size: 14px; border-bottom: 1px solid #f1f5f9; vertical-align: middle; }
    .inv-table tbody tr:nth-child(even) { background: #f8fafc; }
    .inv-table tbody tr:hover { background: #eef2ff; }
    .inv-table tbody tr:last-child td { border-bottom: none; }
    .inv-r { text-align: right !important; }

    .inv-code { font-weight: 700; color: #6366f1; }
    .inv-user { display: inline-flex; align-items: center; gap: 12px; font-weight: 600; color: #0f172a; }
    .inv-avatar { width: 36px; height: 36px; border-radius: 50%; background: linear-gradient(135deg, #6366f1, #8b5cf6); color: #fff; display: inline-flex; align-items: center; justify-content: center; font-weight: 800; font-size: 15px; }
    .inv-you { background: #dbeafe; color: #1d4ed8; font-size: 11px; font-weight: 700; padding: 2px 8px; border-radius: 999px; }
    .inv-muted { color: #64748b; }

    .inv-actions { display: inline-flex; gap: 8px; }
    .inv-btn { display: inline-flex; align-items: center; gap: 6px; padding: 8px 14px; border: none; border-radius: 8px; font-size: 13px; font-weight: 600; color: #fff; text-decoration: none; cursor: pointer; font-family: inherit; transition: transform .12s, filter .12s; }
    .inv-btn:hover { transform: translateY(-1px); filter: brightness(1.1); }
    .inv-btn svg { width: 15px; height: 15px; }
    .inv-edit { background: #2563eb; }
    .inv-del { background: #dc2626; }
    .inv-btn[disabled] { background: #cbd5e1; cursor: not-allowed; transform: none; filter: none; }

    .inv-empty { text-align: center; padding: 50px 20px; color: #94a3b8; }
</style>

<div class="inv">
    <div class="inv-hero">
        <div>
            <h1>Administración de Usuarios</h1>
            <p>Gestiona quién tiene acceso al sistema.</p>
        </div>
        <div class="inv-top">
            <a href="/products/show" class="inv-new inv-ghost">Ver productos</a>
            <a href="/users/create" class="inv-new">
                <svg width="18" height="18" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd"/></svg>
                Nuevo Usuario
            </a>
        </div>
    </div>

    @if (session('ok'))
        <div class="inv-flash">{{ session('ok') }}</div>
    @endif

    <div class="inv-bar">
        <div class="inv-count"><b>{{ $usuarios->count() }}</b> usuarios registrados</div>
        <input type="text" id="invSearch" class="inv-search" placeholder="Buscar por nombre o correo...">
    </div>

    <div class="inv-card">
        <div class="inv-scroll">
            <table class="inv-table" id="invTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Usuario</th>
                        <th>Correo</th>
                        <th>Registrado</th>
                        <th class="inv-r">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($usuarios as $u)
                    <tr>
                        <td class="inv-code">#{{ $u->id }}</td>
                        <td>
                            <span class="inv-user">
                                <span class="inv-avatar">{{ strtoupper(substr($u->name, 0, 1)) }}</span>
                                {{ $u->name }}
                                @if ($u->id === auth()->id())
                                    <span class="inv-you">Tú</span>
                                @endif
                            </span>
                        </td>
                        <td class="inv-muted">{{ $u->email }}</td>
                        <td class="inv-muted">{{ $u->created_at?->format('d/m/Y') }}</td>
                        <td class="inv-r">
                            <div class="inv-actions">
                                <a class="inv-btn inv-edit" href="/users/edit/{{ $u->id }}">
                                    <svg viewBox="0 0 20 20" fill="currentColor"><path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z"/><path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd"/></svg>
                                    Editar
                                </a>
                                <button type="button" class="inv-btn inv-del"
                                    url="/users/destroy/{{ $u->id }}"
                                    token="{{ csrf_token() }}"
                                    onclick="destroyUser(this)"
                                    @if ($u->id === auth()->id()) disabled title="No puedes eliminar tu propia cuenta" @endif>
                                    <svg viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                                    Eliminar
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="5" class="inv-empty">No hay usuarios registrados.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.getElementById('invSearch').addEventListener('input', function () {
        const q = this.value.toLowerCase();
        document.querySelectorAll('#invTable tbody tr').forEach(function (tr) {
            tr.style.display = tr.textContent.toLowerCase().includes(q) ? '' : 'none';
        });
    });

    function destroyUser(btn) {
        const url   = btn.getAttribute('url');
        const token = btn.getAttribute('token');

        Swal.fire({
            title: '¿Eliminar usuario?',
            text: 'Esta acción no se puede deshacer.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc2626',
            cancelButtonColor: '#64748b',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then(function (result) {
            if (!result.isConfirmed) return;

            fetch(url, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': token,
                    'Accept': 'application/json',
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: new URLSearchParams({ _method: 'DELETE' })
            })
            .then(function (r) {
                return r.json().then(function (d) {
                    if (!r.ok) throw new Error(d.message || 'Error ' + r.status);
                    return d;
                });
            })
            .then(function () {
                return Swal.fire({ icon: 'success', title: 'Usuario eliminado', timer: 1200, showConfirmButton: false });
            })
            .then(function () { location.reload(); })
            .catch(function (e) { Swal.fire('Error', e.message, 'error'); });
        });
    }
</script>
@endsection