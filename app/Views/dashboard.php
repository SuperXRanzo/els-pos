<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard — ELS POS</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;700;800&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.umd.min.js"></script>
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        :root {
            --lime: #deff9a;
            --lime-dim: #b8d966;
            --dark: #0a0f1e;
            --panel: #111827;
            --card: #1a2236;
            --card2: #1f2b42;
            --border: rgba(255,255,255,0.07);
            --muted: #6b7a99;
            --text: #e2e8f4;
        }
        html, body { height: 100%; }
        body { font-family: 'DM Sans', sans-serif; background: var(--dark); color: var(--text); display: flex; min-height: 100vh; }

        .sidebar {
            width: 240px;
            flex-shrink: 0;
            background: var(--panel);
            border-right: 1px solid var(--border);
            display: flex;
            flex-direction: column;
            padding: 1.5rem 1rem;
            position: fixed;
            top: 0; left: 0; bottom: 0;
        }
        .sidebar-logo {
            font-family: 'Syne', sans-serif;
            font-weight: 800;
            font-size: 1.6rem;
            letter-spacing: -1px;
            color: #fff;
            padding: 0.5rem 0.75rem 2rem;
        }
        .sidebar-logo span { color: var(--lime); }

        .nav-section {
            font-size: 0.68rem;
            font-weight: 500;
            color: var(--muted);
            text-transform: uppercase;
            letter-spacing: 0.12em;
            padding: 0 0.75rem;
            margin-bottom: 0.5rem;
        }
        .nav-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.7rem 0.75rem;
            border-radius: 10px;
            color: var(--muted);
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 400;
            transition: all 0.15s;
            margin-bottom: 2px;
        }
        .nav-item:hover { background: rgba(255,255,255,0.05); color: var(--text); }
        .nav-item.active { background: rgba(222,255,154,0.1); color: var(--lime); }
        .nav-item svg { width: 18px; height: 18px; flex-shrink: 0; }

        .nav-btn {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.7rem 0.75rem;
            border-radius: 10px;
            background: var(--lime);
            color: #0a0f1e;
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 700;
            transition: background 0.15s;
            margin-top: 0.5rem;
            margin-bottom: 1.5rem;
        }
        .nav-btn:hover { background: var(--lime-dim); }
        .nav-btn svg { width: 18px; height: 18px; }

        .sidebar-spacer { flex: 1; }
        .nav-logout {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.7rem 0.75rem;
            border-radius: 10px;
            color: #f87171;
            text-decoration: none;
            font-size: 0.9rem;
            transition: background 0.15s;
        }
        .nav-logout:hover { background: rgba(248,113,113,0.1); }
        .nav-logout svg { width: 18px; height: 18px; }

        /* ── MAIN ── */
        .main {
            margin-left: 240px;
            flex: 1;
            padding: 2rem 2.5rem;
            min-height: 100vh;
        }

        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2.5rem;
        }
        .page-title {
            font-family: 'Syne', sans-serif;
            font-size: 1.6rem;
            font-weight: 700;
            color: #fff;
        }
        .page-title span { color: var(--muted); font-size: 0.85rem; font-weight: 400; display: block; font-family: 'DM Sans', sans-serif; margin-top: 2px; }

        .date-badge {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 10px;
            padding: 0.5rem 1rem;
            font-size: 0.82rem;
            color: var(--muted);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .date-badge svg { width: 15px; height: 15px; color: var(--lime); }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1.2rem;
            margin-bottom: 2rem;
        }
        .stat-card {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 1.5rem;
            position: relative;
            overflow: hidden;
            transition: transform 0.2s, border-color 0.2s;
        }
        .stat-card:hover { transform: translateY(-2px); border-color: rgba(222,255,154,0.15); }
        .stat-card::before {
            content: '';
            position: absolute;
            top: 0; right: 0;
            width: 120px; height: 120px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(222,255,154,0.07) 0%, transparent 70%);
            transform: translate(30%, -30%);
        }
        .stat-label {
            font-size: 0.78rem;
            color: var(--muted);
            text-transform: uppercase;
            letter-spacing: 0.1em;
            margin-bottom: 0.75rem;
        }
        .stat-value {
            font-family: 'Syne', sans-serif;
            font-size: 2rem;
            font-weight: 700;
            color: #fff;
            line-height: 1;
            margin-bottom: 0.5rem;
        }
        .stat-delta {
            font-size: 0.78rem;
            display: flex;
            align-items: center;
            gap: 4px;
        }
        .stat-delta.up { color: var(--lime); }
        .stat-delta.neutral { color: var(--muted); }
        .stat-icon {
            position: absolute;
            top: 1.5rem; right: 1.5rem;
            width: 40px; height: 40px;
            border-radius: 10px;
            background: rgba(222,255,154,0.1);
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .stat-icon svg { width: 20px; height: 20px; color: var(--lime); }

        .bottom-grid {
            display: grid;
            grid-template-columns: 1.5fr 1fr;
            gap: 1.2rem;
        }

        .chart-card {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 1.5rem;
        }
        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }
        .card-title {
            font-family: 'Syne', sans-serif;
            font-weight: 700;
            font-size: 1rem;
            color: #fff;
        }
        .card-header .tag {
            font-size: 0.72rem;
            padding: 0.25rem 0.65rem;
            border-radius: 6px;
            background: rgba(222,255,154,0.1);
            color: var(--lime);
        }
        .chart-wrap { height: 220px; }

        .txn-card {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 1.5rem;
            overflow: hidden;
        }

        .txn-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0.75rem 0;
            border-bottom: 1px solid var(--border);
            transition: background 0.15s;
        }
        .txn-item:last-child { border-bottom: none; }
        .txn-item:hover { padding-left: 4px; }
        .txn-left { display: flex; flex-direction: column; gap: 3px; }
        .txn-inv {
            font-size: 0.82rem;
            font-weight: 500;
            color: var(--lime);
            font-family: 'Syne', sans-serif;
        }
        .txn-date { font-size: 0.72rem; color: var(--muted); }
        .txn-amount {
            font-size: 0.9rem;
            font-weight: 500;
            color: #fff;
        }

        .empty-state {
            text-align: center;
            padding: 2.5rem 1rem;
            color: var(--muted);
            font-size: 0.9rem;
        }
        .empty-state svg { width: 40px; height: 40px; color: var(--muted); margin-bottom: 0.75rem; opacity: 0.4; }

        .fade-up {
            opacity: 0;
            transform: translateY(16px);
            animation: fadeUp 0.5s ease-out forwards;
        }
        @keyframes fadeUp {
            to { opacity: 1; transform: translateY(0); }
        }
        .stat-card:nth-child(1) { animation-delay: 0.05s; }
        .stat-card:nth-child(2) { animation-delay: 0.1s; }
        .stat-card:nth-child(3) { animation-delay: 0.15s; }
    </style>
</head>
<body>

<aside class="sidebar">
    <div class="sidebar-logo">ELS <span>POS</span></div>
    <div class="nav-section">Menu</div>
    <a href="/dashboard" class="nav-item active">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg>
        Dashboard
    </a>
    <a href="/sales" class="nav-item">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>
        Riwayat Penjualan
    </a>
    <a href="/sales/create" class="nav-btn">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
        Transaksi Baru
    </a>
    <div class="sidebar-spacer"></div>
    <a href="/logout" class="nav-logout">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
        Keluar
    </a>
</aside>

<main class="main">
    <div class="topbar">
        <div>
            <div class="page-title">
                Dashboard
                <span>Selamat datang kembali 👋</span>
            </div>
        </div>
        <div class="date-badge">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
            <span id="live-date">—</span>
        </div>
    </div>

    <div class="stats-grid">
        <div class="stat-card fade-up">
            <div class="stat-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/></svg>
            </div>
            <div class="stat-label">Total Produk</div>
            <div class="stat-value" id="ctr-products">0</div>
            <div class="stat-delta up">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="13" height="13"><polyline points="18 15 12 9 6 15"/></svg>
                Aktif terdaftar
            </div>
        </div>
        <div class="stat-card fade-up">
            <div class="stat-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/></svg>
            </div>
            <div class="stat-label">Transaksi Penjualan</div>
            <div class="stat-value" id="ctr-transactions">0</div>
            <div class="stat-delta up">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="13" height="13"><polyline points="18 15 12 9 6 15"/></svg>
                Total semua waktu
            </div>
        </div>
        <div class="stat-card fade-up">
            <div class="stat-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
            </div>
            <div class="stat-label">Total Pendapatan</div>
            <div class="stat-value" id="ctr-revenue">Rp 0</div>
            <div class="stat-delta up">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="13" height="13"><polyline points="18 15 12 9 6 15"/></svg>
                Semua transaksi
            </div>
        </div>
    </div>

    <div class="bottom-grid">
        <div class="chart-card">
            <div class="card-header">
                <span class="card-title">Tren Penjualan</span>
                <span class="tag">7 hari terakhir</span>
            </div>
            <div class="chart-wrap">
                <canvas id="salesChart"></canvas>
            </div>
        </div>

        <div class="txn-card">
            <div class="card-header">
                <span class="card-title">Transaksi Terakhir</span>
                <a href="/sales" style="font-size:0.78rem; color:var(--lime); text-decoration:none;">Lihat semua →</a>
            </div>
            <?php if (empty($recent_sales)): ?>
            <div class="empty-state">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                <p>Belum ada transaksi</p>
            </div>
            <?php else: ?>
            <?php foreach ($recent_sales as $sale): ?>
            <div class="txn-item">
                <div class="txn-left">
                    <span class="txn-inv"><?= $sale['invoice'] ?></span>
                    <span class="txn-date"><?= $sale['created_at'] ?></span>
                </div>
                <span class="txn-amount">Rp <?= number_format($sale['total'], 0, ',', '.') ?></span>
            </div>
            <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</main>

<script>
    const d = new Date();
    document.getElementById('live-date').textContent = d.toLocaleDateString('id-ID', { weekday:'long', year:'numeric', month:'long', day:'numeric' });

    function animateCounter(id, target, prefix='', suffix='', duration=1200) {
        const el = document.getElementById(id);
        const start = performance.now();
        const isNumber = typeof target === 'number';
        function update(now) {
            const t = Math.min((now - start) / duration, 1);
            const ease = t < 0.5 ? 2*t*t : -1+(4-2*t)*t;
            const current = Math.floor(ease * target);
            el.textContent = prefix + current.toLocaleString('id-ID') + suffix;
            if (t < 1) requestAnimationFrame(update);
        }
        requestAnimationFrame(update);
    }

    const totalProducts     = <?= isset($total_products)     ? (int)$total_products     : 0 ?>;
    const totalTransactions = <?= isset($total_transactions) ? (int)$total_transactions : 0 ?>;
    const totalRevenue      = <?= isset($total_revenue)      ? (float)$total_revenue    : 0 ?>;

    animateCounter('ctr-products',     totalProducts);
    animateCounter('ctr-transactions', totalTransactions);
    animateCounter('ctr-revenue',      totalRevenue, 'Rp ');

    const ctx = document.getElementById('salesChart').getContext('2d');

    const chartLabels = <?= isset($chart_labels) ? json_encode($chart_labels) : json_encode(['Sen','Sel','Rab','Kam','Jum','Sab','Min']) ?>;
    const chartData   = <?= isset($chart_data)   ? json_encode($chart_data)   : json_encode([0, 0, 0, 0, 0, 0, 0]) ?>;

    const gradient = ctx.createLinearGradient(0, 0, 0, 220);
    gradient.addColorStop(0, 'rgba(222,255,154,0.25)');
    gradient.addColorStop(1, 'rgba(222,255,154,0)');

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: chartLabels,
            datasets: [{
                data: chartData,
                borderColor: '#deff9a',
                borderWidth: 2,
                backgroundColor: gradient,
                fill: true,
                tension: 0.4,
                pointBackgroundColor: '#deff9a',
                pointRadius: 4,
                pointHoverRadius: 6
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false }, tooltip: {
                backgroundColor: '#1a2236',
                borderColor: 'rgba(255,255,255,0.08)',
                borderWidth: 1,
                titleColor: '#deff9a',
                bodyColor: '#e2e8f4',
                callbacks: {
                    label: ctx => 'Rp ' + ctx.raw.toLocaleString('id-ID')
                }
            }},
            scales: {
                x: { grid: { color: 'rgba(255,255,255,0.04)' }, ticks: { color: '#6b7a99', font: { size: 11 } } },
                y: { grid: { color: 'rgba(255,255,255,0.04)' }, ticks: { color: '#6b7a99', font: { size: 11 }, callback: v => 'Rp ' + v.toLocaleString('id-ID') }, beginAtZero: true }
            }
        }
    });
</script>
</body>
</html>