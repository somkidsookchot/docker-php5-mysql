<?php

// Call Row_Rendering event
$view2->Row_Rendering();

// member_code
// id_code
// prefix
// gender
// fname
// lname
// age
// t_code
// village_id
// dead_date
// note
// dead_id
// member_status
// Call Row_Rendered event

$view2->Row_Rendered();
?>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
	<tbody>
<?php if ($view2->member_code->Visible) { // member_code ?>
		<tr id="r_member_code">
			<td class="ewTableHeader"><?php echo $view2->member_code->FldCaption() ?></td>
			<td<?php echo $view2->member_code->CellAttributes() ?>>
<div<?php echo $view2->member_code->ViewAttributes() ?>><?php echo $view2->member_code->ListViewValue() ?></div></td>
		</tr>
<?php } ?>
<?php if ($view2->id_code->Visible) { // id_code ?>
		<tr id="r_id_code">
			<td class="ewTableHeader"><?php echo $view2->id_code->FldCaption() ?></td>
			<td<?php echo $view2->id_code->CellAttributes() ?>>
<div<?php echo $view2->id_code->ViewAttributes() ?>><?php echo $view2->id_code->ListViewValue() ?></div></td>
		</tr>
<?php } ?>
<?php if ($view2->prefix->Visible) { // prefix ?>
		<tr id="r_prefix">
			<td class="ewTableHeader"><?php echo $view2->prefix->FldCaption() ?></td>
			<td<?php echo $view2->prefix->CellAttributes() ?>>
<div<?php echo $view2->prefix->ViewAttributes() ?>><?php echo $view2->prefix->ListViewValue() ?></div></td>
		</tr>
<?php } ?>
<?php if ($view2->gender->Visible) { // gender ?>
		<tr id="r_gender">
			<td class="ewTableHeader"><?php echo $view2->gender->FldCaption() ?></td>
			<td<?php echo $view2->gender->CellAttributes() ?>>
<div<?php echo $view2->gender->ViewAttributes() ?>><?php echo $view2->gender->ListViewValue() ?></div></td>
		</tr>
<?php } ?>
<?php if ($view2->fname->Visible) { // fname ?>
		<tr id="r_fname">
			<td class="ewTableHeader"><?php echo $view2->fname->FldCaption() ?></td>
			<td<?php echo $view2->fname->CellAttributes() ?>>
<div<?php echo $view2->fname->ViewAttributes() ?>><?php echo $view2->fname->ListViewValue() ?></div></td>
		</tr>
<?php } ?>
<?php if ($view2->lname->Visible) { // lname ?>
		<tr id="r_lname">
			<td class="ewTableHeader"><?php echo $view2->lname->FldCaption() ?></td>
			<td<?php echo $view2->lname->CellAttributes() ?>>
<div<?php echo $view2->lname->ViewAttributes() ?>><?php echo $view2->lname->ListViewValue() ?></div></td>
		</tr>
<?php } ?>
<?php if ($view2->age->Visible) { // age ?>
		<tr id="r_age">
			<td class="ewTableHeader"><?php echo $view2->age->FldCaption() ?></td>
			<td<?php echo $view2->age->CellAttributes() ?>>
<div<?php echo $view2->age->ViewAttributes() ?>><?php echo $view2->age->ListViewValue() ?></div></td>
		</tr>
<?php } ?>
<?php if ($view2->t_code->Visible) { // t_code ?>
		<tr id="r_t_code">
			<td class="ewTableHeader"><?php echo $view2->t_code->FldCaption() ?></td>
			<td<?php echo $view2->t_code->CellAttributes() ?>>
<div<?php echo $view2->t_code->ViewAttributes() ?>><?php echo $view2->t_code->ListViewValue() ?></div></td>
		</tr>
<?php } ?>
<?php if ($view2->village_id->Visible) { // village_id ?>
		<tr id="r_village_id">
			<td class="ewTableHeader"><?php echo $view2->village_id->FldCaption() ?></td>
			<td<?php echo $view2->village_id->CellAttributes() ?>>
<div<?php echo $view2->village_id->ViewAttributes() ?>><?php echo $view2->village_id->ListViewValue() ?></div></td>
		</tr>
<?php } ?>
<?php if ($view2->dead_date->Visible) { // dead_date ?>
		<tr id="r_dead_date">
			<td class="ewTableHeader"><?php echo $view2->dead_date->FldCaption() ?></td>
			<td<?php echo $view2->dead_date->CellAttributes() ?>>
<div<?php echo $view2->dead_date->ViewAttributes() ?>><?php echo $view2->dead_date->ListViewValue() ?></div></td>
		</tr>
<?php } ?>
<?php if ($view2->note->Visible) { // note ?>
		<tr id="r_note">
			<td class="ewTableHeader"><?php echo $view2->note->FldCaption() ?></td>
			<td<?php echo $view2->note->CellAttributes() ?>>
<div<?php echo $view2->note->ViewAttributes() ?>><?php echo $view2->note->ListViewValue() ?></div></td>
		</tr>
<?php } ?>
<?php if ($view2->dead_id->Visible) { // dead_id ?>
		<tr id="r_dead_id">
			<td class="ewTableHeader"><?php echo $view2->dead_id->FldCaption() ?></td>
			<td<?php echo $view2->dead_id->CellAttributes() ?>>
<div<?php echo $view2->dead_id->ViewAttributes() ?>><?php echo $view2->dead_id->ListViewValue() ?></div></td>
		</tr>
<?php } ?>
<?php if ($view2->member_status->Visible) { // member_status ?>
		<tr id="r_member_status">
			<td class="ewTableHeader"><?php echo $view2->member_status->FldCaption() ?></td>
			<td<?php echo $view2->member_status->CellAttributes() ?>>
<div<?php echo $view2->member_status->ViewAttributes() ?>><?php echo $view2->member_status->ListViewValue() ?></div></td>
		</tr>
<?php } ?>
	</tbody>
</table>
</div>
</td></tr></table>
<br>
