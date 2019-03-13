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
$setting_delete = new csetting_delete();
$Page =& $setting_delete;

// Page init
$setting_delete->Page_Init();

// Page main
$setting_delete->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var setting_delete = new ew_Page("setting_delete");

// page properties
setting_delete.PageID = "delete"; // page ID
setting_delete.FormID = "fsettingdelete"; // form ID
var EW_PAGE_ID = setting_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
setting_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
setting_delete.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
setting_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
setting_delete.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<?php

// Load records for display
if ($setting_delete->Recordset = $setting_delete->LoadRecordset())
	$setting_deleteTotalRecs = $setting_delete->Recordset->RecordCount(); // Get record count
if ($setting_deleteTotalRecs <= 0) { // No record found, exit
	if ($setting_delete->Recordset)
		$setting_delete->Recordset->Close();
	$setting_delete->Page_Terminate("settinglist.php"); // Return to list
}
?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $setting->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $setting->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $setting_delete->ShowPageHeader(); ?>
<?php
$setting_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="setting">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($setting_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(EW_COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($keyvalue) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $setting->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $setting->regis_rate->FldCaption() ?></td>
		<td valign="top"><?php echo $setting->annual_rate->FldCaption() ?></td>
		<td valign="top"><?php echo $setting->subvention_rate->FldCaption() ?></td>
		<td valign="top"><?php echo $setting->assc_percent->FldCaption() ?></td>
		<td valign="top"><?php echo $setting->max_subvention->FldCaption() ?></td>
		<td valign="top"><?php echo $setting->min_advance_subv->FldCaption() ?></td>
		<td valign="top"><?php echo $setting->max_advance_subv->FldCaption() ?></td>
		<td valign="top"><?php echo $setting->max_age->FldCaption() ?></td>
		<td valign="top"><?php echo $setting->chairman_name->FldCaption() ?></td>
		<td valign="top"><?php echo $setting->chairman_signature->FldCaption() ?></td>
		<td valign="top"><?php echo $setting->receiver_name->FldCaption() ?></td>
		<td valign="top"><?php echo $setting->receiver_signature->FldCaption() ?></td>
		<td valign="top"><?php echo $setting->notice_duedate->FldCaption() ?></td>
		<td valign="top"><?php echo $setting->invoice_duedate->FldCaption() ?></td>
		<td valign="top"><?php echo $setting->annual_fee_duedate->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$setting_delete->RecCnt = 0;
$i = 0;
while (!$setting_delete->Recordset->EOF) {
	$setting_delete->RecCnt++;

	// Set row properties
	$setting->ResetAttrs();
	$setting->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$setting_delete->LoadRowValues($setting_delete->Recordset);

	// Render row
	$setting_delete->RenderRow();
?>
	<tr<?php echo $setting->RowAttributes() ?>>
		<td<?php echo $setting->regis_rate->CellAttributes() ?>>
<div<?php echo $setting->regis_rate->ViewAttributes() ?>><?php echo $setting->regis_rate->ListViewValue() ?></div></td>
		<td<?php echo $setting->annual_rate->CellAttributes() ?>>
<div<?php echo $setting->annual_rate->ViewAttributes() ?>><?php echo $setting->annual_rate->ListViewValue() ?></div></td>
		<td<?php echo $setting->subvention_rate->CellAttributes() ?>>
<div<?php echo $setting->subvention_rate->ViewAttributes() ?>><?php echo $setting->subvention_rate->ListViewValue() ?></div></td>
		<td<?php echo $setting->assc_percent->CellAttributes() ?>>
<div<?php echo $setting->assc_percent->ViewAttributes() ?>><?php echo $setting->assc_percent->ListViewValue() ?></div></td>
		<td<?php echo $setting->max_subvention->CellAttributes() ?>>
<div<?php echo $setting->max_subvention->ViewAttributes() ?>><?php echo $setting->max_subvention->ListViewValue() ?></div></td>
		<td<?php echo $setting->min_advance_subv->CellAttributes() ?>>
<div<?php echo $setting->min_advance_subv->ViewAttributes() ?>><?php echo $setting->min_advance_subv->ListViewValue() ?></div></td>
		<td<?php echo $setting->max_advance_subv->CellAttributes() ?>>
<div<?php echo $setting->max_advance_subv->ViewAttributes() ?>><?php echo $setting->max_advance_subv->ListViewValue() ?></div></td>
		<td<?php echo $setting->max_age->CellAttributes() ?>>
<div<?php echo $setting->max_age->ViewAttributes() ?>><?php echo $setting->max_age->ListViewValue() ?></div></td>
		<td<?php echo $setting->chairman_name->CellAttributes() ?>>
<div<?php echo $setting->chairman_name->ViewAttributes() ?>><?php echo $setting->chairman_name->ListViewValue() ?></div></td>
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
		<td<?php echo $setting->receiver_name->CellAttributes() ?>>
<div<?php echo $setting->receiver_name->ViewAttributes() ?>><?php echo $setting->receiver_name->ListViewValue() ?></div></td>
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
		<td<?php echo $setting->notice_duedate->CellAttributes() ?>>
<div<?php echo $setting->notice_duedate->ViewAttributes() ?>><?php echo $setting->notice_duedate->ListViewValue() ?></div></td>
		<td<?php echo $setting->invoice_duedate->CellAttributes() ?>>
<div<?php echo $setting->invoice_duedate->ViewAttributes() ?>><?php echo $setting->invoice_duedate->ListViewValue() ?></div></td>
		<td<?php echo $setting->annual_fee_duedate->CellAttributes() ?>>
<div<?php echo $setting->annual_fee_duedate->ViewAttributes() ?>><?php echo $setting->annual_fee_duedate->ListViewValue() ?></div></td>
	</tr>
<?php
	$setting_delete->Recordset->MoveNext();
}
$setting_delete->Recordset->Close();
?>
</tbody>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="Action" id="Action" value="<?php echo ew_BtnCaption($Language->Phrase("DeleteBtn")) ?>">
</form>
<?php
$setting_delete->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php include_once "footer.php" ?>
<?php
$setting_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class csetting_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'setting';

	// Page object name
	var $PageObjName = 'setting_delete';

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
	function csetting_delete() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (setting)
		if (!isset($GLOBALS["setting"])) {
			$GLOBALS["setting"] = new csetting();
			$GLOBALS["Table"] =& $GLOBALS["setting"];
		}

		// Table object (administrator)
		if (!isset($GLOBALS['administrator'])) $GLOBALS['administrator'] = new cadministrator();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'setting', TRUE);

		// Start timer
		if (!isset($GLOBALS["gTimer"])) $GLOBALS["gTimer"] = new cTimer();

		// Open connection
		if (!isset($conn)) $conn = ew_Connect();
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
	var $TotalRecs = 0;
	var $RecCnt;
	var $RecKeys = array();
	var $Recordset;

	//
	// Page main
	//
	function Page_Main() {
		global $Language, $setting;

		// Load key parameters
		$this->RecKeys = $setting->GetRecordKeys(); // Load record keys
		$sFilter = $setting->GetKeyFilter();
		if ($sFilter == "")
			$this->Page_Terminate("settinglist.php"); // Prevent SQL injection, return to list

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in setting class, settinginfo.php

		$setting->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$setting->CurrentAction = $_POST["a_delete"];
		} else {
			$setting->CurrentAction = "I"; // Display record
		}
		switch ($setting->CurrentAction) {
			case "D": // Delete
				$setting->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setSuccessMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($setting->getReturnUrl()); // Return to caller
				}
		}
	}

// No functions
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

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $setting;
		$DeleteRows = TRUE;
		$sSql = $setting->SQL();
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
		$conn->BeginTrans();

		// Clone old rows
		$rsold = ($rs) ? $rs->GetRows() : array();
		if ($rs)
			$rs->Close();

		// Call row deleting event
		if ($DeleteRows) {
			foreach ($rsold as $row) {
				$DeleteRows = $setting->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['setting_id'];
				@unlink(ew_UploadPathEx(TRUE, $setting->chairman_signature->UploadPath) . $row['chairman_signature']);
				@unlink(ew_UploadPathEx(TRUE, $setting->receiver_signature->UploadPath) . $row['receiver_signature']);
				@unlink(ew_UploadPathEx(TRUE, $setting->logo->UploadPath) . $row['logo']);
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $conn->Execute($setting->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($setting->CancelMessage <> "") {
				$this->setFailureMessage($setting->CancelMessage);
				$setting->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->Phrase("DeleteCancelled"));
			}
		}
		if ($DeleteRows) {
			$conn->CommitTrans(); // Commit the changes
		} else {
			$conn->RollbackTrans(); // Rollback changes
		}

		// Call Row Deleted event
		if ($DeleteRows) {
			foreach ($rsold as $row) {
				$setting->Row_Deleted($row);
			}
		}
		return $DeleteRows;
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
