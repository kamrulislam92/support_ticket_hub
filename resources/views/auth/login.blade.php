<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Login</title>

<link href="https://fonts.googleapis.com/css2?family=Inter:wght=300;400;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

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

.input {
    width: 100%;
    padding: 12px;
    margin-bottom: 15px;
    border-radius: 10px;
    border: none;
    outline: none;
    font-size: 14px;
    color: #333;
}

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
    <p style="text-align:center; opacity:0.8; font-size:13px; margin-bottom: 20px;">Login to your account</p>

    <form id="loginForm">
        @csrf
        <input type="email" name="email" id="email" class="input" placeholder="Email address" required>
        <input type="password" name="password" id="password" class="input" placeholder="Password" required>

        <button class="btn" type="submit" id="loginBtn">Login</button>
        <div class="loading" id="loading">Logging in...</div>
    </form>
</div>

<script>
$(document).ready(function() {
    // Toastr কনফিগারেশন
    toastr.options = {
        "closeButton": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "timeOut": "3000"
    };

    // ড্যাশবোর্ড থেকে লগআউট হয়ে আসলে নোটিফিকেশন দেখাবে
    const pendingToast = sessionStorage.getItem('toast_message');
    const toastType = sessionStorage.getItem('toast_type');
    if (pendingToast) {
        if (toastType === 'success') toastr.success(pendingToast);
        else if (toastType === 'error') toastr.error(pendingToast);
        else if (toastType === 'warning') toastr.warning(pendingToast);
        else toastr.info(pendingToast);

        sessionStorage.removeItem('toast_message');
        sessionStorage.removeItem('toast_type');
    }

    // ফর্ম সাবমিট হ্যান্ডলার (যা আপনার কোডে মিসিং ছিল)
    $('#loginForm').on('submit', function(e) {
        e.preventDefault();
        const email = $('#email').val();
        const password = $('#password').val();
        loginUser(email, password);
    });
});


function loginUser(email, password) {
    const baseUrl = window.location.origin + '/support_ticket_hub/public';
    
    // লোডার দেখানো এবং বাটন ডিজেবল করা
    $('#loginBtn').prop('disabled', true);
    $('#loading').show();

    fetch(baseUrl + '/api/login', {
        method: 'POST',
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            email: email,
            password: password
        })
    })
    .then(response => response.json())
    .then(data => {
        $('#loginBtn').prop('disabled', false);
        $('#loading').hide();

        if (data.success) {
            // ১. টোকেন এবং ইউজার ডেটা লোকাল স্টোরেজে সেভ করা
            localStorage.setItem('token', data.token);
            localStorage.setItem('user', JSON.stringify(data.user)); // অবজেক্টকে স্ট্রিং আকারে সেভ করা
            
            // সেশনে মেসেজ রাখা যাতে ড্যাশবোর্ডে টোস্টার দেখায়
            sessionStorage.setItem('toast_message', 'Welcome back! Login Successful.');
            sessionStorage.setItem('toast_type', 'success');

            // ২. রোল (Role) অনুযায়ী ডাইনামিক রিডাইরেকশন
            // ব্যাকএন্ড থেকে আসা ইউজার অবজেক্টের ভেতর রোল চেক করা হচ্ছে
            if (data.user && data.user.role === 'admin') {
                window.location.href = baseUrl + '/admin/dashboard';
            } else {
                window.location.href = baseUrl + '/user/dashboard';
            }
        } else {
            toastr.error(data.message || 'Invalid email or password.');
        }
    })
    .catch(error => {
        $('#loginBtn').prop('disabled', false);
        $('#loading').hide();
        console.error('Error:', error);
        toastr.error('Connection refused or Server Error.');
    });
}





// function loginUser(email, password) {
//     const baseUrl = window.location.origin + '/support_ticket_hub/public';
    
//     // লোডার দেখানো এবং বাটন ডিজেবল করা
//     $('#loginBtn').prop('disabled', true);
//     $('#loading').show();

//     fetch(baseUrl + '/api/login', {
//         method: 'POST',
//         headers: {
//             'Accept': 'application/json',
//             'Content-Type': 'application/json'
//         },
//         body: JSON.stringify({
//             email: email,
//             password: password
//         })
//     })
//     .then(response => response.json())
//     .then(data => {
//         $('#loginBtn').prop('disabled', false);
//         $('#loading').hide();

//         if (data.success) {
//             // ১. টোকেন ব্রাউজারে সেভ করা
//             localStorage.setItem('token', data.token);
            
//             // সেশনে মেসেজ রাখা যাতে পরের পেজে গিয়ে দেখায়
//             sessionStorage.setItem('toast_message', 'Welcome back! Login Successful.');
//             sessionStorage.setItem('toast_type', 'success');

//             // ২. ড্যাশবোর্ডে রিডাইরেক্ট করা (web.php এর রুট অনুযায়ী)
//             window.location.href = baseUrl + '/admin/dashboard'; 
//         } else {
//             toastr.error(data.message || 'Invalid email or password.');
//         }

// // if(data.success){
// //     // টোকেন এবং ইউজার অবজেক্ট লোকাল স্টোরেজে সেভ করে রাখা হচ্ছে
// //     localStorage.setItem('token', data.token);
// //     localStorage.setItem('user', JSON.stringify(data.user));

// //     if(data.role === 'admin'){
// //         window.location.href = BASE_URL + '/admin/dashboard';
// //     } else {
// //         window.location.href = BASE_URL + '/user/dashboard';
// //     }
// // }





//     })
//     .catch(error => {
//         $('#loginBtn').prop('disabled', false);
//         $('#loading').hide();
//         console.error('Error:', error);
//         toastr.error('Connection refused or Server Error.');
//     });
// }
</script>

</body>
</html>