<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Create Intern</title>

  <!-- Bootstrap CSS (for styling) -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>

<div class="container mt-4">
  <h2>➕ Add Intern</h2>

  <form action="{{ route('interns.store') }}" method="POST">
    @csrf

    <div class="mb-3">
      <label>Name *</label>
      <input type="text" name="name" class="form-control" required>
    </div>

    <div class="mb-3">
      <label>Email</label>
      <input type="email" name="email" class="form-control">
    </div>

    <div class="mb-3">
      <label>Phone</label>
      <input type="text" name="phone" class="form-control">
    </div>

    <div class="mb-3">
      <label>Address</label>
      <input type="text" name="address" class="form-control">
    </div>

    <div class="mb-3">
      <label>Field *</label>
      <select name="field" class="form-control" required>
        <option value="" selected disabled>-- Select Field --</option>
        <option value="Laravel">Laravel</option>
        <option value="React">React</option>
        <option value="UI/UX">UI/UX</option>
        <option value="Facebook Marketing">Facebook Marketing</option>
        <option value="SEO">SEO</option>
        <option value="Content Writing">Content Writing</option>
      </select>
    </div>

    <div class="mb-3">
      <label>Join Date *</label>
      <input type="date" name="join_date" class="form-control" required>
    </div>

    <div class="mb-3">
      <label>Leave Date</label>
      <input type="date" name="leave_date" class="form-control">
    </div>

    <button type="submit" class="btn btn-success">💾 Save Intern</button>
  </form>
</div>

</body>
</html>
