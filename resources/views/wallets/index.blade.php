@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 mt-4">
                <div class="card">
                    <div class="card-header">{{ __('Create wallet') }}</div>
                    <div class="card-body">
                        <form action="{{route('wallets.store')}}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="name_input">Name</label>
                                <input type="text" id="name_input" class="form-control" name="name" value="{{old('name')}}">
                            </div>
                            <div class="form-group">
                                <label for="type_input">Type</label>
                                <input type="text" id="type_input" class="form-control" name="type" value="{{old('type')}}">
                            </div>
                            <button class="btn btn-outline-primary float-right mt-2">Create</button>
                        </form>
                        @include('partials.errors')
                    </div>
                </div>
            </div>
            <div class="col-12 mt-4">
                <h4>Wallets</h4>
                <table class="table table-bordered p-2">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Type</th>
                        <th scope="col">Report</th>
                        <th scope="col">Balance</th>
                        <th scope="col">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($wallets as $wallet)
                            <tr>
                                <th scope="row">{{$wallet->id}}</th>
                                <td>{{$wallet->name}}</td>
                                <td>{{$wallet->type}}</td>
                                <td><a href="{{route('wallets.show', $wallet->id)}}"><button class="btn btn-sm btn-outline-info">Show</button></a></td>
                                <td>{{$wallet->records->sum('amount')}}</td>
                                <td>
                                    <form action="{{route('wallets.destroy', $wallet->id)}}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button class="btn btn-sm btn-outline-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-4"><h4>Total: {{$total}}</h4></div>
            </div>
        </div>
    </div>
@endsection
