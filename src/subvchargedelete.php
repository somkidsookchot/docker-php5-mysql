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
$subvcharge_delete = new csubvcharge_delete();
$Page =& $subvcharge_delete;

// Page init
$subvcharge_delete->Page_Init();

// Page main
$subvcharge_delete->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var subvcharge_delete = new ew_Page("subvcharge_delete");

// page properties
subvcharge_delete.PageID = "delete"; // page ID
subvcharge_delete.FormID = "fsubvchargedelete"; // form ID
var EW_PAGE_ID = subvcharge_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
subvcharge_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
subvcharge_delete.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
subvcharge_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
subvcharge_delete.ValidateRequired = false; // no JavaScript validation
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
if ($subvcharge_delete->Recordset = $subvcharge_delete->LoadRecordset())
	$subvcharge_deleteTotalRecs = $subvcharge_delete->Recordset->RecordCount(); // Get record count
if ($subvcharge_deleteTotalRecs <= 0) { // No record found, exit
	if ($subvcharge_delete->Recordset)
		$subvcharge_delete->Recordset->Close();
	$subvcharge_delete->Page_Terminate("subvchargelist.php"); // Return to list
}
?>
<div class="ewTitle"><img src="images/ico_delete_finace.png" width="40" height="40" align="absmiddle" />&nbsp;<?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $subvcharge->TableCaption() ?></div>
<div class="clear"></div>
<p class="phpmaker"><a href="<?php echo $subvcharge->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $subvcharge_delete->ShowPageHeader(); ?>
<?php
$subvcharge_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="subvcharge">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($subvcharge_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(EW_COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($keyvalue) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $subvcharge->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $subvcharge->member_code->FldCaption() ?></td>
		<td valign="top"><?php echo $subvcharge->subvc_total->FldCaption() ?></td>
		<td valign="top"><?php echo $subvcharge->assc_percent->FldCaption() ?></td>
		<td valign="top"><?php echo $subvcharge->assc_total->FldCaption() ?></td>
		<td valign="top"><?php echo $subvcharge->bnfc_total->FldCaption() ?></td>
		<td valign="top"><?php echo $subvcharge->subvc_status->FldCaption() ?></td>
		<td valign="top"><?php echo $subvcharge->subvc_date->FldCaption() ?></td>
		<td valign="top"><?php echo $subvcharge->subvc_slipt_num->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$subvcharge_delete->RecCnt = 0;
$i = 0;
while (!$subvcharge_delete->Recordset->EOF) {
	$subvcharge_delete->RecCnt++;

	// Set row properties
	$subvcharge->ResetAttrs();
	$subvcharge->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$subvcharge_delete->LoadRowValues($subvcharge_delete->Recordset);

	// Render row
	$subvcharge_delete->RenderRow();
?>
	<tr<?php echo $subvcharge->RowAttributes() ?>>
		<td<?php echo $subvcharge->member_code->CellAttributes() ?>>
<div<?php echo $subvcharge->member_code->ViewAttributes() ?>><?php echo $subvcharge->member_code->ListViewValue() ?></div></td>
		<td<?php echo $subvcharge->subvc_total->CellAttributes() ?>>
<div<?php echo $subvcharge->subvc_total->ViewAttributes() ?>><?php echo $subvcharge->subvc_total->ListViewValue() ?></div></td>
		<td<?php echo $subvcharge->assc_percent->CellAttributes() ?>>
<div<?php echo $subvcharge->assc_percent->ViewAttributes() ?>><?php echo $subvcharge->assc_percent->ListViewValue() ?></div></td>
		<td<?php echo $subvcharge->assc_total->CellAttributes() ?>>
<div<?php echo $subvcharge->assc_total->ViewAttributes() ?>><?php echo $subvcharge->assc_total->ListViewValue() ?></div></td>
		<td<?php echo $subvcharge->bnfc_total->CellAttributes() ?>>
<div<?php echo $subvcharge->bnfc_total->ViewAttributes() ?>><?php echo $subvcharge->bnfc_total->ListViewValue() ?></div></td>
		<td<?php echo $subvcharge->subvc_status->CellAttributes() ?>>
<div<?php echo $subvcharge->subvc_status->ViewAttributes() ?>><?php echo $subvcharge->subvc_status->ListViewValue() ?></div></td>
		<td<?php echo $subvcharge->subvc_date->CellAttributes() ?>>
<div<?php echo $subvcharge->subvc_date->ViewAttributes() ?>><?php echo $subvcharge->subvc_date->ListViewValue() ?></div></td>
		<td<?php echo $subvcharge->subvc_slipt_num->CellAttributes() ?>>
<div<?php echo $subvcharge->subvc_slipt_num->ViewAttributes() ?>><?php echo $subvcharge->subvc_slipt_num->ListViewValue() ?></div></td>
	</tr>
<?php
	$subvcharge_delete->Recordset->MoveNext();
}
$subvcharge_delete->Recordset->Close();
?>
</tbody>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="Action" id="Action" value="<?php echo ew_BtnCaption($Language->Phrase("DeleteBtn")) ?>">
</form>
<?php
$subvcharge_delete->ShowPageFooter();
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
$subvcharge_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class csubvcharge_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'subvcharge';

	// Page object name
	var $PageObjName = 'subvcharge_delete';

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
	function csubvcharge_delete() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (subvcharge)
		if (!isset($GLOBALS["subvcharge"])) {
			$GLOBALS["subvcharge"] = new csubvcharge();
			$GLOBALS["Table"] =& $GLOBALS["subvcharge"];
		}

		// Table object (administrator)
		if (!isset($GLOBALS['administrator'])) $GLOBALS['administrator'] = new cadministrator();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'subvcharge', TRUE);

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
	var $TotalRecs = 0;
	var $RecCnt;
	var $RecKeys = array();
	var $Recordset;

	//
	// Page main
	//
	function Page_Main() {
		global $Language, $subvcharge;

		// Load key parameters
		$this->RecKeys = $subvcharge->GetRecordKeys(); // Load record keys
		$sFilter = $subvcharge->GetKeyFilter();
		if ($sFilter == "")
			$this->Page_Terminate("subvchargelist.php"); // Prevent SQL injection, return to list

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in subvcharge class, subvchargeinfo.php

		$subvcharge->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$subvcharge->CurrentAction = $_POST["a_delete"];
		} else {
			$subvcharge->CurrentAction = "I"; // Display record
		}
		switch ($subvcharge->CurrentAction) {
			case "D": // Delete
				$subvcharge->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setSuccessMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($subvcharge->getReturnUrl()); // Return to caller
				}
		}
	}

// No functions
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
		// Call Row_Rendering event

		$subvcharge->Row_Rendering();

		// Common render codes for all row types
		// subvc_id

		$subvcharge->subvc_id->CellCssStyle = "white-space: nowrap;";

		// member_code
		$subvcharge->member_code->CellCssStyle = "white-space: nowrap;";

		// all_member
		$subvcharge->all_member->CellCssStyle = "white-space: nowrap;";

		// alive_count
		$subvcharge->alive_count->CellCssStyle = "white-space: nowrap;";

		// dead_count
		$subvcharge->dead_count->CellCssStyle = "white-space: nowrap;";

		// resign_count
		$subvcharge->resign_count->CellCssStyle = "white-space: nowrap;";

		// terminate_count
		$subvcharge->terminate_count->CellCssStyle = "white-space: nowrap;";

		// subv_rate
		$subvcharge->subv_rate->CellCssStyle = "white-space: nowrap;";

		// can_pay_count
		$subvcharge->can_pay_count->CellCssStyle = "white-space: nowrap;";

		// cant_pay_count
		$subvcharge->cant_pay_count->CellCssStyle = "white-space: nowrap;";

		// cant_pay_detail
		$subvcharge->cant_pay_detail->CellCssStyle = "white-space: nowrap;";

		// subvc_total
		$subvcharge->subvc_total->CellCssStyle = "white-space: nowrap;";

		// assc_percent
		$subvcharge->assc_percent->CellCssStyle = "white-space: nowrap;";

		// assc_total
		$subvcharge->assc_total->CellCssStyle = "white-space: nowrap;";

		// bnfc_total
		$subvcharge->bnfc_total->CellCssStyle = "white-space: nowrap;";

		// canculate_date
		$subvcharge->canculate_date->CellCssStyle = "white-space: nowrap;";

		// subvc_status
		$subvcharge->subvc_status->CellCssStyle = "white-space: nowrap;";

		// subvc_date
		$subvcharge->subvc_date->CellCssStyle = "white-space: nowrap;";

		// subvc_slipt_num
		$subvcharge->subvc_slipt_num->CellCssStyle = "white-space: nowrap;";
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

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $subvcharge;
		$DeleteRows = TRUE;
		$sSql = $subvcharge->SQL();
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
				$DeleteRows = $subvcharge->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['subvc_id'];
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $conn->Execute($subvcharge->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($subvcharge->CancelMessage <> "") {
				$this->setFailureMessage($subvcharge->CancelMessage);
				$subvcharge->CancelMessage = "";
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
				$subvcharge->Row_Deleted($row);
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
