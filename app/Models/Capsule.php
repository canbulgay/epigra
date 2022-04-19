<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Capsule extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string ,dateTime ,text ,enum>
     */
    protected $fillable = [
        'capsule_id',
        'capsule_serial',
        'capsule_status',
        'original_launch',
        'original_launch_unix',
        'landings',
        'type',
        'details',
        'reuse_count',
    ];

    /**
     * The attributes that should be cast.
     * 
     * @var array<string, string>
     */

    protected $casts = [
        'original_launch' => 'datetime: Y-m-d H:i:s',
    ];

    /**
     * Set original_launch attribute to Carbon instance.
     * 
     * @param dateTime $value
     */
    public function setOriginalLaunchAttribute($value)
    {
        $this->attributes['original_launch'] = Carbon::parse($value);
    }

    /**
     * Missions of the capsule.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function missions()
    {
        return $this->hasMany(Mission::class, 'capsule_serial', 'capsule_serial');
    }
}
