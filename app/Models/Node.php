<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Violation;

class Node extends Model
{
    use HasFactory;
    protected $fillable = [
        'violation_id',
        'any',
        'all',
        'none',
        'node_impact',
        'html',
        'target',
        'failureSummary',
    ];



    public function violation()
    {
        return $this->belongsTo(Violation::class, 'violation_id', 'id');
    }
}
