<?php

namespace App\View\Components;

use Illuminate\View\Component;

class CustomSeo extends Component
{

    public $title;
    public $metaTag;
    public function __construct($title, $metaTag)
    {
        $this->title = $title;
        $this->metaTag = $metaTag;
    }

    public function render()
    {
        return view('components.custom-seo');
    }
}
