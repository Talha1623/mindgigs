<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Visitor Dashboard | MindGigs</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
  <style>
    body { background-color: #f8f9fa; font-family: 'Segoe UI', sans-serif; }
    .sidebar {
      height: 100vh; background-color: #1e2a45; color: white; padding-top: 20px;
      position: fixed; top: 0; left: 0; width: 220px; display: flex; flex-direction: column;
      z-index: 1030; transition: transform 0.3s ease;
    }
    .sidebar.hide { transform: translateX(-100%); }
    .sidebar .logo { font-size: 1.4rem; font-weight: bold; text-align: center; margin-bottom: 30px; }
    .sidebar a {
      color: #a0b4d4; text-decoration: none; padding: 12px 20px;
      display: flex; align-items: center; gap: 12px; transition: 0.3s;
    }
    .sidebar a:hover, .sidebar a.active { background-color: #3c4b6b; color: #fff; }
    .content-area { margin-left: 220px; padding: 24px; }
    .table thead th { background-color: #1e2a45; color: white; }
    .top-right-alert {
      position: fixed; top: 20px; right: 20px; z-index: 1055; min-width: 300px;
      border-radius: 10px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); opacity: 0;
      animation: fadeIn 0.5s forwards;
    }
    @keyframes fadeIn { to { opacity: 1; } }
    @media (max-width: 991.98px) {
      .sidebar { transform: translateX(-100%); }
      .sidebar.show { transform: translateX(0); }
      .mobile-header { display: flex; }
      .content-area { margin-left: 0; margin-top: 60px; }
    }
    .mobile-header {
      display: none; position: fixed; top: 0; left: 0; width: 100%; height: 60px;
      background-color: #fff; box-shadow: 0 1px 3px rgba(0,0,0,0.1); z-index: 1020;
      align-items: center; padding: 0 16px;
    }
    .sidebar-toggle-btn {
      font-size: 1.5rem; background: none; border: none; color: #1e2a45; cursor: pointer;
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
  <a href="{{ route('dashboard') }}"><i class="bi bi-grid"></i> Dashboard</a>
  <a href="{{ route('today.deals') }}"><i class="bi bi-person"></i> Today Deals</a>
  <a href="{{ route('visitors.index') }}" class="active"><i class="bi bi-people"></i> Visitors</a>
  <a href="#"><i class="bi bi-briefcase"></i> Projects</a>
   <a href="{{ route('interns.index') }}"><i class="bi bi-person-badge"></i> Interny</a>
  <a href="{{ route('logout') }}"
     onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
    <i class="bi bi-box-arrow-right"></i> Logout
  </a>
  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
  </form>
</div>

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show top-right-alert" role="alert" id="successAlert">
  <strong>{{ session('success') }}</strong>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<div class="content-area">
  <h3 class="mb-4">Today's Visitors</h3>
  <div class="mb-4">
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addVisitorModal">
      ➕ Add Visitor
    </button>
  </div>

  <div class="table-responsive">
    <table class="table table-bordered table-hover">
      <thead>
        <tr>
          <th>Name</th><th>Contact</th><th>Email</th><th>Source</th>
          <th>Time</th><th>Staff</th><th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach($visitors as $visitor)
        <tr>
          <td>{{ $visitor->name }}</td>
          <td>{{ $visitor->contact }}</td>
          <td>{{ $visitor->email }}</td>
          <td>{{ $visitor->source }}</td>
          <td>{{ $visitor->created_at->format('h:i A') }}</td>
          <td>{{ $visitor->addedBy->name ?? 'N/A' }}</td>
          <td>
            <a href="{{ route('visitors.edit', $visitor->id) }}" class="btn btn-warning btn-sm">
              <i class="bi bi-pencil"></i>
            </a>
            <form action="{{ route('visitors.destroy', $visitor->id) }}" method="POST" class="d-inline">
              @csrf @method('DELETE')
              <button class="btn btn-danger btn-sm" onclick="return confirm('Delete this visitor?')">
                <i class="bi bi-trash"></i>
              </button>
            </form>
          </td>
        </tr>
        @endforeach
        @if($visitors->isEmpty())
        <tr><td colspan="7" class="text-center">No visitors today.</td></tr>
        @endif
      </tbody>
    </table>
  </div>
</div>

<!-- Add Visitor Modal -->
<div class="modal fade" id="addVisitorModal" tabindex="-1" aria-labelledby="addVisitorModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title">Add New Visitor</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <form action="{{ route('visitors.store') }}" method="POST" class="row g-3 p-3">
        @csrf
        <div class="row">
          <div class="col-md-6 mb-3">
        <input type="text" name="name" class="form-control" placeholder="Name" required>
          </div>
          <div class="col-md-6 mb-3">
        <input type="email" name="email" class="form-control" placeholder="Email" required>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6 mb-3">
        <input type="text" name="contact" class="form-control" placeholder="Contact" required>
          </div>
          <div class="col-md-6 mb-3">
        <select name="source" class="form-select" required>
          <option value="" disabled selected>Select Source</option>
          <option value="Facebook">Facebook</option>
          <option value="Referral">Referral</option>
          <option value="Walk-in">Walk-in</option>
          <option value="Instagram">Instagram</option>
        </select>
          </div>
        </div>
        <!-- Hidden field for staff -->
        <input type="hidden" name="person_to_meet" value="{{ Auth::user()->name }}">
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Save</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
  document.addEventListener('DOMContentLoaded', () => {
    const alertBox = document.getElementById('successAlert');
    if (alertBox) setTimeout(() => bootstrap.Alert.getOrCreateInstance(alertBox).close(), 3000);

    const sidebar = document.getElementById('sidebar');
    document.getElementById('sidebarToggle')?.addEventListener('click', () =>
      sidebar.classList.toggle('show')
    );
  });
</script>
</body>
</html>
