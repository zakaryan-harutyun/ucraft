@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 mt-4">
                <div class="card">
                    <div class="card-header">{{ __('Create record') }}</div>
                    <div class="card-body">
                        <form action="{{route('records.store')}}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="wallet_input">Wallet</label>
                                <select class="form-control"  name="wallet_id" id="wallet_input">
                                    @foreach($wallets as $wallet)
                                        <option {{old('wallet_id') == $wallet->id ? 'selected' : ''}} value="{{$wallet->id}}">{{$wallet->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="type_input">Type</label>
                                <select class="form-control"  name="type" id="type_input">
                                    <option {{old('type') == "Debit" ? 'selected' : ''}} value="Debit">Debit</option>
                                    <option {{old('type') == "Credit" ? 'selected' : ''}} value="Credit">Credit</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="type_input">Amount</label>
                                <input class="form-control" type="number" name="amount" min="1" value="{{old('amount')}}">
                            </div>
                            <button class="btn btn-outline-primary float-right mt-2">Create</button>
                        </form>
                        @include('partials.errors')
                    </div>
                </div>
            </div>
            <div class="col-12 mt-4">
                <h4>Records</h4>
                <table class="table table-bordered p-2">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Wallet</th>
                        <th scope="col">Type</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($records as $record)
                        <tr>
                            <th scope="row">{{$record->id}}</th>
                            <td>{{$record->wallet->name ?? ''}}</td>
                            <td>{{$record->type}}</td>
                            <td>{{abs($record->amount)}}</td>
                            <td>
                                <form action="{{route('records.destroy', $record->id)}}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button class="btn btn-sm btn-outline-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
