@extends('layout.app')

@section('title', 'Gestión de Productos')

@section('content')
<style>
    .inv * { box-sizing: border-box; }
    .inv { max-width: 1100px; margin: 0 auto; padding: 32px 20px 60px; font-family: system-ui, -apple-system, "Segoe UI", Roboto, sans-serif; color: #1e293b; }

    /* Banner */
    .inv-hero { background: linear-gradient(135deg, #0D868C 0%, #0891b2 100%); border-radius: 18px; padding: 28px 32px; color: #fff; display: flex; align-items: center; justify-content: space-between; gap: 20px; flex-wrap: wrap; box-shadow: 0 10px 25px -8px rgba(13,134,140,.5); }
    .inv-hero h1 { margin: 0; font-size: 28px; font-weight: 800; }
    .inv-hero p { margin: 6px 0 0; font-size: 14px; opacity: .85; }
    .inv-top { display: flex; gap: 10px; flex-wrap: wrap; align-items: center; }
    .inv-new { display: inline-flex; align-items: center; gap: 8px; background: #fff; color: #0A0A0A; padding: 11px 20px; border-radius: 10px; font-weight: 700; font-size: 14px; text-decoration: none; transition: transform .15s, box-shadow .15s; }
    .inv-new:hover { transform: translateY(-2px); box-shadow: 0 6px 14px rgba(0,0,0,.2); }

    /* Barra superior */
    .inv-bar { display: flex; align-items: center; justify-content: space-between; gap: 16px; margin: 24px 0 14px; flex-wrap: wrap; }
    .inv-count { font-size: 14px; color: #64748b; }
    .inv-count b { color: #0f172a; font-size: 18px; }
    .inv-search { padding: 10px 14px; width: 280px; max-width: 100%; border: 1px solid #cbd5e1; border-radius: 10px; font-size: 14px; outline: none; background: #fff; }
    .inv-search:focus { border-color: #0D868C; box-shadow: 0 0 0 3px rgba(13,134,140,.2); }

    /* Tabla */
    .inv-card { background: #fff; border-radius: 16px; box-shadow: 0 4px 16px rgba(15,23,42,.08); border: 1px solid #e2e8f0; overflow: hidden; }
    .inv-scroll { overflow-x: auto; }
    .inv-table { width: 100%; border-collapse: collapse; min-width: 700px; }
    .inv-table thead th { background: #0f172a; color: #e2e8f0; padding: 15px 22px; text-align: left; font-size: 12px; text-transform: uppercase; letter-spacing: .08em; font-weight: 600; }
    .inv-table tbody td { padding: 16px 22px; font-size: 14px; border-bottom: 1px solid #f1f5f9; vertical-align: middle; }
    .inv-table tbody tr:nth-child(even) { background: #f8fafc; }
    .inv-table tbody tr:hover { background: #ecfeff; }
    .inv-table tbody tr:last-child td { border-bottom: none; }
    .inv-r { text-align: right !important; }

    .inv-code { font-weight: 700; color: #0A0A0A; }
    .inv-name { font-weight: 600; color: #0f172a; }
    .inv-price { font-weight: 800; color: #059669; font-size: 15px; }

    .inv-brand { display: inline-flex; align-items: center; gap: 10px; font-weight: 600; }
    .inv-avatar { width: 32px; height: 32px; border-radius: 50%; background: #cffafe; color: #0D868C; display: inline-flex; align-items: center; justify-content: center; font-weight: 800; font-size: 14px; }

    /* Botones */
    .inv-actions { display: inline-flex; gap: 8px; }
    .inv-btn { display: inline-flex; align-items: center; gap: 6px; padding: 8px 14px; border: none; border-radius: 8px; font-size: 13px; font-weight: 600; color: #fff; text-decoration: none; cursor: pointer; font-family: inherit; transition: transform .12s, filter .12s; }
    .inv-btn:hover { transform: translateY(-1px); filter: brightness(1.1); }
    .inv-btn svg { width: 15px; height: 15px; }
    .inv-edit { background: #2563eb; }
    .inv-del { background: #dc2626; }

    .inv-empty { text-align: center; padding: 50px 20px; color: #94a3b8; }
</style>

<div class="inv">
    <div class="inv-hero">
        <div>
            <h1>Inventario de Productos</h1>
            <p>Administra el catálogo general, precios y asignación de marcas.</p>
        </div>
        <div class="inv-top">
            <a href="/users" class="inv-new">Usuarios</a>
            <a href="/products/create" class="inv-new">
                <svg width="18" height="18" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd"/></svg>
                Nuevo Producto
            </a>
            <form action="/logout" method="POST" style="margin:0">
                @csrf
                <button type="submit" class="inv-new" style="border:none; cursor:pointer; font-family:inherit;">
                    Cerrar sesión
                </button>
            </form>
        </div>
    </div>

    <div class="inv-bar">
        <div class="inv-count"><b>{{ $productos->count() }}</b> productos registrados</div>
        <input type="text" id="invSearch" class="inv-search" placeholder="Buscar por código, nombre o marca...">
    </div>

    <div class="inv-card">
        <div class="inv-scroll">
            <table class="inv-table" id="invTable">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Producto</th>
                        <th>Precio</th>
                        <th>Marca</th>
                        <th class="inv-r">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($productos as $item)
                    <tr>
                        <td class="inv-code">#{{ $item->codigo }}</td>
                        <td class="inv-name">{{ $item->nombre }}</td>
                        <td class="inv-price">$ {{ number_format($item->precio, 2) }}</td>
                        <td>
                            <span class="inv-brand">
                                <span class="inv-avatar">{{ strtoupper(substr($item->marca, 0, 1)) }}</span>
                                {{ $item->marca }}
                            </span>
                        </td>
                        <td class="inv-r">
                            <div class="inv-actions">
                                <a class="inv-btn inv-edit" href="/products/edit/{{ $item->codigo }}">
                                    <svg viewBox="0 0 20 20" fill="currentColor"><path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z"/><path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd"/></svg>
                                    Editar
                                </a>
                                <button type="button" class="inv-btn inv-del"
                                    url="/products/destroy/{{ $item->codigo }}"
                                    token="{{ csrf_token() }}"
                                    onclick="destroy(this)">
                                    <svg viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                                    Eliminar
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="5" class="inv-empty">No hay productos registrados.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // Buscador
    document.getElementById('invSearch').addEventListener('input', function () {
        const q = this.value.toLowerCase();
        document.querySelectorAll('#invTable tbody tr').forEach(function (tr) {
            tr.style.display = tr.textContent.toLowerCase().includes(q) ? '' : 'none';
        });
    });

    // Confirmar y eliminar
    function destroy(btn) {
        const url   = btn.getAttribute('url');
        const token = btn.getAttribute('token');

        Swal.fire({
            title: '¿Eliminar producto?',
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
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: new URLSearchParams({ _method: 'DELETE' })
            })
            .then(function (r) {
                if (!r.ok) throw new Error('Error ' + r.status);
                return Swal.fire({ icon: 'success', title: 'Producto eliminado', timer: 1200, showConfirmButton: false });
            })
            .then(function () { location.reload(); })
            .catch(function () {
                Swal.fire('Error', 'No se pudo eliminar el producto.', 'error');
            });
        });
    }
</script>
@endsection