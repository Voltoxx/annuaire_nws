<!DOCTYPE html>
<html>

<head>
    <title>
        <?php echo $title ?>
    </title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="shortcut icon" href="../assets/logo.jpg" type="image/x-icon">
</head>

<body>
    <header>
        <nav>
            <ul>
                <li><a href="../index.php?page=list">Liste</a></li>
                <li><a href="../index.php?page=add">Ajouter</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <?php echo $content ?>
    </main>
    <footer>
        <div>
            <div>
                <div>
                    <p>&copy; <?php echo date("Y"); ?> Annuaire NWS</p>
                </div>
                <div>
                    <ul>
                        <li><a href="#">Politique de confidentialité</a></li>
                        <li><a href="#">Politique des cookies</a></li>
                        <li><a href="#">Nous Contacter</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
</body>

</html>