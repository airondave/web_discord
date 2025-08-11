<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Submission; // model untuk database
use App\Models\Role;

class SubmissionController extends Controller
{
    // tampilkan form
    public function create()
    {
        $roles = Role::where('is_active', true)->orderBy('name')->get();
        return view('submit', compact('roles'));
    }

    // simpan data ke database
    public function store(Request $request)
    {
        // Different validation rules based on route
        $validationRules = [
            'discord_username' => 'required|string|max:255',
            'discord_id' => 'required|string|max:255',
            'role_id' => 'required|exists:roles,id',
        ];

        // Add different fields based on route
        $isButunRoute = str_contains($request->url(), '/butun');
        if ($isButunRoute) {
            // BUTUN page: requires image, no desired_role
            $validationRules['proof_image'] = 'required|image|mimes:jpeg,png,jpg,gif|max:10240';
        } else {
            // Main page: requires desired_role, no image
            $validationRules['desired_role'] = 'required|string|max:255';
        }

        $request->validate($validationRules);

        // handle file upload with enhanced security
        $imageName = null;
        if ($request->hasFile('proof_image')) {
            $file = $request->file('proof_image');
            
            // Additional security checks
            $allowedMimeTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
            if (!in_array($file->getMimeType(), $allowedMimeTypes)) {
                return back()->withErrors(['proof_image' => 'Invalid file type detected.'])->withInput();
            }
            
            // Check file content for malicious signatures
            $fileContent = file_get_contents($file->getRealPath());
            $dangerousSignatures = [
                '<?php', '<?=', '<? ', 'eval(', 'system(', 'exec(', 'shell_exec(',
                'passthru(', 'base64_decode(', 'gzinflate(', 'str_rot13('
            ];
            
            foreach ($dangerousSignatures as $signature) {
                if (stripos($fileContent, $signature) !== false) {
                    return back()->withErrors(['proof_image' => 'File contains potentially dangerous content.'])->withInput();
                }
            }
            
            // Generate secure filename
            $imageName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads'), $imageName);
        }

        // simpan ke database
        Submission::create([
            'discord_username' => $request->discord_username,
            'discord_id' => $request->discord_id,
            'role_id' => $request->role_id,
            'desired_role' => $request->desired_role ?? null,
            'proof_path' => $imageName ? 'uploads/' . $imageName : null,
            'status' => 'pending',
            'submission_type' => $isButunRoute ? 'butun' : 'regular',
        ]);

        $redirectUrl = $isButunRoute ? '/submit/butun' : '/submit';
        return redirect($redirectUrl)->with('success', 'Submission sent successfully! Please wait for admin verification.');
    }

    // Create method for BUTUN page
    public function createButun()
    {
        $roles = Role::where('is_active', true)->orderBy('name')->get();
        return view('submit-butun', compact('roles'));
    }

    // lihat semua data (admin)
    public function index()
    {
        $submissions = Submission::with('role')->orderBy('created_at', 'desc')->get();
        return view('admin.submissions', compact('submissions'));
    }

    // approve submission
    public function approve($id)
    {
        $submission = Submission::findOrFail($id);
        $submission->update(['status' => 'approved']);
        
        return redirect('/admin/submissions')->with('success', 'Submission approved successfully!');
    }

    // reject submission
    public function reject($id)
    {
        $submission = Submission::findOrFail($id);
        $submission->update(['status' => 'rejected']);
        
        return redirect('/admin/submissions')->with('success', 'Submission rejected successfully!');
    }

    // Approval history page
    public function approvalHistory()
    {
        $submissions = Submission::with('role')
                                ->whereIn('status', ['approved', 'rejected'])
                                ->orderBy('updated_at', 'desc')
                                ->get();
        
        return view('admin.approval-history', compact('submissions'));
    }
}
