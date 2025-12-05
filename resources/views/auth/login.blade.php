<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login - RSHP Unair</title> <!-- Diubah menjadi Login -->

  <!-- Mengambil CSS yang sama dengan layout GXON untuk konsistensi -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap" rel="stylesheet">
  
  <link rel="stylesheet" href="{{ asset('assets/libs/flaticon/css/all/all.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/libs/fontawesome/css/all.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/libs/node-waves/waves.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}">
    
    <style>
    </style>
</head>

<body>
  <div class="auth-frame-wrapper">

    <div class="row g-0 h-100">
      
      {{-- Cover Image Side (Diambil dari GXON Template) --}}
      <div class="col-lg-6">
        <div class="auth-frame" style="background-image: url({{ asset('assets/images/auth/memegw.jpg') }});">
          <div class="clearfix p-5">
            <!-- <div class="auth-content">
              <h1 class="display-6 text-white fw-bold">Selamat Datang Kembali!</h1>
              <p class="text-white">Sistem manajemen RSHP membantu menjaga kualitas pelayanan dan kesejahteraan hewan peliharaan Anda.</p>
            </div> -->
            <div class="auth-imgs position-relative text-center">
            </div>
          </div>
        </div>
      </div>
      
      {{-- Login Form Side --}}
      <div class="col-lg-6 align-self-center">
        <div class="p-4 p-sm-5 maxw-450px m-auto">
          
          <div class="mb-4 text-center">
            <a href="{{ url('/') }}" aria-label="RSHP logo">
              <img class="visible-light" src="{{ asset('assets/images/logo-full.svg') }}" alt="RSHP logo" height="40">
            </a>
          </div>
          
          <div class="text-center mb-5">
            <h5 class="mb-1">Masuk ke Akun Anda</h5> <!-- Diubah menjadi Login -->
            <p>Silakan masukkan detail akun Anda untuk melanjutkan.</p> <!-- Diubah -->
          </div>
          
          <form method="POST" action="{{ route('login') }}"> <!-- Action diubah ke route('login') -->
            @csrf
            
            {{-- Input EMAIL --}}
            <div class="mb-3">
              <label class="form-label" for="loginEmail">Alamat Email</label>
              <input type="email" class="form-control @error('email') is-invalid @enderror" id="loginEmail" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="alamak@example.com">
              @error('email')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
              @enderror
            </div>
            
            {{-- Input PASSWORD --}}
            <div class="mb-3">
              <label class="form-label" for="loginPassword">Password</label>
              <input type="password" class="form-control @error('password') is-invalid @enderror" id="loginPassword" name="password" required autocomplete="current-password" placeholder="********">
              @error('password')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
              @enderror
            </div>

            {{-- Remember Me & Forgot Password --}}
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-label" for="remember">
                        Ingat Saya
                    </label>
                </div>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-primary fw-semibold small">Lupa Password?</a>
                @endif
            </div>
            
            <div class="mb-3">
              <button type="submit" class="btn btn-primary waves-effect waves-light w-100">Login</button> <!-- Button diubah menjadi Login -->
            </div>
            
            <p class="mb-5 text-center">Belum punya akun? <!-- Teks diubah -->
              <a href="{{ route('register') }}" class="text-primary fw-semibold">Daftar di sini</a> <!-- Link diubah ke register -->
            </p>
          </form>

        </div>
      </div>
    </div>

  </div>
  
  <!-- begin::GXON Page Scripts -->
  <script src="{{ asset('assets/libs/global/global.min.js') }}"></script>
  <script src="{{ asset('assets/js/appSettings.js') }}"></script>
  <script src="{{ asset('assets/js/main.js') }}"></script>
  <!-- end::GXON Page Scripts -->
</body>

</html>