<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="description" content="Halaman Admin RSHP Unair">
  <meta name="keywords" content="RSHP Unair, Halaman Admin">
  <meta name="author" content="Diaul">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Halaman Admin-datamaster</title>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Urbanist:wght@300;400;600;700&display=swap');
    
    body {
      margin: 0;
      font-family: 'Urbanist', sans-serif;
      background-color: #eef4f8;
      color: #3f5e71;
      line-height: 1.6;
      display: flex;
      flex-direction: column;
      min-height: 100vh;
      text-align: center;
    }
    
    nav {
      background-color: #6a9ac4;
      display: flex;
      justify-content: center;
      gap: 30px;
      padding: 15px 0;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
      flex-wrap: wrap;
    }
    nav a {
      text-decoration: none;
      color: white;
      font-weight: 600;
      padding: 8px 15px;
      border-radius: 5px;
      transition: background-color 0.3s ease, color 0.3s ease;
    }
    nav a:hover,
    nav a:focus {
      background-color: #f7b267;
      color: #3f5e71;
      outline: none;
    }

    .container {
        padding: 40px 20px;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 20px;
    }

    .container a {
        display: block;
        width: 250px;
        padding: 15px;
        background-color: #f7b267;
        color: #3f5e71;
        text-decoration: none;
        font-weight: 600;
        border-radius: 8px;
        transition: background-color 0.3s ease, transform 0.3s ease;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }

    .container a:hover {
        background-color: #e59c5d;
        transform: translateY(-3px);
    }
    
    @media (max-width: 768px) {
        nav {
            gap: 15px;
            padding: 12px 10px;
        }
        nav a {
            font-size: 14px;
        }
        .container {
            padding: 20px;
        }
        .container a {
            width: 100%;
            max-width: 250px;
        }
    }
  </style>
</head>
<body>


<nav class="nav-atas">
  <a href="/">Home</a>
  <a href="/login">Logout</a>
</nav>


<div class="container">
    <h2>Pilihan Data Master</h2>
    <a href="data_user.php">Data User</a>
    <a href="manajemen_role.php">Manajemen Role</a>
    <a href="data_jenishewan.php">Data Jenis Hewan</a>
    <a href="data_rashewan.php">Data Ras Hewan</a>
    <a href="data_pemilik.php">Data Pemilik</a>
    <a href="../Data_Master/pet/data_pet.php">Data Pet</a>
    <a href="data_kategori.php">Kategori</a>
    <a href="data_kategoriklinis.php">Kategori Klinis</a>
    <a href="data_kodetindakanterapi.php">Kode Tindakan Terapi</a>



</div>


</body>
</html>