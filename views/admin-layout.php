<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portafolio - Aarón Carrizales</title>
    <!-- <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;700;900&display=swap" rel="stylesheet">  -->
    <link href="https://fonts.googleapis.com/css2?family=Bona+Nova&family=Raleway:wght@700;900&family=Roboto:wght@300;400;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css" integrity="sha512-hoalWLoI8r4UszCkZ5kL8vayOGVae1oxXe/2A4AO6J9+580uKHDO3JdHb7NzwwzK5xr/Fs0W40kiNHxM9vyTtQ==" crossorigin="" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="/build/css/app.css">
</head>
<body class="dashboard">

    <?php include_once __DIR__ . '/templates/admin-header.php'; ?>
    <div class="dashboard__grid">
        <?php include_once __DIR__ . '/templates/admin-sidebar.php'; ?>
        <main class="dashboard__contenido">
            <?php echo $contenido; ?>
        </main>
    </div>


    <script src="/build/js/main.min.js" defer></script>
            
</body>
</html>