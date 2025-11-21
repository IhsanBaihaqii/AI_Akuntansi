<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard - Aishan AI</title>
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
        --sidebar-width: 260px;
        --header-height: 70px;
        --footer-height: 80px;
      }
      
      * {
          margin: 0;
          padding: 0;
          box-sizing: border-box;
          font-family: "Inter", "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
      }
      
      body {
          background-color: var(--dark-bg);
          color: var(--text-light);
          min-height: 100vh;
          display: flex;
          flex-direction: column;
      }
      
      /* Header Styles */
      header {
          background-color: var(--dark-card);
          display: flex;
          justify-content: space-between;
          align-items: center;
          padding: 0 30px;
          height: var(--header-height);
          border-bottom: 1px solid var(--dark-border);
          position: sticky;
          top: 0;
          z-index: 100;
      }
      
      .logo {
          display: flex;
          align-items: center;
          gap: 12px;
      }
      
      .logo-icon {
          width: 36px;
          height: 36px;
          border-radius: 10px;
          background: linear-gradient(135deg, var(--primary), var(--primary-dark));
          display: flex;
          align-items: center;
          justify-content: center;
      }
      
      .logo i {
          color: white;
          font-size: 1.2rem;
      }
      
      .logo h1 {
          font-size: 1.5rem;
          font-weight: 700;
          background: linear-gradient(135deg, var(--primary), var(--primary-dark));
          -webkit-background-clip: text;
          -webkit-text-fill-color: transparent;
      }
      
      .user-info {
          display: flex;
          align-items: center;
          gap: 15px;
      }
      
      .user-avatar {
          width: 42px;
          height: 42px;
          border-radius: 50%;
          background: linear-gradient(135deg, var(--primary), var(--primary-dark));
          color: white;
          display: flex;
          align-items: center;
          justify-content: center;
          font-weight: bold;
          border: 2px solid var(--dark-border);
      }
      
      .hamburger {
          display: none;
          flex-direction: column;
          cursor: pointer;
          gap: 4px;
      }
      
      .hamburger div {
          width: 25px;
          height: 3px;
          background-color: var(--text-light);
          transition: 0.3s;
          border-radius: 2px;
      }
      
      /* Main Layout */
      .main-container {
          display: flex;
          flex: 1;
          padding-bottom: var(--footer-height);
      }
      
      /* Sidebar Styles */
      .sidebar {
          width: var(--sidebar-width);
          background-color: var(--dark-card);
          border-right: 1px solid var(--dark-border);
          height: calc(100vh - var(--header-height));
          position: sticky;
          top: var(--header-height);
          overflow-y: auto;
          transition: transform 0.3s ease;
          margin-bottom: -100rem;
      }
      
      .sidebar-menu {
          padding: 25px 0;
      }
      
      .menu-section {
          margin-bottom: 30px;
      }
      
      .menu-title {
          padding: 10px 25px;
          font-size: 0.75rem;
          color: var(--text-muted);
          font-weight: 600;
          text-transform: uppercase;
          letter-spacing: 1px;
      }
      
      .menu-item {
          padding: 14px 25px;
          display: flex;
          align-items: center;
          gap: 12px;
          color: var(--text-light);
          text-decoration: none;
          transition: all 0.2s;
          border-left: 3px solid transparent;
          margin: 5px 0;
      }
      
      .menu-item:hover {
          background-color: rgba(99, 102, 241, 0.1);
          border-left-color: var(--primary);
          color: var(--primary);
      }
      
      .menu-item.active {
          background-color: rgba(99, 102, 241, 0.15);
          border-left-color: var(--primary);
          color: var(--primary);
      }
      
      .menu-item i {
          width: 20px;
          text-align: center;
          font-size: 1.1rem;
      }
      
      /* Content Area */
      .content {
          flex: 1;
          padding: 30px;
          overflow-y: auto;
      }
      
      .page-header {
          display: flex;
          flex-direction: column;
          margin-bottom: 30px;
      }
      
      .page-title {
          display: flex;
          align-items: center;
      }
      .page-title h2, .page-title i {
          font-size: 1.8rem;
          font-weight: 700;
          margin-bottom: 8px;
          margin-right: 4px;
      }
      
      .page-title p {
          color: var(--text-muted);
          font-size: 1rem;
      }
      
      .stats-cards {
          display: grid;
          grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
          gap: 20px;
          margin-bottom: 30px;
      }
      
      .stat-card {
          background-color: var(--dark-card);
          border-radius: 12px;
          padding: 24px;
          border: 1px solid var(--dark-border);
          transition: transform 0.3s, box-shadow 0.3s;
          position: relative;
          overflow: hidden;
      }
      
      .stat-card::before {
          content: '';
          position: absolute;
          top: 0;
          left: 0;
          width: 4px;
          height: 100%;
          background: linear-gradient(to bottom, var(--primary), var(--primary-dark));
      }
      
      .stat-card:hover {
          transform: translateY(-5px);
          box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
      }
      
      .stat-header {
          display: flex;
          justify-content: space-between;
          align-items: flex-start;
          margin-bottom: 15px;
      }
      
      .stat-icon {
          width: 44px;
          height: 44px;
          border-radius: 10px;
          display: flex;
          align-items: center;
          justify-content: center;
          font-size: 1.3rem;
          background-color: rgba(99, 102, 241, 0.1);
          color: var(--primary);
      }
      
      .stat-trend {
          font-size: 0.85rem;
          font-weight: 600;
          display: flex;
          align-items: center;
          gap: 4px;
      }
      
      .trend-up {
          color: #10b981;
      }
      
      .trend-down {
          color: #ef4444;
      }
      
      .stat-value {
          font-size: 1.8rem;
          font-weight: 700;
          margin-bottom: 5px;
      }
      
      .stat-label {
          color: var(--text-muted);
          font-size: 0.9rem;
      }
      
      .content-section {
          background-color: var(--dark-card);
          border-radius: 12px;
          padding: 24px;
          border: 1px solid var(--dark-border);
          margin-bottom: 30px;
      }
      
      .section-header {
          display: flex;
          justify-content: space-between;
          align-items: center;
          margin-bottom: 20px;
      }
      
      .section-title {
          font-size: 1.3rem;
          font-weight: 600;
      }
      
      .section-actions {
          display: flex;
          gap: 10px;
      }
      
      .btn {
          padding: 8px 16px;
          border-radius: 8px;
          font-weight: 500;
          font-size: 0.9rem;
          cursor: pointer;
          transition: all 0.2s;
          border: none;
          display: flex;
          align-items: center;
          gap: 8px;
      }
      
      .btn-primary {
          background-color: var(--primary);
          color: white;
      }
      
      .btn-primary:hover {
          background-color: var(--primary-dark);
      }
      
      .btn-outline {
          background-color: transparent;
          color: var(--text-light);
          border: 1px solid var(--dark-border);
      }
      
      .btn-outline:hover {
          background-color: rgba(255, 255, 255, 0.05);
      }

      .btn-warning{
        background-color: #f59e0b;
        color: white;
      }
      .btn-warning:hover{
          background-color: #faaf2fff;
      }
      
      .table-container {
          overflow-x: auto;
      }
      
      table {
          width: 100%;
          border-collapse: collapse;
      }
      
      th {
          text-align: left;
          padding: 12px 16px;
          font-weight: 600;
          color: var(--text-muted);
          border-bottom: 1px solid var(--dark-border);
          font-size: 0.9rem;
      }
      
      td {
          padding: 16px;
          border-bottom: 1px solid var(--dark-border);
          font-size: 0.95rem;
      }
      
      tr:last-child td {
          border-bottom: none;
      }
      
      .status-badge {
          padding: 6px 12px;
          border-radius: 20px;
          font-size: 0.8rem;
          font-weight: 500;
          display: inline-block;
      }
      
      .status-completed {
          background-color: rgba(16, 185, 129, 0.1);
          color: #10b981;
      }
      
      .status-pending {
          background-color: rgba(245, 158, 11, 0.1);
          color: #f59e0b;
      }
      
      .status-processing {
          background-color: rgba(99, 102, 241, 0.1);
          color: var(--primary);
      }
      
      /* Quick Actions */
      .quick-actions {
          display: grid;
          grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
          gap: 16px;
          margin-top: 20px;
      }
      
      .action-card {
          background-color: var(--dark-card);
          border: 1px solid var(--dark-border);
          border-radius: 10px;
          padding: 20px;
          display: flex;
          flex-direction: column;
          align-items: center;
          text-align: center;
          transition: all 0.2s;
          cursor: pointer;
      }
      
      .action-card:hover {
          transform: translateY(-3px);
          border-color: var(--primary);
          box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
      }
      
      .action-icon {
          width: 50px;
          height: 50px;
          border-radius: 12px;
          display: flex;
          align-items: center;
          justify-content: center;
          font-size: 1.5rem;
          margin-bottom: 12px;
          background-color: rgba(99, 102, 241, 0.1);
          color: var(--primary);
      }
      
      .action-title {
          font-weight: 600;
          margin-bottom: 5px;
      }
      
      .action-desc {
          font-size: 0.85rem;
          color: var(--text-muted);
      }
      
      /* Footer Styles - Improved Horizontal Scroll */
      footer {
          position: fixed;
          bottom: 0;
          width: calc(100% - var(--sidebar-width));
          left: var(--sidebar-width);
          background-color: var(--dark-card);
          border-top: 1px solid var(--dark-border);
          height: var(--footer-height);
          z-index: 90;
          overflow-x: auto;
          overflow-y: hidden;
      }
      
      .footer-container {
          display: flex;
          height: 100%;
          align-items: center;
          padding: 0 20px;
          min-width: max-content;
      }
      
      .footer-nav {
          display: flex;
          gap: 25px;
          height: 100%;
          align-items: center;
      }
      
      .footer-menu-item {
          display: flex;
          flex-direction: column;
          align-items: center;
          text-decoration: none;
          color: var(--text-muted);
          padding: 12px 16px;
          border-radius: 8px;
          transition: all 0.2s;
          min-width: 90px;
          flex-shrink: 0;
          height: 65px;
          justify-content: center;
      }
      
      .footer-menu-item:hover {
          background-color: rgba(99, 102, 241, 0.1);
          color: var(--primary);
          transform: translateY(-2px);
      }
      
      .footer-menu-item.active {
          background-color: rgba(99, 102, 241, 0.15);
          color: var(--primary);
          border-bottom: 2px solid var(--primary);
      }
      
      .footer-menu-item i {
          font-size: 1.3rem;
          margin-bottom: 6px;
      }
      
      .footer-menu-item span {
          font-size: 0.75rem;
          font-weight: 500;
          text-align: center;
          line-height: 1.2;
      }
      
      /* Custom Scrollbar for Footer */
      footer::-webkit-scrollbar {
          height: 6px;
      }
      
      footer::-webkit-scrollbar-track {
          background: var(--dark-border);
      }
      
      footer::-webkit-scrollbar-thumb {
          background: var(--primary);
          border-radius: 3px;
      }
      
      footer::-webkit-scrollbar-thumb:hover {
          background: var(--primary-dark);
      }
      
      /* Scroll Indicators */
      .scroll-indicator {
          position: absolute;
          top: 50%;
          transform: translateY(-50%);
          width: 30px;
          height: 30px;
          background: rgba(99, 102, 241, 0.8);
          border-radius: 50%;
          display: flex;
          align-items: center;
          justify-content: center;
          color: white;
          cursor: pointer;
          z-index: 91;
          opacity: 0;
          transition: opacity 0.3s;
      }
      
      .scroll-left {
          left: 10px;
      }
      
      .scroll-right {
          right: 10px;
      }
      
      footer:hover .scroll-indicator {
          opacity: 1;
      }
      
      /* Responsive Styles */
      @media (max-width: 992px) {
          .sidebar {
              position: fixed;
              transform: translateX(-100%);
              z-index: 99;
              height: 85vh;
              top: var(--header-height);
          }
          
          .sidebar.open {
              transform: translateX(0);
          }
          
          .hamburger {
              display: flex;
          }
          
          .overlay {
              position: fixed;
              top: 0;
              left: 0;
              width: 100%;
              height: 100%;
              background-color: rgba(0,0,0,0.7);
              z-index: 98;
              display: none;
          }
          
          .overlay.active {
              display: block;
          }
          
          .content {
              padding: 20px;
          }
          
          footer {
              width: 100%;
              left: 0;
          }
          
          .footer-container {
              padding: 0 15px;
          }
          
          .footer-nav {
              gap: 20px;
          }
          
          .footer-menu-item {
              min-width: 80px;
              padding: 10px 14px;
          }
      }
      
      @media (max-width: 768px) {
          .stats-cards {
              grid-template-columns: 1fr;
          }
          
          .page-header {
              flex-direction: column;
              align-items: flex-start;
              gap: 15px;
          }
          
          .section-header {
              flex-direction: column;
              align-items: flex-start;
              gap: 15px;
          }
          
          .section-actions {
              width: 100%;
              justify-content: space-between;
          }
          
          .quick-actions {
              grid-template-columns: repeat(2, 1fr);
          }
          
          .footer-nav {
              gap: 15px;
          }
          
          .footer-menu-item {
              min-width: 75px;
              padding: 8px 12px;
              height: 60px;
          }
          
          .footer-menu-item i {
              font-size: 1.2rem;
          }
          
          .footer-menu-item span {
              font-size: 0.7rem;
          }
      }
      
      @media (max-width: 576px) {
          .quick-actions {
              grid-template-columns: 1fr;
          }
          
          header {
              padding: 0 20px;
          }
          
          .content {
              padding: 15px;
          }
          
          .footer-container {
              padding: 0 10px;
          }
          
          .footer-nav {
              gap: 12px;
          }
          
          .footer-menu-item {
              min-width: 70px;
              padding: 6px 10px;
              height: 55px;
          }
          
          .footer-menu-item i {
              font-size: 1.1rem;
              margin-bottom: 4px;
          }
          
          .footer-menu-item span {
              font-size: 0.65rem;
          }
          
          .scroll-indicator {
              width: 25px;
              height: 25px;
              font-size: 0.8rem;
          }
      }
    </style>
  </head>
  <body>
    <!-- Header -->
    <header>
        <div class="logo">
            <div class="logo-icon">
                <i class="fas fa-brain"></i>
            </div>
            <h1>Aishan AI</h1>
        </div>
        
        <div class="user-info">
            <div class="user-avatar">
                <!-- <?php 
                    $username = $_SESSION['username'];
                    echo strtoupper(substr($username, 0, 1)); 
                ?> -->
                I
            </div>
            <span><?php echo htmlspecialchars($username); ?></span>
            <div class="hamburger">
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div>
    </header>
    
    <!-- Main Container -->
    <div class="main-container">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="sidebar-menu">
                <div class="menu-section">
                    <div class="menu-title">Main Menu</div>
                    <a href="dashboard.php" class="menu-item active">
                        <i class="fas fa-home"></i>
                        <span>Dashboard</span>
                    </a>
                </div>
                
                <div class="menu-section">
                    <div class="menu-title">Accounting</div>
                    <a href="journal.php" class="menu-item">
                        <i class="fas fa-book"></i>
                        <span>Journal Umum</span>
                    </a>
                    <a href="ledger.php" class="menu-item">
                        <i class="fas fa-file-invoice-dollar"></i>
                        <span>Buku Besar</span>
                    </a>
                    <a href="trial-balance.php" class="menu-item">
                        <i class="fas fa-balance-scale"></i>
                        <span>Neraca Saldo</span>
                    </a>
                    <a href="financial-statements.php" class="menu-item">
                        <i class="fas fa-chart-line"></i>
                        <span>Laporan Keuangan</span>
                    </a>
                </div>
                
                <div class="menu-section">
                    <div class="menu-title">Settings</div>
                    <a href="profile.php" class="menu-item">
                        <i class="fas fa-user-cog"></i>
                        <span>Profile</span>
                    </a>
                    <a href="language.php" class="menu-item">
                        <i class="fas fa-globe"></i>
                        <span>Bahasa</span>
                    </a>
                    <a href="logout.php" class="menu-item">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Logout</span>
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Overlay for mobile -->
        <div class="overlay"></div>
        
        <!-- Content Area -->
        <div class="content">
            <div class="page-header">
                <div class="page-title">
                    <i class="fas fa-robot"></i>
                    <h2>Aishan AI</h2>
                </div>
                <p>AI Akuntansi asisten berbasis AI yang dibuat untuk membantu pembuatan akuntansi</p>
            </div>
            
            <div class="content-section">
                <div class="section-header">
                    <h3 class="section-title">Recent Transactions</h3>
                    <div class="section-actions">
                        <button class="btn btn-warning">
                            <i class="fas fa-redo"></i>
                            Reset
                        </button>
                        <button class="btn btn-outline">
                            <i class="fas fa-download"></i>
                            Load
                        </button>
                        <button class="btn btn-primary">
                            <i class="fas fa-plus"></i>
                            Tambahkan
                        </button>
                    </div>
                </div>
                
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Description</th>
                                <th>Account</th>
                                <th>Debit</th>
                                <th>Credit</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>15 Mar 2023</td>
                                <td>Sales - Product A</td>
                                <td>Cash</td>
                                <td>Rp 5.000.000</td>
                                <td>-</td>
                                <td><span class="status-badge status-completed">Completed</span></td>
                            </tr>
                            <tr>
                                <td>14 Mar 2023</td>
                                <td>Office Supplies</td>
                                <td>Expenses</td>
                                <td>-</td>
                                <td>Rp 1.250.000</td>
                                <td><span class="status-badge status-completed">Completed</span></td>
                            </tr>
                            <tr>
                                <td>13 Mar 2023</td>
                                <td>Equipment Purchase</td>
                                <td>Fixed Assets</td>
                                <td>Rp 12.500.000</td>
                                <td>-</td>
                                <td><span class="status-badge status-processing">Processing</span></td>
                            </tr>
                            <tr>
                                <td>12 Mar 2023</td>
                                <td>Client Payment</td>
                                <td>Accounts Receivable</td>
                                <td>-</td>
                                <td>Rp 7.800.000</td>
                                <td><span class="status-badge status-completed">Completed</span></td>
                            </tr>
                            <tr>
                                <td>11 Mar 2023</td>
                                <td>Utility Bills</td>
                                <td>Expenses</td>
                                <td>-</td>
                                <td>Rp 2.350.000</td>
                                <td><span class="status-badge status-pending">Pending</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            
            <div class="content-section">
                <div class="section-header">
                    <h3 class="section-title">Quick Actions</h3>
                </div>
                
                <div class="quick-actions">
                    <div class="action-card">
                        <div class="action-icon">
                            <i class="fas fa-plus-circle"></i>
                        </div>
                        <div class="action-title">New Journal</div>
                        <div class="action-desc">Create new journal entry</div>
                    </div>
                    
                    <div class="action-card">
                        <div class="action-icon">
                            <i class="fas fa-file-invoice"></i>
                        </div>
                        <div class="action-title">View Ledger</div>
                        <div class="action-desc">Check account details</div>
                    </div>
                    
                    <div class="action-card">
                        <div class="action-icon">
                            <i class="fas fa-chart-pie"></i>
                        </div>
                        <div class="action-title">Reports</div>
                        <div class="action-desc">Generate financial reports</div>
                    </div>
                    
                    <div class="action-card">
                        <div class="action-icon">
                            <i class="fas fa-cog"></i>
                        </div>
                        <div class="action-title">Settings</div>
                        <div class="action-desc">Manage account settings</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Footer Navigation -->
    <footer>
        <div class="footer-nav">
            <a href="journal.php" class="footer-menu-item">
                <i class="fas fa-book"></i>
                <span>Journal Umum</span>
            </a>
            <a href="ledger.php" class="footer-menu-item">
                <i class="fas fa-file-invoice-dollar"></i>
                <span>Buku Besar</span>
            </a>
            <a href="trial-balance.php" class="footer-menu-item">
                <i class="fas fa-balance-scale"></i>
                <span>Neraca Saldo</span>
            </a>
            <a href="financial-statements.php" class="footer-menu-item">
                <i class="fas fa-chart-line"></i>
                <span>Laporan Keuangan</span>
            </a>
            <a href="adjusting.php" class="footer-menu-item">
                <i class="fas fa-adjust"></i>
                <span>Penyesuaian</span>
            </a>
            <a href="reports.php" class="footer-menu-item">
                <i class="fas fa-chart-bar"></i>
                <span>Laporan</span>
            </a>
            <a href="analytics.php" class="footer-menu-item">
                <i class="fas fa-chart-pie"></i>
                <span>Analytics</span>
            </a>
        </div>
    </footer>
    
    <script>
        const hamburger = document.querySelector('.hamburger');
        const sidebar = document.querySelector('.sidebar');
        const overlay = document.querySelector('.overlay');
        
        hamburger.addEventListener('click', () => {
            sidebar.classList.toggle('open');
            overlay.classList.toggle('active');
        });
        
        overlay.addEventListener('click', () => {
            sidebar.classList.remove('open');
            overlay.classList.remove('active');
        });
        
        // Highlight active menu item
        const currentPage = window.location.pathname.split('/').pop();
        const menuItems = document.querySelectorAll('.menu-item');
        const footerMenuItems = document.querySelectorAll('.footer-menu-item');
        
        menuItems.forEach(item => {
            const href = item.getAttribute('href');
            if (href === currentPage) {
                item.classList.add('active');
            } else {
                item.classList.remove('active');
            }
        });
        
        footerMenuItems.forEach(item => {
            const href = item.getAttribute('href');
            if (href === currentPage) {
                item.classList.add('active');
            } else {
                item.classList.remove('active');
            }
        });
    </script>
  </body>
</html>