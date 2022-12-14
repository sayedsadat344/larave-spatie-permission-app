<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class UsersList extends Component
{

    use WithPagination;

    public $name,$password,$email,$password_confirmation;
    public $isUpdateOperation = false;
    public $user_id;
    public $rec_per_pages = 5;
    public $search = '';

    protected $paginationTheme = 'bootstrap';



    protected $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed']
        ];




    public function render()
    {
        return view('livewire.user-list',[
            'users' => User::search('name',$this->search)->paginate($this->rec_per_pages)
        ]);
    }

    //CREATE USER
    public function storeUser(){

        if($this->isUpdateOperation){

            $data = $this->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($this->user_id)],

            ]);


            $this->updateUser($data);
        }else{
            $data = $this->validate();
            $this->saveUser($data);
        }

    }

    public function saveUser($data){
        try {
            User::create($data);
            $this->dispatchBrowserEvent('Swal', [
                'title' => 'Item has been Saved.',
                'icon'=>'success',
                'iconColor'=>'blue',
            ]);

            $this->dispatchBrowserEvent('closeModal', 'createUser'); //event name & model id
        } catch (\Throwable $th) {

            $this->dispatchBrowserEvent('Swal', [
                'title' => 'Error occured!!.',
                'icon'=>'error',
                'iconColor'=>'red',
            ]);
            //throw $th;
            dd($th);
        }
    }

    public function editUser($id){
        $this->isUpdateOperation = true;
        $user = User::findOrFail($id);
        $this->user_id = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
    }

    //UPDATE USER
    public function updateUser($data){
        try {


            // $user = User::findOrFail($this->user_id)->first();
            // $user->name = $data['name'];
            // $user->email = $data['email'];

            // $user->update();

            User::whereId($this->user_id)->update($data);

            $this->dispatchBrowserEvent('Swal', [
                'title' => 'User Updated.',
                'icon'=>'success',
                'iconColor'=>'green',
            ]);
            $this->dispatchBrowserEvent('closeModal', 'createUser');
        } catch (\Throwable $th) {

            $this->dispatchBrowserEvent('Swal', [
                'title' => 'Error occured !!.',
                'icon'=>'error',
                'iconColor'=>'red',
            ]);
            //throw $th;
            dd($th);
        }
    }


    //DELETE USER
    public function deleteUser($id){
        try {
            // User::delete($id);
            User::where('id', $id)->first()->delete();
            $this->dispatchBrowserEvent('Swal', [
                'title' => 'Item has deleted.',
                'icon'=>'success',
                'iconColor'=>'green',
            ]);
        } catch (\Throwable $th) {
            //throw $th;
            dd($th);
        }
    }
}
