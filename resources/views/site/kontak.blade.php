<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="description" content="Kontak dan Informasi RSHP Unair">
  <meta name="keywords" content="RSHP Unair, Kontak Kami, Alamat, Telepon">
  <meta name="author" content="Diaul">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kontak Kami - RSHP Unair</title>
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

    /* Gaya Khusus Halaman Kontak */
    .kontak-container {
      max-width: 700px;
      margin: 40px auto 60px;
      padding: 0 15px;
      text-align: center;
    }

    .kontak-container h1 {
      color: #6a9ac4;
      margin-bottom: 35px;
      font-weight: 700;
      font-size: 30px;
    }

    .kontak-box {
        background-color: #ffffff;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.1);
        margin-bottom: 30px;
        border-top: 5px solid #f7b267;
    }
    
    .kontak-item {
        margin-bottom: 25px;
        display: flex;
        align-items: center;
        text-align: left;
    }
    
    .kontak-item img {
        width: 30px;
        height: 30px;
        margin-right: 20px;
        filter: drop-shadow(0 0 5px rgba(106, 154, 196, 0.5));
    }
    
    .kontak-item p {
        margin: 0;
        font-size: 17px;
    }

    .kontak-item a {
        color: #3f5e71;
        text-decoration: none;
        font-weight: 600;
        transition: color 0.3s ease;
    }
    
    .kontak-item a:hover {
        color: #f7b267;
    }

    .map-container {
        overflow: hidden;
        border-radius: 12px;
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.1);
    }
    
    .map-container iframe {
        width: 100%;
        height: 350px;
        border: 0;
    }

    /* Akhir Gaya Khusus */

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
      .kontak-container {
        margin: 30px auto 50px;
      }
      .kontak-box {
          padding: 20px;
      }
      .kontak-item {
          flex-direction: column;
          align-items: flex-start;
          text-align: left;
          margin-bottom: 20px;
      }
      .kontak-item img {
          margin-bottom: 10px;
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
  <a href="/Pelatihan">Pelatihan</a>
</nav>

<section class="kontak-container">
    <h1>Hubungi Kami</h1>
    
    <div class="kontak-box">
        <div class="kontak-item">
            <img src="https://img.icons8.com/color/48/phone.png" alt="Telepon">
            <p>
                **Telepon Utama:** <a href="tel:0315927832">031 5927832</a> <br>
                <small style="color: #6a9ac4; font-weight: 600;">(Informasi Umum & Pendaftaran)</small>
            </p>
        </div>
        
        <div class="kontak-item">
            <img src="https://img.icons8.com/color/48/whatsapp.png" alt="WhatsApp">
            <p>
                **WhatsApp (Chat Only):** <a href="https://wa.me/6281234569007" target="_blank">+62 812-3456-9007</a> <br>
                <small style="color: #6a9ac4; font-weight: 600;">(Khusus Layanan Ultrasonografi)</small>
            </p>
        </div>
        
        <div class="kontak-item">
            <img src="https://img.icons8.com/color/48/email.png" alt="Email">
            <p>
                **Email:** <a href="mailto:rshp@fkh.unair.ac.id">rshp@fkh.unair.ac.id</a> <br>
                <small style="color: #6a9ac4; font-weight: 600;">(Kerja Sama & Keperluan Administrasi)</small>
            </p>
        </div>
        
        <div class="kontak-item">
            <img src="https://img.icons8.com/color/48/address.png" alt="Alamat">
            <p>
                **Alamat Fisik:** <br>
                GEDUNG RS HEWAN PENDIDIKAN, Kampus C Universitas Airlangga, Surabaya 60115, Jawa Timur
            </p>
        </div>
    </div>
    
    <h2>Lokasi Kami</h2>
    <div class="map-container">
        <iframe 
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3957.519398846175!2d112.78441111477481!3d-7.291730094723049!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7fb3907c1340b%3A0x8677f52554746f33!2sRumah%20Sakit%20Hewan%20Pendidikan%20(RSHP)!5e0!3m2!1sid!2sid!4v1633590000000!5m2!1sid!2sid" 
            allowfullscreen="" 
            loading="lazy">
        </iframe>
    </div>
</section>

<footer>
  <h3>RUMAH SAKIT HEWAN PENDIDIKAN</h3>
  GEDUNG RS HEWAN PENDIDIKAN<br>
  rshp@fkh.