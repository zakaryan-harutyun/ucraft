@extends('layouts.app')

@section('content')
<div class="container">
    <div class="jumbotron">
        <h1 class="display-4">Welcome {{Auth::user()->name}}!</h1>
        <hr class="my-4">
        @if($wallet_count == 0)
            <h5>Please create a <a href="{{route('wallets.index')}}">wallet</a></h5>
        @else
            <h5>Lets continue creating records <a href="{{route('records.index')}}">here</a></h5>
        @endif
    </div>
</div>
@endsection
