<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PdfDocument extends Model
{
    use HasFactory;
        protected $table='pdf_documen'
     protected $fillable =['title','contents'];
}
