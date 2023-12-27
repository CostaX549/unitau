 <?php



use Livewire\Volt\Component;

use Spatie\Image\Manipulations;
use App\Models\Equipe;
use Livewire\WithFileUploads;
new  class extends Component {
    use WithFileUploads;
    public $name = '';

    public $avatar = null;
    

    public $croppedImage = null;
  




  

   
    public function CriarEquipe(){
        

       
         

        
         
         if ($this->croppedImage) {
        $croppedPath = $this->salvarImagemCortada($this->croppedImage);
    } 
        


    

   

        
    

       
           
     



         $equipe = new Equipe;

$equipe->name = $this->name;
$equipe->owner_id = auth()->user()->id;

          $equipe->imagem = $croppedPath;
     
            $equipe->save();
            $equipe->users()->attach(auth()->user()->id);




          $this->reset();
           
            $this->dispatch('close-modal');
            $this->dispatch('equipe-salva');
       
    }


    private function salvarImagemCortada($base64Data)
{
    
    $data = explode(',', $base64Data);
    $imageData = base64_decode($data[1]);
    $croppedPath = 'uploads/' . uniqid() . '.png';
    file_put_contents(public_path($croppedPath), $imageData);

    return $croppedPath;
}

    
}; ?>


<div >
 

     <form wire:submit.prevent="CriarEquipe" class="flex flex-col">
        <label for="name">Nome</label>
        <input type="text" class="mb-3" wire:model = "name">
        
        @if($avatar)
            <div
                class="d-flex flex-column justify-content-center"
                wire:ignore
                x-data="{
                    setUp() {
                        const cropper = new Cropper(document.getElementById('avatar'), {
                            aspectRatio: 1/1,
                            autoCropArea: 1,
                            viewMode: 1,
                            crop(event) {
                                @this.set('croppedImage', cropper.getCroppedCanvas().toDataURL())
                            }
                        })
                    }
                }"
                x-init="setUp"
            >
                <div class="mb-2">
                    <img id="avatar" src="{{ $avatar->temporaryUrl() }}" style="width: 100%; max-width: 100%;">
                </div>
    
              
            </div>

            <button class="mt-5 rounded-sm bg-blue-600 p-3 text-white font-bold" type="submit"  wire:loading.attr="disabled" wire:target="CriarEquipe" >
                <div wire:loading wire:target="CriarEquipe">
                    <span class="loader" style=" border: 5px solid white;"></span>
                </div>
    
                <div wire:loading.remove  wire:target="CriarEquipe">
                 Criar Equipe
                </div>
               
              </button>
        
      @else  

      <input type="file" name="avatar" id="avatar"  wire:model="avatar">
      @endif
    </form>
    </div>
 

  
 





  

