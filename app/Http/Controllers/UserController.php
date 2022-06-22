<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateWalletRequest;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function create_wallet()
    {

        return view('create-wallet', compact('wallets'));
    }

    public function create_wallet_post(CreateWalletRequest $request){

        Wallet::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'type' => $request->type,
        ]);

        Session::flash('success', 'Wallet successfully created.');

        return redirect()->back();
    }
}
