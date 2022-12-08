<div>
        <div class="row">
            <div class="col-12">
               <div class="card-header bg-primary">
                <h3 class="card-title"><i class="fas fa-users fa-2x"></i>Listes Des Utilisateurs</h3>
                <div class="card-tools d-flex align-items-center">
	        <a href="" class="btn btn-link text-white mr-4 d-block" wire:click.prevent="AddUser()"><i class="fas fa-user-plus"></i>Nouvel utilisateur</a>
		<div class="input-group input-group-md" style="width: 250px;">
		<input type="text" name="table_search"  class="form-control float-right"  placeholder="Search">
		<div class="input-group-append">
		<button type="submit" class="btn btn-default">
		<i class="fas fa-search"></i>
		</button>
		</div>
		</div>
		</div>
		</div>

		<div class="card-body table-responsive p-0 table-striped" style="height: 300px;">
		<table class="table table-head-fixed text-nowrap">
		<thead>

		<tr>
		<th style="width: 10%">FistName</th>
		<th style="width: 10%">LastName</th>	
		<th style="width: 15%">Role</th>
		<th style="width: 10%">telephone</th>
		<th style="width: 10%">Adresse</th>
		<th style="width:10%">Ajoute </th>
		<th class="text-center" style="width: 25%;">Action</th>
		</tr>
		</thead>
		<tbody>
		@foreach ($users as $user)
		<tr>
		<td>{{$user->prenom}}</td>
		<td>{{$user->nom}}</td>
		<td>{{$user->roles->implode('nom',"|")}}</td>
		<td>{{$user->telephone}}</td>
		<td>{{$user->adresse}}</td>
		<td>il y'a {{$user->created_at->diffForHumans()}}</td>
		<td class="text-center">
			<button class="btn btn-link" wire:click.prevent="goToEditUser({{$user->id}})"><i class="far fa-edit"></i></button>
			<button class="btn btn-link" wire:click.prevent="confirmDelete('{{$user->prenom}} {{$user->nom}}',{{$user->id}})"><i class="far fa-trash-alt"></i></button>

		</td>
		</tr>
		@endforeach
		</tbody>
		</table>
		</div>
		<div class="card-footer">
			<div class="float-right">
				{{$users->links()}}
			</div>
		</div>

		</div>
       </div>
       <script>
	 window.addEventListener("showconfirmMessage", event=>{
            Swal.fire({
            title:event.detail.message.title,
            text: event.detail.message.text,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#861717',
            confirmButtonText: 'Continuer',
            cancelButtonText:'Annuler'
            }).then((result) => {
            if (result.isConfirmed) {
              @this.DeleteUser(event.detail.message.data.user_id)
            }
    })
})
       </script>
</div>