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
$paymentlog_delete = new cpaymentlog_delete();
$Page =& $paymentlog_delete;

// Page init
$paymentlog_delete->Page_Init();

// Page main
$paymentlog_delete->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var paymentlog_delete = new ew_Page("paymentlog_delete");

// page properties
paymentlog_delete.PageID = "delete"; // page ID
paymentlog_delete.FormID = "fpaymentlogdelete"; // form ID
var EW_PAGE_ID = paymentlog_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
paymentlog_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
paymentlog_delete.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
paymentlog_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
paymentlog_delete.ValidateRequired = false; // no JavaScript validation
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
if ($paymentlog_delete->Recordset = $paymentlog_delete->LoadRecordset())
	$paymentlog_deleteTotalRecs = $paymentlog_delete->Recordset->RecordCount(); // Get record count
if ($paymentlog_deleteTotalRecs <= 0) { // No record found, exit
	if ($paymentlog_delete->Recordset)
		$paymentlog_delete->Recordset->Close();
	$paymentlog_delete->Page_Terminate("paymentloglist.php"); // Return to list
}
?>
<div class="phpmaker ewTitle"><img src="images/ico_paid.png" width="40" height="40" align="absmiddle" /><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $paymentlog->TableCaption() ?></div>
<div class="clear"></div>
<p class="phpmaker"><a href="<?php echo $paymentlog->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $paymentlog_delete->ShowPageHeader(); ?>
<?php
$paymentlog_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="paymentlog">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($paymentlog_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(EW_COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($keyvalue) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $paymentlog->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $paymentlog->pay_date->FldCaption() ?></td>
		<td valign="top"><?php echo $paymentlog->t_code->FldCaption() ?></td>
		<td valign="top"><?php echo $paymentlog->village_id->FldCaption() ?></td>
		<td valign="top"><?php echo $paymentlog->pay_type->FldCaption() ?></td>
		<td valign="top"><?php echo $paymentlog->pay_detail->FldCaption() ?></td>
		<td valign="top"><?php echo $paymentlog->count_member->FldCaption() ?></td>
		<td valign="top"><?php echo $paymentlog->pay_rate->FldCaption() ?></td>
		<td valign="top"><?php echo $paymentlog->sub_total->FldCaption() ?></td>
		<td valign="top"><?php echo $paymentlog->assc_rate->FldCaption() ?></td>
		<td valign="top"><?php echo $paymentlog->assc_total->FldCaption() ?></td>
		<td valign="top"><?php echo $paymentlog->grand_total->FldCaption() ?></td>
		<td valign="top"><?php echo $paymentlog->pay_note->FldCaption() ?></td>
		<td valign="top"><?php echo $paymentlog->pml_slipt_num->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$paymentlog_delete->RecCnt = 0;
$i = 0;
while (!$paymentlog_delete->Recordset->EOF) {
	$paymentlog_delete->RecCnt++;

	// Set row properties
	$paymentlog->ResetAttrs();
	$paymentlog->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$paymentlog_delete->LoadRowValues($paymentlog_delete->Recordset);

	// Render row
	$paymentlog_delete->RenderRow();
?>
	<tr<?php echo $paymentlog->RowAttributes() ?>>
		<td<?php echo $paymentlog->pay_date->CellAttributes() ?>>
<div<?php echo $paymentlog->pay_date->ViewAttributes() ?>><?php echo $paymentlog->pay_date->ListViewValue() ?></div></td>
		<td<?php echo $paymentlog->t_code->CellAttributes() ?>>
<div<?php echo $paymentlog->t_code->ViewAttributes() ?>><?php echo $paymentlog->t_code->ListViewValue() ?></div></td>
		<td<?php echo $paymentlog->village_id->CellAttributes() ?>>
<div<?php echo $paymentlog->village_id->ViewAttributes() ?>><?php echo $paymentlog->village_id->ListViewValue() ?></div></td>
		<td<?php echo $paymentlog->pay_type->CellAttributes() ?>>
<div<?php echo $paymentlog->pay_type->ViewAttributes() ?>><?php echo $paymentlog->pay_type->ListViewValue() ?></div></td>
		<td<?php echo $paymentlog->pay_detail->CellAttributes() ?>>
<div<?php echo $paymentlog->pay_detail->ViewAttributes() ?>><?php echo $paymentlog->pay_detail->ListViewValue() ?></div></td>
		<td<?php echo $paymentlog->count_member->CellAttributes() ?>>
<div<?php echo $paymentlog->count_member->ViewAttributes() ?>><?php echo $paymentlog->count_member->ListViewValue() ?></div></td>
		<td<?php echo $paymentlog->pay_rate->CellAttributes() ?>>
<div<?php echo $paymentlog->pay_rate->ViewAttributes() ?>><?php echo $paymentlog->pay_rate->ListViewValue() ?></div></td>
		<td<?php echo $paymentlog->sub_total->CellAttributes() ?>>
<div<?php echo $paymentlog->sub_total->ViewAttributes() ?>><?php echo $paymentlog->sub_total->ListViewValue() ?></div></td>
		<td<?php echo $paymentlog->assc_rate->CellAttributes() ?>>
<div<?php echo $paymentlog->assc_rate->ViewAttributes() ?>><?php echo $paymentlog->assc_rate->ListViewValue() ?></div></td>
		<td<?php echo $paymentlog->assc_total->CellAttributes() ?>>
<div<?php echo $paymentlog->assc_total->ViewAttributes() ?>><?php echo $paymentlog->assc_total->ListViewValue() ?></div></td>
		<td<?php echo $paymentlog->grand_total->CellAttributes() ?>>
<div<?php echo $paymentlog->grand_total->ViewAttributes() ?>><?php echo $paymentlog->grand_total->ListViewValue() ?></div></td>
		<td<?php echo $paymentlog->pay_note->CellAttributes() ?>>
<div<?php echo $paymentlog->pay_note->ViewAttributes() ?>><?php echo $paymentlog->pay_note->ListViewValue() ?></div></td>
		<td<?php echo $paymentlog->pml_slipt_num->CellAttributes() ?>>
<div<?php echo $paymentlog->pml_slipt_num->ViewAttributes() ?>><?php echo $paymentlog->pml_slipt_num->ListViewValue() ?></div></td>
	</tr>
<?php
	$paymentlog_delete->Recordset->MoveNext();
}
$paymentlog_delete->Recordset->Close();
?>
</tbody>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="Action" id="Action" value="<?php echo ew_BtnCaption($Language->Phrase("DeleteBtn")) ?>">
</form>
<?php
$paymentlog_delete->ShowPageFooter();
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
$paymentlog_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class cpaymentlog_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'paymentlog';

	// Page object name
	var $PageObjName = 'paymentlog_delete';

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
	function cpaymentlog_delete() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (paymentlog)
		if (!isset($GLOBALS["paymentlog"])) {
			$GLOBALS["paymentlog"] = new cpaymentlog();
			$GLOBALS["Table"] =& $GLOBALS["paymentlog"];
		}

		// Table object (administrator)
		if (!isset($GLOBALS['administrator'])) $GLOBALS['administrator'] = new cadministrator();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'paymentlog', TRUE);

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
	var $TotalRecs = 0;
	var $RecCnt;
	var $RecKeys = array();
	var $Recordset;

	//
	// Page main
	//
	function Page_Main() {
		global $Language, $paymentlog;

		// Load key parameters
		$this->RecKeys = $paymentlog->GetRecordKeys(); // Load record keys
		$sFilter = $paymentlog->GetKeyFilter();
		if ($sFilter == "")
			$this->Page_Terminate("paymentloglist.php"); // Prevent SQL injection, return to list

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in paymentlog class, paymentloginfo.php

		$paymentlog->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$paymentlog->CurrentAction = $_POST["a_delete"];
		} else {
			$paymentlog->CurrentAction = "I"; // Display record
		}
		switch ($paymentlog->CurrentAction) {
			case "D": // Delete
				$paymentlog->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setSuccessMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($paymentlog->getReturnUrl()); // Return to caller
				}
		}
	}

// No functions
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
		// Call Row_Rendering event

		$paymentlog->Row_Rendering();

		// Common render codes for all row types
		// pml_id

		$paymentlog->pml_id->CellCssStyle = "white-space: nowrap;";

		// pay_date
		$paymentlog->pay_date->CellCssStyle = "white-space: nowrap;";

		// t_code
		$paymentlog->t_code->CellCssStyle = "white-space: nowrap;";

		// village_id
		$paymentlog->village_id->CellCssStyle = "white-space: nowrap;";

		// pay_type
		$paymentlog->pay_type->CellCssStyle = "white-space: nowrap;";

		// pay_detail
		$paymentlog->pay_detail->CellCssStyle = "white-space: nowrap;";

		// count_member
		$paymentlog->count_member->CellCssStyle = "white-space: nowrap;";

		// pay_rate
		$paymentlog->pay_rate->CellCssStyle = "white-space: nowrap;";

		// sub_total
		$paymentlog->sub_total->CellCssStyle = "white-space: nowrap;";

		// assc_rate
		$paymentlog->assc_rate->CellCssStyle = "white-space: nowrap;";

		// assc_total
		$paymentlog->assc_total->CellCssStyle = "white-space: nowrap;";

		// grand_total
		$paymentlog->grand_total->CellCssStyle = "white-space: nowrap;";

		// pay_note
		$paymentlog->pay_note->CellCssStyle = "white-space: nowrap;";

		// pml_slipt_num
		$paymentlog->pml_slipt_num->CellCssStyle = "white-space: nowrap;";
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

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $paymentlog;
		$DeleteRows = TRUE;
		$sSql = $paymentlog->SQL();
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
				$DeleteRows = $paymentlog->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['pml_id'];
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $conn->Execute($paymentlog->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($paymentlog->CancelMessage <> "") {
				$this->setFailureMessage($paymentlog->CancelMessage);
				$paymentlog->CancelMessage = "";
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
				$paymentlog->Row_Deleted($row);
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
