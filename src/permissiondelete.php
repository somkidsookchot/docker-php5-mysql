<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "permissioninfo.php" ?>
<?php include_once "administratorinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$permission_delete = new cpermission_delete();
$Page =& $permission_delete;

// Page init
$permission_delete->Page_Init();

// Page main
$permission_delete->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var permission_delete = new ew_Page("permission_delete");

// page properties
permission_delete.PageID = "delete"; // page ID
permission_delete.FormID = "fpermissiondelete"; // form ID
var EW_PAGE_ID = permission_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
permission_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
permission_delete.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
permission_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
permission_delete.ValidateRequired = false; // no JavaScript validation
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
if ($permission_delete->Recordset = $permission_delete->LoadRecordset())
	$permission_deleteTotalRecs = $permission_delete->Recordset->RecordCount(); // Get record count
if ($permission_deleteTotalRecs <= 0) { // No record found, exit
	if ($permission_delete->Recordset)
		$permission_delete->Recordset->Close();
	$permission_delete->Page_Terminate("permissionlist.php"); // Return to list
}
?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $permission->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $permission->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $permission_delete->ShowPageHeader(); ?>
<?php
$permission_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="permission">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($permission_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(EW_COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($keyvalue) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $permission->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $permission->permission_id->FldCaption() ?></td>
		<td valign="top"><?php echo $permission->member_id->FldCaption() ?></td>
		<td valign="top"><?php echo $permission->admin->FldCaption() ?></td>
		<td valign="top"><?php echo $permission->zupload->FldCaption() ?></td>
		<td valign="top"><?php echo $permission->download->FldCaption() ?></td>
		<td valign="top"><?php echo $permission->readonly->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$permission_delete->RecCnt = 0;
$i = 0;
while (!$permission_delete->Recordset->EOF) {
	$permission_delete->RecCnt++;

	// Set row properties
	$permission->ResetAttrs();
	$permission->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$permission_delete->LoadRowValues($permission_delete->Recordset);

	// Render row
	$permission_delete->RenderRow();
?>
	<tr<?php echo $permission->RowAttributes() ?>>
		<td<?php echo $permission->permission_id->CellAttributes() ?>>
<div<?php echo $permission->permission_id->ViewAttributes() ?>><?php echo $permission->permission_id->ListViewValue() ?></div></td>
		<td<?php echo $permission->member_id->CellAttributes() ?>>
<div<?php echo $permission->member_id->ViewAttributes() ?>><?php echo $permission->member_id->ListViewValue() ?></div></td>
		<td<?php echo $permission->admin->CellAttributes() ?>>
<div<?php echo $permission->admin->ViewAttributes() ?>><?php echo $permission->admin->ListViewValue() ?></div></td>
		<td<?php echo $permission->zupload->CellAttributes() ?>>
<div<?php echo $permission->zupload->ViewAttributes() ?>><?php echo $permission->zupload->ListViewValue() ?></div></td>
		<td<?php echo $permission->download->CellAttributes() ?>>
<div<?php echo $permission->download->ViewAttributes() ?>><?php echo $permission->download->ListViewValue() ?></div></td>
		<td<?php echo $permission->readonly->CellAttributes() ?>>
<div<?php echo $permission->readonly->ViewAttributes() ?>><?php echo $permission->readonly->ListViewValue() ?></div></td>
	</tr>
<?php
	$permission_delete->Recordset->MoveNext();
}
$permission_delete->Recordset->Close();
?>
</tbody>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="Action" id="Action" value="<?php echo ew_BtnCaption($Language->Phrase("DeleteBtn")) ?>">
</form>
<?php
$permission_delete->ShowPageFooter();
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
$permission_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class cpermission_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'permission';

	// Page object name
	var $PageObjName = 'permission_delete';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $permission;
		if ($permission->UseTokenInUrl) $PageUrl .= "t=" . $permission->TableVar . "&"; // Add page token
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
		global $objForm, $permission;
		if ($permission->UseTokenInUrl) {
			if ($objForm)
				return ($permission->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($permission->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cpermission_delete() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (permission)
		if (!isset($GLOBALS["permission"])) {
			$GLOBALS["permission"] = new cpermission();
			$GLOBALS["Table"] =& $GLOBALS["permission"];
		}

		// Table object (administrator)
		if (!isset($GLOBALS['administrator'])) $GLOBALS['administrator'] = new cadministrator();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'permission', TRUE);

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
		global $permission;

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
		global $Language, $permission;

		// Load key parameters
		$this->RecKeys = $permission->GetRecordKeys(); // Load record keys
		$sFilter = $permission->GetKeyFilter();
		if ($sFilter == "")
			$this->Page_Terminate("permissionlist.php"); // Prevent SQL injection, return to list

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in permission class, permissioninfo.php

		$permission->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$permission->CurrentAction = $_POST["a_delete"];
		} else {
			$permission->CurrentAction = "I"; // Display record
		}
		switch ($permission->CurrentAction) {
			case "D": // Delete
				$permission->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setSuccessMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($permission->getReturnUrl()); // Return to caller
				}
		}
	}

// No functions
	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $permission;

		// Call Recordset Selecting event
		$permission->Recordset_Selecting($permission->CurrentFilter);

		// Load List page SQL
		$sSql = $permission->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$permission->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $permission;
		$sFilter = $permission->KeyFilter();

		// Call Row Selecting event
		$permission->Row_Selecting($sFilter);

		// Load SQL based on filter
		$permission->CurrentFilter = $sFilter;
		$sSql = $permission->SQL();
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
		global $conn, $permission;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$permission->Row_Selected($row);
		$permission->permission_id->setDbValue($rs->fields('permission_id'));
		$permission->member_id->setDbValue($rs->fields('member_id'));
		$permission->admin->setDbValue($rs->fields('admin'));
		$permission->zupload->setDbValue($rs->fields('upload'));
		$permission->download->setDbValue($rs->fields('download'));
		$permission->readonly->setDbValue($rs->fields('readonly'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $permission;

		// Initialize URLs
		// Call Row_Rendering event

		$permission->Row_Rendering();

		// Common render codes for all row types
		// permission_id
		// member_id
		// admin
		// upload
		// download
		// readonly

		if ($permission->RowType == EW_ROWTYPE_VIEW) { // View row

			// permission_id
			$permission->permission_id->ViewValue = $permission->permission_id->CurrentValue;
			$permission->permission_id->ViewCustomAttributes = "";

			// member_id
			$permission->member_id->ViewValue = $permission->member_id->CurrentValue;
			$permission->member_id->ViewCustomAttributes = "";

			// admin
			$permission->admin->ViewValue = $permission->admin->CurrentValue;
			$permission->admin->ViewCustomAttributes = "";

			// upload
			$permission->zupload->ViewValue = $permission->zupload->CurrentValue;
			$permission->zupload->ViewCustomAttributes = "";

			// download
			$permission->download->ViewValue = $permission->download->CurrentValue;
			$permission->download->ViewCustomAttributes = "";

			// readonly
			$permission->readonly->ViewValue = $permission->readonly->CurrentValue;
			$permission->readonly->ViewCustomAttributes = "";

			// permission_id
			$permission->permission_id->LinkCustomAttributes = "";
			$permission->permission_id->HrefValue = "";
			$permission->permission_id->TooltipValue = "";

			// member_id
			$permission->member_id->LinkCustomAttributes = "";
			$permission->member_id->HrefValue = "";
			$permission->member_id->TooltipValue = "";

			// admin
			$permission->admin->LinkCustomAttributes = "";
			$permission->admin->HrefValue = "";
			$permission->admin->TooltipValue = "";

			// upload
			$permission->zupload->LinkCustomAttributes = "";
			$permission->zupload->HrefValue = "";
			$permission->zupload->TooltipValue = "";

			// download
			$permission->download->LinkCustomAttributes = "";
			$permission->download->HrefValue = "";
			$permission->download->TooltipValue = "";

			// readonly
			$permission->readonly->LinkCustomAttributes = "";
			$permission->readonly->HrefValue = "";
			$permission->readonly->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($permission->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$permission->Row_Rendered();
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $permission;
		$DeleteRows = TRUE;
		$sSql = $permission->SQL();
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
				$DeleteRows = $permission->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['permission_id'];
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['member_id'];
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $conn->Execute($permission->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($permission->CancelMessage <> "") {
				$this->setFailureMessage($permission->CancelMessage);
				$permission->CancelMessage = "";
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
				$permission->Row_Deleted($row);
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
