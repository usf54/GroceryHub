<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Driver Panel</title>

<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: "Nunito", system-ui, -apple-system, Segoe UI, Roboto, sans-serif;
}

:root {
    --primary: #ff9800;
    --bg: #f5f7fb;
    --sidebar: #0b1220;
    --card: #ffffff;
    --text: #0f172a;
    --muted: #6b7280;
    --border: #e5e7eb;
}

/* GLOBAL */
body {
    background: var(--bg);
    display: flex;
    min-height: 100vh;
    color: var(--text);
}

/* SIDEBAR (modern SaaS style) */
.sidebar {
    width: 250px;
    background: linear-gradient(180deg, #0b1220, #0f172a);
    color: white;
    padding: 22px 18px;
    display: flex;
    flex-direction: column;
    gap: 6px;
    border-right: 1px solid rgba(255,255,255,0.05);
}

.sidebar .logo {
    font-size: 18px;
    font-weight: 800;
    margin-bottom: 18px;
}

.sidebar .logo span {
    color: var(--primary);
}

/* NAV LINKS */
.nav-link {
    display: flex;
    align-items: center;
    gap: 10px;
    text-decoration: none;
    color: rgba(255,255,255,0.75);
    padding: 10px 12px;
    border-radius: 10px;
    font-size: 14px;
    transition: 0.2s ease;
}

.nav-link:hover {
    background: rgba(255,255,255,0.08);
    color: white;
    transform: translateX(2px);
}

/* MAIN */
.main {
    flex: 1;
    display: flex;
    flex-direction: column;
}

/* TOPBAR */
.topbar {
    background: white;
    padding: 14px 22px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-bottom: 1px solid var(--border);
    position: sticky;
    top: 0;
    z-index: 10;
}

.topbar .title {
    font-size: 16px;
    font-weight: 800;
    letter-spacing: -0.2px;
}

/* LOGOUT */
.logout-btn {
    background: transparent;
    border: 1px solid var(--border);
    padding: 7px 12px;
    border-radius: 10px;
    font-size: 13px;
    cursor: pointer;
    transition: 0.2s ease;
    font-weight: 600;
}

.logout-btn:hover {
    border-color: var(--primary);
    color: var(--primary);
}

/* CONTENT */
.content {
    padding: 26px;
}

/* CARDS SYSTEM (modern SaaS) */
.grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 14px;
}

.card {
    background: var(--card);
    border: 1px solid var(--border);
    border-radius: 14px;
    padding: 18px;
    box-shadow: 0 2px 10px rgba(15, 23, 42, 0.04);
    transition: 0.2s ease;
}

.card:hover {
    transform: translateY(-3px);
    border-color: var(--primary);
    box-shadow: 0 10px 25px rgba(15, 23, 42, 0.08);
}

.card h4 {
    font-size: 13px;
    color: var(--muted);
    font-weight: 600;
}

.card p {
    margin-top: 6px;
    font-size: 22px;
    font-weight: 800;
}

/* ORDER LIST */
.order {
    background: var(--card);
    border: 1px solid var(--border);
    border-radius: 14px;
    padding: 16px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    transition: 0.2s ease;
    box-shadow: 0 2px 10px rgba(15, 23, 42, 0.04);
}

.order:hover {
    transform: translateY(-2px);
    border-color: var(--primary);
}

.order-title {
    font-weight: 800;
    font-size: 15px;
}

.order-sub {
    font-size: 13px;
    color: var(--muted);
    margin-top: 3px;
}

/* BUTTONS */
.btn {
    padding: 8px 12px;
    border-radius: 10px;
    border: none;
    font-weight: 700;
    font-size: 13px;
    cursor: pointer;
    transition: 0.2s ease;
}

.btn-primary {
    background: var(--primary);
    color: white;
    box-shadow: 0 6px 14px rgba(255,152,0,0.25);
}

.btn-primary:hover {
    transform: translateY(-1px);
}

.btn-light {
    background: #f1f5f9;
}

.btn-light:hover {
    background: #e2e8f0;
}

/* RESPONSIVE */
@media (max-width: 900px) {
    .grid {
        grid-template-columns: 1fr;
    }

    .sidebar {
        display: none;
    }
}
</style>
</head>

<body>

<!-- SIDEBAR -->
<div class="sidebar">
    <div class="logo">🚚 Grocery<span>Hub</span></div>

    <a href="/driver/dashboard" class="nav-link">🏠 Dashboard</a>
    <a href="/driver/orders" class="nav-link">📦 Deliveries</a>
    <a href="#" class="nav-link">📊 History</a>
</div>

<!-- MAIN -->
<div class="main">

    <div class="topbar">
        <div class="title">@yield('title')</div>

        <form method="POST" action="/logout">
            @csrf
            <button class="logout-btn">Logout</button>
        </form>
    </div>

    <div class="content">
        @yield('content')
    </div>

</div>

</body>
</html>