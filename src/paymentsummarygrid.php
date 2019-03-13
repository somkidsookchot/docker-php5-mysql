<?php include_once "administratorinfo.php" ?>
<?php

// Create page object
$paymentsummary_grid = new cpaymentsummary_grid();
$MasterPage =& $Page;
$Page =& $paymentsummary_grid;

// Page init
$paymentsummary_grid->Page_Init();

// Page main
$paymentsummary_grid->Page_Main();
?>
<?php if ($paymentsummary->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var paymentsummary_grid = new ew_Page("paymentsummary_grid");

// page properties
paymentsummary_grid.PageID = "grid"; // page ID
paymentsummary_grid.FormID = "fpaymentsummarygrid"; // form ID
var EW_PAGE_ID = paymentsummary_grid.PageID; // for backward compatibility

// extend page with ValidateForm function
paymentsummary_grid.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	var addcnt = 0;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";
		var chkthisrow = true;
		if (fobj.a_list && fobj.a_list.value == "gridinsert")
			chkthisrow = !(this.EmptyRow(fobj, infix));
		else
			chkthisrow = true;
		if (chkthisrow) {
			addcnt += 1;
		elm = fobj.elements["x" + infix + "_pay_sum_date"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($paymentsummary->pay_sum_date->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_pay_sum_date"];
		if (elm && !ew_CheckEuroDate(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($paymentsummary->pay_sum_date->FldErrMsg()) ?>");

		// Set up row object
		var row = {};
		row["index"] = infix;
		for (var j = 0; j < fobj.elements.length; j++) {
			var el = fobj.elements[j];
			var len = infix.length + 2;
			if (el.name.substr(0, len) == "x" + infix + "_") {
				var elname = "x_" + el.name.substr(len);
				if (ewLang.isObject(row[elname])) { // already exists
					if (ewLang.isArray(row[elname])) {
						row[elname][row[elname].length] = el; // add to array
					} else {
						row[elname] = [row[elname], el]; // convert to array
					}
				} else {
					row[elname] = el;
				}
			}
		}
		fobj.row = row;

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
		} // End Grid Add checking
	}
	return true;
}

// Extend page with empty row check
paymentsummary_grid.EmptyRow = function(fobj, infix) {
	if (ew_ValueChanged(fobj, infix, "t_code", false)) return false;
	if (ew_ValueChanged(fobj, infix, "village_id", false)) return false;
	if (ew_ValueChanged(fobj, infix, "member_code[]", false)) return false;
	if (ew_ValueChanged(fobj, infix, "pay_sum_date", false)) return false;
	if (ew_ValueChanged(fobj, infix, "pay_sum_type", false)) return false;
	if (ew_ValueChanged(fobj, infix, "pay_death_begin", false)) return false;
	if (ew_ValueChanged(fobj, infix, "pay_sum_adv_num", false)) return false;
	if (ew_ValueChanged(fobj, infix, "pay_annual_year", false)) return false;
	if (ew_ValueChanged(fobj, infix, "pay_sum_detail", false)) return false;
	if (ew_ValueChanged(fobj, infix, "pay_sum_total", false)) return false;
	if (ew_ValueChanged(fobj, infix, "pay_sum_note", false)) return false;
	return true;
}

// extend page with Form_CustomValidate function
paymentsummary_grid.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
paymentsummary_grid.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
paymentsummary_grid.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
paymentsummary_grid.ValidateRequired = false; // no JavaScript validation
<?php } ?>

// search highlight properties
paymentsummary_grid.ShowHighlightText = ewLanguage.Phrase("ShowHighlight"); 
paymentsummary_grid.HideHighlightText = ewLanguage.Phrase("HideHighlight");

//-->
</script>
<link rel="stylesheet" type="text/css" media="all" href="calendar/calendar-win2k-cold-1.css" title="win2k-1">
<script type="text/javascript" src="calendar/calendar.js"></script>
<script type="text/javascript" src="calendar/lang/calendar-en.js"></script>
<script type="text/javascript" src="calendar/calendar-setup.js"></script>
<?php } ?>
<?php
if ($paymentsummary->CurrentAction == "gridadd") {
	if ($paymentsummary->CurrentMode == "copy") {
		$bSelectLimit = EW_SELECT_LIMIT;
		if ($bSelectLimit) {
			$paymentsummary_grid->TotalRecs = $paymentsummary->SelectRecordCount();
			$paymentsummary_grid->Recordset = $paymentsummary_grid->LoadRecordset($paymentsummary_grid->StartRec-1, $paymentsummary_grid->DisplayRecs);
		} else {
			if ($paymentsummary_grid->Recordset = $paymentsummary_grid->LoadRecordset())
				$paymentsummary_grid->TotalRecs = $paymentsummary_grid->Recordset->RecordCount();
		}
		$paymentsummary_grid->StartRec = 1;
		$paymentsummary_grid->DisplayRecs = $paymentsummary_grid->TotalRecs;
	} else {
		$paymentsummary->CurrentFilter = "0=1";
		$paymentsummary_grid->StartRec = 1;
		$paymentsummary_grid->DisplayRecs = $paymentsummary->GridAddRowCount;
	}
	$paymentsummary_grid->TotalRecs = $paymentsummary_grid->DisplayRecs;
	$paymentsummary_grid->StopRec = $paymentsummary_grid->DisplayRecs;
} else {
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$paymentsummary_grid->TotalRecs = $paymentsummary->SelectRecordCount();
	} else {
		if ($paymentsummary_grid->Recordset = $paymentsummary_grid->LoadRecordset())
			$paymentsummary_grid->TotalRecs = $paymentsummary_grid->Recordset->RecordCount();
	}
	$paymentsummary_grid->StartRec = 1;
	$paymentsummary_grid->DisplayRecs = $paymentsummary_grid->TotalRecs; // Display all records
	if ($bSelectLimit)
		$paymentsummary_grid->Recordset = $paymentsummary_grid->LoadRecordset($paymentsummary_grid->StartRec-1, $paymentsummary_grid->DisplayRecs);
}
?>
<p class="phpmaker ewTitle" style="white-space: nowrap;"><?php if ($paymentsummary->CurrentMode == "add" || $paymentsummary->CurrentMode == "copy") { ?><?php echo $Language->Phrase("Add") ?><?php } elseif ($paymentsummary->CurrentMode == "edit") { ?><?php echo $Language->Phrase("Edit") ?><?php } ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $paymentsummary->TableCaption() ?></p>
</p>
<?php $paymentsummary_grid->ShowPageHeader(); ?>
<?php
$paymentsummary_grid->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if (($paymentsummary->CurrentMode == "add" || $paymentsummary->CurrentMode == "copy" || $paymentsummary->CurrentMode == "edit") && $paymentsummary->CurrentAction != "F") { // add/copy/edit mode ?>
<div class="ewGridUpperPanel">
<?php if ($paymentsummary->AllowAddDeleteRow) { ?>
<?php if ($Security->IsLoggedIn()) { ?>
<span class="phpmaker">
<a href="javascript:void(0);" onclick="ew_AddGridRow(this);"><?php echo $Language->Phrase("AddBlankRow") ?></a>&nbsp;&nbsp;
</span>
<?php } ?>
<?php } ?>
</div>
<?php } ?>
<div id="gmp_paymentsummary" class="ewGridMiddlePanel">
<table cellspacing="0" data-rowhighlightclass="ewTableHighlightRow" data-rowselectclass="ewTableSelectRow" data-roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $paymentsummary->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$paymentsummary_grid->RenderListOptions();

// Render list options (header, left)
$paymentsummary_grid->ListOptions->Render("header", "left");
?>
<?php if ($paymentsummary->t_code->Visible) { // t_code ?>
	<?php if ($paymentsummary->SortUrl($paymentsummary->t_code) == "") { ?>
		<td style="white-space: nowrap;"><?php echo $paymentsummary->t_code->FldCaption() ?></td>
	<?php } else { ?>
		<td><div>
			<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><thead><tr><td><?php echo $paymentsummary->t_code->FldCaption() ?></td><td style="width: 10px;"><?php if ($paymentsummary->t_code->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($paymentsummary->t_code->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($paymentsummary->village_id->Visible) { // village_id ?>
	<?php if ($paymentsummary->SortUrl($paymentsummary->village_id) == "") { ?>
		<td style="white-space: nowrap;"><?php echo $paymentsummary->village_id->FldCaption() ?></td>
	<?php } else { ?>
		<td><div>
			<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><thead><tr><td><?php echo $paymentsummary->village_id->FldCaption() ?></td><td style="width: 10px;"><?php if ($paymentsummary->village_id->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($paymentsummary->village_id->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($paymentsummary->member_code->Visible) { // member_code ?>
	<?php if ($paymentsummary->SortUrl($paymentsummary->member_code) == "") { ?>
		<td style="white-space: nowrap;"><?php echo $paymentsummary->member_code->FldCaption() ?></td>
	<?php } else { ?>
		<td><div>
			<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><thead><tr><td><?php echo $paymentsummary->member_code->FldCaption() ?></td><td style="width: 10px;"><?php if ($paymentsummary->member_code->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($paymentsummary->member_code->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($paymentsummary->pay_sum_date->Visible) { // pay_sum_date ?>
	<?php if ($paymentsummary->SortUrl($paymentsummary->pay_sum_date) == "") { ?>
		<td><?php echo $paymentsummary->pay_sum_date->FldCaption() ?></td>
	<?php } else { ?>
		<td><div>
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $paymentsummary->pay_sum_date->FldCaption() ?></td><td style="width: 10px;"><?php if ($paymentsummary->pay_sum_date->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($paymentsummary->pay_sum_date->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($paymentsummary->pay_sum_type->Visible) { // pay_sum_type ?>
	<?php if ($paymentsummary->SortUrl($paymentsummary->pay_sum_type) == "") { ?>
		<td style="white-space: nowrap;"><?php echo $paymentsummary->pay_sum_type->FldCaption() ?></td>
	<?php } else { ?>
		<td><div>
			<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><thead><tr><td><?php echo $paymentsummary->pay_sum_type->FldCaption() ?></td><td style="width: 10px;"><?php if ($paymentsummary->pay_sum_type->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($paymentsummary->pay_sum_type->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($paymentsummary->pay_death_begin->Visible) { // pay_death_begin ?>
	<?php if ($paymentsummary->SortUrl($paymentsummary->pay_death_begin) == "") { ?>
		<td><?php echo $paymentsummary->pay_death_begin->FldCaption() ?></td>
	<?php } else { ?>
		<td><div>
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $paymentsummary->pay_death_begin->FldCaption() ?></td><td style="width: 10px;"><?php if ($paymentsummary->pay_death_begin->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($paymentsummary->pay_death_begin->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($paymentsummary->pay_sum_adv_num->Visible) { // pay_sum_adv_num ?>
	<?php if ($paymentsummary->SortUrl($paymentsummary->pay_sum_adv_num) == "") { ?>
		<td><?php echo $paymentsummary->pay_sum_adv_num->FldCaption() ?></td>
	<?php } else { ?>
		<td><div>
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $paymentsummary->pay_sum_adv_num->FldCaption() ?></td><td style="width: 10px;"><?php if ($paymentsummary->pay_sum_adv_num->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($paymentsummary->pay_sum_adv_num->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($paymentsummary->pay_annual_year->Visible) { // pay_annual_year ?>
	<?php if ($paymentsummary->SortUrl($paymentsummary->pay_annual_year) == "") { ?>
		<td><?php echo $paymentsummary->pay_annual_year->FldCaption() ?></td>
	<?php } else { ?>
		<td><div>
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $paymentsummary->pay_annual_year->FldCaption() ?></td><td style="width: 10px;"><?php if ($paymentsummary->pay_annual_year->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($paymentsummary->pay_annual_year->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($paymentsummary->pay_sum_detail->Visible) { // pay_sum_detail ?>
	<?php if ($paymentsummary->SortUrl($paymentsummary->pay_sum_detail) == "") { ?>
		<td><?php echo $paymentsummary->pay_sum_detail->FldCaption() ?></td>
	<?php } else { ?>
		<td><div>
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $paymentsummary->pay_sum_detail->FldCaption() ?></td><td style="width: 10px;"><?php if ($paymentsummary->pay_sum_detail->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($paymentsummary->pay_sum_detail->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($paymentsummary->pay_sum_total->Visible) { // pay_sum_total ?>
	<?php if ($paymentsummary->SortUrl($paymentsummary->pay_sum_total) == "") { ?>
		<td style="white-space: nowrap;"><?php echo $paymentsummary->pay_sum_total->FldCaption() ?></td>
	<?php } else { ?>
		<td><div>
			<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><thead><tr><td><?php echo $paymentsummary->pay_sum_total->FldCaption() ?></td><td style="width: 10px;"><?php if ($paymentsummary->pay_sum_total->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($paymentsummary->pay_sum_total->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($paymentsummary->pay_sum_note->Visible) { // pay_sum_note ?>
	<?php if ($paymentsummary->SortUrl($paymentsummary->pay_sum_note) == "") { ?>
		<td><?php echo $paymentsummary->pay_sum_note->FldCaption() ?></td>
	<?php } else { ?>
		<td><div>
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $paymentsummary->pay_sum_note->FldCaption() ?></td><td style="width: 10px;"><?php if ($paymentsummary->pay_sum_note->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($paymentsummary->pay_sum_note->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$paymentsummary_grid->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
$paymentsummary_grid->StartRec = 1;
$paymentsummary_grid->StopRec = $paymentsummary_grid->TotalRecs; // Show all records

// Restore number of post back records
if ($objForm) {
	$objForm->Index = 0;
	if ($objForm->HasValue("key_count") && ($paymentsummary->CurrentAction == "gridadd" || $paymentsummary->CurrentAction == "gridedit" || $paymentsummary->CurrentAction == "F")) {
		$paymentsummary_grid->KeyCount = $objForm->GetValue("key_count");
		$paymentsummary_grid->StopRec = $paymentsummary_grid->KeyCount;
	}
}
$paymentsummary_grid->RecCnt = $paymentsummary_grid->StartRec - 1;
if ($paymentsummary_grid->Recordset && !$paymentsummary_grid->Recordset->EOF) {
	$paymentsummary_grid->Recordset->MoveFirst();
	if (!$bSelectLimit && $paymentsummary_grid->StartRec > 1)
		$paymentsummary_grid->Recordset->Move($paymentsummary_grid->StartRec - 1);
} elseif (!$paymentsummary->AllowAddDeleteRow && $paymentsummary_grid->StopRec == 0) {
	$paymentsummary_grid->StopRec = $paymentsummary->GridAddRowCount;
}

// Initialize aggregate
$paymentsummary->RowType = EW_ROWTYPE_AGGREGATEINIT;
$paymentsummary->ResetAttrs();
$paymentsummary_grid->RenderRow();
$paymentsummary_grid->RowCnt = 0;
if ($paymentsummary->CurrentAction == "gridadd")
	$paymentsummary_grid->RowIndex = 0;
if ($paymentsummary->CurrentAction == "gridedit")
	$paymentsummary_grid->RowIndex = 0;
while ($paymentsummary_grid->RecCnt < $paymentsummary_grid->StopRec) {
	$paymentsummary_grid->RecCnt++;
	if (intval($paymentsummary_grid->RecCnt) >= intval($paymentsummary_grid->StartRec)) {
		$paymentsummary_grid->RowCnt++;
		if ($paymentsummary->CurrentAction == "gridadd" || $paymentsummary->CurrentAction == "gridedit" || $paymentsummary->CurrentAction == "F") {
			$paymentsummary_grid->RowIndex++;
			$objForm->Index = $paymentsummary_grid->RowIndex;
			if ($objForm->HasValue("k_action"))
				$paymentsummary_grid->RowAction = strval($objForm->GetValue("k_action"));
			elseif ($paymentsummary->CurrentAction == "gridadd")
				$paymentsummary_grid->RowAction = "insert";
			else
				$paymentsummary_grid->RowAction = "";
		}

		// Set up key count
		$paymentsummary_grid->KeyCount = $paymentsummary_grid->RowIndex;

		// Init row class and style
		$paymentsummary->ResetAttrs();
		$paymentsummary->CssClass = "";
		if ($paymentsummary->CurrentAction == "gridadd") {
			if ($paymentsummary->CurrentMode == "copy") {
				$paymentsummary_grid->LoadRowValues($paymentsummary_grid->Recordset); // Load row values
				$paymentsummary_grid->SetRecordKey($paymentsummary_grid->RowOldKey, $paymentsummary_grid->Recordset); // Set old record key
			} else {
				$paymentsummary_grid->LoadDefaultValues(); // Load default values
				$paymentsummary_grid->RowOldKey = ""; // Clear old key value
			}
		} elseif ($paymentsummary->CurrentAction == "gridedit") {
			$paymentsummary_grid->LoadRowValues($paymentsummary_grid->Recordset); // Load row values
		}
		$paymentsummary->RowType = EW_ROWTYPE_VIEW; // Render view
		if ($paymentsummary->CurrentAction == "gridadd") // Grid add
			$paymentsummary->RowType = EW_ROWTYPE_ADD; // Render add
		if ($paymentsummary->CurrentAction == "gridadd" && $paymentsummary->EventCancelled && !$objForm->HasValue("k_blankrow")) // Insert failed
			$paymentsummary_grid->RestoreCurrentRowFormValues($paymentsummary_grid->RowIndex); // Restore form values
		if ($paymentsummary->CurrentAction == "gridedit") { // Grid edit
			if ($paymentsummary->EventCancelled) {
				$paymentsummary_grid->RestoreCurrentRowFormValues($paymentsummary_grid->RowIndex); // Restore form values
			}
			if ($paymentsummary_grid->RowAction == "insert")
				$paymentsummary->RowType = EW_ROWTYPE_ADD; // Render add
			else
				$paymentsummary->RowType = EW_ROWTYPE_EDIT; // Render edit
		}
		if ($paymentsummary->CurrentAction == "gridedit" && ($paymentsummary->RowType == EW_ROWTYPE_EDIT || $paymentsummary->RowType == EW_ROWTYPE_ADD) && $paymentsummary->EventCancelled) // Update failed
			$paymentsummary_grid->RestoreCurrentRowFormValues($paymentsummary_grid->RowIndex); // Restore form values
		if ($paymentsummary->RowType == EW_ROWTYPE_EDIT) // Edit row
			$paymentsummary_grid->EditRowCnt++;
		if ($paymentsummary->CurrentAction == "F") // Confirm row
			$paymentsummary_grid->RestoreCurrentRowFormValues($paymentsummary_grid->RowIndex); // Restore form values
		if ($paymentsummary->RowType == EW_ROWTYPE_ADD || $paymentsummary->RowType == EW_ROWTYPE_EDIT) { // Add / Edit row
			if ($paymentsummary->CurrentAction == "edit") {
				$paymentsummary->RowAttrs = array();
				$paymentsummary->CssClass = "ewTableEditRow";
			} else {
				$paymentsummary->RowAttrs = array();
			}
			if (!empty($paymentsummary_grid->RowIndex))
				$paymentsummary->RowAttrs = array_merge($paymentsummary->RowAttrs, array('data-rowindex'=>$paymentsummary_grid->RowIndex, 'id'=>'r' . $paymentsummary_grid->RowIndex . '_paymentsummary'));
		} else {
			$paymentsummary->RowAttrs = array();
		}

		// Render row
		$paymentsummary_grid->RenderRow();

		// Render list options
		$paymentsummary_grid->RenderListOptions();

		// Skip delete row / empty row for confirm page
		if ($paymentsummary_grid->RowAction <> "delete" && $paymentsummary_grid->RowAction <> "insertdelete" && !($paymentsummary_grid->RowAction == "insert" && $paymentsummary->CurrentAction == "F" && $paymentsummary_grid->EmptyRow())) {
?>
	<tr<?php echo $paymentsummary->RowAttributes() ?>>
<?php

// Render list options (body, left)
$paymentsummary_grid->ListOptions->Render("body", "left");
?>
	<?php if ($paymentsummary->t_code->Visible) { // t_code ?>
		<td<?php echo $paymentsummary->t_code->CellAttributes() ?>>
<?php if ($paymentsummary->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<?php if ($paymentsummary->t_code->getSessionValue() <> "") { ?>
<div<?php echo $paymentsummary->t_code->ViewAttributes() ?>><?php echo $paymentsummary->t_code->ListViewValue() ?></div>
<input type="hidden" id="x<?php echo $paymentsummary_grid->RowIndex ?>_t_code" name="x<?php echo $paymentsummary_grid->RowIndex ?>_t_code" value="<?php echo ew_HtmlEncode($paymentsummary->t_code->CurrentValue) ?>">
<?php } else { ?>
<select id="x<?php echo $paymentsummary_grid->RowIndex ?>_t_code" name="x<?php echo $paymentsummary_grid->RowIndex ?>_t_code"<?php echo $paymentsummary->t_code->EditAttributes() ?>>
<?php
if (is_array($paymentsummary->t_code->EditValue)) {
	$arwrk = $paymentsummary->t_code->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($paymentsummary->t_code->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
if (@$emptywrk) $paymentsummary->t_code->OldValue = "";
?>
</select>
<?php } ?>
<input type="hidden" name="o<?php echo $paymentsummary_grid->RowIndex ?>_t_code" id="o<?php echo $paymentsummary_grid->RowIndex ?>_t_code" value="<?php echo ew_HtmlEncode($paymentsummary->t_code->OldValue) ?>">
<?php } ?>
<?php if ($paymentsummary->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<div<?php echo $paymentsummary->t_code->ViewAttributes() ?>><?php echo $paymentsummary->t_code->EditValue ?></div>
<input type="hidden" name="x<?php echo $paymentsummary_grid->RowIndex ?>_t_code" id="x<?php echo $paymentsummary_grid->RowIndex ?>_t_code" value="<?php echo ew_HtmlEncode($paymentsummary->t_code->CurrentValue) ?>">
<?php } ?>
<?php if ($paymentsummary->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $paymentsummary->t_code->ViewAttributes() ?>><?php echo $paymentsummary->t_code->ListViewValue() ?></div>
<input type="hidden" name="x<?php echo $paymentsummary_grid->RowIndex ?>_t_code" id="x<?php echo $paymentsummary_grid->RowIndex ?>_t_code" value="<?php echo ew_HtmlEncode($paymentsummary->t_code->CurrentValue) ?>">
<input type="hidden" name="o<?php echo $paymentsummary_grid->RowIndex ?>_t_code" id="o<?php echo $paymentsummary_grid->RowIndex ?>_t_code" value="<?php echo ew_HtmlEncode($paymentsummary->t_code->OldValue) ?>">
<?php } ?>
<a name="<?php echo $paymentsummary_grid->PageObjName . "_row_" . $paymentsummary_grid->RowCnt ?>" id="<?php echo $paymentsummary_grid->PageObjName . "_row_" . $paymentsummary_grid->RowCnt ?>"></a>
<?php if ($paymentsummary->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="hidden" name="o<?php echo $paymentsummary_grid->RowIndex ?>_pay_sum_id" id="o<?php echo $paymentsummary_grid->RowIndex ?>_pay_sum_id" value="<?php echo ew_HtmlEncode($paymentsummary->pay_sum_id->OldValue) ?>">
<?php } ?>
<?php if ($paymentsummary->RowType == EW_ROWTYPE_EDIT) { ?>
<input type="hidden" name="x<?php echo $paymentsummary_grid->RowIndex ?>_pay_sum_id" id="x<?php echo $paymentsummary_grid->RowIndex ?>_pay_sum_id" value="<?php echo ew_HtmlEncode($paymentsummary->pay_sum_id->CurrentValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($paymentsummary->village_id->Visible) { // village_id ?>
		<td<?php echo $paymentsummary->village_id->CellAttributes() ?>>
<?php if ($paymentsummary->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<?php if ($paymentsummary->village_id->getSessionValue() <> "") { ?>
<div<?php echo $paymentsummary->village_id->ViewAttributes() ?>><?php echo $paymentsummary->village_id->ListViewValue() ?></div>
<input type="hidden" id="x<?php echo $paymentsummary_grid->RowIndex ?>_village_id" name="x<?php echo $paymentsummary_grid->RowIndex ?>_village_id" value="<?php echo ew_HtmlEncode($paymentsummary->village_id->CurrentValue) ?>">
<?php } else { ?>
<select id="x<?php echo $paymentsummary_grid->RowIndex ?>_village_id" name="x<?php echo $paymentsummary_grid->RowIndex ?>_village_id"<?php echo $paymentsummary->village_id->EditAttributes() ?>>
<?php
if (is_array($paymentsummary->village_id->EditValue)) {
	$arwrk = $paymentsummary->village_id->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($paymentsummary->village_id->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
if (@$emptywrk) $paymentsummary->village_id->OldValue = "";
?>
</select>
<?php } ?>
<input type="hidden" name="o<?php echo $paymentsummary_grid->RowIndex ?>_village_id" id="o<?php echo $paymentsummary_grid->RowIndex ?>_village_id" value="<?php echo ew_HtmlEncode($paymentsummary->village_id->OldValue) ?>">
<?php } ?>
<?php if ($paymentsummary->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<div<?php echo $paymentsummary->village_id->ViewAttributes() ?>><?php echo $paymentsummary->village_id->EditValue ?></div>
<input type="hidden" name="x<?php echo $paymentsummary_grid->RowIndex ?>_village_id" id="x<?php echo $paymentsummary_grid->RowIndex ?>_village_id" value="<?php echo ew_HtmlEncode($paymentsummary->village_id->CurrentValue) ?>">
<?php } ?>
<?php if ($paymentsummary->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $paymentsummary->village_id->ViewAttributes() ?>><?php echo $paymentsummary->village_id->ListViewValue() ?></div>
<input type="hidden" name="x<?php echo $paymentsummary_grid->RowIndex ?>_village_id" id="x<?php echo $paymentsummary_grid->RowIndex ?>_village_id" value="<?php echo ew_HtmlEncode($paymentsummary->village_id->CurrentValue) ?>">
<input type="hidden" name="o<?php echo $paymentsummary_grid->RowIndex ?>_village_id" id="o<?php echo $paymentsummary_grid->RowIndex ?>_village_id" value="<?php echo ew_HtmlEncode($paymentsummary->village_id->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($paymentsummary->member_code->Visible) { // member_code ?>
		<td<?php echo $paymentsummary->member_code->CellAttributes() ?>>
<?php if ($paymentsummary->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<div id="tp_x<?php echo $paymentsummary_grid->RowIndex ?>_member_code" class="<?php echo EW_ITEM_TEMPLATE_CLASSNAME; ?>"><input type="checkbox" name="x<?php echo $paymentsummary_grid->RowIndex ?>_member_code[]" id="x<?php echo $paymentsummary_grid->RowIndex ?>_member_code[]" value="{value}"<?php echo $paymentsummary->member_code->EditAttributes() ?>></div>
<div id="dsl_x<?php echo $paymentsummary_grid->RowIndex ?>_member_code" data-repeatcolumn="5" class="ewItemList">
<?php
$arwrk = $paymentsummary->member_code->EditValue;
if (is_array($arwrk)) {
	$armultiwrk= explode(",", strval($paymentsummary->member_code->CurrentValue));
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = "";
		$cnt = count($armultiwrk);
		for ($ari = 0; $ari < $cnt; $ari++) {
			if (strval($arwrk[$rowcntwrk][0]) == trim(strval($armultiwrk[$ari]))) {
				$selwrk = " checked=\"checked\"";
				if ($selwrk <> "") $emptywrk = FALSE;
				break;
			}
		}

		// Note: No spacing within the LABEL tag
?>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 1) ?>
<label><input type="checkbox" name="x<?php echo $paymentsummary_grid->RowIndex ?>_member_code[]" id="x<?php echo $paymentsummary_grid->RowIndex ?>_member_code[]" value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?><?php echo $paymentsummary->member_code->EditAttributes() ?>><?php echo $arwrk[$rowcntwrk][1] ?><?php echo ew_ValueSeparator($rowcntwrk,1,$paymentsummary->member_code) ?><?php echo $arwrk[$rowcntwrk][2] ?><?php echo ew_ValueSeparator($rowcntwrk,2,$paymentsummary->member_code) ?><?php echo $arwrk[$rowcntwrk][3] ?></label>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 2) ?>
<?php
	}
}
if (@$emptywrk) $paymentsummary->member_code->OldValue = "";
?>
</div>
<input type="hidden" name="o<?php echo $paymentsummary_grid->RowIndex ?>_member_code[]" id="o<?php echo $paymentsummary_grid->RowIndex ?>_member_code[]" value="<?php echo ew_HtmlEncode($paymentsummary->member_code->OldValue) ?>">
<?php } ?>
<?php if ($paymentsummary->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<div<?php echo $paymentsummary->member_code->ViewAttributes() ?>><?php echo $paymentsummary->member_code->EditValue ?></div>
<input type="hidden" name="x<?php echo $paymentsummary_grid->RowIndex ?>_member_code" id="x<?php echo $paymentsummary_grid->RowIndex ?>_member_code" value="<?php echo ew_HtmlEncode($paymentsummary->member_code->CurrentValue) ?>">
<?php } ?>
<?php if ($paymentsummary->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $paymentsummary->member_code->ViewAttributes() ?>><?php echo $paymentsummary->member_code->ListViewValue() ?></div>
<input type="hidden" name="x<?php echo $paymentsummary_grid->RowIndex ?>_member_code" id="x<?php echo $paymentsummary_grid->RowIndex ?>_member_code" value="<?php echo ew_HtmlEncode($paymentsummary->member_code->CurrentValue) ?>">
<input type="hidden" name="o<?php echo $paymentsummary_grid->RowIndex ?>_member_code[]" id="o<?php echo $paymentsummary_grid->RowIndex ?>_member_code[]" value="<?php echo ew_HtmlEncode($paymentsummary->member_code->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($paymentsummary->pay_sum_date->Visible) { // pay_sum_date ?>
		<td<?php echo $paymentsummary->pay_sum_date->CellAttributes() ?>>
<?php if ($paymentsummary->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="text" name="x<?php echo $paymentsummary_grid->RowIndex ?>_pay_sum_date" id="x<?php echo $paymentsummary_grid->RowIndex ?>_pay_sum_date" value="<?php echo $paymentsummary->pay_sum_date->EditValue ?>"<?php echo $paymentsummary->pay_sum_date->EditAttributes() ?>>
&nbsp;<img src="phpimages/calendar.png" id="cal_x<?php echo $paymentsummary_grid->RowIndex ?>_pay_sum_date" name="cal_x<?php echo $paymentsummary_grid->RowIndex ?>_pay_sum_date" alt="<?php echo $Language->Phrase("PickDate") ?>" title="<?php echo $Language->Phrase("PickDate") ?>" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField: "x<?php echo $paymentsummary_grid->RowIndex ?>_pay_sum_date", // input field id
	ifFormat: "%d/%m/%Y", // date format
	button: "cal_x<?php echo $paymentsummary_grid->RowIndex ?>_pay_sum_date" // button id
});
</script>
<input type="hidden" name="fo<?php echo $paymentsummary_grid->RowIndex ?>_pay_sum_date" id="fo<?php echo $paymentsummary_grid->RowIndex ?>_pay_sum_date" value="<?php echo ew_HtmlEncode(ew_FormatDateTime($paymentsummary->pay_sum_date->OldValue, 7)) ?>">
<input type="hidden" name="o<?php echo $paymentsummary_grid->RowIndex ?>_pay_sum_date" id="o<?php echo $paymentsummary_grid->RowIndex ?>_pay_sum_date" value="<?php echo ew_HtmlEncode($paymentsummary->pay_sum_date->OldValue) ?>">
<?php } ?>
<?php if ($paymentsummary->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $paymentsummary_grid->RowIndex ?>_pay_sum_date" id="x<?php echo $paymentsummary_grid->RowIndex ?>_pay_sum_date" value="<?php echo $paymentsummary->pay_sum_date->EditValue ?>"<?php echo $paymentsummary->pay_sum_date->EditAttributes() ?>>
&nbsp;<img src="phpimages/calendar.png" id="cal_x<?php echo $paymentsummary_grid->RowIndex ?>_pay_sum_date" name="cal_x<?php echo $paymentsummary_grid->RowIndex ?>_pay_sum_date" alt="<?php echo $Language->Phrase("PickDate") ?>" title="<?php echo $Language->Phrase("PickDate") ?>" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField: "x<?php echo $paymentsummary_grid->RowIndex ?>_pay_sum_date", // input field id
	ifFormat: "%d/%m/%Y", // date format
	button: "cal_x<?php echo $paymentsummary_grid->RowIndex ?>_pay_sum_date" // button id
});
</script>
<?php } ?>
<?php if ($paymentsummary->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $paymentsummary->pay_sum_date->ViewAttributes() ?>><?php echo $paymentsummary->pay_sum_date->ListViewValue() ?></div>
<input type="hidden" name="x<?php echo $paymentsummary_grid->RowIndex ?>_pay_sum_date" id="x<?php echo $paymentsummary_grid->RowIndex ?>_pay_sum_date" value="<?php echo ew_HtmlEncode($paymentsummary->pay_sum_date->CurrentValue) ?>">
<input type="hidden" name="o<?php echo $paymentsummary_grid->RowIndex ?>_pay_sum_date" id="o<?php echo $paymentsummary_grid->RowIndex ?>_pay_sum_date" value="<?php echo ew_HtmlEncode($paymentsummary->pay_sum_date->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($paymentsummary->pay_sum_type->Visible) { // pay_sum_type ?>
		<td<?php echo $paymentsummary->pay_sum_type->CellAttributes() ?>>
<?php if ($paymentsummary->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<select id="x<?php echo $paymentsummary_grid->RowIndex ?>_pay_sum_type" name="x<?php echo $paymentsummary_grid->RowIndex ?>_pay_sum_type"<?php echo $paymentsummary->pay_sum_type->EditAttributes() ?>>
<?php
if (is_array($paymentsummary->pay_sum_type->EditValue)) {
	$arwrk = $paymentsummary->pay_sum_type->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($paymentsummary->pay_sum_type->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
if (@$emptywrk) $paymentsummary->pay_sum_type->OldValue = "";
?>
</select>
<input type="hidden" name="o<?php echo $paymentsummary_grid->RowIndex ?>_pay_sum_type" id="o<?php echo $paymentsummary_grid->RowIndex ?>_pay_sum_type" value="<?php echo ew_HtmlEncode($paymentsummary->pay_sum_type->OldValue) ?>">
<?php } ?>
<?php if ($paymentsummary->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<div<?php echo $paymentsummary->pay_sum_type->ViewAttributes() ?>><?php echo $paymentsummary->pay_sum_type->EditValue ?></div>
<input type="hidden" name="x<?php echo $paymentsummary_grid->RowIndex ?>_pay_sum_type" id="x<?php echo $paymentsummary_grid->RowIndex ?>_pay_sum_type" value="<?php echo ew_HtmlEncode($paymentsummary->pay_sum_type->CurrentValue) ?>">
<?php } ?>
<?php if ($paymentsummary->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $paymentsummary->pay_sum_type->ViewAttributes() ?>><?php echo $paymentsummary->pay_sum_type->ListViewValue() ?></div>
<input type="hidden" name="x<?php echo $paymentsummary_grid->RowIndex ?>_pay_sum_type" id="x<?php echo $paymentsummary_grid->RowIndex ?>_pay_sum_type" value="<?php echo ew_HtmlEncode($paymentsummary->pay_sum_type->CurrentValue) ?>">
<input type="hidden" name="o<?php echo $paymentsummary_grid->RowIndex ?>_pay_sum_type" id="o<?php echo $paymentsummary_grid->RowIndex ?>_pay_sum_type" value="<?php echo ew_HtmlEncode($paymentsummary->pay_sum_type->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($paymentsummary->pay_death_begin->Visible) { // pay_death_begin ?>
		<td<?php echo $paymentsummary->pay_death_begin->CellAttributes() ?>>
<?php if ($paymentsummary->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<select id="x<?php echo $paymentsummary_grid->RowIndex ?>_pay_death_begin" name="x<?php echo $paymentsummary_grid->RowIndex ?>_pay_death_begin"<?php echo $paymentsummary->pay_death_begin->EditAttributes() ?>>
<?php
if (is_array($paymentsummary->pay_death_begin->EditValue)) {
	$arwrk = $paymentsummary->pay_death_begin->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($paymentsummary->pay_death_begin->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
if (@$emptywrk) $paymentsummary->pay_death_begin->OldValue = "";
?>
</select>
<input type="hidden" name="o<?php echo $paymentsummary_grid->RowIndex ?>_pay_death_begin" id="o<?php echo $paymentsummary_grid->RowIndex ?>_pay_death_begin" value="<?php echo ew_HtmlEncode($paymentsummary->pay_death_begin->OldValue) ?>">
<?php } ?>
<?php if ($paymentsummary->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<div<?php echo $paymentsummary->pay_death_begin->ViewAttributes() ?>><?php echo $paymentsummary->pay_death_begin->EditValue ?></div>
<input type="hidden" name="x<?php echo $paymentsummary_grid->RowIndex ?>_pay_death_begin" id="x<?php echo $paymentsummary_grid->RowIndex ?>_pay_death_begin" value="<?php echo ew_HtmlEncode($paymentsummary->pay_death_begin->CurrentValue) ?>">
<?php } ?>
<?php if ($paymentsummary->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $paymentsummary->pay_death_begin->ViewAttributes() ?>><?php echo $paymentsummary->pay_death_begin->ListViewValue() ?></div>
<input type="hidden" name="x<?php echo $paymentsummary_grid->RowIndex ?>_pay_death_begin" id="x<?php echo $paymentsummary_grid->RowIndex ?>_pay_death_begin" value="<?php echo ew_HtmlEncode($paymentsummary->pay_death_begin->CurrentValue) ?>">
<input type="hidden" name="o<?php echo $paymentsummary_grid->RowIndex ?>_pay_death_begin" id="o<?php echo $paymentsummary_grid->RowIndex ?>_pay_death_begin" value="<?php echo ew_HtmlEncode($paymentsummary->pay_death_begin->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($paymentsummary->pay_sum_adv_num->Visible) { // pay_sum_adv_num ?>
		<td<?php echo $paymentsummary->pay_sum_adv_num->CellAttributes() ?>>
<?php if ($paymentsummary->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<select id="x<?php echo $paymentsummary_grid->RowIndex ?>_pay_sum_adv_num" name="x<?php echo $paymentsummary_grid->RowIndex ?>_pay_sum_adv_num"<?php echo $paymentsummary->pay_sum_adv_num->EditAttributes() ?>>
<?php
if (is_array($paymentsummary->pay_sum_adv_num->EditValue)) {
	$arwrk = $paymentsummary->pay_sum_adv_num->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($paymentsummary->pay_sum_adv_num->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
if (@$emptywrk) $paymentsummary->pay_sum_adv_num->OldValue = "";
?>
</select>
<input type="hidden" name="o<?php echo $paymentsummary_grid->RowIndex ?>_pay_sum_adv_num" id="o<?php echo $paymentsummary_grid->RowIndex ?>_pay_sum_adv_num" value="<?php echo ew_HtmlEncode($paymentsummary->pay_sum_adv_num->OldValue) ?>">
<?php } ?>
<?php if ($paymentsummary->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<div<?php echo $paymentsummary->pay_sum_adv_num->ViewAttributes() ?>><?php echo $paymentsummary->pay_sum_adv_num->EditValue ?></div>
<input type="hidden" name="x<?php echo $paymentsummary_grid->RowIndex ?>_pay_sum_adv_num" id="x<?php echo $paymentsummary_grid->RowIndex ?>_pay_sum_adv_num" value="<?php echo ew_HtmlEncode($paymentsummary->pay_sum_adv_num->CurrentValue) ?>">
<?php } ?>
<?php if ($paymentsummary->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $paymentsummary->pay_sum_adv_num->ViewAttributes() ?>><?php echo $paymentsummary->pay_sum_adv_num->ListViewValue() ?></div>
<input type="hidden" name="x<?php echo $paymentsummary_grid->RowIndex ?>_pay_sum_adv_num" id="x<?php echo $paymentsummary_grid->RowIndex ?>_pay_sum_adv_num" value="<?php echo ew_HtmlEncode($paymentsummary->pay_sum_adv_num->CurrentValue) ?>">
<input type="hidden" name="o<?php echo $paymentsummary_grid->RowIndex ?>_pay_sum_adv_num" id="o<?php echo $paymentsummary_grid->RowIndex ?>_pay_sum_adv_num" value="<?php echo ew_HtmlEncode($paymentsummary->pay_sum_adv_num->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($paymentsummary->pay_annual_year->Visible) { // pay_annual_year ?>
		<td<?php echo $paymentsummary->pay_annual_year->CellAttributes() ?>>
<?php if ($paymentsummary->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<select id="x<?php echo $paymentsummary_grid->RowIndex ?>_pay_annual_year" name="x<?php echo $paymentsummary_grid->RowIndex ?>_pay_annual_year"<?php echo $paymentsummary->pay_annual_year->EditAttributes() ?>>
<?php
if (is_array($paymentsummary->pay_annual_year->EditValue)) {
	$arwrk = $paymentsummary->pay_annual_year->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($paymentsummary->pay_annual_year->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
if (@$emptywrk) $paymentsummary->pay_annual_year->OldValue = "";
?>
</select>
<input type="hidden" name="o<?php echo $paymentsummary_grid->RowIndex ?>_pay_annual_year" id="o<?php echo $paymentsummary_grid->RowIndex ?>_pay_annual_year" value="<?php echo ew_HtmlEncode($paymentsummary->pay_annual_year->OldValue) ?>">
<?php } ?>
<?php if ($paymentsummary->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<div<?php echo $paymentsummary->pay_annual_year->ViewAttributes() ?>><?php echo $paymentsummary->pay_annual_year->EditValue ?></div>
<input type="hidden" name="x<?php echo $paymentsummary_grid->RowIndex ?>_pay_annual_year" id="x<?php echo $paymentsummary_grid->RowIndex ?>_pay_annual_year" value="<?php echo ew_HtmlEncode($paymentsummary->pay_annual_year->CurrentValue) ?>">
<?php } ?>
<?php if ($paymentsummary->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $paymentsummary->pay_annual_year->ViewAttributes() ?>><?php echo $paymentsummary->pay_annual_year->ListViewValue() ?></div>
<input type="hidden" name="x<?php echo $paymentsummary_grid->RowIndex ?>_pay_annual_year" id="x<?php echo $paymentsummary_grid->RowIndex ?>_pay_annual_year" value="<?php echo ew_HtmlEncode($paymentsummary->pay_annual_year->CurrentValue) ?>">
<input type="hidden" name="o<?php echo $paymentsummary_grid->RowIndex ?>_pay_annual_year" id="o<?php echo $paymentsummary_grid->RowIndex ?>_pay_annual_year" value="<?php echo ew_HtmlEncode($paymentsummary->pay_annual_year->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($paymentsummary->pay_sum_detail->Visible) { // pay_sum_detail ?>
		<td<?php echo $paymentsummary->pay_sum_detail->CellAttributes() ?>>
<?php if ($paymentsummary->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<select id="x<?php echo $paymentsummary_grid->RowIndex ?>_pay_sum_detail" name="x<?php echo $paymentsummary_grid->RowIndex ?>_pay_sum_detail"<?php echo $paymentsummary->pay_sum_detail->EditAttributes() ?>>
<?php
if (is_array($paymentsummary->pay_sum_detail->EditValue)) {
	$arwrk = $paymentsummary->pay_sum_detail->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($paymentsummary->pay_sum_detail->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
if (@$emptywrk) $paymentsummary->pay_sum_detail->OldValue = "";
?>
</select>
<input type="hidden" name="o<?php echo $paymentsummary_grid->RowIndex ?>_pay_sum_detail" id="o<?php echo $paymentsummary_grid->RowIndex ?>_pay_sum_detail" value="<?php echo ew_HtmlEncode($paymentsummary->pay_sum_detail->OldValue) ?>">
<?php } ?>
<?php if ($paymentsummary->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<div<?php echo $paymentsummary->pay_sum_detail->ViewAttributes() ?>><?php echo $paymentsummary->pay_sum_detail->EditValue ?></div>
<input type="hidden" name="x<?php echo $paymentsummary_grid->RowIndex ?>_pay_sum_detail" id="x<?php echo $paymentsummary_grid->RowIndex ?>_pay_sum_detail" value="<?php echo ew_HtmlEncode($paymentsummary->pay_sum_detail->CurrentValue) ?>">
<?php } ?>
<?php if ($paymentsummary->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $paymentsummary->pay_sum_detail->ViewAttributes() ?>><?php echo $paymentsummary->pay_sum_detail->ListViewValue() ?></div>
<input type="hidden" name="x<?php echo $paymentsummary_grid->RowIndex ?>_pay_sum_detail" id="x<?php echo $paymentsummary_grid->RowIndex ?>_pay_sum_detail" value="<?php echo ew_HtmlEncode($paymentsummary->pay_sum_detail->CurrentValue) ?>">
<input type="hidden" name="o<?php echo $paymentsummary_grid->RowIndex ?>_pay_sum_detail" id="o<?php echo $paymentsummary_grid->RowIndex ?>_pay_sum_detail" value="<?php echo ew_HtmlEncode($paymentsummary->pay_sum_detail->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($paymentsummary->pay_sum_total->Visible) { // pay_sum_total ?>
		<td<?php echo $paymentsummary->pay_sum_total->CellAttributes() ?>>
<?php if ($paymentsummary->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="text" name="x<?php echo $paymentsummary_grid->RowIndex ?>_pay_sum_total" id="x<?php echo $paymentsummary_grid->RowIndex ?>_pay_sum_total" size="30" value="<?php echo $paymentsummary->pay_sum_total->EditValue ?>"<?php echo $paymentsummary->pay_sum_total->EditAttributes() ?>>
<input type="hidden" name="o<?php echo $paymentsummary_grid->RowIndex ?>_pay_sum_total" id="o<?php echo $paymentsummary_grid->RowIndex ?>_pay_sum_total" value="<?php echo ew_HtmlEncode($paymentsummary->pay_sum_total->OldValue) ?>">
<?php } ?>
<?php if ($paymentsummary->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<div<?php echo $paymentsummary->pay_sum_total->ViewAttributes() ?>><?php echo $paymentsummary->pay_sum_total->EditValue ?></div>
<input type="hidden" name="x<?php echo $paymentsummary_grid->RowIndex ?>_pay_sum_total" id="x<?php echo $paymentsummary_grid->RowIndex ?>_pay_sum_total" value="<?php echo ew_HtmlEncode($paymentsummary->pay_sum_total->CurrentValue) ?>">
<?php } ?>
<?php if ($paymentsummary->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $paymentsummary->pay_sum_total->ViewAttributes() ?>><?php echo $paymentsummary->pay_sum_total->ListViewValue() ?></div>
<input type="hidden" name="x<?php echo $paymentsummary_grid->RowIndex ?>_pay_sum_total" id="x<?php echo $paymentsummary_grid->RowIndex ?>_pay_sum_total" value="<?php echo ew_HtmlEncode($paymentsummary->pay_sum_total->CurrentValue) ?>">
<input type="hidden" name="o<?php echo $paymentsummary_grid->RowIndex ?>_pay_sum_total" id="o<?php echo $paymentsummary_grid->RowIndex ?>_pay_sum_total" value="<?php echo ew_HtmlEncode($paymentsummary->pay_sum_total->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($paymentsummary->pay_sum_note->Visible) { // pay_sum_note ?>
		<td<?php echo $paymentsummary->pay_sum_note->CellAttributes() ?>>
<?php if ($paymentsummary->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<textarea name="x<?php echo $paymentsummary_grid->RowIndex ?>_pay_sum_note" id="x<?php echo $paymentsummary_grid->RowIndex ?>_pay_sum_note" cols="35" rows="4"<?php echo $paymentsummary->pay_sum_note->EditAttributes() ?>><?php echo $paymentsummary->pay_sum_note->EditValue ?></textarea>
<input type="hidden" name="o<?php echo $paymentsummary_grid->RowIndex ?>_pay_sum_note" id="o<?php echo $paymentsummary_grid->RowIndex ?>_pay_sum_note" value="<?php echo ew_HtmlEncode($paymentsummary->pay_sum_note->OldValue) ?>">
<?php } ?>
<?php if ($paymentsummary->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<textarea name="x<?php echo $paymentsummary_grid->RowIndex ?>_pay_sum_note" id="x<?php echo $paymentsummary_grid->RowIndex ?>_pay_sum_note" cols="35" rows="4"<?php echo $paymentsummary->pay_sum_note->EditAttributes() ?>><?php echo $paymentsummary->pay_sum_note->EditValue ?></textarea>
<?php } ?>
<?php if ($paymentsummary->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $paymentsummary->pay_sum_note->ViewAttributes() ?>><?php echo $paymentsummary->pay_sum_note->ListViewValue() ?></div>
<input type="hidden" name="x<?php echo $paymentsummary_grid->RowIndex ?>_pay_sum_note" id="x<?php echo $paymentsummary_grid->RowIndex ?>_pay_sum_note" value="<?php echo ew_HtmlEncode($paymentsummary->pay_sum_note->CurrentValue) ?>">
<input type="hidden" name="o<?php echo $paymentsummary_grid->RowIndex ?>_pay_sum_note" id="o<?php echo $paymentsummary_grid->RowIndex ?>_pay_sum_note" value="<?php echo ew_HtmlEncode($paymentsummary->pay_sum_note->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$paymentsummary_grid->ListOptions->Render("body", "right");
?>
	</tr>
<?php if ($paymentsummary->RowType == EW_ROWTYPE_ADD) { ?>
<?php } ?>
<?php if ($paymentsummary->RowType == EW_ROWTYPE_EDIT) { ?>
<?php } ?>
<?php
	}
	} // End delete row checking
	if ($paymentsummary->CurrentAction <> "gridadd" || $paymentsummary->CurrentMode == "copy")
		if (!$paymentsummary_grid->Recordset->EOF) $paymentsummary_grid->Recordset->MoveNext();
}
?>
<?php
	if ($paymentsummary->CurrentMode == "add" || $paymentsummary->CurrentMode == "copy" || $paymentsummary->CurrentMode == "edit") {
		$paymentsummary_grid->RowIndex = '$rowindex$';
		$paymentsummary_grid->LoadDefaultValues();

		// Set row properties
		$paymentsummary->ResetAttrs();
		$paymentsummary->RowAttrs = array();
		if (!empty($paymentsummary_grid->RowIndex))
			$paymentsummary->RowAttrs = array_merge($paymentsummary->RowAttrs, array('data-rowindex'=>$paymentsummary_grid->RowIndex, 'id'=>'r' . $paymentsummary_grid->RowIndex . '_paymentsummary'));
		$paymentsummary->RowType = EW_ROWTYPE_ADD;

		// Render row
		$paymentsummary_grid->RenderRow();

		// Render list options
		$paymentsummary_grid->RenderListOptions();

		// Add id and class to the template row
		$paymentsummary->RowAttrs["id"] = "r0_paymentsummary";
		ew_AppendClass($paymentsummary->RowAttrs["class"], "ewTemplate");
?>
	<tr<?php echo $paymentsummary->RowAttributes() ?>>
<?php

// Render list options (body, left)
$paymentsummary_grid->ListOptions->Render("body", "left");
?>
	<?php if ($paymentsummary->t_code->Visible) { // t_code ?>
		<td>
<?php if ($paymentsummary->CurrentAction <> "F") { ?>
<?php if ($paymentsummary->t_code->getSessionValue() <> "") { ?>
<div<?php echo $paymentsummary->t_code->ViewAttributes() ?>><?php echo $paymentsummary->t_code->ListViewValue() ?></div>
<input type="hidden" id="x<?php echo $paymentsummary_grid->RowIndex ?>_t_code" name="x<?php echo $paymentsummary_grid->RowIndex ?>_t_code" value="<?php echo ew_HtmlEncode($paymentsummary->t_code->CurrentValue) ?>">
<?php } else { ?>
<select id="x<?php echo $paymentsummary_grid->RowIndex ?>_t_code" name="x<?php echo $paymentsummary_grid->RowIndex ?>_t_code"<?php echo $paymentsummary->t_code->EditAttributes() ?>>
<?php
if (is_array($paymentsummary->t_code->EditValue)) {
	$arwrk = $paymentsummary->t_code->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($paymentsummary->t_code->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
if (@$emptywrk) $paymentsummary->t_code->OldValue = "";
?>
</select>
<?php } ?>
<?php } else { ?>
<div<?php echo $paymentsummary->t_code->ViewAttributes() ?>><?php echo $paymentsummary->t_code->ViewValue ?></div>
<input type="hidden" name="x<?php echo $paymentsummary_grid->RowIndex ?>_t_code" id="x<?php echo $paymentsummary_grid->RowIndex ?>_t_code" value="<?php echo ew_HtmlEncode($paymentsummary->t_code->FormValue) ?>">
<?php } ?>
<input type="hidden" name="o<?php echo $paymentsummary_grid->RowIndex ?>_t_code" id="o<?php echo $paymentsummary_grid->RowIndex ?>_t_code" value="<?php echo ew_HtmlEncode($paymentsummary->t_code->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($paymentsummary->village_id->Visible) { // village_id ?>
		<td>
<?php if ($paymentsummary->CurrentAction <> "F") { ?>
<?php if ($paymentsummary->village_id->getSessionValue() <> "") { ?>
<div<?php echo $paymentsummary->village_id->ViewAttributes() ?>><?php echo $paymentsummary->village_id->ListViewValue() ?></div>
<input type="hidden" id="x<?php echo $paymentsummary_grid->RowIndex ?>_village_id" name="x<?php echo $paymentsummary_grid->RowIndex ?>_village_id" value="<?php echo ew_HtmlEncode($paymentsummary->village_id->CurrentValue) ?>">
<?php } else { ?>
<select id="x<?php echo $paymentsummary_grid->RowIndex ?>_village_id" name="x<?php echo $paymentsummary_grid->RowIndex ?>_village_id"<?php echo $paymentsummary->village_id->EditAttributes() ?>>
<?php
if (is_array($paymentsummary->village_id->EditValue)) {
	$arwrk = $paymentsummary->village_id->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($paymentsummary->village_id->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
if (@$emptywrk) $paymentsummary->village_id->OldValue = "";
?>
</select>
<?php } ?>
<?php } else { ?>
<div<?php echo $paymentsummary->village_id->ViewAttributes() ?>><?php echo $paymentsummary->village_id->ViewValue ?></div>
<input type="hidden" name="x<?php echo $paymentsummary_grid->RowIndex ?>_village_id" id="x<?php echo $paymentsummary_grid->RowIndex ?>_village_id" value="<?php echo ew_HtmlEncode($paymentsummary->village_id->FormValue) ?>">
<?php } ?>
<input type="hidden" name="o<?php echo $paymentsummary_grid->RowIndex ?>_village_id" id="o<?php echo $paymentsummary_grid->RowIndex ?>_village_id" value="<?php echo ew_HtmlEncode($paymentsummary->village_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($paymentsummary->member_code->Visible) { // member_code ?>
		<td>
<?php if ($paymentsummary->CurrentAction <> "F") { ?>
<div id="tp_x<?php echo $paymentsummary_grid->RowIndex ?>_member_code" class="<?php echo EW_ITEM_TEMPLATE_CLASSNAME; ?>"><input type="checkbox" name="x<?php echo $paymentsummary_grid->RowIndex ?>_member_code[]" id="x<?php echo $paymentsummary_grid->RowIndex ?>_member_code[]" value="{value}"<?php echo $paymentsummary->member_code->EditAttributes() ?>></div>
<div id="dsl_x<?php echo $paymentsummary_grid->RowIndex ?>_member_code" data-repeatcolumn="5" class="ewItemList">
<?php
$arwrk = $paymentsummary->member_code->EditValue;
if (is_array($arwrk)) {
	$armultiwrk= explode(",", strval($paymentsummary->member_code->CurrentValue));
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = "";
		$cnt = count($armultiwrk);
		for ($ari = 0; $ari < $cnt; $ari++) {
			if (strval($arwrk[$rowcntwrk][0]) == trim(strval($armultiwrk[$ari]))) {
				$selwrk = " checked=\"checked\"";
				if ($selwrk <> "") $emptywrk = FALSE;
				break;
			}
		}

		// Note: No spacing within the LABEL tag
?>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 1) ?>
<label><input type="checkbox" name="x<?php echo $paymentsummary_grid->RowIndex ?>_member_code[]" id="x<?php echo $paymentsummary_grid->RowIndex ?>_member_code[]" value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?><?php echo $paymentsummary->member_code->EditAttributes() ?>><?php echo $arwrk[$rowcntwrk][1] ?><?php echo ew_ValueSeparator($rowcntwrk,1,$paymentsummary->member_code) ?><?php echo $arwrk[$rowcntwrk][2] ?><?php echo ew_ValueSeparator($rowcntwrk,2,$paymentsummary->member_code) ?><?php echo $arwrk[$rowcntwrk][3] ?></label>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 2) ?>
<?php
	}
}
if (@$emptywrk) $paymentsummary->member_code->OldValue = "";
?>
</div>
<?php } else { ?>
<div<?php echo $paymentsummary->member_code->ViewAttributes() ?>><?php echo $paymentsummary->member_code->ViewValue ?></div>
<input type="hidden" name="x<?php echo $paymentsummary_grid->RowIndex ?>_member_code" id="x<?php echo $paymentsummary_grid->RowIndex ?>_member_code" value="<?php echo ew_HtmlEncode($paymentsummary->member_code->FormValue) ?>">
<?php } ?>
<input type="hidden" name="o<?php echo $paymentsummary_grid->RowIndex ?>_member_code[]" id="o<?php echo $paymentsummary_grid->RowIndex ?>_member_code[]" value="<?php echo ew_HtmlEncode($paymentsummary->member_code->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($paymentsummary->pay_sum_date->Visible) { // pay_sum_date ?>
		<td>
<?php if ($paymentsummary->CurrentAction <> "F") { ?>
<input type="text" name="x<?php echo $paymentsummary_grid->RowIndex ?>_pay_sum_date" id="x<?php echo $paymentsummary_grid->RowIndex ?>_pay_sum_date" value="<?php echo $paymentsummary->pay_sum_date->EditValue ?>"<?php echo $paymentsummary->pay_sum_date->EditAttributes() ?>>
&nbsp;<img src="phpimages/calendar.png" id="cal_x<?php echo $paymentsummary_grid->RowIndex ?>_pay_sum_date" name="cal_x<?php echo $paymentsummary_grid->RowIndex ?>_pay_sum_date" alt="<?php echo $Language->Phrase("PickDate") ?>" title="<?php echo $Language->Phrase("PickDate") ?>" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField: "x<?php echo $paymentsummary_grid->RowIndex ?>_pay_sum_date", // input field id
	ifFormat: "%d/%m/%Y", // date format
	button: "cal_x<?php echo $paymentsummary_grid->RowIndex ?>_pay_sum_date" // button id
});
</script>
<?php } else { ?>
<div<?php echo $paymentsummary->pay_sum_date->ViewAttributes() ?>><?php echo $paymentsummary->pay_sum_date->ViewValue ?></div>
<input type="hidden" name="x<?php echo $paymentsummary_grid->RowIndex ?>_pay_sum_date" id="x<?php echo $paymentsummary_grid->RowIndex ?>_pay_sum_date" value="<?php echo ew_HtmlEncode($paymentsummary->pay_sum_date->FormValue) ?>">
<?php } ?>
<input type="hidden" name="o<?php echo $paymentsummary_grid->RowIndex ?>_pay_sum_date" id="o<?php echo $paymentsummary_grid->RowIndex ?>_pay_sum_date" value="<?php echo ew_HtmlEncode($paymentsummary->pay_sum_date->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($paymentsummary->pay_sum_type->Visible) { // pay_sum_type ?>
		<td>
<?php if ($paymentsummary->CurrentAction <> "F") { ?>
<select id="x<?php echo $paymentsummary_grid->RowIndex ?>_pay_sum_type" name="x<?php echo $paymentsummary_grid->RowIndex ?>_pay_sum_type"<?php echo $paymentsummary->pay_sum_type->EditAttributes() ?>>
<?php
if (is_array($paymentsummary->pay_sum_type->EditValue)) {
	$arwrk = $paymentsummary->pay_sum_type->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($paymentsummary->pay_sum_type->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
if (@$emptywrk) $paymentsummary->pay_sum_type->OldValue = "";
?>
</select>
<?php } else { ?>
<div<?php echo $paymentsummary->pay_sum_type->ViewAttributes() ?>><?php echo $paymentsummary->pay_sum_type->ViewValue ?></div>
<input type="hidden" name="x<?php echo $paymentsummary_grid->RowIndex ?>_pay_sum_type" id="x<?php echo $paymentsummary_grid->RowIndex ?>_pay_sum_type" value="<?php echo ew_HtmlEncode($paymentsummary->pay_sum_type->FormValue) ?>">
<?php } ?>
<input type="hidden" name="o<?php echo $paymentsummary_grid->RowIndex ?>_pay_sum_type" id="o<?php echo $paymentsummary_grid->RowIndex ?>_pay_sum_type" value="<?php echo ew_HtmlEncode($paymentsummary->pay_sum_type->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($paymentsummary->pay_death_begin->Visible) { // pay_death_begin ?>
		<td>
<?php if ($paymentsummary->CurrentAction <> "F") { ?>
<select id="x<?php echo $paymentsummary_grid->RowIndex ?>_pay_death_begin" name="x<?php echo $paymentsummary_grid->RowIndex ?>_pay_death_begin"<?php echo $paymentsummary->pay_death_begin->EditAttributes() ?>>
<?php
if (is_array($paymentsummary->pay_death_begin->EditValue)) {
	$arwrk = $paymentsummary->pay_death_begin->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($paymentsummary->pay_death_begin->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
if (@$emptywrk) $paymentsummary->pay_death_begin->OldValue = "";
?>
</select>
<?php } else { ?>
<div<?php echo $paymentsummary->pay_death_begin->ViewAttributes() ?>><?php echo $paymentsummary->pay_death_begin->ViewValue ?></div>
<input type="hidden" name="x<?php echo $paymentsummary_grid->RowIndex ?>_pay_death_begin" id="x<?php echo $paymentsummary_grid->RowIndex ?>_pay_death_begin" value="<?php echo ew_HtmlEncode($paymentsummary->pay_death_begin->FormValue) ?>">
<?php } ?>
<input type="hidden" name="o<?php echo $paymentsummary_grid->RowIndex ?>_pay_death_begin" id="o<?php echo $paymentsummary_grid->RowIndex ?>_pay_death_begin" value="<?php echo ew_HtmlEncode($paymentsummary->pay_death_begin->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($paymentsummary->pay_sum_adv_num->Visible) { // pay_sum_adv_num ?>
		<td>
<?php if ($paymentsummary->CurrentAction <> "F") { ?>
<select id="x<?php echo $paymentsummary_grid->RowIndex ?>_pay_sum_adv_num" name="x<?php echo $paymentsummary_grid->RowIndex ?>_pay_sum_adv_num"<?php echo $paymentsummary->pay_sum_adv_num->EditAttributes() ?>>
<?php
if (is_array($paymentsummary->pay_sum_adv_num->EditValue)) {
	$arwrk = $paymentsummary->pay_sum_adv_num->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($paymentsummary->pay_sum_adv_num->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
if (@$emptywrk) $paymentsummary->pay_sum_adv_num->OldValue = "";
?>
</select>
<?php } else { ?>
<div<?php echo $paymentsummary->pay_sum_adv_num->ViewAttributes() ?>><?php echo $paymentsummary->pay_sum_adv_num->ViewValue ?></div>
<input type="hidden" name="x<?php echo $paymentsummary_grid->RowIndex ?>_pay_sum_adv_num" id="x<?php echo $paymentsummary_grid->RowIndex ?>_pay_sum_adv_num" value="<?php echo ew_HtmlEncode($paymentsummary->pay_sum_adv_num->FormValue) ?>">
<?php } ?>
<input type="hidden" name="o<?php echo $paymentsummary_grid->RowIndex ?>_pay_sum_adv_num" id="o<?php echo $paymentsummary_grid->RowIndex ?>_pay_sum_adv_num" value="<?php echo ew_HtmlEncode($paymentsummary->pay_sum_adv_num->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($paymentsummary->pay_annual_year->Visible) { // pay_annual_year ?>
		<td>
<?php if ($paymentsummary->CurrentAction <> "F") { ?>
<select id="x<?php echo $paymentsummary_grid->RowIndex ?>_pay_annual_year" name="x<?php echo $paymentsummary_grid->RowIndex ?>_pay_annual_year"<?php echo $paymentsummary->pay_annual_year->EditAttributes() ?>>
<?php
if (is_array($paymentsummary->pay_annual_year->EditValue)) {
	$arwrk = $paymentsummary->pay_annual_year->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($paymentsummary->pay_annual_year->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
if (@$emptywrk) $paymentsummary->pay_annual_year->OldValue = "";
?>
</select>
<?php } else { ?>
<div<?php echo $paymentsummary->pay_annual_year->ViewAttributes() ?>><?php echo $paymentsummary->pay_annual_year->ViewValue ?></div>
<input type="hidden" name="x<?php echo $paymentsummary_grid->RowIndex ?>_pay_annual_year" id="x<?php echo $paymentsummary_grid->RowIndex ?>_pay_annual_year" value="<?php echo ew_HtmlEncode($paymentsummary->pay_annual_year->FormValue) ?>">
<?php } ?>
<input type="hidden" name="o<?php echo $paymentsummary_grid->RowIndex ?>_pay_annual_year" id="o<?php echo $paymentsummary_grid->RowIndex ?>_pay_annual_year" value="<?php echo ew_HtmlEncode($paymentsummary->pay_annual_year->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($paymentsummary->pay_sum_detail->Visible) { // pay_sum_detail ?>
		<td>
<?php if ($paymentsummary->CurrentAction <> "F") { ?>
<select id="x<?php echo $paymentsummary_grid->RowIndex ?>_pay_sum_detail" name="x<?php echo $paymentsummary_grid->RowIndex ?>_pay_sum_detail"<?php echo $paymentsummary->pay_sum_detail->EditAttributes() ?>>
<?php
if (is_array($paymentsummary->pay_sum_detail->EditValue)) {
	$arwrk = $paymentsummary->pay_sum_detail->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($paymentsummary->pay_sum_detail->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
if (@$emptywrk) $paymentsummary->pay_sum_detail->OldValue = "";
?>
</select>
<?php } else { ?>
<div<?php echo $paymentsummary->pay_sum_detail->ViewAttributes() ?>><?php echo $paymentsummary->pay_sum_detail->ViewValue ?></div>
<input type="hidden" name="x<?php echo $paymentsummary_grid->RowIndex ?>_pay_sum_detail" id="x<?php echo $paymentsummary_grid->RowIndex ?>_pay_sum_detail" value="<?php echo ew_HtmlEncode($paymentsummary->pay_sum_detail->FormValue) ?>">
<?php } ?>
<input type="hidden" name="o<?php echo $paymentsummary_grid->RowIndex ?>_pay_sum_detail" id="o<?php echo $paymentsummary_grid->RowIndex ?>_pay_sum_detail" value="<?php echo ew_HtmlEncode($paymentsummary->pay_sum_detail->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($paymentsummary->pay_sum_total->Visible) { // pay_sum_total ?>
		<td>
<?php if ($paymentsummary->CurrentAction <> "F") { ?>
<input type="text" name="x<?php echo $paymentsummary_grid->RowIndex ?>_pay_sum_total" id="x<?php echo $paymentsummary_grid->RowIndex ?>_pay_sum_total" size="30" value="<?php echo $paymentsummary->pay_sum_total->EditValue ?>"<?php echo $paymentsummary->pay_sum_total->EditAttributes() ?>>
<?php } else { ?>
<div<?php echo $paymentsummary->pay_sum_total->ViewAttributes() ?>><?php echo $paymentsummary->pay_sum_total->ViewValue ?></div>
<input type="hidden" name="x<?php echo $paymentsummary_grid->RowIndex ?>_pay_sum_total" id="x<?php echo $paymentsummary_grid->RowIndex ?>_pay_sum_total" value="<?php echo ew_HtmlEncode($paymentsummary->pay_sum_total->FormValue) ?>">
<?php } ?>
<input type="hidden" name="o<?php echo $paymentsummary_grid->RowIndex ?>_pay_sum_total" id="o<?php echo $paymentsummary_grid->RowIndex ?>_pay_sum_total" value="<?php echo ew_HtmlEncode($paymentsummary->pay_sum_total->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($paymentsummary->pay_sum_note->Visible) { // pay_sum_note ?>
		<td>
<?php if ($paymentsummary->CurrentAction <> "F") { ?>
<textarea name="x<?php echo $paymentsummary_grid->RowIndex ?>_pay_sum_note" id="x<?php echo $paymentsummary_grid->RowIndex ?>_pay_sum_note" cols="35" rows="4"<?php echo $paymentsummary->pay_sum_note->EditAttributes() ?>><?php echo $paymentsummary->pay_sum_note->EditValue ?></textarea>
<?php } else { ?>
<div<?php echo $paymentsummary->pay_sum_note->ViewAttributes() ?>><?php echo $paymentsummary->pay_sum_note->ViewValue ?></div>
<input type="hidden" name="x<?php echo $paymentsummary_grid->RowIndex ?>_pay_sum_note" id="x<?php echo $paymentsummary_grid->RowIndex ?>_pay_sum_note" value="<?php echo ew_HtmlEncode($paymentsummary->pay_sum_note->FormValue) ?>">
<?php } ?>
<input type="hidden" name="o<?php echo $paymentsummary_grid->RowIndex ?>_pay_sum_note" id="o<?php echo $paymentsummary_grid->RowIndex ?>_pay_sum_note" value="<?php echo ew_HtmlEncode($paymentsummary->pay_sum_note->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$paymentsummary_grid->ListOptions->Render("body", "right");
?>
	</tr>
<?php
}
?>
</tbody>
</table>
<?php if ($paymentsummary->CurrentMode == "add" || $paymentsummary->CurrentMode == "copy") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridinsert">
<input type="hidden" name="key_count" id="key_count" value="<?php echo $paymentsummary_grid->KeyCount ?>">
<?php echo $paymentsummary_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($paymentsummary->CurrentMode == "edit") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridupdate">
<input type="hidden" name="key_count" id="key_count" value="<?php echo $paymentsummary_grid->KeyCount ?>">
<?php echo $paymentsummary_grid->MultiSelectKey ?>
<?php } ?>
<input type="hidden" name="detailpage" id="detailpage" value="paymentsummary_grid">
</div>
<?php

// Close recordset
if ($paymentsummary_grid->Recordset)
	$paymentsummary_grid->Recordset->Close();
?>
<?php if (($paymentsummary->CurrentMode == "add" || $paymentsummary->CurrentMode == "copy" || $paymentsummary->CurrentMode == "edit") && $paymentsummary->CurrentAction != "F") { // add/copy/edit mode ?>
<div class="ewGridLowerPanel">
<?php if ($paymentsummary->AllowAddDeleteRow) { ?>
<?php if ($Security->IsLoggedIn()) { ?>
<span class="phpmaker">
<a href="javascript:void(0);" onclick="ew_AddGridRow(this);"><?php echo $Language->Phrase("AddBlankRow") ?></a>&nbsp;&nbsp;
</span>
<?php } ?>
<?php } ?>
</div>
<?php } ?>
</td></tr></table>
<?php if ($paymentsummary->Export == "" && $paymentsummary->CurrentAction == "") { ?>
<script type="text/javascript">
<!--
ew_ToggleSearchPanel(paymentsummary_grid); // Init search panel as collapsed

//-->
</script>
<?php } ?>
<?php
$paymentsummary_grid->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php
$paymentsummary_grid->Page_Terminate();
$Page =& $MasterPage;
?>
