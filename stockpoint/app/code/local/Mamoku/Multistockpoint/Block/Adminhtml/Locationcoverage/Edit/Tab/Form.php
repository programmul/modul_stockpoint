<?php
class Mamoku_Multistockpoint_Block_Adminhtml_Locationcoverage_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
		protected function _prepareForm()
		{

				$form = new Varien_Data_Form();
				$this->setForm($form);
				?>

				<script>
				var ajaxku;
				var u = "<?php echo $this->getBaseUrl();?>";
				var loc = u.replace('index.php/','');
				function ajaxkota(prop){
				    ajaxku = buatajax();    
				    var url= loc + "select_kotaadmin.php";
				    url=url+"?prop="+prop;
				    //url=url+"&sid="+Math.random();
				    ajaxku.onreadystatechange=stateChanged;
				    ajaxku.open("GET",url,true);
				    ajaxku.send(null);
				}

				function ajaxkec(prop,city){   
				    ajaxku = buatajax();
				    var url=loc + "select_kotaadmin.php";
				    url=url+"?prop="+prop;
				    url=url+"&city="+city;
				    //url=url+"&sid="+Math.random();
				    ajaxku.onreadystatechange=stateChangedKec;
				    ajaxku.open("GET",url,true);
				    ajaxku.send(null);
				}

				function ajaxkel(prop,city,kecamatan){
				    ajaxku = buatajax();
				    var url=loc + "select_kotaadmin.php";
				    url=url+"?prop="+prop;
				    url=url+"&city="+city;
				    url=url+"&kecamatan="+kecamatan;
				    ajaxku.onreadystatechange=stateChangedKel;
				    ajaxku.open("GET",url,true);
				    ajaxku.send(null);
				}

				function buatajax(){
				    if (window.XMLHttpRequest){
				    return new XMLHttpRequest();
				    }
				    if (window.ActiveXObject){
				    return new ActiveXObject("Microsoft.XMLHTTP");
				    }
				    return null;
				}
				function stateChanged(){
				    var data;
				    if (ajaxku.readyState==4){
				    data=ajaxku.responseText;
				    if(data.length>=0){
				    document.getElementById("kota").innerHTML = data
				    }else{
				    document.getElementById("kota").value = "<option selected>Pilih Kota/Kab</option>";
				    }
				    }
				}

				function stateChangedKec(){
				    var data;
				    if (ajaxku.readyState==4){
				    data=ajaxku.responseText;
				    if(data.length>=0){
				    document.getElementById("kecamatan").innerHTML = data
				    }else{
				    document.getElementById("kecamatan").value = "<option selected>Pilih Kecamatan</option>";
				    }
				    }
				}

				function stateChangedKel(){
				    var data;
				    if (ajaxku.readyState==4){
				    data=ajaxku.responseText;
				    if(data.length>=0){
				    document.getElementById("kelurahan").innerHTML = data
				    }else{
				    document.getElementById("kelurahan").value = "<option selected>Pilih Kelurahan/Desa</option>";
				    }
				    }
				}
				</script>
				<?php
				$fieldset = $form->addFieldset("multistockpoint_form", array("legend"=>Mage::helper("multistockpoint")->__("Item information")));

						$collection = Mage::getModel('multistockpoint/stockpoint')->getCollection();
						//echo $collection;
						$newlocCode = array();
						foreach ($collection as $locCode) {
							$newlocCode[''] = "Please Select";
							$newlocCode[$locCode->getCode()] = $locCode->getCode();
						}
						$fieldset->addField("stockpoint_code", "select", array(
						"label" => Mage::helper("multistockpoint")->__("location code"),					
						"class" => "required-entry",
						"required" => true,
						"values" => $newlocCode,
						"name" => "stockpoint_code",
						));
						$connection = Mage::getSingleton('core/resource')->getConnection('core_read');  
                        $sql= "SELECT distinct propinsi FROM mamoku_lokasi";
                        $rows = $connection->fetchAll($sql);
                        $newrow = array();
                        foreach( $rows as $row){
                        			$newrow[''] = "Please Select";
                                    $newrow[$row['propinsi']] =  $row['propinsi'];
                                }                          

						$fieldset->addField("propinsi", "select", array(
						"label" => Mage::helper("multistockpoint")->__("propinsi"),					
						"class" => "required-entry",
						"values"=> $newrow,
						"onchange" => "javascript:ajaxkota(this.value)",
						"required" => true,
						"name" => "propinsi",
						));
						
						$sql= "SELECT distinct city FROM mamoku_lokasi";
                        $rows = $connection->fetchAll($sql);
                        $newrow = array();
                        foreach( $rows as $row){
                        			$newrow[''] = "Please Select";
                                    $newrow[$row['city']] =  $row['city'];
                                }                          

						$fieldset->addField("kota", "select", array(
						"label" => Mage::helper("multistockpoint")->__("kota"),					
						"class" => "required-entry",
						"values" => $newrow,
						"onchange" => "javascript:ajaxkec(propinsi.value,this.value)",
						"required" => true,
						"name" => "kota",
						));

						$sql= "SELECT distinct kecamatan FROM mamoku_lokasi";
                        $rows = $connection->fetchAll($sql);
                        $newrow = array();
                        foreach( $rows as $row){
                        			$newrow[''] = "Please Select";
                                    $newrow[$row['kecamatan']] =  $row['kecamatan'];
                                }					
						$fieldset->addField("kecamatan", "select", array(
						"label" => Mage::helper("multistockpoint")->__("kecamatan"),					
						"class" => "required-entry",
						"values" => $newrow,
						"onchange" => "javascript:ajaxkel(propinsi.value,kota.value,this.value)",
						"required" => true,
						"name" => "kecamatan",
						));
						
						$sql= "SELECT distinct kelurahan FROM mamoku_lokasi";
                        $rows = $connection->fetchAll($sql);
                        $newrow = array();
                        foreach( $rows as $row){
                        			$newrow[''] = "Please Select";
                                    $newrow[$row['kelurahan']] =  $row['kelurahan'];
                                }
						$fieldset->addField("kelurahan", "select", array(
						"label" => Mage::helper("multistockpoint")->__("kelurahan"),					
						"class" => "required-entry",
						"values" => $newrow,
						"required" => true,
						"name" => "kelurahan",
						));
					
						

				if (Mage::getSingleton("adminhtml/session")->getLocationcoverageData())
				{
					$form->setValues(Mage::getSingleton("adminhtml/session")->getLocationcoverageData());
					Mage::getSingleton("adminhtml/session")->setLocationcoverageData(null);
				} 
				elseif(Mage::registry("locationcoverage_data")) {
				    $form->setValues(Mage::registry("locationcoverage_data")->getData());
				}
				return parent::_prepareForm();
		}
}
