<meta http-equiv="Content-Type" content="text/HTML; charset=utf-8" />
 	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
 	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<?php
 include 'Classes/PHPExcel/IOFactory.php';//kullandığımız kütüphane

 // submit başı
if (isset($_POST["submit"])) {
	$dizin = 'dosya/';
	$yuklenecek_dosya = $dizin . basename($_FILES['profilDosyasi']['name']);
	$yuklenecek_dosya2 = $dizin . basename($_FILES['networkDosyasi']['name']);


if ((move_uploaded_file($_FILES['profilDosyasi']['tmp_name'], $yuklenecek_dosya)) && (move_uploaded_file($_FILES['networkDosyasi']['tmp_name'], $yuklenecek_dosya2)))
{
require_once("veritabani.php");
$inputFileName = $yuklenecek_dosya;
$inputFileName2 = $yuklenecek_dosya2;
$inputFileName3 = "dosya/ogrencilistesi.xlsx";
$objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
$objPHPExcel2 = PHPExcel_IOFactory::load($inputFileName2);
$objPHPExcel3 = PHPExcel_IOFactory::load($inputFileName3);
$excel_satirlar = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);//excel dosyasındaki aktif sekme kullanılıyor
$excel_satirlar2 = $objPHPExcel2->getActiveSheet()->toArray(null,true,true,true);//excel dosyasındaki aktif sekme kullanılıyor
$excel_satirlar3 = $objPHPExcel3->getActiveSheet()->toArray(null,true,true,true);//excel dosyasındaki aktif sekme kullanılıyor
 
foreach($excel_satirlar as $excel_satir){
    $sorgu1 = "INSERT INTO profil (ogrenciNo, secim1, secim2,secim3,secim4,secim5,secim6,secim7,secim8,secim9,secim10,secim11,secim12,secim13,secim14,secim15)
VALUES ('".$excel_satir['A']."', '".$excel_satir['B']."', '".$excel_satir['C']."', '".$excel_satir['D']."', '".$excel_satir['E']."', '".$excel_satir['F']."', '".$excel_satir['G']."', '".$excel_satir['H']."', '".$excel_satir['I']."', '".$excel_satir['J']."', '".$excel_satir['K']."', '".$excel_satir['L']."', '".$excel_satir['M']."', '".$excel_satir['N']."', '".$excel_satir['O']."', '".$excel_satir['P']."')";

	$conn->query($sorgu1);
    
    //bu kısımdan sonra verileri nasıl işlemek istiyorsanız ona göre kodları yazmamış gerekiyor. örneğin veri tabanına kaydetmek.
    }

     foreach($excel_satirlar2 as $excel_satir2){
    $sorgu2 = "INSERT INTO network (ogrenciNo, ogrNo1, ogrNo2,ogrNo3,ogrNo4,ogrNo5,ogrNo6,ogrNo7,ogrNo8,ogrNo9,ogrNo10)
VALUES ('".$excel_satir2['A']."', '".$excel_satir2['B']."', '".$excel_satir2['C']."', '".$excel_satir2['D']."', '".$excel_satir2['E']."', '".$excel_satir2['F']."', '".$excel_satir2['G']."', '".$excel_satir2['H']."', '".$excel_satir2['I']."', '".$excel_satir2['J']."', '".$excel_satir2['K']."')";

	$conn->query($sorgu2);
    
    
    //bu kısımdan sonra verileri nasıl işlemek istiyorsanız ona göre kodları yazmamış gerekiyor. örneğin veri tabanına kaydetmek.
    }

    foreach($excel_satirlar3 as $excel_satir3){
    $sorgu3 = "INSERT INTO liste (ogrenciNo, adSoyad)
VALUES ('".$excel_satir3['A']."', '".$excel_satir3['B']."')";

	$conn->query($sorgu3);
    
    
    //bu kısımdan sonra verileri nasıl işlemek istiyorsanız ona göre kodları yazmamış gerekiyor. örneğin veri tabanına kaydetmek.
    }

}
else {
    echo "Dosya yükleme hatası!\n";
}
}
// submit sonu

if (isset($_POST["model"])) {
  require_once("veritabani.php");
  $ogrNo = $_POST["ogrNo"];
  $ogrNoPost = $ogrNo;
  $kisiSayisi=0;
  $Beta = array(1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1);
  $yeniBeta = array();
  $toplam1;
  $toplam2;
  $maxIterSayisi=100;
  $stepSize=0.001;
  $egitimSeti = array();
  $testSeti = array();
  $hx=0;
  $hbx=0; 	
  $sql = "Select * from network where ogrenciNo='".$ogrNo."'";
  $sonuc = $conn->query($sql);
  if ($sonuc->num_rows > 0) 
  {
    while($satir = $sonuc->fetch_assoc()) 
    {
    	if ($satir["ogrNo1"] != "") {
    		$sql2 = "Select * from profil where ogrenciNo='".$satir["ogrNo1"]."'";
    		$ogrNo = $satir["ogrNo1"];
    		$arkadas[0] = $ogrNo;
  			$sonuc2 = $conn->query($sql2);
    		while($satir2 = $sonuc2->fetch_assoc()) {
    			$model0 = array(null,$ogrNo,$satir2["secim1"],$satir2["secim2"],$satir2["secim3"],$satir2["secim4"],$satir2["secim5"],$satir2["secim6"],$satir2["secim7"],$satir2["secim8"],$satir2["secim9"],$satir2["secim10"],$satir2["secim11"],$satir2["secim12"],$satir2["secim13"],$satir2["secim14"],$satir2["secim15"],1);
    			array_push($egitimSeti, $model0);
    		}
    	}
    	if ($satir["ogrNo2"] != "") {
    		$sql2 = "Select * from profil where ogrenciNo='".$satir["ogrNo2"]."'";
    		$ogrNo = $satir["ogrNo2"];
    		$arkadas[1] = $ogrNo;
  			$sonuc2 = $conn->query($sql2);
    		while($satir2 = $sonuc2->fetch_assoc()) {
    			$model1 = array(null,$ogrNo,$satir2["secim1"],$satir2["secim2"],$satir2["secim3"],$satir2["secim4"],$satir2["secim5"],$satir2["secim6"],$satir2["secim7"],$satir2["secim8"],$satir2["secim9"],$satir2["secim10"],$satir2["secim11"],$satir2["secim12"],$satir2["secim13"],$satir2["secim14"],$satir2["secim15"],1);
    			array_push($egitimSeti, $model1);

    		}
    	}
    	if ($satir["ogrNo3"] != "") {
    		$sql2 = "Select * from profil where ogrenciNo='".$satir["ogrNo3"]."'";
    		$ogrNo = $satir["ogrNo3"];
    		$arkadas[2] = $ogrNo;
  			$sonuc2 = $conn->query($sql2);
    		while($satir2 = $sonuc2->fetch_assoc()) {
    			$model2 = array(null,$ogrNo,$satir2["secim1"],$satir2["secim2"],$satir2["secim3"],$satir2["secim4"],$satir2["secim5"],$satir2["secim6"],$satir2["secim7"],$satir2["secim8"],$satir2["secim9"],$satir2["secim10"],$satir2["secim11"],$satir2["secim12"],$satir2["secim13"],$satir2["secim14"],$satir2["secim15"],1);
    			array_push($egitimSeti, $model2);

    		}
    	}
    	if ($satir["ogrNo4"] != "") {
    		$sql2 = "Select * from profil where ogrenciNo='".$satir["ogrNo4"]."'";
    		$ogrNo = $satir["ogrNo4"];
    		$arkadas[3] = $ogrNo;
  			$sonuc2 = $conn->query($sql2);
    		while($satir2 = $sonuc2->fetch_assoc()) {
    			$model3 = array(null,$ogrNo,$satir2["secim1"],$satir2["secim2"],$satir2["secim3"],$satir2["secim4"],$satir2["secim5"],$satir2["secim6"],$satir2["secim7"],$satir2["secim8"],$satir2["secim9"],$satir2["secim10"],$satir2["secim11"],$satir2["secim12"],$satir2["secim13"],$satir2["secim14"],$satir2["secim15"],1);
    			array_push($egitimSeti, $model3);

    		}
    	}
    	if ($satir["ogrNo5"] != "") {
    		$sql2 = "Select * from profil where ogrenciNo='".$satir["ogrNo5"]."'";
    		$ogrNo = $satir["ogrNo5"];
    		$arkadas[4] = $ogrNo;
  			$sonuc2 = $conn->query($sql2);
    		while($satir2 = $sonuc2->fetch_assoc()) {
    			$model4 = array(null,$ogrNo,$satir2["secim1"],$satir2["secim2"],$satir2["secim3"],$satir2["secim4"],$satir2["secim5"],$satir2["secim6"],$satir2["secim7"],$satir2["secim8"],$satir2["secim9"],$satir2["secim10"],$satir2["secim11"],$satir2["secim12"],$satir2["secim13"],$satir2["secim14"],$satir2["secim15"],1);
    			array_push($egitimSeti, $model4);

    		}
    	}
    	if ($satir["ogrNo6"] != "") {
    		$sql2 = "Select * from profil where ogrenciNo='".$satir["ogrNo6"]."'";
    		$ogrNo = $satir["ogrNo6"];
    		$arkadas[5] = $ogrNo;
  			$sonuc2 = $conn->query($sql2);
    		while($satir2 = $sonuc2->fetch_assoc()) {
    			$model5 = array(null,$ogrNo,$satir2["secim1"],$satir2["secim2"],$satir2["secim3"],$satir2["secim4"],$satir2["secim5"],$satir2["secim6"],$satir2["secim7"],$satir2["secim8"],$satir2["secim9"],$satir2["secim10"],$satir2["secim11"],$satir2["secim12"],$satir2["secim13"],$satir2["secim14"],$satir2["secim15"],1);
    			array_push($egitimSeti, $model5);

    		
    		}
    	}
    	if ($satir["ogrNo7"] != "") {
    		$sql2 = "Select * from profil where ogrenciNo='".$satir["ogrNo7"]."'";
    		$ogrNo = $satir["ogrNo7"];
    		$arkadas[6] = $ogrNo;
  			$sonuc2 = $conn->query($sql2);
    		while($satir2 = $sonuc2->fetch_assoc()) {
    			$model6 = array(null,$ogrNo,$satir2["secim1"],$satir2["secim2"],$satir2["secim3"],$satir2["secim4"],$satir2["secim5"],$satir2["secim6"],$satir2["secim7"],$satir2["secim8"],$satir2["secim9"],$satir2["secim10"],$satir2["secim11"],$satir2["secim12"],$satir2["secim13"],$satir2["secim14"],$satir2["secim15"],1);
    			array_push($egitimSeti, $model6);

    			
    		}
    	}
    	if ($satir["ogrNo8"] != "") {
    		$sql2 = "Select * from profil where ogrenciNo='".$satir["ogrNo8"]."'";
    		$ogrNo = $satir["ogrNo8"];
    		$arkadas[7] = $ogrNo;
  			$sonuc2 = $conn->query($sql2);
    		while($satir2 = $sonuc2->fetch_assoc()) {
    			$model7 = array(null,$ogrNo,$satir2["secim1"],$satir2["secim2"],$satir2["secim3"],$satir2["secim4"],$satir2["secim5"],$satir2["secim6"],$satir2["secim7"],$satir2["secim8"],$satir2["secim9"],$satir2["secim10"],$satir2["secim11"],$satir2["secim12"],$satir2["secim13"],$satir2["secim14"],$satir2["secim15"],1);
    			array_push($egitimSeti, $model7);

    			
    		}
    	}
    	if ($satir["ogrNo9"] != "") {
    		$sql2 = "Select * from profil where ogrenciNo='".$satir["ogrNo9"]."'";
    		$ogrNo = $satir["ogrNo9"];
    		$arkadas[8] = $ogrNo;
  			$sonuc2 = $conn->query($sql2);
    		while($satir2 = $sonuc2->fetch_assoc()) {
    			$model8 = array(null,$ogrNo,$satir2["secim1"],$satir2["secim2"],$satir2["secim3"],$satir2["secim4"],$satir2["secim5"],$satir2["secim6"],$satir2["secim7"],$satir2["secim8"],$satir2["secim9"],$satir2["secim10"],$satir2["secim11"],$satir2["secim12"],$satir2["secim13"],$satir2["secim14"],$satir2["secim15"],1);
    			array_push($egitimSeti, $model8);

    			
    		}
    	}
    	if ($satir["ogrNo10"] != "") {
    		$sql2 = "Select * from profil where ogrenciNo='".$satir["ogrNo10"]."'";
    		$ogrNo = $satir["ogrNo10"];
    		$arkadas[9] = $ogrNo;
  			$sonuc2 = $conn->query($sql2);
    		while($satir2 = $sonuc2->fetch_assoc()) {
    			$model9 = array(null,$ogrNo,$satir2["secim1"],$satir2["secim2"],$satir2["secim3"],$satir2["secim4"],$satir2["secim5"],$satir2["secim6"],$satir2["secim7"],$satir2["secim8"],$satir2["secim9"],$satir2["secim10"],$satir2["secim11"],$satir2["secim12"],$satir2["secim13"],$satir2["secim14"],$satir2["secim15"],1);
    			array_push($egitimSeti, $model9);
    		}
    	}
    		
    }
    // while sonu


    		$sql3 = "Select * from profil";
    		$modelim = array();
  			$sonuc3 = $conn->query($sql3);
    		while($satir3 = $sonuc3->fetch_assoc()) {
    			if (($satir3["ogrenciNo"] != $arkadas[0])&&($satir3["ogrenciNo"] != $arkadas[1])&&($satir3["ogrenciNo"] != $arkadas[2])&&($satir3["ogrenciNo"] != $arkadas[3])&&($satir3["ogrenciNo"] != $arkadas[4])&&($satir3["ogrenciNo"] != $arkadas[5])&&($satir3["ogrenciNo"] != $arkadas[6])&&($satir3["ogrenciNo"] != $arkadas[7])&&($satir3["ogrenciNo"] != $arkadas[8])&&($satir3["ogrenciNo"] != $arkadas[9])&&($satir3["ogrenciNo"] != $ogrNoPost))
    			{
    			$ilk = array(null,$satir3["ogrenciNo"],$satir3["secim1"],$satir3["secim2"],$satir3["secim3"],$satir3["secim4"],$satir3["secim5"],$satir3["secim6"],$satir3["secim7"],$satir3["secim8"],$satir3["secim9"],$satir3["secim10"],$satir3["secim11"],$satir3["secim12"],$satir3["secim13"],$satir3["secim14"],$satir3["secim15"],0);
    			array_push($modelim, $ilk);
    			$kisiSayisi++;
    			}
    		}
    			
    		for ($i=0;$i < $kisiSayisi/2;$i++) {
    			array_push($egitimSeti, $modelim[$i]);
    		}

    		for ($i=($kisiSayisi/2)+1;$i < $kisiSayisi;$i++) {
    			array_push($testSeti, $modelim[$i]);
    		}
    		
    		
    		
    		for ($t=1;$t<=$maxIterSayisi;$t++) 
    		{
    			for ($i=0;$i<sizeof($egitimSeti);$i++) 
    			{
    			$hx = -($Beta[0]+$Beta[1]*$egitimSeti[$i][2]+$Beta[2]*$egitimSeti[$i][3]+$Beta[3]*$egitimSeti[$i][4]+$Beta[4]*$egitimSeti[$i][5]+$Beta[5]*$egitimSeti[$i][6]+$Beta[6]*$egitimSeti[$i][7]+$Beta[7]*$egitimSeti[$i][8]+$Beta[8]*$egitimSeti[$i][9]+$Beta[9]*$egitimSeti[$i][10]+$Beta[10]*$egitimSeti[$i][11]+$Beta[11]*$egitimSeti[$i][12]+$Beta[12]*$egitimSeti[$i][13]+$Beta[13]*$egitimSeti[$i][14]+$Beta[14]*$egitimSeti[$i][15]+$Beta[15]*$egitimSeti[$i][16]);

    			$hxx = pow(M_E, $hx);
    			$hbx = 1/(1+$hxx);
    			$toplam1 += $hbx - $egitimSeti[$i][17];
    			//echo "<-".$toplam1."->";
    			}
    			
    			$yeniBeta[0] = $Beta[0] - ($stepSize * $toplam1 / sizeof($egitimSeti));
    			
    			for ($j=1;$j<=15;$j++)
    			{
    				for ($i=0;$i<sizeof($egitimSeti);$i++)
    				{
    					$hx = -($Beta[0]+$Beta[1]*$egitimSeti[$i][2]+$Beta[2]*$egitimSeti[$i][3]+$Beta[3]*$egitimSeti[$i][4]+$Beta[4]*$egitimSeti[$i][5]+$Beta[5]*$egitimSeti[$i][6]+$Beta[6]*$egitimSeti[$i][7]+$Beta[7]*$egitimSeti[$i][8]+$Beta[8]*$egitimSeti[$i][9]+$Beta[9]*$egitimSeti[$i][10]+$Beta[10]*$egitimSeti[$i][11]+$Beta[11]*$egitimSeti[$i][12]+$Beta[12]*$egitimSeti[$i][13]+$Beta[13]*$egitimSeti[$i][14]+$Beta[14]*$egitimSeti[$i][15]+$Beta[15]*$egitimSeti[$i][16]);

    					$hxx = pow(M_E, $hx);
    					$hbx = 1/(1+$hxx);
    					$toplam2 += ($hbx-$egitimSeti[$i][17])*$egitimSeti[$i][$j];
    				}

    				$yeniBeta[$j] = $Beta[$j] - ($stepSize * $toplam2 / sizeof($egitimSeti));
    			}

    			for ($i=0; $i < sizeof($Beta); $i++) { 
    				$Beta[$i] = $yeniBeta[$i];
    			}

    		}

    		// iterasyon for sonu

    		// test seti başlangıç

    		for ($i=0; $i < sizeof($testSeti); $i++) { 
    			$hx = -($Beta[0]+$Beta[1]*$testSeti[$i][2]+$Beta[2]*$testSeti[$i][3]+$Beta[3]*$testSeti[$i][4]+$Beta[4]*$testSeti[$i][5]+$Beta[5]*$testSeti[$i][6]+$Beta[6]*$testSeti[$i][7]+$Beta[7]*$testSeti[$i][8]+$Beta[8]*$testSeti[$i][9]+$Beta[9]*$testSeti[$i][10]+$Beta[10]*$testSeti[$i][11]+$Beta[11]*$testSeti[$i][12]+$Beta[12]*$testSeti[$i][13]+$Beta[13]*$testSeti[$i][14]+$Beta[14]*$testSeti[$i][15]+$Beta[15]*$testSeti[$i][16]);

    					$hxx = pow(M_E, $hx);
    					$hbx = 1/(1+$hxx);
    				if ($testSeti[$i][17] == 0)
    					$testSeti[$i][0] = $hbx;  

    		}

    		// test seti sonu

    		for ($i=0; $i < sizeof($testSeti); $i++) { 
    			sort($testSeti);
    		}
    		echo "<center> <h1>Önerilen Arkadaşlar</h1> </center>";
        $sql5 = "Select * from liste where ogrenciNo=".$ogrNoPost;
      $sonuc5 = $conn->query($sql5);
      $satir5 = $sonuc5->fetch_assoc();
      echo "<hr><center><h2>Test Yapılan Kişi : ".$satir5["adSoyad"]."</h2></center>";
    		echo "<div class='row'>";
    		//for ($i=0; $i < 10; $i++) {
        $sayac=0;
        $i=0;
        while ($sayac < 10) {
          if ($testSeti[$i][17] == 0) 
          {
            $sql4 = "Select * from liste where ogrenciNo=".$testSeti[$i][1];
          $sonuc4 = $conn->query($sql4);
          
          while($satir4 = $sonuc4->fetch_assoc()) {
            
            echo "<div class='col-mb-5'> <div class='card' style='width: 17rem;'>
  <div class='card-body'>
    <h5 class='card-title'>".$testSeti[$i][1]."</h5>
    <a href='#' class='btn btn-primary'>".$satir4["adSoyad"]."</a></div></div></div>";
          $sayac++;
          }
          
          }
          $i++; 
        }
    			
    			
    		//}
			echo "</div>";
      
  }
  else 
  {
    echo "<center><h1>KAYIT BULUNAMADI </h1></center>";
  }   
}


   

    ?>
    <p></p>
    <center>
    <form action="giris.php" method="post">
   		 <div class="form-group" style="text-align: center; width: 200px;">
    		<input type="text" class="form-control" id="ogrNo" name="ogrNo" placeholder="Öğrenci Numarası">
  		</div>
  		<div style="text-align: center;">
    			<button type="submit" class="btn btn-primary" name="model">BUL</button>
    		</div>
    </form>
    <form action="cikis.php">
    	<center><button type="submit" class="btn btn-primary">UYGULAMADAN ÇIKIŞ</button></center>
    </form>

    <?php
    if ($egitimSeti != "") {
    echo "<div class='table-responsive'>
    <table class='table table-bordered table-hover'>
  <thead>
    <tr>
      <th scope='col'>Öğrenci Numarası</th>
      <th scope='col'>Alan1</th>
      <th scope='col'>Alan2</th>
      <th scope='col'>Alan3</th>
      <th scope='col'>Alan4</th>
      <th scope='col'>Alan5</th>
      <th scope='col'>Alan6</th>
      <th scope='col'>Alan7</th>
      <th scope='col'>Alan8</th>
      <th scope='col'>Alan9</th>
      <th scope='col'>Alan10</th>
      <th scope='col'>Alan11</th>
      <th scope='col'>Alan12</th>
      <th scope='col'>Alan13</th>
      <th scope='col'>Alan14</th>
      <th scope='col'>Alan15</th>
      <th scope='col'>Labels</th>
      <th scope='col'>P</th>
    </tr>
  </thead>
  <tbody>";
    
    	for ($i=0;$i<sizeof($egitimSeti);$i++) {

    		echo "<tr>";

    		for ($j=1;$j<18;$j++) {
    			echo "<td>".$egitimSeti[$i][$j]."</td>";
    		}
        echo "<td>".$egitimSeti[$i][0]."</td>";
    		echo "</tr>";
    		
    	}
    	echo "</tbody>
				</table></div";

	}

	if ($testSeti != "") {
		echo "<div class='table-responsive'>
    <table class='table table-bordered table-hover'>
  <thead>
    <tr>
      <th scope='col'>Öğrenci Numarası</th>
      <th scope='col'>Alan1</th>
      <th scope='col'>Alan2</th>
      <th scope='col'>Alan3</th>
      <th scope='col'>Alan4</th>
      <th scope='col'>Alan5</th>
      <th scope='col'>Alan6</th>
      <th scope='col'>Alan7</th>
      <th scope='col'>Alan8</th>
      <th scope='col'>Alan9</th>
      <th scope='col'>Alan10</th>
      <th scope='col'>Alan11</th>
      <th scope='col'>Alan12</th>
      <th scope='col'>Alan13</th>
      <th scope='col'>Alan14</th>
      <th scope='col'>Alan15</th>
      <th scope='col'>Labels</th>
      <th scope='col'>P</th>
    </tr>
  </thead>
  <tbody>";

  for ($i=0;$i<sizeof($testSeti);$i++) {

    		echo "<tr>";
    		for ($j=1;$j<18;$j++) {
    			echo "<td>".$testSeti[$i][$j]."</td>";
    		}
          echo "<td>".$testSeti[$i][0]."</td>";

    		echo "</tr>";
    		
    	}
    	echo "</tbody>
				</table></div";

	}
     
  
    ?> 	

  
  </center>
  