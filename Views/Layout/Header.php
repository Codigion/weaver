<!DOCTYPE html>
<html>

<head>
    <!-- Set the page title based on the retrieved meta data -->
    <title><?= MetaData::get()['title'] ?></title>

    <!-- Include Master CSS from the base URL -->
    <link rel="stylesheet" href="<?= Generic::baseURL(); ?>/Assets/CSS/Master.css">

    <!-- Include Master JS from the base URL -->
    <script src="<?= Generic::baseURL(); ?>/Assets/JS/Master.js"></script>
</head>

<body>
    
    <!-- Your HTML from Views/ -->
