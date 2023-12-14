<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use App\Models\Equipe;
use Livewire\WithFileUploads;
new #[Layout('layouts.app')] class extends Component {

}; ?>

<div >
  <x-modal-unitau name="1" title="Criar Equipe">
    <x-slot:body>
   <livewire:unitau.create-equipe />
    </x-slot>
 </x-modal-unitau>
 <x-modal-unitau name="2" title="Encontrar uma Equipe">
    <x-slot:body>
      
        <input type="text" wire:model = "search">
        <button type="submit">Buscar</button>
    </x-slot>
 </x-modal-unitau>
  <div class="flex justify-between">
   <h1>Encontrar ou entrar em uma equipe</h1>
   <input type="text" placeholder="Buscar">
</div>
  <div class="flex gap-4 ">
   <section class="bg-white p-5">
          <button x-data x-on:click="$dispatch('open-modal', { name: '1' })" >Criar uma Equipe</button>
   </section>
   <section class="bg-white p-5">
       <button x-data x-on:click="$dispatch('open-modal', { name: '2' })">Entrar em uma Equipe</button>
   </section>
</div>  
</div>
