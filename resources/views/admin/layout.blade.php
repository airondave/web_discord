<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel') - Random Community</title>
    
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
        .sidebar {
            background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
            min-height: 100vh;
            box-shadow: 2px 0 10px rgba(0,0,0,0.1);
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
            background: #f8f9fa;
            min-height: 100vh;
        }
        .top-navbar {
            background: white;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            border-bottom: 1px solid #e9ecef;
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
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            border-radius: 10px;
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
                    
                    <div class="navbar-nav ms-auto">
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
@stack('scripts')
</body>
</html>