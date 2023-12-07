<?php

namespace App\View\Components;

use App\Models\Catergory;
use Illuminate\View\Component;

class FrontLayout extends Component
{
    public $title; 

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title=null)
    {
        $this->title=$title??config('app.name');
        // $this->categories= $categories;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $categories=Catergory::all();
        return view('layouts.front',compact('categories'));
    }
}
