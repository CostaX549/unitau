<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;


class TarefaForm extends Form
{
  
    #[Validate('required|string')] 
    public $titulo = '';
 #[Validate('required|date')] 
    public $dateinicial = '';
 
    #[Validate('required|date')] 
    public $datefinal = '';
 
    #[Validate('required|string')] 
    public $descricao = '';

    #[Validate(['arquivos.*' => 'required|file'])]
    public $arquivos = [];

 



}
