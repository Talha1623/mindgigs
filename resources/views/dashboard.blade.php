<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Dashboard | MindGigs</title>

  <!-- Bootstrap CSS & Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #f4f6fa;
      margin: 0;
    }
    .sidebar {
      width: 220px;
      height: 100vh;
      background-color: #1e2a45;
      position: fixed;
      top: 0;
      left: 0;
      padding: 20px 0;
      display: flex;
      flex-direction: column;
      color: #fff;
      transition: transform 0.3s ease;
      z-index: 1030;
    }
    .sidebar.hide {
      transform: translateX(-100%);
    }
    .sidebar .logo {
      font-size: 1.6rem;
      font-weight: bold;
      color: #fff;
      text-align: center;
      margin-bottom: 30px;
    }
    .sidebar nav a {
      display: flex;
      align-items: center;
      gap: 16px;
      padding: 12px 20px;
      color: #a0b4d4;
      font-size: 1rem;
      text-decoration: none;
      transition: background 0.3s, color 0.3s;
    }
    .sidebar nav a:hover,
    .sidebar nav a.active {
      background-color: #3c4b6b;
      color: #fff;
    }
    .sidebar nav a i {
      font-size: 1.2rem;
    }
    .main-content {
      margin-left: 220px;
      padding: 24px;
      transition: margin-left 0.3s ease;
    }
    .card-box {
      background: #fff;
      border-radius: 12px;
      padding: 20px;
      box-shadow: 0 2px 10px rgba(0,0,0,0.05);
      transition: 0.3s ease-in-out;
    }
    .card-box:hover {
      transform: translateY(-3px);
    }
    .card-title {
      font-size: 0.85rem;
      color: #888;
    }
    .card-value {
      font-size: 1.8rem;
      font-weight: 600;
    }
    canvas {
      max-height: 220px;
    }
    .mobile-header {
      display: none;
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 60px;
      background-color: #fff;
      box-shadow: 0 1px 3px rgba(0,0,0,0.1);
      z-index: 1020;
      align-items: center;
      padding: 0 16px;
    }
    .sidebar-toggle-btn {
      background: none;
      border: none;
      font-size: 1.5rem;
      cursor: pointer;
      color: #1e2a45;
    }
    @media (max-width: 991.98px) {
      .sidebar {
        transform: translateX(-100%);
      }
      .sidebar.show {
        transform: translateX(0);
      }
      .main-content {
        margin-left: 0;
        margin-top: 60px;
      }
      .mobile-header {
        display: flex;
        justify-content: space-between;
      }
    }
  </style>
</head>
<body>

<!-- Mobile Header -->
<div class="mobile-header">
  <button class="sidebar-toggle-btn" id="sidebarToggle"><i class="bi bi-list"></i></button>
  <strong class="ms-3">MindGigs</strong>
</div>

<!-- Sidebar -->
<div class="sidebar" id="sidebar">
  <div class="logo">MindGigs</div>
  <nav>
    <a href="#" class="active"><i class="bi bi-grid"></i> Dashboard</a>
    <a href="{{ route('today.deals') }}"><i class="bi bi-person"></i> Today Deals</a>
    <a href="{{ route('visitors.index') }}"><i class="bi bi-people"></i> Visitors</a>
    <a href="{{ route('projects') }}"><i class="bi bi-briefcase"></i> Projects</a>
    <a href="{{ route('interns.index') }}"><i class="bi bi-person-badge"></i> Interny</a>

    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
      <i class="bi bi-box-arrow-right"></i> Logout
    </a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
      @csrf
    </form>
  </nav>
</div>

<!-- Main Content -->
<div class="main-content" id="mainContent">

  <!-- Logged in user display -->
  <!-- Logged in user display -->
<div class="mb-4">
  <h2>Logged in as: <strong>{{ Auth::user()->name }}</strong></h2>
</div>


  <!-- Cards -->
  <div class="row g-4 mb-4">
    <div class="col-md-4">
      <div class="card-box">
        <div class="card-title">Today's Visitors</div>
        <div class="card-value" id="visitors">15</div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card-box">
        <div class="card-title">Today's Deals</div>
        <div class="card-value" id="deals">5</div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card-box">
        <div class="card-title">Staff Available</div>
        <div class="card-value" id="staff">8</div>
      </div>
    </div>
  </div>

  <!-- Charts -->
  <div class="row g-4">
    <div class="col-md-4">
      <div class="card-box">
        <h6 class="mb-3">📈 Visitors (Line Chart)</h6>
        <canvas id="visitorsChart"></canvas>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card-box">
        <h6 class="mb-3">📊 Deals (Histogram)</h6>
        <canvas id="dealsChart"></canvas>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card-box">
        <h6 class="mb-3">📉 Staff (Area Chart)</h6>
        <canvas id="staffChart"></canvas>
      </div>
    </div>
  </div>
</div>

<!-- Chart.js scripts -->
<script>
  const visitorData = [5, 10, 7, 14, 9, 15, 13];
  const dealData = [1, 2, 4, 3, 5, 2, 5];
  const staffData = [6, 7, 8, 8, 7, 9, 8];
  const days = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];

  new Chart(document.getElementById('visitorsChart'), {
    type: 'line',
    data: {
      labels: days,
      datasets: [{
        label: 'Visitors',
        data: visitorData,
        borderColor: '#0d6efd',
        backgroundColor: 'rgba(13, 110, 253, 0.1)',
        fill: false,
        tension: 0.4
      }]
    },
    options: { responsive: true, plugins: { legend: { display: false } } }
  });

  new Chart(document.getElementById('dealsChart'), {
    type: 'bar',
    data: {
      labels: days,
      datasets: [{
        label: 'Deals',
        data: dealData,
        backgroundColor: '#198754',
        borderRadius: 8
      }]
    },
    options: {
      responsive: true,
      plugins: { legend: { display: false } },
      scales: { y: { beginAtZero: true } }
    }
  });

  new Chart(document.getElementById('staffChart'), {
    type: 'line',
    data: {
      labels: days,
      datasets: [{
        label: 'Staff',
        data: staffData,
        borderColor: '#ffc107',
        backgroundColor: 'rgba(255, 193, 7, 0.3)',
        fill: true,
        tension: 0.4
      }]
    },
    options: { responsive: true, plugins: { legend: { display: false } } }
  });
</script>

<!-- Sidebar toggle script -->
<script>
  const sidebar = document.getElementById('sidebar');
  const toggleBtn = document.getElementById('sidebarToggle');

  toggleBtn.addEventListener('click', () => {
    sidebar.classList.toggle('show');
  });

  document.addEventListener('click', (event) => {
    const isClickInside = sidebar.contains(event.target) || toggleBtn.contains(event.target);
    if (!isClickInside && sidebar.classList.contains('show')) {
      sidebar.classList.remove('show');
    }
  });
</script>

</body>
</html>
