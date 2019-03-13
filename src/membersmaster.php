<?php

// Call Row_Rendering event
$members->Row_Rendering();

// member_code
// id_code
// prefix
// gender
// fname
// lname
// birthdate
// age
// t_code
// village_id
// bnfc1_name
// bnfc1_rel
// bnfc2_name
// bnfc2_rel
// bnfc3_name
// bnfc3_rel
// regis_date
// effective_date
// member_status
// Call Row_Rendered event

$members->Row_Rendered();
?>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
	<tbody>
<?php if ($members->member_code->Visible) { // member_code ?>
		<tr id="r_member_code">
			<td width="170" class="ewTableHeader"><?php echo $members->member_code->FldCaption() ?></td>
			<td<?php echo $members->member_code->CellAttributes() ?>>
<div<?php echo $members->member_code->ViewAttributes() ?>><?php echo $members->member_code->ListViewValue() ?></div></td>
		</tr>
<?php } ?>
<?php if ($members->id_code->Visible) { // id_code ?>
		<tr id="r_id_code">
			<td class="ewTableHeader"><?php echo $members->id_code->FldCaption() ?></td>
			<td<?php echo $members->id_code->CellAttributes() ?>>
<div<?php echo $members->id_code->ViewAttributes() ?>><?php echo $members->id_code->ListViewValue() ?></div></td>
		</tr>
<?php } ?>
<?php if ($members->prefix->Visible) { // prefix ?>
		<tr id="r_prefix">
			<td class="ewTableHeader"><?php echo $members->prefix->FldCaption() ?></td>
			<td<?php echo $members->prefix->CellAttributes() ?>>
<div<?php echo $members->prefix->ViewAttributes() ?>><?php echo $members->prefix->ListViewValue() ?></div></td>
		</tr>
<?php } ?>
<?php if ($members->gender->Visible) { // gender ?>
		<tr id="r_gender">
			<td class="ewTableHeader"><?php echo $members->gender->FldCaption() ?></td>
			<td<?php echo $members->gender->CellAttributes() ?>>
<div<?php echo $members->gender->ViewAttributes() ?>><?php echo $members->gender->ListViewValue() ?></div></td>
		</tr>
<?php } ?>
<?php if ($members->fname->Visible) { // fname ?>
		<tr id="r_fname">
			<td class="ewTableHeader"><?php echo $members->fname->FldCaption() ?></td>
			<td<?php echo $members->fname->CellAttributes() ?>>
<div<?php echo $members->fname->ViewAttributes() ?>><?php echo $members->fname->ListViewValue() ?></div></td>
		</tr>
<?php } ?>
<?php if ($members->lname->Visible) { // lname ?>
		<tr id="r_lname">
			<td class="ewTableHeader"><?php echo $members->lname->FldCaption() ?></td>
			<td<?php echo $members->lname->CellAttributes() ?>>
<div<?php echo $members->lname->ViewAttributes() ?>><?php echo $members->lname->ListViewValue() ?></div></td>
		</tr>
<?php } ?>
<?php if ($members->birthdate->Visible) { // birthdate ?>
		<tr id="r_birthdate">
			<td class="ewTableHeader"><?php echo $members->birthdate->FldCaption() ?></td>
			<td<?php echo $members->birthdate->CellAttributes() ?>>
<div<?php echo $members->birthdate->ViewAttributes() ?>><?php echo $members->birthdate->ListViewValue() ?></div></td>
		</tr>
<?php } ?>
<?php if ($members->age->Visible) { // age ?>
		<tr id="r_age">
			<td class="ewTableHeader"><?php echo $members->age->FldCaption() ?></td>
			<td<?php echo $members->age->CellAttributes() ?>>
<div<?php echo $members->age->ViewAttributes() ?>><?php echo $members->age->ListViewValue() ?></div></td>
		</tr>
<?php } ?>
<?php if ($members->t_code->Visible) { // t_code ?>
		<tr id="r_t_code">
			<td class="ewTableHeader"><?php echo $members->t_code->FldCaption() ?></td>
			<td<?php echo $members->t_code->CellAttributes() ?>>
<div<?php echo $members->t_code->ViewAttributes() ?>><?php echo $members->t_code->ListViewValue() ?></div></td>
		</tr>
<?php } ?>
<?php if ($members->village_id->Visible) { // village_id ?>
		<tr id="r_village_id">
			<td class="ewTableHeader"><?php echo $members->village_id->FldCaption() ?></td>
			<td<?php echo $members->village_id->CellAttributes() ?>>
<div<?php echo $members->village_id->ViewAttributes() ?>><?php echo $members->village_id->ListViewValue() ?></div></td>
		</tr>
<?php } ?>
<?php if ($members->bnfc1_name->Visible) { // bnfc1_name ?>
		<tr id="r_bnfc1_name">
			<td class="ewTableHeader"><?php echo $members->bnfc1_name->FldCaption() ?></td>
			<td<?php echo $members->bnfc1_name->CellAttributes() ?>>
<div<?php echo $members->bnfc1_name->ViewAttributes() ?>><?php echo $members->bnfc1_name->ListViewValue() ?></div></td>
		</tr>
<?php } ?>
<?php if ($members->bnfc1_rel->Visible) { // bnfc1_rel ?>
		<tr id="r_bnfc1_rel">
			<td class="ewTableHeader"><?php echo $members->bnfc1_rel->FldCaption() ?></td>
			<td<?php echo $members->bnfc1_rel->CellAttributes() ?>>
<div<?php echo $members->bnfc1_rel->ViewAttributes() ?>><?php echo $members->bnfc1_rel->ListViewValue() ?></div></td>
		</tr>
<?php } ?>
<?php if ($members->bnfc2_name->Visible) { // bnfc2_name ?>
		<tr id="r_bnfc2_name">
			<td class="ewTableHeader"><?php echo $members->bnfc2_name->FldCaption() ?></td>
			<td<?php echo $members->bnfc2_name->CellAttributes() ?>>
<div<?php echo $members->bnfc2_name->ViewAttributes() ?>><?php echo $members->bnfc2_name->ListViewValue() ?></div></td>
		</tr>
<?php } ?>
<?php if ($members->bnfc2_rel->Visible) { // bnfc2_rel ?>
		<tr id="r_bnfc2_rel">
			<td class="ewTableHeader"><?php echo $members->bnfc2_rel->FldCaption() ?></td>
			<td<?php echo $members->bnfc2_rel->CellAttributes() ?>>
<div<?php echo $members->bnfc2_rel->ViewAttributes() ?>><?php echo $members->bnfc2_rel->ListViewValue() ?></div></td>
		</tr>
<?php } ?>
<?php if ($members->bnfc3_name->Visible) { // bnfc3_name ?>
		<tr id="r_bnfc3_name">
			<td class="ewTableHeader"><?php echo $members->bnfc3_name->FldCaption() ?></td>
			<td<?php echo $members->bnfc3_name->CellAttributes() ?>>
<div<?php echo $members->bnfc3_name->ViewAttributes() ?>><?php echo $members->bnfc3_name->ListViewValue() ?></div></td>
		</tr>
<?php } ?>
<?php if ($members->bnfc3_rel->Visible) { // bnfc3_rel ?>
		<tr id="r_bnfc3_rel">
			<td class="ewTableHeader"><?php echo $members->bnfc3_rel->FldCaption() ?></td>
			<td<?php echo $members->bnfc3_rel->CellAttributes() ?>>
<div<?php echo $members->bnfc3_rel->ViewAttributes() ?>><?php echo $members->bnfc3_rel->ListViewValue() ?></div></td>
		</tr>
<?php } ?>
<?php if ($members->regis_date->Visible) { // regis_date ?>
		<tr id="r_regis_date">
			<td class="ewTableHeader"><?php echo $members->regis_date->FldCaption() ?></td>
			<td<?php echo $members->regis_date->CellAttributes() ?>>
<div<?php echo $members->regis_date->ViewAttributes() ?>><?php echo $members->regis_date->ListViewValue() ?></div></td>
		</tr>
<?php } ?>
<?php if ($members->effective_date->Visible) { // effective_date ?>
		<tr id="r_effective_date">
			<td class="ewTableHeader"><?php echo $members->effective_date->FldCaption() ?></td>
			<td<?php echo $members->effective_date->CellAttributes() ?>>
<div<?php echo $members->effective_date->ViewAttributes() ?>><?php echo $members->effective_date->ListViewValue() ?></div></td>
		</tr>
<?php } ?>
<?php if ($members->member_status->Visible) { // member_status ?>
		<tr id="r_member_status">
			<td class="ewTableHeader"><?php echo $members->member_status->FldCaption() ?></td>
			<td<?php echo $members->member_status->CellAttributes() ?>>
<div<?php echo $members->member_status->ViewAttributes() ?>><?php echo $members->member_status->ListViewValue() ?></div></td>
		</tr>
<?php } ?>
	</tbody>
</table>
</div>
</td></tr></table>
<br>
