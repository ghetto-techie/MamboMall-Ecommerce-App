<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Contact;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMessage;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;

class ContactForm extends Component
{
    public $name = '';
    public $email = '';
    public $message = '';

    protected $rules = [
        'name' => 'required|min:3|max:100',
        'email' => 'required|email',
        'message' => 'required|min:10|max:1000',
    ];

    protected $messages = [
        'name.required' => 'Please provide your name.',
        'name.min' => 'Name should be at least 3 characters.',
        'email.required' => 'Please provide your email address.',
        'email.email' => 'Please enter a valid email address.',
        'message.required' => 'Please enter your message.',
        'message.min' => 'Message should be at least 10 characters.',
    ];

    public function send()
    {
        $this->validate();

        try {
            // Create contact record
            $contact = Contact::create([
                'name' => $this->name,
                'email' => $this->email,
                'message' => $this->message,
            ]);

            // Prepare data for email
            $mailData = [
                'name' => $this->name,
                'email' => $this->email,
                'messageContent' => $this->message,
            ];

            // // Send email
            // Mail::to(config('mail.from.address', 'admin@example.com'))
            //     ->send(new ContactMessage($mailData));

            // Reset form
            $this->reset(['name', 'email', 'message']);

            // Show success message
            LivewireAlert::title('Thank you for your message!')
                ->text('We will get back to you as soon as possible.')
                ->success()
                ->toast()
                ->position('center')
                ->timer(4000);

        } catch (\Exception $e) {
            // Log the error
            logger()->error('Contact form error: ' . $e->getMessage());

            // Show error message
            LivewireAlert::title('Something went wrong')
                ->text('Please try again or contact us directly at ' . config('mail.from.address', 'admin@example.com'))
                ->error()
                ->toast()
                ->position('center')
                ->timer(5000);
        }
    }

    public function render()
    {
        return view('livewire.contact-form');
    }
}
