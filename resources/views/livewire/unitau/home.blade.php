<?php

use Livewire\Volt\Component;
use App\Models\Equipe;

use App\View\Components\UnitauText;
use Livewire\Attributes\{Title, On, Layout};


new 
#[Title('Home')] 
#[Layout('components.layouts.teams')] 
class extends Component {
     public $codigo;
 

     

     public function EntrarEquipe(){

   sleep(2);
    $equipe = Equipe::where("code", $this->codigo)->first();

    if (!$equipe) {
        return session()->flash('erro', 'Código de equipe inválido. Verifique e tente novamente.');
    }


    if ($equipe->users()->where('user_id', auth()->user()->id)->exists()) {
        return session()->flash('erro', 'Você já está na equipe.');
    }
    

    $equipe->users()->attach(auth()->user()->id);

 

    $this->redirect("equipe/{$equipe->id}", navigate: true); 
}
  

     
 
}; ?>

<div  >
 

  <x-modal-unitau name="1" title="Criar Equipe">
    <x-slot:body>
   <livewire:unitau.create-equipe-dois  />
    </x-slot>
 </x-modal-unitau>  


 <x-modal-unitau name="2" title="Encontrar uma Equipe">
    <x-slot:body>
    @session('erro')
           <p>{{ $value }}</p>
    @endsession     
      
         <svg xmlns="http://www.w3.org/2000/svg"  class="mx-auto w-[250px]" viewBox="0 0 24 24"><path fill="#2b6cb0" d="M14.754 10c.966 0 1.75.784 1.75 1.75v4.749a4.501 4.501 0 0 1-9.002 0V11.75c0-.966.783-1.75 1.75-1.75zm-7.623 0a2.72 2.72 0 0 0-.62 1.53l-.01.22v4.749c0 .847.192 1.649.534 2.365A4.001 4.001 0 0 1 2 14.999V11.75a1.75 1.75 0 0 1 1.606-1.744L3.75 10zm9.744 0h3.375c.966 0 1.75.784 1.75 1.75V15a4 4 0 0 1-5.03 3.866c.3-.628.484-1.32.525-2.052l.009-.315V11.75c0-.665-.236-1.275-.63-1.75M12 3a3 3 0 1 1 0 6a3 3 0 0 1 0-6m6.5 1a2.5 2.5 0 1 1 0 5a2.5 2.5 0 0 1 0-5m-13 0a2.5 2.5 0 1 1 0 5a2.5 2.5 0 0 1 0-5"/></svg>
       
        <form wire:submit = "EntrarEquipe" >
       <label  class="font-bold text-[18px]">Insira o código da equipe</label>
       <div class="flex items-center">
        
         <x-unitau-text name="codigo" wire:model="codigo" class="w-full mt-1  relative" />
         <button wire:loading.attr="disabled" wire:loading.class="opacity-50" type="submit" class="bg-blue-800 hover:bg-blue-500  rounded-lg z-10 p-2 m-2">
            <span class="loader" style=" border: 5px solid white;" wire:loading></span>
         <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" wire:loading.remove>
            <path fill="#FFFFFF" d="m12 4l-1.41 1.41L16.17 11H4v2h12.17l-5.58 5.59L12 20l8-8z"/>
        </svg>
        
      </button>
     </div>
      
  

  
        </form>
    
    </x-slot>
 </x-modal-unitau>
 <div x-data="{ visible: false }" x-on:click.away="visible = false">
  <div   x-show="visible" class="ml-24" style="position: fixed; bottom: 90px; right: 50px;">
 
   <h1>Encontrar ou entrar em uma equipe</h1>
 


  <div class="flex gap-5 ">
    <section class="bg-white p-5">


         <button x-data x-on:click="$dispatch('open-modal', { name: '1'})" >Criar uma Equipe</button>

   
      
    </section>
    <section class="bg-white p-5">
      <button x-data x-on:click="$dispatch('open-modal', { name: '2' })">Entrar em uma Equipe</button>
    </section>
  </div>

</div>   

<div style="position: fixed; bottom: 20px; right: 20px;">
  <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-4 px-4 rounded-full"  x-on:click="visible = !visible">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-6 w-6">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
      </svg>
  </button>
</div>
</div>
<livewire:unitau.equipe-list   />




</div>