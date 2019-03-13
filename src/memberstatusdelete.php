<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "memberstatusinfo.php" ?>
<?php include_once "administratorinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$memberstatus_delete = new cmemberstatus_delete();
$Page =& $memberstatus_delete;

// Page init
$memberstatus_delete->Page_Init();

// Page main
$memberstatus_delete->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var memberstatus_delete = new ew_Page("memberstatus_delete");

// page properties
memberstatus_delete.PageID = "delete"; // page ID
memberstatus_delete.FormID = "fmemberstatusdelete"; // form ID
var EW_PAGE_ID = memberstatus_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
memberstatus_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
memberstatus_delete.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
memberstatus_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
memberstatus_delete.ValidateRequired = false; // no JavaScript validation
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
if ($memberstatus_delete->Recordset = $memberstatus_delete->LoadRecordset())
	$memberstatus_deleteTotalRecs = $memberstatus_delete->Recordset->RecordCount(); // Get record count
if ($memberstatus_deleteTotalRecs <= 0) { // No record found, exit
	if ($memberstatus_delete->Recordset)
		$memberstatus_delete->Recordset->Close();
	$memberstatus_delete->Page_Terminate("memberstatuslist.php"); // Return to list
}
?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $memberstatus->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $memberstatus->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $memberstatus_delete->ShowPageHeader(); ?>
<?php
$memberstatus_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="memberstatus">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($memberstatus_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(EW_COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($keyvalue) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $memberstatus->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $memberstatus->s_id->FldCaption() ?></td>
		<td valign="top"><?php echo $memberstatus->s_title->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$memberstatus_delete->RecCnt = 0;
$i = 0;
while (!$memberstatus_delete->Recordset->EOF) {
	$memberstatus_delete->RecCnt++;

	// Set row properties
	$memberstatus->ResetAttrs();
	$memberstatus->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$memberstatus_delete->LoadRowValues($memberstatus_delete->Recordset);

	// Render row
	$memberstatus_delete->RenderRow();
?>
	<tr<?php echo $memberstatus->RowAttributes() ?>>
		<td<?php echo $memberstatus->s_id->CellAttributes() ?>>
<div<?php echo $memberstatus->s_id->ViewAttributes() ?>><?php echo $memberstatus->s_id->ListViewValue() ?></div></td>
		<td<?php echo $memberstatus->s_title->CellAttributes() ?>>
<div<?php echo $memberstatus->s_title->ViewAttributes() ?>><?php echo $memberstatus->s_title->ListViewValue() ?></div></td>
	</tr>
<?php
	$memberstatus_delete->Recordset->MoveNext();
}
$memberstatus_delete->Recordset->Close();
?>
</tbody>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="Action" id="Action" value="<?php echo ew_BtnCaption($Language->Phrase("DeleteBtn")) ?>">
</form>
<?php
$memberstatus_delete->ShowPageFooter();
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
$memberstatus_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class cmemberstatus_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'memberstatus';

	// Page object name
	var $PageObjName = 'memberstatus_delete';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $memberstatus;
		if ($memberstatus->UseTokenInUrl) $PageUrl .= "t=" . $memberstatus->TableVar . "&"; // Add page token
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
		global $objForm, $memberstatus;
		if ($memberstatus->UseTokenInUrl) {
			if ($objForm)
				return ($memberstatus->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($memberstatus->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cmemberstatus_delete() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (memberstatus)
		if (!isset($GLOBALS["memberstatus"])) {
			$GLOBALS["memberstatus"] = new cmemberstatus();
			$GLOBALS["Table"] =& $GLOBALS["memberstatus"];
		}

		// Table object (administrator)
		if (!isset($GLOBALS['administrator'])) $GLOBALS['administrator'] = new cadministrator();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'memberstatus', TRUE);

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
		global $memberstatus;

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
		global $Language, $memberstatus;

		// Load key parameters
		$this->RecKeys = $memberstatus->GetRecordKeys(); // Load record keys
		$sFilter = $memberstatus->GetKeyFilter();
		if ($sFilter == "")
			$this->Page_Terminate("memberstatuslist.php"); // Prevent SQL injection, return to list

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in memberstatus class, memberstatusinfo.php

		$memberstatus->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$memberstatus->CurrentAction = $_POST["a_delete"];
		} else {
			$memberstatus->CurrentAction = "I"; // Display record
		}
		switch ($memberstatus->CurrentAction) {
			case "D": // Delete
				$memberstatus->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setSuccessMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($memberstatus->getReturnUrl()); // Return to caller
				}
		}
	}

// No functions
	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $memberstatus;

		// Call Recordset Selecting event
		$memberstatus->Recordset_Selecting($memberstatus->CurrentFilter);

		// Load List page SQL
		$sSql = $memberstatus->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$memberstatus->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $memberstatus;
		$sFilter = $memberstatus->KeyFilter();

		// Call Row Selecting event
		$memberstatus->Row_Selecting($sFilter);

		// Load SQL based on filter
		$memberstatus->CurrentFilter = $sFilter;
		$sSql = $memberstatus->SQL();
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
		global $conn, $memberstatus;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$memberstatus->Row_Selected($row);
		$memberstatus->s_id->setDbValue($rs->fields('s_id'));
		$memberstatus->s_title->setDbValue($rs->fields('s_title'));
		$memberstatus->s_des->setDbValue($rs->fields('s_des'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $memberstatus;

		// Initialize URLs
		// Call Row_Rendering event

		$memberstatus->Row_Rendering();

		// Common render codes for all row types
		// s_id
		// s_title
		// s_des

		if ($memberstatus->RowType == EW_ROWTYPE_VIEW) { // View row

			// s_id
			$memberstatus->s_id->ViewValue = $memberstatus->s_id->CurrentValue;
			$memberstatus->s_id->ViewCustomAttributes = "";

			// s_title
			$memberstatus->s_title->ViewValue = $memberstatus->s_title->CurrentValue;
			$memberstatus->s_title->ViewCustomAttributes = "";

			// s_id
			$memberstatus->s_id->LinkCustomAttributes = "";
			$memberstatus->s_id->HrefValue = "";
			$memberstatus->s_id->TooltipValue = "";

			// s_title
			$memberstatus->s_title->LinkCustomAttributes = "";
			$memberstatus->s_title->HrefValue = "";
			$memberstatus->s_title->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($memberstatus->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$memberstatus->Row_Rendered();
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $memberstatus;
		$DeleteRows = TRUE;
		$sSql = $memberstatus->SQL();
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
				$DeleteRows = $memberstatus->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['s_id'];
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $conn->Execute($memberstatus->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($memberstatus->CancelMessage <> "") {
				$this->setFailureMessage($memberstatus->CancelMessage);
				$memberstatus->CancelMessage = "";
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
				$memberstatus->Row_Deleted($row);
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
