<?php
require_once 'config.php';

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $fname    = $conn->real_escape_string($_POST['Fname']);
    $mname    = $conn->real_escape_string($_POST['Mname']);
    $lname    = $conn->real_escape_string($_POST['Lname']);
    $email    = $conn->real_escape_string($_POST['email']);
    $contact  = $conn->real_escape_string($_POST['contact']);
    $pass     = $_POST['password'];
    $confirm_pass = $_POST['confirm_password'];

   
    if ($pass !== $confirm_pass) {
        $message = "<div class='alert alert-danger'>Passwords do not match!</div>";
    } else {
      
        $hashed_password = password_hash($pass, PASSWORD_DEFAULT);

      
        $checkEmail = $conn->query("SELECT email FROM customer_tbl WHERE email = '$email'");
        if ($checkEmail->num_rows > 0) {
            $message = "<div class='alert alert-warning'>This email is already registered!</div>";
        } else {
            
            $sql = "INSERT INTO customer_tbl (Fname, Mname, Lname, email, contact, password) 
                    VALUES ('$fname', '$mname', '$lname', '$email', '$contact', '$hashed_password')";

            if ($conn->query($sql) === TRUE) {
                $message = "<div class='alert alert-success'>Account created successfully! <a href='login.php' class='fw-bold'>Log In Here</a></div>";
            } else {
                $message = "<div class='alert alert-danger'>Error: " . $conn->error . "</div>";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create an Account - Cat Cafe</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/signup.css">
</head>

<body>

    <div class="container py-5 d-flex justify-content-center">
        <div class="card auth-card shadow">
            <div class="row g-0">

                <div class="col-lg-5 d-none d-lg-flex auth-side-panel flex-column justify-content-between text-center text-lg-start">
                    <div>
                        <a href="index.php" class="text-white text-decoration-none d-inline-flex align-items-center mb-4">
                            <i class="bi bi-cat-fill me-2 fs-4" style="color: var(--brand-pink);"></i>
                            <span class="fw-bold tracking-wider fs-5">CAT CAFE</span>
                        </a>
                    </div>

                    <div class="my-auto py-4">
                        <div class="h2 display-6 fw-bold text-white mb-3">Join Our Cozy Community</div>
                        <div class="text-white-50 font-weight-light small lh-lg">
                            Create an account to unlock faster seat reservations, save your favorite custom drinks, and
                            keep up with our adorable feline family records.
</div>
                    </div>

                    <div>
                        <div class="small text-white-50 mb-0">&copy; 2026 Cat Cafe Lounge.</p>
                    </div>
                </div>

                <div class="col-lg-7 p-4 p-sm-5 d-flex flex-column justify-content-center bg-white">

                    <div class="d-lg-none text-center mb-4">
                        <div class="d-inline-flex align-items-center justify-content-center mb-2" style="color: var(--brand-dark);">
                            <i class="bi bi-cat-fill fs-2 me-2" style="color: var(--brand-pink-hover);"></i>
                            <span class="fw-bold fs-4 brand-title">CAT CAFE</span>
                        </div>
                    </div>

                    <div class="mb-4 text-center text-lg-start">
                        <div class="h2 fw-bold text-dark mb-1">Create Account</div>
                        <div class="text-muted small">Please fill in your details to register.</div>
                    </div>

                    <?php echo $message; ?>

                    <form action="signup.php" method="POST" autocomplete="off">
                        
                        <div class="row g-2 mb-3">
                            <div class="col-md-4">
                                <div class="form-floating">
                                    <input type="text" class="form-control rounded-3" id="fName" name="Fname" placeholder="John" required>
                                    <label for="fName">First Name</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-floating">
                                    <input type="text" class="form-control rounded-3" id="mName" name="Mname" placeholder="Edward">
                                    <label for="mName">Middle Name</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-floating">
                                    <input type="text" class="form-control rounded-3" id="lName" name="Lname" placeholder="Doe" required>
                                    <label for="lName">Last Name</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="text" class="form-control rounded-3" id="contact" name="contact" placeholder="09123456789" required>
                            <label for="contact">Contact Number</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="email" class="form-control rounded-3" id="emailAddress" name="email" placeholder="name@example.com" required>
                            <label for="emailAddress">Email Address</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="password" class="form-control rounded-3" id="userPassword" name="password" placeholder="Password" required>
                            <label for="userPassword">Password</label>
                        </div>

                        <div class="form-floating mb-4">
                            <input type="password" class="form-control rounded-3" id="confirmPassword" name="confirm_password" placeholder="Confirm Password" required>
                            <label for="confirmPassword">Confirm Password</label>
                        </div>

                        <div class="form-check text-start mb-4 small">
                            <input class="form-check-input" type="checkbox" id="termsCheck" required>
                            <label class="form-check-label text-muted" for="termsCheck">
                                I agree to the <a href="#" class="text-decoration-none" style="color: #d06a93;">Terms of Service</a> & <a href="#" class="text-decoration-none" style="color: #d06a93;">Privacy Policy</a>
                            </label>
                        </div>

                        <button type="submit" class="btn btn-submit w-100 mb-4 shadow-sm">
                            Register Account
                        </button>

                        <div class="text-center">
                            <div class="small text-muted mb-3">Already have an account? <a href="login.php" class="fw-semibold text-decoration-none" style="color: #d06a93;">Log In Here</a></div>
                            <hr class="w-25 mx-auto opacity-25 my-3">
                            <a href="index.php" class="btn-back d-inline-flex align-items-center gap-2">
                                <i class="bi bi-arrow-left"></i> Back to Homepage
                            </a>
                        </div>

                    </form>

                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>