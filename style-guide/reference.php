<?php
    require_once('includes/bootstrap.inc.php');
    require_once('includes/header.inc.php');

    $reference = (isset($_GET['ref']) && preg_match('/(\d+\.?)+/', $_GET['ref'])) ? $_GET['ref'] : '1';

    try {
        $section = $kss->getSection($reference);
    } catch (UnexpectedValueException $e) {
        $reference = '1';
        $section = $kss->getSection($reference);
    }
?>
<div id="content">
    

<h1><?php echo $section->getTitle(); ?></h1>

<?php
    foreach ($kss->getSectionChildren($reference) as $section) {
        require('includes/block.inc.php');
    }
?>

<?php
    require_once('includes/footer.inc.php');
?>
</div>