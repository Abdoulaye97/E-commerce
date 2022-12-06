<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Validation\Rule;

class Utilisateur extends Component
{
    use WithPagination;
    protected $paginationTheme = "bootstrap";
    public $current_page = PAGELIST;
    public $prenom;
    public $nom;
    public $sexe;
    public $password="password";
    public $adresse;
    public $email;
    public $telephone;
    public $edituser= [];
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
        'edituser.email.unique' =>'Cette adresse email existe deja.',
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
            'sexe'=>$this->sexe,
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
}
