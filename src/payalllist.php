<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "administratorinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$cpayalllist = new cpayalllist();
$Page =& $cpayalllist;

// Page init
$cpayalllist->Page_Init();

// Page main
$cpayalllist->Page_Main();

?>
<?php 

include_once "header.php";

?>
<script type="text/javascript">
var cpayalllist = new ew_Page("cpayalllist");

// page properties
cpayalllist.PageID = "edit"; // page ID
cpayalllist.FormID = "fpayall"; // form ID
var EW_PAGE_ID = cpayalllist.PageID; // for backward compatibility
// extend page with Form_CustomValidate function
cpayalllist.Form_CustomValidate =  function(fobj) { // DO NOT CHANGE THIS LINE!
	// Your custom validation code here, return false if invalid. 

	var total = 0;

		if (fobj.elements[0].value == 0) total +=1;
		if (fobj.elements[1].value == 0) total +=1;
		if (fobj.elements[2].value == 0) total +=1;
		if (fobj.elements[3].value == 0) total +=1;
		if (fobj.elements[4].value == 0) total +=1;
		//if (fobj.elements['regis_pay'].checked == false) total +=1;

	if (total == 5) return ew_OnError(this, fobj.elements["dead_id"], "โปรดระบุรายการที่จะชำระ");
	
	return true;                                                                      
}  

//-->
</script>


<?php

global $conn;  

$allmember = getMemberList('ปกติ');
$setting = getSetting();

//print_r($allmember);


if (count($allmember) > 0){ 
$speed = speedCheck("INSERT INTO paymentsummary 
				(t_code, village_id, member_code, pay_sum_type, pay_sum_total, pay_death_begin, pay_sum_date)
				VALUES ('1',1,1,1,1,1,'1111-11-11')");
$time =  round(($speed * count($allmember)/60),2);
?>

<script language="javascript">alert('คำเตือน! ระบบต้องใช้เวลาสำหรับการชำระแต่ละรายการประมาณ '+<?php echo $time;?>+' นาที หากจำนวนสมาชิกมีมาก โปรดใช้การชำระทีละหมู่บ้านเพื่อลดเวลาในการประมวลผล')</script>
		
<?php if ($_POST['dead_id']){
	
	$conn->Execute("DELETE FROM paymentsummary WHERE pay_death_begin = ".$_POST["dead_id"]);
		
		$varr = ""; 
		
		foreach ($allmember as $value){
				

		$varr .=",('".$value['t_code']."',".$value['village_id'].",'".$value['member_code']."','1',".$setting[0]['subvention_rate'].",'".$_POST['dead_id']."','".date('Y-m-d')."')";
			
			$svc_id = ew_ExecuteScalar("SELECT svc_id FROM subvcalculate WHERE village_id = ".$value['village_id']." AND member_code = '".getDeadMemberCodeByDeadId($_POST['dead_id'])."'");
				
			updateSubvention(getMemberIdByCode($value['member_code']),$svc_id); 
		
		
		} // end for
		
		   		$conn->Execute("INSERT INTO paymentsummary 
				(t_code, village_id, member_code, pay_sum_type, pay_sum_total, pay_death_begin, pay_sum_date)
				VALUES ".substr($varr,1)); 
		
	} // end if dead_id*/
	
//if (payCheckDup($value['member_code'],$_POST)){ 
		
		
		
		if ($_POST['adv_num']){
		
		$conn->Execute("DELETE FROM paymentsummary WHERE pay_sum_adv_num = ".$_POST["adv_num"]); 
		$varr = ""; 
		
		foreach ($allmember as $value){
			
			
		
		$varr .=",('".$value['t_code']."',".$value['village_id'].",'".$value['member_code']."','2',".($setting[0]['max_advance_subv']*$setting[0]['subvention_rate']).",'".$_POST['adv_num']."','".date('Y-m-d')."')";
			
				$svc_id = ew_ExecuteScalar("SELECT svc_id FROM subvcalculate WHERE village_id = ".$value['village_id']." AND adv_num = '".$_POST['adv_num']."'");
							
				updateSubvention(getMemberIdByCode($value['member_code']),$svc_id);
			

		
		} // end for
		
				$conn->Execute("INSERT INTO paymentsummary 
				(t_code, village_id, member_code, pay_sum_type, pay_sum_total, pay_sum_adv_num, pay_sum_date)
				VALUES ".substr($varr,1));
		
	    
		} // end if adv_num
		  
		  
		  
		if ($_POST['annual_year']){
				
		$conn->Execute("DELETE FROM paymentsummary WHERE pay_annual_year = ".$_POST["annual_year"]); 	
		$varr = ""; 
		
		foreach ($allmember as $value){
			
			
			
		$varr .=",('".$value['t_code']."',".$value['village_id'].",'".$value['member_code']."','3',".$setting[0]['annual_rate'].",'".$_POST['annual_year']."','".date('Y-m-d')."')";
		
				$svc_id = ew_ExecuteScalar("SELECT svc_id FROM subvcalculate WHERE village_id = ".$value['village_id']." AND cal_detail = '".$_POST['annual_year']."'");
				
				updateSubvention(getMemberIdByCode($value['member_code']),$svc_id);
				
		
		} // end for
				
				
				$conn->Execute("INSERT INTO paymentsummary 
				(t_code, village_id, member_code, pay_sum_type, pay_sum_total, pay_annual_year, pay_sum_date)
				VALUES ".substr($varr,1));
								
								
		} // end if annual_year
		
		
		
		
		if ($_POST['regis_pay']){
			
		$conn->Execute("DELETE FROM paymentsummary WHERE pay_sum_type = 4");			
		$varr = ""; 
		
		foreach ($allmember as $value){
			
			
			$varr .=",('".$value['t_code']."',".$value['village_id'].",'".$value['member_code']."','4',".$setting[0]['regis_rate'].",'".$_POST['annual_year']."','".date('Y-m-d')."')";
			
			
				$svc_id = ew_ExecuteScalar("SELECT svc_id FROM subvcalculate WHERE village_id = ".$value['village_id']." AND cal_type = 4");
			
				updateSubvention(getMemberIdByCode($value['member_code']),$svc_id);
				
				
		} // end for 
		
				$conn->Execute("INSERT INTO paymentsummary 
				(t_code, village_id, member_code, pay_sum_type, pay_sum_total, pay_annual_year, pay_sum_date)
				VALUES ".substr($varr,1));
				
				
		} // end regis_pay
		
		
		if ($_POST['rc_pay']){
			
		$conn->Execute("DELETE FROM paymentsummary WHERE pay_sum_type = 6");			
		$varr = ""; 
		
		foreach ($allmember as $value){
			
			
			$varr .=",('".$value['t_code']."',".$value['village_id'].",'".$value['member_code']."','6',".$setting[0]['regis_rate'].",'".$_POST['annual_year']."','".date('Y-m-d')."')";
			
			
				$svc_id = ew_ExecuteScalar("SELECT svc_id FROM subvcalculate WHERE village_id = ".$value['village_id']." AND cal_type = 6");
			
				updateSubvention(getMemberIdByCode($value['member_code']),$svc_id);
				
				
		} // end for 
		
				$conn->Execute("INSERT INTO paymentsummary 
				(t_code, village_id, member_code, pay_sum_type, pay_sum_total, pay_annual_year, pay_sum_date)
				VALUES ".substr($varr,1));
				
				
		} // end rc_pay
		
		
		
		
		if ($_POST['other_detail']){
					
			
		$varr = ""; 
		
		foreach ($allmember as $value){
			
			$total = ew_ExecuteScalar("SELECT unit_rate FROM subvcalculate WHERE cal_detail = '".$_POST['other_detail']."'");
			
		
			$varr .=",('".$value['t_code']."',".$value['village_id'].",'".$value['member_code']."','5',".$total.",'".$_POST['other_detail']."','".date('Y-m-d')."')";
						
			
			$svc_id = ew_ExecuteScalar("SELECT svc_id FROM subvcalculate WHERE village_id = ".$value['village_id']." AND cal_detail = '".$_POST['other_detail']."'");
			
			updateSubvention(getMemberIdByCode($value['member_code']),$svc_id);
			
			
			
		} // end for
		
				$conn->Execute("INSERT INTO paymentsummary 
				(t_code, village_id, member_code, pay_sum_type, pay_sum_total, pay_sum_detail, pay_sum_date)
				VALUES ".substr($varr,1));
			
		} // end other_detail
		
		
		
	/*if ($_POST['dead_id']) calculatesubvention2(getDeadMemberCodeByDeadId($_POST['dead_id']),true); 
	if ($_POST['adv_num']) calculateAdvSubv($_POST['adv_num']);
	if ($_POST['annual_year'])  calculateAnnualfee($_POST['annual_year']);
	if ($_POST['regis_pay'])  calculateRegis();
	if ($_POST['other_detail'])  calculateOther($_POST['other_detail'],getRateByDetail($_POST['other_detail'])); */
	

	
	//  }// end check dup

} // end if member > 0

if ($_POST['btnAction']) header("location:paymentsummarylist.php?cmd=resetall");		
?>
<div class="ewTitle"><img src="images/ico_payall.png" width="40" height="40" align="absmiddle" />ชำระเงินให้กับสมาชิกทุกราย</div><div class="clear"></div><br />


<form name="fpayall" id="fpayall" action="<?php echo ew_CurrentPage() ?>" method="post" enctype="multipart/form-data" onsubmit="return cpayalllist.Form_CustomValidate(this);">
  <table width="100%" border="0" cellspacing="0" class="ewGrid">
    <tr>
      <td class="ewGridContent"><div class="ewGridMiddlePanel">

      <table width="100%" border="1" cellpadding="3" cellspacing="3" class="ewTable">
        <tr id="r_min_advance_subv">
            <td width="200" align="left" class="ewTableHeader">ค่าสงเคราะห์ศพ</td>
            <td width="100" align="right">ศพที่:</td>
            <td align="left"><select name="dead_id" id="dead_id">
              <option value="0">--------------------------</option>
             <?php echo createOptionList("SELECT DISTINCT subvcalculate.member_code, members.fname, members.lname, members.dead_id FROM subvcalculate LEFT JOIN members ON (subvcalculate.member_code = members.member_code) WHERE subvcalculate.cal_type = 1",'dead_id','fname','lname')?>
            </select></td>
            </tr>
        <tr>
          <td align="left" class="ewTableHeader">ค่าสงเคราะห์ศพล่วงหน้า</td>
          <td align="right">งวดที่:</td>
          <td align="left"><select name="adv_num" id="adv_num">
            <option value="0">-----------</option>
		<?php echo createOptionList("SELECT DISTINCT adv_num FROM subvcalculate WHERE adv_num > 0",'adv_num')?>
          </select></td>
        </tr>
        <tr>
          <td align="left" class="ewTableHeader">ค่าสงเคราะห์ศพย้อนหลัง</td>
          <td align="right">จำนวน:</td>
          <td align="left">          <select name="rc_pay" id="rc_pay">
          <option value="0">-----------</option>
                      <?php echo createOptionList("SELECT DISTINCT unit_rate FROM subvcalculate WHERE  cal_type = 6",'unit_rate')?>
          </select> บาท</td>
        </tr>
        <tr>
          <td align="left" class="ewTableHeader">ค่าบำรุงประจำปี</td>
          <td align="right">ปี พ.ศ.:</td>
          <td align="left"><select name="annual_year" id="annual_year">
            <option value="0">-----------</option>
            <?php echo createOptionList("SELECT DISTINCT cal_detail FROM subvcalculate WHERE cal_detail != '' AND cal_type = 3",'cal_detail')?>
          </select></td>
        </tr>
        <tr>
          <td align="left" class="ewTableHeader">ค่าสมัครสมาชิก</td>
          <td align="right">จำนวน:</td>
          <?php $setting = getSetting();?> 
          <td align="left">
          <select name="regis_pay" id="regis_pay">
          <option value="0">--------------------------</option>
                      <?php echo createOptionList("SELECT DISTINCT unit_rate FROM subvcalculate WHERE  cal_type = 4",'unit_rate')?>
          </select>
         <!-- <input name="regis_pay" type="checkbox" id="regis_pay" value="1" /><?php echo $setting[0]['regis_rate']?> --> บาท</td>
        </tr>
        <tr>
          <td align="left" class="ewTableHeader">อื่นๆ</td>
          <td align="right">ค่า:            </td>
          <td align="left"><select name="other_detail" id="other_detail">
          <option value="0">--------------------------</option>
                      <?php echo createOptionList("SELECT DISTINCT cal_detail FROM subvcalculate WHERE cal_detail != '' AND cal_type = 5",'cal_detail')?>
          </select></td>
        </tr>
        </table> 
      </div></td>
    </tr>
  </table>
  <br />
  <input name="addother" type="hidden" id="addother" value="1" />


  <input type="submit" name="btnAction" id="btnAction" value="ชำระเงิน"/>
</form>
<!-- Put your custom html here -->


<?php 

include_once "footer.php";

$cpayalllist->Page_Terminate();
?>
<?php

//
// Page class
//
class cpayalllist {

	// Page ID
	var $PageID = 'cpayalllist';

	// Page object name
	var $PageObjName = 'cpayalllist';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
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
		if ($sMessage <> "") { // Message in Session, display
			echo "<p class=\"ewMessage\">" . $sMessage . "</p>";
			$_SESSION[EW_SESSION_MESSAGE] = ""; // Clear message in Session
		}

		// Success message
		$sSuccessMessage = $this->getSuccessMessage();
		if ($sSuccessMessage <> "") { // Message in Session, display
			echo "<p class=\"ewSuccessMessage\">" . $sSuccessMessage . "</p>";
			$_SESSION[EW_SESSION_SUCCESS_MESSAGE] = ""; // Clear message in Session
		}

		// Failure message
		$sErrorMessage = $this->getFailureMessage();
		if ($sErrorMessage <> "") { // Message in Session, display
			echo "<p class=\"ewErrorMessage\">" . $sErrorMessage . "</p>";
			$_SESSION[EW_SESSION_FAILURE_MESSAGE] = ""; // Clear message in Session
		}
	}

	//
	// Page class constructor
	//
	function cpayalllist() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// User table object (administrator)
		if (!isset($GLOBALS["administrator"])) $GLOBALS["administrator"] = new cadministrator;

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'slipview', TRUE);

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
		global $Report1;

		// Security
		$Security = new cAdvancedSecurity();

		// Uncomment codes below for security

		
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if (!$Security->IsLoggedIn())
			$this->Page_Terminate("login.php");
		

		// Global Page Loading event (in userfn*.php)
		Page_Loading();
	}

	//
	// Page_Terminate
	//
	function Page_Terminate($url = "") {
		global $conn;

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();

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

	//
	// Page main
	//
	function Page_Main() {
		global $Security, $Language;

		//$this->setSuccessMessage("Welcome " . CurrentUserName());
		// Put your custom codes here
		
	}

}
?>

