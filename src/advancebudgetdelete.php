<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "advancebudgetinfo.php" ?>
<?php include_once "administratorinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$advancebudget_delete = new cadvancebudget_delete();
$Page =& $advancebudget_delete;

// Page init
$advancebudget_delete->Page_Init();

// Page main
$advancebudget_delete->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var advancebudget_delete = new ew_Page("advancebudget_delete");

// page properties
advancebudget_delete.PageID = "delete"; // page ID
advancebudget_delete.FormID = "fadvancebudgetdelete"; // form ID
var EW_PAGE_ID = advancebudget_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
advancebudget_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
advancebudget_delete.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
advancebudget_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
advancebudget_delete.ValidateRequired = false; // no JavaScript validation
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
if ($advancebudget_delete->Recordset = $advancebudget_delete->LoadRecordset())
	$advancebudget_deleteTotalRecs = $advancebudget_delete->Recordset->RecordCount(); // Get record count
if ($advancebudget_deleteTotalRecs <= 0) { // No record found, exit
	if ($advancebudget_delete->Recordset)
		$advancebudget_delete->Recordset->Close();
	$advancebudget_delete->Page_Terminate("advancebudgetlist.php"); // Return to list
}
?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $advancebudget->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $advancebudget->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $advancebudget_delete->ShowPageHeader(); ?>
<?php
$advancebudget_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="advancebudget">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($advancebudget_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(EW_COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($keyvalue) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $advancebudget->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $advancebudget->adv_id->FldCaption() ?></td>
		<td valign="top"><?php echo $advancebudget->member_id->FldCaption() ?></td>
		<td valign="top"><?php echo $advancebudget->death_count->FldCaption() ?></td>
		<td valign="top"><?php echo $advancebudget->adv_total->FldCaption() ?></td>
		<td valign="top"><?php echo $advancebudget->adb_detail->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$advancebudget_delete->RecCnt = 0;
$i = 0;
while (!$advancebudget_delete->Recordset->EOF) {
	$advancebudget_delete->RecCnt++;

	// Set row properties
	$advancebudget->ResetAttrs();
	$advancebudget->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$advancebudget_delete->LoadRowValues($advancebudget_delete->Recordset);

	// Render row
	$advancebudget_delete->RenderRow();
?>
	<tr<?php echo $advancebudget->RowAttributes() ?>>
		<td<?php echo $advancebudget->adv_id->CellAttributes() ?>>
<div<?php echo $advancebudget->adv_id->ViewAttributes() ?>><?php echo $advancebudget->adv_id->ListViewValue() ?></div></td>
		<td<?php echo $advancebudget->member_id->CellAttributes() ?>>
<div<?php echo $advancebudget->member_id->ViewAttributes() ?>><?php echo $advancebudget->member_id->ListViewValue() ?></div></td>
		<td<?php echo $advancebudget->death_count->CellAttributes() ?>>
<div<?php echo $advancebudget->death_count->ViewAttributes() ?>><?php echo $advancebudget->death_count->ListViewValue() ?></div></td>
		<td<?php echo $advancebudget->adv_total->CellAttributes() ?>>
<div<?php echo $advancebudget->adv_total->ViewAttributes() ?>><?php echo $advancebudget->adv_total->ListViewValue() ?></div></td>
		<td<?php echo $advancebudget->adb_detail->CellAttributes() ?>>
<div<?php echo $advancebudget->adb_detail->ViewAttributes() ?>><?php echo $advancebudget->adb_detail->ListViewValue() ?></div></td>
	</tr>
<?php
	$advancebudget_delete->Recordset->MoveNext();
}
$advancebudget_delete->Recordset->Close();
?>
</tbody>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="Action" id="Action" value="<?php echo ew_BtnCaption($Language->Phrase("DeleteBtn")) ?>">
</form>
<?php
$advancebudget_delete->ShowPageFooter();
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
$advancebudget_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class cadvancebudget_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'advancebudget';

	// Page object name
	var $PageObjName = 'advancebudget_delete';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $advancebudget;
		if ($advancebudget->UseTokenInUrl) $PageUrl .= "t=" . $advancebudget->TableVar . "&"; // Add page token
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
		global $objForm, $advancebudget;
		if ($advancebudget->UseTokenInUrl) {
			if ($objForm)
				return ($advancebudget->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($advancebudget->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cadvancebudget_delete() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (advancebudget)
		if (!isset($GLOBALS["advancebudget"])) {
			$GLOBALS["advancebudget"] = new cadvancebudget();
			$GLOBALS["Table"] =& $GLOBALS["advancebudget"];
		}

		// Table object (administrator)
		if (!isset($GLOBALS['administrator'])) $GLOBALS['administrator'] = new cadministrator();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'advancebudget', TRUE);

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
		global $advancebudget;

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
		global $Language, $advancebudget;

		// Load key parameters
		$this->RecKeys = $advancebudget->GetRecordKeys(); // Load record keys
		$sFilter = $advancebudget->GetKeyFilter();
		if ($sFilter == "")
			$this->Page_Terminate("advancebudgetlist.php"); // Prevent SQL injection, return to list

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in advancebudget class, advancebudgetinfo.php

		$advancebudget->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$advancebudget->CurrentAction = $_POST["a_delete"];
		} else {
			$advancebudget->CurrentAction = "I"; // Display record
		}
		switch ($advancebudget->CurrentAction) {
			case "D": // Delete
				$advancebudget->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setSuccessMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($advancebudget->getReturnUrl()); // Return to caller
				}
		}
	}

// No functions
	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $advancebudget;

		// Call Recordset Selecting event
		$advancebudget->Recordset_Selecting($advancebudget->CurrentFilter);

		// Load List page SQL
		$sSql = $advancebudget->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$advancebudget->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $advancebudget;
		$sFilter = $advancebudget->KeyFilter();

		// Call Row Selecting event
		$advancebudget->Row_Selecting($sFilter);

		// Load SQL based on filter
		$advancebudget->CurrentFilter = $sFilter;
		$sSql = $advancebudget->SQL();
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
		global $conn, $advancebudget;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$advancebudget->Row_Selected($row);
		$advancebudget->adv_id->setDbValue($rs->fields('adv_id'));
		$advancebudget->member_id->setDbValue($rs->fields('member_id'));
		$advancebudget->death_count->setDbValue($rs->fields('death_count'));
		$advancebudget->adv_total->setDbValue($rs->fields('adv_total'));
		$advancebudget->adb_detail->setDbValue($rs->fields('adb_detail'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $advancebudget;

		// Initialize URLs
		// Call Row_Rendering event

		$advancebudget->Row_Rendering();

		// Common render codes for all row types
		// adv_id
		// member_id
		// death_count
		// adv_total
		// adb_detail

		if ($advancebudget->RowType == EW_ROWTYPE_VIEW) { // View row

			// adv_id
			$advancebudget->adv_id->ViewValue = $advancebudget->adv_id->CurrentValue;
			$advancebudget->adv_id->ViewCustomAttributes = "";

			// member_id
			$advancebudget->member_id->ViewValue = $advancebudget->member_id->CurrentValue;
			$advancebudget->member_id->ViewCustomAttributes = "";

			// death_count
			$advancebudget->death_count->ViewValue = $advancebudget->death_count->CurrentValue;
			$advancebudget->death_count->ViewCustomAttributes = "";

			// adv_total
			$advancebudget->adv_total->ViewValue = $advancebudget->adv_total->CurrentValue;
			$advancebudget->adv_total->ViewCustomAttributes = "";

			// adb_detail
			$advancebudget->adb_detail->ViewValue = $advancebudget->adb_detail->CurrentValue;
			$advancebudget->adb_detail->ViewCustomAttributes = "";

			// adv_id
			$advancebudget->adv_id->LinkCustomAttributes = "";
			$advancebudget->adv_id->HrefValue = "";
			$advancebudget->adv_id->TooltipValue = "";

			// member_id
			$advancebudget->member_id->LinkCustomAttributes = "";
			$advancebudget->member_id->HrefValue = "";
			$advancebudget->member_id->TooltipValue = "";

			// death_count
			$advancebudget->death_count->LinkCustomAttributes = "";
			$advancebudget->death_count->HrefValue = "";
			$advancebudget->death_count->TooltipValue = "";

			// adv_total
			$advancebudget->adv_total->LinkCustomAttributes = "";
			$advancebudget->adv_total->HrefValue = "";
			$advancebudget->adv_total->TooltipValue = "";

			// adb_detail
			$advancebudget->adb_detail->LinkCustomAttributes = "";
			$advancebudget->adb_detail->HrefValue = "";
			$advancebudget->adb_detail->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($advancebudget->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$advancebudget->Row_Rendered();
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $advancebudget;
		$DeleteRows = TRUE;
		$sSql = $advancebudget->SQL();
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
				$DeleteRows = $advancebudget->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['adv_id'];
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $conn->Execute($advancebudget->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($advancebudget->CancelMessage <> "") {
				$this->setFailureMessage($advancebudget->CancelMessage);
				$advancebudget->CancelMessage = "";
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
				$advancebudget->Row_Deleted($row);
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
