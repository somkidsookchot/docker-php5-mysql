<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "tamboninfo.php" ?>
<?php include_once "administratorinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$tambon_delete = new ctambon_delete();
$Page =& $tambon_delete;

// Page init
$tambon_delete->Page_Init();

// Page main
$tambon_delete->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var tambon_delete = new ew_Page("tambon_delete");

// page properties
tambon_delete.PageID = "delete"; // page ID
tambon_delete.FormID = "ftambondelete"; // form ID
var EW_PAGE_ID = tambon_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
tambon_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
tambon_delete.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
tambon_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
tambon_delete.ValidateRequired = false; // no JavaScript validation
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
if ($tambon_delete->Recordset = $tambon_delete->LoadRecordset())
	$tambon_deleteTotalRecs = $tambon_delete->Recordset->RecordCount(); // Get record count
if ($tambon_deleteTotalRecs <= 0) { // No record found, exit
	if ($tambon_delete->Recordset)
		$tambon_delete->Recordset->Close();
	$tambon_delete->Page_Terminate("tambonlist.php"); // Return to list
}
?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $tambon->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $tambon->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $tambon_delete->ShowPageHeader(); ?>
<?php
$tambon_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="tambon">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($tambon_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(EW_COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($keyvalue) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $tambon->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $tambon->t_id->FldCaption() ?></td>
		<td valign="top"><?php echo $tambon->t_title->FldCaption() ?></td>
		<td valign="top"><?php echo $tambon->t_order->FldCaption() ?></td>
		<td valign="top"><?php echo $tambon->t_code->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$tambon_delete->RecCnt = 0;
$i = 0;
while (!$tambon_delete->Recordset->EOF) {
	$tambon_delete->RecCnt++;

	// Set row properties
	$tambon->ResetAttrs();
	$tambon->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$tambon_delete->LoadRowValues($tambon_delete->Recordset);

	// Render row
	$tambon_delete->RenderRow();
?>
	<tr<?php echo $tambon->RowAttributes() ?>>
		<td<?php echo $tambon->t_id->CellAttributes() ?>>
<div<?php echo $tambon->t_id->ViewAttributes() ?>><?php echo $tambon->t_id->ListViewValue() ?></div></td>
		<td<?php echo $tambon->t_title->CellAttributes() ?>>
<div<?php echo $tambon->t_title->ViewAttributes() ?>><?php echo $tambon->t_title->ListViewValue() ?></div></td>
		<td<?php echo $tambon->t_order->CellAttributes() ?>>
<div<?php echo $tambon->t_order->ViewAttributes() ?>><?php echo $tambon->t_order->ListViewValue() ?></div></td>
		<td<?php echo $tambon->t_code->CellAttributes() ?>>
<div<?php echo $tambon->t_code->ViewAttributes() ?>><?php echo $tambon->t_code->ListViewValue() ?></div></td>
	</tr>
<?php
	$tambon_delete->Recordset->MoveNext();
}
$tambon_delete->Recordset->Close();
?>
</tbody>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="Action" id="Action" value="<?php echo ew_BtnCaption($Language->Phrase("DeleteBtn")) ?>">
</form>
<?php
$tambon_delete->ShowPageFooter();
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
$tambon_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class ctambon_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'tambon';

	// Page object name
	var $PageObjName = 'tambon_delete';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $tambon;
		if ($tambon->UseTokenInUrl) $PageUrl .= "t=" . $tambon->TableVar . "&"; // Add page token
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
		global $objForm, $tambon;
		if ($tambon->UseTokenInUrl) {
			if ($objForm)
				return ($tambon->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($tambon->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function ctambon_delete() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (tambon)
		if (!isset($GLOBALS["tambon"])) {
			$GLOBALS["tambon"] = new ctambon();
			$GLOBALS["Table"] =& $GLOBALS["tambon"];
		}

		// Table object (administrator)
		if (!isset($GLOBALS['administrator'])) $GLOBALS['administrator'] = new cadministrator();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'tambon', TRUE);

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
		global $tambon;

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
		global $Language, $tambon;

		// Load key parameters
		$this->RecKeys = $tambon->GetRecordKeys(); // Load record keys
		$sFilter = $tambon->GetKeyFilter();
		if ($sFilter == "")
			$this->Page_Terminate("tambonlist.php"); // Prevent SQL injection, return to list

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in tambon class, tamboninfo.php

		$tambon->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$tambon->CurrentAction = $_POST["a_delete"];
		} else {
			$tambon->CurrentAction = "I"; // Display record
		}
		switch ($tambon->CurrentAction) {
			case "D": // Delete
				$tambon->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setSuccessMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($tambon->getReturnUrl()); // Return to caller
				}
		}
	}

// No functions
	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $tambon;

		// Call Recordset Selecting event
		$tambon->Recordset_Selecting($tambon->CurrentFilter);

		// Load List page SQL
		$sSql = $tambon->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$tambon->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $tambon;
		$sFilter = $tambon->KeyFilter();

		// Call Row Selecting event
		$tambon->Row_Selecting($sFilter);

		// Load SQL based on filter
		$tambon->CurrentFilter = $sFilter;
		$sSql = $tambon->SQL();
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
		global $conn, $tambon;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$tambon->Row_Selected($row);
		$tambon->t_id->setDbValue($rs->fields('t_id'));
		$tambon->t_title->setDbValue($rs->fields('t_title'));
		$tambon->t_order->setDbValue($rs->fields('t_order'));
		$tambon->t_code->setDbValue($rs->fields('t_code'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $tambon;

		// Initialize URLs
		// Call Row_Rendering event

		$tambon->Row_Rendering();

		// Common render codes for all row types
		// t_id
		// t_title
		// t_order
		// t_code

		if ($tambon->RowType == EW_ROWTYPE_VIEW) { // View row

			// t_id
			$tambon->t_id->ViewValue = $tambon->t_id->CurrentValue;
			$tambon->t_id->ViewCustomAttributes = "";

			// t_title
			$tambon->t_title->ViewValue = $tambon->t_title->CurrentValue;
			$tambon->t_title->ViewCustomAttributes = "";

			// t_order
			$tambon->t_order->ViewValue = $tambon->t_order->CurrentValue;
			$tambon->t_order->ViewCustomAttributes = "";

			// t_code
			$tambon->t_code->ViewValue = $tambon->t_code->CurrentValue;
			$tambon->t_code->ViewCustomAttributes = "";

			// t_id
			$tambon->t_id->LinkCustomAttributes = "";
			$tambon->t_id->HrefValue = "";
			$tambon->t_id->TooltipValue = "";

			// t_title
			$tambon->t_title->LinkCustomAttributes = "";
			$tambon->t_title->HrefValue = "";
			$tambon->t_title->TooltipValue = "";

			// t_order
			$tambon->t_order->LinkCustomAttributes = "";
			$tambon->t_order->HrefValue = "";
			$tambon->t_order->TooltipValue = "";

			// t_code
			$tambon->t_code->LinkCustomAttributes = "";
			$tambon->t_code->HrefValue = "";
			$tambon->t_code->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($tambon->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$tambon->Row_Rendered();
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $tambon;
		$DeleteRows = TRUE;
		$sSql = $tambon->SQL();
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
				$DeleteRows = $tambon->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['t_id'];
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $conn->Execute($tambon->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($tambon->CancelMessage <> "") {
				$this->setFailureMessage($tambon->CancelMessage);
				$tambon->CancelMessage = "";
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
				$tambon->Row_Deleted($row);
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
