<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;700&display=swap" rel="stylesheet">

  <style>
    :root {
      --primary: #5A3B1F;
      --secondary: #EBDDCB;
      --accent: #C9A66B;
      --text-dark: #2E2E2E;
      --white: #FFFFFF;
    }

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Poppins', sans-serif;
    }

    body {
      background: url('https://images.unsplash.com/photo-1600585154340-be6161a56a0c') center/cover no-repeat;
      position: relative;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    body::before {
      content: "";
      position: absolute;
      top: 0; left: 0; right: 0; bottom: 0;
      background: rgba(0, 0, 0, 0.35);
      z-index: 0;
    }

    .container {
      display: flex;
      background-color: var(--white);
      border-radius: 15px;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.25);
      overflow: hidden;
      max-width: 900px;
      width: 100%;
      min-height: 550px;
      position: relative;
      z-index: 1;
    }

    .image-section {
      flex: 1;
      background: url('/images/login.png') center/cover no-repeat;
      min-height: 300px;
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
      margin-bottom: 8px;
      font-weight: 600;
      color: var(--text-dark);
    }

    .form-section p {
      color: #666;
      font-size: 14px;
      margin-bottom: 30px;
    }

    label {
      display: block;
      font-weight: 500;
      margin-bottom: 6px;
      color: var(--text-dark);
    }

    input {
      width: 100%;
      padding: 12px 14px;
      border: 1px solid #ccc;
      border-radius: 10px;
      font-size: 14px;
      transition: border-color 0.3s ease, box-shadow 0.3s ease;
    }

    input:focus {
      border-color: var(--primary);
      box-shadow: 0 0 6px rgba(90, 59, 31, 0.3);
      outline: none;
    }

    button {
      width: 100%;
      padding: 14px;
      background-color: var(--primary);
      color: var(--white);
      font-size: 16px;
      font-weight: 500;
      border: none;
      border-radius: 10px;
      cursor: pointer;
      margin-top: 20px;
      transition: background-color 0.3s ease, transform 0.2s ease;
    }

    button:hover {
      background-color: var(--accent);
      color: var(--text-dark);
      transform: translateY(-2px);
    }

    .register-link {
      font-size: 14px;
      margin-top: 10px;
      color: #444;
    }

    .register-link a {
      color: var(--accent);
      text-decoration: none;
      font-weight: 500;
    }

    .register-link a:hover {
      text-decoration: underline;
    }

    @media (max-width: 768px) {
      .container {
        flex-direction: column;
        max-width: 95%;
      }
      .image-section {
        min-height: 200px;
      }
      .form-section {
        padding: 30px 20px;
      }
      .form-section h2 {
        font-size: 26px;
      }
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="image-section"></div> <!-- Gambar di kiri -->
    <div class="form-section">
      <h2>Sign In</h2>
      <p>Sign in to your account</p>
      
      <form method="POST" action="{{ route('login.post') }}">
        @csrf
        <label for="username">Username</label>
        <input type="text" id="username" name="username" placeholder="Enter your username" required />

        <label for="email">Email</label>
        <input type="email" id="email" name="email" placeholder="Enter your email" required />

        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="Enter your password" required />

        <div class="register-link">
          Don't have an account? <a href="{{ route('register') }}">Register</a>
        </div>

        <button type="submit">Sign in</button>
      </form>
    </div>
  </div>
</body>
</html>
