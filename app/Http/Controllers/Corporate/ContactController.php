<?php

declare(strict_types=1);

namespace App\Http\Controllers\Corporate;

use App\Http\Controllers\Controller;

class ContactController extends Controller
{
    public function submit(ContactRequest $request): RedirectResponse
    {
        // Store the submission
        $submission = ContactSubmission::create($request->validated());

        // Could send notification to admins
        // Notification::route('mail', config('mail.admin_email'))
        //     ->notify(new ContactFormSubmission($submission));

        return redirect()
            ->back()
            ->with('success', 'Thank you for your message. We will get back to you soon!');
    }
}
