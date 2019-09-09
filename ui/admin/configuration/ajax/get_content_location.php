<?php
/* 
 * Web Handler
 * Get Content Location Action
 * @param string $xpath
 *  string  for xpath
 * @param in $content
 *  string  for content
 * @param in $match (dropdown)
 *  string  for match
 * value for match dropdown 1.contain 2.equals
 */
$xpath = isset($data['data']['xpath']) ? $data['data']['xpath'] : '';
$content = isset($data['data']['content']) ? $data['data']['content'] : '';
$match = isset($data['data']['match']) ? $data['data']['match'] : '';
$mode = isset($data['data']['output']) ? $data['data']['output'] : '';
$wait_time = isset($data['on_success']['next']['wait_time']) ? $data['on_success']['next']['wait_time'] : '';
$next_action = isset($data['on_success']['next']['next_action']) ? $data['on_success']['next']['next_action'] : '';
$comment = isset($data['nm']) ? $data['nm'] : '';
?>
<div class="tab-pane" id="<?php echo $classid ?>">
    <h3> Get Content Location</h3>
    <div class="show-me12">
        <div class="form-group">
            <label for="sel1" class="cell-po">Label</label>
            <input type="text"  id="label-<?php echo $classid ?>" value="<?php echo $label; ?>" class="label-entity form-control" name="<?php echo $classid . "[label]"; ?>">    
        </div>
    </div>
    <div class="form-group">
        <label for="sel1" class="cell-po" >X-Path<span style="color:red;">*</span></label>
        <input type="text" value="<?php echo htmlspecialchars($xpath); ?>" class="form-control width-100 mandatory_field" placeholder="" name="<?php echo $classid . "[xpath]"; ?>" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
    </div>
    <div class="form-group">
        <label for="sel1" class="cell-po" >Content<span style="color:red;">*</span></label>
        <input type="text" value="<?php echo htmlspecialchars($content); ?>" class="form-control width-100 mandatory_field" placeholder="" name="<?php echo $classid . "[content]"; ?>" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
    </div>
    <div class="form-group">
        <label for="sel1" class="cell-po" >Match<span style="color:red;">*</span></label>
        <select class="form-control width-100 mandatory_field" name="<?php echo $classid . "[match]"; ?>" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
            <option value="">Select Match Type</option>
            <option value="contain" <?php echo ($match == "contain") ? 'selected' : ''; ?>>Contain</option>
            <option value="equals" <?php echo ($match == "equals") ? 'selected' : ''; ?>>Equals</option>
        </select>
    </div>
    <div class="form-group">
        <label for="sel1" class="cell-po" >Output<span style="color:red;">*</span></label>
        <select class="form-control width-100 mandatory_field" name="<?php echo $classid . "[output]"; ?>" data-id="output-<?php echo $classid ?>"  data-class="output-options-<?php echo $classid ?>" data-check="blank" data-error="This field is required" data-createform-id="<?php echo $classid ?>">
            <option value="">Please Select Output </option>
            <option value="id" <?= $mode == 'id' ? ' selected="selected"' : ''; ?>>ID</option>
            <option value="name" <?= $mode == 'name' ? 'selected="selected"' : ''; ?>>Name</option>
            <option value="xpath" <?= $mode == 'xpath' ? 'selected="selected"' : ''; ?>>X Path</option>
            <option value="class" <?= $mode == 'class' ? 'selected="selected"' : ''; ?>>Class Name</option>
            <option value="css" <?= $mode == 'css' ? 'selected="selected"' : ''; ?>>CSS Selector</option>
        </select>   
    </div>
    <hr>
    <?php if (!isset($validationjsonArr['web'][$type]) || !empty($validationjsonArr['web'][$type]['output'])) { ?>
        <?php include('output.php'); ?>
    <?php } ?>   
    <?php include('failure.php'); ?>
    <?php include('advance.php'); ?>
    <div class="collapse-box" data-toggle="collapse" data-target=".demo82">Comments</div>
    <div class="demo82 collapse collapse-content">
        <div class="collapse-container">
            <textarea class="form-control width-100" rows="5" id="comment" name="<?php echo $classid . "[comment]"; ?>"><?php echo $comment; ?></textarea>
        </div>
    </div>
</div>

