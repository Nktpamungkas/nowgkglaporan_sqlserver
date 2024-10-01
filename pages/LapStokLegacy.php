<?php
$Thn	= isset($_POST['thn']) ? $_POST['thn'] : '';
$Thn1	= substr($Thn,2,2);
?>
<!-- Main content -->
      <div class="container-fluid">
		<form role="form" method="post" enctype="multipart/form-data" name="form1">  
		<div class="card card-success">
          <div class="card-header">
            <h3 class="card-title">Filter Data Per Tahun</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div>
          <!-- /.card-header -->		  
          <div class="card-body">
             <div class="form-group row">
               <label for="tgl_awal" class="col-md-1">Tahun</label>
               <div class="col-md-2">  
                 <select name="thn" class="form-control select2"> 
                	<option value="">Pilih Tahun</option>
        <?php
                $thn_skr = date('Y');
                for ($x = $thn_skr; $x >= 2019; $x--) {
                ?>
        <option value="<?php echo $x ?>" <?php if($Thn!=""){if($Thn==$x){echo "SELECTED";}}else{if($x==$thn_skr){echo "SELECTED";}} ?>><?php echo $x ?></option>
        <?php
                }
   ?>
                	</select>
			   </div>	
            </div> 
			  <button class="btn btn-info" type="submit">Cari Data</button>
          </div>		  
		  <!-- /.card-body -->          
        </div>  
		<?php if($Thn!=""){ ?> 	
		<div class="card card-warning">
              <div class="card-header">
                <h3 class="card-title">Detail Data Kain Greige Legacy <?php echo $Thn1; ?></h3>				 
          </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-sm table-bordered table-striped" style="font-size: 13px; text-align: center;">
                  <thead>
                  <tr>
                    <th valign="middle" style="text-align: center">No</th>
                    <th valign="middle" style="text-align: center">Item</th>
                    <th valign="middle" style="text-align: center">Lot</th>
                    <th valign="middle" style="text-align: center">Qty</th>
                    <th valign="middle" style="text-align: center">Berat/Kg</th>
                    <th valign="middle" style="text-align: center">Block</th>
                    </tr>
                  </thead>
                  <tbody>
				  <?php
	 
$no=1;   
$c=0;
					  
	$sqlDB21 = " SELECT DECOSUBCODE01,DECOSUBCODE02,DECOSUBCODE03,DECOSUBCODE04,LOTCODE,WAREHOUSELOCATIONCODE,
COUNT(LOTCODE) AS QTY_ROL, SUM(BASEPRIMARYQUANTITYUNIT) AS QTY_KG
FROM BALANCE b WHERE ITEMTYPECODE ='KGF' AND 
LOGICALWAREHOUSECODE='M021' AND 
WHSLOCATIONWAREHOUSEZONECODE ='L2' AND 
TRIM(LOTCODE) LIKE '%/$Thn1' 
GROUP BY DECOSUBCODE01,DECOSUBCODE02,DECOSUBCODE03,DECOSUBCODE04,LOTCODE,WAREHOUSELOCATIONCODE ";
	$stmt1   = db2_exec($conn1,$sqlDB21, array('cursor'=>DB2_SCROLLABLE));
	//}				  
    while($rowdb21 = db2_fetch_assoc($stmt1)){	
	$itemc=trim($rowdb21['DECOSUBCODE01'])." ".trim($rowdb21['DECOSUBCODE02'])."".trim($rowdb21['DECOSUBCODE03'])." ".trim($rowdb21['DECOSUBCODE04']);	
?>
	  <tr>
	  <td style="text-align: center"><?php echo $no;?></td>
	  <td><?php echo $itemc;?></td> 
      <td style="text-align: center"><?php echo $rowdb21['LOTCODE']; ?></td>
      <td style="text-align: right"><?php echo $rowdb21['QTY_ROL']; ?></td>
      <td style="text-align: right"><?php echo $rowdb21['QTY_KG']; ?></td>
      <td><?php echo $rowdb21['WAREHOUSELOCATIONCODE']; ?></td>
      </tr>
	  				  
	<?php 
	 $no++; 
	$tMRol+=$rowdb21['QTY_ROL'];
	$tMKG +=$rowdb21['QTY_KG'];
	} ?>
				  </tbody>
                  <tfoot>
	 <tr>
	    <td style="text-align: center">&nbsp;</td>
	    <td>&nbsp;</td>
	    <td style="text-align: center">&nbsp;</td>
	    <td style="text-align: right"><strong><?php echo $tMRol;?></strong></td>
	    <td style="text-align: right"><strong><?php echo number_format(round($tMKG,2),2);?></strong></td>
	    <td>&nbsp;</td>
	    </tr>				
					</tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div> 
		<?php } ?>
	</form>		
      </div><!-- /.container-fluid -->
    <!-- /.content -->
<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- SweetAlert2 -->
<script src="plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Toastr -->
<script src="plugins/toastr/toastr.min.js"></script>	
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>

<script>
	$(function () {
		//Datepicker
    $('#datepicker').datetimepicker({
      format: 'YYYY-MM-DD'
    });
    $('#datepicker1').datetimepicker({
      format: 'YYYY-MM-DD'
    });
    $('#datepicker2').datetimepicker({
      format: 'YYYY-MM-DD'
    });
	
});		
</script>
<script type="text/javascript">
function checkAll(form1){
    for (var i=0;i<document.forms['form1'].elements.length;i++)
    {
        var e=document.forms['form1'].elements[i];
        if ((e.name !='allbox') && (e.type=='checkbox'))
        {
            e.checked=document.forms['form1'].allbox.checked;
			
        }
    }
}
</script>