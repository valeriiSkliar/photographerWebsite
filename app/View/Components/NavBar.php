<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class NavBar extends Component
{
    public array $available_locales = [
        'English' => 'en',
        "German" => "de"
    ];
    public string $current_locale = 'en';
    public array $routs = [
        'About' => 'about',
        'Portfolio' => 'portfolio',
        'Work' => 'work',
        'Contact' => 'contact',
    ];
    public string $logo = 'assets/logo/logo_nav.svg';

    /**
     * Create a new component instance.
     */
    public function __construct($routs = [], $logo = '', $available_locales = [], $current_locale = 'en')
    {
        if (!empty($routs)) {
            $this->routs = $routs;
        }
        
        if ($current_locale) {
            $this->current_locale = $current_locale;
        }

        if (!empty($available_locales)) {
            $this->available_locales = $available_locales;
        }

        if ($logo) {
            $this->logo = $logo;
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.nav-bar');
    }
}
