<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>
<?
	if (CModule::IncludeModule("form"))
	{
		$FORM_ID = 1;
			$arValues = array (				
				"form_text_1" => htmlspecialchars($_POST['product_name']),
				"form_email_2" => trim(htmlspecialchars($_POST['product_price'])),
				"form_textarea_3" => htmlspecialchars($_POST['product_url']),
				"form_text_33" => date("Y-m-d H:i:s")
			);
			
			
			if( $RESULT_ID = CFormResult::Add($FORM_ID, $arValues) ){
				//echo "data has been sent, ID - ".$RESULT_ID;				

				$FORM_ID = $FORM_ID;
				$RESULT_ID = $RESULT_ID;
	
				if ($FORM_ID > 0 && $RESULT_ID > 0)
				{
					$leadId = CFormCrm::AddLead($FORM_ID, $RESULT_ID);
					if ($leadId > 0)
					{
						$result = '{"result":"ok",ID:'.intval($leadId).'}';
						echo $result;
					}
					else
					{
						if ($ex = $APPLICATION->GetException())
						{
							$result = '{"result":"error","error":"'.CUtil::JSEscape($ex->GetString()).'"}';
							echo $result;
						}
					}
				}	
			}
	}
?>
