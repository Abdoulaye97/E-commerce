<div class="card card-primary">
<div class="card-header">
<h3 class="card-title">Inscription</h3>
</div>


<form method="post" role="form" wire:submit.prevent="AjouterUser()">
<div class="card-body">
<div class="form-group">
<label for="exampleInputPassword1">Prenom</label>
<input type="text" class="form-control" wire:model="prenom" id="exampleInputPassword1" placeholder="Prenom">
  @error("prenom")
         <span class="text-danger">{{ $message }}</span>
  @enderror
</div>
<div class="form-group">
<label for="exampleInputPassword1">Nom</label>
<input type="text" class="form-control" wire:model="nom" id="exampleInputPassword1" placeholder="Nom">
@error("nom")
         <span class="text-danger">{{ $message }}</span>
@enderror
</div>
<div class="form-group">
<label for="exampleInputPassword1">Telephone</label>
<input type="text" class="form-control" wire:model="telephone" id="exampleInputPassword1" placeholder="Telaphone">
@error("telephone")
         <span class="text-danger">{{ $message }}</span>
@enderror
</div>
<div class="form-group">
<label for="exampleInputPassword1">Adresse</label>
<input type="text" class="form-control" wire:model="adresses" id="exampleInputPassword1" placeholder="Adressse">
</div>
<div class="form-group">
@error("email")
         <span class="text-danger">{{ $message }}</span>
 @enderror
<label for="exampleInputEmail1">Email address</label>
<input type="email" class="form-control" wire:model="email" id="exampleInput" placeholder="Email">
</div>
<div class="form-group">
<label for="exampleInputPassword1">Password</label>
<input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
</div>
<div class="card-footer">
<button type="submit" class="btn btn-primary">Submit</button>
<button type="button" class="btn btn-danger"><a href="#" wire:click.prevent="back()">Retour</a> </button>
</div>
</form>
</div>
<script>                     
    window.addEventListener("showMessageSuccess", event=>{
        Swal.fire({
                position: 'top-end',
                icon: 'success',
                toast:true,
                title:event.detail.message,
                showConfirmButton: false,
                timer: 5000
                }
            )
    })
</script>