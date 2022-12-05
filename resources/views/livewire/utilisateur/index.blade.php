<div class="">
    @if ($current_page == PAGELIST)
        @include('livewire.utilisateur.listes')
    @endif
    @if ($current_page == PAGECREATE)
        @include('livewire.utilisateur.editer')
    @endif
</div>
