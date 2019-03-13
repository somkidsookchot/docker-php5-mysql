<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "expresspaymentinfo.php" ?>
<?php include_once "administratorinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$expresspayment_view = new cexpresspayment_view();
$Page =& $expresspayment_view;

// Page init
$expresspayment_view->Page_Init();

// Page main
$expresspayment_view->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($expresspayment->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var expresspayment_view = new ew_Page("expresspayment_view");

// page properties
expresspayment_view.PageID = "view"; // page ID
expresspayment_view.FormID = "fexpresspaymentview"; // form ID
var EW_PAGE_ID = expresspayment_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
expresspayment_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
expresspayment_view.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
expresspayment_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
expresspayment_view.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<?php } ?>
<div class="phpmaker ewTitle"><img src="images/ico_paid.png" width="40" height="40" align="absmiddle" /> <?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $expresspayment->TableCaption() ?>
&nbsp;&nbsp;<?php $expresspayment_view->ExportOptions->Render("body"); ?>
</div>
<div class="clear"></div>
<?php if ($expresspayment->Export == "") { ?>
<p class="phpmaker">
<a href="<?php echo $expresspayment_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $expresspayment_view->AddUrl ?>"><?php echo $Language->Phrase("ViewPageAddLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $expresspayment_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $expresspayment_view->DeleteUrl ?>"><?php echo $Language->Phrase("ViewPageDeleteLink") ?></a>&nbsp;
<a href='exprsubvsliptview.php?expr_id=<?php echo $expresspayment->expr_id->CurrentValue ?>' title='พิมพ์ใบเสร็จรับเงิน' target='_blank'><img src='images/ico_send_notice.png' border="0" align='absmiddle'></a>
<?php } ?>
<?php } ?>
</p>
<?php $expresspayment_view->ShowPageHeader(); ?>
<?php
$expresspayment_view->ShowMessage();
?>
<p>
<?php if ($expresspayment->Export == "") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($expresspayment_view->Pager)) $expresspayment_view->Pager = new cPrevNextPager($expresspayment_view->StartRec, $expresspayment_view->DisplayRecs, $expresspayment_view->TotalRecs) ?>
<?php if ($expresspayment_view->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($expresspayment_view->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $expresspayment_view->PageUrl() ?>start=<?php echo $expresspayment_view->Pager->FirstButton->Start ?>"><img src="phpimages/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($expresspayment_view->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $expresspayment_view->PageUrl() ?>start=<?php echo $expresspayment_view->Pager->PrevButton->Start ?>"><img src="phpimages/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $expresspayment_view->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($expresspayment_view->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $expresspayment_view->PageUrl() ?>start=<?php echo $expresspayment_view->Pager->NextButton->Start ?>"><img src="phpimages/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($expresspayment_view->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $expresspayment_view->PageUrl() ?>start=<?php echo $expresspayment_view->Pager->LastButton->Start ?>"><img src="phpimages/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $expresspayment_view->Pager->PageCount ?></span></td>
	</tr></table>
<?php } else { ?>
	<?php if ($expresspayment_view->SearchWhere == "0=101") { ?>
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
<?php if ($expresspayment->t_code->Visible) { // t_code ?>
	<tr id="r_t_code"<?php echo $expresspayment->RowAttributes() ?>>
		<td width="170" class="ewTableHeader"><?php echo $expresspayment->t_code->FldCaption() ?></td>
		<td<?php echo $expresspayment->t_code->CellAttributes() ?>>
<div<?php echo $expresspayment->t_code->ViewAttributes() ?>><?php echo $expresspayment->t_code->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($expresspayment->village_id->Visible) { // village_id ?>
	<tr id="r_village_id"<?php echo $expresspayment->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $expresspayment->village_id->FldCaption() ?></td>
		<td<?php echo $expresspayment->village_id->CellAttributes() ?>>
<div<?php echo $expresspayment->village_id->ViewAttributes() ?>><?php echo $expresspayment->village_id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($expresspayment->subv_total->Visible) { // subv_total ?>
	<tr id="r_subv_total"<?php echo $expresspayment->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $expresspayment->subv_total->FldCaption() ?></td>
		<td<?php echo $expresspayment->subv_total->CellAttributes() ?>>
<div<?php echo $expresspayment->subv_total->ViewAttributes() ?>><?php echo $expresspayment->subv_total->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($expresspayment->subv_detail->Visible) { // subv_detail ?>
	<tr id="r_subv_detail"<?php echo $expresspayment->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $expresspayment->subv_detail->FldCaption() ?></td>
		<td<?php echo $expresspayment->subv_detail->CellAttributes() ?>>
<div<?php echo $expresspayment->subv_detail->ViewAttributes() ?>><?php echo $expresspayment->subv_detail->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($expresspayment->adv_total->Visible) { // adv_total ?>
	<tr id="r_adv_total"<?php echo $expresspayment->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $expresspayment->adv_total->FldCaption() ?></td>
		<td<?php echo $expresspayment->adv_total->CellAttributes() ?>>
<div<?php echo $expresspayment->adv_total->ViewAttributes() ?>><?php echo $expresspayment->adv_total->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($expresspayment->adv_detail->Visible) { // adv_detail ?>
	<tr id="r_adv_detail"<?php echo $expresspayment->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $expresspayment->adv_detail->FldCaption() ?></td>
		<td<?php echo $expresspayment->adv_detail->CellAttributes() ?>>
<div<?php echo $expresspayment->adv_detail->ViewAttributes() ?>><?php echo $expresspayment->adv_detail->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($expresspayment->annual_total->Visible) { // annual_total ?>
	<tr id="r_annual_total"<?php echo $expresspayment->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $expresspayment->annual_total->FldCaption() ?></td>
		<td<?php echo $expresspayment->annual_total->CellAttributes() ?>>
<div<?php echo $expresspayment->annual_total->ViewAttributes() ?>><?php echo $expresspayment->annual_total->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($expresspayment->annual_detail->Visible) { // annual_detail ?>
	<tr id="r_annual_detail"<?php echo $expresspayment->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $expresspayment->annual_detail->FldCaption() ?></td>
		<td<?php echo $expresspayment->annual_detail->CellAttributes() ?>>
<div<?php echo $expresspayment->annual_detail->ViewAttributes() ?>><?php echo $expresspayment->annual_detail->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($expresspayment->regis_total->Visible) { // regis_total ?>
	<tr id="r_regis_total"<?php echo $expresspayment->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $expresspayment->regis_total->FldCaption() ?></td>
		<td<?php echo $expresspayment->regis_total->CellAttributes() ?>>
<div<?php echo $expresspayment->regis_total->ViewAttributes() ?>><?php echo $expresspayment->regis_total->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($expresspayment->regis_detail->Visible) { // regis_detail ?>
	<tr id="r_regis_detail"<?php echo $expresspayment->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $expresspayment->regis_detail->FldCaption() ?></td>
		<td<?php echo $expresspayment->regis_detail->CellAttributes() ?>>
<div<?php echo $expresspayment->regis_detail->ViewAttributes() ?>><?php echo $expresspayment->regis_detail->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($expresspayment->other_total->Visible) { // other_total ?>
	<tr id="r_other_total"<?php echo $expresspayment->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $expresspayment->other_total->FldCaption() ?></td>
		<td<?php echo $expresspayment->other_total->CellAttributes() ?>>
<div<?php echo $expresspayment->other_total->ViewAttributes() ?>><?php echo $expresspayment->other_total->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($expresspayment->other_detail->Visible) { // other_detail ?>
	<tr id="r_other_detail"<?php echo $expresspayment->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $expresspayment->other_detail->FldCaption() ?></td>
		<td<?php echo $expresspayment->other_detail->CellAttributes() ?>>
<div<?php echo $expresspayment->other_detail->ViewAttributes() ?>><?php echo $expresspayment->other_detail->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($expresspayment->expr_total->Visible) { // expr_total ?>
	<tr id="r_expr_total"<?php echo $expresspayment->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $expresspayment->expr_total->FldCaption() ?></td>
		<td<?php echo $expresspayment->expr_total->CellAttributes() ?>>
<div<?php echo $expresspayment->expr_total->ViewAttributes() ?>><?php echo $expresspayment->expr_total->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($expresspayment->expr_note->Visible) { // expr_note ?>
	<tr id="r_expr_note"<?php echo $expresspayment->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $expresspayment->expr_note->FldCaption() ?></td>
		<td<?php echo $expresspayment->expr_note->CellAttributes() ?>>
<div<?php echo $expresspayment->expr_note->ViewAttributes() ?>><?php echo $expresspayment->expr_note->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($expresspayment->expr_pay_date->Visible) { // expr_pay_date ?>
	<tr id="r_expr_pay_date"<?php echo $expresspayment->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $expresspayment->expr_pay_date->FldCaption() ?></td>
		<td<?php echo $expresspayment->expr_pay_date->CellAttributes() ?>>
<div<?php echo $expresspayment->expr_pay_date->ViewAttributes() ?>><?php echo $expresspayment->expr_pay_date->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($expresspayment->expr_slipt_num->Visible) { // expr_slipt_num ?>
	<tr id="r_expr_slipt_num"<?php echo $expresspayment->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $expresspayment->expr_slipt_num->FldCaption() ?></td>
		<td<?php echo $expresspayment->expr_slipt_num->CellAttributes() ?>>
<div<?php echo $expresspayment->expr_slipt_num->ViewAttributes() ?>><?php echo $expresspayment->expr_slipt_num->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<?php if ($expresspayment->Export == "") { ?>
<br>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($expresspayment_view->Pager)) $expresspayment_view->Pager = new cPrevNextPager($expresspayment_view->StartRec, $expresspayment_view->DisplayRecs, $expresspayment_view->TotalRecs) ?>
<?php if ($expresspayment_view->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($expresspayment_view->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $expresspayment_view->PageUrl() ?>start=<?php echo $expresspayment_view->Pager->FirstButton->Start ?>"><img src="phpimages/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($expresspayment_view->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $expresspayment_view->PageUrl() ?>start=<?php echo $expresspayment_view->Pager->PrevButton->Start ?>"><img src="phpimages/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $expresspayment_view->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($expresspayment_view->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $expresspayment_view->PageUrl() ?>start=<?php echo $expresspayment_view->Pager->NextButton->Start ?>"><img src="phpimages/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($expresspayment_view->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $expresspayment_view->PageUrl() ?>start=<?php echo $expresspayment_view->Pager->LastButton->Start ?>"><img src="phpimages/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $expresspayment_view->Pager->PageCount ?></span></td>
	</tr></table>
<?php } else { ?>
	<?php if ($expresspayment_view->SearchWhere == "0=101") { ?>
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
$expresspayment_view->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($expresspayment->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$expresspayment_view->Page_Terminate();
?>
<?php

//
// Page class
//
class cexpresspayment_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'expresspayment';

	// Page object name
	var $PageObjName = 'expresspayment_view';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $expresspayment;
		if ($expresspayment->UseTokenInUrl) $PageUrl .= "t=" . $expresspayment->TableVar . "&"; // Add page token
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
		global $objForm, $expresspayment;
		if ($expresspayment->UseTokenInUrl) {
			if ($objForm)
				return ($expresspayment->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($expresspayment->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cexpresspayment_view() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (expresspayment)
		if (!isset($GLOBALS["expresspayment"])) {
			$GLOBALS["expresspayment"] = new cexpresspayment();
			$GLOBALS["Table"] =& $GLOBALS["expresspayment"];
		}
		$KeyUrl = "";
		if (@$_GET["expr_id"] <> "") {
			$this->RecKey["expr_id"] = $_GET["expr_id"];
			$KeyUrl .= "&expr_id=" . urlencode($this->RecKey["expr_id"]);
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
			define("EW_TABLE_NAME", 'expresspayment', TRUE);

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
		global $expresspayment;

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
		global $Language, $expresspayment;

		// Load current record
		$bLoadCurrentRecord = FALSE;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["expr_id"] <> "") {
				$expresspayment->expr_id->setQueryStringValue($_GET["expr_id"]);
				$this->RecKey["expr_id"] = $expresspayment->expr_id->QueryStringValue;
			} else {
				$bLoadCurrentRecord = TRUE;
			}

			// Get action
			$expresspayment->CurrentAction = "I"; // Display form
			switch ($expresspayment->CurrentAction) {
				case "I": // Get a record to display
					$this->StartRec = 1; // Initialize start position
					if ($this->Recordset = $this->LoadRecordset()) // Load records
						$this->TotalRecs = $this->Recordset->RecordCount(); // Get record count
					if ($this->TotalRecs <= 0) { // No record found
						if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "")
							$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record message
						$this->Page_Terminate("expresspaymentlist.php"); // Return to list page
					} elseif ($bLoadCurrentRecord) { // Load current record position
						$this->SetUpStartRec(); // Set up start record position

						// Point to current record
						if (intval($this->StartRec) <= intval($this->TotalRecs)) {
							$bMatchRecord = TRUE;
							$this->Recordset->Move($this->StartRec-1);
						}
					} else { // Match key values
						while (!$this->Recordset->EOF) {
							if (strval($expresspayment->expr_id->CurrentValue) == strval($this->Recordset->fields('expr_id'))) {
								$expresspayment->setStartRecordNumber($this->StartRec); // Save record position
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
						$sReturnUrl = "expresspaymentlist.php"; // No matching record, return to list
					} else {
						$this->LoadRowValues($this->Recordset); // Load row values
					}
			}
		} else {
			$sReturnUrl = "expresspaymentlist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$expresspayment->RowType = EW_ROWTYPE_VIEW;
		$expresspayment->ResetAttrs();
		$this->RenderRow();
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $expresspayment;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$expresspayment->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$expresspayment->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $expresspayment->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$expresspayment->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$expresspayment->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$expresspayment->setStartRecordNumber($this->StartRec);
		}
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $expresspayment;

		// Call Recordset Selecting event
		$expresspayment->Recordset_Selecting($expresspayment->CurrentFilter);

		// Load List page SQL
		$sSql = $expresspayment->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$expresspayment->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $expresspayment;
		$sFilter = $expresspayment->KeyFilter();

		// Call Row Selecting event
		$expresspayment->Row_Selecting($sFilter);

		// Load SQL based on filter
		$expresspayment->CurrentFilter = $sFilter;
		$sSql = $expresspayment->SQL();
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
		global $conn, $expresspayment;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$expresspayment->Row_Selected($row);
		$expresspayment->expr_id->setDbValue($rs->fields('expr_id'));
		$expresspayment->t_code->setDbValue($rs->fields('t_code'));
		$expresspayment->village_id->setDbValue($rs->fields('village_id'));
		$expresspayment->subv_total->setDbValue($rs->fields('subv_total'));
		$expresspayment->subv_detail->setDbValue($rs->fields('subv_detail'));
		$expresspayment->adv_total->setDbValue($rs->fields('adv_total'));
		$expresspayment->adv_detail->setDbValue($rs->fields('adv_detail'));
		$expresspayment->annual_total->setDbValue($rs->fields('annual_total'));
		$expresspayment->annual_detail->setDbValue($rs->fields('annual_detail'));
		$expresspayment->regis_total->setDbValue($rs->fields('regis_total'));
		$expresspayment->regis_detail->setDbValue($rs->fields('regis_detail'));
		$expresspayment->other_total->setDbValue($rs->fields('other_total'));
		$expresspayment->other_detail->setDbValue($rs->fields('other_detail'));
		$expresspayment->expr_total->setDbValue($rs->fields('expr_total'));
		$expresspayment->expr_note->setDbValue($rs->fields('expr_note'));
		$expresspayment->expr_pay_date->setDbValue($rs->fields('expr_pay_date'));
		$expresspayment->expr_slipt_num->setDbValue($rs->fields('expr_slipt_num'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $expresspayment;

		// Initialize URLs
		$this->AddUrl = $expresspayment->AddUrl();
		$this->EditUrl = $expresspayment->EditUrl();
		$this->CopyUrl = $expresspayment->CopyUrl();
		$this->DeleteUrl = $expresspayment->DeleteUrl();
		$this->ListUrl = $expresspayment->ListUrl();

		// Call Row_Rendering event
		$expresspayment->Row_Rendering();

		// Common render codes for all row types
		// expr_id
		// t_code
		// village_id
		// subv_total
		// subv_detail
		// adv_total
		// adv_detail
		// annual_total
		// annual_detail
		// regis_total
		// regis_detail
		// other_total
		// other_detail
		// expr_total
		// expr_note
		// expr_pay_date
		// expr_slipt_num

		if ($expresspayment->RowType == EW_ROWTYPE_VIEW) { // View row

			// t_code
			if (strval($expresspayment->t_code->CurrentValue) <> "") {
				$sFilterWrk = "`t_code` = '" . ew_AdjustSql($expresspayment->t_code->CurrentValue) . "'";
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
					$expresspayment->t_code->ViewValue = $rswrk->fields('t_code');
					$expresspayment->t_code->ViewValue .= ew_ValueSeparator(0,1,$expresspayment->t_code) . $rswrk->fields('t_title');
					$rswrk->Close();
				} else {
					$expresspayment->t_code->ViewValue = $expresspayment->t_code->CurrentValue;
				}
			} else {
				$expresspayment->t_code->ViewValue = NULL;
			}
			$expresspayment->t_code->ViewCustomAttributes = "";

			// village_id
			if (strval($expresspayment->village_id->CurrentValue) <> "") {
				$sFilterWrk = "`village_id` = " . ew_AdjustSql($expresspayment->village_id->CurrentValue) . "";
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
					$expresspayment->village_id->ViewValue = $rswrk->fields('v_code');
					$expresspayment->village_id->ViewValue .= ew_ValueSeparator(0,1,$expresspayment->village_id) . $rswrk->fields('v_title');
					$rswrk->Close();
				} else {
					$expresspayment->village_id->ViewValue = $expresspayment->village_id->CurrentValue;
				}
			} else {
				$expresspayment->village_id->ViewValue = NULL;
			}
			$expresspayment->village_id->ViewCustomAttributes = "";

			// subv_total
			$expresspayment->subv_total->ViewValue = $expresspayment->subv_total->CurrentValue;
			$expresspayment->subv_total->ViewValue = ew_FormatCurrency($expresspayment->subv_total->ViewValue, 0, -2, -2, -2);
			$expresspayment->subv_total->ViewCustomAttributes = "";

			// subv_detail
			$expresspayment->subv_detail->ViewValue = $expresspayment->subv_detail->CurrentValue;
			$expresspayment->subv_detail->ViewCustomAttributes = "";

			// adv_total
			$expresspayment->adv_total->ViewValue = $expresspayment->adv_total->CurrentValue;
			$expresspayment->adv_total->ViewValue = ew_FormatCurrency($expresspayment->adv_total->ViewValue, 0, -2, -2, -2);
			$expresspayment->adv_total->ViewCustomAttributes = "";

			// adv_detail
			$expresspayment->adv_detail->ViewValue = $expresspayment->adv_detail->CurrentValue;
			$expresspayment->adv_detail->ViewCustomAttributes = "";

			// annual_total
			$expresspayment->annual_total->ViewValue = $expresspayment->annual_total->CurrentValue;
			$expresspayment->annual_total->ViewValue = ew_FormatCurrency($expresspayment->annual_total->ViewValue, 0, -2, -2, -2);
			$expresspayment->annual_total->ViewCustomAttributes = "";

			// annual_detail
			$expresspayment->annual_detail->ViewValue = $expresspayment->annual_detail->CurrentValue;
			$expresspayment->annual_detail->ViewCustomAttributes = "";

			// regis_total
			$expresspayment->regis_total->ViewValue = $expresspayment->regis_total->CurrentValue;
			$expresspayment->regis_total->ViewValue = ew_FormatCurrency($expresspayment->regis_total->ViewValue, 0, -2, -2, -2);
			$expresspayment->regis_total->ViewCustomAttributes = "";

			// regis_detail
			$expresspayment->regis_detail->ViewValue = $expresspayment->regis_detail->CurrentValue;
			$expresspayment->regis_detail->ViewCustomAttributes = "";

			// other_total
			$expresspayment->other_total->ViewValue = $expresspayment->other_total->CurrentValue;
			$expresspayment->other_total->ViewValue = ew_FormatCurrency($expresspayment->other_total->ViewValue, 0, -2, -2, -2);
			$expresspayment->other_total->ViewCustomAttributes = "";

			// other_detail
			$expresspayment->other_detail->ViewValue = $expresspayment->other_detail->CurrentValue;
			$expresspayment->other_detail->ViewCustomAttributes = "";

			// expr_total
			$expresspayment->expr_total->ViewValue = $expresspayment->expr_total->CurrentValue;
			$expresspayment->expr_total->ViewValue = ew_FormatCurrency($expresspayment->expr_total->ViewValue, 0, -2, -2, -2);
			$expresspayment->expr_total->ViewCustomAttributes = "";

			// expr_note
			$expresspayment->expr_note->ViewValue = $expresspayment->expr_note->CurrentValue;
			$expresspayment->expr_note->ViewCustomAttributes = "";

			// expr_pay_date
			$expresspayment->expr_pay_date->ViewValue = $expresspayment->expr_pay_date->CurrentValue;
			$expresspayment->expr_pay_date->ViewValue = ew_FormatDateTime($expresspayment->expr_pay_date->ViewValue, 7);
			$expresspayment->expr_pay_date->ViewCustomAttributes = "";

			// expr_slipt_num
			$expresspayment->expr_slipt_num->ViewValue = $expresspayment->expr_slipt_num->CurrentValue;
			$expresspayment->expr_slipt_num->ViewCustomAttributes = "";

			// t_code
			$expresspayment->t_code->LinkCustomAttributes = "";
			$expresspayment->t_code->HrefValue = "";
			$expresspayment->t_code->TooltipValue = "";

			// village_id
			$expresspayment->village_id->LinkCustomAttributes = "";
			$expresspayment->village_id->HrefValue = "";
			$expresspayment->village_id->TooltipValue = "";

			// subv_total
			$expresspayment->subv_total->LinkCustomAttributes = "";
			$expresspayment->subv_total->HrefValue = "";
			$expresspayment->subv_total->TooltipValue = "";

			// subv_detail
			$expresspayment->subv_detail->LinkCustomAttributes = "";
			$expresspayment->subv_detail->HrefValue = "";
			$expresspayment->subv_detail->TooltipValue = "";

			// adv_total
			$expresspayment->adv_total->LinkCustomAttributes = "";
			$expresspayment->adv_total->HrefValue = "";
			$expresspayment->adv_total->TooltipValue = "";

			// adv_detail
			$expresspayment->adv_detail->LinkCustomAttributes = "";
			$expresspayment->adv_detail->HrefValue = "";
			$expresspayment->adv_detail->TooltipValue = "";

			// annual_total
			$expresspayment->annual_total->LinkCustomAttributes = "";
			$expresspayment->annual_total->HrefValue = "";
			$expresspayment->annual_total->TooltipValue = "";

			// annual_detail
			$expresspayment->annual_detail->LinkCustomAttributes = "";
			$expresspayment->annual_detail->HrefValue = "";
			$expresspayment->annual_detail->TooltipValue = "";

			// regis_total
			$expresspayment->regis_total->LinkCustomAttributes = "";
			$expresspayment->regis_total->HrefValue = "";
			$expresspayment->regis_total->TooltipValue = "";

			// regis_detail
			$expresspayment->regis_detail->LinkCustomAttributes = "";
			$expresspayment->regis_detail->HrefValue = "";
			$expresspayment->regis_detail->TooltipValue = "";

			// other_total
			$expresspayment->other_total->LinkCustomAttributes = "";
			$expresspayment->other_total->HrefValue = "";
			$expresspayment->other_total->TooltipValue = "";

			// other_detail
			$expresspayment->other_detail->LinkCustomAttributes = "";
			$expresspayment->other_detail->HrefValue = "";
			$expresspayment->other_detail->TooltipValue = "";

			// expr_total
			$expresspayment->expr_total->LinkCustomAttributes = "";
			$expresspayment->expr_total->HrefValue = "";
			$expresspayment->expr_total->TooltipValue = "";

			// expr_note
			$expresspayment->expr_note->LinkCustomAttributes = "";
			$expresspayment->expr_note->HrefValue = "";
			$expresspayment->expr_note->TooltipValue = "";

			// expr_pay_date
			$expresspayment->expr_pay_date->LinkCustomAttributes = "";
			$expresspayment->expr_pay_date->HrefValue = "";
			$expresspayment->expr_pay_date->TooltipValue = "";

			// expr_slipt_num
			$expresspayment->expr_slipt_num->LinkCustomAttributes = "";
			$expresspayment->expr_slipt_num->HrefValue = "";
			$expresspayment->expr_slipt_num->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($expresspayment->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$expresspayment->Row_Rendered();
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
