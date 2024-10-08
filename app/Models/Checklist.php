<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Checklist extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'deadline_at',
        'title',
        'description',
    ];

    public function items()
    {
        return $this->hasMany(ChecklistItem::class);
    }
}
