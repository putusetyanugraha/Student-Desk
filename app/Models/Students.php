<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Students extends Model
{
    // 1. nama tablenya apa
    protected $table = 'students';

    // 2. field apa saja yang bisa diisi
    protected $fillable = [
        'name',
        'nim',
        'prediction'
    ];

    // 3. relasi
    public function student_scores()
    {
        return $this->hasMany(Scores::class, 'student_id');
    }

    //  4. custome function
    public function getAverage(): float
    {
        if($this->relationLoaded('scores')){
            $count = $this->student_scores->count();
            if($count == 0) {
                return 0;
            }
        };

        return round($this->student_scores->avg('score'), 2);
    }
}
