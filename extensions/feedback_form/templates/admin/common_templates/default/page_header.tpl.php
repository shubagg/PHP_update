<section class="panel" style="">
    <header class="panel-heading sm">
        <div class="row">
            <div class="col-md-6">
                <h3><?= !empty($request_data['page_heading']) ? $ui_string[$request_data['page_heading']] : ''; ?></h3>
            </div>
            <div class="col-md-6 text-right">
                <!-- Split button -->
                <div class="btn-group">
                    <button type="button" class="btn btn-default" id="export1">Export XLS</button>
                </div>
                <div class="btn-group">
                    <button type="button" id="projects1" name="projects1" class="btn btn-default dropdown-toggle" data-toggle="dropdown">Filter by Projects <span class="caret"></span> <span class="sr-only">Toggle Dropdown</span> </button>
                    <ul class="dropdown-menu align-xs-left " role="menu">
                        <?php
                        if (!empty($project_details['data'])) {
                            $current_project = '';
                            $project_lists = '';
                            foreach ($project_details['data'] as $project_val) {
                                $pro_url = $admin_ui_url . 'job/all_ticket.php?job=2&project=' . $project_val['id'];
                                if ($project_val['id'] == $selected_project) {
                                    $current_project .= "<span class='headings'>Current Project </span>";
                                    $current_project .= "<li><a href='javascript:void(0)'>{$project_val['name']}</a></li>";
                                    $current_project .= "<li class='divider'></li>";
                                } else {
                                    $project_lists .= "<li><a href='{$pro_url}' id='{$project_val['id']}' class='project_dropdown'>{$project_val['name']}</a></li>";
                                }
                                ?>

                                <?php
                            }
                            echo $current_project;
                            echo $project_lists;
                        }
                        ?>
                        <li class="divider"></li>
                        <li><a href="<?php echo $admin_ui_url; ?>project/project.php">View All Projects</a></li>
                    </ul>
                </div>
                <!-- Split button -->
                <div class="btn-group">
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">Filter By Type <span class="caret"></span> <span class="sr-only">Toggle Dropdown</span> </button>
                    <ul class="dropdown-menu align-xs-left " role="menu">
                        <li><a onclick="show_datatable(0, 1)">P-1</a></li>
                        <li><a onclick="show_datatable(0, 2)">P-2</a></li>
                        <li><a onclick="show_datatable(0, 3)">P-3</a></li>
                        <li><a onclick="show_datatable(0, 4)">P-4</a></li>
                        <li><a onclick="show_datatable(0, 5)">P-5</a></li>
                        <li><a onclick="show_datatable(0, 0)">View All</a></li>
                    </ul>
                </div>
                <div class="btn-group">
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"> Issue <span class="caret"></span> <span class="sr-only">Toggle Dropdown</span> </button>
                    <ul class="dropdown-menu align-xs-left " role="menu">
                        <!--<li><a href="<?php echo $admin_ui_url; ?>job/all_ticket.php?status=1&user=<?php echo $_SESSION['user']['user_id']; ?>">My Open Issue</a></li>
                        <li><a href="<?php echo $admin_ui_url; ?>job/all_ticket.php?user=<?php echo $_SESSION['user']['user_id']; ?>">Reported By Me</a></li>-->
                        <li><a onclick="show_datatable(1)">My Open Issue</a></li>
                        <li><a onclick="show_datatable(0)">Reported By Me</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </header>
</section>