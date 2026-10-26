<style>
    .frm * { box-sizing: border-box; }
    .frm { max-width: 760px; margin: 0 auto; padding: 32px 20px 60px; font-family: system-ui, -apple-system, "Segoe UI", Roboto, sans-serif; color: #1e293b; }

    .frm-hero { background: linear-gradient(135deg, {{ $c1 }} 0%, {{ $c2 }} 100%); border-radius: 18px; padding: 26px 32px; color: #fff; display: flex; align-items: center; justify-content: space-between; gap: 20px; flex-wrap: wrap; box-shadow: 0 10px 25px -8px rgba(79,70,229,.5); }
    .frm-hero h1 { margin: 0; font-size: 26px; font-weight: 800; }
    .frm-hero p { margin: 6px 0 0; font-size: 14px; opacity: .9; }
    .frm-tag { background: rgba(255,255,255,.2); border: 1px solid rgba(255,255,255,.35); padding: 8px 16px; border-radius: 999px; font-weight: 700; font-size: 14px; }

    .frm-card { background: #fff; border: 1px solid #e2e8f0; border-radius: 16px; box-shadow: 0 4px 16px rgba(15,23,42,.08); padding: 28px; margin-top: 24px; }
    .frm-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
    .frm-full { grid-column: 1 / -1; }
    @media (max-width: 600px) { .frm-grid { grid-template-columns: 1fr; } }

    .frm-label { display: block; font-size: 13px; font-weight: 700; color: #334155; margin-bottom: 6px; }
    .frm-input { width: 100%; padding: 12px 14px; border: 1px solid #cbd5e1; border-radius: 10px; font-size: 15px; font-family: inherit; color: #0f172a; background: #fff; outline: none; transition: border-color .15s, box-shadow .15s; }
    .frm-input:focus { border-color: #6366f1; box-shadow: 0 0 0 3px rgba(99,102,241,.2); }
    .frm-input.is-invalid { border-color: #dc2626; background: #fef2f2; }
    .frm-error { display: block; color: #dc2626; font-size: 12px; font-weight: 600; margin-top: 6px; }
    .frm-hint { font-size: 12px; color: #64748b; margin-top: 6px; }

    .frm-actions { display: flex; justify-content: flex-end; gap: 10px; margin-top: 24px; padding-top: 20px; border-top: 1px solid #f1f5f9; }
    .frm-btn { display: inline-flex; align-items: center; gap: 8px; padding: 11px 20px; border: none; border-radius: 10px; font-size: 14px; font-weight: 700; text-decoration: none; cursor: pointer; font-family: inherit; transition: transform .12s, filter .12s; }
    .frm-btn:hover { transform: translateY(-1px); filter: brightness(1.08); }
    .frm-cancel { background: #e2e8f0; color: #334155; }
    .frm-save { background: {{ $c1 }}; color: #fff; box-shadow: 0 4px 10px rgba(0,0,0,.2); }
</style>

<div class="frm">
    <div class="frm-hero">
        <div>
            <h1>{{ $titulo }}</h1>
            <p>{{ $subtitulo }}</p>
        </div>
        <span class="frm-tag">{{ $etiqueta }}</span>
    </div>

    <div class="frm-card">
        <form action="{{ $action }}" method="POST">
            @csrf
            @if ($metodo === 'PUT') @method('PUT') @endif

            <div class="frm-grid">
                <div>
                    <label class="frm-label" for="name">Nombre completo</label>
                    <input type="text" id="name" name="name" placeholder="Nombre del usuario"
                        class="frm-input @error('name') is-invalid @enderror"
                        value="{{ old('name', $usuario->name ?? '') }}">
                    @error('name') <span class="frm-error" role="alert">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="frm-label" for="email">Correo electrónico</label>
                    <input type="email" id="email" name="email" placeholder="correo@ejemplo.com"
                        class="frm-input @error('email') is-invalid @enderror"
                        value="{{ old('email', $usuario->email ?? '') }}">
                    @error('email') <span class="frm-error" role="alert">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="frm-label" for="password">Contraseña</label>
                    <input type="password" id="password" name="password"
                        placeholder="{{ $metodo === 'PUT' ? 'Dejar vacía para no cambiar' : 'Mínimo 8 caracteres' }}"
                        class="frm-input @error('password') is-invalid @enderror">
                    @error('password') <span class="frm-error" role="alert">{{ $message }}</span> @enderror
                    @if ($metodo === 'PUT')
                        <div class="frm-hint">Solo escríbela si quieres cambiarla.</div>
                    @endif
                </div>

                <div>
                    <label class="frm-label" for="password_confirmation">Confirmar contraseña</label>
                    <input type="password" id="password_confirmation" name="password_confirmation"
                        placeholder="Repite la contraseña" class="frm-input">
                </div>
            </div>

            <div class="frm-actions">
                <a href="/users" class="frm-btn frm-cancel">Cancelar</a>
                <button type="submit" class="frm-btn frm-save">{{ $boton }}</button>
            </div>
        </form>
    </div>
</div>