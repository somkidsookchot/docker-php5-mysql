<?php

// Call Row_Rendering event
$expensescategory->Row_Rendering();

// exp_cat_title
// Call Row_Rendered event

$expensescategory->Row_Rendered();
?>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
	<tbody>
<?php if ($expensescategory->exp_cat_title->Visible) { // exp_cat_title ?>
		<tr id="r_exp_cat_title">
			<td width="170" class="ewTableHeader"><?php echo $expensescategory->exp_cat_title->FldCaption() ?></td>
			<td<?php echo $expensescategory->exp_cat_title->CellAttributes() ?>>
<div<?php echo $expensescategory->exp_cat_title->ViewAttributes() ?>><?php echo $expensescategory->exp_cat_title->ListViewValue() ?></div></td>
		</tr>
<?php } ?>
	</tbody>
</table>
</div>
</td></tr></table>
<br>
