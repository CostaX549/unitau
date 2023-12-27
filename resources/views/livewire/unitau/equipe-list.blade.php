<?php

use Livewire\Volt\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Attributes\Computed;
use App\Models\Equipe;

new  class extends Component {
      
     #[Url]
public $search = '';



public ?Equipe $editing = null; 

     
     

           
   


 #[On("equipe-salva")]
   public function with(): array {

    return [
      'equipes' => auth()->user()->teams()->where('name', 'like', '%'.$this->search.'%')->latest()->get(),
   ];

   }

 
   public function edit(Equipe $equipe): void
    {
        $this->editing = $equipe;
 
    } 
  
 
   #[On('equipe-edit-canceled')]
    #[On('equipe-updated')] 
    
    public function disableEditing()
    {
   $this->editing = null;
 
 
    } 



}; ?>
<div >
  <div class= " flex items-end pt-5">
    <input class="ml-auto mr-5 "  wire:model.live="search"  type="text" placeholder="Buscar">

</div>  
  

<div class="flex mb-3  ml-24 gap-5 justify-center  flex-wrap ">
    
 
    @forelse($equipes as $equipe)
   
    <div class="max-w-sm bg-white border border-gray-200  rounded-lg  mt-5 " wire:key="equipe-{{ $equipe->id }}">
      @if($equipe->is($editing))
    
      <livewire:unitau.equipes-edit :equipe="$equipe" :key="$equipe->id" />
  
      @else
       <div class="flex items-center justify-center mt-2 mb-2">
          <img class="rounded-lg w-[200px] h-[200px] border-4 border-blue-800 object-cover" src="{{ asset('storage/' . $equipe->imagem) }}" alt="" />
      </div>
      
    
       <div class="p-5">
       <div class="flex justify-between">
               <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">{{ $equipe->name }}</h5>
               @if($equipe->owner->is(auth()->user()))
               <div  wire:click="edit({{ $equipe->id }})" class="rounded-full p-2 hover:bg-gray-100 cursor-pointer">
               <svg  xmlns="http://www.w3.org/2000/svg"  width="24" height="24" viewBox="0 0 24 24" class="cursor-pointer"><path fill="#00688B" d="m19.3 8.925l-4.25-4.2l1.4-1.4q.575-.575 1.413-.575t1.412.575l1.4 1.4q.575.575.6 1.388t-.55 1.387L19.3 8.925ZM17.85 10.4L7.25 21H3v-4.25l10.6-10.6l4.25 4.25Z"/></svg>
               </div>
               @endif
            </div> 
           <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Here are the biggest enterprise technology acquisitions of 2021 so far, in reverse chronological order.</p>
           <a href="/equipe/{{ $equipe->id }}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" wire:navigate>
             View
                <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                   <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
               </svg>
            </a>
       </div>
       @endif
    </div>

    @empty
    <h1 class="text-xl font-bold">Nenhuma equipe encontrada.</h1>
    @endforelse

</div>


</div>
