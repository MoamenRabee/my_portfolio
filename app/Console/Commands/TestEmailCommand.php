<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Models\ContactMessage;
use App\Mail\ContactMessageMail;

class TestEmailCommand extends Command
{
    protected $signature = 'test:email {--to=moamen.rabee.dev@gmail.com}';
    protected $description = 'Test email sending functionality';

    public function handle()
    {
        $this->info('🔍 Testing email configuration...');

        // Check mail configuration
        $this->info('📧 Mail Configuration:');
        $this->info('- Mailer: ' . config('mail.default'));
        $this->info('- Host: ' . config('mail.mailers.smtp.host'));
        $this->info('- Port: ' . config('mail.mailers.smtp.port'));
        $this->info('- Username: ' . config('mail.mailers.smtp.username'));
        $this->info('- Encryption: ' . config('mail.mailers.smtp.encryption'));
        $this->info('- From: ' . config('mail.from.address'));
        $this->info('- Admin Email: ' . config('mail.admin_email'));

        $this->info('');
        $this->info('🚀 Sending test email...');

        try {
            // Test 1: Simple raw email
            $this->info('Test 1: Simple raw email');
            Mail::raw('This is a test email from ' . config('app.name'), function ($message) {
                $message->to($this->option('to'))
                    ->subject('Test Email - Simple');
            });
            $this->info('✅ Simple email sent successfully!');

            $this->info('');

            // Test 2: Contact form email
            $this->info('Test 2: Contact form email template');

            // Create a test contact message
            $contact = new ContactMessage();
            $contact->name = 'Test User';
            $contact->email = 'test@example.com';
            $contact->subject = 'Test Subject from Command';
            $contact->message = 'This is a test message sent from the email test command.';
            $contact->phone = '123456789';
            $contact->ip_address = '127.0.0.1';
            $contact->save();

            Mail::to($this->option('to'))->send(new ContactMessageMail($contact));
            $this->info('✅ Contact form email sent successfully!');
            $this->info('📝 Contact message saved with ID: ' . $contact->id);

            $this->info('');
            $this->info('🎉 All tests passed! Email is working correctly.');

        } catch (\Exception $e) {
            $this->error('❌ Email test failed:');
            $this->error($e->getMessage());

            // Additional debugging info
            $this->info('');
            $this->info('🔧 Debugging information:');
            $this->info('- Error File: ' . $e->getFile());
            $this->info('- Error Line: ' . $e->getLine());

            if ($e->getPrevious()) {
                $this->info('- Previous Error: ' . $e->getPrevious()->getMessage());
            }

            return 1;
        }

        return 0;
    }
}
