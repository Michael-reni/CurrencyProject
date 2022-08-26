<?php

namespace App\Models\CurrencyProject;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';

    protected $keyType = 'string';

    protected $fillable = ['name','currency_code','exchange_rate'];
    
    protected $table =  'currencies';

    public $incrementing = false;

    public $timestamps = false;
}
