<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "paymenttypeinfo.php" ?>
<?php include_once "administratorinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$paymenttype_delete = new cpaymenttype_delete();
$Page =& $paymenttype_delete;

// Page init
$paymenttype_delete->Page_Init();

// Page main
$paymenttype_delete->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var paymenttype_delete = new ew_Page("paymenttype_delete");

// page properties
paymenttype_delete.PageID = "delete"; // page ID
paymenttype_delete.FormID = "fpaymenttypedelete"; // form ID
var EW_PAGE_ID = paymenttype_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
paymenttype_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
paymenttype_delete.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
paymenttype_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
paymenttype_delete.ValidateRequired = false; // no JavaScript validation
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
if ($paymenttype_delete->Recordset = $paymenttype_delete->LoadRecordset())
	$paymenttype_deleteTotalRecs = $paymenttype_delete->Recordset->RecordCount(); // Get record count
if ($paymenttype_deleteTotalRecs <= 0) { // No record found, exit
	if ($paymenttype_delete->Recordset)
		$paymenttype_delete->Recordset->Close();
	$paymenttype_delete->Page_Terminate("paymenttypelist.php"); // Return to list
}
?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $paymenttype->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $paymenttype->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $paymenttype_delete->ShowPageHeader(); ?>
<?php
$paymenttype_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="paymenttype">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($paymenttype_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(EW_COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($keyvalue) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $paymenttype->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $paymenttype->pt_id->FldCaption() ?></td>
		<td valign="top"><?php echo $paymenttype->pt_title->FldCaption() ?></td>
		<td valign="top"><?php echo $paymenttype->pt_des->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$paymenttype_delete->RecCnt = 0;
$i = 0;
while (!$paymenttype_delete->Recordset->EOF) {
	$paymenttype_delete->RecCnt++;

	// Set row properties
	$paymenttype->ResetAttrs();
	$paymenttype->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$paymenttype_delete->LoadRowValues($paymenttype_delete->Recordset);

	// Render row
	$paymenttype_delete->RenderRow();
?>
	<tr<?php echo $paymenttype->RowAttributes() ?>>
		<td<?php echo $paymenttype->pt_id->CellAttributes() ?>>
<div<?php echo $paymenttype->pt_id->ViewAttributes() ?>><?php echo $paymenttype->pt_id->ListViewValue() ?></div></td>
		<td<?php echo $paymenttype->pt_title->CellAttributes() ?>>
<div<?php echo $paymenttype->pt_title->ViewAttributes() ?>><?php echo $paymenttype->pt_title->ListViewValue() ?></div></td>
		<td<?php echo $paymenttype->pt_des->CellAttributes() ?>>
<div<?php echo $paymenttype->pt_des->ViewAttributes() ?>><?php echo $paymenttype->pt_des->ListViewValue() ?></div></td>
	</tr>
<?php
	$paymenttype_delete->Recordset->MoveNext();
}
$paymenttype_delete->Recordset->Close();
?>
</tbody>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="Action" id="Action" value="<?php echo ew_BtnCaption($Language->Phrase("DeleteBtn")) ?>">
</form>
<?php
$paymenttype_delete->ShowPageFooter();
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
$paymenttype_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class cpaymenttype_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'paymenttype';

	// Page object name
	var $PageObjName = 'paymenttype_delete';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $paymenttype;
		if ($paymenttype->UseTokenInUrl) $PageUrl .= "t=" . $paymenttype->TableVar . "&"; // Add page token
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
		global $objForm, $paymenttype;
		if ($paymenttype->UseTokenInUrl) {
			if ($objForm)
				return ($paymenttype->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($paymenttype->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cpaymenttype_delete() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (paymenttype)
		if (!isset($GLOBALS["paymenttype"])) {
			$GLOBALS["paymenttype"] = new cpaymenttype();
			$GLOBALS["Table"] =& $GLOBALS["paymenttype"];
		}

		// Table object (administrator)
		if (!isset($GLOBALS['administrator'])) $GLOBALS['administrator'] = new cadministrator();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'paymenttype', TRUE);

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
		global $paymenttype;

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
		global $Language, $paymenttype;

		// Load key parameters
		$this->RecKeys = $paymenttype->GetRecordKeys(); // Load record keys
		$sFilter = $paymenttype->GetKeyFilter();
		if ($sFilter == "")
			$this->Page_Terminate("paymenttypelist.php"); // Prevent SQL injection, return to list

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in paymenttype class, paymenttypeinfo.php

		$paymenttype->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$paymenttype->CurrentAction = $_POST["a_delete"];
		} else {
			$paymenttype->CurrentAction = "I"; // Display record
		}
		switch ($paymenttype->CurrentAction) {
			case "D": // Delete
				$paymenttype->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setSuccessMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($paymenttype->getReturnUrl()); // Return to caller
				}
		}
	}

// No functions
	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $paymenttype;

		// Call Recordset Selecting event
		$paymenttype->Recordset_Selecting($paymenttype->CurrentFilter);

		// Load List page SQL
		$sSql = $paymenttype->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$paymenttype->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $paymenttype;
		$sFilter = $paymenttype->KeyFilter();

		// Call Row Selecting event
		$paymenttype->Row_Selecting($sFilter);

		// Load SQL based on filter
		$paymenttype->CurrentFilter = $sFilter;
		$sSql = $paymenttype->SQL();
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
		global $conn, $paymenttype;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$paymenttype->Row_Selected($row);
		$paymenttype->pt_id->setDbValue($rs->fields('pt_id'));
		$paymenttype->pt_title->setDbValue($rs->fields('pt_title'));
		$paymenttype->pt_des->setDbValue($rs->fields('pt_des'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $paymenttype;

		// Initialize URLs
		// Call Row_Rendering event

		$paymenttype->Row_Rendering();

		// Common render codes for all row types
		// pt_id
		// pt_title
		// pt_des

		if ($paymenttype->RowType == EW_ROWTYPE_VIEW) { // View row

			// pt_id
			$paymenttype->pt_id->ViewValue = $paymenttype->pt_id->CurrentValue;
			$paymenttype->pt_id->ViewCustomAttributes = "";

			// pt_title
			$paymenttype->pt_title->ViewValue = $paymenttype->pt_title->CurrentValue;
			$paymenttype->pt_title->ViewCustomAttributes = "";

			// pt_des
			$paymenttype->pt_des->ViewValue = $paymenttype->pt_des->CurrentValue;
			$paymenttype->pt_des->ViewCustomAttributes = "";

			// pt_id
			$paymenttype->pt_id->LinkCustomAttributes = "";
			$paymenttype->pt_id->HrefValue = "";
			$paymenttype->pt_id->TooltipValue = "";

			// pt_title
			$paymenttype->pt_title->LinkCustomAttributes = "";
			$paymenttype->pt_title->HrefValue = "";
			$paymenttype->pt_title->TooltipValue = "";

			// pt_des
			$paymenttype->pt_des->LinkCustomAttributes = "";
			$paymenttype->pt_des->HrefValue = "";
			$paymenttype->pt_des->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($paymenttype->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$paymenttype->Row_Rendered();
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $paymenttype;
		$DeleteRows = TRUE;
		$sSql = $paymenttype->SQL();
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
				$DeleteRows = $paymenttype->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['pt_id'];
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $conn->Execute($paymenttype->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($paymenttype->CancelMessage <> "") {
				$this->setFailureMessage($paymenttype->CancelMessage);
				$paymenttype->CancelMessage = "";
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
				$paymenttype->Row_Deleted($row);
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
