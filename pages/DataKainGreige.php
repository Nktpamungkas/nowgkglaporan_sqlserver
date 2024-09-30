<?php
$Awal	= isset($_POST['tgl_awal']) ? $_POST['tgl_awal'] : '';
$Akhir	= isset($_POST['tgl_akhir']) ? $_POST['tgl_akhir'] : '';
?>
<!-- Main content -->
      <div class="container-fluid">
			
		<div class="card">
              <div class="card-header">
                <h3 class="card-title">Data Kain Greige</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-sm table-bordered table-striped" style="font-size:13px;">
                  <thead>
                  <tr>
                    <th style="text-align: center">No</th>
                    <th style="text-align: center">Project</th>
                    <th style="text-align: center">ProdNo</th>
                    <th style="text-align: center">DemandNo</th>
                    <th style="text-align: center">Konsumen</th>
                    <th style="text-align: center">NoArt</th>
                    <th style="text-align: center">Order</th>
                    <th style="text-align: center">Rajut</th>
                    <th style="text-align: center">Siap Kirim</th>
                    <th style="text-align: center">Terkirim</th>
                    </tr>
                  </thead>
                  <tbody>
<?php
$sqlDB2 =" SELECT *,CURRENT_TIMESTAMP AS TGLS FROM ITXVIEWKNTORDER WHERE ITEMTYPEAFICODE ='KGF' AND SCHEDULEDRESOURCECODE <>'' ";	
$stmt   = db2_exec($conn1,$sqlDB2, array('cursor'=>DB2_SCROLLABLE));
$no=1;
while($rowdb2 = db2_fetch_assoc($stmt)){

$sqlDB22 =" SELECT COUNT(WEIGHTREALNET ) AS JML, SUM(WEIGHTREALNET ) AS JQTY FROM 
ELEMENTSINSPECTION WHERE DEMANDCODE ='$rowdb2[PRODUCTIONDEMANDCODE]' AND ELEMENTITEMTYPECODE='KGF'";	
$stmt2   = db2_exec($conn1,$sqlDB22, array('cursor'=>DB2_SCROLLABLE));
$rowdb22 = db2_fetch_assoc($stmt2);
	
?>
	  <tr>
      <td style="text-align: center"><?php echo $no; ?></td>
      <td style="text-align: center"><?php echo $rowdb2['PROJECTCODE'];?></td>
      <td style="text-align: center"><?php echo $rowdb2['PRODUCTIONORDERCODE'];?></td>
      <td style="text-align: center"><?php echo $rowdb2['PRODUCTIONDEMANDCODE'];?></td>
      <td><?php echo $rowdb2['LEGALNAME1'];?></td>
      <td style="text-align: center"><?php echo trim($rowdb2['SUBCODE02']).trim($rowdb2['SUBCODE03'])." ".trim($rowdb2['SUBCODE04']);?></td>
      <td style="text-align: right"><?php echo number_format(round($rowdb2['BASEPRIMARYQUANTITY'],2),2);?></td>
      <td style="text-align: right"><?php echo number_format(round($rowdb22['JQTY'],2),2);?></td>
      <td style="text-align: center">&nbsp;</td>
      <td style="text-align: center">&nbsp;</td>
      </tr>				  
	<?php 
	 $no++;} ?>
				  </tbody>
                 </table>
              </div>
              <!-- /.card-body -->
            </div>  
      </div><!-- /.container-fluid -->
    <!-- /.content -->
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