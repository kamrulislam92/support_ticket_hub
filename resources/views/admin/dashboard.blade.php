<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Admin Dashboard</title>

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<style>
*{ margin:0; padding:0; box-sizing:border-box; font-family: 'Inter', sans-serif; }
body{ background:#f4f6f9; }
.sidebar{ width:250px; height:100vh; background:#111827; color:white; position:fixed; left:0; top:0; padding:20px; display: flex; flex-direction: column; justify-content: space-between; }
.sidebar-menu h2{ font-size:18px; margin-bottom:30px; color:#00c6ff; }
.sidebar a{ display:block; color:#cbd5e1; padding:12px; text-decoration:none; border-radius:8px; margin-bottom:8px; transition:0.3s; }
.sidebar a:hover{ background:#1f2937; color:white; }
.logout-btn { width: 100%; background: #ef4444; color: white; border: none; padding: 12px; border-radius: 8px; cursor: pointer; font-weight: 600; font-size: 15px; transition: 0.3s; display: flex; align-items: center; justify-content: center; gap: 8px; }
.logout-btn:hover { background: #dc2626; }
.main{ margin-left:250px; padding:20px; }
.topbar{ display:flex; justify-content:space-between; align-items:center; margin-bottom:20px; }
.topbar h1{ font-size:22px; }
.cards{ display:grid; grid-template-columns:repeat(4,1fr); gap:15px; margin-bottom:20px; }
.card{ background:white; padding:20px; border-radius:12px; box-shadow:0 5px 15px rgba(0,0,0,0.05); }
.card h3{ font-size:14px; color:#6b7280; }
.card p{ font-size:22px; font-weight:700; margin-top:5px; }
.table-box{ background:white; padding:20px; border-radius:12px; box-shadow:0 5px 15px rgba(0,0,0,0.05); }
table{ width:100%; border-collapse:collapse; }
th, td{ padding:12px; border-bottom:1px solid #e5e7eb; text-align:left; }
.badge{ padding:5px 10px; border-radius:6px; font-size:12px; color:white; }
.open{ background:#f59e0b; }
.progress{ background:#3b82f6; }
.closed{ background:#10b981; }
</style>
</head>

<body>

<div class="sidebar">
    <div class="sidebar-menu">
        <h2>Support ERP</h2>
        <a href="#">📊 Dashboard</a>
        <a href="#">🎫 Tickets</a>
        <a href="#">👨‍💼 Users</a>
        <a href="#">⚙️ Settings</a>
    </div>
    <div>
        <button onclick="logout()" class="logout-btn">🚪 Logout</button>
    </div>
</div>

<div class="main">
    <div class="topbar"><h1>Admin Dashboard</h1></div>

    <div class="cards">
        <div class="card"><h3>Total Tickets</h3><p>120</p></div>
        <div class="card"><h3>Open Tickets</h3><p>45</p></div>
        <div class="card"><h3>In Progress</h3><p>30</p></div>
        <div class="card"><h3>Resolved</h3><p>45</p></div>
    </div>

    <div class="table-box">
        <h3 style="margin-bottom:10px;">Recent Tickets</h3>
        <table>
            <tr><th>ID</th><th>Title</th><th>Priority</th><th>Status</th></tr>
            <tr><td>#101</td><td>Login issue</td><td>High</td><td><span class="badge open">Open</span></td></tr>
            <tr><td>#102</td><td>Payment bug</td><td>Critical</td><td><span class="badge progress">In Progress</span></td></tr>
            <tr><td>#103</td><td>Dashboard not loading</td><td>Medium</td><td><span class="badge closed">Resolved</span></td></tr>
        </table>
    </div>
</div>

<script>
// $(document).ready(function () {
//     toastr.options = { closeButton: true, progressBar: true, positionClass: "toast-top-right", timeOut: 3000 };

//     const token = localStorage.getItem('token');
//     const baseUrl = window.location.origin + '/support_ticket_hub/public';

//     // ১. কোনো টোকেন না থাকলে ড্যাশবোর্ড অ্যাক্সেস ব্লক করে লগইনে পাঠাবে
//     if (!token) {
//         sessionStorage.setItem('toast_message', 'Please login first to access dashboard.');
//         sessionStorage.setItem('toast_type', 'error');
//         window.location.href = baseUrl + '/login';
//         return;
//     }

//     // ২. পেন্ডিং টোস্টার নোটিফিকেশন চেক ও শো করা
//     const pendingToast = sessionStorage.getItem('toast_message');
//     const toastType = sessionStorage.getItem('toast_type');
//     if (pendingToast) {
//         if (toastType === 'success') toastr.success(pendingToast);
//         else if (toastType === 'error') toastr.error(pendingToast);
//         sessionStorage.removeItem('toast_message');
//         sessionStorage.removeItem('toast_type');
//     }
// });
$(document).ready(function () {
    toastr.options = { closeButton: true, progressBar: true, positionClass: "toast-top-right", timeOut: 3000 };

    const token = localStorage.getItem('token');
    const userString = localStorage.getItem('user');
    const baseUrl = window.location.origin + '/support_ticket_hub/public';

    // ১. টোকেন বা ইউজার ডেটা না থাকলে লগইন পেজে রিডাইরেক্ট
    if (!token || !userString) {
        localStorage.clear();
        sessionStorage.setItem('toast_message', 'Please login first to access dashboard.');
        sessionStorage.setItem('toast_type', 'error');
        window.location.href = baseUrl + '/login';
        return;
    }

    // ২. রোল চেক: যদি ইউজার 'admin' না হয়, তবে তাকে ইউজার ড্যাশবোর্ডে পুশ করবে
    const user = JSON.parse(userString);
    if (user.role !== 'admin') {
        sessionStorage.setItem('toast_message', 'Unauthorized access! Redirected to User Dashboard.');
        sessionStorage.setItem('toast_type', 'warning');
        window.location.href = baseUrl + '/user/dashboard';
        return;
    }

    // পেন্ডিং টোস্টার নোটিফিকেশন শো করা
    const pendingToast = sessionStorage.getItem('toast_message');
    const toastType = sessionStorage.getItem('toast_type');
    if (pendingToast) {
        if (toastType === 'success') toastr.success(pendingToast);
        else if (toastType === 'error') toastr.error(pendingToast);
        else if (toastType === 'warning') toastr.warning(pendingToast);
        sessionStorage.removeItem('toast_message');
        sessionStorage.removeItem('toast_type');
    }
});


function logout() {
    const token = localStorage.getItem('token');
    const baseUrl = window.location.origin + '/support_ticket_hub/public';

    if (!token) {
        window.location.href = baseUrl + '/login';
        return;
    }

    // RESTful API স্ট্যান্ডার্ডে টোকেনসহ লগআউট রিকোয়েস্ট পাঠানো
    fetch(baseUrl + '/api/logout', {
        method: 'POST',
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json',
            'Authorization': 'Bearer ' + token
        }
    })
    .then(response => {
        // যদি ব্যাকএন্ড বলে টোকেন অলরেডি এক্সপায়ার্ড বা ইনভ্যালিড (৪০১), তাও ব্রাউজার ক্লিয়ার করবে
        if (response.status === 401) {
            localStorage.removeItem('token');
            sessionStorage.setItem('toast_message', 'Session expired. Please login again.');
            sessionStorage.setItem('toast_type', 'warning');
            window.location.href = baseUrl + '/login';
            return Promise.reject('Unauthorized');
        }
        if (!response.ok) throw new Error('Logout request failed');
        return response.json();
    })
    .then(data => {
        if (data.success) {
            localStorage.removeItem('token');
            sessionStorage.setItem('toast_message', 'Logout successful!');
            sessionStorage.setItem('toast_type', 'success');
            window.location.href = baseUrl + '/login';
        } else {
            toastr.error('Logout failed: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        localStorage.removeItem('token');
        sessionStorage.setItem('toast_message', 'Logged out successfully.');
        sessionStorage.setItem('toast_type', 'success');
        window.location.href = baseUrl + '/login';
    });
}
</script>
</body>
</html>