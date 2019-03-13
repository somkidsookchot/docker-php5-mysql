<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "membersinfo.php" ?>
<?php include_once "administratorinfo.php" ?>
<?php include_once "memberupdateloginfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$members_list = new cmembers_list();
$Page =& $members_list;

// Page init
$members_list->Page_Init();

// Page main
$members_list->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($members->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var members_list = new ew_Page("members_list");

// page properties
members_list.PageID = "list"; // page ID
members_list.FormID = "fmemberslist"; // form ID
var EW_PAGE_ID = members_list.PageID; // for backward compatibility

// extend page with ValidateForm function
members_list.ValidateForm = function(fobj) {
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
		elm = fobj.elements["x" + infix + "_prefix"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($members->prefix->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_gender"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($members->gender->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_fname"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($members->fname->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_lname"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($members->lname->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_birthdate"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($members->birthdate->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_birthdate"];
		if (elm && !ew_CheckEuroDate(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($members->birthdate->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_t_code"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($members->t_code->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_village_id"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($members->village_id->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_bnfc1_name"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($members->bnfc1_name->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_bnfc1_rel"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($members->bnfc1_rel->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_regis_date"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($members->regis_date->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_regis_date"];
		if (elm && !ew_CheckEuroDate(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($members->regis_date->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_effective_date"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($members->effective_date->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_effective_date"];
		if (elm && !ew_CheckEuroDate(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($members->effective_date->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_member_status"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($members->member_status->FldCaption()) ?>");

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
	if (fobj.a_list && fobj.a_list.value == "gridinsert" && addcnt == 0) { // No row added
		alert(ewLanguage.Phrase("NoAddRecord"));
		return false;
	}
	return true;
}

// Extend page with empty row check
members_list.EmptyRow = function(fobj, infix) {
	if (ew_ValueChanged(fobj, infix, "member_code", false)) return false;
	if (ew_ValueChanged(fobj, infix, "id_code", false)) return false;
	if (ew_ValueChanged(fobj, infix, "prefix", false)) return false;
	if (ew_ValueChanged(fobj, infix, "gender", false)) return false;
	if (ew_ValueChanged(fobj, infix, "fname", false)) return false;
	if (ew_ValueChanged(fobj, infix, "lname", false)) return false;
	if (ew_ValueChanged(fobj, infix, "birthdate", false)) return false;
	if (ew_ValueChanged(fobj, infix, "age", false)) return false;
	if (ew_ValueChanged(fobj, infix, "t_code", false)) return false;
	if (ew_ValueChanged(fobj, infix, "village_id", false)) return false;
	if (ew_ValueChanged(fobj, infix, "bnfc1_name", false)) return false;
	if (ew_ValueChanged(fobj, infix, "bnfc1_rel", false)) return false;
	if (ew_ValueChanged(fobj, infix, "bnfc2_name", false)) return false;
	if (ew_ValueChanged(fobj, infix, "bnfc2_rel", false)) return false;
	if (ew_ValueChanged(fobj, infix, "bnfc3_name", false)) return false;
	if (ew_ValueChanged(fobj, infix, "bnfc3_rel", false)) return false;
	if (ew_ValueChanged(fobj, infix, "regis_date", false)) return false;
	if (ew_ValueChanged(fobj, infix, "effective_date", false)) return false;
	if (ew_ValueChanged(fobj, infix, "member_status", false)) return false;
	return true;
}

// extend page with validate function for search
members_list.ValidateSearch = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (this.ValidateRequired) {
		var infix = "";
		elm = fobj.elements["x" + infix + "_id_code"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($members->id_code->FldErrMsg()) ?>");

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
members_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
members_list.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
members_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
members_list.ValidateRequired = false; // no JavaScript validation
<?php } ?>

// search highlight properties
members_list.ShowHighlightText = ewLanguage.Phrase("ShowHighlight"); 
members_list.HideHighlightText = ewLanguage.Phrase("HideHighlight");

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
<?php if (($members->Export == "") || (EW_EXPORT_MASTER_RECORD && $members->Export == "print")) { ?>
<?php } ?>
<?php
if ($members->CurrentAction == "gridadd") {
	$members->CurrentFilter = "0=1";
	$members_list->StartRec = 1;
	$members_list->DisplayRecs = $members->GridAddRowCount;
	$members_list->TotalRecs = $members_list->DisplayRecs;
	$members_list->StopRec = $members_list->DisplayRecs;
} else {
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$members_list->TotalRecs = $members->SelectRecordCount();
	} else {
		if ($members_list->Recordset = $members_list->LoadRecordset())
			$members_list->TotalRecs = $members_list->Recordset->RecordCount();
	}
	$members_list->StartRec = 1;
	if ($members_list->DisplayRecs <= 0 || ($members->Export <> "" && $members->ExportAll)) // Display all records
		$members_list->DisplayRecs = $members_list->TotalRecs;
	if (!($members->Export <> "" && $members->ExportAll))
		$members_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$members_list->Recordset = $members_list->LoadRecordset($members_list->StartRec-1, $members_list->DisplayRecs);
}
?>
<div class="ewTitle"><img src="images/im48x48.png" width="40" height="40" align="absmiddle" />&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $members->TableCaption()."".($_GET["x_member_status"] ? "ที่มีสถานะ".$_GET["x_member_status"] : "ทั้งหมด")?>&nbsp;&nbsp; </div>
<div class="clear"></div>
<?php if ($Security->IsLoggedIn()) { ?>
<?php if ($members->Export == "" && $members->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(members_list);" style="text-decoration: none;"><img src="phpimages/collapse.png" alt="" border="0" align="absmiddle" id="members_list_SearchImage"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="members_list_SearchPanel">
<form name="fmemberslistsrch" id="fmemberslistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>" onsubmit="return members_list.ValidateSearch(this);">
<input type="hidden" id="t" name="t" value="members">
<div class="ewBasicSearch">
<?php
if ($gsSearchError == "")
	$members_list->LoadAdvancedSearch(); // Load advanced search

// Render for search
$members->RowType = EW_ROWTYPE_SEARCH;

// Render row
$members->ResetAttrs();
$members_list->RenderRow();
?>

	<span id="xsc_member_code" class="ewCssTableCell">
		<span class="ewSearchCaption"><?php echo $members->member_code->FldCaption() ?></span>
		<span class="ewSearchOprCell"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_member_code" id="z_member_code" value="LIKE"></span>
		<span class="ewSearchField">
<input type="text" name="x_member_code" id="x_member_code" size="30" maxlength="50" value="<?php echo $members->member_code->EditValue ?>"<?php echo $members->member_code->EditAttributes() ?>>
</span>
	</span>


	<span id="xsc_id_code" class="ewCssTableCell">
		<span class="ewSearchCaption"><?php echo $members->id_code->FldCaption() ?></span>
		<span class="ewSearchOprCell"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_id_code" id="z_id_code" value="LIKE"></span>
		<span class="ewSearchField">
<input type="text" name="x_id_code" id="x_id_code" size="13" maxlength="13" value="<?php echo $members->id_code->EditValue ?>"<?php echo $members->id_code->EditAttributes() ?>>
</span>
	</span>
<div class="clear"></div>
<span id="xsc_fname" class="ewCssTableCell">
	  <span class="ewSearchCaption"><?php echo $members->fname->FldCaption() ?></span>
	  <span class="ewSearchOprCell"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_fname" id="z_fname" value="LIKE"></span>
	  <span class="ewSearchField">
<input type="text" name="x_fname" id="x_fname" size="30" maxlength="45" value="<?php echo $members->fname->EditValue ?>"<?php echo $members->fname->EditAttributes() ?>>
</span>
	</span>
<span id="xsc_lname" class="ewCssTableCell">
		<span class="ewSearchCaption"><?php echo $members->lname->FldCaption() ?></span>
		<span class="ewSearchOprCell"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_lname" id="z_lname" value="LIKE"></span>
		<span class="ewSearchField">
<input type="text" name="x_lname" id="x_lname" size="30" maxlength="45" value="<?php echo $members->lname->EditValue ?>"<?php echo $members->lname->EditAttributes() ?>>
</span>
	</span>
<div class="clear"></div>
<span id="xsc_t_code" class="ewCssTableCell">
	  <span class="ewSearchCaption"><?php echo $members->t_code->FldCaption() ?></span>
	  <span class="ewSearchOprCell"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_t_code" id="z_t_code" value="LIKE"></span>
	  <span class="ewSearchField">
<?php $members->t_code->EditAttrs["onchange"] = "ew_UpdateOpt('x_village_id','x_t_code',true); " . @$members->t_code->EditAttrs["onchange"]; ?>
<select id="x_t_code" name="x_t_code"<?php echo $members->t_code->EditAttributes() ?>>
<?php
if (is_array($members->t_code->EditValue)) {
	$arwrk = $members->t_code->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($members->t_code->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
<?php if ($arwrk[$rowcntwrk][2] <> "") { ?>
<?php echo ew_ValueSeparator($rowcntwrk,1,$members->t_code) ?><?php echo $arwrk[$rowcntwrk][2] ?>
<?php } ?>
</option>
<?php
	}
}
if (@$emptywrk) $members->t_code->OldValue = "";
?>
</select>
<?php
$sSqlWrk = "SELECT `t_code`, `t_code` AS `DispFld`, `t_title` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `tambon`";
$sWhereWrk = "";
if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
$sSqlWrk .= " ORDER BY `t_code`";
$sSqlWrk = TEAencrypt($sSqlWrk, EW_RANDOM_KEY);
?>
<input type="hidden" name="s_x_t_code" id="s_x_t_code" value="<?php echo $sSqlWrk; ?>">
<input type="hidden" name="lft_x_t_code" id="lft_x_t_code" value="">
</span>
	</span>
<span id="xsc_village_id" class="ewCssTableCell">
		<span class="ewSearchCaption"><?php echo $members->village_id->FldCaption() ?></span>
		<span class="ewSearchOprCell"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_village_id" id="z_village_id" value="="></span>
		<span class="ewSearchField">
<select id="x_village_id" name="x_village_id"<?php echo $members->village_id->EditAttributes() ?>>
<?php
if (is_array($members->village_id->EditValue)) {
	$arwrk = $members->village_id->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($members->village_id->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
<?php if ($arwrk[$rowcntwrk][2] <> "") { ?>
<?php echo ew_ValueSeparator($rowcntwrk,1,$members->village_id) ?><?php echo $arwrk[$rowcntwrk][2] ?>
<?php } ?>
</option>
<?php
	}
}
if (@$emptywrk) $members->village_id->OldValue = "";
?>
</select>
<?php
$sSqlWrk = "SELECT `village_id`, `v_code` AS `DispFld`, `v_title` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `village`";
$sWhereWrk = "`t_code` IN ({filter_value})";
if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
$sSqlWrk .= " ORDER BY `v_code`";
$sSqlWrk = TEAencrypt($sSqlWrk, EW_RANDOM_KEY);
?>
<input type="hidden" name="s_x_village_id" id="s_x_village_id" value="<?php echo $sSqlWrk; ?>">
<input type="hidden" name="lft_x_village_id" id="lft_x_village_id" value="3">
</span>
	</span>
<span id="xsc_member_status" class="ewCssTableCell">
		<span class="ewSearchCaption"><?php echo $members->member_status->FldCaption() ?></span>
		<span class="ewSearchOprCell"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_member_status" id="z_member_status" value="LIKE"></span>
		<span class="ewSearchField">
<select id="x_member_status" name="x_member_status"<?php echo $members->member_status->EditAttributes() ?>>
<?php
if (is_array($members->member_status->EditValue)) {
	$arwrk = $members->member_status->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($members->member_status->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
if (@$emptywrk) $members->member_status->OldValue = "";
?>
</select>
<?php
$sSqlWrk = "SELECT `s_title`, `s_title` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `memberstatus`";
$sWhereWrk = "";
if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
$sSqlWrk = TEAencrypt($sSqlWrk, EW_RANDOM_KEY);
?>
<input type="hidden" name="s_x_member_status" id="s_x_member_status" value="<?php echo $sSqlWrk; ?>">
<input type="hidden" name="lft_x_member_status" id="lft_x_member_status" value="">
</span>
	</span>

<div id="xsr_8" class="ewCssTableRow">
	<input type="Submit" name="Submit" id="Submit" value="<?php echo ew_BtnCaption($Language->Phrase("QuickSearchBtn")) ?>">&nbsp;
	<a href="<?php echo $members_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
	<?php if ($members_list->SearchWhere <> "" && $members_list->TotalRecs > 0) { ?>
	<a href="javascript:void(0);" onclick="ew_ToggleHighlight(members_list, this, '<?php echo $members->HighlightName() ?>');"><?php echo $Language->Phrase("HideHighlight") ?></a>
	<?php } ?>
</div>
</div>
</form>
</div>
<?php } ?>
<?php } ?>
<?php $members_list->ShowPageHeader(); ?>
<br />
<?php
$members_list->ShowMessage();
?>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($members->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($members->CurrentAction <> "gridadd" && $members->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($members_list->Pager)) $members_list->Pager = new cPrevNextPager($members_list->StartRec, $members_list->DisplayRecs, $members_list->TotalRecs) ?>
<?php if ($members_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($members_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $members_list->PageUrl() ?>start=<?php echo $members_list->Pager->FirstButton->Start ?>"><img src="phpimages/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($members_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $members_list->PageUrl() ?>start=<?php echo $members_list->Pager->PrevButton->Start ?>"><img src="phpimages/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $members_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($members_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $members_list->PageUrl() ?>start=<?php echo $members_list->Pager->NextButton->Start ?>"><img src="phpimages/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($members_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $members_list->PageUrl() ?>start=<?php echo $members_list->Pager->LastButton->Start ?>"><img src="phpimages/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $members_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $members_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $members_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $members_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($members_list->SearchWhere == "0=101") { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoRecord") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($members_list->TotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td><?php echo $Language->Phrase("RecordsPerPage") ?>&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="members">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();">
<option value="10"<?php if ($members_list->DisplayRecs == 10) { ?> selected="selected"<?php } ?>>10</option>
<option value="20"<?php if ($members_list->DisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="50"<?php if ($members_list->DisplayRecs == 50) { ?> selected="selected"<?php } ?>>50</option>
<option value="100"<?php if ($members_list->DisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="200"<?php if ($members_list->DisplayRecs == 200) { ?> selected="selected"<?php } ?>>200</option>
<option value="300"<?php if ($members_list->DisplayRecs == 300) { ?> selected="selected"<?php } ?>>300</option>
<option value="500"<?php if ($members_list->DisplayRecs == 500) { ?> selected="selected"<?php } ?>>500</option>
<option value="700"<?php if ($members_list->DisplayRecs == 700) { ?> selected="selected"<?php } ?>>700</option>
<option value="1000"<?php if ($members_list->DisplayRecs == 1000) { ?> selected="selected"<?php } ?>>1000</option>
<option value="ALL"<?php if ($members->getRecordsPerPage() == -1) { ?> selected="selected"<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<span class="phpmaker">
<?php if ($members->CurrentAction <> "gridadd" && $members->CurrentAction <> "gridedit") { // Not grid add/edit mode ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a class="ewGridLink" href="<?php echo $members_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;<a class="ewGridLink" href="<?php echo $members_list->GridAddUrl ?>"><?php echo $Language->Phrase("GridAddLink") ?></a>&nbsp;<?php if ($memberupdatelog->DetailAdd && $Security->IsLoggedIn()) { ?>
<a class="ewGridLink" href="<?php echo $members->AddUrl() . "?" . EW_TABLE_SHOW_DETAIL . "=memberupdatelog" ?>"><?php echo $Language->Phrase("AddLink") ?>&nbsp;<?php echo $members->TableCaption() ?>/<?php echo $memberupdatelog->TableCaption() ?></a>&nbsp;<?php } ?>
<?php } ?><?php if ($members_list->TotalRecs > 0) { ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a class="ewGridLink" href="" onclick="ew_SubmitSelected(document.fmemberslist, 'custompaymentcalculate.php');return false;"><img src="images/button_add_payment.png" width="174" height="37" border="0" align="absmiddle" /></a>&nbsp;<a class="ewGridLink" href="" onclick="ew_SubmitSelected(document.fmemberslist, '<?php echo $members_list->MultiDeleteUrl ?>');return false;"><?php echo $Language->Phrase("DeleteSelectedLink") ?></a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
<?php } else { // Grid add/edit mode ?>
<?php if ($members->CurrentAction == "gridadd") { ?>
<?php if ($members->AllowAddDeleteRow) { ?>
<a class="ewGridLink" href="javascript:void(0);" onclick="ew_AddGridRow(this);"><?php echo $Language->Phrase("AddBlankRow") ?></a>&nbsp;&nbsp;
<?php } ?>
<a class="ewGridLink" href="" onclick="return ew_SubmitForm(members_list, document.fmemberslist);"><?php echo $Language->Phrase("GridInsertLink") ?></a>&nbsp;&nbsp;
<a class="ewGridLink" href="<?php echo $members_list->PageUrl() ?>a=cancel"><?php echo $Language->Phrase("GridCancelLink") ?></a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
</span>
</div>
<?php } ?>
<form name="fmemberslist" id="fmemberslist" class="ewForm" action="<?php echo ew_CurrentPage() ?>" method="post">
<input type="hidden" name="t" id="t" value="members">
<div id="gmp_members" class="ewGridMiddlePanel">
<?php if ($members_list->TotalRecs > 0) { ?>
<table cellspacing="0" data-rowhighlightclass="ewTableHighlightRow" data-rowselectclass="ewTableSelectRow" data-roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $members->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$members_list->RenderListOptions();

// Render list options (header, left)
$members_list->ListOptions->Render("header", "left");
?>
<?php if ($members->member_code->Visible) { // member_code ?>
	<?php if ($members->SortUrl($members->member_code) == "") { ?>
		<td><?php echo $members->member_code->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $members->SortUrl($members->member_code) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $members->member_code->FldCaption() ?></td><td style="width: 10px;"><?php if ($members->member_code->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($members->member_code->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($members->id_code->Visible) { // id_code ?>
	<?php if ($members->SortUrl($members->id_code) == "") { ?>
		<td><?php echo $members->id_code->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $members->SortUrl($members->id_code) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $members->id_code->FldCaption() ?></td><td style="width: 10px;"><?php if ($members->id_code->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($members->id_code->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($members->prefix->Visible) { // prefix ?>
	<?php if ($members->SortUrl($members->prefix) == "") { ?>
		<td><?php echo $members->prefix->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $members->SortUrl($members->prefix) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $members->prefix->FldCaption() ?></td><td style="width: 10px;"><?php if ($members->prefix->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($members->prefix->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($members->gender->Visible) { // gender ?>
	<?php if ($members->SortUrl($members->gender) == "") { ?>
		<td><?php echo $members->gender->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $members->SortUrl($members->gender) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $members->gender->FldCaption() ?></td><td style="width: 10px;"><?php if ($members->gender->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($members->gender->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($members->fname->Visible) { // fname ?>
	<?php if ($members->SortUrl($members->fname) == "") { ?>
		<td style="white-space: nowrap;"><?php echo $members->fname->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $members->SortUrl($members->fname) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><thead><tr><td><?php echo $members->fname->FldCaption() ?></td><td style="width: 10px;"><?php if ($members->fname->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($members->fname->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($members->lname->Visible) { // lname ?>
	<?php if ($members->SortUrl($members->lname) == "") { ?>
		<td style="white-space: nowrap;"><?php echo $members->lname->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $members->SortUrl($members->lname) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><thead><tr><td><?php echo $members->lname->FldCaption() ?></td><td style="width: 10px;"><?php if ($members->lname->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($members->lname->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($members->birthdate->Visible) { // birthdate ?>
	<?php if ($members->SortUrl($members->birthdate) == "") { ?>
		<td><?php echo $members->birthdate->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $members->SortUrl($members->birthdate) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $members->birthdate->FldCaption() ?></td><td style="width: 10px;"><?php if ($members->birthdate->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($members->birthdate->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($members->age->Visible) { // age ?>
	<?php if ($members->SortUrl($members->age) == "") { ?>
		<td><?php echo $members->age->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $members->SortUrl($members->age) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $members->age->FldCaption() ?></td><td style="width: 10px;"><?php if ($members->age->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($members->age->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($members->t_code->Visible) { // t_code ?>
	<?php if ($members->SortUrl($members->t_code) == "") { ?>
		<td style="white-space: nowrap;"><?php echo $members->t_code->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $members->SortUrl($members->t_code) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><thead><tr><td><?php echo $members->t_code->FldCaption() ?></td><td style="width: 10px;"><?php if ($members->t_code->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($members->t_code->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($members->village_id->Visible) { // village_id ?>
	<?php if ($members->SortUrl($members->village_id) == "") { ?>
		<td style="white-space: nowrap;"><?php echo $members->village_id->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $members->SortUrl($members->village_id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><thead><tr><td><?php echo $members->village_id->FldCaption() ?></td><td style="width: 10px;"><?php if ($members->village_id->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($members->village_id->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($members->bnfc1_name->Visible) { // bnfc1_name ?>
	<?php if ($members->SortUrl($members->bnfc1_name) == "") { ?>
		<td style="white-space: nowrap;"><?php echo $members->bnfc1_name->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $members->SortUrl($members->bnfc1_name) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><thead><tr><td><?php echo $members->bnfc1_name->FldCaption() ?></td><td style="width: 10px;"><?php if ($members->bnfc1_name->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($members->bnfc1_name->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($members->bnfc1_rel->Visible) { // bnfc1_rel ?>
	<?php if ($members->SortUrl($members->bnfc1_rel) == "") { ?>
		<td style="white-space: nowrap;"><?php echo $members->bnfc1_rel->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $members->SortUrl($members->bnfc1_rel) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><thead><tr><td><?php echo $members->bnfc1_rel->FldCaption() ?></td><td style="width: 10px;"><?php if ($members->bnfc1_rel->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($members->bnfc1_rel->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($members->bnfc2_name->Visible) { // bnfc2_name ?>
	<?php if ($members->SortUrl($members->bnfc2_name) == "") { ?>
		<td style="white-space: nowrap;"><?php echo $members->bnfc2_name->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $members->SortUrl($members->bnfc2_name) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><thead><tr><td><?php echo $members->bnfc2_name->FldCaption() ?></td><td style="width: 10px;"><?php if ($members->bnfc2_name->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($members->bnfc2_name->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($members->bnfc2_rel->Visible) { // bnfc2_rel ?>
	<?php if ($members->SortUrl($members->bnfc2_rel) == "") { ?>
		<td style="white-space: nowrap;"><?php echo $members->bnfc2_rel->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $members->SortUrl($members->bnfc2_rel) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><thead><tr><td><?php echo $members->bnfc2_rel->FldCaption() ?></td><td style="width: 10px;"><?php if ($members->bnfc2_rel->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($members->bnfc2_rel->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($members->bnfc3_name->Visible) { // bnfc3_name ?>
	<?php if ($members->SortUrl($members->bnfc3_name) == "") { ?>
		<td style="white-space: nowrap;"><?php echo $members->bnfc3_name->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $members->SortUrl($members->bnfc3_name) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><thead><tr><td><?php echo $members->bnfc3_name->FldCaption() ?></td><td style="width: 10px;"><?php if ($members->bnfc3_name->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($members->bnfc3_name->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($members->bnfc3_rel->Visible) { // bnfc3_rel ?>
	<?php if ($members->SortUrl($members->bnfc3_rel) == "") { ?>
		<td style="white-space: nowrap;"><?php echo $members->bnfc3_rel->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $members->SortUrl($members->bnfc3_rel) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><thead><tr><td><?php echo $members->bnfc3_rel->FldCaption() ?></td><td style="width: 10px;"><?php if ($members->bnfc3_rel->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($members->bnfc3_rel->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($members->regis_date->Visible) { // regis_date ?>
	<?php if ($members->SortUrl($members->regis_date) == "") { ?>
		<td><?php echo $members->regis_date->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $members->SortUrl($members->regis_date) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $members->regis_date->FldCaption() ?></td><td style="width: 10px;"><?php if ($members->regis_date->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($members->regis_date->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($members->effective_date->Visible) { // effective_date ?>
	<?php if ($members->SortUrl($members->effective_date) == "") { ?>
		<td><?php echo $members->effective_date->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $members->SortUrl($members->effective_date) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $members->effective_date->FldCaption() ?></td><td style="width: 10px;"><?php if ($members->effective_date->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($members->effective_date->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($members->member_status->Visible) { // member_status ?>
	<?php if ($members->SortUrl($members->member_status) == "") { ?>
		<td style="white-space: nowrap;"><?php echo $members->member_status->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $members->SortUrl($members->member_status) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><thead><tr><td><?php echo $members->member_status->FldCaption() ?></td><td style="width: 10px;"><?php if ($members->member_status->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($members->member_status->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$members_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($members->ExportAll && $members->Export <> "") {
	$members_list->StopRec = $members_list->TotalRecs;
} else {

	// Set the last record to display
	if ($members_list->TotalRecs > $members_list->StartRec + $members_list->DisplayRecs - 1)
		$members_list->StopRec = $members_list->StartRec + $members_list->DisplayRecs - 1;
	else
		$members_list->StopRec = $members_list->TotalRecs;
}

// Restore number of post back records
if ($objForm) {
	$objForm->Index = 0;
	if ($objForm->HasValue("key_count") && ($members->CurrentAction == "gridadd" || $members->CurrentAction == "gridedit" || $members->CurrentAction == "F")) {
		$members_list->KeyCount = $objForm->GetValue("key_count");
		$members_list->StopRec = $members_list->KeyCount;
	}
}
$members_list->RecCnt = $members_list->StartRec - 1;
if ($members_list->Recordset && !$members_list->Recordset->EOF) {
	$members_list->Recordset->MoveFirst();
	if (!$bSelectLimit && $members_list->StartRec > 1)
		$members_list->Recordset->Move($members_list->StartRec - 1);
} elseif (!$members->AllowAddDeleteRow && $members_list->StopRec == 0) {
	$members_list->StopRec = $members->GridAddRowCount;
}

// Initialize aggregate
$members->RowType = EW_ROWTYPE_AGGREGATEINIT;
$members->ResetAttrs();
$members_list->RenderRow();
$members_list->RowCnt = 0;
if ($members->CurrentAction == "gridadd")
	$members_list->RowIndex = 0;
while ($members_list->RecCnt < $members_list->StopRec) {
	$members_list->RecCnt++;
	if (intval($members_list->RecCnt) >= intval($members_list->StartRec)) {
		$members_list->RowCnt++;
		if ($members->CurrentAction == "gridadd" || $members->CurrentAction == "gridedit" || $members->CurrentAction == "F") {
			$members_list->RowIndex++;
			$objForm->Index = $members_list->RowIndex;
			if ($objForm->HasValue("k_action"))
				$members_list->RowAction = strval($objForm->GetValue("k_action"));
			elseif ($members->CurrentAction == "gridadd")
				$members_list->RowAction = "insert";
			else
				$members_list->RowAction = "";
		}

		// Set up key count
		$members_list->KeyCount = $members_list->RowIndex;

		// Init row class and style
		$members->ResetAttrs();
		$members->CssClass = "";
		if ($members->CurrentAction == "gridadd") {
			$members_list->LoadDefaultValues(); // Load default values
		} else {
			$members_list->LoadRowValues($members_list->Recordset); // Load row values
		}
		$members->RowType = EW_ROWTYPE_VIEW; // Render view
		if ($members->CurrentAction == "gridadd") // Grid add
			$members->RowType = EW_ROWTYPE_ADD; // Render add
		if ($members->CurrentAction == "gridadd" && $members->EventCancelled && !$objForm->HasValue("k_blankrow")) // Insert failed
			$members_list->RestoreCurrentRowFormValues($members_list->RowIndex); // Restore form values
		$members->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');

		// Render row
		$members_list->RenderRow();

		// Render list options
		$members_list->RenderListOptions();

		// Skip delete row / empty row for confirm page
		if ($members_list->RowAction <> "delete" && $members_list->RowAction <> "insertdelete" && !($members_list->RowAction == "insert" && $members->CurrentAction == "F" && $members_list->EmptyRow())) {
?>
	<tr<?php echo $members->RowAttributes() ?>>
<?php

// Render list options (body, left)
$members_list->ListOptions->Render("body", "left");
?>
	<?php if ($members->member_code->Visible) { // member_code ?>
		<td<?php echo $members->member_code->CellAttributes() ?>>
<?php if ($members->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="text" name="x<?php echo $members_list->RowIndex ?>_member_code" id="x<?php echo $members_list->RowIndex ?>_member_code" size="30" maxlength="50" value="<?php echo $members->member_code->EditValue ?>"<?php echo $members->member_code->EditAttributes() ?>>
<input type="hidden" name="o<?php echo $members_list->RowIndex ?>_member_code" id="o<?php echo $members_list->RowIndex ?>_member_code" value="<?php echo ew_HtmlEncode($members->member_code->OldValue) ?>">
<?php } ?>
<?php if ($members->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $members->member_code->ViewAttributes() ?>><?php echo $members->member_code->ListViewValue() ?></div>
<?php } ?>
<a name="<?php echo $members_list->PageObjName . "_row_" . $members_list->RowCnt ?>" id="<?php echo $members_list->PageObjName . "_row_" . $members_list->RowCnt ?>"></a></td>
	<?php } ?>
	<?php if ($members->id_code->Visible) { // id_code ?>
		<td<?php echo $members->id_code->CellAttributes() ?>>
<?php if ($members->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="text" name="x<?php echo $members_list->RowIndex ?>_id_code" id="x<?php echo $members_list->RowIndex ?>_id_code" size="13" maxlength="13" value="<?php echo $members->id_code->EditValue ?>"<?php echo $members->id_code->EditAttributes() ?>>
<input type="hidden" name="o<?php echo $members_list->RowIndex ?>_id_code" id="o<?php echo $members_list->RowIndex ?>_id_code" value="<?php echo ew_HtmlEncode($members->id_code->OldValue) ?>">
<?php } ?>
<?php if ($members->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $members->id_code->ViewAttributes() ?>><?php echo $members->id_code->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($members->prefix->Visible) { // prefix ?>
		<td<?php echo $members->prefix->CellAttributes() ?>>
<?php if ($members->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<select id="x<?php echo $members_list->RowIndex ?>_prefix" name="x<?php echo $members_list->RowIndex ?>_prefix"<?php echo $members->prefix->EditAttributes() ?>>
<?php
if (is_array($members->prefix->EditValue)) {
	$arwrk = $members->prefix->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($members->prefix->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
if (@$emptywrk) $members->prefix->OldValue = "";
?>
</select>
<input type="hidden" name="o<?php echo $members_list->RowIndex ?>_prefix" id="o<?php echo $members_list->RowIndex ?>_prefix" value="<?php echo ew_HtmlEncode($members->prefix->OldValue) ?>">
<?php } ?>
<?php if ($members->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $members->prefix->ViewAttributes() ?>><?php echo $members->prefix->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($members->gender->Visible) { // gender ?>
		<td<?php echo $members->gender->CellAttributes() ?>>
<?php if ($members->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<select id="x<?php echo $members_list->RowIndex ?>_gender" name="x<?php echo $members_list->RowIndex ?>_gender"<?php echo $members->gender->EditAttributes() ?>>
<?php
if (is_array($members->gender->EditValue)) {
	$arwrk = $members->gender->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($members->gender->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
if (@$emptywrk) $members->gender->OldValue = "";
?>
</select>
<input type="hidden" name="o<?php echo $members_list->RowIndex ?>_gender" id="o<?php echo $members_list->RowIndex ?>_gender" value="<?php echo ew_HtmlEncode($members->gender->OldValue) ?>">
<?php } ?>
<?php if ($members->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $members->gender->ViewAttributes() ?>><?php echo $members->gender->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($members->fname->Visible) { // fname ?>
		<td<?php echo $members->fname->CellAttributes() ?>>
<?php if ($members->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="text" name="x<?php echo $members_list->RowIndex ?>_fname" id="x<?php echo $members_list->RowIndex ?>_fname" size="30" maxlength="45" value="<?php echo $members->fname->EditValue ?>"<?php echo $members->fname->EditAttributes() ?>>
<input type="hidden" name="o<?php echo $members_list->RowIndex ?>_fname" id="o<?php echo $members_list->RowIndex ?>_fname" value="<?php echo ew_HtmlEncode($members->fname->OldValue) ?>">
<?php } ?>
<?php if ($members->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $members->fname->ViewAttributes() ?>><?php echo $members->fname->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($members->lname->Visible) { // lname ?>
		<td<?php echo $members->lname->CellAttributes() ?>>
<?php if ($members->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="text" name="x<?php echo $members_list->RowIndex ?>_lname" id="x<?php echo $members_list->RowIndex ?>_lname" size="30" maxlength="45" value="<?php echo $members->lname->EditValue ?>"<?php echo $members->lname->EditAttributes() ?>>
<input type="hidden" name="o<?php echo $members_list->RowIndex ?>_lname" id="o<?php echo $members_list->RowIndex ?>_lname" value="<?php echo ew_HtmlEncode($members->lname->OldValue) ?>">
<?php } ?>
<?php if ($members->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $members->lname->ViewAttributes() ?>><?php echo $members->lname->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($members->birthdate->Visible) { // birthdate ?>
		<td<?php echo $members->birthdate->CellAttributes() ?>>
<?php if ($members->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="text" name="x<?php echo $members_list->RowIndex ?>_birthdate" id="x<?php echo $members_list->RowIndex ?>_birthdate" value="<?php echo $members->birthdate->EditValue ?>"<?php echo $members->birthdate->EditAttributes() ?>>
&nbsp;<img src="phpimages/calendar.png" id="cal_x<?php echo $members_list->RowIndex ?>_birthdate" name="cal_x<?php echo $members_list->RowIndex ?>_birthdate" alt="<?php echo $Language->Phrase("PickDate") ?>" title="<?php echo $Language->Phrase("PickDate") ?>" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField: "x<?php echo $members_list->RowIndex ?>_birthdate", // input field id
	ifFormat: "%d/%m/%Y", // date format
	button: "cal_x<?php echo $members_list->RowIndex ?>_birthdate" // button id
});
</script>
<input type="hidden" name="fo<?php echo $members_list->RowIndex ?>_birthdate" id="fo<?php echo $members_list->RowIndex ?>_birthdate" value="<?php echo ew_HtmlEncode(ew_FormatDateTime($members->birthdate->OldValue, 7)) ?>">
<input type="hidden" name="o<?php echo $members_list->RowIndex ?>_birthdate" id="o<?php echo $members_list->RowIndex ?>_birthdate" value="<?php echo ew_HtmlEncode($members->birthdate->OldValue) ?>">
<?php } ?>
<?php if ($members->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $members->birthdate->ViewAttributes() ?>><?php echo $members->birthdate->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($members->age->Visible) { // age ?>
		<td<?php echo $members->age->CellAttributes() ?>>
<?php if ($members->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="text" name="x<?php echo $members_list->RowIndex ?>_age" id="x<?php echo $members_list->RowIndex ?>_age" size="30" value="<?php echo $members->age->EditValue ?>"<?php echo $members->age->EditAttributes() ?>>
<input type="hidden" name="o<?php echo $members_list->RowIndex ?>_age" id="o<?php echo $members_list->RowIndex ?>_age" value="<?php echo ew_HtmlEncode($members->age->OldValue) ?>">
<?php } ?>
<?php if ($members->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $members->age->ViewAttributes() ?>><?php echo $members->age->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($members->t_code->Visible) { // t_code ?>
		<td<?php echo $members->t_code->CellAttributes() ?>>
<?php if ($members->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<?php $members->t_code->EditAttrs["onchange"] = "ew_UpdateOpt('x" . $members_list->RowIndex . "_village_id','x" . $members_list->RowIndex . "_t_code',true); " . @$members->t_code->EditAttrs["onchange"]; ?>
<select id="x<?php echo $members_list->RowIndex ?>_t_code" name="x<?php echo $members_list->RowIndex ?>_t_code"<?php echo $members->t_code->EditAttributes() ?>>
<?php
if (is_array($members->t_code->EditValue)) {
	$arwrk = $members->t_code->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($members->t_code->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
<?php if ($arwrk[$rowcntwrk][2] <> "") { ?>
<?php echo ew_ValueSeparator($rowcntwrk,1,$members->t_code) ?><?php echo $arwrk[$rowcntwrk][2] ?>
<?php } ?>
</option>
<?php
	}
}
if (@$emptywrk) $members->t_code->OldValue = "";
?>
</select>
<?php
$sSqlWrk = "SELECT `t_code`, `t_code` AS `DispFld`, `t_title` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `tambon`";
$sWhereWrk = "";
if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
$sSqlWrk .= " ORDER BY `t_code`";
$sSqlWrk = TEAencrypt($sSqlWrk, EW_RANDOM_KEY);
?>
<input type="hidden" name="s_x<?php echo $members_list->RowIndex ?>_t_code" id="s_x<?php echo $members_list->RowIndex ?>_t_code" value="<?php echo $sSqlWrk; ?>">
<input type="hidden" name="lft_x<?php echo $members_list->RowIndex ?>_t_code" id="lft_x<?php echo $members_list->RowIndex ?>_t_code" value="">
<input type="hidden" name="o<?php echo $members_list->RowIndex ?>_t_code" id="o<?php echo $members_list->RowIndex ?>_t_code" value="<?php echo ew_HtmlEncode($members->t_code->OldValue) ?>">
<?php } ?>
<?php if ($members->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $members->t_code->ViewAttributes() ?>><?php echo $members->t_code->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($members->village_id->Visible) { // village_id ?>
		<td<?php echo $members->village_id->CellAttributes() ?>>
<?php if ($members->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<select id="x<?php echo $members_list->RowIndex ?>_village_id" name="x<?php echo $members_list->RowIndex ?>_village_id"<?php echo $members->village_id->EditAttributes() ?>>
<?php
if (is_array($members->village_id->EditValue)) {
	$arwrk = $members->village_id->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($members->village_id->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
<?php if ($arwrk[$rowcntwrk][2] <> "") { ?>
<?php echo ew_ValueSeparator($rowcntwrk,1,$members->village_id) ?><?php echo $arwrk[$rowcntwrk][2] ?>
<?php } ?>
</option>
<?php
	}
}
if (@$emptywrk) $members->village_id->OldValue = "";
?>
</select>
<?php
$sSqlWrk = "SELECT `village_id`, `v_code` AS `DispFld`, `v_title` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `village`";
$sWhereWrk = "`t_code` IN ({filter_value})";
if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
$sSqlWrk .= " ORDER BY `v_code`";
$sSqlWrk = TEAencrypt($sSqlWrk, EW_RANDOM_KEY);
?>
<input type="hidden" name="s_x<?php echo $members_list->RowIndex ?>_village_id" id="s_x<?php echo $members_list->RowIndex ?>_village_id" value="<?php echo $sSqlWrk; ?>">
<input type="hidden" name="lft_x<?php echo $members_list->RowIndex ?>_village_id" id="lft_x<?php echo $members_list->RowIndex ?>_village_id" value="3">
<input type="hidden" name="o<?php echo $members_list->RowIndex ?>_village_id" id="o<?php echo $members_list->RowIndex ?>_village_id" value="<?php echo ew_HtmlEncode($members->village_id->OldValue) ?>">
<?php } ?>
<?php if ($members->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $members->village_id->ViewAttributes() ?>><?php echo $members->village_id->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($members->bnfc1_name->Visible) { // bnfc1_name ?>
		<td<?php echo $members->bnfc1_name->CellAttributes() ?>>
<?php if ($members->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="text" name="x<?php echo $members_list->RowIndex ?>_bnfc1_name" id="x<?php echo $members_list->RowIndex ?>_bnfc1_name" size="30" maxlength="45" value="<?php echo $members->bnfc1_name->EditValue ?>"<?php echo $members->bnfc1_name->EditAttributes() ?>>
<input type="hidden" name="o<?php echo $members_list->RowIndex ?>_bnfc1_name" id="o<?php echo $members_list->RowIndex ?>_bnfc1_name" value="<?php echo ew_HtmlEncode($members->bnfc1_name->OldValue) ?>">
<?php } ?>
<?php if ($members->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $members->bnfc1_name->ViewAttributes() ?>><?php echo $members->bnfc1_name->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($members->bnfc1_rel->Visible) { // bnfc1_rel ?>
		<td<?php echo $members->bnfc1_rel->CellAttributes() ?>>
<?php if ($members->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="text" name="x<?php echo $members_list->RowIndex ?>_bnfc1_rel" id="x<?php echo $members_list->RowIndex ?>_bnfc1_rel" size="30" maxlength="45" value="<?php echo $members->bnfc1_rel->EditValue ?>"<?php echo $members->bnfc1_rel->EditAttributes() ?>>
<input type="hidden" name="o<?php echo $members_list->RowIndex ?>_bnfc1_rel" id="o<?php echo $members_list->RowIndex ?>_bnfc1_rel" value="<?php echo ew_HtmlEncode($members->bnfc1_rel->OldValue) ?>">
<?php } ?>
<?php if ($members->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $members->bnfc1_rel->ViewAttributes() ?>><?php echo $members->bnfc1_rel->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($members->bnfc2_name->Visible) { // bnfc2_name ?>
		<td<?php echo $members->bnfc2_name->CellAttributes() ?>>
<?php if ($members->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="text" name="x<?php echo $members_list->RowIndex ?>_bnfc2_name" id="x<?php echo $members_list->RowIndex ?>_bnfc2_name" size="30" maxlength="45" value="<?php echo $members->bnfc2_name->EditValue ?>"<?php echo $members->bnfc2_name->EditAttributes() ?>>
<input type="hidden" name="o<?php echo $members_list->RowIndex ?>_bnfc2_name" id="o<?php echo $members_list->RowIndex ?>_bnfc2_name" value="<?php echo ew_HtmlEncode($members->bnfc2_name->OldValue) ?>">
<?php } ?>
<?php if ($members->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $members->bnfc2_name->ViewAttributes() ?>><?php echo $members->bnfc2_name->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($members->bnfc2_rel->Visible) { // bnfc2_rel ?>
		<td<?php echo $members->bnfc2_rel->CellAttributes() ?>>
<?php if ($members->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="text" name="x<?php echo $members_list->RowIndex ?>_bnfc2_rel" id="x<?php echo $members_list->RowIndex ?>_bnfc2_rel" size="30" maxlength="45" value="<?php echo $members->bnfc2_rel->EditValue ?>"<?php echo $members->bnfc2_rel->EditAttributes() ?>>
<input type="hidden" name="o<?php echo $members_list->RowIndex ?>_bnfc2_rel" id="o<?php echo $members_list->RowIndex ?>_bnfc2_rel" value="<?php echo ew_HtmlEncode($members->bnfc2_rel->OldValue) ?>">
<?php } ?>
<?php if ($members->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $members->bnfc2_rel->ViewAttributes() ?>><?php echo $members->bnfc2_rel->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($members->bnfc3_name->Visible) { // bnfc3_name ?>
		<td<?php echo $members->bnfc3_name->CellAttributes() ?>>
<?php if ($members->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="text" name="x<?php echo $members_list->RowIndex ?>_bnfc3_name" id="x<?php echo $members_list->RowIndex ?>_bnfc3_name" size="30" maxlength="45" value="<?php echo $members->bnfc3_name->EditValue ?>"<?php echo $members->bnfc3_name->EditAttributes() ?>>
<input type="hidden" name="o<?php echo $members_list->RowIndex ?>_bnfc3_name" id="o<?php echo $members_list->RowIndex ?>_bnfc3_name" value="<?php echo ew_HtmlEncode($members->bnfc3_name->OldValue) ?>">
<?php } ?>
<?php if ($members->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $members->bnfc3_name->ViewAttributes() ?>><?php echo $members->bnfc3_name->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($members->bnfc3_rel->Visible) { // bnfc3_rel ?>
		<td<?php echo $members->bnfc3_rel->CellAttributes() ?>>
<?php if ($members->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="text" name="x<?php echo $members_list->RowIndex ?>_bnfc3_rel" id="x<?php echo $members_list->RowIndex ?>_bnfc3_rel" size="30" maxlength="45" value="<?php echo $members->bnfc3_rel->EditValue ?>"<?php echo $members->bnfc3_rel->EditAttributes() ?>>
<input type="hidden" name="o<?php echo $members_list->RowIndex ?>_bnfc3_rel" id="o<?php echo $members_list->RowIndex ?>_bnfc3_rel" value="<?php echo ew_HtmlEncode($members->bnfc3_rel->OldValue) ?>">
<?php } ?>
<?php if ($members->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $members->bnfc3_rel->ViewAttributes() ?>><?php echo $members->bnfc3_rel->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($members->regis_date->Visible) { // regis_date ?>
		<td<?php echo $members->regis_date->CellAttributes() ?>>
<?php if ($members->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="text" name="x<?php echo $members_list->RowIndex ?>_regis_date" id="x<?php echo $members_list->RowIndex ?>_regis_date" value="<?php echo $members->regis_date->EditValue ?>"<?php echo $members->regis_date->EditAttributes() ?>>
&nbsp;<img src="phpimages/calendar.png" id="cal_x<?php echo $members_list->RowIndex ?>_regis_date" name="cal_x<?php echo $members_list->RowIndex ?>_regis_date" alt="<?php echo $Language->Phrase("PickDate") ?>" title="<?php echo $Language->Phrase("PickDate") ?>" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField: "x<?php echo $members_list->RowIndex ?>_regis_date", // input field id
	ifFormat: "%d/%m/%Y", // date format
	button: "cal_x<?php echo $members_list->RowIndex ?>_regis_date" // button id
});
</script>
<input type="hidden" name="fo<?php echo $members_list->RowIndex ?>_regis_date" id="fo<?php echo $members_list->RowIndex ?>_regis_date" value="<?php echo ew_HtmlEncode(ew_FormatDateTime($members->regis_date->OldValue, 7)) ?>">
<input type="hidden" name="o<?php echo $members_list->RowIndex ?>_regis_date" id="o<?php echo $members_list->RowIndex ?>_regis_date" value="<?php echo ew_HtmlEncode($members->regis_date->OldValue) ?>">
<?php } ?>
<?php if ($members->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $members->regis_date->ViewAttributes() ?>><?php echo $members->regis_date->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($members->effective_date->Visible) { // effective_date ?>
		<td<?php echo $members->effective_date->CellAttributes() ?>>
<?php if ($members->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="text" name="x<?php echo $members_list->RowIndex ?>_effective_date" id="x<?php echo $members_list->RowIndex ?>_effective_date" value="<?php echo $members->effective_date->EditValue ?>"<?php echo $members->effective_date->EditAttributes() ?>>
&nbsp;<img src="phpimages/calendar.png" id="cal_x<?php echo $members_list->RowIndex ?>_effective_date" name="cal_x<?php echo $members_list->RowIndex ?>_effective_date" alt="<?php echo $Language->Phrase("PickDate") ?>" title="<?php echo $Language->Phrase("PickDate") ?>" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField: "x<?php echo $members_list->RowIndex ?>_effective_date", // input field id
	ifFormat: "%d/%m/%Y", // date format
	button: "cal_x<?php echo $members_list->RowIndex ?>_effective_date" // button id
});
</script>
<input type="hidden" name="fo<?php echo $members_list->RowIndex ?>_effective_date" id="fo<?php echo $members_list->RowIndex ?>_effective_date" value="<?php echo ew_HtmlEncode(ew_FormatDateTime($members->effective_date->OldValue, 7)) ?>">
<input type="hidden" name="o<?php echo $members_list->RowIndex ?>_effective_date" id="o<?php echo $members_list->RowIndex ?>_effective_date" value="<?php echo ew_HtmlEncode($members->effective_date->OldValue) ?>">
<?php } ?>
<?php if ($members->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $members->effective_date->ViewAttributes() ?>><?php echo $members->effective_date->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($members->member_status->Visible) { // member_status ?>
		<td<?php echo $members->member_status->CellAttributes() ?>>
<?php if ($members->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<select id="x<?php echo $members_list->RowIndex ?>_member_status" name="x<?php echo $members_list->RowIndex ?>_member_status"<?php echo $members->member_status->EditAttributes() ?>>
<?php
if (is_array($members->member_status->EditValue)) {
	$arwrk = $members->member_status->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($members->member_status->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
if (@$emptywrk) $members->member_status->OldValue = "";
?>
</select>
<?php
$sSqlWrk = "SELECT `s_title`, `s_title` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `memberstatus`";
$sWhereWrk = "";
if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
$sSqlWrk = TEAencrypt($sSqlWrk, EW_RANDOM_KEY);
?>
<input type="hidden" name="s_x<?php echo $members_list->RowIndex ?>_member_status" id="s_x<?php echo $members_list->RowIndex ?>_member_status" value="<?php echo $sSqlWrk; ?>">
<input type="hidden" name="lft_x<?php echo $members_list->RowIndex ?>_member_status" id="lft_x<?php echo $members_list->RowIndex ?>_member_status" value="">
<input type="hidden" name="o<?php echo $members_list->RowIndex ?>_member_status" id="o<?php echo $members_list->RowIndex ?>_member_status" value="<?php echo ew_HtmlEncode($members->member_status->OldValue) ?>">
<?php } ?>
<?php if ($members->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $members->member_status->ViewAttributes() ?>><?php echo $members->member_status->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$members_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php if ($members->RowType == EW_ROWTYPE_ADD) { ?>
<script language="JavaScript" type="text/javascript">
<!--
ew_UpdateOpts([['x<?php echo $members_list->RowIndex ?>_village_id','x<?php echo $members_list->RowIndex ?>_t_code',false],
['x<?php echo $members_list->RowIndex ?>_t_code','x<?php echo $members_list->RowIndex ?>_t_code',false],
['x<?php echo $members_list->RowIndex ?>_member_status','x<?php echo $members_list->RowIndex ?>_member_status',false]]);

//-->
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if ($members->CurrentAction <> "gridadd")
		if (!$members_list->Recordset->EOF) $members_list->Recordset->MoveNext();
}
?>
<?php
	if ($members->CurrentAction == "gridadd" || $members->CurrentAction == "gridedit") {
		$members_list->RowIndex = '$rowindex$';
		$members_list->LoadDefaultValues();

		// Set row properties
		$members->ResetAttrs();
		$members->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');
		if (!empty($members_list->RowIndex))
			$members->RowAttrs = array_merge($members->RowAttrs, array('data-rowindex'=>$members_list->RowIndex, 'id'=>'r' . $members_list->RowIndex . '_members'));
		$members->RowType = EW_ROWTYPE_ADD;

		// Render row
		$members_list->RenderRow();

		// Render list options
		$members_list->RenderListOptions();

		// Add id and class to the template row
		$members->RowAttrs["id"] = "r0_members";
		ew_AppendClass($members->RowAttrs["class"], "ewTemplate");
?>
	<tr<?php echo $members->RowAttributes() ?>>
<?php

// Render list options (body, left)
$members_list->ListOptions->Render("body", "left");
?>
	<?php if ($members->member_code->Visible) { // member_code ?>
		<td>
<input type="text" name="x<?php echo $members_list->RowIndex ?>_member_code" id="x<?php echo $members_list->RowIndex ?>_member_code" size="30" maxlength="50" value="<?php echo $members->member_code->EditValue ?>"<?php echo $members->member_code->EditAttributes() ?>>
<input type="hidden" name="o<?php echo $members_list->RowIndex ?>_member_code" id="o<?php echo $members_list->RowIndex ?>_member_code" value="<?php echo ew_HtmlEncode($members->member_code->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($members->id_code->Visible) { // id_code ?>
		<td>
<input type="text" name="x<?php echo $members_list->RowIndex ?>_id_code" id="x<?php echo $members_list->RowIndex ?>_id_code" size="13" maxlength="13" value="<?php echo $members->id_code->EditValue ?>"<?php echo $members->id_code->EditAttributes() ?>>
<input type="hidden" name="o<?php echo $members_list->RowIndex ?>_id_code" id="o<?php echo $members_list->RowIndex ?>_id_code" value="<?php echo ew_HtmlEncode($members->id_code->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($members->prefix->Visible) { // prefix ?>
		<td>
<select id="x<?php echo $members_list->RowIndex ?>_prefix" name="x<?php echo $members_list->RowIndex ?>_prefix"<?php echo $members->prefix->EditAttributes() ?>>
<?php
if (is_array($members->prefix->EditValue)) {
	$arwrk = $members->prefix->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($members->prefix->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
if (@$emptywrk) $members->prefix->OldValue = "";
?>
</select>
<input type="hidden" name="o<?php echo $members_list->RowIndex ?>_prefix" id="o<?php echo $members_list->RowIndex ?>_prefix" value="<?php echo ew_HtmlEncode($members->prefix->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($members->gender->Visible) { // gender ?>
		<td>
<select id="x<?php echo $members_list->RowIndex ?>_gender" name="x<?php echo $members_list->RowIndex ?>_gender"<?php echo $members->gender->EditAttributes() ?>>
<?php
if (is_array($members->gender->EditValue)) {
	$arwrk = $members->gender->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($members->gender->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
if (@$emptywrk) $members->gender->OldValue = "";
?>
</select>
<input type="hidden" name="o<?php echo $members_list->RowIndex ?>_gender" id="o<?php echo $members_list->RowIndex ?>_gender" value="<?php echo ew_HtmlEncode($members->gender->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($members->fname->Visible) { // fname ?>
		<td>
<input type="text" name="x<?php echo $members_list->RowIndex ?>_fname" id="x<?php echo $members_list->RowIndex ?>_fname" size="30" maxlength="45" value="<?php echo $members->fname->EditValue ?>"<?php echo $members->fname->EditAttributes() ?>>
<input type="hidden" name="o<?php echo $members_list->RowIndex ?>_fname" id="o<?php echo $members_list->RowIndex ?>_fname" value="<?php echo ew_HtmlEncode($members->fname->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($members->lname->Visible) { // lname ?>
		<td>
<input type="text" name="x<?php echo $members_list->RowIndex ?>_lname" id="x<?php echo $members_list->RowIndex ?>_lname" size="30" maxlength="45" value="<?php echo $members->lname->EditValue ?>"<?php echo $members->lname->EditAttributes() ?>>
<input type="hidden" name="o<?php echo $members_list->RowIndex ?>_lname" id="o<?php echo $members_list->RowIndex ?>_lname" value="<?php echo ew_HtmlEncode($members->lname->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($members->birthdate->Visible) { // birthdate ?>
		<td>
<input type="text" name="x<?php echo $members_list->RowIndex ?>_birthdate" id="x<?php echo $members_list->RowIndex ?>_birthdate" value="<?php echo $members->birthdate->EditValue ?>"<?php echo $members->birthdate->EditAttributes() ?>>
&nbsp;<img src="phpimages/calendar.png" id="cal_x<?php echo $members_list->RowIndex ?>_birthdate" name="cal_x<?php echo $members_list->RowIndex ?>_birthdate" alt="<?php echo $Language->Phrase("PickDate") ?>" title="<?php echo $Language->Phrase("PickDate") ?>" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField: "x<?php echo $members_list->RowIndex ?>_birthdate", // input field id
	ifFormat: "%d/%m/%Y", // date format
	button: "cal_x<?php echo $members_list->RowIndex ?>_birthdate" // button id
});
</script>
<input type="hidden" name="o<?php echo $members_list->RowIndex ?>_birthdate" id="o<?php echo $members_list->RowIndex ?>_birthdate" value="<?php echo ew_HtmlEncode($members->birthdate->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($members->age->Visible) { // age ?>
		<td>
<input type="text" name="x<?php echo $members_list->RowIndex ?>_age" id="x<?php echo $members_list->RowIndex ?>_age" size="30" value="<?php echo $members->age->EditValue ?>"<?php echo $members->age->EditAttributes() ?>>
<input type="hidden" name="o<?php echo $members_list->RowIndex ?>_age" id="o<?php echo $members_list->RowIndex ?>_age" value="<?php echo ew_HtmlEncode($members->age->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($members->t_code->Visible) { // t_code ?>
		<td>
<?php $members->t_code->EditAttrs["onchange"] = "ew_UpdateOpt('x" . $members_list->RowIndex . "_village_id','x" . $members_list->RowIndex . "_t_code',true); " . @$members->t_code->EditAttrs["onchange"]; ?>
<select id="x<?php echo $members_list->RowIndex ?>_t_code" name="x<?php echo $members_list->RowIndex ?>_t_code"<?php echo $members->t_code->EditAttributes() ?>>
<?php
if (is_array($members->t_code->EditValue)) {
	$arwrk = $members->t_code->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($members->t_code->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
<?php if ($arwrk[$rowcntwrk][2] <> "") { ?>
<?php echo ew_ValueSeparator($rowcntwrk,1,$members->t_code) ?><?php echo $arwrk[$rowcntwrk][2] ?>
<?php } ?>
</option>
<?php
	}
}
if (@$emptywrk) $members->t_code->OldValue = "";
?>
</select>
<?php
$sSqlWrk = "SELECT `t_code`, `t_code` AS `DispFld`, `t_title` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `tambon`";
$sWhereWrk = "";
if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
$sSqlWrk .= " ORDER BY `t_code`";
$sSqlWrk = TEAencrypt($sSqlWrk, EW_RANDOM_KEY);
?>
<input type="hidden" name="s_x<?php echo $members_list->RowIndex ?>_t_code" id="s_x<?php echo $members_list->RowIndex ?>_t_code" value="<?php echo $sSqlWrk; ?>">
<input type="hidden" name="lft_x<?php echo $members_list->RowIndex ?>_t_code" id="lft_x<?php echo $members_list->RowIndex ?>_t_code" value="">
<input type="hidden" name="o<?php echo $members_list->RowIndex ?>_t_code" id="o<?php echo $members_list->RowIndex ?>_t_code" value="<?php echo ew_HtmlEncode($members->t_code->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($members->village_id->Visible) { // village_id ?>
		<td>
<select id="x<?php echo $members_list->RowIndex ?>_village_id" name="x<?php echo $members_list->RowIndex ?>_village_id"<?php echo $members->village_id->EditAttributes() ?>>
<?php
if (is_array($members->village_id->EditValue)) {
	$arwrk = $members->village_id->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($members->village_id->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
<?php if ($arwrk[$rowcntwrk][2] <> "") { ?>
<?php echo ew_ValueSeparator($rowcntwrk,1,$members->village_id) ?><?php echo $arwrk[$rowcntwrk][2] ?>
<?php } ?>
</option>
<?php
	}
}
if (@$emptywrk) $members->village_id->OldValue = "";
?>
</select>
<?php
$sSqlWrk = "SELECT `village_id`, `v_code` AS `DispFld`, `v_title` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `village`";
$sWhereWrk = "`t_code` IN ({filter_value})";
if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
$sSqlWrk .= " ORDER BY `v_code`";
$sSqlWrk = TEAencrypt($sSqlWrk, EW_RANDOM_KEY);
?>
<input type="hidden" name="s_x<?php echo $members_list->RowIndex ?>_village_id" id="s_x<?php echo $members_list->RowIndex ?>_village_id" value="<?php echo $sSqlWrk; ?>">
<input type="hidden" name="lft_x<?php echo $members_list->RowIndex ?>_village_id" id="lft_x<?php echo $members_list->RowIndex ?>_village_id" value="3">
<input type="hidden" name="o<?php echo $members_list->RowIndex ?>_village_id" id="o<?php echo $members_list->RowIndex ?>_village_id" value="<?php echo ew_HtmlEncode($members->village_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($members->bnfc1_name->Visible) { // bnfc1_name ?>
		<td>
<input type="text" name="x<?php echo $members_list->RowIndex ?>_bnfc1_name" id="x<?php echo $members_list->RowIndex ?>_bnfc1_name" size="30" maxlength="45" value="<?php echo $members->bnfc1_name->EditValue ?>"<?php echo $members->bnfc1_name->EditAttributes() ?>>
<input type="hidden" name="o<?php echo $members_list->RowIndex ?>_bnfc1_name" id="o<?php echo $members_list->RowIndex ?>_bnfc1_name" value="<?php echo ew_HtmlEncode($members->bnfc1_name->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($members->bnfc1_rel->Visible) { // bnfc1_rel ?>
		<td>
<input type="text" name="x<?php echo $members_list->RowIndex ?>_bnfc1_rel" id="x<?php echo $members_list->RowIndex ?>_bnfc1_rel" size="30" maxlength="45" value="<?php echo $members->bnfc1_rel->EditValue ?>"<?php echo $members->bnfc1_rel->EditAttributes() ?>>
<input type="hidden" name="o<?php echo $members_list->RowIndex ?>_bnfc1_rel" id="o<?php echo $members_list->RowIndex ?>_bnfc1_rel" value="<?php echo ew_HtmlEncode($members->bnfc1_rel->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($members->bnfc2_name->Visible) { // bnfc2_name ?>
		<td>
<input type="text" name="x<?php echo $members_list->RowIndex ?>_bnfc2_name" id="x<?php echo $members_list->RowIndex ?>_bnfc2_name" size="30" maxlength="45" value="<?php echo $members->bnfc2_name->EditValue ?>"<?php echo $members->bnfc2_name->EditAttributes() ?>>
<input type="hidden" name="o<?php echo $members_list->RowIndex ?>_bnfc2_name" id="o<?php echo $members_list->RowIndex ?>_bnfc2_name" value="<?php echo ew_HtmlEncode($members->bnfc2_name->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($members->bnfc2_rel->Visible) { // bnfc2_rel ?>
		<td>
<input type="text" name="x<?php echo $members_list->RowIndex ?>_bnfc2_rel" id="x<?php echo $members_list->RowIndex ?>_bnfc2_rel" size="30" maxlength="45" value="<?php echo $members->bnfc2_rel->EditValue ?>"<?php echo $members->bnfc2_rel->EditAttributes() ?>>
<input type="hidden" name="o<?php echo $members_list->RowIndex ?>_bnfc2_rel" id="o<?php echo $members_list->RowIndex ?>_bnfc2_rel" value="<?php echo ew_HtmlEncode($members->bnfc2_rel->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($members->bnfc3_name->Visible) { // bnfc3_name ?>
		<td>
<input type="text" name="x<?php echo $members_list->RowIndex ?>_bnfc3_name" id="x<?php echo $members_list->RowIndex ?>_bnfc3_name" size="30" maxlength="45" value="<?php echo $members->bnfc3_name->EditValue ?>"<?php echo $members->bnfc3_name->EditAttributes() ?>>
<input type="hidden" name="o<?php echo $members_list->RowIndex ?>_bnfc3_name" id="o<?php echo $members_list->RowIndex ?>_bnfc3_name" value="<?php echo ew_HtmlEncode($members->bnfc3_name->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($members->bnfc3_rel->Visible) { // bnfc3_rel ?>
		<td>
<input type="text" name="x<?php echo $members_list->RowIndex ?>_bnfc3_rel" id="x<?php echo $members_list->RowIndex ?>_bnfc3_rel" size="30" maxlength="45" value="<?php echo $members->bnfc3_rel->EditValue ?>"<?php echo $members->bnfc3_rel->EditAttributes() ?>>
<input type="hidden" name="o<?php echo $members_list->RowIndex ?>_bnfc3_rel" id="o<?php echo $members_list->RowIndex ?>_bnfc3_rel" value="<?php echo ew_HtmlEncode($members->bnfc3_rel->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($members->regis_date->Visible) { // regis_date ?>
		<td>
<input type="text" name="x<?php echo $members_list->RowIndex ?>_regis_date" id="x<?php echo $members_list->RowIndex ?>_regis_date" value="<?php echo $members->regis_date->EditValue ?>"<?php echo $members->regis_date->EditAttributes() ?>>
&nbsp;<img src="phpimages/calendar.png" id="cal_x<?php echo $members_list->RowIndex ?>_regis_date" name="cal_x<?php echo $members_list->RowIndex ?>_regis_date" alt="<?php echo $Language->Phrase("PickDate") ?>" title="<?php echo $Language->Phrase("PickDate") ?>" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField: "x<?php echo $members_list->RowIndex ?>_regis_date", // input field id
	ifFormat: "%d/%m/%Y", // date format
	button: "cal_x<?php echo $members_list->RowIndex ?>_regis_date" // button id
});
</script>
<input type="hidden" name="o<?php echo $members_list->RowIndex ?>_regis_date" id="o<?php echo $members_list->RowIndex ?>_regis_date" value="<?php echo ew_HtmlEncode($members->regis_date->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($members->effective_date->Visible) { // effective_date ?>
		<td>
<input type="text" name="x<?php echo $members_list->RowIndex ?>_effective_date" id="x<?php echo $members_list->RowIndex ?>_effective_date" value="<?php echo $members->effective_date->EditValue ?>"<?php echo $members->effective_date->EditAttributes() ?>>
&nbsp;<img src="phpimages/calendar.png" id="cal_x<?php echo $members_list->RowIndex ?>_effective_date" name="cal_x<?php echo $members_list->RowIndex ?>_effective_date" alt="<?php echo $Language->Phrase("PickDate") ?>" title="<?php echo $Language->Phrase("PickDate") ?>" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField: "x<?php echo $members_list->RowIndex ?>_effective_date", // input field id
	ifFormat: "%d/%m/%Y", // date format
	button: "cal_x<?php echo $members_list->RowIndex ?>_effective_date" // button id
});
</script>
<input type="hidden" name="o<?php echo $members_list->RowIndex ?>_effective_date" id="o<?php echo $members_list->RowIndex ?>_effective_date" value="<?php echo ew_HtmlEncode($members->effective_date->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($members->member_status->Visible) { // member_status ?>
		<td>
<select id="x<?php echo $members_list->RowIndex ?>_member_status" name="x<?php echo $members_list->RowIndex ?>_member_status"<?php echo $members->member_status->EditAttributes() ?>>
<?php
if (is_array($members->member_status->EditValue)) {
	$arwrk = $members->member_status->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($members->member_status->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
if (@$emptywrk) $members->member_status->OldValue = "";
?>
</select>
<?php
$sSqlWrk = "SELECT `s_title`, `s_title` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `memberstatus`";
$sWhereWrk = "";
if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
$sSqlWrk = TEAencrypt($sSqlWrk, EW_RANDOM_KEY);
?>
<input type="hidden" name="s_x<?php echo $members_list->RowIndex ?>_member_status" id="s_x<?php echo $members_list->RowIndex ?>_member_status" value="<?php echo $sSqlWrk; ?>">
<input type="hidden" name="lft_x<?php echo $members_list->RowIndex ?>_member_status" id="lft_x<?php echo $members_list->RowIndex ?>_member_status" value="">
<input type="hidden" name="o<?php echo $members_list->RowIndex ?>_member_status" id="o<?php echo $members_list->RowIndex ?>_member_status" value="<?php echo ew_HtmlEncode($members->member_status->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$members_list->ListOptions->Render("body", "right");
?>
<script language="JavaScript" type="text/javascript">
<!--
ew_UpdateOpts([['x<?php echo $members_list->RowIndex ?>_village_id','x<?php echo $members_list->RowIndex ?>_t_code',false],
['x<?php echo $members_list->RowIndex ?>_t_code','x<?php echo $members_list->RowIndex ?>_t_code',false],
['x<?php echo $members_list->RowIndex ?>_member_status','x<?php echo $members_list->RowIndex ?>_member_status',false]]);

//-->
</script>
	</tr>
<?php
}
?>
</tbody>
</table>
<?php } ?>
<?php if ($members->CurrentAction == "gridadd") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridinsert">
<input type="hidden" name="key_count" id="key_count" value="<?php echo $members_list->KeyCount ?>">
<?php echo $members_list->MultiSelectKey ?>
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($members_list->Recordset)
	$members_list->Recordset->Close();
?>
<?php if ($members_list->TotalRecs > 0) { ?>
<?php if ($members->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($members->CurrentAction <> "gridadd" && $members->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($members_list->Pager)) $members_list->Pager = new cPrevNextPager($members_list->StartRec, $members_list->DisplayRecs, $members_list->TotalRecs) ?>
<?php if ($members_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($members_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $members_list->PageUrl() ?>start=<?php echo $members_list->Pager->FirstButton->Start ?>"><img src="phpimages/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($members_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $members_list->PageUrl() ?>start=<?php echo $members_list->Pager->PrevButton->Start ?>"><img src="phpimages/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $members_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($members_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $members_list->PageUrl() ?>start=<?php echo $members_list->Pager->NextButton->Start ?>"><img src="phpimages/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($members_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $members_list->PageUrl() ?>start=<?php echo $members_list->Pager->LastButton->Start ?>"><img src="phpimages/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $members_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $members_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $members_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $members_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($members_list->SearchWhere == "0=101") { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoRecord") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($members_list->TotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td><?php echo $Language->Phrase("RecordsPerPage") ?>&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="members">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();">
<option value="10"<?php if ($members_list->DisplayRecs == 10) { ?> selected="selected"<?php } ?>>10</option>
<option value="20"<?php if ($members_list->DisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="50"<?php if ($members_list->DisplayRecs == 50) { ?> selected="selected"<?php } ?>>50</option>
<option value="100"<?php if ($members_list->DisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="200"<?php if ($members_list->DisplayRecs == 200) { ?> selected="selected"<?php } ?>>200</option>
<option value="300"<?php if ($members_list->DisplayRecs == 300) { ?> selected="selected"<?php } ?>>300</option>
<option value="500"<?php if ($members_list->DisplayRecs == 500) { ?> selected="selected"<?php } ?>>500</option>
<option value="700"<?php if ($members_list->DisplayRecs == 700) { ?> selected="selected"<?php } ?>>700</option>
<option value="1000"<?php if ($members_list->DisplayRecs == 1000) { ?> selected="selected"<?php } ?>>1000</option>
<option value="ALL"<?php if ($members->getRecordsPerPage() == -1) { ?> selected="selected"<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<span class="phpmaker">
<?php if ($members->CurrentAction <> "gridadd" && $members->CurrentAction <> "gridedit") { // Not grid add/edit mode ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a class="ewGridLink" href="<?php echo $members_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;<a class="ewGridLink" href="<?php echo $members_list->GridAddUrl ?>"><?php echo $Language->Phrase("GridAddLink") ?></a>&nbsp;<?php if ($memberupdatelog->DetailAdd && $Security->IsLoggedIn()) { ?>
<a class="ewGridLink" href="<?php echo $members->AddUrl() . "?" . EW_TABLE_SHOW_DETAIL . "=memberupdatelog" ?>"><?php echo $Language->Phrase("AddLink") ?>&nbsp;<?php echo $members->TableCaption() ?>/<?php echo $memberupdatelog->TableCaption() ?></a>&nbsp;<?php } ?>
<?php } ?><?php if ($members_list->TotalRecs > 0) { ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a class="ewGridLink" href="" onclick="ew_SubmitSelected(document.fmemberslist, 'custompaymentcalculate.php');return false;"><img src="images/button_add_payment.png" width="174" height="37" border="0" align="absmiddle" /></a>
<a class="ewGridLink" href="" onclick="ew_SubmitSelected(document.fmemberslist, '<?php echo $members_list->MultiDeleteUrl ?>');return false;"><?php echo $Language->Phrase("DeleteSelectedLink") ?></a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
<?php } else { // Grid add/edit mode ?>
<?php if ($members->CurrentAction == "gridadd") { ?>
<?php if ($members->AllowAddDeleteRow) { ?>
<a class="ewGridLink" href="javascript:void(0);" onclick="ew_AddGridRow(this);"><?php echo $Language->Phrase("AddBlankRow") ?></a>&nbsp;&nbsp;
<?php } ?>
<a class="ewGridLink" href="" onclick="return ew_SubmitForm(members_list, document.fmemberslist);"><?php echo $Language->Phrase("GridInsertLink") ?></a>&nbsp;&nbsp;
<a class="ewGridLink" href="<?php echo $members_list->PageUrl() ?>a=cancel"><?php echo $Language->Phrase("GridCancelLink") ?></a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
</span>
</div>
<?php } ?>
<?php } ?>
</td></tr></table>
<?php if ($members->Export == "" && $members->CurrentAction == "") { ?>
<script type="text/javascript">
<!--
ew_ToggleSearchPanel(members_list); // Init search panel as collapsed

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--
ew_UpdateOpts([['x_village_id','x_t_code',false],
['x_t_code','x_t_code',false],
['x_member_status','x_member_status',false]]);

//-->
</script>
<?php } ?>
<?php
$members_list->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($members->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$members_list->Page_Terminate();
?>
<?php

//
// Page class
//
class cmembers_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'members';

	// Page object name
	var $PageObjName = 'members_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $members;
		if ($members->UseTokenInUrl) $PageUrl .= "t=" . $members->TableVar . "&"; // Add page token
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
		global $objForm, $members;
		if ($members->UseTokenInUrl) {
			if ($objForm)
				return ($members->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($members->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cmembers_list() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (members)
		if (!isset($GLOBALS["members"])) {
			$GLOBALS["members"] = new cmembers();
			$GLOBALS["Table"] =& $GLOBALS["members"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf";
		$this->AddUrl = "membersadd.php?" . EW_TABLE_SHOW_DETAIL . "=";
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "membersdelete.php";
		$this->MultiUpdateUrl = "membersupdate.php";

		// Table object (administrator)
		if (!isset($GLOBALS['administrator'])) $GLOBALS['administrator'] = new cadministrator();

		// Table object (memberupdatelog)
		if (!isset($GLOBALS['memberupdatelog'])) $GLOBALS['memberupdatelog'] = new cmemberupdatelog();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'members', TRUE);

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
		global $members;

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

		// Create form object
		$objForm = new cFormObj();

		// Get export parameters
		if (@$_GET["export"] <> "") {
			$members->Export = $_GET["export"];
		} elseif (ew_IsHttpPost()) {
			if (@$_POST["exporttype"] <> "")
				$members->Export = $_POST["exporttype"];
		} else {
			$members->setExportReturnUrl(ew_CurrentUrl());
		}
		$gsExport = $members->Export; // Get export parameter, used in header
		$gsExportFile = $members->TableVar; // Get export file, used in header
		$Charset = (EW_CHARSET <> "") ? ";charset=" . EW_CHARSET : ""; // Charset used in header
		if ($members->Export == "excel") {
			header('Content-Type: application/vnd.ms-excel' . $Charset);
			header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
		}

		// Get grid add count
		$gridaddcnt = @$_GET[EW_TABLE_GRID_ADD_ROW_COUNT];
		if (is_numeric($gridaddcnt) && $gridaddcnt > 0)
			$members->GridAddRowCount = $gridaddcnt;

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
		global $objForm, $Language, $gsFormError, $gsSearchError, $Security, $members;

		// Search filters
		$sSrchAdvanced = ""; // Advanced search filter
		$sSrchBasic = ""; // Basic search filter
		$sFilter = "";
		if ($this->IsPageRequest()) { // Validate request

			// Set up records per page
			$this->SetUpDisplayRecs();

			// Handle reset command
			$this->ResetCmd();

			// Check QueryString parameters
			if (@$_GET["a"] <> "") {
				$members->CurrentAction = $_GET["a"];

				// Clear inline mode
				if ($members->CurrentAction == "cancel")
					$this->ClearInlineMode();

				// Switch to grid add mode
				if ($members->CurrentAction == "gridadd")
					$this->GridAddMode();
			} else {
				if (@$_POST["a_list"] <> "") {
					$members->CurrentAction = $_POST["a_list"]; // Get action

					// Grid Insert
					if ($members->CurrentAction == "gridinsert" && @$_SESSION[EW_SESSION_INLINE_MODE] == "gridadd") {
						if ($this->ValidateGridForm()) {
							$this->GridInsert();
						} else {
							$this->setFailureMessage($gsFormError);
							$members->EventCancelled = TRUE;
							$members->CurrentAction = "gridadd"; // Stay in Grid Add mode
						}
					}
				}
			}

			// Hide all options
			if ($members->Export <> "" ||
				$members->CurrentAction == "gridadd" ||
				$members->CurrentAction == "gridedit") {
				$this->ListOptions->HideAllOptions();
				$this->ExportOptions->HideAllOptions();
			}

			// Show grid delete link for grid add / grid edit
			if ($members->AllowAddDeleteRow) {
				if ($members->CurrentAction == "gridadd" ||
					$members->CurrentAction == "gridedit") {
					$item = $this->ListOptions->GetItem("griddelete");
					if ($item) $item->Visible = TRUE;
				}
			}

			// Get and validate search values for advanced search
			$this->LoadSearchValues(); // Get search values
			if (!$this->ValidateSearch())
				$this->setFailureMessage($gsSearchError);

			// Restore search parms from Session
			$this->RestoreSearchParms();

			// Call Recordset SearchValidated event
			$members->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get search criteria for advanced search
			if ($gsSearchError == "")
				$sSrchAdvanced = $this->AdvancedSearchWhere();
		}

		// Restore display records
		if ($members->getRecordsPerPage() <> "") {
			$this->DisplayRecs = $members->getRecordsPerPage(); // Restore from Session
		} else {
			$this->DisplayRecs = 100; // Load default
		}

		// Load Sorting Order
		$this->LoadSortOrder();

		// Build search criteria
		ew_AddFilter($this->SearchWhere, $sSrchAdvanced);
		ew_AddFilter($this->SearchWhere, $sSrchBasic);

		// Call Recordset_Searching event
		$members->Recordset_Searching($this->SearchWhere);

		// Save search criteria
		if ($this->SearchWhere <> "") {
			if ($sSrchAdvanced == "")
				$this->ResetAdvancedSearchParms();
			$members->setSearchWhere($this->SearchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->StartRec = 1; // Reset start record counter
				$members->setStartRecordNumber($this->StartRec);
			}
		} else {
			$this->SearchWhere = $members->getSearchWhere();
		}

		// Build filter
		$sFilter = "";
		ew_AddFilter($sFilter, $this->DbDetailFilter);
		ew_AddFilter($sFilter, $this->SearchWhere);

		// Set up filter in session
		$members->setSessionWhere($sFilter);
		$members->CurrentFilter = "";

		// Export data only
		if (in_array($members->Export, array("html","word","excel","xml","csv","email","pdf"))) {
			$this->ExportData();
			if ($members->Export <> "email")
				$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	// Set up number of records displayed per page
	function SetUpDisplayRecs() {
		global $members;
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
			$members->setRecordsPerPage($this->DisplayRecs); // Save to Session

			// Reset start position
			$this->StartRec = 1;
			$members->setStartRecordNumber($this->StartRec);
		}
	}

	//  Exit inline mode
	function ClearInlineMode() {
		global $members;
		$members->LastAction = $members->CurrentAction; // Save last action
		$members->CurrentAction = ""; // Clear action
		$_SESSION[EW_SESSION_INLINE_MODE] = ""; // Clear inline mode
	}

	// Switch to Grid Add mode
	function GridAddMode() {
		$_SESSION[EW_SESSION_INLINE_MODE] = "gridadd"; // Enabled grid add
	}

	// Perform Grid Add
	function GridInsert() {
		global $conn, $Language, $objForm, $gsFormError, $members;
		$rowindex = 1;
		$bGridInsert = FALSE;

		// Begin transaction
		$conn->BeginTrans();

		// Init key filter
		$sWrkFilter = "";
		$addcnt = 0;
		$sKey = "";

		// Get row count
		$objForm->Index = 0;
		$rowcnt = strval($objForm->GetValue("key_count"));
		if ($rowcnt == "" || !is_numeric($rowcnt))
			$rowcnt = 0;

		// Insert all rows
		for ($rowindex = 1; $rowindex <= $rowcnt; $rowindex++) {

			// Load current row values
			$objForm->Index = $rowindex;
			$rowaction = strval($objForm->GetValue("k_action"));
			if ($rowaction <> "" && $rowaction <> "insert")
				continue; // Skip
			$this->LoadFormValues(); // Get form values
			if (!$this->EmptyRow()) {
				$addcnt++;
				$members->SendEmail = FALSE; // Do not send email on insert success

				// Validate form
				if (!$this->ValidateForm()) {
					$bGridInsert = FALSE; // Form error, reset action
					$this->setFailureMessage($gsFormError);
				} else {
					$bGridInsert = $this->AddRow($this->OldRecordset); // Insert this row
				}
				if ($bGridInsert) {
					if ($sKey <> "") $sKey .= EW_COMPOSITE_KEY_SEPARATOR;
					$sKey .= $members->member_id->CurrentValue;

					// Add filter for this record
					$sFilter = $members->KeyFilter();
					if ($sWrkFilter <> "") $sWrkFilter .= " OR ";
					$sWrkFilter .= $sFilter;
				} else {
					break;
				}
			}
		}
		if ($addcnt == 0) { // No record inserted
			$this->setFailureMessage($Language->Phrase("NoAddRecord"));
			$bGridInsert = FALSE;
		}
		if ($bGridInsert) {
			$conn->CommitTrans(); // Commit transaction

			// Get new recordset
			$members->CurrentFilter = $sWrkFilter;
			$sSql = $members->SQL();
			if ($rs = $conn->Execute($sSql)) {
				$rsnew = $rs->GetRows();
				$rs->Close();
			}
			$this->setSuccessMessage($Language->Phrase("InsertSuccess")); // Set insert success message
			$this->ClearInlineMode(); // Clear grid add mode
		} else {
			$conn->RollbackTrans(); // Rollback transaction
			if ($this->getFailureMessage() == "") {
				$this->setFailureMessage($Language->Phrase("InsertFailed")); // Set insert failed message
			}
			$members->EventCancelled = TRUE; // Set event cancelled
			$members->CurrentAction = "gridadd"; // Stay in gridadd mode
		}
		return $bGridInsert;
	}

	// Check if empty row
	function EmptyRow() {
		global $members, $objForm;
		if ($objForm->HasValue("x_member_code") && $objForm->HasValue("o_member_code") && $members->member_code->CurrentValue <> $members->member_code->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_id_code") && $objForm->HasValue("o_id_code") && $members->id_code->CurrentValue <> $members->id_code->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_prefix") && $objForm->HasValue("o_prefix") && $members->prefix->CurrentValue <> $members->prefix->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_gender") && $objForm->HasValue("o_gender") && $members->gender->CurrentValue <> $members->gender->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_fname") && $objForm->HasValue("o_fname") && $members->fname->CurrentValue <> $members->fname->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_lname") && $objForm->HasValue("o_lname") && $members->lname->CurrentValue <> $members->lname->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_birthdate") && $objForm->HasValue("o_birthdate") && $members->birthdate->CurrentValue <> $members->birthdate->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_age") && $objForm->HasValue("o_age") && $members->age->CurrentValue <> $members->age->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_t_code") && $objForm->HasValue("o_t_code") && $members->t_code->CurrentValue <> $members->t_code->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_village_id") && $objForm->HasValue("o_village_id") && $members->village_id->CurrentValue <> $members->village_id->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_bnfc1_name") && $objForm->HasValue("o_bnfc1_name") && $members->bnfc1_name->CurrentValue <> $members->bnfc1_name->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_bnfc1_rel") && $objForm->HasValue("o_bnfc1_rel") && $members->bnfc1_rel->CurrentValue <> $members->bnfc1_rel->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_bnfc2_name") && $objForm->HasValue("o_bnfc2_name") && $members->bnfc2_name->CurrentValue <> $members->bnfc2_name->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_bnfc2_rel") && $objForm->HasValue("o_bnfc2_rel") && $members->bnfc2_rel->CurrentValue <> $members->bnfc2_rel->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_bnfc3_name") && $objForm->HasValue("o_bnfc3_name") && $members->bnfc3_name->CurrentValue <> $members->bnfc3_name->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_bnfc3_rel") && $objForm->HasValue("o_bnfc3_rel") && $members->bnfc3_rel->CurrentValue <> $members->bnfc3_rel->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_regis_date") && $objForm->HasValue("o_regis_date") && $members->regis_date->CurrentValue <> $members->regis_date->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_effective_date") && $objForm->HasValue("o_effective_date") && $members->effective_date->CurrentValue <> $members->effective_date->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_member_status") && $objForm->HasValue("o_member_status") && $members->member_status->CurrentValue <> $members->member_status->OldValue)
			return FALSE;
		return TRUE;
	}

	// Validate grid form
	function ValidateGridForm() {
		global $objForm;

		// Get row count
		$objForm->Index = 0;
		$rowcnt = strval($objForm->GetValue("key_count"));
		if ($rowcnt == "" || !is_numeric($rowcnt))
			$rowcnt = 0;

		// Validate all records
		for ($rowindex = 1; $rowindex <= $rowcnt; $rowindex++) {

			// Load current row values
			$objForm->Index = $rowindex;
			$rowaction = strval($objForm->GetValue("k_action"));
			if ($rowaction <> "delete" && $rowaction <> "insertdelete") {
				$this->LoadFormValues(); // Get form values
				if ($rowaction == "insert" && $this->EmptyRow()) {

					// Ignore
				} else if (!$this->ValidateForm()) {
					return FALSE;
				}
			}
		}
		return TRUE;
	}

	// Restore form values for current row
	function RestoreCurrentRowFormValues($idx) {
		global $objForm, $members;

		// Get row based on current index
		$objForm->Index = $idx;
		$this->LoadFormValues(); // Load form values
	}

	// Advanced search WHERE clause based on QueryString
	function AdvancedSearchWhere() {
		global $Security, $members;
		$sWhere = "";
		$this->BuildSearchSql($sWhere, $members->member_code, FALSE); // member_code
		$this->BuildSearchSql($sWhere, $members->id_code, FALSE); // id_code
		$this->BuildSearchSql($sWhere, $members->prefix, FALSE); // prefix
		$this->BuildSearchSql($sWhere, $members->gender, FALSE); // gender
		$this->BuildSearchSql($sWhere, $members->fname, FALSE); // fname
		$this->BuildSearchSql($sWhere, $members->lname, FALSE); // lname
		$this->BuildSearchSql($sWhere, $members->birthdate, FALSE); // birthdate
		$this->BuildSearchSql($sWhere, $members->age, FALSE); // age
		$this->BuildSearchSql($sWhere, $members->address, FALSE); // address
		$this->BuildSearchSql($sWhere, $members->t_code, FALSE); // t_code
		$this->BuildSearchSql($sWhere, $members->village_id, FALSE); // village_id
		$this->BuildSearchSql($sWhere, $members->phone, FALSE); // phone
		$this->BuildSearchSql($sWhere, $members->regis_date, FALSE); // regis_date
		$this->BuildSearchSql($sWhere, $members->effective_date, FALSE); // effective_date
		$this->BuildSearchSql($sWhere, $members->attachment, FALSE); // attachment
		$this->BuildSearchSql($sWhere, $members->member_status, FALSE); // member_status
		$this->BuildSearchSql($sWhere, $members->resign_date, FALSE); // resign_date
		$this->BuildSearchSql($sWhere, $members->dead_date, FALSE); // dead_date
		$this->BuildSearchSql($sWhere, $members->terminate_date, FALSE); // terminate_date
		$this->BuildSearchSql($sWhere, $members->note, FALSE); // note

		// Set up search parm
		if ($sWhere <> "") {
			$this->SetSearchParm($members->member_code); // member_code
			$this->SetSearchParm($members->id_code); // id_code
			$this->SetSearchParm($members->prefix); // prefix
			$this->SetSearchParm($members->gender); // gender
			$this->SetSearchParm($members->fname); // fname
			$this->SetSearchParm($members->lname); // lname
			$this->SetSearchParm($members->birthdate); // birthdate
			$this->SetSearchParm($members->age); // age
			$this->SetSearchParm($members->address); // address
			$this->SetSearchParm($members->t_code); // t_code
			$this->SetSearchParm($members->village_id); // village_id
			$this->SetSearchParm($members->phone); // phone
			$this->SetSearchParm($members->regis_date); // regis_date
			$this->SetSearchParm($members->effective_date); // effective_date
			$this->SetSearchParm($members->attachment); // attachment
			$this->SetSearchParm($members->member_status); // member_status
			$this->SetSearchParm($members->resign_date); // resign_date
			$this->SetSearchParm($members->dead_date); // dead_date
			$this->SetSearchParm($members->terminate_date); // terminate_date
			$this->SetSearchParm($members->note); // note
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
		global $members;
		$FldParm = substr($Fld->FldVar, 2);
		$FldVal = $Fld->AdvancedSearch->SearchValue; // @$_GET["x_$FldParm"]
		$FldVal = ew_StripSlashes($FldVal);
		if (is_array($FldVal)) $FldVal = implode(",", $FldVal);
		$FldVal2 = $Fld->AdvancedSearch->SearchValue2; // @$_GET["y_$FldParm"]
		$FldVal2 = ew_StripSlashes($FldVal2);
		if (is_array($FldVal2)) $FldVal2 = implode(",", $FldVal2);
		$members->setAdvancedSearch("x_$FldParm", $FldVal);
		$members->setAdvancedSearch("z_$FldParm", $Fld->AdvancedSearch->SearchOperator); // @$_GET["z_$FldParm"]
		$members->setAdvancedSearch("v_$FldParm", $Fld->AdvancedSearch->SearchCondition); // @$_GET["v_$FldParm"]
		$members->setAdvancedSearch("y_$FldParm", $FldVal2);
		$members->setAdvancedSearch("w_$FldParm", $Fld->AdvancedSearch->SearchOperator2); // @$_GET["w_$FldParm"]
	}

	// Get search parameters
	function GetSearchParm(&$Fld) {
		global $members;
		$FldParm = substr($Fld->FldVar, 2);
		$Fld->AdvancedSearch->SearchValue = $members->getAdvancedSearch("x_$FldParm");
		$Fld->AdvancedSearch->SearchOperator = $members->getAdvancedSearch("z_$FldParm");
		$Fld->AdvancedSearch->SearchCondition = $members->getAdvancedSearch("v_$FldParm");
		$Fld->AdvancedSearch->SearchValue2 = $members->getAdvancedSearch("y_$FldParm");
		$Fld->AdvancedSearch->SearchOperator2 = $members->getAdvancedSearch("w_$FldParm");
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
		global $members;

		// Clear search WHERE clause
		$this->SearchWhere = "";
		$members->setSearchWhere($this->SearchWhere);

		// Clear advanced search parameters
		$this->ResetAdvancedSearchParms();
	}

	// Clear all advanced search parameters
	function ResetAdvancedSearchParms() {
		global $members;
		$members->setAdvancedSearch("x_member_code", "");
		$members->setAdvancedSearch("x_id_code", "");
		$members->setAdvancedSearch("x_prefix", "");
		$members->setAdvancedSearch("x_gender", "");
		$members->setAdvancedSearch("x_fname", "");
		$members->setAdvancedSearch("x_lname", "");
		$members->setAdvancedSearch("x_birthdate", "");
		$members->setAdvancedSearch("x_age", "");
		$members->setAdvancedSearch("x_address", "");
		$members->setAdvancedSearch("x_t_code", "");
		$members->setAdvancedSearch("x_village_id", "");
		$members->setAdvancedSearch("x_phone", "");
		$members->setAdvancedSearch("x_regis_date", "");
		$members->setAdvancedSearch("x_effective_date", "");
		$members->setAdvancedSearch("x_attachment", "");
		$members->setAdvancedSearch("x_member_status", "");
		$members->setAdvancedSearch("x_resign_date", "");
		$members->setAdvancedSearch("x_dead_date", "");
		$members->setAdvancedSearch("x_terminate_date", "");
		$members->setAdvancedSearch("x_note", "");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $members;
		$bRestore = TRUE;
		if ($members->member_code->AdvancedSearch->SearchValue <> "") $bRestore = FALSE;
		if ($members->id_code->AdvancedSearch->SearchValue <> "") $bRestore = FALSE;
		if ($members->prefix->AdvancedSearch->SearchValue <> "") $bRestore = FALSE;
		if ($members->gender->AdvancedSearch->SearchValue <> "") $bRestore = FALSE;
		if ($members->fname->AdvancedSearch->SearchValue <> "") $bRestore = FALSE;
		if ($members->lname->AdvancedSearch->SearchValue <> "") $bRestore = FALSE;
		if ($members->birthdate->AdvancedSearch->SearchValue <> "") $bRestore = FALSE;
		if ($members->age->AdvancedSearch->SearchValue <> "") $bRestore = FALSE;
		if ($members->address->AdvancedSearch->SearchValue <> "") $bRestore = FALSE;
		if ($members->t_code->AdvancedSearch->SearchValue <> "") $bRestore = FALSE;
		if ($members->village_id->AdvancedSearch->SearchValue <> "") $bRestore = FALSE;
		if ($members->phone->AdvancedSearch->SearchValue <> "") $bRestore = FALSE;
		if ($members->regis_date->AdvancedSearch->SearchValue <> "") $bRestore = FALSE;
		if ($members->effective_date->AdvancedSearch->SearchValue <> "") $bRestore = FALSE;
		if ($members->attachment->AdvancedSearch->SearchValue <> "") $bRestore = FALSE;
		if ($members->member_status->AdvancedSearch->SearchValue <> "") $bRestore = FALSE;
		if ($members->resign_date->AdvancedSearch->SearchValue <> "") $bRestore = FALSE;
		if ($members->dead_date->AdvancedSearch->SearchValue <> "") $bRestore = FALSE;
		if ($members->terminate_date->AdvancedSearch->SearchValue <> "") $bRestore = FALSE;
		if ($members->note->AdvancedSearch->SearchValue <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore advanced search values
			$this->GetSearchParm($members->member_code);
			$this->GetSearchParm($members->id_code);
			$this->GetSearchParm($members->prefix);
			$this->GetSearchParm($members->gender);
			$this->GetSearchParm($members->fname);
			$this->GetSearchParm($members->lname);
			$this->GetSearchParm($members->birthdate);
			$this->GetSearchParm($members->age);
			$this->GetSearchParm($members->address);
			$this->GetSearchParm($members->t_code);
			$this->GetSearchParm($members->village_id);
			$this->GetSearchParm($members->phone);
			$this->GetSearchParm($members->regis_date);
			$this->GetSearchParm($members->effective_date);
			$this->GetSearchParm($members->attachment);
			$this->GetSearchParm($members->member_status);
			$this->GetSearchParm($members->resign_date);
			$this->GetSearchParm($members->dead_date);
			$this->GetSearchParm($members->terminate_date);
			$this->GetSearchParm($members->note);
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $members;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$members->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$members->CurrentOrderType = @$_GET["ordertype"];
			$members->UpdateSort($members->member_code); // member_code
			$members->UpdateSort($members->id_code); // id_code
			$members->UpdateSort($members->prefix); // prefix
			$members->UpdateSort($members->gender); // gender
			$members->UpdateSort($members->fname); // fname
			$members->UpdateSort($members->lname); // lname
			$members->UpdateSort($members->birthdate); // birthdate
			$members->UpdateSort($members->age); // age
			$members->UpdateSort($members->t_code); // t_code
			$members->UpdateSort($members->village_id); // village_id
			$members->UpdateSort($members->bnfc1_name); // bnfc1_name
			$members->UpdateSort($members->bnfc1_rel); // bnfc1_rel
			$members->UpdateSort($members->bnfc2_name); // bnfc2_name
			$members->UpdateSort($members->bnfc2_rel); // bnfc2_rel
			$members->UpdateSort($members->bnfc3_name); // bnfc3_name
			$members->UpdateSort($members->bnfc3_rel); // bnfc3_rel
			$members->UpdateSort($members->regis_date); // regis_date
			$members->UpdateSort($members->effective_date); // effective_date
			$members->UpdateSort($members->member_status); // member_status
			$members->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $members;
		$sOrderBy = $members->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($members->SqlOrderBy() <> "") {
				$sOrderBy = $members->SqlOrderBy();
				$members->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $members;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$members->setSessionOrderBy($sOrderBy);
				$members->member_code->setSort("");
				$members->id_code->setSort("");
				$members->prefix->setSort("");
				$members->gender->setSort("");
				$members->fname->setSort("");
				$members->lname->setSort("");
				$members->birthdate->setSort("");
				$members->age->setSort("");
				$members->t_code->setSort("");
				$members->village_id->setSort("");
				$members->bnfc1_name->setSort("");
				$members->bnfc1_rel->setSort("");
				$members->bnfc2_name->setSort("");
				$members->bnfc2_rel->setSort("");
				$members->bnfc3_name->setSort("");
				$members->bnfc3_rel->setSort("");
				$members->regis_date->setSort("");
				$members->effective_date->setSort("");
				$members->member_status->setSort("");
			}

			// Reset start position
			$this->StartRec = 1;
			$members->setStartRecordNumber($this->StartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $Language, $members;

		// "griddelete"
		if ($members->AllowAddDeleteRow) {
			$item =& $this->ListOptions->Add("griddelete");
			$item->CssStyle = "white-space: nowrap;";
			$item->OnLeft = TRUE;
			$item->Visible = FALSE; // Default hidden
		}

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

		// "detail_memberupdatelog"
		$item =& $this->ListOptions->Add("detail_memberupdatelog");
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->IsLoggedIn();
		$item->OnLeft = TRUE;

		// "checkbox"
		$item =& $this->ListOptions->Add("checkbox");
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = ($Security->IsLoggedIn() || $Security->IsLoggedIn());
		$item->OnLeft = TRUE;
		$item->Header = "<input type=\"checkbox\" name=\"key\" id=\"key\" class=\"phpmaker\" onclick=\"members_list.SelectAllKey(this);\">";
		$item->MoveTo(0);

		// Call ListOptions_Load event
		$this->ListOptions_Load();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $members, $objForm;
		$this->ListOptions->LoadDefault();

		// Set up row action and key
		if (is_numeric($this->RowIndex)) {
			$objForm->Index = $this->RowIndex;
			if ($this->RowAction <> "")
				$this->MultiSelectKey .= "<input type=\"hidden\" name=\"k" . $this->RowIndex . "_action\" id=\"k" . $this->RowIndex . "_action\" value=\"" . $this->RowAction . "\">";
			if ($this->RowAction == "delete") {
				$rowkey = $objForm->GetValue("k_key");
				$this->SetupKeyValues($rowkey);
			}
			if ($this->RowAction == "insert" && $members->CurrentAction == "F" && $this->EmptyRow())
				$this->MultiSelectKey .= "<input type=\"hidden\" name=\"k" . $this->RowIndex . "_blankrow\" id=\"k" . $this->RowIndex . "_blankrow\" value=\"1\">";
		}

		// "delete"
		if ($members->AllowAddDeleteRow) {
			if ($members->CurrentAction == "gridadd" || $members->CurrentAction == "gridedit") {
				$oListOpt =& $this->ListOptions->Items["griddelete"];
				$oListOpt->Body = "<a class=\"ewGridLink\" href=\"javascript:void(0);\" onclick=\"ew_DeleteGridRow(this, members_list, " . $this->RowIndex . ");\">" . $Language->Phrase("DeleteLink") . "</a>";
			}
		}

		// "view"
		$oListOpt =& $this->ListOptions->Items["view"];
		if ($Security->IsLoggedIn() && $oListOpt->Visible)
			$oListOpt->Body = "<a class=\"ewRowLink\" href=\"" . $this->ViewUrl . "\">" . $Language->Phrase("ViewLink") . "</a>";

		// "edit"
		$oListOpt =& $this->ListOptions->Items["edit"];
		if ($Security->IsLoggedIn() && $oListOpt->Visible) {
			$oListOpt->Body = "<a class=\"ewRowLink\" href=\"" . $this->EditUrl . "\">" . $Language->Phrase("EditLink") . "</a>";
		}

		// "detail_memberupdatelog"
		$oListOpt =& $this->ListOptions->Items["detail_memberupdatelog"];
		if ($Security->IsLoggedIn()) {
			$oListOpt->Body = $Language->Phrase("DetailLink") . $Language->TablePhrase("memberupdatelog", "TblCaption");
			$oListOpt->Body = "<a class=\"ewRowLink\" href=\"memberupdateloglist.php?" . EW_TABLE_SHOW_MASTER . "=members&member_code=" . urlencode(strval($members->member_code->CurrentValue)) . "\">" . $oListOpt->Body . "</a>";
			$links = "";
			if ($GLOBALS["memberupdatelog"]->DetailEdit && $Security->IsLoggedIn() && $Security->IsLoggedIn())
				$links .= "<a class=\"ewRowLink\" href=\"" . $members->EditUrl(EW_TABLE_SHOW_DETAIL . "=memberupdatelog") . "\">" . $Language->Phrase("EditLink") . "</a>&nbsp;";
			if ($links <> "") $oListOpt->Body .= "<br>" . $links;
		}

		// "checkbox"
		$oListOpt =& $this->ListOptions->Items["checkbox"];
		if (($Security->IsLoggedIn() || $Security->IsLoggedIn()) && $oListOpt->Visible)
			$oListOpt->Body = "<input type=\"checkbox\" name=\"key_m[]\" id=\"key_m[]\" value=\"" . ew_HtmlEncode($members->member_id->CurrentValue) . "\" class=\"phpmaker\" onclick='ew_ClickMultiCheckbox(this);'>";
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	function RenderListOptionsExt() {
		global $Security, $Language, $members;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $members;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$members->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$members->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $members->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$members->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$members->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$members->setStartRecordNumber($this->StartRec);
		}
	}

	// Load default values
	function LoadDefaultValues() {
		global $members;
		$members->member_code->CurrentValue = NULL;
		$members->member_code->OldValue = $members->member_code->CurrentValue;
		$members->id_code->CurrentValue = NULL;
		$members->id_code->OldValue = $members->id_code->CurrentValue;
		$members->prefix->CurrentValue = NULL;
		$members->prefix->OldValue = $members->prefix->CurrentValue;
		$members->gender->CurrentValue = NULL;
		$members->gender->OldValue = $members->gender->CurrentValue;
		$members->fname->CurrentValue = NULL;
		$members->fname->OldValue = $members->fname->CurrentValue;
		$members->lname->CurrentValue = NULL;
		$members->lname->OldValue = $members->lname->CurrentValue;
		$members->birthdate->CurrentValue = NULL;
		$members->birthdate->OldValue = $members->birthdate->CurrentValue;
		$members->age->CurrentValue = NULL;
		$members->age->OldValue = $members->age->CurrentValue;
		$members->t_code->CurrentValue = NULL;
		$members->t_code->OldValue = $members->t_code->CurrentValue;
		$members->village_id->CurrentValue = NULL;
		$members->village_id->OldValue = $members->village_id->CurrentValue;
		$members->bnfc1_name->CurrentValue = NULL;
		$members->bnfc1_name->OldValue = $members->bnfc1_name->CurrentValue;
		$members->bnfc1_rel->CurrentValue = NULL;
		$members->bnfc1_rel->OldValue = $members->bnfc1_rel->CurrentValue;
		$members->bnfc2_name->CurrentValue = NULL;
		$members->bnfc2_name->OldValue = $members->bnfc2_name->CurrentValue;
		$members->bnfc2_rel->CurrentValue = NULL;
		$members->bnfc2_rel->OldValue = $members->bnfc2_rel->CurrentValue;
		$members->bnfc3_name->CurrentValue = NULL;
		$members->bnfc3_name->OldValue = $members->bnfc3_name->CurrentValue;
		$members->bnfc3_rel->CurrentValue = NULL;
		$members->bnfc3_rel->OldValue = $members->bnfc3_rel->CurrentValue;
		$members->regis_date->CurrentValue = NULL;
		$members->regis_date->OldValue = $members->regis_date->CurrentValue;
		$members->effective_date->CurrentValue = NULL;
		$members->effective_date->OldValue = $members->effective_date->CurrentValue;
		$members->member_status->CurrentValue = "ปกติ";
		$members->member_status->OldValue = $members->member_status->CurrentValue;
	}

	//  Load search values for validation
	function LoadSearchValues() {
		global $objForm, $members;

		// Load search values
		// member_code

		$members->member_code->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_member_code"]);
		$members->member_code->AdvancedSearch->SearchOperator = @$_GET["z_member_code"];

		// id_code
		$members->id_code->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_id_code"]);
		$members->id_code->AdvancedSearch->SearchOperator = @$_GET["z_id_code"];

		// prefix
		$members->prefix->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_prefix"]);
		$members->prefix->AdvancedSearch->SearchOperator = @$_GET["z_prefix"];

		// gender
		$members->gender->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_gender"]);
		$members->gender->AdvancedSearch->SearchOperator = @$_GET["z_gender"];

		// fname
		$members->fname->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_fname"]);
		$members->fname->AdvancedSearch->SearchOperator = @$_GET["z_fname"];

		// lname
		$members->lname->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_lname"]);
		$members->lname->AdvancedSearch->SearchOperator = @$_GET["z_lname"];

		// birthdate
		$members->birthdate->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_birthdate"]);
		$members->birthdate->AdvancedSearch->SearchOperator = @$_GET["z_birthdate"];

		// age
		$members->age->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_age"]);
		$members->age->AdvancedSearch->SearchOperator = @$_GET["z_age"];

		// address
		$members->address->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_address"]);
		$members->address->AdvancedSearch->SearchOperator = @$_GET["z_address"];

		// t_code
		$members->t_code->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_t_code"]);
		$members->t_code->AdvancedSearch->SearchOperator = @$_GET["z_t_code"];

		// village_id
		$members->village_id->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_village_id"]);
		$members->village_id->AdvancedSearch->SearchOperator = @$_GET["z_village_id"];

		// phone
		$members->phone->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_phone"]);
		$members->phone->AdvancedSearch->SearchOperator = @$_GET["z_phone"];

		// regis_date
		$members->regis_date->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_regis_date"]);
		$members->regis_date->AdvancedSearch->SearchOperator = @$_GET["z_regis_date"];

		// effective_date
		$members->effective_date->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_effective_date"]);
		$members->effective_date->AdvancedSearch->SearchOperator = @$_GET["z_effective_date"];

		// attachment
		$members->attachment->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_attachment"]);
		$members->attachment->AdvancedSearch->SearchOperator = @$_GET["z_attachment"];

		// member_status
		$members->member_status->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_member_status"]);
		$members->member_status->AdvancedSearch->SearchOperator = @$_GET["z_member_status"];

		// resign_date
		$members->resign_date->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_resign_date"]);
		$members->resign_date->AdvancedSearch->SearchOperator = @$_GET["z_resign_date"];

		// dead_date
		$members->dead_date->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_dead_date"]);
		$members->dead_date->AdvancedSearch->SearchOperator = @$_GET["z_dead_date"];

		// terminate_date
		$members->terminate_date->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_terminate_date"]);
		$members->terminate_date->AdvancedSearch->SearchOperator = @$_GET["z_terminate_date"];

		// note
		$members->note->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_note"]);
		$members->note->AdvancedSearch->SearchOperator = @$_GET["z_note"];
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $members;
		if (!$members->member_code->FldIsDetailKey) {
			$members->member_code->setFormValue($objForm->GetValue("x_member_code"));
		}
		$members->member_code->setOldValue($objForm->GetValue("o_member_code"));
		if (!$members->id_code->FldIsDetailKey) {
			$members->id_code->setFormValue($objForm->GetValue("x_id_code"));
		}
		$members->id_code->setOldValue($objForm->GetValue("o_id_code"));
		if (!$members->prefix->FldIsDetailKey) {
			$members->prefix->setFormValue($objForm->GetValue("x_prefix"));
		}
		$members->prefix->setOldValue($objForm->GetValue("o_prefix"));
		if (!$members->gender->FldIsDetailKey) {
			$members->gender->setFormValue($objForm->GetValue("x_gender"));
		}
		$members->gender->setOldValue($objForm->GetValue("o_gender"));
		if (!$members->fname->FldIsDetailKey) {
			$members->fname->setFormValue($objForm->GetValue("x_fname"));
		}
		$members->fname->setOldValue($objForm->GetValue("o_fname"));
		if (!$members->lname->FldIsDetailKey) {
			$members->lname->setFormValue($objForm->GetValue("x_lname"));
		}
		$members->lname->setOldValue($objForm->GetValue("o_lname"));
		if (!$members->birthdate->FldIsDetailKey) {
			$members->birthdate->setFormValue($objForm->GetValue("x_birthdate"));
			$members->birthdate->CurrentValue = ew_UnFormatDateTime($members->birthdate->CurrentValue, 7);
		}
		$members->birthdate->setOldValue($objForm->GetValue("o_birthdate"));
		if (!$members->age->FldIsDetailKey) {
			$members->age->setFormValue($objForm->GetValue("x_age"));
		}
		$members->age->setOldValue($objForm->GetValue("o_age"));
		if (!$members->t_code->FldIsDetailKey) {
			$members->t_code->setFormValue($objForm->GetValue("x_t_code"));
		}
		$members->t_code->setOldValue($objForm->GetValue("o_t_code"));
		if (!$members->village_id->FldIsDetailKey) {
			$members->village_id->setFormValue($objForm->GetValue("x_village_id"));
		}
		$members->village_id->setOldValue($objForm->GetValue("o_village_id"));
		if (!$members->bnfc1_name->FldIsDetailKey) {
			$members->bnfc1_name->setFormValue($objForm->GetValue("x_bnfc1_name"));
		}
		$members->bnfc1_name->setOldValue($objForm->GetValue("o_bnfc1_name"));
		if (!$members->bnfc1_rel->FldIsDetailKey) {
			$members->bnfc1_rel->setFormValue($objForm->GetValue("x_bnfc1_rel"));
		}
		$members->bnfc1_rel->setOldValue($objForm->GetValue("o_bnfc1_rel"));
		if (!$members->bnfc2_name->FldIsDetailKey) {
			$members->bnfc2_name->setFormValue($objForm->GetValue("x_bnfc2_name"));
		}
		$members->bnfc2_name->setOldValue($objForm->GetValue("o_bnfc2_name"));
		if (!$members->bnfc2_rel->FldIsDetailKey) {
			$members->bnfc2_rel->setFormValue($objForm->GetValue("x_bnfc2_rel"));
		}
		$members->bnfc2_rel->setOldValue($objForm->GetValue("o_bnfc2_rel"));
		if (!$members->bnfc3_name->FldIsDetailKey) {
			$members->bnfc3_name->setFormValue($objForm->GetValue("x_bnfc3_name"));
		}
		$members->bnfc3_name->setOldValue($objForm->GetValue("o_bnfc3_name"));
		if (!$members->bnfc3_rel->FldIsDetailKey) {
			$members->bnfc3_rel->setFormValue($objForm->GetValue("x_bnfc3_rel"));
		}
		$members->bnfc3_rel->setOldValue($objForm->GetValue("o_bnfc3_rel"));
		if (!$members->regis_date->FldIsDetailKey) {
			$members->regis_date->setFormValue($objForm->GetValue("x_regis_date"));
			$members->regis_date->CurrentValue = ew_UnFormatDateTime($members->regis_date->CurrentValue, 7);
		}
		$members->regis_date->setOldValue($objForm->GetValue("o_regis_date"));
		if (!$members->effective_date->FldIsDetailKey) {
			$members->effective_date->setFormValue($objForm->GetValue("x_effective_date"));
			$members->effective_date->CurrentValue = ew_UnFormatDateTime($members->effective_date->CurrentValue, 7);
		}
		$members->effective_date->setOldValue($objForm->GetValue("o_effective_date"));
		if (!$members->member_status->FldIsDetailKey) {
			$members->member_status->setFormValue($objForm->GetValue("x_member_status"));
		}
		$members->member_status->setOldValue($objForm->GetValue("o_member_status"));
		if (!$members->member_id->FldIsDetailKey && $members->CurrentAction <> "gridadd" && $members->CurrentAction <> "add")
			$members->member_id->setFormValue($objForm->GetValue("x_member_id"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $members;
		if ($members->CurrentAction <> "gridadd" && $members->CurrentAction <> "add")
			$members->member_id->CurrentValue = $members->member_id->FormValue;
		$members->member_code->CurrentValue = $members->member_code->FormValue;
		$members->id_code->CurrentValue = $members->id_code->FormValue;
		$members->prefix->CurrentValue = $members->prefix->FormValue;
		$members->gender->CurrentValue = $members->gender->FormValue;
		$members->fname->CurrentValue = $members->fname->FormValue;
		$members->lname->CurrentValue = $members->lname->FormValue;
		$members->birthdate->CurrentValue = $members->birthdate->FormValue;
		$members->birthdate->CurrentValue = ew_UnFormatDateTime($members->birthdate->CurrentValue, 7);
		$members->age->CurrentValue = $members->age->FormValue;
		$members->t_code->CurrentValue = $members->t_code->FormValue;
		$members->village_id->CurrentValue = $members->village_id->FormValue;
		$members->bnfc1_name->CurrentValue = $members->bnfc1_name->FormValue;
		$members->bnfc1_rel->CurrentValue = $members->bnfc1_rel->FormValue;
		$members->bnfc2_name->CurrentValue = $members->bnfc2_name->FormValue;
		$members->bnfc2_rel->CurrentValue = $members->bnfc2_rel->FormValue;
		$members->bnfc3_name->CurrentValue = $members->bnfc3_name->FormValue;
		$members->bnfc3_rel->CurrentValue = $members->bnfc3_rel->FormValue;
		$members->regis_date->CurrentValue = $members->regis_date->FormValue;
		$members->regis_date->CurrentValue = ew_UnFormatDateTime($members->regis_date->CurrentValue, 7);
		$members->effective_date->CurrentValue = $members->effective_date->FormValue;
		$members->effective_date->CurrentValue = ew_UnFormatDateTime($members->effective_date->CurrentValue, 7);
		$members->member_status->CurrentValue = $members->member_status->FormValue;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $members;

		// Call Recordset Selecting event
		$members->Recordset_Selecting($members->CurrentFilter);

		// Load List page SQL
		$sSql = $members->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$members->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $members;
		$sFilter = $members->KeyFilter();

		// Call Row Selecting event
		$members->Row_Selecting($sFilter);

		// Load SQL based on filter
		$members->CurrentFilter = $sFilter;
		$sSql = $members->SQL();
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
		global $conn, $members;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$members->Row_Selected($row);
		$members->member_id->setDbValue($rs->fields('member_id'));
		$members->member_code->setDbValue($rs->fields('member_code'));
		$members->id_code->setDbValue($rs->fields('id_code'));
		$members->prefix->setDbValue($rs->fields('prefix'));
		$members->gender->setDbValue($rs->fields('gender'));
		$members->fname->setDbValue($rs->fields('fname'));
		$members->lname->setDbValue($rs->fields('lname'));
		$members->birthdate->setDbValue($rs->fields('birthdate'));
		$members->age->setDbValue($rs->fields('age'));
		$members->zemail->setDbValue($rs->fields('email'));
		$members->address->setDbValue($rs->fields('address'));
		$members->t_code->setDbValue($rs->fields('t_code'));
		$members->village_id->setDbValue($rs->fields('village_id'));
		$members->phone->setDbValue($rs->fields('phone'));
		$members->suffix->Upload->DbValue = $rs->fields('suffix');
		$members->bnfc1_name->setDbValue($rs->fields('bnfc1_name'));
		$members->bnfc1_rel->setDbValue($rs->fields('bnfc1_rel'));
		$members->bnfc2_name->setDbValue($rs->fields('bnfc2_name'));
		$members->bnfc2_rel->setDbValue($rs->fields('bnfc2_rel'));
		$members->bnfc3_name->setDbValue($rs->fields('bnfc3_name'));
		$members->bnfc3_rel->setDbValue($rs->fields('bnfc3_rel'));
		$members->bnfc4_name->setDbValue($rs->fields('bnfc4_name'));
		$members->bnfc4_rel->setDbValue($rs->fields('bnfc4_rel'));
		$members->regis_date->setDbValue($rs->fields('regis_date'));
		$members->effective_date->setDbValue($rs->fields('effective_date'));
		$members->attachment->setDbValue($rs->fields('attachment'));
		$members->member_status->setDbValue($rs->fields('member_status'));
		$members->resign_date->setDbValue($rs->fields('resign_date'));
		$members->dead_date->setDbValue($rs->fields('dead_date'));
		$members->terminate_date->setDbValue($rs->fields('terminate_date'));
		$members->advance_budget->setDbValue($rs->fields('advance_budget'));
		$members->dead_id->setDbValue($rs->fields('dead_id'));
		$members->note->setDbValue($rs->fields('note'));
		$members->update_detail->setDbValue($rs->fields('update_detail'));
		$members->member_type->setDbValue($rs->fields('member_type'));
	}

	// Load old record
	function LoadOldRecord() {
		global $members;

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($members->getKey("member_id")) <> "")
			$members->member_id->CurrentValue = $members->getKey("member_id"); // member_id
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$members->CurrentFilter = $members->KeyFilter();
			$sSql = $members->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		} else {
			$this->OldRecordset = NULL;
		}
		return $bValidKey;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $members;

		// Initialize URLs
		$this->ViewUrl = $members->ViewUrl();
		$this->EditUrl = $members->EditUrl();
		$this->InlineEditUrl = $members->InlineEditUrl();
		$this->CopyUrl = $members->CopyUrl();
		$this->InlineCopyUrl = $members->InlineCopyUrl();
		$this->DeleteUrl = $members->DeleteUrl();

		// Call Row_Rendering event
		$members->Row_Rendering();

		// Common render codes for all row types
		// member_id

		$members->member_id->CellCssStyle = "white-space: nowrap;";

		// member_code
		// id_code
		// prefix
		// gender
		// fname

		$members->fname->CellCssStyle = "white-space: nowrap;";

		// lname
		$members->lname->CellCssStyle = "white-space: nowrap;";

		// birthdate
		// age
		// email

		$members->zemail->CellCssStyle = "white-space: nowrap;";

		// address
		// t_code

		$members->t_code->CellCssStyle = "white-space: nowrap;";

		// village_id
		$members->village_id->CellCssStyle = "white-space: nowrap;";

		// phone
		// suffix

		$members->suffix->CellCssStyle = "white-space: nowrap;";

		// bnfc1_name
		$members->bnfc1_name->CellCssStyle = "white-space: nowrap;";

		// bnfc1_rel
		$members->bnfc1_rel->CellCssStyle = "white-space: nowrap;";

		// bnfc2_name
		$members->bnfc2_name->CellCssStyle = "white-space: nowrap;";

		// bnfc2_rel
		$members->bnfc2_rel->CellCssStyle = "white-space: nowrap;";

		// bnfc3_name
		$members->bnfc3_name->CellCssStyle = "white-space: nowrap;";

		// bnfc3_rel
		$members->bnfc3_rel->CellCssStyle = "white-space: nowrap;";

		// bnfc4_name
		$members->bnfc4_name->CellCssStyle = "white-space: nowrap;";

		// bnfc4_rel
		$members->bnfc4_rel->CellCssStyle = "white-space: nowrap;";

		// regis_date
		// effective_date
		// attachment

		$members->attachment->CellCssStyle = "white-space: nowrap;";

		// member_status
		$members->member_status->CellCssStyle = "white-space: nowrap;";

		// resign_date
		$members->resign_date->CellCssStyle = "white-space: nowrap;";

		// dead_date
		$members->dead_date->CellCssStyle = "white-space: nowrap;";

		// terminate_date
		$members->terminate_date->CellCssStyle = "white-space: nowrap;";

		// advance_budget
		$members->advance_budget->CellCssStyle = "white-space: nowrap;";

		// dead_id
		$members->dead_id->CellCssStyle = "white-space: nowrap;";

		// note
		// update_detail

		$members->update_detail->CellCssStyle = "white-space: nowrap;";

		// member_type
		$members->member_type->CellCssStyle = "white-space: nowrap;";
		if ($members->RowType == EW_ROWTYPE_VIEW) { // View row

			// member_code
			$members->member_code->ViewValue = $members->member_code->CurrentValue;
			$members->member_code->ViewCustomAttributes = "";

			// id_code
			$members->id_code->ViewValue = $members->id_code->CurrentValue;
			$members->id_code->ViewCustomAttributes = "";

			// prefix
			if (strval($members->prefix->CurrentValue) <> "") {
				$sFilterWrk = "`p_title` = '" . ew_AdjustSql($members->prefix->CurrentValue) . "'";
			$sSqlWrk = "SELECT `p_title` FROM `prefix`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$members->prefix->ViewValue = $rswrk->fields('p_title');
					$rswrk->Close();
				} else {
					$members->prefix->ViewValue = $members->prefix->CurrentValue;
				}
			} else {
				$members->prefix->ViewValue = NULL;
			}
			$members->prefix->ViewCustomAttributes = "";

			// gender
			if (strval($members->gender->CurrentValue) <> "") {
				$sFilterWrk = "`g_title` = '" . ew_AdjustSql($members->gender->CurrentValue) . "'";
			$sSqlWrk = "SELECT `g_title` FROM `gender`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$members->gender->ViewValue = $rswrk->fields('g_title');
					$rswrk->Close();
				} else {
					$members->gender->ViewValue = $members->gender->CurrentValue;
				}
			} else {
				$members->gender->ViewValue = NULL;
			}
			$members->gender->ViewCustomAttributes = "";

			// fname
			$members->fname->ViewValue = $members->fname->CurrentValue;
			$members->fname->ViewCustomAttributes = "";

			// lname
			$members->lname->ViewValue = $members->lname->CurrentValue;
			$members->lname->ViewCustomAttributes = "";

			// birthdate
			$members->birthdate->ViewValue = $members->birthdate->CurrentValue;
			$members->birthdate->ViewValue = ew_FormatDateTime($members->birthdate->ViewValue, 7);
			$members->birthdate->ViewCustomAttributes = "";

			// age
			$members->age->ViewValue = $members->age->CurrentValue;
			$members->age->ViewCustomAttributes = "";

			// address
			$members->address->ViewValue = $members->address->CurrentValue;
			$members->address->ViewCustomAttributes = "";

			// t_code
			if (strval($members->t_code->CurrentValue) <> "") {
				$sFilterWrk = "`t_code` = '" . ew_AdjustSql($members->t_code->CurrentValue) . "'";
			$sSqlWrk = "SELECT `t_code`, `t_title` FROM `tambon`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `t_code`";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$members->t_code->ViewValue = $rswrk->fields('t_code');
					$members->t_code->ViewValue .= ew_ValueSeparator(0,1,$members->t_code) . $rswrk->fields('t_title');
					$rswrk->Close();
				} else {
					$members->t_code->ViewValue = $members->t_code->CurrentValue;
				}
			} else {
				$members->t_code->ViewValue = NULL;
			}
			$members->t_code->ViewCustomAttributes = "";

			// village_id
			if (strval($members->village_id->CurrentValue) <> "") {
				$sFilterWrk = "`village_id` = " . ew_AdjustSql($members->village_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `v_code`, `v_title` FROM `village`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `v_code`";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$members->village_id->ViewValue = $rswrk->fields('v_code');
					$members->village_id->ViewValue .= ew_ValueSeparator(0,1,$members->village_id) . $rswrk->fields('v_title');
					$rswrk->Close();
				} else {
					$members->village_id->ViewValue = $members->village_id->CurrentValue;
				}
			} else {
				$members->village_id->ViewValue = NULL;
			}
			$members->village_id->ViewCustomAttributes = "";

			// phone
			$members->phone->ViewValue = $members->phone->CurrentValue;
			$members->phone->ViewCustomAttributes = "";

			// bnfc1_name
			$members->bnfc1_name->ViewValue = $members->bnfc1_name->CurrentValue;
			$members->bnfc1_name->ViewCustomAttributes = "";

			// bnfc1_rel
			$members->bnfc1_rel->ViewValue = $members->bnfc1_rel->CurrentValue;
			$members->bnfc1_rel->ViewCustomAttributes = "";

			// bnfc2_name
			$members->bnfc2_name->ViewValue = $members->bnfc2_name->CurrentValue;
			$members->bnfc2_name->ViewCustomAttributes = "";

			// bnfc2_rel
			$members->bnfc2_rel->ViewValue = $members->bnfc2_rel->CurrentValue;
			$members->bnfc2_rel->ViewCustomAttributes = "";

			// bnfc3_name
			$members->bnfc3_name->ViewValue = $members->bnfc3_name->CurrentValue;
			$members->bnfc3_name->ViewCustomAttributes = "";

			// bnfc3_rel
			$members->bnfc3_rel->ViewValue = $members->bnfc3_rel->CurrentValue;
			$members->bnfc3_rel->ViewCustomAttributes = "";

			// regis_date
			$members->regis_date->ViewValue = $members->regis_date->CurrentValue;
			$members->regis_date->ViewValue = ew_FormatDateTime($members->regis_date->ViewValue, 7);
			$members->regis_date->ViewCustomAttributes = "";

			// effective_date
			$members->effective_date->ViewValue = $members->effective_date->CurrentValue;
			$members->effective_date->ViewValue = ew_FormatDateTime($members->effective_date->ViewValue, 7);
			$members->effective_date->ViewCustomAttributes = "";

			// attachment
			$members->attachment->ViewValue = $members->attachment->CurrentValue;
			$members->attachment->ViewCustomAttributes = "";

			// member_status
			if (strval($members->member_status->CurrentValue) <> "") {
				$sFilterWrk = "`s_title` = '" . ew_AdjustSql($members->member_status->CurrentValue) . "'";
			$sSqlWrk = "SELECT `s_title` FROM `memberstatus`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$members->member_status->ViewValue = $rswrk->fields('s_title');
					$rswrk->Close();
				} else {
					$members->member_status->ViewValue = $members->member_status->CurrentValue;
				}
			} else {
				$members->member_status->ViewValue = NULL;
			}
			$members->member_status->ViewCustomAttributes = "";

			// resign_date
			$members->resign_date->ViewValue = $members->resign_date->CurrentValue;
			$members->resign_date->ViewValue = ew_FormatDateTime($members->resign_date->ViewValue, 7);
			$members->resign_date->ViewCustomAttributes = "";

			// dead_date
			$members->dead_date->ViewValue = $members->dead_date->CurrentValue;
			$members->dead_date->ViewValue = ew_FormatDateTime($members->dead_date->ViewValue, 7);
			$members->dead_date->ViewCustomAttributes = "";

			// terminate_date
			$members->terminate_date->ViewValue = $members->terminate_date->CurrentValue;
			$members->terminate_date->ViewValue = ew_FormatDateTime($members->terminate_date->ViewValue, 7);
			$members->terminate_date->ViewCustomAttributes = "";

			// member_code
			$members->member_code->LinkCustomAttributes = "";
			$members->member_code->HrefValue = "";
			$members->member_code->TooltipValue = "";
			if ($members->Export == "")
				$members->member_code->ViewValue = ew_Highlight($members->HighlightName(), $members->member_code->ViewValue, "", "", $members->getAdvancedSearch("x_member_code"));

			// id_code
			$members->id_code->LinkCustomAttributes = "";
			$members->id_code->HrefValue = "";
			$members->id_code->TooltipValue = "";
			if ($members->Export == "")
				$members->id_code->ViewValue = ew_Highlight($members->HighlightName(), $members->id_code->ViewValue, "", "", $members->getAdvancedSearch("x_id_code"));

			// prefix
			$members->prefix->LinkCustomAttributes = "";
			$members->prefix->HrefValue = "";
			$members->prefix->TooltipValue = "";

			// gender
			$members->gender->LinkCustomAttributes = "";
			$members->gender->HrefValue = "";
			$members->gender->TooltipValue = "";

			// fname
			$members->fname->LinkCustomAttributes = "";
			$members->fname->HrefValue = "";
			$members->fname->TooltipValue = "";
			if ($members->Export == "")
				$members->fname->ViewValue = ew_Highlight($members->HighlightName(), $members->fname->ViewValue, "", "", $members->getAdvancedSearch("x_fname"));

			// lname
			$members->lname->LinkCustomAttributes = "";
			$members->lname->HrefValue = "";
			$members->lname->TooltipValue = "";
			if ($members->Export == "")
				$members->lname->ViewValue = ew_Highlight($members->HighlightName(), $members->lname->ViewValue, "", "", $members->getAdvancedSearch("x_lname"));

			// birthdate
			$members->birthdate->LinkCustomAttributes = "";
			$members->birthdate->HrefValue = "";
			$members->birthdate->TooltipValue = "";

			// age
			$members->age->LinkCustomAttributes = "";
			$members->age->HrefValue = "";
			$members->age->TooltipValue = "";

			// t_code
			$members->t_code->LinkCustomAttributes = "";
			$members->t_code->HrefValue = "";
			$members->t_code->TooltipValue = "";

			// village_id
			$members->village_id->LinkCustomAttributes = "";
			$members->village_id->HrefValue = "";
			$members->village_id->TooltipValue = "";

			// bnfc1_name
			$members->bnfc1_name->LinkCustomAttributes = "";
			$members->bnfc1_name->HrefValue = "";
			$members->bnfc1_name->TooltipValue = "";

			// bnfc1_rel
			$members->bnfc1_rel->LinkCustomAttributes = "";
			$members->bnfc1_rel->HrefValue = "";
			$members->bnfc1_rel->TooltipValue = "";

			// bnfc2_name
			$members->bnfc2_name->LinkCustomAttributes = "";
			$members->bnfc2_name->HrefValue = "";
			$members->bnfc2_name->TooltipValue = "";

			// bnfc2_rel
			$members->bnfc2_rel->LinkCustomAttributes = "";
			$members->bnfc2_rel->HrefValue = "";
			$members->bnfc2_rel->TooltipValue = "";

			// bnfc3_name
			$members->bnfc3_name->LinkCustomAttributes = "";
			$members->bnfc3_name->HrefValue = "";
			$members->bnfc3_name->TooltipValue = "";

			// bnfc3_rel
			$members->bnfc3_rel->LinkCustomAttributes = "";
			$members->bnfc3_rel->HrefValue = "";
			$members->bnfc3_rel->TooltipValue = "";

			// regis_date
			$members->regis_date->LinkCustomAttributes = "";
			$members->regis_date->HrefValue = "";
			$members->regis_date->TooltipValue = "";

			// effective_date
			$members->effective_date->LinkCustomAttributes = "";
			$members->effective_date->HrefValue = "";
			$members->effective_date->TooltipValue = "";

			// member_status
			$members->member_status->LinkCustomAttributes = "";
			$members->member_status->HrefValue = "";
			$members->member_status->TooltipValue = "";
		} elseif ($members->RowType == EW_ROWTYPE_ADD) { // Add row

			// member_code
			$members->member_code->EditCustomAttributes = "";
			$members->member_code->EditValue = ew_HtmlEncode($members->member_code->CurrentValue);

			// id_code
			$members->id_code->EditCustomAttributes = "";
			$members->id_code->EditValue = ew_HtmlEncode($members->id_code->CurrentValue);

			// prefix
			$members->prefix->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `p_title`, `p_title` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld` FROM `prefix`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$members->prefix->EditValue = $arwrk;

			// gender
			$members->gender->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `g_title`, `g_title` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld` FROM `gender`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$members->gender->EditValue = $arwrk;

			// fname
			$members->fname->EditCustomAttributes = "";
			$members->fname->EditValue = ew_HtmlEncode($members->fname->CurrentValue);

			// lname
			$members->lname->EditCustomAttributes = "";
			$members->lname->EditValue = ew_HtmlEncode($members->lname->CurrentValue);

			// birthdate
			$members->birthdate->EditCustomAttributes = "";
			$members->birthdate->EditValue = ew_HtmlEncode(ew_FormatDateTime($members->birthdate->CurrentValue, 7));

			// age
			$members->age->EditCustomAttributes = "";
			$members->age->EditValue = ew_HtmlEncode($members->age->CurrentValue);

			// t_code
			$members->t_code->EditCustomAttributes = "";
			if (trim(strval($members->t_code->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`t_code` = '" . ew_AdjustSql($members->t_code->CurrentValue) . "'";
			}
			$sSqlWrk = "SELECT `t_code`, `t_code` AS `DispFld`, `t_title` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld` FROM `tambon`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `t_code`";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect"), ""));
			$members->t_code->EditValue = $arwrk;

			// village_id
			$members->village_id->EditCustomAttributes = "";
			if (trim(strval($members->village_id->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`village_id` = " . ew_AdjustSql($members->village_id->CurrentValue) . "";
			}
			$sSqlWrk = "SELECT `village_id`, `v_code` AS `DispFld`, `v_title` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, `t_code` AS `SelectFilterFld` FROM `village`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `v_code`";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect"), "", ""));
			$members->village_id->EditValue = $arwrk;

			// bnfc1_name
			$members->bnfc1_name->EditCustomAttributes = "";
			$members->bnfc1_name->EditValue = ew_HtmlEncode($members->bnfc1_name->CurrentValue);

			// bnfc1_rel
			$members->bnfc1_rel->EditCustomAttributes = "";
			$members->bnfc1_rel->EditValue = ew_HtmlEncode($members->bnfc1_rel->CurrentValue);

			// bnfc2_name
			$members->bnfc2_name->EditCustomAttributes = "";
			$members->bnfc2_name->EditValue = ew_HtmlEncode($members->bnfc2_name->CurrentValue);

			// bnfc2_rel
			$members->bnfc2_rel->EditCustomAttributes = "";
			$members->bnfc2_rel->EditValue = ew_HtmlEncode($members->bnfc2_rel->CurrentValue);

			// bnfc3_name
			$members->bnfc3_name->EditCustomAttributes = "";
			$members->bnfc3_name->EditValue = ew_HtmlEncode($members->bnfc3_name->CurrentValue);

			// bnfc3_rel
			$members->bnfc3_rel->EditCustomAttributes = "";
			$members->bnfc3_rel->EditValue = ew_HtmlEncode($members->bnfc3_rel->CurrentValue);

			// regis_date
			$members->regis_date->EditCustomAttributes = "";
			$members->regis_date->EditValue = ew_HtmlEncode(ew_FormatDateTime($members->regis_date->CurrentValue, 7));

			// effective_date
			$members->effective_date->EditCustomAttributes = "";
			$members->effective_date->EditValue = ew_HtmlEncode(ew_FormatDateTime($members->effective_date->CurrentValue, 7));

			// member_status
			$members->member_status->EditCustomAttributes = 'onchange=showmemberfield(this.options[this.selectedIndex].value);';
			if (trim(strval($members->member_status->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`s_title` = '" . ew_AdjustSql($members->member_status->CurrentValue) . "'";
			}
			$sSqlWrk = "SELECT `s_title`, `s_title` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld` FROM `memberstatus`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$members->member_status->EditValue = $arwrk;

			// Edit refer script
			// member_code

			$members->member_code->HrefValue = "";

			// id_code
			$members->id_code->HrefValue = "";

			// prefix
			$members->prefix->HrefValue = "";

			// gender
			$members->gender->HrefValue = "";

			// fname
			$members->fname->HrefValue = "";

			// lname
			$members->lname->HrefValue = "";

			// birthdate
			$members->birthdate->HrefValue = "";

			// age
			$members->age->HrefValue = "";

			// t_code
			$members->t_code->HrefValue = "";

			// village_id
			$members->village_id->HrefValue = "";

			// bnfc1_name
			$members->bnfc1_name->HrefValue = "";

			// bnfc1_rel
			$members->bnfc1_rel->HrefValue = "";

			// bnfc2_name
			$members->bnfc2_name->HrefValue = "";

			// bnfc2_rel
			$members->bnfc2_rel->HrefValue = "";

			// bnfc3_name
			$members->bnfc3_name->HrefValue = "";

			// bnfc3_rel
			$members->bnfc3_rel->HrefValue = "";

			// regis_date
			$members->regis_date->HrefValue = "";

			// effective_date
			$members->effective_date->HrefValue = "";

			// member_status
			$members->member_status->HrefValue = "";
		} elseif ($members->RowType == EW_ROWTYPE_SEARCH) { // Search row

			// member_code
			$members->member_code->EditCustomAttributes = "";
			$members->member_code->EditValue = ew_HtmlEncode($members->member_code->AdvancedSearch->SearchValue);

			// id_code
			$members->id_code->EditCustomAttributes = "";
			$members->id_code->EditValue = ew_HtmlEncode($members->id_code->AdvancedSearch->SearchValue);

			// prefix
			$members->prefix->EditCustomAttributes = "";

			// gender
			$members->gender->EditCustomAttributes = "";

			// fname
			$members->fname->EditCustomAttributes = "";
			$members->fname->EditValue = ew_HtmlEncode($members->fname->AdvancedSearch->SearchValue);

			// lname
			$members->lname->EditCustomAttributes = "";
			$members->lname->EditValue = ew_HtmlEncode($members->lname->AdvancedSearch->SearchValue);

			// birthdate
			$members->birthdate->EditCustomAttributes = "";
			$members->birthdate->EditValue = ew_HtmlEncode(ew_FormatDateTime(ew_UnFormatDateTime($members->birthdate->AdvancedSearch->SearchValue, 7), 7));

			// age
			$members->age->EditCustomAttributes = "";
			$members->age->EditValue = ew_HtmlEncode($members->age->AdvancedSearch->SearchValue);

			// t_code
			$members->t_code->EditCustomAttributes = "";
			if (trim(strval($members->t_code->AdvancedSearch->SearchValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`t_code` = '" . ew_AdjustSql($members->t_code->AdvancedSearch->SearchValue) . "'";
			}
			$sSqlWrk = "SELECT `t_code`, `t_code` AS `DispFld`, `t_title` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld` FROM `tambon`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `t_code`";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect"), ""));
			$members->t_code->EditValue = $arwrk;

			// village_id
			$members->village_id->EditCustomAttributes = "";
			if (trim(strval($members->village_id->AdvancedSearch->SearchValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`village_id` = " . ew_AdjustSql($members->village_id->AdvancedSearch->SearchValue) . "";
			}
			$sSqlWrk = "SELECT `village_id`, `v_code` AS `DispFld`, `v_title` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, `t_code` AS `SelectFilterFld` FROM `village`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `v_code`";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect"), "", ""));
			$members->village_id->EditValue = $arwrk;

			// bnfc1_name
			$members->bnfc1_name->EditCustomAttributes = "";
			$members->bnfc1_name->EditValue = ew_HtmlEncode($members->bnfc1_name->AdvancedSearch->SearchValue);

			// bnfc1_rel
			$members->bnfc1_rel->EditCustomAttributes = "";
			$members->bnfc1_rel->EditValue = ew_HtmlEncode($members->bnfc1_rel->AdvancedSearch->SearchValue);

			// bnfc2_name
			$members->bnfc2_name->EditCustomAttributes = "";
			$members->bnfc2_name->EditValue = ew_HtmlEncode($members->bnfc2_name->AdvancedSearch->SearchValue);

			// bnfc2_rel
			$members->bnfc2_rel->EditCustomAttributes = "";
			$members->bnfc2_rel->EditValue = ew_HtmlEncode($members->bnfc2_rel->AdvancedSearch->SearchValue);

			// bnfc3_name
			$members->bnfc3_name->EditCustomAttributes = "";
			$members->bnfc3_name->EditValue = ew_HtmlEncode($members->bnfc3_name->AdvancedSearch->SearchValue);

			// bnfc3_rel
			$members->bnfc3_rel->EditCustomAttributes = "";
			$members->bnfc3_rel->EditValue = ew_HtmlEncode($members->bnfc3_rel->AdvancedSearch->SearchValue);

			// regis_date
			$members->regis_date->EditCustomAttributes = "";
			$members->regis_date->EditValue = ew_HtmlEncode(ew_FormatDateTime(ew_UnFormatDateTime($members->regis_date->AdvancedSearch->SearchValue, 7), 7));

			// effective_date
			$members->effective_date->EditCustomAttributes = "";
			$members->effective_date->EditValue = ew_HtmlEncode(ew_FormatDateTime(ew_UnFormatDateTime($members->effective_date->AdvancedSearch->SearchValue, 7), 7));

			// member_status
			$members->member_status->EditCustomAttributes = 'onchange=showmemberfield(this.options[this.selectedIndex].value);';
			if (trim(strval($members->member_status->AdvancedSearch->SearchValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`s_title` = '" . ew_AdjustSql($members->member_status->AdvancedSearch->SearchValue) . "'";
			}
			$sSqlWrk = "SELECT `s_title`, `s_title` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld` FROM `memberstatus`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$members->member_status->EditValue = $arwrk;
		}
		if ($members->RowType == EW_ROWTYPE_ADD ||
			$members->RowType == EW_ROWTYPE_EDIT ||
			$members->RowType == EW_ROWTYPE_SEARCH) { // Add / Edit / Search row
			$members->SetupFieldTitles();
		}

		// Call Row Rendered event
		if ($members->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$members->Row_Rendered();
	}

	// Validate search
	function ValidateSearch() {
		global $gsSearchError, $members;

		// Initialize
		$gsSearchError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return TRUE;
		if (!ew_CheckInteger($members->id_code->AdvancedSearch->SearchValue)) {
			ew_AddMessage($gsSearchError, $members->id_code->FldErrMsg());
		}

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

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $members;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($members->prefix->FormValue) && $members->prefix->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $members->prefix->FldCaption());
		}
		if (!is_null($members->gender->FormValue) && $members->gender->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $members->gender->FldCaption());
		}
		if (!is_null($members->fname->FormValue) && $members->fname->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $members->fname->FldCaption());
		}
		if (!is_null($members->lname->FormValue) && $members->lname->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $members->lname->FldCaption());
		}
		if (!is_null($members->birthdate->FormValue) && $members->birthdate->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $members->birthdate->FldCaption());
		}
		if (!ew_CheckEuroDate($members->birthdate->FormValue)) {
			ew_AddMessage($gsFormError, $members->birthdate->FldErrMsg());
		}
		if (!is_null($members->t_code->FormValue) && $members->t_code->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $members->t_code->FldCaption());
		}
		if (!is_null($members->village_id->FormValue) && $members->village_id->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $members->village_id->FldCaption());
		}
		if (!is_null($members->bnfc1_name->FormValue) && $members->bnfc1_name->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $members->bnfc1_name->FldCaption());
		}
		if (!is_null($members->bnfc1_rel->FormValue) && $members->bnfc1_rel->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $members->bnfc1_rel->FldCaption());
		}
		if (!is_null($members->regis_date->FormValue) && $members->regis_date->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $members->regis_date->FldCaption());
		}
		if (!ew_CheckEuroDate($members->regis_date->FormValue)) {
			ew_AddMessage($gsFormError, $members->regis_date->FldErrMsg());
		}
		if (!is_null($members->effective_date->FormValue) && $members->effective_date->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $members->effective_date->FldCaption());
		}
		if (!ew_CheckEuroDate($members->effective_date->FormValue)) {
			ew_AddMessage($gsFormError, $members->effective_date->FldErrMsg());
		}
		if (!is_null($members->member_status->FormValue) && $members->member_status->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $members->member_status->FldCaption());
		}

		// Return validate result
		$ValidateForm = ($gsFormError == "");

		// Call Form_CustomValidate event
		$sFormCustomError = "";
		$ValidateForm = $ValidateForm && $this->Form_CustomValidate($sFormCustomError);
		if ($sFormCustomError <> "") {
			ew_AddMessage($gsFormError, $sFormCustomError);
		}
		return $ValidateForm;
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $members;
		$DeleteRows = TRUE;
		$sSql = $members->SQL();
		$conn->raiseErrorFn = 'ew_ErrorFn';
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';
		if ($rs === FALSE) {
			return FALSE;
		} elseif ($rs->EOF) {
			$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
			$rs->Close();
			return FALSE;
		}

		// Clone old rows
		$rsold = ($rs) ? $rs->GetRows() : array();
		if ($rs)
			$rs->Close();

		// Call row deleting event
		if ($DeleteRows) {
			foreach ($rsold as $row) {
				$DeleteRows = $members->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['member_id'];
				@unlink(ew_UploadPathEx(TRUE, $members->suffix->UploadPath) . $row['suffix']);
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $conn->Execute($members->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($members->CancelMessage <> "") {
				$this->setFailureMessage($members->CancelMessage);
				$members->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->Phrase("DeleteCancelled"));
			}
		}
		if ($DeleteRows) {
		} else {
		}

		// Call Row Deleted event
		if ($DeleteRows) {
			foreach ($rsold as $row) {
				$members->Row_Deleted($row);
			}
		}
		return $DeleteRows;
	}

	// Add record
	function AddRow($rsold = NULL) {
		global $conn, $Language, $Security, $members;
		if ($members->member_code->CurrentValue <> "") { // Check field with unique index
			$sFilter = "(member_code = '" . ew_AdjustSql($members->member_code->CurrentValue) . "')";
			$rsChk = $members->LoadRs($sFilter);
			if ($rsChk && !$rsChk->EOF) {
				$sIdxErrMsg = str_replace("%f", $members->member_code->FldCaption(), $Language->Phrase("DupIndex"));
				$sIdxErrMsg = str_replace("%v", $members->member_code->CurrentValue, $sIdxErrMsg);
				$this->setFailureMessage($sIdxErrMsg);
				$rsChk->Close();
				return FALSE;
			}
		}
	/*	if ($members->id_code->CurrentValue <> "") { // Check field with unique index
			$sFilter = "(id_code = '" . ew_AdjustSql($members->id_code->CurrentValue) . "')";
			$rsChk = $members->LoadRs($sFilter);
			if ($rsChk && !$rsChk->EOF) {
				$sIdxErrMsg = str_replace("%f", $members->id_code->FldCaption(), $Language->Phrase("DupIndex"));
				$sIdxErrMsg = str_replace("%v", $members->id_code->CurrentValue, $sIdxErrMsg);
				$this->setFailureMessage($sIdxErrMsg);
				$rsChk->Close();
				return FALSE;
			}
		}*/
		if ($members->age->CurrentValue <> "") { // Check field max age
		
		  $setting = getSetting();
		  $maxage = $setting[0]["max_age"] ;
		   
		   if ($maxage > 0) {
			
			if ($members->age->CurrentValue > $maxage){
				
				$sIdxErrMsg = str_replace("%f", $members->age->FldCaption(), "อายุผู้สมัครเกินกำหนด");

				$this->setFailureMessage($sIdxErrMsg);
				
			}
			return FALSE;
		   
		   }
		
		}
		$rsnew = array();

		// member_code
		$members->member_code->SetDbValueDef($rsnew, $members->member_code->CurrentValue, "", FALSE);

		// id_code
		$members->id_code->SetDbValueDef($rsnew, $members->id_code->CurrentValue, "", FALSE);

		// prefix
		$members->prefix->SetDbValueDef($rsnew, $members->prefix->CurrentValue, "", FALSE);

		// gender
		$members->gender->SetDbValueDef($rsnew, $members->gender->CurrentValue, "", FALSE);

		// fname
		$members->fname->SetDbValueDef($rsnew, $members->fname->CurrentValue, "", FALSE);

		// lname
		$members->lname->SetDbValueDef($rsnew, $members->lname->CurrentValue, "", FALSE);

		// birthdate
		$members->birthdate->SetDbValueDef($rsnew, ew_UnFormatDateTime($members->birthdate->CurrentValue, 7), NULL, FALSE);

		// age
		$members->age->SetDbValueDef($rsnew, $members->age->CurrentValue, 0, FALSE);

		// t_code
		$members->t_code->SetDbValueDef($rsnew, $members->t_code->CurrentValue, "", FALSE);

		// village_id
		$members->village_id->SetDbValueDef($rsnew, $members->village_id->CurrentValue, 0, FALSE);

		// bnfc1_name
		$members->bnfc1_name->SetDbValueDef($rsnew, $members->bnfc1_name->CurrentValue, NULL, FALSE);

		// bnfc1_rel
		$members->bnfc1_rel->SetDbValueDef($rsnew, $members->bnfc1_rel->CurrentValue, NULL, FALSE);

		// bnfc2_name
		$members->bnfc2_name->SetDbValueDef($rsnew, $members->bnfc2_name->CurrentValue, NULL, FALSE);

		// bnfc2_rel
		$members->bnfc2_rel->SetDbValueDef($rsnew, $members->bnfc2_rel->CurrentValue, NULL, FALSE);

		// bnfc3_name
		$members->bnfc3_name->SetDbValueDef($rsnew, $members->bnfc3_name->CurrentValue, NULL, FALSE);

		// bnfc3_rel
		$members->bnfc3_rel->SetDbValueDef($rsnew, $members->bnfc3_rel->CurrentValue, NULL, FALSE);

		// regis_date
		$members->regis_date->SetDbValueDef($rsnew, ew_UnFormatDateTime($members->regis_date->CurrentValue, 7), NULL, FALSE);

		// effective_date
		$members->effective_date->SetDbValueDef($rsnew, ew_UnFormatDateTime($members->effective_date->CurrentValue, 7), ew_CurrentDate(), FALSE);

		// member_status
		$members->member_status->SetDbValueDef($rsnew, $members->member_status->CurrentValue, NULL, strval($members->member_status->CurrentValue) == "");

		// Call Row Inserting event
		$rs = ($rsold == NULL) ? NULL : $rsold->fields;
		$bInsertRow = $members->Row_Inserting($rs, $rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($members->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($members->CancelMessage <> "") {
				$this->setFailureMessage($members->CancelMessage);
				$members->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->Phrase("InsertCancelled"));
			}
			$AddRow = FALSE;
		}

		// Get insert id if necessary
		if ($AddRow) {
			$members->member_id->setDbValue($conn->Insert_ID());
			$rsnew['member_id'] = $members->member_id->DbValue;
		}
		if ($AddRow) {

			// Call Row Inserted event
			$rs = ($rsold == NULL) ? NULL : $rsold->fields;
			$members->Row_Inserted($rs, $rsnew);
		}
		return $AddRow;
	}

	// Load advanced search
	function LoadAdvancedSearch() {
		global $members;
		$members->member_code->AdvancedSearch->SearchValue = $members->getAdvancedSearch("x_member_code");
		$members->id_code->AdvancedSearch->SearchValue = $members->getAdvancedSearch("x_id_code");
		$members->prefix->AdvancedSearch->SearchValue = $members->getAdvancedSearch("x_prefix");
		$members->gender->AdvancedSearch->SearchValue = $members->getAdvancedSearch("x_gender");
		$members->fname->AdvancedSearch->SearchValue = $members->getAdvancedSearch("x_fname");
		$members->lname->AdvancedSearch->SearchValue = $members->getAdvancedSearch("x_lname");
		$members->birthdate->AdvancedSearch->SearchValue = $members->getAdvancedSearch("x_birthdate");
		$members->age->AdvancedSearch->SearchValue = $members->getAdvancedSearch("x_age");
		$members->address->AdvancedSearch->SearchValue = $members->getAdvancedSearch("x_address");
		$members->t_code->AdvancedSearch->SearchValue = $members->getAdvancedSearch("x_t_code");
		$members->village_id->AdvancedSearch->SearchValue = $members->getAdvancedSearch("x_village_id");
		$members->phone->AdvancedSearch->SearchValue = $members->getAdvancedSearch("x_phone");
		$members->regis_date->AdvancedSearch->SearchValue = $members->getAdvancedSearch("x_regis_date");
		$members->effective_date->AdvancedSearch->SearchValue = $members->getAdvancedSearch("x_effective_date");
		$members->attachment->AdvancedSearch->SearchValue = $members->getAdvancedSearch("x_attachment");
		$members->member_status->AdvancedSearch->SearchValue = $members->getAdvancedSearch("x_member_status");
		$members->resign_date->AdvancedSearch->SearchValue = $members->getAdvancedSearch("x_resign_date");
		$members->dead_date->AdvancedSearch->SearchValue = $members->getAdvancedSearch("x_dead_date");
		$members->terminate_date->AdvancedSearch->SearchValue = $members->getAdvancedSearch("x_terminate_date");
		$members->note->AdvancedSearch->SearchValue = $members->getAdvancedSearch("x_note");
	}

	// Set up export options
	function SetupExportOptions() {
		global $Language, $members;

		// Printer friendly
		$item =& $this->ExportOptions->Add("print");
		$item->Body = "<a href=\"" . $this->ExportPrintUrl . "\">" . $Language->Phrase("PrinterFriendly") . "</a>";
		$item->Visible = FALSE;

		// Export to Excel
		$item =& $this->ExportOptions->Add("excel");
		$item->Body = "<a href=\"" . $this->ExportExcelUrl . "\">" . $Language->Phrase("ExportToExcel") . "</a>";
		$item->Visible = TRUE;

		// Export to Word
		$item =& $this->ExportOptions->Add("word");
		$item->Body = "<a href=\"" . $this->ExportWordUrl . "\">" . $Language->Phrase("ExportToWord") . "</a>";
		$item->Visible = FALSE;

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
		$item->Body = "<a name=\"emf_members\" id=\"emf_members\" href=\"javascript:void(0);\" onclick=\"ew_EmailDialogShow({lnk:'emf_members',hdr:ewLanguage.Phrase('ExportToEmail'),f:document.fmemberslist,sel:false});\">" . $Language->Phrase("ExportToEmail") . "</a>";
		$item->Visible = FALSE;

		// Hide options for export/action
		if ($members->Export <> "" ||
			$members->CurrentAction <> "")
			$this->ExportOptions->HideAllOptions();
	}

	// Export data in HTML/CSV/Word/Excel/XML/Email/PDF format
	function ExportData() {
		global $members;
		$utf8 = (strtolower(EW_CHARSET) == "utf-8");
		$bSelectLimit = EW_SELECT_LIMIT;

		// Load recordset
		if ($bSelectLimit) {
			$this->TotalRecs = $members->SelectRecordCount();
		} else {
			if ($rs = $this->LoadRecordset())
				$this->TotalRecs = $rs->RecordCount();
		}
		$this->StartRec = 1;

		// Export all
		if ($members->ExportAll) {
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
		if ($members->Export == "xml") {
			$XmlDoc = new cXMLDocument(EW_XML_ENCODING);
			$XmlDoc->XmlDoc->formatOutput = TRUE; // Formatted output
		} else {
			$ExportDoc = new cExportDocument($members, "h");
		}
		$ParentTable = "";
		if ($bSelectLimit) {
			$StartRec = 1;
			$StopRec = $this->DisplayRecs;
		} else {
			$StartRec = $this->StartRec;
			$StopRec = $this->StopRec;
		}
		if ($members->Export == "xml") {
			$members->ExportXmlDocument($XmlDoc, ($ParentTable <> ""), $rs, $StartRec, $StopRec, "");
		} else {
			$sHeader = $this->PageHeader;
			$this->Page_DataRendering($sHeader);
			$ExportDoc->Text .= $sHeader;
			$members->ExportDocument($ExportDoc, $rs, $StartRec, $StopRec, "");
			$sFooter = $this->PageFooter;
			$this->Page_DataRendered($sFooter);
			$ExportDoc->Text .= $sFooter;
		}

		// Close recordset
		$rs->Close();

		// Export header and footer
		if ($members->Export <> "xml") {
			$ExportDoc->ExportHeaderAndFooter();
		}

		// Clean output buffer
		if (!EW_DEBUG_ENABLED && ob_get_length())
			ob_end_clean();

		// Write BOM if utf-8
		if ($utf8 && !in_array($members->Export, array("email", "xml")))
			echo "\xEF\xBB\xBF";

		// Write debug message if enabled
		if (EW_DEBUG_ENABLED)
			echo ew_DebugMsg();

		// Output data
		if ($members->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} elseif ($members->Export == "email") {
			$this->ExportEmail($ExportDoc->Text);
			$this->Page_Terminate($members->ExportReturnUrl());
		} elseif ($members->Export == "pdf") {
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

   setAges();
   setGender();
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
		if ($_GET["x_member_status"] == "พ้นสภาพ"){
			$opt =& $this->ListOptions->Add("new");
			$opt->Header = "<center>พิมพ์</center>";
			$opt->OnLeft = TRUE; // Link on left
			$opt->MoveTo(5); // Move to first column
		}
	}

	// ListOptions Rendered event
	function ListOptions_Rendered() {

			global $members;
			
		if ($_GET["x_member_status"] == "พ้นสภาพ"){
			$this->ListOptions->Items["new"]->Body = "<a href='terminatesliptview.php?member_id=".$members->member_id->CurrentValue."' title = 'ส่งหนังสือแจ้งการพ้นสภาพ'><center><img src='images/ico_send_notice.png' align='absmiddle'></center></a>";
	

		}

	}
}
?>
