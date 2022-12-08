<div>
    @if ($current_page == PAGELIST)
        @include('livewire.utilisateur.listes')
    @endif
    @if ($current_page == PAGECREATE)
        @include('livewire.utilisateur.editer')
    @endif
    @if ($current_page === PAGEEDIT)
        @include('livewire.utilisateur.update')    
    @endif
</div>
