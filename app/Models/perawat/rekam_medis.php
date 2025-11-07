<?php

namespace App\Models\perawat;

use Illuminate\Database\Eloquent\Model;
use App\Models\DaftarPet; // Menggunakan model DaftarPet
use App\Models\User;    // Asumsi model User ada di App\Models
use App\models\rekam_medis;

// app/Http/Controllers/perawat/PerawatDashboardController.php

use App\Models\RekamMedis; // <-- Perbaiki di baris paling atas controller Anda

class PerawatDashboardController extends Controller
{
    public function index()
    {
        // ... (baris 15 yang bermasalah, misalnya)
        $rekam_medis_data = RekamMedis::where(/* ... */)->get(); 
        // ...
    }
}