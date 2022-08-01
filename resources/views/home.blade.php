@extends('layouts.app')

@section('content')
<div class="container">
    <x-small-cards :total_users="$total_users"></x-small-cards>
    <x-users-list></x-users-list>
</div>
@endsection
