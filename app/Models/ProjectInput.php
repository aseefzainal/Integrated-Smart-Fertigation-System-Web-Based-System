<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProjectInput extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    // Relationship to Project
    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    // Relationship to Input
    public function input(): BelongsTo
    {
        return $this->belongsTo(Input::class);
    }
}
