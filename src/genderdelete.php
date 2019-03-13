<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "genderinfo.php" ?>
<?php include_once "administratorinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$gender_delete = new cgender_delete();
$Page =& $gender_delete;

// Page init
$gender_delete->Page_Init();

// Page main
$gender_delete->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var gender_delete = new ew_Page("gender_delete");

// page properties
gender_delete.PageID = "delete"; // page ID
gender_delete.FormID = "fgenderdelete"; // form ID
var EW_PAGE_ID = gender_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
gender_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
gender_delete.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
gender_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
gender_delete.ValidateRequired = false; // no JavaScript validation
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
if ($gender_delete->Recordset = $gender_delete->LoadRecordset())
	$gender_deleteTotalRecs = $gender_delete->Recordset->RecordCount(); // Get record count
if ($gender_deleteTotalRecs <= 0) { // No record found, exit
	if ($gender_delete->Recordset)
		$gender_delete->Recordset->Close();
	$gender_delete->Page_Terminate("genderlist.php"); // Return to list
}
?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $gender->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $gender->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $gender_delete->ShowPageHeader(); ?>
<?php
$gender_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="gender">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($gender_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(EW_COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($keyvalue) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $gender->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $gender->gender_id->FldCaption() ?></td>
		<td valign="top"><?php echo $gender->g_title->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$gender_delete->RecCnt = 0;
$i = 0;
while (!$gender_delete->Recordset->EOF) {
	$gender_delete->RecCnt++;

	// Set row properties
	$gender->ResetAttrs();
	$gender->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$gender_delete->LoadRowValues($gender_delete->Recordset);

	// Render row
	$gender_delete->RenderRow();
?>
	<tr<?php echo $gender->RowAttributes() ?>>
		<td<?php echo $gender->gender_id->CellAttributes() ?>>
<div<?php echo $gender->gender_id->ViewAttributes() ?>><?php echo $gender->gender_id->ListViewValue() ?></div></td>
		<td<?php echo $gender->g_title->CellAttributes() ?>>
<div<?php echo $gender->g_title->ViewAttributes() ?>><?php echo $gender->g_title->ListViewValue() ?></div></td>
	</tr>
<?php
	$gender_delete->Recordset->MoveNext();
}
$gender_delete->Recordset->Close();
?>
</tbody>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="Action" id="Action" value="<?php echo ew_BtnCaption($Language->Phrase("DeleteBtn")) ?>">
</form>
<?php
$gender_delete->ShowPageFooter();
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
$gender_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class cgender_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'gender';

	// Page object name
	var $PageObjName = 'gender_delete';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $gender;
		if ($gender->UseTokenInUrl) $PageUrl .= "t=" . $gender->TableVar . "&"; // Add page token
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
		global $objForm, $gender;
		if ($gender->UseTokenInUrl) {
			if ($objForm)
				return ($gender->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($gender->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cgender_delete() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (gender)
		if (!isset($GLOBALS["gender"])) {
			$GLOBALS["gender"] = new cgender();
			$GLOBALS["Table"] =& $GLOBALS["gender"];
		}

		// Table object (administrator)
		if (!isset($GLOBALS['administrator'])) $GLOBALS['administrator'] = new cadministrator();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'gender', TRUE);

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
		global $gender;

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
		global $Language, $gender;

		// Load key parameters
		$this->RecKeys = $gender->GetRecordKeys(); // Load record keys
		$sFilter = $gender->GetKeyFilter();
		if ($sFilter == "")
			$this->Page_Terminate("genderlist.php"); // Prevent SQL injection, return to list

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in gender class, genderinfo.php

		$gender->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$gender->CurrentAction = $_POST["a_delete"];
		} else {
			$gender->CurrentAction = "I"; // Display record
		}
		switch ($gender->CurrentAction) {
			case "D": // Delete
				$gender->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setSuccessMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($gender->getReturnUrl()); // Return to caller
				}
		}
	}

// No functions
	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $gender;

		// Call Recordset Selecting event
		$gender->Recordset_Selecting($gender->CurrentFilter);

		// Load List page SQL
		$sSql = $gender->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$gender->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $gender;
		$sFilter = $gender->KeyFilter();

		// Call Row Selecting event
		$gender->Row_Selecting($sFilter);

		// Load SQL based on filter
		$gender->CurrentFilter = $sFilter;
		$sSql = $gender->SQL();
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
		global $conn, $gender;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$gender->Row_Selected($row);
		$gender->gender_id->setDbValue($rs->fields('gender_id'));
		$gender->g_title->setDbValue($rs->fields('g_title'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $gender;

		// Initialize URLs
		// Call Row_Rendering event

		$gender->Row_Rendering();

		// Common render codes for all row types
		// gender_id
		// g_title

		if ($gender->RowType == EW_ROWTYPE_VIEW) { // View row

			// gender_id
			$gender->gender_id->ViewValue = $gender->gender_id->CurrentValue;
			$gender->gender_id->ViewCustomAttributes = "";

			// g_title
			$gender->g_title->ViewValue = $gender->g_title->CurrentValue;
			$gender->g_title->ViewCustomAttributes = "";

			// gender_id
			$gender->gender_id->LinkCustomAttributes = "";
			$gender->gender_id->HrefValue = "";
			$gender->gender_id->TooltipValue = "";

			// g_title
			$gender->g_title->LinkCustomAttributes = "";
			$gender->g_title->HrefValue = "";
			$gender->g_title->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($gender->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$gender->Row_Rendered();
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $gender;
		$DeleteRows = TRUE;
		$sSql = $gender->SQL();
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
				$DeleteRows = $gender->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['gender_id'];
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $conn->Execute($gender->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($gender->CancelMessage <> "") {
				$this->setFailureMessage($gender->CancelMessage);
				$gender->CancelMessage = "";
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
				$gender->Row_Deleted($row);
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
