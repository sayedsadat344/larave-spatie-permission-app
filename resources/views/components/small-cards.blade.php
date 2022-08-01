{{-- BLADE COMPONENT THAT HOLDS MULTIPLE LIVEWIRE COMPONENTS --}}
@props(['total_users'])
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="row">
            @livewire('small-card',['title' => "products",'icon' => 'fa-boxes-packing','total' => $total_users])   {{-- Product Card--}}
            @livewire('small-card',['title' => "users",'icon' => 'fa-users','total' => 12])   {{-- User Card--}}
            @livewire('small-card',['title' => "roles",'icon' => 'fa-shield','total' => 15])   {{-- Role Card--}}
            @livewire('small-card',['title' => "permissions",'icon' => 'fa-key','total' => 20])   {{-- Permission Card--}}
        </div>
    </div>
</div>
