<?php


namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;
use App\Models\User;
use Illuminate\Validation\Rule;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

class RoleList extends Component
{


    use WithPagination;

    public $name;
    public $isUpdateOperation = false;
    public $role_id;
    public $rec_per_pages = 5;
    protected $paginationTheme = 'bootstrap';
    public $search = '';

    protected $rules = [
            'name' => ['required', 'string', 'max:100'],
        ];




    public function render()
    {
        return view('livewire.role-list',[
            'roles' => Role::search('name',$this->search)->paginate($this->rec_per_pages)
        ]);
    }

    //CREATE PRODUCT
    public function storeRole(){

        if($this->isUpdateOperation){
            $data = $this->validate();
            $this->updateRole($data);
        }else{
            $data = $this->validate();
            $this->saveRole($data);
        }

    }

    public function saveRole($data){

        try {
            Role::create($data);
            $this->dispatchBrowserEvent('Swal', [
                'title' => 'Item has been Saved.',
                'icon'=>'success',
                'iconColor'=>'blue',
            ]);

            $this->dispatchBrowserEvent('closeModal', 'createRole'); //event name & model id
            $this->resetForm();
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

    public function editRole($id){
        $this->isUpdateOperation = true;
        $role = Role::findOrFail($id);
        $this->role_id = $role->id;
        $this->name = $role->name;

    }

    //UPDATE USER
    public function updateRole($data){
        try {


            Role::whereId($this->role_id)->update($data);

            $this->dispatchBrowserEvent('Swal', [
                'title' => 'User Updated.',
                'icon'=>'success',
                'iconColor'=>'green',
            ]);
            $this->dispatchBrowserEvent('closeModal', 'createRole');

            $this->resetForm();
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
    public function deleteRole($id){
        try {
            // User::delete($id);
            Role::where('id', $id)->first()->delete();
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

    public function resetForm(){
        $this->name = null;
    }
}
