<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "deathmemberinfo.php" ?>
<?php include_once "administratorinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$deathmember_delete = new cdeathmember_delete();
$Page =& $deathmember_delete;

// Page init
$deathmember_delete->Page_Init();

// Page main
$deathmember_delete->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var deathmember_delete = new ew_Page("deathmember_delete");

// page properties
deathmember_delete.PageID = "delete"; // page ID
deathmember_delete.FormID = "fdeathmemberdelete"; // form ID
var EW_PAGE_ID = deathmember_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
deathmember_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
deathmember_delete.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
deathmember_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
deathmember_delete.ValidateRequired = false; // no JavaScript validation
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
if ($deathmember_delete->Recordset = $deathmember_delete->LoadRecordset())
	$deathmember_deleteTotalRecs = $deathmember_delete->Recordset->RecordCount(); // Get record count
if ($deathmember_deleteTotalRecs <= 0) { // No record found, exit
	if ($deathmember_delete->Recordset)
		$deathmember_delete->Recordset->Close();
	$deathmember_delete->Page_Terminate("deathmemberlist.php"); // Return to list
}
?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $deathmember->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $deathmember->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $deathmember_delete->ShowPageHeader(); ?>
<?php
$deathmember_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="deathmember">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($deathmember_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(EW_COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($keyvalue) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $deathmember->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $deathmember->death_id->FldCaption() ?></td>
		<td valign="top"><?php echo $deathmember->member_id->FldCaption() ?></td>
		<td valign="top"><?php echo $deathmember->dead_date->FldCaption() ?></td>
		<td valign="top"><?php echo $deathmember->dead_detail->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$deathmember_delete->RecCnt = 0;
$i = 0;
while (!$deathmember_delete->Recordset->EOF) {
	$deathmember_delete->RecCnt++;

	// Set row properties
	$deathmember->ResetAttrs();
	$deathmember->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$deathmember_delete->LoadRowValues($deathmember_delete->Recordset);

	// Render row
	$deathmember_delete->RenderRow();
?>
	<tr<?php echo $deathmember->RowAttributes() ?>>
		<td<?php echo $deathmember->death_id->CellAttributes() ?>>
<div<?php echo $deathmember->death_id->ViewAttributes() ?>><?php echo $deathmember->death_id->ListViewValue() ?></div></td>
		<td<?php echo $deathmember->member_id->CellAttributes() ?>>
<div<?php echo $deathmember->member_id->ViewAttributes() ?>><?php echo $deathmember->member_id->ListViewValue() ?></div></td>
		<td<?php echo $deathmember->dead_date->CellAttributes() ?>>
<div<?php echo $deathmember->dead_date->ViewAttributes() ?>><?php echo $deathmember->dead_date->ListViewValue() ?></div></td>
		<td<?php echo $deathmember->dead_detail->CellAttributes() ?>>
<div<?php echo $deathmember->dead_detail->ViewAttributes() ?>><?php echo $deathmember->dead_detail->ListViewValue() ?></div></td>
	</tr>
<?php
	$deathmember_delete->Recordset->MoveNext();
}
$deathmember_delete->Recordset->Close();
?>
</tbody>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="Action" id="Action" value="<?php echo ew_BtnCaption($Language->Phrase("DeleteBtn")) ?>">
</form>
<?php
$deathmember_delete->ShowPageFooter();
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
$deathmember_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class cdeathmember_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'deathmember';

	// Page object name
	var $PageObjName = 'deathmember_delete';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $deathmember;
		if ($deathmember->UseTokenInUrl) $PageUrl .= "t=" . $deathmember->TableVar . "&"; // Add page token
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
		global $objForm, $deathmember;
		if ($deathmember->UseTokenInUrl) {
			if ($objForm)
				return ($deathmember->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($deathmember->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cdeathmember_delete() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (deathmember)
		if (!isset($GLOBALS["deathmember"])) {
			$GLOBALS["deathmember"] = new cdeathmember();
			$GLOBALS["Table"] =& $GLOBALS["deathmember"];
		}

		// Table object (administrator)
		if (!isset($GLOBALS['administrator'])) $GLOBALS['administrator'] = new cadministrator();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'deathmember', TRUE);

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
		global $deathmember;

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
		global $Language, $deathmember;

		// Load key parameters
		$this->RecKeys = $deathmember->GetRecordKeys(); // Load record keys
		$sFilter = $deathmember->GetKeyFilter();
		if ($sFilter == "")
			$this->Page_Terminate("deathmemberlist.php"); // Prevent SQL injection, return to list

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in deathmember class, deathmemberinfo.php

		$deathmember->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$deathmember->CurrentAction = $_POST["a_delete"];
		} else {
			$deathmember->CurrentAction = "I"; // Display record
		}
		switch ($deathmember->CurrentAction) {
			case "D": // Delete
				$deathmember->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setSuccessMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($deathmember->getReturnUrl()); // Return to caller
				}
		}
	}

// No functions
	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $deathmember;

		// Call Recordset Selecting event
		$deathmember->Recordset_Selecting($deathmember->CurrentFilter);

		// Load List page SQL
		$sSql = $deathmember->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$deathmember->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $deathmember;
		$sFilter = $deathmember->KeyFilter();

		// Call Row Selecting event
		$deathmember->Row_Selecting($sFilter);

		// Load SQL based on filter
		$deathmember->CurrentFilter = $sFilter;
		$sSql = $deathmember->SQL();
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
		global $conn, $deathmember;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$deathmember->Row_Selected($row);
		$deathmember->death_id->setDbValue($rs->fields('death_id'));
		$deathmember->member_id->setDbValue($rs->fields('member_id'));
		$deathmember->dead_date->setDbValue($rs->fields('dead_date'));
		$deathmember->dead_detail->setDbValue($rs->fields('dead_detail'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $deathmember;

		// Initialize URLs
		// Call Row_Rendering event

		$deathmember->Row_Rendering();

		// Common render codes for all row types
		// death_id
		// member_id
		// dead_date
		// dead_detail

		if ($deathmember->RowType == EW_ROWTYPE_VIEW) { // View row

			// death_id
			$deathmember->death_id->ViewValue = $deathmember->death_id->CurrentValue;
			$deathmember->death_id->ViewCustomAttributes = "";

			// member_id
			$deathmember->member_id->ViewValue = $deathmember->member_id->CurrentValue;
			$deathmember->member_id->ViewCustomAttributes = "";

			// dead_date
			$deathmember->dead_date->ViewValue = $deathmember->dead_date->CurrentValue;
			$deathmember->dead_date->ViewValue = ew_FormatDateTime($deathmember->dead_date->ViewValue, 7);
			$deathmember->dead_date->ViewCustomAttributes = "";

			// dead_detail
			$deathmember->dead_detail->ViewValue = $deathmember->dead_detail->CurrentValue;
			$deathmember->dead_detail->ViewCustomAttributes = "";

			// death_id
			$deathmember->death_id->LinkCustomAttributes = "";
			$deathmember->death_id->HrefValue = "";
			$deathmember->death_id->TooltipValue = "";

			// member_id
			$deathmember->member_id->LinkCustomAttributes = "";
			$deathmember->member_id->HrefValue = "";
			$deathmember->member_id->TooltipValue = "";

			// dead_date
			$deathmember->dead_date->LinkCustomAttributes = "";
			$deathmember->dead_date->HrefValue = "";
			$deathmember->dead_date->TooltipValue = "";

			// dead_detail
			$deathmember->dead_detail->LinkCustomAttributes = "";
			$deathmember->dead_detail->HrefValue = "";
			$deathmember->dead_detail->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($deathmember->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$deathmember->Row_Rendered();
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $deathmember;
		$DeleteRows = TRUE;
		$sSql = $deathmember->SQL();
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
				$DeleteRows = $deathmember->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['death_id'];
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $conn->Execute($deathmember->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($deathmember->CancelMessage <> "") {
				$this->setFailureMessage($deathmember->CancelMessage);
				$deathmember->CancelMessage = "";
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
				$deathmember->Row_Deleted($row);
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
