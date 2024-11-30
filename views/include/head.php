<?php
$loggedIn = isset($_SESSION['logged_in']) && $_SESSION['logged_in'];
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css"
          integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>

    <link rel="stylesheet" href="../assets/style.css">

    <title>ToDo список</title>
</head>
<body>

<div class="container my-1">
    <?php if (isset($_GET['success'])): ?>
        <div class="alert alert-success" role="alert">
            <?= $_GET['success'] ?>
        </div>
    <?php endif; ?>
    <?php if (isset($_GET['error'])): ?>
        <div class="alert alert-danger" role="alert">
            <?= $_GET['error'] ?>
        </div>
    <?php endif; ?>
</div>
<div class="container position-relative">
    <div class="auth-btn-block">
        <?php if ($loggedIn): ?>
            <a href="?action=logout" class="btn btn-danger">Выход</a>
        <?php else: ?>
            <a href="?action=login" class="btn btn-primary">Вход</a>
        <?php endif; ?>
    </div>