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
        
        if (!$this->botToken || !$this->guildId) {
            \Log::error('Discord Service: Missing bot_token or guild_id in configuration');
            throw new \Exception('Discord configuration is incomplete. Please check your .env file.');
        }
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
     * Get 2 specific Discord members by their IDs
     */
    public function getSelectedMembers($memberIds = [])
    {
        $cacheKey = "discord_selected_members_{$this->guildId}_" . implode('_', $memberIds);
        
        return Cache::remember($cacheKey, 300, function () use ($memberIds) { // Cache for 5 minutes
            $selectedMembers = [];
            
            \Log::info('DiscordService: Starting getSelectedMembers', [
                'memberIds' => $memberIds,
                'guildId' => $this->guildId
            ]);
            
            // If no specific IDs provided, get first 2 members with avatars
            if (empty($memberIds)) {
                \Log::info('DiscordService: No specific IDs provided, getting first 2 members');
                $members = $this->getGuildMembers(100);
                \Log::info('DiscordService: Retrieved guild members', ['count' => count($members)]);
                
                $count = 0;
                
                foreach ($members as $member) {
                    if ($count >= 2) break;
                    
                    if (isset($member['user'])) {
                        $user = $this->getUser($member['user']['id']);
                        if ($user) {
                            $selectedMembers[] = [
                                'id' => $user['id'],
                                'username' => $user['username'],
                                'discriminator' => $user['discriminator'] ?? '0',
                                'avatar' => $user['avatar'] ? "https://cdn.discordapp.com/avatars/{$user['id']}/{$user['avatar']}.png" : null,
                                'roles' => $member['roles'] ?? [],
                                'joined_at' => $member['joined_at'],
                                'nick' => $member['nick'] ?? null,
                                'status' => 'online',
                                'last_seen' => 'Recently active'
                            ];
                            $count++;
                        }
                    }
                }
            } else {
                \Log::info('DiscordService: Getting specific members by ID', ['memberIds' => $memberIds]);
                
                // Get specific members by ID
                foreach ($memberIds as $memberId) {
                    \Log::info('DiscordService: Fetching member', ['memberId' => $memberId]);
                    
                    $member = $this->getGuildMember($memberId);
                    \Log::info('DiscordService: Guild member response', [
                        'memberId' => $memberId,
                        'memberFound' => !empty($member),
                        'hasUser' => isset($member['user'])
                    ]);
                    
                    if ($member && isset($member['user'])) {
                        $user = $this->getUser($member['user']['id']);
                        \Log::info('DiscordService: User response', [
                            'memberId' => $memberId,
                            'userFound' => !empty($user)
                        ]);
                        
                        if ($user) {
                            $selectedMembers[] = [
                                'id' => $user['id'],
                                'username' => $user['username'],
                                'discriminator' => $user['discriminator'] ?? '0',
                                'avatar' => $user['avatar'] ? "https://cdn.discordapp.com/avatars/{$user['id']}/{$user['avatar']}.png" : null,
                                'roles' => $member['roles'] ?? [],
                                'joined_at' => $member['joined_at'],
                                'nick' => $member['nick'] ?? null,
                                'status' => 'online',
                                'last_seen' => 'Recently active'
                            ];
                        }
                    }
                }
            }
            
            \Log::info('DiscordService: Final result', [
                'selectedMembersCount' => count($selectedMembers),
                'selectedMembers' => $selectedMembers
            ]);
            
            return $selectedMembers;
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