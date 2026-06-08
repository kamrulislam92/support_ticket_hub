<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Login</title>

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">

<style>
body {
    margin: 0;
    font-family: 'Inter', sans-serif;
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    background: linear-gradient(135deg, #667eea, #764ba2);
}

/* Glass Card */
.login-box {
    width: 380px;
    padding: 40px;
    border-radius: 20px;
    background: rgba(255,255,255,0.12);
    backdrop-filter: blur(12px);
    border: 1px solid rgba(255,255,255,0.2);
    box-shadow: 0 20px 50px rgba(0,0,0,0.25);
    color: white;
}

.login-box h2 {
    text-align: center;
    margin-bottom: 25px;
    font-weight: 700;
}

/* Inputs */
.input {
    width: 100%;
    padding: 12px;
    margin-bottom: 15px;
    border-radius: 10px;
    border: none;
    outline: none;
    font-size: 14px;
}

/* Button */
.btn {
    width: 100%;
    padding: 12px;
    background: #00c6ff;
    border: none;
    border-radius: 10px;
    font-weight: 600;
    color: white;
    cursor: pointer;
    transition: 0.3s;
}

.btn:hover {
    background: #0096c7;
}

/* Error */
.error {
    background: rgba(255,0,0,0.2);
    padding: 10px;
    border-radius: 10px;
    margin-bottom: 10px;
    display: none;
}

/* Loader */
.loading {
    display: none;
    text-align: center;
    margin-top: 10px;
    font-size: 14px;
}
</style>
</head>

<body>

<div class="login-box">

    <h2>Welcome Back</h2>
    <p style="text-align:center; opacity:0.8; font-size:13px;">Login to your account</p>

    <div class="error" id="errorBox"></div>

    <form id="loginForm">
        @csrf

        <input type="email" name="email" id="email" class="input" placeholder="Email address" required>

        <input type="password" name="password" id="password" class="input" placeholder="Password" required>

        <button class="btn" type="submit" id="loginBtn">
            Login
        </button>

        <div class="loading" id="loading">Logging in...</div>
    </form>

</div>

<script>
// document.getElementById('loginForm')
// .addEventListener('submit', async function(e){

//     e.preventDefault();

//     let errorBox = document.getElementById('errorBox');
//     let loading = document.getElementById('loading');
//     let btn = document.getElementById('loginBtn');

//     errorBox.style.display = "none";
//     loading.style.display = "block";
//     btn.disabled = true;

//     let response = await fetch('/support_ticket_hub/public/api/login', {
//         method: 'POST',
//         headers: {
//             'Content-Type': 'application/json',
//             'Accept': 'application/json'
//         },
//         body: JSON.stringify({
//             email: document.getElementById('email').value,
//             password: document.getElementById('password').value
//         })
//     });

//     let data = await response.json();

//     loading.style.display = "none";
//     btn.disabled = false;

//     if(data.success){

//         if(data.role === 'admin'){
//             window.location.href = '/admin/dashboard';
//         }
//         else{
//             window.location.href = '/user/dashboard';
//         }

//     }else{

//         errorBox.style.display = "block";
//         errorBox.innerText = data.message;

//     }

// });





const BASE_URL = '/support_ticket_hub/public';

document.getElementById('loginForm')
.addEventListener('submit', async function(e){

    e.preventDefault();

    let response = await fetch(BASE_URL + '/api/login', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json'
        },
        body: JSON.stringify({
            email: document.getElementById('email').value,
            password: document.getElementById('password').value
        })
    });

    let data = await response.json();

    if(data.success){

        if(data.role === 'admin'){
            window.location.href = BASE_URL + '/admin/dashboard';
        } else {
            window.location.href = BASE_URL + '/user/dashboard';
        }

    } else {
        alert(data.message);
    }

});
</script>

</body>
</html>