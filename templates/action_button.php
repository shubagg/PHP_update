<?php foreach($data as $button){  ?>  
<a <?php echo $button['attr'] ?> id="<?php echo $unique_id."-".$id; ?>" data-id="<?php echo $id; ?>" class="btn btn-default btn-sm" title="<?php echo $button['title'] ?>">
    <i class="<?php echo $button['icon'] ?>"></i>
</a>&nbsp;
<?php }  ?>

