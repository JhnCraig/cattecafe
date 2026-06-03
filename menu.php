<?php
session_start();
$host     = "localhost";
$username = "root";
$password = "abc123456";
$dbname   = "cafe_db"; 
$charset  = "utf8mb4";

$dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
     $pdo = new PDO($dsn, $username, $password, $options);
} catch (\PDOException $e) {
     die("Database connection failed: " . $e->getMessage());
}

$stmt = $pdo->query("SELECT * FROM menuitem_tbl ORDER BY category, item_id ASC");
$all_items = $stmt->fetchAll();

$cats = $pdo->query("SELECT cat_id, cat_name FROM cat_tbl")->fetchAll();

$brownies = [];
$cookies  = [];
$drinks   = []; 
$cakes    = []; 

foreach ($all_items as $item) {
    $category = strtolower($item['category']); 
    
    if ($category === 'brownie' || $category === 'brownies') {
        $brownies[] = $item;
    } elseif ($category === 'cookie' || $category === 'cookies') {
        $cookies[] = $item;
    } elseif ($category === 'coffee' || $category === 'drink' || $category === 'drinks') { 
        $drinks[] = $item;
    } elseif ($category === 'cake' || $category === 'cakes') {
        $cakes[] = $item;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Menu - Cat Cafe Lounge</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="css/menu.css">
</head>

<body>

    <?php include 'navbar.php'; ?>

    <section class="page-banner">
        <div class="container text-white">
            <div class="display-5 fw-bold mb-2 h1">Our Culinary Menu</div>
            <div class="lead text-white-50 small font-monospace text-uppercase tracking-wider">Artisan pastries &
                premium house blends prepared daily</div>
        </div>
    </section>

    <div class="container py-5">
        <ul class="nav nav-pills justify-content-center gap-2 mb-5" id="menuControlPicker" role="tablist">
            <li class="nav-item"><button class="nav-link nav-link-picker rounded-pill active" id="brownies-tab"
                    data-bs-toggle="pill" data-bs-target="#pane-brownies" type="button"><i
                        class="bi bi-grid-3x3-gap me-2"></i> Brownies</button></li>
            <li class="nav-item"><button class="nav-link nav-link-picker rounded-pill" id="cookies-tab"
                    data-bs-toggle="pill" data-bs-target="#pane-cookies" type="button"><i class="bi bi-cookie me-2"></i>
                    Cookies</button></li>
            <li class="nav-item"><button class="nav-link nav-link-picker rounded-pill" id="drinks-tab"
                    data-bs-toggle="pill" data-bs-target="#pane-drinks" type="button"><i class="bi bi-cup-hot me-2"></i>
                    Drinks</button></li>
            <li class="nav-item"><button class="nav-link nav-link-picker rounded-pill" id="cakes-tab"
                    data-bs-toggle="pill" data-bs-target="#pane-cakes" type="button"><i class="bi bi-cake2 me-2"></i>
                    Cakes</button></li>
        </ul>

        <div class="tab-content" id="menuControlPickerContent">
            <?php 
            function render_menu_grid($items, $is_brownie_tab = false) {
                if (!empty($items)): 
                    foreach ($items as $item): ?>
            <div class="col">
                <div class="card menu-card h-100 d-flex flex-column justify-content-between">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <div class="card-title fw-bold text-dark mb-0 h5">
                                <?= htmlspecialchars($item['item_name']); ?>
                                <?php if($is_brownie_tab && isset($item['item_id']) && $item['item_id'] == 5): ?>
                                <span class="badge item-badge badge-signature ms-2">Signature</span>
                                <?php endif; ?>
                            </div>
                            <span class="item-price ms-2">₱
                                <?= number_format($item['price'], 2); ?>
                            </span>
                        </div>
                        <div class="card-text text-muted item-description mb-0">
                            <?= htmlspecialchars($item['description']); ?>
                        </div>
                    </div>
                    <div class="card-action-box p-3 mt-auto">
                        <div class="row g-2">
                            <div class="col-6">
                                <button class="btn btn-bag w-100 btn-add-bag" data-id="<?= $item['item_id']; ?>"
                                    data-name="<?= htmlspecialchars($item['item_name']); ?>"
                                    data-price="<?= $item['price']; ?>">
                                    <i class="bi bi-bag me-1"></i> + Bag
                                </button>
                            </div>
                            <div class="col-6">
                                <button class="btn btn-order w-100 btn-order-now" data-id="<?= $item['item_id']; ?>"
                                    data-name="<?= htmlspecialchars($item['item_name']); ?>"
                                    data-price="<?= $item['price']; ?>">
                                    Buy Now
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach;
                else: ?>
            <div class="col-12 text-center py-4">
                <div class="text-muted">No items found under this section.</div>
            </div>
            <?php endif; 
            } ?>

            <div class="tab-pane fade show active" id="pane-brownies" role="tabpanel">
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                    <?php render_menu_grid($brownies, true); ?>
                </div>
            </div>
            <div class="tab-pane fade" id="pane-cookies" role="tabpanel">
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                    <?php render_menu_grid($cookies); ?>
                </div>
            </div>
            <div class="tab-pane fade" id="pane-drinks" role="tabpanel">
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                    <?php render_menu_grid($drinks); ?>
                </div>
            </div>
            <div class="tab-pane fade" id="pane-cakes" role="tabpanel">
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                    <?php render_menu_grid($cakes); ?>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="orderModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content p-4">
                <div class="modal-header border-0">
                    <div class="modal-title fw-bold h5">Order Preference</div>
                </div>
                <div class="modal-body">
                    <div id="step1">
                        <button class="btn btn-outline-dark w-100 mb-2" onclick="savePref('Dine-in')">Dine-in</button>
                        <button class="btn btn-outline-dark w-100 mb-2" onclick="savePref('Delivery')">Delivery</button>
                        <button class="btn btn-dark w-100" onclick="showStep('step2')">Pre-order</button>
                    </div>
                    <div id="step2" style="display:none;">
                        <div class="mb-3">Would you like to book a cat companion?</div>
                        <button class="btn btn-dark w-100 mb-2" onclick="showStep('step3')">Yes, choose a cat</button>
                        <button class="btn btn-outline-secondary w-100" onclick="savePref('Pre-order')">No, just
                            food</button>
                    </div>
                    <div id="step3" style="display:none;">
                        <select class="form-select mb-3" id="catSelect">
                            <?php foreach($cats as $cat): ?>
                            <option value="<?= $cat['cat_id'] ?>">
                                <?= htmlspecialchars($cat['cat_name']) ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                        <button class="btn btn-dark w-100" onclick="saveCatBooking()">Confirm & Book</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="py-4 text-center bg-dark text-white-50 border-top border-secondary border-opacity-10">
        <div class="small mb-0">&copy; 2026 Cat Cafe Lounge. Curated and crafted responsibly.</div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const saveToBag = (id, name, price) => {
                let currentBag = JSON.parse(localStorage.getItem('cafe_bag')) || [];
                const searchIdx = currentBag.findIndex(item => item.id === id);
                if (searchIdx > -1) currentBag[searchIdx].quantity += 1;
                else currentBag.push({ id, name, price: parseFloat(price), quantity: 1 });
                localStorage.setItem('cafe_bag', JSON.stringify(currentBag));
            };

            document.querySelectorAll('.btn-add-bag').forEach(btn => {
                btn.addEventListener('click', (e) => {
                    const ds = e.currentTarget.dataset;
                    saveToBag(ds.id, ds.name, ds.price);
                    alert(`${ds.name} successfully added to your bag!`);
                });
            });

            document.querySelectorAll('.btn-order-now').forEach(btn => {
                btn.addEventListener('click', (e) => {
                    const ds = e.currentTarget.dataset;
                    saveToBag(ds.id, ds.name, ds.price);
                    document.getElementById('step1').style.display = 'block';
                    document.getElementById('step2').style.display = 'none';
                    document.getElementById('step3').style.display = 'none';
                    new bootstrap.Modal(document.getElementById('orderModal')).show();
                });
            });
        });

        if (typeof showStep !== 'function') {
            window.showStep = function (id) {
                document.getElementById('step1').style.display = 'none';
                document.getElementById('step2').style.display = 'none';
                document.getElementById('step3').style.display = 'none';
                document.getElementById(id).style.display = 'block';
            }
        }

        if (typeof savePref !== 'function') {
            window.savePref = function (type) {
                localStorage.setItem('order_type', type);
                window.location.href = 'bags.html';
            }
        }

        if (typeof saveCatBooking !== 'function') {
            window.saveCatBooking = function () {
                localStorage.setItem('order_type', 'Pre-order');
                localStorage.setItem('cat_id', document.getElementById('catSelect').value);
                window.location.href = 'bags.html';
            }
        }
    </script>
</body>

</html>