<?php

namespace App\Models;

use Carbon\Traits\Timestamp;
use Illuminate\Database\Eloquent\Model;

class Logs extends Model
{
    /**
     * The attributes that are mass assignable.
     * @property integer user_id
     * @property string ip_address
     */
    protected $fillable = [
        'ip_address', 'user_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     * @property integer id
     */
    protected $hidden = [
        'id'
    ];

    /**
     * The attributes that should be cast to native types.
     * @property timestamp created_at
     */
    protected $casts = [
        'created_at' => 'timestamp'
    ];

    public function logs()
    {
        return $this->belongsTo(Logs::class, 'user_id');
    }

}
