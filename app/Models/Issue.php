<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Issue extends Model
{
    use HasFactory;
    protected $fillable = [
        'website',
        'batch',
        'page',
        'url',
        'issue_link',
        'description',
        'criterion',
        'issue_reference',
        'element',
        'check_type',
        'responsibility',
        'severity',
        'complexity',
        'date',
    ];
 
}
