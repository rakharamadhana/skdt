<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Uuid, SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'user_id';

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
        'area_id',
        'citizen_id_card',
        'fullname',
        'birthplace',
        'birthday',
        'address',
        'phone',
        'email',
        'gender',
        'nationality',
        'year_entries',
        'year_active',
        'leader_name',
        'password',
        'username',
        'password',
        'created_by',
        'updated_by',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'created_at',
        'updated_at',
        'deleted_at',
        'created_by',
        'updated_by',
    ];

    public function area(){
        return $this->belongsTo(Area::class, 'area_id', 'area_id');
    }

    public function statusToText(){
        switch($this->user_status){
            case 1: return 'Mahasiswa'; break;
            case 10: return 'PPI cabang'; break;
            case 11: return 'Internal PPI Taiwan'; break;
            case 12: return 'BANOM PPI Taiwan'; break;
            case 100: return 'Pusat'; break;
            case 101: return 'Admin SIAP'; break;
            case 102: return 'Admin KPIT'; break;
            case 103: return 'Admin I3S'; break;
            case 104: return 'Bendahara I3S'; break;
            case 105: return 'Ilmiah I3S'; break;
            default: return ''; break;
        }
    }

    public function scopeIsAreaUser($query, $area_id){
        return $query->where('area_id', $area_id);
    }

    public function getGenderAttribute($value){
        if($value == 1){
            return 'Laki-Laki';
        }else if($value == 2){
            return 'Perempuan';
        }else{
            return '';
        }
    }

    public function getBirthdayAttribute($value){
        if($value){
            return date_format(date_create($value), 'd M Y');
        }else{
            return '';
        }
    }

    public function getDateBirthdayAttribute(){
        if($this->birthday){
            return date_format(date_create($this->birthday), 'Y-m-d');
        }else{
            return '';
        }
    }
}
