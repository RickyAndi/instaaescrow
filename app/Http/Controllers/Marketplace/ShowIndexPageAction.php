<?php

namespace App\Http\Controllers\Marketplace;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShowIndexPageAction extends Controller
{
    public function __invoke(Request $request)
    {
        return view('marketplace.index');
    }
}
