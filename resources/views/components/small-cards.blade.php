{{-- BLADE COMPONENT THAT HOLDS MULTIPLE LIVEWIRE COMPONENTS --}}
@props(['total_users','total_products','total_permissions','total_roles'])
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="row">
            @livewire('small-card',['title' => "products",'icon' => 'fa-boxes-packing','total' => $total_products])   {{-- Product Card--}}
            @livewire('small-card',['title' => "users",'icon' => 'fa-users','total' => $total_users])   {{-- User Card--}}
            @livewire('small-card',['title' => "roles",'icon' => 'fa-shield','total' => $total_roles])   {{-- Role Card--}}
            @livewire('small-card',['title' => "permissions",'icon' => 'fa-key','total' => $total_permissions])   {{-- Permission Card--}}
        </div>
    </div>
</div>
