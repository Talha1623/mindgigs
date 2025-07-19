<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Visitor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h3>Edit Visitor</h3>

    <form action="{{ route('visitors.update', $visitor->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Name:</label>
            <input type="text" name="name" value="{{ $visitor->name }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Contact:</label>
            <input type="text" name="contact" value="{{ $visitor->contact }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Email:</label>
            <input type="email" name="email" value="{{ $visitor->email }}" class="form-control">
        </div>

        <div class="mb-3">
            <label>Source:</label>
            <select name="source" class="form-control" required>
                <option value="Facebook" {{ $visitor->source == 'Facebook' ? 'selected' : '' }}>Facebook</option>
                <option value="Referral" {{ $visitor->source == 'Referral' ? 'selected' : '' }}>Referral</option>
                <option value="Walk-in" {{ $visitor->source == 'Walk-in' ? 'selected' : '' }}>Walk-in</option>
                <option value="Instagram" {{ $visitor->source == 'Instagram' ? 'selected' : '' }}>Instagram</option>
            </select>
        </div>

        <button class="btn btn-success">Update</button>
        <a href="{{ route('visitors.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
</body>
</html>
