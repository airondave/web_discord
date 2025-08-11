<?php

namespace App\Http\Controllers;

use App\Models\CriticsAdvice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\CriticsAdviceResponse;
use App\Services\DiscordService;
use Illuminate\Support\Str;

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
            'discord_username' => 'nullable|string|max:100',
            'messages' => 'required|string|max:1000',
        ]);

        CriticsAdvice::create([
            'sender_name' => $request->sender_name,
            'sender_email' => $request->sender_email,
            'discord_username' => $request->discord_username,
            'messages' => $request->messages,
            'response' => null, // New submissions don't have responses yet
        ]);

        return redirect()->back()->with('success', 'Thank you for your feedback! We will review and respond to your message soon.');
    }

    /**
     * Mask email address for privacy (e.g., j*******m@example.com)
     */
    private function maskEmail($email)
    {
        if (empty($email)) return '';
        
        $parts = explode('@', $email);
        if (count($parts) !== 2) return $email;
        
        $username = $parts[0];
        $domain = $parts[1];
        
        if (strlen($username) <= 2) {
            $maskedUsername = $username;
        } else {
            $first = substr($username, 0, 1);
            $last = substr($username, -1);
            $maskedUsername = $first . str_repeat('*', strlen($username) - 2) . $last;
        }
        
        return $maskedUsername . '@' . $domain;
    }

    public function index()
    {
        $unresponded = CriticsAdvice::unresponded()->orderBy('created_at', 'desc')->get();
        $responded = CriticsAdvice::responded()->orderBy('created_at', 'desc')->get();

        // Mask emails for privacy
        $unresponded->each(function ($item) {
            $item->masked_email = $this->maskEmail($item->sender_email);
        });
        
        $responded->each(function ($item) {
            $item->masked_email = $this->maskEmail($item->sender_email);
        });

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

        // Send Discord notification if user provided Discord username
        if ($criticsAdvice->discord_username) {
            try {
                $this->sendDiscordNotification($criticsAdvice);
            } catch (\Exception $e) {
                // Log the error but don't fail the response
                \Log::error('Failed to send Discord notification: ' . $e->getMessage());
            }
        }

        return redirect()->back()->with('success', 'Response sent successfully to ' . $criticsAdvice->sender_email . 
            ($criticsAdvice->discord_username ? ' and Discord notification sent to ' . $criticsAdvice->discord_username : ''));
    }

    /**
     * Send Discord notification to user
     */
    private function sendDiscordNotification($criticsAdvice)
    {
        try {
            $discordService = new DiscordService();
            
            // Create embed message for Discord
            $embed = [
                'title' => '🎯 Response to Your Feedback',
                'description' => 'Kami sudah membalas feedback anda! Silahkan cek email anda untuk melihat balasan kami.',
                'color' => 0x00ff41, // Retro green color
                'footer' => [
                    'text' => 'Ranconnity'
                ],
                'timestamp' => now()->toISOString()
            ];

            // Try to find the user in Discord server and send DM
            // For now, we'll send to a designated channel for notifications
            // You can enhance this to send DMs if you have user IDs
            $notificationChannelId = config('services.discord.notification_channel_id');
            
            if ($notificationChannelId) {
                $message = "🔔 **Discord Notification**\n\n" .
                          "Hey {$criticsAdvice->discord_username}! We have responded to your feedback! Check your email for the full response.";
                
                $discordService->sendMessage($notificationChannelId, $message, $embed);
            }

        } catch (\Exception $e) {
            \Log::error('Discord notification failed: ' . $e->getMessage());
            throw $e;
        }
    }

    public function destroy($id)
    {
        $criticsAdvice = CriticsAdvice::findOrFail($id);
        $criticsAdvice->delete();

        return redirect()->back()->with('success', 'Feedback deleted successfully');
    }
} 