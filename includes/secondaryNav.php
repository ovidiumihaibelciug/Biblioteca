
<?php 
    $link = explode('/',$_SERVER['SCRIPT_FILENAME']);
    $filename = $link[count($link) - 1];
?>
<div class="secondary-nav">
    <div class="secondary-nav-start">CNGI</div>
    <div class="secondary-nav-end">
        <a href="index.php" class="navbar-item <?= $filename == '' || $filename == 'index.php'  ? "active-secnav" : '' ?>">Biblioteca</a>
        <a href="evenimente.php" class="navbar-item <?= $filename == 'evenimente.php' ? "active-secnav" : '' ?>">Evenimente</a>
    </div>
</div>

