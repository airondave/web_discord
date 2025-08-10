<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Exception;

class DiscordService
{
    protected $botToken;
    protected $guildId;
    protected $baseUrl = 'https://discord.com/api/v10';

    public function __construct()
    {
        $this->botToken = config('services.discord.bot_token');
        $this->guildId = config('services.discord.guild_id');
    }

    /**
     * Get guild (server) members
     */
    public function getGuildMembers($limit = 1000)
    {
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bot ' . $this->botToken,
            ])->get("{$this->baseUrl}/guilds/{$this->guildId}/members", [
                'limit' => $limit
            ]);

            if ($response->successful()) {
                return $response->json();
            }

            return [];
        } catch (Exception $e) {
            \Log::error('Discord API Error: ' . $e->getMessage());
            return [];
        }
    }

    /**
     * Get user information
     */
    public function getUser($userId)
    {
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bot ' . $this->botToken,
            ])->get("{$this->baseUrl}/users/{$userId}");

            if ($response->successful()) {
                return $response->json();
            }

            return null;
        } catch (Exception $e) {
            \Log::error('Discord API Error: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Get guild member with roles
     */
    public function getGuildMember($userId)
    {
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bot ' . $this->botToken,
            ])->get("{$this->baseUrl}/guilds/{$this->guildId}/members/{$userId}");

            if ($response->successful()) {
                return $response->json();
            }

            return null;
        } catch (Exception $e) {
            \Log::error('Discord API Error: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Get guild roles
     */
    public function getGuildRoles()
    {
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bot ' . $this->botToken,
            ])->get("{$this->baseUrl}/guilds/{$this->guildId}/roles");

            if ($response->successful()) {
                return $response->json();
            }

            return [];
        } catch (Exception $e) {
            \Log::error('Discord API Error: ' . $e->getMessage());
            return [];
        }
    }

    /**
     * Get online members count
     */
    public function getOnlineMembersCount()
    {
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bot ' . $this->botToken,
            ])->get("{$this->baseUrl}/guilds/{$this->guildId}?with_counts=true");

            if ($response->successful()) {
                $data = $response->json();
                return [
                    'online' => $data['approximate_presence_count'] ?? 0,
                    'total' => $data['approximate_member_count'] ?? 0
                ];
            }

            return ['online' => 0, 'total' => 0];
        } catch (Exception $e) {
            \Log::error('Discord API Error: ' . $e->getMessage());
            return ['online' => 0, 'total' => 0];
        }
    }

    /**
     * Get one featured Discord member
     */
    public function getFeaturedMember()
    {
        $cacheKey = "discord_featured_member_{$this->guildId}";
        
        return Cache::remember($cacheKey, 300, function () { // Cache for 5 minutes
            $members = $this->getGuildMembers(100); // Get up to 100 members to find a good one
            
            if (empty($members)) {
                return null;
            }
            
            // Get the first member with an avatar (or just the first one)
            foreach ($members as $member) {
                if (isset($member['user']) && isset($member['user']['avatar'])) {
                    $user = $this->getUser($member['user']['id']);
                    if ($user) {
                        return [
                            'id' => $user['id'],
                            'username' => $user['username'],
                            'discriminator' => $user['discriminator'] ?? '0',
                            'avatar' => "https://cdn.discordapp.com/avatars/{$user['id']}/{$user['avatar']}.png",
                            'roles' => $member['roles'] ?? [],
                            'joined_at' => $member['joined_at'],
                            'nick' => $member['nick'] ?? null,
                            'status' => 'online',
                            'last_seen' => 'Recently active'
                        ];
                    }
                }
            }
            
            // Fallback to first member without avatar
            if (isset($members[0]['user'])) {
                $user = $this->getUser($members[0]['user']['id']);
                if ($user) {
                    return [
                        'id' => $user['id'],
                        'username' => $user['username'],
                        'discriminator' => $user['discriminator'] ?? '0',
                        'avatar' => null, // No avatar
                        'roles' => $members[0]['roles'] ?? [],
                        'joined_at' => $members[0]['joined_at'],
                        'nick' => $members[0]['nick'] ?? null,
                        'status' => 'online',
                        'last_seen' => 'Recently active'
                    ];
                }
            }
            
            return null;
        });
    }

    /**
     * Get simple member count (without server insights)
     */
    public function getSimpleMemberCount()
    {
        $cacheKey = "discord_member_count_{$this->guildId}";
        
        return Cache::remember($cacheKey, 600, function () { // Cache for 10 minutes
            $members = $this->getGuildMembers(1000); // Get max members to count
            return count($members);
        });
    }
} 