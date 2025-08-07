<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class ContactMessage extends Model
{
    use HasFactory;

    protected $table = 'contact_messages';

    protected $fillable = [
        'name',
        'email',
        'subject',
        'message',
        'phone',
        'ip_address',
        'is_read',
        'read_at'
    ];

    protected $casts = [
        'is_read' => 'boolean',
        'read_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    // Scopes
    public function scopeUnread($query)
    {
        return $query->where('is_read', false);
    }

    public function scopeRead($query)
    {
        return $query->where('is_read', true);
    }

    // Methods
    public function markAsRead()
    {
        $this->update([
            'is_read' => true,
            'read_at' => now()
        ]);
    }

    public function markAsUnread()
    {
        $this->update([
            'is_read' => false,
            'read_at' => null
        ]);
    }

    // Static methods for statistics
    public static function todayCount()
    {
        return self::whereDate('created_at', today())->count();
    }

    public static function unreadCount()
    {
        return self::unread()->count();
    }

    public static function thisWeekCount()
    {
        return self::whereBetween('created_at', [
            Carbon::now()->startOfWeek(),
            Carbon::now()->endOfWeek()
        ])->count();
    }

    public static function thisMonthCount()
    {
        return self::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();
    }
}
