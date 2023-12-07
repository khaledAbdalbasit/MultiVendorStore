<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
class dashbordController extends Controller
{
    //second methode to define middleware in controller
    public function __construct()
    {
        //$this->middleware(['auth']);//->except('index) use condtion in all methode excpeion index
                                    //->only('index) use use condtion in index method only
    }

    public function index()
    {
        $user=Auth::user();

        $title='store';
        return View::make('dashboard.index',[
            'user'=>'kahlde',
            'title'=>$title
        ]);
    }
}
