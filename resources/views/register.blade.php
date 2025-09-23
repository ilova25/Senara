<!-- resources/views/register.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Register</title>
  <!-- Ganti Roboto ke Poppins -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Poppins', sans-serif;
    }

    body {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      background-image: url('https://images.unsplash.com/photo-1600585154340-be6161a56a0c');
      background-size: cover;
      background-position: center;
      transition: opacity 1s ease-in;
    }

    body.fade-out {
      opacity: 0;
      transition: opacity 1.0s ease-out;
    }

    .container {
      display: flex;
      width: 800px;
      max-width: 90%;
      background-color: rgba(255, 255, 255, 0.95);
      border-radius: 15px;
      overflow: hidden;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
    }

    .form-section {
      flex: 1;
      padding: 40px;
    }

    .form-section h2 {
      font-size: 32px;
      margin-bottom: 10px;
    }

    .form-section p {
      font-size: 14px;
      color: #777;
      margin-bottom: 30px;
    }

    .form-section label {
      font-size: 14px;
      font-weight: 500;
      margin-bottom: 6px;
      display: block;
      color: #333;
    }

    .form-section input,
    .form-section textarea {
      width: 100%;
      padding: 12px;
      margin-bottom: 20px;
      border: 1px solid #ccc;
      border-radius: 10px;
    }

    .form-section button {
      width: 100%;
      background-color: #5a3414;
      color: #fff;
      padding: 14px;
      font-size: 16px;
      border: none;
      border-radius: 10px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    .form-section button:hover {
      background-color: #3d230c;
    }

    .image-section {
      flex: 1;
      background: url('/images/register.png') center/cover no-repeat;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="form-section">
      <h2>Sign up</h2>
      <p>Create your account</p>

      @if(session('errors'))
        <p style="color:red">{{ session('errors') }}</p>
      @endif 

      <form method="POST" action="{{ route('register.post') }}">
        @csrf
        <label for="name">Nama</label>
        <input type="text" id="name" name="username" placeholder="Nama" required />

        <label for="email">Email</label>
        <input type="email" id="email" name="email" placeholder="Email" required />

        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="Password" required />

        <label for="alamat">Alamat</label>
        <input type="text" id="alamat" name="alamat" placeholder="Alamat" required />

        <label for="no_hp">No. Telepon</label>
        <input type="number" id="no_hp" name="no_hp" placeholder="No. Telepon" required />

        <button type="submit">Sign up</button>
      </form>
    </div>
    <div class="image-section"></div>
  </div>
</body>
</html>
