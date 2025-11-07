<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="description" content="Rumah Sakit Hewan Pendidikan Unair">
  <meta name="keywords" content="HTML, CSS">
  <meta name="author" content="Diaul">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home - RSHP Unair</title>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Urbanist:wght@300;400;600;700&display=swap');

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
      align-items: center;
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

    .dua-kolom {
      display: flex;
      justify-content: center;
      align-items: flex-start;
      gap: 40px;
      padding: 40px 20px;
      flex-wrap: wrap;
    }
    .dua-kolom iframe {
      max-width: 100%;
      width: 560px;
      height: 315px;
      border-radius: 12px;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
    }
    .dua-kolom .teks {
      max-width: 500px;
      font-size: 1.3rem;
      text-align: justify;
    }

    .berita {
      padding: 40px 20px;
      background-color: #f3f9fc;
    }
    .berita h2 {
      text-align: center;
      margin-bottom: 30px;
      color: #3f5e71;
    }
    .berita-wrapper {
      display: flex;
      gap: 30px;
      justify-content: center;
      flex-wrap: wrap;
    }
    .berita-item {
      width: 350px;
      background: #fff;
      border-radius: 12px;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
      display: flex;
      flex-direction: column;
      overflow: hidden;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .berita-item:hover {
      transform: translateY(-5px);
      box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
    }
    .berita-item img {
      width: 100%;
      height: 220px;
      object-fit: cover;
    }
    .berita-item-content {
      padding: 20px;
      flex-grow: 1;
      text-align: justify;
      display: flex;
      flex-direction: column;
    }
    .berita-item-content p {
      margin: 0 0 10px;
      font-size: 15px;
      line-height: 1.5;
      color: #555;
    }
    .berita-item-content p.judul {
      font-weight: 700;
      font-size: 1.1rem;
      line-height: 1.4;
      color: #3f5e71;
      margin-bottom: 15px;
    }
    .berita-item-content span {
      font-size: 13px;
      color: #999;
      margin-top: auto;
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
        gap: 15px;
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
      .dua-kolom {
        flex-direction: column;
        align-items: center;
        gap: 20px;
        padding: 20px;
      }
      .dua-kolom iframe,
      .dua-kolom .teks {
        width: 100%;
        max-width: 100%;
      }
      .berita-wrapper {
        gap: 20px;
      }
      .berita-item {
        width: 100%;
        max-width: 400px;
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
    @guest
        <a href="{{ route('login') }}">Login</a>
    @else
        @php
            $role = session('user_role');
            $dashboards = [
                1 => route('admin.dashboard'),
                2 => route('admin.Dokter.Dashboard_dokter'),
                3 => route('admin.perawat.Dashboard_perawat'),
                5 => route('admin.pemilik.Dashboard_pemilik'),
                8 => route('admin.Resepsionis.Dashboard_Resepsionis'),
            ];
        @endphp
        <a href="{{ $dashboards[$role] ?? route('home') }}">Dashboard</a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit">Logout</button>
        </form>
    @endguest
    </nav>
</nav>

<div class="banner">
    <img src="./aset/banner.webp" alt="Rumah Sakit Hewan Pendidikan Unair">
</div>

<nav class="nav-bawah">
  <a href="/struktur">Struktur Organisasi</a>
  <a href="/layanan">Layanan Umum</a>
  <a href="/pelatihan">Pelatihan</a>
</nav>

<section class="dua-kolom">
  <div>
    <iframe width="560" height="315" src="https://www.youtube.com/embed/rCfvZPECZvE?si=6UU1MSyB2qtCoiME" title="YouTube video player" frameborder="0" allowfullscreen></iframe>
  </div>
  <div class="teks">
    <p>Rumah Sakit Hewan Pendidikan Universitas Airlangga berinovasi untuk selalu meningkatkan kualitas pelayanan, maka dari itu Rumah Sakit Hewan Pendidikan Universitas Airlangga mempunyai fitur pendaftaran online yang mempermudah untuk mendaftarkan hewan kesayangan anda.</p>
  </div>
</section>

<section class="berita">
  <h2>Berita Terkini</h2>
  <div class="berita-wrapper">
    <div class="berita-item">
      <img src="./aset/berita1.jpg" alt="Program Kerja Sama">
      <div class="berita-item-content">
        <p class="judul">Program Kerja Sama Rumah Sakit Hewan Pendidikan dengan SMK Negeri Tutur</p>
        <p>Rumah Sakit Hewan Pendidikan menjalin kerja sama dengan SMK Negeri Tutur dalam rangka meningkatkan kompetensi siswa di bidang kesehatan hewan. Acara ini meliputi pelatihan langsung dan observasi lapangan.</p>
        <span>29 September 2023</span>
      </div>
    </div>
    <div class="berita-item">
      <img src="./aset/berita2.jpg" alt="Road To Pet Festival">
      <div class="berita-item-content">
        <p class="judul">Road To Pet Festival 2023 Vaksin Purevax Gratis</p>
        <p>Dalam rangka memeriahkan Road To Pet Festival, Rumah Sakit Hewan Pendidikan memberikan layanan vaksin Purevax gratis bagi kucing peliharaan warga sekitar. Acara ini berlangsung selama dua hari penuh.</p>
        <span>25-26 September 2023</span>
      </div>
    </div>
    <div class="berita-item">
      <img src="./aset/berita3.jpg" alt="World Rabies Day">
      <div class="berita-item-content">
        <p class="judul">World Rabies Day</p>
        <p>Peringatan Hari Rabies Sedunia diadakan untuk meningkatkan kesadaran masyarakat tentang bahaya rabies dan pentingnya vaksinasi hewan peliharaan.</p>
        <span>28 September 2023</span>
      </div>
    </div>
  </div>
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