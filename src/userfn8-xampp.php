<?php

// Global user functions
// Page Loading event
function Page_Loading() {
   // echo "Page Loading";    
	
}                   

							   
								  

// Page Unloaded event
function Page_Unloaded() {

	//echo "Page Unloaded";
}

        function getAdvanceBudget($mid){                                      
				$total = ew_ExecuteScalar("SELECT sum(pay_sum_total) FROM  paymentsummary WHERE member_code = '".$mid."' AND pay_sum_type = 2 GROUP BY pay_sum_type "); 
				$pay = ew_ExecuteScalar("SELECT sum(pay_sum_total) FROM  paymentsummary WHERE member_code = '".$mid."' AND pay_sum_type = 1 GROUP BY pay_sum_type ");
				if (!$pay) $pay = 0;                                                                                              
				return ($total-$pay);
		}  
		
		 function getAdvanceBudgetAll($mid){                                      
				$total = ew_ExecuteScalar("SELECT sum(pay_sum_total) FROM  paymentsummary WHERE member_code = '".$mid."' AND pay_sum_type = 2 GROUP BY pay_sum_type "); 
                                                                                              
				return $total;
		}  
		
		function getUnpayBalance($code,$type = false){ 
		
		if ($type) $cond = " AND unpaylist.un_pay_type = ".$type;
		
				$total = ew_ExecuteScalar("SELECT SUM(unit_rate) FROM unpaylist LEFT JOIN subvcalculate ON (subvcalculate.svc_id =  unpaylist.svc_id) LEFT JOIN paymenttype ON (paymenttype.pt_id = unpaylist.un_pay_type) WHERE un_member_id = ".getMemberIdByCode($code)." ".$cond); 
                                                                                              
				
				return $total;
		}  

		function subventionPaid($mid, $did){
			  $count = ew_ExecuteScalar("SELECT pay_death_begin FROM  paymentsummary WHERE member_code = '".$mid."' AND pay_death_begin = ".$did." AND pay_sum_type = 1");   
			  if ($count > 0) return TRUE;             
			  else return FALSE; 
		}                  

		function getDeadIdByMember($member_code){
			
			  $dead_id = ew_ExecuteScalar("SELECT dead_id FROM  members WHERE member_code = '".$member_code."'");
			  return $dead_id;        
			
		}
		
		function getDeadMemberCodeByDeadId($dead_id){
			
			  $dead_id = ew_ExecuteScalar("SELECT member_code FROM  members WHERE dead_id = '".$dead_id."'");
			  return $dead_id;        
			
		}
			
			
		function getNameById($mid){
		
			 $prefix = ew_ExecuteScalar("SELECT prefix FROM  members WHERE member_code = '".$mid."'");
			 $fname = ew_ExecuteScalar("SELECT fname FROM  members WHERE member_code = '".$mid."'");
			 $lname = ew_ExecuteScalar("SELECT lname FROM  members WHERE member_code = '".$mid."'");
			  return $prefix."".$fname." ".$lname;                                         
		} 
		
		
	 function getName($mid){
		
			 $prefix = ew_ExecuteScalar("SELECT prefix FROM  members WHERE member_id = '".$mid."'");
			 $fname = ew_ExecuteScalar("SELECT fname FROM  members WHERE member_id = '".$mid."'");
			 $lname = ew_ExecuteScalar("SELECT lname FROM  members WHERE member_id = '".$mid."'");
			  return $prefix."".$fname." ".$lname;                                         
		} 
		
		function getMemberCodeById($mid){
		
		
			 $mid = ew_ExecuteScalar("SELECT member_code FROM  members WHERE member_id = '".$mid."'");
			 return $mid;                                          
		} 
		
		
		
		function getMemberIdByCode($code){
		
			 $mid = ew_ExecuteScalar("SELECT member_id FROM  members WHERE member_code = '".$code."'");
			 return $mid;                                         
		} 
		
		function getNameByDeadId($id){
			 $prefix = ew_ExecuteScalar("SELECT prefix FROM  members WHERE dead_id = ".$id);
			 $fname = ew_ExecuteScalar("SELECT fname FROM  members WHERE dead_id = ".$id);
			 $lname = ew_ExecuteScalar("SELECT lname FROM  members WHERE dead_id = ".$id);
			  return $prefix."".$fname." ".$lname;                                         
		}                                   

		function getMemberByVillage($vid){
			global $conn;  

			// $member = ew_Execute("SELECT * FROM  members WHERE village_id = ".$vid);
			 $member = $conn->Execute("SELECT * FROM  members WHERE village_id = ".$vid." AND member_status != 'เสียชีวิต' AND  member_status != 'ลาออก' AND member_status != 'พ้นสภาพ'");
				$arr = $member->GetArray();
			return $arr;    
		}
		
		
		
		function getMemberList($status){
			
			global $conn;  

			// $member = ew_Execute("SELECT * FROM  members WHERE village_id = ".$vid);
			$member = $conn->Execute("SELECT * FROM  members WHERE member_status = '".$status."'");
			$arr = $member->GetArray();
			return $arr;
			
		}
		
		function getSetting(){
			
			global $conn;  

			// $member = ew_Execute("SELECT * FROM  members WHERE village_id = ".$vid);
			$member = $conn->Execute("SELECT * FROM  setting");
			$arr = $member->GetArray();
			return $arr;
			
		}
		                                                                  
		function getAllMember(){
			
			global $conn;
			
			 $all = ew_ExecuteScalar("SELECT count(member_id) FROM  members");
			 if ($all > 0) return $all;   
			 else return 0;
		}
		
		function getSubvRate(){
			
			global $conn;
			
			 $value = ew_ExecuteScalar("SELECT subvention_rate FROM  setting WHERE 1");
			 if ($value > 0) return $value;   
			 else return 0;
		}
		
		
		function getSubvTotal(){
			
			$setting = getSetting();
			$rate = getSubvRate();
			$all = getAliveTotal();
			$total = ($rate * $all);
			
			if ($setting[0]['max_subvention'] > 0){
				if ($total > $setting[0]['max_subvention']) $total = $setting[0]['max_subvention']; 
			}
			
			if ($total > 0) return $total;   
			else return 0;
		}
		
		function getAsscPercent(){
			
			global $conn;
			
			 $value = ew_ExecuteScalar("SELECT assc_percent FROM  setting WHERE 1");
			 if ($value > 0) return $value;   
			 else return 0;
		}
		
		function getAsscTotal(){
			
			$per = getAsscPercent();
			$subtotal = getSubvTotal();
			$total = ($per * $subtotal)/100;
			
			if ($total > 0) return $total;   
			else return 0;
		}
		
		function getBnfcTotal(){
			
			$ass = getAsscTotal();
			$subtotal = getSubvTotal();
			$total = ($subtotal - $ass);
			
			if ($total > 0) return $total;   
			else return 0;
		}
		
		function getAliveTotal(){
			
			global $conn;
			
			 $value = ew_ExecuteScalar("SELECT count(member_id) FROM  members WHERE member_status = 'ปกติ'");
			 if ($value > 0) return $value;   
			 else return 0;
		}
		
		function getDeadTotal(){
			
			global $conn;
			
			 $value = ew_ExecuteScalar("SELECT count(member_id) FROM  members WHERE member_status = 'เสียชีวิต'");
			 if ($value > 0) return $value;   
			 else return 0;
		}
		function getResignTotal(){
			
			global $conn;
			
			 $value = ew_ExecuteScalar("SELECT count(member_id) FROM  members WHERE member_status = 'ลาออก'");
			 if ($value > 0) return $value;   
			 else return 0;
		}
		function getTerminateTotal(){
			
			global $conn;
			
			 $value = ew_ExecuteScalar("SELECT count(member_id) FROM  members WHERE member_status = 'พ้นสภาพ'");
			 if ($value > 0) return $value;   
			 else return 0;
		}

		function getCanPay(){
			
			
			$arrmem = getMemberList("ปกติ");
			
			$total = 0;
			
			foreach ($arrmem as $value) {
    			$budget = getAdvanceBudget($value["member_code"]);
				if ($budget > 10) $total+= 1;
				//CurrentPage()->setMessage($budget);
			}
			
			if ($total > 0) return $total;   
			else return 0;
		}
		
		function getCantPay(){
			
			
			$alive = getAliveTotal();
			$can = getCanPay();
			
			$total = ($alive - $can);
			
			if ($total > 0) return $total;   
			else return 0;
		}
		
		function getCantPayDetail(){
			
			if (getCantPay() > 0){
				
				return 'เงินสงเคราะห์ล่วงหน้าไม่พอจ่าย';	
			}else {
				return '';	
			}
			
			
		}
		function getPayType($payid){
			
			global $conn;
			
			 $value = ew_ExecuteScalar("SELECT pay_sum_type FROM  paymentsummary WHERE pay_sum_id = $payid");
			 if ($value > 0) return $value;   
			 else return 0;
		}
		
		function villageCheck($list){
			global $conn;

			$l = implode(',',$list['key_m']);
		
			$rs = $conn->Execute("SELECT DISTINCT village_id FROM paymentsummary WHERE pay_sum_id IN (".$l.")");
			$arr = $rs->GetArray();
			$row = count($arr);
			if ($row != 1) return false;
			else return true;
			
		}
		
		function subvcalvillageCheck($list){
			global $conn;

			$l = implode(',',$list['key_m']);
		
			$rs = $conn->Execute("SELECT DISTINCT village_id FROM subvcalculate WHERE svc_id IN (".$l.")");
			$arr = $rs->GetArray();
			$row = count($arr);
			if ($row != 1) return false;
			else return true;
			
		}
		
		function getPayCount($paytypeid,$list){

			$l = implode(',',$list['key_m']);
		//	echo $l;
			

			
			$paycount = ew_ExecuteScalar("SELECT count(pay_sum_id) FROM  paymentsummary WHERE pay_sum_id IN (".$l.") AND pay_sum_type = ".$paytypeid." ");

			return $paycount;
		}
		

		function getPayOtherCount($paytypeid,$list,$detail){

			$l = implode(',',$list['key_m']);
		//	echo $l;
			

			
			$paycount = ew_ExecuteScalar("SELECT count(pay_sum_id) FROM  paymentsummary WHERE pay_sum_id IN (".$l.") AND pay_sum_type = ".$paytypeid." AND pay_sum_detail = '".$detail."'");

			return $paycount;
		}
		
		

function getPayAnnualCount($paytypeid,$list,$year){

			$l = implode(',',$list['key_m']);
		//	echo $l;
			

			
			$paycount = ew_ExecuteScalar("SELECT count(pay_sum_id) FROM  paymentsummary WHERE pay_sum_id IN (".$l.") AND pay_sum_type = ".$paytypeid." AND pay_annual_year = ".$year);

			return $paycount;
		}


function getPayRegisCount($paytypeid,$list){

			$l = implode(',',$list['key_m']);
		//	echo $l;
			

			
			$paycount = ew_ExecuteScalar("SELECT count(pay_sum_id) FROM  paymentsummary WHERE pay_sum_id IN (".$l.") AND pay_sum_type = ".$paytypeid);

			return $paycount;
}
		
		function getPayDeadCount($paytypeid,$list,$did){

			$l = implode(',',$list['key_m']);
		//	echo $l;
			

			
			$paycount = ew_ExecuteScalar("SELECT count(pay_sum_id) FROM  paymentsummary WHERE pay_sum_id IN (".$l.") AND pay_sum_type = ".$paytypeid." AND pay_death_begin = ".$did);

			return $paycount;
		}
		
		
	function getPayAdvCount($paytypeid,$list,$num){

			$l = implode(',',$list['key_m']);
		//	echo $l;
			

			
			$paycount = ew_ExecuteScalar("SELECT count(pay_sum_id) FROM  paymentsummary WHERE pay_sum_id IN (".$l.") AND pay_sum_type = ".$paytypeid." AND pay_sum_adv_num = ".$num);

			return $paycount;
		}
		
		function getPayList($paytypeid,$list){


			global $conn;
			
			$l = implode(',',$list['key_m']);
			
			$paylist = $conn->Execute("SELECT member_code FROM  paymentsummary WHERE pay_sum_id IN (".$l.") AND pay_sum_type = ".$paytypeid." ");
			
			$arr = $paylist->GetArray();

			$pl = "";

			foreach($arr as $key => $value){

				
				if ($key != 0) $pl .= ", ".$value['member_code'];
				else $pl .= $value['member_code'];
				
			}
			 

			return $pl;
		}
		
				
		function getPayDeadList($paytypeid,$list,$did){


			global $conn;
			
			$l = implode(',',$list['key_m']);
			
			$paylist = $conn->Execute("SELECT member_code FROM  paymentsummary WHERE pay_sum_id IN (".$l.") AND pay_sum_type = ".$paytypeid." AND pay_death_begin = ".$did);
			
			
			$arr = $paylist->GetArray();

			$pl = "";

			foreach($arr as $key => $value){

				
				if ($key != 0) $pl .= ", ".$value['member_code'];
				else $pl .= $value['member_code'];
				
			}

			return $pl;
		}
		
		function getPayAdvList($paytypeid,$list,$num){


			global $conn;
			
			$l = implode(',',$list['key_m']);
			
			$paylist = $conn->Execute("SELECT member_code FROM  paymentsummary WHERE pay_sum_id IN (".$l.") AND pay_sum_type = ".$paytypeid." AND pay_sum_adv_num = ".$num);
			
			$arr = $paylist->GetArray();

			$pl = "";

			foreach($arr as $key => $value){

				
				if ($key != 0) $pl .= ", ".$value['member_code'];
				else $pl .= $value['member_code'];
				
			}
			 

			return $pl;
		}
		
		function getPayOtherList($paytypeid,$list,$detail){


			global $conn;
			
			$l = implode(',',$list['key_m']);
			
			$paylist = $conn->Execute("SELECT member_code FROM  paymentsummary WHERE pay_sum_id IN (".$l.") AND pay_sum_type = ".$paytypeid." AND pay_sum_detail = '".$detail."'");
			
			
			$arr = $paylist->GetArray();

			$pl = "";

			foreach($arr as $key => $value){

				
				if ($key != 0) $pl .= ", ".$value['member_code'];
				else $pl .= $value['member_code'];
				
			}
			 

			return $pl;
		}
		
		
		function getPayAnnualList($paytypeid,$list,$year){


			global $conn;
			
			$l = implode(',',$list['key_m']);
			
			$paylist = $conn->Execute("SELECT member_code FROM  paymentsummary WHERE pay_sum_id IN (".$l.") AND pay_sum_type = ".$paytypeid." AND pay_annual_year = ".$year);
			
			$arr = $paylist->GetArray();

			$pl = "";

			foreach($arr as $key => $value){

				
				if ($key != 0) $pl .= ", ".$value['member_code'];
				else $pl .= $value['member_code'];
				
			}
			 

			return $pl;
		}
		
function getPayRegisList($paytypeid,$list){


			global $conn;
			
			$l = implode(',',$list['key_m']);
			
			$paylist = $conn->Execute("SELECT member_code FROM  paymentsummary WHERE pay_sum_id IN (".$l.") AND pay_sum_type = ".$paytypeid);
			
			$arr = $paylist->GetArray();

			$pl = "";

			foreach($arr as $key => $value){

				
				if ($key != 0) $pl .= ", ".$value['member_code'];
				else $pl .= $value['member_code'];
				
			}
			 

			return $pl;
		}
		
		function getTambonInfo($tcode){
			
			
			global $conn;
			
			$info = $conn->Execute("SELECT * FROM  tambon WHERE t_code = '".$tcode."'");
			 
			 return $info->GetArray();   
			 
			 
			 
		}
				
		function getTambonCode($member_id){
		
			 $mid = ew_ExecuteScalar("SELECT t_code FROM members WHERE member_id = ".$member_id);
			 return $mid;                                         
		}
		
		
	   function getVillageId($member_id){
		
			 $mid = ew_ExecuteScalar("SELECT village_id FROM members WHERE member_id = ".$member_id);
			 return $mid;                                         
		}
		
		function getVillageInfo($vid){
			global $conn;
			
			 $info = $conn->Execute("SELECT * FROM  village WHERE village_id = '".$vid."'");
			 
			 return $info->GetArray();   
			 
		}
		
		
function createSlipt($list){
	
	   $setting = getSetting();

 global $conn;
		
			$l = implode(',',$list['key_m']);
			
			$rs = $conn->Execute("SELECT *  FROM paymentsummary LEFT JOIN paymenttype ON (paymenttype.pt_id = paymentsummary.pay_sum_type) WHERE pay_sum_id IN (".$l.") GROUP BY pay_sum_type, pay_sum_adv_num, pay_death_begin, pay_annual_year");
			
			$arr = $rs->GetArray();

			
?>

<div id="slipt">
<font face="Cordia New" size="2">
  <table width="100%" align="center">
    <tr>
      <td width="200" align="left">เล่มที่ 1</td>
      <td align="center"><img src="upload/<?php echo $setting[0]["logo"]?>" alt="" width="131" height="139" vspace="10" /></td>
      <td width="200" align="right">เลขที่ <?php echo str_pad(getSliptNumber(), 5, "0", STR_PAD_LEFT);?></td>
    </tr>
    <tr>
      <td colspan="3" align="center"><strong><br />
        ใบเสร็จรับเงิน<br />
        ชมรมฌาปนกิจสงเคราะห์สมาชิกเครือข่ายกองทุนหมุ่บ้านอำเภอลี้<br />
อำเภอลี้   จังหวัดลำพูน</strong></td>
    </tr>
    <tr>
      <td colspan="3" align="left">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="3" align="right">วันที่ <?php echo date('d');?> เดือน <?php echo thaiMonth(date('n'));?> พ.ศ <?php echo  thaiYear(date('Y'));?></td>
    </tr>
    <tr>
    <?php $tinfo = getTambonInfo($arr[0]['t_code']); $vinfo = getVillageInfo($arr[0]['village_id']);?>
      <td colspan="3" align="left"><strong>นาม</strong> ประธานกองทุนหมู่บ้าน <br />
        <strong>ที่อยู่</strong> ตำบล <?php echo $tinfo[0]['t_title']." หมู่ ".$vinfo[0]['v_code']." ".$vinfo[0]['v_title'];?></td>
    </tr>
    <tr>
      <td colspan="3" align="left">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="3" align="left"><table width="100%" border="0" cellpadding="3" cellspacing="2">
        <tr>
          <td width="72" rowspan="2" align="center" style="border: solid 1px #999"><strong>ลำดับ</strong></td>
          <td width="391" rowspan="2" align="center" style="border: solid 1px #999"><strong>รายการ</strong></td>
          <td width="150" align="center" valign="top" style="border: solid 1px #999"><strong>จำนวนเงิน</strong></td>
        </tr>
        <tr>
          <td width="94" align="center" style="border: solid 1px #999"><strong>บาท</strong></td>
          </tr>
<?php 
			
			$amount = 0;
			$total  = 0;
			
			foreach ($arr as $key => $value){
				switch ($value['pay_sum_type']){
					
					case 1 :
						$erow = $setiing[0]['subvention_rate'];
						break;
					case 2 :
					//	$erow = $setiing[0][''];
						break;	
				}
?>
<tr>
          <td width="72" align="center" valign="top" style="border: solid 1px #999"> <?php echo $key+1;?></td>
          <td width="391" valign="top" style="border: solid 1px #999"><?php
		  if ($value['pay_sum_type'] == 1) {
			   echo $value["pt_title"];
			  echo " ศพที่ ".$value['pay_death_begin']." ".getNameByDeadId($value['pay_death_begin']);?><br />
			  จำนวน <?php echo getPayDeadCount($value['pay_sum_type'],$list,$value['pay_death_begin'])?> ราย (รหัสสมาชิก <?php echo  getPayDeadList($value['pay_sum_type'],$list,$value['pay_death_begin']);?>)
		  <?php
		  $total = (getPayDeadCount($value['pay_sum_type'],$list,$value['pay_death_begin']) * $value['pay_sum_total']);
          }else if ($value['pay_sum_type'] == 2) {
			   echo $value["pt_title"];
			  echo " งวดที่ ".$value['pay_sum_adv_num'];?><br />
			  จำนวน <?php echo getPayAdvCount($value['pay_sum_type'],$list,$value['pay_sum_adv_num'])?> ราย (รหัสสมาชิก <?php echo  getPayAdvList($value['pay_sum_type'],$list,$value['pay_sum_adv_num'],true);?>)
		  <?php
		  $total = (getPayAdvCount($value['pay_sum_type'],$list,$value['pay_sum_adv_num']) * $value['pay_sum_total']);
          }
		  else if ($value['pay_sum_type'] == 3) {
			   echo $value["pt_title"];
			  echo "  ".$value['pay_annual_year']." ";?><br />
			  จำนวน <?php echo getPayAnnualCount($value['pay_sum_type'],$list,$value['pay_annual_year']);?> ราย (รหัสสมาชิก <?php echo  getPayAnnualList($value['pay_sum_type'],$list,$value['pay_annual_year'],true);?>)
		 <?php 
		 $total = (getPayAnnualCount($value['pay_sum_type'],$list,$value['pay_annual_year']) * $value['pay_sum_total']);
		 }
		  else if ($value['pay_sum_type'] == 4) {
			   echo $value["pt_title"];
			  echo "  ".$value['pay_sum_detail']." ";?><br />
			  จำนวน <?php echo getPayRegisCount($value['pay_sum_type'],$list);?> ราย (รหัสสมาชิก <?php echo  getPayRegisList($value['pay_sum_type'],$list,true);?>)
		 <?php 
		 $total = (getPayRegisCount($value['pay_sum_type'],$list) * $value['pay_sum_total']);
		 }
		 
		 else if ($value['pay_sum_type'] == 5) {
			  echo "  ".$value['pay_sum_detail']." ";?><br />
			  จำนวน <?php echo getPayOtherCount($value['pay_sum_type'],$list,$value['pay_sum_detail']);?> ราย (รหัสสมาชิก <?php echo  getPayOtherList($value['pay_sum_type'],$list,$value['pay_sum_detail'],true);?>)
		 <?php 
		 $total = (getPayOtherCount($value['pay_sum_type'],$list,$value['pay_sum_detail']) * $value['pay_sum_total']);
		 }else {
		  ?><br />
          จำนวน <?php echo getPayCount($value['pay_sum_type'],$list);?> ราย (รหัสสมาชิก <?php echo  getPayList($value['pay_sum_type'],$list);?>)  
          <?php 
		  $total = (getPayCount($value['pay_sum_type'],$list) * $value['pay_sum_total']);
		  } ?>  <br />
รายละ  <?php echo number_format($value['pay_sum_total']) ?> บาท<br />
            </td>
          <td width="94" valign="top" align="right" style="border: solid 1px #999">
		  <?php 
		  echo number_format($total);
		?></td>
          </tr>
          
			<?php 
			$amount += $total;
			}?>
        <tr>
          <td width="463" colspan="2" valign="middle" style="border: solid 1px #999"><table width="100%" cellpadding="1" >
            <tr>
                <td width="80%" align="center" valign="bottom"><strong>( <?php echo num2thai($amount);?> )</strong></td>
                <td width="15%" align="center" valign="bottom" ><strong>รวมเงิน</strong></td>
              </tr>
          </table></td>
          <td width="94" valign="middle" align="right" style="border: solid 1px #999"><strong><?php echo number_format($amount)?></strong></td>
          </tr>
      </table></td>
    </tr>
    <tr>
      <td colspan="3" align="center">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="3" align="center"><img src="upload/<?php echo $setting[0]["receiver_signature"]?>" width="102" height="19" vspace="10" /> <br />
      ( <?php echo $setting[0]['receiver_name']?> ) <br />        <strong>ผู้รับเงิน</strong></td>
    </tr>
  </table>
  </font>
</div>

<?php
}
function getSliptNumber(){
	
$total = ew_ExecuteScalar("SELECT number FROM sliptnumber WHERE slipt_id = 1");

if ($total > 0) return $total;
else return 1; 


}

function addSliptNumber(){
	
$old = getSliptNumber();
$add = $old+1;	
	
$total = ew_ExecuteScalar("UPDATE sliptnumber SET number = ".$add." WHERE slipt_id = 1"); 

}

function getSubvSliptNumber(){
	
$total = ew_ExecuteScalar("SELECT number FROM sliptnumber WHERE slipt_id = 2");

if ($total > 0) return $total;
else return 1; 


}


function addSubvSliptNumber(){
	
$old = getSubvSliptNumber();
$add = $old+1;	
	
$total = ew_ExecuteScalar("UPDATE sliptnumber SET number = ".$add." WHERE slipt_id = 2"); 

}


function getRefundSliptNumber(){
	
$total = ew_ExecuteScalar("SELECT number FROM sliptnumber WHERE slipt_id = 3");

if ($total > 0) return $total;
else return 1; 


}


function addRefundSliptNumber(){
	
$old = getRefundSliptNumber();
$add = $old+1;	
	
$total = ew_ExecuteScalar("UPDATE sliptnumber SET number = ".$add." WHERE slipt_id = 3"); 

}

function createSubvSlipt($subvc_id){

 global $conn;
		
			
			$rs = $conn->Execute("SELECT *, subvcharge.member_code as mc  FROM subvcharge LEFT JOIN members ON (subvcharge.member_code = members.member_code) LEFT JOIN paymentsummary ON (paymentsummary.member_code = subvcharge.member_code) WHERE subvc_id = ".$subvc_id);
			
			$arr = $rs->GetArray();

			$setting = getSetting();
?>

<div id="slipt">
<font face="Cordia New" size="2">
  <table width="100%" align="center">
    <tr>
      <td width="250" align="left">เล่มที่ 1</td>
      <td align="center"><img src="upload/<?php echo $setting[0]["logo"]?>" alt="" width="131" height="139" vspace="10" /></td>
      <td width="200" colspan="2" align="right">เลขที่ <?php echo str_pad(getSubvSliptNumber(), 5, "0", STR_PAD_LEFT);?></td>
    </tr>
    <tr>
      <td colspan="4" align="center"><strong><br />
        ใบสำคัญรับเงินค่าฌาปนกิจสงเคราะห์<br />
        ชมรมฌาปนกิจสงเคราะห์สมาชิกเครือข่ายกองทุนหมุ่บ้านอำเภอลี้<br />
อำเภอลี้   จังหวัดลำพูน</strong></td>
    </tr>
    <tr>
      <td colspan="4" align="right">วันที่ <?php echo date('d');?> เดือน <?php echo thaiMonth(date('n'));?> พ.ศ <?php echo  thaiYear(date('Y'));?></td>
    </tr>
    <tr>
      <td colspan="4" align="center">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="4" align="center"><strong>รหัสสมาชิก(ผู้เสียชีวิต): <?php echo $arr[0]['mc']?><br />
        <br />
      </strong></td>
    </tr>
    <tr>
    <?php $tinfo = getTambonInfo($arr[0]['t_code']); $vinfo = getVillageInfo($arr[0]['village_id']);?>
      <td colspan="4" align="left"><table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td width="33%" align="center" valign="top"><strong>ผู้รับเงินสงเคราะห์คนที่ 1</strong><br />
            <?php echo $arr[0]['bnfc1_name']?><br />
            <strong>ความสัมพันธ์</strong><font size="2" face="Cordia New">&nbsp; </font><?php echo $arr[0]['bnfc1_rel']?>
</td>
          <?php if($arr[0]['bnfc2_name']){?>
          <td width="33%" align="center" valign="top"><strong>ผู้รับเงินสงเคราะห์คนที่<font size="2" face="Cordia New"> 2</font></strong><br />
            <?php echo $arr[0]['bnfc2_name']?><br />
            <strong>ความสัมพันธ์</strong><font size="2" face="Cordia New">&nbsp; </font><?php echo $arr[0]['bnfc2_rel']?></td>
            <?php } ?>
            <?php if($arr[0]['bnfc3_name']){?>
          <td width="33%" align="center" valign="top"><strong>ผู้รับเงินสงเคราะห์คนที่<font size="2" face="Cordia New"> 3</font></strong><br />
            <?php echo $arr[0]['bnfc3_name']?><br />
            <strong>ความสัมพันธ์</strong><font size="2" face="Cordia New">&nbsp; </font><?php echo $arr[0]['bnfc3_rel']?></td>
            <?php } ?>
          </tr>
      </table>        <br /></td>
    </tr>
    <tr>
      <td colspan="4" align="left"><strong>ซึ่งเป็นผู้รับผลประโยชน์ของ </strong><?php echo getNameById($arr[0]['mc'])?> (ผู้เสียชีวิต)<br />
        <br />
      ได้รับเงินค่าฌาปนกิจสงเคราะห์ จากชมรมฌาปนกิจสงเคราะห์สมาชิกเครือข่ายกองทุนหมุ่บ้านอำเภอลี้ อำเภอลี้ จังหวัดลำพูน <br />
      เป็นจำนวนเงิน <?php echo number_format($arr[0]['bnfc_total']);?> บาท<font size="2" face="Cordia New">&nbsp; </font><strong>( <?php echo num2thai($arr[0]['bnfc_total']);?> )</strong> ไว้เป็นการถูกต้องครบถ้วนแล้ว เมื่อวันที่ วันที่ <?php echo date('d');?> เดือน <?php echo thaiMonth(date('n'));?> พ.ศ <?php echo  thaiYear(date('Y'));?></td>
    </tr>
    <tr>
      <td colspan="4" align="center">&nbsp;</td>
    </tr>
    <tr>
    <?php $setting = getSetting(); ?>
      <td colspan="4" align="center"><br />
        <table width="100%" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td width="33%" align="center" valign="top"><strong><br />
            (..........................................<font size="2" face="Cordia New">......</font>....)</strong><br />              <?php echo $arr[0]['bnfc1_name']?><br />            <strong>ผู้รับเงินสงเคราะห์คนที่ 1</strong><br /></td>
            <?php if($arr[0]['bnfc2_name']){?>
            <td width="33%" align="center" valign="top"><strong><br />
              (..........................................<font size="2" face="Cordia New">......</font>...</strong>)<br />
<?php echo $arr[0]['bnfc2_name']?><br />
<strong>ผู้รับเงินสงเคราะห์คนที่ <font size="2" face="Cordia New">2</font></strong><br /></td><?php }?>

<?php if($arr[0]['bnfc3_name']){?>            <td width="33%" align="center" valign="top"><strong><br />
              (..........................................<font size="2" face="Cordia New">......</font>...</strong>)<br />
<?php echo $arr[0]['bnfc3_name']?><br />
<strong>ผู้รับเงินสงเคราะห์คนที่ <font size="2" face="Cordia New">3</font></strong></td>
<?php } ?>
          </tr>
        </table>
        <br />        
      <strong>ลายมือผู้รับเงินสงเคราะห์</strong></td>
    </tr>
  </table>
  </font>
</div>

<?php
		$conn->Execute("UPDATE subvcharge SET subvc_slipt_num = ".getSubvSliptNumber()." WHERE subvc_id= ".$subvc_id);
}




function createRefundSlipt($refund_id){

 global $conn;
		
			
			$rs = $conn->Execute("SELECT * FROM refundable LEFT JOIN members ON (refundable.member_code = members.member_code) WHERE refund_id = ".$refund_id);
			
			$arr = $rs->GetArray();

			$setting = getSetting();
?>

<div id="slipt">
<font face="Cordia New" size="2">
  <table width="100%" align="center">
    <tr>
      <td width="250" align="left">เล่มที่ 1</td>
      <td align="center"><img src="upload/<?php echo $setting[0]["logo"]?>" alt="" width="131" height="139" vspace="10" /></td>
      <td width="200" colspan="2" align="right">เลขที่ <?php echo str_pad(getRefundSliptNumber(), 5, "0", STR_PAD_LEFT);?></td>
    </tr>
    <tr>
      <td colspan="4" align="center"><strong><br />
        ใบสำคัญรับเงินสงเคราะห์ล่วงหน้าคงเหลือ<br />
ชมรมฌาปนกิจสงเคราะห์สมาชิกเครือข่ายกองทุนหมุ่บ้านอำเภอลี้<br />
อำเภอลี้   จังหวัดลำพูน</strong></td>
    </tr>
    <tr>
      <td colspan="4" align="right">วันที่ <?php echo date('d');?> เดือน <?php echo thaiMonth(date('n'));?> พ.ศ <?php echo  thaiYear(date('Y'));?></td>
    </tr>
    <tr>
      <td colspan="4" align="center">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="4" align="center"><strong><br />
        <br />
      </strong></td>
    </tr>
    <tr>
      <td colspan="4" align="left"><strong>ข้าพเจ้า <?php echo getNameById($arr[0]['member_code'])?><font size="2" face="Cordia New"> </font></strong><br />
        <br />
      ได้รับเงินสงเคราะห์ล่วงหน้าคงเหลือ จากชมรมฌาปนกิจสงเคราะห์สมาชิกเครือข่ายกองทุนหมุ่บ้านอำเภอลี้ อำเภอลี้ จังหวัดลำพูน <br />
      เป็นจำนวนเงิน <?php echo number_format($arr[0]['sub_total']);?> บาท<font size="2" face="Cordia New">&nbsp; </font><strong>( <?php echo num2thai($arr[0]['sub_total']);?> )</strong> ไว้เป็นการถูกต้องครบถ้วนแล้ว เมื่อวันที่ วันที่ <?php echo date('d');?> เดือน <?php echo thaiMonth(date('n'));?> พ.ศ <?php echo  thaiYear(date('Y'));?></td>
    </tr>
    <tr>
      <td colspan="4" align="center">&nbsp;</td>
    </tr>
    <tr>
    <?php $setting = getSetting(); ?>
      <td colspan="4" align="center"><br />
        <table width="100%" border="0" cellpadding="0" cellspacing="0">
          <tr>
     
            <td width="33%" align="center" valign="top"><strong><br />
              (..........................................<font size="2" face="Cordia New">......</font>...</strong>)<br />
<?php echo getNameById($arr[0]['member_code'])?><br />
         

          </tr>
        </table>
        <br />        
      <strong>ลายมือผู้รับเงิน</strong></td>
    </tr>
  </table>
  </font>
</div>

<?php
		$conn->Execute("UPDATE refundable SET refund_slipt_num = ".getRefundSliptNumber()." WHERE refund_id = ".$refund_id);
		
} // end refund slipt



function createTerminateSlipt($member_id){

 global $conn;
		
			
			$rs = $conn->Execute("SELECT * FROM members LEFT JOIN tambon ON (members.t_code = tambon.t_code) LEFT JOIN village ON (members.village_id = village.village_id) WHERE member_id = ".$member_id);
			
			$arr = $rs->GetArray();

			$setting = getSetting();
?>

<div id="slipt"><font face="Cordia New" size="2">
  <table width="100%" align="center">
    <tr>
      <td width="250" align="left">สส. กทบ.ลี้ /ว 005</td>
      <td align="center"><img src="upload/<?php echo $setting[0]["logo"]?>" alt="" width="131" height="139" vspace="10" /></td>
      <td width="250" align="right"><div style="text-align:left; float:right;">สำนักงานชมรมฌาปนกิจสงเคราะห์<br />
        เครือข่ายกองทุนหมู่บ้านอำเภอลี้<br />
        ชั้น 2 อาคารที่ว่าการอำเภอลี้<br />
        อำเภอลี้ จังหวัดลำพูน 51110</div></td>
    </tr>
    <tr>
      <td colspan="3" align="left">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="3" align="center">วันที่ <?php echo date('d');?> เดือน <?php echo thaiMonth(date('n'));?> พ.ศ <?php echo  thaiYear(date('Y'));?></td>
    </tr>
    <tr>
      <td colspan="3" align="center">&nbsp;</td>
    </tr>
    <tr>
      <?php $tinfo = getTambonInfo($arr[0]['t_code']); $vinfo = getVillageInfo($arr[0]['village_id']);?>
      <td colspan="3" align="left"><p>เรื่อง      แจ้งการพ้นสภาพจากการเป็นสมาชิกชมรมฌาปนกิจสงเคราะห์เครือข่ายกองทุนหมู่บ้านอำเภอลี้ <br />
        เรียน       <strong><?php echo getNameById($arr[0]['member_code'])?></strong> <strong>, รหัสสมาชิก <?php echo $arr[0]['member_code']?></strong><br />
        อ้างถึง     ระเบียบชมรม  เรื่อง การพ้นสภาพของสมาชิกชมรมฌาปนกิจสงเคราะห์<br />
        <br />
      </p>
        <div style="text-indent:50px; text-align:justify;">ทางชมรมฯ<font size="2" face="Cordia New">ได้</font>พิจารณาการหมดสภาพการเป็นสมาชิกของท่าน เนื่องจาก <strong><u><?php echo $arr[0]['note']?></u></strong> และให้มีผลตั้งแต่ <strong><u><?php echo date2Thai($arr[0]['terminate_date'])?></u></strong> เป็นต้นไป</div>
        <br />
        <div style="margin-left:100px;"><br />
        จึงเรียนมาเพื่อโปรดทราบ</div>
        <div style="text-align:center; margin-left:200px;">
          <p>ขอแสดงความนับถือ<br />
            <img src="upload/<?php echo $setting[0]['chairman_signature']?>" width="106" height="18" vspace="10" /> <br />
            (<?php echo $setting[0]['chairman_name'] ?>)<br />
            ประธานชมรมฌาปนกิจสงเคราะห์เครือข่ายกองทุนหมู่บ้านอำเภอลี้<br />
          </p>
        </div>
        <h4 align="center">&nbsp;</h4></td>
    </tr>
    <tr>
      <td colspan="3" align="center">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="3" align="left"><?php echo nl2br($setting[0]['contact_info'])?></td>
    </tr>
  </table>
</font></div>

<?php

		
} // end terminate slipt


function createInvoice($list){

 global $conn;
		
			$l = implode(',',$list['key_m']);
			
			$rs = $conn->Execute("SELECT *  FROM subvcalculate LEFT JOIN paymenttype ON (paymenttype.pt_id = subvcalculate.cal_type) WHERE svc_id IN (".$l.") GROUP BY cal_type, adv_num, member_code, pt_des");
			
			
			$arr = $rs->GetArray();

			$setting = getSetting();
?>

<div id="slipt"><font face="Cordia New" size="2">
  <table width="100%" align="center">
    <tr>
      <td width="250" align="left">สส. กทบ.ลี้ /ว 005</td>
      <td align="center"><img src="upload/<?php echo $setting[0]["logo"]?>" alt="" width="131" height="139" vspace="10" /></td>
      <td width="250" align="right"><div style="text-align:left; float:right;">สำนักงานชมรมฌาปนกิจสงเคราะห์<br />
        เครือข่ายกองทุนหมู่บ้านอำเภอลี้<br />
        ชั้น 2 อาคารที่ว่าการอำเภอลี้<br />
      อำเภอลี้ จังหวัดลำพูน 51110</div></td>
    </tr>
    <tr>
      <td colspan="3" align="left">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="3" align="center">วันที่ <?php echo date('d');?> เดือน <?php echo thaiMonth(date('n'));?> พ.ศ <?php echo  thaiYear(date('Y'));?></td>
    </tr>
    <tr>
      <td colspan="3" align="center">&nbsp;</td>
    </tr>
    <tr>
      <?php $tinfo = getTambonInfo($arr[0]['t_code']); $vinfo = getVillageInfo($arr[0]['village_id']);?>
      <td colspan="3" align="left"><p>เรื่อง      เก็บเงินสมาชิกชมรมฌาปนกิจสงเคราะห์เครือข่ายกองทุนหมู่บ้านอำเภอลี้ <br />
        เรียน       ประธานกองทุนหมู่บ้าน หมู่ <?php echo $vinfo[0]['v_code']." ".$vinfo[0]['v_title'];?> ตำบล<?php echo $tinfo[0]['t_title']?><br />
        อ้างถึง     ระเบียบชมรม หมวดที่ 4 ข้อที่ 15 (4) เรื่อง การเก็บเงินของสมาชิกชมรมฌาปนกิจสงเคราะห์<br />
        <br />
        <div style="text-indent:50px; text-align:justify;">ตามระเบียบข้อบังคับของชมรมฌาปนกิจสงเคราะห์เครือข่ายกองทุนหมู่บ้านอำเภอลี้ หมวดที่ 4  ข้อที่15 (4)    เพื่อให้การดำเนินการของชมรมฌาปนกิจสงเคราะห์เครือข่ายกองทุนหมู่บ้านอำเภอลี้  เป็นไปด้วยความสะดวกรวดเร็ว  ต่อเนื่อง และทันต่อเหตุการณ์   จึงใคร่ขอความร่วมมือจากท่าน ในการจัดเก็บเงินตามรายการในตารางที่แนบมาด้ายนี้้ แล้วนำส่งสำนักงาน ชมรมฌาปนกิจสงเคราะห์เครือข่ายกองทุนหมู่บ้าน  <strong>ภายในวันที่ <u><?php echo genInvoiceDuedate()?></u></strong></div> <br />
  <div style="margin-left:100px;">จึงเรียนมาเพื่อโปรดทราบและดำเนินการต่อไป</div>
  <div style="text-align:center; margin-left:200px;"><p>ขอแสดงความนับถือ<br />
    <img src="upload/<?php echo $setting[0]['chairman_signature']?>" width="106" height="18" vspace="10" />  <br />
    (<?php echo $setting[0]['chairman_name'] ?>)<br />ประธานชมรมฌาปนกิจสงเคราะห์เครือข่ายกองทุนหมู่บ้านอำเภอลี้<br />
  </p></div>
  <h4 align="center">หากเกินระยะเวลาที่กำหนดทางชมรมฯจะพิจารณาการหมดสภาพการเป็นสมาชิกของท่าน</h4></td>
    </tr>
    <tr>
      <td colspan="3" align="left"><strong><br />
        ตารางสรุปรายการที่ต้องชำระ</strong><br />
        <br />
        <table width="100%" border="0" cellpadding="3" cellspacing="2">
          <tr>
          <td width="72" rowspan="2" align="center" style="border: solid 1px #999"><strong>ลำดับ</strong></td>
          <td width="391" rowspan="2" align="center" style="border: solid 1px #999"><strong>รายการ</strong></td>
          <td width="150" align="center" valign="top" style="border: solid 1px #999"><strong>จำนวนเงิน</strong></td>
        </tr>
        <tr>
          <td width="94" align="center" style="border: solid 1px #999"><strong>บาท</strong></td>
          </tr>
<?php 
			
			$amount = 0;
			$total  = 0;
			
			foreach ($arr as $key => $value){
				switch ($value['cal_type']){
					
					case 1 :
						$erow = $setiing[0]['subvention_rate'];
						break;
					case 2 :
					//	$erow = $setiing[0][''];
						break;	
				}
?>
<tr>
          <td width="72" align="center" valign="top" style="border: solid 1px #999"> <?php echo $key+1;?></td>
          <td width="391" valign="top" style="border: solid 1px #999"><?php 
		  if ($value['cal_type'] == 1) {
			  echo $value["pt_title"];
			  echo " ศพที่ ".getDeadIdByMember($value['member_code'])." ".getNameById($value['member_code']);?><br />
			  จำนวน <?php echo $value["count_member"];?> ราย (รหัสสมาชิก <?php echo  getNotPayDeadList($value['village_id'],$value['member_code']);?>)
<?php
		  $total =  $total = ($value['unit_rate'] * $value['count_member']);
          }else if ($value['cal_type'] == 2) {
			  echo $value["pt_title"];
			  echo " งวดที่ ".$value['adv_num'];?><br />
			  จำนวน <?php echo $value['count_member']?> ราย
		   (รหัสสมาชิก <?php echo  getNotPayAdvList($value['village_id'],$value['adv_num']);?>) 
		   <?php
		  $total = ($value['unit_rate'] * $value['count_member']);
          }
		  else if ($value['cal_type'] == 3) {
			  echo $value["pt_title"];
			  echo " ".$value['cal_detail']." ";?><br />
			  จำนวน <?php echo $value["count_member"];?> ราย (รหัสสมาชิก <?php echo  getNotPayAnnaulList($value['village_id'],$value['cal_detail']);?>)
<?php 
		 $total = ($value['unit_rate'] * $value['count_member']);
		 }
		 else if ($value['cal_type'] == 4) {
			 echo $value["pt_title"];
			  echo " ".$value['cal_detail']." ";?><br />
			  จำนวน <?php echo $value["count_member"];?> ราย
		 (รหัสสมาชิก <?php echo  getNotPayRegisList($value['village_id']);?>)
		 <?php 
		 $total = ($value['unit_rate'] * $value['count_member']);
		 }
		  else if ($value['cal_type'] == 5) {
			  echo " ".$value['cal_detail']." ";?><br />
			  จำนวน <?php echo $value["count_member"];?> ราย
		 (รหัสสมาชิก <?php echo  getNotPayOtherList($value['village_id'],$value['cal_detail']);?>)
		 <?php 
		 $total = ($value['unit_rate'] * $value['count_member']);
		 }else {
		  ?><br />
          จำนวน <?php echo $value['count_member']?> ราย 
          <?php 
		  $total = ($value['unit_rate'] * $value['count_member']);
		  } ?> 
รายละ  <?php echo number_format($value['unit_rate']) ?> บาท<br />
            </td>
          <td width="94" valign="top" align="right" style="border: solid 1px #999">
		  <?php 
		  echo number_format($total);
		?></td>
          </tr>
          
			<?php 
			$amount += $total;
			}?>
        <tr>
          <td width="463" colspan="2" valign="middle" style="border: solid 1px #999"><table width="100%" cellpadding="3">
            <tr>
                <td width="80%" align="center" valign="bottom"><strong><?php echo num2thai($amount);?></strong></td>
                <td width="15%" align="center" valign="bottom"><strong>รวมเงิน</strong></td>
              </tr>
          </table></td>
          <td width="94" valign="middle" align="right" style="border: solid 1px #999"><strong><?php echo number_format($amount)?></strong></td>
          </tr>
      </table></td>
    </tr>
    <tr>
      <td colspan="3" align="center">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="3" align="left"><?php echo nl2br($setting[0]['contact_info'])?></td>
    </tr>
  </table>
  </font>
</div>

<?php

		$conn->Execute("UPDATE subvcalculate SET cal_status = 'ส่งใบแจ้งหนี้' , invoice_senddate ='".date('Y-m-d')."', invoice_duedate = '".genInvoiceDuedate(true)."'  WHERE svc_id IN (".$l.") ");
		

}



function createNotice($list){

 global $conn;
		
			$l = implode(',',$list['key_m']);
			
			$rs = $conn->Execute("SELECT *  FROM subvcalculate LEFT JOIN paymenttype ON (paymenttype.pt_id = subvcalculate.cal_type) WHERE svc_id IN (".$l.") GROUP BY cal_type, adv_num, member_code, pt_des");
			
			
			$arr = $rs->GetArray();

			$setting = getSetting();
?>

<div id="slipt"><font face="Cordia New" size="2">
  <table width="100%" align="center">
    <tr>
      <td width="250" align="left">สส. กทบ.ลี้ /ว 005</td>
      <td align="center"><img src="upload/<?php echo $setting[0]["logo"]?>" alt="" width="131" height="139" vspace="10" /></td>
      <td width="250" align="right"><div style="text-align:left; float:right;">สำนักงานชมรมฌาปนกิจสงเคราะห์<br />
        เครือข่ายกองทุนหมู่บ้านอำเภอลี้<br />
        ชั้น 2 อาคารที่ว่าการอำเภอลี้<br />
      อำเภอลี้ จังหวัดลำพูน 51110</div></td>
    </tr>
    <tr>
      <td colspan="3" align="left">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="3" align="center">วันที่ <?php echo date('j');?> เดือน <?php echo thaiMonth(date('n'));?> พ.ศ <?php echo  thaiYear(date('Y'));?></td>
    </tr>
    <tr>
      <td colspan="3" align="center">&nbsp;</td>
    </tr>
    <tr>
      <?php $tinfo = getTambonInfo($arr[0]['t_code']); $vinfo = getVillageInfo($arr[0]['village_id']);?>
      <td colspan="3" align="left"><p>เรื่อง      เก็บเงินสมาชิกชมรมฌาปนกิจสงเคราะห์เครือข่ายกองทุนหมู่บ้านอำเภอลี้ <br />
        เรียน       ประธานกองทุนหมู่บ้าน หมู่ <?php echo $vinfo[0]['v_code']." ".$vinfo[0]['v_title'];?> ตำบล<?php echo $tinfo[0]['t_title']?><br />
        <br />
        <div style="text-indent:50px; text-align:justify;">
          <p>ตามที่ทางชมรมฌาปนกิจสงเคราะห์เครือข่ายกองทุนหมู่บ้านอำเภอลี้ ได้เรียกเก็บเงินตามรายการในตารางที่แนบมาด้วยนั้น กำหนดส่ง <strong><u>ภายใน <?php echo getInvoiceDuedate($l)?></u></strong> ไปแล้วนั้น  ท่านยังไม่ได้ดำเนินการจัดส่งให้กับทางชมรมฯ <br />
            <br />
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ดังนั้น จึงใคร่ขอความร่วมมือจากท่านในการจัดเก็บเงินสงเคราะห์ล่วงหน้า แล้วนำส่งสำนักงานชมรมฌาปนกิจสงเคราะห์เครือข่ายกองทุนหมู่บ้าน <strong><u>ไม่เกินวันที่ <?php echo getNoticeDuedate($l)?></u></strong></p>
        </div> 
        <br />
  <div style="margin-left:100px;">จึงเรียนมาเพื่อโปรดทราบและดำเนินการต่อไป</div>
  <div style="text-align:center; margin-left:200px;"><p>ขอแสดงความนับถือ<br />
    <img src="upload/<?php echo $setting[0]['chairman_signature']?>" width="106" height="18" vspace="10" />  <br />
    (<?php echo $setting[0]['chairman_name'] ?>)<br />ประธานชมรมฌาปนกิจสงเคราะห์เครือข่ายกองทุนหมู่บ้านอำเภอลี้<br />
  </p></div></td>
    </tr>
    <tr>
      <td colspan="3" align="left"><strong><br />
        ตารางสรุปรายการที่ต้องชำระ</strong><br />
        <br />
        <table width="100%" border="0" cellpadding="3" cellspacing="2">
          <tr>
          <td width="72" rowspan="2" align="center" style="border: solid 1px #999"><strong>ลำดับ</strong></td>
          <td width="391" rowspan="2" align="center"  style="border: solid 1px #999"><strong>รายการ</strong></td>
          <td width="150" align="center" valign="top" style="border: solid 1px #999"><strong>จำนวนเงิน</strong></td>
        </tr>
        <tr>
          <td width="94" align="center" style="border: solid 1px #999"><strong>บาท</strong></td>
          </tr>
<?php 
			
			$amount = 0;
			$total  = 0;
			
			foreach ($arr as $key => $value){
				switch ($value['cal_type']){
					
					case 1 :
						$erow = $setiing[0]['subvention_rate'];
						break;
					case 2 :
					//	$erow = $setiing[0][''];
						break;	
				}
?>
<tr>
          <td width="72" align="center" valign="top" style="border: solid 1px #999"> <?php echo $key+1;?></td>
          <td width="391" valign="top" style="border: solid 1px #999"><?php 
		  if ($value['cal_type'] == 1) {
			  echo $value["pt_title"];
			  echo " ศพที่ ".getDeadIdByMember($value['member_code'])." ".getNameById($value['member_code']);?><br />
			  จำนวน <?php echo $value["count_member"];?> ราย (รหัสสมาชิก <?php echo  getNotPayDeadList($value['village_id'],$value['member_code']);?>)
<?php
		  $total =  $total = ($value['unit_rate'] * $value['count_member']);
          }else if ($value['cal_type'] == 2) {
			  echo $value["pt_title"];
			  echo " งวดที่ ".$value['pt_des'];?><br />
			  จำนวน <?php echo $value['count_member']?> ราย
		  (รหัสสมาชิก <?php echo  getNotPayAdvList($value['village_id'],$value['adv_num']);?>)
		  <?php
		  $total = ($value['unit_rate'] * $value['count_member']);
          }
		  else if ($value['cal_type'] == 3) {
			  echo $value["pt_title"];
			  echo "  ".$value['cal_detail']." ";?><br />
			  จำนวน <?php echo $value["count_member"];?> ราย
		 (รหัสสมาชิก <?php echo  getNotPayAnnaulList($value['village_id'],$value['cal_detail']);?>)
		 <?php 
		 $total = ($value['unit_rate'] * $value['count_member']);
		 }
		 else if ($value['cal_type'] == 4) {
			 echo $value["pt_title"];
			  echo " ".$value['cal_detail']." ";?><br />
			  จำนวน <?php echo $value["count_member"];?> ราย
		 (รหัสสมาชิก <?php echo  getNotPayRegisList($value['village_id']);?>)
		 <?php 
		 $total = ($value['unit_rate'] * $value['count_member']);
		 }
		  else if ($value['cal_type'] == 5) {
			  echo " ".$value['cal_detail']." ";?><br />
			  จำนวน <?php echo $value["count_member"];?> ราย 
		 (รหัสสมาชิก <?php echo  getNotPayOtherList($value['village_id'],$value['cal_detail']);?>)
<?php 
		 $total = ($value['unit_rate'] * $value['count_member']);
		 }else {
		  ?><br />
          จำนวน <?php echo $value['count_member']?> ราย 
          <?php 
		  $total = ($value['unit_rate'] * $value['count_member']);
		  } ?> 
รายละ  <?php echo number_format($value['unit_rate']) ?> บาท<br />
            </td>
          <td width="94" valign="top" align="right" style="border: solid 1px #999">
		  <?php 
		  echo number_format($total);
		?></td>
          </tr>
          
			<?php 
			$amount += $total;
			}?>
        <tr>
          <td width="463" colspan="2" valign="middle" style="border: solid 1px #999"><table width="100%" cellpadding="3">
            <tr>
                <td width="80%" align="center" valign="bottom"><strong><?php echo num2thai($amount);?></strong></td>
                <td width="15%" align="center" valign="bottom"><strong>รวมเงิน</strong></td>
              </tr>
          </table></td>
          <td width="94" valign="middle" align="right" style="border: solid 1px #999"><strong><?php echo number_format($amount)?></strong></td>
          </tr>
      </table></td>
    </tr>
    <tr>
      <td colspan="3" align="center">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="3" align="left"><?php echo nl2br($setting[0]['contact_info'])?></td>
    </tr>
  </table>
  </font>
</div>

<?php

ew_ExecuteScalar("UPDATE subvcalculate SET cal_status = 'ส่งหนังสือเตือน' , notice_senddate ='".date('Y-m-d')."', notice_duedate = '".getNoticeDuedate($l,true)."'  WHERE svc_id IN (".$l.") ");
}


function date2Thai($date){
		
	$d = explode('-',$date);
	
	$dd = round($d[2]);
	
	return "วันที่ ".$dd." เดือน ".thaiMonth($d[1])." พ.ศ. ".thaiYear($d[0]);
	
	
}

function thaiMonth($m=false){
	
	if (!$m) $m = date('n');
	switch ($m){
		
		case 1:
			$month = "มกราคม";
		    break;
		case 2:
			$month = "กุมภาพันธ์";
			break;
		case 3:
			$month = "มีนาคม";
			break;
		case 4:
			$month = "เมษายน";
			break;
		case 5:
			$month = "พฤษภาคม";
			break;
		case 6:
			$month = "มิถุนายน";
			break;
		case 7:
			$month = "กรกฎาคม";
			break;
		case 8:
			$month = "สิงหาคม";
			break;
		case 9:
			$month = "กันยายน";
			break;		
		case 10:
			$month = "ตุลาคม";
			break;
		case 11:
			$month = "พฤศจิกายน";
			break;			
		case 12:
			$month = "ธันวาคม";
			break;					
	}
	return $month;
}
function thaiYear($y){
	
	if (!$y) $y = date('Y');
	$year = ($y+543); 
	return $year;
}

function num2thai($number){
$t1 = array("ศูนย์", "หนึ่ง", "สอง", "สาม", "สี่", "ห้า", "หก", "เจ็ด", "แปด", "เก้า");
$t2 = array("เอ็ด", "ยี่", "สิบ", "ร้อย", "พัน", "หมื่น", "แสน", "ล้าน");
$zerobahtshow = 0; // ในกรณีที่มีแต่จำนวนสตางค์ เช่น 0.25 หรือ .75 จะให้แสดงคำว่า ศูนย์บาท หรือไม่ 0 = ไม่แสดง, 1 = แสดง
(string) $number;
$number = explode(".", $number);
if(!empty($number[1])){
if(strlen($number[1]) == 1){
$number[1] .= "0";
}else if(strlen($number[1]) > 2){
if($number[1]{2} < 5){
$number[1] = substr($number[1], 0, 2);
}else{
$number[1] = $number[1]{0}.($number[1]{1}+1);
}
}
}

for($i=0; $i<count($number); $i++){
$countnum[$i] = strlen($number[$i]);
if($countnum[$i] <= 7){
$var[$i][] = $number[$i];
}else{
$loopround = ceil($countnum[$i]/6);
for($j=1; $j<=$loopround; $j++){
if($j == 1){
$slen = 0;
$elen = $countnum[$i]-(($loopround-1)*6);
}else{
$slen = $countnum[$i]-((($loopround+1)-$j)*6);
$elen = 6;
}
$var[$i][] = substr($number[$i], $slen, $elen);
}
}

$nstring[$i] = "";
for($k=0; $k<count($var[$i]); $k++){
if($k > 0) $nstring[$i] .= $t2[7];
$val = $var[$i][$k];
$tnstring = "";
$countval = strlen($val);
for($l=7; $l>=2; $l--){
if($countval >= $l){
$v = substr($val, -$l, 1);
if($v > 0){
if($l == 2 && $v == 1){
$tnstring .= $t2[($l)];
}elseif($l == 2 && $v == 2){
$tnstring .= $t2[1].$t2[($l)];
}else{
$tnstring .= $t1[$v].$t2[($l)];
}
}
}
}
if($countval >= 1){
$v = substr($val, -1, 1);
if($v > 0){
if($v == 1 && $countval > 1 && substr($val, -2, 1) > 0){
$tnstring .= $t2[0];
}else{
$tnstring .= $t1[$v];
}

}
}

$nstring[$i] .= $tnstring;
}

}
$rstring = "";
if(!empty($nstring[0]) || $zerobahtshow == 1 || empty($nstring[1])){
if($nstring[0] == "") $nstring[0] = $t1[0];
$rstring .= $nstring[0]."บาท";
}
if(count($number) == 1 || empty($nstring[1])){
$rstring .= "ถ้วน";
}else{
$rstring .= $nstring[1]."สตางค์";
}
return $rstring;
}

function countMemberInvillage($vid){
			
			global $conn;
			
			 $all = ew_ExecuteScalar("SELECT count(member_id) FROM  members WHERE village_id = ".$vid." AND member_status ='ปกติ'");
			 if ($all > 0) return $all;   
			 else return 0;
}

function countPayAdvMemberInvillage($vid,$num){
	
			 $all = ew_ExecuteScalar("SELECT count(member_code) FROM  paymentsummary WHERE village_id = ".$vid." AND pay_sum_adv_num ='".$num."'");
			 if ($all > 0) return $all;   
			 else return 0;
	
}

function PayAdvMemberInvillageList($vid,$num){
	
			 $all = Execute("SELECT member_id FROM  paymentsummary WHERE village_id = ".$vid." AND pay_sum_adv_num ='".$num."'");
			 			 
			 $arr = $all->GetArray();
			 return $arr;
	
}

function countPaySubvInvillage($vid,$dead){
	
			 $paydead = getDeadIdByMember($dead);
			
			 $all = ew_ExecuteScalar("SELECT count(member_code) FROM  paymentsummary WHERE village_id = ".$vid." AND pay_sum_type ='1' AND pay_death_begin = ".$paydead);
			 if ($all > 0) return $all;   
			 else return 0;
}

function PaySubvInvillageList($vid,$dead){
	
			 $paydead = getDeadIdByMember($dead);
			
			 $all = Execute("SELECT member_id FROM  paymentsummary WHERE village_id = ".$vid." AND pay_sum_type ='1' AND pay_death_begin = ".$paydead);
			 
			 
			 $arr = $all->GetArray();
			 return $arr;
}

function countPayRegisMemberInvillage($vid){
	
	
		
			 $all = ew_ExecuteScalar("SELECT count(member_code) FROM  paymentsummary WHERE village_id = ".$vid." AND pay_sum_type ='4'");
			 if ($all > 0) return $all;   
			 else return 0;
	
}

function PayRegisMemberInvillageList($vid){
	
	
		
			 $all = Execute("SELECT member_id FROM  paymentsummary WHERE village_id = ".$vid." AND pay_sum_type ='4'");
			 $arr = $all->GetArray();
			 return $arr;
	
}

function countPayOtherInvillage($vid,$detail){
	
	
		
			 $all = ew_ExecuteScalar("SELECT count(member_code) FROM  paymentsummary WHERE village_id = ".$vid." AND pay_sum_type ='5' AND pay_sum_detail = '".$detail."'");

			 if ($all > 0) return $all;   
			 else return 0;
	
}

function PayOtherInvillageList($vid,$detail){
	
	
		
			 $all = ew_ExecuteScalar("SELECT member_id FROM  paymentsummary WHERE village_id = ".$vid." AND pay_sum_type ='5' AND pay_sum_detail = '".$detail."'");

			 $arr = $all->GetArray();
			 return $arr;
	
}

function countPayAnnualInvillage($vid,$year){
	
			$all = ew_ExecuteScalar("SELECT count(member_code) FROM  paymentsummary WHERE village_id = ".$vid." AND pay_sum_type ='3' AND pay_annual_year = '".$year."'");
			
			
			 if ($all > 0) return $all;   
			 else return 0;
}

function PayAnnualInvillageList($vid,$year){
	
			$all = ew_ExecuteScalar("SELECT member_id FROM  paymentsummary WHERE village_id = ".$vid." AND pay_sum_type ='3' AND pay_annual_year = '".$year."'");
			
			
			$arr = $all->GetArray();
			 return $arr;
}

function calculatesubvention($m_id,$isCode=false){ // dead
	
 global $conn;
 
 	$setting = getSetting();

   if ($isCode){
	 $member = $m_id;  
   }else {
	$rs = $conn->Execute("SELECT * FROM members WHERE member_id = ".$m_id);
	$m = $rs->GetArray();
	$member = $m[0]['member_code'];
   }
   
    
	$conn->Execute("DELETE FROM subvcharge WHERE member_code = '".$member."'");
    
	
	
	$rs = $conn->Execute("INSERT INTO subvcharge SET member_code = '".$member."', all_member = ".getAllMember().", subv_rate = ".getSubvRate().", subvc_total = ".getSubvTotal().", assc_percent = ".getAsscPercent().", assc_total = ".getAsscTotal().", bnfc_total = ".getBnfcTotal().", dead_count = ".getDeadTotal().", resign_count = ".getResignTotal().", terminate_count =".getTerminateTotal().", alive_count =".getAliveTotal().", can_pay_count =".getCanPay().", cant_pay_count =".getCantPay().", cant_pay_detail = '".getCantPayDetail()."', canculate_date = '".ew_CurrentDate()."'");
	

	$village = getVillageList();
	$rate = $setting[0]['subvention_rate'];
	
	$conn->Execute("DELETE FROM subvcalculate WHERE member_code = '".$member."'");
	//$conn->Execute("DELETE FROM unpaylist WHERE un_pay_type = 1");
	 $varr = ""; 

	foreach ($village as $value){
		
		
	$paidmember = countPaySubvInvillage($value["village_id"], $member);
	$allmember = countMemberInvillage($value["village_id"]);
	$unpaymember = $allmember - $paidmember;

	
	if ($unpaymember > 0){
		
		
		$conn->Execute("INSERT INTO subvcalculate SET  member_code = '".$member."', t_code = '".$value["t_code"]."', village_id = '".$value["village_id"]."',cal_type = '1',  cal_date = '".date('Y/m/d')."', count_member = ".$unpaymember.", unit_rate = ".$rate.", total = (".$rate."*".$unpaymember."), cal_detail = ''");
		
		
		$lastid = ew_ExecuteScalar("SELECT max(svc_id) FROM subvcalculate");
		
     //  $notpay =  getNotPayDeadList(1,$value["village_id"],$member,true);
	 
	 $mb = getMemberByVillage($value["village_id"]);
	   
	 
	   
		foreach($mb as $notvalue){
			
			$varr .=",(".$lastid.",".getMemberIdByCode($notvalue["member_code"]).",1)";

				
		}
		
	
		
		}

	}
	$conn->Execute("INSERT INTO unpaylist (svc_id, un_member_id, un_pay_type) VALUES ".substr($varr,1));
	

} // end calculatesubvention


function calculatesubvention2($m_id,$isCode=false){ // dead
	
 global $conn;
 
 	$setting = getSetting();

   if ($isCode){
	 $member = $m_id;  
   }else {
	$rs = $conn->Execute("SELECT * FROM members WHERE member_id = ".$m_id);
	$m = $rs->GetArray();
	$member = $m[0]['member_code'];
   }
   
	

	$village = getVillageList();
	$rate = $setting[0]['subvention_rate'];
	
	$conn->Execute("DELETE FROM subvcalculate WHERE member_code = '".$member."'");
	//$conn->Execute("DELETE FROM unpaylist WHERE un_pay_type = 1");
	
	$varr = ""; 

	
	foreach ($village as $value){
		
		
	$paidmember = countPaySubvInvillage($value["village_id"], $member);
	$allmember = countMemberInvillage($value["village_id"]);
	$unpaymember = $allmember - $paidmember;

	if ($unpaymember > 0){
		
		
		$conn->Execute("INSERT INTO subvcalculate SET  member_code = '".$member."', t_code = '".$value["t_code"]."', village_id = '".$value["village_id"]."',cal_type = '1',  cal_date = '".date('Y/m/d')."', count_member = ".$unpaymember.", unit_rate = ".$rate.", total = (".$rate."*".$unpaymember."), cal_detail = ''");
		

		$lastid = ew_ExecuteScalar("SELECT max(svc_id) FROM subvcalculate");
		
      $mb = getMemberByVillage($value["village_id"]);
	   
	    foreach($mb as $notvalue){
			
			$varr .=",(".$lastid.",".getMemberIdByCode($notvalue["member_code"]).",1)";

			
		}
		
				
		}
		

	}
	$conn->Execute("INSERT INTO unpaylist (svc_id, un_member_id, un_pay_type) VALUES ".substr($varr,1));

} // end calculatesubvention



function updateSubvention($m_id,$svc_id){ // paid


 global $conn;


 $conn->Execute("UPDATE subvcalculate SET count_member = (count_member - 1), total = (total - unit_rate) WHERE svc_id = ".$svc_id);
 

 
 $conn->Execute("DELETE FROM subvcalculate WHERE count_member = 0");
 
 $conn->Execute("DELETE FROM unpaylist WHERE un_member_id = ".$m_id." AND svc_id = ".$svc_id);
 
 


}




function calculateresign($m_id){ // resign
	
global $conn;

$conn->Execute("DELETE FROM refundable WHERE member_code = '".$m_id."'");

$advbal = getAdvanceBudget($m_id);

$unpay = getUnpayBalance($m_id);


$balance = ($advbal - $unpay);

$asscper = getAsscPercent();

$assctotal = ($balance * $asscper) / 100;
	
$subtotal = ($balance - $assctotal);

if ($subtotal > 0){
$conn->Execute("INSERT INTO refundable SET member_code = '".$m_id."', refund_total = ".$balance.",assc_percent = ".$asscper.", assc_total = ".$assctotal.", sub_total = ".$subtotal.", calculate_date = '".ew_CurrentDate()."'");
} else {
	
return true;	
}
	

}

function calculateterminate($m_id){ // terminate
	
// please implement.
}

function calculatenormal($m_id){ // normal

// please implement.
}

function getAge($bd){

 $date = new DateTime($bd);
 $now = new DateTime();
 $interval = $now->diff($date);

return $interval->y;
	
}

function setAges(){
	
	 global $conn;
		
	$rs = $conn->Execute("SELECT birthdate,member_id  FROM members WHERE member_status != 'เสียชีวิต'");
			
	$arr = $rs->GetArray();
	
	foreach ($arr as $value){
		if ($value['birthdate']){
		//echo "UPDATE members SET age = '".getAge($value['birthdate'])."' WHERE member_id = ".$value['member_id'];
		$conn->Execute("UPDATE members SET age = '".getAge($value['birthdate'])."' WHERE member_id = ".$value['member_id']);
		
		}
		
	}
	
}

function getGender($prefix){
	
	$gender = "";
	
	switch($prefix){
		
		case "นาง" :
			$gender = "หญิง";
			break;
		case "นางสาว" :
			$gender = "หญิง";
			break;
		case "น.ส." :
			$gender = "หญิง";
			break;
		case "ด.ญ." :
			$gender = "หญิง";
			break;
		case "นาย" :
			$gender = "ชาย";
			break;
		case "ด.ช." :
			$gender = "ชาย";
			break;
		default:
			$gender = "";
			break;
			
	}

return $gender;
}

function setGender(){
	
	 global $conn;
	 
	$rs = $conn->Execute("SELECT prefix,member_id  FROM members");
			
	$arr = $rs->GetArray();
	
	foreach ($arr as $value){
		
		//echo "UPDATE members SET age = '".getAge($value['birthdate'])."' WHERE member_id = ".$value['member_id'];
		$conn->Execute("UPDATE members SET gender = '".getGender($value['prefix'])."' WHERE member_id = ".$value['member_id']);
		
	}
}

function updatememberlog($m_id,$detail,$date,$user){
	
	global $conn;
	$conn->Execute("INSERT INTO memberupdatelog SET member_code = ".$m_id.", update_detail = '".$detail."',update_date = '".$date."', author = '".$user."'");

}

function getFlag(){
	
	if (isset ($_GET["flag"])) return $_GET["flag"];
	else return 1;
}

function getVillageList($t_code=false){
			
	global $conn;  

	if ($t_code) $vllage = $conn->Execute("SELECT * FROM  village WHERE t_code = '".$t_code."'");
	else $vllage = $conn->Execute("SELECT * FROM  village order by v_code");
	
	$arr = $vllage->GetArray();
	return $arr;			
	
}

function countLowerAdvInVillage($v_id){
	
	 $all = getMemberByVillage($v_id);
	 $setting = getSetting();
	 $rate = $setting[0]["min_advance_subv"];
	 $total = 0;
	 
	 foreach($all as $value){
		 
		 if (getAdvanceBudget($value["member_code"]) < $rate) $total += 1;
	 }
	
	return $total;
}


function calculateLowerAdvSubv(){

$setting = getSetting();
$minrate = $setting[0]["min_advance_subv"];
$unitrate = ($setting[0]["max_advance_subv"]*$setting[0]["subvention_rate"]);

$memberlist = getMemberList('ปกติ');
$village = getVillageList();

global $conn;

$conn->Execute("DELETE FROM subvcalculate WHERE adv_num = ".getAdvNum());

foreach ($village as $value){
	
	$lowermember = countLowerAdvInVillage($value["village_id"]);
	
	
	if ($lowermember > 0){
		
		
		$conn->Execute("INSERT INTO subvcalculate SET t_code = '".$value["t_code"]."', village_id = '".$value["village_id"]."',cal_type = '2',  adv_num = ".getAdvNum().", cal_date = '".date('Y/m/d')."', count_member = ".$lowermember.", unit_rate = ".$unitrate.", total = (".$unitrate."*".$lowermember.")");
		
	}
}

}


function calculateAdvSubv($num=false){

$setting = getSetting();
$minrate = $setting[0]["min_advance_subv"];
$unitrate = ($setting[0]["max_advance_subv"]*$setting[0]["subvention_rate"]);

$memberlist = getMemberList('ปกติ');
$village = getVillageList();

if (!$num) $num = getAdvNum()+1;

global $conn;

//$conn->Execute("DELETE FROM subvcalculate WHERE adv_num = ".$num);
//$conn->Execute("DELETE FROM unpaylist WHERE un_pay_type = 2");
$varr = ""; 

foreach ($village as $value){
	
	$paidmember = countPayAdvMemberInvillage($value["village_id"],$num);
	$allmember = countMemberInvillage($value["village_id"]);
	$unpaymember = $allmember - $paidmember;
	
	
	if ($unpaymember > 0){
		
		
		$conn->Execute("INSERT INTO subvcalculate SET t_code = '".$value["t_code"]."', village_id = '".$value["village_id"]."',cal_type = '2',  adv_num = ".$num.", cal_date = '".date('Y/m/d')."', count_member = ".$unpaymember.", unit_rate = ".$unitrate.", total = (".$unitrate."*".$unpaymember.")");
		
		
		$lastid = ew_ExecuteScalar("SELECT max(svc_id) FROM subvcalculate");
		
     //  $notpay =  getNotPayDeadList(1,$value["village_id"],$member,true);
	 
	 $mb = getMemberByVillage($value["village_id"]);
	   
	    foreach($mb as $notvalue){
		$varr .=",(".$lastid.",".getMemberIdByCode($notvalue["member_code"]).",2)";
		}
		
	} // end if
	
}  // end for


$conn->Execute("INSERT INTO unpaylist (svc_id, un_member_id, un_pay_type) VALUES ".substr($varr,1));


   setAdvNum($num);
   return true;
}

function getAdvNum(){
	
	 $all = ew_ExecuteScalar("SELECT pt_des FROM  paymenttype WHERE pt_id = 2");
		//	 if ($all > 0) return $all;   
		//	 else return 1;
	
	return $all;
}

function setAdvNum($oldnum=false){
	
	
	if($oldnum) $num = $oldnum;
	else $num = getAdvNum()+1;
	
	ew_ExecuteScalar("UPDATE paymenttype SET pt_des = '".$num."' WHERE pt_title = 'ค่าสงเคราะห์ศพล่วงหน้า'");
	
}

function calculateRegis($village_id=false){

$setting = getSetting();
$unitrate = $setting[0]["regis_rate"];

$memberlist = getMemberList('ปกติ');
$village = getVillageList();


global $conn;

$conn->Execute("DELETE FROM subvcalculate WHERE cal_type = 4");
$conn->Execute("DELETE FROM unpaylist WHERE un_pay_type = 4");

$varr = ""; 

foreach ($village as $value){
	
	$paidmember = countPayRegisMemberInvillage($value["village_id"]);
	$allmember = countMemberInvillage($value["village_id"]);
	$unpaymember = $allmember - $paidmember;

	if ($unpaymember > 0){
		 
		
		$conn->Execute("INSERT INTO subvcalculate SET t_code = '".$value["t_code"]."', village_id = '".$value["village_id"]."',cal_type = '4',  cal_date = '".date('Y/m/d')."', count_member = ".$unpaymember.", unit_rate = ".$unitrate.", total = (".$unitrate."*".$unpaymember.")");
		
		
		$lastid = ew_ExecuteScalar("SELECT max(svc_id) FROM subvcalculate");
		
     //  $notpay =  getNotPayDeadList(1,$value["village_id"],$member,true);
	 
	 $mb = getMemberByVillage($value["village_id"]);
	   
	    foreach($mb as $notvalue){
			$varr .=",(".$lastid.",".getMemberIdByCode($notvalue["member_code"]).",4)";	
		}
		
		
	} // end if

}  // end for


$conn->Execute("INSERT INTO unpaylist (svc_id, un_member_id, un_pay_type) VALUES ".substr($varr,1));


   return true;
}



function calculateAnnualfee($year=false){

$setting = getSetting();
$unitrate = $setting[0]["regis_rate"];

$memberlist = getMemberList('ปกติ');
$village = getVillageList();


global $conn;

$conn->Execute("DELETE FROM subvcalculate WHERE cal_type = 3");
$conn->Execute("DELETE FROM unpaylist WHERE un_pay_type = 3");

$varr = ""; 
$k = 0;

foreach ($village as $value){
	
	$paidmember = countPayAnnualInvillage($value["village_id"],$year);
	$allmember = countMemberInvillage($value["village_id"]);
	$unpaymember = $allmember - $paidmember;

	if ($unpaymember > 0){
		
		
		$conn->Execute("INSERT INTO subvcalculate SET t_code = '".$value["t_code"]."', village_id = '".$value["village_id"]."',cal_type = '3',  cal_date = '".date('Y/m/d')."', count_member = ".$unpaymember.", unit_rate = ".$unitrate.", total = (".$unitrate."*".$unpaymember."), cal_detail = '".$year."'");
		
		
		$lastid = ew_ExecuteScalar("SELECT max(svc_id) FROM subvcalculate");
		
     //  $notpay =  getNotPayDeadList(1,$value["village_id"],$member,true);
	 
	 $mb = getMemberByVillage($value["village_id"]);
	   
	    foreach($mb as $notvalue){

 			$varr .=",(".$lastid.",".getMemberIdByCode($notvalue["member_code"]).",3)";

		}
		
	} // end if 
	
}  // end for
$conn->Execute("INSERT INTO unpaylist (svc_id, un_member_id, un_pay_type) VALUES ".substr($varr,1));

   return true;
}



function calculateOther($detail,$unitrate){

$setting = getSetting();

$memberlist = getMemberList('ปกติ');
$village = getVillageList();


global $conn;

//$conn->Execute("DELETE FROM subvcalculate WHERE cal_type = 5 AND cal_detail = '".$detail."'");
//$conn->Execute("DELETE FROM unpaylist WHERE un_pay_type = 5");

$varr = ""; 

foreach ($village as $value){
	
	$paidmember = countPayOtherInvillage($value["village_id"],$detail);

	$allmember = countMemberInvillage($value["village_id"]);
	$unpaymember = $allmember - $paidmember;

	if ($unpaymember > 0){
		
		$conn->Execute("INSERT INTO subvcalculate SET t_code = '".$value["t_code"]."', village_id = '".$value["village_id"]."',cal_type = '5',  cal_date = '".date('Y/m/d')."', count_member = ".$unpaymember.", unit_rate = ".$unitrate.", total = (".$unitrate."*".$unpaymember."), cal_detail = '".$detail."'");
		
		$lastid = ew_ExecuteScalar("SELECT max(svc_id) FROM subvcalculate");
		
     //  $notpay =  getNotPayDeadList(1,$value["village_id"],$member,true);
	 
	 $mb = getMemberByVillage($value["village_id"]);
	   
	    foreach($mb as $notvalue){
			$varr .=",(".$lastid.",".getMemberIdByCode($notvalue["member_code"]).",5)";	
		}
		
		
	} // end if

}  // end for


$conn->Execute("INSERT INTO unpaylist (svc_id, un_member_id, un_pay_type) VALUES ".substr($varr,1));

   return true;
}


function genInvoiceDuedate($dformat = false){
	
	$setting = getSetting();
	
	$duedate = $setting[0]['invoice_duedate'];
	
	
	$date = date('Y-m-d', strtotime('+'.$duedate.' day'));
	

	$d = explode('-',$date);
	
	if ($dformat) $dd  =  $date;
	else $dd =  "วันที่ ".$d['2']." เดือน ".thaiMonth($d['1'])." พ.ศ. ".thaiYear($d['0']);
	
	return $dd;

	
}

function getInvoiceDuedate($list, $dformat = false){
	
	
	
	$date = ew_ExecuteScalar("SELECT invoice_duedate FROM subvcalculate  WHERE svc_id IN (".$list.")");
	
	
	$d = explode('-',$date);
	
	
	if ($dformat) $dd  =  $date;
	else $dd =  "วันที่ ".$d['2']." เดือน ".thaiMonth($d['1'])." พ.ศ. ".thaiYear($d['0']);
	
	return $dd;

	
}

function getNoticeDuedate($list, $dformat = false){
	
	$setting = getSetting();
	
	$duedate = $setting[0]['notice_duedate'];
	
	
	$in_duedate = getInvoiceDuedate($list,true);
	
	
	$date = date('Y-m-d', strtotime($in_duedate.'+'.$duedate.' day'));
	$d = explode('-',$date);
	
	
	if ($dformat) $dd  =  $date;
	else $dd =  "วันที่ ".$d['2']." เดือน ".thaiMonth($d['1'])." พ.ศ. ".thaiYear($d['0']);
	
	return $dd;

	
}

function getRateByDetail($detail){
	
	
	$rate = ew_ExecuteScalar("SELECT unit_rate FROM subvcalculate  WHERE cal_detail = '".$detail."'");
	return $rate;
}
						   
// getNotPayDeadList
function getNotPayDeadList($vid,$did,$showarr = false){


			global $conn;
			
			
			$paylist = $conn->Execute("SELECT un_member_id, member_code, cal_detail, adv_num FROM  unpaylist LEFT JOIN subvcalculate ON (subvcalculate.svc_id = unpaylist.svc_id) WHERE member_code ='".$did."' AND village_id = ".$vid);
			
			
			
			$arr = $paylist->GetArray();

		    if(! $showarr){ 
		
				$pl = "";

				foreach($arr as $key => $value){

				
					if ($key != 0) $pl .= ", ".getMemberCodeById($value['un_member_id']);
					else $pl .= getMemberCodeById($value['un_member_id']);
				
				}
			 
			}else {
				
				$pl = $arr;	
			}
			return $pl;
			
}
// getNotPayDeadList	

// getNotPayAdvList
function getNotPayAdvList($vid,$num,$showarr = false){

			global $conn;
			
			
			
			$paylist = $conn->Execute("SELECT un_member_id, member_code, cal_detail, adv_num FROM  unpaylist LEFT JOIN subvcalculate ON (subvcalculate.svc_id = unpaylist.svc_id) WHERE adv_num = '".$num."' AND village_id = ".$vid);
			
					
			$arr = $paylist->GetArray();
			
			

		    if(! $showarr){ 
		
				$pl = "";

				foreach($arr as $key => $value){

				
					if ($key != 0) $pl .= ", ".getMemberCodeById($value['un_member_id']);
					else $pl .= getMemberCodeById($value['un_member_id']);
				
				}
			 
			}else {
				
				$pl = $arr;	
			}
			return $pl;
			
			
}
// end

// start
function getNotPayAnnaulList($vid,$year,$showarr = false){

global $conn;
			
			
			
			$paylist = $conn->Execute("SELECT un_member_id, member_code, cal_detail, adv_num FROM  unpaylist LEFT JOIN subvcalculate ON (subvcalculate.svc_id = unpaylist.svc_id) WHERE cal_detail = '".$year."' AND village_id = ".$vid);
			
					
			$arr = $paylist->GetArray();
			
			

		    if(! $showarr){ 
		
				$pl = "";

				foreach($arr as $key => $value){

				
					if ($key != 0) $pl .= ", ".getMemberCodeById($value['un_member_id']);
					else $pl .= getMemberCodeById($value['un_member_id']);
				
				}
			 
			}else {
				
				$pl = $arr;	
			}
			return $pl;
			
			
}
// end


function getNotPayRegisList($vid,$showarr = false){

			global $conn;
			
			
			
			$paylist = $conn->Execute("SELECT un_member_id, member_code, cal_detail, adv_num FROM  unpaylist LEFT JOIN subvcalculate ON (subvcalculate.svc_id = unpaylist.svc_id) WHERE cal_type = 4 AND village_id = ".$vid);
			
					
			$arr = $paylist->GetArray();
			
			

		    if(! $showarr){ 
		
				$pl = "";

				foreach($arr as $key => $value){

				
					if ($key != 0) $pl .= ", ".getMemberCodeById($value['un_member_id']);
					else $pl .= getMemberCodeById($value['un_member_id']);
				
				}
			 
			}else {
				
				$pl = $arr;	
			}
			return $pl;
			
}
// end

function getNotPayOtherList($vid,$detail,$showarr = false){

			global $conn;
			
			
			
			$paylist = $conn->Execute("SELECT un_member_id, member_code, cal_detail, adv_num FROM  unpaylist LEFT JOIN subvcalculate ON (subvcalculate.svc_id = unpaylist.svc_id) WHERE cal_detail = '".$detail."' AND village_id = ".$vid);
			
					
			$arr = $paylist->GetArray();
			
			

		    if(! $showarr){ 
		
				$pl = "";

				foreach($arr as $key => $value){

				
					if ($key != 0) $pl .= ", ".getMemberCodeById($value['un_member_id']);
					else $pl .= getMemberCodeById($value['un_member_id']);
				
				}
			 
			}else {
				
				$pl = $arr;	
			}
			return $pl;
			
			
}
// end

function createOptionList($sql,$field1,$field2=false,$field3=false){
	
	
	global $conn;
	
	$opt = "";
	
	$ar = $conn->Execute($sql);
	
	$arr = $ar->GetArray();
	

	if (count($arr) > 0){
		
		foreach ($arr as $value){
			
			$opt .= "<option value='".$value[$field1]."'>".$value[$field1];
			if ($field2) $opt .= ", ".$value[$field2];
			if ($field3) $opt .= "&nbsp;".$value[$field3];
			$opt.= "</option>";
		}
	}
	
	return $opt;
}


function payCheckDup($mcode, $pay){
	
$setting = getSetting();             

	
	           if($pay['dead_id']){
				   $total = $setting[0]['subvention_rate'];
                if ($total > getAdvanceBudget($mcode)){
                    CurrentPage()->setFailureMessage(getNameById($mcode)."  มียอดเงินสงเคราะห์ล่วงหน้าคงเหลือไม่พอจ่าย   ");
                     return FALSE;                                                                                               
                } else if(subventionPaid($mcode, $pay['dead_id'])){     
                   CurrentPage()->setFailureMessage(getNameById($mcode)."ได้ ชำระค่าสงเคราะห์ศพรายการนี้แล้ว  ");  
                   return FALSE;                                                    
                }                                                                                          
           } // end if pay_sum_type = 2    
           else if($pay['adv_num']){
                  $dup  = ew_ExecuteScalar("SELECT pay_sum_id FROM paymentsummary WHERE member_code = '".$mcode."' AND pay_sum_adv_num = '".$pay['adv_num']."'"); 
                  if ($dup > 0)  {                                                                                                                                           
                   CurrentPage()->setFailureMessage(getNameById($mcode)."ได้ ชำระค่าสงเคราะห์ล่วงหน้ารายการนี้แล้ว  ");  
                   return FALSE;                              
                  }                                                                                       
           } // end if pay_sum_type = 2                     
           else if ($pay['annual_year']){
                  $dup  = ew_ExecuteScalar("SELECT pay_sum_id FROM paymentsummary WHERE member_code = '".$mcode."' AND pay_annual_year = '".$pay['annual_year']."'"); 
                  if ($dup > 0)  {
                   CurrentPage()->setFailureMessage(getNameById($mcode)."ได้ ชำระค่าบำรุงประจำปีรายการนี้แล้ว  ");  
                   return FALSE;                              
                  }                                          
           }  // end if pay_sum_type = 3  
           else if ($pay['regis_pay']){
                  $dup  = ew_ExecuteScalar("SELECT pay_sum_id FROM paymentsummary WHERE member_code = '".$mcode."'"); 
                  if ($dup > 0)  {                                                            
                   CurrentPage()->setFailureMessage(getNameById($mcode)."ได้  ชำระค่าสมัครรายการนี้แล้ว  ");  
                   return FALSE;                                   
                  }       
           }  // end if pay_sum_type = 4   
           else if ($pay['other_detail']){
                  $dup  = ew_ExecuteScalar("SELECT pay_sum_id FROM paymentsummary WHERE member_code = '".$mcode."' AND pay_sum_detail = '".$pay['other_detail']."'"); 
                  
                  if ($dup > 0)  {                                                            
                   CurrentPage()->setFailureMessage(getNameById($mcode)."ได้  ชำระรายการนี้แล้ว  ");  
                   return FALSE;                                   
                  }       
           }  // end if pay_sum_type = 5 
	return true;
	
}// end paycheckdup

function getContactInfo(){
	
$setting = getSetting();

return $setting[0]["contact_info"];
	
}
function createToDo(){
	
	  $html = "<ul>";
	  
	  $subv  = ew_ExecuteScalar("SELECT count(subvc_id) FROM subvcharge WHERE subvc_status = 'รอจ่าย'"); 
	  if ($subv > 0) $html .="<li><a href='subvchargelist.php?x_subvc_status=รอจ่าย'>จ่ายเงินสงเคราะห์ให้กับผู้รับผลประโยชน์ของสมาชิกที่เสียชีวิต จำนวน <b class='red'>$subv</b> ราย</a></li>";
	  
	  
	  $refund = ew_ExecuteScalar("SELECT count(refund_id) FROM refundable WHERE refund_status = 'รอจ่าย'"); 
	  if ($refund > 0) $html .="<li><a href='refundablelist.php?x_refund_status=รอจ่าย'>จ่ายเงินสงเคราะห์ล่วงหน้าคงเหลือให้กับสมาชิกที่ลาออก จำนวน <b class='red'>$refund</b> ราย</a></li>";
	  
	  $invoice = ew_ExecuteScalar("SELECT count(svc_id) FROM subvcalculate WHERE invoice_senddate = '0000-00-00'"); 
	  if ($invoice > 0) $html .="<li><a href='subvcalculatelist.php?cmd=resetall'>ส่งใบแจ้งหนี้รายการค้างชำระ จำนวน <b class='red'>$invoice</b> ราย</a></li>";
	  
	  
	  $notice = ew_ExecuteScalar("SELECT count(svc_id) FROM subvcalculate WHERE invoice_duedate = '".date('Y-m-d')."'"); 
	  if ($notice > 0) $html .="<li><a href='subvcalculatelist.php?x_cal_status=ส่งใบแจ้งหนี้'>ส่งหนังสือเตือนรายการที่ครบกำหนดการจ่าย จำนวน <b class='red'>$notice</b> ราย</a></li>";
	  
	  
	  $terminate = ew_ExecuteScalar("SELECT count(svc_id) FROM subvcalculate WHERE notice_duedate = '".date('Y-m-d')."'"); 
	  if ($terminate > 0) $html .="<li><a href='subvcalculatelist.php?x_cal_status=ส่งหนังสือเตือน'>แจ้งการพ้นสภาพสมาชิกค้างจ่ายเกินกำหนดหลังได้รับหนงสือเตือน จำนวน <b class='red'>$terminate</b> ราย</a></li>";
	  
	$annual = ew_ExecuteScalar("SELECT count(svc_id) FROM subvcalculate WHERE cal_detail = '".thaiYear(date('Y'))."'"); 
	
	if ($annual < 1){
		$setting = getSetting();
		$afd = $setting[0]["annual_fee_duedate"];
		$afddate = explode('-',$afd);

		if ($afddate[1] == date('m') && $afddate[2]== date('d')){
			 $html .="<li><a href='annualfeecalculate.php'>เพิ่มรายการเรียกเก็บเงินค่าบำรุงประจำปี <b class='red'>".thaiYear(date('Y'))."</b></a></li>";
		}
	  
	}
	  
	   $setting = getSetting();
	  
	 if (date('Y-m-d') != $setting[0]["last_export"]) {
	  if ($setting[0]["export_date"] > 0){
	 	 if (((strtotime(date('Y-m-d')) - strtotime($setting[0]["last_export"]))/  ( 60 * 60 * 24 )) == $setting[0]["export_date"]){
			 
			exportDb();
			
		  $html .="<li>ครบกำหนดสำรองข้อมูลอัตโนมัติทุก <b class='red'>".$setting[0]["export_date"]." วัน</b> &nbsp;(ดำเนินการเรียบร้อยแล้ว)</li>";
	 	 }
	  
	  }
	 }
    //  echo date("Y-m-d",strtotime("-2 days",strtotime($adate)));
	  $html .= "</ul>";  
	 
	 return $html;
	
}

function exportDb(){

$setting = getSetting();

if ($setting[0]["export_path"] != "") {
 if (!is_dir($setting[0]["export_path"])) mkdir($setting[0]["export_path"]);
	$path = $setting[0]["export_path"];
}
else {
	if (!is_dir("C:\Softside\BACKUP"))mkdir("C:\Softside\BACKUP");
	$path = "C:\Softside\BACKUP";
	
}

$filename = date('Y.m.d.H.i.s').".db";

//$command="c:wamp\bin\mysql\mysql5.5.24\bin\mysqldump --opt -h localhost -uroot cremation > ".$path."/$filename";
$command="c:xampp\mysql\bin\mysqldump --opt -h localhost -uroot cremation > ".$path."/$filename";
system($command,$worked);
switch($worked){
    case 0:
       
	    CurrentPage()->setSuccessMessage("สำรองข้อมูลสำเร็จ ไฟล์ถูกจัดเก็บไว้ที่ ".$path."\\".$filename);
		
		ew_ExecuteScalar("UPDATE setting SET last_export = '".date('Y-d-m')."' WHERE setting_id = 1");
		
        break;
    case 1:
        CurrentPage()->setFailureMessage("พบปัญหาระหว่างการสำรองข้อมูล โปรดลองอีกครั้ง");  
        break;
    case 2:
       CurrentPage()->setFailureMessage("สำรองข้อมูลไม่สำเร็จ");  
        break;

} 

}

function importDb($f){

$f = $_FILES;

if (file_exists("tmp/db.sql")) unlink("tmp/db.sql");

$new_name = "tmp/db.sql";
move_uploaded_file($f['tmp_name'],$new_name);


//DONT EDIT BELOW THIS LINE
//Export the database and output the status to the page
//$command="c:wamp\bin\mysql\mysql5.5.24\bin\mysql -h localhost -uroot cremation < $new_name";
$command="c:xampp\mysql\bin\mysql -h localhost -uroot cremation < $new_name";
system($command,$worked);
switch($worked){
    case 0:
        CurrentPage()->setSuccessMessage("นำเข้าข้อมูลสำเร็จ");
		if (file_exists("tmp/db.sql")) unlink("tmp/db.sql");
        break;
    case 1:
        CurrentPage()->setFailureMessage("นำเข้าข้อมูลไม่สำเร็จ"); 
		if (file_exists("tmp/db.sql")) unlink("tmp/db.sql");
    break;
}

}


function speedCheck($sql){
	
$time1 =  microtime();
ew_ExecuteScalar($sql);
$time2 = microtime();

$speed =  ($time2 - $time1);

$lastid = ew_ExecuteScalar("SELECT max(pay_sum_id) FROM paymentsummary");

ew_ExecuteScalar("DELETE FROM paymentsummary WHERE pay_sum_id = $lastid");

return $speed;

}

function emptyNotPay(){
	
	$count = ew_ExecuteScalar("SELECT count(svc_id) FROM subvcalculate WHERE 1");
	if ($count > 0) return false;
	else return true;
}
?>
