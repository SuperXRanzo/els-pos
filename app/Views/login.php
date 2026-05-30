<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — ELS POS</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;700;800&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --lime: #deff9a;
            --lime-dim: #b8d966;
            --dark: #0a0f1e;
            --panel: #111827;
            --card: #1a2236;
            --border: rgba(255,255,255,0.08);
            --muted: #6b7a99;
            --text: #e2e8f4;
        }

        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--dark);
            min-height: 100vh;
            display: grid;
            grid-template-columns: 1fr 1fr;
            overflow: hidden;
        }

        /* ── LEFT SIDE ── */
        .left-panel {
            position: relative;
            background: var(--panel);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 3rem;
            overflow: hidden;
        }

        .left-panel::before {
            content: '';
            position: absolute;
            width: 500px; height: 500px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(222,255,154,0.12) 0%, transparent 70%);
            top: -100px; left: -100px;
            animation: pulse 6s ease-in-out infinite;
        }
        .left-panel::after {
            content: '';
            position: absolute;
            width: 400px; height: 400px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(222,255,154,0.07) 0%, transparent 70%);
            bottom: -80px; right: -80px;
            animation: pulse 6s ease-in-out infinite 3s;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); opacity: 1; }
            50% { transform: scale(1.1); opacity: 0.7; }
        }

        .brand-area {
            position: relative;
            z-index: 1;
            text-align: center;
        }

        .brand-logo {
            font-family: 'Syne', sans-serif;
            font-weight: 800;
            font-size: 4.5rem;
            letter-spacing: -2px;
            line-height: 1;
            color: #fff;
        }
        .brand-logo span { color: var(--lime); }

        .brand-tagline {
            font-size: 0.9rem;
            color: var(--muted);
            margin-top: 0.5rem;
            letter-spacing: 0.15em;
            text-transform: uppercase;
        }

        .floating-cards {
            position: absolute;
            z-index: 1;
            width: 100%;
            height: 100%;
            top: 0; left: 0;
            pointer-events: none;
        }

        .stat-float {
            position: absolute;
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 14px;
            padding: 1rem 1.4rem;
            font-size: 0.8rem;
            color: var(--muted);
            backdrop-filter: blur(8px);
        }
        .stat-float .val {
            font-family: 'Syne', sans-serif;
            font-size: 1.4rem;
            font-weight: 700;
            color: var(--text);
            display: block;
            margin-bottom: 2px;
        }
        .stat-float.s1 { top: 18%; left: 8%; animation: floatA 8s ease-in-out infinite; }
        .stat-float.s2 { top: 22%; right: 6%; animation: floatB 7s ease-in-out infinite 1s; }
        .stat-float.s3 { bottom: 20%; left: 10%; animation: floatA 9s ease-in-out infinite 2s; }
        .stat-float.s4 { bottom: 18%; right: 8%; animation: floatB 8s ease-in-out infinite 0.5s; }

        @keyframes floatA {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-12px); }
        }
        @keyframes floatB {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(10px); }
        }

        .dot-lime { width: 8px; height: 8px; border-radius: 50%; background: var(--lime); display: inline-block; margin-right: 6px; animation: blink 2s infinite; }
        @keyframes blink { 0%,100% { opacity: 1; } 50% { opacity: 0.3; } }

        .right-panel {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 3rem;
            animation: slideIn 0.6s ease-out;
        }

        @keyframes slideIn {
            from { opacity: 0; transform: translateX(30px); }
            to   { opacity: 1; transform: translateX(0); }
        }

        .login-box {
            width: 100%;
            max-width: 420px;
        }

        .login-box h2 {
            font-family: 'Syne', sans-serif;
            font-size: 1.8rem;
            font-weight: 700;
            color: #fff;
            margin-bottom: 0.4rem;
        }
        .login-box .sub {
            color: var(--muted);
            font-size: 0.9rem;
            margin-bottom: 2.5rem;
        }

        .alert-msg {
            background: rgba(239,68,68,0.12);
            border: 1px solid rgba(239,68,68,0.3);
            border-radius: 10px;
            padding: 0.75rem 1rem;
            color: #fca5a5;
            font-size: 0.85rem;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .form-group {
            margin-bottom: 1.4rem;
        }
        .form-group label {
            display: block;
            font-size: 0.8rem;
            font-weight: 500;
            color: var(--muted);
            margin-bottom: 0.5rem;
            text-transform: uppercase;
            letter-spacing: 0.08em;
        }

        .input-wrap {
            position: relative;
        }
        .input-wrap svg {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--muted);
            width: 18px; height: 18px;
        }

        .form-group input {
            width: 100%;
            padding: 0.85rem 1rem 0.85rem 2.8rem;
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 10px;
            color: var(--text);
            font-family: 'DM Sans', sans-serif;
            font-size: 0.95rem;
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s;
        }
        .form-group input:focus {
            border-color: rgba(222,255,154,0.4);
            box-shadow: 0 0 0 3px rgba(222,255,154,0.08);
        }
        .form-group input::placeholder { color: rgba(107,122,153,0.6); }

        .toggle-pw {
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: var(--muted);
            cursor: pointer;
            padding: 0;
        }
        .toggle-pw:hover { color: var(--text); }

        .btn-login {
            width: 100%;
            padding: 0.9rem;
            background: var(--lime);
            color: #0a0f1e;
            font-family: 'Syne', sans-serif;
            font-weight: 700;
            font-size: 1rem;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            letter-spacing: 0.05em;
            margin-top: 0.5rem;
            position: relative;
            overflow: hidden;
            transition: background 0.2s, transform 0.1s;
        }
        .btn-login:hover { background: var(--lime-dim); }
        .btn-login:active { transform: scale(0.98); }

        .btn-login .btn-shine {
            position: absolute;
            inset: 0;
            background: linear-gradient(105deg, transparent 40%, rgba(255,255,255,0.25) 50%, transparent 60%);
            transform: translateX(-100%);
            transition: transform 0.5s ease;
        }
        .btn-login:hover .btn-shine { transform: translateX(100%); }

        .btn-login.loading {
            pointer-events: none;
            opacity: 0.7;
        }
        .btn-login.loading span { opacity: 0; }
        .loader {
            display: none;
            position: absolute;
            width: 16px; height: 16px;
            border: 2px solid rgba(10, 15, 30, 0.3);
            border-top: 2px solid #0a0f1e;
            border-radius: 50%;
            animation: spin 0.8s linear infinite;
        }
        .btn-login.loading .loader { display: block; }
        @keyframes spin { to { transform: rotate(360deg); } }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            10%, 30%, 50%, 70%, 90% { transform: translateX(-8px); }
            20%, 40%, 60%, 80% { transform: translateX(8px); }
        }
        .login-box.error { animation: shake 0.5s; }

        .live-clock {
            font-family: 'Syne', sans-serif;
            font-size: 2.8rem;
            font-weight: 800;
            color: var(--lime);
            margin-bottom: 1.5rem;
            letter-spacing: 1px;
        }
        .live-date {
            font-size: 0.9rem;
            color: var(--muted);
            text-align: center;
            font-family: 'DM Sans', sans-serif;
        }

        .footer-note {
            text-align: center;
            margin-top: 2rem;
            font-size: 0.78rem;
            color: var(--muted);
        }

        @media (max-width: 768px) {
            body { grid-template-columns: 1fr; }
            .left-panel { display: none; }
        }
    </style>
</head>
<body>

    <div class="left-panel">
        <div class="floating-cards">
            <div class="stat-float s1">
                <span class="val">1.247</span>
                <span><span class="dot-lime"></span>Transaksi Hari Ini</span>
            </div>
            <div class="stat-float s2">
                <span class="val">Rp 8,4 jt</span>
                <span><span class="dot-lime"></span>Pendapatan Hari Ini</span>
            </div>
            <div class="stat-float s3">
                <span class="val">98,4%</span>
                <span>Kepuasan Pelanggan</span>
            </div>
            <div class="stat-float s4">
                <span class="val">312</span>
                <span>Produk Aktif</span>
            </div>
        </div>
        <div class="brand-area">
            <div class="live-clock" id="live-clock">--:--:--</div>
            <div class="live-date" id="live-date">Loading...</div>
            <div style="margin-top: 3rem;">
                <div class="brand-logo">ELS <span>POS</span></div>
                <div class="brand-tagline">Point of Sale System</div>
            </div>
        </div>
    </div>

    <div class="right-panel">
        <div class="login-box" id="login-box">
            <h2>Selamat Datang 👋</h2>
            <p class="sub">Masuk untuk mengelola transaksi Anda</p>

            <?php if(session()->getFlashdata('msg')): ?>
            <div class="alert-msg">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                <?= session()->getFlashdata('msg') ?>
            </div>
            <?php endif; ?>

            <form action="/login" method="post">
                <?= csrf_field() ?>
                
                <div class="form-group">
                    <label>Username</label>
                    <div class="input-wrap">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                        <input type="text" name="username" placeholder="Masukkan username" required autocomplete="username">
                    </div>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <div class="input-wrap">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                        <input type="password" name="password" id="pw" placeholder="••••••••" required autocomplete="current-password">
                        <button type="button" class="toggle-pw" onclick="togglePw()" aria-label="Tampilkan password">
                            <svg id="eye-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="18" height="18"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                        </button>
                    </div>
                </div>
                <button type="submit" class="btn-login" id="btn-login">
                    <span class="btn-shine"></span>
                    <span>Masuk ke Sistem</span>
                    <div class="loader"></div>
                </button>
            </form>

            <p class="footer-note">ELS POS v2.0 &mdash; © 2025 ELS Systems</p>
        </div>
    </div>

    <script>
        // Live Clock
        function updateClock() {
            const now = new Date();
            const time = now.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit', second: '2-digit' });
            const date = now.toLocaleDateString('id-ID', { weekday: 'short', year: 'numeric', month: 'short', day: 'numeric' });
            document.getElementById('live-clock').textContent = time;
            document.getElementById('live-date').textContent = date;
        }
        updateClock();
        setInterval(updateClock, 1000);

        // Toggle Password
        function togglePw() {
            const pw = document.getElementById('pw');
            pw.type = pw.type === 'password' ? 'text' : 'password';
        }

        // Loading State
        document.querySelector('form').addEventListener('submit', function(e) {
            const btn = document.getElementById('btn-login');
            const loginBox = document.getElementById('login-box');
            
            btn.classList.add('loading');
            btn.disabled = true;
        });

        // Show shake on error if message exists
        if (document.querySelector('.alert-msg')) {
            document.getElementById('login-box').classList.add('error');
        }
    </script>
</body>
</html>