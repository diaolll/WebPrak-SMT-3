<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - RSHP Unair</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Urbanist:wght@300;400;600;700&display=swap');

        body {
            font-family: 'Urbanist', sans-serif;
            background-color: #eef4f8;
            color: #3f5e71;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            min-height: 100vh;
            margin: 0;
            text-align: center;
        }
        
        /* Ini adalah class yang akan digunakan */
        .login-container { 
            background-color: #fff;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 400px;
        }

        h2 {
            color: #6a9ac4;
            margin-bottom: 25px;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        label {
            align-self: flex-start;
            font-weight: 600;
        }

        input[type="email"],
        input[type="password"] {
            /* width: auto; dihilangkan untuk default block element */
            display: block; 
            box-sizing: border-box; 
            width: 100%; /* Ditambahkan untuk konsistensi desain */
            padding: 10px;
            border: 1px solid #c9d2d9;
            border-radius: 8px;
            font-size: 16px;
            margin-top: 5px; 
        }
        
        input[type="checkbox"] {
            margin-right: 5px;
        }

        button {
            padding: 12px 20px;
            border: none;
            border-radius: 8px;
            background-color: #6a9ac4;
            color: white;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.3s ease;
            font-weight: 600;
            width: 100%; 
            display: block; 
        }
        
        button:hover {
            background-color: #5580a8;
            transform: translateY(-2px);
        }
        
        a {
        color: #f7b267;
        text-decoration: none;
        font-weight: 600;
        }
        
        a:hover {
            text-decoration: underline;
        }
        
        .msg {
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 5px;
            font-weight: 600;
            text-align: left; /* Ditambahkan agar pesan lebih rapi di dalam card */
        }
        
        .error {
            color: #d9534f;
            background-color: #fbecec;
            border: 1px solid #d9534f;
        }

        .success {
            color: #5cb85c;
            background-color: #edfaed;
            border: 1px solid #5cb85c;
        }

        .hint {
            margin-top: 20px;
            font-size: 14px;
            color: #6a9ac4;
        }
    </style>
    
</head>
<body>
  <div class="login-container">
    <h2>Login Admin - RSHP Unair</h2>

    @if (session('error'))
      <div class="msg error">{{ session('error') }}</div>
    @endif
    @if (session('success'))
      <div class="msg success">{{ session('success') }}</div>
    @endif
    @error('email')
      <div class="msg error">{{ $message }}</div>
    @enderror

    <form method="post" action="{{ route('site.login.post') }}">
      @csrf
      <label for="email">Email</label>
      <input id="email" type="email" name="email" value="{{ old('email') }}" required>

      <label for="password">Password</label>
      <input id="password" type="password" name="password" required>

      <button type="submit">Login</button>
    </form>

    <div class="hint">Gunakan email & password yang sudah terdaftar.</div>
  </div>
</body>
</html>