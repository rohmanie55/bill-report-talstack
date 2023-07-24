<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $appended =['slip_url'];

    public function getSlipUrlAttribute()
    {
        return Storage::url($this->pay_slip);
    }

    public static function generateCode(){
        return "IV".sprintf("%06s",(int)substr(self::selectRaw('MAX(code) as max')->first()->max, 2, 6)+1);
    }

    public function user(){
        return $this->hasOne(User::class,'id','user_id');
    }

    public function type(){
        return $this->hasOne(BillType::class,'id','type_id');
    }
}
