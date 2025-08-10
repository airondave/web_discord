<?php

namespace App\Http\Controllers;

use App\Services\DiscordService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DiscordChatController extends Controller
{
    protected $discordService;

    public function __construct(DiscordService $discordService)
    {
        $this->discordService = $discordService;
    }

    /**
     * Show the Discord chat interface
     */
    public function index()
    {
        try {
            $channels = $this->discordService->getGuildChannels();
            
            return view('admin.discord.chat', compact('channels'));
        } catch (\Exception $e) {
            Log::error('Error loading Discord chat: ' . $e->getMessage());
            return back()->with('error', 'Failed to load Discord channels. Please check your bot configuration.');
        }
    }

    /**
     * Send a message to a Discord channel
     */
    public function sendMessage(Request $request)
    {
        $request->validate([
            'channel_id' => 'required|string',
            'message' => 'required|string|max:2000',
            'message_type' => 'required|in:text,embed'
        ]);

        try {
            $channelId = $request->input('channel_id');
            $message = $request->input('message');
            $messageType = $request->input('message_type');

            $embed = null;
            if ($messageType === 'embed') {
                $embed = [
                    'title' => 'Admin Message',
                    'description' => $message,
                    'color' => 0x3498db, // Blue color
                    'timestamp' => now()->toISOString(),
                    'footer' => [
                        'text' => 'Sent via Admin Panel'
                    ]
                ];
            }

            $result = $this->discordService->sendMessage($channelId, $message, $embed);

            if ($result['success']) {
                return back()->with('success', 'Message sent successfully to Discord channel!');
            } else {
                return back()->with('error', 'Failed to send message: ' . ($result['error'] ?? 'Unknown error'));
            }

        } catch (\Exception $e) {
            Log::error('Error sending Discord message: ' . $e->getMessage());
            return back()->with('error', 'An error occurred while sending the message.');
        }
    }

    /**
     * Get available channels via AJAX
     */
    public function getChannels()
    {
        try {
            $channels = $this->discordService->getGuildChannels();
            return response()->json(['success' => true, 'channels' => $channels]);
        } catch (\Exception $e) {
            Log::error('Error getting Discord channels: ' . $e->getMessage());
            return response()->json(['success' => false, 'error' => 'Failed to load channels']);
        }
    }
} 