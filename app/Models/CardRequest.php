<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;
use Illuminate\Database\Eloquent\SoftDeletes;

class CardRequest extends Model
{
    use Uuid, SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'card_requests';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'card_request_id';

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

    public function genderToText(){
        switch($this->gender){
            case 1: return 'LAKI-LAKI'; break;
            case 2: return 'PEREMPUAN'; break;
            default: return ''; break;
        }
    }

    public function statusToText(){
        switch($this->card_status){
            case 0: return 'Menunggu Respon'; break;
            case 1: return 'Ditolak, butuh revisi'; break;
            case 2: return 'Diterima'; break;
            case 10: return 'Sedang Diproses'; break;
            case 100: return 'Masih dalam pengisian'; break;
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
