<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <style>
        * { box-sizing: border-box; }
        body { margin: 0; min-height: 100vh; display: flex; align-items: center; justify-content: center; padding: 24px; font-family: system-ui, -apple-system, "Segoe UI", Roboto, sans-serif; color: #1e293b; background: linear-gradient(135deg, #0D868C 0%, #0891b2 100%); }

        .au-card { width: 100%; max-width: 440px; background: #fff; border-radius: 20px; padding: 36px 34px; box-shadow: 0 25px 50px -12px rgba(15,23,42,.45); }
        .au-logo { width: 52px; height: 52px; border-radius: 14px; background: linear-gradient(135deg, #0D868C 0%, #0891b2); display: flex; align-items: center; justify-content: center; margin-bottom: 18px; box-shadow: 0 8px 18px -6px rgba(13,134,140,.6); }
        .au-logo svg { width: 28px; height: 28px; color: #fff; }
        .au-title { margin: 0; font-size: 26px; font-weight: 800; color: #0f172a; }
        .au-sub { margin: 6px 0 24px; font-size: 14px; color: #64748b; }

        .au-group { margin-bottom: 16px; }
        .au-label { display: block; font-size: 13px; font-weight: 700; color: #334155; margin-bottom: 6px; }
        .au-input { width: 100%; padding: 12px 14px; border: 1px solid #cbd5e1; border-radius: 10px; font-size: 15px; font-family: inherit; color: #0f172a; outline: none; transition: border-color .15s, box-shadow .15s; }
        .au-input:focus { border-color: #0D868C; box-shadow: 0 0 0 3px rgba(13,134,140,.2); }
        .au-input.is-invalid { border-color: #dc2626; background: #fef2f2; }
        .au-error { display: block; color: #dc2626; font-size: 12px; font-weight: 600; margin-top: 6px; }

        .au-row { display: flex; align-items: center; justify-content: space-between; margin: 4px 0 20px; font-size: 13px; color: #475569; }
        .au-check { display: inline-flex; align-items: center; gap: 8px; cursor: pointer; }
        .au-check input { width: 16px; height: 16px; accent-color: #0D868C; }

        .au-btn { width: 100%; padding: 13px; border: none; border-radius: 10px; background: #0D868C; color: #fff; font-size: 15px; font-weight: 700; font-family: inherit; cursor: pointer; box-shadow: 0 6px 14px rgba(13,134,140,.35); transition: transform .12s, filter .12s; }
        .au-btn:hover { transform: translateY(-1px); filter: brightness(1.1); }

        .au-foot { margin-top: 22px; text-align: center; font-size: 14px; color: #64748b; }
        .au-foot a { color: #0D868C; font-weight: 700; text-decoration: none; }
        .au-foot a:hover { text-decoration: underline; }
    </style>
</head>
<body>
    <div class="au-card">
        <!-- <div class="au-logo">
            <svg viewBox="0 0 20 20" fill="currentColor"><path d="M4 3a2 2 0 100 4h12a2 2 0 100-4H4z"/><path fill-rule="evenodd" d="M3 8h14v7a2 2 0 01-2 2H5a2 2 0 01-2-2V8zm5 3a1 1 0 011-1h2a1 1 0 110 2H9a1 1 0 01-1-1z" clip-rule="evenodd"/></svg>
        </div> -->
        @yield('content')
    </div>
</body>
</html>