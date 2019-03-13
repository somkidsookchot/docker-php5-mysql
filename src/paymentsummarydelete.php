<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "paymentsummaryinfo.php" ?>
<?php include_once "administratorinfo.php" ?>
<?php include_once "villageinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$paymentsummary_delete = new cpaymentsummary_delete();
$Page =& $paymentsummary_delete;

// Page init
$paymentsummary_delete->Page_Init();

// Page main
$paymentsummary_delete->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var paymentsummary_delete = new ew_Page("paymentsummary_delete");

// page properties
paymentsummary_delete.PageID = "delete"; // page ID
paymentsummary_delete.FormID = "fpaymentsummarydelete"; // form ID
var EW_PAGE_ID = paymentsummary_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
paymentsummary_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
paymentsummary_delete.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
paymentsummary_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
paymentsummary_delete.ValidateRequired = false; // no JavaScript validation
<?php } ?>

// search highlight properties
paymentsummary_delete.ShowHighlightText = ewLanguage.Phrase("ShowHighlight"); 
paymentsummary_delete.HideHighlightText = ewLanguage.Phrase("HideHighlight");

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<?php

// Load records for display
if ($paymentsummary_delete->Recordset = $paymentsummary_delete->LoadRecordset())
	$paymentsummary_deleteTotalRecs = $paymentsummary_delete->Recordset->RecordCount(); // Get record count
if ($paymentsummary_deleteTotalRecs <= 0) { // No record found, exit
	if ($paymentsummary_delete->Recordset)
		$paymentsummary_delete->Recordset->Close();
	$paymentsummary_delete->Page_Terminate("paymentsummarylist.php"); // Return to list
}
?>
<div class="phpmaker ewTitle"><img src="images/ico_delete_unpay.png" width="40" height="40" align="absmiddle" /><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $paymentsummary->TableCaption() ?></div>
<div class="clear"></div>
<?php $paymentsummary_delete->ShowPageHeader(); ?>
<?php
$paymentsummary_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="paymentsummary">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($paymentsummary_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(EW_COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($keyvalue) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $paymentsummary->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $paymentsummary->t_code->FldCaption() ?></td>
		<td valign="top"><?php echo $paymentsummary->village_id->FldCaption() ?></td>
		<td valign="top"><?php echo $paymentsummary->member_code->FldCaption() ?></td>
		<td valign="top"><?php echo $paymentsummary->pay_sum_date->FldCaption() ?></td>
		<td valign="top"><?php echo $paymentsummary->pay_sum_type->FldCaption() ?></td>
		<td valign="top"><?php echo $paymentsummary->pay_death_begin->FldCaption() ?></td>
		<td valign="top"><?php echo $paymentsummary->pay_sum_adv_num->FldCaption() ?></td>
		<td valign="top"><?php echo $paymentsummary->pay_annual_year->FldCaption() ?></td>
		<td valign="top"><?php echo $paymentsummary->pay_sum_detail->FldCaption() ?></td>
		<td valign="top"><?php echo $paymentsummary->pay_sum_total->FldCaption() ?></td>
		<td valign="top"><?php echo $paymentsummary->pay_sum_note->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$paymentsummary_delete->RecCnt = 0;
$i = 0;
while (!$paymentsummary_delete->Recordset->EOF) {
	$paymentsummary_delete->RecCnt++;

	// Set row properties
	$paymentsummary->ResetAttrs();
	$paymentsummary->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$paymentsummary_delete->LoadRowValues($paymentsummary_delete->Recordset);

	// Render row
	$paymentsummary_delete->RenderRow();
?>
	<tr<?php echo $paymentsummary->RowAttributes() ?>>
		<td<?php echo $paymentsummary->t_code->CellAttributes() ?>>
<div<?php echo $paymentsummary->t_code->ViewAttributes() ?>><?php echo $paymentsummary->t_code->ListViewValue() ?></div></td>
		<td<?php echo $paymentsummary->village_id->CellAttributes() ?>>
<div<?php echo $paymentsummary->village_id->ViewAttributes() ?>><?php echo $paymentsummary->village_id->ListViewValue() ?></div></td>
		<td<?php echo $paymentsummary->member_code->CellAttributes() ?>>
<div<?php echo $paymentsummary->member_code->ViewAttributes() ?>><?php echo $paymentsummary->member_code->ListViewValue() ?></div></td>
		<td<?php echo $paymentsummary->pay_sum_date->CellAttributes() ?>>
<div<?php echo $paymentsummary->pay_sum_date->ViewAttributes() ?>><?php echo $paymentsummary->pay_sum_date->ListViewValue() ?></div></td>
		<td<?php echo $paymentsummary->pay_sum_type->CellAttributes() ?>>
<div<?php echo $paymentsummary->pay_sum_type->ViewAttributes() ?>><?php echo $paymentsummary->pay_sum_type->ListViewValue() ?></div></td>
		<td<?php echo $paymentsummary->pay_death_begin->CellAttributes() ?>>
<div<?php echo $paymentsummary->pay_death_begin->ViewAttributes() ?>><?php echo $paymentsummary->pay_death_begin->ListViewValue() ?></div></td>
		<td<?php echo $paymentsummary->pay_sum_adv_num->CellAttributes() ?>>
<div<?php echo $paymentsummary->pay_sum_adv_num->ViewAttributes() ?>><?php echo $paymentsummary->pay_sum_adv_num->ListViewValue() ?></div></td>
		<td<?php echo $paymentsummary->pay_annual_year->CellAttributes() ?>>
<div<?php echo $paymentsummary->pay_annual_year->ViewAttributes() ?>><?php echo $paymentsummary->pay_annual_year->ListViewValue() ?></div></td>
		<td<?php echo $paymentsummary->pay_sum_detail->CellAttributes() ?>>
<div<?php echo $paymentsummary->pay_sum_detail->ViewAttributes() ?>><?php echo $paymentsummary->pay_sum_detail->ListViewValue() ?></div></td>
		<td<?php echo $paymentsummary->pay_sum_total->CellAttributes() ?>>
<div<?php echo $paymentsummary->pay_sum_total->ViewAttributes() ?>><?php echo $paymentsummary->pay_sum_total->ListViewValue() ?></div></td>
		<td<?php echo $paymentsummary->pay_sum_note->CellAttributes() ?>>
<div<?php echo $paymentsummary->pay_sum_note->ViewAttributes() ?>><?php echo $paymentsummary->pay_sum_note->ListViewValue() ?></div></td>
	</tr>
<?php
	$paymentsummary_delete->Recordset->MoveNext();
}
$paymentsummary_delete->Recordset->Close();
?>
</tbody>
</table>
</div>
</td></tr></table>
<p>
<a href="<?php echo $paymentsummary->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a>
<input type="submit" name="Action" id="Action" value="<?php echo ew_BtnCaption($Language->Phrase("DeleteBtn")) ?>">
</form>
<?php
$paymentsummary_delete->ShowPageFooter();
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
$paymentsummary_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class cpaymentsummary_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'paymentsummary';

	// Page object name
	var $PageObjName = 'paymentsummary_delete';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $paymentsummary;
		if ($paymentsummary->UseTokenInUrl) $PageUrl .= "t=" . $paymentsummary->TableVar . "&"; // Add page token
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
		global $objForm, $paymentsummary;
		if ($paymentsummary->UseTokenInUrl) {
			if ($objForm)
				return ($paymentsummary->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($paymentsummary->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cpaymentsummary_delete() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (paymentsummary)
		if (!isset($GLOBALS["paymentsummary"])) {
			$GLOBALS["paymentsummary"] = new cpaymentsummary();
			$GLOBALS["Table"] =& $GLOBALS["paymentsummary"];
		}

		// Table object (administrator)
		if (!isset($GLOBALS['administrator'])) $GLOBALS['administrator'] = new cadministrator();

		// Table object (village)
		if (!isset($GLOBALS['village'])) $GLOBALS['village'] = new cvillage();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'paymentsummary', TRUE);

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
		global $paymentsummary;

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
		global $Language, $paymentsummary;

		// Load key parameters
		$this->RecKeys = $paymentsummary->GetRecordKeys(); // Load record keys
		$sFilter = $paymentsummary->GetKeyFilter();
		if ($sFilter == "")
			$this->Page_Terminate("paymentsummarylist.php"); // Prevent SQL injection, return to list

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in paymentsummary class, paymentsummaryinfo.php

		$paymentsummary->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$paymentsummary->CurrentAction = $_POST["a_delete"];
		} else {
			$paymentsummary->CurrentAction = "I"; // Display record
		}
		switch ($paymentsummary->CurrentAction) {
			case "D": // Delete
				$paymentsummary->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setSuccessMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($paymentsummary->getReturnUrl()); // Return to caller
				}
		}
	}

// No functions
	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $paymentsummary;

		// Call Recordset Selecting event
		$paymentsummary->Recordset_Selecting($paymentsummary->CurrentFilter);

		// Load List page SQL
		$sSql = $paymentsummary->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$paymentsummary->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $paymentsummary;
		$sFilter = $paymentsummary->KeyFilter();

		// Call Row Selecting event
		$paymentsummary->Row_Selecting($sFilter);

		// Load SQL based on filter
		$paymentsummary->CurrentFilter = $sFilter;
		$sSql = $paymentsummary->SQL();
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
		global $conn, $paymentsummary;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$paymentsummary->Row_Selected($row);
		$paymentsummary->pay_sum_id->setDbValue($rs->fields('pay_sum_id'));
		$paymentsummary->t_code->setDbValue($rs->fields('t_code'));
		$paymentsummary->village_id->setDbValue($rs->fields('village_id'));
		$paymentsummary->member_code->setDbValue($rs->fields('member_code'));
		$paymentsummary->pay_sum_date->setDbValue($rs->fields('pay_sum_date'));
		$paymentsummary->pay_sum_type->setDbValue($rs->fields('pay_sum_type'));
		$paymentsummary->pay_death_begin->setDbValue($rs->fields('pay_death_begin'));
		$paymentsummary->pay_sum_adv_count->setDbValue($rs->fields('pay_sum_adv_count'));
		$paymentsummary->pay_sum_adv_num->setDbValue($rs->fields('pay_sum_adv_num'));
		$paymentsummary->pay_death_end->setDbValue($rs->fields('pay_death_end'));
		$paymentsummary->pay_annual_year->setDbValue($rs->fields('pay_annual_year'));
		$paymentsummary->pay_sum_detail->setDbValue($rs->fields('pay_sum_detail'));
		$paymentsummary->pay_sum_total->setDbValue($rs->fields('pay_sum_total'));
		$paymentsummary->pay_sum_note->setDbValue($rs->fields('pay_sum_note'));
		$paymentsummary->flag->setDbValue($rs->fields('flag'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $paymentsummary;

		// Initialize URLs
		// Call Row_Rendering event

		$paymentsummary->Row_Rendering();

		// Common render codes for all row types
		// pay_sum_id
		// t_code

		$paymentsummary->t_code->CellCssStyle = "white-space: nowrap;";

		// village_id
		$paymentsummary->village_id->CellCssStyle = "white-space: nowrap;";

		// member_code
		$paymentsummary->member_code->CellCssStyle = "white-space: nowrap;";

		// pay_sum_date
		// pay_sum_type

		$paymentsummary->pay_sum_type->CellCssStyle = "white-space: nowrap;";

		// pay_death_begin
		// pay_sum_adv_count

		$paymentsummary->pay_sum_adv_count->CellCssStyle = "white-space: nowrap;";

		// pay_sum_adv_num
		// pay_death_end

		$paymentsummary->pay_death_end->CellCssStyle = "white-space: nowrap;";

		// pay_annual_year
		// pay_sum_detail
		// pay_sum_total

		$paymentsummary->pay_sum_total->CellCssStyle = "white-space: nowrap;";

		// pay_sum_note
		// flag

		$paymentsummary->flag->CellCssStyle = "white-space: nowrap;";
		if ($paymentsummary->RowType == EW_ROWTYPE_VIEW) { // View row

			// pay_sum_id
			$paymentsummary->pay_sum_id->ViewValue = $paymentsummary->pay_sum_id->CurrentValue;
			$paymentsummary->pay_sum_id->ViewCustomAttributes = "";

			// t_code
			if (strval($paymentsummary->t_code->CurrentValue) <> "") {
				$sFilterWrk = "`t_code` = '" . ew_AdjustSql($paymentsummary->t_code->CurrentValue) . "'";
			$sSqlWrk = "SELECT `t_code`, `t_title` FROM `tambon`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `t_code`";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$paymentsummary->t_code->ViewValue = $rswrk->fields('t_code');
					$paymentsummary->t_code->ViewValue .= ew_ValueSeparator(0,1,$paymentsummary->t_code) . $rswrk->fields('t_title');
					$rswrk->Close();
				} else {
					$paymentsummary->t_code->ViewValue = $paymentsummary->t_code->CurrentValue;
				}
			} else {
				$paymentsummary->t_code->ViewValue = NULL;
			}
			$paymentsummary->t_code->ViewCustomAttributes = "";

			// village_id
			if (strval($paymentsummary->village_id->CurrentValue) <> "") {
				$sFilterWrk = "`village_id` = " . ew_AdjustSql($paymentsummary->village_id->CurrentValue) . "";
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
					$paymentsummary->village_id->ViewValue = $rswrk->fields('v_code');
					$paymentsummary->village_id->ViewValue .= ew_ValueSeparator(0,1,$paymentsummary->village_id) . $rswrk->fields('v_title');
					$rswrk->Close();
				} else {
					$paymentsummary->village_id->ViewValue = $paymentsummary->village_id->CurrentValue;
				}
			} else {
				$paymentsummary->village_id->ViewValue = NULL;
			}
			$paymentsummary->village_id->ViewCustomAttributes = "";

			// member_code
			if (strval($paymentsummary->member_code->CurrentValue) <> "") {
				$arwrk = explode(",", $paymentsummary->member_code->CurrentValue);
				$sFilterWrk = "";
				foreach ($arwrk as $wrk) {
					if ($sFilterWrk <> "") $sFilterWrk .= " OR ";
					$sFilterWrk .= "`member_code` = '" . ew_AdjustSql(trim($wrk)) . "'";
				}	
			$sSqlWrk = "SELECT `member_code`, `fname`, `lname` FROM `members`";
			$sWhereWrk = "";
			$lookuptblfilter = "`member_status` != 'เสียชีวิต' ";;
			if (strval($lookuptblfilter) <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $lookuptblfilter . ")";
			}
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `member_code`";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$paymentsummary->member_code->ViewValue = "";
					$ari = 0;
					while (!$rswrk->EOF) {
						$paymentsummary->member_code->ViewValue .= $rswrk->fields('member_code');
						$paymentsummary->member_code->ViewValue .= ew_ValueSeparator($ari,1,$paymentsummary->member_code) . $rswrk->fields('fname');
						$paymentsummary->member_code->ViewValue .= ew_ValueSeparator($ari,2,$paymentsummary->member_code) . $rswrk->fields('lname');
						$rswrk->MoveNext();
						if (!$rswrk->EOF) $paymentsummary->member_code->ViewValue .= ew_ViewOptionSeparator($ari); // Separate Options
						$ari++;
					}
					$rswrk->Close();
				} else {
					$paymentsummary->member_code->ViewValue = $paymentsummary->member_code->CurrentValue;
				}
			} else {
				$paymentsummary->member_code->ViewValue = NULL;
			}
			$paymentsummary->member_code->ViewCustomAttributes = "";

			// pay_sum_date
			$paymentsummary->pay_sum_date->ViewValue = $paymentsummary->pay_sum_date->CurrentValue;
			$paymentsummary->pay_sum_date->ViewValue = ew_FormatDateTime($paymentsummary->pay_sum_date->ViewValue, 7);
			$paymentsummary->pay_sum_date->ViewCustomAttributes = "";

			// pay_sum_type
			if (strval($paymentsummary->pay_sum_type->CurrentValue) <> "") {
				$sFilterWrk = "`pt_id` = " . ew_AdjustSql($paymentsummary->pay_sum_type->CurrentValue) . "";
			$sSqlWrk = "SELECT `pt_title` FROM `paymenttype`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$paymentsummary->pay_sum_type->ViewValue = $rswrk->fields('pt_title');
					$rswrk->Close();
				} else {
					$paymentsummary->pay_sum_type->ViewValue = $paymentsummary->pay_sum_type->CurrentValue;
				}
			} else {
				$paymentsummary->pay_sum_type->ViewValue = NULL;
			}
			$paymentsummary->pay_sum_type->ViewCustomAttributes = "";

			// pay_death_begin
			if (strval($paymentsummary->pay_death_begin->CurrentValue) <> "") {
				$sFilterWrk = "`dead_id` = " . ew_AdjustSql($paymentsummary->pay_death_begin->CurrentValue) . "";
			$sSqlWrk = "SELECT `dead_id`, `fname`, `lname` FROM `members`";
			$sWhereWrk = "";
			$lookuptblfilter = "`member_status` = 'เสียชีวิต' ";
			if (strval($lookuptblfilter) <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $lookuptblfilter . ")";
			}
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `dead_id` Desc";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$paymentsummary->pay_death_begin->ViewValue = $rswrk->fields('dead_id');
					$paymentsummary->pay_death_begin->ViewValue .= ew_ValueSeparator(0,1,$paymentsummary->pay_death_begin) . $rswrk->fields('fname');
					$paymentsummary->pay_death_begin->ViewValue .= ew_ValueSeparator(0,2,$paymentsummary->pay_death_begin) . $rswrk->fields('lname');
					$rswrk->Close();
				} else {
					$paymentsummary->pay_death_begin->ViewValue = $paymentsummary->pay_death_begin->CurrentValue;
				}
			} else {
				$paymentsummary->pay_death_begin->ViewValue = NULL;
			}
			$paymentsummary->pay_death_begin->ViewCustomAttributes = "";

			// pay_sum_adv_num
			if (strval($paymentsummary->pay_sum_adv_num->CurrentValue) <> "") {
				$sFilterWrk = "`adv_num` = " . ew_AdjustSql($paymentsummary->pay_sum_adv_num->CurrentValue) . "";
			$sSqlWrk = "SELECT DISTINCT `adv_num` FROM `subvcalculate`";
			$sWhereWrk = "";
			$lookuptblfilter = "`adv_num` != '0'";
			if (strval($lookuptblfilter) <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $lookuptblfilter . ")";
			}
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `adv_num`";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$paymentsummary->pay_sum_adv_num->ViewValue = $rswrk->fields('adv_num');
					$rswrk->Close();
				} else {
					$paymentsummary->pay_sum_adv_num->ViewValue = $paymentsummary->pay_sum_adv_num->CurrentValue;
				}
			} else {
				$paymentsummary->pay_sum_adv_num->ViewValue = NULL;
			}
			$paymentsummary->pay_sum_adv_num->ViewCustomAttributes = "";

			// pay_annual_year
			if (strval($paymentsummary->pay_annual_year->CurrentValue) <> "") {
				$sFilterWrk = "`cal_detail` = '" . ew_AdjustSql($paymentsummary->pay_annual_year->CurrentValue) . "'";
			$sSqlWrk = "SELECT DISTINCT `cal_detail` FROM `subvcalculate`";
			$sWhereWrk = "";
			$lookuptblfilter = "`cal_type` = 3";
			if (strval($lookuptblfilter) <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $lookuptblfilter . ")";
			}
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `cal_detail` Desc";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$paymentsummary->pay_annual_year->ViewValue = $rswrk->fields('cal_detail');
					$rswrk->Close();
				} else {
					$paymentsummary->pay_annual_year->ViewValue = $paymentsummary->pay_annual_year->CurrentValue;
				}
			} else {
				$paymentsummary->pay_annual_year->ViewValue = NULL;
			}
			$paymentsummary->pay_annual_year->ViewCustomAttributes = "";

			// pay_sum_detail
			if (strval($paymentsummary->pay_sum_detail->CurrentValue) <> "") {
				$sFilterWrk = "`cal_detail` = '" . ew_AdjustSql($paymentsummary->pay_sum_detail->CurrentValue) . "'";
			$sSqlWrk = "SELECT DISTINCT `cal_detail` FROM `subvcalculate`";
			$sWhereWrk = "";
			$lookuptblfilter = "`cal_type` = 5";
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
					$paymentsummary->pay_sum_detail->ViewValue = $rswrk->fields('cal_detail');
					$rswrk->Close();
				} else {
					$paymentsummary->pay_sum_detail->ViewValue = $paymentsummary->pay_sum_detail->CurrentValue;
				}
			} else {
				$paymentsummary->pay_sum_detail->ViewValue = NULL;
			}
			$paymentsummary->pay_sum_detail->ViewCustomAttributes = "";

			// pay_sum_total
			$paymentsummary->pay_sum_total->ViewValue = $paymentsummary->pay_sum_total->CurrentValue;
			$paymentsummary->pay_sum_total->ViewCustomAttributes = "";

			// pay_sum_note
			$paymentsummary->pay_sum_note->ViewValue = $paymentsummary->pay_sum_note->CurrentValue;
			$paymentsummary->pay_sum_note->ViewCustomAttributes = "";

			// t_code
			$paymentsummary->t_code->LinkCustomAttributes = "";
			$paymentsummary->t_code->HrefValue = "";
			$paymentsummary->t_code->TooltipValue = "";

			// village_id
			$paymentsummary->village_id->LinkCustomAttributes = "";
			$paymentsummary->village_id->HrefValue = "";
			$paymentsummary->village_id->TooltipValue = "";

			// member_code
			$paymentsummary->member_code->LinkCustomAttributes = "";
			$paymentsummary->member_code->HrefValue = "";
			$paymentsummary->member_code->TooltipValue = "";

			// pay_sum_date
			$paymentsummary->pay_sum_date->LinkCustomAttributes = "";
			$paymentsummary->pay_sum_date->HrefValue = "";
			$paymentsummary->pay_sum_date->TooltipValue = "";

			// pay_sum_type
			$paymentsummary->pay_sum_type->LinkCustomAttributes = "";
			$paymentsummary->pay_sum_type->HrefValue = "";
			$paymentsummary->pay_sum_type->TooltipValue = "";

			// pay_death_begin
			$paymentsummary->pay_death_begin->LinkCustomAttributes = "";
			$paymentsummary->pay_death_begin->HrefValue = "";
			$paymentsummary->pay_death_begin->TooltipValue = "";

			// pay_sum_adv_num
			$paymentsummary->pay_sum_adv_num->LinkCustomAttributes = "";
			$paymentsummary->pay_sum_adv_num->HrefValue = "";
			$paymentsummary->pay_sum_adv_num->TooltipValue = "";

			// pay_annual_year
			$paymentsummary->pay_annual_year->LinkCustomAttributes = "";
			$paymentsummary->pay_annual_year->HrefValue = "";
			$paymentsummary->pay_annual_year->TooltipValue = "";

			// pay_sum_detail
			$paymentsummary->pay_sum_detail->LinkCustomAttributes = "";
			$paymentsummary->pay_sum_detail->HrefValue = "";
			$paymentsummary->pay_sum_detail->TooltipValue = "";

			// pay_sum_total
			$paymentsummary->pay_sum_total->LinkCustomAttributes = "";
			$paymentsummary->pay_sum_total->HrefValue = "";
			$paymentsummary->pay_sum_total->TooltipValue = "";

			// pay_sum_note
			$paymentsummary->pay_sum_note->LinkCustomAttributes = "";
			$paymentsummary->pay_sum_note->HrefValue = "";
			$paymentsummary->pay_sum_note->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($paymentsummary->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$paymentsummary->Row_Rendered();
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $paymentsummary;
		$DeleteRows = TRUE;
		$sSql = $paymentsummary->SQL();
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
				$DeleteRows = $paymentsummary->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['pay_sum_id'];
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $conn->Execute($paymentsummary->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($paymentsummary->CancelMessage <> "") {
				$this->setFailureMessage($paymentsummary->CancelMessage);
				$paymentsummary->CancelMessage = "";
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
				$paymentsummary->Row_Deleted($row);
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
