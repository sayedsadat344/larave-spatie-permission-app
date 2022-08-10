<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;
use App\Models\User;
use Illuminate\Validation\Rule;
use Livewire\WithPagination;

class ProductList extends Component
{


    use WithPagination;

    public $name;
    public $isUpdateOperation = false;
    public $product_id;
    public $rec_per_pages = 5;
    protected $paginationTheme = 'bootstrap';
    public $search = '';

    protected $rules = [
            'name' => ['required', 'string', 'max:255'],
        ];




    public function render()
    {
        return view('livewire.product-list',[
            'products' => Product::search('name',$this->search)->paginate($this->rec_per_pages)
        ]);
    }

    //CREATE PRODUCT
    public function storeProduct(){

        if($this->isUpdateOperation){

            $data = $this->validate();
            $this->updateProduct($data);
        }else{
            $data = $this->validate();
            $this->saveProduct($data);
        }

    }

    public function saveProduct($data){
        try {
            Product::create($data);
            $this->dispatchBrowserEvent('Swal', [
                'title' => 'Item has been Saved.',
                'icon'=>'success',
                'iconColor'=>'blue',
            ]);

            $this->dispatchBrowserEvent('closeModal', 'createProduct'); //event name & model id
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

    public function editProduct($id){
        $this->isUpdateOperation = true;
        $product = Product::findOrFail($id);
        $this->product_id = $product->id;
        $this->name = $product->name;

    }

    //UPDATE USER
    public function updateProduct($data){
        try {


            Product::whereId($this->product_id)->update($data);

            $this->dispatchBrowserEvent('Swal', [
                'title' => 'User Updated.',
                'icon'=>'success',
                'iconColor'=>'green',
            ]);
            $this->dispatchBrowserEvent('closeModal', 'createProduct');

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
    public function deleteProduct($id){
        try {
            // User::delete($id);
            Product::where('id', $id)->first()->delete();
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
