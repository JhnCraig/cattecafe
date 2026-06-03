<?php
require_once 'config.php';

$host     = "localhost";
$username = "root";
$password = "abc123456";
$dbname   = "cafe_db"; 

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM cat_tbl"; 
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cat Cafe - Sweet Treats & Purrfect Moments</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/index.css">
   
</head>

<body>
     <?php include 'navbar.php'; ?>

            <a class="navbar-brand fw-bold text-white d-flex align-items-center" href="#">
                <i class="bi bi-cat-fill me-2 text-pink" style="color: var(--brand-pink);"></i> CATTÉ CAFÉ
            </a>

            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#menu">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="menu">
                <ul class="navbar-nav ms-auto text-center mt-3 mt-lg-0">
                    <li class="nav-item">
                        <a class="nav-link text-white smooth-transition" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white smooth-transition" href="menu.php">Menu</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white smooth-transition" href="cat.php">Cats</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white smooth-transition" href="#">Reservation</a>
                    </li>
                    <?php if (isset($_SESSION['user_id'])): ?>
  <li class="nav-item dropdown ms-lg-3">
    <a class="nav-link dropdown-toggle text-white text-decoration-none d-inline-flex align-items-center gap-2 px-3 py-2 rounded-5 profile-dropdown-toggle" 
       href="#" 
       role="button" 
       data-bs-toggle="dropdown" 
       aria-expanded="false"
       style="background-color: rgba(255,255,255,0.05); font-weight: 500; border-bottom: none !important;">
         <i class="bi bi-person-circle fs-5" style="color: var(--brand-pink);"></i> 
         <span>Hi, <?php echo htmlspecialchars($_SESSION['user_fname'] ?? 'Guest'); ?>!</span>
    </a>
    <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg mt-2" 
        style="background-color: #ffffff; border-radius: 16px; min-width: 200px; padding: 8px;">
        <li>
            <a class="dropdown-item small py-2.5 rounded-3 d-flex align-items-center gap-2 text-secondary" href="profile.php">
                <i class="bi bi-person fs-5" style="color: #d06a93;"></i> My Profile
            </a>
        </li>
        <li>
            <a class="dropdown-item small py-2.5 rounded-3 d-flex align-items-center gap-2 text-secondary" href="reservations.php">
                <i class="bi bi-calendar-check fs-5" style="color: #d06a93;"></i> My Bookings
            </a>
        </li>
        <li><hr class="dropdown-divider opacity-25 my-2"></li>
        <li>
            <a class="dropdown-item small py-2.5 rounded-3 d-flex align-items-center gap-2 text-danger fw-medium" href="logout.php">
                <i class="bi bi-box-arrow-right fs-5"></i> Log Out
            </a>
        </li>
    </ul>
</li>
<?php else: ?>
    <li class="nav-item ms-lg-3 mt-2 mt-lg-0">
        <a class="btn btn-outline-light btn-sm px-3 rounded-pill" href="login.php">Log In</a>
    </li>
    <li class="nav-item ms-lg-2 mt-2 mt-lg-0">
        <a class="btn btn-light btn-sm px-3 rounded-pill fw-semibold text-dark" href="signup.php">Sign Up</a>
    </li>
<?php endif; ?>
                    </li>
                </ul>
            </div>

        </div>
    </nav>

    <section class="hero">
        <div class="hero-content px-3">
            <div class="hero-title h1">
                Sweet Treats &<br>Purrfect Moments
            </div>
            <div class="hero-text">
                Enjoy delicious artisanal cakes, premium brewed coffees, and unforgettable <br class="d-none d-md-inline">
                moments wrapped in the cozy company of our lovable resident cats.
            </div>
            <button class="btn btn-pink px-5 py-3 shadow smooth-transition">
                Explore Menu <i class="bi bi-arrow-right ms-2"></i>
            </button>
        </div>
    </section>

    <section class="container py-5 my-4">
        <div class="row g-4 text-center justify-content-center">
            <div class="col-md-4 px-4">
                <div class="mb-3 text-center">
                    <div class="d-inline-flex align-items-center justify-content-center bg-white shadow-sm rounded-circle" style="width: 70px; height: 70px;">
                        <i class="bi bi-cup-hot fs-3" style="color: var(--brand-pink-hover);"></i>
                    </div>
                </div>
                <div class="fw-bold mb-2 h4">Artisanal Bakery</div>
                <div class="text-muted small">Freshly baked pastries and crafted espresso selections prepared daily by our expert baristas.</div>
            </div>
            <div class="col-md-4 px-4">
                <div class="mb-3 text-center">
                    <div class="d-inline-flex align-items-center justify-content-center bg-white shadow-sm rounded-circle" style="width: 70px; height: 70px;">
                        <i class="bi bi-heart fs-3" style="color: var(--brand-pink-hover);"></i>
                    </div>
                </div>
                <div class="fw-bold mb-2 h4">Therapeutic Space</div>
                <div class="text-muted small">Unwind and de-stress in an environment designed strictly for relaxation, warmth, and joy.</div>
            </div>
            <div class="col-md-4 px-4">
                <div class="mb-3 text-center">
                    <div class="d-inline-flex align-items-center justify-content-center bg-white shadow-sm rounded-circle" style="width: 70px; height: 70px;">
                        <i class="bi bi-shield-check fs-3" style="color: var(--brand-pink-hover);"></i>
                    </div>
                </div>
                <div class="fw-bold mb-2 h4">Safe & Happy Felines</div>
                <div class="text-muted small">Our rescued companions live in highly hygienic spaces with dedicated vet checks and infinite love.</div>
            </div>
        </div>
    </section>

    <hr class="container opacity-25">

    <section class="container py-5">
        <div class="text-center mb-5">
            <span class="section-badge">From Our Kitchen</span>
            <div class="section-title h2">Explore Our Signature Delights</div>
            <div class="text-muted mt-2">Handcrafted treats made with love to complement your feline friend date.</div>
        </div>

        <div class="row g-4">
            <div class="col-12 col-md-6 col-lg-3">
                <div class="card h-100 menu-card smooth-transition">
                    <div class="card-icon-header">
                        <div class="card-icon-circle">
                            <i class="bi bi-cake2"></i>
                        </div>
                    </div>
                    <div class="card-body d-flex flex-column text-center p-4">
                        <div class="card-title mb-2 h5">Cakes</div>
                        <div class="card-text text-muted small flex-grow-1">
                            Decadent and rich homemade layered signature cakes, crafted perfectly for sweet cravings.
                        </div>
                        <div class="mt-4">
                            <a href="#" class="btn btn-outline-custom w-100 smooth-transition">Order Now</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-6 col-lg-3">
                <div class="card h-100 menu-card smooth-transition">
                    <div class="card-icon-header">
                        <div class="card-icon-circle">
                            <i class="bi bi-cookie"></i>
                        </div>
                    </div>
                    <div class="card-body d-flex flex-column text-center p-4">
                        <div class="card-title mb-2 h5">Cookies</div>
                        <div class="card-text text-muted small flex-grow-1">
                            Freshly baked, crisp on the edges and soft-centered premium cookies straight from the oven.
                        </div>
                        <div class="mt-4">
                            <a href="#" class="btn btn-outline-custom w-100 smooth-transition">Order Now</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-6 col-lg-3">
                <div class="card h-100 menu-card smooth-transition">
                    <div class="card-icon-header">
                        <div class="card-icon-circle">
                            <i class="bi bi-box-seam"></i>
                        </div>
                    </div>
                    <div class="card-body d-flex flex-column text-center p-4">
                        <div class="card-title mb-2 h5">Brownies</div>
                        <div class="card-text text-muted small flex-grow-1">
                            Fudgy, dense, and premium rich dark chocolate square brownies dusted with love.
                        </div>
                        <div class="mt-4">
                            <a href="#" class="btn btn-outline-custom w-100 smooth-transition">Order Now</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-6 col-lg-3">
                <div class="card h-100 menu-card smooth-transition">
                    <div class="card-icon-header">
                        <div class="card-icon-circle">
                            <i class="bi bi-cup-straw"></i>
                        </div>
                    </div>
                    <div class="card-body d-flex flex-column text-center p-4">
                        <div class="card-title mb-2 h5">Drinks</div>
                        <div class="card-text text-muted small flex-grow-1">
                            Expertly brewed hot espresso blends and refreshing, artisanal iced companion creations.
                        </div>
                        <div class="mt-4">
                            <a href="#" class="btn btn-outline-custom w-100 smooth-transition">Order Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="py-5 mt-5" style="background-color: var(--brand-dark); color: rgba(255,255,255,0.75);">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-5 col-md-12">
                    <div class="text-white fw-bold mb-3 h5"><i class="bi bi-cat-fill me-2 text-pink" style="color: var(--brand-pink);"></i> CAT CAFE</div>
                    <div class="small text-muted mb-0" style="max-width: 380px;">
                        A safe sanctuary where coffee aroma marries sweet purrs. Come visit us for unique baked pastries and cozy feline therapy.
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="text-white fw-semibold mb-3 small text-uppercase h6" style="letter-spacing: 1px;">Quick Links</div>
                    <ul class="list-unstyled small">
                        <li class="mb-2"><a href="#" class="text-decoration-none link-light opacity-75">Our Pastry Menu</a></li>
                        <li class="mb-2"><a href="cat.php" class="text-decoration-none link-light opacity-75">Meet the Cats</a></li>
                        <li class="mb-2"><a href="#" class="text-decoration-none link-light opacity-75">Book a Reservation</a></li>
                    </ul>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="text-white fw-semibold mb-3 small text-uppercase h6" style="letter-spacing: 1px;">Hours & Location</div>
                    <div class="small mb-1 text-light opacity-75"><i class="bi bi-clock me-2"></i> Mon - Sun: 9:00 AM - 9:00 PM</div>
                    <div class="small text-light opacity-75"><i class="bi bi-geo-alt me-2"></i> 123 Purrfect Lane, Velvet City</div>
                </div>
            </div>
            <hr class="my-4 opacity-10">
            <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center small">
                <div class="mb-0 text-muted">&copy; <?php echo date("Y"); ?> Cat Cafe. All rights reserved.</div>
                <div class="d-flex gap-3 mt-3 mt-sm-0">
                    <a href="#" class="text-white opacity-75"><i class="bi bi-instagram"></i></a>
                    <a href="#" class="text-white opacity-75"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="text-white opacity-75"><i class="bi bi-tiktok"></i></a>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>