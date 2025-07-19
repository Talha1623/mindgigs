<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Today Deals | MindGigs</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

  <style>
    body {
      background-color: #f8f9fa;
      margin: 0;
      font-family: 'Segoe UI', sans-serif;
    }

    /* Sidebar */
    .sidebar {
      height: 100vh;
      background-color: #1e2a45;
      color: white;
      padding-top: 20px;
      position: fixed;
      top: 0;
      left: 0;
      width: 220px;
      display: flex;
      flex-direction: column;
      transition: transform 0.3s ease;
      z-index: 1030;
    }

    .sidebar.hide {
      transform: translateX(-100%);
    }

    .sidebar .logo {
      font-size: 1.4rem;
      font-weight: bold;
      text-align: center;
      margin-bottom: 30px;
    }

    .sidebar a {
      color: #a0b4d4;
      text-decoration: none;
      padding: 12px 20px;
      display: flex;
      align-items: center;
      gap: 12px;
      transition: 0.3s;
    }

    .sidebar a:hover,
    .sidebar a.active {
      background-color: #3c4b6b;
      color: #fff;
    }

    /* Topbar */
    .topbar {
      margin-left: 220px;
      height: 60px;
      background: #fff;
      padding: 0 24px;
      box-shadow: 0 1px 3px rgba(0,0,0,0.08);
      display: flex;
      align-items: center;
      justify-content: space-between;
      transition: margin-left 0.3s ease;
      position: sticky;
      top: 0;
      z-index: 1020;
    }

    /* Content */
    .content-area {
      margin-left: 220px;
      margin-top: 60px;
      padding: 24px;
      transition: margin-left 0.3s ease;
    }

    .table thead th {
      background-color: #1e2a45;
      color: white;
    }

    .badge {
      font-size: 0.8rem;
      padding: 6px 10px;
    }

    /* Boxes */
    .box-sidebar-bg {
      background-color: #1e2a45;
      color: white;
      border-radius: 12px;
      padding: 20px 30px;
      box-shadow: 0 5px 15px rgba(30, 42, 69, 0.5);
      display: flex;
      align-items: center;
      gap: 12px;
      font-weight: 600;
      user-select: none;
      transition: transform 0.3s ease;
    }

    .box-sidebar-bg:hover {
      transform: translateY(-5px);
      box-shadow: 0 8px 20px rgba(30, 42, 69, 0.7);
    }

    .box-icon {
      width: 50px;
      height: 50px;
      font-size: 1.8rem;
      background-color: rgba(255, 255, 255, 0.15);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      box-shadow: 0 4px 8px rgba(0,0,0,0.3);
      color: #76a9fa;
      flex-shrink: 0;
    }

    .header-text {
      font-size: 1.6rem;
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .total-visitors-text h5 {
      margin: 0;
      font-weight: 500;
      color: #c0c6d9;
    }
    .total-visitors-text h2 {
      margin: 0;
      font-weight: 700;
      font-size: 2.2rem;
      color: #fff;
      line-height: 1;
    }
    .total-visitors-text small {
      color: #a1a8c6;
    }

    /* Profile and icons in topbar */
    .profile {
      gap: 12px;
    }

    /* Toggle button */
    .sidebar-toggle-btn {
      display: none;
      background: none;
      border: none;
      font-size: 1.5rem;
      cursor: pointer;
      color: #1e2a45;
    }

    /* Responsive - Mobile */
    @media (max-width: 991.98px) {
      .sidebar {
        transform: translateX(-100%);
        width: 200px;
      }
      .sidebar.show {
        transform: translateX(0);
      }

      .topbar {
        margin-left: 0;
        padding-left: 16px;
        padding-right: 16px;
      }
      .content-area {
        margin-left: 0;
        padding: 16px;
      }

      .sidebar-toggle-btn {
        display: block;
      }
    }

  </style>
</head>
<body>

<!-- Sidebar -->
<div class="sidebar" id="sidebar">
  <div class="logo">MindGigs</div>
  <a href="{{ route('dashboard') }}">
    <i class="bi bi-grid"></i> Dashboard
  </a>
  <a href="{{ route('today.deals') }}" class="active">
    <i class="bi bi-person"></i> Today Deals
  </a>
  <a href="{{ route('visitors.index') }}">
    <i class="bi bi-people"></i> Visitors
  </a>
  <a href="#"><i class="bi bi-briefcase"></i> Projects</a>
  <a href="{{ route('logout') }}"
     onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
     <i class="bi bi-box-arrow-right"></i> Logout
  </a>
  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
  </form>
</div>

<!-- Topbar -->
<div class="topbar">
  <button class="sidebar-toggle-btn" id="sidebarToggle">
    <i class="bi bi-list"></i>
  </button>
  <div>
    <button class="btn btn-outline-primary btn-sm">POS</button>
  </div>
  <div class="profile d-flex align-items-center gap-3">
    <i class="bi bi-globe"></i>
    <i class="bi bi-bell"></i>
    <span class="badge bg-success rounded-pill">3</span>
    <img src="https://i.pravatar.cc/40" alt="Profile" class="rounded-circle" width="36" height="36">
    <div>
      <strong>{{ Auth::user()->name }}</strong><br/>
      <small class="text-muted">Admin</small>
    </div>
  </div>
</div>

<!-- Main Content -->
<div class="content-area" id="contentArea">

  <div class="row mb-4 gx-4">

    <!-- Left col: Header box -->
    <div class="col-md-6">
      <div class="box-sidebar-bg header-text">
        <i class="bi bi-clipboard2-check box-icon"></i>
        📋 Today’s Deals ({{ now()->format('d M Y') }})
      </div>
    </div>

    <!-- Right col: Total visitors -->
    <div class="col-md-6">
      <div class="box-sidebar-bg justify-content-between">
        <div class="d-flex align-items-center gap-3">
          <div class="box-icon">
            <i class="bi bi-people-fill"></i>
          </div>
          <div class="total-visitors-text">
            <h5>Total Visitors Today</h5>
            <h2>{{ $totalVisitors }}</h2>
          </div>
        </div>
        <small>People visited your place today</small>
      </div>
    </div>

  </div>

  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <div class="table-responsive">
    <table class="table table-bordered table-hover align-middle shadow-sm">
      <thead>
        <tr>
          <th><i class="bi bi-person"></i> Name</th>
          <th><i class="bi bi-telephone"></i> Contact</th>
          <th><i class="bi bi-envelope"></i> Email</th>
          <th><i class="bi bi-share"></i> Source</th>
          <th><i class="bi bi-award"></i> Status</th>
          <th><i class="bi bi-person-check"></i> Added By</th>
          <th><i class="bi bi-clock"></i> Time</th>
        </tr>
      </thead>
      <tbody>
        @forelse($visitors as $visitor)
        <tr>
          <td>{{ $visitor->name }}</td>
          <td>{{ $visitor->contact }}</td>
          <td>{{ $visitor->email ?? '—' }}</td>
          <td>{{ $visitor->source }}</td>
          <td>
            <span class="badge 
              @if($visitor->status === 'Enrolled') bg-success 
              @elseif($visitor->status === 'Interested') bg-primary 
              @elseif($visitor->status === 'Follow Up') bg-warning text-dark 
              @else bg-secondary 
              @endif">
              {{ $visitor->status ?? 'Pending' }}
            </span>
          </td>
          <td>{{ optional($visitor->addedBy)->name ?? '—' }}</td>
          <td>{{ $visitor->created_at->setTimezone('Asia/Karachi')->format('h:i A') }}</td>
        </tr>
        @empty
        <tr>
          <td colspan="7" class="text-center">No deals found today.</td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
  const sidebar = document.getElementById('sidebar');
  const toggleBtn = document.getElementById('sidebarToggle');

  toggleBtn.addEventListener('click', () => {
    sidebar.classList.toggle('show');
  });

  // Optional: Click outside sidebar to close on mobile
  document.addEventListener('click', function(event) {
    const isClickInside = sidebar.contains(event.target) || toggleBtn.contains(event.target);
    if (!isClickInside && sidebar.classList.contains('show')) {
      sidebar.classList.remove('show');
    }
  });
</script>
</body>
</html>
