<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "permissioninfo.php" ?>
<?php include_once "administratorinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$permission_list = new cpermission_list();
$Page =& $permission_list;

// Page init
$permission_list->Page_Init();

// Page main
$permission_list->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($permission->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var permission_list = new ew_Page("permission_list");

// page properties
permission_list.PageID = "list"; // page ID
permission_list.FormID = "fpermissionlist"; // form ID
var EW_PAGE_ID = permission_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
permission_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
permission_list.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
permission_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
permission_list.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script type="text/javascript">
<!--
var ew_DHTMLEditors = [];

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<?php } ?>
<?php if (($permission->Export == "") || (EW_EXPORT_MASTER_RECORD && $permission->Export == "print")) { ?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$permission_list->TotalRecs = $permission->SelectRecordCount();
	} else {
		if ($permission_list->Recordset = $permission_list->LoadRecordset())
			$permission_list->TotalRecs = $permission_list->Recordset->RecordCount();
	}
	$permission_list->StartRec = 1;
	if ($permission_list->DisplayRecs <= 0 || ($permission->Export <> "" && $permission->ExportAll)) // Display all records
		$permission_list->DisplayRecs = $permission_list->TotalRecs;
	if (!($permission->Export <> "" && $permission->ExportAll))
		$permission_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$permission_list->Recordset = $permission_list->LoadRecordset($permission_list->StartRec-1, $permission_list->DisplayRecs);
?>
<p class="phpmaker ewTitle" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $permission->TableCaption() ?>
&nbsp;&nbsp;<?php $permission_list->ExportOptions->Render("body"); ?>
</p>
<?php $permission_list->ShowPageHeader(); ?>
<?php
$permission_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($permission->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($permission->CurrentAction <> "gridadd" && $permission->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($permission_list->Pager)) $permission_list->Pager = new cPrevNextPager($permission_list->StartRec, $permission_list->DisplayRecs, $permission_list->TotalRecs) ?>
<?php if ($permission_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($permission_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $permission_list->PageUrl() ?>start=<?php echo $permission_list->Pager->FirstButton->Start ?>"><img src="phpimages/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($permission_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $permission_list->PageUrl() ?>start=<?php echo $permission_list->Pager->PrevButton->Start ?>"><img src="phpimages/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $permission_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($permission_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $permission_list->PageUrl() ?>start=<?php echo $permission_list->Pager->NextButton->Start ?>"><img src="phpimages/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($permission_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $permission_list->PageUrl() ?>start=<?php echo $permission_list->Pager->LastButton->Start ?>"><img src="phpimages/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $permission_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $permission_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $permission_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $permission_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($permission_list->SearchWhere == "0=101") { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoRecord") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($permission_list->TotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td><?php echo $Language->Phrase("RecordsPerPage") ?>&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="permission">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();">
<option value="10"<?php if ($permission_list->DisplayRecs == 10) { ?> selected="selected"<?php } ?>>10</option>
<option value="20"<?php if ($permission_list->DisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="50"<?php if ($permission_list->DisplayRecs == 50) { ?> selected="selected"<?php } ?>>50</option>
<option value="100"<?php if ($permission_list->DisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="200"<?php if ($permission_list->DisplayRecs == 200) { ?> selected="selected"<?php } ?>>200</option>
<option value="300"<?php if ($permission_list->DisplayRecs == 300) { ?> selected="selected"<?php } ?>>300</option>
<option value="500"<?php if ($permission_list->DisplayRecs == 500) { ?> selected="selected"<?php } ?>>500</option>
<option value="700"<?php if ($permission_list->DisplayRecs == 700) { ?> selected="selected"<?php } ?>>700</option>
<option value="1000"<?php if ($permission_list->DisplayRecs == 1000) { ?> selected="selected"<?php } ?>>1000</option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<span class="phpmaker">
<?php if ($Security->IsLoggedIn()) { ?>
<a class="ewGridLink" href="<?php echo $permission_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
<?php if ($permission_list->TotalRecs > 0) { ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a class="ewGridLink" href="" onclick="ew_SubmitSelected(document.fpermissionlist, '<?php echo $permission_list->MultiDeleteUrl ?>');return false;"><?php echo $Language->Phrase("DeleteSelectedLink") ?></a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
</span>
</div>
<?php } ?>
<form name="fpermissionlist" id="fpermissionlist" class="ewForm" action="" method="post">
<input type="hidden" name="t" id="t" value="permission">
<div id="gmp_permission" class="ewGridMiddlePanel">
<?php if ($permission_list->TotalRecs > 0) { ?>
<table cellspacing="0" data-rowhighlightclass="ewTableHighlightRow" data-rowselectclass="ewTableSelectRow" data-roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $permission->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$permission_list->RenderListOptions();

// Render list options (header, left)
$permission_list->ListOptions->Render("header", "left");
?>
<?php if ($permission->permission_id->Visible) { // permission_id ?>
	<?php if ($permission->SortUrl($permission->permission_id) == "") { ?>
		<td><?php echo $permission->permission_id->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $permission->SortUrl($permission->permission_id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $permission->permission_id->FldCaption() ?></td><td style="width: 10px;"><?php if ($permission->permission_id->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($permission->permission_id->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($permission->member_id->Visible) { // member_id ?>
	<?php if ($permission->SortUrl($permission->member_id) == "") { ?>
		<td><?php echo $permission->member_id->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $permission->SortUrl($permission->member_id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $permission->member_id->FldCaption() ?></td><td style="width: 10px;"><?php if ($permission->member_id->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($permission->member_id->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($permission->admin->Visible) { // admin ?>
	<?php if ($permission->SortUrl($permission->admin) == "") { ?>
		<td><?php echo $permission->admin->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $permission->SortUrl($permission->admin) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $permission->admin->FldCaption() ?></td><td style="width: 10px;"><?php if ($permission->admin->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($permission->admin->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($permission->zupload->Visible) { // upload ?>
	<?php if ($permission->SortUrl($permission->zupload) == "") { ?>
		<td><?php echo $permission->zupload->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $permission->SortUrl($permission->zupload) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $permission->zupload->FldCaption() ?></td><td style="width: 10px;"><?php if ($permission->zupload->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($permission->zupload->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($permission->download->Visible) { // download ?>
	<?php if ($permission->SortUrl($permission->download) == "") { ?>
		<td><?php echo $permission->download->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $permission->SortUrl($permission->download) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $permission->download->FldCaption() ?></td><td style="width: 10px;"><?php if ($permission->download->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($permission->download->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($permission->readonly->Visible) { // readonly ?>
	<?php if ($permission->SortUrl($permission->readonly) == "") { ?>
		<td><?php echo $permission->readonly->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $permission->SortUrl($permission->readonly) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $permission->readonly->FldCaption() ?></td><td style="width: 10px;"><?php if ($permission->readonly->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($permission->readonly->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$permission_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($permission->ExportAll && $permission->Export <> "") {
	$permission_list->StopRec = $permission_list->TotalRecs;
} else {

	// Set the last record to display
	if ($permission_list->TotalRecs > $permission_list->StartRec + $permission_list->DisplayRecs - 1)
		$permission_list->StopRec = $permission_list->StartRec + $permission_list->DisplayRecs - 1;
	else
		$permission_list->StopRec = $permission_list->TotalRecs;
}
$permission_list->RecCnt = $permission_list->StartRec - 1;
if ($permission_list->Recordset && !$permission_list->Recordset->EOF) {
	$permission_list->Recordset->MoveFirst();
	if (!$bSelectLimit && $permission_list->StartRec > 1)
		$permission_list->Recordset->Move($permission_list->StartRec - 1);
} elseif (!$permission->AllowAddDeleteRow && $permission_list->StopRec == 0) {
	$permission_list->StopRec = $permission->GridAddRowCount;
}

// Initialize aggregate
$permission->RowType = EW_ROWTYPE_AGGREGATEINIT;
$permission->ResetAttrs();
$permission_list->RenderRow();
$permission_list->RowCnt = 0;
while ($permission_list->RecCnt < $permission_list->StopRec) {
	$permission_list->RecCnt++;
	if (intval($permission_list->RecCnt) >= intval($permission_list->StartRec)) {
		$permission_list->RowCnt++;

		// Set up key count
		$permission_list->KeyCount = $permission_list->RowIndex;

		// Init row class and style
		$permission->ResetAttrs();
		$permission->CssClass = "";
		if ($permission->CurrentAction == "gridadd") {
		} else {
			$permission_list->LoadRowValues($permission_list->Recordset); // Load row values
		}
		$permission->RowType = EW_ROWTYPE_VIEW; // Render view
		$permission->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');

		// Render row
		$permission_list->RenderRow();

		// Render list options
		$permission_list->RenderListOptions();
?>
	<tr<?php echo $permission->RowAttributes() ?>>
<?php

// Render list options (body, left)
$permission_list->ListOptions->Render("body", "left");
?>
	<?php if ($permission->permission_id->Visible) { // permission_id ?>
		<td<?php echo $permission->permission_id->CellAttributes() ?>>
<div<?php echo $permission->permission_id->ViewAttributes() ?>><?php echo $permission->permission_id->ListViewValue() ?></div>
<a name="<?php echo $permission_list->PageObjName . "_row_" . $permission_list->RowCnt ?>" id="<?php echo $permission_list->PageObjName . "_row_" . $permission_list->RowCnt ?>"></a></td>
	<?php } ?>
	<?php if ($permission->member_id->Visible) { // member_id ?>
		<td<?php echo $permission->member_id->CellAttributes() ?>>
<div<?php echo $permission->member_id->ViewAttributes() ?>><?php echo $permission->member_id->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($permission->admin->Visible) { // admin ?>
		<td<?php echo $permission->admin->CellAttributes() ?>>
<div<?php echo $permission->admin->ViewAttributes() ?>><?php echo $permission->admin->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($permission->zupload->Visible) { // upload ?>
		<td<?php echo $permission->zupload->CellAttributes() ?>>
<div<?php echo $permission->zupload->ViewAttributes() ?>><?php echo $permission->zupload->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($permission->download->Visible) { // download ?>
		<td<?php echo $permission->download->CellAttributes() ?>>
<div<?php echo $permission->download->ViewAttributes() ?>><?php echo $permission->download->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($permission->readonly->Visible) { // readonly ?>
		<td<?php echo $permission->readonly->CellAttributes() ?>>
<div<?php echo $permission->readonly->ViewAttributes() ?>><?php echo $permission->readonly->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$permission_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($permission->CurrentAction <> "gridadd")
		$permission_list->Recordset->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($permission_list->Recordset)
	$permission_list->Recordset->Close();
?>
<?php if ($permission_list->TotalRecs > 0) { ?>
<?php if ($permission->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($permission->CurrentAction <> "gridadd" && $permission->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($permission_list->Pager)) $permission_list->Pager = new cPrevNextPager($permission_list->StartRec, $permission_list->DisplayRecs, $permission_list->TotalRecs) ?>
<?php if ($permission_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($permission_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $permission_list->PageUrl() ?>start=<?php echo $permission_list->Pager->FirstButton->Start ?>"><img src="phpimages/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($permission_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $permission_list->PageUrl() ?>start=<?php echo $permission_list->Pager->PrevButton->Start ?>"><img src="phpimages/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $permission_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($permission_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $permission_list->PageUrl() ?>start=<?php echo $permission_list->Pager->NextButton->Start ?>"><img src="phpimages/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($permission_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $permission_list->PageUrl() ?>start=<?php echo $permission_list->Pager->LastButton->Start ?>"><img src="phpimages/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $permission_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $permission_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $permission_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $permission_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($permission_list->SearchWhere == "0=101") { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoRecord") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($permission_list->TotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td><?php echo $Language->Phrase("RecordsPerPage") ?>&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="permission">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();">
<option value="10"<?php if ($permission_list->DisplayRecs == 10) { ?> selected="selected"<?php } ?>>10</option>
<option value="20"<?php if ($permission_list->DisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="50"<?php if ($permission_list->DisplayRecs == 50) { ?> selected="selected"<?php } ?>>50</option>
<option value="100"<?php if ($permission_list->DisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="200"<?php if ($permission_list->DisplayRecs == 200) { ?> selected="selected"<?php } ?>>200</option>
<option value="300"<?php if ($permission_list->DisplayRecs == 300) { ?> selected="selected"<?php } ?>>300</option>
<option value="500"<?php if ($permission_list->DisplayRecs == 500) { ?> selected="selected"<?php } ?>>500</option>
<option value="700"<?php if ($permission_list->DisplayRecs == 700) { ?> selected="selected"<?php } ?>>700</option>
<option value="1000"<?php if ($permission_list->DisplayRecs == 1000) { ?> selected="selected"<?php } ?>>1000</option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<span class="phpmaker">
<?php if ($Security->IsLoggedIn()) { ?>
<a class="ewGridLink" href="<?php echo $permission_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
<?php if ($permission_list->TotalRecs > 0) { ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a class="ewGridLink" href="" onclick="ew_SubmitSelected(document.fpermissionlist, '<?php echo $permission_list->MultiDeleteUrl ?>');return false;"><?php echo $Language->Phrase("DeleteSelectedLink") ?></a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
</span>
</div>
<?php } ?>
<?php } ?>
</td></tr></table>
<?php if ($permission->Export == "" && $permission->CurrentAction == "") { ?>
<script type="text/javascript">
<!--
ew_ToggleSearchPanel(permission_list); // Init search panel as collapsed

//-->
</script>
<?php } ?>
<?php
$permission_list->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($permission->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$permission_list->Page_Terminate();
?>
<?php

//
// Page class
//
class cpermission_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'permission';

	// Page object name
	var $PageObjName = 'permission_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $permission;
		if ($permission->UseTokenInUrl) $PageUrl .= "t=" . $permission->TableVar . "&"; // Add page token
		return $PageUrl;
	}

	// Page URLs
	var $AddUrl;
	var $EditUrl;
	var $CopyUrl;
	var $DeleteUrl;
	var $ViewUrl;
	var $ListUrl;

	// Export URLs
	var $ExportPrintUrl;
	var $ExportHtmlUrl;
	var $ExportExcelUrl;
	var $ExportWordUrl;
	var $ExportXmlUrl;
	var $ExportCsvUrl;
	var $ExportPdfUrl;

	// Update URLs
	var $InlineAddUrl;
	var $InlineCopyUrl;
	var $InlineEditUrl;
	var $GridAddUrl;
	var $GridEditUrl;
	var $MultiDeleteUrl;
	var $MultiUpdateUrl;

	// Message
	function getMessage() {
		return @$_SESSION[EW_SESSION_MESSAGE];
	}

	function setMessage($v) {
		ew_AddMessage($_SESSION[EW_SESSION_MESSAGE], $v);
	}

	function getFailureMessage() {
		return @$_SESSION[EW_SESSION_FAILURE_MESSAGE];
	}

	function setFailureMessage($v) {
		ew_AddMessage($_SESSION[EW_SESSION_FAILURE_MESSAGE], $v);
	}

	function getSuccessMessage() {
		return @$_SESSION[EW_SESSION_SUCCESS_MESSAGE];
	}

	function setSuccessMessage($v) {
		ew_AddMessage($_SESSION[EW_SESSION_SUCCESS_MESSAGE], $v);
	}

	// Show message
	function ShowMessage() {
		$sMessage = $this->getMessage();
		$this->Message_Showing($sMessage, "");
		if ($sMessage <> "") { // Message in Session, display
			echo "<p class=\"ewMessage\">" . $sMessage . "</p>";
			$_SESSION[EW_SESSION_MESSAGE] = ""; // Clear message in Session
		}

		// Success message
		$sSuccessMessage = $this->getSuccessMessage();
		$this->Message_Showing($sSuccessMessage, "success");
		if ($sSuccessMessage <> "") { // Message in Session, display
			echo "<p class=\"ewSuccessMessage\">" . $sSuccessMessage . "</p>";
			$_SESSION[EW_SESSION_SUCCESS_MESSAGE] = ""; // Clear message in Session
		}

		// Failure message
		$sErrorMessage = $this->getFailureMessage();
		$this->Message_Showing($sErrorMessage, "failure");
		if ($sErrorMessage <> "") { // Message in Session, display
			echo "<p class=\"ewErrorMessage\">" . $sErrorMessage . "</p>";
			$_SESSION[EW_SESSION_FAILURE_MESSAGE] = ""; // Clear message in Session
		}
	}
	var $PageHeader;
	var $PageFooter;

	// Show Page Header
	function ShowPageHeader() {
		$sHeader = $this->PageHeader;
		$this->Page_DataRendering($sHeader);
		if ($sHeader <> "") { // Header exists, display
			echo "<p class=\"phpmaker\">" . $sHeader . "</p>";
		}
	}

	// Show Page Footer
	function ShowPageFooter() {
		$sFooter = $this->PageFooter;
		$this->Page_DataRendered($sFooter);
		if ($sFooter <> "") { // Fotoer exists, display
			echo "<p class=\"phpmaker\">" . $sFooter . "</p>";
		}
	}

	// Validate page request
	function IsPageRequest() {
		global $objForm, $permission;
		if ($permission->UseTokenInUrl) {
			if ($objForm)
				return ($permission->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($permission->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cpermission_list() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (permission)
		if (!isset($GLOBALS["permission"])) {
			$GLOBALS["permission"] = new cpermission();
			$GLOBALS["Table"] =& $GLOBALS["permission"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf";
		$this->AddUrl = "permissionadd.php";
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "permissiondelete.php";
		$this->MultiUpdateUrl = "permissionupdate.php";

		// Table object (administrator)
		if (!isset($GLOBALS['administrator'])) $GLOBALS['administrator'] = new cadministrator();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'permission', TRUE);

		// Start timer
		if (!isset($GLOBALS["gTimer"])) $GLOBALS["gTimer"] = new cTimer();

		// Open connection
		if (!isset($conn)) $conn = ew_Connect();

		// List options
		$this->ListOptions = new cListOptions();

		// Export options
		$this->ExportOptions = new cListOptions();
		$this->ExportOptions->Tag = "span";
		$this->ExportOptions->Separator = "&nbsp;&nbsp;";
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $UserProfile, $Language, $Security, $objForm;
		global $permission;

		// Security
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}
		$Security->UserID_Loading();
		if ($Security->IsLoggedIn()) $Security->LoadUserID();
		$Security->UserID_Loaded();

		// Get export parameters
		if (@$_GET["export"] <> "") {
			$permission->Export = $_GET["export"];
		} elseif (ew_IsHttpPost()) {
			if (@$_POST["exporttype"] <> "")
				$permission->Export = $_POST["exporttype"];
		} else {
			$permission->setExportReturnUrl(ew_CurrentUrl());
		}
		$gsExport = $permission->Export; // Get export parameter, used in header
		$gsExportFile = $permission->TableVar; // Get export file, used in header
		$Charset = (EW_CHARSET <> "") ? ";charset=" . EW_CHARSET : ""; // Charset used in header
		if ($permission->Export == "excel") {
			header('Content-Type: application/vnd.ms-excel' . $Charset);
			header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
		}
		if ($permission->Export == "word") {
			header('Content-Type: application/vnd.ms-word' . $Charset);
			header('Content-Disposition: attachment; filename=' . $gsExportFile .'.doc');
		}

		// Get grid add count
		$gridaddcnt = @$_GET[EW_TABLE_GRID_ADD_ROW_COUNT];
		if (is_numeric($gridaddcnt) && $gridaddcnt > 0)
			$permission->GridAddRowCount = $gridaddcnt;

		// Set up list options
		$this->SetupListOptions();

		// Setup export options
		$this->SetupExportOptions();

		// Global Page Loading event (in userfn*.php)
		Page_Loading();

		// Page Load event
		$this->Page_Load();
	}

	//
	// Page_Terminate
	//
	function Page_Terminate($url = "") {
		global $conn;

		// Page Unload event
		$this->Page_Unload();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();
		$this->Page_Redirecting($url);

		 // Close connection
		$conn->Close();

		// Go to URL if specified
		if ($url <> "") {
			if (!EW_DEBUG_ENABLED && ob_get_length())
				ob_end_clean();
			header("Location: " . $url);
		}
		exit();
	}

	// Class variables
	var $ListOptions; // List options
	var $ExportOptions; // Export options
	var $DisplayRecs = 100;
	var $StartRec;
	var $StopRec;
	var $TotalRecs = 0;
	var $RecRange = 10;
	var $SearchWhere = ""; // Search WHERE clause
	var $RecCnt = 0; // Record count
	var $EditRowCnt;
	var $RowCnt;
	var $RowIndex = 0; // Row index
	var $KeyCount = 0; // Key count
	var $RowAction = ""; // Row action
	var $RowOldKey = ""; // Row old key (for copy)
	var $RecPerRow = 0;
	var $ColCnt = 0;
	var $DbMasterFilter = ""; // Master filter
	var $DbDetailFilter = ""; // Detail filter
	var $MasterRecordExists;	
	var $MultiSelectKey;
	var $RestoreSearch;
	var $Recordset;
	var $OldRecordset;

	//
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsFormError, $gsSearchError, $Security, $permission;

		// Search filters
		$sSrchAdvanced = ""; // Advanced search filter
		$sSrchBasic = ""; // Basic search filter
		$sFilter = "";
		if ($this->IsPageRequest()) { // Validate request

			// Set up records per page
			$this->SetUpDisplayRecs();

			// Handle reset command
			$this->ResetCmd();

			// Hide all options
			if ($permission->Export <> "" ||
				$permission->CurrentAction == "gridadd" ||
				$permission->CurrentAction == "gridedit") {
				$this->ListOptions->HideAllOptions();
				$this->ExportOptions->HideAllOptions();
			}

			// Set up sorting order
			$this->SetUpSortOrder();
		}

		// Restore display records
		if ($permission->getRecordsPerPage() <> "") {
			$this->DisplayRecs = $permission->getRecordsPerPage(); // Restore from Session
		} else {
			$this->DisplayRecs = 100; // Load default
		}

		// Load Sorting Order
		$this->LoadSortOrder();

		// Build filter
		$sFilter = "";
		ew_AddFilter($sFilter, $this->DbDetailFilter);
		ew_AddFilter($sFilter, $this->SearchWhere);

		// Set up filter in session
		$permission->setSessionWhere($sFilter);
		$permission->CurrentFilter = "";

		// Export data only
		if (in_array($permission->Export, array("html","word","excel","xml","csv","email","pdf"))) {
			$this->ExportData();
			if ($permission->Export <> "email")
				$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	// Set up number of records displayed per page
	function SetUpDisplayRecs() {
		global $permission;
		$sWrk = @$_GET[EW_TABLE_REC_PER_PAGE];
		if ($sWrk <> "") {
			if (is_numeric($sWrk)) {
				$this->DisplayRecs = intval($sWrk);
			} else {
				if (strtolower($sWrk) == "all") { // Display all records
					$this->DisplayRecs = -1;
				} else {
					$this->DisplayRecs = 100; // Non-numeric, load default
				}
			}
			$permission->setRecordsPerPage($this->DisplayRecs); // Save to Session

			// Reset start position
			$this->StartRec = 1;
			$permission->setStartRecordNumber($this->StartRec);
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $permission;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$permission->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$permission->CurrentOrderType = @$_GET["ordertype"];
			$permission->UpdateSort($permission->permission_id); // permission_id
			$permission->UpdateSort($permission->member_id); // member_id
			$permission->UpdateSort($permission->admin); // admin
			$permission->UpdateSort($permission->zupload); // upload
			$permission->UpdateSort($permission->download); // download
			$permission->UpdateSort($permission->readonly); // readonly
			$permission->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $permission;
		$sOrderBy = $permission->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($permission->SqlOrderBy() <> "") {
				$sOrderBy = $permission->SqlOrderBy();
				$permission->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $permission;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$permission->setSessionOrderBy($sOrderBy);
				$permission->permission_id->setSort("");
				$permission->member_id->setSort("");
				$permission->admin->setSort("");
				$permission->zupload->setSort("");
				$permission->download->setSort("");
				$permission->readonly->setSort("");
			}

			// Reset start position
			$this->StartRec = 1;
			$permission->setStartRecordNumber($this->StartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $Language, $permission;

		// "view"
		$item =& $this->ListOptions->Add("view");
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->IsLoggedIn();
		$item->OnLeft = TRUE;

		// "edit"
		$item =& $this->ListOptions->Add("edit");
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->IsLoggedIn();
		$item->OnLeft = TRUE;

		// "copy"
		$item =& $this->ListOptions->Add("copy");
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->IsLoggedIn();
		$item->OnLeft = TRUE;

		// "checkbox"
		$item =& $this->ListOptions->Add("checkbox");
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->IsLoggedIn();
		$item->OnLeft = TRUE;
		$item->Header = "<input type=\"checkbox\" name=\"key\" id=\"key\" class=\"phpmaker\" onclick=\"permission_list.SelectAllKey(this);\">";
		$item->MoveTo(0);

		// Call ListOptions_Load event
		$this->ListOptions_Load();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $permission, $objForm;
		$this->ListOptions->LoadDefault();

		// "view"
		$oListOpt =& $this->ListOptions->Items["view"];
		if ($Security->IsLoggedIn() && $oListOpt->Visible)
			$oListOpt->Body = "<a class=\"ewRowLink\" href=\"" . $this->ViewUrl . "\">" . $Language->Phrase("ViewLink") . "</a>";

		// "edit"
		$oListOpt =& $this->ListOptions->Items["edit"];
		if ($Security->IsLoggedIn() && $oListOpt->Visible) {
			$oListOpt->Body = "<a class=\"ewRowLink\" href=\"" . $this->EditUrl . "\">" . $Language->Phrase("EditLink") . "</a>";
		}

		// "copy"
		$oListOpt =& $this->ListOptions->Items["copy"];
		if ($Security->IsLoggedIn() && $oListOpt->Visible) {
			$oListOpt->Body = "<a class=\"ewRowLink\" href=\"" . $this->CopyUrl . "\">" . $Language->Phrase("CopyLink") . "</a>";
		}

		// "checkbox"
		$oListOpt =& $this->ListOptions->Items["checkbox"];
		if ($Security->IsLoggedIn() && $oListOpt->Visible)
			$oListOpt->Body = "<input type=\"checkbox\" name=\"key_m[]\" id=\"key_m[]\" value=\"" . ew_HtmlEncode($permission->permission_id->CurrentValue . EW_COMPOSITE_KEY_SEPARATOR . $permission->member_id->CurrentValue) . "\" class=\"phpmaker\" onclick='ew_ClickMultiCheckbox(this);'>";
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	function RenderListOptionsExt() {
		global $Security, $Language, $permission;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $permission;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$permission->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$permission->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $permission->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$permission->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$permission->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$permission->setStartRecordNumber($this->StartRec);
		}
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $permission;

		// Call Recordset Selecting event
		$permission->Recordset_Selecting($permission->CurrentFilter);

		// Load List page SQL
		$sSql = $permission->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$permission->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $permission;
		$sFilter = $permission->KeyFilter();

		// Call Row Selecting event
		$permission->Row_Selecting($sFilter);

		// Load SQL based on filter
		$permission->CurrentFilter = $sFilter;
		$sSql = $permission->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $permission;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$permission->Row_Selected($row);
		$permission->permission_id->setDbValue($rs->fields('permission_id'));
		$permission->member_id->setDbValue($rs->fields('member_id'));
		$permission->admin->setDbValue($rs->fields('admin'));
		$permission->zupload->setDbValue($rs->fields('upload'));
		$permission->download->setDbValue($rs->fields('download'));
		$permission->readonly->setDbValue($rs->fields('readonly'));
	}

	// Load old record
	function LoadOldRecord() {
		global $permission;

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($permission->getKey("permission_id")) <> "")
			$permission->permission_id->CurrentValue = $permission->getKey("permission_id"); // permission_id
		else
			$bValidKey = FALSE;
		if (strval($permission->getKey("member_id")) <> "")
			$permission->member_id->CurrentValue = $permission->getKey("member_id"); // member_id
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$permission->CurrentFilter = $permission->KeyFilter();
			$sSql = $permission->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		} else {
			$this->OldRecordset = NULL;
		}
		return $bValidKey;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $permission;

		// Initialize URLs
		$this->ViewUrl = $permission->ViewUrl();
		$this->EditUrl = $permission->EditUrl();
		$this->InlineEditUrl = $permission->InlineEditUrl();
		$this->CopyUrl = $permission->CopyUrl();
		$this->InlineCopyUrl = $permission->InlineCopyUrl();
		$this->DeleteUrl = $permission->DeleteUrl();

		// Call Row_Rendering event
		$permission->Row_Rendering();

		// Common render codes for all row types
		// permission_id
		// member_id
		// admin
		// upload
		// download
		// readonly

		if ($permission->RowType == EW_ROWTYPE_VIEW) { // View row

			// permission_id
			$permission->permission_id->ViewValue = $permission->permission_id->CurrentValue;
			$permission->permission_id->ViewCustomAttributes = "";

			// member_id
			$permission->member_id->ViewValue = $permission->member_id->CurrentValue;
			$permission->member_id->ViewCustomAttributes = "";

			// admin
			$permission->admin->ViewValue = $permission->admin->CurrentValue;
			$permission->admin->ViewCustomAttributes = "";

			// upload
			$permission->zupload->ViewValue = $permission->zupload->CurrentValue;
			$permission->zupload->ViewCustomAttributes = "";

			// download
			$permission->download->ViewValue = $permission->download->CurrentValue;
			$permission->download->ViewCustomAttributes = "";

			// readonly
			$permission->readonly->ViewValue = $permission->readonly->CurrentValue;
			$permission->readonly->ViewCustomAttributes = "";

			// permission_id
			$permission->permission_id->LinkCustomAttributes = "";
			$permission->permission_id->HrefValue = "";
			$permission->permission_id->TooltipValue = "";

			// member_id
			$permission->member_id->LinkCustomAttributes = "";
			$permission->member_id->HrefValue = "";
			$permission->member_id->TooltipValue = "";

			// admin
			$permission->admin->LinkCustomAttributes = "";
			$permission->admin->HrefValue = "";
			$permission->admin->TooltipValue = "";

			// upload
			$permission->zupload->LinkCustomAttributes = "";
			$permission->zupload->HrefValue = "";
			$permission->zupload->TooltipValue = "";

			// download
			$permission->download->LinkCustomAttributes = "";
			$permission->download->HrefValue = "";
			$permission->download->TooltipValue = "";

			// readonly
			$permission->readonly->LinkCustomAttributes = "";
			$permission->readonly->HrefValue = "";
			$permission->readonly->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($permission->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$permission->Row_Rendered();
	}

	// Set up export options
	function SetupExportOptions() {
		global $Language, $permission;

		// Printer friendly
		$item =& $this->ExportOptions->Add("print");
		$item->Body = "<a href=\"" . $this->ExportPrintUrl . "\">" . $Language->Phrase("PrinterFriendly") . "</a>";
		$item->Visible = TRUE;

		// Export to Excel
		$item =& $this->ExportOptions->Add("excel");
		$item->Body = "<a href=\"" . $this->ExportExcelUrl . "\">" . $Language->Phrase("ExportToExcel") . "</a>";
		$item->Visible = TRUE;

		// Export to Word
		$item =& $this->ExportOptions->Add("word");
		$item->Body = "<a href=\"" . $this->ExportWordUrl . "\">" . $Language->Phrase("ExportToWord") . "</a>";
		$item->Visible = TRUE;

		// Export to Html
		$item =& $this->ExportOptions->Add("html");
		$item->Body = "<a href=\"" . $this->ExportHtmlUrl . "\">" . $Language->Phrase("ExportToHtml") . "</a>";
		$item->Visible = FALSE;

		// Export to Xml
		$item =& $this->ExportOptions->Add("xml");
		$item->Body = "<a href=\"" . $this->ExportXmlUrl . "\">" . $Language->Phrase("ExportToXml") . "</a>";
		$item->Visible = FALSE;

		// Export to Csv
		$item =& $this->ExportOptions->Add("csv");
		$item->Body = "<a href=\"" . $this->ExportCsvUrl . "\">" . $Language->Phrase("ExportToCsv") . "</a>";
		$item->Visible = FALSE;

		// Export to Pdf
		$item =& $this->ExportOptions->Add("pdf");
		$item->Body = "<a href=\"" . $this->ExportPdfUrl . "\">" . $Language->Phrase("ExportToPDF") . "</a>";
		$item->Visible = FALSE;

		// Export to Email
		$item =& $this->ExportOptions->Add("email");
		$item->Body = "<a name=\"emf_permission\" id=\"emf_permission\" href=\"javascript:void(0);\" onclick=\"ew_EmailDialogShow({lnk:'emf_permission',hdr:ewLanguage.Phrase('ExportToEmail'),f:document.fpermissionlist,sel:false});\">" . $Language->Phrase("ExportToEmail") . "</a>";
		$item->Visible = FALSE;

		// Hide options for export/action
		if ($permission->Export <> "" ||
			$permission->CurrentAction <> "")
			$this->ExportOptions->HideAllOptions();
	}

	// Export data in HTML/CSV/Word/Excel/XML/Email/PDF format
	function ExportData() {
		global $permission;
		$utf8 = (strtolower(EW_CHARSET) == "utf-8");
		$bSelectLimit = EW_SELECT_LIMIT;

		// Load recordset
		if ($bSelectLimit) {
			$this->TotalRecs = $permission->SelectRecordCount();
		} else {
			if ($rs = $this->LoadRecordset())
				$this->TotalRecs = $rs->RecordCount();
		}
		$this->StartRec = 1;

		// Export all
		if ($permission->ExportAll) {
			$this->DisplayRecs = $this->TotalRecs;
			$this->StopRec = $this->TotalRecs;
		} else { // Export one page only
			$this->SetUpStartRec(); // Set up start record position

			// Set the last record to display
			if ($this->DisplayRecs < 0) {
				$this->StopRec = $this->TotalRecs;
			} else {
				$this->StopRec = $this->StartRec + $this->DisplayRecs - 1;
			}
		}
		if ($bSelectLimit)
			$rs = $this->LoadRecordset($this->StartRec-1, $this->DisplayRecs);
		if (!$rs) {
			header("Content-Type:"); // Remove header
			header("Content-Disposition:");
			$this->ShowMessage();
			return;
		}
		if ($permission->Export == "xml") {
			$XmlDoc = new cXMLDocument(EW_XML_ENCODING);
			$XmlDoc->XmlDoc->formatOutput = TRUE; // Formatted output
		} else {
			$ExportDoc = new cExportDocument($permission, "h");
		}
		$ParentTable = "";
		if ($bSelectLimit) {
			$StartRec = 1;
			$StopRec = $this->DisplayRecs;
		} else {
			$StartRec = $this->StartRec;
			$StopRec = $this->StopRec;
		}
		if ($permission->Export == "xml") {
			$permission->ExportXmlDocument($XmlDoc, ($ParentTable <> ""), $rs, $StartRec, $StopRec, "");
		} else {
			$sHeader = $this->PageHeader;
			$this->Page_DataRendering($sHeader);
			$ExportDoc->Text .= $sHeader;
			$permission->ExportDocument($ExportDoc, $rs, $StartRec, $StopRec, "");
			$sFooter = $this->PageFooter;
			$this->Page_DataRendered($sFooter);
			$ExportDoc->Text .= $sFooter;
		}

		// Close recordset
		$rs->Close();

		// Export header and footer
		if ($permission->Export <> "xml") {
			$ExportDoc->ExportHeaderAndFooter();
		}

		// Clean output buffer
		if (!EW_DEBUG_ENABLED && ob_get_length())
			ob_end_clean();

		// Write BOM if utf-8
		if ($utf8 && !in_array($permission->Export, array("email", "xml")))
			echo "\xEF\xBB\xBF";

		// Write debug message if enabled
		if (EW_DEBUG_ENABLED)
			echo ew_DebugMsg();

		// Output data
		if ($permission->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} elseif ($permission->Export == "email") {
			$this->ExportEmail($ExportDoc->Text);
			$this->Page_Terminate($permission->ExportReturnUrl());
		} elseif ($permission->Export == "pdf") {
			$this->ExportPDF($ExportDoc->Text);
		} else {
			echo $ExportDoc->Text;
		}
	}

	// Export PDF
	function ExportPDF($html) {
		global $gsExportFile;
		include_once "dompdf060b2/dompdf_config.inc.php";
		@ini_set("memory_limit", EW_PDF_MEMORY_LIMIT);
		set_time_limit(EW_PDF_TIME_LIMIT);
		$dompdf = new DOMPDF();
		$dompdf->load_html($html);
		$dompdf->set_paper("a4", "portrait");
		$dompdf->render();
		ob_end_clean();
		ew_DeleteTmpImages();
		$dompdf->stream($gsExportFile . ".pdf", array("Attachment" => 1)); // 0 to open in browser, 1 to download

//		exit();
	}

	// Page Load event
	function Page_Load() {

		//echo "Page Load";
	}

	// Page Unload event
	function Page_Unload() {

		//echo "Page Unload";
	}

	// Page Redirecting event
	function Page_Redirecting(&$url) {

		// Example:
		//$url = "your URL";

	}

	// Message Showing event
	// $type = ''|'success'|'failure'
	function Message_Showing(&$msg, $type) {

		// Example:
		//if ($type == 'success') $msg = "your success message";

	}

	// Page Data Rendering event
	function Page_DataRendering(&$header) {

		// Example:
		//$header = "your header";

	}

	// Page Data Rendered event
	function Page_DataRendered(&$footer) {

		// Example:
		//$footer = "your footer";

	}

	// Form Custom Validate event
	function Form_CustomValidate(&$CustomError) {

		// Return error message in CustomError
		return TRUE;
	}

	// ListOptions Load event
	function ListOptions_Load() {

		// Example:
		//$opt =& $this->ListOptions->Add("new");
		//$opt->Header = "xxx";
		//$opt->OnLeft = TRUE; // Link on left
		//$opt->MoveTo(0); // Move to first column

	}

	// ListOptions Rendered event
	function ListOptions_Rendered() {

		// Example: 
		//$this->ListOptions->Items["new"]->Body = "xxx";

	}
}
?>
