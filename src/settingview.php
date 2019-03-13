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
$setting_view = new csetting_view();
$Page =& $setting_view;

// Page init
$setting_view->Page_Init();

// Page main
$setting_view->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($setting->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var setting_view = new ew_Page("setting_view");

// page properties
setting_view.PageID = "view"; // page ID
setting_view.FormID = "fsettingview"; // form ID
var EW_PAGE_ID = setting_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
setting_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
setting_view.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
setting_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
setting_view.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<?php } ?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $setting->TableCaption() ?>
&nbsp;&nbsp;<?php $setting_view->ExportOptions->Render("body"); ?>
</p>
<?php if ($setting->Export == "") { ?>
<p class="phpmaker">
<a href="<?php echo $setting_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $setting_view->AddUrl ?>"><?php echo $Language->Phrase("ViewPageAddLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $setting_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $setting_view->CopyUrl ?>"><?php echo $Language->Phrase("ViewPageCopyLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $setting_view->DeleteUrl ?>"><?php echo $Language->Phrase("ViewPageDeleteLink") ?></a>&nbsp;
<?php } ?>
<?php } ?>
</p>
<?php $setting_view->ShowPageHeader(); ?>
<?php
$setting_view->ShowMessage();
?>
<p>
<?php if ($setting->Export == "") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($setting_view->Pager)) $setting_view->Pager = new cPrevNextPager($setting_view->StartRec, $setting_view->DisplayRecs, $setting_view->TotalRecs) ?>
<?php if ($setting_view->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($setting_view->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $setting_view->PageUrl() ?>start=<?php echo $setting_view->Pager->FirstButton->Start ?>"><img src="phpimages/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($setting_view->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $setting_view->PageUrl() ?>start=<?php echo $setting_view->Pager->PrevButton->Start ?>"><img src="phpimages/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $setting_view->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($setting_view->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $setting_view->PageUrl() ?>start=<?php echo $setting_view->Pager->NextButton->Start ?>"><img src="phpimages/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($setting_view->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $setting_view->PageUrl() ?>start=<?php echo $setting_view->Pager->LastButton->Start ?>"><img src="phpimages/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $setting_view->Pager->PageCount ?></span></td>
	</tr></table>
<?php } else { ?>
	<?php if ($setting_view->SearchWhere == "0=101") { ?>
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
<?php if ($setting->min_advance_subv->Visible) { // min_advance_subv ?>
	<tr id="r_min_advance_subv"<?php echo $setting->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $setting->min_advance_subv->FldCaption() ?></td>
		<td<?php echo $setting->min_advance_subv->CellAttributes() ?>>
<div<?php echo $setting->min_advance_subv->ViewAttributes() ?>><?php echo $setting->min_advance_subv->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($setting->max_advance_subv->Visible) { // max_advance_subv ?>
	<tr id="r_max_advance_subv"<?php echo $setting->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $setting->max_advance_subv->FldCaption() ?></td>
		<td<?php echo $setting->max_advance_subv->CellAttributes() ?>>
<div<?php echo $setting->max_advance_subv->ViewAttributes() ?>><?php echo $setting->max_advance_subv->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($setting->max_age->Visible) { // max_age ?>
	<tr id="r_max_age"<?php echo $setting->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $setting->max_age->FldCaption() ?></td>
		<td<?php echo $setting->max_age->CellAttributes() ?>>
<div<?php echo $setting->max_age->ViewAttributes() ?>><?php echo $setting->max_age->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($setting->chairman_name->Visible) { // chairman_name ?>
	<tr id="r_chairman_name"<?php echo $setting->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $setting->chairman_name->FldCaption() ?></td>
		<td<?php echo $setting->chairman_name->CellAttributes() ?>>
<div<?php echo $setting->chairman_name->ViewAttributes() ?>><?php echo $setting->chairman_name->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($setting->chairman_signature->Visible) { // chairman_signature ?>
	<tr id="r_chairman_signature"<?php echo $setting->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $setting->chairman_signature->FldCaption() ?></td>
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
	</tr>
<?php } ?>
<?php if ($setting->receiver_name->Visible) { // receiver_name ?>
	<tr id="r_receiver_name"<?php echo $setting->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $setting->receiver_name->FldCaption() ?></td>
		<td<?php echo $setting->receiver_name->CellAttributes() ?>>
<div<?php echo $setting->receiver_name->ViewAttributes() ?>><?php echo $setting->receiver_name->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($setting->receiver_signature->Visible) { // receiver_signature ?>
	<tr id="r_receiver_signature"<?php echo $setting->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $setting->receiver_signature->FldCaption() ?></td>
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
	</tr>
<?php } ?>
<?php if ($setting->logo->Visible) { // logo ?>
	<tr id="r_logo"<?php echo $setting->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $setting->logo->FldCaption() ?></td>
		<td<?php echo $setting->logo->CellAttributes() ?>>
<?php if ($setting->logo->LinkAttributes() <> "") { ?>
<?php if (!empty($setting->logo->Upload->DbValue)) { ?>
<img src="ewbv8.php?fn=<?php echo urlencode(ew_IncludeTrailingDelimiter($setting->logo->UploadPath, FALSE) . $setting->logo->Upload->DbValue) ?>&width=<?php echo $setting->logo->ImageWidth ?>&height=<?php echo $setting->logo->ImageHeight ?>" border=0<?php echo $setting->logo->ViewAttributes() ?>>
<?php } elseif (!in_array($setting->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } else { ?>
<?php if (!empty($setting->logo->Upload->DbValue)) { ?>
<img src="ewbv8.php?fn=<?php echo urlencode(ew_IncludeTrailingDelimiter($setting->logo->UploadPath, FALSE) . $setting->logo->Upload->DbValue) ?>&width=<?php echo $setting->logo->ImageWidth ?>&height=<?php echo $setting->logo->ImageHeight ?>" border=0<?php echo $setting->logo->ViewAttributes() ?>>
<?php } elseif (!in_array($setting->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } ?>
</td>
	</tr>
<?php } ?>
<?php if ($setting->notice_duedate->Visible) { // notice_duedate ?>
	<tr id="r_notice_duedate"<?php echo $setting->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $setting->notice_duedate->FldCaption() ?></td>
		<td<?php echo $setting->notice_duedate->CellAttributes() ?>>
<div<?php echo $setting->notice_duedate->ViewAttributes() ?>><?php echo $setting->notice_duedate->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($setting->invoice_duedate->Visible) { // invoice_duedate ?>
	<tr id="r_invoice_duedate"<?php echo $setting->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $setting->invoice_duedate->FldCaption() ?></td>
		<td<?php echo $setting->invoice_duedate->CellAttributes() ?>>
<div<?php echo $setting->invoice_duedate->ViewAttributes() ?>><?php echo $setting->invoice_duedate->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($setting->contact_info->Visible) { // contact_info ?>
	<tr id="r_contact_info"<?php echo $setting->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $setting->contact_info->FldCaption() ?></td>
		<td<?php echo $setting->contact_info->CellAttributes() ?>>
<div<?php echo $setting->contact_info->ViewAttributes() ?>><?php echo $setting->contact_info->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($setting->annual_fee_duedate->Visible) { // annual_fee_duedate ?>
	<tr id="r_annual_fee_duedate"<?php echo $setting->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $setting->annual_fee_duedate->FldCaption() ?></td>
		<td<?php echo $setting->annual_fee_duedate->CellAttributes() ?>>
<div<?php echo $setting->annual_fee_duedate->ViewAttributes() ?>><?php echo $setting->annual_fee_duedate->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<?php if ($setting->Export == "") { ?>
<br>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($setting_view->Pager)) $setting_view->Pager = new cPrevNextPager($setting_view->StartRec, $setting_view->DisplayRecs, $setting_view->TotalRecs) ?>
<?php if ($setting_view->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($setting_view->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $setting_view->PageUrl() ?>start=<?php echo $setting_view->Pager->FirstButton->Start ?>"><img src="phpimages/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($setting_view->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $setting_view->PageUrl() ?>start=<?php echo $setting_view->Pager->PrevButton->Start ?>"><img src="phpimages/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $setting_view->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($setting_view->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $setting_view->PageUrl() ?>start=<?php echo $setting_view->Pager->NextButton->Start ?>"><img src="phpimages/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($setting_view->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $setting_view->PageUrl() ?>start=<?php echo $setting_view->Pager->LastButton->Start ?>"><img src="phpimages/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $setting_view->Pager->PageCount ?></span></td>
	</tr></table>
<?php } else { ?>
	<?php if ($setting_view->SearchWhere == "0=101") { ?>
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
$setting_view->ShowPageFooter();
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
$setting_view->Page_Terminate();
?>
<?php

//
// Page class
//
class csetting_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'setting';

	// Page object name
	var $PageObjName = 'setting_view';

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
	function csetting_view() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (setting)
		if (!isset($GLOBALS["setting"])) {
			$GLOBALS["setting"] = new csetting();
			$GLOBALS["Table"] =& $GLOBALS["setting"];
		}
		$KeyUrl = "";
		if (@$_GET["setting_id"] <> "") {
			$this->RecKey["setting_id"] = $_GET["setting_id"];
			$KeyUrl .= "&setting_id=" . urlencode($this->RecKey["setting_id"]);
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
			define("EW_TABLE_NAME", 'setting', TRUE);

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
		if (@$_GET["setting_id"] <> "") {
			if ($gsExportFile <> "") $gsExportFile .= "_";
			$gsExportFile .= ew_StripSlashes($_GET["setting_id"]);
		}
		if ($setting->Export == "excel") {
			header('Content-Type: application/vnd.ms-excel' . $Charset);
			header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
		}
		if ($setting->Export == "word") {
			header('Content-Type: application/vnd.ms-word' . $Charset);
			header('Content-Disposition: attachment; filename=' . $gsExportFile .'.doc');
		}

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
		global $Language, $setting;

		// Load current record
		$bLoadCurrentRecord = FALSE;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["setting_id"] <> "") {
				$setting->setting_id->setQueryStringValue($_GET["setting_id"]);
				$this->RecKey["setting_id"] = $setting->setting_id->QueryStringValue;
			} else {
				$bLoadCurrentRecord = TRUE;
			}

			// Get action
			$setting->CurrentAction = "I"; // Display form
			switch ($setting->CurrentAction) {
				case "I": // Get a record to display
					$this->StartRec = 1; // Initialize start position
					if ($this->Recordset = $this->LoadRecordset()) // Load records
						$this->TotalRecs = $this->Recordset->RecordCount(); // Get record count
					if ($this->TotalRecs <= 0) { // No record found
						if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "")
							$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record message
						$this->Page_Terminate("settinglist.php"); // Return to list page
					} elseif ($bLoadCurrentRecord) { // Load current record position
						$this->SetUpStartRec(); // Set up start record position

						// Point to current record
						if (intval($this->StartRec) <= intval($this->TotalRecs)) {
							$bMatchRecord = TRUE;
							$this->Recordset->Move($this->StartRec-1);
						}
					} else { // Match key values
						while (!$this->Recordset->EOF) {
							if (strval($setting->setting_id->CurrentValue) == strval($this->Recordset->fields('setting_id'))) {
								$setting->setStartRecordNumber($this->StartRec); // Save record position
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
						$sReturnUrl = "settinglist.php"; // No matching record, return to list
					} else {
						$this->LoadRowValues($this->Recordset); // Load row values
					}
			}

			// Export data only
			if (in_array($setting->Export, array("html","word","excel","xml","csv","email","pdf"))) {
				$this->ExportData();
				if ($setting->Export <> "email")
					$this->Page_Terminate(); // Terminate response
				exit();
			}
		} else {
			$sReturnUrl = "settinglist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$setting->RowType = EW_ROWTYPE_VIEW;
		$setting->ResetAttrs();
		$this->RenderRow();
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

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $setting;

		// Initialize URLs
		$this->AddUrl = $setting->AddUrl();
		$this->EditUrl = $setting->EditUrl();
		$this->CopyUrl = $setting->CopyUrl();
		$this->DeleteUrl = $setting->DeleteUrl();
		$this->ListUrl = $setting->ListUrl();

		// Call Row_Rendering event
		$setting->Row_Rendering();

		// Common render codes for all row types
		// setting_id
		// regis_rate
		// annual_rate
		// subvention_rate
		// assc_percent
		// max_subvention
		// rc_rate
		// min_advance_subv
		// max_advance_subv
		// quoted_advance_subv
		// max_age
		// chairman_name
		// chairman_signature
		// receiver_name
		// receiver_signature
		// logo
		// notice_duedate
		// invoice_duedate
		// contact_info
		// annual_fee_duedate

		if ($setting->RowType == EW_ROWTYPE_VIEW) { // View row

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

			// logo
			if (!ew_Empty($setting->logo->Upload->DbValue)) {
				$setting->logo->ViewValue = $setting->logo->Upload->DbValue;
				$setting->logo->ImageWidth = 130;
				$setting->logo->ImageHeight = 0;
				$setting->logo->ImageAlt = $setting->logo->FldAlt();
			} else {
				$setting->logo->ViewValue = "";
			}
			$setting->logo->ViewCustomAttributes = "";

			// notice_duedate
			$setting->notice_duedate->ViewValue = $setting->notice_duedate->CurrentValue;
			$setting->notice_duedate->ViewCustomAttributes = "";

			// invoice_duedate
			$setting->invoice_duedate->ViewValue = $setting->invoice_duedate->CurrentValue;
			$setting->invoice_duedate->ViewCustomAttributes = "";

			// contact_info
			$setting->contact_info->ViewValue = $setting->contact_info->CurrentValue;
			$setting->contact_info->ViewCustomAttributes = "";

			// annual_fee_duedate
			$setting->annual_fee_duedate->ViewValue = $setting->annual_fee_duedate->CurrentValue;
			$setting->annual_fee_duedate->ViewValue = ew_FormatDateTime($setting->annual_fee_duedate->ViewValue, 7);
			$setting->annual_fee_duedate->ViewCustomAttributes = "";

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

			// logo
			$setting->logo->LinkCustomAttributes = "";
			$setting->logo->HrefValue = "";
			$setting->logo->TooltipValue = "";

			// notice_duedate
			$setting->notice_duedate->LinkCustomAttributes = "";
			$setting->notice_duedate->HrefValue = "";
			$setting->notice_duedate->TooltipValue = "";

			// invoice_duedate
			$setting->invoice_duedate->LinkCustomAttributes = "";
			$setting->invoice_duedate->HrefValue = "";
			$setting->invoice_duedate->TooltipValue = "";

			// contact_info
			$setting->contact_info->LinkCustomAttributes = "";
			$setting->contact_info->HrefValue = "";
			$setting->contact_info->TooltipValue = "";

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
		$item->Body = "<a name=\"emf_setting\" id=\"emf_setting\" href=\"javascript:void(0);\" onclick=\"ew_EmailDialogShow({lnk:'emf_setting',hdr:ewLanguage.Phrase('ExportToEmail'),key:" . ew_ArrayToJsonAttr($this->RecKey) . ",sel:false});\">" . $Language->Phrase("ExportToEmail") . "</a>";
		$item->Visible = FALSE;

		// Hide options for export/action
		if ($setting->Export <> "")
			$this->ExportOptions->HideAllOptions();
	}

	// Export data in HTML/CSV/Word/Excel/XML/Email/PDF format
	function ExportData() {
		global $setting;
		$utf8 = (strtolower(EW_CHARSET) == "utf-8");
		$bSelectLimit = FALSE;

		// Load recordset
		if ($bSelectLimit) {
			$this->TotalRecs = $setting->SelectRecordCount();
		} else {
			if ($rs = $this->LoadRecordset())
				$this->TotalRecs = $rs->RecordCount();
		}
		$this->StartRec = 1;
		$this->SetUpStartRec(); // Set up start record position

		// Set the last record to display
		if ($this->DisplayRecs < 0) {
			$this->StopRec = $this->TotalRecs;
		} else {
			$this->StopRec = $this->StartRec + $this->DisplayRecs - 1;
		}
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
			$ExportDoc = new cExportDocument($setting, "v");
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
			$setting->ExportXmlDocument($XmlDoc, ($ParentTable <> ""), $rs, $StartRec, $StopRec, "view");
		} else {
			$sHeader = $this->PageHeader;
			$this->Page_DataRendering($sHeader);
			$ExportDoc->Text .= $sHeader;
			$setting->ExportDocument($ExportDoc, $rs, $StartRec, $StopRec, "view");
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
}
?>
