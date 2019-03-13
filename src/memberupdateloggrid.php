<?php include_once "administratorinfo.php" ?>
<?php

// Create page object
$memberupdatelog_grid = new cmemberupdatelog_grid();
$MasterPage =& $Page;
$Page =& $memberupdatelog_grid;

// Page init
$memberupdatelog_grid->Page_Init();

// Page main
$memberupdatelog_grid->Page_Main();
?>
<?php if ($memberupdatelog->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var memberupdatelog_grid = new ew_Page("memberupdatelog_grid");

// page properties
memberupdatelog_grid.PageID = "grid"; // page ID
memberupdatelog_grid.FormID = "fmemberupdateloggrid"; // form ID
var EW_PAGE_ID = memberupdatelog_grid.PageID; // for backward compatibility

// extend page with ValidateForm function
memberupdatelog_grid.ValidateForm = function(fobj) {
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
		elm = fobj.elements["x" + infix + "_update_detail"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($memberupdatelog->update_detail->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_update_date"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($memberupdatelog->update_date->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_update_date"];
		if (elm && !ew_CheckEuroDate(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($memberupdatelog->update_date->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_author"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($memberupdatelog->author->FldCaption()) ?>");

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
memberupdatelog_grid.EmptyRow = function(fobj, infix) {
	if (ew_ValueChanged(fobj, infix, "update_detail", false)) return false;
	if (ew_ValueChanged(fobj, infix, "update_date", false)) return false;
	if (ew_ValueChanged(fobj, infix, "author", false)) return false;
	return true;
}

// extend page with Form_CustomValidate function
memberupdatelog_grid.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
memberupdatelog_grid.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
memberupdatelog_grid.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
memberupdatelog_grid.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<?php } ?>
<?php
if ($memberupdatelog->CurrentAction == "gridadd") {
	if ($memberupdatelog->CurrentMode == "copy") {
		$bSelectLimit = EW_SELECT_LIMIT;
		if ($bSelectLimit) {
			$memberupdatelog_grid->TotalRecs = $memberupdatelog->SelectRecordCount();
			$memberupdatelog_grid->Recordset = $memberupdatelog_grid->LoadRecordset($memberupdatelog_grid->StartRec-1, $memberupdatelog_grid->DisplayRecs);
		} else {
			if ($memberupdatelog_grid->Recordset = $memberupdatelog_grid->LoadRecordset())
				$memberupdatelog_grid->TotalRecs = $memberupdatelog_grid->Recordset->RecordCount();
		}
		$memberupdatelog_grid->StartRec = 1;
		$memberupdatelog_grid->DisplayRecs = $memberupdatelog_grid->TotalRecs;
	} else {
		$memberupdatelog->CurrentFilter = "0=1";
		$memberupdatelog_grid->StartRec = 1;
		$memberupdatelog_grid->DisplayRecs = $memberupdatelog->GridAddRowCount;
	}
	$memberupdatelog_grid->TotalRecs = $memberupdatelog_grid->DisplayRecs;
	$memberupdatelog_grid->StopRec = $memberupdatelog_grid->DisplayRecs;
} else {
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$memberupdatelog_grid->TotalRecs = $memberupdatelog->SelectRecordCount();
	} else {
		if ($memberupdatelog_grid->Recordset = $memberupdatelog_grid->LoadRecordset())
			$memberupdatelog_grid->TotalRecs = $memberupdatelog_grid->Recordset->RecordCount();
	}
	$memberupdatelog_grid->StartRec = 1;
	$memberupdatelog_grid->DisplayRecs = $memberupdatelog_grid->TotalRecs; // Display all records
	if ($bSelectLimit)
		$memberupdatelog_grid->Recordset = $memberupdatelog_grid->LoadRecordset($memberupdatelog_grid->StartRec-1, $memberupdatelog_grid->DisplayRecs);
}
?>
<p class="phpmaker ewTitle" style="white-space: nowrap;"><?php if ($memberupdatelog->CurrentMode == "add" || $memberupdatelog->CurrentMode == "copy") { ?><?php echo $Language->Phrase("Add") ?><?php } elseif ($memberupdatelog->CurrentMode == "edit") { ?><?php echo $Language->Phrase("Edit") ?><?php } ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $memberupdatelog->TableCaption() ?></p>
</p>
<?php $memberupdatelog_grid->ShowPageHeader(); ?>
<?php
$memberupdatelog_grid->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if (($memberupdatelog->CurrentMode == "add" || $memberupdatelog->CurrentMode == "copy" || $memberupdatelog->CurrentMode == "edit") && $memberupdatelog->CurrentAction != "F") { // add/copy/edit mode ?>
<div class="ewGridUpperPanel">
</div>
<?php } ?>
<div id="gmp_memberupdatelog" class="ewGridMiddlePanel">
<table cellspacing="0" data-rowhighlightclass="ewTableHighlightRow" data-rowselectclass="ewTableSelectRow" data-roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $memberupdatelog->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$memberupdatelog_grid->RenderListOptions();

// Render list options (header, left)
$memberupdatelog_grid->ListOptions->Render("header", "left");
?>
<?php if ($memberupdatelog->update_detail->Visible) { // update_detail ?>
	<?php if ($memberupdatelog->SortUrl($memberupdatelog->update_detail) == "") { ?>
		<td style="white-space: nowrap;"><?php echo $memberupdatelog->update_detail->FldCaption() ?></td>
	<?php } else { ?>
		<td><div>
			<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><thead><tr><td><?php echo $memberupdatelog->update_detail->FldCaption() ?></td><td style="width: 10px;"><?php if ($memberupdatelog->update_detail->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($memberupdatelog->update_detail->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($memberupdatelog->update_date->Visible) { // update_date ?>
	<?php if ($memberupdatelog->SortUrl($memberupdatelog->update_date) == "") { ?>
		<td style="white-space: nowrap;"><?php echo $memberupdatelog->update_date->FldCaption() ?></td>
	<?php } else { ?>
		<td><div>
			<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><thead><tr><td><?php echo $memberupdatelog->update_date->FldCaption() ?></td><td style="width: 10px;"><?php if ($memberupdatelog->update_date->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($memberupdatelog->update_date->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($memberupdatelog->author->Visible) { // author ?>
	<?php if ($memberupdatelog->SortUrl($memberupdatelog->author) == "") { ?>
		<td style="white-space: nowrap;"><?php echo $memberupdatelog->author->FldCaption() ?></td>
	<?php } else { ?>
		<td><div>
			<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><thead><tr><td><?php echo $memberupdatelog->author->FldCaption() ?></td><td style="width: 10px;"><?php if ($memberupdatelog->author->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($memberupdatelog->author->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$memberupdatelog_grid->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
$memberupdatelog_grid->StartRec = 1;
$memberupdatelog_grid->StopRec = $memberupdatelog_grid->TotalRecs; // Show all records

// Restore number of post back records
if ($objForm) {
	$objForm->Index = 0;
	if ($objForm->HasValue("key_count") && ($memberupdatelog->CurrentAction == "gridadd" || $memberupdatelog->CurrentAction == "gridedit" || $memberupdatelog->CurrentAction == "F")) {
		$memberupdatelog_grid->KeyCount = $objForm->GetValue("key_count");
		$memberupdatelog_grid->StopRec = $memberupdatelog_grid->KeyCount;
	}
}
$memberupdatelog_grid->RecCnt = $memberupdatelog_grid->StartRec - 1;
if ($memberupdatelog_grid->Recordset && !$memberupdatelog_grid->Recordset->EOF) {
	$memberupdatelog_grid->Recordset->MoveFirst();
	if (!$bSelectLimit && $memberupdatelog_grid->StartRec > 1)
		$memberupdatelog_grid->Recordset->Move($memberupdatelog_grid->StartRec - 1);
} elseif (!$memberupdatelog->AllowAddDeleteRow && $memberupdatelog_grid->StopRec == 0) {
	$memberupdatelog_grid->StopRec = $memberupdatelog->GridAddRowCount;
}

// Initialize aggregate
$memberupdatelog->RowType = EW_ROWTYPE_AGGREGATEINIT;
$memberupdatelog->ResetAttrs();
$memberupdatelog_grid->RenderRow();
$memberupdatelog_grid->RowCnt = 0;
if ($memberupdatelog->CurrentAction == "gridadd")
	$memberupdatelog_grid->RowIndex = 0;
if ($memberupdatelog->CurrentAction == "gridedit")
	$memberupdatelog_grid->RowIndex = 0;
while ($memberupdatelog_grid->RecCnt < $memberupdatelog_grid->StopRec) {
	$memberupdatelog_grid->RecCnt++;
	if (intval($memberupdatelog_grid->RecCnt) >= intval($memberupdatelog_grid->StartRec)) {
		$memberupdatelog_grid->RowCnt++;
		if ($memberupdatelog->CurrentAction == "gridadd" || $memberupdatelog->CurrentAction == "gridedit" || $memberupdatelog->CurrentAction == "F") {
			$memberupdatelog_grid->RowIndex++;
			$objForm->Index = $memberupdatelog_grid->RowIndex;
			if ($objForm->HasValue("k_action"))
				$memberupdatelog_grid->RowAction = strval($objForm->GetValue("k_action"));
			elseif ($memberupdatelog->CurrentAction == "gridadd")
				$memberupdatelog_grid->RowAction = "insert";
			else
				$memberupdatelog_grid->RowAction = "";
		}

		// Set up key count
		$memberupdatelog_grid->KeyCount = $memberupdatelog_grid->RowIndex;

		// Init row class and style
		$memberupdatelog->ResetAttrs();
		$memberupdatelog->CssClass = "";
		if ($memberupdatelog->CurrentAction == "gridadd") {
			if ($memberupdatelog->CurrentMode == "copy") {
				$memberupdatelog_grid->LoadRowValues($memberupdatelog_grid->Recordset); // Load row values
				$memberupdatelog_grid->SetRecordKey($memberupdatelog_grid->RowOldKey, $memberupdatelog_grid->Recordset); // Set old record key
			} else {
				$memberupdatelog_grid->LoadDefaultValues(); // Load default values
				$memberupdatelog_grid->RowOldKey = ""; // Clear old key value
			}
		} elseif ($memberupdatelog->CurrentAction == "gridedit") {
			$memberupdatelog_grid->LoadRowValues($memberupdatelog_grid->Recordset); // Load row values
		}
		$memberupdatelog->RowType = EW_ROWTYPE_VIEW; // Render view
		if ($memberupdatelog->CurrentAction == "gridadd") // Grid add
			$memberupdatelog->RowType = EW_ROWTYPE_ADD; // Render add
		if ($memberupdatelog->CurrentAction == "gridadd" && $memberupdatelog->EventCancelled && !$objForm->HasValue("k_blankrow")) // Insert failed
			$memberupdatelog_grid->RestoreCurrentRowFormValues($memberupdatelog_grid->RowIndex); // Restore form values
		if ($memberupdatelog->CurrentAction == "gridedit") { // Grid edit
			if ($memberupdatelog->EventCancelled) {
				$memberupdatelog_grid->RestoreCurrentRowFormValues($memberupdatelog_grid->RowIndex); // Restore form values
			}
			if ($memberupdatelog_grid->RowAction == "insert")
				$memberupdatelog->RowType = EW_ROWTYPE_ADD; // Render add
			else
				$memberupdatelog->RowType = EW_ROWTYPE_EDIT; // Render edit
		}
		if ($memberupdatelog->CurrentAction == "gridedit" && ($memberupdatelog->RowType == EW_ROWTYPE_EDIT || $memberupdatelog->RowType == EW_ROWTYPE_ADD) && $memberupdatelog->EventCancelled) // Update failed
			$memberupdatelog_grid->RestoreCurrentRowFormValues($memberupdatelog_grid->RowIndex); // Restore form values
		if ($memberupdatelog->RowType == EW_ROWTYPE_EDIT) // Edit row
			$memberupdatelog_grid->EditRowCnt++;
		if ($memberupdatelog->CurrentAction == "F") // Confirm row
			$memberupdatelog_grid->RestoreCurrentRowFormValues($memberupdatelog_grid->RowIndex); // Restore form values
		if ($memberupdatelog->RowType == EW_ROWTYPE_ADD || $memberupdatelog->RowType == EW_ROWTYPE_EDIT) { // Add / Edit row
			if ($memberupdatelog->CurrentAction == "edit") {
				$memberupdatelog->RowAttrs = array();
				$memberupdatelog->CssClass = "ewTableEditRow";
			} else {
				$memberupdatelog->RowAttrs = array();
			}
			if (!empty($memberupdatelog_grid->RowIndex))
				$memberupdatelog->RowAttrs = array_merge($memberupdatelog->RowAttrs, array('data-rowindex'=>$memberupdatelog_grid->RowIndex, 'id'=>'r' . $memberupdatelog_grid->RowIndex . '_memberupdatelog'));
		} else {
			$memberupdatelog->RowAttrs = array();
		}

		// Render row
		$memberupdatelog_grid->RenderRow();

		// Render list options
		$memberupdatelog_grid->RenderListOptions();

		// Skip delete row / empty row for confirm page
		if ($memberupdatelog_grid->RowAction <> "delete" && $memberupdatelog_grid->RowAction <> "insertdelete" && !($memberupdatelog_grid->RowAction == "insert" && $memberupdatelog->CurrentAction == "F" && $memberupdatelog_grid->EmptyRow())) {
?>
	<tr<?php echo $memberupdatelog->RowAttributes() ?>>
<?php

// Render list options (body, left)
$memberupdatelog_grid->ListOptions->Render("body", "left");
?>
	<?php if ($memberupdatelog->update_detail->Visible) { // update_detail ?>
		<td<?php echo $memberupdatelog->update_detail->CellAttributes() ?>>
<?php if ($memberupdatelog->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<textarea name="x<?php echo $memberupdatelog_grid->RowIndex ?>_update_detail" id="x<?php echo $memberupdatelog_grid->RowIndex ?>_update_detail" cols="35" rows="4"<?php echo $memberupdatelog->update_detail->EditAttributes() ?>><?php echo $memberupdatelog->update_detail->EditValue ?></textarea>
<input type="hidden" name="o<?php echo $memberupdatelog_grid->RowIndex ?>_update_detail" id="o<?php echo $memberupdatelog_grid->RowIndex ?>_update_detail" value="<?php echo ew_HtmlEncode($memberupdatelog->update_detail->OldValue) ?>">
<?php } ?>
<?php if ($memberupdatelog->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<textarea name="x<?php echo $memberupdatelog_grid->RowIndex ?>_update_detail" id="x<?php echo $memberupdatelog_grid->RowIndex ?>_update_detail" cols="35" rows="4"<?php echo $memberupdatelog->update_detail->EditAttributes() ?>><?php echo $memberupdatelog->update_detail->EditValue ?></textarea>
<?php } ?>
<?php if ($memberupdatelog->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $memberupdatelog->update_detail->ViewAttributes() ?>><?php echo $memberupdatelog->update_detail->ListViewValue() ?></div>
<input type="hidden" name="x<?php echo $memberupdatelog_grid->RowIndex ?>_update_detail" id="x<?php echo $memberupdatelog_grid->RowIndex ?>_update_detail" value="<?php echo ew_HtmlEncode($memberupdatelog->update_detail->CurrentValue) ?>">
<input type="hidden" name="o<?php echo $memberupdatelog_grid->RowIndex ?>_update_detail" id="o<?php echo $memberupdatelog_grid->RowIndex ?>_update_detail" value="<?php echo ew_HtmlEncode($memberupdatelog->update_detail->OldValue) ?>">
<?php } ?>
<a name="<?php echo $memberupdatelog_grid->PageObjName . "_row_" . $memberupdatelog_grid->RowCnt ?>" id="<?php echo $memberupdatelog_grid->PageObjName . "_row_" . $memberupdatelog_grid->RowCnt ?>"></a>
<?php if ($memberupdatelog->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="hidden" name="o<?php echo $memberupdatelog_grid->RowIndex ?>_mu_id" id="o<?php echo $memberupdatelog_grid->RowIndex ?>_mu_id" value="<?php echo ew_HtmlEncode($memberupdatelog->mu_id->OldValue) ?>">
<?php } ?>
<?php if ($memberupdatelog->RowType == EW_ROWTYPE_EDIT) { ?>
<input type="hidden" name="x<?php echo $memberupdatelog_grid->RowIndex ?>_mu_id" id="x<?php echo $memberupdatelog_grid->RowIndex ?>_mu_id" value="<?php echo ew_HtmlEncode($memberupdatelog->mu_id->CurrentValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($memberupdatelog->update_date->Visible) { // update_date ?>
		<td<?php echo $memberupdatelog->update_date->CellAttributes() ?>>
<?php if ($memberupdatelog->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="text" name="x<?php echo $memberupdatelog_grid->RowIndex ?>_update_date" id="x<?php echo $memberupdatelog_grid->RowIndex ?>_update_date" value="<?php echo $memberupdatelog->update_date->EditValue ?>"<?php echo $memberupdatelog->update_date->EditAttributes() ?>>
<input type="hidden" name="fo<?php echo $memberupdatelog_grid->RowIndex ?>_update_date" id="fo<?php echo $memberupdatelog_grid->RowIndex ?>_update_date" value="<?php echo ew_HtmlEncode(ew_FormatDateTime($memberupdatelog->update_date->OldValue, 7)) ?>">
<input type="hidden" name="o<?php echo $memberupdatelog_grid->RowIndex ?>_update_date" id="o<?php echo $memberupdatelog_grid->RowIndex ?>_update_date" value="<?php echo ew_HtmlEncode($memberupdatelog->update_date->OldValue) ?>">
<?php } ?>
<?php if ($memberupdatelog->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $memberupdatelog_grid->RowIndex ?>_update_date" id="x<?php echo $memberupdatelog_grid->RowIndex ?>_update_date" value="<?php echo $memberupdatelog->update_date->EditValue ?>"<?php echo $memberupdatelog->update_date->EditAttributes() ?>>
<?php } ?>
<?php if ($memberupdatelog->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $memberupdatelog->update_date->ViewAttributes() ?>><?php echo $memberupdatelog->update_date->ListViewValue() ?></div>
<input type="hidden" name="x<?php echo $memberupdatelog_grid->RowIndex ?>_update_date" id="x<?php echo $memberupdatelog_grid->RowIndex ?>_update_date" value="<?php echo ew_HtmlEncode($memberupdatelog->update_date->CurrentValue) ?>">
<input type="hidden" name="o<?php echo $memberupdatelog_grid->RowIndex ?>_update_date" id="o<?php echo $memberupdatelog_grid->RowIndex ?>_update_date" value="<?php echo ew_HtmlEncode($memberupdatelog->update_date->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($memberupdatelog->author->Visible) { // author ?>
		<td<?php echo $memberupdatelog->author->CellAttributes() ?>>
<?php if ($memberupdatelog->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="text" name="x<?php echo $memberupdatelog_grid->RowIndex ?>_author" id="x<?php echo $memberupdatelog_grid->RowIndex ?>_author" size="30" maxlength="30" value="<?php echo $memberupdatelog->author->EditValue ?>"<?php echo $memberupdatelog->author->EditAttributes() ?>>
<input type="hidden" name="o<?php echo $memberupdatelog_grid->RowIndex ?>_author" id="o<?php echo $memberupdatelog_grid->RowIndex ?>_author" value="<?php echo ew_HtmlEncode($memberupdatelog->author->OldValue) ?>">
<?php } ?>
<?php if ($memberupdatelog->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $memberupdatelog_grid->RowIndex ?>_author" id="x<?php echo $memberupdatelog_grid->RowIndex ?>_author" size="30" maxlength="30" value="<?php echo $memberupdatelog->author->EditValue ?>"<?php echo $memberupdatelog->author->EditAttributes() ?>>
<?php } ?>
<?php if ($memberupdatelog->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $memberupdatelog->author->ViewAttributes() ?>><?php echo $memberupdatelog->author->ListViewValue() ?></div>
<input type="hidden" name="x<?php echo $memberupdatelog_grid->RowIndex ?>_author" id="x<?php echo $memberupdatelog_grid->RowIndex ?>_author" value="<?php echo ew_HtmlEncode($memberupdatelog->author->CurrentValue) ?>">
<input type="hidden" name="o<?php echo $memberupdatelog_grid->RowIndex ?>_author" id="o<?php echo $memberupdatelog_grid->RowIndex ?>_author" value="<?php echo ew_HtmlEncode($memberupdatelog->author->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$memberupdatelog_grid->ListOptions->Render("body", "right");
?>
	</tr>
<?php if ($memberupdatelog->RowType == EW_ROWTYPE_ADD) { ?>
<?php } ?>
<?php if ($memberupdatelog->RowType == EW_ROWTYPE_EDIT) { ?>
<?php } ?>
<?php
	}
	} // End delete row checking
	if ($memberupdatelog->CurrentAction <> "gridadd" || $memberupdatelog->CurrentMode == "copy")
		if (!$memberupdatelog_grid->Recordset->EOF) $memberupdatelog_grid->Recordset->MoveNext();
}
?>
<?php
	if ($memberupdatelog->CurrentMode == "add" || $memberupdatelog->CurrentMode == "copy" || $memberupdatelog->CurrentMode == "edit") {
		$memberupdatelog_grid->RowIndex = '$rowindex$';
		$memberupdatelog_grid->LoadDefaultValues();

		// Set row properties
		$memberupdatelog->ResetAttrs();
		$memberupdatelog->RowAttrs = array();
		if (!empty($memberupdatelog_grid->RowIndex))
			$memberupdatelog->RowAttrs = array_merge($memberupdatelog->RowAttrs, array('data-rowindex'=>$memberupdatelog_grid->RowIndex, 'id'=>'r' . $memberupdatelog_grid->RowIndex . '_memberupdatelog'));
		$memberupdatelog->RowType = EW_ROWTYPE_ADD;

		// Render row
		$memberupdatelog_grid->RenderRow();

		// Render list options
		$memberupdatelog_grid->RenderListOptions();

		// Add id and class to the template row
		$memberupdatelog->RowAttrs["id"] = "r0_memberupdatelog";
		ew_AppendClass($memberupdatelog->RowAttrs["class"], "ewTemplate");
?>
	<tr<?php echo $memberupdatelog->RowAttributes() ?>>
<?php

// Render list options (body, left)
$memberupdatelog_grid->ListOptions->Render("body", "left");
?>
	<?php if ($memberupdatelog->update_detail->Visible) { // update_detail ?>
		<td>
<?php if ($memberupdatelog->CurrentAction <> "F") { ?>
<textarea name="x<?php echo $memberupdatelog_grid->RowIndex ?>_update_detail" id="x<?php echo $memberupdatelog_grid->RowIndex ?>_update_detail" cols="35" rows="4"<?php echo $memberupdatelog->update_detail->EditAttributes() ?>><?php echo $memberupdatelog->update_detail->EditValue ?></textarea>
<?php } else { ?>
<div<?php echo $memberupdatelog->update_detail->ViewAttributes() ?>><?php echo $memberupdatelog->update_detail->ViewValue ?></div>
<input type="hidden" name="x<?php echo $memberupdatelog_grid->RowIndex ?>_update_detail" id="x<?php echo $memberupdatelog_grid->RowIndex ?>_update_detail" value="<?php echo ew_HtmlEncode($memberupdatelog->update_detail->FormValue) ?>">
<?php } ?>
<input type="hidden" name="o<?php echo $memberupdatelog_grid->RowIndex ?>_update_detail" id="o<?php echo $memberupdatelog_grid->RowIndex ?>_update_detail" value="<?php echo ew_HtmlEncode($memberupdatelog->update_detail->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($memberupdatelog->update_date->Visible) { // update_date ?>
		<td>
<?php if ($memberupdatelog->CurrentAction <> "F") { ?>
<input type="text" name="x<?php echo $memberupdatelog_grid->RowIndex ?>_update_date" id="x<?php echo $memberupdatelog_grid->RowIndex ?>_update_date" value="<?php echo $memberupdatelog->update_date->EditValue ?>"<?php echo $memberupdatelog->update_date->EditAttributes() ?>>
<?php } else { ?>
<div<?php echo $memberupdatelog->update_date->ViewAttributes() ?>><?php echo $memberupdatelog->update_date->ViewValue ?></div>
<input type="hidden" name="x<?php echo $memberupdatelog_grid->RowIndex ?>_update_date" id="x<?php echo $memberupdatelog_grid->RowIndex ?>_update_date" value="<?php echo ew_HtmlEncode($memberupdatelog->update_date->FormValue) ?>">
<?php } ?>
<input type="hidden" name="o<?php echo $memberupdatelog_grid->RowIndex ?>_update_date" id="o<?php echo $memberupdatelog_grid->RowIndex ?>_update_date" value="<?php echo ew_HtmlEncode($memberupdatelog->update_date->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($memberupdatelog->author->Visible) { // author ?>
		<td>
<?php if ($memberupdatelog->CurrentAction <> "F") { ?>
<input type="text" name="x<?php echo $memberupdatelog_grid->RowIndex ?>_author" id="x<?php echo $memberupdatelog_grid->RowIndex ?>_author" size="30" maxlength="30" value="<?php echo $memberupdatelog->author->EditValue ?>"<?php echo $memberupdatelog->author->EditAttributes() ?>>
<?php } else { ?>
<div<?php echo $memberupdatelog->author->ViewAttributes() ?>><?php echo $memberupdatelog->author->ViewValue ?></div>
<input type="hidden" name="x<?php echo $memberupdatelog_grid->RowIndex ?>_author" id="x<?php echo $memberupdatelog_grid->RowIndex ?>_author" value="<?php echo ew_HtmlEncode($memberupdatelog->author->FormValue) ?>">
<?php } ?>
<input type="hidden" name="o<?php echo $memberupdatelog_grid->RowIndex ?>_author" id="o<?php echo $memberupdatelog_grid->RowIndex ?>_author" value="<?php echo ew_HtmlEncode($memberupdatelog->author->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$memberupdatelog_grid->ListOptions->Render("body", "right");
?>
	</tr>
<?php
}
?>
</tbody>
</table>
<?php if ($memberupdatelog->CurrentMode == "add" || $memberupdatelog->CurrentMode == "copy") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridinsert">
<input type="hidden" name="key_count" id="key_count" value="<?php echo $memberupdatelog_grid->KeyCount ?>">
<?php echo $memberupdatelog_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($memberupdatelog->CurrentMode == "edit") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridupdate">
<input type="hidden" name="key_count" id="key_count" value="<?php echo $memberupdatelog_grid->KeyCount ?>">
<?php echo $memberupdatelog_grid->MultiSelectKey ?>
<?php } ?>
<input type="hidden" name="detailpage" id="detailpage" value="memberupdatelog_grid">
</div>
<?php

// Close recordset
if ($memberupdatelog_grid->Recordset)
	$memberupdatelog_grid->Recordset->Close();
?>
<?php if (($memberupdatelog->CurrentMode == "add" || $memberupdatelog->CurrentMode == "copy" || $memberupdatelog->CurrentMode == "edit") && $memberupdatelog->CurrentAction != "F") { // add/copy/edit mode ?>
<div class="ewGridLowerPanel">
</div>
<?php } ?>
</td></tr></table>
<?php if ($memberupdatelog->Export == "" && $memberupdatelog->CurrentAction == "") { ?>
<script type="text/javascript">
<!--
ew_ToggleSearchPanel(memberupdatelog_grid); // Init search panel as collapsed

//-->
</script>
<?php } ?>
<?php
$memberupdatelog_grid->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php
$memberupdatelog_grid->Page_Terminate();
$Page =& $MasterPage;
?>
