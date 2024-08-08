<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tool extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
    ];


    public function websites()
    {
        return $this->hasMany(Website::class, 'tool_id');
    }
}
