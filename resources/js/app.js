import './bootstrap';
document.addEventListener('livewire:navigated', () => { 
    Livewire.on('equipe-salva', () => {
    Livewire.navigate('/home');
    });
  })