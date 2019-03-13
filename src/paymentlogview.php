<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "paymentloginfo.php" ?>
<?php include_once "administratorinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$paymentlog_view = new cpaymentlog_view();
$Page =& $paymentlog_view;

// Page init
$paymentlog_view->Page_Init();

// Page main
$paymentlog_view->Page_Main();
?>
<?php include_once "header.php" ?>
<?php 
if ($_GET["fprint"]){
header("location:paylogsliptview.php?paylog_id=".$paymentlog->pml_id->CurrentValue);	
}
?>
<?php if ($paymentlog->Export == "") { ?>
<script type="text/javascript">
<!--
//window.onload = function () {
//	mystickybar.showhide('show');
//}
// Create page object
var paymentlog_view = new ew_Page("paymentlog_view");

// page properties
paymentlog_view.PageID = "view"; // page ID
paymentlog_view.FormID = "fpaymentlogview"; // form ID
var EW_PAGE_ID = paymentlog_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
paymentlog_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
paymentlog_view.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
paymentlog_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
paymentlog_view.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<?php } ?>
<div class="phpmaker ewTitle"><img src="images/ico_paid.png" width="40" height="40" align="absmiddle" /><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $paymentlog->TableCaption() ?>
&nbsp;&nbsp;<?php $paymentlog_view->ExportOptions->Render("body"); ?>
</div><div class="clear"></div>
<?php if ($paymentlog->Export == "") { ?>
<p class="phpmaker">
<a href="<?php echo $paymentlog_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $paymentlog_view->AddUrl ?>"><?php echo $Language->Phrase("ViewPageAddLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $paymentlog_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $paymentlog_view->DeleteUrl ?>"><?php echo $Language->Phrase("ViewPageDeleteLink") ?></a>&nbsp;
<?php } ?>
<?php } ?>
</p>
<?php $paymentlog_view->ShowPageHeader(); ?>
<?php
$paymentlog_view->ShowMessage();
?>
<span class="phpmaker"><a href='paylogsliptview.php?paylog_id=<?php echo $paymentlog->pml_id->CurrentValue ?>' title='พิมพ์ใบเสร็จรับเงิน' target='_blank'><img src="images/bt_print_slipt.png" width="147" height="37" border="0" /></a></span>
<p>
<?php if ($paymentlog->Export == "") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($paymentlog_view->Pager)) $paymentlog_view->Pager = new cPrevNextPager($paymentlog_view->StartRec, $paymentlog_view->DisplayRecs, $paymentlog_view->TotalRecs) ?>
<?php if ($paymentlog_view->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($paymentlog_view->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $paymentlog_view->PageUrl() ?>start=<?php echo $paymentlog_view->Pager->FirstButton->Start ?>"><img src="phpimages/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($paymentlog_view->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $paymentlog_view->PageUrl() ?>start=<?php echo $paymentlog_view->Pager->PrevButton->Start ?>"><img src="phpimages/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $paymentlog_view->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($paymentlog_view->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $paymentlog_view->PageUrl() ?>start=<?php echo $paymentlog_view->Pager->NextButton->Start ?>"><img src="phpimages/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($paymentlog_view->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $paymentlog_view->PageUrl() ?>start=<?php echo $paymentlog_view->Pager->LastButton->Start ?>"><img src="phpimages/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $paymentlog_view->Pager->PageCount ?></span></td>
	</tr></table>
<?php } else { ?>
	<?php if ($paymentlog_view->SearchWhere == "0=101") { ?>
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
<table width="350" cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table width="350" cellspacing="0" class="ewTable">
<?php if ($paymentlog->pay_date->Visible) { // pay_date ?>
	<tr id="r_pay_date"<?php echo $paymentlog->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $paymentlog->pay_date->FldCaption() ?></td>
		<td<?php echo $paymentlog->pay_date->CellAttributes() ?>>
<div<?php echo $paymentlog->pay_date->ViewAttributes() ?>><?php echo $paymentlog->pay_date->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($paymentlog->t_code->Visible) { // t_code ?>
	<tr id="r_t_code"<?php echo $paymentlog->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $paymentlog->t_code->FldCaption() ?></td>
		<td<?php echo $paymentlog->t_code->CellAttributes() ?>>
<div<?php echo $paymentlog->t_code->ViewAttributes() ?>><?php echo $paymentlog->t_code->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($paymentlog->village_id->Visible) { // village_id ?>
	<tr id="r_village_id"<?php echo $paymentlog->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $paymentlog->village_id->FldCaption() ?></td>
		<td<?php echo $paymentlog->village_id->CellAttributes() ?>>
<div<?php echo $paymentlog->village_id->ViewAttributes() ?>><?php echo $paymentlog->village_id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($paymentlog->pay_type->Visible) { // pay_type ?>
	<tr id="r_pay_type"<?php echo $paymentlog->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $paymentlog->pay_type->FldCaption() ?></td>
		<td<?php echo $paymentlog->pay_type->CellAttributes() ?>>
<div<?php echo $paymentlog->pay_type->ViewAttributes() ?>><?php echo $paymentlog->pay_type->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($paymentlog->pay_detail->Visible) { // pay_detail ?>
	<tr id="r_pay_detail"<?php echo $paymentlog->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $paymentlog->pay_detail->FldCaption() ?></td>
		<td<?php echo $paymentlog->pay_detail->CellAttributes() ?>>
<div<?php echo $paymentlog->pay_detail->ViewAttributes() ?>><?php echo $paymentlog->pay_detail->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($paymentlog->count_member->Visible) { // count_member ?>
	<tr id="r_count_member"<?php echo $paymentlog->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $paymentlog->count_member->FldCaption() ?></td>
		<td<?php echo $paymentlog->count_member->CellAttributes() ?>>
<div<?php echo $paymentlog->count_member->ViewAttributes() ?>><?php echo $paymentlog->count_member->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($paymentlog->pay_rate->Visible) { // pay_rate ?>
	<tr id="r_pay_rate"<?php echo $paymentlog->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $paymentlog->pay_rate->FldCaption() ?></td>
		<td<?php echo $paymentlog->pay_rate->CellAttributes() ?>>
<div<?php echo $paymentlog->pay_rate->ViewAttributes() ?>><?php echo $paymentlog->pay_rate->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($paymentlog->sub_total->Visible) { // sub_total ?>
	<tr id="r_sub_total"<?php echo $paymentlog->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $paymentlog->sub_total->FldCaption() ?></td>
		<td<?php echo $paymentlog->sub_total->CellAttributes() ?>>
<div<?php echo $paymentlog->sub_total->ViewAttributes() ?>><?php echo $paymentlog->sub_total->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($paymentlog->assc_rate->Visible) { // assc_rate ?>
	<tr id="r_assc_rate"<?php echo $paymentlog->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $paymentlog->assc_rate->FldCaption() ?></td>
		<td<?php echo $paymentlog->assc_rate->CellAttributes() ?>>
<div<?php echo $paymentlog->assc_rate->ViewAttributes() ?>><?php echo $paymentlog->assc_rate->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($paymentlog->assc_total->Visible) { // assc_total ?>
	<tr id="r_assc_total"<?php echo $paymentlog->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $paymentlog->assc_total->FldCaption() ?></td>
		<td<?php echo $paymentlog->assc_total->CellAttributes() ?>>
<div<?php echo $paymentlog->assc_total->ViewAttributes() ?>><?php echo $paymentlog->assc_total->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($paymentlog->grand_total->Visible) { // grand_total ?>
	<tr id="r_grand_total"<?php echo $paymentlog->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $paymentlog->grand_total->FldCaption() ?></td>
		<td<?php echo $paymentlog->grand_total->CellAttributes() ?>>
<div<?php echo $paymentlog->grand_total->ViewAttributes() ?>><?php echo $paymentlog->grand_total->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($paymentlog->pay_note->Visible) { // pay_note ?>
	<tr id="r_pay_note"<?php echo $paymentlog->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $paymentlog->pay_note->FldCaption() ?></td>
		<td<?php echo $paymentlog->pay_note->CellAttributes() ?>>
<div<?php echo $paymentlog->pay_note->ViewAttributes() ?>><?php echo $paymentlog->pay_note->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($paymentlog->pml_slipt_num->Visible) { // pml_slipt_num ?>
	<tr id="r_pml_slipt_num"<?php echo $paymentlog->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $paymentlog->pml_slipt_num->FldCaption() ?></td>
		<td<?php echo $paymentlog->pml_slipt_num->CellAttributes() ?>>
<div<?php echo $paymentlog->pml_slipt_num->ViewAttributes() ?>><?php echo $paymentlog->pml_slipt_num->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<?php if ($paymentlog->Export == "") { ?>
<br>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($paymentlog_view->Pager)) $paymentlog_view->Pager = new cPrevNextPager($paymentlog_view->StartRec, $paymentlog_view->DisplayRecs, $paymentlog_view->TotalRecs) ?>
<?php if ($paymentlog_view->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($paymentlog_view->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $paymentlog_view->PageUrl() ?>start=<?php echo $paymentlog_view->Pager->FirstButton->Start ?>"><img src="phpimages/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($paymentlog_view->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $paymentlog_view->PageUrl() ?>start=<?php echo $paymentlog_view->Pager->PrevButton->Start ?>"><img src="phpimages/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $paymentlog_view->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($paymentlog_view->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $paymentlog_view->PageUrl() ?>start=<?php echo $paymentlog_view->Pager->NextButton->Start ?>"><img src="phpimages/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($paymentlog_view->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $paymentlog_view->PageUrl() ?>start=<?php echo $paymentlog_view->Pager->LastButton->Start ?>"><img src="phpimages/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $paymentlog_view->Pager->PageCount ?></span></td>
	</tr></table>
<?php } else { ?>
	<?php if ($paymentlog_view->SearchWhere == "0=101") { ?>
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
$paymentlog_view->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($paymentlog->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$paymentlog_view->Page_Terminate();
?>
<?php

//
// Page class
//
class cpaymentlog_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'paymentlog';

	// Page object name
	var $PageObjName = 'paymentlog_view';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $paymentlog;
		if ($paymentlog->UseTokenInUrl) $PageUrl .= "t=" . $paymentlog->TableVar . "&"; // Add page token
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
		global $objForm, $paymentlog;
		if ($paymentlog->UseTokenInUrl) {
			if ($objForm)
				return ($paymentlog->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($paymentlog->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cpaymentlog_view() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (paymentlog)
		if (!isset($GLOBALS["paymentlog"])) {
			$GLOBALS["paymentlog"] = new cpaymentlog();
			$GLOBALS["Table"] =& $GLOBALS["paymentlog"];
		}
		$KeyUrl = "";
		if (@$_GET["pml_id"] <> "") {
			$this->RecKey["pml_id"] = $_GET["pml_id"];
			$KeyUrl .= "&pml_id=" . urlencode($this->RecKey["pml_id"]);
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
			define("EW_TABLE_NAME", 'paymentlog', TRUE);

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
		global $paymentlog;

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
		global $Language, $paymentlog;

		// Load current record
		$bLoadCurrentRecord = FALSE;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["pml_id"] <> "") {
				$paymentlog->pml_id->setQueryStringValue($_GET["pml_id"]);
				$this->RecKey["pml_id"] = $paymentlog->pml_id->QueryStringValue;
			} else {
				$bLoadCurrentRecord = TRUE;
			}

			// Get action
			$paymentlog->CurrentAction = "I"; // Display form
			switch ($paymentlog->CurrentAction) {
				case "I": // Get a record to display
					$this->StartRec = 1; // Initialize start position
					if ($this->Recordset = $this->LoadRecordset()) // Load records
						$this->TotalRecs = $this->Recordset->RecordCount(); // Get record count
					if ($this->TotalRecs <= 0) { // No record found
						if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "")
							$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record message
						$this->Page_Terminate("paymentloglist.php"); // Return to list page
					} elseif ($bLoadCurrentRecord) { // Load current record position
						$this->SetUpStartRec(); // Set up start record position

						// Point to current record
						if (intval($this->StartRec) <= intval($this->TotalRecs)) {
							$bMatchRecord = TRUE;
							$this->Recordset->Move($this->StartRec-1);
						}
					} else { // Match key values
						while (!$this->Recordset->EOF) {
							if (strval($paymentlog->pml_id->CurrentValue) == strval($this->Recordset->fields('pml_id'))) {
								$paymentlog->setStartRecordNumber($this->StartRec); // Save record position
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
						$sReturnUrl = "paymentloglist.php"; // No matching record, return to list
					} else {
						$this->LoadRowValues($this->Recordset); // Load row values
					}
			}
		} else {
			$sReturnUrl = "paymentloglist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$paymentlog->RowType = EW_ROWTYPE_VIEW;
		$paymentlog->ResetAttrs();
		$this->RenderRow();
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $paymentlog;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$paymentlog->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$paymentlog->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $paymentlog->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$paymentlog->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$paymentlog->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$paymentlog->setStartRecordNumber($this->StartRec);
		}
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $paymentlog;

		// Call Recordset Selecting event
		$paymentlog->Recordset_Selecting($paymentlog->CurrentFilter);

		// Load List page SQL
		$sSql = $paymentlog->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$paymentlog->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $paymentlog;
		$sFilter = $paymentlog->KeyFilter();

		// Call Row Selecting event
		$paymentlog->Row_Selecting($sFilter);

		// Load SQL based on filter
		$paymentlog->CurrentFilter = $sFilter;
		$sSql = $paymentlog->SQL();
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
		global $conn, $paymentlog;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$paymentlog->Row_Selected($row);
		$paymentlog->pml_id->setDbValue($rs->fields('pml_id'));
		$paymentlog->pay_date->setDbValue($rs->fields('pay_date'));
		$paymentlog->t_code->setDbValue($rs->fields('t_code'));
		$paymentlog->village_id->setDbValue($rs->fields('village_id'));
		$paymentlog->pay_type->setDbValue($rs->fields('pay_type'));
		$paymentlog->pay_detail->setDbValue($rs->fields('pay_detail'));
		$paymentlog->count_member->setDbValue($rs->fields('count_member'));
		$paymentlog->pay_rate->setDbValue($rs->fields('pay_rate'));
		$paymentlog->sub_total->setDbValue($rs->fields('sub_total'));
		$paymentlog->assc_rate->setDbValue($rs->fields('assc_rate'));
		$paymentlog->assc_total->setDbValue($rs->fields('assc_total'));
		$paymentlog->grand_total->setDbValue($rs->fields('grand_total'));
		$paymentlog->pay_note->setDbValue($rs->fields('pay_note'));
		$paymentlog->pml_slipt_num->setDbValue($rs->fields('pml_slipt_num'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $paymentlog;

		// Initialize URLs
		$this->AddUrl = $paymentlog->AddUrl();
		$this->EditUrl = $paymentlog->EditUrl();
		$this->CopyUrl = $paymentlog->CopyUrl();
		$this->DeleteUrl = $paymentlog->DeleteUrl();
		$this->ListUrl = $paymentlog->ListUrl();

		// Call Row_Rendering event
		$paymentlog->Row_Rendering();

		// Common render codes for all row types
		// pml_id
		// pay_date
		// t_code
		// village_id
		// pay_type
		// pay_detail
		// count_member
		// pay_rate
		// sub_total
		// assc_rate
		// assc_total
		// grand_total
		// pay_note
		// pml_slipt_num

		if ($paymentlog->RowType == EW_ROWTYPE_VIEW) { // View row

			// pay_date
			$paymentlog->pay_date->ViewValue = $paymentlog->pay_date->CurrentValue;
			$paymentlog->pay_date->ViewValue = ew_FormatDateTime($paymentlog->pay_date->ViewValue, 7);
			$paymentlog->pay_date->ViewCustomAttributes = "";

			// t_code
			if (strval($paymentlog->t_code->CurrentValue) <> "") {
				$sFilterWrk = "`t_code` = '" . ew_AdjustSql($paymentlog->t_code->CurrentValue) . "'";
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
					$paymentlog->t_code->ViewValue = $rswrk->fields('t_code');
					$paymentlog->t_code->ViewValue .= ew_ValueSeparator(0,1,$paymentlog->t_code) . $rswrk->fields('t_title');
					$rswrk->Close();
				} else {
					$paymentlog->t_code->ViewValue = $paymentlog->t_code->CurrentValue;
				}
			} else {
				$paymentlog->t_code->ViewValue = NULL;
			}
			$paymentlog->t_code->ViewCustomAttributes = "";

			// village_id
			if (strval($paymentlog->village_id->CurrentValue) <> "") {
				$sFilterWrk = "`village_id` = " . ew_AdjustSql($paymentlog->village_id->CurrentValue) . "";
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
					$paymentlog->village_id->ViewValue = $rswrk->fields('v_code');
					$paymentlog->village_id->ViewValue .= ew_ValueSeparator(0,1,$paymentlog->village_id) . $rswrk->fields('v_title');
					$rswrk->Close();
				} else {
					$paymentlog->village_id->ViewValue = $paymentlog->village_id->CurrentValue;
				}
			} else {
				$paymentlog->village_id->ViewValue = NULL;
			}
			$paymentlog->village_id->ViewCustomAttributes = "";

			// pay_type
			if (strval($paymentlog->pay_type->CurrentValue) <> "") {
				$sFilterWrk = "`pt_id` = " . ew_AdjustSql($paymentlog->pay_type->CurrentValue) . "";
			$sSqlWrk = "SELECT `pt_title` FROM `paymenttype`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `pt_order`";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$paymentlog->pay_type->ViewValue = $rswrk->fields('pt_title');
					$rswrk->Close();
				} else {
					$paymentlog->pay_type->ViewValue = $paymentlog->pay_type->CurrentValue;
				}
			} else {
				$paymentlog->pay_type->ViewValue = NULL;
			}
			$paymentlog->pay_type->ViewCustomAttributes = "";

			// pay_detail
			$paymentlog->pay_detail->ViewValue = $paymentlog->pay_detail->CurrentValue;
			$paymentlog->pay_detail->ViewCustomAttributes = "";

			// count_member
			$paymentlog->count_member->ViewValue = $paymentlog->count_member->CurrentValue;
			$paymentlog->count_member->ViewCustomAttributes = "";

			// pay_rate
			$paymentlog->pay_rate->ViewValue = $paymentlog->pay_rate->CurrentValue;
			$paymentlog->pay_rate->ViewCustomAttributes = "";

			// sub_total
			$paymentlog->sub_total->ViewValue = $paymentlog->sub_total->CurrentValue;
			$paymentlog->sub_total->ViewCustomAttributes = "";

			// assc_rate
			$paymentlog->assc_rate->ViewValue = $paymentlog->assc_rate->CurrentValue;
			$paymentlog->assc_rate->ViewCustomAttributes = "";

			// assc_total
			$paymentlog->assc_total->ViewValue = $paymentlog->assc_total->CurrentValue;
			$paymentlog->assc_total->ViewCustomAttributes = "";

			// grand_total
			$paymentlog->grand_total->ViewValue = $paymentlog->grand_total->CurrentValue;
			$paymentlog->grand_total->ViewCustomAttributes = "";

			// pay_note
			$paymentlog->pay_note->ViewValue = $paymentlog->pay_note->CurrentValue;
			$paymentlog->pay_note->ViewCustomAttributes = "";

			// pml_slipt_num
			$paymentlog->pml_slipt_num->ViewValue = $paymentlog->pml_slipt_num->CurrentValue;
			$paymentlog->pml_slipt_num->ViewCustomAttributes = "";

			// pay_date
			$paymentlog->pay_date->LinkCustomAttributes = "";
			$paymentlog->pay_date->HrefValue = "";
			$paymentlog->pay_date->TooltipValue = "";

			// t_code
			$paymentlog->t_code->LinkCustomAttributes = "";
			$paymentlog->t_code->HrefValue = "";
			$paymentlog->t_code->TooltipValue = "";

			// village_id
			$paymentlog->village_id->LinkCustomAttributes = "";
			$paymentlog->village_id->HrefValue = "";
			$paymentlog->village_id->TooltipValue = "";

			// pay_type
			$paymentlog->pay_type->LinkCustomAttributes = "";
			$paymentlog->pay_type->HrefValue = "";
			$paymentlog->pay_type->TooltipValue = "";

			// pay_detail
			$paymentlog->pay_detail->LinkCustomAttributes = "";
			$paymentlog->pay_detail->HrefValue = "";
			$paymentlog->pay_detail->TooltipValue = "";

			// count_member
			$paymentlog->count_member->LinkCustomAttributes = "";
			$paymentlog->count_member->HrefValue = "";
			$paymentlog->count_member->TooltipValue = "";

			// pay_rate
			$paymentlog->pay_rate->LinkCustomAttributes = "";
			$paymentlog->pay_rate->HrefValue = "";
			$paymentlog->pay_rate->TooltipValue = "";

			// sub_total
			$paymentlog->sub_total->LinkCustomAttributes = "";
			$paymentlog->sub_total->HrefValue = "";
			$paymentlog->sub_total->TooltipValue = "";

			// assc_rate
			$paymentlog->assc_rate->LinkCustomAttributes = "";
			$paymentlog->assc_rate->HrefValue = "";
			$paymentlog->assc_rate->TooltipValue = "";

			// assc_total
			$paymentlog->assc_total->LinkCustomAttributes = "";
			$paymentlog->assc_total->HrefValue = "";
			$paymentlog->assc_total->TooltipValue = "";

			// grand_total
			$paymentlog->grand_total->LinkCustomAttributes = "";
			$paymentlog->grand_total->HrefValue = "";
			$paymentlog->grand_total->TooltipValue = "";

			// pay_note
			$paymentlog->pay_note->LinkCustomAttributes = "";
			$paymentlog->pay_note->HrefValue = "";
			$paymentlog->pay_note->TooltipValue = "";

			// pml_slipt_num
			$paymentlog->pml_slipt_num->LinkCustomAttributes = "";
			$paymentlog->pml_slipt_num->HrefValue = "";
			$paymentlog->pml_slipt_num->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($paymentlog->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$paymentlog->Row_Rendered();
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
