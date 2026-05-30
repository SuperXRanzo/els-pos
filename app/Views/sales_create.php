<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kasir Baru — ELS POS</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;700;800&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        :root {
            --lime: #deff9a;
            --lime-dim: #b8d966;
            --dark: #0a0f1e;
            --panel: #111827;
            --card: #1a2236;
            --card2: #1f2b42;
            --border: rgba(255, 255, 255, 0.07);
            --muted: #6b7a99;
            --text: #e2e8f4;
            --danger: #f87171;
            --success: #4ade80;
        }

        html,
        body {
            height: 100%;
        }

        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--dark);
            color: var(--text);
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 240px;
            flex-shrink: 0;
            background: var(--panel);
            border-right: 1px solid var(--border);
            display: flex;
            flex-direction: column;
            padding: 1.5rem 1rem;
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
        }

        .sidebar-logo {
            font-family: 'Syne', sans-serif;
            font-weight: 800;
            font-size: 1.6rem;
            letter-spacing: -1px;
            color: #fff;
            padding: 0.5rem 0.75rem 2rem;
        }

        .sidebar-logo span {
            color: var(--lime);
        }

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
            transition: all 0.15s;
            margin-bottom: 2px;
        }

        .nav-item:hover {
            background: rgba(255, 255, 255, 0.05);
            color: var(--text);
        }

        .nav-item.active {
            background: rgba(222, 255, 154, 0.1);
            color: var(--lime);
        }

        .nav-item svg {
            width: 18px;
            height: 18px;
            flex-shrink: 0;
        }

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

        .nav-btn:hover {
            background: var(--lime-dim);
        }

        .nav-btn svg {
            width: 18px;
            height: 18px;
        }

        .sidebar-spacer {
            flex: 1;
        }

        .sidebar-summary {
            background: rgba(222, 255, 154, 0.08);
            border: 1px solid rgba(222, 255, 154, 0.15);
            border-radius: 12px;
            padding: 1rem;
            margin-bottom: 1.5rem;
            text-align: center;
        }

        .summary-label {
            font-size: 0.72rem;
            color: var(--muted);
            text-transform: uppercase;
            letter-spacing: 0.08em;
            margin-bottom: 0.5rem;
        }

        .summary-value {
            font-family: 'Syne', sans-serif;
            font-size: 1.3rem;
            font-weight: 800;
            color: var(--lime);
        }

        .summary-label.second {
            margin-top: 0.8rem;
            margin-bottom: 0.3rem;
        }

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

        .nav-logout:hover {
            background: rgba(248, 113, 113, 0.1);
        }

        .nav-logout svg {
            width: 18px;
            height: 18px;
        }

        .main {
            margin-left: 240px;
            flex: 1;
            padding: 2rem 2.5rem;
            min-height: 100vh;
        }

        .page-title {
            font-family: 'Syne', sans-serif;
            font-size: 1.5rem;
            font-weight: 700;
            color: #fff;
            margin-bottom: 0.25rem;
        }

        .page-sub {
            font-size: 0.85rem;
            color: var(--muted);
            margin-bottom: 2rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .invoice-badge {
            background: rgba(222, 255, 154, 0.12);
            color: var(--lime);
            padding: 0.2rem 0.6rem;
            border-radius: 6px;
            font-size: 0.78rem;
            font-family: 'Syne', sans-serif;
            font-weight: 700;
        }

        .kasir-grid {
            display: grid;
            grid-template-columns: 1fr 1.2fr;
            gap: 1.5rem;
        }

        .panel {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 1.5rem;
        }

        .panel-title {
            font-family: 'Syne', sans-serif;
            font-weight: 700;
            font-size: 0.95rem;
            color: #fff;
            margin-bottom: 1.25rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .panel-title svg {
            width: 18px;
            height: 18px;
            color: var(--lime);
        }

        .search-wrap {
            position: relative;
            margin-bottom: 1rem;
        }

        .search-wrap>svg {
            position: absolute;
            left: 0.85rem;
            top: 50%;
            transform: translateY(-50%);
            width: 16px;
            height: 16px;
            color: var(--muted);
            pointer-events: none;
        }

        .search-input {
            width: 100%;
            padding: 0.7rem 0.85rem 0.7rem 2.5rem;
            background: var(--card2);
            border: 1px solid var(--border);
            border-radius: 10px;
            color: var(--text);
            font-family: 'DM Sans', sans-serif;
            font-size: 0.9rem;
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .search-input:focus {
            border-color: rgba(222, 255, 154, 0.35);
            box-shadow: 0 0 0 3px rgba(222, 255, 154, 0.06);
        }

        .search-input::placeholder {
            color: rgba(107, 122, 153, 0.6);
        }

        .dropdown-results {
            position: absolute;
            top: calc(100% + 4px);
            left: 0;
            right: 0;
            background: var(--card2);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            z-index: 100;
            overflow: hidden;
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.4);
            display: none;
            max-height: 280px;
            overflow-y: auto;
        }

        .dropdown-results.show {
            display: block;
        }

        .product-option {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.75rem 1rem;
            cursor: pointer;
            transition: background 0.1s;
            border-bottom: 1px solid var(--border);
        }

        .product-option:last-child {
            border-bottom: none;
        }

        .product-option:hover,
        .product-option.focused {
            background: rgba(222, 255, 154, 0.07);
        }

        .po-name {
            font-size: 0.88rem;
            font-weight: 500;
            color: var(--text);
        }

        .po-stock {
            font-size: 0.72rem;
            color: var(--muted);
            margin-top: 2px;
        }

        .po-price {
            font-size: 0.85rem;
            font-weight: 500;
            color: var(--lime);
        }

        .selected-product {
            background: rgba(222, 255, 154, 0.06);
            border: 1px solid rgba(222, 255, 154, 0.15);
            border-radius: 12px;
            padding: 1rem;
            margin-bottom: 1rem;
            display: none;
        }

        .selected-product.show {
            display: block;
        }

        .sp-name {
            font-weight: 500;
            color: #fff;
            font-size: 0.9rem;
            margin-bottom: 4px;
        }

        .sp-meta {
            font-size: 0.78rem;
            color: var(--muted);
            display: flex;
            gap: 1rem;
        }

        .qty-row {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 1.25rem;
        }

        .qty-label {
            font-size: 0.8rem;
            color: var(--muted);
            flex-shrink: 0;
        }

        .qty-control {
            display: flex;
            align-items: center;
            background: var(--card2);
            border: 1px solid var(--border);
            border-radius: 10px;
            overflow: hidden;
        }

        .qty-btn {
            padding: 0.6rem 0.9rem;
            background: none;
            border: none;
            color: var(--text);
            font-size: 1.1rem;
            cursor: pointer;
            transition: background 0.15s;
        }

        .qty-btn:hover {
            background: rgba(255, 255, 255, 0.07);
            color: var(--lime);
        }

        .qty-input {
            background: none;
            border: none;
            color: #fff;
            font-family: 'Syne', sans-serif;
            font-size: 1rem;
            font-weight: 700;
            width: 50px;
            text-align: center;
            outline: none;
        }

        .btn-add {
            width: 100%;
            padding: 0.85rem;
            background: var(--lime);
            color: #0a0f1e;
            font-family: 'Syne', sans-serif;
            font-weight: 700;
            font-size: 0.9rem;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            transition: background 0.15s, transform 0.1s;
        }

        .btn-add:hover:not(:disabled) {
            background: var(--lime-dim);
        }

        .btn-add:active:not(:disabled) {
            transform: scale(0.98);
        }

        .btn-add svg {
            width: 18px;
            height: 18px;
        }

        .btn-add:disabled {
            opacity: 0.4;
            cursor: not-allowed;
        }

        .shortcut-hint {
            text-align: center;
            font-size: 0.72rem;
            color: var(--muted);
            margin-top: 0.6rem;
        }

        .key {
            background: var(--card2);
            border: 1px solid var(--border);
            border-radius: 4px;
            padding: 1px 6px;
            font-size: 0.68rem;
        }

        .cart-panel {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 16px;
            display: flex;
            flex-direction: column;
        }

        .cart-header {
            padding: 1.5rem 1.5rem 0;
        }

        .cart-items {
            flex: 1;
            padding: 0 1.5rem;
            overflow-y: auto;
            max-height: 340px;
        }

        .cart-empty {
            text-align: center;
            padding: 3rem 1rem;
            color: var(--muted);
        }

        .cart-empty svg {
            width: 40px;
            height: 40px;
            opacity: 0.3;
            margin-bottom: 0.75rem;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }

        .cart-empty p {
            font-size: 0.85rem;
        }

        .cart-row {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.85rem 0;
            border-bottom: 1px solid var(--border);
        }

        .cart-row:last-child {
            border-bottom: none;
        }

        .cart-row.new-item {
            animation: slideIn 0.25s ease-out;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateX(-8px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .cr-info {
            flex: 1;
            min-width: 0;
        }

        .cr-name {
            font-size: 0.88rem;
            font-weight: 500;
            color: var(--text);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .cr-price {
            font-size: 0.75rem;
            color: var(--muted);
            margin-top: 2px;
        }

        .cr-qty {
            display: flex;
            align-items: center;
            gap: 4px;
            flex-shrink: 0;
        }

        .cr-qty-btn {
            width: 26px;
            height: 26px;
            border-radius: 6px;
            background: var(--card2);
            border: 1px solid var(--border);
            color: var(--text);
            font-size: 1rem;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background 0.1s;
            line-height: 1;
        }

        .cr-qty-btn:hover {
            background: rgba(255, 255, 255, 0.1);
            color: var(--lime);
        }

        .cr-qty-num {
            font-family: 'Syne', sans-serif;
            font-weight: 700;
            color: #fff;
            font-size: 0.9rem;
            min-width: 28px;
            text-align: center;
        }

        .cr-sub {
            font-size: 0.88rem;
            font-weight: 500;
            color: var(--lime);
            min-width: 90px;
            text-align: right;
            flex-shrink: 0;
        }

        .cr-del {
            width: 28px;
            height: 28px;
            border-radius: 8px;
            background: rgba(248, 113, 113, 0.1);
            border: 1px solid rgba(248, 113, 113, 0.2);
            color: var(--danger);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background 0.1s;
            flex-shrink: 0;
        }

        .cr-del:hover {
            background: rgba(248, 113, 113, 0.25);
        }

        .cr-del svg {
            width: 14px;
            height: 14px;
        }

        .checkout-area {
            padding: 1.25rem 1.5rem 1.5rem;
            border-top: 1px solid var(--border);
        }

        .total-row {
            display: flex;
            justify-content: space-between;
            align-items: baseline;
            margin-bottom: 1rem;
        }

        .total-label {
            font-size: 0.85rem;
            color: var(--muted);
        }

        .total-value {
            font-family: 'Syne', sans-serif;
            font-size: 1.6rem;
            font-weight: 800;
            color: var(--lime);
        }

        .quick-cash {
            display: flex;
            gap: 0.5rem;
            flex-wrap: wrap;
            margin-bottom: 0.75rem;
        }

        .qc-btn {
            padding: 0.3rem 0.7rem;
            border-radius: 8px;
            background: var(--card2);
            border: 1px solid var(--border);
            color: var(--text);
            font-size: 0.75rem;
            cursor: pointer;
            transition: all 0.15s;
        }

        .qc-btn:hover {
            background: rgba(222, 255, 154, 0.1);
            border-color: rgba(222, 255, 154, 0.2);
            color: var(--lime);
        }

        .payment-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 0.75rem;
            margin-bottom: 1rem;
        }

        .pay-group label {
            font-size: 0.72rem;
            color: var(--muted);
            text-transform: uppercase;
            letter-spacing: 0.1em;
            display: block;
            margin-bottom: 0.4rem;
        }

        .pay-input {
            width: 100%;
            padding: 0.7rem 0.85rem;
            background: var(--card2);
            border: 1px solid var(--border);
            border-radius: 10px;
            color: var(--text);
            font-family: 'DM Sans', sans-serif;
            font-size: 0.9rem;
            outline: none;
            transition: border-color 0.2s;
        }

        .pay-input:focus {
            border-color: rgba(222, 255, 154, 0.35);
        }

        .pay-input[readonly] {
            color: var(--success);
            cursor: default;
        }

        .pay-input.insufficient {
            color: var(--danger) !important;
        }

        .btn-checkout {
            width: 100%;
            padding: 1rem;
            background: var(--success);
            color: #0a0f1e;
            font-family: 'Syne', sans-serif;
            font-weight: 800;
            font-size: 1rem;
            border: none;
            border-radius: 12px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.75rem;
            transition: opacity 0.2s, transform 0.1s;
            letter-spacing: 0.05em;
        }

        .btn-checkout:hover:not(:disabled) {
            opacity: 0.9;
        }

        .btn-checkout:active:not(:disabled) {
            transform: scale(0.98);
        }

        .btn-checkout:disabled {
            opacity: 0.3;
            cursor: not-allowed;
        }

        .btn-checkout svg {
            width: 20px;
            height: 20px;
        }

        .toast {
            position: fixed;
            bottom: 2rem;
            right: 2rem;
            background: var(--card2);
            border: 1px solid rgba(74, 222, 128, 0.3);
            border-radius: 12px;
            padding: 0.75rem 1.25rem;
            font-size: 0.85rem;
            color: var(--success);
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transform: translateY(100px);
            opacity: 0;
            transition: all 0.3s ease;
            z-index: 999;
        }

        .toast.show {
            transform: translateY(0);
            opacity: 1;
        }

        .toast svg {
            width: 16px;
            height: 16px;
            flex-shrink: 0;
        }

        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.7);
            z-index: 1000;
            align-items: center;
            justify-content: center;
        }

        .modal.show {
            display: flex;
        }

        .modal-content {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 20px;
            padding: 2rem;
            max-width: 440px;
            width: 90%;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5);
            animation: modalUp 0.3s ease-out;
        }

        @keyframes modalUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .modal-title {
            font-family: 'Syne', sans-serif;
            font-size: 1.3rem;
            font-weight: 700;
            color: #fff;
            margin-bottom: 0.4rem;
        }

        .modal-desc {
            font-size: 0.86rem;
            color: var(--muted);
            margin-bottom: 1.5rem;
        }

        .modal-summary {
            background: rgba(222, 255, 154, 0.05);
            border: 1px solid rgba(222, 255, 154, 0.12);
            border-radius: 12px;
            padding: 1.1rem;
            margin-bottom: 1.5rem;
        }

        .ms-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.45rem 0;
            font-size: 0.88rem;
        }

        .ms-label {
            color: var(--muted);
        }

        .ms-value {
            font-weight: 600;
            color: var(--lime);
        }

        .ms-row.divider {
            border-top: 1px solid rgba(222, 255, 154, 0.15);
            padding-top: 0.7rem;
            margin-top: 0.3rem;
            font-size: 1rem;
        }

        .modal-buttons {
            display: flex;
            gap: 0.75rem;
        }

        .modal-btn {
            flex: 1;
            padding: 0.85rem;
            border: none;
            border-radius: 10px;
            font-family: 'Syne', sans-serif;
            font-weight: 700;
            font-size: 0.9rem;
            cursor: pointer;
            transition: all 0.15s;
        }

        .modal-btn.cancel {
            background: var(--card2);
            border: 1px solid var(--border);
            color: var(--text);
        }

        .modal-btn.cancel:hover {
            background: rgba(255, 255, 255, 0.06);
        }

        .modal-btn.confirm {
            background: var(--success);
            color: #0a0f1e;
        }

        .modal-btn.confirm:hover:not(:disabled) {
            opacity: 0.9;
        }

        .modal-btn.confirm:disabled {
            opacity: 0.4;
            cursor: not-allowed;
        }

        .receipt-backdrop {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.75);
            z-index: 1000;
        }

        .receipt-backdrop.show {
            display: block;
        }

        .receipt {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: #fff;
            color: #111;
            border-radius: 16px;
            padding: 2rem;
            max-width: 380px;
            width: 90%;
            z-index: 1001;
            font-family: 'Courier New', monospace;
            font-size: 0.82rem;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5);
        }

        .receipt.show {
            display: block;
            animation: modalUp 0.3s ease-out;
        }

        .rh {
            text-align: center;
            border-bottom: 2px dashed #ccc;
            padding-bottom: 1rem;
            margin-bottom: 1rem;
        }

        .rh-title {
            font-size: 1.3rem;
            font-weight: 700;
            letter-spacing: -0.5px;
        }

        .rh-sub {
            font-size: 0.78rem;
            color: #666;
            margin-top: 2px;
        }

        .r-meta {
            text-align: center;
            margin-bottom: 1rem;
            font-size: 0.78rem;
            color: #555;
        }

        .r-items {
            border-bottom: 1px dashed #ccc;
            margin-bottom: 0.75rem;
            padding-bottom: 0.75rem;
        }

        .r-item {
            display: grid;
            grid-template-columns: 1fr auto auto;
            gap: 0.5rem;
            margin-bottom: 0.4rem;
            align-items: start;
        }

        .r-item-name {
            word-break: break-word;
        }

        .r-item-qty {
            text-align: right;
            white-space: nowrap;
            color: #555;
        }

        .r-item-price {
            text-align: right;
            white-space: nowrap;
        }

        .r-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 0.3rem;
        }

        .r-row.bold {
            font-weight: 700;
            border-top: 1px dashed #ccc;
            padding-top: 0.5rem;
            margin-top: 0.3rem;
        }

        .r-footer {
            text-align: center;
            border-top: 1px dashed #ccc;
            padding-top: 0.75rem;
            margin-top: 0.75rem;
            font-size: 0.72rem;
            color: #888;
        }

        .receipt-btns {
            display: flex;
            gap: 0.75rem;
            margin-top: 1.25rem;
        }

        .receipt-btn {
            flex: 1;
            padding: 0.7rem;
            border: none;
            border-radius: 8px;
            font-size: 0.84rem;
            font-weight: 700;
            cursor: pointer;
        }

        .receipt-btn.print {
            background: #111;
            color: #fff;
        }

        .receipt-btn.done {
            background: #deff9a;
            color: #000;
        }
    </style>
</head>

<body>

    <aside class="sidebar">
        <div class="sidebar-logo">ELS <span>POS</span></div>
        <div class="nav-section">Menu</div>
        <a href="/dashboard" class="nav-item">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <rect x="3" y="3" width="7" height="7" />
                <rect x="14" y="3" width="7" height="7" />
                <rect x="14" y="14" width="7" height="7" />
                <rect x="3" y="14" width="7" height="7" />
            </svg>
            Dashboard
        </a>
        <a href="/sales" class="nav-item">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                <polyline points="14 2 14 8 20 8" />
                <line x1="16" y1="13" x2="8" y2="13" />
                <line x1="16" y1="17" x2="8" y2="17" />
            </svg>
            Riwayat Penjualan
        </a>
        <a href="/sales/create" class="nav-btn">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                <line x1="12" y1="5" x2="12" y2="19" />
                <line x1="5" y1="12" x2="19" y2="12" />
            </svg>
            Transaksi Baru
        </a>
        <div class="sidebar-spacer"></div>
        <div class="sidebar-summary">
            <div class="summary-label">Item dalam Keranjang</div>
            <div class="summary-value" id="sidebar-item-count">0</div>
            <div class="summary-label second">Total Transaksi</div>
            <div class="summary-value" id="sidebar-total">Rp 0</div>
        </div>
        <a href="/logout" class="nav-logout">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" />
                <polyline points="16 17 21 12 16 7" />
                <line x1="21" y1="12" x2="9" y2="12" />
            </svg>
            Keluar
        </a>
    </aside>

    <main class="main">
        <div class="page-title">Kasir / Transaksi Baru</div>
        <div class="page-sub">
            No. Invoice: <span class="invoice-badge"><?= isset($invoice) ? $invoice : 'INV-' . date('YmdHis') ?></span>
        </div>

        <input type="hidden" id="invoice-val" value="<?= isset($invoice) ? $invoice : 'INV-' . date('YmdHis') ?>">

        <div class="kasir-grid">

            <div class="panel">
                <div class="panel-title">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z" />
                        <line x1="7" y1="7" x2="7.01" y2="7" />
                    </svg>
                    Pilih Produk
                </div>

                <div class="search-wrap">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="11" cy="11" r="8" />
                        <line x1="21" y1="21" x2="16.65" y2="16.65" />
                    </svg>
                    <input type="text" id="product-search" class="search-input" placeholder="Cari nama produk..." autocomplete="off">
                    <div class="dropdown-results" id="dropdown-results"></div>
                </div>

                <div class="selected-product" id="selected-info">
                    <div class="sp-name" id="sp-name">—</div>
                    <div class="sp-meta">
                        <span>💰 Harga: <strong id="sp-price" style="color:var(--lime)">Rp 0</strong></span>
                        <span>📦 Stok: <strong id="sp-stock">0</strong></span>
                    </div>
                </div>

                <div class="qty-row">
                    <span class="qty-label">Jumlah:</span>
                    <div class="qty-control">
                        <button class="qty-btn" id="qty-minus">−</button>
                        <input type="number" class="qty-input" id="qty" value="1" min="1">
                        <button class="qty-btn" id="qty-plus">+</button>
                    </div>
                </div>

                <button class="btn-add" id="btn-add" disabled>
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                        <line x1="12" y1="5" x2="12" y2="19" />
                        <line x1="5" y1="12" x2="19" y2="12" />
                    </svg>
                    Tambah ke Keranjang
                </button>
                <div class="shortcut-hint">Tekan <span class="key">Enter</span> untuk menambah &nbsp;|&nbsp; <span class="key">Esc</span> untuk batal</div>

                <script id="products-data" type="application/json">
                    <?php
                    $productsJson = [];
                    foreach (($products ?? []) as $p) {
                        $productsJson[] = [
                            'id'    => (int)$p['id'],
                            'name'  => $p['name'],
                            'price' => (float)$p['price'],
                            'stock' => (int)$p['stock'],
                        ];
                    }
                    echo json_encode($productsJson, JSON_UNESCAPED_UNICODE);
                    ?>
                </script>
            </div>

            <div class="cart-panel">
                <div class="cart-header">
                    <div class="panel-title" style="margin-bottom:1rem;">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="9" cy="21" r="1" />
                            <circle cx="20" cy="21" r="1" />
                            <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6" />
                        </svg>
                        Keranjang Belanja
                        <span id="cart-badge" style="margin-left:auto;font-size:0.72rem;background:rgba(222,255,154,0.12);color:var(--lime);padding:0.15rem 0.55rem;border-radius:20px;display:none;">0 item</span>
                    </div>
                </div>

                <div class="cart-items" id="cart-items">
                    <div class="cart-empty" id="cart-empty">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            <circle cx="9" cy="21" r="1" />
                            <circle cx="20" cy="21" r="1" />
                            <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6" />
                        </svg>
                        <p>Keranjang masih kosong</p>
                    </div>
                </div>

                <div class="checkout-area">
                    <div class="total-row">
                        <span class="total-label">Total Belanja</span>
                        <span class="total-value">Rp <span id="grand-total">0</span></span>
                    </div>

                    <div style="font-size:0.72rem;color:var(--muted);margin-bottom:0.4rem;">Nominal cepat:</div>
                    <div class="quick-cash">
                        <button class="qc-btn" onclick="setQuickCash(50000)">Rp 50K</button>
                        <button class="qc-btn" onclick="setQuickCash(100000)">Rp 100K</button>
                        <button class="qc-btn" onclick="setQuickCash(200000)">Rp 200K</button>
                        <button class="qc-btn" onclick="setQuickCash(500000)">Rp 500K</button>
                        <button class="qc-btn" onclick="setExact()">Pas</button>
                    </div>

                    <div class="payment-row">
                        <div class="pay-group">
                            <label>Uang Diterima</label>
                            <input type="number" id="cash-input" class="pay-input" placeholder="0" oninput="calcChange()">
                        </div>
                        <div class="pay-group">
                            <label>Uang Kembali</label>
                            <input type="text" id="change-display" class="pay-input" value="Rp 0" readonly>
                        </div>
                    </div>

                    <button class="btn-checkout" id="btn-checkout" disabled>
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                            <polyline points="20 12 20 22 4 22 4 12" />
                            <rect x="2" y="7" width="20" height="5" />
                            <line x1="12" y1="22" x2="12" y2="7" />
                        </svg>
                        PROSES TRANSAKSI
                    </button>
                </div>
            </div>
        </div>
    </main>

    <div class="toast" id="toast">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <polyline points="20 6 9 17 4 12" />
        </svg>
        <span id="toast-msg">OK</span>
    </div>

    <div class="modal" id="modal-confirm">
        <div class="modal-content">
            <div class="modal-title">Konfirmasi Transaksi</div>
            <div class="modal-desc">Periksa kembali sebelum diproses.</div>
            <div class="modal-summary">
                <div class="ms-row"><span class="ms-label">Jumlah Item</span><span class="ms-value" id="conf-items">0</span></div>
                <div class="ms-row"><span class="ms-label">Total Belanja</span><span class="ms-value" id="conf-total">Rp 0</span></div>
                <div class="ms-row"><span class="ms-label">Uang Diterima</span><span class="ms-value" id="conf-cash">Rp 0</span></div>
                <div class="ms-row divider"><span class="ms-label">Uang Kembali</span><span class="ms-value" id="conf-change">Rp 0</span></div>
            </div>
            <div class="modal-buttons">
                <button class="modal-btn cancel" onclick="closeModal()">Batal</button>
                <button class="modal-btn confirm" id="btn-confirm" onclick="doTransaction()">Proses</button>
            </div>
        </div>
    </div>

    <div class="receipt-backdrop" id="receipt-backdrop"></div>
    <div class="receipt" id="receipt">
        <div class="rh">
            <div class="rh-title">ELS POS</div>
            <div class="rh-sub">Bukti Transaksi</div>
        </div>
        <div class="r-meta">
            <div>Invoice: <strong id="r-invoice">—</strong></div>
            <div style="color:#888">Waktu: <span id="r-time">—</span></div>
        </div>
        <div class="r-items" id="r-items"></div>
        <div class="r-row bold"><span>Total</span><span id="r-total">Rp 0</span></div>
        <div class="r-row" style="color:#555"><span>Dibayar</span><span id="r-paid">Rp 0</span></div>
        <div class="r-row bold"><span>Kembali</span><span id="r-change">Rp 0</span></div>
        <div class="r-footer">
            <p>Terima kasih telah berbelanja!</p>
            <p style="margin-top:4px">© 2025 ELS Systems</p>
        </div>
        <div class="receipt-btns">
            <button class="receipt-btn print" onclick="window.print()">🖨 Cetak</button>
            <button class="receipt-btn done" onclick="doneReceipt()">✓ Selesai</button>
        </div>
    </div>

    <script>
        const PRODUCTS = JSON.parse(document.getElementById('products-data').textContent);

        let cart = [];
        let grandTotal = 0;
        let selectedProduct = null;
        let focusIndex = -1;

        const cartEmptyEl = document.getElementById('cart-empty');

        const searchEl = document.getElementById('product-search');
        const dropdownEl = document.getElementById('dropdown-results');

        searchEl.addEventListener('input', function() {
            const q = this.value.toLowerCase().trim();
            if (!q) {
                dropdownEl.classList.remove('show');
                return;
            }

            const matches = PRODUCTS.filter(p => p.name.toLowerCase().includes(q)).slice(0, 8);

            if (!matches.length) {
                dropdownEl.innerHTML = '<div style="padding:1rem;color:var(--muted);font-size:0.85rem;text-align:center">Produk tidak ditemukan</div>';
                dropdownEl.classList.add('show');
                return;
            }

            dropdownEl.innerHTML = matches.map((p, i) => `
        <div class="product-option" data-idx="${i}" onclick='selectProduct(${JSON.stringify(p)})'>
            <div>
                <div class="po-name">${p.name}</div>
                <div class="po-stock">Stok: ${p.stock}</div>
            </div>
            <div class="po-price">Rp ${p.price.toLocaleString('id-ID')}</div>
        </div>
    `).join('');
            dropdownEl.classList.add('show');
            focusIndex = -1;
        });

        searchEl.addEventListener('keydown', function(e) {
            const opts = dropdownEl.querySelectorAll('.product-option');
            if (e.key === 'ArrowDown') {
                e.preventDefault();
                focusIndex = Math.min(focusIndex + 1, opts.length - 1);
                opts.forEach((el, i) => el.classList.toggle('focused', i === focusIndex));
            } else if (e.key === 'ArrowUp') {
                e.preventDefault();
                focusIndex = Math.max(focusIndex - 1, -1);
                opts.forEach((el, i) => el.classList.toggle('focused', i === focusIndex));
            } else if (e.key === 'Enter') {
                if (focusIndex > -1 && opts[focusIndex]) {
                    opts[focusIndex].click();
                    return;
                }
                if (selectedProduct) addToCart();
            } else if (e.key === 'Escape') {
                dropdownEl.classList.remove('show');
                searchEl.value = '';
                clearSelected();
            }
        });

        document.addEventListener('click', function(e) {
            if (!searchEl.contains(e.target) && !dropdownEl.contains(e.target)) {
                dropdownEl.classList.remove('show');
            }
        });

        function selectProduct(p) {
            selectedProduct = p;
            searchEl.value = p.name;
            dropdownEl.classList.remove('show');

            document.getElementById('sp-name').textContent = p.name;
            document.getElementById('sp-price').textContent = 'Rp ' + p.price.toLocaleString('id-ID');
            document.getElementById('sp-stock').textContent = p.stock;
            document.getElementById('selected-info').classList.add('show');
            document.getElementById('btn-add').disabled = false;
            document.getElementById('qty').max = p.stock;
            document.getElementById('qty').value = 1;
        }

        function clearSelected() {
            selectedProduct = null;
            document.getElementById('selected-info').classList.remove('show');
            document.getElementById('btn-add').disabled = true;
        }


        document.getElementById('qty-minus').addEventListener('click', () => {
            const el = document.getElementById('qty');
            el.value = Math.max(1, parseInt(el.value || 1) - 1);
        });
        document.getElementById('qty-plus').addEventListener('click', () => {
            const el = document.getElementById('qty');
            const max = selectedProduct ? selectedProduct.stock : 999;
            el.value = Math.min(max, parseInt(el.value || 1) + 1);
        });


        document.getElementById('btn-add').addEventListener('click', addToCart);

        function addToCart() {
            if (!selectedProduct) return;

            const qty = parseInt(document.getElementById('qty').value) || 1;
            const p = selectedProduct;

            if (qty < 1) {
                showToast('Jumlah tidak valid', 'error');
                return;
            }
            if (qty > p.stock) {
                showToast('Stok hanya ' + p.stock + ' pcs', 'error');
                return;
            }

            const idx = cart.findIndex(item => item.product_id === p.id);

            if (idx > -1) {
                const newQty = cart[idx].qty + qty;
                if (newQty > p.stock) {
                    showToast('Total qty melebihi stok (' + p.stock + ')', 'error');
                    return;
                }
                cart[idx].qty = newQty;
                cart[idx].subtotal = newQty * p.price;
                showToast(p.name + ' diperbarui (qty: ' + newQty + ')');
            } else {
                cart.push({
                    product_id: p.id,
                    name: p.name,
                    price: p.price,
                    stock: p.stock,
                    qty: qty,
                    subtotal: qty * p.price,
                    isNew: true,
                });
                showToast(p.name + ' ditambahkan!');
            }

            renderCart();

            searchEl.value = '';
            clearSelected();
            document.getElementById('qty').value = 1;
            searchEl.focus();
        }

        function renderCart() {
            grandTotal = cart.reduce((sum, item) => sum + item.subtotal, 0);

            const container = document.getElementById('cart-items');
            const badge = document.getElementById('cart-badge');

            if (cart.length === 0) {
                if (!container.contains(cartEmptyEl)) {
                    container.innerHTML = '';
                    container.appendChild(cartEmptyEl);
                } else {
                    container.innerHTML = '';
                    container.appendChild(cartEmptyEl);
                }
                cartEmptyEl.style.display = '';
                badge.style.display = 'none';
                document.getElementById('grand-total').textContent = '0';
                document.getElementById('btn-checkout').disabled = true;
                document.getElementById('sidebar-item-count').textContent = '0';
                document.getElementById('sidebar-total').textContent = 'Rp 0';
                calcChange();
                return;
            }

            cartEmptyEl.style.display = 'none';
            badge.style.display = '';
            badge.textContent = cart.length + ' item';

            if (container.contains(cartEmptyEl)) {
                container.removeChild(cartEmptyEl);
            }

            container.innerHTML = '';
            cart.forEach((item, idx) => {
                const row = document.createElement('div');
                row.className = 'cart-row' + (item.isNew ? ' new-item' : '');
                row.dataset.idx = idx;
                item.isNew = false;

                row.innerHTML = `
            <div class="cr-info">
                <div class="cr-name" title="${item.name}">${item.name}</div>
                <div class="cr-price">Rp ${item.price.toLocaleString('id-ID')} / pcs</div>
            </div>
            <div class="cr-qty">
                <button class="cr-qty-btn" onclick="changeQty(${idx}, -1)">−</button>
                <span class="cr-qty-num">${item.qty}</span>
                <button class="cr-qty-btn" onclick="changeQty(${idx}, +1)">+</button>
            </div>
            <div class="cr-sub">Rp ${item.subtotal.toLocaleString('id-ID')}</div>
            <button class="cr-del" onclick="removeItem(${idx})" title="Hapus item">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <polyline points="3 6 5 6 21 6"/>
                    <path d="M19 6l-1 14H6L5 6"/>
                    <path d="M10 11v6"/><path d="M14 11v6"/>
                    <path d="M9 6V4h6v2"/>
                </svg>
            </button>
        `;
                container.appendChild(row);
            });

            document.getElementById('grand-total').textContent = grandTotal.toLocaleString('id-ID');
            document.getElementById('btn-checkout').disabled = false;
            document.getElementById('sidebar-item-count').textContent = cart.length;
            document.getElementById('sidebar-total').textContent = 'Rp ' + grandTotal.toLocaleString('id-ID');
            calcChange();
        }

        function changeQty(idx, delta) {
            const item = cart[idx];
            const newQty = item.qty + delta;

            if (newQty < 1) {
                removeItem(idx);
                return;
            }
            if (newQty > item.stock) {
                showToast('Stok hanya ' + item.stock + ' pcs', 'error');
                return;
            }

            item.qty = newQty;
            item.subtotal = newQty * item.price;
            renderCart();
        }

        function removeItem(idx) {
            cart.splice(idx, 1);
            renderCart();
        }

        function calcChange() {
            const cash = parseFloat(document.getElementById('cash-input').value) || 0;
            const change = cash - grandTotal;
            const el = document.getElementById('change-display');

            if (grandTotal === 0) {
                el.value = 'Rp 0';
                el.classList.remove('insufficient');
                return;
            }

            if (change >= 0) {
                el.value = 'Rp ' + change.toLocaleString('id-ID');
                el.classList.remove('insufficient');
            } else {
                el.value = 'Kurang Rp ' + Math.abs(change).toLocaleString('id-ID');
                el.classList.add('insufficient');
            }
        }

        function setQuickCash(amount) {
            document.getElementById('cash-input').value = amount;
            calcChange();
        }

        function setExact() {
            document.getElementById('cash-input').value = grandTotal;
            calcChange();
        }

        document.getElementById('btn-checkout').addEventListener('click', function() {
            const cash = parseFloat(document.getElementById('cash-input').value) || 0;
            if (cash < grandTotal) {
                showToast('Uang pembayaran kurang!', 'error');
                return;
            }

            const change = cash - grandTotal;

            document.getElementById('conf-items').textContent = cart.length + ' item';
            document.getElementById('conf-total').textContent = 'Rp ' + grandTotal.toLocaleString('id-ID');
            document.getElementById('conf-cash').textContent = 'Rp ' + cash.toLocaleString('id-ID');
            document.getElementById('conf-change').textContent = 'Rp ' + change.toLocaleString('id-ID');
            document.getElementById('modal-confirm').classList.add('show');
        });

        function closeModal() {
            document.getElementById('modal-confirm').classList.remove('show');
            const btn = document.getElementById('btn-confirm');
            btn.disabled = false;
            btn.textContent = 'Proses';
        }

        function doTransaction() {
            const cash = parseFloat(document.getElementById('cash-input').value) || 0;
            const change = cash - grandTotal;
            const btn = document.getElementById('btn-confirm');

            btn.disabled = true;
            btn.textContent = 'Memproses...';

            fetch('/sales/store', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        invoice: document.getElementById('invoice-val').value,
                        total: grandTotal,
                        cash: cash,
                        change: change,
                        cart: cart,
                    }),
                })
                .then(r => r.json())
                .then(data => {
                    if (data.status === 'success') {
                        closeModal();
                        showReceipt(cash, change);
                    } else {
                        btn.disabled = false;
                        btn.textContent = 'Proses';
                        showToast(data.message || 'Terjadi kesalahan', 'error');
                    }
                })
                .catch(() => {
                    btn.disabled = false;
                    btn.textContent = 'Proses';
                    showToast('Gagal terhubung ke server', 'error');
                });
        }

        function showReceipt(cash, change) {
            const now = new Date();
            document.getElementById('r-invoice').textContent = document.getElementById('invoice-val').value;
            document.getElementById('r-time').textContent = now.toLocaleString('id-ID');

            document.getElementById('r-items').innerHTML = cart.map(item => `
        <div class="r-item">
            <span class="r-item-name">${item.name}</span>
            <span class="r-item-qty">${item.qty}x</span>
            <span class="r-item-price">Rp ${item.subtotal.toLocaleString('id-ID')}</span>
        </div>
    `).join('');

            document.getElementById('r-total').textContent = 'Rp ' + grandTotal.toLocaleString('id-ID');
            document.getElementById('r-paid').textContent = 'Rp ' + cash.toLocaleString('id-ID');
            document.getElementById('r-change').textContent = 'Rp ' + change.toLocaleString('id-ID');

            document.getElementById('receipt-backdrop').classList.add('show');
            document.getElementById('receipt').classList.add('show');
        }

        function doneReceipt() {
            document.getElementById('receipt-backdrop').classList.remove('show');
            document.getElementById('receipt').classList.remove('show');

            cart = [];
            selectedProduct = null;
            document.getElementById('cash-input').value = '';
            renderCart();
            searchEl.value = '';
            clearSelected();
            searchEl.focus();
            showToast('Transaksi selesai! Siap transaksi baru.');
        }

        let toastTimer;

        function showToast(msg, type = 'success') {
            const el = document.getElementById('toast');
            document.getElementById('toast-msg').textContent = msg;
            el.style.borderColor = type === 'error' ? 'rgba(248,113,113,0.35)' : 'rgba(74,222,128,0.35)';
            el.style.color = type === 'error' ? 'var(--danger)' : 'var(--success)';
            el.classList.add('show');
            clearTimeout(toastTimer);
            toastTimer = setTimeout(() => el.classList.remove('show'), 2800);
        }

        window.addEventListener('DOMContentLoaded', () => {
            renderCart();
            searchEl.focus();
        });
    </script>
</body>

</html>