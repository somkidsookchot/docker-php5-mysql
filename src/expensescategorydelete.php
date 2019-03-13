<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "expensescategoryinfo.php" ?>
<?php include_once "administratorinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$expensescategory_delete = new cexpensescategory_delete();
$Page =& $expensescategory_delete;

// Page init
$expensescategory_delete->Page_Init();

// Page main
$expensescategory_delete->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var expensescategory_delete = new ew_Page("expensescategory_delete");

// page properties
expensescategory_delete.PageID = "delete"; // page ID
expensescategory_delete.FormID = "fexpensescategorydelete"; // form ID
var EW_PAGE_ID = expensescategory_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
expensescategory_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
expensescategory_delete.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
expensescategory_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
expensescategory_delete.ValidateRequired = false; // no JavaScript validation
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
if ($expensescategory_delete->Recordset = $expensescategory_delete->LoadRecordset())
	$expensescategory_deleteTotalRecs = $expensescategory_delete->Recordset->RecordCount(); // Get record count
if ($expensescategory_deleteTotalRecs <= 0) { // No record found, exit
	if ($expensescategory_delete->Recordset)
		$expensescategory_delete->Recordset->Close();
	$expensescategory_delete->Page_Terminate("expensescategorylist.php"); // Return to list
}
?>
<div class="phpmaker ewTitle"><img src="images/ico_delete_category.png" width="40" height="40" align="absmiddle" /> <?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $expensescategory->TableCaption() ?></div>
<div class="clear"></div>
<?php $expensescategory_delete->ShowPageHeader(); ?>
<?php
$expensescategory_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="expensescategory">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($expensescategory_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(EW_COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($keyvalue) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $expensescategory->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $expensescategory->exp_cat_title->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$expensescategory_delete->RecCnt = 0;
$i = 0;
while (!$expensescategory_delete->Recordset->EOF) {
	$expensescategory_delete->RecCnt++;

	// Set row properties
	$expensescategory->ResetAttrs();
	$expensescategory->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$expensescategory_delete->LoadRowValues($expensescategory_delete->Recordset);

	// Render row
	$expensescategory_delete->RenderRow();
?>
	<tr<?php echo $expensescategory->RowAttributes() ?>>
		<td<?php echo $expensescategory->exp_cat_title->CellAttributes() ?>>
<div<?php echo $expensescategory->exp_cat_title->ViewAttributes() ?>><?php echo $expensescategory->exp_cat_title->ListViewValue() ?></div></td>
	</tr>
<?php
	$expensescategory_delete->Recordset->MoveNext();
}
$expensescategory_delete->Recordset->Close();
?>
</tbody>
</table>
</div>
</td></tr></table>
<p>
<a href="<?php echo $expensescategory->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a>&nbsp;
<input type="submit" name="Action" id="Action" value="<?php echo ew_BtnCaption($Language->Phrase("DeleteBtn")) ?>">
</form>
<?php
$expensescategory_delete->ShowPageFooter();
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
$expensescategory_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class cexpensescategory_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'expensescategory';

	// Page object name
	var $PageObjName = 'expensescategory_delete';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $expensescategory;
		if ($expensescategory->UseTokenInUrl) $PageUrl .= "t=" . $expensescategory->TableVar . "&"; // Add page token
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
		global $objForm, $expensescategory;
		if ($expensescategory->UseTokenInUrl) {
			if ($objForm)
				return ($expensescategory->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($expensescategory->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cexpensescategory_delete() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (expensescategory)
		if (!isset($GLOBALS["expensescategory"])) {
			$GLOBALS["expensescategory"] = new cexpensescategory();
			$GLOBALS["Table"] =& $GLOBALS["expensescategory"];
		}

		// Table object (administrator)
		if (!isset($GLOBALS['administrator'])) $GLOBALS['administrator'] = new cadministrator();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'expensescategory', TRUE);

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
		global $expensescategory;

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
		global $Language, $expensescategory;

		// Load key parameters
		$this->RecKeys = $expensescategory->GetRecordKeys(); // Load record keys
		$sFilter = $expensescategory->GetKeyFilter();
		if ($sFilter == "")
			$this->Page_Terminate("expensescategorylist.php"); // Prevent SQL injection, return to list

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in expensescategory class, expensescategoryinfo.php

		$expensescategory->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$expensescategory->CurrentAction = $_POST["a_delete"];
		} else {
			$expensescategory->CurrentAction = "I"; // Display record
		}
		switch ($expensescategory->CurrentAction) {
			case "D": // Delete
				$expensescategory->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setSuccessMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($expensescategory->getReturnUrl()); // Return to caller
				}
		}
	}

// No functions
	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $expensescategory;

		// Call Recordset Selecting event
		$expensescategory->Recordset_Selecting($expensescategory->CurrentFilter);

		// Load List page SQL
		$sSql = $expensescategory->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$expensescategory->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $expensescategory;
		$sFilter = $expensescategory->KeyFilter();

		// Call Row Selecting event
		$expensescategory->Row_Selecting($sFilter);

		// Load SQL based on filter
		$expensescategory->CurrentFilter = $sFilter;
		$sSql = $expensescategory->SQL();
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
		global $conn, $expensescategory;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$expensescategory->Row_Selected($row);
		$expensescategory->exp_cat_id->setDbValue($rs->fields('exp_cat_id'));
		$expensescategory->exp_cat_title->setDbValue($rs->fields('exp_cat_title'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $expensescategory;

		// Initialize URLs
		// Call Row_Rendering event

		$expensescategory->Row_Rendering();

		// Common render codes for all row types
		// exp_cat_id

		$expensescategory->exp_cat_id->CellCssStyle = "white-space: nowrap;";

		// exp_cat_title
		$expensescategory->exp_cat_title->CellCssStyle = "white-space: nowrap;";
		if ($expensescategory->RowType == EW_ROWTYPE_VIEW) { // View row

			// exp_cat_title
			$expensescategory->exp_cat_title->ViewValue = $expensescategory->exp_cat_title->CurrentValue;
			$expensescategory->exp_cat_title->ViewCustomAttributes = "";

			// exp_cat_title
			$expensescategory->exp_cat_title->LinkCustomAttributes = "";
			$expensescategory->exp_cat_title->HrefValue = "";
			$expensescategory->exp_cat_title->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($expensescategory->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$expensescategory->Row_Rendered();
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $expensescategory;
		$DeleteRows = TRUE;
		$sSql = $expensescategory->SQL();
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
				$DeleteRows = $expensescategory->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['exp_cat_id'];
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $conn->Execute($expensescategory->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($expensescategory->CancelMessage <> "") {
				$this->setFailureMessage($expensescategory->CancelMessage);
				$expensescategory->CancelMessage = "";
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
				$expensescategory->Row_Deleted($row);
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
