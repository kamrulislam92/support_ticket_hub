<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Account</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <style>
        body {
            margin: 0;
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(135deg, #667eea, #764ba2);
            padding: 20px 0;
        }

        /* ২ কলামের জন্য বক্সের উইডথ বাড়িয়ে ৬৫০পিএক্স করা হয়েছে */
        .register-box {
            width: 650px;
            padding: 40px;
            border-radius: 20px;
            background: rgba(255, 255, 255, 0.12);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 20px 50px rgba(0,0,0,0.25);
            color: white;
        }

        .register-box h2 { text-align: center; margin-bottom: 5px; font-weight: 700; }
        .register-box p { text-align: center; opacity: 0.8; font-size: 13px; margin-bottom: 30px; }

        /* CSS Grid দিয়ে ২ কলামের ফর্ম লেআউট */
        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr); /* সমান দুই ভাগে ভাগ */
            gap: 20px; /* প্রতিটি ফিল্ডের মাঝের গ্যাপ */
        }

        .input-group { 
            display: flex;
            flex-direction: column;
        }
        
        .input-group label { 
            font-size: 13px; 
            margin-bottom: 6px; 
            opacity: 0.9; 
            font-weight: 600;
        }
        
        .input, select {
            width: 100%; 
            padding: 11px 15px; 
            border-radius: 8px; 
            border: none; 
            outline: none;
            font-size: 14px; 
            box-sizing: border-box; 
            color: #333; 
            background: white;
            transition: 0.3s;
        }

        .input:focus {
            box-shadow: 0 0 10px rgba(0, 198, 255, 0.5);
        }

        /* জেন্ডার রেডিও বাটনগুলোর অ্যালাইনমেন্ট */
        .gender-group { 
            display: flex; 
            gap: 20px; 
            height: 100%;
            align-items: center; /* ইনপুটের সাথে লেখা একই লাইনে রাখার জন্য */
        }
        
        .gender-group label { 
            display: flex; 
            align-items: center; 
            gap: 6px; 
            cursor: pointer; 
            margin: 0;
            font-weight: 400;
        }

        /* বাটন ও নিচের টেক্সট গ্রিডের বাইরে রাখার জন্য ফুল উইডথ */
        .form-actions {
            grid-column: span 2; 
            margin-top: 10px;
        }

        .btn {
            width: 100%; padding: 13px; background: #00c6ff; border: none; border-radius: 10px;
            font-weight: 600; color: white; cursor: pointer; transition: 0.3s; font-size: 16px;
        }
        .btn:hover { background: #0096c7; }
        .small-text { text-align: center; margin-top: 20px; font-size: 14px; }
        .small-text a { color: #00c6ff; text-decoration: none; font-weight: 600; }
        .small-text a:hover { text-decoration: underline; }
        .loading { display: none; text-align: center; margin-top: 10px; font-size: 14px; }

        /* রেসপনসিভ: মোবাইল স্ক্রিনে যেন আবার ১ কলাম হয়ে যায় */
        @media (max-width: 768px) {
            .register-box { width: 90%; padding: 25px; }
            .form-grid { grid-template-columns: 1fr; gap: 15px; }
            .form-actions { grid-column: span 1; }
        }
    </style>
</head>

<body>

<div class="register-box">
    <h2>Create Account</h2>
    <p>Sign up to join the Support ERP platform</p>

    <form id="registerForm" enctype="multipart/form-data">
        @csrf

        <div class="form-grid">
            
            <div class="input-group">
                <label>Full Name</label>
                <input type="text" id="name" class="input" placeholder="John Doe" required>
            </div>

            <div class="input-group">
                <label>Email Address</label>
                <input type="email" id="email" class="input" placeholder="example@mail.com" required>
            </div>

            <div class="input-group">
                <label>Phone Number</label>
                <input type="text" id="phone" class="input" placeholder="+88017XXXXXXXX" required>
            </div>

            <div class="input-group">
                <label>Date of Birth</label>
                <input type="date" id="date_of_birth" class="input" required>
            </div>

            <div class="input-group">
                <label>Gender</label>
                <div class="gender-group">
                    <label><input type="radio" name="gender" value="male" checked> Male</label>
                    <label><input type="radio" name="gender" value="female"> Female</label>
                    <label><input type="radio" name="gender" value="other"> Other</label>
                </div>
            </div>

            <div class="input-group">
                <label>Profile Image</label>
                <input type="file" id="profile_image" class="input" accept="image/*">
            </div>

            <div class="input-group">
                <label>Password</label>
                <input type="password" id="password" class="input" placeholder="******" required>
            </div>

            <div class="input-group">
                <label>Confirm Password</label>
                <input type="password" id="password_confirmation" class="input" placeholder="******" required>
            </div>

            <div class="form-actions">
                <button class="btn" type="submit" id="registerBtn">Register</button>
                <div class="loading" id="loading">Creating your account...</div>
            </div>

        </div>
        </form>

    <div class="small-text">
        Already have an account? <a href="/support_ticket_hub/public/login">Login</a>
    </div>
</div>

<script>
$(document).ready(function() {
    toastr.options = { "closeButton": true, "progressBar": true, "positionClass": "toast-top-right", "timeOut": "3000" };

    $('#registerForm').on('submit', function(e) {
        e.preventDefault();

        if ($('#password').val() !== $('#password_confirmation').val()) {
            toastr.error('Password and Confirm Password do not match!');
            return;
        }

        const formData = new FormData();
        formData.append('name', $('#name').val());
        formData.append('email', $('#email').val());
        formData.append('phone', $('#phone').val());
        formData.append('date_of_birth', $('#date_of_birth').val());
        formData.append('gender', $('input[name="gender"]:checked').val());
        formData.append('password', $('#password').val());
        formData.append('password_confirmation', $('#password_confirmation').val());
        
        const imageFile = $('#profile_image')[0].files[0];
        if (imageFile) {
            formData.append('profile_image', imageFile);
        }

        registerUser(formData);
    });
});

function registerUser(formData) {
    const baseUrl = window.location.origin + '/support_ticket_hub/public';
    
    $('#registerBtn').prop('disabled', true);
    $('#loading').show();

    fetch(baseUrl + '/api/register', {
        method: 'POST',
        headers: { 'Accept': 'application/json' },
        body: formData
    })
    .then(response => {
        return response.json().then(data => {
            if (!response.ok) return Promise.reject(data);
            return data;
        });
    })
    .then(data => {
        $('#registerBtn').prop('disabled', false);
        $('#loading').hide();

        if (data.success) {
            localStorage.setItem('token', data.token);
            localStorage.setItem('user', JSON.stringify(data.user));

            sessionStorage.setItem('toast_message', 'Registration Successful with Profile Image!');
            sessionStorage.setItem('toast_type', 'success');

            window.location.href = baseUrl + '/user/dashboard';
        }
    })
    .catch(error => {
        $('#registerBtn').prop('disabled', false);
        $('#loading').hide();
        console.error('Registration Error:', error);

        if (error.errors) {
            const firstError = Object.values(error.errors)[0][0];
            toastr.error(firstError);
        } else {
            toastr.error(error.message || 'Something went wrong on the server.');
        }
    });
}
</script>

</body>
</html>