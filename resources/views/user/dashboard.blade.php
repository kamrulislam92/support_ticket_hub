<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard - Support Ticket Hub</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }

        body {
            background: #f4f6f9;
            color: #333;
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar Design */
        .sidebar {
            width: 260px;
            background: linear-gradient(180deg, #667eea, #764ba2);
            color: white;
            padding: 30px 20px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            position: fixed;
            height: 100vh;
        }

        .sidebar .brand {
            font-size: 20px;
            font-weight: 700;
            text-align: center;
            margin-bottom: 40px;
            letter-spacing: 1px;
        }

        .sidebar .menu-item {
            padding: 12px 15px;
            border-radius: 10px;
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            display: block;
            margin-bottom: 10px;
            font-weight: 500;
            transition: 0.3s;
        }

        .sidebar .menu-item.active, .sidebar .menu-item:hover {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            backdrop-filter: blur(5px);
        }

        .logout-btn {
            background: #ff4d4d;
            color: white;
            border: none;
            padding: 12px;
            border-radius: 10px;
            cursor: pointer;
            font-weight: 600;
            width: 100%;
            transition: 0.3s;
        }

        .logout-btn:hover {
            background: #e03e3e;
            box-shadow: 0 5px 15px rgba(255, 77, 77, 0.3);
        }

        /* Main Content */
        .main-content {
            margin-left: 260px;
            flex: 1;
            padding: 40px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .header h1 {
            font-size: 26px;
            color: #2d3748;
        }

        .user-profile {
            font-weight: 600;
            color: #4a5568;
            background: white;
            padding: 8px 18px;
            border-radius: 20px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
        }

        /* Stats Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 20px;
            margin-bottom: 40px;
        }

        .card {
            background: white;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.03);
            border: 1px solid rgba(0,0,0,0.05);
        }

        .card h3 {
            font-size: 14px;
            color: #718096;
            text-transform: uppercase;
            margin-bottom: 10px;
        }

        .card .value {
            font-size: 28px;
            font-weight: 700;
            color: #2d3748;
        }

        /* Grid Layout for Form & Tickets */
        .dashboard-grid {
            display: grid;
            grid-template-columns: 1fr 2fr;
            gap: 30px;
        }

        @media (max-width: 1024px) {
            .dashboard-grid {
                grid-template-columns: 1fr;
            }
        }

        /* Form Styling */
        .ticket-form-box {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.03);
        }

        .ticket-form-box h2 {
            font-size: 18px;
            margin-bottom: 20px;
            color: #2d3748;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 5px;
            color: #4a5568;
        }

        .form-control {
            width: 100%;
            padding: 12px;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            outline: none;
            font-size: 14px;
            transition: 0.3s;
        }

        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .submit-btn {
            width: 100%;
            padding: 12px;
            background: #00c6ff;
            color: white;
            border: none;
            border-radius: 10px;
            font-weight: 600;
            cursor: pointer;
            transition: 0.3s;
        }

        .submit-btn:hover {
            background: #0096c7;
        }

        /* Table Styling */
        .ticket-list-box {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.03);
        }

        .ticket-list-box h2 {
            font-size: 18px;
            margin-bottom: 20px;
            color: #2d3748;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        }

        th, td {
            padding: 14px;
            border-bottom: 1px solid #edf2f7;
            font-size: 14px;
        }

        th {
            background: #f7fafc;
            color: #4a5568;
            font-weight: 600;
        }

        /* Badges */
        .badge {
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            display: inline-block;
        }

        .badge-open { background: #e3f2fd; color: #1e88e5; }
        .badge-pending { background: #fff3e0; color: #fb8c00; }
        .badge-closed { background: #e8f5e9; color: #43a047; }

    </style>
</head>
<body>

    <div class="sidebar">
        <div>
            <div class="brand">TicketHub</div>
            <a href="#" class="menu-item active">Dashboard</a>
            <a href="#" class="menu-item">My Tickets</a>
            <a href="#" class="menu-item">Settings</a>
        </div>
        <div>
            <button class="logout-btn" id="logoutBtn">Logout</button>
        </div>
    </div>

    <div class="main-content">
        <div class="header">
            <h1>User Dashboard</h1>
            <div class="user-profile" id="userName">Loading User...</div>
        </div>

        <div class="stats-grid">
            <div class="card">
                <h3>Total Tickets</h3>
                <div class="value">12</div>
            </div>
            <div class="card">
                <h3>Open Tickets</h3>
                <div class="value" style="color: #1e88e5;">4</div>
            </div>
            <div class="card">
                <h3>Pending</h3>
                <div class="value" style="color: #fb8c00;">2</div>
            </div>
            <div class="card">
                <h3>Resolved</h3>
                <div class="value" style="color: #43a047;">6</div>
            </div>
        </div>

        <div class="dashboard-grid">
            
            <div class="ticket-form-box">
                <h2>Create New Ticket</h2>
                <form id="ticketForm">
                    <div class="form-group">
                        <label>Subject</label>
                        <input type="text" class="form-control" placeholder="Briefly describe the issue" required>
                    </div>
                    <div class="form-group">
                        <label>Department</label>
                        <select class="form-control">
                            <option>Technical Support</option>
                            <option>Billing & Invoice</option>
                            <option>Account Access</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Priority</label>
                        <select class="form-control">
                            <option>Low</option>
                            <option>Medium</option>
                            <option>High</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Message Description</label>
                        <textarea class="form-control" rows="4" placeholder="Provide details about your problem..." required></textarea>
                    </div>
                    <button type="submit" class="submit-btn">Submit Ticket</button>
                </form>
            </div>

            <div class="ticket-list-box">
                <h2>My Recent Tickets</h2>
                <div style="overflow-x: auto;">
                    <table>
                        <thead>
                            <tr>
                                <th>Ticket ID</th>
                                <th>Subject</th>
                                <th>Priority</th>
                                <th>Status</th>
                                <th>Last Update</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>#TK-9082</td>
                                <td>Server connection timeout</td>
                                <td>High</td>
                                <td><span class="badge badge-open">Open</span></td>
                                <td>2 hours ago</td>
                            </tr>
                            <tr>
                                <td>#TK-8941</td>
                                <td>Payment failure via Stripe</td>
                                <td>Medium</td>
                                <td><span class="badge badge-pending">Pending</span></td>
                                <td>Yesterday</td>
                            </tr>
                            <tr>
                                <td>#TK-8720</td>
                                <td>Profile data sync issue</td>
                                <td>Low</td>
                                <td><span class="badge badge-closed">Resolved</span></td>
                                <td>3 days ago</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

    <script>
        const BASE_URL = '/support_ticket_hub/public';
        
        // ১. ড্যাশবোর্ড লোড হওয়ার সময় লোকাল স্টোরেজ থেকে ইউজারের নাম দেখানো
        document.addEventListener("DOMContentLoaded", () => {
            const user = JSON.parse(localStorage.getItem('user'));
            if(user) {
                document.getElementById('userName').innerText = user.name;
            } else {
                document.getElementById('userName').innerText = "Guest User";
            }
        });

        // ২. RESTful API দিয়ে সম্পূর্ণ সিকিউর লগআউট প্রসেস
        document.getElementById('logoutBtn').addEventListener('click', async function() {
            
            // লগইন করার সময় যদি আপনি টোকেন ব্রাউজারে সেভ করে থাকেন (যেমন LocalStorage)
            const token = localStorage.getItem('token'); 

            try {
                let response = await fetch(BASE_URL + '/api/logout', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        // Sanctum প্রটেক্টড রুটে হিট করার জন্য Bearer Token পাঠানো বাধ্যতামূলক
                        'Authorization': 'Bearer ' + token 
                    }
                });

                let data = await response.json();

                if(data.success) {
                    // লোকাল ডাটা ক্লিয়ার করা
                    localStorage.removeItem('token');
                    localStorage.removeItem('user');
                    
                    // সফলভাবে লগআউট হলে আবার মেইন লগইন পেজে ব্যাক করা
                    window.location.href = BASE_URL + '/login';
                } else {
                    alert("Logout failed. Please try again.");
                }
            } catch (error) {
                console.error("Error during logout:", error);
                // কোনো কারণে ব্যাকএন্ড ফেইল করলেও ফ্রন্টএন্ড সেফটির জন্য রিডাইরেক্ট করে দেওয়া
                window.location.href = BASE_URL + '/login';
            }
        });
    </script>
</body>
</html>