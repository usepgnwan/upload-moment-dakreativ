<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

use Cviebrock\EloquentSluggable\Sluggable;
class UsersPelanggan extends Model
{

    use Sluggable;
    use HasFactory;
    protected $guarded = ['id'];
    protected $with = ['event','paket'];
    public function moments(): HasMany{
        return  $this->HasMany(UserMoment::class, 'user_pelanggan_id');
    }

    public function event(): BelongsTo{
        return $this->belongsTo(Event::class);
    }
    public function paket(): BelongsTo{
        return $this->belongsTo(Paket::class);
    }

    public function sluggable(): array
        {
            return [
                'username' => [
                    'source' => 'name'
                ]
            ];
        }
}
