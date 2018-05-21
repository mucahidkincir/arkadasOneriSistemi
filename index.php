<!DOCTYPE html>
 <html>
 <head>
 	<title></title>
 	<meta http-equiv="Content-Type" content="text/HTML; charset=utf-8" />
 	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
 	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
 </head>
 <body>
<div style="text-align: center;">
	<h2>Arkadaş Öneri Sistemi Giriş Sayfası</h2>
<form class="was-validated" enctype="multipart/form-data" action="giris.php" method="POST">
  <div class="custom-file" style="width: 25%">
    <input type="file" class="custom-file-input" id="validatedCustomFile" name="profilDosyasi" accept=".csv" required>
    <label class="custom-file-label" for="validatedCustomFile">Profil dosyası seç...</label>
    <div class="invalid-feedback">Öğrenci Profil Dosyası Seçmediniz !</div>
  </div>
  <p></p>
  <div class="custom-file" style="width: 25%">
    <input type="file" class="custom-file-input" id="validatedCustomFile" name="networkDosyasi" accept=".csv" required>
    <label class="custom-file-label" for="validatedCustomFile">Network dosyası seç...</label>
    <div class="invalid-feedback">Öğrenci Network Dosyası Seçmediniz !</div>
  </div>
  <p></p>
  <div style="text-align: center;">
  <button type="submit" name="submit" class="btn btn-primary mb-2" style="width: 25%">DOSYALARI YUKLE</button>
  </div>
</form>
</div>
 </body>
 </html>