
<?php foreach($data as $array){ ?>
<a  <?php echo $array['attr']; ?>>
<div class="display_block">
		<div class="custom_button btn btn-default"
			data-toggle="popover" data-placement="bottom"
			data-content="<?php echo $array['hover_desc']; ?>"
			data-original-title="<?php echo $array['hover_head']; ?>">
			<i class="<?php echo $array['icon']; ?>"></i><br /> <span><?php echo $array['name']; ?></span>
		</div>
</div>
</a>
<?php } ?>