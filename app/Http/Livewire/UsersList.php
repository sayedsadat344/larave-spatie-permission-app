<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class UsersList extends Component
{

    public $users;

    public function render()
    {
        $this->users = User::all();

        return <<<'blade'
            <div>

                @if($this->users->count() > 0)
                <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>

                @foreach ($this->users as $user)
                    <tr>
                        <th scope="row">{{$loop->index + 1}}</th>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>@mdo</td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            @else
                <div class="alert alert-info" role="alert">
                    NO USER AVAILABLE
                </div>
            @endif
            </div>
        blade;
    }
}
