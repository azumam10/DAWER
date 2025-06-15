<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AlumniOrganisasi extends Model
{
    use HasFactory;

    protected $table = 'alumni_organisasi';

    protected $fillable = [
        'alumni_id',
        'organisasi_id',
    ];

    // Optional: jika ingin akses ke relasi dari model pivot langsung
    public function alumni()
    {
        return $this->belongsTo(Alumni::class);
    }

    public function organisasi()
    {
        return $this->belongsTo(Organisasi::class);
    }
}
