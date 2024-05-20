<?php require_once "layout/header.php" ?>

<?php
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit;
}

?>


<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Dashboard</h1>
    <p>Id: <?= $_SESSION['admin_id']; ?></p>
    <p>Name: <?= $_SESSION['admin_name']; ?></p>
    <p>Email: <?= $_SESSION['admin_email']; ?></p>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
<?php require_once "layout/footer.php"; ?>