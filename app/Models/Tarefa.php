<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarefa extends Model
{
    use HasFactory;


    protected $fillable = [
       'StartDate',
       'EndDate',
       'descricao',
       'texto',
       'file',
     'status',
       'equipe_id'
    ];

    public function equipe(){
          return $this->belongsTo(Equipe::class,"equipe_id");
    }
    public function owner(){
        return $this->belongsTo(User::class,"owner_id");
  }

  public function files(){
 return $this->hasMany(TarefaFiles::class, 'tarefa_id', 'id');
  }
}
