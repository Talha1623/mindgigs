<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Edit Intern | MindGigs</title>

  <!-- Bootstrap CSS & Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />

  <style>
    body {
      background-color: #f8fafc;
      font-family: 'Segoe UI', sans-serif;
    }
    .container {
      max-width: 800px;
      margin-top: 50px;
    }
    .card {
      border: none;
      border-radius: 16px;
      box-shadow: 0 0 15px rgba(0,0,0,0.05);
    }
    .form-label {
      font-weight: 500;
    }
  </style>
</head>
<body>

<div class="container">
  <div class="card">
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
      <h5 class="mb-0">✏️ Edit Intern - {{ $intern->name }}</h5>
      <a href="{{ route('interns.index') }}" class="btn btn-light btn-sm"><i class="bi bi-arrow-left"></i> Back</a>
    </div>

    <form action="{{ route('interns.update', $intern->id) }}" method="POST" class="card-body row g-3">
      @csrf
      @method('PUT')

      <div class="col-md-6">
        <label class="form-label">Name *</label>
        <input type="text" name="name" class="form-control" value="{{ $intern->name }}" required>
      </div>

      <div class="col-md-6">
        <label class="form-label">Email</label>
        <input type="email" name="email" class="form-control" value="{{ $intern->email }}">
      </div>

      <div class="col-md-6">
        <label class="form-label">Phone</label>
        <input type="text" name="phone" class="form-control" value="{{ $intern->phone }}">
      </div>

      <div class="col-md-6">
        <label class="form-label">Address</label>
        <input type="text" name="address" class="form-control" value="{{ $intern->address }}">
      </div>

      <div class="col-md-6">
        <label class="form-label">Field *</label>
        <select name="field" class="form-select" required>
          <option disabled>-- Select Field --</option>
          <option value="Laravel" {{ $intern->field === 'Laravel' ? 'selected' : '' }}>Laravel</option>
          <option value="React" {{ $intern->field === 'React' ? 'selected' : '' }}>React</option>
          <option value="UI/UX" {{ $intern->field === 'UI/UX' ? 'selected' : '' }}>UI/UX</option>
          <option value="Facebook Marketing" {{ $intern->field === 'Facebook Marketing' ? 'selected' : '' }}>Facebook Marketing</option>
          <option value="SEO" {{ $intern->field === 'SEO' ? 'selected' : '' }}>SEO</option>
          <option value="Content Writing" {{ $intern->field === 'Content Writing' ? 'selected' : '' }}>Content Writing</option>
        </select>
      </div>

      <div class="col-md-6">
        <label class="form-label">Join Date *</label>
        <input type="date" name="join_date" class="form-control" value="{{ $intern->join_date }}" required>
      </div>

      <div class="col-md-6">
        <label class="form-label">Leave Date</label>
        <input type="date" name="leave_date" class="form-control" value="{{ $intern->leave_date }}">
      </div>

      <div class="col-12 text-end">
        <button type="submit" class="btn btn-success px-4"><i class="bi bi-save"></i> Update</button>
      </div>
    </form>
  </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
