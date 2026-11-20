
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>tp7</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<nav class="navbar navbar-dark bg-dark mb-4">
    <div class="container">
        <a class="navbar-brand" href="index.php">Centre de Formation</a>
        <div class="d-flex gap-2">
            <a href="formations/index.php" class="btn btn-outline-light btn-sm">Formations</a>
            <a href="etudiants/index.php" class="btn btn-outline-light btn-sm">Étudiants</a>
            <a href="modules/index.php" class="btn btn-outline-light btn-sm">Modules</a>
        </div>
    </div>
</nav>

<div class="container py-3">
   
    <div class="row g-4">
        <div class="col-md-4">
            <div class="card shadow-sm h-100 bg-white">
                <div class="card-body">
                    <h5 class="card-title">Formations</h5>
                    <p class="card-text text-muted">Programmes et tarifs disponibles.</p>
                    <a href="formations/index.php" class="btn btn-primary">Gérer les formations</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm h-100 bg-white">
                <div class="card-body">
                    <h5 class="card-title">Étudiants</h5>
                    <p class="card-text text-muted">Inscriptions et affectations.</p>
                    <a href="etudiants/index.php" class="btn btn-primary">Gérer les étudiants</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm h-100 bg-white">
                <div class="card-body">
                    <h5 class="card-title">Modules</h5>
                    <p class="card-text text-muted">Cours et volumes horaires.</p>
                    <a href="modules/index.php" class="btn btn-primary">Gérer les modules</a>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>