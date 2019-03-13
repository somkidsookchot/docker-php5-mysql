<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "expenseslistinfo.php" ?>
<?php include_once "administratorinfo.php" ?>
<?php include_once "expensescategoryinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$expenseslist_delete = new cexpenseslist_delete();
$Page =& $expenseslist_delete;

// Page init
$expenseslist_delete->Page_Init();

// Page main
$expenseslist_delete->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var expenseslist_delete = new ew_Page("expenseslist_delete");

// page properties
expenseslist_delete.PageID = "delete"; // page ID
expenseslist_delete.FormID = "fexpenseslistdelete"; // form ID
var EW_PAGE_ID = expenseslist_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
expenseslist_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
expenseslist_delete.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
expenseslist_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
expenseslist_delete.ValidateRequired = false; // no JavaScript validation
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
if ($expenseslist_delete->Recordset = $expenseslist_delete->LoadRecordset())
	$expenseslist_deleteTotalRecs = $expenseslist_delete->Recordset->RecordCount(); // Get record count
if ($expenseslist_deleteTotalRecs <= 0) { // No record found, exit
	if ($expenseslist_delete->Recordset)
		$expenseslist_delete->Recordset->Close();
	$expenseslist_delete->Page_Terminate("expenseslistlist.php"); // Return to list
}
?>
<div class="phpmaker ewTitle"><img src="images/ico_delete_finace.png" width="40" height="40" align="absmiddle" />&nbsp;<?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $expenseslist->TableCaption() ?></div>
<div class="clear"></div>

<?php $expenseslist_delete->ShowPageHeader(); ?>
<?php
$expenseslist_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="expenseslist">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($expenseslist_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(EW_COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($keyvalue) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $expenseslist->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $expenseslist->exp_cat->FldCaption() ?></td>
		<td valign="top"><?php echo $expenseslist->exp_total->FldCaption() ?></td>
		<td valign="top"><?php echo $expenseslist->exp_date->FldCaption() ?></td>
		<td valign="top"><?php echo $expenseslist->exp_dispencer->FldCaption() ?></td>
		<td valign="top"><?php echo $expenseslist->exp_slipt_num->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$expenseslist_delete->RecCnt = 0;
$i = 0;
while (!$expenseslist_delete->Recordset->EOF) {
	$expenseslist_delete->RecCnt++;

	// Set row properties
	$expenseslist->ResetAttrs();
	$expenseslist->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$expenseslist_delete->LoadRowValues($expenseslist_delete->Recordset);

	// Render row
	$expenseslist_delete->RenderRow();
?>
	<tr<?php echo $expenseslist->RowAttributes() ?>>
		<td<?php echo $expenseslist->exp_cat->CellAttributes() ?>>
<div<?php echo $expenseslist->exp_cat->ViewAttributes() ?>><?php echo $expenseslist->exp_cat->ListViewValue() ?></div></td>
		<td<?php echo $expenseslist->exp_total->CellAttributes() ?>>
<div<?php echo $expenseslist->exp_total->ViewAttributes() ?>><?php echo $expenseslist->exp_total->ListViewValue() ?></div></td>
		<td<?php echo $expenseslist->exp_date->CellAttributes() ?>>
<div<?php echo $expenseslist->exp_date->ViewAttributes() ?>><?php echo $expenseslist->exp_date->ListViewValue() ?></div></td>
		<td<?php echo $expenseslist->exp_dispencer->CellAttributes() ?>>
<div<?php echo $expenseslist->exp_dispencer->ViewAttributes() ?>><?php echo $expenseslist->exp_dispencer->ListViewValue() ?></div></td>
		<td<?php echo $expenseslist->exp_slipt_num->CellAttributes() ?>>
<div<?php echo $expenseslist->exp_slipt_num->ViewAttributes() ?>><?php echo $expenseslist->exp_slipt_num->ListViewValue() ?></div></td>
	</tr>
<?php
	$expenseslist_delete->Recordset->MoveNext();
}
$expenseslist_delete->Recordset->Close();
?>
</tbody>
</table>
</div>
</td></tr></table>
<p>
<a href="<?php echo $expenseslist->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a>&nbsp;
<input type="submit" name="Action" id="Action" value="<?php echo ew_BtnCaption($Language->Phrase("DeleteBtn")) ?>">
</form>
<?php
$expenseslist_delete->ShowPageFooter();
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
$expenseslist_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class cexpenseslist_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'expenseslist';

	// Page object name
	var $PageObjName = 'expenseslist_delete';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $expenseslist;
		if ($expenseslist->UseTokenInUrl) $PageUrl .= "t=" . $expenseslist->TableVar . "&"; // Add page token
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
		global $objForm, $expenseslist;
		if ($expenseslist->UseTokenInUrl) {
			if ($objForm)
				return ($expenseslist->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($expenseslist->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cexpenseslist_delete() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (expenseslist)
		if (!isset($GLOBALS["expenseslist"])) {
			$GLOBALS["expenseslist"] = new cexpenseslist();
			$GLOBALS["Table"] =& $GLOBALS["expenseslist"];
		}

		// Table object (administrator)
		if (!isset($GLOBALS['administrator'])) $GLOBALS['administrator'] = new cadministrator();

		// Table object (expensescategory)
		if (!isset($GLOBALS['expensescategory'])) $GLOBALS['expensescategory'] = new cexpensescategory();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'expenseslist', TRUE);

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
		global $expenseslist;

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
		global $Language, $expenseslist;

		// Load key parameters
		$this->RecKeys = $expenseslist->GetRecordKeys(); // Load record keys
		$sFilter = $expenseslist->GetKeyFilter();
		if ($sFilter == "")
			$this->Page_Terminate("expenseslistlist.php"); // Prevent SQL injection, return to list

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in expenseslist class, expenseslistinfo.php

		$expenseslist->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$expenseslist->CurrentAction = $_POST["a_delete"];
		} else {
			$expenseslist->CurrentAction = "I"; // Display record
		}
		switch ($expenseslist->CurrentAction) {
			case "D": // Delete
				$expenseslist->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setSuccessMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($expenseslist->getReturnUrl()); // Return to caller
				}
		}
	}

// No functions
	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $expenseslist;

		// Call Recordset Selecting event
		$expenseslist->Recordset_Selecting($expenseslist->CurrentFilter);

		// Load List page SQL
		$sSql = $expenseslist->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$expenseslist->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $expenseslist;
		$sFilter = $expenseslist->KeyFilter();

		// Call Row Selecting event
		$expenseslist->Row_Selecting($sFilter);

		// Load SQL based on filter
		$expenseslist->CurrentFilter = $sFilter;
		$sSql = $expenseslist->SQL();
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
		global $conn, $expenseslist;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$expenseslist->Row_Selected($row);
		$expenseslist->exp_id->setDbValue($rs->fields('exp_id'));
		$expenseslist->exp_cat->setDbValue($rs->fields('exp_cat'));
		$expenseslist->exp_detail->setDbValue($rs->fields('exp_detail'));
		$expenseslist->exp_total->setDbValue($rs->fields('exp_total'));
		$expenseslist->exp_date->setDbValue($rs->fields('exp_date'));
		$expenseslist->exp_dispencer->setDbValue($rs->fields('exp_dispencer'));
		$expenseslist->exp_slipt_num->setDbValue($rs->fields('exp_slipt_num'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $expenseslist;

		// Initialize URLs
		// Call Row_Rendering event

		$expenseslist->Row_Rendering();

		// Common render codes for all row types
		// exp_id

		$expenseslist->exp_id->CellCssStyle = "white-space: nowrap;";

		// exp_cat
		$expenseslist->exp_cat->CellCssStyle = "white-space: nowrap;";

		// exp_detail
		// exp_total
		// exp_date
		// exp_dispencer
		// exp_slipt_num

		if ($expenseslist->RowType == EW_ROWTYPE_VIEW) { // View row

			// exp_cat
			if (strval($expenseslist->exp_cat->CurrentValue) <> "") {
				$sFilterWrk = "`exp_cat_id` = " . ew_AdjustSql($expenseslist->exp_cat->CurrentValue) . "";
			$sSqlWrk = "SELECT `exp_cat_title` FROM `expensescategory`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `exp_cat_title`";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$expenseslist->exp_cat->ViewValue = $rswrk->fields('exp_cat_title');
					$rswrk->Close();
				} else {
					$expenseslist->exp_cat->ViewValue = $expenseslist->exp_cat->CurrentValue;
				}
			} else {
				$expenseslist->exp_cat->ViewValue = NULL;
			}
			$expenseslist->exp_cat->ViewCustomAttributes = "";

			// exp_total
			$expenseslist->exp_total->ViewValue = $expenseslist->exp_total->CurrentValue;
			$expenseslist->exp_total->ViewCustomAttributes = "";

			// exp_date
			$expenseslist->exp_date->ViewValue = $expenseslist->exp_date->CurrentValue;
			$expenseslist->exp_date->ViewValue = ew_FormatDateTime($expenseslist->exp_date->ViewValue, 7);
			$expenseslist->exp_date->ViewCustomAttributes = "";

			// exp_dispencer
			$expenseslist->exp_dispencer->ViewValue = $expenseslist->exp_dispencer->CurrentValue;
			$expenseslist->exp_dispencer->ViewCustomAttributes = "";

			// exp_slipt_num
			$expenseslist->exp_slipt_num->ViewValue = $expenseslist->exp_slipt_num->CurrentValue;
			$expenseslist->exp_slipt_num->ViewCustomAttributes = "";

			// exp_cat
			$expenseslist->exp_cat->LinkCustomAttributes = "";
			$expenseslist->exp_cat->HrefValue = "";
			$expenseslist->exp_cat->TooltipValue = "";

			// exp_total
			$expenseslist->exp_total->LinkCustomAttributes = "";
			$expenseslist->exp_total->HrefValue = "";
			$expenseslist->exp_total->TooltipValue = "";

			// exp_date
			$expenseslist->exp_date->LinkCustomAttributes = "";
			$expenseslist->exp_date->HrefValue = "";
			$expenseslist->exp_date->TooltipValue = "";

			// exp_dispencer
			$expenseslist->exp_dispencer->LinkCustomAttributes = "";
			$expenseslist->exp_dispencer->HrefValue = "";
			$expenseslist->exp_dispencer->TooltipValue = "";

			// exp_slipt_num
			$expenseslist->exp_slipt_num->LinkCustomAttributes = "";
			$expenseslist->exp_slipt_num->HrefValue = "";
			$expenseslist->exp_slipt_num->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($expenseslist->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$expenseslist->Row_Rendered();
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $expenseslist;
		$DeleteRows = TRUE;
		$sSql = $expenseslist->SQL();
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
				$DeleteRows = $expenseslist->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['exp_id'];
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $conn->Execute($expenseslist->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($expenseslist->CancelMessage <> "") {
				$this->setFailureMessage($expenseslist->CancelMessage);
				$expenseslist->CancelMessage = "";
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
				$expenseslist->Row_Deleted($row);
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
