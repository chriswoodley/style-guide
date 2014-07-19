<nav id="nav" role="main">
    <h3>Modules</h3>
    <ul>
        <li><a href="index.php">Home</a></li>
        <?php

            foreach ($kss->getTopLevelSections() as $topLevelSection) {
                echo '<li>
                    <a href="reference.php?ref='.$topLevelSection->getReference().'" title="'.$topLevelSection->getDescription().'">' .
                        $topLevelSection->getTitle() .
                    '</a>' .
                '</li>';
            }
        ?>
    </ul>
</nav>
