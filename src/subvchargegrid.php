<?php include_once "administratorinfo.php" ?>
<?php

// Create page object
$subvcharge_grid = new csubvcharge_grid();
$MasterPage =& $Page;
$Page =& $subvcharge_grid;

// Page init
$subvcharge_grid->Page_Init();

// Page main
$subvcharge_grid->Page_Main();
?>
<?php if ($subvcharge->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var subvcharge_grid = new ew_Page("subvcharge_grid");

// page properties
subvcharge_grid.PageID = "grid"; // page ID
subvcharge_grid.FormID = "fsubvchargegrid"; // form ID
var EW_PAGE_ID = subvcharge_grid.PageID; // for backward compatibility

// extend page with ValidateForm function
subvcharge_grid.ValidateForm = function(fobj) {
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
		elm = fobj.elements["x" + infix + "_subvc_status"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($subvcharge->subvc_status->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_subvc_date"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($subvcharge->subvc_date->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_subvc_date"];
		if (elm && !ew_CheckEuroDate(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($subvcharge->subvc_date->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_subvc_slipt_num"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($subvcharge->subvc_slipt_num->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_subvc_slipt_num"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($subvcharge->subvc_slipt_num->FldErrMsg()) ?>");

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
subvcharge_grid.EmptyRow = function(fobj, infix) {
	if (ew_ValueChanged(fobj, infix, "member_code", false)) return false;
	if (ew_ValueChanged(fobj, infix, "subvc_status", false)) return false;
	if (ew_ValueChanged(fobj, infix, "subvc_date", false)) return false;
	if (ew_ValueChanged(fobj, infix, "subvc_slipt_num", false)) return false;
	return true;
}

// extend page with Form_CustomValidate function
subvcharge_grid.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
subvcharge_grid.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
subvcharge_grid.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
subvcharge_grid.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<link rel="stylesheet" type="text/css" media="all" href="calendar/calendar-win2k-cold-1.css" title="win2k-1">
<script type="text/javascript" src="calendar/calendar.js"></script>
<script type="text/javascript" src="calendar/lang/calendar-en.js"></script>
<script type="text/javascript" src="calendar/calendar-setup.js"></script>
<?php } ?>
<?php
if ($subvcharge->CurrentAction == "gridadd") {
	if ($subvcharge->CurrentMode == "copy") {
		$bSelectLimit = EW_SELECT_LIMIT;
		if ($bSelectLimit) {
			$subvcharge_grid->TotalRecs = $subvcharge->SelectRecordCount();
			$subvcharge_grid->Recordset = $subvcharge_grid->LoadRecordset($subvcharge_grid->StartRec-1, $subvcharge_grid->DisplayRecs);
		} else {
			if ($subvcharge_grid->Recordset = $subvcharge_grid->LoadRecordset())
				$subvcharge_grid->TotalRecs = $subvcharge_grid->Recordset->RecordCount();
		}
		$subvcharge_grid->StartRec = 1;
		$subvcharge_grid->DisplayRecs = $subvcharge_grid->TotalRecs;
	} else {
		$subvcharge->CurrentFilter = "0=1";
		$subvcharge_grid->StartRec = 1;
		$subvcharge_grid->DisplayRecs = $subvcharge->GridAddRowCount;
	}
	$subvcharge_grid->TotalRecs = $subvcharge_grid->DisplayRecs;
	$subvcharge_grid->StopRec = $subvcharge_grid->DisplayRecs;
} else {
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$subvcharge_grid->TotalRecs = $subvcharge->SelectRecordCount();
	} else {
		if ($subvcharge_grid->Recordset = $subvcharge_grid->LoadRecordset())
			$subvcharge_grid->TotalRecs = $subvcharge_grid->Recordset->RecordCount();
	}
	$subvcharge_grid->StartRec = 1;
	$subvcharge_grid->DisplayRecs = $subvcharge_grid->TotalRecs; // Display all records
	if ($bSelectLimit)
		$subvcharge_grid->Recordset = $subvcharge_grid->LoadRecordset($subvcharge_grid->StartRec-1, $subvcharge_grid->DisplayRecs);
}
?>
<p class="phpmaker ewTitle" style="white-space: nowrap;"><?php if ($subvcharge->CurrentMode == "add" || $subvcharge->CurrentMode == "copy") { ?><?php echo $Language->Phrase("Add") ?><?php } elseif ($subvcharge->CurrentMode == "edit") { ?><?php echo $Language->Phrase("Edit") ?><?php } ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $subvcharge->TableCaption() ?></p>
</p>
<?php $subvcharge_grid->ShowPageHeader(); ?>
<?php
$subvcharge_grid->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if (($subvcharge->CurrentMode == "add" || $subvcharge->CurrentMode == "copy" || $subvcharge->CurrentMode == "edit") && $subvcharge->CurrentAction != "F") { // add/copy/edit mode ?>
<div class="ewGridUpperPanel">
</div>
<?php } ?>
<div id="gmp_subvcharge" class="ewGridMiddlePanel">
<table cellspacing="0" data-rowhighlightclass="ewTableHighlightRow" data-rowselectclass="ewTableSelectRow" data-roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $subvcharge->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$subvcharge_grid->RenderListOptions();

// Render list options (header, left)
$subvcharge_grid->ListOptions->Render("header", "left");
?>
<?php if ($subvcharge->member_code->Visible) { // member_code ?>
	<?php if ($subvcharge->SortUrl($subvcharge->member_code) == "") { ?>
		<td style="white-space: nowrap;"><?php echo $subvcharge->member_code->FldCaption() ?></td>
	<?php } else { ?>
		<td><div>
			<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><thead><tr><td><?php echo $subvcharge->member_code->FldCaption() ?></td><td style="width: 10px;"><?php if ($subvcharge->member_code->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($subvcharge->member_code->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($subvcharge->subvc_total->Visible) { // subvc_total ?>
	<?php if ($subvcharge->SortUrl($subvcharge->subvc_total) == "") { ?>
		<td><?php echo $subvcharge->subvc_total->FldCaption() ?></td>
	<?php } else { ?>
		<td><div>
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $subvcharge->subvc_total->FldCaption() ?></td><td style="width: 10px;"><?php if ($subvcharge->subvc_total->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($subvcharge->subvc_total->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($subvcharge->assc_percent->Visible) { // assc_percent ?>
	<?php if ($subvcharge->SortUrl($subvcharge->assc_percent) == "") { ?>
		<td><?php echo $subvcharge->assc_percent->FldCaption() ?></td>
	<?php } else { ?>
		<td><div>
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $subvcharge->assc_percent->FldCaption() ?></td><td style="width: 10px;"><?php if ($subvcharge->assc_percent->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($subvcharge->assc_percent->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($subvcharge->assc_total->Visible) { // assc_total ?>
	<?php if ($subvcharge->SortUrl($subvcharge->assc_total) == "") { ?>
		<td><?php echo $subvcharge->assc_total->FldCaption() ?></td>
	<?php } else { ?>
		<td><div>
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $subvcharge->assc_total->FldCaption() ?></td><td style="width: 10px;"><?php if ($subvcharge->assc_total->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($subvcharge->assc_total->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($subvcharge->bnfc_total->Visible) { // bnfc_total ?>
	<?php if ($subvcharge->SortUrl($subvcharge->bnfc_total) == "") { ?>
		<td><?php echo $subvcharge->bnfc_total->FldCaption() ?></td>
	<?php } else { ?>
		<td><div>
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $subvcharge->bnfc_total->FldCaption() ?></td><td style="width: 10px;"><?php if ($subvcharge->bnfc_total->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($subvcharge->bnfc_total->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($subvcharge->subvc_status->Visible) { // subvc_status ?>
	<?php if ($subvcharge->SortUrl($subvcharge->subvc_status) == "") { ?>
		<td><?php echo $subvcharge->subvc_status->FldCaption() ?></td>
	<?php } else { ?>
		<td><div>
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $subvcharge->subvc_status->FldCaption() ?></td><td style="width: 10px;"><?php if ($subvcharge->subvc_status->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($subvcharge->subvc_status->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($subvcharge->subvc_date->Visible) { // subvc_date ?>
	<?php if ($subvcharge->SortUrl($subvcharge->subvc_date) == "") { ?>
		<td><?php echo $subvcharge->subvc_date->FldCaption() ?></td>
	<?php } else { ?>
		<td><div>
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $subvcharge->subvc_date->FldCaption() ?></td><td style="width: 10px;"><?php if ($subvcharge->subvc_date->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($subvcharge->subvc_date->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($subvcharge->subvc_slipt_num->Visible) { // subvc_slipt_num ?>
	<?php if ($subvcharge->SortUrl($subvcharge->subvc_slipt_num) == "") { ?>
		<td><?php echo $subvcharge->subvc_slipt_num->FldCaption() ?></td>
	<?php } else { ?>
		<td><div>
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $subvcharge->subvc_slipt_num->FldCaption() ?></td><td style="width: 10px;"><?php if ($subvcharge->subvc_slipt_num->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($subvcharge->subvc_slipt_num->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$subvcharge_grid->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
$subvcharge_grid->StartRec = 1;
$subvcharge_grid->StopRec = $subvcharge_grid->TotalRecs; // Show all records

// Restore number of post back records
if ($objForm) {
	$objForm->Index = 0;
	if ($objForm->HasValue("key_count") && ($subvcharge->CurrentAction == "gridadd" || $subvcharge->CurrentAction == "gridedit" || $subvcharge->CurrentAction == "F")) {
		$subvcharge_grid->KeyCount = $objForm->GetValue("key_count");
		$subvcharge_grid->StopRec = $subvcharge_grid->KeyCount;
	}
}
$subvcharge_grid->RecCnt = $subvcharge_grid->StartRec - 1;
if ($subvcharge_grid->Recordset && !$subvcharge_grid->Recordset->EOF) {
	$subvcharge_grid->Recordset->MoveFirst();
	if (!$bSelectLimit && $subvcharge_grid->StartRec > 1)
		$subvcharge_grid->Recordset->Move($subvcharge_grid->StartRec - 1);
} elseif (!$subvcharge->AllowAddDeleteRow && $subvcharge_grid->StopRec == 0) {
	$subvcharge_grid->StopRec = $subvcharge->GridAddRowCount;
}

// Initialize aggregate
$subvcharge->RowType = EW_ROWTYPE_AGGREGATEINIT;
$subvcharge->ResetAttrs();
$subvcharge_grid->RenderRow();
$subvcharge_grid->RowCnt = 0;
if ($subvcharge->CurrentAction == "gridadd")
	$subvcharge_grid->RowIndex = 0;
if ($subvcharge->CurrentAction == "gridedit")
	$subvcharge_grid->RowIndex = 0;
while ($subvcharge_grid->RecCnt < $subvcharge_grid->StopRec) {
	$subvcharge_grid->RecCnt++;
	if (intval($subvcharge_grid->RecCnt) >= intval($subvcharge_grid->StartRec)) {
		$subvcharge_grid->RowCnt++;
		if ($subvcharge->CurrentAction == "gridadd" || $subvcharge->CurrentAction == "gridedit" || $subvcharge->CurrentAction == "F") {
			$subvcharge_grid->RowIndex++;
			$objForm->Index = $subvcharge_grid->RowIndex;
			if ($objForm->HasValue("k_action"))
				$subvcharge_grid->RowAction = strval($objForm->GetValue("k_action"));
			elseif ($subvcharge->CurrentAction == "gridadd")
				$subvcharge_grid->RowAction = "insert";
			else
				$subvcharge_grid->RowAction = "";
		}

		// Set up key count
		$subvcharge_grid->KeyCount = $subvcharge_grid->RowIndex;

		// Init row class and style
		$subvcharge->ResetAttrs();
		$subvcharge->CssClass = "";
		if ($subvcharge->CurrentAction == "gridadd") {
			if ($subvcharge->CurrentMode == "copy") {
				$subvcharge_grid->LoadRowValues($subvcharge_grid->Recordset); // Load row values
				$subvcharge_grid->SetRecordKey($subvcharge_grid->RowOldKey, $subvcharge_grid->Recordset); // Set old record key
			} else {
				$subvcharge_grid->LoadDefaultValues(); // Load default values
				$subvcharge_grid->RowOldKey = ""; // Clear old key value
			}
		} elseif ($subvcharge->CurrentAction == "gridedit") {
			$subvcharge_grid->LoadRowValues($subvcharge_grid->Recordset); // Load row values
		}
		$subvcharge->RowType = EW_ROWTYPE_VIEW; // Render view
		if ($subvcharge->CurrentAction == "gridadd") // Grid add
			$subvcharge->RowType = EW_ROWTYPE_ADD; // Render add
		if ($subvcharge->CurrentAction == "gridadd" && $subvcharge->EventCancelled && !$objForm->HasValue("k_blankrow")) // Insert failed
			$subvcharge_grid->RestoreCurrentRowFormValues($subvcharge_grid->RowIndex); // Restore form values
		if ($subvcharge->CurrentAction == "gridedit") { // Grid edit
			if ($subvcharge->EventCancelled) {
				$subvcharge_grid->RestoreCurrentRowFormValues($subvcharge_grid->RowIndex); // Restore form values
			}
			if ($subvcharge_grid->RowAction == "insert")
				$subvcharge->RowType = EW_ROWTYPE_ADD; // Render add
			else
				$subvcharge->RowType = EW_ROWTYPE_EDIT; // Render edit
		}
		if ($subvcharge->CurrentAction == "gridedit" && ($subvcharge->RowType == EW_ROWTYPE_EDIT || $subvcharge->RowType == EW_ROWTYPE_ADD) && $subvcharge->EventCancelled) // Update failed
			$subvcharge_grid->RestoreCurrentRowFormValues($subvcharge_grid->RowIndex); // Restore form values
		if ($subvcharge->RowType == EW_ROWTYPE_EDIT) // Edit row
			$subvcharge_grid->EditRowCnt++;
		if ($subvcharge->CurrentAction == "F") // Confirm row
			$subvcharge_grid->RestoreCurrentRowFormValues($subvcharge_grid->RowIndex); // Restore form values
		if ($subvcharge->RowType == EW_ROWTYPE_ADD || $subvcharge->RowType == EW_ROWTYPE_EDIT) { // Add / Edit row
			if ($subvcharge->CurrentAction == "edit") {
				$subvcharge->RowAttrs = array();
				$subvcharge->CssClass = "ewTableEditRow";
			} else {
				$subvcharge->RowAttrs = array();
			}
			if (!empty($subvcharge_grid->RowIndex))
				$subvcharge->RowAttrs = array_merge($subvcharge->RowAttrs, array('data-rowindex'=>$subvcharge_grid->RowIndex, 'id'=>'r' . $subvcharge_grid->RowIndex . '_subvcharge'));
		} else {
			$subvcharge->RowAttrs = array();
		}

		// Render row
		$subvcharge_grid->RenderRow();

		// Render list options
		$subvcharge_grid->RenderListOptions();

		// Skip delete row / empty row for confirm page
		if ($subvcharge_grid->RowAction <> "delete" && $subvcharge_grid->RowAction <> "insertdelete" && !($subvcharge_grid->RowAction == "insert" && $subvcharge->CurrentAction == "F" && $subvcharge_grid->EmptyRow())) {
?>
	<tr<?php echo $subvcharge->RowAttributes() ?>>
<?php

// Render list options (body, left)
$subvcharge_grid->ListOptions->Render("body", "left");
?>
	<?php if ($subvcharge->member_code->Visible) { // member_code ?>
		<td<?php echo $subvcharge->member_code->CellAttributes() ?>>
<?php if ($subvcharge->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<?php if ($subvcharge->member_code->getSessionValue() <> "") { ?>
<div<?php echo $subvcharge->member_code->ViewAttributes() ?>><?php echo $subvcharge->member_code->ListViewValue() ?></div>
<input type="hidden" id="x<?php echo $subvcharge_grid->RowIndex ?>_member_code" name="x<?php echo $subvcharge_grid->RowIndex ?>_member_code" value="<?php echo ew_HtmlEncode($subvcharge->member_code->CurrentValue) ?>">
<?php } else { ?>
<span id="as_x<?php echo $subvcharge_grid->RowIndex ?>_member_code" style="white-space: nowrap; z-index: <?php echo (9000 - $subvcharge_grid->RowIndex * 10) ?>">
	<input type="text" name="sv_x<?php echo $subvcharge_grid->RowIndex ?>_member_code" id="sv_x<?php echo $subvcharge_grid->RowIndex ?>_member_code" value="<?php echo $subvcharge->member_code->EditValue ?>" size="30" maxlength="100"<?php echo $subvcharge->member_code->EditAttributes() ?>>&nbsp;<span id="em_x<?php echo $subvcharge_grid->RowIndex ?>_member_code" class="ewMessage" style="display: none"><?php echo str_replace("%f", "phpimages/", $Language->Phrase("UnmatchedValue")) ?></span>
	<div id="sc_x<?php echo $subvcharge_grid->RowIndex ?>_member_code" style="z-index: <?php echo (9000 - $subvcharge_grid->RowIndex * 10) ?>"></div>
</span>
<input type="hidden" name="x<?php echo $subvcharge_grid->RowIndex ?>_member_code" id="x<?php echo $subvcharge_grid->RowIndex ?>_member_code" value="<?php echo $subvcharge->member_code->CurrentValue ?>">
<?php
 $sSqlWrk = "SELECT `member_code`, `dead_id`, `fname`, `lname` FROM `members`";
 $sWhereWrk = "`dead_id`  LIKE '{query_value}%'";
 if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
 $sSqlWrk .= " LIMIT " . EW_AUTO_SUGGEST_MAX_ENTRIES;
	$sSqlWrk = TEAencrypt($sSqlWrk, EW_RANDOM_KEY);
?>
<input type="hidden" name="s_x<?php echo $subvcharge_grid->RowIndex ?>_member_code" id="s_x<?php echo $subvcharge_grid->RowIndex ?>_member_code" value="<?php echo $sSqlWrk ?>">
<script type="text/javascript">
<!--
var oas_x<?php echo $subvcharge_grid->RowIndex ?>_member_code = new ew_AutoSuggest("sv_x<?php echo $subvcharge_grid->RowIndex ?>_member_code", "sc_x<?php echo $subvcharge_grid->RowIndex ?>_member_code", "s_x<?php echo $subvcharge_grid->RowIndex ?>_member_code", "em_x<?php echo $subvcharge_grid->RowIndex ?>_member_code", "x<?php echo $subvcharge_grid->RowIndex ?>_member_code", "", false, EW_AUTO_SUGGEST_MAX_ENTRIES);
oas_x<?php echo $subvcharge_grid->RowIndex ?>_member_code.formatResult = function(ar) {	
	var df1 = ar[1];
	var df2 = ar[2];
	if (df2 != "")
		df1 += EW_FIELD_SEP + df2;
	var df3 = ar[3];
	if (df3 != "")
		df1 += EW_FIELD_SEP + df3;
	return df1;
};
oas_x<?php echo $subvcharge_grid->RowIndex ?>_member_code.ac.typeAhead = false;

//-->
</script>
<?php } ?>
<input type="hidden" name="o<?php echo $subvcharge_grid->RowIndex ?>_member_code" id="o<?php echo $subvcharge_grid->RowIndex ?>_member_code" value="<?php echo ew_HtmlEncode($subvcharge->member_code->OldValue) ?>">
<?php } ?>
<?php if ($subvcharge->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<div<?php echo $subvcharge->member_code->ViewAttributes() ?>><?php echo $subvcharge->member_code->EditValue ?></div>
<input type="hidden" name="x<?php echo $subvcharge_grid->RowIndex ?>_member_code" id="x<?php echo $subvcharge_grid->RowIndex ?>_member_code" value="<?php echo ew_HtmlEncode($subvcharge->member_code->CurrentValue) ?>">
<?php } ?>
<?php if ($subvcharge->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $subvcharge->member_code->ViewAttributes() ?>><?php echo $subvcharge->member_code->ListViewValue() ?></div>
<input type="hidden" name="x<?php echo $subvcharge_grid->RowIndex ?>_member_code" id="x<?php echo $subvcharge_grid->RowIndex ?>_member_code" value="<?php echo ew_HtmlEncode($subvcharge->member_code->CurrentValue) ?>">
<input type="hidden" name="o<?php echo $subvcharge_grid->RowIndex ?>_member_code" id="o<?php echo $subvcharge_grid->RowIndex ?>_member_code" value="<?php echo ew_HtmlEncode($subvcharge->member_code->OldValue) ?>">
<?php } ?>
<a name="<?php echo $subvcharge_grid->PageObjName . "_row_" . $subvcharge_grid->RowCnt ?>" id="<?php echo $subvcharge_grid->PageObjName . "_row_" . $subvcharge_grid->RowCnt ?>"></a>
<?php if ($subvcharge->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="hidden" name="o<?php echo $subvcharge_grid->RowIndex ?>_subvc_id" id="o<?php echo $subvcharge_grid->RowIndex ?>_subvc_id" value="<?php echo ew_HtmlEncode($subvcharge->subvc_id->OldValue) ?>">
<?php } ?>
<?php if ($subvcharge->RowType == EW_ROWTYPE_EDIT) { ?>
<input type="hidden" name="x<?php echo $subvcharge_grid->RowIndex ?>_subvc_id" id="x<?php echo $subvcharge_grid->RowIndex ?>_subvc_id" value="<?php echo ew_HtmlEncode($subvcharge->subvc_id->CurrentValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($subvcharge->subvc_total->Visible) { // subvc_total ?>
		<td<?php echo $subvcharge->subvc_total->CellAttributes() ?>>
<?php if ($subvcharge->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="hidden" name="o<?php echo $subvcharge_grid->RowIndex ?>_subvc_total" id="o<?php echo $subvcharge_grid->RowIndex ?>_subvc_total" value="<?php echo ew_HtmlEncode($subvcharge->subvc_total->OldValue) ?>">
<?php } ?>
<?php if ($subvcharge->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<?php } ?>
<?php if ($subvcharge->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $subvcharge->subvc_total->ViewAttributes() ?>><?php echo $subvcharge->subvc_total->ListViewValue() ?></div>
<input type="hidden" name="x<?php echo $subvcharge_grid->RowIndex ?>_subvc_total" id="x<?php echo $subvcharge_grid->RowIndex ?>_subvc_total" value="<?php echo ew_HtmlEncode($subvcharge->subvc_total->CurrentValue) ?>">
<input type="hidden" name="o<?php echo $subvcharge_grid->RowIndex ?>_subvc_total" id="o<?php echo $subvcharge_grid->RowIndex ?>_subvc_total" value="<?php echo ew_HtmlEncode($subvcharge->subvc_total->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($subvcharge->assc_percent->Visible) { // assc_percent ?>
		<td<?php echo $subvcharge->assc_percent->CellAttributes() ?>>
<?php if ($subvcharge->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="hidden" name="o<?php echo $subvcharge_grid->RowIndex ?>_assc_percent" id="o<?php echo $subvcharge_grid->RowIndex ?>_assc_percent" value="<?php echo ew_HtmlEncode($subvcharge->assc_percent->OldValue) ?>">
<?php } ?>
<?php if ($subvcharge->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<?php } ?>
<?php if ($subvcharge->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $subvcharge->assc_percent->ViewAttributes() ?>><?php echo $subvcharge->assc_percent->ListViewValue() ?></div>
<input type="hidden" name="x<?php echo $subvcharge_grid->RowIndex ?>_assc_percent" id="x<?php echo $subvcharge_grid->RowIndex ?>_assc_percent" value="<?php echo ew_HtmlEncode($subvcharge->assc_percent->CurrentValue) ?>">
<input type="hidden" name="o<?php echo $subvcharge_grid->RowIndex ?>_assc_percent" id="o<?php echo $subvcharge_grid->RowIndex ?>_assc_percent" value="<?php echo ew_HtmlEncode($subvcharge->assc_percent->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($subvcharge->assc_total->Visible) { // assc_total ?>
		<td<?php echo $subvcharge->assc_total->CellAttributes() ?>>
<?php if ($subvcharge->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="hidden" name="o<?php echo $subvcharge_grid->RowIndex ?>_assc_total" id="o<?php echo $subvcharge_grid->RowIndex ?>_assc_total" value="<?php echo ew_HtmlEncode($subvcharge->assc_total->OldValue) ?>">
<?php } ?>
<?php if ($subvcharge->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<?php } ?>
<?php if ($subvcharge->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $subvcharge->assc_total->ViewAttributes() ?>><?php echo $subvcharge->assc_total->ListViewValue() ?></div>
<input type="hidden" name="x<?php echo $subvcharge_grid->RowIndex ?>_assc_total" id="x<?php echo $subvcharge_grid->RowIndex ?>_assc_total" value="<?php echo ew_HtmlEncode($subvcharge->assc_total->CurrentValue) ?>">
<input type="hidden" name="o<?php echo $subvcharge_grid->RowIndex ?>_assc_total" id="o<?php echo $subvcharge_grid->RowIndex ?>_assc_total" value="<?php echo ew_HtmlEncode($subvcharge->assc_total->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($subvcharge->bnfc_total->Visible) { // bnfc_total ?>
		<td<?php echo $subvcharge->bnfc_total->CellAttributes() ?>>
<?php if ($subvcharge->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="hidden" name="o<?php echo $subvcharge_grid->RowIndex ?>_bnfc_total" id="o<?php echo $subvcharge_grid->RowIndex ?>_bnfc_total" value="<?php echo ew_HtmlEncode($subvcharge->bnfc_total->OldValue) ?>">
<?php } ?>
<?php if ($subvcharge->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<?php } ?>
<?php if ($subvcharge->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $subvcharge->bnfc_total->ViewAttributes() ?>><?php echo $subvcharge->bnfc_total->ListViewValue() ?></div>
<input type="hidden" name="x<?php echo $subvcharge_grid->RowIndex ?>_bnfc_total" id="x<?php echo $subvcharge_grid->RowIndex ?>_bnfc_total" value="<?php echo ew_HtmlEncode($subvcharge->bnfc_total->CurrentValue) ?>">
<input type="hidden" name="o<?php echo $subvcharge_grid->RowIndex ?>_bnfc_total" id="o<?php echo $subvcharge_grid->RowIndex ?>_bnfc_total" value="<?php echo ew_HtmlEncode($subvcharge->bnfc_total->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($subvcharge->subvc_status->Visible) { // subvc_status ?>
		<td<?php echo $subvcharge->subvc_status->CellAttributes() ?>>
<?php if ($subvcharge->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<select id="x<?php echo $subvcharge_grid->RowIndex ?>_subvc_status" name="x<?php echo $subvcharge_grid->RowIndex ?>_subvc_status"<?php echo $subvcharge->subvc_status->EditAttributes() ?>>
<?php
if (is_array($subvcharge->subvc_status->EditValue)) {
	$arwrk = $subvcharge->subvc_status->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($subvcharge->subvc_status->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
if (@$emptywrk) $subvcharge->subvc_status->OldValue = "";
?>
</select>
<input type="hidden" name="o<?php echo $subvcharge_grid->RowIndex ?>_subvc_status" id="o<?php echo $subvcharge_grid->RowIndex ?>_subvc_status" value="<?php echo ew_HtmlEncode($subvcharge->subvc_status->OldValue) ?>">
<?php } ?>
<?php if ($subvcharge->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<select id="x<?php echo $subvcharge_grid->RowIndex ?>_subvc_status" name="x<?php echo $subvcharge_grid->RowIndex ?>_subvc_status"<?php echo $subvcharge->subvc_status->EditAttributes() ?>>
<?php
if (is_array($subvcharge->subvc_status->EditValue)) {
	$arwrk = $subvcharge->subvc_status->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($subvcharge->subvc_status->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
if (@$emptywrk) $subvcharge->subvc_status->OldValue = "";
?>
</select>
<?php } ?>
<?php if ($subvcharge->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $subvcharge->subvc_status->ViewAttributes() ?>><?php echo $subvcharge->subvc_status->ListViewValue() ?></div>
<input type="hidden" name="x<?php echo $subvcharge_grid->RowIndex ?>_subvc_status" id="x<?php echo $subvcharge_grid->RowIndex ?>_subvc_status" value="<?php echo ew_HtmlEncode($subvcharge->subvc_status->CurrentValue) ?>">
<input type="hidden" name="o<?php echo $subvcharge_grid->RowIndex ?>_subvc_status" id="o<?php echo $subvcharge_grid->RowIndex ?>_subvc_status" value="<?php echo ew_HtmlEncode($subvcharge->subvc_status->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($subvcharge->subvc_date->Visible) { // subvc_date ?>
		<td<?php echo $subvcharge->subvc_date->CellAttributes() ?>>
<?php if ($subvcharge->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="text" name="x<?php echo $subvcharge_grid->RowIndex ?>_subvc_date" id="x<?php echo $subvcharge_grid->RowIndex ?>_subvc_date" value="<?php echo $subvcharge->subvc_date->EditValue ?>"<?php echo $subvcharge->subvc_date->EditAttributes() ?>>
&nbsp;<img src="phpimages/calendar.png" id="cal_x<?php echo $subvcharge_grid->RowIndex ?>_subvc_date" name="cal_x<?php echo $subvcharge_grid->RowIndex ?>_subvc_date" alt="<?php echo $Language->Phrase("PickDate") ?>" title="<?php echo $Language->Phrase("PickDate") ?>" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField: "x<?php echo $subvcharge_grid->RowIndex ?>_subvc_date", // input field id
	ifFormat: "%d/%m/%Y", // date format
	button: "cal_x<?php echo $subvcharge_grid->RowIndex ?>_subvc_date" // button id
});
</script>
<input type="hidden" name="fo<?php echo $subvcharge_grid->RowIndex ?>_subvc_date" id="fo<?php echo $subvcharge_grid->RowIndex ?>_subvc_date" value="<?php echo ew_HtmlEncode(ew_FormatDateTime($subvcharge->subvc_date->OldValue, 7)) ?>">
<input type="hidden" name="o<?php echo $subvcharge_grid->RowIndex ?>_subvc_date" id="o<?php echo $subvcharge_grid->RowIndex ?>_subvc_date" value="<?php echo ew_HtmlEncode($subvcharge->subvc_date->OldValue) ?>">
<?php } ?>
<?php if ($subvcharge->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $subvcharge_grid->RowIndex ?>_subvc_date" id="x<?php echo $subvcharge_grid->RowIndex ?>_subvc_date" value="<?php echo $subvcharge->subvc_date->EditValue ?>"<?php echo $subvcharge->subvc_date->EditAttributes() ?>>
&nbsp;<img src="phpimages/calendar.png" id="cal_x<?php echo $subvcharge_grid->RowIndex ?>_subvc_date" name="cal_x<?php echo $subvcharge_grid->RowIndex ?>_subvc_date" alt="<?php echo $Language->Phrase("PickDate") ?>" title="<?php echo $Language->Phrase("PickDate") ?>" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField: "x<?php echo $subvcharge_grid->RowIndex ?>_subvc_date", // input field id
	ifFormat: "%d/%m/%Y", // date format
	button: "cal_x<?php echo $subvcharge_grid->RowIndex ?>_subvc_date" // button id
});
</script>
<?php } ?>
<?php if ($subvcharge->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $subvcharge->subvc_date->ViewAttributes() ?>><?php echo $subvcharge->subvc_date->ListViewValue() ?></div>
<input type="hidden" name="x<?php echo $subvcharge_grid->RowIndex ?>_subvc_date" id="x<?php echo $subvcharge_grid->RowIndex ?>_subvc_date" value="<?php echo ew_HtmlEncode($subvcharge->subvc_date->CurrentValue) ?>">
<input type="hidden" name="o<?php echo $subvcharge_grid->RowIndex ?>_subvc_date" id="o<?php echo $subvcharge_grid->RowIndex ?>_subvc_date" value="<?php echo ew_HtmlEncode($subvcharge->subvc_date->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($subvcharge->subvc_slipt_num->Visible) { // subvc_slipt_num ?>
		<td<?php echo $subvcharge->subvc_slipt_num->CellAttributes() ?>>
<?php if ($subvcharge->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="text" name="x<?php echo $subvcharge_grid->RowIndex ?>_subvc_slipt_num" id="x<?php echo $subvcharge_grid->RowIndex ?>_subvc_slipt_num" size="30" value="<?php echo $subvcharge->subvc_slipt_num->EditValue ?>"<?php echo $subvcharge->subvc_slipt_num->EditAttributes() ?>>
<input type="hidden" name="o<?php echo $subvcharge_grid->RowIndex ?>_subvc_slipt_num" id="o<?php echo $subvcharge_grid->RowIndex ?>_subvc_slipt_num" value="<?php echo ew_HtmlEncode($subvcharge->subvc_slipt_num->OldValue) ?>">
<?php } ?>
<?php if ($subvcharge->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $subvcharge_grid->RowIndex ?>_subvc_slipt_num" id="x<?php echo $subvcharge_grid->RowIndex ?>_subvc_slipt_num" size="30" value="<?php echo $subvcharge->subvc_slipt_num->EditValue ?>"<?php echo $subvcharge->subvc_slipt_num->EditAttributes() ?>>
<?php } ?>
<?php if ($subvcharge->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $subvcharge->subvc_slipt_num->ViewAttributes() ?>><?php echo $subvcharge->subvc_slipt_num->ListViewValue() ?></div>
<input type="hidden" name="x<?php echo $subvcharge_grid->RowIndex ?>_subvc_slipt_num" id="x<?php echo $subvcharge_grid->RowIndex ?>_subvc_slipt_num" value="<?php echo ew_HtmlEncode($subvcharge->subvc_slipt_num->CurrentValue) ?>">
<input type="hidden" name="o<?php echo $subvcharge_grid->RowIndex ?>_subvc_slipt_num" id="o<?php echo $subvcharge_grid->RowIndex ?>_subvc_slipt_num" value="<?php echo ew_HtmlEncode($subvcharge->subvc_slipt_num->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$subvcharge_grid->ListOptions->Render("body", "right");
?>
	</tr>
<?php if ($subvcharge->RowType == EW_ROWTYPE_ADD) { ?>
<?php } ?>
<?php if ($subvcharge->RowType == EW_ROWTYPE_EDIT) { ?>
<?php } ?>
<?php
	}
	} // End delete row checking
	if ($subvcharge->CurrentAction <> "gridadd" || $subvcharge->CurrentMode == "copy")
		if (!$subvcharge_grid->Recordset->EOF) $subvcharge_grid->Recordset->MoveNext();
}
?>
<?php
	if ($subvcharge->CurrentMode == "add" || $subvcharge->CurrentMode == "copy" || $subvcharge->CurrentMode == "edit") {
		$subvcharge_grid->RowIndex = '$rowindex$';
		$subvcharge_grid->LoadDefaultValues();

		// Set row properties
		$subvcharge->ResetAttrs();
		$subvcharge->RowAttrs = array();
		if (!empty($subvcharge_grid->RowIndex))
			$subvcharge->RowAttrs = array_merge($subvcharge->RowAttrs, array('data-rowindex'=>$subvcharge_grid->RowIndex, 'id'=>'r' . $subvcharge_grid->RowIndex . '_subvcharge'));
		$subvcharge->RowType = EW_ROWTYPE_ADD;

		// Render row
		$subvcharge_grid->RenderRow();

		// Render list options
		$subvcharge_grid->RenderListOptions();

		// Add id and class to the template row
		$subvcharge->RowAttrs["id"] = "r0_subvcharge";
		ew_AppendClass($subvcharge->RowAttrs["class"], "ewTemplate");
?>
	<tr<?php echo $subvcharge->RowAttributes() ?>>
<?php

// Render list options (body, left)
$subvcharge_grid->ListOptions->Render("body", "left");
?>
	<?php if ($subvcharge->member_code->Visible) { // member_code ?>
		<td>
<?php if ($subvcharge->CurrentAction <> "F") { ?>
<?php if ($subvcharge->member_code->getSessionValue() <> "") { ?>
<div<?php echo $subvcharge->member_code->ViewAttributes() ?>><?php echo $subvcharge->member_code->ListViewValue() ?></div>
<input type="hidden" id="x<?php echo $subvcharge_grid->RowIndex ?>_member_code" name="x<?php echo $subvcharge_grid->RowIndex ?>_member_code" value="<?php echo ew_HtmlEncode($subvcharge->member_code->CurrentValue) ?>">
<?php } else { ?>
<span id="as_x<?php echo $subvcharge_grid->RowIndex ?>_member_code" style="white-space: nowrap; z-index: <?php echo (9000 - $subvcharge_grid->RowIndex * 10) ?>">
	<input type="text" name="sv_x<?php echo $subvcharge_grid->RowIndex ?>_member_code" id="sv_x<?php echo $subvcharge_grid->RowIndex ?>_member_code" value="<?php echo $subvcharge->member_code->EditValue ?>" size="30" maxlength="100"<?php echo $subvcharge->member_code->EditAttributes() ?>>&nbsp;<span id="em_x<?php echo $subvcharge_grid->RowIndex ?>_member_code" class="ewMessage" style="display: none"><?php echo str_replace("%f", "phpimages/", $Language->Phrase("UnmatchedValue")) ?></span>
	<div id="sc_x<?php echo $subvcharge_grid->RowIndex ?>_member_code" style="z-index: <?php echo (9000 - $subvcharge_grid->RowIndex * 10) ?>"></div>
</span>
<input type="hidden" name="x<?php echo $subvcharge_grid->RowIndex ?>_member_code" id="x<?php echo $subvcharge_grid->RowIndex ?>_member_code" value="<?php echo $subvcharge->member_code->CurrentValue ?>">
<?php
 $sSqlWrk = "SELECT `member_code`, `dead_id`, `fname`, `lname` FROM `members`";
 $sWhereWrk = "`dead_id`  LIKE '{query_value}%'";
 if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
 $sSqlWrk .= " LIMIT " . EW_AUTO_SUGGEST_MAX_ENTRIES;
	$sSqlWrk = TEAencrypt($sSqlWrk, EW_RANDOM_KEY);
?>
<input type="hidden" name="s_x<?php echo $subvcharge_grid->RowIndex ?>_member_code" id="s_x<?php echo $subvcharge_grid->RowIndex ?>_member_code" value="<?php echo $sSqlWrk ?>">
<script type="text/javascript">
<!--
var oas_x<?php echo $subvcharge_grid->RowIndex ?>_member_code = new ew_AutoSuggest("sv_x<?php echo $subvcharge_grid->RowIndex ?>_member_code", "sc_x<?php echo $subvcharge_grid->RowIndex ?>_member_code", "s_x<?php echo $subvcharge_grid->RowIndex ?>_member_code", "em_x<?php echo $subvcharge_grid->RowIndex ?>_member_code", "x<?php echo $subvcharge_grid->RowIndex ?>_member_code", "", false, EW_AUTO_SUGGEST_MAX_ENTRIES);
oas_x<?php echo $subvcharge_grid->RowIndex ?>_member_code.formatResult = function(ar) {	
	var df1 = ar[1];
	var df2 = ar[2];
	if (df2 != "")
		df1 += EW_FIELD_SEP + df2;
	var df3 = ar[3];
	if (df3 != "")
		df1 += EW_FIELD_SEP + df3;
	return df1;
};
oas_x<?php echo $subvcharge_grid->RowIndex ?>_member_code.ac.typeAhead = false;

//-->
</script>
<?php } ?>
<?php } else { ?>
<div<?php echo $subvcharge->member_code->ViewAttributes() ?>><?php echo $subvcharge->member_code->ViewValue ?></div>
<input type="hidden" name="x<?php echo $subvcharge_grid->RowIndex ?>_member_code" id="x<?php echo $subvcharge_grid->RowIndex ?>_member_code" value="<?php echo ew_HtmlEncode($subvcharge->member_code->FormValue) ?>">
<?php } ?>
<input type="hidden" name="o<?php echo $subvcharge_grid->RowIndex ?>_member_code" id="o<?php echo $subvcharge_grid->RowIndex ?>_member_code" value="<?php echo ew_HtmlEncode($subvcharge->member_code->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($subvcharge->subvc_total->Visible) { // subvc_total ?>
		<td>
<?php if ($subvcharge->CurrentAction <> "F") { ?>
<?php } else { ?>
<div<?php echo $subvcharge->subvc_total->ViewAttributes() ?>><?php echo $subvcharge->subvc_total->ViewValue ?></div>
<input type="hidden" name="x<?php echo $subvcharge_grid->RowIndex ?>_subvc_total" id="x<?php echo $subvcharge_grid->RowIndex ?>_subvc_total" value="<?php echo ew_HtmlEncode($subvcharge->subvc_total->FormValue) ?>">
<?php } ?>
<input type="hidden" name="o<?php echo $subvcharge_grid->RowIndex ?>_subvc_total" id="o<?php echo $subvcharge_grid->RowIndex ?>_subvc_total" value="<?php echo ew_HtmlEncode($subvcharge->subvc_total->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($subvcharge->assc_percent->Visible) { // assc_percent ?>
		<td>
<?php if ($subvcharge->CurrentAction <> "F") { ?>
<?php } else { ?>
<div<?php echo $subvcharge->assc_percent->ViewAttributes() ?>><?php echo $subvcharge->assc_percent->ViewValue ?></div>
<input type="hidden" name="x<?php echo $subvcharge_grid->RowIndex ?>_assc_percent" id="x<?php echo $subvcharge_grid->RowIndex ?>_assc_percent" value="<?php echo ew_HtmlEncode($subvcharge->assc_percent->FormValue) ?>">
<?php } ?>
<input type="hidden" name="o<?php echo $subvcharge_grid->RowIndex ?>_assc_percent" id="o<?php echo $subvcharge_grid->RowIndex ?>_assc_percent" value="<?php echo ew_HtmlEncode($subvcharge->assc_percent->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($subvcharge->assc_total->Visible) { // assc_total ?>
		<td>
<?php if ($subvcharge->CurrentAction <> "F") { ?>
<?php } else { ?>
<div<?php echo $subvcharge->assc_total->ViewAttributes() ?>><?php echo $subvcharge->assc_total->ViewValue ?></div>
<input type="hidden" name="x<?php echo $subvcharge_grid->RowIndex ?>_assc_total" id="x<?php echo $subvcharge_grid->RowIndex ?>_assc_total" value="<?php echo ew_HtmlEncode($subvcharge->assc_total->FormValue) ?>">
<?php } ?>
<input type="hidden" name="o<?php echo $subvcharge_grid->RowIndex ?>_assc_total" id="o<?php echo $subvcharge_grid->RowIndex ?>_assc_total" value="<?php echo ew_HtmlEncode($subvcharge->assc_total->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($subvcharge->bnfc_total->Visible) { // bnfc_total ?>
		<td>
<?php if ($subvcharge->CurrentAction <> "F") { ?>
<?php } else { ?>
<div<?php echo $subvcharge->bnfc_total->ViewAttributes() ?>><?php echo $subvcharge->bnfc_total->ViewValue ?></div>
<input type="hidden" name="x<?php echo $subvcharge_grid->RowIndex ?>_bnfc_total" id="x<?php echo $subvcharge_grid->RowIndex ?>_bnfc_total" value="<?php echo ew_HtmlEncode($subvcharge->bnfc_total->FormValue) ?>">
<?php } ?>
<input type="hidden" name="o<?php echo $subvcharge_grid->RowIndex ?>_bnfc_total" id="o<?php echo $subvcharge_grid->RowIndex ?>_bnfc_total" value="<?php echo ew_HtmlEncode($subvcharge->bnfc_total->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($subvcharge->subvc_status->Visible) { // subvc_status ?>
		<td>
<?php if ($subvcharge->CurrentAction <> "F") { ?>
<select id="x<?php echo $subvcharge_grid->RowIndex ?>_subvc_status" name="x<?php echo $subvcharge_grid->RowIndex ?>_subvc_status"<?php echo $subvcharge->subvc_status->EditAttributes() ?>>
<?php
if (is_array($subvcharge->subvc_status->EditValue)) {
	$arwrk = $subvcharge->subvc_status->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($subvcharge->subvc_status->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
if (@$emptywrk) $subvcharge->subvc_status->OldValue = "";
?>
</select>
<?php } else { ?>
<div<?php echo $subvcharge->subvc_status->ViewAttributes() ?>><?php echo $subvcharge->subvc_status->ViewValue ?></div>
<input type="hidden" name="x<?php echo $subvcharge_grid->RowIndex ?>_subvc_status" id="x<?php echo $subvcharge_grid->RowIndex ?>_subvc_status" value="<?php echo ew_HtmlEncode($subvcharge->subvc_status->FormValue) ?>">
<?php } ?>
<input type="hidden" name="o<?php echo $subvcharge_grid->RowIndex ?>_subvc_status" id="o<?php echo $subvcharge_grid->RowIndex ?>_subvc_status" value="<?php echo ew_HtmlEncode($subvcharge->subvc_status->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($subvcharge->subvc_date->Visible) { // subvc_date ?>
		<td>
<?php if ($subvcharge->CurrentAction <> "F") { ?>
<input type="text" name="x<?php echo $subvcharge_grid->RowIndex ?>_subvc_date" id="x<?php echo $subvcharge_grid->RowIndex ?>_subvc_date" value="<?php echo $subvcharge->subvc_date->EditValue ?>"<?php echo $subvcharge->subvc_date->EditAttributes() ?>>
&nbsp;<img src="phpimages/calendar.png" id="cal_x<?php echo $subvcharge_grid->RowIndex ?>_subvc_date" name="cal_x<?php echo $subvcharge_grid->RowIndex ?>_subvc_date" alt="<?php echo $Language->Phrase("PickDate") ?>" title="<?php echo $Language->Phrase("PickDate") ?>" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField: "x<?php echo $subvcharge_grid->RowIndex ?>_subvc_date", // input field id
	ifFormat: "%d/%m/%Y", // date format
	button: "cal_x<?php echo $subvcharge_grid->RowIndex ?>_subvc_date" // button id
});
</script>
<?php } else { ?>
<div<?php echo $subvcharge->subvc_date->ViewAttributes() ?>><?php echo $subvcharge->subvc_date->ViewValue ?></div>
<input type="hidden" name="x<?php echo $subvcharge_grid->RowIndex ?>_subvc_date" id="x<?php echo $subvcharge_grid->RowIndex ?>_subvc_date" value="<?php echo ew_HtmlEncode($subvcharge->subvc_date->FormValue) ?>">
<?php } ?>
<input type="hidden" name="o<?php echo $subvcharge_grid->RowIndex ?>_subvc_date" id="o<?php echo $subvcharge_grid->RowIndex ?>_subvc_date" value="<?php echo ew_HtmlEncode($subvcharge->subvc_date->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($subvcharge->subvc_slipt_num->Visible) { // subvc_slipt_num ?>
		<td>
<?php if ($subvcharge->CurrentAction <> "F") { ?>
<input type="text" name="x<?php echo $subvcharge_grid->RowIndex ?>_subvc_slipt_num" id="x<?php echo $subvcharge_grid->RowIndex ?>_subvc_slipt_num" size="30" value="<?php echo $subvcharge->subvc_slipt_num->EditValue ?>"<?php echo $subvcharge->subvc_slipt_num->EditAttributes() ?>>
<?php } else { ?>
<div<?php echo $subvcharge->subvc_slipt_num->ViewAttributes() ?>><?php echo $subvcharge->subvc_slipt_num->ViewValue ?></div>
<input type="hidden" name="x<?php echo $subvcharge_grid->RowIndex ?>_subvc_slipt_num" id="x<?php echo $subvcharge_grid->RowIndex ?>_subvc_slipt_num" value="<?php echo ew_HtmlEncode($subvcharge->subvc_slipt_num->FormValue) ?>">
<?php } ?>
<input type="hidden" name="o<?php echo $subvcharge_grid->RowIndex ?>_subvc_slipt_num" id="o<?php echo $subvcharge_grid->RowIndex ?>_subvc_slipt_num" value="<?php echo ew_HtmlEncode($subvcharge->subvc_slipt_num->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$subvcharge_grid->ListOptions->Render("body", "right");
?>
	</tr>
<?php
}
?>
</tbody>
</table>
<?php if ($subvcharge->CurrentMode == "add" || $subvcharge->CurrentMode == "copy") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridinsert">
<input type="hidden" name="key_count" id="key_count" value="<?php echo $subvcharge_grid->KeyCount ?>">
<?php echo $subvcharge_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($subvcharge->CurrentMode == "edit") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridupdate">
<input type="hidden" name="key_count" id="key_count" value="<?php echo $subvcharge_grid->KeyCount ?>">
<?php echo $subvcharge_grid->MultiSelectKey ?>
<?php } ?>
<input type="hidden" name="detailpage" id="detailpage" value="subvcharge_grid">
</div>
<?php

// Close recordset
if ($subvcharge_grid->Recordset)
	$subvcharge_grid->Recordset->Close();
?>
<?php if (($subvcharge->CurrentMode == "add" || $subvcharge->CurrentMode == "copy" || $subvcharge->CurrentMode == "edit") && $subvcharge->CurrentAction != "F") { // add/copy/edit mode ?>
<div class="ewGridLowerPanel">
</div>
<?php } ?>
</td></tr></table>
<?php if ($subvcharge->Export == "" && $subvcharge->CurrentAction == "") { ?>
<script type="text/javascript">
<!--
ew_ToggleSearchPanel(subvcharge_grid); // Init search panel as collapsed

//-->
</script>
<?php } ?>
<?php
$subvcharge_grid->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php
$subvcharge_grid->Page_Terminate();
$Page =& $MasterPage;
?>
