<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Penjualan — ELS POS</title>
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
            --card2: #1f2b42;
            --border: rgba(255,255,255,0.07);
            --muted: #6b7a99;
            --text: #e2e8f4;
        }
        html, body { height: 100%; }
        body { font-family: 'DM Sans', sans-serif; background: var(--dark); color: var(--text); display: flex; min-height: 100vh; }

        .sidebar { width: 240px; flex-shrink: 0; background: var(--panel); border-right: 1px solid var(--border); display: flex; flex-direction: column; padding: 1.5rem 1rem; position: fixed; top: 0; left: 0; bottom: 0; }
        .sidebar-logo { font-family: 'Syne', sans-serif; font-weight: 800; font-size: 1.6rem; letter-spacing: -1px; color: #fff; padding: 0.5rem 0.75rem 2rem; }
        .sidebar-logo span { color: var(--lime); }
        .nav-section { font-size: 0.68rem; font-weight: 500; color: var(--muted); text-transform: uppercase; letter-spacing: 0.12em; padding: 0 0.75rem; margin-bottom: 0.5rem; }
        .nav-item { display: flex; align-items: center; gap: 0.75rem; padding: 0.7rem 0.75rem; border-radius: 10px; color: var(--muted); text-decoration: none; font-size: 0.9rem; transition: all 0.15s; margin-bottom: 2px; }
        .nav-item:hover { background: rgba(255,255,255,0.05); color: var(--text); }
        .nav-item.active { background: rgba(222,255,154,0.1); color: var(--lime); }
        .nav-item svg { width: 18px; height: 18px; flex-shrink: 0; }
        .nav-btn { display: flex; align-items: center; gap: 0.75rem; padding: 0.7rem 0.75rem; border-radius: 10px; background: var(--lime); color: #0a0f1e; text-decoration: none; font-size: 0.9rem; font-weight: 700; transition: background 0.15s; margin-top: 0.5rem; margin-bottom: 1.5rem; }
        .nav-btn:hover { background: var(--lime-dim); }
        .nav-btn svg { width: 18px; height: 18px; }
        .sidebar-spacer { flex: 1; }
        .nav-logout { display: flex; align-items: center; gap: 0.75rem; padding: 0.7rem 0.75rem; border-radius: 10px; color: #f87171; text-decoration: none; font-size: 0.9rem; transition: background 0.15s; }
        .nav-logout:hover { background: rgba(248,113,113,0.1); }
        .nav-logout svg { width: 18px; height: 18px; }

        .main { margin-left: 240px; flex: 1; padding: 2rem 2.5rem; min-height: 100vh; }

        .topbar { display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem; }
        .page-title { font-family: 'Syne', sans-serif; font-size: 1.5rem; font-weight: 700; color: #fff; }

        .btn-new {
            display: flex; align-items: center; gap: 0.5rem;
            padding: 0.6rem 1.2rem; background: var(--lime); color: #0a0f1e;
            font-family: 'Syne', sans-serif; font-weight: 700; font-size: 0.85rem;
            border: none; border-radius: 10px; cursor: pointer; text-decoration: none;
            transition: background 0.15s;
        }
        .btn-new:hover { background: var(--lime-dim); }
        .btn-new svg { width: 16px; height: 16px; }

        .filter-bar { display: flex; gap: 0.75rem; margin-bottom: 1.5rem; align-items: center; }
        .search-wrap { position: relative; flex: 1; }
        .search-wrap svg { position: absolute; left: 0.85rem; top: 50%; transform: translateY(-50%); width: 16px; height: 16px; color: var(--muted); pointer-events: none; }
        .search-input { width: 100%; padding: 0.65rem 0.85rem 0.65rem 2.5rem; background: var(--card); border: 1px solid var(--border); border-radius: 10px; color: var(--text); font-family: 'DM Sans', sans-serif; font-size: 0.88rem; outline: none; transition: border-color 0.2s; }
        .search-input:focus { border-color: rgba(222,255,154,0.35); }
        .search-input::placeholder { color: rgba(107,122,153,0.6); }

        .filter-select { padding: 0.65rem 0.85rem; background: var(--card); border: 1px solid var(--border); border-radius: 10px; color: var(--text); font-family: 'DM Sans', sans-serif; font-size: 0.88rem; outline: none; cursor: pointer; }
        .filter-select:focus { border-color: rgba(222,255,154,0.35); }

        .stats-strip { display: grid; grid-template-columns: repeat(3,1fr); gap: 1rem; margin-bottom: 1.5rem; }
        .strip-card { background: var(--card); border: 1px solid var(--border); border-radius: 12px; padding: 1rem 1.25rem; display: flex; justify-content: space-between; align-items: center; }
        .strip-label { font-size: 0.75rem; color: var(--muted); text-transform: uppercase; letter-spacing: 0.08em; margin-bottom: 4px; }
        .strip-value { font-family: 'Syne', sans-serif; font-size: 1.3rem; font-weight: 700; color: #fff; }
        .strip-icon { width: 36px; height: 36px; border-radius: 9px; background: rgba(222,255,154,0.1); display: flex; align-items: center; justify-content: center; }
        .strip-icon svg { width: 18px; height: 18px; color: var(--lime); }

        .table-card { background: var(--card); border: 1px solid var(--border); border-radius: 16px; overflow: hidden; }

        .table-head { display: grid; grid-template-columns: 160px 1fr 1fr 1fr 1fr 140px 40px; gap: 0; padding: 0.75rem 1.5rem; border-bottom: 1px solid var(--border); }
        .th { font-size: 0.72rem; font-weight: 500; color: var(--muted); text-transform: uppercase; letter-spacing: 0.1em; }

        .txn-row {
            display: grid; grid-template-columns: 160px 1fr 1fr 1fr 1fr 140px 40px;
            padding: 0 1.5rem; border-bottom: 1px solid var(--border);
            transition: background 0.15s; cursor: pointer; position: relative;
        }
        .txn-row:last-child { border-bottom: none; }
        .txn-row:hover { background: rgba(255,255,255,0.02); }
        .txn-row.expanded { background: rgba(222,255,154,0.02); border-color: rgba(222,255,154,0.1); }

        .td { padding: 1rem 0; font-size: 0.85rem; display: flex; align-items: center; }
        .td.invoice-col { font-family: 'Syne', sans-serif; font-weight: 700; color: var(--lime); }
        .td.amount { font-weight: 500; }
        .td.expand-btn { justify-content: center; }

        .expand-icon { width: 28px; height: 28px; border-radius: 7px; background: var(--card2); border: 1px solid var(--border); display: flex; align-items: center; justify-content: center; transition: transform 0.2s, background 0.15s; }
        .expand-icon svg { width: 14px; height: 14px; color: var(--muted); transition: transform 0.2s; }
        .txn-row.expanded .expand-icon svg { transform: rotate(180deg); }
        .txn-row:hover .expand-icon { background: rgba(255,255,255,0.05); }

        .detail-row { display: none; border-bottom: 1px solid var(--border); background: rgba(0,0,0,0.15); }
        .detail-row.show { display: block; }
        .detail-inner { padding: 1rem 1.5rem 1.25rem; }
        .detail-title { font-size: 0.72rem; color: var(--muted); text-transform: uppercase; letter-spacing: 0.1em; margin-bottom: 0.75rem; }
        .detail-grid { display: grid; grid-template-columns: repeat(4,1fr); gap: 0.75rem; }
        .detail-item { background: var(--card); border: 1px solid var(--border); border-radius: 10px; padding: 0.75rem 1rem; }
        .di-label { font-size: 0.72rem; color: var(--muted); margin-bottom: 3px; }
        .di-value { font-size: 0.88rem; font-weight: 500; color: var(--text); }

        .empty-row { padding: 3.5rem; text-align: center; color: var(--muted); }
        .empty-row svg { width: 40px; height: 40px; opacity: 0.25; margin-bottom: 0.75rem; display: block; margin-left: auto; margin-right: auto; }
        .empty-row p { font-size: 0.9rem; }

        .pagination { display: flex; justify-content: center; gap: 0.4rem; padding: 1.5rem; border-top: 1px solid var(--border); }
        .page-btn { width: 34px; height: 34px; border-radius: 8px; background: var(--card2); border: 1px solid var(--border); color: var(--text); font-size: 0.82rem; cursor: pointer; display: flex; align-items: center; justify-content: center; transition: all 0.15s; }
        .page-btn:hover { background: rgba(255,255,255,0.07); }
        .page-btn.active { background: rgba(222,255,154,0.15); border-color: rgba(222,255,154,0.3); color: var(--lime); font-weight: 700; }
        .page-btn:disabled { opacity: 0.3; cursor: not-allowed; }

        .change-badge {
            display: inline-block;
            padding: 0.25rem 0.6rem;
            border-radius: 6px;
            font-size: 0.72rem;
            font-weight: 600;
            font-family: 'Syne', sans-serif;
        }
        .change-badge.lunas {
            background: rgba(74, 222, 128, 0.15);
            color: #4ade80;
            border: 1px solid rgba(74, 222, 128, 0.3);
        }
        .change-badge.lebih {
            background: rgba(222, 255, 154, 0.15);
            color: var(--lime);
            border: 1px solid rgba(222, 255, 154, 0.3);
        }

        .btn-export {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.65rem 1rem;
            background: rgba(222, 255, 154, 0.1);
            border: 1px solid rgba(222, 255, 154, 0.2);
            border-radius: 10px;
            color: var(--lime);
            font-size: 0.85rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.15s;
        }
        .btn-export:hover {
            background: rgba(222, 255, 154, 0.2);
            border-color: rgba(222, 255, 154, 0.4);
        }
        .btn-export svg { width: 16px; height: 16px; }
    </style>
</head>
<body>

<aside class="sidebar">
    <div class="sidebar-logo">ELS <span>POS</span></div>
    <div class="nav-section">Menu</div>
    <a href="/dashboard" class="nav-item">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg>
        Dashboard
    </a>
    <a href="/sales" class="nav-item active">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
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
        <div class="page-title">Riwayat Penjualan</div>
        <div style="display: flex; gap: 0.75rem;">
            <button class="btn-export" onclick="exportToCSV()">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                Export CSV
            </button>
            <a href="/sales/create" class="btn-new">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                Transaksi Baru
            </a>
        </div>
    </div>

    <div class="stats-strip">
        <div class="strip-card">
            <div>
                <div class="strip-label">Total Transaksi</div>
                <div class="strip-value"><?= count($sales ?? []) ?></div>
            </div>
            <div class="strip-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/></svg></div>
        </div>
        <div class="strip-card">
            <div>
                <div class="strip-label">Total Pendapatan</div>
                <div class="strip-value">Rp <?= number_format(array_sum(array_column($sales ?? [], 'total')), 0, ',', '.') ?></div>
            </div>
            <div class="strip-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg></div>
        </div>
        <div class="strip-card">
            <div>
                <div class="strip-label">Rata-rata Transaksi</div>
                <div class="strip-value">Rp <?= (count($sales ?? []) > 0) ? number_format(array_sum(array_column($sales ?? [], 'total')) / count($sales ?? []), 0, ',', '.') : '0' ?></div>
            </div>
            <div class="strip-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg></div>
        </div>
    </div>

    <div class="filter-bar">
        <div class="search-wrap">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
            <input type="text" class="search-input" id="search-input" placeholder="Cari nomor invoice...">
        </div>
        <select class="filter-select" id="date-filter" onchange="filterByDate(this.value)">
            <option value="">Semua Tanggal</option>
            <option value="today">Hari Ini</option>
            <option value="week">Minggu Ini</option>
            <option value="month">Bulan Ini</option>
        </select>
        <select class="filter-select" id="sort-select">
            <option value="newest">Terbaru</option>
            <option value="oldest">Terlama</option>
            <option value="highest">Total Terbesar</option>
            <option value="lowest">Total Terkecil</option>
        </select>
    </div>

    <div class="table-card">
        <div class="table-head">
            <div class="th">Invoice</div>
            <div class="th">Tanggal</div>
            <div class="th">Total</div>
            <div class="th">Dibayar</div>
            <div class="th">Kembalian</div>
            <div class="th">Status</div>
            <div class="th"></div>
        </div>
        <div id="table-body">
            <?php if (empty($sales ?? [])): ?>
            <div class="empty-row">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                <p>Belum ada transaksi</p>
            </div>
            <?php else: ?>
                <?php foreach (($sales ?? []) as $idx => $s): ?>
                <div class="txn-row" id="row-<?= $idx ?>" onclick="toggleDetail(<?= $idx ?>)" data-invoice="<?= strtolower($s['invoice']) ?>" data-date="<?= $s['created_at'] ?>">
                    <div class="td invoice-col"><?= $s['invoice'] ?></div>
                    <div class="td"><?= $s['created_at'] ?></div>
                    <div class="td amount">Rp <?= number_format($s['total'], 0, ',', '.') ?></div>
                    <div class="td">Rp <?= number_format($s['cash_paid'], 0, ',', '.') ?></div>
                    <div class="td">Rp <?= number_format($s['change_amount'], 0, ',', '.') ?></div>
                    <div class="td">
                        <span class="change-badge <?= ($s['change_amount'] == 0) ? 'lunas' : 'lebih' ?>">
                            <?= ($s['change_amount'] == 0) ? 'Lunas' : 'Lebih' ?>
                        </span>
                    </div>
                    <div class="td expand-btn">
                        <div class="expand-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="6 9 12 15 18 9"/></svg>
                        </div>
                    </div>
                </div>
                <div class="detail-row" id="detail-<?= $idx ?>">
                    <div class="detail-inner">
                        <div class="detail-title">Rincian Transaksi</div>
                        <div class="detail-grid">
                            <div class="detail-item">
                                <div class="di-label">No. Invoice</div>
                                <div class="di-value" style="color:var(--lime);font-family:'Syne',sans-serif"><?= $s['invoice'] ?></div>
                            </div>
                            <div class="detail-item">
                                <div class="di-label">Waktu Transaksi</div>
                                <div class="di-value"><?= $s['created_at'] ?></div>
                            </div>
                            <div class="detail-item">
                                <div class="di-label">Total Belanja</div>
                                <div class="di-value">Rp <?= number_format($s['total'], 0, ',', '.') ?></div>
                            </div>
                            <div class="detail-item">
                                <div class="di-label">Uang Kembali</div>
                                <div class="di-value" style="color:var(--lime)">Rp <?= number_format($s['change_amount'], 0, ',', '.') ?></div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <div class="pagination" id="pagination"></div>
    </div>
</main>

<script>
    let openIdx = null;
    let currentPage = 1;
    const itemsPerPage = 10;
    let allRows = [];

    function toggleDetail(idx) {
        const row    = document.getElementById('row-' + idx);
        const detail = document.getElementById('detail-' + idx);
        if (!row || !detail) return;

        if (openIdx !== null && openIdx !== idx) {
            const prev = document.getElementById('row-' + openIdx);
            const prevD = document.getElementById('detail-' + openIdx);
            if (prev) prev.classList.remove('expanded');
            if (prevD) prevD.classList.remove('show');
        }

        const isOpen = row.classList.toggle('expanded');
        detail.classList.toggle('show', isOpen);
        openIdx = isOpen ? idx : null;
    }

    function getVisibleRows() {
        const rows = [];
        document.querySelectorAll('.txn-row').forEach(row => {
            if (row.style.display !== 'none') {
                rows.push(row);
            }
        });
        return rows;
    }

    function updatePagination() {
        const visibleRows = getVisibleRows();
        const totalPages = Math.ceil(visibleRows.length / itemsPerPage);
        const paginationEl = document.getElementById('pagination');
        paginationEl.innerHTML = '';

        if (totalPages <= 1) return;

        for (let i = 1; i <= totalPages; i++) {
            const btn = document.createElement('button');
            btn.className = 'page-btn';
            if (i === currentPage) btn.classList.add('active');
            btn.textContent = i;
            btn.disabled = i === currentPage;
            btn.onclick = () => {
                currentPage = i;
                showPage(i);
            };
            paginationEl.appendChild(btn);
        }
    }

    function showPage(page) {
        const visibleRows = getVisibleRows();
        const totalPages = Math.ceil(visibleRows.length / itemsPerPage);
        const start = (page - 1) * itemsPerPage;
        const end = start + itemsPerPage;

        visibleRows.forEach((row, idx) => {
            if (idx >= start && idx < end) {
                row.style.display = '';
                const detailId = row.id.replace('row-', 'detail-');
                const detail = document.getElementById(detailId);
                if (detail) detail.style.display = '';
            } else {
                row.style.display = 'none';
                const detailId = row.id.replace('row-', 'detail-');
                const detail = document.getElementById(detailId);
                if (detail) detail.style.display = 'none';
            }
        });

        updatePagination();
        window.scrollTo(0, 0);
    }

    function filterByDate(period) {
        const now = new Date();
        let startDate = new Date();

        if (period === 'today') {
            startDate.setHours(0, 0, 0, 0);
        } else if (period === 'week') {
            startDate.setDate(now.getDate() - now.getDay());
            startDate.setHours(0, 0, 0, 0);
        } else if (period === 'month') {
            startDate.setDate(1);
            startDate.setHours(0, 0, 0, 0);
        } else {
            startDate = new Date(0);
        }

        document.querySelectorAll('.txn-row').forEach(row => {
            const dateStr = row.getAttribute('data-date');
            if (!dateStr) { row.style.display = ''; return; }

            const rowDate = new Date(dateStr.split(' ')[0]);
            const visible = rowDate >= startDate;
            row.style.display = visible ? '' : 'none';
            const detail = document.getElementById(row.id.replace('row-','detail-'));
            if (!visible && detail) { detail.style.display = 'none'; row.classList.remove('expanded'); }
        });

        currentPage = 1;
        applySearchAndSort();
    }

    function applySearchAndSort() {
        const searchQ = document.getElementById('search-input').value.toLowerCase();
        const sortBy = document.getElementById('sort-select').value;
        
        let visibleRows = getVisibleRows().filter(row => {
            const inv = row.getAttribute('data-invoice') || '';
            return !searchQ || inv.includes(searchQ);
        });

        // Sort the rows
        const tableBody = document.getElementById('table-body');
        visibleRows.sort((a, b) => {
            if (sortBy === 'newest') return 0; // Keep original order
            if (sortBy === 'oldest') return 0;
            if (sortBy === 'highest' || sortBy === 'lowest') {
                const aAmount = parseInt(a.querySelectorAll('.td')[2].textContent.replace(/\D/g, '')) || 0;
                const bAmount = parseInt(b.querySelectorAll('.td')[2].textContent.replace(/\D/g, '')) || 0;
                return sortBy === 'highest' ? bAmount - aAmount : aAmount - bAmount;
            }
            return 0;
        });

        // Reorder visible rows in DOM
        visibleRows.forEach(row => {
            const detailId = row.id.replace('row-', 'detail-');
            const detail = document.getElementById(detailId);
            if (detail) {
                tableBody.appendChild(row);
                tableBody.appendChild(detail);
            }
        });

        currentPage = 1;
        showPage(1);
    }

    document.getElementById('search-input').addEventListener('input', applySearchAndSort);
    document.getElementById('sort-select').addEventListener('change', applySearchAndSort);

    function exportToCSV() {
        const rows = [];
        const headers = ['Invoice', 'Tanggal', 'Total', 'Dibayar', 'Kembalian'];
        rows.push(headers.join(','));

        document.querySelectorAll('.txn-row').forEach(row => {
            if (row.style.display !== 'none') {
                const cells = row.querySelectorAll('.td');
                const rowData = [
                    cells[0].textContent.trim(),
                    cells[1].textContent.trim(),
                    cells[2].textContent.trim().replace(/\D/g, ''),
                    cells[3].textContent.trim().replace(/\D/g, ''),
                    cells[4].textContent.trim().replace(/\D/g, '')
                ];
                rows.push(rowData.map(v => `"${v}"`).join(','));
            }
        });

        const csv = rows.join('\n');
        const blob = new Blob([csv], { type: 'text/csv' });
        const url = window.URL.createObjectURL(blob);
        const a = document.createElement('a');
        a.href = url;
        a.download = `sales_${new Date().toISOString().split('T')[0]}.csv`;
        document.body.appendChild(a);
        a.click();
        window.URL.revokeObjectURL(url);
        document.body.removeChild(a);
    }

    // Initialize pagination
    showPage(1);
</script>
</body>
</html>