@extends('admin.layout')

@section('title', 'Discord Chat')

@push('styles')
<style>
    .chat-container {
        background: var(--card-bg);
        border-radius: 15px;
        box-shadow: var(--shadow);
        overflow: hidden;
        border: 1px solid var(--border-color);
    }
    
    .chat-header {
        background: linear-gradient(135deg, #5865f2 0%, #7289da 100%);
        color: white;
        padding: 20px;
        text-align: center;
    }
    
    .chat-form {
        padding: 30px;
        background: var(--card-bg);
        color: var(--text-primary);
    }
    
    .channel-selector {
        background: var(--bg-primary);
        border: 2px solid var(--border-color);
        border-radius: 10px;
        padding: 20px;
        margin-bottom: 25px;
        color: var(--text-primary);
    }
    
    .message-input {
        background: var(--bg-secondary);
        border: 2px solid var(--border-color);
        border-radius: 10px;
        transition: all 0.3s ease;
        color: var(--text-primary);
    }
    
    .message-input:focus {
        border-color: #5865f2;
        box-shadow: 0 0 0 0.2rem rgba(88, 101, 242, 0.25);
        background: var(--bg-secondary);
        color: var(--text-primary);
    }
    
    .send-btn {
        background: linear-gradient(135deg, #5865f2 0%, #7289da 100%);
        border: none;
        border-radius: 10px;
        padding: 12px 30px;
        font-weight: 600;
        transition: all 0.3s ease;
    }
    
    .send-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(88, 101, 242, 0.4);
    }
    
    .message-type-toggle {
        background: var(--bg-primary);
        border: 1px solid var(--border-color);
        border-radius: 8px;
        padding: 8px 16px;
        margin-bottom: 20px;
        color: var(--text-primary);
    }
    
    .message-type-toggle .btn {
        border-radius: 6px;
        font-size: 0.9rem;
        padding: 6px 16px;
        color: var(--text-primary);
        border-color: var(--border-color);
        background: var(--bg-secondary);
    }
    
    .message-type-toggle .btn:hover {
        background: var(--bg-primary);
        border-color: var(--text-secondary);
    }
    
    .message-type-toggle .btn.active {
        background: #5865f2;
        border-color: #5865f2;
        color: white;
    }
    
    .channel-info {
        background: var(--bg-primary);
        border: 1px solid var(--border-color);
        border-radius: 8px;
        padding: 15px;
        margin-bottom: 20px;
        color: var(--text-primary);
    }
    
    .character-count {
        font-size: 0.85rem;
        color: var(--text-secondary);
        text-align: right;
        margin-top: 5px;
    }
    
    .character-count.warning {
        color: #ffc107;
    }
    
    .character-count.danger {
        color: #dc3545;
    }
    
    /* Dark mode specific overrides */
    [data-bs-theme="dark"] .chat-container {
        background: var(--card-bg);
        border-color: var(--border-color);
    }
    
    [data-bs-theme="dark"] .chat-form {
        background: var(--card-bg);
        color: var(--text-primary);
    }
    
    [data-bs-theme="dark"] .channel-selector {
        background: var(--bg-primary);
        border-color: var(--border-color);
        color: var(--text-primary);
    }
    
    [data-bs-theme="dark"] .message-type-toggle {
        background: var(--bg-primary);
        border-color: var(--border-color);
        color: var(--text-primary);
    }
    
    [data-bs-theme="dark"] .channel-info {
        background: var(--bg-primary);
        border-color: var(--border-color);
        color: var(--text-primary);
    }
    
    /* Form elements dark mode support */
    .form-check-label {
        color: var(--text-primary);
    }
    
    .form-check-label small {
        color: var(--text-secondary);
    }
    
    .form-label {
        color: var(--text-primary);
    }
    
    /* Button group dark mode support */
    .btn-outline-secondary {
        color: var(--text-primary);
        border-color: var(--border-color);
        background: var(--bg-secondary);
    }
    
    .btn-outline-secondary:hover {
        background: var(--bg-primary);
        border-color: var(--text-secondary);
        color: var(--text-primary);
    }
    
    /* Alert dark mode support */
    .alert-warning {
        background: var(--bg-secondary);
        border-color: var(--border-color);
        color: var(--text-primary);
    }
    
    /* Smooth transitions for theme switching */
    .chat-container,
    .chat-form,
    .channel-selector,
    .message-type-toggle,
    .channel-info,
    .form-check-label,
    .form-label,
    .btn-outline-secondary {
        transition: all 0.3s ease;
    }
</style>
@endpush

@section('content')
<div class="content-wrapper">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">
            <i class="bi bi-discord text-primary me-2"></i>
            Discord Chat
        </h2>
        <div class="d-flex align-items-center">
            <span class="badge bg-success me-2">
                <i class="bi bi-check-circle me-1"></i>
                Bot Connected
            </span>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-triangle me-2"></i>
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="chat-container">
        <div class="chat-header">
            <h4 class="mb-1">
                <i class="bi bi-chat-dots me-2"></i>
                Send Message to Discord Server
            </h4>
            <p class="mb-0 opacity-75">Choose a channel and send your message</p>
        </div>

        <div class="chat-form">
            <form action="{{ route('admin.discord.chat.send') }}" method="POST" id="discordChatForm">
                @csrf
                
                <!-- Channel Selection -->
                <div class="channel-selector">
                    <h6 class="mb-3">
                        <i class="bi bi-hash me-2"></i>
                        Select Channel
                    </h6>
                    
                    @if(count($channels) > 0)
                        <div class="row">
                            @foreach($channels as $channel)
                                <div class="col-md-6 col-lg-4 mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="channel_id" 
                                               id="channel_{{ $channel['id'] }}" value="{{ $channel['id'] }}" required>
                                        <label class="form-check-label" for="channel_{{ $channel['id'] }}">
                                            <strong>#{{ $channel['name'] }}</strong>
                                            @if(isset($channel['topic']) && $channel['topic'])
                                                <br><small class="text-muted">{{ Str::limit($channel['topic'], 50) }}</small>
                                            @endif
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="alert alert-warning">
                            <i class="bi bi-exclamation-triangle me-2"></i>
                            No text channels found. Please check your bot permissions.
                        </div>
                    @endif
                </div>

                <!-- Message Type Selection -->
                <div class="message-type-toggle">
                    <h6 class="mb-3">
                        <i class="bi bi-type me-2"></i>
                        Message Type
                    </h6>
                    <div class="btn-group" role="group">
                        <input type="radio" class="btn-check" name="message_type" id="type_text" value="text" checked>
                        <label class="btn btn-outline-secondary" for="type_text">
                            <i class="bi bi-chat-text me-1"></i>
                            Text Message
                        </label>
                        
                        <input type="radio" class="btn-check" name="message_type" id="type_embed" value="embed">
                        <label class="btn btn-outline-secondary" for="type_embed">
                            <i class="bi bi-card-text me-1"></i>
                            Rich Embed
                        </label>
                    </div>
                </div>

                <!-- Message Input -->
                <div class="mb-4">
                    <label for="message" class="form-label">
                        <i class="bi bi-pencil-square me-2"></i>
                        Message Content
                    </label>
                    <textarea class="form-control message-input" id="message" name="message" 
                              rows="6" placeholder="Type your message here..." required maxlength="2000"></textarea>
                    <div class="character-count" id="charCount">
                        <span id="currentCount">0</span> / 2000 characters
                    </div>
                </div>

                <!-- Send Button -->
                <div class="text-center">
                    <button type="submit" class="btn send-btn btn-lg text-white" id="sendBtn" disabled>
                        <i class="bi bi-send me-2"></i>
                        Send to Discord
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Channel Information -->
    <div class="channel-info mt-4">
        <h6 class="mb-2">
            <i class="bi bi-info-circle me-2"></i>
            Tentang Discord Chat by Venla
        </h6>
        <ul class="mb-0">
            <li><strong>Text Messages:</strong> Langsung kirim pesan ke channel</li>
            <li><strong>Rich Embeds:</strong> Embed biasa dengan style yang kaya</li>
            <li><strong>Character Limit:</strong> Maksimal 2000 karakter pesan</li>
        </ul>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const messageInput = document.getElementById('message');
    const charCount = document.getElementById('charCount');
    const currentCount = document.getElementById('currentCount');
    const sendBtn = document.getElementById('sendBtn');
    const form = document.getElementById('discordChatForm');

    // Character count functionality
    messageInput.addEventListener('input', function() {
        const count = this.value.length;
        currentCount.textContent = count;
        
        // Update character count styling
        charCount.className = 'character-count';
        if (count > 1800) {
            charCount.classList.add('danger');
        } else if (count > 1500) {
            charCount.classList.add('warning');
        }
        
        // Enable/disable send button
        sendBtn.disabled = count === 0;
    });

    // Form validation
    form.addEventListener('submit', function(e) {
        const selectedChannel = document.querySelector('input[name="channel_id"]:checked');
        const message = messageInput.value.trim();
        
        if (!selectedChannel) {
            e.preventDefault();
            alert('Please select a channel to send your message to.');
            return;
        }
        
        if (!message) {
            e.preventDefault();
            alert('Please enter a message to send.');
            return;
        }
        
        // Show loading state
        sendBtn.innerHTML = '<i class="bi bi-hourglass-split me-2"></i>Sending...';
        sendBtn.disabled = true;
    });

    // Auto-select first channel if only one exists
    const channels = document.querySelectorAll('input[name="channel_id"]');
    if (channels.length === 1) {
        channels[0].checked = true;
    }
});
</script>
@endpush 