<!-- resources/views/register.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Register - Create Account</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Poppins', sans-serif;
    }

    body {
      background: linear-gradient(135deg, #543310 0%, #74512D 50%, #543310 100%);
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 20px;
    }

    .register-container {
      display: flex;
      background: rgba(84, 51, 16, 0.6);
      backdrop-filter: blur(20px);
      border-radius: 30px;
      overflow: hidden;
      max-width: 900px;
      width: 85%;
      min-height: 600px;
      box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5),
                  inset 0 1px 0 rgba(255, 255, 255, 0.1);
      border: 1px solid rgba(255, 255, 255, 0.1);
    }

    /* Left Section - Welcome */
    .welcome-section {
      flex: 1;
      padding: 50px;
      display: flex;
      flex-direction: column;
      justify-content: center;
      background: linear-gradient(135deg, rgba(175, 143, 111, 0.25) 0%, rgba(116, 81, 45, 0.2) 100%);
      position: relative;
    }

    .logo {
      width: 60px;
      height: 60px;
      background: linear-gradient(135deg, #F8F4E1 0%, #AF8F6F 100%);
      backdrop-filter: blur(10px);
      border: 2px solid rgba(255, 255, 255, 0.3);
      border-radius: 18px;
      display: flex;
      align-items: center;
      justify-content: center;
      margin-bottom: 40px;
      box-shadow: 0 10px 30px rgba(248, 244, 225, 0.2);
    }

    .logo i {
      font-size: 28px;
      background: linear-gradient(135deg, #543310, #74512D);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
    }

    .welcome-section h1 {
      font-size: 48px;
      font-weight: 900;
      color: #F8F4E1;
      margin-bottom: 18px;
      line-height: 1.1;
      letter-spacing: -1px;
      text-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
    }

    .divider {
      width: 90px;
      height: 4px;
      background: linear-gradient(90deg, #F8F4E1, #AF8F6F, transparent);
      margin-bottom: 24px;
      border-radius: 10px;
      box-shadow: 0 4px 15px rgba(248, 244, 225, 0.3);
    }

    .welcome-section p {
      color: rgba(248, 244, 225, 0.9);
      font-size: 15px;
      line-height: 1.7;
      margin-bottom: 35px;
      max-width: 380px;
      font-weight: 400;
    }

    .back-btn {
      padding: 14px 36px;
      background: linear-gradient(135deg, #F8F4E1 0%, #AF8F6F 100%);
      color: #543310;
      border: none;
      border-radius: 50px;
      font-size: 14px;
      font-weight: 700;
      cursor: pointer;
      width: fit-content;
      transition: all 0.3s ease;
      box-shadow: 0 10px 30px rgba(248, 244, 225, 0.25);
      text-decoration: none;
      display: inline-block;
    }

    .back-btn:hover {
      transform: translateY(-3px);
      box-shadow: 0 15px 40px rgba(248, 244, 225, 0.35);
    }

    /* Right Section - Register Form */
    .form-section {
      flex: 0 0 450px;
      padding: 50px;
      background: #F8F4E1;
      display: flex;
      flex-direction: column;
      justify-content: center;
      overflow-y: auto;
      max-height: 600px;
    }

    .form-section::-webkit-scrollbar {
      width: 6px;
    }

    .form-section::-webkit-scrollbar-track {
      background: rgba(116, 81, 45, 0.1);
      border-radius: 10px;
    }

    .form-section::-webkit-scrollbar-thumb {
      background: #AF8F6F;
      border-radius: 10px;
    }

    .error-message {
      background: rgba(220, 53, 69, 0.1);
      border: 1px solid rgba(220, 53, 69, 0.3);
      color: #dc3545;
      padding: 12px 16px;
      border-radius: 12px;
      margin-bottom: 20px;
      font-size: 13px;
      font-weight: 500;
    }

    .form-group {
      margin-bottom: 20px;
    }

    .form-group label {
      display: block;
      color: #543310;
      font-size: 11px;
      font-weight: 700;
      margin-bottom: 10px;
      text-transform: uppercase;
      letter-spacing: 1.2px;
    }

    .input-wrapper {
      position: relative;
    }

    .input-icon {
      position: absolute;
      left: 20px;
      top: 50%;
      transform: translateY(-50%);
      color: #AF8F6F;
      font-size: 16px;
      pointer-events: none;
    }

    .form-group input {
      width: 100%;
      padding: 16px 20px 16px 50px;
      background: white;
      border: 2px solid rgba(116, 81, 45, 0.12);
      border-radius: 14px;
      color: #543310;
      font-size: 14px;
      font-weight: 500;
      transition: all 0.3s ease;
      box-shadow: 0 2px 8px rgba(84, 51, 16, 0.04);
    }

    .form-group input::placeholder {
      color: #AF8F6F;
      opacity: 0.5;
      font-weight: 400;
    }

    .form-group input:focus {
      outline: none;
      background: #fff;
      border-color: #AF8F6F;
      box-shadow: 0 8px 24px rgba(175, 143, 111, 0.15);
      transform: translateY(-2px);
    }

    .form-group input:focus ~ .input-icon {
      color: #74512D;
    }

    .password-toggle {
      position: absolute;
      right: 20px;
      top: 50%;
      transform: translateY(-50%);
      color: #AF8F6F;
      cursor: pointer;
      font-size: 16px;
      transition: all 0.3s ease;
    }

    .password-toggle:hover {
      color: #543310;
    }

    .submit-btn {
      width: 100%;
      padding: 16px;
      background: linear-gradient(135deg, #74512D 0%, #543310 100%);
      border: none;
      border-radius: 14px;
      color: #F8F4E1;
      font-size: 15px;
      font-weight: 700;
      cursor: pointer;
      margin-top: 10px;
      margin-bottom: 0;
      transition: all 0.3s ease;
      box-shadow: 0 12px 32px rgba(84, 51, 16, 0.3);
    }

    .submit-btn:hover {
      transform: translateY(-3px);
      box-shadow: 0 16px 40px rgba(84, 51, 16, 0.4);
    }

    /* Responsive */
    @media (max-width: 1024px) {
      .register-container {
        flex-direction: column;
        max-width: 500px;
      }

      .welcome-section {
        padding: 40px;
      }

      .welcome-section h1 {
        font-size: 42px;
      }

      .form-section {
        flex: 1;
        padding: 40px;
        max-height: none;
      }
    }

    @media (max-width: 480px) {
      .welcome-section h1 {
        font-size: 36px;
      }

      .welcome-section,
      .form-section {
        padding: 30px;
      }
    }
  </style>
</head>

<body>
  <div class="register-container">
    <!-- Welcome Section -->
    <div class="welcome-section">
      <div class="logo">
        <i class="fas fa-user-plus"></i>
      </div>
      
      <h1>Join Us!</h1>
      
      <div class="divider"></div>
      
      <p>Create your account and start your journey with us. Experience seamless authentication on our modern and secure platform.</p>
      
      <a href="{{ route('login') }}" class="back-btn">Back to Login</a>
    </div>

    <!-- Form Section -->
    <div class="form-section">
      

      @if(session('errors'))
        <div class="error-message">
          <i class="fas fa-exclamation-circle"></i> {{ session('errors') }}
        </div>
      @endif

      <form method="POST" action="{{ route('register.post') }}">
        @csrf
        
        <div class="form-group">
          <label for="name">NAMA</label>
          <div class="input-wrapper">
            <input type="text" id="name" name="name" placeholder="Nama lengkap" required />

        <label for="username">Username</label>
        <input type="text" id="username" name="username" placeholder="Username" required />
            <i class="fas fa-user input-icon"></i>
          </div>
        </div>

        <div class="form-group">
          <label for="email">EMAIL</label>
          <div class="input-wrapper">
            <input type="email" id="email" name="email" placeholder="email@example.com" required />
            <i class="fas fa-envelope input-icon"></i>
          </div>
        </div>

        <div class="form-group">
          <label for="password">PASSWORD</label>
          <div class="input-wrapper">
            <input type="password" id="password" name="password" placeholder="••••••••••" required />
            <i class="fas fa-lock input-icon"></i>
            <i class="fas fa-eye password-toggle" onclick="togglePassword()"></i>
          </div>
        </div>

        <div class="form-group">
          <label for="alamat">ALAMAT</label>
          <div class="input-wrapper">
            <input type="text" id="alamat" name="alamat" placeholder="Alamat lengkap" required />
            <i class="fas fa-map-marker-alt input-icon"></i>
          </div>
        </div>

        <div class="form-group">
          <label for="no_hp">NO. TELEPON</label>
          <div class="input-wrapper">
            <input type="text" id="no_hp" name="no_hp" placeholder="08123456789" required />
            <i class="fas fa-phone input-icon"></i>
          </div>
        </div>

        <button type="submit" class="submit-btn">Sign Up</button>
      </form>
    </div>
  </div>

  <script>
    function togglePassword() {
      const input = document.getElementById('password');
      const icon = document.querySelector('.password-toggle');
      
      if (input.type === 'password') {
        input.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
      } else {
        input.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
      }
    }
  </script>
</body>

</html>