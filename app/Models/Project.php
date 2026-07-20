<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'name', 'description', 'guide_pdf', 'price', 'is_active',
    ];

    public function prospects()
    {
        return $this->hasMany(Prospect::class);
    }
}