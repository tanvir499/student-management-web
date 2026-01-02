<?php 
session_start();
if(!isset($_SESSION['username'])) {
    header("location:login.php");
}
elseif($_SESSION['usertype'] === 'admin'){
    header("location:login.php");
}

$host="localhost";
$user="root";
$password="";
$db="schoolproject";

$data=mysqli_connect($host,$user,$password,$db);
$name=$_SESSION['username'];
$sql="SELECT * FROM user WHERE username='$name' ";
$result= mysqli_query($data, $sql);
$info=mysqli_fetch_assoc($result);


if(isset($_POST['update_profile'])){
   $s_email=$_POST['email'];
   $s_phone=$_POST['phone'];
   $s_password=$_POST['password'];

   $sql2="UPDATE user SET email='$s_email',phone=' $s_phone',password='$s_password' WHERE username='$name' ";

   $result2=mysqli_query($data,$sql2);

   if($result2){
      header('location:student_profile.php');
   }
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Student Profile</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <?php
    include 'student_css.php'
    ?>
    
    <style>
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        @keyframes float {
            0%, 100% {
                transform: translateY(0px);
            }
            50% {
                transform: translateY(-10px);
            }
        }
        
        @keyframes shimmer {
            0% {
                background-position: -200% center;
            }
            100% {
                background-position: 200% center;
            }
        }
        
        .animate-fadeInUp {
            animation: fadeInUp 0.6s ease-out;
        }
        
        .animate-float {
            animation: float 3s ease-in-out infinite;
        }
        
        .profile-card {
            transition: all 0.3s ease;
            background: white;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }
        
        .profile-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        }
        
        .input-field {
            transition: all 0.3s ease;
            background: #f8fafc;
        }
        
        .input-field:focus {
            background: white;
            transform: scale(1.02);
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }
        
        .shimmer-btn {
            background: linear-gradient(90deg, #667eea, #764ba2, #667eea);
            background-size: 200% auto;
            transition: all 0.3s ease;
            color: white;
        }
        
        .shimmer-btn:hover {
            background-position: right center;
            animation: shimmer 2s linear infinite;
            transform: scale(1.05);
        }
        
        .glass-effect {
            background: white;
            border: 1px solid #e2e8f0;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }
        
        .pulse-ring {
            animation: pulse 2s infinite;
        }
        
        @keyframes pulse {
            0% {
                box-shadow: 0 0 0 0 rgba(102, 126, 234, 0.7);
            }
            70% {
                box-shadow: 0 0 0 10px rgba(102, 126, 234, 0);
            }
            100% {
                box-shadow: 0 0 0 0 rgba(102, 126, 234, 0);
            }
        }
        
        .gradient-text {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .gradient-border {
            border: 2px solid transparent;
            background: linear-gradient(white, white) padding-box,
                        linear-gradient(135deg, #667eea 0%, #764ba2 100%) border-box;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-gray-50 to-gray-100">

	<?php
    include 'student_sidebar.php'
    ?>
     
     <div class="ml-64 p-8 animate-fadeInUp">
        <div class="max-w-4xl mx-auto">
            <!-- Header with Animation -->
            <div class="text-center mb-12">
                <div class="relative inline-block mb-6">
                    <div class="absolute inset-0 bg-gradient-to-r from-purple-400 to-pink-500 rounded-full blur-xl opacity-50 animate-float"></div>
                    <h1 class="relative text-5xl font-bold gradient-text">
                        Update Profile
                    </h1>
                </div>
                <p class="text-gray-600 text-lg mb-2">Manage your personal information and account settings</p>
                <div class="w-32 h-1 bg-gradient-to-r from-purple-500 to-pink-500 rounded-full mx-auto"></div>
            </div>

            <!-- Profile Card -->
            <div class="profile-card rounded-3xl overflow-hidden mb-8 gradient-border">
                <div class="p-8">
                    <!-- User Info Header -->
                    <div class="flex items-center mb-10 glass-effect rounded-2xl p-6">
                        <div class="relative">
                            <div class="w-20 h-20 rounded-full bg-gradient-to-r from-purple-500 to-pink-500 flex items-center justify-center text-white text-2xl font-bold pulse-ring">
                                <?php echo strtoupper(substr($name, 0, 1)); ?>
                            </div>
                            <div class="absolute -bottom-1 -right-1 w-6 h-6 bg-green-500 rounded-full border-2 border-white"></div>
                        </div>
                        <div class="ml-6">
                            <h2 class="text-2xl font-bold text-gray-800"><?php echo htmlspecialchars($name); ?></h2>
                            <p class="text-gray-600">Student Account</p>
                        </div>
                        <div class="ml-auto">
                            <div class="bg-gradient-to-r from-green-500 to-green-600 text-white rounded-lg px-4 py-2 shadow-md">
                                <span class="font-semibold">Active</span>
                            </div>
                        </div>
                    </div>

                    <!-- Update Form -->
                    <form action="#" method="POST" class="space-y-8">
                        <!-- Email Field -->
                        <div class="space-y-3">
                            <label class="block text-sm font-medium text-gray-700 flex items-center">
                                <i class="fas fa-envelope mr-3 text-purple-600"></i>
                                Email Address
                            </label>
                            <div class="relative">
                                <input 
                                    type="email" 
                                    name="email" 
                                    value="<?php echo htmlspecialchars($info['email']); ?>"
                                    class="input-field w-full px-6 py-4 text-gray-800 placeholder-gray-400 rounded-xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                                    placeholder="Enter your email address"
                                    required
                                >
                                <div class="absolute right-4 top-1/2 transform -translate-y-1/2">
                                    <i class="fas fa-edit text-gray-400"></i>
                                </div>
                            </div>
                        </div>

                        <!-- Phone Field -->
                        <div class="space-y-3">
                            <label class="block text-sm font-medium text-gray-700 flex items-center">
                                <i class="fas fa-phone mr-3 text-purple-600"></i>
                                Phone Number
                            </label>
                            <div class="relative">
                                <input 
                                    type="number" 
                                    name="phone" 
                                    value="<?php echo htmlspecialchars($info['phone']); ?>"
                                    class="input-field w-full px-6 py-4 text-gray-800 placeholder-gray-400 rounded-xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                                    placeholder="Enter your phone number"
                                    required
                                >
                                <div class="absolute right-4 top-1/2 transform -translate-y-1/2">
                                    <i class="fas fa-mobile-alt text-gray-400"></i>
                                </div>
                            </div>
                        </div>

                        <!-- Password Field -->
                        <div class="space-y-3">
                            <label class="block text-sm font-medium text-gray-700 flex items-center">
                                <i class="fas fa-lock mr-3 text-purple-600"></i>
                                Password
                            </label>
                            <div class="relative">
                                <input 
                                    type="text" 
                                    name="password" 
                                    value="<?php echo htmlspecialchars($info['password']); ?>"
                                    class="input-field w-full px-6 py-4 text-gray-800 placeholder-gray-400 rounded-xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                                    placeholder="Enter your password"
                                    required
                                >
                                <div class="absolute right-4 top-1/2 transform -translate-y-1/2">
                                    <i class="fas fa-key text-gray-400"></i>
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="pt-6">
                            <button 
                                type="submit" 
                                name="update_profile"
                                class="shimmer-btn w-full font-bold py-4 px-6 rounded-xl text-lg transition-all duration-300 hover:shadow-xl shadow-md"
                            >
                                <i class="fas fa-sync-alt mr-3 animate-spin hidden"></i>
                                <span class="update-text">Update Profile</span>
                                <span class="success-text hidden"><i class="fas fa-check mr-2"></i> Profile Updated!</span>
                            </button>
                        </div>
                    </form>

                    <!-- Information Panel -->
                    <div class="mt-10 p-6 glass-effect rounded-2xl border border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                            <i class="fas fa-info-circle mr-3 text-purple-600"></i>
                            Profile Information
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div class="text-center p-4 bg-purple-50 rounded-lg border border-purple-100">
                                <div class="text-2xl font-bold text-purple-600">1</div>
                                <div class="text-sm text-purple-700 mt-2">Active Session</div>
                            </div>
                            <div class="text-center p-4 bg-blue-50 rounded-lg border border-blue-100">
                                <div class="text-2xl font-bold text-blue-600">Student</div>
                                <div class="text-sm text-blue-700 mt-2">Account Type</div>
                            </div>
                            <div class="text-center p-4 bg-green-50 rounded-lg border border-green-100">
                                <div class="text-2xl font-bold text-green-600">
                                    <?php echo date('M d, Y'); ?>
                                </div>
                                <div class="text-sm text-green-700 mt-2">Last Login</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Tips -->
            <div class="bg-white rounded-2xl shadow-lg p-6 mb-8 border border-gray-200">
                <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-lightbulb mr-3 text-yellow-500"></i>
                    Quick Tips
                </h3>
                <ul class="space-y-3">
                    <li class="flex items-center text-gray-600">
                        <i class="fas fa-check-circle text-green-500 mr-3"></i>
                        Keep your email updated for important notifications
                    </li>
                    <li class="flex items-center text-gray-600">
                        <i class="fas fa-check-circle text-green-500 mr-3"></i>
                        Use a secure password with letters and numbers
                    </li>
                    <li class="flex items-center text-gray-600">
                        <i class="fas fa-check-circle text-green-500 mr-3"></i>
                        Your username cannot be changed after registration
                    </li>
                </ul>
            </div>
        </div>
     </div>

     <!-- JavaScript for Animations -->
     <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Form submission animation
            const form = document.querySelector('form');
            const submitBtn = document.querySelector('.shimmer-btn');
            const updateText = document.querySelector('.update-text');
            const successText = document.querySelector('.success-text');
            const spinIcon = document.querySelector('.fa-sync-alt');
            
            form.addEventListener('submit', function() {
                // Show loading animation
                updateText.classList.add('hidden');
                spinIcon.classList.remove('hidden');
                submitBtn.disabled = true;
                
                // Simulate loading
                setTimeout(() => {
                    spinIcon.classList.add('hidden');
                    successText.classList.remove('hidden');
                    
                    // Reset after 2 seconds
                    setTimeout(() => {
                        successText.classList.add('hidden');
                        updateText.classList.remove('hidden');
                        submitBtn.disabled = false;
                    }, 2000);
                }, 1500);
            });
            
            // Input field animations
            const inputs = document.querySelectorAll('.input-field');
            inputs.forEach(input => {
                input.addEventListener('focus', function() {
                    this.parentElement.classList.add('scale-105');
                });
                
                input.addEventListener('blur', function() {
                    this.parentElement.classList.remove('scale-105');
                });
            });
            
            // Add floating animation to profile elements
            const profileElements = document.querySelectorAll('.glass-effect, .profile-card');
            profileElements.forEach((element, index) => {
                element.style.animationDelay = `${index * 0.1}s`;
            });
        });
     </script>

</body>
</html>