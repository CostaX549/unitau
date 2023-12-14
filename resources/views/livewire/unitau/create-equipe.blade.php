<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use App\Models\Equipe;
use Livewire\WithFileUploads;
new #[Layout('layouts.app')] class extends Component {
    public $name = '';
    public $imagem = null;

    use WithFileUploads;
    public function CriarEquipe(){
           $equipe = new Equipe;

           $equipe->name = $this->name;
           $equipe->owner_id = auth()->user()->id;
           $imagePath = $this->imagem->store('uploads', 'public');
           $equipe->imagem = $imagePath;
            $equipe->save();
            $this->name  = '';
            $this->imagem= null;
            $this->dispatch('close-modal');
    }
}; ?>


<div>
    <form wire:submit.prevent="CriarEquipe" class="flex flex-col" >
        <label for="">Nome</label>
          <input type="text" wire:model = "name">
          <label for="file">Enviar arquivo</label>
          <input type="file" class="hidden" id="file" wire:model="imagem" >
          <button type="submit">Criar Equipe</button>
     </form>
</div>
