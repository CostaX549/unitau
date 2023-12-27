<?php

use Livewire\Volt\Component;
use App\Models\Equipe;
use App\Models\Tarefa;
use Illuminate\View\View;
new class extends Component {
    public Equipe $equipe;
    public Tarefa $tarefa;




    public function mount($id,$id1){
          $this->equipe = Equipe::findOrFail($id);
           $this->tarefa = Tarefa::findOrFail($id1);


          
    }
    public function download($fullFilePath)
{
    $path = storage_path('app/public/' . $fullFilePath);

    return response()->download($path);
}
}; ?>


   
  <div class=" p-20"> 
    @php
    $dataInicio = is_string($tarefa->StartDate) ? new \DateTime($tarefa->StartDate) : $tarefa->StartDate;
    $dataFinal = is_string($tarefa->EndDate) ? new \DateTime($tarefa->EndDate) : $tarefa->EndDate;
   @endphp

    <h1 class="text-4xl mb-3">{{ $tarefa->texto }}</h1>
  <h2  class="text-lg mb-2">Data de Início: {{ $dataInicio->format('d/m/Y H:i') }}</h2>
  <h2  class="text-lg mb-3">Data de Entrega: {{ $dataFinal->format('d/m/Y H:i') }}</h2>
  <div class="bg-blue-600 rounded-md text-center flex justify-center text-white p-2 mb-3"><svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 256 256"><path fill="#FFFFFF" d="M209.66 122.34a8 8 0 0 1 0 11.32l-82.05 82a56 56 0 0 1-79.2-79.21l99.26-100.72a40 40 0 1 1 56.61 56.55L105 193a24 24 0 1 1-34-34l83.3-84.62a8 8 0 1 1 11.4 11.22l-83.31 84.71a8 8 0 1 0 11.27 11.36L192.93 81A24 24 0 1 0 159 47L59.76 147.68a40 40 0 1 0 56.53 56.62l82.06-82a8 8 0 0 1 11.31.04"/></svg>Anexos</div>
  <div class="flex flex-col gap-4">
 @foreach($tarefa->files as $file)   
<x-file-box :file="$file" />
@endforeach
  </div>
 {{--    <div class="max-w-md mx-auto bg-white rounded-xl shadow-md overflow-hidden md:max-w-2xl m-5">
        <div class="p-8 flex">
            <div class="pr-4">
             <p>{{$tarefa->owner->name}}</p>   
            <p class="text-4xl font-bold">{{ $tarefa->StartDate }}</p>
            <p class="text-4xl font-bold">{{ $tarefa->EndDate }}</p>
            <p>{{$tarefa->descricao}}</p>
            <p class="text-4xl font-bold">{{ $tarefa->equipe->name }}</p>
            </div>
            <div>
                <button type="button" wire:click="download('{{ $tarefa->file }}')">Download</button>
               @can("enviar",$tarefa) 
                <label for="file">Enviar Arquivo</label>
                <input type="file" id="file" class="hidden" name=""  >
               @else
                    
                  <p>O tempo Excedeu</p>
               @endcan  
<a href="{{ asset('storage/' . $tarefa->file) }}">Ver Arquivo</a>
               
            </div>
        </div>
        </div> --}}
    </div>    
