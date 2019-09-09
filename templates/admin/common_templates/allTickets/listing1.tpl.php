<section class="panel">
    <div class="panel-body">
        <header class="panel-heading">
            <div class="row">
                <?= $this->adv_version2($request_data['advanced_search_v2']); ?>
                <div class="col-md-2 text-right pull-right" id="">
                    <?php
                    echo $this->custom_buttons();
                    ?>
                </div>
            </div>
        </header>
        <div class="panel-body">
            <table id="employee-grid" cellpadding="0" cellspacing="0" border="0" class="table table-striped">
                <thead>
                    <tr>
                        <?php
                        $table_header = $this->get_table_header();
                        if (is_array($table_header) && count($table_header)) {
                            foreach ($table_header as $val) {
                                ?>
                                <th class="text-center2">
                                    <?= $ui_string[$val]; ?>
                                </th>
                                <?php
                            }
                            ?>
                        <?php } ?>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</section>

