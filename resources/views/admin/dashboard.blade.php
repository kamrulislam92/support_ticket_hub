<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Admin Dashboard</title>

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">

<style>
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family: 'Inter', sans-serif;
}

body{
    background:#f4f6f9;
}

/* SIDEBAR */
.sidebar{
    width:250px;
    height:100vh;
    background:#111827;
    color:white;
    position:fixed;
    left:0;
    top:0;
    padding:20px;
}

.sidebar h2{
    font-size:18px;
    margin-bottom:30px;
    color:#00c6ff;
}

.sidebar a{
    display:block;
    color:#cbd5e1;
    padding:12px;
    text-decoration:none;
    border-radius:8px;
    margin-bottom:8px;
    transition:0.3s;
}

.sidebar a:hover{
    background:#1f2937;
    color:white;
}

/* MAIN */
.main{
    margin-left:250px;
    padding:20px;
}

/* TOP BAR */
.topbar{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:20px;
}

.topbar h1{
    font-size:22px;
}

.logout{
    background:#ef4444;
    color:white;
    padding:8px 14px;
    border-radius:8px;
    text-decoration:none;
}

/* CARDS */
.cards{
    display:grid;
    grid-template-columns:repeat(4,1fr);
    gap:15px;
    margin-bottom:20px;
}

.card{
    background:white;
    padding:20px;
    border-radius:12px;
    box-shadow:0 5px 15px rgba(0,0,0,0.05);
}

.card h3{
    font-size:14px;
    color:#6b7280;
}

.card p{
    font-size:22px;
    font-weight:700;
    margin-top:5px;
}

/* TABLE */
.table-box{
    background:white;
    padding:20px;
    border-radius:12px;
    box-shadow:0 5px 15px rgba(0,0,0,0.05);
}

table{
    width:100%;
    border-collapse:collapse;
}

th, td{
    padding:12px;
    border-bottom:1px solid #e5e7eb;
    text-align:left;
}

.badge{
    padding:5px 10px;
    border-radius:6px;
    font-size:12px;
    color:white;
}

.open{ background:#f59e0b; }
.progress{ background:#3b82f6; }
.closed{ background:#10b981; }

</style>
</head>

<body>

<!-- SIDEBAR -->
<div class="sidebar">
    <h2>Support ERP</h2>

    <a href="#">📊 Dashboard</a>
    <a href="#">🎫 Tickets</a>
    <a href="#">👨‍💼 Users</a>
    <a href="#">⚙️ Settings</a>

    <!-- LOGOUT (BEST PLACE: bottom of sidebar) -->
    <!-- <div style="margin-top:40px;">
        <a href="/logout" style="background:#ef4444;color:white;">
            🚪 Logout
        </a>

        
    </div> -->
    <button onclick="logout()" class="logout-btn">
    Logout
</button>
</div>

<!-- MAIN -->
<div class="main">

    <!-- TOP BAR -->
    <div class="topbar">
        <h1>Admin Dashboard</h1>

        <!-- optional logout top right -->
        <!-- <a class="logout" href="/logout">Logout</a> -->
    </div>

    <!-- CARDS -->
    <div class="cards">

        <div class="card">
            <h3>Total Tickets</h3>
            <p>120</p>
        </div>

        <div class="card">
            <h3>Open Tickets</h3>
            <p>45</p>
        </div>

        <div class="card">
            <h3>In Progress</h3>
            <p>30</p>
        </div>

        <div class="card">
            <h3>Resolved</h3>
            <p>45</p>
        </div>

    </div>

    <!-- TABLE -->
    <div class="table-box">
        <h3 style="margin-bottom:10px;">Recent Tickets</h3>

        <table>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Priority</th>
                <th>Status</th>
            </tr>

            <tr>
                <td>#101</td>
                <td>Login issue</td>
                <td>High</td>
                <td><span class="badge open">Open</span></td>
            </tr>

            <tr>
                <td>#102</td>
                <td>Payment bug</td>
                <td>Critical</td>
                <td><span class="badge progress">In Progress</span></td>
            </tr>

            <tr>
                <td>#103</td>
                <td>Dashboard not loading</td>
                <td>Medium</td>
                <td><span class="badge closed">Resolved</span></td>
            </tr>

        </table>
    </div>

</div>
    <script>
        // async function logout() {

        //     let response = await fetch('/support_ticket_hub/public/api/logout', {
        //         method: 'POST',
        //         headers: {
        //             'Accept': 'application/json',
        //             'Content-Type': 'application/json'
        //         }
        //     });

        //     let data = await response.json();

        //     if(data.success){
        //         window.location.href = '/support_ticket_hub/public/login';
        //     } else {
        //         alert('Logout failed');
        //     }
        // }

        
    </script>

    <script>
async function logout() {

    let response = await fetch('/support_ticket_hub/public/api/logout', {
        method: 'POST',
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        }
    });

    let data = await response.json();

    if(data.success){
        window.location.href = '/support_ticket_hub/public/login';
    }
    else{
        alert('Logout failed');
    }
}
</script>
</body>
</html>