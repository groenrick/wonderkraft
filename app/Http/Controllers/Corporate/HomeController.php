<?php

declare(strict_types=1);

namespace App\Http\Controllers\Corporate;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Display the corporate homepage
     */
    public function index(): View
    {
        return view('corporate.home');
    }
}
