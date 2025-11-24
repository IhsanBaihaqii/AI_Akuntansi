<?php
require_once "config.php";

// Redirect jika sudah login
if (isset($_SESSION['username'])) {
    header('Location: dashboard.php');
    exit();
}

// Check for login error
$login_error = isset($_GET['error']);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aishan AI - Sistem Akuntansi Berbasis AI</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #6366f1;
            --primary-dark: #4f46e5;
            --secondary: #94a3b8;
            --dark-bg: #0f172a;
            --dark-card: #1e293b;
            --dark-border: #334155;
            --text-light: #f1f5f9;
            --text-muted: #94a3b8;
            --success: #10b981;
            --warning: #f59e0b;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Inter", "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
            color: var(--text-light);
            min-height: 100vh;
            line-height: 1.6;
            overflow-x: hidden;
        }
        
        /* Header & Navigation */
        header {
            background-color: rgba(30, 41, 59, 0.95);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid var(--dark-border);
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
        }
        
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 2rem;
            max-width: 1200px;
            margin: 0 auto;
        }
        
        .logo {
            display: flex;
            align-items: center;
            gap: 12px;
            z-index: 1001;
        }
        
        .logo-icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .logo i {
            color: white;
            font-size: 1.3rem;
        }
        
        .logo h1 {
            font-size: 1.5rem;
            font-weight: 700;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        
        .nav-links {
            display: flex;
            list-style: none;
            gap: 2rem;
            align-items: center;
        }
        
        .nav-links a {
            color: var(--text-light);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s;
            padding: 0.5rem 1rem;
            border-radius: 8px;
        }
        
        .nav-links a:hover {
            color: var(--primary);
            background-color: rgba(99, 102, 241, 0.1);
        }
        
        .nav-links .login-btn {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            transition: all 0.3s;
        }
        
        .nav-links .login-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(99, 102, 241, 0.4);
            background: linear-gradient(135deg, var(--primary-dark), var(--primary));
        }
        
        /* Mobile Sidebar */
        .mobile-sidebar {
            position: fixed;
            top: 0;
            right: -100%;
            width: 280px;
            height: 100vh;
            background: var(--dark-card);
            border-left: 1px solid var(--dark-border);
            z-index: 999;
            transition: right 0.3s ease;
            padding: 80px 2rem 2rem;
            overflow-y: auto;
        }
        
        .mobile-sidebar.active {
            right: 0;
        }
        
        .mobile-nav-links {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 1rem;
            margin-bottom: 2rem;
        }
        
        .mobile-nav-links a {
            color: var(--text-light);
            text-decoration: none;
            font-weight: 500;
            padding: 1rem;
            border-radius: 8px;
            display: block;
            transition: all 0.3s;
        }
        
        .mobile-nav-links a:hover {
            background-color: rgba(99, 102, 241, 0.1);
            color: var(--primary);
        }
        
        .mobile-nav-links .login-btn {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
            text-align: center;
            margin-top: 1rem;
        }
        
        .social-links {
            display: flex;
            gap: 1rem;
            justify-content: center;
            margin-top: 2rem;
            padding-top: 2rem;
            border-top: 1px solid var(--dark-border);
        }
        
        .social-link {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            background: var(--dark-bg);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-light);
            text-decoration: none;
            transition: all 0.3s;
            font-size: 1.2rem;
        }
        
        .social-link:hover {
            background: var(--primary);
            transform: translateY(-2px);
        }
        
        .social-link.instagram:hover {
            background: linear-gradient(45deg, #f09433, #e6683c, #dc2743, #cc2366, #bc1888);
        }
        
        .social-link.telegram:hover {
            background: #0088cc;
        }
        
        .social-link.tiktok:hover {
            background: #000000;
        }
        
        .hamburger {
            display: none;
            flex-direction: column;
            cursor: pointer;
            gap: 4px;
            z-index: 1001;
            padding: 8px;
        }
        
        .hamburger div {
            width: 25px;
            height: 3px;
            background-color: var(--text-light);
            transition: 0.3s;
            border-radius: 2px;
        }
        
        .hamburger.active div:nth-child(1) {
            transform: rotate(45deg) translate(6px, 6px);
        }
        
        .hamburger.active div:nth-child(2) {
            opacity: 0;
        }
        
        .hamburger.active div:nth-child(3) {
            transform: rotate(-45deg) translate(6px, -6px);
        }
        
        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 998;
            display: none;
        }
        
        .overlay.active {
            display: block;
        }
        
        /* Hero Section */
        .hero {
            padding: 120px 1rem 80px;
            max-width: 1200px;
            margin: 0 auto;
            text-align: center;
        }
        
        .hero-content {
            max-width: 800px;
            margin: 0 auto;
        }
        
        .hero h2 {
            font-size: clamp(2rem, 5vw, 3.5rem);
            font-weight: 800;
            margin-bottom: 1.5rem;
            background: linear-gradient(135deg, var(--primary), #8b5cf6);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            line-height: 1.2;
        }
        
        .hero p {
            font-size: clamp(1rem, 3vw, 1.25rem);
            color: var(--text-muted);
            margin-bottom: 2.5rem;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }
        
        .cta-buttons {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
        }
        
        .btn {
            padding: 1rem 2rem;
            border-radius: 10px;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s;
            border: none;
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
        }
        
        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(99, 102, 241, 0.4);
        }
        
        .btn-outline {
            background: transparent;
            color: var(--text-light);
            border: 2px solid var(--dark-border);
        }
        
        .btn-outline:hover {
            border-color: var(--primary);
            background-color: rgba(99, 102, 241, 0.1);
        }
        
        /* Features Section */
        .features {
            padding: 80px 1rem;
            background-color: rgba(15, 23, 42, 0.7);
        }
        
        .section-title {
            text-align: center;
            font-size: clamp(2rem, 5vw, 2.5rem);
            font-weight: 700;
            margin-bottom: 3rem;
            color: var(--text-light);
        }
        
        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(min(300px, 100%), 1fr));
            gap: 2rem;
            max-width: 1200px;
            margin: 0 auto;
        }
        
        .feature-card {
            background: var(--dark-card);
            border: 1px solid var(--dark-border);
            border-radius: 12px;
            padding: 2rem;
            text-align: center;
            transition: all 0.3s;
        }
        
        .feature-card:hover {
            transform: translateY(-5px);
            border-color: var(--primary);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        }
        
        .feature-icon {
            width: 70px;
            height: 70px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            margin: 0 auto 1.5rem;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
        }
        
        .feature-card h3 {
            font-size: 1.5rem;
            margin-bottom: 1rem;
            color: var(--text-light);
        }
        
        .feature-card p {
            color: var(--text-muted);
            line-height: 1.6;
        }
        
        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            z-index: 2000;
            align-items: center;
            justify-content: center;
            padding: 1rem;
        }
        
        .modal.active {
            display: flex;
        }
        
        .modal-content {
            background-color: var(--dark-card);
            border-radius: 16px;
            padding: 2rem;
            width: 100%;
            max-width: 400px;
            border: 1px solid var(--dark-border);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4);
            position: relative;
            animation: modalSlideIn 0.3s ease;
        }
        
        @keyframes modalSlideIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .modal-header {
            text-align: center;
            margin-bottom: 1.5rem;
        }
        
        .modal-title {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            color: var(--text-light);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }
        
        .modal-subtitle {
            color: var(--text-muted);
            font-size: 0.9rem;
        }
        
        .modal-close {
            position: absolute;
            top: 1rem;
            right: 1rem;
            background: none;
            border: none;
            color: var(--text-muted);
            font-size: 1.25rem;
            cursor: pointer;
            padding: 5px;
            border-radius: 6px;
            transition: all 0.2s;
        }
        
        .modal-close:hover {
            background-color: rgba(239, 68, 68, 0.1);
            color: #ef4444;
        }
        
        .form-group {
            margin-bottom: 1.25rem;
        }
        
        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: var(--text-light);
            font-size: 0.9rem;
        }
        
        .form-input {
            width: 100%;
            padding: 0.875rem;
            border-radius: 8px;
            border: 1px solid var(--dark-border);
            background-color: rgba(15, 23, 42, 0.8);
            color: var(--text-light);
            font-size: 0.95rem;
            transition: border-color 0.3s;
        }
        
        .form-input:focus {
            outline: none;
            border-color: var(--primary);
        }
        
        .modal-footer {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
            margin-top: 1.5rem;
        }
        
        .btn-full {
            width: 100%;
            justify-content: center;
        }
        
        .register-link {
            text-align: center;
            margin-top: 1.25rem;
            color: var(--text-muted);
            font-size: 0.9rem;
        }
        
        .register-link a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 500;
        }
        
        .register-link a:hover {
            text-decoration: underline;
        }
        
        .loading-spinner {
            display: none;
            width: 20px;
            height: 20px;
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-top: 2px solid white;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin-right: 8px;
        }
        
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        
        .error-message {
            color: #ef4444;
            font-size: 0.875rem;
            margin-top: 0.5rem;
            text-align: center;
            display: <?php echo $login_error ? "block" : "none"?>;
        }
        
        /* Footer */
        footer {
            background-color: var(--dark-card);
            border-top: 1px solid var(--dark-border);
            padding: 3rem 1rem;
            text-align: center;
        }
        
        .footer-content {
            max-width: 1200px;
            margin: 0 auto;
        }
        
        .footer-links {
            display: flex;
            justify-content: center;
            gap: 2rem;
            margin-bottom: 2rem;
            flex-wrap: wrap;
        }
        
        .footer-links a {
            color: var(--text-muted);
            text-decoration: none;
            transition: color 0.3s;
            font-size: 0.9rem;
        }
        
        .footer-links a:hover {
            color: var(--primary);
        }
        
        .copyright {
            color: var(--text-muted);
            font-size: 0.875rem;
        }
        
        /* Responsive Styles */
        @media (max-width: 768px) {
            .nav-links {
                display: none;
            }
            
            .hamburger {
                display: flex;
            }
            
            .hero {
                padding: 100px 1rem 60px;
            }
            
            .cta-buttons {
                flex-direction: column;
                align-items: center;
            }
            
            .btn {
                width: 100%;
                max-width: 300px;
                justify-content: center;
            }
            
            .features {
                padding: 60px 1rem;
            }
            
            .modal-content {
                padding: 1.5rem;
                max-width: 350px;
            }
        }
        
        @media (max-width: 480px) {
            .navbar {
                padding: 1rem;
            }
            
            .hero h2 {
                font-size: 2rem;
            }
            
            .features-grid {
                grid-template-columns: 1fr;
            }
            
            .mobile-sidebar {
                width: 100%;
            }
            
            .modal-content {
                padding: 1.25rem;
                margin: 1rem;
            }
        }
    </style>
</head>
<body>
    <!-- Header & Navigation -->
    <header>
        <nav class="navbar">
            <div class="logo">
                <div class="logo-icon">
                    <i class="fas fa-brain"></i>
                </div>
                <h1>Aishan AI</h1>
            </div>
            
            <ul class="nav-links">
                <li><a href="#home">Home</a></li>
                <li><a href="#features">Features</a></li>
                <li><a href="#about">About</a></li>
                <li><a href="#contact">Contact</a></li>
                <li><a href="#" class="login-btn" id="navLoginBtn">
                    <i class="fas fa-sign-in-alt"></i>
                    Login
                </a></li>
            </ul>
            
            <div class="hamburger" id="hamburger">
                <div></div>
                <div></div>
                <div></div>
            </div>
        </nav>
    </header>

    <!-- Mobile Sidebar -->
    <div class="mobile-sidebar" id="mobileSidebar">
        <ul class="mobile-nav-links">
            <li><a href="#home">Home</a></li>
            <li><a href="#features">Features</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#contact">Contact</a></li>
            <li><a href="#" class="login-btn" id="mobileLoginBtn">
                <i class="fas fa-sign-in-alt"></i>
                Login
            </a></li>
        </ul>
        
        <div class="social-links">
            <a href="https://instagram.com/ihsaanbaihaqi" class="social-link instagram" target="_blank">
                <i class="fab fa-instagram"></i>
            </a>
            <a href="https://t.me/SaanModz" class="social-link telegram" target="_blank">
                <i class="fab fa-telegram"></i>
            </a>
            <a href="https://tiktok.com/@SaanModz" class="social-link tiktok" target="_blank">
                <i class="fab fa-tiktok"></i>
            </a>
        </div>
    </div>

    <!-- Overlay for mobile sidebar -->
    <div class="overlay" id="overlay"></div>

    <!-- Hero Section -->
    <section class="hero" id="home">
        <div class="hero-content">
            <h2>Transformasi Akuntansi dengan Kecerdasan Buatan</h2>
            <p>Sistem akuntansi berbasis AI yang membantu Anda mengelola keuangan bisnis dengan lebih efisien, akurat, dan otomatis.</p>
            <div class="cta-buttons">
                <a href="#" class="btn btn-primary" id="heroLoginBtn">
                    <i class="fas fa-rocket"></i>
                    Mulai Sekarang
                </a>
                <a href="#features" class="btn btn-outline">
                    <i class="fas fa-play-circle"></i>
                    Lihat Demo
                </a>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features" id="features">
        <h2 class="section-title">Fitur Unggulan</h2>
        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-robot"></i>
                </div>
                <h3>AI Assistant</h3>
                <p>Asisten AI yang membantu proses pencatatan transaksi dan pembuatan laporan keuangan secara otomatis.</p>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-chart-line"></i>
                </div>
                <h3>Analisis Real-time</h3>
                <p>Pantau kesehatan keuangan bisnis Anda dengan analisis dan dashboard yang update secara real-time.</p>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-file-invoice-dollar"></i>
                </div>
                <h3>Laporan Otomatis</h3>
                <p>Generate laporan keuangan lengkap seperti neraca, laba rugi, dan arus kas dengan satu klik.</p>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="footer-content">
            <div class="footer-links">
                <a href="#privacy">Privacy Policy</a>
                <a href="#terms">Terms of Service</a>
                <a href="#support">Support</a>
                <a href="#docs">Documentation</a>
            </div>
            <p class="copyright">&copy; 2024 Aishan AI. All rights reserved.</p>
        </div>
    </footer>

    <!-- Login Modal -->
    <div class="modal <?php echo $login_error ? 'active' : ''; ?>" id="loginModal">
        <div class="modal-content">
            <button class="modal-close" id="modalClose">
                <i class="fas fa-times"></i>
            </button>
            
            <div class="modal-header">
                <h3 class="modal-title">
                    <i class="fas fa-sign-in-alt"></i>
                    Login ke Aishan AI
                </h3>
                <p class="modal-subtitle">Masuk untuk mengakses dashboard akuntansi Anda</p>
            </div>
            
            <form id="loginForm" method="POST" action="login.php">
                <div class="form-group">
                    <label class="form-label">Username</label>
                    <input type="text" class="form-input" name="username" placeholder="Masukkan username" required value="admin">
                </div>
                
                <div class="form-group">
                    <label class="form-label">Password</label>
                    <input type="password" class="form-input" name="password" placeholder="Masukkan password" required value="password123">
                </div>
                
                <div class="error-message" id="errorMessage">
                    Username atau password salah!
                </div>
                
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-full" id="submitBtn">
                        <div class="loading-spinner" id="loadingSpinner"></div>
                        <i class="fas fa-paper-plane"></i>
                        Login
                    </button>
                    <button type="button" class="btn btn-outline btn-full" id="cancelLoginBtn">
                        <i class="fas fa-times"></i>
                        Cancel
                    </button>
                </div>
            </form>
            
            <div class="register-link">
                Don't have an account? <a href="#" id="registerLink">Buat akun baru</a>
            </div>
        </div>
    </div>

    <script>
        // Mobile sidebar elements
        const hamburger = document.getElementById('hamburger');
        const mobileSidebar = document.getElementById('mobileSidebar');
        const overlay = document.getElementById('overlay');

        // Modal elements
        const loginModal = document.getElementById('loginModal');
        const modalClose = document.getElementById('modalClose');
        const cancelLoginBtn = document.getElementById('cancelLoginBtn');
        const loginForm = document.getElementById('loginForm');
        const registerLink = document.getElementById('registerLink');
        const submitBtn = document.getElementById('submitBtn');
        const loadingSpinner = document.getElementById('loadingSpinner');
        const errorMessage = document.getElementById('errorMessage');
        
        // Buttons to open modal
        const navLoginBtn = document.getElementById('navLoginBtn');
        const heroLoginBtn = document.getElementById('heroLoginBtn');
        const mobileLoginBtn = document.getElementById('mobileLoginBtn');
        
        // Mobile sidebar functions
        function openMobileSidebar() {
            mobileSidebar.classList.add('active');
            overlay.classList.add('active');
            hamburger.classList.add('active');
            document.body.style.overflow = 'hidden';
        }
        
        function closeMobileSidebar() {
            mobileSidebar.classList.remove('active');
            overlay.classList.remove('active');
            hamburger.classList.remove('active');
            document.body.style.overflow = '';
        }
        
        // Open modal function
        function openLoginModal() {
            loginModal.classList.add('active');
            document.body.style.overflow = 'hidden';
            // Reset form and error message
            loginForm.reset();
            //errorMessage.style.display = 'none';
        }
        
        // Close modal function
        function closeLoginModal() {
            loginModal.classList.remove('active');
            document.body.style.overflow = '';
            // Reset loading state
            submitBtn.disabled = false;
            loadingSpinner.style.display = 'none';
        }
        
        // Event listeners for mobile sidebar
        hamburger.addEventListener('click', () => {
            if (mobileSidebar.classList.contains('active')) {
                closeMobileSidebar();
            } else {
                openMobileSidebar();
            }
        });
        
        overlay.addEventListener('click', closeMobileSidebar);
        
        // Close mobile sidebar when clicking on links
        document.querySelectorAll('.mobile-nav-links a').forEach(link => {
            link.addEventListener('click', (e) => {
                if (!link.classList.contains('login-btn')) {
                    closeMobileSidebar();
                }
            });
        });
        
        // Event listeners for opening modal
        navLoginBtn.addEventListener('click', (e) => {
            e.preventDefault();
            openLoginModal();
        });
        
        heroLoginBtn.addEventListener('click', (e) => {
            e.preventDefault();
            openLoginModal();
        });
        
        mobileLoginBtn.addEventListener('click', (e) => {
            e.preventDefault();
            closeMobileSidebar();
            openLoginModal();
        });
        
        // Event listeners for closing modal
        modalClose.addEventListener('click', closeLoginModal);
        cancelLoginBtn.addEventListener('click', closeLoginModal);
        
        // Form submission
        loginForm.addEventListener('submit', (e) => {
            // Show loading state
            submitBtn.disabled = true;
            loadingSpinner.style.display = 'inline-block';
            errorMessage.style.display = 'none';
            
            // Form will submit normally to login.php
            // PHP will handle the redirect
        });
        
        // Register link
        registerLink.addEventListener('click', (e) => {
            e.preventDefault();
            alert('Fitur pendaftaran akun akan segera tersedia!');
        });
        
        // Close modal when clicking outside
        loginModal.addEventListener('click', (e) => {
            if (e.target === loginModal) {
                closeLoginModal();
            }
        });
        
        // Close sidebar on escape key
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                closeMobileSidebar();
                closeLoginModal();
            }
        });

        // Auto-open modal if there's login error
        <?php if ($login_error): ?>
        document.addEventListener('DOMContentLoaded', function() {
            openLoginModal();
        });
        <?php endif; ?>
    </script>
</body>
</html>