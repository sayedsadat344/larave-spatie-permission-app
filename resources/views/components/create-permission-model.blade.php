@props(['isUpdateOperation'])
<div>
    <div wire:ignore.self class="modal fade" id="createPermission" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="createPermissionLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createPermissionLabel">{{ $isUpdateOperation ? 'Edit Permission' : 'Add Permission' }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">


                    <form>
                        @csrf

                        <div class="row mb-3">
                            <label for="name"
                                class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text"
                                    class="form-control @error('name') is-invalid @enderror" name="name"
                                    wire:model="name" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="button" class="btn btn-primary" wire:click="storePermission">
                                    {{ $isUpdateOperation ? 'Update' : 'Save' }}
                                </button>
                            </div>
                        </div>
                        {{-- <button type="submit">good</button> --}}
                    </form>

                </div>

            </div>
        </div>
    </div>
</div>
