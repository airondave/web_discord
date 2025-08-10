<?php

namespace App\Http\Controllers;

use App\Services\DiscordService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class DiscordController extends Controller
{
    protected $discordService;

    public function __construct(DiscordService $discordService)
    {
        $this->discordService = $discordService;
    }

    /**
     * Get selected Discord members (2 members)
     */
    public function getSelectedMembers(Request $request): JsonResponse
    {
        try {
            // Get member IDs from query parameters if provided
            $memberIds = $request->get('ids', []);
            if (is_string($memberIds)) {
                $memberIds = explode(',', $memberIds);
            }
            
            $members = $this->discordService->getSelectedMembers($memberIds);
            
            if (empty($members)) {
                return response()->json([
                    'success' => false,
                    'message' => 'No Discord members found'
                ], 404);
            }
            
            return response()->json([
                'success' => true,
                'data' => $members,
                'count' => count($members)
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch Discord members',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get simple member count
     */
    public function getMemberCount(): JsonResponse
    {
        try {
            $count = $this->discordService->getSimpleMemberCount();
            
            return response()->json([
                'success' => true,
                'data' => ['total' => $count]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch member count',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get specific user information
     */
    public function getUser($userId): JsonResponse
    {
        try {
            $user = $this->discordService->getUser($userId);
            $member = $this->discordService->getGuildMember($userId);
            
            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'User not found'
                ], 404);
            }

            $userData = [
                'id' => $user['id'],
                'username' => $user['username'],
                'discriminator' => $user['discriminator'] ?? '0',
                'avatar' => $user['avatar'] ? "https://cdn.discordapp.com/avatars/{$user['id']}/{$user['avatar']}.png" : null,
                'roles' => $member['roles'] ?? [],
                'joined_at' => $member['joined_at'] ?? null,
                'nick' => $member['nick'] ?? null,
                'status' => 'online', // Placeholder
                'last_seen' => now()->subHours(rand(1, 24))->diffForHumans() // Placeholder
            ];
            
            return response()->json([
                'success' => true,
                'data' => $userData
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch user information',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get guild roles
     */
    public function getRoles(): JsonResponse
    {
        try {
            $roles = $this->discordService->getGuildRoles();
            
            return response()->json([
                'success' => true,
                'data' => $roles
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch roles',
                'error' => $e->getMessage()
            ], 500);
        }
    }
} 