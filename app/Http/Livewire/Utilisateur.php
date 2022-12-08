<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use App\Models\Role;
use App\Models\User;
use Livewire\Component;
use App\Models\Permission;
use Livewire\WithPagination;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class Utilisateur extends Component
{
    use WithPagination;
    protected $paginationTheme = "bootstrap";
    public $current_page = PAGELIST;
    public $prenom;
    public $nom;
    public $password="password";
    public $adresse;
    public $email;
    public $telephone;
    public $edituser= [];
    public $rolePermission = [];
    public function render()
    {
        Carbon::setLocale("fr");
        return view('livewire.utilisateur.index',[
            'users'=>User::latest()->paginate(5),
            'roles'=>Role::all(),
        ])
        ->extends('layouts.master')
        ->section('contenu');
    }
    protected $message=[
       'prenom.required' => 'Le prenom est obligatoire.',
        'email.required' => 'Email est obligatoire.',
        'prenom.min'=>'Votre Prenom doit superieur a 6 caracteres.',
        'nom.required'=>'Le nom est obligatoire .',
        'telephone.required'=>'Numero de telephone est obliagatoire.',
        'email.unique' =>'Cette adresse email existe deja.',
        'telephone.unique' =>'Numero telephone existe deja.',
        'edituser.prenom.required' => 'Le prenom est obligqtoire.',
        'edituser.email.required' => 'Email est obligatoire.',
        'edituser.prenom.min'=>'Votre Prenom doit superieur a 6 caracteres.',
        'edituser.nom.required'=>'Le nom est obligatoire.',
        'edituser.email.unique' => 'Cette adresse email existe deja.',
        'edituser.telephone.unique' =>'Numero telephone existe deja.',
        'edituser.email.unique' =>'Cette adresse email existe deja.',
        'edituser.telephone.unique' =>'Numero telephone existe deja.', 
    ];
    public function AddUser()
    {
        $this->current_page=PAGECREATE;
    }
    public function confirmDelete($prenom,$id)
    {
        $this->dispatchBrowserEvent('showconfirmMessage',['message'=>[
        "text"=>"Vous etes sur le point de supprimer $prenom de la liste des utilisateurs",
        "title"=>"Etes-vous sur de Continuer ?",
        "data"=>[
            "user_id"=>$id
        ]]
    ]);
    }
    public function DeleteUser($id)
    {
        User::destroy($id);
    }
    public function rules()
    {
        if($this->current_page===PAGEEDIT)
        {
        return [
        'edituser.prenom' => 'required|min:6',
        'edituser.nom' => 'required|min:4',
        'edituser.email' => ['required',Rule::unique("users","email")->ignore($this->edituser['id'])],
        'edituser.telephone'=>['required',Rule::unique("users","telephone")->ignore($this->edituser['id'])],
        ];
        }
       return [
        'prenom' => 'required|min:6',
        'nom' => 'required|min:4',
        'email' => 'required|email|unique:users,email',
        'telephone'=>'required|numeric|unique:users,telephone'
       ];
      
    }
    
    //cette fonction permet de controler l'email de telephone a temps reel
     public function UpdatedEmail()
    {
        $this->validate(['email'=>'unique:users']);
    }
    //cette fonction permet de controler le numero de telephone a temps reel
    public function Updatedtelephone()
    {
        $this->validate(['telephone'=>'unique:users']);
    }
    public function AjouterUser()
    {
        $this->validate();
        User::create([
            'prenom'=>$this->prenom,
            'nom'=>$this->nom,
            'email'=>$this->email,
            'adresse'=>$this->adresse,
            'telephone'=>$this->telephone,
            'password'=>Hash::make($this->password)
        ]);

        $this->dispatchBrowserEvent('ShowMessageSuccess',['message'=>'Utilisateur ajouter avec success']);
    }
    public function back()
    {
        $this->current_page=PAGELIST;
    }
    public function goToEditUser($id)
    {
        $this->edituser = User::find($id)->toArray();
        $this->populateRolePermission();
        $this->current_page=PAGEEDIT;
    }
     //modifier un itulisateur
    public function EditUser()
    {
        $validationAttributes = $this->validate();
        //dump($validationAttributes);
        User::find($this->edituser['id'])->update($validationAttributes["edituser"]);

        $this->dispatchBrowserEvent("showSuccessMessage", ["message"=>"Utilisateur mis à jour avec succès!"]);
    }

    public function ResetPwd()
    {
        $this->dispatchBrowserEvent('ShowResetMessage',['message'=>'Vous etes sur le point de Reinitialiser le mot de pass.']);
    }
    public function confirmResetPwd()
    {
     User::find($this->edituser['id'])->update(['password'=>Hash::make($this->password)]);
     $this->dispatchBrowserEvent('showResetSuccess',['message'=>"Mot de pass reinitialiser avec success"]);
    }
    ////////////////////////////////
     public function populateRolePermission()
    {
        $this->rolePermission["roles"]= [];
        $this->rolePermission["permissions"]= [];
        //cette fonction est une callback qui renvoie les l'id des roles recuperer
        $mapforCb = function($value)
        {
            return $value["id"];
        };
        $rolesId = array_map($mapforCb, User::find($this->edituser["id"])->roles->toArray());
        //dump($rolesId);
        $permissionsId = array_map($mapforCb, User::find($this->edituser["id"])->permissions->toArray());//on recuperer les roles l'id des roles de l'itulisateur
       
        foreach(Role::all() as $role)
        {
            if(in_array($role->id,$rolesId))
            {
               array_push($this->rolePermission["roles"],["role_id" => $role->id,"role_nom"=>$role->nom,"active"=>true]);
            } 
            else{
                array_push($this->rolePermission["roles"],["role_id" => $role->id,"role_nom"=>$role->nom,"active"=>false]);
            }
        }

        foreach(Permission::all() as $permission)
        {
            if(in_array($permission->id,$permissionsId))
            {
                array_push($this->rolePermission["permissions"],["permission_id"=>$permission->id,"permission_nom"=>$permission->nom,"active"=>true]);
            }
            else{
               array_push($this->rolePermission["permissions"],["permission_id"=>$permission->id,"permission_nom"=>$permission->nom,"active"=>false]);
            }

        }
          
        //la logique pour charger les roles et les permissions
    }
    //donner des roles et des permissions
    public function updateRoleAndPermissions()
    {
        //on supprime d'abord les roles de l'itulisateur avant de faire la mise a jour
        DB::table("users_roles")->where("user_id", $this->edituser["id"])->delete();
          //on supprime d'abord les permissions de l'itulisateur avant de faire la mise a jour
        DB::table("users_permissions")->where("user_id", $this->edituser["id"])->delete();
        
        //on boucle sur les roles pour faire une nouvelle insertions
        foreach($this->rolePermission["roles"] as $role){
            if($role["active"]){
                User::find($this->edituser["id"])->roles()->attach($role["role_id"]);
            }
        }

        foreach($this->rolePermission["permissions"] as $permission){
            if($permission["active"]){
                User::find($this->edituser["id"])->permissions()->attach($permission["permission_id"]);
            }
        }

        $this->dispatchBrowserEvent("showRoleMessage", ["message"=>"Roles et permissions mis à jour avec succès!"]);
    }
}

