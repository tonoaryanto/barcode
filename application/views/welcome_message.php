<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Ansell Barcode Generator</title>
  <link rel="shortcut icon" href="<?php echo base_url();?>assets/icon/logo.png">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/adminlte.min.css">
</head>
<body class="hold-transition lockscreen">
<!-- Automatic element centering -->
<div class="lockscreen-wrapper">
  <div class="lockscreen-logo">
    <img src="<?php echo base_url();?>assets/icon/icon-Logo.png" style="width:100px;"><br>
    <a href="javascript:void(0);"><b>Ansell</b> Barcode Generator</a>
  </div>
  <br>
  <!-- START LOCK SCREEN ITEM -->
  <div class="lockscreen-item">
    <!-- lockscreen image -->
    <!-- /.lockscreen-image -->

    <!-- lockscreen credentials (contains the form) -->
    <div class="lockscreen-credentials" style="margin-left:0px;">
      <div class="input-group">
        <input name="generate" type="text" class="form-control" placeholder="Input text barcode">

        <div class="input-group-append">
          <button type="button" class="btn" style="background:#da2f39;color:#eeecec;" onclick="generate();">
          Generate
          </button>
        </div>
      </div>
    </div>
    <!-- /.lockscreen credentials -->

  </div>
  <center>
  <div id="isibarcode"></div>
  </center>
  <!-- /.lockscreen-item -->
  <br>
  <div class="lockscreen-footer text-center">
    Copyright &copy; 2021 <b><a href="https://anseljaya.com" class="text-black" style="color:rgb(180, 0, 0);">Ansell Jaya Indonesia</a></b><br>
    All rights reserved
  </div>
</div>
<!-- /.center -->

<!-- jQuery -->
<script src="<?php echo base_url(); ?>assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url(); ?>assets//plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
<script>
function generate(){
  if($('[name="generate"]').val() == ''){return;}
  $('#isibarcode').html('Please Wait. . .');

  $.ajax({
      type: "POST",
      url : "<?php echo base_url('welcome/create_qr'); ?>",
      data : {'text' : $('[name="generate"]').val()},
      dataType : "JSON",
      success : function(isi){
        $('#isibarcode').html('');
        $('<img>')
        .attr({'src' : isi.dataset,'id':'bcimage'})
        .appendTo('#isibarcode');
        $('<br>').appendTo('#isibarcode');
        $('<br>').appendTo('#isibarcode');
        $('<a>')
        .attr({'class' : 'btn btn-success','download':isi.namafile,'href':isi.dataset})
        .text('Download')
        .appendTo('#isibarcode');
      }
  });
}
</script>
</html>
