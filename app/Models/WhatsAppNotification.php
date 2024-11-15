<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WhatsAppNotification extends Model
{
    use HasFactory;

    protected $table = 'whatsapp_notifications';
    
    protected $guarded = [
        'id'
    ];
}
