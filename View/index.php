<!DOCTYPE html>
<html lang="hu">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Bejelentkezés és Regisztráció</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../style.css">
</head>

<body>
    <div class="container mt-5">

        <!-- Hibaüzenetek és sikeres visszajelzések kiiratása -->
        <?php session_start(); ?>

        <?php if (isset($_SESSION['message'])) : ?>
            <div class="alert <?php echo ($_SESSION['message_type'] == 'true' ? 'alert-success' : 'alert-warning'); ?>" role="alert">
                <?php echo $_SESSION['message']; ?>
                <?php
                unset($_SESSION['message']);
                unset($_SESSION['message_type']);
                ?>
            </div>
        <?php endif; ?>



        <div class="row">
            <div class="col-md-6">
                <h3>Bejelentkezés</h3>
                <hr>
                <form action="../Controller/EsemenyController.php" method="post">
                    <input type="hidden" name="action" value="login">
                    <div class="form-group">
                        <label for="loginUsername">Felhasználónév</label>
                        <input type="text" class="form-control" id="loginUsername" name="fNev" required>
                    </div>
                    <div class="form-group">
                        <label for="loginPassword">Jelszó</label>
                        <input type="password" class="form-control" id="loginPassword" name="fJelszo" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Bejelentkezés</button>
                </form>
            </div>
            <div class="col-md-6">
                <h3>Regisztráció</h3>
                <hr>
                <form action="../Controller/EsemenyController.php" method="post">
                    <input type="hidden" name="action" value="register">
                    <div class="form-group">
                        <label for="regUsername">Felhasználónév</label>
                        <input type="text" class="form-control" id="regUsername" name="fNev" required>
                    </div>
                    <div class="form-group">
                        <label for="regEmail">Email cím</label>
                        <input type="email" class="form-control" id="regEmail" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="regPassword">Jelszó</label>
                        <input type="password" class="form-control" id="regPassword" name="fJelszo" required>
                    </div>
                    <button type="submit" class="btn btn-success">Regisztráció</button>
                </form>
            </div>
        </div>
    </div>
</body>
<footer class="footer mt-auto py-3">
    <div class="container">
        <p>Készítette: Fűrész Bence</p>
    </div>
</footer>

</html>