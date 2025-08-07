<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactMessage;
use App\Mail\ContactMessageMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        // Validation
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|min:10|max:5000',
            'phone' => 'nullable|string|max:20'
        ], [
            'name.required' => 'Name is required',
            'name.max' => 'Name must not exceed 255 characters',
            'email.required' => 'Email is required',
            'email.email' => 'Email format is invalid',
            'email.max' => 'Email must not exceed 255 characters',
            'subject.required' => 'Subject is required',
            'subject.max' => 'Subject must not exceed 255 characters',
            'message.required' => 'Message is required',
            'message.min' => 'Message must be at least 10 characters',
            'message.max' => 'Message must not exceed 5000 characters',
            'phone.max' => 'Phone number must not exceed 20 characters'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error in submitted data',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            // Create contact message
            $contactMessage = ContactMessage::create([
                'name' => $request->name,
                'email' => $request->email,
                'subject' => $request->subject,
                'message' => $request->message,
                'phone' => $request->phone,
                'ip_address' => $request->ip()
            ]);

            // Send email
            try {
                Mail::to(config('mail.admin_email', 'admin@admin.com'))->send(new ContactMessageMail($contactMessage));
            } catch (\Exception $e) {
                \Log::error('Failed to send contact email: ' . $e->getMessage());
                // Don't fail the entire request if email fails
            }

            return response()->json([
                'success' => true,
                'message' => 'Your message has been sent successfully! We will reply to you as soon as possible.'
            ]);

        } catch (\Exception $e) {
            \Log::error('Contact form error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'An error occurred while sending the message. Please try again.'
            ], 500);
        }
    }
}
