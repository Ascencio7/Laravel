@extends('layout.app')

@section('title', 'Modificar Producto')

@section('content')
<style>
    .frm * { box-sizing: border-box; }
    .frm { max-width: 760px; margin: 0 auto; padding: 32px 20px 60px; font-family: system-ui, -apple-system, "Segoe UI", Roboto, sans-serif; color: #1e293b; }

    /* Banner */
    .frm-hero { background: linear-gradient(135deg, #0D868C  0%, #27EBF5 100%); border-radius: 18px; padding: 26px 32px; color: #fff; display: flex; align-items: center; justify-content: space-between; gap: 20px; flex-wrap: wrap; box-shadow: 0 10px 25px -8px rgba(79,70,229,.5); }
    .frm-hero h1 { margin: 0; font-size: 26px; font-weight: 800; }
    .frm-hero p { margin: 6px 0 0; font-size: 14px; opacity: .85; }
    .frm-tag { background: rgba(255,255,255,.2); border: 1px solid rgba(255,255,255,.35); padding: 8px 16px; border-radius: 999px; font-weight: 700; font-size: 14px; }

    /* Tarjeta */
    .frm-card { background: #fff; border: 1px solid #e2e8f0; border-radius: 16px; box-shadow: 0 4px 16px rgba(15,23,42,.08); padding: 28px; margin-top: 24px; }
    .frm-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
    .frm-full { grid-column: 1 / -1; }
    @media (max-width: 600px) { .frm-grid { grid-template-columns: 1fr; } }

    .frm-label { display: block; font-size: 13px; font-weight: 700; color: #334155; margin-bottom: 6px; }
    .frm-field { position: relative; }
    .frm-prefix { position: absolute; left: 14px; top: 50%; transform: translateY(-50%); color: #64748b; font-weight: 700; }
    .frm-input, .frm-select { width: 100%; padding: 12px 14px; border: 1px solid #cbd5e1; border-radius: 10px; font-size: 15px; font-family: inherit; color: #0f172a; background: #fff; outline: none; transition: border-color .15s, box-shadow .15s; }
    .frm-input.has-prefix { padding-left: 30px; }
    .frm-input:focus, .frm-select:focus { border-color: #6366f1; box-shadow: 0 0 0 3px rgba(99,102,241,.2); }
    .frm-input.is-invalid, .frm-select.is-invalid { border-color: #dc2626; background: #fef2f2; }
    .frm-error { display: block; color: #dc2626; font-size: 12px; font-weight: 600; margin-top: 6px; }

    /* Botones */
    .frm-actions { display: flex; justify-content: flex-end; gap: 10px; margin-top: 8px; padding-top: 20px; border-top: 1px solid #f1f5f9; }
    .frm-btn { display: inline-flex; align-items: center; gap: 8px; padding: 11px 20px; border: none; border-radius: 10px; font-size: 14px; font-weight: 700; text-decoration: none; cursor: pointer; font-family: inherit; transition: transform .12s, filter .12s; }
    .frm-btn:hover { transform: translateY(-1px); filter: brightness(1.08); }
    .frm-btn svg { width: 16px; height: 16px; }
    .frm-cancel { background: #e2e8f0; color: #334155; }
    .frm-save { background: #4f46e5; color: #fff; box-shadow: 0 4px 10px rgba(79,70,229,.35); }
</style>

<div class="frm">
    <div class="frm-hero">
        <div>
            <h1>Modificar Producto</h1>
            <p>Formulario para actualizar los datos del producto.</p>
        </div>
        <span class="frm-tag">Código #{{ $producto->codigo }}</span>
    </div>

    <div class="frm-card">
        <form action="/products/update/{{ $producto->codigo }}" method="POST">
            @csrf
            @method('PUT')

            <div class="frm-grid">
                <!-- Nombre -->
                <div>
                    <label class="frm-label" for="nombre">Nombre</label>
                    <input type="text" id="nombre" name="nombre"
                        class="frm-input @error('nombre') is-invalid @enderror"
                        value="{{ old('nombre', $producto->nombre) }}">
                    @error('nombre')
                        <span class="frm-error" role="alert">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Precio -->
                <div>
                    <label class="frm-label" for="precio">Precio</label>
                    <div class="frm-field">
                        <span class="frm-prefix">$</span>
                        <input type="text" id="precio" name="precio"
                            class="frm-input has-prefix @error('precio') is-invalid @enderror"
                            value="{{ old('precio', $producto->precio) }}">
                    </div>
                    @error('precio')
                        <span class="frm-error" role="alert">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Marca -->
                <div class="frm-full">
                    <label class="frm-label" for="marca">Marca</label>
                    <select id="marca" name="marca" class="frm-select @error('marca') is-invalid @enderror">
                        @foreach ($marcas as $item)
                            <option value="{{ $item->codigo }}"
                                {{ old('marca', $producto->marca) == $item->codigo ? 'selected' : '' }}>
                                {{ $item->nombre }}
                            </option>
                        @endforeach
                    </select>
                    @error('marca')
                        <span class="frm-error" role="alert">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="frm-actions">
                <a href="/products/show" class="frm-btn frm-cancel">Cancelar</a>
                <button type="submit" class="frm-btn frm-save">
                    <svg viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                    Guardar Cambios
                </button>
            </div>
        </form>
    </div>
</div>
@endsection