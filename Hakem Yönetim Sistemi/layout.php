<?php include("partials/_header-mobile.php"); ?>
<div class="d-flex flex-column flex-root">
    <div class="d-flex flex-row flex-column-fluid page">
        <?php include("partials/_aside.php"); ?>
        <div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">
            <?php include("partials/_header.php"); ?>
            <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
                <?php
                    if ($_GET) {
                        $page = 'pages/' . $_GET['page'];
                        echo '<div class="content-area">';
                            include($page . '.php');
                        echo '</div>';
                    } else {
                        $page = 'partials/_content';
                        include($page . '.php');
                    }
                ?>
            </div>
            <?php include("partials/_footer.php"); ?>
        </div>
    </div>
</div>
