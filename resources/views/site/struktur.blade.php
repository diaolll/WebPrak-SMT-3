<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="description" content="Struktur Organisasi RSHP Unair">
  <meta name="keywords" content="RSHP Unair, Struktur Organisasi">
  <meta name="author" content="Diaul">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Struktur Organisasi - RSHP Unair</title>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Urbanist:wght@300;400;600;700&display=swap');

    * {
      box-sizing: border-box;
    }

    body {
      margin: 0;
      font-family: 'Urbanist', sans-serif;
      background-color: #eef4f8;
      color: #3f5e71;
      line-height: 1.6;
    }

    nav {
      display: flex;
      justify-content: center;
      gap: 30px;
      padding: 15px 0;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
      position: sticky;
      top: 0;
      z-index: 100;
      flex-wrap: wrap;
    }
    nav a {
      text-decoration: none;
      padding: 8px 15px;
      font-weight: 600;
      border-radius: 5px;
      transition: background-color 0.3s ease, color 0.3s ease;
    }
    .nav-atas {
      background-color: #6a9ac4;
    }
    .nav-atas a {
      color: white;
    }
    .nav-atas a:hover,
    .nav-atas a:focus {
      background-color: #f7b267;
      color: #3f5e71;
      outline: none;
    }
    .nav-bawah {
      background-color: #f7b267;
    }
    .nav-bawah a {
      color: #3f5e71;
    }
    .nav-bawah a:hover,
    .nav-bawah a:focus {
      background-color: #6a9ac4;
      color: #f7b267;
      outline: none;
    }

    .banner {
      display: flex;
      justify-content: center;
      margin: 30px 15px;
    }
    .banner img {
      width: 100%;
      max-width: 900px;
      height: auto;
      border-radius: 12px;
      box-shadow: 0 8px 20px rgba(106, 154, 196, 0.4);
      cursor: pointer;
      transition: transform 0.3s ease;
    }
    .banner img:hover {
      transform: scale(1.03);
    }

    .struktur {
      display: flex;
      justify-content: center;
      margin: 40px 15px 60px;
    }
    .struktur img {
      max-width: 100%;
      max-height: 600px;
      border-radius: 12px;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
      object-fit: contain;
      transition: box-shadow 0.3s ease;
    }
    .struktur img:hover {
      box-shadow: 0 12px 30px rgba(0, 0, 0, 0.3);
    }

    footer {
      background-color: #6a9ac4;
      color: #fff;
      text-align: center;
      padding: 30px 20px;
      margin-top: 40px;
      font-size: 15px;
      line-height: 1.8;
      letter-spacing: 0.03em;
      box-shadow: 0 -3px 10px rgba(0, 0, 0, 0.2);
    }
    footer h3 {
      margin: 0 0 15px;
      font-weight: 700;
      font-size: 22px;
      letter-spacing: 0.1em;
      text-transform: uppercase;
    }
    footer a {
      color: #f7b267;
      text-decoration: underline;
    }

    @media (max-width: 768px) {
      nav {
        gap: 16px;
        padding: 12px 10px;
        flex-wrap: wrap;
      }
      nav a {
        padding: 6px 12px;
        font-size: 14px;
      }
      .banner {
        margin: 20px 10px;
      }
      .struktur {
        margin: 30px 10px 50px;
      }
      .struktur img {
        max-height: 400px;
      }
      footer {
        font-size: 14px;
        padding: 25px 15px;
      }
    }
  </style>
</head>
<body>

<nav class="nav-atas">
<a href="/">Home</a> 
<a href="/kontak">Kontak Kami</a>
<a href="/login">Login</a>
</nav>

<div class="banner">
    <img src="./aset/banner.webp" alt="Rumah Sakit Hewan Pendidikan Unair">
</div>

<nav class="nav-bawah">
  <a href="/struktur">Struktur Organisasi</a>
  <a href="/layanan">Layanan Umum</a>
  <a href="/pelatihan">Pelatihan</a>
</nav>

<section class="struktur">
  <img src="./aset/struktur.jpg" alt="Struktur Organisasi RSHP Unair">
</section>

<footer>
  <h3>RUMAH SAKIT HEWAN PENDIDIKAN</h3>
  GEDUNG RS HEWAN PENDIDIKAN<br>
  rshp@fkh.unair.ac.id<br>
  Telp : 031 5927832<br>
  Kampus C Universitas Airlangga<br>
  Surabaya 60115, Jawa Timur
</footer>

</body>
</html>