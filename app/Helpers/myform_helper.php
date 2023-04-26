<?php  
// if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//  
// ダウンメニュー出力
//

  function show_select_amount($select,$name,$default,$input,$amount,$kbn_return,$kbn_exchange,$dat_returns,$dat_exchange,$add) {

	if(!$default){
		$default=$input;
	}
	if($select==1 && $kbn_exchange==1){

			return '<font color="red">交換対象外です</font>';
	}
	if($select==3 && $kbn_exchange==1){

			return '<font color="red">交換対象外です</font>';
	}
	if($select==2 && $kbn_return==1){

			return '<font color="red">返品対象外です</font>';
	}
	if($select==4 && $kbn_return==1){

			return '<font color="red">返品対象外です</font>';
	}
	$max=$amount-$dat_returns-$dat_exchange;
	$select_array["0"]="0";
	for($i=1;$i<=$max;$i++){

		if($i<=9){
			$select_array[$i]=$i."　";
		}else if($i==10 ){
			if($max>10){
				$select_array[-1]="10以上";
			}else{
				$select_array[$i]=$i."　";

			}
		}else{


		}

	}


    $field = '<select name="' . $name . '" id="' . $name . '"  '.$add. ' >';

   //  foreach (list($value,$columns ) = each($select_array)) {
     foreach ($select_array as $value=>$text) {
      $field .= '<option value="' . $value . '"';
      if ( $default == $value )
	  {
        $field .= ' SELECTED';
      }
      $field .= '>' . $text  . '</option>';
    }
    $field .= '</select>';

    return $field;
  }
//
//
  function show_text_amount($select,$name,$default,$input,$s_no,$inp_s_no,$amount,$kbn_return,$kbn_exchange,$dat_returns,$dat_exchange) {
	if(!$default){
		$default=$input;
	}
	if($select==1 && $kbn_exchange==1){

			return '<font color="red">交換対象外です</font>';
	}
	if($select==3 && $kbn_exchange==1){

			return '<font color="red">交換対象外です</font>';
	}
	if($select==2 && $kbn_return==1){

			return '<font color="red">返品対象外です</font>';
	}
	if($select==4 && $kbn_return==1){

			return '<font color="red">返品対象外です</font>';
	}
	$max=$amount-$dat_returns-$dat_exchange;
	$display="none";
	if($s_no==-1){
		$display="";
	}
	if($inp_s_no==-1){
		$display="";
	}
	if($max>10 || $display==""){
		    return  '<input name="'.$name.'" type="tel" id="'.$name.'" value="'.$default.'"  MAXLENGTH="3" size="3"   style="ime-mode: inactive;display: '.$display.';" class="" >';
	}else{
			return '';

	}

  }

////
//  エラーメッセーのclassチェック         
  function show_thismsg($msgs) {

		if(!$msgs){

				return "";
		}

		foreach($msgs as $msg){
			$str.=FORM_ERR_PREFIX.$msg.FORM_ERR_SUFFIX;
		}

	return $str;
  }

/* End of file form_helper.php */
/* Location: ./system/helpers/form_helper.php */