<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index(){
        return Tag::all();
    }
}
