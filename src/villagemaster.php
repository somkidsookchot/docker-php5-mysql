<?php

// Call Row_Rendering event
$village->Row_Rendering();

// t_code
// v_code
// v_title
// Call Row_Rendered event

$village->Row_Rendered();
?>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
	<tbody>
<?php if ($village->t_code->Visible) { // t_code ?>
		<tr id="r_t_code">
			<td class="ewTableHeader"><?php echo $village->t_code->FldCaption() ?></td>
			<td<?php echo $village->t_code->CellAttributes() ?>>
<div<?php echo $village->t_code->ViewAttributes() ?>><?php echo $village->t_code->ListViewValue() ?></div></td>
		</tr>
<?php } ?>
<?php if ($village->v_code->Visible) { // v_code ?>
		<tr id="r_v_code">
			<td class="ewTableHeader"><?php echo $village->v_code->FldCaption() ?></td>
			<td<?php echo $village->v_code->CellAttributes() ?>>
<div<?php echo $village->v_code->ViewAttributes() ?>><?php echo $village->v_code->ListViewValue() ?></div></td>
		</tr>
<?php } ?>
<?php if ($village->v_title->Visible) { // v_title ?>
		<tr id="r_v_title">
			<td class="ewTableHeader"><?php echo $village->v_title->FldCaption() ?></td>
			<td<?php echo $village->v_title->CellAttributes() ?>>
<div<?php echo $village->v_title->ViewAttributes() ?>><?php echo $village->v_title->ListViewValue() ?></div></td>
		</tr>
<?php } ?>
	</tbody>
</table>
</div>
</td></tr></table>
<br>
