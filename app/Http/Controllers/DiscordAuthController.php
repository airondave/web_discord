<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\Role;

class DiscordAuthController extends Controller
{
    // Redirect to Discord OAuth
    public function redirectToDiscord(Request $request)
    {
        // Store the return URL in session
        $returnUrl = $request->get('return_url', '/submit');
        session(['discord_return_url' => $returnUrl]);
        
        return Socialite::driver('discord')
            ->scopes(['identify'])
            ->redirect();
    }

    // Handle Discord OAuth callback
    public function handleDiscordCallback()
    {
        try {
            $discordUser = Socialite::driver('discord')->user();
            
            // Get the return URL from session, default to /submit
            $returnUrl = session('discord_return_url', '/submit');
            
            // Get roles for the form
            $roles = Role::where('is_active', true)->orderBy('name')->get();
            
            // Store Discord user data in session
            session([
                'discord_user' => [
                    'id' => $discordUser->getId(),
                    'username' => $discordUser->getNickname() ?: $discordUser->getName(),
                    'discriminator' => $discordUser->user['discriminator'] ?? null,
                    'avatar' => $discordUser->getAvatar(),
                ]
            ]);
            
            // Clear the return URL from session
            session()->forget('discord_return_url');
            
            // Redirect back to the original form with success message
            return redirect($returnUrl)->with('discord_success', 'Discord account connected successfully!');
            
        } catch (\Exception $e) {
            // Get the return URL from session for error redirect too
            $returnUrl = session('discord_return_url', '/submit');
            session()->forget('discord_return_url');
            
            return redirect($returnUrl)->with('discord_error', 'Failed to connect Discord account. Please try again.');
        }
    }

    // Clear Discord session
    public function clearDiscordAuth(Request $request)
    {
        session()->forget('discord_user');
        
        // Get return URL from request or default to /submit
        $returnUrl = $request->get('return_url', '/submit');
        
        return redirect($returnUrl)->with('success', 'Discord connection cleared.');
    }
}
