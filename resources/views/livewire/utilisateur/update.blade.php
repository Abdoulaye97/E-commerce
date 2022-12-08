<div class="row">
<div class="col-md-6">
<div class="card card-primary">
<div class="card-header">
<h3 class="card-title">Modifier</h3>
</div>
<form method="post" role="form" wire:submit.prevent="EditUser()">
<div class="card-body">
<div class="form-group">
<label for="exampleInputPassword1">Prenom</label>
<input type="text" class="form-control" wire:model.lazy="edituser.prenom" id="exampleInputPassword1" placeholder="Prenom">
  @error("prenom")
         <span class="text-danger">{{ $message }}</span>
  @enderror
</div>
<div class="form-group">
<label for="exampleInputPassword1">Nom</label>
<input type="text" class="form-control" wire:model.lazy="edituser.nom" id="exampleInputPassword1" placeholder="Nom">
@error("nom")
         <span class="text-danger">{{ $message }}</span>
@enderror
</div>
<div class="form-group">
<label for="exampleInputPassword1">Telephone</label>
<input type="text" class="form-control" wire:model.lazy="edituser.telephone" id="exampleInputPassword1" placeholder="Telaphone">
@error("telephone")
         <span class="text-danger">{{ $message }}</span>
@enderror
</div>
<div class="form-group">
<label for="exampleInputPassword1">Adresse</label>
<input type="text" class="form-control" wire:model.lazy="edituser.adresse" id="exampleInputPassword1" placeholder="Adressse">
@error('adresse')
	<span class="text-danger">{{$message}}</span>
@enderror
</div>
<div class="form-group">
<label for="exampleInputEmail1">Email address</label>
<input type="email" class="form-control" wire:model.lazy="edituser.email" id="exampleInput" placeholder="Email">
@error("email")
         <span class="text-danger">{{ $message }}</span>
 @enderror
</div>
<div class="card-footer">
<button type="submit" class="btn btn-primary">Submit</button>
<button type="button" class="btn btn-danger"><a href="#" wire:click.prevent="back()">Retour</a> </button>
</div>
</form>
</div>
</div>
  <div class="col-md-6">
        <div class="row ">
            <div class="col-md-12">
                <div class="card card-primary" style="width:500px">
                    <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-key fa-2x"></i> Réinitialisation de mot de passe</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <ul>
                            <li>
                                <a href="#" class="btn btn-link" wire:click.prevent="ResetPwd()">Réinitialiser le mot de passe</a>
                                <span>(par défaut: "password") </span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
              <div class="col-md-12 mt-4">
                <div class="card card-primary" style="width:500px">
                    <div class="card-header d-flex align-items-center">
                    <h3 class="card-title flex-grow-1"><i class="fas fa-fingerprint fa-2x"></i> Roles & permissions</h3>
                    <button class="btn bg-gradient-success" wire:click.prevent="updateRoleAndPermissions()"><i class="fas fa-check"></i> Appliquer les modifications</button>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body" style="width:400px;">
                            <div id="accordion">
                                      @foreach($rolePermission["roles"] as $role)
                                    <div class="card">
                                        <div class="card-header d-flex justify-content-between">
                                            <h4 class="card-title flex-grow-1">
                                            <a  data-parent="#accordion" href="#"  aria-expanded="true">
                                               {{$role["role_nom"]}}  
                                            </a>
                                            </h4>
                                            <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">

                                                <input type="checkbox" class="custom-control-input" wire:model.lazy="rolePermission.roles.{{$loop->index}}.active" 
                                                    @if($role["active"]) checked @endif 
                                                    id="customSwitch{{$role['role_id']}}"> 
                                                <label class="custom-control-label" for="customSwitch{{$role['role_id']}}"> {{ $role["active"]? "Activé" : "Desactivé" }}</label>
                                            </div>
                                        </div>
                                    </div> 
                                     @endforeach  
                                    
                             </div>
                    </div>

                    <div class="p-3">
                        <table class="table table-bordered">
                            <thead>
                                <th>Permissions</th>
                                <th></th>
                            </thead>
                            <tbody>  
                                 @foreach($rolePermission["permissions"] as $permission) 
                                 <tr>
                                    { <td>{{ $permission["permission_nom"] }}</td> }
                                    <td>
                                         <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success"> 

                                                 <input type="checkbox" class="custom-control-input"
                                                     @if($permission["active"]) checked @endif 
                                                     wire:model.lazy="rolePermission.permissions.{{$loop->index}}.active" 
                                                     id="customSwitchPermission{{$permission['permission_id']}}"> 
                                                 <label class="custom-control-label" for="customSwitchPermission{{$permission['permission_id']}}"> {{ $permission["active"]? "Activé" : "Desactivé" }}</label> 
                                             </div>
                                    </td>
                                </tr>  
                                 @endforeach 
                             </tbody>

                        </table> 
                    </div> 
                </div>
             </div> 
        </div> 
 </div>  
<script>                     
    window.addEventListener("showSuccessMessage", event=>{
        Swal.fire({
                position: 'top-end',
                icon: 'success',
                toast:true,
                title:event.detail.message,
                showConfirmButton: false,
                timer: 5000
                
	})
	})
</script>
<script>
    window.addEventListener("ShowResetMessage", event=>{
            Swal.fire({
            title:'Voulez-vous continuez ?',
            text: event.detail.message,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#861717',
            confirmButtonText: 'Continuer',
            cancelButtonText:'Annuler'
	    }).then((result) => {
            if (result.isConfirmed) {
              @this.confirmResetPwd()
            
	    }
	})
	})
</script>
<script>
 window.addEventListener("showResetSuccess", event=>{
        Swal.fire({
                position: 'top-end',
                icon: 'success',
                toast:true,
                title:event.detail.message,
                showConfirmButton: false,
                timer: 5000
                
	})
    })
</script>	
<script>
	window.addEventListener("showRoleMessage", event=>{
        Swal.fire({
                position: 'top-end',
                icon: 'success',
                toast:true,
                title:event.detail.message,
                showConfirmButton: false,
                timer: 5000
                
	})
    })
	

</script>
</div>