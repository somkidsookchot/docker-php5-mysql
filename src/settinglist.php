<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "settinginfo.php" ?>
<?php include_once "administratorinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$setting_list = new csetting_list();
$Page =& $setting_list;

// Page init
$setting_list->Page_Init();

// Page main
$setting_list->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($setting->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var setting_list = new ew_Page("setting_list");

// page properties
setting_list.PageID = "list"; // page ID
setting_list.FormID = "fsettinglist"; // form ID
var EW_PAGE_ID = setting_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
setting_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
setting_list.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
setting_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
setting_list.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<link rel="stylesheet" type="text/css" media="all" href="calendar/calendar-win2k-cold-1.css" title="win2k-1">
<script type="text/javascript" src="calendar/calendar.js"></script>
<script type="text/javascript" src="calendar/lang/calendar-en.js"></script>
<script type="text/javascript" src="calendar/calendar-setup.js"></script>
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
<?php if (($setting->Export == "") || (EW_EXPORT_MASTER_RECORD && $setting->Export == "print")) { ?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$setting_list->TotalRecs = $setting->SelectRecordCount();
	} else {
		if ($setting_list->Recordset = $setting_list->LoadRecordset())
			$setting_list->TotalRecs = $setting_list->Recordset->RecordCount();
	}
	$setting_list->StartRec = 1;
	if ($setting_list->DisplayRecs <= 0 || ($setting->Export <> "" && $setting->ExportAll)) // Display all records
		$setting_list->DisplayRecs = $setting_list->TotalRecs;
	if (!($setting->Export <> "" && $setting->ExportAll))
		$setting_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$setting_list->Recordset = $setting_list->LoadRecordset($setting_list->StartRec-1, $setting_list->DisplayRecs);
?>
<p class="phpmaker ewTitle" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $setting->TableCaption() ?>
&nbsp;&nbsp;<?php $setting_list->ExportOptions->Render("body"); ?>
</p>
<?php $setting_list->ShowPageHeader(); ?>
<?php
$setting_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($setting->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($setting->CurrentAction <> "gridadd" && $setting->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($setting_list->Pager)) $setting_list->Pager = new cPrevNextPager($setting_list->StartRec, $setting_list->DisplayRecs, $setting_list->TotalRecs) ?>
<?php if ($setting_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($setting_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $setting_list->PageUrl() ?>start=<?php echo $setting_list->Pager->FirstButton->Start ?>"><img src="phpimages/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($setting_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $setting_list->PageUrl() ?>start=<?php echo $setting_list->Pager->PrevButton->Start ?>"><img src="phpimages/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $setting_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($setting_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $setting_list->PageUrl() ?>start=<?php echo $setting_list->Pager->NextButton->Start ?>"><img src="phpimages/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($setting_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $setting_list->PageUrl() ?>start=<?php echo $setting_list->Pager->LastButton->Start ?>"><img src="phpimages/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $setting_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $setting_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $setting_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $setting_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($setting_list->SearchWhere == "0=101") { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoRecord") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($setting_list->TotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td><?php echo $Language->Phrase("RecordsPerPage") ?>&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="setting">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();">
<option value="10"<?php if ($setting_list->DisplayRecs == 10) { ?> selected="selected"<?php } ?>>10</option>
<option value="20"<?php if ($setting_list->DisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="50"<?php if ($setting_list->DisplayRecs == 50) { ?> selected="selected"<?php } ?>>50</option>
<option value="100"<?php if ($setting_list->DisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="200"<?php if ($setting_list->DisplayRecs == 200) { ?> selected="selected"<?php } ?>>200</option>
<option value="300"<?php if ($setting_list->DisplayRecs == 300) { ?> selected="selected"<?php } ?>>300</option>
<option value="500"<?php if ($setting_list->DisplayRecs == 500) { ?> selected="selected"<?php } ?>>500</option>
<option value="700"<?php if ($setting_list->DisplayRecs == 700) { ?> selected="selected"<?php } ?>>700</option>
<option value="1000"<?php if ($setting_list->DisplayRecs == 1000) { ?> selected="selected"<?php } ?>>1000</option>
<option value="ALL"<?php if ($setting->getRecordsPerPage() == -1) { ?> selected="selected"<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<span class="phpmaker">
<?php if ($Security->IsLoggedIn()) { ?>
<a class="ewGridLink" href="<?php echo $setting_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
<?php if ($setting_list->TotalRecs > 0) { ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a class="ewGridLink" href="" onclick="ew_SubmitSelected(document.fsettinglist, '<?php echo $setting_list->MultiDeleteUrl ?>');return false;"><?php echo $Language->Phrase("DeleteSelectedLink") ?></a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
</span>
</div>
<?php } ?>
<form name="fsettinglist" id="fsettinglist" class="ewForm" action="" method="post">
<input type="hidden" name="t" id="t" value="setting">
<div id="gmp_setting" class="ewGridMiddlePanel">
<?php if ($setting_list->TotalRecs > 0) { ?>
<table cellspacing="0" data-rowhighlightclass="ewTableHighlightRow" data-rowselectclass="ewTableSelectRow" data-roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $setting->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$setting_list->RenderListOptions();

// Render list options (header, left)
$setting_list->ListOptions->Render("header", "left");
?>
<?php if ($setting->regis_rate->Visible) { // regis_rate ?>
	<?php if ($setting->SortUrl($setting->regis_rate) == "") { ?>
		<td style="white-space: nowrap;"><?php echo $setting->regis_rate->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $setting->SortUrl($setting->regis_rate) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><thead><tr><td><?php echo $setting->regis_rate->FldCaption() ?></td><td style="width: 10px;"><?php if ($setting->regis_rate->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($setting->regis_rate->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($setting->annual_rate->Visible) { // annual_rate ?>
	<?php if ($setting->SortUrl($setting->annual_rate) == "") { ?>
		<td style="white-space: nowrap;"><?php echo $setting->annual_rate->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $setting->SortUrl($setting->annual_rate) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><thead><tr><td><?php echo $setting->annual_rate->FldCaption() ?></td><td style="width: 10px;"><?php if ($setting->annual_rate->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($setting->annual_rate->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($setting->subvention_rate->Visible) { // subvention_rate ?>
	<?php if ($setting->SortUrl($setting->subvention_rate) == "") { ?>
		<td style="white-space: nowrap;"><?php echo $setting->subvention_rate->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $setting->SortUrl($setting->subvention_rate) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><thead><tr><td><?php echo $setting->subvention_rate->FldCaption() ?></td><td style="width: 10px;"><?php if ($setting->subvention_rate->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($setting->subvention_rate->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($setting->assc_percent->Visible) { // assc_percent ?>
	<?php if ($setting->SortUrl($setting->assc_percent) == "") { ?>
		<td style="white-space: nowrap;"><?php echo $setting->assc_percent->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $setting->SortUrl($setting->assc_percent) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><thead><tr><td><?php echo $setting->assc_percent->FldCaption() ?></td><td style="width: 10px;"><?php if ($setting->assc_percent->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($setting->assc_percent->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($setting->max_subvention->Visible) { // max_subvention ?>
	<?php if ($setting->SortUrl($setting->max_subvention) == "") { ?>
		<td style="white-space: nowrap;"><?php echo $setting->max_subvention->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $setting->SortUrl($setting->max_subvention) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><thead><tr><td><?php echo $setting->max_subvention->FldCaption() ?></td><td style="width: 10px;"><?php if ($setting->max_subvention->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($setting->max_subvention->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($setting->min_advance_subv->Visible) { // min_advance_subv ?>
	<?php if ($setting->SortUrl($setting->min_advance_subv) == "") { ?>
		<td style="white-space: nowrap;"><?php echo $setting->min_advance_subv->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $setting->SortUrl($setting->min_advance_subv) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><thead><tr><td><?php echo $setting->min_advance_subv->FldCaption() ?></td><td style="width: 10px;"><?php if ($setting->min_advance_subv->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($setting->min_advance_subv->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($setting->max_advance_subv->Visible) { // max_advance_subv ?>
	<?php if ($setting->SortUrl($setting->max_advance_subv) == "") { ?>
		<td style="white-space: nowrap;"><?php echo $setting->max_advance_subv->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $setting->SortUrl($setting->max_advance_subv) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><thead><tr><td><?php echo $setting->max_advance_subv->FldCaption() ?></td><td style="width: 10px;"><?php if ($setting->max_advance_subv->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($setting->max_advance_subv->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($setting->max_age->Visible) { // max_age ?>
	<?php if ($setting->SortUrl($setting->max_age) == "") { ?>
		<td style="white-space: nowrap;"><?php echo $setting->max_age->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $setting->SortUrl($setting->max_age) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><thead><tr><td><?php echo $setting->max_age->FldCaption() ?></td><td style="width: 10px;"><?php if ($setting->max_age->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($setting->max_age->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($setting->chairman_name->Visible) { // chairman_name ?>
	<?php if ($setting->SortUrl($setting->chairman_name) == "") { ?>
		<td style="white-space: nowrap;"><?php echo $setting->chairman_name->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $setting->SortUrl($setting->chairman_name) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><thead><tr><td><?php echo $setting->chairman_name->FldCaption() ?></td><td style="width: 10px;"><?php if ($setting->chairman_name->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($setting->chairman_name->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($setting->chairman_signature->Visible) { // chairman_signature ?>
	<?php if ($setting->SortUrl($setting->chairman_signature) == "") { ?>
		<td style="white-space: nowrap;"><?php echo $setting->chairman_signature->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $setting->SortUrl($setting->chairman_signature) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><thead><tr><td><?php echo $setting->chairman_signature->FldCaption() ?></td><td style="width: 10px;"><?php if ($setting->chairman_signature->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($setting->chairman_signature->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($setting->receiver_name->Visible) { // receiver_name ?>
	<?php if ($setting->SortUrl($setting->receiver_name) == "") { ?>
		<td style="white-space: nowrap;"><?php echo $setting->receiver_name->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $setting->SortUrl($setting->receiver_name) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><thead><tr><td><?php echo $setting->receiver_name->FldCaption() ?></td><td style="width: 10px;"><?php if ($setting->receiver_name->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($setting->receiver_name->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($setting->receiver_signature->Visible) { // receiver_signature ?>
	<?php if ($setting->SortUrl($setting->receiver_signature) == "") { ?>
		<td style="white-space: nowrap;"><?php echo $setting->receiver_signature->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $setting->SortUrl($setting->receiver_signature) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><thead><tr><td><?php echo $setting->receiver_signature->FldCaption() ?></td><td style="width: 10px;"><?php if ($setting->receiver_signature->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($setting->receiver_signature->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($setting->notice_duedate->Visible) { // notice_duedate ?>
	<?php if ($setting->SortUrl($setting->notice_duedate) == "") { ?>
		<td style="white-space: nowrap;"><?php echo $setting->notice_duedate->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $setting->SortUrl($setting->notice_duedate) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><thead><tr><td><?php echo $setting->notice_duedate->FldCaption() ?></td><td style="width: 10px;"><?php if ($setting->notice_duedate->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($setting->notice_duedate->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($setting->invoice_duedate->Visible) { // invoice_duedate ?>
	<?php if ($setting->SortUrl($setting->invoice_duedate) == "") { ?>
		<td style="white-space: nowrap;"><?php echo $setting->invoice_duedate->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $setting->SortUrl($setting->invoice_duedate) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><thead><tr><td><?php echo $setting->invoice_duedate->FldCaption() ?></td><td style="width: 10px;"><?php if ($setting->invoice_duedate->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($setting->invoice_duedate->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($setting->annual_fee_duedate->Visible) { // annual_fee_duedate ?>
	<?php if ($setting->SortUrl($setting->annual_fee_duedate) == "") { ?>
		<td style="white-space: nowrap;"><?php echo $setting->annual_fee_duedate->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $setting->SortUrl($setting->annual_fee_duedate) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><thead><tr><td><?php echo $setting->annual_fee_duedate->FldCaption() ?></td><td style="width: 10px;"><?php if ($setting->annual_fee_duedate->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($setting->annual_fee_duedate->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$setting_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($setting->ExportAll && $setting->Export <> "") {
	$setting_list->StopRec = $setting_list->TotalRecs;
} else {

	// Set the last record to display
	if ($setting_list->TotalRecs > $setting_list->StartRec + $setting_list->DisplayRecs - 1)
		$setting_list->StopRec = $setting_list->StartRec + $setting_list->DisplayRecs - 1;
	else
		$setting_list->StopRec = $setting_list->TotalRecs;
}
$setting_list->RecCnt = $setting_list->StartRec - 1;
if ($setting_list->Recordset && !$setting_list->Recordset->EOF) {
	$setting_list->Recordset->MoveFirst();
	if (!$bSelectLimit && $setting_list->StartRec > 1)
		$setting_list->Recordset->Move($setting_list->StartRec - 1);
} elseif (!$setting->AllowAddDeleteRow && $setting_list->StopRec == 0) {
	$setting_list->StopRec = $setting->GridAddRowCount;
}

// Initialize aggregate
$setting->RowType = EW_ROWTYPE_AGGREGATEINIT;
$setting->ResetAttrs();
$setting_list->RenderRow();
$setting_list->RowCnt = 0;
while ($setting_list->RecCnt < $setting_list->StopRec) {
	$setting_list->RecCnt++;
	if (intval($setting_list->RecCnt) >= intval($setting_list->StartRec)) {
		$setting_list->RowCnt++;

		// Set up key count
		$setting_list->KeyCount = $setting_list->RowIndex;

		// Init row class and style
		$setting->ResetAttrs();
		$setting->CssClass = "";
		if ($setting->CurrentAction == "gridadd") {
		} else {
			$setting_list->LoadRowValues($setting_list->Recordset); // Load row values
		}
		$setting->RowType = EW_ROWTYPE_VIEW; // Render view
		$setting->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');

		// Render row
		$setting_list->RenderRow();

		// Render list options
		$setting_list->RenderListOptions();
?>
	<tr<?php echo $setting->RowAttributes() ?>>
<?php

// Render list options (body, left)
$setting_list->ListOptions->Render("body", "left");
?>
	<?php if ($setting->regis_rate->Visible) { // regis_rate ?>
		<td<?php echo $setting->regis_rate->CellAttributes() ?>>
<div<?php echo $setting->regis_rate->ViewAttributes() ?>><?php echo $setting->regis_rate->ListViewValue() ?></div>
<a name="<?php echo $setting_list->PageObjName . "_row_" . $setting_list->RowCnt ?>" id="<?php echo $setting_list->PageObjName . "_row_" . $setting_list->RowCnt ?>"></a></td>
	<?php } ?>
	<?php if ($setting->annual_rate->Visible) { // annual_rate ?>
		<td<?php echo $setting->annual_rate->CellAttributes() ?>>
<div<?php echo $setting->annual_rate->ViewAttributes() ?>><?php echo $setting->annual_rate->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($setting->subvention_rate->Visible) { // subvention_rate ?>
		<td<?php echo $setting->subvention_rate->CellAttributes() ?>>
<div<?php echo $setting->subvention_rate->ViewAttributes() ?>><?php echo $setting->subvention_rate->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($setting->assc_percent->Visible) { // assc_percent ?>
		<td<?php echo $setting->assc_percent->CellAttributes() ?>>
<div<?php echo $setting->assc_percent->ViewAttributes() ?>><?php echo $setting->assc_percent->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($setting->max_subvention->Visible) { // max_subvention ?>
		<td<?php echo $setting->max_subvention->CellAttributes() ?>>
<div<?php echo $setting->max_subvention->ViewAttributes() ?>><?php echo $setting->max_subvention->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($setting->min_advance_subv->Visible) { // min_advance_subv ?>
		<td<?php echo $setting->min_advance_subv->CellAttributes() ?>>
<div<?php echo $setting->min_advance_subv->ViewAttributes() ?>><?php echo $setting->min_advance_subv->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($setting->max_advance_subv->Visible) { // max_advance_subv ?>
		<td<?php echo $setting->max_advance_subv->CellAttributes() ?>>
<div<?php echo $setting->max_advance_subv->ViewAttributes() ?>><?php echo $setting->max_advance_subv->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($setting->max_age->Visible) { // max_age ?>
		<td<?php echo $setting->max_age->CellAttributes() ?>>
<div<?php echo $setting->max_age->ViewAttributes() ?>><?php echo $setting->max_age->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($setting->chairman_name->Visible) { // chairman_name ?>
		<td<?php echo $setting->chairman_name->CellAttributes() ?>>
<div<?php echo $setting->chairman_name->ViewAttributes() ?>><?php echo $setting->chairman_name->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($setting->chairman_signature->Visible) { // chairman_signature ?>
		<td<?php echo $setting->chairman_signature->CellAttributes() ?>>
<?php if ($setting->chairman_signature->LinkAttributes() <> "") { ?>
<?php if (!empty($setting->chairman_signature->Upload->DbValue)) { ?>
<img src="ewbv8.php?fn=<?php echo urlencode(ew_IncludeTrailingDelimiter($setting->chairman_signature->UploadPath, FALSE) . $setting->chairman_signature->Upload->DbValue) ?>&width=<?php echo $setting->chairman_signature->ImageWidth ?>&height=<?php echo $setting->chairman_signature->ImageHeight ?>" border=0<?php echo $setting->chairman_signature->ViewAttributes() ?>>
<?php } elseif (!in_array($setting->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } else { ?>
<?php if (!empty($setting->chairman_signature->Upload->DbValue)) { ?>
<img src="ewbv8.php?fn=<?php echo urlencode(ew_IncludeTrailingDelimiter($setting->chairman_signature->UploadPath, FALSE) . $setting->chairman_signature->Upload->DbValue) ?>&width=<?php echo $setting->chairman_signature->ImageWidth ?>&height=<?php echo $setting->chairman_signature->ImageHeight ?>" border=0<?php echo $setting->chairman_signature->ViewAttributes() ?>>
<?php } elseif (!in_array($setting->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($setting->receiver_name->Visible) { // receiver_name ?>
		<td<?php echo $setting->receiver_name->CellAttributes() ?>>
<div<?php echo $setting->receiver_name->ViewAttributes() ?>><?php echo $setting->receiver_name->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($setting->receiver_signature->Visible) { // receiver_signature ?>
		<td<?php echo $setting->receiver_signature->CellAttributes() ?>>
<?php if ($setting->receiver_signature->LinkAttributes() <> "") { ?>
<?php if (!empty($setting->receiver_signature->Upload->DbValue)) { ?>
<img src="ewbv8.php?fn=<?php echo urlencode(ew_IncludeTrailingDelimiter($setting->receiver_signature->UploadPath, FALSE) . $setting->receiver_signature->Upload->DbValue) ?>&width=<?php echo $setting->receiver_signature->ImageWidth ?>&height=<?php echo $setting->receiver_signature->ImageHeight ?>" border=0<?php echo $setting->receiver_signature->ViewAttributes() ?>>
<?php } elseif (!in_array($setting->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } else { ?>
<?php if (!empty($setting->receiver_signature->Upload->DbValue)) { ?>
<img src="ewbv8.php?fn=<?php echo urlencode(ew_IncludeTrailingDelimiter($setting->receiver_signature->UploadPath, FALSE) . $setting->receiver_signature->Upload->DbValue) ?>&width=<?php echo $setting->receiver_signature->ImageWidth ?>&height=<?php echo $setting->receiver_signature->ImageHeight ?>" border=0<?php echo $setting->receiver_signature->ViewAttributes() ?>>
<?php } elseif (!in_array($setting->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($setting->notice_duedate->Visible) { // notice_duedate ?>
		<td<?php echo $setting->notice_duedate->CellAttributes() ?>>
<div<?php echo $setting->notice_duedate->ViewAttributes() ?>><?php echo $setting->notice_duedate->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($setting->invoice_duedate->Visible) { // invoice_duedate ?>
		<td<?php echo $setting->invoice_duedate->CellAttributes() ?>>
<div<?php echo $setting->invoice_duedate->ViewAttributes() ?>><?php echo $setting->invoice_duedate->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($setting->annual_fee_duedate->Visible) { // annual_fee_duedate ?>
		<td<?php echo $setting->annual_fee_duedate->CellAttributes() ?>>
<div<?php echo $setting->annual_fee_duedate->ViewAttributes() ?>><?php echo $setting->annual_fee_duedate->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$setting_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($setting->CurrentAction <> "gridadd")
		$setting_list->Recordset->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($setting_list->Recordset)
	$setting_list->Recordset->Close();
?>
<?php if ($setting_list->TotalRecs > 0) { ?>
<?php if ($setting->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($setting->CurrentAction <> "gridadd" && $setting->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($setting_list->Pager)) $setting_list->Pager = new cPrevNextPager($setting_list->StartRec, $setting_list->DisplayRecs, $setting_list->TotalRecs) ?>
<?php if ($setting_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($setting_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $setting_list->PageUrl() ?>start=<?php echo $setting_list->Pager->FirstButton->Start ?>"><img src="phpimages/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($setting_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $setting_list->PageUrl() ?>start=<?php echo $setting_list->Pager->PrevButton->Start ?>"><img src="phpimages/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $setting_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($setting_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $setting_list->PageUrl() ?>start=<?php echo $setting_list->Pager->NextButton->Start ?>"><img src="phpimages/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($setting_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $setting_list->PageUrl() ?>start=<?php echo $setting_list->Pager->LastButton->Start ?>"><img src="phpimages/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $setting_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $setting_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $setting_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $setting_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($setting_list->SearchWhere == "0=101") { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoRecord") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($setting_list->TotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td><?php echo $Language->Phrase("RecordsPerPage") ?>&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="setting">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();">
<option value="10"<?php if ($setting_list->DisplayRecs == 10) { ?> selected="selected"<?php } ?>>10</option>
<option value="20"<?php if ($setting_list->DisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="50"<?php if ($setting_list->DisplayRecs == 50) { ?> selected="selected"<?php } ?>>50</option>
<option value="100"<?php if ($setting_list->DisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="200"<?php if ($setting_list->DisplayRecs == 200) { ?> selected="selected"<?php } ?>>200</option>
<option value="300"<?php if ($setting_list->DisplayRecs == 300) { ?> selected="selected"<?php } ?>>300</option>
<option value="500"<?php if ($setting_list->DisplayRecs == 500) { ?> selected="selected"<?php } ?>>500</option>
<option value="700"<?php if ($setting_list->DisplayRecs == 700) { ?> selected="selected"<?php } ?>>700</option>
<option value="1000"<?php if ($setting_list->DisplayRecs == 1000) { ?> selected="selected"<?php } ?>>1000</option>
<option value="ALL"<?php if ($setting->getRecordsPerPage() == -1) { ?> selected="selected"<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<span class="phpmaker">
<?php if ($Security->IsLoggedIn()) { ?>
<a class="ewGridLink" href="<?php echo $setting_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
<?php if ($setting_list->TotalRecs > 0) { ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a class="ewGridLink" href="" onclick="ew_SubmitSelected(document.fsettinglist, '<?php echo $setting_list->MultiDeleteUrl ?>');return false;"><?php echo $Language->Phrase("DeleteSelectedLink") ?></a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
</span>
</div>
<?php } ?>
<?php } ?>
</td></tr></table>
<?php if ($setting->Export == "" && $setting->CurrentAction == "") { ?>
<script type="text/javascript">
<!--
ew_ToggleSearchPanel(setting_list); // Init search panel as collapsed

//-->
</script>
<?php } ?>
<?php
$setting_list->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($setting->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$setting_list->Page_Terminate();
?>
<?php

//
// Page class
//
class csetting_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'setting';

	// Page object name
	var $PageObjName = 'setting_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $setting;
		if ($setting->UseTokenInUrl) $PageUrl .= "t=" . $setting->TableVar . "&"; // Add page token
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
		global $objForm, $setting;
		if ($setting->UseTokenInUrl) {
			if ($objForm)
				return ($setting->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($setting->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function csetting_list() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (setting)
		if (!isset($GLOBALS["setting"])) {
			$GLOBALS["setting"] = new csetting();
			$GLOBALS["Table"] =& $GLOBALS["setting"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf";
		$this->AddUrl = "settingadd.php";
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "settingdelete.php";
		$this->MultiUpdateUrl = "settingupdate.php";

		// Table object (administrator)
		if (!isset($GLOBALS['administrator'])) $GLOBALS['administrator'] = new cadministrator();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'setting', TRUE);

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
		global $setting;

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
			$setting->Export = $_GET["export"];
		} elseif (ew_IsHttpPost()) {
			if (@$_POST["exporttype"] <> "")
				$setting->Export = $_POST["exporttype"];
		} else {
			$setting->setExportReturnUrl(ew_CurrentUrl());
		}
		$gsExport = $setting->Export; // Get export parameter, used in header
		$gsExportFile = $setting->TableVar; // Get export file, used in header
		$Charset = (EW_CHARSET <> "") ? ";charset=" . EW_CHARSET : ""; // Charset used in header
		if ($setting->Export == "excel") {
			header('Content-Type: application/vnd.ms-excel' . $Charset);
			header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
		}
		if ($setting->Export == "word") {
			header('Content-Type: application/vnd.ms-word' . $Charset);
			header('Content-Disposition: attachment; filename=' . $gsExportFile .'.doc');
		}

		// Get grid add count
		$gridaddcnt = @$_GET[EW_TABLE_GRID_ADD_ROW_COUNT];
		if (is_numeric($gridaddcnt) && $gridaddcnt > 0)
			$setting->GridAddRowCount = $gridaddcnt;

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
		global $objForm, $Language, $gsFormError, $gsSearchError, $Security, $setting;

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
			if ($setting->Export <> "" ||
				$setting->CurrentAction == "gridadd" ||
				$setting->CurrentAction == "gridedit") {
				$this->ListOptions->HideAllOptions();
				$this->ExportOptions->HideAllOptions();
			}

			// Set up sorting order
			$this->SetUpSortOrder();
		}

		// Restore display records
		if ($setting->getRecordsPerPage() <> "") {
			$this->DisplayRecs = $setting->getRecordsPerPage(); // Restore from Session
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
		$setting->setSessionWhere($sFilter);
		$setting->CurrentFilter = "";

		// Export data only
		if (in_array($setting->Export, array("html","word","excel","xml","csv","email","pdf"))) {
			$this->ExportData();
			if ($setting->Export <> "email")
				$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	// Set up number of records displayed per page
	function SetUpDisplayRecs() {
		global $setting;
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
			$setting->setRecordsPerPage($this->DisplayRecs); // Save to Session

			// Reset start position
			$this->StartRec = 1;
			$setting->setStartRecordNumber($this->StartRec);
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $setting;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$setting->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$setting->CurrentOrderType = @$_GET["ordertype"];
			$setting->UpdateSort($setting->regis_rate); // regis_rate
			$setting->UpdateSort($setting->annual_rate); // annual_rate
			$setting->UpdateSort($setting->subvention_rate); // subvention_rate
			$setting->UpdateSort($setting->assc_percent); // assc_percent
			$setting->UpdateSort($setting->max_subvention); // max_subvention
			$setting->UpdateSort($setting->min_advance_subv); // min_advance_subv
			$setting->UpdateSort($setting->max_advance_subv); // max_advance_subv
			$setting->UpdateSort($setting->max_age); // max_age
			$setting->UpdateSort($setting->chairman_name); // chairman_name
			$setting->UpdateSort($setting->chairman_signature); // chairman_signature
			$setting->UpdateSort($setting->receiver_name); // receiver_name
			$setting->UpdateSort($setting->receiver_signature); // receiver_signature
			$setting->UpdateSort($setting->notice_duedate); // notice_duedate
			$setting->UpdateSort($setting->invoice_duedate); // invoice_duedate
			$setting->UpdateSort($setting->annual_fee_duedate); // annual_fee_duedate
			$setting->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $setting;
		$sOrderBy = $setting->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($setting->SqlOrderBy() <> "") {
				$sOrderBy = $setting->SqlOrderBy();
				$setting->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $setting;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$setting->setSessionOrderBy($sOrderBy);
				$setting->regis_rate->setSort("");
				$setting->annual_rate->setSort("");
				$setting->subvention_rate->setSort("");
				$setting->assc_percent->setSort("");
				$setting->max_subvention->setSort("");
				$setting->min_advance_subv->setSort("");
				$setting->max_advance_subv->setSort("");
				$setting->max_age->setSort("");
				$setting->chairman_name->setSort("");
				$setting->chairman_signature->setSort("");
				$setting->receiver_name->setSort("");
				$setting->receiver_signature->setSort("");
				$setting->notice_duedate->setSort("");
				$setting->invoice_duedate->setSort("");
				$setting->annual_fee_duedate->setSort("");
			}

			// Reset start position
			$this->StartRec = 1;
			$setting->setStartRecordNumber($this->StartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $Language, $setting;

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
		$item->Header = "<input type=\"checkbox\" name=\"key\" id=\"key\" class=\"phpmaker\" onclick=\"setting_list.SelectAllKey(this);\">";
		$item->MoveTo(0);

		// Call ListOptions_Load event
		$this->ListOptions_Load();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $setting, $objForm;
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
			$oListOpt->Body = "<input type=\"checkbox\" name=\"key_m[]\" id=\"key_m[]\" value=\"" . ew_HtmlEncode($setting->setting_id->CurrentValue) . "\" class=\"phpmaker\" onclick='ew_ClickMultiCheckbox(this);'>";
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	function RenderListOptionsExt() {
		global $Security, $Language, $setting;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $setting;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$setting->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$setting->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $setting->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$setting->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$setting->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$setting->setStartRecordNumber($this->StartRec);
		}
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $setting;

		// Call Recordset Selecting event
		$setting->Recordset_Selecting($setting->CurrentFilter);

		// Load List page SQL
		$sSql = $setting->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$setting->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $setting;
		$sFilter = $setting->KeyFilter();

		// Call Row Selecting event
		$setting->Row_Selecting($sFilter);

		// Load SQL based on filter
		$setting->CurrentFilter = $sFilter;
		$sSql = $setting->SQL();
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
		global $conn, $setting;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$setting->Row_Selected($row);
		$setting->setting_id->setDbValue($rs->fields('setting_id'));
		$setting->regis_rate->setDbValue($rs->fields('regis_rate'));
		$setting->annual_rate->setDbValue($rs->fields('annual_rate'));
		$setting->subvention_rate->setDbValue($rs->fields('subvention_rate'));
		$setting->assc_percent->setDbValue($rs->fields('assc_percent'));
		$setting->max_subvention->setDbValue($rs->fields('max_subvention'));
		$setting->rc_rate->setDbValue($rs->fields('rc_rate'));
		$setting->min_advance_subv->setDbValue($rs->fields('min_advance_subv'));
		$setting->max_advance_subv->setDbValue($rs->fields('max_advance_subv'));
		$setting->quoted_advance_subv->setDbValue($rs->fields('quoted_advance_subv'));
		$setting->max_age->setDbValue($rs->fields('max_age'));
		$setting->chairman_name->setDbValue($rs->fields('chairman_name'));
		$setting->chairman_signature->Upload->DbValue = $rs->fields('chairman_signature');
		$setting->receiver_name->setDbValue($rs->fields('receiver_name'));
		$setting->receiver_signature->Upload->DbValue = $rs->fields('receiver_signature');
		$setting->logo->Upload->DbValue = $rs->fields('logo');
		$setting->notice_duedate->setDbValue($rs->fields('notice_duedate'));
		$setting->invoice_duedate->setDbValue($rs->fields('invoice_duedate'));
		$setting->contact_info->setDbValue($rs->fields('contact_info'));
		$setting->annual_fee_duedate->setDbValue($rs->fields('annual_fee_duedate'));
	}

	// Load old record
	function LoadOldRecord() {
		global $setting;

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($setting->getKey("setting_id")) <> "")
			$setting->setting_id->CurrentValue = $setting->getKey("setting_id"); // setting_id
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$setting->CurrentFilter = $setting->KeyFilter();
			$sSql = $setting->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		} else {
			$this->OldRecordset = NULL;
		}
		return $bValidKey;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $setting;

		// Initialize URLs
		$this->ViewUrl = $setting->ViewUrl();
		$this->EditUrl = $setting->EditUrl();
		$this->InlineEditUrl = $setting->InlineEditUrl();
		$this->CopyUrl = $setting->CopyUrl();
		$this->InlineCopyUrl = $setting->InlineCopyUrl();
		$this->DeleteUrl = $setting->DeleteUrl();

		// Call Row_Rendering event
		$setting->Row_Rendering();

		// Common render codes for all row types
		// setting_id

		$setting->setting_id->CellCssStyle = "white-space: nowrap;";

		// regis_rate
		$setting->regis_rate->CellCssStyle = "white-space: nowrap;";

		// annual_rate
		$setting->annual_rate->CellCssStyle = "white-space: nowrap;";

		// subvention_rate
		$setting->subvention_rate->CellCssStyle = "white-space: nowrap;";

		// assc_percent
		$setting->assc_percent->CellCssStyle = "white-space: nowrap;";

		// max_subvention
		$setting->max_subvention->CellCssStyle = "white-space: nowrap;";

		// rc_rate
		$setting->rc_rate->CellCssStyle = "white-space: nowrap;";

		// min_advance_subv
		$setting->min_advance_subv->CellCssStyle = "white-space: nowrap;";

		// max_advance_subv
		$setting->max_advance_subv->CellCssStyle = "white-space: nowrap;";

		// quoted_advance_subv
		$setting->quoted_advance_subv->CellCssStyle = "white-space: nowrap;";

		// max_age
		$setting->max_age->CellCssStyle = "white-space: nowrap;";

		// chairman_name
		$setting->chairman_name->CellCssStyle = "white-space: nowrap;";

		// chairman_signature
		$setting->chairman_signature->CellCssStyle = "white-space: nowrap;";

		// receiver_name
		$setting->receiver_name->CellCssStyle = "white-space: nowrap;";

		// receiver_signature
		$setting->receiver_signature->CellCssStyle = "white-space: nowrap;";

		// logo
		$setting->logo->CellCssStyle = "white-space: nowrap;";

		// notice_duedate
		$setting->notice_duedate->CellCssStyle = "white-space: nowrap;";

		// invoice_duedate
		$setting->invoice_duedate->CellCssStyle = "white-space: nowrap;";

		// contact_info
		$setting->contact_info->CellCssStyle = "white-space: nowrap;";

		// annual_fee_duedate
		$setting->annual_fee_duedate->CellCssStyle = "white-space: nowrap;";
		if ($setting->RowType == EW_ROWTYPE_VIEW) { // View row

			// regis_rate
			$setting->regis_rate->ViewValue = $setting->regis_rate->CurrentValue;
			$setting->regis_rate->ViewCustomAttributes = "";

			// annual_rate
			$setting->annual_rate->ViewValue = $setting->annual_rate->CurrentValue;
			$setting->annual_rate->ViewCustomAttributes = "";

			// subvention_rate
			$setting->subvention_rate->ViewValue = $setting->subvention_rate->CurrentValue;
			$setting->subvention_rate->ViewCustomAttributes = "";

			// assc_percent
			$setting->assc_percent->ViewValue = $setting->assc_percent->CurrentValue;
			$setting->assc_percent->ViewCustomAttributes = "";

			// max_subvention
			$setting->max_subvention->ViewValue = $setting->max_subvention->CurrentValue;
			$setting->max_subvention->ViewCustomAttributes = "";

			// min_advance_subv
			$setting->min_advance_subv->ViewValue = $setting->min_advance_subv->CurrentValue;
			$setting->min_advance_subv->ViewCustomAttributes = "";

			// max_advance_subv
			$setting->max_advance_subv->ViewValue = $setting->max_advance_subv->CurrentValue;
			$setting->max_advance_subv->ViewCustomAttributes = "";

			// max_age
			$setting->max_age->ViewValue = $setting->max_age->CurrentValue;
			$setting->max_age->ViewCustomAttributes = "";

			// chairman_name
			$setting->chairman_name->ViewValue = $setting->chairman_name->CurrentValue;
			$setting->chairman_name->ViewCustomAttributes = "";

			// chairman_signature
			if (!ew_Empty($setting->chairman_signature->Upload->DbValue)) {
				$setting->chairman_signature->ViewValue = $setting->chairman_signature->Upload->DbValue;
				$setting->chairman_signature->ImageWidth = 120;
				$setting->chairman_signature->ImageHeight = 0;
				$setting->chairman_signature->ImageAlt = $setting->chairman_signature->FldAlt();
			} else {
				$setting->chairman_signature->ViewValue = "";
			}
			$setting->chairman_signature->ViewCustomAttributes = "";

			// receiver_name
			$setting->receiver_name->ViewValue = $setting->receiver_name->CurrentValue;
			$setting->receiver_name->ViewCustomAttributes = "";

			// receiver_signature
			if (!ew_Empty($setting->receiver_signature->Upload->DbValue)) {
				$setting->receiver_signature->ViewValue = $setting->receiver_signature->Upload->DbValue;
				$setting->receiver_signature->ImageWidth = 120;
				$setting->receiver_signature->ImageHeight = 0;
				$setting->receiver_signature->ImageAlt = $setting->receiver_signature->FldAlt();
			} else {
				$setting->receiver_signature->ViewValue = "";
			}
			$setting->receiver_signature->ViewCustomAttributes = "";

			// notice_duedate
			$setting->notice_duedate->ViewValue = $setting->notice_duedate->CurrentValue;
			$setting->notice_duedate->ViewCustomAttributes = "";

			// invoice_duedate
			$setting->invoice_duedate->ViewValue = $setting->invoice_duedate->CurrentValue;
			$setting->invoice_duedate->ViewCustomAttributes = "";

			// annual_fee_duedate
			$setting->annual_fee_duedate->ViewValue = $setting->annual_fee_duedate->CurrentValue;
			$setting->annual_fee_duedate->ViewValue = ew_FormatDateTime($setting->annual_fee_duedate->ViewValue, 7);
			$setting->annual_fee_duedate->ViewCustomAttributes = "";

			// regis_rate
			$setting->regis_rate->LinkCustomAttributes = "";
			$setting->regis_rate->HrefValue = "";
			$setting->regis_rate->TooltipValue = "";

			// annual_rate
			$setting->annual_rate->LinkCustomAttributes = "";
			$setting->annual_rate->HrefValue = "";
			$setting->annual_rate->TooltipValue = "";

			// subvention_rate
			$setting->subvention_rate->LinkCustomAttributes = "";
			$setting->subvention_rate->HrefValue = "";
			$setting->subvention_rate->TooltipValue = "";

			// assc_percent
			$setting->assc_percent->LinkCustomAttributes = "";
			$setting->assc_percent->HrefValue = "";
			$setting->assc_percent->TooltipValue = "";

			// max_subvention
			$setting->max_subvention->LinkCustomAttributes = "";
			$setting->max_subvention->HrefValue = "";
			$setting->max_subvention->TooltipValue = "";

			// min_advance_subv
			$setting->min_advance_subv->LinkCustomAttributes = "";
			$setting->min_advance_subv->HrefValue = "";
			$setting->min_advance_subv->TooltipValue = "";

			// max_advance_subv
			$setting->max_advance_subv->LinkCustomAttributes = "";
			$setting->max_advance_subv->HrefValue = "";
			$setting->max_advance_subv->TooltipValue = "";

			// max_age
			$setting->max_age->LinkCustomAttributes = "";
			$setting->max_age->HrefValue = "";
			$setting->max_age->TooltipValue = "";

			// chairman_name
			$setting->chairman_name->LinkCustomAttributes = "";
			$setting->chairman_name->HrefValue = "";
			$setting->chairman_name->TooltipValue = "";

			// chairman_signature
			$setting->chairman_signature->LinkCustomAttributes = "";
			$setting->chairman_signature->HrefValue = "";
			$setting->chairman_signature->TooltipValue = "";

			// receiver_name
			$setting->receiver_name->LinkCustomAttributes = "";
			$setting->receiver_name->HrefValue = "";
			$setting->receiver_name->TooltipValue = "";

			// receiver_signature
			$setting->receiver_signature->LinkCustomAttributes = "";
			$setting->receiver_signature->HrefValue = "";
			$setting->receiver_signature->TooltipValue = "";

			// notice_duedate
			$setting->notice_duedate->LinkCustomAttributes = "";
			$setting->notice_duedate->HrefValue = "";
			$setting->notice_duedate->TooltipValue = "";

			// invoice_duedate
			$setting->invoice_duedate->LinkCustomAttributes = "";
			$setting->invoice_duedate->HrefValue = "";
			$setting->invoice_duedate->TooltipValue = "";

			// annual_fee_duedate
			$setting->annual_fee_duedate->LinkCustomAttributes = "";
			$setting->annual_fee_duedate->HrefValue = "";
			$setting->annual_fee_duedate->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($setting->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$setting->Row_Rendered();
	}

	// Set up export options
	function SetupExportOptions() {
		global $Language, $setting;

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
		$item->Body = "<a name=\"emf_setting\" id=\"emf_setting\" href=\"javascript:void(0);\" onclick=\"ew_EmailDialogShow({lnk:'emf_setting',hdr:ewLanguage.Phrase('ExportToEmail'),f:document.fsettinglist,sel:false});\">" . $Language->Phrase("ExportToEmail") . "</a>";
		$item->Visible = FALSE;

		// Hide options for export/action
		if ($setting->Export <> "" ||
			$setting->CurrentAction <> "")
			$this->ExportOptions->HideAllOptions();
	}

	// Export data in HTML/CSV/Word/Excel/XML/Email/PDF format
	function ExportData() {
		global $setting;
		$utf8 = (strtolower(EW_CHARSET) == "utf-8");
		$bSelectLimit = EW_SELECT_LIMIT;

		// Load recordset
		if ($bSelectLimit) {
			$this->TotalRecs = $setting->SelectRecordCount();
		} else {
			if ($rs = $this->LoadRecordset())
				$this->TotalRecs = $rs->RecordCount();
		}
		$this->StartRec = 1;

		// Export all
		if ($setting->ExportAll) {
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
		if ($setting->Export == "xml") {
			$XmlDoc = new cXMLDocument(EW_XML_ENCODING);
			$XmlDoc->XmlDoc->formatOutput = TRUE; // Formatted output
		} else {
			$ExportDoc = new cExportDocument($setting, "h");
		}
		$ParentTable = "";
		if ($bSelectLimit) {
			$StartRec = 1;
			$StopRec = $this->DisplayRecs;
		} else {
			$StartRec = $this->StartRec;
			$StopRec = $this->StopRec;
		}
		if ($setting->Export == "xml") {
			$setting->ExportXmlDocument($XmlDoc, ($ParentTable <> ""), $rs, $StartRec, $StopRec, "");
		} else {
			$sHeader = $this->PageHeader;
			$this->Page_DataRendering($sHeader);
			$ExportDoc->Text .= $sHeader;
			$setting->ExportDocument($ExportDoc, $rs, $StartRec, $StopRec, "");
			$sFooter = $this->PageFooter;
			$this->Page_DataRendered($sFooter);
			$ExportDoc->Text .= $sFooter;
		}

		// Close recordset
		$rs->Close();

		// Export header and footer
		if ($setting->Export <> "xml") {
			$ExportDoc->ExportHeaderAndFooter();
		}

		// Clean output buffer
		if (!EW_DEBUG_ENABLED && ob_get_length())
			ob_end_clean();

		// Write BOM if utf-8
		if ($utf8 && !in_array($setting->Export, array("email", "xml")))
			echo "\xEF\xBB\xBF";

		// Write debug message if enabled
		if (EW_DEBUG_ENABLED)
			echo ew_DebugMsg();

		// Output data
		if ($setting->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} elseif ($setting->Export == "email") {
			$this->ExportEmail($ExportDoc->Text);
			$this->Page_Terminate($setting->ExportReturnUrl());
		} elseif ($setting->Export == "pdf") {
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
