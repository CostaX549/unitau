<?php

use Livewire\Volt\Component;
use Livewire\WithFileUploads;
use Imagine\Image\Box;
use Imagine\Image\Point;
use Illuminate\Support\Str;
use App\Models\Equipe;
use Livewire\Attributes\Validate;




new 

class extends Component {

    use WithFileUploads;

    
   #[Validate('required|mimes:jpeg,jpg,png,gif')]
    public $imagem;

    #[Validate('required|min:3')]
public $name;
 #[Validate('required')]
public $code;



public $x;
public $y;
public $width;
public $height;




public function mount() {
    $this->code = Str::random(8);
    $this->validate();
}





public function save()
    {
    
       
       $this->validate();
       $imagemSalva = $this->imagem->store('uploads','public'); 
           
            $imagemPath = storage_path("app/public/{$imagemSalva}"); 

            $imagine = new \Imagine\Gd\Imagine();

            $image = $imagine->open($imagemPath);


            $adjustedX = (int) round($this->x);
            $adjustedY = (int) round($this->y);
            $adjustedWidth = (int) round($this->width);
            $adjustedHeight = (int) round($this->height);
 
     
          $croppedImage = $image->crop(new Point($adjustedX, $adjustedY), new Box($adjustedWidth, $adjustedHeight));


$croppedImage->save($imagemPath);

      
     

    $equipe =  auth()->user()->equipes()->create([
        'name' => $this->name,
        'imagem' => $imagemSalva,
        'code' => $this->code,

    ]);
      
     
 
      

  
  $equipe->users()->attach(auth()->user()->id);

   
  
    $this->dispatch('close-modal');
    $this->dispatch('equipe-salva');
    $this->reset();
    $this->validate();

          
        
    }

    public function limpar() {
        $this->reset();
    }


}; ?>
<div   x-data="{
    cropper: null,
    setUp() {
        this.cropper = new Cropper(document.getElementById('avatar'), {
            aspectRatio: 1/1,
            autoCropArea: 1,
            viewMode: 1,
            background: false,
          
           
        })
    },

  
}">
  
<form wire:submit="save">
    <label for="name">Nome</label>
    <x-unitau-text name="name" wire:model.blur="name" class="w-full mb-3  relative" />
  

  

    @if($imagem && !$errors->has('imagem'))
        <div
            class="d-flex flex-column justify-content-center"
            wire:ignore
      
            x-init="setUp"
        >
            <div class="mb-2">
                <img id="avatar" src="{{ $imagem->temporaryUrl() }}" class="w-full">
            </div>

       
    
         
        </div>
      
     






    @endif
    <div class="mb-6 pt-4">
        <label class="mb-5 block text-xl font-semibold text-[#07074D]">
          Enviar Imagem
        </label>

        <div class="mb-8">
            @if($imagem)
            @error('imagem') <span class="text-red-600">{{ $message }}</span>    @enderror
            @endif
          <input type="file" wire:model.blur="imagem" id="file" class="sr-only" x-on:change="$wire.imagem = ''" />
       
          <label
            for="file"
            class=" cursor-pointer relative flex min-h-[200px] items-center justify-center rounded-md border border-dashed border-[#e0e0e0] p-12 text-center"
          >
         
             @if(!$imagem)
             <span
             class="hover:bg-gray-100 inline-flex rounded border border-[#e0e0e0] py-2 px-7 text-base font-medium text-[#07074D]"
           >
            Enviar
           </span>

             @else
             <span
             class="hover:bg-gray-100 inline-flex rounded border border-[#e0e0e0] py-2 px-7 text-base font-medium text-[#07074D]"
           >
           Mudar Imagem
        </span>
             @endif
            


        
          </label>
        </div>
    </div>
    <button  @if($errors->any()) class="mt-5 rounded-sm bg-blue-600 p-3 text-white font-bold w-full opacity-50"  disabled @else x-data="{
        cropImage() {
            @this.set('x', this.cropper.getData().x);
            @this.set('y', this.cropper.getData().y);
            @this.set('width', this.cropper.getData().width);
            @this.set('height', this.cropper.getData().height);
        }
    }" x-on:click="cropImage" class="mt-5 rounded-sm bg-blue-600 p-3 text-white font-bold w-full" type="submit"  wire:loading.attr="disabled"  wire:loading.class="opacity-50" wire:target="save" @endif  >
    

        <div>
         Criar Equipe
        </div>
       
      </button>
     
      <button    @if($imagem || $name)  class="mt-5 rounded-sm bg-blue-600 p-3 text-white font-bold w-full" wire:click="limpar"  @else  class="mt-5 rounded-sm bg-blue-600 p-3 text-white font-bold w-full opacity-50"  disabled @endif >Limpar Tudo</button>
   
</form>
</div>

