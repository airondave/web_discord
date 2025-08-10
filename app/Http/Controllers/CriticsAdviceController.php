<?php

namespace App\Http\Controllers;

use App\Models\CriticsAdvice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\CriticsAdviceResponse;

class CriticsAdviceController extends Controller
{
    public function showForm()
    {
        return view('critics_advice.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'sender_name' => 'required|string|max:100',
            'sender_email' => 'required|email|max:100',
            'messages' => 'required|string|max:1000',
        ]);

        CriticsAdvice::create([
            'sender_name' => $request->sender_name,
            'sender_email' => $request->sender_email,
            'messages' => $request->messages,
        ]);

        return redirect()->back()->with('success', 'Thank you for your feedback! We will review and respond to your message soon.');
    }

    public function index()
    {
        $unresponded = CriticsAdvice::unresponded()->orderBy('created_at', 'desc')->get();
        $responded = CriticsAdvice::responded()->orderBy('created_at', 'desc')->get();

        return view('admin.critics_advice.index', compact('unresponded', 'responded'));
    }

    public function respond(Request $request, $id)
    {
        $request->validate([
            'response' => 'required|string|max:1000',
        ]);

        $criticsAdvice = CriticsAdvice::findOrFail($id);
        $criticsAdvice->update([
            'response' => $request->response
        ]);

        // Send email response to user
        try {
            Mail::to($criticsAdvice->sender_email)->send(new CriticsAdviceResponse($criticsAdvice));
        } catch (\Exception $e) {
            // Log the error but don't fail the response
            \Log::error('Failed to send email response: ' . $e->getMessage());
        }

        return redirect()->back()->with('success', 'Response sent successfully to ' . $criticsAdvice->sender_email);
    }

    public function destroy($id)
    {
        $criticsAdvice = CriticsAdvice::findOrFail($id);
        $criticsAdvice->delete();

        return redirect()->back()->with('success', 'Feedback deleted successfully');
    }
} 