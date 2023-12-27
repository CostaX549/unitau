<?php

use Livewire\Volt\Component;
use App\Models\Equipe; 
use Livewire\Attributes\Validate; 
use Livewire\WithFileUploads;

new class extends Component {

    
    use WithFileUploads;
    public Equipe $equipe;

    #[Validate('required|string|max:255')]
  public string $name = '';
   #[Validate('nullable')]
  public $photo;


  public function mount(): void
    {
        $this->name = $this->equipe->name;
        $this->photo = $this->equipe->imagem;
     
 
    }

        public function update() {

            $this->authorize('update', $this->equipe);
           $this->validate();

 if($this->photo !== $this->equipe->imagem) {
    $realName = $this->photo->getClientOriginalName();


    $this->equipe->update([
             
             'imagem' => $this->photo->storeAs('uploads', $realName,'public'),
       ]);
 }

 if($this->name != $this->equipe->name) {
    $this->equipe->update([
             
             'name' => $this->name,
       ]);
 }

           

        $this->dispatch('equipe-updated');
        
    }

 



}; ?>

<div>
    <form wire:submit="update">

    

     
 
 
      
        <label for="teste" class="flex items-center justify-center mt-2 mb-2 relative cursor-pointer ">
            @if($photo !== $equipe->imagem)
            <img  class="rounded-lg w-[200px] h-[200px] border-4 border-blue-800 object-cover cursor-pointer " src="{{ $photo->temporaryUrl() }}" id="image-{{ $equipe->id }}" alt="" />
            @else 
            <img class="rounded-lg w-[200px] h-[200px] border-4 border-blue-800 object-cover" src="{{ asset('storage/' . $equipe->imagem) }}" id="image-{{ $equipe->id }}" alt="" />

            @endif
    
         
   


   
    </label>
    <input wire:model="photo" type="file" id="teste" class="hidden"  >


  
         
     <div class="p-5">
 
             <x-unitau-text wire:model.blur="name" name="name" class="mb-2 text-2xl font-bold tracking-tight text-gray-900 rounded-lg" value="{{ $name }}" />
            
      
         <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Here are the biggest enterprise technology acquisitions of 2021 so far, in reverse chronological order.</p>
         <x-unitau-button type="submit"  :disabled="$photo === $equipe->imagem && $name === $equipe->name" :inactive="$photo  === $equipe->imagem && $name === $equipe->name" wire:loading.attr="disabled" wire:loading.class="opacity-50" wire:target="update">
            <span wire:loading wire:target="update">
                {{ __('Editando...') }}
            </span>
            <span wire:loading.remove wire:target="update">
                {{ __('Editar') }}
            </span>
        </x-unitau-button>
  
              <x-unitau-button  x-on:click.prevent="$dispatch('equipe-edit-canceled')" >
                {{ __('Cancelar') }}
                 
              </x-unitau-buton>
       
         
     </div>
    </form>
    
</div>
