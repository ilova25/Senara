@extends('layout.app')

@section('content')
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

    .main-container {
        width: 80%;
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
        background: #5A3B1F;
        padding: 4rem 2rem 2rem;
        position: relative;
        color: white;
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
        margin: -80px auto 1.5rem;
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

    .form-label {
        font-weight: 600;
        color: #2c1810;
        margin-bottom: 0.5rem;
        font-size: 0.9rem;
    }

    .form-input {
        padding: 1rem;
        border: 2px solid #e5e7eb;
        border-radius: 10px;
        font-size: 1rem;
        font-family: inherit;
        transition: all 0.3s ease;
        background: white;
    }

    .form-input:focus {
        outline: none;
        border-color: #5A3B1F;
        box-shadow: 0 0 0 3px rgba(90, 59, 31, 0.1);
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
        background:#5A3B1F;
        color: white;
    }

    .btn-secondary {
        background: white;
        color: #5A3B1F;
        border: 2px solid #5A3B1F;
    }

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
    }
</style>

<div class="main-container">
    <div class="profile-card">
        <div class="profile-header"></div>

        <div class="profile-main">
            <!-- Sidebar -->
            <div class="profile-sidebar">
                <div class="profile-avatar-large">
                    NP
                    <div class="status-badge">✓</div>
                </div>
                <h2 class="profile-name">Nathaniel Poole</h2>
                <p class="profile-email">nathaniel.poole@gmail.com</p>
                <p class="profile-member-since">Member since March 2024</p>

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
                        <div class="tab" data-tab="security">Security</div>
                    </div>
                </div>

                <div class="form-content">
                    <div id="personal-tab" class="tab-content active">
                        <form>
                            <div class="form-grid">
                                <div class="form-group">
                                    <label class="form-label">First Name</label>
                                    <input type="text" class="form-input" placeholder="Enter your first name" required>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Last Name</label>
                                    <input type="text" class="form-input" placeholder="Enter your last name" required>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Email Address</label>
                                    <input type="email" class="form-input" placeholder="Enter your email" required>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Phone Number</label>
                                    <input type="tel" class="form-input" placeholder="Enter your phone number" required>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Date of Birth</label>
                                    <input type="date" class="form-input">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Address</label>
                                    <input type="text" class="form-input" placeholder="Enter your full address">
                                </div>
                            </div>
                            <div class="button-group">
                                <button type="button" class="btn btn-secondary">Cancel</button>
                                <button type="submit" class="btn btn-primary">Save Changes</button>
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
            document.querySelectorAll('.tab').forEach(t => t.classList.remove('active'));
            document.querySelectorAll('.tab-content').forEach(content => {
                content.style.display = 'none';
                content.classList.remove('active');
            });
            this.classList.add('active');
            const content = document.getElementById(tabId + '-tab');
            if (content) {
                content.style.display = 'block';
                content.classList.add('active');
            }
        });
    });
</script>
@endsection