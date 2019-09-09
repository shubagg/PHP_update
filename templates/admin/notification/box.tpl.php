
<?php foreach($data as $array){ ?>
<a  <?php echo $array['attr']; ?>>
<div class="display_block">
		<div class="<?php echo $array['class']; ?>"
			data-toggle="popover" data-placement="bottom"
			data-content="<?php echo isset($array['hover_desc']) ? $array['hover_desc'] : ''; ?>"
			data-original-title="<?php echo isset($array['hover_head']) ? $array['hover_head'] : ''; ?>">


			<span><?php echo $array['name']; ?></span>
		</div>
</div>
</a>
<?php } ?>