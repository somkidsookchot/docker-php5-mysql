<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "subvcalculateinfo.php" ?>
<?php include_once "administratorinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$subvcalculate_delete = new csubvcalculate_delete();
$Page =& $subvcalculate_delete;

// Page init
$subvcalculate_delete->Page_Init();

// Page main
$subvcalculate_delete->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var subvcalculate_delete = new ew_Page("subvcalculate_delete");

// page properties
subvcalculate_delete.PageID = "delete"; // page ID
subvcalculate_delete.FormID = "fsubvcalculatedelete"; // form ID
var EW_PAGE_ID = subvcalculate_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
subvcalculate_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
subvcalculate_delete.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
subvcalculate_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
subvcalculate_delete.ValidateRequired = false; // no JavaScript validation
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
if ($subvcalculate_delete->Recordset = $subvcalculate_delete->LoadRecordset())
	$subvcalculate_deleteTotalRecs = $subvcalculate_delete->Recordset->RecordCount(); // Get record count
if ($subvcalculate_deleteTotalRecs <= 0) { // No record found, exit
	if ($subvcalculate_delete->Recordset)
		$subvcalculate_delete->Recordset->Close();
	$subvcalculate_delete->Page_Terminate("subvcalculatelist.php"); // Return to list
}
?>
<div class="phpmaker ewTitle"><img src="images/ico_delete_unpay.png" width="40" height="40" align="absmiddle" /><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $subvcalculate->TableCaption() ?></div><div class="clear"></div>

<?php $subvcalculate_delete->ShowPageHeader(); ?>
<?php
$subvcalculate_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="subvcalculate">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($subvcalculate_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(EW_COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($keyvalue) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $subvcalculate->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $subvcalculate->t_code->FldCaption() ?></td>
		<td valign="top"><?php echo $subvcalculate->village_id->FldCaption() ?></td>
		<td valign="top"><?php echo $subvcalculate->cal_type->FldCaption() ?></td>
		<td valign="top"><?php echo $subvcalculate->member_code->FldCaption() ?></td>
		<td valign="top"><?php echo $subvcalculate->adv_num->FldCaption() ?></td>
		<td valign="top"><?php echo $subvcalculate->cal_detail->FldCaption() ?></td>
		<td valign="top"><?php echo $subvcalculate->count_member->FldCaption() ?></td>
		<td valign="top"><?php echo $subvcalculate->unit_rate->FldCaption() ?></td>
		<td valign="top"><?php echo $subvcalculate->total->FldCaption() ?></td>
		<td valign="top"><?php echo $subvcalculate->cal_status->FldCaption() ?></td>
		<td valign="top"><?php echo $subvcalculate->invoice_senddate->FldCaption() ?></td>
		<td valign="top"><?php echo $subvcalculate->invoice_duedate->FldCaption() ?></td>
		<td valign="top"><?php echo $subvcalculate->notice_senddate->FldCaption() ?></td>
		<td valign="top"><?php echo $subvcalculate->notice_duedate->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$subvcalculate_delete->RecCnt = 0;
$i = 0;
while (!$subvcalculate_delete->Recordset->EOF) {
	$subvcalculate_delete->RecCnt++;

	// Set row properties
	$subvcalculate->ResetAttrs();
	$subvcalculate->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$subvcalculate_delete->LoadRowValues($subvcalculate_delete->Recordset);

	// Render row
	$subvcalculate_delete->RenderRow();
?>
	<tr<?php echo $subvcalculate->RowAttributes() ?>>
		<td<?php echo $subvcalculate->t_code->CellAttributes() ?>>
<div<?php echo $subvcalculate->t_code->ViewAttributes() ?>><?php echo $subvcalculate->t_code->ListViewValue() ?></div></td>
		<td<?php echo $subvcalculate->village_id->CellAttributes() ?>>
<div<?php echo $subvcalculate->village_id->ViewAttributes() ?>><?php echo $subvcalculate->village_id->ListViewValue() ?></div></td>
		<td<?php echo $subvcalculate->cal_type->CellAttributes() ?>>
<div<?php echo $subvcalculate->cal_type->ViewAttributes() ?>><?php echo $subvcalculate->cal_type->ListViewValue() ?></div></td>
		<td<?php echo $subvcalculate->member_code->CellAttributes() ?>>
<div<?php echo $subvcalculate->member_code->ViewAttributes() ?>><?php echo $subvcalculate->member_code->ListViewValue() ?></div></td>
		<td<?php echo $subvcalculate->adv_num->CellAttributes() ?>>
<div<?php echo $subvcalculate->adv_num->ViewAttributes() ?>><?php echo $subvcalculate->adv_num->ListViewValue() ?></div></td>
		<td<?php echo $subvcalculate->cal_detail->CellAttributes() ?>>
<div<?php echo $subvcalculate->cal_detail->ViewAttributes() ?>><?php echo $subvcalculate->cal_detail->ListViewValue() ?></div></td>
		<td<?php echo $subvcalculate->count_member->CellAttributes() ?>>
<div<?php echo $subvcalculate->count_member->ViewAttributes() ?>><?php echo $subvcalculate->count_member->ListViewValue() ?></div></td>
		<td<?php echo $subvcalculate->unit_rate->CellAttributes() ?>>
<div<?php echo $subvcalculate->unit_rate->ViewAttributes() ?>><?php echo $subvcalculate->unit_rate->ListViewValue() ?></div></td>
		<td<?php echo $subvcalculate->total->CellAttributes() ?>>
<div<?php echo $subvcalculate->total->ViewAttributes() ?>><?php echo $subvcalculate->total->ListViewValue() ?></div></td>
		<td<?php echo $subvcalculate->cal_status->CellAttributes() ?>>
<div<?php echo $subvcalculate->cal_status->ViewAttributes() ?>><?php echo $subvcalculate->cal_status->ListViewValue() ?></div></td>
		<td<?php echo $subvcalculate->invoice_senddate->CellAttributes() ?>>
<div<?php echo $subvcalculate->invoice_senddate->ViewAttributes() ?>><?php echo $subvcalculate->invoice_senddate->ListViewValue() ?></div></td>
		<td<?php echo $subvcalculate->invoice_duedate->CellAttributes() ?>>
<div<?php echo $subvcalculate->invoice_duedate->ViewAttributes() ?>><?php echo $subvcalculate->invoice_duedate->ListViewValue() ?></div></td>
		<td<?php echo $subvcalculate->notice_senddate->CellAttributes() ?>>
<div<?php echo $subvcalculate->notice_senddate->ViewAttributes() ?>><?php echo $subvcalculate->notice_senddate->ListViewValue() ?></div></td>
		<td<?php echo $subvcalculate->notice_duedate->CellAttributes() ?>>
<div<?php echo $subvcalculate->notice_duedate->ViewAttributes() ?>><?php echo $subvcalculate->notice_duedate->ListViewValue() ?></div></td>
	</tr>
<?php
	$subvcalculate_delete->Recordset->MoveNext();
}
$subvcalculate_delete->Recordset->Close();
?>
</tbody>
</table>
</div>
</td></tr></table>
<p><a href="<?php echo $subvcalculate->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a>&nbsp;
<input type="submit" name="Action" id="Action" value="<?php echo ew_BtnCaption($Language->Phrase("DeleteBtn")) ?>">
</form>
<?php
$subvcalculate_delete->ShowPageFooter();
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
$subvcalculate_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class csubvcalculate_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'subvcalculate';

	// Page object name
	var $PageObjName = 'subvcalculate_delete';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $subvcalculate;
		if ($subvcalculate->UseTokenInUrl) $PageUrl .= "t=" . $subvcalculate->TableVar . "&"; // Add page token
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
		global $objForm, $subvcalculate;
		if ($subvcalculate->UseTokenInUrl) {
			if ($objForm)
				return ($subvcalculate->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($subvcalculate->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function csubvcalculate_delete() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (subvcalculate)
		if (!isset($GLOBALS["subvcalculate"])) {
			$GLOBALS["subvcalculate"] = new csubvcalculate();
			$GLOBALS["Table"] =& $GLOBALS["subvcalculate"];
		}

		// Table object (administrator)
		if (!isset($GLOBALS['administrator'])) $GLOBALS['administrator'] = new cadministrator();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'subvcalculate', TRUE);

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
		global $subvcalculate;

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
		global $Language, $subvcalculate;

		// Load key parameters
		$this->RecKeys = $subvcalculate->GetRecordKeys(); // Load record keys
		$sFilter = $subvcalculate->GetKeyFilter();
		if ($sFilter == "")
			$this->Page_Terminate("subvcalculatelist.php"); // Prevent SQL injection, return to list

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in subvcalculate class, subvcalculateinfo.php

		$subvcalculate->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$subvcalculate->CurrentAction = $_POST["a_delete"];
		} else {
			$subvcalculate->CurrentAction = "I"; // Display record
		}
		switch ($subvcalculate->CurrentAction) {
			case "D": // Delete
				$subvcalculate->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setSuccessMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($subvcalculate->getReturnUrl()); // Return to caller
				}
		}
	}

// No functions
	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $subvcalculate;

		// Call Recordset Selecting event
		$subvcalculate->Recordset_Selecting($subvcalculate->CurrentFilter);

		// Load List page SQL
		$sSql = $subvcalculate->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$subvcalculate->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $subvcalculate;
		$sFilter = $subvcalculate->KeyFilter();

		// Call Row Selecting event
		$subvcalculate->Row_Selecting($sFilter);

		// Load SQL based on filter
		$subvcalculate->CurrentFilter = $sFilter;
		$sSql = $subvcalculate->SQL();
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
		global $conn, $subvcalculate;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$subvcalculate->Row_Selected($row);
		$subvcalculate->svc_id->setDbValue($rs->fields('svc_id'));
		$subvcalculate->t_code->setDbValue($rs->fields('t_code'));
		$subvcalculate->village_id->setDbValue($rs->fields('village_id'));
		$subvcalculate->cal_type->setDbValue($rs->fields('cal_type'));
		$subvcalculate->member_code->setDbValue($rs->fields('member_code'));
		$subvcalculate->adv_num->setDbValue($rs->fields('adv_num'));
		$subvcalculate->cal_detail->setDbValue($rs->fields('cal_detail'));
		$subvcalculate->count_member->setDbValue($rs->fields('count_member'));
		$subvcalculate->all_member->setDbValue($rs->fields('all_member'));
		$subvcalculate->unit_rate->setDbValue($rs->fields('unit_rate'));
		$subvcalculate->total->setDbValue($rs->fields('total'));
		$subvcalculate->cal_date->setDbValue($rs->fields('cal_date'));
		$subvcalculate->cal_status->setDbValue($rs->fields('cal_status'));
		$subvcalculate->invoice_senddate->setDbValue($rs->fields('invoice_senddate'));
		$subvcalculate->invoice_duedate->setDbValue($rs->fields('invoice_duedate'));
		$subvcalculate->notice_senddate->setDbValue($rs->fields('notice_senddate'));
		$subvcalculate->notice_duedate->setDbValue($rs->fields('notice_duedate'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $subvcalculate;

		// Initialize URLs
		// Call Row_Rendering event

		$subvcalculate->Row_Rendering();

		// Common render codes for all row types
		// svc_id

		$subvcalculate->svc_id->CellCssStyle = "white-space: nowrap;";

		// t_code
		$subvcalculate->t_code->CellCssStyle = "white-space: nowrap;";

		// village_id
		$subvcalculate->village_id->CellCssStyle = "white-space: nowrap;";

		// cal_type
		$subvcalculate->cal_type->CellCssStyle = "white-space: nowrap;";

		// member_code
		$subvcalculate->member_code->CellCssStyle = "white-space: nowrap;";

		// adv_num
		$subvcalculate->adv_num->CellCssStyle = "white-space: nowrap;";

		// cal_detail
		$subvcalculate->cal_detail->CellCssStyle = "white-space: nowrap;";

		// count_member
		$subvcalculate->count_member->CellCssStyle = "white-space: nowrap;";

		// all_member
		$subvcalculate->all_member->CellCssStyle = "white-space: nowrap;";

		// unit_rate
		$subvcalculate->unit_rate->CellCssStyle = "white-space: nowrap;";

		// total
		$subvcalculate->total->CellCssStyle = "white-space: nowrap;";

		// cal_date
		$subvcalculate->cal_date->CellCssStyle = "white-space: nowrap;";

		// cal_status
		$subvcalculate->cal_status->CellCssStyle = "white-space: nowrap;";

		// invoice_senddate
		// invoice_duedate
		// notice_senddate
		// notice_duedate

		if ($subvcalculate->RowType == EW_ROWTYPE_VIEW) { // View row

			// t_code
			if (strval($subvcalculate->t_code->CurrentValue) <> "") {
				$sFilterWrk = "`t_code` = '" . ew_AdjustSql($subvcalculate->t_code->CurrentValue) . "'";
			$sSqlWrk = "SELECT `t_code`, `t_title` FROM `tambon`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$subvcalculate->t_code->ViewValue = $rswrk->fields('t_code');
					$subvcalculate->t_code->ViewValue .= ew_ValueSeparator(0,1,$subvcalculate->t_code) . $rswrk->fields('t_title');
					$rswrk->Close();
				} else {
					$subvcalculate->t_code->ViewValue = $subvcalculate->t_code->CurrentValue;
				}
			} else {
				$subvcalculate->t_code->ViewValue = NULL;
			}
			$subvcalculate->t_code->ViewCustomAttributes = "";

			// village_id
			if (strval($subvcalculate->village_id->CurrentValue) <> "") {
				$sFilterWrk = "`village_id` = " . ew_AdjustSql($subvcalculate->village_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `v_code`, `v_title` FROM `village`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `v_code`";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$subvcalculate->village_id->ViewValue = $rswrk->fields('v_code');
					$subvcalculate->village_id->ViewValue .= ew_ValueSeparator(0,1,$subvcalculate->village_id) . $rswrk->fields('v_title');
					$rswrk->Close();
				} else {
					$subvcalculate->village_id->ViewValue = $subvcalculate->village_id->CurrentValue;
				}
			} else {
				$subvcalculate->village_id->ViewValue = NULL;
			}
			$subvcalculate->village_id->ViewCustomAttributes = "";

			// cal_type
			if (strval($subvcalculate->cal_type->CurrentValue) <> "") {
				$sFilterWrk = "`pt_id` = " . ew_AdjustSql($subvcalculate->cal_type->CurrentValue) . "";
			$sSqlWrk = "SELECT `pt_title` FROM `paymenttype`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$subvcalculate->cal_type->ViewValue = $rswrk->fields('pt_title');
					$rswrk->Close();
				} else {
					$subvcalculate->cal_type->ViewValue = $subvcalculate->cal_type->CurrentValue;
				}
			} else {
				$subvcalculate->cal_type->ViewValue = NULL;
			}
			$subvcalculate->cal_type->ViewCustomAttributes = "";

			// member_code
			if (strval($subvcalculate->member_code->CurrentValue) <> "") {
				$sFilterWrk = "`member_code` = '" . ew_AdjustSql($subvcalculate->member_code->CurrentValue) . "'";
			$sSqlWrk = "SELECT `dead_id`, `fname`, `lname` FROM `members`";
			$sWhereWrk = "";
			$lookuptblfilter = "`member_status` = 'เสียชีวิต'";
			if (strval($lookuptblfilter) <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $lookuptblfilter . ")";
			}
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$subvcalculate->member_code->ViewValue = $rswrk->fields('dead_id');
					$subvcalculate->member_code->ViewValue .= ew_ValueSeparator(0,1,$subvcalculate->member_code) . $rswrk->fields('fname');
					$subvcalculate->member_code->ViewValue .= ew_ValueSeparator(0,2,$subvcalculate->member_code) . $rswrk->fields('lname');
					$rswrk->Close();
				} else {
					$subvcalculate->member_code->ViewValue = $subvcalculate->member_code->CurrentValue;
				}
			} else {
				$subvcalculate->member_code->ViewValue = NULL;
			}
			$subvcalculate->member_code->ViewCustomAttributes = "";

			// adv_num
			$subvcalculate->adv_num->ViewValue = $subvcalculate->adv_num->CurrentValue;
			$subvcalculate->adv_num->ViewCustomAttributes = "";

			// cal_detail
			$subvcalculate->cal_detail->ViewValue = $subvcalculate->cal_detail->CurrentValue;
			$subvcalculate->cal_detail->ViewCustomAttributes = "";

			// count_member
			$subvcalculate->count_member->ViewValue = $subvcalculate->count_member->CurrentValue;
			$subvcalculate->count_member->ViewCustomAttributes = "";

			// unit_rate
			$subvcalculate->unit_rate->ViewValue = $subvcalculate->unit_rate->CurrentValue;
			$subvcalculate->unit_rate->ViewCustomAttributes = "";

			// total
			$subvcalculate->total->ViewValue = $subvcalculate->total->CurrentValue;
			$subvcalculate->total->ViewCustomAttributes = "";

			// cal_status
			$subvcalculate->cal_status->ViewValue = $subvcalculate->cal_status->CurrentValue;
			$subvcalculate->cal_status->ViewCustomAttributes = "";

			// invoice_senddate
			$subvcalculate->invoice_senddate->ViewValue = $subvcalculate->invoice_senddate->CurrentValue;
			$subvcalculate->invoice_senddate->ViewValue = ew_FormatDateTime($subvcalculate->invoice_senddate->ViewValue, 7);
			$subvcalculate->invoice_senddate->ViewCustomAttributes = "";

			// invoice_duedate
			$subvcalculate->invoice_duedate->ViewValue = $subvcalculate->invoice_duedate->CurrentValue;
			$subvcalculate->invoice_duedate->ViewValue = ew_FormatDateTime($subvcalculate->invoice_duedate->ViewValue, 7);
			$subvcalculate->invoice_duedate->ViewCustomAttributes = "";

			// notice_senddate
			$subvcalculate->notice_senddate->ViewValue = $subvcalculate->notice_senddate->CurrentValue;
			$subvcalculate->notice_senddate->ViewValue = ew_FormatDateTime($subvcalculate->notice_senddate->ViewValue, 7);
			$subvcalculate->notice_senddate->ViewCustomAttributes = "";

			// notice_duedate
			$subvcalculate->notice_duedate->ViewValue = $subvcalculate->notice_duedate->CurrentValue;
			$subvcalculate->notice_duedate->ViewValue = ew_FormatDateTime($subvcalculate->notice_duedate->ViewValue, 7);
			$subvcalculate->notice_duedate->ViewCustomAttributes = "";

			// t_code
			$subvcalculate->t_code->LinkCustomAttributes = "";
			$subvcalculate->t_code->HrefValue = "";
			$subvcalculate->t_code->TooltipValue = "";

			// village_id
			$subvcalculate->village_id->LinkCustomAttributes = "";
			$subvcalculate->village_id->HrefValue = "";
			$subvcalculate->village_id->TooltipValue = "";

			// cal_type
			$subvcalculate->cal_type->LinkCustomAttributes = "";
			$subvcalculate->cal_type->HrefValue = "";
			$subvcalculate->cal_type->TooltipValue = "";

			// member_code
			$subvcalculate->member_code->LinkCustomAttributes = "";
			$subvcalculate->member_code->HrefValue = "";
			$subvcalculate->member_code->TooltipValue = "";

			// adv_num
			$subvcalculate->adv_num->LinkCustomAttributes = "";
			$subvcalculate->adv_num->HrefValue = "";
			$subvcalculate->adv_num->TooltipValue = "";

			// cal_detail
			$subvcalculate->cal_detail->LinkCustomAttributes = "";
			$subvcalculate->cal_detail->HrefValue = "";
			$subvcalculate->cal_detail->TooltipValue = "";

			// count_member
			$subvcalculate->count_member->LinkCustomAttributes = "";
			$subvcalculate->count_member->HrefValue = "";
			$subvcalculate->count_member->TooltipValue = "";

			// unit_rate
			$subvcalculate->unit_rate->LinkCustomAttributes = "";
			$subvcalculate->unit_rate->HrefValue = "";
			$subvcalculate->unit_rate->TooltipValue = "";

			// total
			$subvcalculate->total->LinkCustomAttributes = "";
			$subvcalculate->total->HrefValue = "";
			$subvcalculate->total->TooltipValue = "";

			// cal_status
			$subvcalculate->cal_status->LinkCustomAttributes = "";
			$subvcalculate->cal_status->HrefValue = "";
			$subvcalculate->cal_status->TooltipValue = "";

			// invoice_senddate
			$subvcalculate->invoice_senddate->LinkCustomAttributes = "";
			$subvcalculate->invoice_senddate->HrefValue = "";
			$subvcalculate->invoice_senddate->TooltipValue = "";

			// invoice_duedate
			$subvcalculate->invoice_duedate->LinkCustomAttributes = "";
			$subvcalculate->invoice_duedate->HrefValue = "";
			$subvcalculate->invoice_duedate->TooltipValue = "";

			// notice_senddate
			$subvcalculate->notice_senddate->LinkCustomAttributes = "";
			$subvcalculate->notice_senddate->HrefValue = "";
			$subvcalculate->notice_senddate->TooltipValue = "";

			// notice_duedate
			$subvcalculate->notice_duedate->LinkCustomAttributes = "";
			$subvcalculate->notice_duedate->HrefValue = "";
			$subvcalculate->notice_duedate->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($subvcalculate->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$subvcalculate->Row_Rendered();
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $subvcalculate;
		$DeleteRows = TRUE;
		$sSql = $subvcalculate->SQL();
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
				$DeleteRows = $subvcalculate->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['svc_id'];
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $conn->Execute($subvcalculate->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($subvcalculate->CancelMessage <> "") {
				$this->setFailureMessage($subvcalculate->CancelMessage);
				$subvcalculate->CancelMessage = "";
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
				$subvcalculate->Row_Deleted($row);
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
