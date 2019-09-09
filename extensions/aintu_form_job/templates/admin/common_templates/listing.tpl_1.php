<section>
    <div class="panel-body">
        <table id="bug_list1" cellpadding="0" cellspacing="0" border="0" class="table table-striped">
            <thead>
                <tr>
                    <th class="text-center2">
                        <?php echo $ui_string['h_s.no']; ?>
                    </th>
                    <th class="text-center2">
                        <?php echo $ui_string['h_incident_id']; ?>
                    </th>
                    <th class="text-center2">
                        <?php echo $ui_string['h_creation_date']; ?>
                    </th>
                    <th class="text-center2">
                        <?php echo $ui_string['h_last_reply']; ?>
                    </th>
                    <th class="text-center2">
                        <?php echo $ui_string['h_assignee']; ?>
                    </th>
                    <th class="text-center2">
                        <?php echo $ui_string['h_title']; ?>
                    </th>
                    <th class="text-center2">
                        <?php echo $ui_string['h_description']; ?>
                    </th>
                    <th class="text-center2">
                        <?php echo $ui_string['h_status']; ?>
                    </th>
                    <!--<th>Action</th>-->
                </tr>
            </thead>
            <tbody align="center">
                <?php
                if (!empty($request_data['show_details'])) {
                    $cnt = 1;
                    foreach ($request_data['show_details']['data'] as $val) {
                        ?>
                        <tr class="gradeX">
                            <td class="text-center2"><?= $cnt; ?></td>
                            <td class="text-center2"><a href="javascript:void(0)">TKT-<?= $val['id']; ?></a></td>
                            <td class="text-center2"><a href="javascript:void(0)"><?= $val['date']; ?></a></td>
                            <td class="text-center2"><a href="javascript:void(0)"><?= $val['date']; ?></a></td>
                            <td class="text-center2"><a href="javascript:void(0)">William Shelver</a></td>
                            <td class="text-center2"><a href="javascript:void(0)"><?= $val['title']; ?></a></td>
                            <td class="text-center2"><a href="javascript:void(0)"><?= $val['description']; ?></a></td>
                            <td class="text-center2"><a href="javascript:void(0)"><?= $val['status']; ?></a></td>
                        </tr>
                        <?php $cnt++;
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
    <div>
<?= !empty($request_data['pagination']) ? $request_data['pagination'] : ''; ?>
    </div>
</section>