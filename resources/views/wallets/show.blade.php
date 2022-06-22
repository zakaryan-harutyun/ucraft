@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 mt-4">
                <h4>Reports</h4>
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
                    @foreach($reports as $report)
                        <tr>
                            <th scope="row">{{$report->id}}</th>
                            <td>{{$report->wallet->name ?? ''}}</td>
                            <td>{{$report->type}}</td>
                            <td>{{abs($report->amount)}}</td>
                            <td>
                                <form action="{{route('records.destroy', $report->id)}}" method="POST">
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
