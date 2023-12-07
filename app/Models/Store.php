<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Store extends Model
{
    use HasFactory , Notifiable;
    // //        if you dont use standard roules in any case
    // const CREATED_AT = 'created_at'; // if you want change created_at field name
    // const UPDATED_AT = 'updated_at'; // if you want change updated_at field name

    // protected $connection = 'mysql'; // to define DB that  will use

    // protected $table ='stores'; //to define DB table that will use

    // protected $primaryKey = 'id'; //to define ID field

    // protected $keyType = 'int'; // if you want chgange primary key from int to any data type

    // public $increminting = True; // if you define id non increment

    // public $timestamps = true;// if you want delete or stop run the timestamps

    public function products()
    {
        return $this->hasMany(Product::class,'store_id','id');
    }
}
