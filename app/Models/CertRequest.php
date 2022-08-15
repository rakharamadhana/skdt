<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;
use Illuminate\Database\Eloquent\SoftDeletes;

class CertRequest extends Model
{
    use Uuid, SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'cert_requests';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'cert_request_id';

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'string';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'cert_status',
        'dept',
        'pic',
        'pic_contact',
        'title',
        'purpose',
        'start_date',
        'end_date',
        'support_file',
        'cert_url',
        'approval_at',
        'approval_by',
        'created_by',
        'updated_by',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'updated_at',
        'deleted_at',
        'created_by',
        'updated_by',
    ];

    public function statusToText(){
        switch($this->cert_status){
            case 0: return 'Menunggu Respon'; break;
            case 1: return 'Ditolak, butuh revisi'; break;
            case 2: return 'Diterima'; break;
            case 10: return 'Sedang Diproses'; break;
            default: return ''; break;
        }
    }

    public function created_by_user(){
        return $this->belongsTo(User::class, 'created_by', 'user_id');
    }

    public function getCreatedAtAttribute($value){
        return date_format(date_create($value), 'd M Y H:i');
    }
    
    public function getAttachmentUrlAttribute($value){
        return url($value);
    }

    public function scopeByUser($query, $user_id){
        return $query->where('created_by', $user_id);
    }
}
