<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Schedule extends Model
{
    use HasFactory;

    public function projectInput(): BelongsTo
    {
        return $this->belongsTo(ProjectInput::class);
    }

    protected function casts(): array
    {
        return [
            'date' => 'date',
            'time' => 'date'
        ];
    }
}
