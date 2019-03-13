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
$creportperson = new creportperson();
$Page =& $creportperson;

// Page init
$creportperson->Page_Init();

// Page main
$creportperson->Page_Main();
if (isset($_GET['xprint'])) $xprint = $_GET["xprint"];
?>
<?php 
if ($xprint != 1){
include_once "header.php";
}
?>


<?php

if ($xprint != 1){
	$_SESSION['print']= $_GET["member_id"];
}

if (! $xprint) $member_id = 	$_GET["member_id"];
else $member_id = $_SESSION['print'];


global $conn;  

			// $member = ew_Execute("SELECT * FROM  members WHERE village_id = ".$vid);
			$info = $conn->Execute("SELECT *, members.member_code as mmcode FROM members LEFT JOIN paymentsummary on (members.member_code =  paymentsummary.member_code) LEFT JOIN paymenttype ON (paymenttype.pt_id = paymentsummary.pay_sum_type) INNER JOIN tambon ON (tambon.t_code = members.t_code) INNER JOIN village ON (village.village_id = members.village_id) WHERE members.member_id = ".$member_id." ORDER BY pay_sum_date DESC");
			
			
			$arr = $info->GetArray();
 

if ($xprint == 1){?>
<font face="Cordia New" size="2">
<?php } ?>
<div class="ewTitle">
<?php if ($xprint != 1){?>
<img src="images/im48x48.png" width="40" height="40" align="absmiddle" />
<?php }?><?php if ($xprint == 1) {?><font size="+3"><center><?php }?>
รายงานสมาชิกภาพรายบุคคล
  <?php if ($xprint == 1) {?></center>
</font><?php }?></div><div class="clear"></div><br />
<?php
if ($xprint != 1){
?>
<a href="reportallmembersmry.php"><?php echo $Language->Phrase("goback") ?></a><br />
	<p>
<a href="reportperson.php?xprint=1" target="_blank"><img src="images/button_print_report.png" width="129" height="37" border="0" /></a>
</p>
<?php } ?>
<?php if ($xprint == 1) {?><font face="Cordia New" size="2"><center><?php }?><strong>ข้อมูลเมื่อวันที่: </strong><?php echo date2Thai(date('Y-m-d'))?><?php if ($xprint == 1) {?></center></font><?php }?><br />

<?php if ($xprint == 1) {?><hr /><?php }?>
<table width="100%" align="center">
  <tr>
    <td align="left"><table width="100%" align="center" cellspacing="0" class="ewGrid">
      <tr>
        <td class="ewGridContent"><table width="100%" border="0" cellpadding="1" cellspacing="1" class="ewTable" <?php if ($xprint == 1) {?> style="padding:5px;"<?php }?>>
          <tr id="r_min_advance_subv6">
            <td width="150" align="left" class="ewTableHeader" <?php if ($xprint == 1) {?> style="border-bottom: dashed 1px #ccc"<?php }?>><strong>รหัสสมาชิก</strong></td>
            <td align="left" <?php if ($xprint == 1) {?> style="border-bottom: dashed 1px #ccc"<?php }?>><strong><?php echo $arr[0]["mmcode"]?></strong></td>
          </tr>
          <tr id="r_max_advance_subv5">
            <td align="left" class="ewTableHeader" <?php if ($xprint == 1) {?> style="border-bottom: dashed 1px #ccc"<?php }?>><strong>ว.ด.ป.ที่สมัคร</strong></td>
            <td align="left" <?php if ($xprint == 1) {?> style="border-bottom: dashed 1px #ccc"<?php }?>><?php echo date2Thai($arr[0]["regis_date"])?></td>
          </tr>
          <tr>
            <td align="left" class="ewTableHeader" <?php if ($xprint == 1) {?> style="border-bottom: dashed 1px #ccc"<?php }?>><strong>ว.ด.ป.ที่มีผล</strong></td>
            <td align="left" <?php if ($xprint == 1) {?> style="border-bottom: dashed 1px #ccc"<?php }?>><?php echo date2Thai($arr[0]["effective_date"])?></td>
          </tr>
          <tr>
            <td align="left" class="ewTableHeader" <?php if ($xprint == 1) {?> style="border-bottom: dashed 1px #ccc"<?php }?>><strong>สถานะสมาชิก</strong></td>
            <td align="left" <?php if ($xprint == 1) {?> style="border-bottom: dashed 1px #ccc"<?php }?>><?php echo $arr[0]["member_status"]?></td>
          </tr>
          </table></td>
      </tr>
    </table>
      <p><strong><u>
      ข้อมูลส่วนตัว</u><br />
    </strong></p>
      <table width="100%" align="center" cellspacing="0" class="ewGrid">
        <tr>
          <td class="ewGridContent"><table width="100%" border="0" cellpadding="1" cellspacing="1" class="ewTable">
            <tr id="r_min_advance_subv5">
              <?php if ($xprint != 1){?>
              <?php } ?>
              <td width="150" align="left" class="ewTableHeader" <?php if ($xprint == 1) {?> style="border-bottom: dashed 1px #ccc"<?php }?>><strong>เลขประจำตัวประชาชน</strong></td>
              <td align="left"<?php if ($xprint == 1) {?> style="border-bottom: dashed 1px #ccc"<?php }?> ><?php echo $arr[0]["id_code"]?></td>
            </tr>
            <tr id="r_max_advance_subv4">
              <td align="left" class="ewTableHeader" <?php if ($xprint == 1) {?> style="border-bottom: dashed 1px #ccc"<?php }?>><strong>เพศ</strong></td>
              <td align="left" <?php if ($xprint == 1) {?> style="border-bottom: dashed 1px #ccc"<?php }?>><?php echo $arr[0]["gender"]?></td>
            </tr>
            <tr>
              <td align="left" class="ewTableHeader" <?php if ($xprint == 1) {?> style="border-bottom: dashed 1px #ccc"<?php }?>><strong>ชื่อ-นามสกุล</strong></td>
              <td align="left" <?php if ($xprint == 1) {?> style="border-bottom: dashed 1px #ccc"<?php }?>><?php echo $arr[0]["prefix"]?><?php echo $arr[0]["fname"]?> <?php echo $arr[0]["lname"]?></td>
            </tr>
            <tr>
              <td align="left" class="ewTableHeader" <?php if ($xprint == 1) {?> style="border-bottom: dashed 1px #ccc"<?php }?>><strong>ว.ด.ป.เกิด</strong></td>
              <td align="left" <?php if ($xprint == 1) {?> style="border-bottom: dashed 1px #ccc"<?php }?>><?php echo ($arr[0]["birthdate"]  ? date2Thai($arr[0]["birthdate"]) : "")?></td>
            </tr>
            <tr>
              <td align="left" class="ewTableHeader" <?php if ($xprint == 1) {?> style="border-bottom: dashed 1px #ccc"<?php }?>><strong>อายุ</strong></td>
              <td align="left" <?php if ($xprint == 1) {?> style="border-bottom: dashed 1px #ccc"<?php }?>><?php echo $arr[0]["age"]?> ปี</td>
            </tr>
            <tr>
              <td align="left" class="ewTableHeader" <?php if ($xprint == 1) {?> style="border-bottom: dashed 1px #ccc"<?php }?>><strong>ที่อยู่</strong></td>
              <td align="left" <?php if ($xprint == 1) {?> style="border-bottom: dashed 1px #ccc"<?php }?>>บ้านเลขที่ <?php echo $arr[0]["address"]?> หมู่ <?php echo $arr[0]["v_code"]?> <?php echo $arr[0]["v_title"]?> ต.<?php echo $arr[0]["t_title"]?> อ.ลี้ จ.ลำพูน</td>
            </tr>
            <tr>
              <td align="left" class="ewTableHeader" <?php if ($xprint == 1) {?> style="border-bottom: dashed 1px #ccc"<?php }?>><strong>เบอร์โทรศัพท์</strong></td>
              <td align="left" <?php if ($xprint == 1) {?> style="border-bottom: dashed 1px #ccc"<?php }?>><?php echo $arr[0]["phone"]?></td>
            </tr>
          </table></td>
        </tr>
      </table>
      <p><br />
        <strong><u>ข้อมูลผู้รับเงินสงเคราะห์</u></strong><br />
      </p>
      <table width="100%" align="center" cellspacing="0" class="ewGrid">
        <tr>
          <td class="ewGridContent"><table width="100%" border="0" cellpadding="1" cellspacing="2" class="ewTable">
            <tr id="r_min_advance_subv4">
              <?php if ($xprint != 1){?>
              <?php } ?>
              <td width="30%" align="center" class="ewTableHeader" <?php if ($xprint == 1) {?> style="border: solid 1px #999"<?php }?>><strong>ผู้รับเงินสงเคราะห์คนที่ 1</strong></td>
              <td width="30%" align="center" class="ewTableHeader"  <?php if ($xprint == 1) {?>style="border: solid 1px #999"<?php }?>><strong>ผู้รับเงินสงเคราะห์คนที่ 2</strong></td>
              <td width="30%" align="center" class="ewTableHeader"  <?php if ($xprint == 1) {?>style="border: solid 1px #999"<?php }?>><strong>ผู้รับเงินสงเคราะห์คนที่ 3</strong></td>
            </tr>
            <tr id="r_max_advance_subv3">
              <td align="center" <?php if ($xprint == 1) {?> style="border: solid 1px #999"<?php }?>><?php echo ($arr[0]["bnfc1_name"] ? $arr[0]["bnfc1_name"]."<br> ความสัมพันธ์ ".$arr[0]["bnfc1_rel"] : "")?><br />
</td>
              <td align="center" <?php if ($xprint == 1) {?> style="border: solid 1px #999"<?php }?>><?php echo ($arr[0]["bnfc2_name"] ? $arr[0]["bnfc2_name"]." <br>ความสัมพันธ์ ".$arr[0]["bnfc2_rel"] : "");?></td>
              <td align="center" <?php if ($xprint == 1) {?> style="border: solid 1px #999"<?php }?>><?php echo ($arr[0]["bnfc3_name"] ? $arr[0]["bnfc3_name"]." <br>ความสัมพันธ์ ".$arr[0]["bnfc3_rel"] : "");?></td>
            </tr>
          </table></td>
        </tr>
      </table>
<br />
<br />
      <strong><u>ข้อมูลเงินสงเคราะห์</u></strong><br />
      <br />
      <table width="100%" align="center" cellspacing="0" class="ewGrid">
        <tr>
          <td class="ewGridContent"><table width="100%" border="0" cellpadding="1" cellspacing="2" class="ewTable">
            <tr id="r_min_advance_subv3">
              <?php if ($xprint != 1){?>
              <?php } ?>
              <td width="390" align="left" class="ewTableHeader" <?php if ($xprint == 1) {?> style="border: solid 1px #999"<?php }?>><strong>ยอดเงินสงเคราะห์ที่จ่ายไปแล้วทั้งหมด</strong></td>
              <td align="center"  <?php if ($xprint == 1) {?>style="border: solid 1px #999;"<?php }?>><?php echo number_format(getAdvanceBudgetAll($arr[0]['mmcode']));?> บาท</td>
              </tr>
            <tr>
              <td align="left" class="ewTableHeader" <?php if ($xprint == 1) {?> style="border: solid 1px #999"<?php }?>><strong>ยอดเงินสงเคราะห์ย้อนหลังที่จ่ายไปแล้ว</strong></td>
              <td align="center"  <?php if ($xprint == 1) {?>style="border: solid 1px #999;"<?php }?>><?php echo number_format(getRcBudgetAll($arr[0]['mmcode']));?> บาท</td>
            </tr>

            <tr id="r_max_advance_subv2">

              <td align="left" class="ewTableHeader" <?php if ($xprint == 1) {?> style="border: solid 1px #999"<?php }?>><strong>ยอดเงินสงเคราะห์ล่วงหน้าคงเหลือ ณ ปัจุบัน</strong></td>
              <td align="center" <?php if ($xprint == 1) {?> style="border: solid 1px #999"<?php }?>><?php echo number_format(getAdvanceBudget($arr[0]['mmcode']));?> บาท</td>
              </tr>
            <tr>
              <td align="left" class="ewTableHeader" <?php if ($xprint == 1) {?> style="border: solid 1px #999"<?php }?>><strong>ยอดเงินสงเคราะห์ล่วงหน้าคงเหลือเมื่อหักค่าสงเคราะห์ศพค้างชำระ</strong></td>
              <td align="center" <?php if ($xprint == 1) {?> style="border: solid 1px #999"<?php }?>><?php echo number_format(getAdvanceBudget($arr[0]['mmcode']) - getUnpayBalance($arr[0]['mmcode'],1));?> บาท</td>
            </tr>
     
          </table></td>
        </tr>
      </table>
  <br />
      <strong><u>ประวัติการชำระเงิน</u></strong>
      <?php

	  if (count($arr[0]) > 0){?>
      <br />
      <br />
      <table width="100%" align="center" cellspacing="0" class="ewGrid">
        <tr>
          <td class="ewGridContent"><table width="100%" border="0" cellpadding="1" cellspacing="2" class="ewTable">
            <tr id="r_min_advance_subv">
              <?php if ($xprint != 1){?>
              <?php } ?>
              <td width="50" align="center" class="ewTableHeader" <?php if ($xprint == 1) {?> style="border: solid 1px #999;"<?php }?>><strong>ลำดับที่</strong></td>
              <td align="center" class="ewTableHeader" <?php if ($xprint == 1) {?> style="border: solid 1px #999;"<?php }?>><strong>วันที่ชำระ</strong></td>
              <td align="center" class="ewTableHeader" <?php if ($xprint == 1) {?> style="border: solid 1px #999;"<?php }?>><strong>รายการ</strong></td>
              <td align="center" class="ewTableHeader" <?php if ($xprint == 1) {?> style="border: solid 1px #999;"<?php }?>><strong>จำนวนเงิน</strong></td>
              <td align="center" class="ewTableHeader" <?php if ($xprint == 1) {?> style="border: solid 1px #999;"<?php }?>><strong>หมายเหตุ</strong></td>
            </tr>
            <?php 
			$total = 0;
			foreach($arr as $key => $value){
				$total += $value["pay_sum_total"];
				if ($value["pay_sum_total"] > 0){
				?>
            <tr id="r_max_advance_subv">
              <?php if ($xprint != 1){?>
              <?php } ?>
              <td align="center" <?php if ($xprint == 1) {?> style="border: solid 1px #999;"<?php }?>><?php echo $key+1?></td>
              <td align="center" <?php if ($xprint == 1) {?> style="border: solid 1px #999;"<?php }?>><?php echo $value["pay_sum_date"]?></td>
              <td <?php if ($xprint == 1) {?> style="border: solid 1px #999;"<?php }?>><?php echo $value["pt_title"];
			  if ($value["pay_sum_type"] == 1) echo " (ศพที่ ".$value["pay_death_begin"]." ".getNameByDeadId($value['pay_death_begin']).")";
			  if ($value["pay_sum_type"] == 2) echo " (งวดที่ ".$value["pay_sum_adv_num"].")";
			  if ($value["pay_sum_type"] == 3) echo " (ปี ".$value["pay_annual_year"].")";
			  if ($value["pay_sum_type"] == 5) echo " (".$value["pay_sum_detail"].")";
			  ?>
</td>
              <td align="right" <?php if ($xprint == 1) {?> style="border: solid 1px #999;"<?php }?>><?php echo number_format($value["pay_sum_total"])?></td>
              <td <?php if ($xprint == 1) {?> style="border: solid 1px #999;"<?php }?>><?php echo $value["pay_sum_note"]?></td>
            </tr>
<?php } ?>
            <?php }?>
                   <?php if ($toal > 0) {?>     <tr>
              <td colspan="3" align="right" <?php if ($xprint == 1) {?> style="border: solid 1px #999;"<?php }?>><strong>รวม</strong></td>
              <td align="right" <?php if ($xprint == 1) {?> style="border: solid 1px #999;"<?php }?>><strong><?php echo number_format($total)?></strong></td>
              <td>&nbsp;</td>
            </tr>
            <?php  } ?>
          </table></td>
        </tr>
      </table>
<?php }  else {echo "ไม่มีประวัติการชำระเงิน";} ?>
  <br />
  <strong><u>รายการค้างชำระ</u></strong>
  <?php 
  
  			$notpay = $conn->Execute("SELECT * FROM unpaylist LEFT JOIN subvcalculate ON (subvcalculate.svc_id =  unpaylist.svc_id) LEFT JOIN paymenttype ON (paymenttype.pt_id = unpaylist.un_pay_type) WHERE un_member_id = ".$member_id." AND member_code IS NOT NULL");

				$notpaylist = $notpay->GetArray();
	
	if (count($notpaylist) > 0){		

  ?>
  <br />
  <br />
      <table width="100%" align="center" cellspacing="0" class="ewGrid">
        <tr>
          <td class="ewGridContent"><table width="100%" border="0" cellpadding="1" cellspacing="2" class="ewTable">
            <tr id="r_min_advance_subv2">
              <td width="50" align="center" class="ewTableHeader" <?php if ($xprint == 1) {?> style="border: solid 1px #999;"<?php }?>><strong>ลำดับที่</strong></td>
              <td align="center" class="ewTableHeader" <?php if ($xprint == 1) {?> style="border: solid 1px #999;"<?php }?>><strong>รายการ</strong></td>
              <td align="center" class="ewTableHeader" <?php if ($xprint == 1) {?> style="border: solid 1px #999;"<?php }?>><strong>จำนวนเงิน</strong></td>
              <td align="center" class="ewTableHeader" <?php if ($xprint == 1) {?> style="border: solid 1px #999;"<?php }?>><strong>สถานะ</strong></td>
              <td align="center" class="ewTableHeader" <?php if ($xprint == 1) {?>style="border: solid 1px #999;" width="60"<?php }?>><strong>ว.ด.ป.<br />
                ที่แจ้งหนี้</strong></td>
              <td  align="center" class="ewTableHeader"  <?php if ($xprint == 1) {?>style="border: solid 1px #999;" width="60"<?php }?>><strong>ว.ด.ป.<br />
                ที่ครบกำหนด</strong></td>
              <td  align="center" class="ewTableHeader"  <?php if ($xprint == 1) {?>style="border: solid 1px #999;" width="60"<?php }?>><strong>ว.ด.ป.<br />
                ที่ส่งหนังสือเตือน</strong></td>
              <td  align="center" class="ewTableHeader"  <?php if ($xprint == 1) {?>style="border: solid 1px #999;" width="60"<?php }?>><strong>ว.ด.ป.<br />
                ที่ครบกำหนด</strong></td>
      
            </tr>
            <?php   
			

			$total = 0;
			foreach ($notpaylist as $key => $value){
				$total += $value["unit_rate"]
				?>
            <tr>
              <td align="center" <?php if ($xprint == 1) {?> style="border: solid 1px #999;"<?php }?>><?php echo ($key+1)?></td>
              <td align="left" <?php if ($xprint == 1) {?> style="border: solid 1px #999;"<?php }?>><?php echo $value["pt_title"];
			  if ($value["un_pay_type"] == 1) echo " (ศพที่ ".$value["member_code"]." ".getNameById($value['member_code']).")";
			  if ($value["un_pay_type"] == 2) echo " (งวดที่ ".$value["adv_num"].")";
			  if ($value["un_pay_type"] == 3) echo " (ปี ".$value["cal_detail"].")";
			  if ($value["un_pay_type"] == 5) echo " (".$value["cal_detail"].")";
			  ?></td>
              <td align="right" <?php if ($xprint == 1) {?> style="border: solid 1px #999;"<?php }?>><?php echo number_format($value["unit_rate"])?></td>
              <td align="center" <?php if ($xprint == 1) {?> style="border: solid 1px #999;"<?php }?>><?php echo $value["cal_status"]?></td>
              <td align="center" <?php if ($xprint == 1) {?> style="border: solid 1px #999;"<?php }?>><?php echo $value["invoice_senddate"]?></td>
              <td align="center" <?php if ($xprint == 1) {?> style="border: solid 1px #999;"<?php }?>><?php echo $value["invoice_duedate"]?></td>
              <td align="center" <?php if ($xprint == 1) {?> style="border: solid 1px #999;"<?php }?>><?php echo $value["notice_senddate"]?></td>
              <td align="center" <?php if ($xprint == 1) {?> style="border: solid 1px #999;"<?php }?>><?php echo $value["notice_duedate"]?></td>
            </tr>
           
          <?php }
		  ?> 
           <tr>
              <td colspan="2" align="right" <?php if ($xprint == 1) {?> style="border: solid 1px #999;"<?php }?>><strong>รวม</strong></td>
              <td align="right" <?php if ($xprint == 1) {?> style="border: solid 1px #999;"<?php }?>><strong><?php echo number_format($total)?></strong></td>
              <td align="left">&nbsp;</td>
              <td align="left">&nbsp;</td>
              <td align="left">&nbsp;</td>
              <td align="left">&nbsp;</td>
              <td align="left">&nbsp;</td>
            </tr>
          </table>
          <?php } else echo "ไม่มีรายการคางชำระ"; // count?>
          </td>
        </tr>
      </table>
    </td>
  </tr>
</table>
<?php
if ($xprint == 1){?>
</font>
<?php } ?>
<br />
<?php 

if ($xprint != 1){
include_once "footer.php";
}
if ($xprint == 1){
//addSliptNumber();	
?>
<script language="javascript">window.print();
window.close();
</script>
<?php }

?>

<?php
$creportperson->Page_Terminate();
?>
<?php

//
// Page class
//
class creportperson {

	// Page ID
	var $PageID = 'creportperson';

	// Page object name
	var $PageObjName = 'creportperson';

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
	function creportperson() {
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
