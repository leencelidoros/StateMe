<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    use HasFactory;
    protected $fillable =[
        'accountNo',
        'clientName',
        'loanProductName',
        'principal',
        'repayments',
        'amtDisbursed',
    ];

  public function client(){
    return $this->belongsTo('Client::class');
  }
}
