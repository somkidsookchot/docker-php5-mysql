<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "subvchargeinfo.php" ?>
<?php include_once "administratorinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$subvcharge_view = new csubvcharge_view();
$Page =& $subvcharge_view;

// Page init
$subvcharge_view->Page_Init();

// Page main
$subvcharge_view->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($subvcharge->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var subvcharge_view = new ew_Page("subvcharge_view");

// page properties
subvcharge_view.PageID = "view"; // page ID
subvcharge_view.FormID = "fsubvchargeview"; // form ID
var EW_PAGE_ID = subvcharge_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
subvcharge_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
subvcharge_view.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
subvcharge_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
subvcharge_view.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<?php } ?>
<div class="ewTitle"><img src="images/finance55x55.png" width="40" height="40" align="absmiddle" />&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $subvcharge->TableCaption() ?>
&nbsp;&nbsp;<?php $subvcharge_view->ExportOptions->Render("body"); ?>
</div>
<div class="clear"></div>
<?php if ($subvcharge->Export == "") { ?>
<p class="phpmaker">
<a href="<?php echo $subvcharge_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<?php if ($Security->IsLoggedIn()) { ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $subvcharge_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<?php } ?>
<a href="<?php echo $subvcharge_view->DeleteUrl ?>"><?php echo $Language->Phrase("ViewPageDeleteLink") ?></a>&nbsp;
<?php } ?>
<?php } ?>
</p>
<?php $subvcharge_view->ShowPageHeader(); ?>
<?php
$subvcharge_view->ShowMessage();
?><a href='subvsliptview.php?subvc_id=<?php echo $subvcharge->subvc_id->CurrentValue ?>' title='พิมพ์ใบเสร็จรับเงิน' target='_blank'><img src="images/bt_print_slipt.png" width="147" height="37" border="0" /></a>
<p>
<?php if ($subvcharge->Export == "") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($subvcharge_view->Pager)) $subvcharge_view->Pager = new cPrevNextPager($subvcharge_view->StartRec, $subvcharge_view->DisplayRecs, $subvcharge_view->TotalRecs) ?>
<?php if ($subvcharge_view->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($subvcharge_view->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $subvcharge_view->PageUrl() ?>start=<?php echo $subvcharge_view->Pager->FirstButton->Start ?>"><img src="phpimages/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($subvcharge_view->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $subvcharge_view->PageUrl() ?>start=<?php echo $subvcharge_view->Pager->PrevButton->Start ?>"><img src="phpimages/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $subvcharge_view->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($subvcharge_view->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $subvcharge_view->PageUrl() ?>start=<?php echo $subvcharge_view->Pager->NextButton->Start ?>"><img src="phpimages/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($subvcharge_view->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $subvcharge_view->PageUrl() ?>start=<?php echo $subvcharge_view->Pager->LastButton->Start ?>"><img src="phpimages/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $subvcharge_view->Pager->PageCount ?></span></td>
	</tr></table>
<?php } else { ?>
	<?php if ($subvcharge_view->SearchWhere == "0=101") { ?>
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
<?php if ($subvcharge->member_code->Visible) { // member_code ?>
	<tr id="r_member_code"<?php echo $subvcharge->RowAttributes() ?>>
		<td width="170" class="ewTableHeader"><?php echo $subvcharge->member_code->FldCaption() ?></td>
		<td<?php echo $subvcharge->member_code->CellAttributes() ?>>
<div<?php echo $subvcharge->member_code->ViewAttributes() ?>><?php echo $subvcharge->member_code->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($subvcharge->all_member->Visible) { // all_member ?>
	<tr id="r_all_member"<?php echo $subvcharge->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $subvcharge->all_member->FldCaption() ?></td>
		<td<?php echo $subvcharge->all_member->CellAttributes() ?>>
<div<?php echo $subvcharge->all_member->ViewAttributes() ?>><?php echo number_format($subvcharge->all_member->ViewValue) ?></div></td>
	</tr>
<?php } ?>
<?php if ($subvcharge->alive_count->Visible) { // alive_count ?>
	<tr id="r_alive_count"<?php echo $subvcharge->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $subvcharge->alive_count->FldCaption() ?></td>
		<td<?php echo $subvcharge->alive_count->CellAttributes() ?>>
<div<?php echo $subvcharge->alive_count->ViewAttributes() ?>><?php echo number_format($subvcharge->alive_count->ViewValue) ?></div></td>
	</tr>
<?php } ?>
<?php if ($subvcharge->dead_count->Visible) { // dead_count ?>
	<tr id="r_dead_count"<?php echo $subvcharge->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $subvcharge->dead_count->FldCaption() ?></td>
		<td<?php echo $subvcharge->dead_count->CellAttributes() ?>>
<div<?php echo $subvcharge->dead_count->ViewAttributes() ?>><?php echo number_format($subvcharge->dead_count->ViewValue) ?></div></td>
	</tr>
<?php } ?>
<?php if ($subvcharge->resign_count->Visible) { // resign_count ?>
	<tr id="r_resign_count"<?php echo $subvcharge->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $subvcharge->resign_count->FldCaption() ?></td>
		<td<?php echo $subvcharge->resign_count->CellAttributes() ?>>
<div<?php echo $subvcharge->resign_count->ViewAttributes() ?>><?php echo number_format($subvcharge->resign_count->ViewValue) ?></div></td>
	</tr>
<?php } ?>
<?php if ($subvcharge->terminate_count->Visible) { // terminate_count ?>
	<tr id="r_terminate_count"<?php echo $subvcharge->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $subvcharge->terminate_count->FldCaption() ?></td>
		<td<?php echo $subvcharge->terminate_count->CellAttributes() ?>>
<div<?php echo $subvcharge->terminate_count->ViewAttributes() ?>><?php echo number_format($subvcharge->terminate_count->ViewValue) ?></div></td>
	</tr>
<?php } ?>
<?php if ($subvcharge->subv_rate->Visible) { // subv_rate ?>
	<tr id="r_subv_rate"<?php echo $subvcharge->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $subvcharge->subv_rate->FldCaption() ?></td>
		<td<?php echo $subvcharge->subv_rate->CellAttributes() ?>>
<div<?php echo $subvcharge->subv_rate->ViewAttributes() ?>><?php echo $subvcharge->subv_rate->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($subvcharge->can_pay_count->Visible) { // can_pay_count ?>
	<tr id="r_can_pay_count"<?php echo $subvcharge->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $subvcharge->can_pay_count->FldCaption() ?></td>
		<td<?php echo $subvcharge->can_pay_count->CellAttributes() ?>>
<div<?php echo $subvcharge->can_pay_count->ViewAttributes() ?>><?php echo number_format($subvcharge->can_pay_count->ViewValue) ?></div></td>
	</tr>
<?php } ?>
<?php if ($subvcharge->cant_pay_count->Visible) { // cant_pay_count ?>
	<tr id="r_cant_pay_count"<?php echo $subvcharge->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $subvcharge->cant_pay_count->FldCaption() ?></td>
		<td<?php echo $subvcharge->cant_pay_count->CellAttributes() ?>>
<div<?php echo $subvcharge->cant_pay_count->ViewAttributes() ?>><?php echo number_format($subvcharge->cant_pay_count->ViewValue) ?></div></td>
	</tr>
<?php } ?>
<?php if ($subvcharge->cant_pay_detail->Visible) { // cant_pay_detail ?>
	<tr id="r_cant_pay_detail"<?php echo $subvcharge->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $subvcharge->cant_pay_detail->FldCaption() ?></td>
		<td<?php echo $subvcharge->cant_pay_detail->CellAttributes() ?>>
<div<?php echo $subvcharge->cant_pay_detail->ViewAttributes() ?>><?php echo $subvcharge->cant_pay_detail->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($subvcharge->subvc_total->Visible) { // subvc_total ?>
	<tr id="r_subvc_total"<?php echo $subvcharge->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $subvcharge->subvc_total->FldCaption() ?></td>
		<td<?php echo $subvcharge->subvc_total->CellAttributes() ?>>
<div<?php echo $subvcharge->subvc_total->ViewAttributes() ?>><?php echo number_format($subvcharge->subvc_total->ViewValue) ?></div></td>
	</tr>
<?php } ?>
<?php if ($subvcharge->assc_percent->Visible) { // assc_percent ?>
	<tr id="r_assc_percent"<?php echo $subvcharge->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $subvcharge->assc_percent->FldCaption() ?></td>
		<td<?php echo $subvcharge->assc_percent->CellAttributes() ?>>
<div<?php echo $subvcharge->assc_percent->ViewAttributes() ?>><?php echo $subvcharge->assc_percent->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($subvcharge->assc_total->Visible) { // assc_total ?>
	<tr id="r_assc_total"<?php echo $subvcharge->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $subvcharge->assc_total->FldCaption() ?></td>
		<td<?php echo $subvcharge->assc_total->CellAttributes() ?>>
<div<?php echo $subvcharge->assc_total->ViewAttributes() ?>><?php echo number_format($subvcharge->assc_total->ViewValue) ?></div></td>
	</tr>
<?php } ?>
<?php if ($subvcharge->bnfc_total->Visible) { // bnfc_total ?>
	<tr id="r_bnfc_total"<?php echo $subvcharge->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $subvcharge->bnfc_total->FldCaption() ?></td>
		<td<?php echo $subvcharge->bnfc_total->CellAttributes() ?>>
<div<?php echo $subvcharge->bnfc_total->ViewAttributes() ?>><?php echo number_format($subvcharge->bnfc_total->ViewValue) ?></div></td>
	</tr>
<?php } ?>
<?php if ($subvcharge->subvc_status->Visible) { // subvc_status ?>
	<tr id="r_subvc_status"<?php echo $subvcharge->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $subvcharge->subvc_status->FldCaption() ?></td>
		<td<?php echo $subvcharge->subvc_status->CellAttributes() ?>>
<div<?php echo $subvcharge->subvc_status->ViewAttributes() ?>><?php echo $subvcharge->subvc_status->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($subvcharge->subvc_date->Visible) { // subvc_date ?>
	<tr id="r_subvc_date"<?php echo $subvcharge->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $subvcharge->subvc_date->FldCaption() ?></td>
		<td<?php echo $subvcharge->subvc_date->CellAttributes() ?>>
<div<?php echo $subvcharge->subvc_date->ViewAttributes() ?>><?php echo $subvcharge->subvc_date->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($subvcharge->subvc_slipt_num->Visible) { // subvc_slipt_num ?>
	<tr id="r_subvc_slipt_num"<?php echo $subvcharge->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $subvcharge->subvc_slipt_num->FldCaption() ?></td>
		<td<?php echo $subvcharge->subvc_slipt_num->CellAttributes() ?>>
<div<?php echo $subvcharge->subvc_slipt_num->ViewAttributes() ?>><?php echo $subvcharge->subvc_slipt_num->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<?php if ($subvcharge->Export == "") { ?>
<br>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($subvcharge_view->Pager)) $subvcharge_view->Pager = new cPrevNextPager($subvcharge_view->StartRec, $subvcharge_view->DisplayRecs, $subvcharge_view->TotalRecs) ?>
<?php if ($subvcharge_view->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($subvcharge_view->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $subvcharge_view->PageUrl() ?>start=<?php echo $subvcharge_view->Pager->FirstButton->Start ?>"><img src="phpimages/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($subvcharge_view->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $subvcharge_view->PageUrl() ?>start=<?php echo $subvcharge_view->Pager->PrevButton->Start ?>"><img src="phpimages/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $subvcharge_view->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($subvcharge_view->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $subvcharge_view->PageUrl() ?>start=<?php echo $subvcharge_view->Pager->NextButton->Start ?>"><img src="phpimages/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($subvcharge_view->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $subvcharge_view->PageUrl() ?>start=<?php echo $subvcharge_view->Pager->LastButton->Start ?>"><img src="phpimages/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $subvcharge_view->Pager->PageCount ?></span></td>
	</tr></table>
<?php } else { ?>
	<?php if ($subvcharge_view->SearchWhere == "0=101") { ?>
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
$subvcharge_view->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($subvcharge->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$subvcharge_view->Page_Terminate();
?>
<?php

//
// Page class
//
class csubvcharge_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'subvcharge';

	// Page object name
	var $PageObjName = 'subvcharge_view';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $subvcharge;
		if ($subvcharge->UseTokenInUrl) $PageUrl .= "t=" . $subvcharge->TableVar . "&"; // Add page token
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
		global $objForm, $subvcharge;
		if ($subvcharge->UseTokenInUrl) {
			if ($objForm)
				return ($subvcharge->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($subvcharge->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function csubvcharge_view() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (subvcharge)
		if (!isset($GLOBALS["subvcharge"])) {
			$GLOBALS["subvcharge"] = new csubvcharge();
			$GLOBALS["Table"] =& $GLOBALS["subvcharge"];
		}
		$KeyUrl = "";
		if (@$_GET["subvc_id"] <> "") {
			$this->RecKey["subvc_id"] = $_GET["subvc_id"];
			$KeyUrl .= "&subvc_id=" . urlencode($this->RecKey["subvc_id"]);
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
			define("EW_TABLE_NAME", 'subvcharge', TRUE);

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
		global $subvcharge;

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
		global $Language, $subvcharge;

		// Load current record
		$bLoadCurrentRecord = FALSE;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["subvc_id"] <> "") {
				$subvcharge->subvc_id->setQueryStringValue($_GET["subvc_id"]);
				$this->RecKey["subvc_id"] = $subvcharge->subvc_id->QueryStringValue;
			} else {
				$bLoadCurrentRecord = TRUE;
			}

			// Get action
			$subvcharge->CurrentAction = "I"; // Display form
			switch ($subvcharge->CurrentAction) {
				case "I": // Get a record to display
					$this->StartRec = 1; // Initialize start position
					if ($this->Recordset = $this->LoadRecordset()) // Load records
						$this->TotalRecs = $this->Recordset->RecordCount(); // Get record count
					if ($this->TotalRecs <= 0) { // No record found
						if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "")
							$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record message
						$this->Page_Terminate("subvchargelist.php"); // Return to list page
					} elseif ($bLoadCurrentRecord) { // Load current record position
						$this->SetUpStartRec(); // Set up start record position

						// Point to current record
						if (intval($this->StartRec) <= intval($this->TotalRecs)) {
							$bMatchRecord = TRUE;
							$this->Recordset->Move($this->StartRec-1);
						}
					} else { // Match key values
						while (!$this->Recordset->EOF) {
							if (strval($subvcharge->subvc_id->CurrentValue) == strval($this->Recordset->fields('subvc_id'))) {
								$subvcharge->setStartRecordNumber($this->StartRec); // Save record position
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
						$sReturnUrl = "subvchargelist.php"; // No matching record, return to list
					} else {
						$this->LoadRowValues($this->Recordset); // Load row values
					}
			}
		} else {
			$sReturnUrl = "subvchargelist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$subvcharge->RowType = EW_ROWTYPE_VIEW;
		$subvcharge->ResetAttrs();
		$this->RenderRow();
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $subvcharge;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$subvcharge->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$subvcharge->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $subvcharge->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$subvcharge->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$subvcharge->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$subvcharge->setStartRecordNumber($this->StartRec);
		}
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $subvcharge;

		// Call Recordset Selecting event
		$subvcharge->Recordset_Selecting($subvcharge->CurrentFilter);

		// Load List page SQL
		$sSql = $subvcharge->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$subvcharge->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $subvcharge;
		$sFilter = $subvcharge->KeyFilter();

		// Call Row Selecting event
		$subvcharge->Row_Selecting($sFilter);

		// Load SQL based on filter
		$subvcharge->CurrentFilter = $sFilter;
		$sSql = $subvcharge->SQL();
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
		global $conn, $subvcharge;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$subvcharge->Row_Selected($row);
		$subvcharge->subvc_id->setDbValue($rs->fields('subvc_id'));
		$subvcharge->member_code->setDbValue($rs->fields('member_code'));
		$subvcharge->all_member->setDbValue($rs->fields('all_member'));
		$subvcharge->alive_count->setDbValue($rs->fields('alive_count'));
		$subvcharge->dead_count->setDbValue($rs->fields('dead_count'));
		$subvcharge->resign_count->setDbValue($rs->fields('resign_count'));
		$subvcharge->terminate_count->setDbValue($rs->fields('terminate_count'));
		$subvcharge->subv_rate->setDbValue($rs->fields('subv_rate'));
		$subvcharge->can_pay_count->setDbValue($rs->fields('can_pay_count'));
		$subvcharge->cant_pay_count->setDbValue($rs->fields('cant_pay_count'));
		$subvcharge->cant_pay_detail->setDbValue($rs->fields('cant_pay_detail'));
		$subvcharge->subvc_total->setDbValue($rs->fields('subvc_total'));
		$subvcharge->assc_percent->setDbValue($rs->fields('assc_percent'));
		$subvcharge->assc_total->setDbValue($rs->fields('assc_total'));
		$subvcharge->bnfc_total->setDbValue($rs->fields('bnfc_total'));
		$subvcharge->canculate_date->setDbValue($rs->fields('canculate_date'));
		$subvcharge->subvc_status->setDbValue($rs->fields('subvc_status'));
		$subvcharge->subvc_date->setDbValue($rs->fields('subvc_date'));
		$subvcharge->subvc_slipt_num->setDbValue($rs->fields('subvc_slipt_num'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $subvcharge;

		// Initialize URLs
		$this->AddUrl = $subvcharge->AddUrl();
		$this->EditUrl = $subvcharge->EditUrl();
		$this->CopyUrl = $subvcharge->CopyUrl();
		$this->DeleteUrl = $subvcharge->DeleteUrl();
		$this->ListUrl = $subvcharge->ListUrl();

		// Call Row_Rendering event
		$subvcharge->Row_Rendering();

		// Common render codes for all row types
		// subvc_id
		// member_code
		// all_member
		// alive_count
		// dead_count
		// resign_count
		// terminate_count
		// subv_rate
		// can_pay_count
		// cant_pay_count
		// cant_pay_detail
		// subvc_total
		// assc_percent
		// assc_total
		// bnfc_total
		// canculate_date
		// subvc_status
		// subvc_date
		// subvc_slipt_num

		if ($subvcharge->RowType == EW_ROWTYPE_VIEW) { // View row

			// member_code
			$subvcharge->member_code->ViewValue = $subvcharge->member_code->CurrentValue;
			if (strval($subvcharge->member_code->CurrentValue) <> "") {
				$sFilterWrk = "`member_code` = '" . ew_AdjustSql($subvcharge->member_code->CurrentValue) . "'";
			$sSqlWrk = "SELECT `dead_id`, `fname`, `lname` FROM `members`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$subvcharge->member_code->ViewValue = $rswrk->fields('dead_id');
					$subvcharge->member_code->ViewValue .= ew_ValueSeparator(0,1,$subvcharge->member_code) . $rswrk->fields('fname');
					$subvcharge->member_code->ViewValue .= ew_ValueSeparator(0,2,$subvcharge->member_code) . $rswrk->fields('lname');
					$rswrk->Close();
				} else {
					$subvcharge->member_code->ViewValue = $subvcharge->member_code->CurrentValue;
				}
			} else {
				$subvcharge->member_code->ViewValue = NULL;
			}
			$subvcharge->member_code->ViewCustomAttributes = "";

			// all_member
			$subvcharge->all_member->ViewValue = $subvcharge->all_member->CurrentValue;
			$subvcharge->all_member->ViewCustomAttributes = "";

			// alive_count
			$subvcharge->alive_count->ViewValue = $subvcharge->alive_count->CurrentValue;
			$subvcharge->alive_count->ViewCustomAttributes = "";

			// dead_count
			$subvcharge->dead_count->ViewValue = $subvcharge->dead_count->CurrentValue;
			$subvcharge->dead_count->ViewCustomAttributes = "";

			// resign_count
			$subvcharge->resign_count->ViewValue = $subvcharge->resign_count->CurrentValue;
			$subvcharge->resign_count->ViewCustomAttributes = "";

			// terminate_count
			$subvcharge->terminate_count->ViewValue = $subvcharge->terminate_count->CurrentValue;
			$subvcharge->terminate_count->ViewCustomAttributes = "";

			// subv_rate
			$subvcharge->subv_rate->ViewValue = $subvcharge->subv_rate->CurrentValue;
			$subvcharge->subv_rate->ViewCustomAttributes = "";

			// can_pay_count
			$subvcharge->can_pay_count->ViewValue = $subvcharge->can_pay_count->CurrentValue;
			$subvcharge->can_pay_count->ViewCustomAttributes = "";

			// cant_pay_count
			$subvcharge->cant_pay_count->ViewValue = $subvcharge->cant_pay_count->CurrentValue;
			$subvcharge->cant_pay_count->ViewCustomAttributes = "";

			// cant_pay_detail
			$subvcharge->cant_pay_detail->ViewValue = $subvcharge->cant_pay_detail->CurrentValue;
			$subvcharge->cant_pay_detail->ViewCustomAttributes = "";

			// subvc_total
			$subvcharge->subvc_total->ViewValue = $subvcharge->subvc_total->CurrentValue;
			$subvcharge->subvc_total->ViewCustomAttributes = "";

			// assc_percent
			$subvcharge->assc_percent->ViewValue = $subvcharge->assc_percent->CurrentValue;
			$subvcharge->assc_percent->ViewCustomAttributes = "";

			// assc_total
			$subvcharge->assc_total->ViewValue = $subvcharge->assc_total->CurrentValue;
			$subvcharge->assc_total->ViewCustomAttributes = "";

			// bnfc_total
			$subvcharge->bnfc_total->ViewValue = $subvcharge->bnfc_total->CurrentValue;
			$subvcharge->bnfc_total->ViewCustomAttributes = "";

			// subvc_status
			if (strval($subvcharge->subvc_status->CurrentValue) <> "") {
				switch ($subvcharge->subvc_status->CurrentValue) {
					case "รอจ่าย":
						$subvcharge->subvc_status->ViewValue = $subvcharge->subvc_status->FldTagCaption(1) <> "" ? $subvcharge->subvc_status->FldTagCaption(1) : $subvcharge->subvc_status->CurrentValue;
						break;
					case "จ่ายแล้ว":
						$subvcharge->subvc_status->ViewValue = $subvcharge->subvc_status->FldTagCaption(2) <> "" ? $subvcharge->subvc_status->FldTagCaption(2) : $subvcharge->subvc_status->CurrentValue;
						break;
					default:
						$subvcharge->subvc_status->ViewValue = $subvcharge->subvc_status->CurrentValue;
				}
			} else {
				$subvcharge->subvc_status->ViewValue = NULL;
			}
			$subvcharge->subvc_status->ViewCustomAttributes = "";

			// subvc_date
			$subvcharge->subvc_date->ViewValue = $subvcharge->subvc_date->CurrentValue;
			$subvcharge->subvc_date->ViewValue = ew_FormatDateTime($subvcharge->subvc_date->ViewValue, 7);
			$subvcharge->subvc_date->ViewCustomAttributes = "";

			// subvc_slipt_num
			$subvcharge->subvc_slipt_num->ViewValue = $subvcharge->subvc_slipt_num->CurrentValue;
			$subvcharge->subvc_slipt_num->ViewCustomAttributes = "";

			// member_code
			$subvcharge->member_code->LinkCustomAttributes = "";
			$subvcharge->member_code->HrefValue = "";
			$subvcharge->member_code->TooltipValue = "";

			// all_member
			$subvcharge->all_member->LinkCustomAttributes = "";
			$subvcharge->all_member->HrefValue = "";
			$subvcharge->all_member->TooltipValue = "";

			// alive_count
			$subvcharge->alive_count->LinkCustomAttributes = "";
			$subvcharge->alive_count->HrefValue = "";
			$subvcharge->alive_count->TooltipValue = "";

			// dead_count
			$subvcharge->dead_count->LinkCustomAttributes = "";
			$subvcharge->dead_count->HrefValue = "";
			$subvcharge->dead_count->TooltipValue = "";

			// resign_count
			$subvcharge->resign_count->LinkCustomAttributes = "";
			$subvcharge->resign_count->HrefValue = "";
			$subvcharge->resign_count->TooltipValue = "";

			// terminate_count
			$subvcharge->terminate_count->LinkCustomAttributes = "";
			$subvcharge->terminate_count->HrefValue = "";
			$subvcharge->terminate_count->TooltipValue = "";

			// subv_rate
			$subvcharge->subv_rate->LinkCustomAttributes = "";
			$subvcharge->subv_rate->HrefValue = "";
			$subvcharge->subv_rate->TooltipValue = "";

			// can_pay_count
			$subvcharge->can_pay_count->LinkCustomAttributes = "";
			$subvcharge->can_pay_count->HrefValue = "";
			$subvcharge->can_pay_count->TooltipValue = "";

			// cant_pay_count
			$subvcharge->cant_pay_count->LinkCustomAttributes = "";
			$subvcharge->cant_pay_count->HrefValue = "";
			$subvcharge->cant_pay_count->TooltipValue = "";

			// cant_pay_detail
			$subvcharge->cant_pay_detail->LinkCustomAttributes = "";
			$subvcharge->cant_pay_detail->HrefValue = "";
			$subvcharge->cant_pay_detail->TooltipValue = "";

			// subvc_total
			$subvcharge->subvc_total->LinkCustomAttributes = "";
			$subvcharge->subvc_total->HrefValue = "";
			$subvcharge->subvc_total->TooltipValue = "";

			// assc_percent
			$subvcharge->assc_percent->LinkCustomAttributes = "";
			$subvcharge->assc_percent->HrefValue = "";
			$subvcharge->assc_percent->TooltipValue = "";

			// assc_total
			$subvcharge->assc_total->LinkCustomAttributes = "";
			$subvcharge->assc_total->HrefValue = "";
			$subvcharge->assc_total->TooltipValue = "";

			// bnfc_total
			$subvcharge->bnfc_total->LinkCustomAttributes = "";
			$subvcharge->bnfc_total->HrefValue = "";
			$subvcharge->bnfc_total->TooltipValue = "";

			// subvc_status
			$subvcharge->subvc_status->LinkCustomAttributes = "";
			$subvcharge->subvc_status->HrefValue = "";
			$subvcharge->subvc_status->TooltipValue = "";

			// subvc_date
			$subvcharge->subvc_date->LinkCustomAttributes = "";
			$subvcharge->subvc_date->HrefValue = "";
			$subvcharge->subvc_date->TooltipValue = "";

			// subvc_slipt_num
			$subvcharge->subvc_slipt_num->LinkCustomAttributes = "";
			$subvcharge->subvc_slipt_num->HrefValue = "";
			$subvcharge->subvc_slipt_num->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($subvcharge->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$subvcharge->Row_Rendered();
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
