<div class="col-md-12">

    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <div class="pt-1">
                Records Per Page
                <select class="form-select-sm mx-2" wire:model="rec_per_pages">

                    <option value="5">05</option>
                    <option value="10">10</option>
                    <option value="30">30</option>
                </select>
            </div>
            <div class="pt-2 px-0">
                <h4 class="fw-bold">PERMISSION LIST</h4>
            </div>
            <div>
                <input type="text" class="border border-secondary rounded p-2 w-80" wire:model="search" placeholder="Search permissions ..">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createPermission"><i
                        class="fa-solid fa-user-plus"></i></button>
            </div>
        </div>

        <div class="card-body">

            @if ($permissions->count() > 0)
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>

                            <th scope="col">Date</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($permissions as $permission)
                            <tr>
                                <th scope="row">{{ $loop->index + 1 }}</th>
                                <td>{{ $permission->name }}</td>

                                <td>{{ $permission->created_at->diffForHumans() }}</td>
                                <td>

                                    <button type="button" class="btn btn-danger btn-sm"
                                        wire:click="deletePermission({{ $permission->id }})"><i
                                            class="fa-solid fa-trash"></i></button>
                                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#createPermission" wire:click="editPermission({{ $permission->id }})"><i
                                            class="fa-solid fa-edit"></i></button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="alert alert-info" role="alert">
                    NO PERMISSION AVAILABLE
                </div>
            @endif
            <x-create-permission-model :isUpdateOperation="$isUpdateOperation"></x-create-permission-model>

            {{ $permissions->links('vendor.livewire.bootstrap') }}
        </div>
    </div>
</div>
