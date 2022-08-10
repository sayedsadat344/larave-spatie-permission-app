@extends('layouts.app')

@section('content')
<div class="container">
   <x-small-cards
        :total_users="$total_users"
        :total_products="$total_products"
        :total_roles="$total_roles"
        :total_permissions="$total_permissions"
        ></x-small-cards> {{--  THE COUNT CARDS --}}
   <x-product-list></x-product-list> {{--  THE PRODUCT LIST CARD --}}
    <x-users-list></x-users-list> {{--  THE USER LIST CARD --}}
    <x-role-list></x-role-list> {{--  THE USER ROLES CARD --}}
    <x-permission-list></x-permission-list> {{--  THE USER ROLES CARD --}}









</div>
@endsection
