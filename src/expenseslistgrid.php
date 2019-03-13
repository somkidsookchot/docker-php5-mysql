<?php include_once "administratorinfo.php" ?>
<?php

// Create page object
$expenseslist_grid = new cexpenseslist_grid();
$MasterPage =& $Page;
$Page =& $expenseslist_grid;

// Page init
$expenseslist_grid->Page_Init();

// Page main
$expenseslist_grid->Page_Main();
?>
<?php if ($expenseslist->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var expenseslist_grid = new ew_Page("expenseslist_grid");

// page properties
expenseslist_grid.PageID = "grid"; // page ID
expenseslist_grid.FormID = "fexpenseslistgrid"; // form ID
var EW_PAGE_ID = expenseslist_grid.PageID; // for backward compatibility

// extend page with ValidateForm function
expenseslist_grid.ValidateForm = function(fobj) {
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
		elm = fobj.elements["x" + infix + "_exp_cat"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($expenseslist->exp_cat->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_exp_total"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($expenseslist->exp_total->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_exp_total"];
		if (elm && !ew_CheckNumber(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($expenseslist->exp_total->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_exp_date"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($expenseslist->exp_date->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_exp_date"];
		if (elm && !ew_CheckEuroDate(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($expenseslist->exp_date->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_exp_dispencer"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($expenseslist->exp_dispencer->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_exp_slipt_num"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($expenseslist->exp_slipt_num->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_exp_slipt_num"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($expenseslist->exp_slipt_num->FldErrMsg()) ?>");

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
expenseslist_grid.EmptyRow = function(fobj, infix) {
	if (ew_ValueChanged(fobj, infix, "exp_cat", false)) return false;
	if (ew_ValueChanged(fobj, infix, "exp_total", false)) return false;
	if (ew_ValueChanged(fobj, infix, "exp_date", false)) return false;
	if (ew_ValueChanged(fobj, infix, "exp_dispencer", false)) return false;
	if (ew_ValueChanged(fobj, infix, "exp_slipt_num", false)) return false;
	return true;
}

// extend page with Form_CustomValidate function
expenseslist_grid.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
expenseslist_grid.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
expenseslist_grid.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
expenseslist_grid.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<link rel="stylesheet" type="text/css" media="all" href="calendar/calendar-win2k-cold-1.css" title="win2k-1">
<script type="text/javascript" src="calendar/calendar.js"></script>
<script type="text/javascript" src="calendar/lang/calendar-en.js"></script>
<script type="text/javascript" src="calendar/calendar-setup.js"></script>
<?php } ?>
<?php
if ($expenseslist->CurrentAction == "gridadd") {
	if ($expenseslist->CurrentMode == "copy") {
		$bSelectLimit = EW_SELECT_LIMIT;
		if ($bSelectLimit) {
			$expenseslist_grid->TotalRecs = $expenseslist->SelectRecordCount();
			$expenseslist_grid->Recordset = $expenseslist_grid->LoadRecordset($expenseslist_grid->StartRec-1, $expenseslist_grid->DisplayRecs);
		} else {
			if ($expenseslist_grid->Recordset = $expenseslist_grid->LoadRecordset())
				$expenseslist_grid->TotalRecs = $expenseslist_grid->Recordset->RecordCount();
		}
		$expenseslist_grid->StartRec = 1;
		$expenseslist_grid->DisplayRecs = $expenseslist_grid->TotalRecs;
	} else {
		$expenseslist->CurrentFilter = "0=1";
		$expenseslist_grid->StartRec = 1;
		$expenseslist_grid->DisplayRecs = $expenseslist->GridAddRowCount;
	}
	$expenseslist_grid->TotalRecs = $expenseslist_grid->DisplayRecs;
	$expenseslist_grid->StopRec = $expenseslist_grid->DisplayRecs;
} else {
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$expenseslist_grid->TotalRecs = $expenseslist->SelectRecordCount();
	} else {
		if ($expenseslist_grid->Recordset = $expenseslist_grid->LoadRecordset())
			$expenseslist_grid->TotalRecs = $expenseslist_grid->Recordset->RecordCount();
	}
	$expenseslist_grid->StartRec = 1;
	$expenseslist_grid->DisplayRecs = $expenseslist_grid->TotalRecs; // Display all records
	if ($bSelectLimit)
		$expenseslist_grid->Recordset = $expenseslist_grid->LoadRecordset($expenseslist_grid->StartRec-1, $expenseslist_grid->DisplayRecs);
}
?>
<p class="phpmaker ewTitle" style="white-space: nowrap;"><?php if ($expenseslist->CurrentMode == "add" || $expenseslist->CurrentMode == "copy") { ?><?php echo $Language->Phrase("Add") ?><?php } elseif ($expenseslist->CurrentMode == "edit") { ?><?php echo $Language->Phrase("Edit") ?><?php } ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $expenseslist->TableCaption() ?></p>
</p>
<?php $expenseslist_grid->ShowPageHeader(); ?>
<?php
$expenseslist_grid->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if (($expenseslist->CurrentMode == "add" || $expenseslist->CurrentMode == "copy" || $expenseslist->CurrentMode == "edit") && $expenseslist->CurrentAction != "F") { // add/copy/edit mode ?>
<div class="ewGridUpperPanel">
<?php if ($expenseslist->AllowAddDeleteRow) { ?>
<?php if ($Security->IsLoggedIn()) { ?>
<span class="phpmaker">
<a href="javascript:void(0);" onclick="ew_AddGridRow(this);"><?php echo $Language->Phrase("AddBlankRow") ?></a>&nbsp;&nbsp;
</span>
<?php } ?>
<?php } ?>
</div>
<?php } ?>
<div id="gmp_expenseslist" class="ewGridMiddlePanel">
<table cellspacing="0" data-rowhighlightclass="ewTableHighlightRow" data-rowselectclass="ewTableSelectRow" data-roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $expenseslist->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$expenseslist_grid->RenderListOptions();

// Render list options (header, left)
$expenseslist_grid->ListOptions->Render("header", "left");
?>
<?php if ($expenseslist->exp_cat->Visible) { // exp_cat ?>
	<?php if ($expenseslist->SortUrl($expenseslist->exp_cat) == "") { ?>
		<td style="white-space: nowrap;"><?php echo $expenseslist->exp_cat->FldCaption() ?></td>
	<?php } else { ?>
		<td><div>
			<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><thead><tr><td><?php echo $expenseslist->exp_cat->FldCaption() ?></td><td style="width: 10px;"><?php if ($expenseslist->exp_cat->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($expenseslist->exp_cat->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($expenseslist->exp_total->Visible) { // exp_total ?>
	<?php if ($expenseslist->SortUrl($expenseslist->exp_total) == "") { ?>
		<td><?php echo $expenseslist->exp_total->FldCaption() ?></td>
	<?php } else { ?>
		<td><div>
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $expenseslist->exp_total->FldCaption() ?></td><td style="width: 10px;"><?php if ($expenseslist->exp_total->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($expenseslist->exp_total->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($expenseslist->exp_date->Visible) { // exp_date ?>
	<?php if ($expenseslist->SortUrl($expenseslist->exp_date) == "") { ?>
		<td><?php echo $expenseslist->exp_date->FldCaption() ?></td>
	<?php } else { ?>
		<td><div>
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $expenseslist->exp_date->FldCaption() ?></td><td style="width: 10px;"><?php if ($expenseslist->exp_date->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($expenseslist->exp_date->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($expenseslist->exp_dispencer->Visible) { // exp_dispencer ?>
	<?php if ($expenseslist->SortUrl($expenseslist->exp_dispencer) == "") { ?>
		<td><?php echo $expenseslist->exp_dispencer->FldCaption() ?></td>
	<?php } else { ?>
		<td><div>
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $expenseslist->exp_dispencer->FldCaption() ?></td><td style="width: 10px;"><?php if ($expenseslist->exp_dispencer->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($expenseslist->exp_dispencer->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($expenseslist->exp_slipt_num->Visible) { // exp_slipt_num ?>
	<?php if ($expenseslist->SortUrl($expenseslist->exp_slipt_num) == "") { ?>
		<td><?php echo $expenseslist->exp_slipt_num->FldCaption() ?></td>
	<?php } else { ?>
		<td><div>
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $expenseslist->exp_slipt_num->FldCaption() ?></td><td style="width: 10px;"><?php if ($expenseslist->exp_slipt_num->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($expenseslist->exp_slipt_num->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$expenseslist_grid->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
$expenseslist_grid->StartRec = 1;
$expenseslist_grid->StopRec = $expenseslist_grid->TotalRecs; // Show all records

// Restore number of post back records
if ($objForm) {
	$objForm->Index = 0;
	if ($objForm->HasValue("key_count") && ($expenseslist->CurrentAction == "gridadd" || $expenseslist->CurrentAction == "gridedit" || $expenseslist->CurrentAction == "F")) {
		$expenseslist_grid->KeyCount = $objForm->GetValue("key_count");
		$expenseslist_grid->StopRec = $expenseslist_grid->KeyCount;
	}
}
$expenseslist_grid->RecCnt = $expenseslist_grid->StartRec - 1;
if ($expenseslist_grid->Recordset && !$expenseslist_grid->Recordset->EOF) {
	$expenseslist_grid->Recordset->MoveFirst();
	if (!$bSelectLimit && $expenseslist_grid->StartRec > 1)
		$expenseslist_grid->Recordset->Move($expenseslist_grid->StartRec - 1);
} elseif (!$expenseslist->AllowAddDeleteRow && $expenseslist_grid->StopRec == 0) {
	$expenseslist_grid->StopRec = $expenseslist->GridAddRowCount;
}

// Initialize aggregate
$expenseslist->RowType = EW_ROWTYPE_AGGREGATEINIT;
$expenseslist->ResetAttrs();
$expenseslist_grid->RenderRow();
$expenseslist_grid->RowCnt = 0;
if ($expenseslist->CurrentAction == "gridadd")
	$expenseslist_grid->RowIndex = 0;
if ($expenseslist->CurrentAction == "gridedit")
	$expenseslist_grid->RowIndex = 0;
while ($expenseslist_grid->RecCnt < $expenseslist_grid->StopRec) {
	$expenseslist_grid->RecCnt++;
	if (intval($expenseslist_grid->RecCnt) >= intval($expenseslist_grid->StartRec)) {
		$expenseslist_grid->RowCnt++;
		if ($expenseslist->CurrentAction == "gridadd" || $expenseslist->CurrentAction == "gridedit" || $expenseslist->CurrentAction == "F") {
			$expenseslist_grid->RowIndex++;
			$objForm->Index = $expenseslist_grid->RowIndex;
			if ($objForm->HasValue("k_action"))
				$expenseslist_grid->RowAction = strval($objForm->GetValue("k_action"));
			elseif ($expenseslist->CurrentAction == "gridadd")
				$expenseslist_grid->RowAction = "insert";
			else
				$expenseslist_grid->RowAction = "";
		}

		// Set up key count
		$expenseslist_grid->KeyCount = $expenseslist_grid->RowIndex;

		// Init row class and style
		$expenseslist->ResetAttrs();
		$expenseslist->CssClass = "";
		if ($expenseslist->CurrentAction == "gridadd") {
			if ($expenseslist->CurrentMode == "copy") {
				$expenseslist_grid->LoadRowValues($expenseslist_grid->Recordset); // Load row values
				$expenseslist_grid->SetRecordKey($expenseslist_grid->RowOldKey, $expenseslist_grid->Recordset); // Set old record key
			} else {
				$expenseslist_grid->LoadDefaultValues(); // Load default values
				$expenseslist_grid->RowOldKey = ""; // Clear old key value
			}
		} elseif ($expenseslist->CurrentAction == "gridedit") {
			$expenseslist_grid->LoadRowValues($expenseslist_grid->Recordset); // Load row values
		}
		$expenseslist->RowType = EW_ROWTYPE_VIEW; // Render view
		if ($expenseslist->CurrentAction == "gridadd") // Grid add
			$expenseslist->RowType = EW_ROWTYPE_ADD; // Render add
		if ($expenseslist->CurrentAction == "gridadd" && $expenseslist->EventCancelled && !$objForm->HasValue("k_blankrow")) // Insert failed
			$expenseslist_grid->RestoreCurrentRowFormValues($expenseslist_grid->RowIndex); // Restore form values
		if ($expenseslist->CurrentAction == "gridedit") { // Grid edit
			if ($expenseslist->EventCancelled) {
				$expenseslist_grid->RestoreCurrentRowFormValues($expenseslist_grid->RowIndex); // Restore form values
			}
			if ($expenseslist_grid->RowAction == "insert")
				$expenseslist->RowType = EW_ROWTYPE_ADD; // Render add
			else
				$expenseslist->RowType = EW_ROWTYPE_EDIT; // Render edit
		}
		if ($expenseslist->CurrentAction == "gridedit" && ($expenseslist->RowType == EW_ROWTYPE_EDIT || $expenseslist->RowType == EW_ROWTYPE_ADD) && $expenseslist->EventCancelled) // Update failed
			$expenseslist_grid->RestoreCurrentRowFormValues($expenseslist_grid->RowIndex); // Restore form values
		if ($expenseslist->RowType == EW_ROWTYPE_EDIT) // Edit row
			$expenseslist_grid->EditRowCnt++;
		if ($expenseslist->CurrentAction == "F") // Confirm row
			$expenseslist_grid->RestoreCurrentRowFormValues($expenseslist_grid->RowIndex); // Restore form values
		if ($expenseslist->RowType == EW_ROWTYPE_ADD || $expenseslist->RowType == EW_ROWTYPE_EDIT) { // Add / Edit row
			if ($expenseslist->CurrentAction == "edit") {
				$expenseslist->RowAttrs = array();
				$expenseslist->CssClass = "ewTableEditRow";
			} else {
				$expenseslist->RowAttrs = array();
			}
			if (!empty($expenseslist_grid->RowIndex))
				$expenseslist->RowAttrs = array_merge($expenseslist->RowAttrs, array('data-rowindex'=>$expenseslist_grid->RowIndex, 'id'=>'r' . $expenseslist_grid->RowIndex . '_expenseslist'));
		} else {
			$expenseslist->RowAttrs = array();
		}

		// Render row
		$expenseslist_grid->RenderRow();

		// Render list options
		$expenseslist_grid->RenderListOptions();

		// Skip delete row / empty row for confirm page
		if ($expenseslist_grid->RowAction <> "delete" && $expenseslist_grid->RowAction <> "insertdelete" && !($expenseslist_grid->RowAction == "insert" && $expenseslist->CurrentAction == "F" && $expenseslist_grid->EmptyRow())) {
?>
	<tr<?php echo $expenseslist->RowAttributes() ?>>
<?php

// Render list options (body, left)
$expenseslist_grid->ListOptions->Render("body", "left");
?>
	<?php if ($expenseslist->exp_cat->Visible) { // exp_cat ?>
		<td<?php echo $expenseslist->exp_cat->CellAttributes() ?>>
<?php if ($expenseslist->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<?php if ($expenseslist->exp_cat->getSessionValue() <> "") { ?>
<div<?php echo $expenseslist->exp_cat->ViewAttributes() ?>><?php echo $expenseslist->exp_cat->ListViewValue() ?></div>
<input type="hidden" id="x<?php echo $expenseslist_grid->RowIndex ?>_exp_cat" name="x<?php echo $expenseslist_grid->RowIndex ?>_exp_cat" value="<?php echo ew_HtmlEncode($expenseslist->exp_cat->CurrentValue) ?>">
<?php } else { ?>
<select id="x<?php echo $expenseslist_grid->RowIndex ?>_exp_cat" name="x<?php echo $expenseslist_grid->RowIndex ?>_exp_cat"<?php echo $expenseslist->exp_cat->EditAttributes() ?>>
<?php
if (is_array($expenseslist->exp_cat->EditValue)) {
	$arwrk = $expenseslist->exp_cat->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($expenseslist->exp_cat->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
if (@$emptywrk) $expenseslist->exp_cat->OldValue = "";
?>
</select>
<?php } ?>
<input type="hidden" name="o<?php echo $expenseslist_grid->RowIndex ?>_exp_cat" id="o<?php echo $expenseslist_grid->RowIndex ?>_exp_cat" value="<?php echo ew_HtmlEncode($expenseslist->exp_cat->OldValue) ?>">
<?php } ?>
<?php if ($expenseslist->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<?php if ($expenseslist->exp_cat->getSessionValue() <> "") { ?>
<div<?php echo $expenseslist->exp_cat->ViewAttributes() ?>><?php echo $expenseslist->exp_cat->ListViewValue() ?></div>
<input type="hidden" id="x<?php echo $expenseslist_grid->RowIndex ?>_exp_cat" name="x<?php echo $expenseslist_grid->RowIndex ?>_exp_cat" value="<?php echo ew_HtmlEncode($expenseslist->exp_cat->CurrentValue) ?>">
<?php } else { ?>
<select id="x<?php echo $expenseslist_grid->RowIndex ?>_exp_cat" name="x<?php echo $expenseslist_grid->RowIndex ?>_exp_cat"<?php echo $expenseslist->exp_cat->EditAttributes() ?>>
<?php
if (is_array($expenseslist->exp_cat->EditValue)) {
	$arwrk = $expenseslist->exp_cat->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($expenseslist->exp_cat->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
if (@$emptywrk) $expenseslist->exp_cat->OldValue = "";
?>
</select>
<?php } ?>
<?php } ?>
<?php if ($expenseslist->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $expenseslist->exp_cat->ViewAttributes() ?>><?php echo $expenseslist->exp_cat->ListViewValue() ?></div>
<input type="hidden" name="x<?php echo $expenseslist_grid->RowIndex ?>_exp_cat" id="x<?php echo $expenseslist_grid->RowIndex ?>_exp_cat" value="<?php echo ew_HtmlEncode($expenseslist->exp_cat->CurrentValue) ?>">
<input type="hidden" name="o<?php echo $expenseslist_grid->RowIndex ?>_exp_cat" id="o<?php echo $expenseslist_grid->RowIndex ?>_exp_cat" value="<?php echo ew_HtmlEncode($expenseslist->exp_cat->OldValue) ?>">
<?php } ?>
<a name="<?php echo $expenseslist_grid->PageObjName . "_row_" . $expenseslist_grid->RowCnt ?>" id="<?php echo $expenseslist_grid->PageObjName . "_row_" . $expenseslist_grid->RowCnt ?>"></a>
<?php if ($expenseslist->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="hidden" name="o<?php echo $expenseslist_grid->RowIndex ?>_exp_id" id="o<?php echo $expenseslist_grid->RowIndex ?>_exp_id" value="<?php echo ew_HtmlEncode($expenseslist->exp_id->OldValue) ?>">
<?php } ?>
<?php if ($expenseslist->RowType == EW_ROWTYPE_EDIT) { ?>
<input type="hidden" name="x<?php echo $expenseslist_grid->RowIndex ?>_exp_id" id="x<?php echo $expenseslist_grid->RowIndex ?>_exp_id" value="<?php echo ew_HtmlEncode($expenseslist->exp_id->CurrentValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($expenseslist->exp_total->Visible) { // exp_total ?>
		<td<?php echo $expenseslist->exp_total->CellAttributes() ?>>
<?php if ($expenseslist->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="text" name="x<?php echo $expenseslist_grid->RowIndex ?>_exp_total" id="x<?php echo $expenseslist_grid->RowIndex ?>_exp_total" size="30" value="<?php echo $expenseslist->exp_total->EditValue ?>"<?php echo $expenseslist->exp_total->EditAttributes() ?>>
<input type="hidden" name="o<?php echo $expenseslist_grid->RowIndex ?>_exp_total" id="o<?php echo $expenseslist_grid->RowIndex ?>_exp_total" value="<?php echo ew_HtmlEncode($expenseslist->exp_total->OldValue) ?>">
<?php } ?>
<?php if ($expenseslist->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $expenseslist_grid->RowIndex ?>_exp_total" id="x<?php echo $expenseslist_grid->RowIndex ?>_exp_total" size="30" value="<?php echo $expenseslist->exp_total->EditValue ?>"<?php echo $expenseslist->exp_total->EditAttributes() ?>>
<?php } ?>
<?php if ($expenseslist->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $expenseslist->exp_total->ViewAttributes() ?>><?php echo $expenseslist->exp_total->ListViewValue() ?></div>
<input type="hidden" name="x<?php echo $expenseslist_grid->RowIndex ?>_exp_total" id="x<?php echo $expenseslist_grid->RowIndex ?>_exp_total" value="<?php echo ew_HtmlEncode($expenseslist->exp_total->CurrentValue) ?>">
<input type="hidden" name="o<?php echo $expenseslist_grid->RowIndex ?>_exp_total" id="o<?php echo $expenseslist_grid->RowIndex ?>_exp_total" value="<?php echo ew_HtmlEncode($expenseslist->exp_total->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($expenseslist->exp_date->Visible) { // exp_date ?>
		<td<?php echo $expenseslist->exp_date->CellAttributes() ?>>
<?php if ($expenseslist->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="text" name="x<?php echo $expenseslist_grid->RowIndex ?>_exp_date" id="x<?php echo $expenseslist_grid->RowIndex ?>_exp_date" value="<?php echo $expenseslist->exp_date->EditValue ?>"<?php echo $expenseslist->exp_date->EditAttributes() ?>>
&nbsp;<img src="phpimages/calendar.png" id="cal_x<?php echo $expenseslist_grid->RowIndex ?>_exp_date" name="cal_x<?php echo $expenseslist_grid->RowIndex ?>_exp_date" alt="<?php echo $Language->Phrase("PickDate") ?>" title="<?php echo $Language->Phrase("PickDate") ?>" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField: "x<?php echo $expenseslist_grid->RowIndex ?>_exp_date", // input field id
	ifFormat: "%d/%m/%Y", // date format
	button: "cal_x<?php echo $expenseslist_grid->RowIndex ?>_exp_date" // button id
});
</script>
<input type="hidden" name="fo<?php echo $expenseslist_grid->RowIndex ?>_exp_date" id="fo<?php echo $expenseslist_grid->RowIndex ?>_exp_date" value="<?php echo ew_HtmlEncode(ew_FormatDateTime($expenseslist->exp_date->OldValue, 7)) ?>">
<input type="hidden" name="o<?php echo $expenseslist_grid->RowIndex ?>_exp_date" id="o<?php echo $expenseslist_grid->RowIndex ?>_exp_date" value="<?php echo ew_HtmlEncode($expenseslist->exp_date->OldValue) ?>">
<?php } ?>
<?php if ($expenseslist->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $expenseslist_grid->RowIndex ?>_exp_date" id="x<?php echo $expenseslist_grid->RowIndex ?>_exp_date" value="<?php echo $expenseslist->exp_date->EditValue ?>"<?php echo $expenseslist->exp_date->EditAttributes() ?>>
&nbsp;<img src="phpimages/calendar.png" id="cal_x<?php echo $expenseslist_grid->RowIndex ?>_exp_date" name="cal_x<?php echo $expenseslist_grid->RowIndex ?>_exp_date" alt="<?php echo $Language->Phrase("PickDate") ?>" title="<?php echo $Language->Phrase("PickDate") ?>" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField: "x<?php echo $expenseslist_grid->RowIndex ?>_exp_date", // input field id
	ifFormat: "%d/%m/%Y", // date format
	button: "cal_x<?php echo $expenseslist_grid->RowIndex ?>_exp_date" // button id
});
</script>
<?php } ?>
<?php if ($expenseslist->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $expenseslist->exp_date->ViewAttributes() ?>><?php echo $expenseslist->exp_date->ListViewValue() ?></div>
<input type="hidden" name="x<?php echo $expenseslist_grid->RowIndex ?>_exp_date" id="x<?php echo $expenseslist_grid->RowIndex ?>_exp_date" value="<?php echo ew_HtmlEncode($expenseslist->exp_date->CurrentValue) ?>">
<input type="hidden" name="o<?php echo $expenseslist_grid->RowIndex ?>_exp_date" id="o<?php echo $expenseslist_grid->RowIndex ?>_exp_date" value="<?php echo ew_HtmlEncode($expenseslist->exp_date->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($expenseslist->exp_dispencer->Visible) { // exp_dispencer ?>
		<td<?php echo $expenseslist->exp_dispencer->CellAttributes() ?>>
<?php if ($expenseslist->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="text" name="x<?php echo $expenseslist_grid->RowIndex ?>_exp_dispencer" id="x<?php echo $expenseslist_grid->RowIndex ?>_exp_dispencer" size="30" maxlength="100" value="<?php echo $expenseslist->exp_dispencer->EditValue ?>"<?php echo $expenseslist->exp_dispencer->EditAttributes() ?>>
<input type="hidden" name="o<?php echo $expenseslist_grid->RowIndex ?>_exp_dispencer" id="o<?php echo $expenseslist_grid->RowIndex ?>_exp_dispencer" value="<?php echo ew_HtmlEncode($expenseslist->exp_dispencer->OldValue) ?>">
<?php } ?>
<?php if ($expenseslist->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $expenseslist_grid->RowIndex ?>_exp_dispencer" id="x<?php echo $expenseslist_grid->RowIndex ?>_exp_dispencer" size="30" maxlength="100" value="<?php echo $expenseslist->exp_dispencer->EditValue ?>"<?php echo $expenseslist->exp_dispencer->EditAttributes() ?>>
<?php } ?>
<?php if ($expenseslist->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $expenseslist->exp_dispencer->ViewAttributes() ?>><?php echo $expenseslist->exp_dispencer->ListViewValue() ?></div>
<input type="hidden" name="x<?php echo $expenseslist_grid->RowIndex ?>_exp_dispencer" id="x<?php echo $expenseslist_grid->RowIndex ?>_exp_dispencer" value="<?php echo ew_HtmlEncode($expenseslist->exp_dispencer->CurrentValue) ?>">
<input type="hidden" name="o<?php echo $expenseslist_grid->RowIndex ?>_exp_dispencer" id="o<?php echo $expenseslist_grid->RowIndex ?>_exp_dispencer" value="<?php echo ew_HtmlEncode($expenseslist->exp_dispencer->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($expenseslist->exp_slipt_num->Visible) { // exp_slipt_num ?>
		<td<?php echo $expenseslist->exp_slipt_num->CellAttributes() ?>>
<?php if ($expenseslist->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="text" name="x<?php echo $expenseslist_grid->RowIndex ?>_exp_slipt_num" id="x<?php echo $expenseslist_grid->RowIndex ?>_exp_slipt_num" size="30" maxlength="50" value="<?php echo $expenseslist->exp_slipt_num->EditValue ?>"<?php echo $expenseslist->exp_slipt_num->EditAttributes() ?>>
<input type="hidden" name="o<?php echo $expenseslist_grid->RowIndex ?>_exp_slipt_num" id="o<?php echo $expenseslist_grid->RowIndex ?>_exp_slipt_num" value="<?php echo ew_HtmlEncode($expenseslist->exp_slipt_num->OldValue) ?>">
<?php } ?>
<?php if ($expenseslist->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $expenseslist_grid->RowIndex ?>_exp_slipt_num" id="x<?php echo $expenseslist_grid->RowIndex ?>_exp_slipt_num" size="30" maxlength="50" value="<?php echo $expenseslist->exp_slipt_num->EditValue ?>"<?php echo $expenseslist->exp_slipt_num->EditAttributes() ?>>
<?php } ?>
<?php if ($expenseslist->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $expenseslist->exp_slipt_num->ViewAttributes() ?>><?php echo $expenseslist->exp_slipt_num->ListViewValue() ?></div>
<input type="hidden" name="x<?php echo $expenseslist_grid->RowIndex ?>_exp_slipt_num" id="x<?php echo $expenseslist_grid->RowIndex ?>_exp_slipt_num" value="<?php echo ew_HtmlEncode($expenseslist->exp_slipt_num->CurrentValue) ?>">
<input type="hidden" name="o<?php echo $expenseslist_grid->RowIndex ?>_exp_slipt_num" id="o<?php echo $expenseslist_grid->RowIndex ?>_exp_slipt_num" value="<?php echo ew_HtmlEncode($expenseslist->exp_slipt_num->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$expenseslist_grid->ListOptions->Render("body", "right");
?>
	</tr>
<?php if ($expenseslist->RowType == EW_ROWTYPE_ADD) { ?>
<?php } ?>
<?php if ($expenseslist->RowType == EW_ROWTYPE_EDIT) { ?>
<?php } ?>
<?php
	}
	} // End delete row checking
	if ($expenseslist->CurrentAction <> "gridadd" || $expenseslist->CurrentMode == "copy")
		if (!$expenseslist_grid->Recordset->EOF) $expenseslist_grid->Recordset->MoveNext();
}
?>
<?php
	if ($expenseslist->CurrentMode == "add" || $expenseslist->CurrentMode == "copy" || $expenseslist->CurrentMode == "edit") {
		$expenseslist_grid->RowIndex = '$rowindex$';
		$expenseslist_grid->LoadDefaultValues();

		// Set row properties
		$expenseslist->ResetAttrs();
		$expenseslist->RowAttrs = array();
		if (!empty($expenseslist_grid->RowIndex))
			$expenseslist->RowAttrs = array_merge($expenseslist->RowAttrs, array('data-rowindex'=>$expenseslist_grid->RowIndex, 'id'=>'r' . $expenseslist_grid->RowIndex . '_expenseslist'));
		$expenseslist->RowType = EW_ROWTYPE_ADD;

		// Render row
		$expenseslist_grid->RenderRow();

		// Render list options
		$expenseslist_grid->RenderListOptions();

		// Add id and class to the template row
		$expenseslist->RowAttrs["id"] = "r0_expenseslist";
		ew_AppendClass($expenseslist->RowAttrs["class"], "ewTemplate");
?>
	<tr<?php echo $expenseslist->RowAttributes() ?>>
<?php

// Render list options (body, left)
$expenseslist_grid->ListOptions->Render("body", "left");
?>
	<?php if ($expenseslist->exp_cat->Visible) { // exp_cat ?>
		<td>
<?php if ($expenseslist->CurrentAction <> "F") { ?>
<?php if ($expenseslist->exp_cat->getSessionValue() <> "") { ?>
<div<?php echo $expenseslist->exp_cat->ViewAttributes() ?>><?php echo $expenseslist->exp_cat->ListViewValue() ?></div>
<input type="hidden" id="x<?php echo $expenseslist_grid->RowIndex ?>_exp_cat" name="x<?php echo $expenseslist_grid->RowIndex ?>_exp_cat" value="<?php echo ew_HtmlEncode($expenseslist->exp_cat->CurrentValue) ?>">
<?php } else { ?>
<select id="x<?php echo $expenseslist_grid->RowIndex ?>_exp_cat" name="x<?php echo $expenseslist_grid->RowIndex ?>_exp_cat"<?php echo $expenseslist->exp_cat->EditAttributes() ?>>
<?php
if (is_array($expenseslist->exp_cat->EditValue)) {
	$arwrk = $expenseslist->exp_cat->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($expenseslist->exp_cat->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
if (@$emptywrk) $expenseslist->exp_cat->OldValue = "";
?>
</select>
<?php } ?>
<?php } else { ?>
<div<?php echo $expenseslist->exp_cat->ViewAttributes() ?>><?php echo $expenseslist->exp_cat->ViewValue ?></div>
<input type="hidden" name="x<?php echo $expenseslist_grid->RowIndex ?>_exp_cat" id="x<?php echo $expenseslist_grid->RowIndex ?>_exp_cat" value="<?php echo ew_HtmlEncode($expenseslist->exp_cat->FormValue) ?>">
<?php } ?>
<input type="hidden" name="o<?php echo $expenseslist_grid->RowIndex ?>_exp_cat" id="o<?php echo $expenseslist_grid->RowIndex ?>_exp_cat" value="<?php echo ew_HtmlEncode($expenseslist->exp_cat->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($expenseslist->exp_total->Visible) { // exp_total ?>
		<td>
<?php if ($expenseslist->CurrentAction <> "F") { ?>
<input type="text" name="x<?php echo $expenseslist_grid->RowIndex ?>_exp_total" id="x<?php echo $expenseslist_grid->RowIndex ?>_exp_total" size="30" value="<?php echo $expenseslist->exp_total->EditValue ?>"<?php echo $expenseslist->exp_total->EditAttributes() ?>>
<?php } else { ?>
<div<?php echo $expenseslist->exp_total->ViewAttributes() ?>><?php echo $expenseslist->exp_total->ViewValue ?></div>
<input type="hidden" name="x<?php echo $expenseslist_grid->RowIndex ?>_exp_total" id="x<?php echo $expenseslist_grid->RowIndex ?>_exp_total" value="<?php echo ew_HtmlEncode($expenseslist->exp_total->FormValue) ?>">
<?php } ?>
<input type="hidden" name="o<?php echo $expenseslist_grid->RowIndex ?>_exp_total" id="o<?php echo $expenseslist_grid->RowIndex ?>_exp_total" value="<?php echo ew_HtmlEncode($expenseslist->exp_total->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($expenseslist->exp_date->Visible) { // exp_date ?>
		<td>
<?php if ($expenseslist->CurrentAction <> "F") { ?>
<input type="text" name="x<?php echo $expenseslist_grid->RowIndex ?>_exp_date" id="x<?php echo $expenseslist_grid->RowIndex ?>_exp_date" value="<?php echo $expenseslist->exp_date->EditValue ?>"<?php echo $expenseslist->exp_date->EditAttributes() ?>>
&nbsp;<img src="phpimages/calendar.png" id="cal_x<?php echo $expenseslist_grid->RowIndex ?>_exp_date" name="cal_x<?php echo $expenseslist_grid->RowIndex ?>_exp_date" alt="<?php echo $Language->Phrase("PickDate") ?>" title="<?php echo $Language->Phrase("PickDate") ?>" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField: "x<?php echo $expenseslist_grid->RowIndex ?>_exp_date", // input field id
	ifFormat: "%d/%m/%Y", // date format
	button: "cal_x<?php echo $expenseslist_grid->RowIndex ?>_exp_date" // button id
});
</script>
<?php } else { ?>
<div<?php echo $expenseslist->exp_date->ViewAttributes() ?>><?php echo $expenseslist->exp_date->ViewValue ?></div>
<input type="hidden" name="x<?php echo $expenseslist_grid->RowIndex ?>_exp_date" id="x<?php echo $expenseslist_grid->RowIndex ?>_exp_date" value="<?php echo ew_HtmlEncode($expenseslist->exp_date->FormValue) ?>">
<?php } ?>
<input type="hidden" name="o<?php echo $expenseslist_grid->RowIndex ?>_exp_date" id="o<?php echo $expenseslist_grid->RowIndex ?>_exp_date" value="<?php echo ew_HtmlEncode($expenseslist->exp_date->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($expenseslist->exp_dispencer->Visible) { // exp_dispencer ?>
		<td>
<?php if ($expenseslist->CurrentAction <> "F") { ?>
<input type="text" name="x<?php echo $expenseslist_grid->RowIndex ?>_exp_dispencer" id="x<?php echo $expenseslist_grid->RowIndex ?>_exp_dispencer" size="30" maxlength="100" value="<?php echo $expenseslist->exp_dispencer->EditValue ?>"<?php echo $expenseslist->exp_dispencer->EditAttributes() ?>>
<?php } else { ?>
<div<?php echo $expenseslist->exp_dispencer->ViewAttributes() ?>><?php echo $expenseslist->exp_dispencer->ViewValue ?></div>
<input type="hidden" name="x<?php echo $expenseslist_grid->RowIndex ?>_exp_dispencer" id="x<?php echo $expenseslist_grid->RowIndex ?>_exp_dispencer" value="<?php echo ew_HtmlEncode($expenseslist->exp_dispencer->FormValue) ?>">
<?php } ?>
<input type="hidden" name="o<?php echo $expenseslist_grid->RowIndex ?>_exp_dispencer" id="o<?php echo $expenseslist_grid->RowIndex ?>_exp_dispencer" value="<?php echo ew_HtmlEncode($expenseslist->exp_dispencer->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($expenseslist->exp_slipt_num->Visible) { // exp_slipt_num ?>
		<td>
<?php if ($expenseslist->CurrentAction <> "F") { ?>
<input type="text" name="x<?php echo $expenseslist_grid->RowIndex ?>_exp_slipt_num" id="x<?php echo $expenseslist_grid->RowIndex ?>_exp_slipt_num" size="30" maxlength="50" value="<?php echo $expenseslist->exp_slipt_num->EditValue ?>"<?php echo $expenseslist->exp_slipt_num->EditAttributes() ?>>
<?php } else { ?>
<div<?php echo $expenseslist->exp_slipt_num->ViewAttributes() ?>><?php echo $expenseslist->exp_slipt_num->ViewValue ?></div>
<input type="hidden" name="x<?php echo $expenseslist_grid->RowIndex ?>_exp_slipt_num" id="x<?php echo $expenseslist_grid->RowIndex ?>_exp_slipt_num" value="<?php echo ew_HtmlEncode($expenseslist->exp_slipt_num->FormValue) ?>">
<?php } ?>
<input type="hidden" name="o<?php echo $expenseslist_grid->RowIndex ?>_exp_slipt_num" id="o<?php echo $expenseslist_grid->RowIndex ?>_exp_slipt_num" value="<?php echo ew_HtmlEncode($expenseslist->exp_slipt_num->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$expenseslist_grid->ListOptions->Render("body", "right");
?>
	</tr>
<?php
}
?>
</tbody>
</table>
<?php if ($expenseslist->CurrentMode == "add" || $expenseslist->CurrentMode == "copy") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridinsert">
<input type="hidden" name="key_count" id="key_count" value="<?php echo $expenseslist_grid->KeyCount ?>">
<?php echo $expenseslist_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($expenseslist->CurrentMode == "edit") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridupdate">
<input type="hidden" name="key_count" id="key_count" value="<?php echo $expenseslist_grid->KeyCount ?>">
<?php echo $expenseslist_grid->MultiSelectKey ?>
<?php } ?>
<input type="hidden" name="detailpage" id="detailpage" value="expenseslist_grid">
</div>
<?php

// Close recordset
if ($expenseslist_grid->Recordset)
	$expenseslist_grid->Recordset->Close();
?>
<?php if (($expenseslist->CurrentMode == "add" || $expenseslist->CurrentMode == "copy" || $expenseslist->CurrentMode == "edit") && $expenseslist->CurrentAction != "F") { // add/copy/edit mode ?>
<div class="ewGridLowerPanel">
<?php if ($expenseslist->AllowAddDeleteRow) { ?>
<?php if ($Security->IsLoggedIn()) { ?>
<span class="phpmaker">
<a href="javascript:void(0);" onclick="ew_AddGridRow(this);"><?php echo $Language->Phrase("AddBlankRow") ?></a>&nbsp;&nbsp;
</span>
<?php } ?>
<?php } ?>
</div>
<?php } ?>
</td></tr></table>
<?php if ($expenseslist->Export == "" && $expenseslist->CurrentAction == "") { ?>
<script type="text/javascript">
<!--
ew_ToggleSearchPanel(expenseslist_grid); // Init search panel as collapsed

//-->
</script>
<?php } ?>
<?php
$expenseslist_grid->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php
$expenseslist_grid->Page_Terminate();
$Page =& $MasterPage;
?>
