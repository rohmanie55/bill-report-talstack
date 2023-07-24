<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillType extends Model
{
    use HasFactory;

    protected $guarded = [];

    public static function generateCode(){
        return "BT".sprintf("%06s",(int)substr(self::selectRaw('MAX(code) as max')->first()->max, 2, 6)+1);
    }
}
