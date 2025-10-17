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
            /* Hapus width: 100%; */
            width: auto; /* atau hapus saja propertinya */
            display: block; /* PENTING: Membuatnya mengambil baris penuh */
            box-sizing: border-box; /* Sudah ada di global * */
            padding: 10px;
            border: 1px solid #c9d2d9;
            border-radius: 8px;
            font-size: 16px;
            margin-top: 5px; /* Tambahkan sedikit jarak dari label */
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
            display: block; /* Memastikan lebar 100% dihormati */
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
    <h2>Login Area Admin</h2>

    <form method="POST" action="/admin/login">
      
      <label for="email">Email</label>
      <input id="email" type="email" name="email" value="" required placeholder="Masukkan Email Anda">

      <label for="password">Password</label>
      <input id="password" type="password" name="password" required placeholder="Masukkan Password Anda">

      <button type="submit">Login</button>
    </form>

    <div class="hint">Gunakan email & password yang sudah terdaftar untuk akses admin.</div>
    
    <p style="margin-top: 20px;"><a href="/">Kembali ke Beranda Situs</a></p>
  </div>
</body>
</html>