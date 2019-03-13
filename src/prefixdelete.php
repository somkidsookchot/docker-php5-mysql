<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "prefixinfo.php" ?>
<?php include_once "administratorinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$prefix_delete = new cprefix_delete();
$Page =& $prefix_delete;

// Page init
$prefix_delete->Page_Init();

// Page main
$prefix_delete->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var prefix_delete = new ew_Page("prefix_delete");

// page properties
prefix_delete.PageID = "delete"; // page ID
prefix_delete.FormID = "fprefixdelete"; // form ID
var EW_PAGE_ID = prefix_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
prefix_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
prefix_delete.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
prefix_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
prefix_delete.ValidateRequired = false; // no JavaScript validation
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
if ($prefix_delete->Recordset = $prefix_delete->LoadRecordset())
	$prefix_deleteTotalRecs = $prefix_delete->Recordset->RecordCount(); // Get record count
if ($prefix_deleteTotalRecs <= 0) { // No record found, exit
	if ($prefix_delete->Recordset)
		$prefix_delete->Recordset->Close();
	$prefix_delete->Page_Terminate("prefixlist.php"); // Return to list
}
?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $prefix->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $prefix->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $prefix_delete->ShowPageHeader(); ?>
<?php
$prefix_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="prefix">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($prefix_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(EW_COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($keyvalue) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $prefix->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $prefix->prefix_id->FldCaption() ?></td>
		<td valign="top"><?php echo $prefix->p_title->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$prefix_delete->RecCnt = 0;
$i = 0;
while (!$prefix_delete->Recordset->EOF) {
	$prefix_delete->RecCnt++;

	// Set row properties
	$prefix->ResetAttrs();
	$prefix->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$prefix_delete->LoadRowValues($prefix_delete->Recordset);

	// Render row
	$prefix_delete->RenderRow();
?>
	<tr<?php echo $prefix->RowAttributes() ?>>
		<td<?php echo $prefix->prefix_id->CellAttributes() ?>>
<div<?php echo $prefix->prefix_id->ViewAttributes() ?>><?php echo $prefix->prefix_id->ListViewValue() ?></div></td>
		<td<?php echo $prefix->p_title->CellAttributes() ?>>
<div<?php echo $prefix->p_title->ViewAttributes() ?>><?php echo $prefix->p_title->ListViewValue() ?></div></td>
	</tr>
<?php
	$prefix_delete->Recordset->MoveNext();
}
$prefix_delete->Recordset->Close();
?>
</tbody>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="Action" id="Action" value="<?php echo ew_BtnCaption($Language->Phrase("DeleteBtn")) ?>">
</form>
<?php
$prefix_delete->ShowPageFooter();
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
$prefix_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class cprefix_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'prefix';

	// Page object name
	var $PageObjName = 'prefix_delete';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $prefix;
		if ($prefix->UseTokenInUrl) $PageUrl .= "t=" . $prefix->TableVar . "&"; // Add page token
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
		global $objForm, $prefix;
		if ($prefix->UseTokenInUrl) {
			if ($objForm)
				return ($prefix->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($prefix->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cprefix_delete() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (prefix)
		if (!isset($GLOBALS["prefix"])) {
			$GLOBALS["prefix"] = new cprefix();
			$GLOBALS["Table"] =& $GLOBALS["prefix"];
		}

		// Table object (administrator)
		if (!isset($GLOBALS['administrator'])) $GLOBALS['administrator'] = new cadministrator();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'prefix', TRUE);

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
		global $prefix;

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
		global $Language, $prefix;

		// Load key parameters
		$this->RecKeys = $prefix->GetRecordKeys(); // Load record keys
		$sFilter = $prefix->GetKeyFilter();
		if ($sFilter == "")
			$this->Page_Terminate("prefixlist.php"); // Prevent SQL injection, return to list

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in prefix class, prefixinfo.php

		$prefix->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$prefix->CurrentAction = $_POST["a_delete"];
		} else {
			$prefix->CurrentAction = "I"; // Display record
		}
		switch ($prefix->CurrentAction) {
			case "D": // Delete
				$prefix->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setSuccessMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($prefix->getReturnUrl()); // Return to caller
				}
		}
	}

// No functions
	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $prefix;

		// Call Recordset Selecting event
		$prefix->Recordset_Selecting($prefix->CurrentFilter);

		// Load List page SQL
		$sSql = $prefix->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$prefix->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $prefix;
		$sFilter = $prefix->KeyFilter();

		// Call Row Selecting event
		$prefix->Row_Selecting($sFilter);

		// Load SQL based on filter
		$prefix->CurrentFilter = $sFilter;
		$sSql = $prefix->SQL();
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
		global $conn, $prefix;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$prefix->Row_Selected($row);
		$prefix->prefix_id->setDbValue($rs->fields('prefix_id'));
		$prefix->p_title->setDbValue($rs->fields('p_title'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $prefix;

		// Initialize URLs
		// Call Row_Rendering event

		$prefix->Row_Rendering();

		// Common render codes for all row types
		// prefix_id
		// p_title

		if ($prefix->RowType == EW_ROWTYPE_VIEW) { // View row

			// prefix_id
			$prefix->prefix_id->ViewValue = $prefix->prefix_id->CurrentValue;
			$prefix->prefix_id->ViewCustomAttributes = "";

			// p_title
			$prefix->p_title->ViewValue = $prefix->p_title->CurrentValue;
			$prefix->p_title->ViewCustomAttributes = "";

			// prefix_id
			$prefix->prefix_id->LinkCustomAttributes = "";
			$prefix->prefix_id->HrefValue = "";
			$prefix->prefix_id->TooltipValue = "";

			// p_title
			$prefix->p_title->LinkCustomAttributes = "";
			$prefix->p_title->HrefValue = "";
			$prefix->p_title->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($prefix->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$prefix->Row_Rendered();
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $prefix;
		$DeleteRows = TRUE;
		$sSql = $prefix->SQL();
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
				$DeleteRows = $prefix->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['prefix_id'];
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $conn->Execute($prefix->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($prefix->CancelMessage <> "") {
				$this->setFailureMessage($prefix->CancelMessage);
				$prefix->CancelMessage = "";
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
				$prefix->Row_Deleted($row);
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
