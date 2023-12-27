
@use('App\Models\Equipe')
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $title ?? 'Unitau' }}</title>

       
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
        
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
    </head>
    <body>
     
       
            <livewire:layout.unitau-navigation />
       

          
            <main  class="flex " >
                
        
            @php 
          
              $equipe = Equipe::findOrFail(request()->route('id'));
          
            @endphp
            
             @livewire('layout.equipe-navigation', ['equipe' => $equipe])
         
                {{ $slot }}
            </main>
            <!-- Page Content -->
          
 
  
    
        <script  src="https://npmcdn.com/flatpickr/dist/flatpickr.min.js"></script>
        <script  src="https://npmcdn.com/flatpickr/dist/l10n/pt.js"></script>
    </body>
</html>
