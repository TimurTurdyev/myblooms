<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Filters\Filterable;

class Group extends Model
{
    use HasFactory, Filterable;

    protected $fillable = [
        'name',
        'sort',
    ];

    protected $allowedFilters = [
        'id',
        'name',
        'sort',
        'updated_at',
        'created_at',
    ];

    protected $allowedSorts = [
        'id',
        'name',
        'sort',
        'updated_at',
        'created_at',
    ];
}
