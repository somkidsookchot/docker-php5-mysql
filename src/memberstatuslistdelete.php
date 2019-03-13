<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "memberstatuslistinfo.php" ?>
<?php include_once "administratorinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$memberstatuslist_delete = new cmemberstatuslist_delete();
$Page =& $memberstatuslist_delete;

// Page init
$memberstatuslist_delete->Page_Init();

// Page main
$memberstatuslist_delete->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var memberstatuslist_delete = new ew_Page("memberstatuslist_delete");

// page properties
memberstatuslist_delete.PageID = "delete"; // page ID
memberstatuslist_delete.FormID = "fmemberstatuslistdelete"; // form ID
var EW_PAGE_ID = memberstatuslist_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
memberstatuslist_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
memberstatuslist_delete.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
memberstatuslist_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
memberstatuslist_delete.ValidateRequired = false; // no JavaScript validation
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
if ($memberstatuslist_delete->Recordset = $memberstatuslist_delete->LoadRecordset())
	$memberstatuslist_deleteTotalRecs = $memberstatuslist_delete->Recordset->RecordCount(); // Get record count
if ($memberstatuslist_deleteTotalRecs <= 0) { // No record found, exit
	if ($memberstatuslist_delete->Recordset)
		$memberstatuslist_delete->Recordset->Close();
	$memberstatuslist_delete->Page_Terminate("memberstatuslistlist.php"); // Return to list
}
?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $memberstatuslist->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $memberstatuslist->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $memberstatuslist_delete->ShowPageHeader(); ?>
<?php
$memberstatuslist_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="memberstatuslist">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($memberstatuslist_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(EW_COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($keyvalue) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $memberstatuslist->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $memberstatuslist->member_id->FldCaption() ?></td>
		<td valign="top"><?php echo $memberstatuslist->status->FldCaption() ?></td>
		<td valign="top"><?php echo $memberstatuslist->mbs_date->FldCaption() ?></td>
		<td valign="top"><?php echo $memberstatuslist->mbs_detail->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$memberstatuslist_delete->RecCnt = 0;
$i = 0;
while (!$memberstatuslist_delete->Recordset->EOF) {
	$memberstatuslist_delete->RecCnt++;

	// Set row properties
	$memberstatuslist->ResetAttrs();
	$memberstatuslist->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$memberstatuslist_delete->LoadRowValues($memberstatuslist_delete->Recordset);

	// Render row
	$memberstatuslist_delete->RenderRow();
?>
	<tr<?php echo $memberstatuslist->RowAttributes() ?>>
		<td<?php echo $memberstatuslist->member_id->CellAttributes() ?>>
<div<?php echo $memberstatuslist->member_id->ViewAttributes() ?>><?php echo $memberstatuslist->member_id->ListViewValue() ?></div></td>
		<td<?php echo $memberstatuslist->status->CellAttributes() ?>>
<div<?php echo $memberstatuslist->status->ViewAttributes() ?>><?php echo $memberstatuslist->status->ListViewValue() ?></div></td>
		<td<?php echo $memberstatuslist->mbs_date->CellAttributes() ?>>
<div<?php echo $memberstatuslist->mbs_date->ViewAttributes() ?>><?php echo $memberstatuslist->mbs_date->ListViewValue() ?></div></td>
		<td<?php echo $memberstatuslist->mbs_detail->CellAttributes() ?>>
<div<?php echo $memberstatuslist->mbs_detail->ViewAttributes() ?>><?php echo $memberstatuslist->mbs_detail->ListViewValue() ?></div></td>
	</tr>
<?php
	$memberstatuslist_delete->Recordset->MoveNext();
}
$memberstatuslist_delete->Recordset->Close();
?>
</tbody>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="Action" id="Action" value="<?php echo ew_BtnCaption($Language->Phrase("DeleteBtn")) ?>">
</form>
<?php
$memberstatuslist_delete->ShowPageFooter();
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
$memberstatuslist_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class cmemberstatuslist_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'memberstatuslist';

	// Page object name
	var $PageObjName = 'memberstatuslist_delete';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $memberstatuslist;
		if ($memberstatuslist->UseTokenInUrl) $PageUrl .= "t=" . $memberstatuslist->TableVar . "&"; // Add page token
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
		global $objForm, $memberstatuslist;
		if ($memberstatuslist->UseTokenInUrl) {
			if ($objForm)
				return ($memberstatuslist->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($memberstatuslist->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cmemberstatuslist_delete() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (memberstatuslist)
		if (!isset($GLOBALS["memberstatuslist"])) {
			$GLOBALS["memberstatuslist"] = new cmemberstatuslist();
			$GLOBALS["Table"] =& $GLOBALS["memberstatuslist"];
		}

		// Table object (administrator)
		if (!isset($GLOBALS['administrator'])) $GLOBALS['administrator'] = new cadministrator();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'memberstatuslist', TRUE);

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
		global $memberstatuslist;

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
		global $Language, $memberstatuslist;

		// Load key parameters
		$this->RecKeys = $memberstatuslist->GetRecordKeys(); // Load record keys
		$sFilter = $memberstatuslist->GetKeyFilter();
		if ($sFilter == "")
			$this->Page_Terminate("memberstatuslistlist.php"); // Prevent SQL injection, return to list

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in memberstatuslist class, memberstatuslistinfo.php

		$memberstatuslist->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$memberstatuslist->CurrentAction = $_POST["a_delete"];
		} else {
			$memberstatuslist->CurrentAction = "I"; // Display record
		}
		switch ($memberstatuslist->CurrentAction) {
			case "D": // Delete
				$memberstatuslist->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setSuccessMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($memberstatuslist->getReturnUrl()); // Return to caller
				}
		}
	}

// No functions
	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $memberstatuslist;

		// Call Recordset Selecting event
		$memberstatuslist->Recordset_Selecting($memberstatuslist->CurrentFilter);

		// Load List page SQL
		$sSql = $memberstatuslist->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$memberstatuslist->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $memberstatuslist;
		$sFilter = $memberstatuslist->KeyFilter();

		// Call Row Selecting event
		$memberstatuslist->Row_Selecting($sFilter);

		// Load SQL based on filter
		$memberstatuslist->CurrentFilter = $sFilter;
		$sSql = $memberstatuslist->SQL();
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
		global $conn, $memberstatuslist;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$memberstatuslist->Row_Selected($row);
		$memberstatuslist->mbs_id->setDbValue($rs->fields('mbs_id'));
		$memberstatuslist->member_id->setDbValue($rs->fields('member_id'));
		$memberstatuslist->status->setDbValue($rs->fields('status'));
		$memberstatuslist->mbs_date->setDbValue($rs->fields('mbs_date'));
		$memberstatuslist->mbs_detail->setDbValue($rs->fields('mbs_detail'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $memberstatuslist;

		// Initialize URLs
		// Call Row_Rendering event

		$memberstatuslist->Row_Rendering();

		// Common render codes for all row types
		// mbs_id
		// member_id
		// status
		// mbs_date
		// mbs_detail

		if ($memberstatuslist->RowType == EW_ROWTYPE_VIEW) { // View row

			// mbs_id
			$memberstatuslist->mbs_id->ViewValue = $memberstatuslist->mbs_id->CurrentValue;
			$memberstatuslist->mbs_id->ViewCustomAttributes = "";

			// member_id
			$memberstatuslist->member_id->ViewValue = $memberstatuslist->member_id->CurrentValue;
			$memberstatuslist->member_id->ViewCustomAttributes = "";

			// status
			if (strval($memberstatuslist->status->CurrentValue) <> "") {
				$sFilterWrk = "`s_title` = '" . ew_AdjustSql($memberstatuslist->status->CurrentValue) . "'";
			$sSqlWrk = "SELECT `s_title` FROM `memberstatus`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$memberstatuslist->status->ViewValue = $rswrk->fields('s_title');
					$rswrk->Close();
				} else {
					$memberstatuslist->status->ViewValue = $memberstatuslist->status->CurrentValue;
				}
			} else {
				$memberstatuslist->status->ViewValue = NULL;
			}
			$memberstatuslist->status->ViewCustomAttributes = "";

			// mbs_date
			$memberstatuslist->mbs_date->ViewValue = $memberstatuslist->mbs_date->CurrentValue;
			$memberstatuslist->mbs_date->ViewValue = ew_FormatDateTime($memberstatuslist->mbs_date->ViewValue, 7);
			$memberstatuslist->mbs_date->ViewCustomAttributes = "";

			// mbs_detail
			$memberstatuslist->mbs_detail->ViewValue = $memberstatuslist->mbs_detail->CurrentValue;
			$memberstatuslist->mbs_detail->ViewCustomAttributes = "";

			// member_id
			$memberstatuslist->member_id->LinkCustomAttributes = "";
			$memberstatuslist->member_id->HrefValue = "";
			$memberstatuslist->member_id->TooltipValue = "";

			// status
			$memberstatuslist->status->LinkCustomAttributes = "";
			$memberstatuslist->status->HrefValue = "";
			$memberstatuslist->status->TooltipValue = "";

			// mbs_date
			$memberstatuslist->mbs_date->LinkCustomAttributes = "";
			$memberstatuslist->mbs_date->HrefValue = "";
			$memberstatuslist->mbs_date->TooltipValue = "";

			// mbs_detail
			$memberstatuslist->mbs_detail->LinkCustomAttributes = "";
			$memberstatuslist->mbs_detail->HrefValue = "";
			$memberstatuslist->mbs_detail->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($memberstatuslist->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$memberstatuslist->Row_Rendered();
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $memberstatuslist;
		$DeleteRows = TRUE;
		$sSql = $memberstatuslist->SQL();
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
				$DeleteRows = $memberstatuslist->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['mbs_id'];
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $conn->Execute($memberstatuslist->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($memberstatuslist->CancelMessage <> "") {
				$this->setFailureMessage($memberstatuslist->CancelMessage);
				$memberstatuslist->CancelMessage = "";
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
				$memberstatuslist->Row_Deleted($row);
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
