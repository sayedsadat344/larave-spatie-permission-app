<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Permission;

class PermissionList extends Component
{



    use WithPagination;

    public $name;
    public $isUpdateOperation = false;
    public $permission_id;
    public $rec_per_pages = 5;
    protected $paginationTheme = 'bootstrap';
    public $search = '';

    protected $rules = [
            'name' => ['required', 'string', 'max:100'],
        ];




    public function render()
    {
        return view('livewire.permission-list',[
            'permissions' => Permission::search('name',$this->search)->paginate($this->rec_per_pages)
        ]);
    }

    //CREATE PRODUCT
    public function storePermission(){

        if($this->isUpdateOperation){
            $data = $this->validate();
            $this->updatePermission($data);
        }else{
            $data = $this->validate();
            $this->savePermission($data);
        }

    }

    public function savePermission($data){

        try {
            Permission::create($data);
            $this->dispatchBrowserEvent('Swal', [
                'title' => 'Item has been Saved.',
                'icon'=>'success',
                'iconColor'=>'blue',
            ]);

            $this->dispatchBrowserEvent('closeModal', 'createPermission'); //event name & model id
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

    public function editPermission($id){
        $this->isUpdateOperation = true;
        $permission = Permission::findOrFail($id);
        $this->permission_id = $permission->id;
        $this->name = $permission->name;

    }

    //UPDATE USER
    public function updatePermission($data){
        try {


            Permission::whereId($this->permission_id)->update($data);

            $this->dispatchBrowserEvent('Swal', [
                'title' => 'User Updated.',
                'icon'=>'success',
                'iconColor'=>'green',
            ]);
            $this->dispatchBrowserEvent('closeModal', 'createPermission');

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
    public function deletePermission($id){
        try {
            // User::delete($id);
            Permission::where('id', $id)->first()->delete();
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
