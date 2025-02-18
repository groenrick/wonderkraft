<?php

declare(strict_types=1);

namespace App\Http\Controllers\Corporate;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class PageController extends Controller
{
    public function about(): View
    {
        return view('corporate.pages.about');
    }

    public function pricing(): View
    {
        $plans = [
            // Your pricing plans data
        ];

        return view('corporate.pages.pricing', compact('plans'));
    }

    public function features(): View
    {
        return view('corporate.pages.features');
    }

    public function contact(): View
    {
        return view('corporate.pages.contact');
    }

    /**
     * Display the support page
     */
    public function support(): View
    {
        $supportCategories = [
            'getting-started' => [
                'title' => 'Getting Started',
                'articles' => [
                    ['title' => 'Quick Start Guide', 'url' => '#'],
                    ['title' => 'Installation Guide', 'url' => '#'],
                    ['title' => 'Basic Configuration', 'url' => '#'],
                ]
            ],
            'troubleshooting' => [
                'title' => 'Troubleshooting',
                'articles' => [
                    ['title' => 'Common Issues', 'url' => '#'],
                    ['title' => 'Error Messages', 'url' => '#'],
                    ['title' => 'FAQs', 'url' => '#'],
                ]
            ],
            'account' => [
                'title' => 'Account & Billing',
                'articles' => [
                    ['title' => 'Subscription Management', 'url' => '#'],
                    ['title' => 'Payment Methods', 'url' => '#'],
                    ['title' => 'Billing FAQ', 'url' => '#'],
                ]
            ]
        ];

        return view('corporate.pages.support', [
            'categories' => $supportCategories,
            'contactEmail' => 'support@yourcompany.com',
            'supportHours' => '24/7'
        ]);
    }
        // Add other page methods...
}
