<?php

namespace App\Models;

use App\Models\KartuKeluarga;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Siswa extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'siswa';
    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nis',
        'kk_id',
        'level_id',
        'class_id',
        'nik', 
        'name',
        'date_of_birth',
        'gender',
        'address', 
        'status' 
    ];

    public function kartuKeluarga(){
        return $this->belongsTo(KartuKeluarga::class, 'kk_id', 'id');
    }

    public function level()
    {
        return $this->belongsTo(LevelSiswa::class, 'level_id', 'id');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'class_id', 'id');
    }
}
