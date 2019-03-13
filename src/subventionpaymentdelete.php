<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "subventionpaymentinfo.php" ?>
<?php include_once "administratorinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$subventionpayment_delete = new csubventionpayment_delete();
$Page =& $subventionpayment_delete;

// Page init
$subventionpayment_delete->Page_Init();

// Page main
$subventionpayment_delete->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var subventionpayment_delete = new ew_Page("subventionpayment_delete");

// page properties
subventionpayment_delete.PageID = "delete"; // page ID
subventionpayment_delete.FormID = "fsubventionpaymentdelete"; // form ID
var EW_PAGE_ID = subventionpayment_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
subventionpayment_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
subventionpayment_delete.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
subventionpayment_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
subventionpayment_delete.ValidateRequired = false; // no JavaScript validation
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
if ($subventionpayment_delete->Recordset = $subventionpayment_delete->LoadRecordset())
	$subventionpayment_deleteTotalRecs = $subventionpayment_delete->Recordset->RecordCount(); // Get record count
if ($subventionpayment_deleteTotalRecs <= 0) { // No record found, exit
	if ($subventionpayment_delete->Recordset)
		$subventionpayment_delete->Recordset->Close();
	$subventionpayment_delete->Page_Terminate("subventionpaymentlist.php"); // Return to list
}
?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $subventionpayment->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $subventionpayment->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $subventionpayment_delete->ShowPageHeader(); ?>
<?php
$subventionpayment_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="subventionpayment">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($subventionpayment_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(EW_COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($keyvalue) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $subventionpayment->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $subventionpayment->payment_id->FldCaption() ?></td>
		<td valign="top"><?php echo $subventionpayment->dead_id->FldCaption() ?></td>
		<td valign="top"><?php echo $subventionpayment->payment_date->FldCaption() ?></td>
		<td valign="top"><?php echo $subventionpayment->subvent_total->FldCaption() ?></td>
		<td valign="top"><?php echo $subventionpayment->payee->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$subventionpayment_delete->RecCnt = 0;
$i = 0;
while (!$subventionpayment_delete->Recordset->EOF) {
	$subventionpayment_delete->RecCnt++;

	// Set row properties
	$subventionpayment->ResetAttrs();
	$subventionpayment->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$subventionpayment_delete->LoadRowValues($subventionpayment_delete->Recordset);

	// Render row
	$subventionpayment_delete->RenderRow();
?>
	<tr<?php echo $subventionpayment->RowAttributes() ?>>
		<td<?php echo $subventionpayment->payment_id->CellAttributes() ?>>
<div<?php echo $subventionpayment->payment_id->ViewAttributes() ?>><?php echo $subventionpayment->payment_id->ListViewValue() ?></div></td>
		<td<?php echo $subventionpayment->dead_id->CellAttributes() ?>>
<div<?php echo $subventionpayment->dead_id->ViewAttributes() ?>><?php echo $subventionpayment->dead_id->ListViewValue() ?></div></td>
		<td<?php echo $subventionpayment->payment_date->CellAttributes() ?>>
<div<?php echo $subventionpayment->payment_date->ViewAttributes() ?>><?php echo $subventionpayment->payment_date->ListViewValue() ?></div></td>
		<td<?php echo $subventionpayment->subvent_total->CellAttributes() ?>>
<div<?php echo $subventionpayment->subvent_total->ViewAttributes() ?>><?php echo $subventionpayment->subvent_total->ListViewValue() ?></div></td>
		<td<?php echo $subventionpayment->payee->CellAttributes() ?>>
<div<?php echo $subventionpayment->payee->ViewAttributes() ?>><?php echo $subventionpayment->payee->ListViewValue() ?></div></td>
	</tr>
<?php
	$subventionpayment_delete->Recordset->MoveNext();
}
$subventionpayment_delete->Recordset->Close();
?>
</tbody>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="Action" id="Action" value="<?php echo ew_BtnCaption($Language->Phrase("DeleteBtn")) ?>">
</form>
<?php
$subventionpayment_delete->ShowPageFooter();
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
$subventionpayment_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class csubventionpayment_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'subventionpayment';

	// Page object name
	var $PageObjName = 'subventionpayment_delete';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $subventionpayment;
		if ($subventionpayment->UseTokenInUrl) $PageUrl .= "t=" . $subventionpayment->TableVar . "&"; // Add page token
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
		global $objForm, $subventionpayment;
		if ($subventionpayment->UseTokenInUrl) {
			if ($objForm)
				return ($subventionpayment->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($subventionpayment->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function csubventionpayment_delete() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (subventionpayment)
		if (!isset($GLOBALS["subventionpayment"])) {
			$GLOBALS["subventionpayment"] = new csubventionpayment();
			$GLOBALS["Table"] =& $GLOBALS["subventionpayment"];
		}

		// Table object (administrator)
		if (!isset($GLOBALS['administrator'])) $GLOBALS['administrator'] = new cadministrator();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'subventionpayment', TRUE);

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
		global $subventionpayment;

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
		global $Language, $subventionpayment;

		// Load key parameters
		$this->RecKeys = $subventionpayment->GetRecordKeys(); // Load record keys
		$sFilter = $subventionpayment->GetKeyFilter();
		if ($sFilter == "")
			$this->Page_Terminate("subventionpaymentlist.php"); // Prevent SQL injection, return to list

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in subventionpayment class, subventionpaymentinfo.php

		$subventionpayment->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$subventionpayment->CurrentAction = $_POST["a_delete"];
		} else {
			$subventionpayment->CurrentAction = "I"; // Display record
		}
		switch ($subventionpayment->CurrentAction) {
			case "D": // Delete
				$subventionpayment->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setSuccessMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($subventionpayment->getReturnUrl()); // Return to caller
				}
		}
	}

// No functions
	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $subventionpayment;

		// Call Recordset Selecting event
		$subventionpayment->Recordset_Selecting($subventionpayment->CurrentFilter);

		// Load List page SQL
		$sSql = $subventionpayment->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$subventionpayment->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $subventionpayment;
		$sFilter = $subventionpayment->KeyFilter();

		// Call Row Selecting event
		$subventionpayment->Row_Selecting($sFilter);

		// Load SQL based on filter
		$subventionpayment->CurrentFilter = $sFilter;
		$sSql = $subventionpayment->SQL();
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
		global $conn, $subventionpayment;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$subventionpayment->Row_Selected($row);
		$subventionpayment->payment_id->setDbValue($rs->fields('payment_id'));
		$subventionpayment->dead_id->setDbValue($rs->fields('dead_id'));
		$subventionpayment->payment_date->setDbValue($rs->fields('payment_date'));
		$subventionpayment->subvent_total->setDbValue($rs->fields('subvent_total'));
		$subventionpayment->payee->setDbValue($rs->fields('payee'));
		$subventionpayment->pay_des->setDbValue($rs->fields('pay_des'));
		$subventionpayment->donate_total->setDbValue($rs->fields('donate_total'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $subventionpayment;

		// Initialize URLs
		// Call Row_Rendering event

		$subventionpayment->Row_Rendering();

		// Common render codes for all row types
		// payment_id
		// dead_id
		// payment_date
		// subvent_total
		// payee
		// pay_des
		// donate_total

		$subventionpayment->donate_total->CellCssStyle = "white-space: nowrap;";
		if ($subventionpayment->RowType == EW_ROWTYPE_VIEW) { // View row

			// payment_id
			$subventionpayment->payment_id->ViewValue = $subventionpayment->payment_id->CurrentValue;
			$subventionpayment->payment_id->ViewCustomAttributes = "";

			// dead_id
			$subventionpayment->dead_id->ViewValue = $subventionpayment->dead_id->CurrentValue;
			$subventionpayment->dead_id->ViewCustomAttributes = "";

			// payment_date
			$subventionpayment->payment_date->ViewValue = $subventionpayment->payment_date->CurrentValue;
			$subventionpayment->payment_date->ViewValue = ew_FormatDateTime($subventionpayment->payment_date->ViewValue, 7);
			$subventionpayment->payment_date->ViewCustomAttributes = "";

			// subvent_total
			$subventionpayment->subvent_total->ViewValue = $subventionpayment->subvent_total->CurrentValue;
			$subventionpayment->subvent_total->ViewCustomAttributes = "";

			// payee
			$subventionpayment->payee->ViewValue = $subventionpayment->payee->CurrentValue;
			$subventionpayment->payee->ViewCustomAttributes = "";

			// payment_id
			$subventionpayment->payment_id->LinkCustomAttributes = "";
			$subventionpayment->payment_id->HrefValue = "";
			$subventionpayment->payment_id->TooltipValue = "";

			// dead_id
			$subventionpayment->dead_id->LinkCustomAttributes = "";
			$subventionpayment->dead_id->HrefValue = "";
			$subventionpayment->dead_id->TooltipValue = "";

			// payment_date
			$subventionpayment->payment_date->LinkCustomAttributes = "";
			$subventionpayment->payment_date->HrefValue = "";
			$subventionpayment->payment_date->TooltipValue = "";

			// subvent_total
			$subventionpayment->subvent_total->LinkCustomAttributes = "";
			$subventionpayment->subvent_total->HrefValue = "";
			$subventionpayment->subvent_total->TooltipValue = "";

			// payee
			$subventionpayment->payee->LinkCustomAttributes = "";
			$subventionpayment->payee->HrefValue = "";
			$subventionpayment->payee->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($subventionpayment->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$subventionpayment->Row_Rendered();
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $subventionpayment;
		$DeleteRows = TRUE;
		$sSql = $subventionpayment->SQL();
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
				$DeleteRows = $subventionpayment->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['payment_id'];
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $conn->Execute($subventionpayment->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($subventionpayment->CancelMessage <> "") {
				$this->setFailureMessage($subventionpayment->CancelMessage);
				$subventionpayment->CancelMessage = "";
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
				$subventionpayment->Row_Deleted($row);
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
