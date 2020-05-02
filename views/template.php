<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meu Site</title>
    <link rel="stylesheet" href=<?php echo BASE_URL."assets/css/tamplate.css"; ?>>
</head>
<body>
    <?php $this->loadViewInTemplate($viewName,$viewData) ?>
</body>
</html>