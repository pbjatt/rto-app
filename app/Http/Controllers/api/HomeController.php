<?php

namespace App\Http\Controllers\api;

use Hash;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Slider;
use App\Models\Tool;

class HomeController extends Controller
{
    public function index()
    {
        $tools = Tool::get();

        $re = [
            'status'    => true,
            'tools'     => $tools
        ];

        return response()->json($re);
    }
}
