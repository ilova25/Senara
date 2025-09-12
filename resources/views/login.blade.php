<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login</title>
  <!-- Ganti Roboto ke Poppins -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;700&display=swap" rel="stylesheet">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Poppins', sans-serif;
    }

    body {
      background-image: url('https://images.unsplash.com/photo-1600585154340-be6161a56a0c');
      background-size: cover;
      background-position: center;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    body.fade-out {
      opacity: 0;
      transition: opacity 0.5s ease-out;
    }

    .container {
      display: flex;
      background-color: #fff;
      border-radius: 15px;
      box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
      overflow: hidden;
      max-width: 900px;
      width: 100%;
    }

    .image-section {
      flex: 1;
      background: url('/images/login.png') center/cover no-repeat;
    }

    .form-section {
      flex: 1;
      padding: 50px 40px;
      display: flex;
      flex-direction: column;
      justify-content: center;
    }

    .form-section h2 {
      font-size: 32px;
      margin-bottom: 10px;
    }

    .form-section p {
      color: #555;
      font-size: 14px;
      margin-bottom: 30px;
    }

    .form-group {
      margin-bottom: 20px;
    }

    label {
      display: block;
      font-weight: 500;
      margin-bottom: 6px;
      color: #333;
    }

    input {
      width: 100%;
      padding: 12px;
      border: 1px solid #ccc;
      border-radius: 10px;
    }

    .register-link {
      font-size: 14px;
      margin-top: 10px;
    }

    .register-link a {
      color: #5a3414;
      text-decoration: none;
      font-weight: bold;
    }

    .register-link a:hover {
      text-decoration: underline;
    }

    button {
      width: 100%;
      padding: 14px;
      background-color: #5a3414;
      color: #fff;
      font-size: 16px;
      border: none;
      border-radius: 10px;
      cursor: pointer;
      margin-top: 20px;
    }

    button:hover {
      background-color: #3d230c;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="image-section"></div>
    <div class="form-section">
      <h2>Sign In</h2>
      <p>Sign in to our account</p>
      
      <!-- GUNAKAN ROUTE LARAVEL -->
      <form method="POST" action="{{ route('login.post') }}">
        @csrf
        <div class="form-group">
          <label for="username">Username</label>
          <input type="text" id="username" name="username" placeholder="Username" required />
        </div>

        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" id="email" name="email" placeholder="Email" required />
        </div>

        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" id="password" name="password" placeholder="Password" required />
        </div>

        <div class="register-link">
          Don't have an account? <a href="{{ route('register') }}">Register</a>
        </div>

        <button type="submit">Sign in</button>
      </form>
    </div>
  </div>
</body>
</html>
