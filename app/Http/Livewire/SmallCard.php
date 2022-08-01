<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class SmallCard extends Component
{
    public $title;
    public $icon;
    public $total;




    public function render()
    {

        return <<<'blade'
                <div class="col-md-3">
                    <div class="small-cards card text-center shadow-lg rounded" style="background-color:rgb(20, 102, 134);">
                        <div class="card-body">
                          <h4 class="card-title fw-bold">{{ Str::ucfirst($title); }}</h4>

                          <span class="display-6 text-warning mt-1"><i class="fa-solid {{$icon}}"></i></span>

                          <hr>
                          <h3 class="">{{$total}}</h3>

                        </div>
                      </div>
                </div>
        blade;
    }
}
