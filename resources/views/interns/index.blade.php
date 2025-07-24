<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Interns | MindGigs</title>

  <!-- Bootstrap CSS & Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />

  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #f8fafc;
    }
    .sidebar {
      width: 240px;
      height: 100vh;
      background-color: #1e2a45;
      position: fixed;
      top: 0;
      left: 0;
      padding: 20px 0;
      display: flex;
      flex-direction: column;
      color: #fff;
      z-index: 1030;
    }
    .sidebar .logo {
      font-size: 1.6rem;
      font-weight: bold;
      text-align: center;
      margin-bottom: 30px;
      color: #fff;
    }
    .sidebar nav a {
      display: flex;
      align-items: center;
      padding: 12px 24px;
      color: #cdd6e4;
      text-decoration: none;
    }
    .sidebar nav a:hover,
    .sidebar nav a.active {
      background-color: #3c4b6b;
      color: #fff;
    }
    .sidebar nav a i {
      margin-right: 10px;
    }
    .main-content {
      margin-left: 240px;
      padding: 40px;
    }
    .card {
      border: none;
      border-radius: 16px;
      box-shadow: 0 0 10px rgba(0,0,0,0.05);
    }
    .table thead th {
      background-color: #1e2a45;
      color: white;
      border-top: none;
      border-bottom: 2px solid #3c4b6b;
      letter-spacing: 0.5px;
      font-size: 1rem;
      font-weight: 600;
    }
    .table tbody tr {
      border-bottom: 1px solid #e3e6ed;
      transition: background 0.2s;
    }
    .table tbody tr:hover {
      background-color: #f1f5fa;
    }
    .table td, .table th {
      vertical-align: middle;
      border-right: 1px solid #e3e6ed;
    }
    .table td:last-child, .table th:last-child {
      border-right: none;
    }
    .table {
      background: #fff;
      border-radius: 12px;
      overflow: hidden;
      box-shadow: 0 2px 8px rgba(30,42,69,0.05);
    }
    .modal-content {
      border-radius: 16px;
      box-shadow: 0 0 20px rgba(0,0,0,0.2);
    }
  </style>
</head>
<body>

<!-- Sidebar -->
<div class="sidebar">
  <div class="logo">MindGigs</div>
  <nav>
    <a href="{{ route('dashboard') }}"><i class="bi bi-grid"></i> Dashboard</a>
    <a href="{{ route('today.deals') }}"><i class="bi bi-person"></i> Today Deals</a>
    <a href="{{ route('visitors.index') }}"><i class="bi bi-people"></i> Visitors</a>
    <a href="{{ route('projects') }}"><i class="bi bi-briefcase"></i> Projects</a>
    <a href="{{ route('interns.index') }}" class="active"><i class="bi bi-person-badge"></i> Interns</a>
    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
      <i class="bi bi-box-arrow-right"></i> Logout
    </a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
      @csrf
    </form>
  </nav>
</div>

<!-- Main Content -->
<div class="main-content">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold">📋 Interns</h2>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addInternModal">
      <i class="bi bi-plus-circle"></i> Add Intern
    </button>
  </div>

  @if(session('success'))
    <div 
      class="alert alert-success alert-dismissible fade show position-fixed top-0 start-50 translate-middle-x mt-4 shadow" 
      role="alert" 
      style="z-index: 2000; min-width: 320px; max-width: 90%;"
      id="successAlert"
    >
      {{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    <script>
      setTimeout(function() {
        var alert = document.getElementById('successAlert');
        if(alert){
          var bsAlert = bootstrap.Alert.getOrCreateInstance(alert);
          bsAlert.close();
        }
      }, 2500);
    </script>
  @endif

  <!-- 🔍 Search -->
  <div class="mb-4" style="max-width: 350px;">
    <div class="input-group shadow-sm rounded">
      <span class="input-group-text bg-white border-end-0" style="border-radius: 8px 0 0 8px;">
        <i class="bi bi-search text-primary"></i>
      </span>
      <input 
        type="text" 
        class="form-control border-start-0" 
        id="searchInput" 
        placeholder="Search interns..." 
        style="border-radius: 0 8px 8px 0; background: #f5f7fa;"
      >
    </div>
  </div>

  <!-- 📋 Interns Table -->
  <div class="card">
    <div class="card-body p-0">
      <div class="table-responsive">
        <table class="table table-hover align-middle mb-0" id="internsTable">
          <thead>
            <tr>
              <th><i class="bi bi-person"></i> Name</th>
              <th><i class="bi bi-envelope"></i> Email</th>
              <th><i class="bi bi-telephone"></i> Phone</th>
              <th><i class="bi bi-geo-alt"></i> Address</th>
              <th><i class="bi bi-diagram-3"></i> Field</th>
              <th><i class="bi bi-calendar-plus"></i> Join Date</th>
              <th><i class="bi bi-calendar-minus"></i> Leave Date</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
        @foreach($interns as $intern)
          <tr>
            <td><i class="bi bi-person text-primary"></i> {{ $intern->name }}</td>
            <td><i class="bi bi-envelope text-info"></i> {{ $intern->email }}</td>
            <td><i class="bi bi-telephone text-success"></i> {{ $intern->phone }}</td>
            <td><i class="bi bi-geo-alt text-danger"></i> {{ $intern->address }}</td>
            <td><i class="bi bi-diagram-3 text-warning"></i> {{ $intern->field }}</td>
            <td><i class="bi bi-calendar-plus text-secondary"></i> {{ $intern->join_date }}</td>
            <td><i class="bi bi-calendar-minus text-secondary"></i> {{ $intern->leave_date ?? 'N/A' }}</td>
            <td>
        <a href="{{ route('interns.edit', $intern->id) }}" class="btn btn-sm btn-warning">
          <i class="bi bi-pencil"></i> Edit
        </a>
            </td>
          </tr>
        @endforeach
      </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<!-- ➕ Add Intern Modal -->
<div class="modal fade" id="addInternModal" tabindex="-1" aria-labelledby="addInternModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <form action="{{ route('interns.store') }}" method="POST" class="modal-content border-0 rounded-4 shadow">
      @csrf

      <!-- Header -->
      <div class="modal-header bg-dark text-white rounded-top-4">
        <h5 class="modal-title fw-semibold">
          <i class="bi bi-person-plus me-2"></i> Add Intern
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>

      <!-- Body -->
      <div class="modal-body px-5 pt-4 pb-1">
        <div class="row g-4">
          <div class="col-md-6">
            <label class="form-label">Full Name *</label>
            <input type="text" name="name" class="form-control" required placeholder="e.g. Ali Khan">
          </div>
          <div class="col-md-6">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" placeholder="e.g. ali@email.com">
          </div>
          <div class="col-md-6">
            <label class="form-label">Phone</label>
            <input type="text" name="phone" class="form-control" placeholder="03xx-xxxxxxx">
          </div>
          <div class="col-md-6">
            <label class="form-label">Address</label>
            <input type="text" name="address" class="form-control" placeholder="Bahria Town, Lahore">
          </div>
          <div class="col-md-6">
            <label class="form-label">Field *</label>
            <input type="text" name="field" class="form-control" required placeholder="Laravel, SEO, React, etc.">
          </div>
          <div class="col-md-6">
            <label class="form-label">Join Date *</label>
            <input type="date" name="join_date" class="form-control" required>
          </div>
          <div class="col-md-6">
            <label class="form-label">Leave Date</label>
            <input type="date" name="leave_date" class="form-control">
          </div>
        </div>
      </div>

      <!-- Footer -->
      <div class="modal-footer bg-light rounded-bottom-4 px-5 py-3">
        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-success">
          <i class="bi bi-check-circle me-1"></i> Save Intern
        </button>
      </div>
    </form>
  </div>
</div>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
  // 🔍 Intern Table Search
  document.getElementById('searchInput').addEventListener('input', function () {
    const value = this.value.toLowerCase();
    const rows = document.querySelectorAll('#internsTable tbody tr');

    rows.forEach(row => {
      const rowText = row.innerText.toLowerCase();
      row.style.display = rowText.includes(value) ? '' : 'none';
    });
  });
</script>

</body>
</html>
  