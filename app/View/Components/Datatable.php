<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Datatable extends Component
{
    public string $id;
    public string $ajaxUrl;
    public array $columns;
    /**
     * Create a new component instance.
     */
    public function __construct(string $id, string $ajaxUrl, array $columns)
    {
        $this->id = $id;
        $this->ajaxUrl = $ajaxUrl;
        $this->columns = $columns;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.datatable');
    }
}
