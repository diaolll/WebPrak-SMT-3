<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="description" content="Pelatihan dan Pendidikan Keprofesian Berkelanjutan RSHP Unair">
  <meta name="keywords" content="RSHP Unair, Pelatihan, Seminar, Workshop, Dokter Hewan">
  <meta name="author" content="Diaul">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pelatihan - RSHP Unair</title>
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

    /* Gaya Khusus Halaman Pelatihan */
    .pelatihan-container {
      max-width: 900px;
      margin: 40px auto 60px;
      padding: 0 15px;
    }

    .pelatihan-container h1 {
      text-align: center;
      color: #6a9ac4;
      margin-bottom: 30px;
      font-weight: 700;
      font-size: 28px;
    }
    
    .pelatihan-intro {
        text-align: center;
        margin-bottom: 40px;
        font-size: 17px;
        color: #555;
    }

    .jadwal-list {
        display: grid;
        gap: 25px;
    }
    
    .jadwal-card {
        background-color: #ffffff;
        padding: 25px;
        border-radius: 10px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        border-left: 5px solid #f7b267;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .jadwal-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
    }

    .jadwal-card h2 {
        color: #3f5e71;
        margin-top: 0;
        font-size: 22px;
        font-weight: 600;
        border-bottom: 2px solid #6a9ac4;
        padding-bottom: 10px;
        margin-bottom: 10px;
    }

    .info-detail {
        display: flex;
        flex-wrap: wrap;
        gap: 15px 30px;
        font-size: 15px;
        margin-bottom: 15px;
    }

    .info-detail span {
        font-weight: 600;
        color: #6a9ac4;
    }
    
    .btn-detail {
        display: inline-block;
        background-color: #6a9ac4;
        color: white;
        padding: 10px 20px;
        text-decoration: none;
        border-radius: 5px;
        font-weight: 600;
        transition: background-color 0.3s ease;
    }
    
    .btn-detail:hover {
        background-color: #f7b267;
        color: #3f5e71;
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
      .pelatihan-container {
        margin: 30px auto 50px;
      }
      .info-detail {
          flex-direction: column;
          gap: 10px;
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
  <a href="/pelatihan">Pelatihan</a> </nav>

<section class="pelatihan-container">
    <h1>Jadwal Pelatihan dan Pendidikan Berkelanjutan</h1>
    
    <p class="pelatihan-intro">
        Rumah Sakit Hewan Pendidikan Universitas Airlangga secara rutin mengadakan kegiatan edukasi, berupa seminar, webinar, atau workshop maupun pendidikan keprofesian berkelanjutan dengan menghadirkan narasumber profesional dan sangat kompeten dalam bidangnya.
    </p>
    
    <div class="jadwal-list">
        
        <div class="jadwal-card">
            <h2>Seminar dan Workshop Cytological & Histopathology</h2>
            <div class="info-detail">
                <p><span>Tanggal:</span> 20 - 21 April 2025</p>
                <p><span>Tempat:</span> Ruang Seminar RSHP Unair & Lab. Patologi</p>
                <p><span>Narasumber:</span> Dr. drh. XXX, M.Vet. (Spesialis Patologi)</p>
            </div>
            <p>Pelatihan mendalam mengenai teknik diagnosis sitologi dan histopatologi pada kasus klinis hewan kesayangan.</p>
            <a href="#" class="btn-detail">Lihat Detail & Daftar</a>
        </div>

        <div class="jadwal-card">
            <h2>Webinar: Update Terapi Cairan pada Kasus Gawat Darurat</h2>
            <div class="info-detail">
                <p><span>Tanggal:</span> 15 Juni 2025</p>
                <p><span>Tempat:</span> Online via Zoom</p>
                <p><span>Narasumber:</span> Prof. drh. YYY, Ph.D. (Spesialis Penyakit Dalam)</p>
            </div>
            <p>Sesi daring yang membahas protokol dan perkembangan terbaru dalam manajemen terapi cairan untuk pasien hewan kritis.</p>
            <a href="#" class="btn-detail">Lihat Detail & Daftar</a>
        </div>
        
        <div class="jadwal-card">
            <h2>Workshop Bedah Ortopedi Dasar (Keterampilan Dasar)</h2>
            <div class="info-detail">
                <p><span>Tanggal:</span> 10 - 12 Juli 2025</p>
                <p><span>Tempat:</span> Ruang Operasi RSHP Unair</p>
                <p><span>Narasumber:</span> drh. ZZZ, Sp.Rad. (Spesialis Bedah)</p>
            </div>
            <p>Pelatihan praktik langsung untuk meningkatkan keterampilan dokter hewan muda dalam prosedur bedah ortopedi dasar.</p>
            <a href="#" class="btn-detail">Lihat Detail & Daftar</a>
        </div>
        
        <div class="jadwal-card">
            <h2>Seminar: Manajemen Kesehatan Populasi Ternak Besar</h2>
            <div class="info-detail">
                <p><span>Tanggal:</span> 05 Oktober 2025</p>
                <p><span>Tempat:</span> Aula FKH Unair</p>
                <p><span>Narasumber:</span> Tim Ahli Kesehatan Ternak</p>
            </div>
            <p>Seminar yang berfokus pada pencegahan penyakit dan peningkatan produktivitas pada hewan ternak besar.</p>
            <a href="#" class="btn-detail">Lihat Detail & Daftar</a>
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