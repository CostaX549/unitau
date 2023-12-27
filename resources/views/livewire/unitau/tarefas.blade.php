<?php

use Livewire\Volt\Component;
use App\Models\Equipe;
use App\Models\Tarefa;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;
use Illuminate\Support\Carbon;
use App\Livewire\Forms\TarefaForm;


new class extends Component  {
 use WithFileUploads;
   public Equipe $equipe;      
   public Tarefa $tarefa;
   public TarefaForm $form;
    
  




    public function mount($id){
          $this->equipe = Equipe::findOrFail($id);
    


          
    }

 public function CriarTarefa(){

      $this->authorize('canCreate', $this->equipe); 


      $this->validate();


  

$carbonDateInicial = Carbon::createFromFormat('d-m-Y H:i', $this->form->dateinicial);
    
    if ($carbonDateInicial->isPast()) {
        session()->flash('errorInicial', 'Não é possível agendar eventos no passado.');
        return;
    }

 $carbonDateFinal =    Carbon::createFromFormat('d-m-Y H:i', $this->form->datefinal);

 if ($carbonDateFinal <= $carbonDateInicial) {
        session()->flash('errorFinal', 'Não é possível agendar.');
        return;
    }

  

  $tarefa =  auth()->user()->tarefas()->create([
        'StartDate' => $carbonDateInicial,
        'EndDate' => $carbonDateFinal,
        'equipe_id' => $this->equipe->id,
         'status' => 0,
        'texto' => $this->form->titulo,
        
        'descricao' => $this->form->descricao,
  
]);

foreach($this->form->arquivos as $arquivo) {
    $nomeRealDoArquivo = $arquivo->getClientOriginalName();
    $tarefa->files()->create([
     
        'file' => $arquivo->storeAs('uploads', $nomeRealDoArquivo,  'public'),
]);
}



$this->dispatch('close-modal');
$this->dispatch('tarefa-salva');
$this->form->reset('titulo', 'arquivo', 'dateinicial', 'datefinal', 'descricao');




 }

 
}; ?>


    
 
     
  
    <div class="w-3/4 p-4">
      @can('canCreate',$equipe)
      <button x-data x-on:click="$dispatch('open-modal', { name: '3'})" >Criar uma Tarefa</button>
      <x-modal-unitau name="3" title="Criar uma Tarefa">
            <x-slot:body>
     
      <form wire:submit="CriarTarefa">
           @session('success')
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4">
                            {{ $value }}
                        </div>
                @endsession
                    <div class="mb-4">
                        <label  class="block text-gray-600 text-sm font-medium mb-1">Título</label>
                        <input type="text" id="nome"  wire:model="form.titulo" class="w-full border px-2 py-2 rounded focus:outline-none focus:border-blue-400">
                        @error('form.titulo') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>
            
                    <div x-data="{ date: '' }" x-init="() => {
                flatpickr($refs.datepicker, {
                    enableTime: true,
                    dateFormat: 'd-m-Y H:i',
                    locale: 'pt',
                    time_24hr: true,
                    minDate: 'today', 
                   
                });
            }">
                <div class="mb-4">
                    <label  class="block text-gray-600 text-sm font-medium mb-1">Horário Inicial</label>
                    <input x-ref="datepicker" wire:model.blur="form.dateinicial" id="data" type="text"  class="w-full border px-2 py-2 rounded focus:outline-none focus:border-blue-400">
                    @error('form.dateinicial') <span class="text-red-500">{{ $message }}</span> @enderror
                    @session('errorInicial')
                    <span class="text-red-500">{{ $value }}</span>
                    @endsession
                </div>
            </div>

            <div x-data="{ date: '' }" x-init="() => {
                  flatpickr($refs.datepicker2, {
                      enableTime: true,
                      dateFormat: 'd-m-Y H:i',
                      locale: 'pt',
                      time_24hr: true,
                      minDate: 'today', 
                     
                  });
              }">
                  <div class="mb-4">
                      <label  class="block text-gray-600 text-sm font-medium mb-1">Horário Final</label>
                      <input x-ref="datepicker2" wire:model.blur="form.datefinal" id="data2" type="text"  class="w-full border px-2 py-2 rounded focus:outline-none focus:border-blue-400">
                      @error('form.datefinal') <span class="text-red-500">{{ $message }}</span> @enderror
                    @session('errorFinal')
                      <span class="text-red-500">{{ $value }}</span>
                      @endsession
                  </div>
              </div>
           
              <label class="mb-5 block text-xl font-semibold text-[#07074D]">
                  Enviar Arquivo
                </label>
         
              <label
              for="file"
              class=" cursor-pointer relative flex min-h-[200px] items-center justify-center rounded-md border border-dashed border-[#e0e0e0] p-12 text-center"
            >
            <input type="file" id="file"  wire:model="form.arquivos" class="sr-only" multiple >
        
               <span
               class="hover:bg-gray-100 inline-flex rounded border border-[#e0e0e0] py-2 px-7 text-base font-medium text-[#07074D]"
             >
              Enviar
             </span>
  
       

              
  
  
          
            </label> 




     
          
            @error('form.arquivos.*') <span class="error">{{ $message }}</span> @enderror        
                    <div class="mt-2 mb-6">
                        <label  class="block text-gray-600 text-sm font-medium mb-1">Descrição</label>
                        <textarea  wire:model.blur="form.descricao" rows="4" id="mensagem" class="w-full border px-2 py-2 rounded focus:outline-none focus:border-blue-400"></textarea>
                        @error('form.descricao') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>
            
                   @if($errors->has('form.titulo') || $errors->has('form.dateInicial') || $errors->has('form.dateFinal') || $errors->has('form.arquivo') || $errors->has('form.descricao'))
                   <button  class="w-full bg-blue-500 text-white py-2 px-2 rounded  opacity-50"  disabled>Enviar</button>
                   @else
                    <button  type="submit" wire:loading.attr="disabled" class="w-full bg-blue-500 text-white py-2 px-2 rounded hover:bg-blue-600 focus:outline-none focus:shadow-outline-blue" wire:target="CriarTarefa">
                <span wire:loading.remove wire:target="CriarTarefa">
                    Enviar
                </span>
                <span wire:loading wire:target="CriarTarefa">
                    <!-- Adicione classes de estilo para o spinner do Tailwind CSS aqui -->
                    <div class="flex justify-center items-center">
                    <div class="animate-spin rounded-full h-8 w-8 border-t-2 border-blue-500 border-r-2 border-b-2 border-l-4 "></div>
                </div>
                </span>
            </button>
            @endif
                </form>
            </x-slot>
      </x-modal-unitau>
      @endcan       

      
{{--  @can('update', $tarefa)  
      <h1>Criar Tarefa</h1>
@else
<div >

      <h1 class="font-bold text-3xl">Informações da Tarefa</h1>
        <h2>Título da tarefa</h2>
        <p>Descrição da tarefa</p>
        <a href="">Arquivo da tarefa</a>
        
     <input type="file" id="file" class="hidden">
     <label for="file" class="cursor-pointer" >Enviar Arquivo </label>

     <button type="submit">Enviar Tarefa</button>
   </div>  
@endcan  --}}
@foreach($equipe->tarefas as $tarefa)
    
   <div class="max-w-md mx-auto bg-white rounded-xl shadow-md overflow-hidden md:max-w-2xl m-5">
    <div class="p-8 flex">
        <div class="pr-4">
        <p class="text-4xl font-bold">{{ $tarefa->StartDate }}</p>
        <p class="text-4xl font-bold">{{ $tarefa->equipe->name }}</p>
        </div>
        <div>
          <a href="/equipe/{{$equipe->id}}/tarefas/{{$tarefa->id}}" wire:navigate>Ver Tarefa</a>
        </div>
    </div>
    </div>
    @endforeach
</div>


