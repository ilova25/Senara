<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile - Senara Guest House</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: #fff;
            color: #2c1810;
            min-height: 100vh;
        }

        header {
            padding: 20px 10%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #ccc;
        }

        header nav {
            display: flex;
            align-items: center;
            gap: 5px;
            margin-left: auto;
        }

        nav a {
            margin-left: 20px;
            text-decoration: none;
            color: #333;
            font-weight: 500;
        }

        nav a:hover,
        nav .active {
            color: #AF8F6F;
        }

        .profile-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #5A3B1F;
            transition: transform 0.3s ease;
        }

        .profile-avatar:hover {
            transform: scale(1.1);
        }

        .profile-wrapper {
            margin-left: 30px;
        }

        .user-menu {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, #5A3B1F, #AF8F6F);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            cursor: pointer;
            transition: transform 0.3s ease;
        }

        .user-avatar:hover {
            transform: scale(1.1);
        }

        /* Main Container - diperlebar untuk menyamakan dengan header */
        .main-container {
            width: 80%; /* Sama dengan padding header 10% kiri + 10% kanan = 80% width */
            margin: 3rem auto;
            padding: 0;
        }

        .profile-card {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 40px rgba(90, 59, 31, 0.15);
        }

        .profile-header {
            background: linear-gradient(135deg, #5A3B1F 0%, #8B6F47 100%);
            padding: 4rem 2rem 2rem; /* Ditambah tingginya dari 3rem menjadi 4rem, dan bottom dari 1rem menjadi 2rem */
            position: relative;
            color: white;
        }

        .profile-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="20" cy="20" r="1" fill="rgba(255,255,255,0.1)"/><circle cx="80" cy="40" r="0.5" fill="rgba(255,255,255,0.05)"/><circle cx="40" cy="80" r="1.5" fill="rgba(255,255,255,0.08)"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>') repeat;
            opacity: 0.3;
        }

        .edit-cover-btn {
            position: absolute;
            top: 1rem;
            right: 2rem;
            background: rgba(255, 255, 255, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.3);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 10px;
            cursor: pointer;
            font-size: 0.875rem;
            font-weight: 500;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
        }

        .edit-cover-btn:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: translateY(-2px);
        }

        .profile-main {
            display: flex;
            gap: 3rem;
            padding: 0 2rem 2rem;
            position: relative;
        }

        .profile-sidebar {
            flex: 0 0 300px;
            text-align: center;
        }

        .profile-avatar-large {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            background: linear-gradient(135deg, #5A3B1F, #AF8F6F);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 3rem;
            font-weight: 700;
            margin: -80px auto 1.5rem; /* Diubah dari -75px menjadi -100px untuk menyesuaikan tinggi header */
            border: 5px solid white;
            box-shadow: 0 5px 20px rgba(90, 59, 31, 0.3);
            position: relative;
        }

        .status-badge {
            position: absolute;
            bottom: 10px;
            right: 10px;
            width: 30px;
            height: 30px;
            background: #10b981;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 14px;
            border: 3px solid white;
        }

        .profile-name {
            font-size: 1.8rem;
            font-weight: 700;
            color: #2c1810;
            margin-bottom: 0.5rem;
        }

        .profile-email {
            color: #6b7280;
            margin-bottom: 0.5rem;
        }

        .profile-member-since {
            color: #AF8F6F;
            font-size: 0.9rem;
            font-weight: 500;
            margin-bottom: 2rem;
        }

        .stats-container {
            background: #f8f5f0;
            border-radius: 15px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }

        .stat-item {
            text-align: center;
        }

        .stat-number {
            font-size: 1.5rem;
            font-weight: 700;
            color: #5A3B1F;
            display: block;
        }

        .stat-label {
            font-size: 0.8rem;
            color: #6b7280;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-top: 0.25rem;
        }

        .loyalty-badge {
            background: linear-gradient(135deg, #f59e0b, #d97706);
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 25px;
            font-weight: 600;
            text-align: center;
            margin-bottom: 1rem;
        }

        /* Form Section */
        .form-section {
            flex: 1;
            background: white;
        }

        .tabs-container {
            border-bottom: 1px solid #e5e7eb;
            margin-bottom: 2rem;
        }

        .tabs {
            display: flex;
            gap: 0;
        }

        .tab {
            padding: 1rem 1.5rem;
            cursor: pointer;
            border-bottom: 3px solid transparent;
            color: #6b7280;
            font-weight: 500;
            transition: all 0.3s ease;
            position: relative;
        }

        .tab:hover {
            color: #5A3B1F;
            background: rgba(90, 59, 31, 0.05);
        }

        .tab.active {
            color: #5A3B1F;
            border-bottom-color: #5A3B1F;
            background: rgba(90, 59, 31, 0.05);
        }

        .form-content {
            padding: 1rem 0;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-group.full-width {
            grid-column: span 2;
        }

        .form-label {
            font-weight: 600;
            color: #2c1810;
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
        }

        .form-input, .form-select {
            padding: 1rem;
            border: 2px solid #e5e7eb;
            border-radius: 10px;
            font-size: 1rem;
            font-family: inherit;
            transition: all 0.3s ease;
            background: white;
        }

        .form-input:focus, .form-select:focus {
            outline: none;
            border-color: #5A3B1F;
            box-shadow: 0 0 0 3px rgba(90, 59, 31, 0.1);
        }

        .form-select {
            cursor: pointer;
            appearance: none;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%235A3B1F' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='m6 8 4 4 4-4'/%3e%3c/svg%3e");
            background-position: right 1rem center;
            background-repeat: no-repeat;
            background-size: 1.2em;
            padding-right: 3rem;
        }

        .button-group {
            display: flex;
            gap: 1rem;
            justify-content: flex-end;
            margin-top: 2rem;
        }

        .btn {
            padding: 1rem 2rem;
            border-radius: 10px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            border: none;
            font-family: inherit;
            font-size: 1rem;
        }

        .btn-primary {
            background: linear-gradient(135deg, #5A3B1F, #AF8F6F);
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(90, 59, 31, 0.3);
        }

        .btn-secondary {
            background: white;
            color: #5A3B1F;
            border: 2px solid #5A3B1F;
        }

        .btn-secondary:hover {
            background: #5A3B1F;
            color: white;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .main-container {
                width: 95%;
                margin: 2rem auto;
            }
            
            .profile-main {
                flex-direction: column;
                gap: 2rem;
            }
            
            .profile-sidebar {
                flex: none;
            }
            
            .form-grid {
                grid-template-columns: 1fr;
            }
            
            .tabs {
                overflow-x: auto;
            }
        }
    </style>
</head>
<body>
    <header>
        <div>Senara Guest House</div>
        <nav>
            <a href="{{ route('home2') }}">Home</a>
            <a href="{{ route('rooms2') }}">Rooms</a>
            <a href="{{ route('facilities2') }}">Facilities</a>
            <a href="{{ route('booking') }}">Booking</a>
        </nav>
        <div class="profile-wrapper">
            <a href="{{ route('profile') }}">
                <img src="{{ asset('images/profile.jpg') }}" alt="Profile" class="profile-avatar">
            </a>
        </div>
    </header>

    <!-- Main Container -->
    <div class="main-container">
        <div class="profile-card">
            <!-- Profile Header -->
            <div class="profile-header">
                <button class="edit-cover-btn">📷 Change Cover</button>
            </div>

            <!-- Profile Main Content -->
            <div class="profile-main">
                <!-- Profile Sidebar -->
                <div class="profile-sidebar">
                    <div class="profile-avatar-large">
                        NP
                        <div class="status-badge">✓</div>
                    </div>
                    
                    <h2 class="profile-name">Nathaniel Poole</h2>
                    <p class="profile-email">nathaniel.poole@gmail.com</p>
                    <p class="profile-member-since">Member since March 2024</p>

                    <div class="loyalty-badge">🏆 Gold Member</div>

                    <div class="stats-container">
                        <div class="stats-grid">
                            <div class="stat-item">
                                <span class="stat-number">12</span>
                                <span class="stat-label">Total Stays</span>
                            </div>
                            <div class="stat-item">
                                <span class="stat-number">3</span>
                                <span class="stat-label">Active Bookings</span>
                            </div>
                            <div class="stat-item">
                                <span class="stat-number">24</span>
                                <span class="stat-label">Nights Stayed</span>
                            </div>
                            <div class="stat-item">
                                <span class="stat-number">4.9</span>
                                <span class="stat-label">Rating</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form Section -->
                <div class="form-section">
                    <div class="tabs-container">
                        <div class="tabs">
                            <div class="tab active" data-tab="personal">Personal Information</div>
                            <div class="tab" data-tab="preferences">Preferences</div>
                            <div class="tab" data-tab="security">Security</div>
                        </div>
                    </div>

                    <div class="form-content">
                        <div id="personal-tab" class="tab-content active">
                            <form>
                                <div class="form-grid">
                                    <div class="form-group">
                                        <label class="form-label">First Name</label>
                                        <input type="text" class="form-input" value="Nathaniel" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Last Name</label>
                                        <input type="text" class="form-input" value="Poole" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Email Address</label>
                                        <input type="email" class="form-input" value="nathaniel.poole@gmail.com" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Phone Number</label>
                                        <input type="tel" class="form-input" value="+1 (555) 123-4567" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Date of Birth</label>
                                        <input type="date" class="form-input" value="1985-06-15">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Nationality</label>
                                        <select class="form-select">
                                            <option value="us">United States</option>
                                            <option value="uk">United Kingdom</option>
                                            <option value="ca">Canada</option>
                                            <option value="id">Indonesia</option>
                                        </select>
                                    </div>
                                    <div class="form-group full-width">
                                        <label class="form-label">Address</label>
                                        <input type="text" class="form-input" value="123 Main Street, Anytown, WA 98001" placeholder="Enter your full address">
                                    </div>
                                </div>

                                <div class="button-group">
                                    <button type="button" class="btn btn-secondary">Cancel</button>
                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                </div>
                            </form>
                        </div>

                        <div id="preferences-tab" class="tab-content" style="display: none;">
                            <form>
                                <div class="form-grid">
                                    <div class="form-group">
                                        <label class="form-label">Room Type Preference</label>
                                        <select class="form-select">
                                            <option value="standard">Standard Room</option>
                                            <option value="deluxe">Deluxe Room</option>
                                            <option value="suite">Suite</option>
                                            <option value="family">Family Room</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Bed Preference</label>
                                        <select class="form-select">
                                            <option value="single">Single Bed</option>
                                            <option value="double">Double Bed</option>
                                            <option value="twin">Twin Beds</option>
                                            <option value="king">King Size</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Floor Preference</label>
                                        <select class="form-select">
                                            <option value="any">Any Floor</option>
                                            <option value="low">Lower Floors (1-3)</option>
                                            <option value="high">Higher Floors (4+)</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Special Requirements</label>
                                        <select class="form-select">
                                            <option value="none">None</option>
                                            <option value="accessible">Wheelchair Accessible</option>
                                            <option value="quiet">Quiet Room</option>
                                            <option value="view">Room with View</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="button-group">
                                    <button type="button" class="btn btn-secondary">Cancel</button>
                                    <button type="submit" class="btn btn-primary">Save Preferences</button>
                                </div>
                            </form>
                        </div>

                        <div id="security-tab" class="tab-content" style="display: none;">
                            <form>
                                <div class="form-grid">
                                    <div class="form-group">
                                        <label class="form-label">Current Password</label>
                                        <input type="password" class="form-input" placeholder="Enter current password">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">New Password</label>
                                        <input type="password" class="form-input" placeholder="Enter new password">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Confirm New Password</label>
                                        <input type="password" class="form-input" placeholder="Confirm new password">
                                    </div>
                                </div>

                                <div class="button-group">
                                    <button type="button" class="btn btn-secondary">Cancel</button>
                                    <button type="submit" class="btn btn-primary">Update Password</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Tab functionality
        document.querySelectorAll('.tab').forEach(tab => {
            tab.addEventListener('click', function() {
                const tabId = this.getAttribute('data-tab');
                
                // Remove active class from all tabs and contents
                document.querySelectorAll('.tab').forEach(t => t.classList.remove('active'));
                document.querySelectorAll('.tab-content').forEach(content => {
                    content.style.display = 'none';
                    content.classList.remove('active');
                });
                
                // Add active class to clicked tab
                this.classList.add('active');
                
                // Show corresponding content
                const content = document.getElementById(tabId + '-tab');
                if (content) {
                    content.style.display = 'block';
                    content.classList.add('active');
                }
            });
        });

        // Form submissions
        document.querySelectorAll('form').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                
                // Simple validation
                const requiredFields = this.querySelectorAll('[required]');
                let isValid = true;
                
                requiredFields.forEach(field => {
                    if (!field.value.trim()) {
                        field.style.borderColor = '#ef4444';
                        isValid = false;
                    } else {
                        field.style.borderColor = '#10b981';
                    }
                });
                
                if (isValid) {
                    alert('Changes saved successfully!');
                    // Reset border colors
                    requiredFields.forEach(field => {
                        field.style.borderColor = '#e5e7eb';
                    });
                } else {
                    alert('Please fill in all required fields.');
                }
            });
        });

        // Cover photo change
        document.querySelector('.edit-cover-btn').addEventListener('click', function() {
            alert('Cover photo upload functionality would be implemented here.');
        });

        // Profile avatar click
        document.querySelector('.user-avatar').addEventListener('click', function() {
            alert('Avatar upload functionality would be implemented here.');
        });
    </script>
</body>
</html>