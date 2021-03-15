<?php

namespace App\Http\Controllers\Development;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DevelopmentUserLoginAction extends Controller
{
    public function __invoke()
    {
        Auth::guard('web')->loginUsingId(1);
        return redirect()
            ->route('marketplace.order-book');
    }
}
