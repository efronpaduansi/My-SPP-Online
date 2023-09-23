<?php

namespace App\Models;

use App\Models\TahunAjaran;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Semester extends Model
{
    use HasFactory;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'semester';

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
    protected $fillable = ['ta_id', 'semester_name', 'start_date', 'close_date'];

    public function tahunAjaran()
    {
        return $this->belongsTo(TahunAjaran::class, 'ta_id', 'id');
    }
}
