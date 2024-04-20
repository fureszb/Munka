<!DOCTYPE html>
<html lang="hu">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sikeres Bejelentkezés</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../style.css">

</head>

<body>
    <div class="container mt-5">
        <?php session_start(); ?>
        <?php
        if (isset($_SESSION['message'])) {
        ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-success" role="alert">
                        <?php echo $_SESSION['message']; ?>
                    </div>
                    <p>További tartalom...</p>
                    <a href="../Controller/EsemenyController.php?action=logout" class="btn btn-warning">Kijelentkezés</a>

                </div>
            </div>
        <?php
        } else {
        ?>
            <div class="container mt-5">
                <div class="row">
                    <div class="col-md-12">
                        <div class="alert alert-danger" role="alert">
                            Jelentkezz be, a profilod eléréséhez!
                        </div>
                        <a href="index.php" class="btn btn-primary">Kezdőlap</a>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>
</body>

</html>