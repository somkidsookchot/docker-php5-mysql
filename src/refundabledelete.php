<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "refundableinfo.php" ?>
<?php include_once "administratorinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$refundable_delete = new crefundable_delete();
$Page =& $refundable_delete;

// Page init
$refundable_delete->Page_Init();

// Page main
$refundable_delete->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var refundable_delete = new ew_Page("refundable_delete");

// page properties
refundable_delete.PageID = "delete"; // page ID
refundable_delete.FormID = "frefundabledelete"; // form ID
var EW_PAGE_ID = refundable_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
refundable_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
refundable_delete.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
refundable_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
refundable_delete.ValidateRequired = false; // no JavaScript validation
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
if ($refundable_delete->Recordset = $refundable_delete->LoadRecordset())
	$refundable_deleteTotalRecs = $refundable_delete->Recordset->RecordCount(); // Get record count
if ($refundable_deleteTotalRecs <= 0) { // No record found, exit
	if ($refundable_delete->Recordset)
		$refundable_delete->Recordset->Close();
	$refundable_delete->Page_Terminate("refundablelist.php"); // Return to list
}
?>
<p class="phpmaker ewTitle"><img src="images/ico_delete_finace.png" width="55" height="55" align="absmiddle" /><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $refundable->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $refundable->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $refundable_delete->ShowPageHeader(); ?>
<?php
$refundable_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="refundable">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($refundable_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(EW_COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($keyvalue) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $refundable->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $refundable->member_code->FldCaption() ?></td>
		<td valign="top"><?php echo $refundable->refund_total->FldCaption() ?></td>
		<td valign="top"><?php echo $refundable->assc_percent->FldCaption() ?></td>
		<td valign="top"><?php echo $refundable->assc_total->FldCaption() ?></td>
		<td valign="top"><?php echo $refundable->sub_total->FldCaption() ?></td>
		<td valign="top"><?php echo $refundable->refund_status->FldCaption() ?></td>
		<td valign="top"><?php echo $refundable->pay_date->FldCaption() ?></td>
		<td valign="top"><?php echo $refundable->refund_slipt_num->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$refundable_delete->RecCnt = 0;
$i = 0;
while (!$refundable_delete->Recordset->EOF) {
	$refundable_delete->RecCnt++;

	// Set row properties
	$refundable->ResetAttrs();
	$refundable->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$refundable_delete->LoadRowValues($refundable_delete->Recordset);

	// Render row
	$refundable_delete->RenderRow();
?>
	<tr<?php echo $refundable->RowAttributes() ?>>
		<td<?php echo $refundable->member_code->CellAttributes() ?>>
<div<?php echo $refundable->member_code->ViewAttributes() ?>><?php echo $refundable->member_code->ListViewValue() ?></div></td>
		<td<?php echo $refundable->refund_total->CellAttributes() ?>>
<div<?php echo $refundable->refund_total->ViewAttributes() ?>><?php echo $refundable->refund_total->ListViewValue() ?></div></td>
		<td<?php echo $refundable->assc_percent->CellAttributes() ?>>
<div<?php echo $refundable->assc_percent->ViewAttributes() ?>><?php echo $refundable->assc_percent->ListViewValue() ?></div></td>
		<td<?php echo $refundable->assc_total->CellAttributes() ?>>
<div<?php echo $refundable->assc_total->ViewAttributes() ?>><?php echo $refundable->assc_total->ListViewValue() ?></div></td>
		<td<?php echo $refundable->sub_total->CellAttributes() ?>>
<div<?php echo $refundable->sub_total->ViewAttributes() ?>><?php echo $refundable->sub_total->ListViewValue() ?></div></td>
		<td<?php echo $refundable->refund_status->CellAttributes() ?>>
<div<?php echo $refundable->refund_status->ViewAttributes() ?>><?php echo $refundable->refund_status->ListViewValue() ?></div></td>
		<td<?php echo $refundable->pay_date->CellAttributes() ?>>
<div<?php echo $refundable->pay_date->ViewAttributes() ?>><?php echo $refundable->pay_date->ListViewValue() ?></div></td>
		<td<?php echo $refundable->refund_slipt_num->CellAttributes() ?>>
<div<?php echo $refundable->refund_slipt_num->ViewAttributes() ?>><?php echo $refundable->refund_slipt_num->ListViewValue() ?></div></td>
	</tr>
<?php
	$refundable_delete->Recordset->MoveNext();
}
$refundable_delete->Recordset->Close();
?>
</tbody>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="Action" id="Action" value="<?php echo ew_BtnCaption($Language->Phrase("DeleteBtn")) ?>">
</form>
<?php
$refundable_delete->ShowPageFooter();
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
$refundable_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class crefundable_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'refundable';

	// Page object name
	var $PageObjName = 'refundable_delete';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $refundable;
		if ($refundable->UseTokenInUrl) $PageUrl .= "t=" . $refundable->TableVar . "&"; // Add page token
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
		global $objForm, $refundable;
		if ($refundable->UseTokenInUrl) {
			if ($objForm)
				return ($refundable->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($refundable->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function crefundable_delete() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (refundable)
		if (!isset($GLOBALS["refundable"])) {
			$GLOBALS["refundable"] = new crefundable();
			$GLOBALS["Table"] =& $GLOBALS["refundable"];
		}

		// Table object (administrator)
		if (!isset($GLOBALS['administrator'])) $GLOBALS['administrator'] = new cadministrator();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'refundable', TRUE);

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
		global $refundable;

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
		global $Language, $refundable;

		// Load key parameters
		$this->RecKeys = $refundable->GetRecordKeys(); // Load record keys
		$sFilter = $refundable->GetKeyFilter();
		if ($sFilter == "")
			$this->Page_Terminate("refundablelist.php"); // Prevent SQL injection, return to list

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in refundable class, refundableinfo.php

		$refundable->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$refundable->CurrentAction = $_POST["a_delete"];
		} else {
			$refundable->CurrentAction = "I"; // Display record
		}
		switch ($refundable->CurrentAction) {
			case "D": // Delete
				$refundable->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setSuccessMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($refundable->getReturnUrl()); // Return to caller
				}
		}
	}

// No functions
	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $refundable;

		// Call Recordset Selecting event
		$refundable->Recordset_Selecting($refundable->CurrentFilter);

		// Load List page SQL
		$sSql = $refundable->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$refundable->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $refundable;
		$sFilter = $refundable->KeyFilter();

		// Call Row Selecting event
		$refundable->Row_Selecting($sFilter);

		// Load SQL based on filter
		$refundable->CurrentFilter = $sFilter;
		$sSql = $refundable->SQL();
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
		global $conn, $refundable;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$refundable->Row_Selected($row);
		$refundable->refund_id->setDbValue($rs->fields('refund_id'));
		$refundable->member_code->setDbValue($rs->fields('member_code'));
		$refundable->refund_total->setDbValue($rs->fields('refund_total'));
		$refundable->assc_percent->setDbValue($rs->fields('assc_percent'));
		$refundable->assc_total->setDbValue($rs->fields('assc_total'));
		$refundable->sub_total->setDbValue($rs->fields('sub_total'));
		$refundable->refund_status->setDbValue($rs->fields('refund_status'));
		$refundable->pay_date->setDbValue($rs->fields('pay_date'));
		$refundable->calculate_date->setDbValue($rs->fields('calculate_date'));
		$refundable->refund_slipt_num->setDbValue($rs->fields('refund_slipt_num'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $refundable;

		// Initialize URLs
		// Call Row_Rendering event

		$refundable->Row_Rendering();

		// Common render codes for all row types
		// refund_id

		$refundable->refund_id->CellCssStyle = "white-space: nowrap;";

		// member_code
		$refundable->member_code->CellCssStyle = "white-space: nowrap;";

		// refund_total
		$refundable->refund_total->CellCssStyle = "white-space: nowrap;";

		// assc_percent
		$refundable->assc_percent->CellCssStyle = "white-space: nowrap;";

		// assc_total
		$refundable->assc_total->CellCssStyle = "white-space: nowrap;";

		// sub_total
		$refundable->sub_total->CellCssStyle = "white-space: nowrap;";

		// refund_status
		$refundable->refund_status->CellCssStyle = "white-space: nowrap;";

		// pay_date
		$refundable->pay_date->CellCssStyle = "white-space: nowrap;";

		// calculate_date
		$refundable->calculate_date->CellCssStyle = "white-space: nowrap;";

		// refund_slipt_num
		$refundable->refund_slipt_num->CellCssStyle = "white-space: nowrap;";
		if ($refundable->RowType == EW_ROWTYPE_VIEW) { // View row

			// member_code
			$refundable->member_code->ViewValue = $refundable->member_code->CurrentValue;
			if (strval($refundable->member_code->CurrentValue) <> "") {
				$sFilterWrk = "`member_code` = '" . ew_AdjustSql($refundable->member_code->CurrentValue) . "'";
			$sSqlWrk = "SELECT `member_code`, `fname`, `lname` FROM `members`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$refundable->member_code->ViewValue = $rswrk->fields('member_code');
					$refundable->member_code->ViewValue .= ew_ValueSeparator(0,1,$refundable->member_code) . $rswrk->fields('fname');
					$refundable->member_code->ViewValue .= ew_ValueSeparator(0,2,$refundable->member_code) . $rswrk->fields('lname');
					$rswrk->Close();
				} else {
					$refundable->member_code->ViewValue = $refundable->member_code->CurrentValue;
				}
			} else {
				$refundable->member_code->ViewValue = NULL;
			}
			$refundable->member_code->ViewCustomAttributes = "";

			// refund_total
			$refundable->refund_total->ViewValue = $refundable->refund_total->CurrentValue;
			$refundable->refund_total->ViewValue = ew_FormatCurrency($refundable->refund_total->ViewValue, 0, -2, -2, -2);
			$refundable->refund_total->ViewCustomAttributes = "";

			// assc_percent
			$refundable->assc_percent->ViewValue = $refundable->assc_percent->CurrentValue;
			$refundable->assc_percent->ViewCustomAttributes = "";

			// assc_total
			$refundable->assc_total->ViewValue = $refundable->assc_total->CurrentValue;
			$refundable->assc_total->ViewValue = ew_FormatCurrency($refundable->assc_total->ViewValue, 0, -2, -2, -2);
			$refundable->assc_total->ViewCustomAttributes = "";

			// sub_total
			$refundable->sub_total->ViewValue = $refundable->sub_total->CurrentValue;
			$refundable->sub_total->ViewValue = ew_FormatCurrency($refundable->sub_total->ViewValue, 0, -2, -2, -2);
			$refundable->sub_total->ViewCustomAttributes = "";

			// refund_status
			if (strval($refundable->refund_status->CurrentValue) <> "") {
				switch ($refundable->refund_status->CurrentValue) {
					case "รอจ่าย":
						$refundable->refund_status->ViewValue = $refundable->refund_status->FldTagCaption(1) <> "" ? $refundable->refund_status->FldTagCaption(1) : $refundable->refund_status->CurrentValue;
						break;
					case "จ่ายแล้ว":
						$refundable->refund_status->ViewValue = $refundable->refund_status->FldTagCaption(2) <> "" ? $refundable->refund_status->FldTagCaption(2) : $refundable->refund_status->CurrentValue;
						break;
					default:
						$refundable->refund_status->ViewValue = $refundable->refund_status->CurrentValue;
				}
			} else {
				$refundable->refund_status->ViewValue = NULL;
			}
			$refundable->refund_status->ViewCustomAttributes = "";

			// pay_date
			$refundable->pay_date->ViewValue = $refundable->pay_date->CurrentValue;
			$refundable->pay_date->ViewValue = ew_FormatDateTime($refundable->pay_date->ViewValue, 7);
			$refundable->pay_date->ViewCustomAttributes = "";

			// refund_slipt_num
			$refundable->refund_slipt_num->ViewValue = $refundable->refund_slipt_num->CurrentValue;
			$refundable->refund_slipt_num->ViewCustomAttributes = "";

			// member_code
			$refundable->member_code->LinkCustomAttributes = "";
			$refundable->member_code->HrefValue = "";
			$refundable->member_code->TooltipValue = "";

			// refund_total
			$refundable->refund_total->LinkCustomAttributes = "";
			$refundable->refund_total->HrefValue = "";
			$refundable->refund_total->TooltipValue = "";

			// assc_percent
			$refundable->assc_percent->LinkCustomAttributes = "";
			$refundable->assc_percent->HrefValue = "";
			$refundable->assc_percent->TooltipValue = "";

			// assc_total
			$refundable->assc_total->LinkCustomAttributes = "";
			$refundable->assc_total->HrefValue = "";
			$refundable->assc_total->TooltipValue = "";

			// sub_total
			$refundable->sub_total->LinkCustomAttributes = "";
			$refundable->sub_total->HrefValue = "";
			$refundable->sub_total->TooltipValue = "";

			// refund_status
			$refundable->refund_status->LinkCustomAttributes = "";
			$refundable->refund_status->HrefValue = "";
			$refundable->refund_status->TooltipValue = "";

			// pay_date
			$refundable->pay_date->LinkCustomAttributes = "";
			$refundable->pay_date->HrefValue = "";
			$refundable->pay_date->TooltipValue = "";

			// refund_slipt_num
			$refundable->refund_slipt_num->LinkCustomAttributes = "";
			$refundable->refund_slipt_num->HrefValue = "";
			$refundable->refund_slipt_num->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($refundable->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$refundable->Row_Rendered();
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $refundable;
		$DeleteRows = TRUE;
		$sSql = $refundable->SQL();
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
				$DeleteRows = $refundable->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['refund_id'];
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $conn->Execute($refundable->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($refundable->CancelMessage <> "") {
				$this->setFailureMessage($refundable->CancelMessage);
				$refundable->CancelMessage = "";
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
				$refundable->Row_Deleted($row);
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
