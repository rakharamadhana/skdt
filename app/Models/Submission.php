<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;
use Illuminate\Database\Eloquent\SoftDeletes;

class Submission extends Model
{
    use Uuid, SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'submissions';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'submission_id';

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


    public function purposeToText(){
        switch($this->submission_purpose){
            case 1: return 'Eksternal'; break;
            case 2: return 'Internal'; break;
            case 3: return 'Tidak dipublikasikan'; break;
            default: return ''; break;
        }
    }

    public function statusToText(){
        switch($this->submission_status){
            case 0: return 'Waiting for Response'; break;
            case 1: return 'Need Revision'; break;
            case 2: return 'Accepted 100%'; break;
            case 10: return 'On-Process'; break;
            case 100: return 'Process of completing documents'; break;
            case 400: return 'Cancel'; break;
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
