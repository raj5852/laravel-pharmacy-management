<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicineper extends Model
{
    use HasFactory;
    protected $fillable = ['name','company','quantity','rack','supplier','priceparunit','saleprice','totalcost','expairdate'];
}
