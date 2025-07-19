<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Logdy - Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      min-height: 100vh;
      display: flex;
    }
    .left-side {
      background: linear-gradient(to bottom right, #d50000, #ff8f00);
      color: white;
      padding: 60px 40px;
      flex: 1;
      display: flex;
      flex-direction: column;
      justify-content: center;
    }
    .left-side h1 {
      font-weight: bold;
    }
    .social-icons button {
      margin-right: 10px;
      border: none;
      width: 40px;
      height: 40px;
      border-radius: 5px;
    }
    .right-side {
      flex: 1;
      background-color: #f3f6fb;
      padding: 60px 40px;
      display: flex;
      flex-direction: column;
      justify-content: center;
    }
    .login-box {
      max-width: 400px;
      margin: auto;
    }
  </style>
</head>
<body>

  <div class="left-side">
    <h1>WELCOME TO MINDGIGS</h1>
    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
    <div class="social-icons mt-4">
      <button class="btn btn-light"><i class="bi bi-facebook"></i></button>
      <button class="btn btn-light"><i class="bi bi-twitter"></i></button>
      <button class="btn btn-light"><i class="bi bi-google"></i></button>
      <button class="btn btn-light"><i class="bi bi-linkedin"></i></button>
    </div>
  </div>

  <div class="right-side">
    <div class="login-box text-center">
      <h2>Login</h2>
      <p class="mb-4">Sign Into Your Account</p>
      <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="form-floating mb-3">
          <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
          <label for="email">Email Address</label>
        </div>

        <div class="form-floating mb-3">
          <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
          <label for="password">Password</label>
        </div>

        <div class="d-flex justify-content-between align-items-center mb-3">
          <div class="form-check">
            <input class="form-check-input" type="checkbox" name="remember" id="remember">
            <label class="form-check-label" for="remember">Remember me</label>
          </div>
<a href="#">Forgot Password?</a>
        </div>

        <button type="submit" class="btn btn-warning w-100">Login</button>
      </form>
      <p class="mt-3">Don't have an account? <a href="{{ route('register') }}">Register here</a></p>
    </div>
  </div>

  <!-- Bootstrap Icons CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</body>
</html>
