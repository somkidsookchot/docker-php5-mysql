<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "membersinfo.php" ?>
<?php include_once "administratorinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$members_view = new cmembers_view();
$Page =& $members_view;

// Page init
$members_view->Page_Init();

// Page main
$members_view->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($members->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var members_view = new ew_Page("members_view");

// page properties
members_view.PageID = "view"; // page ID
members_view.FormID = "fmembersview"; // form ID
var EW_PAGE_ID = members_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
members_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
members_view.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
members_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
members_view.ValidateRequired = false; // no JavaScript validation
<?php } ?>

// search highlight properties
members_view.ShowHighlightText = ewLanguage.Phrase("ShowHighlight"); 
members_view.HideHighlightText = ewLanguage.Phrase("HideHighlight");

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<?php } ?>
<div class="phpmaker ewTitle"><img src="images/im48x48.png" width="40" height="40" align="absmiddle" />&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $members->TableCaption() ?>
&nbsp;&nbsp;<?php $members_view->ExportOptions->Render("body"); ?>
</div>
<div class="clear"></div>
<?php if ($members->Export == "") { ?>
<p class="phpmaker">
<a href="<?php echo $members_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $members_view->AddUrl ?>"><?php echo $Language->Phrase("ViewPageAddLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $members_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $members_view->DeleteUrl ?>"><?php echo $Language->Phrase("ViewPageDeleteLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="memberupdateloglist.php?<?php echo EW_TABLE_SHOW_MASTER ?>=members&member_code=<?php echo urlencode(strval($members->member_code->CurrentValue)) ?>"><?php echo $Language->Phrase("ViewPageDetailLink") ?><?php echo $Language->TablePhrase("memberupdatelog", "TblCaption") ?>
</a>
&nbsp;
<?php } ?>
<?php } ?>
</p>
<?php $members_view->ShowPageHeader(); ?>
<?php
$members_view->ShowMessage();
?>
<p>
<?php if ($members->Export == "") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($members_view->Pager)) $members_view->Pager = new cPrevNextPager($members_view->StartRec, $members_view->DisplayRecs, $members_view->TotalRecs) ?>
<?php if ($members_view->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($members_view->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $members_view->PageUrl() ?>start=<?php echo $members_view->Pager->FirstButton->Start ?>"><img src="phpimages/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($members_view->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $members_view->PageUrl() ?>start=<?php echo $members_view->Pager->PrevButton->Start ?>"><img src="phpimages/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $members_view->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($members_view->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $members_view->PageUrl() ?>start=<?php echo $members_view->Pager->NextButton->Start ?>"><img src="phpimages/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($members_view->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $members_view->PageUrl() ?>start=<?php echo $members_view->Pager->LastButton->Start ?>"><img src="phpimages/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $members_view->Pager->PageCount ?></span></td>
	</tr></table>
<?php } else { ?>
	<?php if ($members_view->SearchWhere == "0=101") { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoRecord") ?></span>
	<?php } ?>
<?php } ?>
		</td>
	</tr>
</table>
</form>
<br>
<?php } ?>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($members->member_code->Visible) { // member_code ?>
	<tr id="r_member_code"<?php echo $members->RowAttributes() ?>>
		<td width="170" class="ewTableHeader"><?php echo $members->member_code->FldCaption() ?></td>
		<td<?php echo $members->member_code->CellAttributes() ?>>
<div<?php echo $members->member_code->ViewAttributes() ?>><?php echo $members->member_code->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($members->id_code->Visible) { // id_code ?>
	<tr id="r_id_code"<?php echo $members->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $members->id_code->FldCaption() ?></td>
		<td<?php echo $members->id_code->CellAttributes() ?>>
<div<?php echo $members->id_code->ViewAttributes() ?>><?php echo $members->id_code->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($members->prefix->Visible) { // prefix ?>
	<tr id="r_prefix"<?php echo $members->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $members->prefix->FldCaption() ?></td>
		<td<?php echo $members->prefix->CellAttributes() ?>>
<div<?php echo $members->prefix->ViewAttributes() ?>><?php echo $members->prefix->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($members->gender->Visible) { // gender ?>
	<tr id="r_gender"<?php echo $members->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $members->gender->FldCaption() ?></td>
		<td<?php echo $members->gender->CellAttributes() ?>>
<div<?php echo $members->gender->ViewAttributes() ?>><?php echo $members->gender->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($members->fname->Visible) { // fname ?>
	<tr id="r_fname"<?php echo $members->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $members->fname->FldCaption() ?></td>
		<td<?php echo $members->fname->CellAttributes() ?>>
<div<?php echo $members->fname->ViewAttributes() ?>><?php echo $members->fname->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($members->lname->Visible) { // lname ?>
	<tr id="r_lname"<?php echo $members->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $members->lname->FldCaption() ?></td>
		<td<?php echo $members->lname->CellAttributes() ?>>
<div<?php echo $members->lname->ViewAttributes() ?>><?php echo $members->lname->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($members->birthdate->Visible) { // birthdate ?>
	<tr id="r_birthdate"<?php echo $members->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $members->birthdate->FldCaption() ?></td>
		<td<?php echo $members->birthdate->CellAttributes() ?>>
<div<?php echo $members->birthdate->ViewAttributes() ?>><?php echo $members->birthdate->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($members->age->Visible) { // age ?>
	<tr id="r_age"<?php echo $members->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $members->age->FldCaption() ?></td>
		<td<?php echo $members->age->CellAttributes() ?>>
<div<?php echo $members->age->ViewAttributes() ?>><?php echo $members->age->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($members->address->Visible) { // address ?>
	<tr id="r_address"<?php echo $members->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $members->address->FldCaption() ?></td>
		<td<?php echo $members->address->CellAttributes() ?>>
<div<?php echo $members->address->ViewAttributes() ?>><?php echo $members->address->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($members->t_code->Visible) { // t_code ?>
	<tr id="r_t_code"<?php echo $members->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $members->t_code->FldCaption() ?></td>
		<td<?php echo $members->t_code->CellAttributes() ?>>
<div<?php echo $members->t_code->ViewAttributes() ?>><?php echo $members->t_code->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($members->village_id->Visible) { // village_id ?>
	<tr id="r_village_id"<?php echo $members->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $members->village_id->FldCaption() ?></td>
		<td<?php echo $members->village_id->CellAttributes() ?>>
<div<?php echo $members->village_id->ViewAttributes() ?>><?php echo $members->village_id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($members->phone->Visible) { // phone ?>
	<tr id="r_phone"<?php echo $members->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $members->phone->FldCaption() ?></td>
		<td<?php echo $members->phone->CellAttributes() ?>>
<div<?php echo $members->phone->ViewAttributes() ?>><?php echo $members->phone->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($members->bnfc1_name->Visible) { // bnfc1_name ?>
	<tr id="r_bnfc1_name"<?php echo $members->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $members->bnfc1_name->FldCaption() ?></td>
		<td<?php echo $members->bnfc1_name->CellAttributes() ?>>
<div<?php echo $members->bnfc1_name->ViewAttributes() ?>><?php echo $members->bnfc1_name->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($members->bnfc1_rel->Visible) { // bnfc1_rel ?>
	<tr id="r_bnfc1_rel"<?php echo $members->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $members->bnfc1_rel->FldCaption() ?></td>
		<td<?php echo $members->bnfc1_rel->CellAttributes() ?>>
<div<?php echo $members->bnfc1_rel->ViewAttributes() ?>><?php echo $members->bnfc1_rel->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($members->bnfc2_name->Visible) { // bnfc2_name ?>
	<tr id="r_bnfc2_name"<?php echo $members->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $members->bnfc2_name->FldCaption() ?></td>
		<td<?php echo $members->bnfc2_name->CellAttributes() ?>>
<div<?php echo $members->bnfc2_name->ViewAttributes() ?>><?php echo $members->bnfc2_name->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($members->bnfc2_rel->Visible) { // bnfc2_rel ?>
	<tr id="r_bnfc2_rel"<?php echo $members->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $members->bnfc2_rel->FldCaption() ?></td>
		<td<?php echo $members->bnfc2_rel->CellAttributes() ?>>
<div<?php echo $members->bnfc2_rel->ViewAttributes() ?>><?php echo $members->bnfc2_rel->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($members->bnfc3_name->Visible) { // bnfc3_name ?>
	<tr id="r_bnfc3_name"<?php echo $members->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $members->bnfc3_name->FldCaption() ?></td>
		<td<?php echo $members->bnfc3_name->CellAttributes() ?>>
<div<?php echo $members->bnfc3_name->ViewAttributes() ?>><?php echo $members->bnfc3_name->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($members->bnfc3_rel->Visible) { // bnfc3_rel ?>
	<tr id="r_bnfc3_rel"<?php echo $members->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $members->bnfc3_rel->FldCaption() ?></td>
		<td<?php echo $members->bnfc3_rel->CellAttributes() ?>>
<div<?php echo $members->bnfc3_rel->ViewAttributes() ?>><?php echo $members->bnfc3_rel->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($members->regis_date->Visible) { // regis_date ?>
	<tr id="r_regis_date"<?php echo $members->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $members->regis_date->FldCaption() ?></td>
		<td<?php echo $members->regis_date->CellAttributes() ?>>
<div<?php echo $members->regis_date->ViewAttributes() ?>><?php echo $members->regis_date->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($members->effective_date->Visible) { // effective_date ?>
	<tr id="r_effective_date"<?php echo $members->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $members->effective_date->FldCaption() ?></td>
		<td<?php echo $members->effective_date->CellAttributes() ?>>
<div<?php echo $members->effective_date->ViewAttributes() ?>><?php echo $members->effective_date->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($members->member_status->Visible) { // member_status ?>
	<tr id="r_member_status"<?php echo $members->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $members->member_status->FldCaption() ?></td>
		<td<?php echo $members->member_status->CellAttributes() ?>>
<div<?php echo $members->member_status->ViewAttributes() ?>><?php echo $members->member_status->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($members->resign_date->Visible) { // resign_date ?>
	<tr id="r_resign_date"<?php echo $members->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $members->resign_date->FldCaption() ?></td>
		<td<?php echo $members->resign_date->CellAttributes() ?>>
<div<?php echo $members->resign_date->ViewAttributes() ?>><?php echo $members->resign_date->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($members->dead_date->Visible) { // dead_date ?>
	<tr id="r_dead_date"<?php echo $members->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $members->dead_date->FldCaption() ?></td>
		<td<?php echo $members->dead_date->CellAttributes() ?>>
<div<?php echo $members->dead_date->ViewAttributes() ?>><?php echo $members->dead_date->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($members->terminate_date->Visible) { // terminate_date ?>
	<tr id="r_terminate_date"<?php echo $members->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $members->terminate_date->FldCaption() ?></td>
		<td<?php echo $members->terminate_date->CellAttributes() ?>>
<div<?php echo $members->terminate_date->ViewAttributes() ?>><?php echo $members->terminate_date->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($members->dead_id->Visible) { // dead_id ?>
	<tr id="r_dead_id"<?php echo $members->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $members->dead_id->FldCaption() ?></td>
		<td<?php echo $members->dead_id->CellAttributes() ?>>
<div<?php echo $members->dead_id->ViewAttributes() ?>><?php echo $members->dead_id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($members->note->Visible) { // note ?>
	<tr id="r_note"<?php echo $members->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $members->note->FldCaption() ?></td>
		<td<?php echo $members->note->CellAttributes() ?>>
<div<?php echo $members->note->ViewAttributes() ?>><?php echo $members->note->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<?php if ($members->Export == "") { ?>
<br>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($members_view->Pager)) $members_view->Pager = new cPrevNextPager($members_view->StartRec, $members_view->DisplayRecs, $members_view->TotalRecs) ?>
<?php if ($members_view->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($members_view->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $members_view->PageUrl() ?>start=<?php echo $members_view->Pager->FirstButton->Start ?>"><img src="phpimages/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($members_view->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $members_view->PageUrl() ?>start=<?php echo $members_view->Pager->PrevButton->Start ?>"><img src="phpimages/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $members_view->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($members_view->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $members_view->PageUrl() ?>start=<?php echo $members_view->Pager->NextButton->Start ?>"><img src="phpimages/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($members_view->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $members_view->PageUrl() ?>start=<?php echo $members_view->Pager->LastButton->Start ?>"><img src="phpimages/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $members_view->Pager->PageCount ?></span></td>
	</tr></table>
<?php } else { ?>
	<?php if ($members_view->SearchWhere == "0=101") { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoRecord") ?></span>
	<?php } ?>
<?php } ?>
		</td>
	</tr>
</table>
</form>
<?php } ?>
<p>
<?php
$members_view->ShowPageFooter();
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
$members_view->Page_Terminate();
?>
<?php

//
// Page class
//
class cmembers_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'members';

	// Page object name
	var $PageObjName = 'members_view';

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
	function cmembers_view() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (members)
		if (!isset($GLOBALS["members"])) {
			$GLOBALS["members"] = new cmembers();
			$GLOBALS["Table"] =& $GLOBALS["members"];
		}
		$KeyUrl = "";
		if (@$_GET["member_id"] <> "") {
			$this->RecKey["member_id"] = $_GET["member_id"];
			$KeyUrl .= "&member_id=" . urlencode($this->RecKey["member_id"]);
		}
		$this->ExportPrintUrl = $this->PageUrl() . "export=print" . $KeyUrl;
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html" . $KeyUrl;
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel" . $KeyUrl;
		$this->ExportWordUrl = $this->PageUrl() . "export=word" . $KeyUrl;
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml" . $KeyUrl;
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv" . $KeyUrl;
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf" . $KeyUrl;

		// Table object (administrator)
		if (!isset($GLOBALS['administrator'])) $GLOBALS['administrator'] = new cadministrator();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'members', TRUE);

		// Start timer
		if (!isset($GLOBALS["gTimer"])) $GLOBALS["gTimer"] = new cTimer();

		// Open connection
		if (!isset($conn)) $conn = ew_Connect();

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
	var $ExportOptions; // Export options
	var $DisplayRecs = 1;
	var $StartRec;
	var $StopRec;
	var $TotalRecs = 0;
	var $RecRange = 10;
	var $RecCnt;
	var $RecKey = array();
	var $Recordset;

	//
	// Page main
	//
	function Page_Main() {
		global $Language, $members;

		// Load current record
		$bLoadCurrentRecord = FALSE;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["member_id"] <> "") {
				$members->member_id->setQueryStringValue($_GET["member_id"]);
				$this->RecKey["member_id"] = $members->member_id->QueryStringValue;
			} else {
				$bLoadCurrentRecord = TRUE;
			}

			// Get action
			$members->CurrentAction = "I"; // Display form
			switch ($members->CurrentAction) {
				case "I": // Get a record to display
					$this->StartRec = 1; // Initialize start position
					if ($this->Recordset = $this->LoadRecordset()) // Load records
						$this->TotalRecs = $this->Recordset->RecordCount(); // Get record count
					if ($this->TotalRecs <= 0) { // No record found
						if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "")
							$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record message
						$this->Page_Terminate("memberslist.php"); // Return to list page
					} elseif ($bLoadCurrentRecord) { // Load current record position
						$this->SetUpStartRec(); // Set up start record position

						// Point to current record
						if (intval($this->StartRec) <= intval($this->TotalRecs)) {
							$bMatchRecord = TRUE;
							$this->Recordset->Move($this->StartRec-1);
						}
					} else { // Match key values
						while (!$this->Recordset->EOF) {
							if (strval($members->member_id->CurrentValue) == strval($this->Recordset->fields('member_id'))) {
								$members->setStartRecordNumber($this->StartRec); // Save record position
								$bMatchRecord = TRUE;
								break;
							} else {
								$this->StartRec++;
								$this->Recordset->MoveNext();
							}
						}
					}
					if (!$bMatchRecord) {
						if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "")
							$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "memberslist.php"; // No matching record, return to list
					} else {
						$this->LoadRowValues($this->Recordset); // Load row values
					}
			}
		} else {
			$sReturnUrl = "memberslist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$members->RowType = EW_ROWTYPE_VIEW;
		$members->ResetAttrs();
		$this->RenderRow();
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

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $members;

		// Initialize URLs
		$this->AddUrl = $members->AddUrl();
		$this->EditUrl = $members->EditUrl();
		$this->CopyUrl = $members->CopyUrl();
		$this->DeleteUrl = $members->DeleteUrl();
		$this->ListUrl = $members->ListUrl();

		// Call Row_Rendering event
		$members->Row_Rendering();

		// Common render codes for all row types
		// member_id
		// member_code
		// id_code
		// prefix
		// gender
		// fname
		// lname
		// birthdate
		// age
		// email
		// address
		// t_code
		// village_id
		// phone
		// suffix
		// bnfc1_name
		// bnfc1_rel
		// bnfc2_name
		// bnfc2_rel
		// bnfc3_name
		// bnfc3_rel
		// bnfc4_name
		// bnfc4_rel
		// regis_date
		// effective_date
		// attachment
		// member_status
		// resign_date
		// dead_date
		// terminate_date
		// advance_budget
		// dead_id
		// note
		// update_detail
		// member_type

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

			// dead_id
			$members->dead_id->ViewValue = $members->dead_id->CurrentValue;
			$members->dead_id->ViewCustomAttributes = "";

			// note
			$members->note->ViewValue = $members->note->CurrentValue;
			$members->note->ViewCustomAttributes = "";

			// member_code
			$members->member_code->LinkCustomAttributes = "";
			$members->member_code->HrefValue = "";
			$members->member_code->TooltipValue = "";

			// id_code
			$members->id_code->LinkCustomAttributes = "";
			$members->id_code->HrefValue = "";
			$members->id_code->TooltipValue = "";

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

			// lname
			$members->lname->LinkCustomAttributes = "";
			$members->lname->HrefValue = "";
			$members->lname->TooltipValue = "";

			// birthdate
			$members->birthdate->LinkCustomAttributes = "";
			$members->birthdate->HrefValue = "";
			$members->birthdate->TooltipValue = "";

			// age
			$members->age->LinkCustomAttributes = "";
			$members->age->HrefValue = "";
			$members->age->TooltipValue = "";

			// address
			$members->address->LinkCustomAttributes = "";
			$members->address->HrefValue = "";
			$members->address->TooltipValue = "";

			// t_code
			$members->t_code->LinkCustomAttributes = "";
			$members->t_code->HrefValue = "";
			$members->t_code->TooltipValue = "";

			// village_id
			$members->village_id->LinkCustomAttributes = "";
			$members->village_id->HrefValue = "";
			$members->village_id->TooltipValue = "";

			// phone
			$members->phone->LinkCustomAttributes = "";
			$members->phone->HrefValue = "";
			$members->phone->TooltipValue = "";

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

			// resign_date
			$members->resign_date->LinkCustomAttributes = "";
			$members->resign_date->HrefValue = "";
			$members->resign_date->TooltipValue = "";

			// dead_date
			$members->dead_date->LinkCustomAttributes = "";
			$members->dead_date->HrefValue = "";
			$members->dead_date->TooltipValue = "";

			// terminate_date
			$members->terminate_date->LinkCustomAttributes = "";
			$members->terminate_date->HrefValue = "";
			$members->terminate_date->TooltipValue = "";

			// dead_id
			$members->dead_id->LinkCustomAttributes = "";
			$members->dead_id->HrefValue = "";
			$members->dead_id->TooltipValue = "";

			// note
			$members->note->LinkCustomAttributes = "";
			$members->note->HrefValue = "";
			$members->note->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($members->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$members->Row_Rendered();
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
}
?>
