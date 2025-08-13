<!DOCTYPE html>
<html lang="en" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel') - Random Community</title>
    
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- Favicon -->
    <link rel="icon" type="/public/image/x-icon" href="/public/image/favicon.ico">
    <link rel="icon" type="/public/image/png" sizes="32x32" href="/public/image/favicon-32x32.png">
    <link rel="icon" type="/public/image/png" sizes="16x16" href="/public/image/favicon-16x16.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/public/image/apple-touch-icon.png">
    
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        :root {
            /* Light theme variables */
            --bg-primary: #f8f9fa;
            --bg-secondary: #ffffff;
            --bg-sidebar: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
            --text-primary: #212529;
            --text-secondary: #6c757d;
            --border-color: #e9ecef;
            --shadow: 0 0 20px rgba(0,0,0,0.1);
            --card-bg: #ffffff;
            --table-bg: #ffffff;
            --table-header-bg: #343a40;
            --table-header-text: #ffffff;
        }

        [data-bs-theme="dark"] {
            /* Dark theme variables */
            --bg-primary: #1a1a1a !important;
            --bg-secondary: #2d2d2d !important;
            --bg-sidebar: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 100%) !important;
            --text-primary: #ffffff !important;
            --text-secondary: #b0b0b0 !important;
            --border-color: #404040 !important;
            --shadow: 0 0 20px rgba(0,0,0,0.3) !important;
            --card-bg: #2d2d2d !important;
            --table-bg: #2d2d2d !important;
            --table-header-bg: #404040 !important;
            --table-header-text: #ffffff !important;
        }

        body {
            background-color: var(--bg-primary);
            color: var(--text-primary);
            transition: all 0.3s ease;
        }

        .sidebar {
            background: var(--bg-sidebar);
            min-height: 100vh;
            box-shadow: var(--shadow);
        }
        .sidebar .nav-link {
            color: rgba(255,255,255,0.8);
            padding: 12px 20px;
            margin: 5px 15px;
            border-radius: 8px;
            transition: all 0.3s ease;
            border-left: 3px solid transparent;
        }
        .sidebar .nav-link:hover {
            color: white;
            background: rgba(255,255,255,0.1);
            border-left-color: #3498db;
            transform: translateX(5px);
        }
        .sidebar .nav-link.active {
            color: white;
            background: rgba(52, 152, 219, 0.2);
            border-left-color: #3498db;
        }
        .sidebar .nav-section {
            color: rgba(255,255,255,0.6);
            font-size: 0.85rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            padding: 20px 20px 10px 20px;
            margin-top: 20px;
        }
        .main-content {
            background: var(--bg-primary);
            min-height: 100vh;
        }
        .top-navbar {
            background: var(--bg-secondary);
            box-shadow: var(--shadow);
            border-bottom: 1px solid var(--border-color);
        }
        .sidebar-brand {
            background: rgba(0,0,0,0.2);
            padding: 20px;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }
        .content-wrapper {
            padding: 30px;
        }
        .card {
            border: none;
            box-shadow: var(--shadow);
            border-radius: 10px;
            background: var(--card-bg);
            color: var(--text-primary);
        }
        .card-header {
            background: var(--bg-secondary) !important;
            border-bottom: 1px solid var(--border-color);
        }
        .table {
            background: var(--table-bg);
            color: var(--text-primary);
        }
        .table thead th {
            background: var(--table-header-bg);
            color: var(--table-header-text);
            border-color: var(--border-color);
        }
        .table tbody tr {
            background: var(--table-bg);
        }
        .table tbody tr:hover {
            background: var(--bg-primary);
        }
        .table td, .table th {
            border-color: var(--border-color);
        }
        .btn-primary {
            background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
            border: none;
        }
        .btn-primary:hover {
            background: linear-gradient(135deg, #2980b9 0%, #1f618d 100%);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(52, 152, 219, 0.4);
        }

        /* Dark mode toggle button styles */
        .theme-toggle {
            background: none;
            border: 2px solid var(--border-color);
            border-radius: 50px;
            padding: 8px 16px;
            color: var(--text-primary);
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            font-weight: 500;
            min-width: 100px;
            justify-content: center;
        }
        .theme-toggle:hover {
            background: var(--bg-primary);
            border-color: var(--text-secondary);
            transform: translateY(-1px);
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        .theme-toggle:active {
            transform: translateY(0);
        }
        .theme-toggle.active {
            background: var(--bg-primary);
            border-color: #3498db;
            color: #3498db;
        }
        .theme-toggle .icon {
            font-size: 1.1rem;
            transition: transform 0.3s ease;
        }
        .theme-toggle:hover .icon {
            transform: rotate(15deg);
        }

        /* Alert styles for dark mode */
        .alert {
            background: var(--bg-secondary);
            border: 1px solid var(--border-color);
            color: var(--text-primary);
        }

        /* Dropdown styles for dark mode */
        .dropdown-menu {
            background: var(--bg-secondary);
            border: 1px solid var(--border-color);
        }
        .dropdown-item {
            color: var(--text-primary);
        }
        .dropdown-item:hover {
            background: var(--bg-primary);
        }
        .dropdown-header {
            color: var(--text-secondary);
        }
        
        /* Additional dark mode improvements */
        .navbar-light .navbar-nav .nav-link {
            color: var(--text-primary);
        }
        
        .navbar-light .navbar-nav .nav-link:hover {
            color: var(--text-secondary);
        }
        
        .navbar-light .navbar-toggler {
            border-color: var(--border-color);
        }
        
        .navbar-light .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%2833, 37, 41, 0.75%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
        }
        
        [data-bs-theme="dark"] .navbar-light .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%28255, 255, 255, 0.75%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
        }
        
        /* Smooth transitions for all elements */
        * {
            transition: background-color 0.3s ease, color 0.3s ease, border-color 0.3s ease, box-shadow 0.3s ease;
        }
        
        /* Form elements dark mode support */
        .form-control, .form-select {
            background-color: var(--bg-secondary);
            border-color: var(--border-color);
            color: var(--text-primary);
        }
        
        .form-control:focus, .form-select:focus {
            background-color: var(--bg-secondary);
            border-color: #3498db;
            color: var(--text-primary);
            box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25);
        }
        
        .form-label {
            color: var(--text-primary);
        }
        
        .form-text {
            color: var(--text-secondary);
        }
    </style>
    @stack('styles')
</head>
<body>

<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <nav class="col-md-3 col-lg-2 d-md-block sidebar collapse">
            <div class="sidebar-brand text-center">
                <i class="bi bi-shield-check display-4 text-white mb-2"></i>
                <h5 class="text-white mb-0">Admin Panel</h5>
                <small class="text-white-50">Discord Verification</small>
            </div>
            
            <div class="position-sticky pt-3">
                <!-- Dashboard -->
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.submissions') ? 'active' : '' }}" href="{{ route('admin.submissions') }}">
                            <i class="bi bi-speedometer2 me-2"></i>
                            Dashboard Menu
                        </a>
                    </li>
                </ul>

                <!-- Data Section -->
                <div class="nav-section">
                    <i class="bi bi-database me-1"></i> Data
                </div>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.submissions') ? 'active' : '' }}" href="{{ route('admin.submissions') }}">
                            <i class="bi bi-list-check me-2"></i>
                            Submissions
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.approval-history') ? 'active' : '' }}" href="{{ route('admin.approval-history') }}">
                            <i class="bi bi-clock-history me-2"></i>
                            Approval History
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.critics.advice') ? 'active' : '' }}" href="{{ route('admin.critics.advice') }}">
                            <i class="bi bi-chat-heart me-2"></i>
                            Critics & Advice
                        </a>
                    </li>
                </ul>

                <!-- Users Section -->
                <div class="nav-section">
                    <i class="bi bi-people me-1"></i> Users
                </div>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.create-admin') ? 'active' : '' }}" href="{{ route('admin.create-admin') }}">
                            <i class="bi bi-person-plus me-2"></i>
                            Create New Admin
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.manage-admins') ? 'active' : '' }}" href="{{ route('admin.manage-admins') }}">
                            <i class="bi bi-people-fill me-2"></i>
                            Manage Admins
                        </a>
                    </li>
                </ul>

                <!-- Roles Section -->
                <div class="nav-section">
                    <i class="bi bi-award me-1"></i> Roles
                </div>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.roles') ? 'active' : '' }}" href="{{ route('admin.roles') }}">
                            <i class="bi bi-list-ul me-2"></i>
                            List Roles
                        </a>
                    </li>
                </ul>

                <!-- Discord Section -->
                <div class="nav-section">
                    <i class="bi bi-discord me-1"></i> Discord
                </div>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.discord.chat') ? 'active' : '' }}" href="{{ route('admin.discord.chat') }}">
                            <i class="bi bi-chat-dots me-2"></i>
                            Discord Chat
                        </a>
                    </li>
                </ul>

                <!-- Topup Section -->
                <div class="nav-section">
                    <i class="bi bi-credit-card me-1"></i> Topup
                </div>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.topup.index') ? 'active' : '' }}" href="{{ route('admin.topup.index') }}">
                            <i class="bi bi-list-check me-2"></i>
                            Transactions
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.topup.management') ? 'active' : '' }}" href="{{ route('admin.topup.management') }}">
                            <i class="bi bi-gear me-2"></i>
                            Management
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- Main content -->
        <main class="col-md-9 ms-sm-auto col-lg-10 px-0 main-content">
            <!-- Top Navigation -->
            <nav class="navbar navbar-expand-lg navbar-light top-navbar px-4">
                <div class="container-fluid">
                    <button class="navbar-toggler d-md-none" type="button" data-bs-toggle="collapse" data-bs-target=".sidebar">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    
                    <div class="navbar-nav ms-auto d-flex align-items-center">
                        <!-- Dark Mode Toggle -->
                        <button class="theme-toggle me-3" id="themeToggle" title="Toggle dark mode">
                            <i class="bi bi-sun-fill icon" id="themeIcon"></i>
                            <span id="themeText">Light</span>
                        </button>
                        
                        <div class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown">
                                <i class="bi bi-person-circle me-2"></i>
                                {{ Auth::guard('admin')->user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <h6 class="dropdown-header">
                                        <i class="bi bi-info-circle me-1"></i>
                                        Account Info
                                    </h6>
                                </li>
                                <li><span class="dropdown-item-text">{{ Auth::guard('admin')->user()->username }}</span></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form action="{{ route('admin.logout') }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-danger" onclick="return confirm('Are you sure you want to logout?')">
                                            <i class="bi bi-box-arrow-right me-2"></i>
                                            Logout
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Page Content -->
            <div class="content-wrapper">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="bi bi-check-circle-fill me-2"></i>
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @yield('content')
            </div>
        </main>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
// Theme switching functionality
document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM loaded, looking for theme elements...');
    
    const themeToggle = document.getElementById('themeToggle');
    const themeIcon = document.getElementById('themeIcon');
    const themeText = document.getElementById('themeText');
    const html = document.documentElement;
    
    console.log('Theme toggle found:', themeToggle);
    console.log('Theme icon found:', themeIcon);
    console.log('Theme text found:', themeText);
    
    if (!themeToggle) {
        console.error('Theme toggle button not found!');
        return;
    }
    
    // Get saved theme from localStorage or default to 'light'
    const currentTheme = localStorage.getItem('admin-theme') || 'light';
    console.log('Initial theme loaded:', currentTheme);
    html.setAttribute('data-bs-theme', currentTheme);
    updateThemeUI(currentTheme);
    
    // Theme toggle click handler
    themeToggle.addEventListener('click', function() {
        console.log('Theme toggle clicked!');
        const currentTheme = html.getAttribute('data-bs-theme');
        const newTheme = currentTheme === 'light' ? 'dark' : 'light';
        
        console.log('Switching from', currentTheme, 'to', newTheme);
        
        html.setAttribute('data-bs-theme', newTheme);
        localStorage.setItem('admin-theme', newTheme);
        updateThemeUI(newTheme);
        
        console.log('Theme updated to:', newTheme);
    });
    
    // Update theme toggle button UI
    function updateThemeUI(theme) {
        console.log('Updating theme UI to:', theme);
        if (theme === 'dark') {
            themeIcon.className = 'bi bi-moon-fill icon';
            themeText.textContent = 'Dark';
            themeToggle.title = 'Switch to light mode';
            themeToggle.classList.add('active');
        } else {
            themeIcon.className = 'bi bi-sun-fill icon';
            themeText.textContent = 'Light';
            themeToggle.title = 'Switch to dark mode';
            themeToggle.classList.remove('active');
        }
    }
    
    // Apply theme to Bootstrap components
    function applyBootstrapTheme() {
        const theme = html.getAttribute('data-bs-theme');
        console.log('Applying Bootstrap theme:', theme);
        if (theme === 'dark') {
            document.body.classList.add('dark-mode');
            // Force some dark mode styles for testing
            document.body.style.backgroundColor = '#1a1a1a';
            document.body.style.color = '#ffffff';
        } else {
            document.body.classList.remove('dark-mode');
            // Reset to light mode
            document.body.style.backgroundColor = '';
            document.body.style.color = '';
        }
    }
    
    // Initial theme application
    applyBootstrapTheme();
    
    // Watch for theme changes and apply Bootstrap theme
    const observer = new MutationObserver(function(mutations) {
        mutations.forEach(function(mutation) {
            if (mutation.type === 'attributes' && mutation.attributeName === 'data-bs-theme') {
                applyBootstrapTheme();
            }
        });
    });
    
    observer.observe(html, {
        attributes: true,
        attributeFilter: ['data-bs-theme']
    });
});
</script>

@stack('scripts')
</body>
</html>