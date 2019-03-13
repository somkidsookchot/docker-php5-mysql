<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "expensescategoryinfo.php" ?>
<?php include_once "administratorinfo.php" ?>
<?php include_once "expenseslistinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$expensescategory_list = new cexpensescategory_list();
$Page =& $expensescategory_list;

// Page init
$expensescategory_list->Page_Init();

// Page main
$expensescategory_list->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($expensescategory->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var expensescategory_list = new ew_Page("expensescategory_list");

// page properties
expensescategory_list.PageID = "list"; // page ID
expensescategory_list.FormID = "fexpensescategorylist"; // form ID
var EW_PAGE_ID = expensescategory_list.PageID; // for backward compatibility

// extend page with validate function for search
expensescategory_list.ValidateSearch = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (this.ValidateRequired) {
		var infix = "";

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj))
			return false;
	}
	for (var i=0; i<fobj.elements.length; i++) {
		var elem = fobj.elements[i];
		if (elem.name.substring(0,2) == "s_" || elem.name.substring(0,3) == "sv_")
			elem.value = "";
	}
	return true;
}

// extend page with Form_CustomValidate function
expensescategory_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
expensescategory_list.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
expensescategory_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
expensescategory_list.ValidateRequired = false; // no JavaScript validation
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
<?php if (($expensescategory->Export == "") || (EW_EXPORT_MASTER_RECORD && $expensescategory->Export == "print")) { ?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$expensescategory_list->TotalRecs = $expensescategory->SelectRecordCount();
	} else {
		if ($expensescategory_list->Recordset = $expensescategory_list->LoadRecordset())
			$expensescategory_list->TotalRecs = $expensescategory_list->Recordset->RecordCount();
	}
	$expensescategory_list->StartRec = 1;
	if ($expensescategory_list->DisplayRecs <= 0 || ($expensescategory->Export <> "" && $expensescategory->ExportAll)) // Display all records
		$expensescategory_list->DisplayRecs = $expensescategory_list->TotalRecs;
	if (!($expensescategory->Export <> "" && $expensescategory->ExportAll))
		$expensescategory_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$expensescategory_list->Recordset = $expensescategory_list->LoadRecordset($expensescategory_list->StartRec-1, $expensescategory_list->DisplayRecs);
?>
<div class="phpmaker ewTitle" style="white-space: nowrap;"><img src="images/ico_payall.png" width="40" height="40" align="absmiddle" /><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $expensescategory->TableCaption() ?>

</div>
<div class="clear"></div>
<?php $expensescategory_list->ShowPageHeader(); ?>
<?php
$expensescategory_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($expensescategory->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($expensescategory->CurrentAction <> "gridadd" && $expensescategory->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($expensescategory_list->Pager)) $expensescategory_list->Pager = new cPrevNextPager($expensescategory_list->StartRec, $expensescategory_list->DisplayRecs, $expensescategory_list->TotalRecs) ?>
<?php if ($expensescategory_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($expensescategory_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $expensescategory_list->PageUrl() ?>start=<?php echo $expensescategory_list->Pager->FirstButton->Start ?>"><img src="phpimages/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($expensescategory_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $expensescategory_list->PageUrl() ?>start=<?php echo $expensescategory_list->Pager->PrevButton->Start ?>"><img src="phpimages/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $expensescategory_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($expensescategory_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $expensescategory_list->PageUrl() ?>start=<?php echo $expensescategory_list->Pager->NextButton->Start ?>"><img src="phpimages/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($expensescategory_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $expensescategory_list->PageUrl() ?>start=<?php echo $expensescategory_list->Pager->LastButton->Start ?>"><img src="phpimages/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $expensescategory_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $expensescategory_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $expensescategory_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $expensescategory_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($expensescategory_list->SearchWhere == "0=101") { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoRecord") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($expensescategory_list->TotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td><?php echo $Language->Phrase("RecordsPerPage") ?>&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="expensescategory">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();">
<option value="10"<?php if ($expensescategory_list->DisplayRecs == 10) { ?> selected="selected"<?php } ?>>10</option>
<option value="20"<?php if ($expensescategory_list->DisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="50"<?php if ($expensescategory_list->DisplayRecs == 50) { ?> selected="selected"<?php } ?>>50</option>
<option value="100"<?php if ($expensescategory_list->DisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="200"<?php if ($expensescategory_list->DisplayRecs == 200) { ?> selected="selected"<?php } ?>>200</option>
<option value="300"<?php if ($expensescategory_list->DisplayRecs == 300) { ?> selected="selected"<?php } ?>>300</option>
<option value="500"<?php if ($expensescategory_list->DisplayRecs == 500) { ?> selected="selected"<?php } ?>>500</option>
<option value="700"<?php if ($expensescategory_list->DisplayRecs == 700) { ?> selected="selected"<?php } ?>>700</option>
<option value="1000"<?php if ($expensescategory_list->DisplayRecs == 1000) { ?> selected="selected"<?php } ?>>1000</option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<span class="phpmaker">
<?php if ($Security->IsLoggedIn()) { ?>
<a class="ewGridLink" href="<?php echo $expensescategory_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php if ($expenseslist->DetailAdd && $Security->IsLoggedIn()) { ?>
<a class="ewGridLink" href="<?php echo $expensescategory->AddUrl() . "?" . EW_TABLE_SHOW_DETAIL . "=expenseslist" ?>"><?php echo $Language->Phrase("AddLink") ?>&nbsp;<?php echo $expensescategory->TableCaption() ?>/<?php echo $expenseslist->TableCaption() ?></a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
<?php if ($expensescategory_list->TotalRecs > 0) { ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a class="ewGridLink" href="" onclick="ew_SubmitSelected(document.fexpensescategorylist, '<?php echo $expensescategory_list->MultiDeleteUrl ?>');return false;"><?php echo $Language->Phrase("DeleteSelectedLink") ?></a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
</span>
</div>
<?php } ?>
<form name="fexpensescategorylist" id="fexpensescategorylist" class="ewForm" action="" method="post">
<input type="hidden" name="t" id="t" value="expensescategory">
<div id="gmp_expensescategory" class="ewGridMiddlePanel">
<?php if ($expensescategory_list->TotalRecs > 0) { ?>
<table cellspacing="0" data-rowhighlightclass="ewTableHighlightRow" data-rowselectclass="ewTableSelectRow" data-roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $expensescategory->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$expensescategory_list->RenderListOptions();

// Render list options (header, left)
$expensescategory_list->ListOptions->Render("header", "left");
?>
<?php if ($expensescategory->exp_cat_title->Visible) { // exp_cat_title ?>
	<?php if ($expensescategory->SortUrl($expensescategory->exp_cat_title) == "") { ?>
		<td style="white-space: nowrap;"><?php echo $expensescategory->exp_cat_title->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $expensescategory->SortUrl($expensescategory->exp_cat_title) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><thead><tr><td><?php echo $expensescategory->exp_cat_title->FldCaption() ?></td><td style="width: 10px;"><?php if ($expensescategory->exp_cat_title->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($expensescategory->exp_cat_title->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$expensescategory_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($expensescategory->ExportAll && $expensescategory->Export <> "") {
	$expensescategory_list->StopRec = $expensescategory_list->TotalRecs;
} else {

	// Set the last record to display
	if ($expensescategory_list->TotalRecs > $expensescategory_list->StartRec + $expensescategory_list->DisplayRecs - 1)
		$expensescategory_list->StopRec = $expensescategory_list->StartRec + $expensescategory_list->DisplayRecs - 1;
	else
		$expensescategory_list->StopRec = $expensescategory_list->TotalRecs;
}
$expensescategory_list->RecCnt = $expensescategory_list->StartRec - 1;
if ($expensescategory_list->Recordset && !$expensescategory_list->Recordset->EOF) {
	$expensescategory_list->Recordset->MoveFirst();
	if (!$bSelectLimit && $expensescategory_list->StartRec > 1)
		$expensescategory_list->Recordset->Move($expensescategory_list->StartRec - 1);
} elseif (!$expensescategory->AllowAddDeleteRow && $expensescategory_list->StopRec == 0) {
	$expensescategory_list->StopRec = $expensescategory->GridAddRowCount;
}

// Initialize aggregate
$expensescategory->RowType = EW_ROWTYPE_AGGREGATEINIT;
$expensescategory->ResetAttrs();
$expensescategory_list->RenderRow();
$expensescategory_list->RowCnt = 0;
while ($expensescategory_list->RecCnt < $expensescategory_list->StopRec) {
	$expensescategory_list->RecCnt++;
	if (intval($expensescategory_list->RecCnt) >= intval($expensescategory_list->StartRec)) {
		$expensescategory_list->RowCnt++;

		// Set up key count
		$expensescategory_list->KeyCount = $expensescategory_list->RowIndex;

		// Init row class and style
		$expensescategory->ResetAttrs();
		$expensescategory->CssClass = "";
		if ($expensescategory->CurrentAction == "gridadd") {
		} else {
			$expensescategory_list->LoadRowValues($expensescategory_list->Recordset); // Load row values
		}
		$expensescategory->RowType = EW_ROWTYPE_VIEW; // Render view
		$expensescategory->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');

		// Render row
		$expensescategory_list->RenderRow();

		// Render list options
		$expensescategory_list->RenderListOptions();
?>
	<tr<?php echo $expensescategory->RowAttributes() ?>>
<?php

// Render list options (body, left)
$expensescategory_list->ListOptions->Render("body", "left");
?>
	<?php if ($expensescategory->exp_cat_title->Visible) { // exp_cat_title ?>
		<td<?php echo $expensescategory->exp_cat_title->CellAttributes() ?>>
<div<?php echo $expensescategory->exp_cat_title->ViewAttributes() ?>><?php echo $expensescategory->exp_cat_title->ListViewValue() ?></div>
<a name="<?php echo $expensescategory_list->PageObjName . "_row_" . $expensescategory_list->RowCnt ?>" id="<?php echo $expensescategory_list->PageObjName . "_row_" . $expensescategory_list->RowCnt ?>"></a></td>
	<?php } ?>
<?php

// Render list options (body, right)
$expensescategory_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($expensescategory->CurrentAction <> "gridadd")
		$expensescategory_list->Recordset->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($expensescategory_list->Recordset)
	$expensescategory_list->Recordset->Close();
?>
<?php if ($expensescategory_list->TotalRecs > 0) { ?>
<?php if ($expensescategory->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($expensescategory->CurrentAction <> "gridadd" && $expensescategory->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($expensescategory_list->Pager)) $expensescategory_list->Pager = new cPrevNextPager($expensescategory_list->StartRec, $expensescategory_list->DisplayRecs, $expensescategory_list->TotalRecs) ?>
<?php if ($expensescategory_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($expensescategory_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $expensescategory_list->PageUrl() ?>start=<?php echo $expensescategory_list->Pager->FirstButton->Start ?>"><img src="phpimages/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($expensescategory_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $expensescategory_list->PageUrl() ?>start=<?php echo $expensescategory_list->Pager->PrevButton->Start ?>"><img src="phpimages/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $expensescategory_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($expensescategory_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $expensescategory_list->PageUrl() ?>start=<?php echo $expensescategory_list->Pager->NextButton->Start ?>"><img src="phpimages/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($expensescategory_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $expensescategory_list->PageUrl() ?>start=<?php echo $expensescategory_list->Pager->LastButton->Start ?>"><img src="phpimages/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $expensescategory_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $expensescategory_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $expensescategory_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $expensescategory_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($expensescategory_list->SearchWhere == "0=101") { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoRecord") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($expensescategory_list->TotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td><?php echo $Language->Phrase("RecordsPerPage") ?>&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="expensescategory">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();">
<option value="10"<?php if ($expensescategory_list->DisplayRecs == 10) { ?> selected="selected"<?php } ?>>10</option>
<option value="20"<?php if ($expensescategory_list->DisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="50"<?php if ($expensescategory_list->DisplayRecs == 50) { ?> selected="selected"<?php } ?>>50</option>
<option value="100"<?php if ($expensescategory_list->DisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="200"<?php if ($expensescategory_list->DisplayRecs == 200) { ?> selected="selected"<?php } ?>>200</option>
<option value="300"<?php if ($expensescategory_list->DisplayRecs == 300) { ?> selected="selected"<?php } ?>>300</option>
<option value="500"<?php if ($expensescategory_list->DisplayRecs == 500) { ?> selected="selected"<?php } ?>>500</option>
<option value="700"<?php if ($expensescategory_list->DisplayRecs == 700) { ?> selected="selected"<?php } ?>>700</option>
<option value="1000"<?php if ($expensescategory_list->DisplayRecs == 1000) { ?> selected="selected"<?php } ?>>1000</option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<span class="phpmaker">
<?php if ($Security->IsLoggedIn()) { ?>
<a class="ewGridLink" href="<?php echo $expensescategory_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php if ($expenseslist->DetailAdd && $Security->IsLoggedIn()) { ?>
<a class="ewGridLink" href="<?php echo $expensescategory->AddUrl() . "?" . EW_TABLE_SHOW_DETAIL . "=expenseslist" ?>"><?php echo $Language->Phrase("AddLink") ?>&nbsp;<?php echo $expensescategory->TableCaption() ?>/<?php echo $expenseslist->TableCaption() ?></a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
<?php if ($expensescategory_list->TotalRecs > 0) { ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a class="ewGridLink" href="" onclick="ew_SubmitSelected(document.fexpensescategorylist, '<?php echo $expensescategory_list->MultiDeleteUrl ?>');return false;"><?php echo $Language->Phrase("DeleteSelectedLink") ?></a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
</span>
</div>
<?php } ?>
<?php } ?>
</td></tr></table>
<?php if ($expensescategory->Export == "" && $expensescategory->CurrentAction == "") { ?>
<script type="text/javascript">
<!--
ew_ToggleSearchPanel(expensescategory_list); // Init search panel as collapsed

//-->
</script>
<?php } ?>
<?php
$expensescategory_list->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($expensescategory->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$expensescategory_list->Page_Terminate();
?>
<?php

//
// Page class
//
class cexpensescategory_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'expensescategory';

	// Page object name
	var $PageObjName = 'expensescategory_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $expensescategory;
		if ($expensescategory->UseTokenInUrl) $PageUrl .= "t=" . $expensescategory->TableVar . "&"; // Add page token
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
		global $objForm, $expensescategory;
		if ($expensescategory->UseTokenInUrl) {
			if ($objForm)
				return ($expensescategory->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($expensescategory->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cexpensescategory_list() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (expensescategory)
		if (!isset($GLOBALS["expensescategory"])) {
			$GLOBALS["expensescategory"] = new cexpensescategory();
			$GLOBALS["Table"] =& $GLOBALS["expensescategory"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf";
		$this->AddUrl = "expensescategoryadd.php?" . EW_TABLE_SHOW_DETAIL . "=";
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "expensescategorydelete.php";
		$this->MultiUpdateUrl = "expensescategoryupdate.php";

		// Table object (administrator)
		if (!isset($GLOBALS['administrator'])) $GLOBALS['administrator'] = new cadministrator();

		// Table object (expenseslist)
		if (!isset($GLOBALS['expenseslist'])) $GLOBALS['expenseslist'] = new cexpenseslist();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'expensescategory', TRUE);

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
		global $expensescategory;

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
			$expensescategory->Export = $_GET["export"];
		} elseif (ew_IsHttpPost()) {
			if (@$_POST["exporttype"] <> "")
				$expensescategory->Export = $_POST["exporttype"];
		} else {
			$expensescategory->setExportReturnUrl(ew_CurrentUrl());
		}
		$gsExport = $expensescategory->Export; // Get export parameter, used in header
		$gsExportFile = $expensescategory->TableVar; // Get export file, used in header
		$Charset = (EW_CHARSET <> "") ? ";charset=" . EW_CHARSET : ""; // Charset used in header
		if ($expensescategory->Export == "excel") {
			header('Content-Type: application/vnd.ms-excel' . $Charset);
			header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
		}
		if ($expensescategory->Export == "word") {
			header('Content-Type: application/vnd.ms-word' . $Charset);
			header('Content-Disposition: attachment; filename=' . $gsExportFile .'.doc');
		}

		// Get grid add count
		$gridaddcnt = @$_GET[EW_TABLE_GRID_ADD_ROW_COUNT];
		if (is_numeric($gridaddcnt) && $gridaddcnt > 0)
			$expensescategory->GridAddRowCount = $gridaddcnt;

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
		global $objForm, $Language, $gsFormError, $gsSearchError, $Security, $expensescategory;

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
			if ($expensescategory->Export <> "" ||
				$expensescategory->CurrentAction == "gridadd" ||
				$expensescategory->CurrentAction == "gridedit") {
				$this->ListOptions->HideAllOptions();
				$this->ExportOptions->HideAllOptions();
			}

			// Get and validate search values for advanced search
			$this->LoadSearchValues(); // Get search values
			if (!$this->ValidateSearch())
				$this->setFailureMessage($gsSearchError);

			// Restore search parms from Session
			$this->RestoreSearchParms();

			// Call Recordset SearchValidated event
			$expensescategory->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get search criteria for advanced search
			if ($gsSearchError == "")
				$sSrchAdvanced = $this->AdvancedSearchWhere();
		}

		// Restore display records
		if ($expensescategory->getRecordsPerPage() <> "") {
			$this->DisplayRecs = $expensescategory->getRecordsPerPage(); // Restore from Session
		} else {
			$this->DisplayRecs = 100; // Load default
		}

		// Load Sorting Order
		$this->LoadSortOrder();

		// Build search criteria
		ew_AddFilter($this->SearchWhere, $sSrchAdvanced);
		ew_AddFilter($this->SearchWhere, $sSrchBasic);

		// Call Recordset_Searching event
		$expensescategory->Recordset_Searching($this->SearchWhere);

		// Save search criteria
		if ($this->SearchWhere <> "") {
			if ($sSrchAdvanced == "")
				$this->ResetAdvancedSearchParms();
			$expensescategory->setSearchWhere($this->SearchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->StartRec = 1; // Reset start record counter
				$expensescategory->setStartRecordNumber($this->StartRec);
			}
		} else {
			$this->SearchWhere = $expensescategory->getSearchWhere();
		}

		// Build filter
		$sFilter = "";
		ew_AddFilter($sFilter, $this->DbDetailFilter);
		ew_AddFilter($sFilter, $this->SearchWhere);

		// Set up filter in session
		$expensescategory->setSessionWhere($sFilter);
		$expensescategory->CurrentFilter = "";

		// Export data only
		if (in_array($expensescategory->Export, array("html","word","excel","xml","csv","email","pdf"))) {
			$this->ExportData();
			if ($expensescategory->Export <> "email")
				$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	// Set up number of records displayed per page
	function SetUpDisplayRecs() {
		global $expensescategory;
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
			$expensescategory->setRecordsPerPage($this->DisplayRecs); // Save to Session

			// Reset start position
			$this->StartRec = 1;
			$expensescategory->setStartRecordNumber($this->StartRec);
		}
	}

	// Advanced search WHERE clause based on QueryString
	function AdvancedSearchWhere() {
		global $Security, $expensescategory;
		$sWhere = "";
		$this->BuildSearchSql($sWhere, $expensescategory->exp_cat_title, FALSE); // exp_cat_title

		// Set up search parm
		if ($sWhere <> "") {
			$this->SetSearchParm($expensescategory->exp_cat_title); // exp_cat_title
		}
		return $sWhere;
	}

	// Build search SQL
	function BuildSearchSql(&$Where, &$Fld, $MultiValue) {
		$FldParm = substr($Fld->FldVar, 2);		
		$FldVal = $Fld->AdvancedSearch->SearchValue; // @$_GET["x_$FldParm"]
		$FldOpr = $Fld->AdvancedSearch->SearchOperator; // @$_GET["z_$FldParm"]
		$FldCond = $Fld->AdvancedSearch->SearchCondition; // @$_GET["v_$FldParm"]
		$FldVal2 = $Fld->AdvancedSearch->SearchValue2; // @$_GET["y_$FldParm"]
		$FldOpr2 = $Fld->AdvancedSearch->SearchOperator2; // @$_GET["w_$FldParm"]
		$sWrk = "";

		//$FldVal = ew_StripSlashes($FldVal);
		if (is_array($FldVal)) $FldVal = implode(",", $FldVal);

		//$FldVal2 = ew_StripSlashes($FldVal2);
		if (is_array($FldVal2)) $FldVal2 = implode(",", $FldVal2);
		$FldOpr = strtoupper(trim($FldOpr));
		if ($FldOpr == "") $FldOpr = "=";
		$FldOpr2 = strtoupper(trim($FldOpr2));
		if ($FldOpr2 == "") $FldOpr2 = "=";
		if (EW_SEARCH_MULTI_VALUE_OPTION == 1 || $FldOpr <> "LIKE" ||
			($FldOpr2 <> "LIKE" && $FldVal2 <> ""))
			$MultiValue = FALSE;
		if ($MultiValue) {
			$sWrk1 = ($FldVal <> "") ? ew_GetMultiSearchSql($Fld, $FldVal) : ""; // Field value 1
			$sWrk2 = ($FldVal2 <> "") ? ew_GetMultiSearchSql($Fld, $FldVal2) : ""; // Field value 2
			$sWrk = $sWrk1; // Build final SQL
			if ($sWrk2 <> "")
				$sWrk = ($sWrk <> "") ? "($sWrk) $FldCond ($sWrk2)" : $sWrk2;
		} else {
			$FldVal = $this->ConvertSearchValue($Fld, $FldVal);
			$FldVal2 = $this->ConvertSearchValue($Fld, $FldVal2);
			$sWrk = ew_GetSearchSql($Fld, $FldVal, $FldOpr, $FldCond, $FldVal2, $FldOpr2);
		}
		ew_AddFilter($Where, $sWrk);
	}

	// Set search parameters
	function SetSearchParm(&$Fld) {
		global $expensescategory;
		$FldParm = substr($Fld->FldVar, 2);
		$FldVal = $Fld->AdvancedSearch->SearchValue; // @$_GET["x_$FldParm"]
		$FldVal = ew_StripSlashes($FldVal);
		if (is_array($FldVal)) $FldVal = implode(",", $FldVal);
		$FldVal2 = $Fld->AdvancedSearch->SearchValue2; // @$_GET["y_$FldParm"]
		$FldVal2 = ew_StripSlashes($FldVal2);
		if (is_array($FldVal2)) $FldVal2 = implode(",", $FldVal2);
		$expensescategory->setAdvancedSearch("x_$FldParm", $FldVal);
		$expensescategory->setAdvancedSearch("z_$FldParm", $Fld->AdvancedSearch->SearchOperator); // @$_GET["z_$FldParm"]
		$expensescategory->setAdvancedSearch("v_$FldParm", $Fld->AdvancedSearch->SearchCondition); // @$_GET["v_$FldParm"]
		$expensescategory->setAdvancedSearch("y_$FldParm", $FldVal2);
		$expensescategory->setAdvancedSearch("w_$FldParm", $Fld->AdvancedSearch->SearchOperator2); // @$_GET["w_$FldParm"]
	}

	// Get search parameters
	function GetSearchParm(&$Fld) {
		global $expensescategory;
		$FldParm = substr($Fld->FldVar, 2);
		$Fld->AdvancedSearch->SearchValue = $expensescategory->getAdvancedSearch("x_$FldParm");
		$Fld->AdvancedSearch->SearchOperator = $expensescategory->getAdvancedSearch("z_$FldParm");
		$Fld->AdvancedSearch->SearchCondition = $expensescategory->getAdvancedSearch("v_$FldParm");
		$Fld->AdvancedSearch->SearchValue2 = $expensescategory->getAdvancedSearch("y_$FldParm");
		$Fld->AdvancedSearch->SearchOperator2 = $expensescategory->getAdvancedSearch("w_$FldParm");
	}

	// Convert search value
	function ConvertSearchValue(&$Fld, $FldVal) {
		$Value = $FldVal;
		if ($Fld->FldDataType == EW_DATATYPE_BOOLEAN) {
			if ($FldVal <> "") $Value = ($FldVal == "1" || strtolower(strval($FldVal)) == "y" || strtolower(strval($FldVal)) == "t") ? $Fld->TrueValue : $Fld->FalseValue;
		} elseif ($Fld->FldDataType == EW_DATATYPE_DATE) {
			if ($FldVal <> "") $Value = ew_UnFormatDateTime($FldVal, $Fld->FldDateTimeFormat);
		}
		return $Value;
	}

	// Clear all search parameters
	function ResetSearchParms() {
		global $expensescategory;

		// Clear search WHERE clause
		$this->SearchWhere = "";
		$expensescategory->setSearchWhere($this->SearchWhere);

		// Clear advanced search parameters
		$this->ResetAdvancedSearchParms();
	}

	// Clear all advanced search parameters
	function ResetAdvancedSearchParms() {
		global $expensescategory;
		$expensescategory->setAdvancedSearch("x_exp_cat_title", "");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $expensescategory;
		$bRestore = TRUE;
		if ($expensescategory->exp_cat_title->AdvancedSearch->SearchValue <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore advanced search values
			$this->GetSearchParm($expensescategory->exp_cat_title);
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $expensescategory;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$expensescategory->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$expensescategory->CurrentOrderType = @$_GET["ordertype"];
			$expensescategory->UpdateSort($expensescategory->exp_cat_title); // exp_cat_title
			$expensescategory->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $expensescategory;
		$sOrderBy = $expensescategory->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($expensescategory->SqlOrderBy() <> "") {
				$sOrderBy = $expensescategory->SqlOrderBy();
				$expensescategory->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $expensescategory;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$expensescategory->setSessionOrderBy($sOrderBy);
				$expensescategory->exp_cat_title->setSort("");
			}

			// Reset start position
			$this->StartRec = 1;
			$expensescategory->setStartRecordNumber($this->StartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $Language, $expensescategory;

		// "edit"
		$item =& $this->ListOptions->Add("edit");
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->IsLoggedIn();
		$item->OnLeft = TRUE;

		// "detail_expenseslist"
		$item =& $this->ListOptions->Add("detail_expenseslist");
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->IsLoggedIn();
		$item->OnLeft = TRUE;

		// "checkbox"
		$item =& $this->ListOptions->Add("checkbox");
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->IsLoggedIn();
		$item->OnLeft = TRUE;
		$item->Header = "<input type=\"checkbox\" name=\"key\" id=\"key\" class=\"phpmaker\" onclick=\"expensescategory_list.SelectAllKey(this);\">";
		$item->MoveTo(0);

		// Call ListOptions_Load event
		$this->ListOptions_Load();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $expensescategory, $objForm;
		$this->ListOptions->LoadDefault();

		// "edit"
		$oListOpt =& $this->ListOptions->Items["edit"];
		if ($Security->IsLoggedIn() && $oListOpt->Visible) {
			$oListOpt->Body = "<a class=\"ewRowLink\" href=\"" . $this->EditUrl . "\">" . $Language->Phrase("EditLink") . "</a>";
		}

		// "detail_expenseslist"
		$oListOpt =& $this->ListOptions->Items["detail_expenseslist"];
		if ($Security->IsLoggedIn()) {
			$oListOpt->Body = $Language->Phrase("DetailLink") . $Language->TablePhrase("expenseslist", "TblCaption");
			$oListOpt->Body = "<a class=\"ewRowLink\" href=\"expenseslistlist.php?" . EW_TABLE_SHOW_MASTER . "=expensescategory&exp_cat_id=" . urlencode(strval($expensescategory->exp_cat_id->CurrentValue)) . "\">" . $oListOpt->Body . "</a>";
			$links = "";
			if ($GLOBALS["expenseslist"]->DetailEdit && $Security->IsLoggedIn() && $Security->IsLoggedIn())
				$links .= "<a class=\"ewRowLink\" href=\"" . $expensescategory->EditUrl(EW_TABLE_SHOW_DETAIL . "=expenseslist") . "\">" . $Language->Phrase("EditLink") . "</a>&nbsp;";
			if ($links <> "") $oListOpt->Body .= "<br>" . $links;
		}

		// "checkbox"
		$oListOpt =& $this->ListOptions->Items["checkbox"];
		if ($Security->IsLoggedIn() && $oListOpt->Visible)
			$oListOpt->Body = "<input type=\"checkbox\" name=\"key_m[]\" id=\"key_m[]\" value=\"" . ew_HtmlEncode($expensescategory->exp_cat_id->CurrentValue) . "\" class=\"phpmaker\" onclick='ew_ClickMultiCheckbox(this);'>";
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	function RenderListOptionsExt() {
		global $Security, $Language, $expensescategory;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $expensescategory;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$expensescategory->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$expensescategory->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $expensescategory->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$expensescategory->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$expensescategory->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$expensescategory->setStartRecordNumber($this->StartRec);
		}
	}

	//  Load search values for validation
	function LoadSearchValues() {
		global $objForm, $expensescategory;

		// Load search values
		// exp_cat_title

		$expensescategory->exp_cat_title->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_exp_cat_title"]);
		$expensescategory->exp_cat_title->AdvancedSearch->SearchOperator = @$_GET["z_exp_cat_title"];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $expensescategory;

		// Call Recordset Selecting event
		$expensescategory->Recordset_Selecting($expensescategory->CurrentFilter);

		// Load List page SQL
		$sSql = $expensescategory->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$expensescategory->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $expensescategory;
		$sFilter = $expensescategory->KeyFilter();

		// Call Row Selecting event
		$expensescategory->Row_Selecting($sFilter);

		// Load SQL based on filter
		$expensescategory->CurrentFilter = $sFilter;
		$sSql = $expensescategory->SQL();
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
		global $conn, $expensescategory;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$expensescategory->Row_Selected($row);
		$expensescategory->exp_cat_id->setDbValue($rs->fields('exp_cat_id'));
		$expensescategory->exp_cat_title->setDbValue($rs->fields('exp_cat_title'));
	}

	// Load old record
	function LoadOldRecord() {
		global $expensescategory;

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($expensescategory->getKey("exp_cat_id")) <> "")
			$expensescategory->exp_cat_id->CurrentValue = $expensescategory->getKey("exp_cat_id"); // exp_cat_id
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$expensescategory->CurrentFilter = $expensescategory->KeyFilter();
			$sSql = $expensescategory->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		} else {
			$this->OldRecordset = NULL;
		}
		return $bValidKey;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $expensescategory;

		// Initialize URLs
		$this->ViewUrl = $expensescategory->ViewUrl();
		$this->EditUrl = $expensescategory->EditUrl();
		$this->InlineEditUrl = $expensescategory->InlineEditUrl();
		$this->CopyUrl = $expensescategory->CopyUrl();
		$this->InlineCopyUrl = $expensescategory->InlineCopyUrl();
		$this->DeleteUrl = $expensescategory->DeleteUrl();

		// Call Row_Rendering event
		$expensescategory->Row_Rendering();

		// Common render codes for all row types
		// exp_cat_id

		$expensescategory->exp_cat_id->CellCssStyle = "white-space: nowrap;";

		// exp_cat_title
		$expensescategory->exp_cat_title->CellCssStyle = "white-space: nowrap;";
		if ($expensescategory->RowType == EW_ROWTYPE_VIEW) { // View row

			// exp_cat_title
			$expensescategory->exp_cat_title->ViewValue = $expensescategory->exp_cat_title->CurrentValue;
			$expensescategory->exp_cat_title->ViewCustomAttributes = "";

			// exp_cat_title
			$expensescategory->exp_cat_title->LinkCustomAttributes = "";
			$expensescategory->exp_cat_title->HrefValue = "";
			$expensescategory->exp_cat_title->TooltipValue = "";
		} elseif ($expensescategory->RowType == EW_ROWTYPE_SEARCH) { // Search row

			// exp_cat_title
			$expensescategory->exp_cat_title->EditCustomAttributes = "";
			$expensescategory->exp_cat_title->EditValue = ew_HtmlEncode($expensescategory->exp_cat_title->AdvancedSearch->SearchValue);
		}
		if ($expensescategory->RowType == EW_ROWTYPE_ADD ||
			$expensescategory->RowType == EW_ROWTYPE_EDIT ||
			$expensescategory->RowType == EW_ROWTYPE_SEARCH) { // Add / Edit / Search row
			$expensescategory->SetupFieldTitles();
		}

		// Call Row Rendered event
		if ($expensescategory->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$expensescategory->Row_Rendered();
	}

	// Validate search
	function ValidateSearch() {
		global $gsSearchError, $expensescategory;

		// Initialize
		$gsSearchError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return TRUE;

		// Return validate result
		$ValidateSearch = ($gsSearchError == "");

		// Call Form_CustomValidate event
		$sFormCustomError = "";
		$ValidateSearch = $ValidateSearch && $this->Form_CustomValidate($sFormCustomError);
		if ($sFormCustomError <> "") {
			ew_AddMessage($gsSearchError, $sFormCustomError);
		}
		return $ValidateSearch;
	}

	// Load advanced search
	function LoadAdvancedSearch() {
		global $expensescategory;
		$expensescategory->exp_cat_title->AdvancedSearch->SearchValue = $expensescategory->getAdvancedSearch("x_exp_cat_title");
	}

	// Set up export options
	function SetupExportOptions() {
		global $Language, $expensescategory;

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
		$item->Body = "<a name=\"emf_expensescategory\" id=\"emf_expensescategory\" href=\"javascript:void(0);\" onclick=\"ew_EmailDialogShow({lnk:'emf_expensescategory',hdr:ewLanguage.Phrase('ExportToEmail'),f:document.fexpensescategorylist,sel:false});\">" . $Language->Phrase("ExportToEmail") . "</a>";
		$item->Visible = FALSE;

		// Hide options for export/action
		if ($expensescategory->Export <> "" ||
			$expensescategory->CurrentAction <> "")
			$this->ExportOptions->HideAllOptions();
	}

	// Export data in HTML/CSV/Word/Excel/XML/Email/PDF format
	function ExportData() {
		global $expensescategory;
		$utf8 = (strtolower(EW_CHARSET) == "utf-8");
		$bSelectLimit = EW_SELECT_LIMIT;

		// Load recordset
		if ($bSelectLimit) {
			$this->TotalRecs = $expensescategory->SelectRecordCount();
		} else {
			if ($rs = $this->LoadRecordset())
				$this->TotalRecs = $rs->RecordCount();
		}
		$this->StartRec = 1;

		// Export all
		if ($expensescategory->ExportAll) {
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
		if ($expensescategory->Export == "xml") {
			$XmlDoc = new cXMLDocument(EW_XML_ENCODING);
			$XmlDoc->XmlDoc->formatOutput = TRUE; // Formatted output
		} else {
			$ExportDoc = new cExportDocument($expensescategory, "h");
		}
		$ParentTable = "";
		if ($bSelectLimit) {
			$StartRec = 1;
			$StopRec = $this->DisplayRecs;
		} else {
			$StartRec = $this->StartRec;
			$StopRec = $this->StopRec;
		}
		if ($expensescategory->Export == "xml") {
			$expensescategory->ExportXmlDocument($XmlDoc, ($ParentTable <> ""), $rs, $StartRec, $StopRec, "");
		} else {
			$sHeader = $this->PageHeader;
			$this->Page_DataRendering($sHeader);
			$ExportDoc->Text .= $sHeader;
			$expensescategory->ExportDocument($ExportDoc, $rs, $StartRec, $StopRec, "");
			$sFooter = $this->PageFooter;
			$this->Page_DataRendered($sFooter);
			$ExportDoc->Text .= $sFooter;
		}

		// Close recordset
		$rs->Close();

		// Export header and footer
		if ($expensescategory->Export <> "xml") {
			$ExportDoc->ExportHeaderAndFooter();
		}

		// Clean output buffer
		if (!EW_DEBUG_ENABLED && ob_get_length())
			ob_end_clean();

		// Write BOM if utf-8
		if ($utf8 && !in_array($expensescategory->Export, array("email", "xml")))
			echo "\xEF\xBB\xBF";

		// Write debug message if enabled
		if (EW_DEBUG_ENABLED)
			echo ew_DebugMsg();

		// Output data
		if ($expensescategory->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} elseif ($expensescategory->Export == "email") {
			$this->ExportEmail($ExportDoc->Text);
			$this->Page_Terminate($expensescategory->ExportReturnUrl());
		} elseif ($expensescategory->Export == "pdf") {
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
