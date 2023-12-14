<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipe extends Model
{


   
    use HasFactory;
    public function owner(){
        $this->belongsTo(User::class,"owner_id");
  }
  public function users(){
    return $this->belongsToMany(User::class,"members","equipe_id","user_id");
}
}
