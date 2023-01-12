<div class="page-title">
    <h1>Aktivitelerim</h1>
    <?php
    $count = mysqli_query($conn, "SELECT count(*) as top FROM activities WHERE activity_user = '$username'");
    $data = mysqli_fetch_assoc($count);
    echo '<span class="text-muted mt-3 font-weight-bold font-size-sm">Toplam: ' . $data["top"] . ' işlem</span>';
    ?>
</div>

<div class="product-category">
    <div class="page" style="width:100%;">
        <?php
            $countactivities = mysqli_query($conn, "SELECT count(*) as top FROM activities WHERE activity_user = '$username'");
            $data = mysqli_fetch_assoc($countactivities);
            $count = $data['top'];
            $iterator = 0;
            $page = 1;
            $size = 20;
            $top_page = ceil($count / $size);
            for ($page; $page <= $top_page; $page++) {
                echo '
                    <div class="';
                    if ($page != 1) {
                        echo ' disabled-message';
                    }
                    echo '" id="page-'.$page.'">
                        ';
                        $getactivities = mysqli_query($conn, "SELECT * FROM activities WHERE activity_user = '$username' ORDER BY activity_created DESC LIMIT $iterator, $size");
                        while ($rowactivities = mysqli_fetch_array($getactivities)) {
                            $activity_name = $rowactivities['activity_name'];
                            $activity_username = $rowactivities['activity_user'];
                            $activity_created = explode(" ", $rowactivities['activity_created']);
                            $activity_date = $activity_created[0];
                            $activity_time = explode(":", $activity_created[1]);
                            $activity_type = $rowactivities['activity'];
                            
                            if ($activity_type == 1) {
                                $color = "text-success";
                            } else if ($activity_type == 2) {
                                $color = "text-warning";
                            } else if ($activity_type == 3) {
                                $color = "text-danger";
                            } else if ($activity_type == 4) {
                                $color = "text-info";
                            } else if ($activity_type == 5) {
                                $color = "text-dark";
                            } else if ($activity_type == 6) {
                                $color = "text-primary";
                            }
                            if ($activity_date != $current_date) {
                                echo '<h5 class="activity-title">' . $activity_date . '</h5>';
                            }
                            echo '
                                <div class="timeline timeline-6 mt-3">
                                    <div class="timeline-item align-items-start">
                                        <div class="timeline-label font-weight-bolder text-dark-75 font-size-lg">' . $activity_time[0] . ':' . $activity_time[1] . '</div>
                                        <div class="timeline-badge">
                                            <i class="fa fa-genderless ' . $color . ' icon-xl"></i>
                                        </div>
                                        <div class="font-weight-mormal font-size-lg timeline-content text-muted pl-3">' . $activity_name . '</div>
                                    </div>
                                </div>
                                ';
                            $current_date = $activity_date;

                        }
                    echo '
                    </div>
                ';
                $iterator += $size;
            }
        ?>
    </div>
    
    <div class="d-flex justify-content-center align-items-center flex-wrap" style=" <?php if ($count <= $size) { echo 'opacity: 0; height: 0;'; } ?>">
        <div class="d-flex flex-wrap py-2 mr-3">
            <span class="btn btn-icon btn-sm btn-light-dark mr-2 my-1" id="pagination-0"><i class="ki ki-bold-arrow-back icon-xs"></i></span>
            <?php
                $countactivities = mysqli_query($conn, "SELECT count(*) as top FROM activities WHERE activity_user = '$username'");
                $data = mysqli_fetch_assoc($countactivities);
                $count = $data['top'];
                $iterator = 0;
                $page = 1;
                $size = 20;
                $top_page = ceil($count / $size);
                for ($page; $page <= $top_page; $page++) {
                    echo '
                        <span class="btn btn-icon btn-sm btn-light-dark mr-2 my-1';
                        if ($page == 1) {
                            echo ' active';
                        }
                        echo '" id="pagination-'.$page.'">'.$page.'</span>
                        <script>
                            document.getElementById("pagination-'.$page.'").addEventListener("click", open'.$page.');
                            function open'.$page.'() {';
                                for ($i = 0; $i <= $top_page + 1; $i++) {
                                    if ($i == $page) {
                                        echo '
                                        $("#page-'.$page.'").removeClass("disabled-message");
                                        $("#pagination-'.$page.'").addClass("active");';
                                    }
                                    else  {
                                        echo '
                                        $("#page-'.$i.'").addClass("disabled-message");
                                        $("#pagination-'.$i.'").removeClass("active");';
                                    }
                                }
                                echo '
                            }
                        </script>
                    ';
                }
            ?>
            <span class="btn btn-icon btn-sm btn-light-dark mr-2 my-1" id="pagination-x"><i class="ki ki-bold-arrow-next icon-xs"></i></span>
            <script>
                <?php
                echo '
                document.getElementById("pagination-0").addEventListener("click", open1);
                document.getElementById("pagination-x").addEventListener("click", open'.$top_page.');';
                ?>
            </script>
        </div>
    </div>
</div>

<?php
/*
 . ' - 
                    <div id="page-' . $page . '" style="width:100%;">asd';
                    $getactivities = mysqli_query($conn, "SELECT * FROM activities WHERE activity_user = '$username' ORDER BY activity_created DESC LIMIT $page, $size");
                    while ($rowactivities = mysqli_fetch_array($getactivities)) {
                        echo '</div>';
                        $activity_name = $rowactivities['activity_name'];
                        $activity_username = $rowactivities['activity_user'];
                        $activity_created = explode(" ", $rowactivities['activity_created']);
                        $activity_date = $activity_created[0];
                        $activity_time = explode(":", $activity_created[1]);
                        $activity_type = $rowactivities['activity'];

                        if ($activity_type == 1) {
                            $color = "text-success";
                        } else if ($activity_type == 2) {
                            $color = "text-warning";
                        } else if ($activity_type == 3) {
                            $color = "text-danger";
                        } else if ($activity_type == 4) {
                            $color = "text-info";
                        } else if ($activity_type == 5) {
                            $color = "text-dark";
                        } else if ($activity_type == 6) {
                            $color = "text-primary";
                        }
                        if ($activity_date != $current_date) {
                            echo '<h5 class="activity-title">' . $activity_date . '</h5>';
                        }
                        echo '
                            <div class="timeline timeline-6 mt-3">
                                <div class="timeline-item align-items-start">
                                    <div class="timeline-label font-weight-bolder text-dark-75 font-size-lg">' . $activity_time[0] . ':' . $activity_time[1] . '</div>
                                    <div class="timeline-badge">
                                        <i class="fa fa-genderless ' . $color . ' icon-xl"></i>
                                    </div>
                                    <div class="font-weight-mormal font-size-lg timeline-content text-muted pl-3">' . $activity_name . '</div>
                                </div>
                            </div>
                            ';
                        $current_date = $activity_date;
                    }
                    
*/
?>
