<?php

namespace App\View\Components;

use App\Models\MetaData\MetaTags;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class MetaData extends Component
{
    public $metaTags;
    /**
     * Create a new component instance.
     */
    public function __construct($page_id = 1)
    {
        $this->metaTags = MetaTags::where('page_id', '=', $page_id)->get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.meta-data');
    }
}
