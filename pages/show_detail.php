<?php
ini_set("error_reporting", 1);
session_start();
include("../koneksi.php");
    $modal_id=$_GET['id'];
	$ORDERCODE=substr($modal_id,0,13);
	$ODERLINE=substr($modal_id,14,2);
	$LOT=substr($modal_id,14,200);
	$pos=strpos($LOT,"-")+1;
	$LOTCODE=substr($LOT,$pos,200);
	
	
?>
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
			<form class="form-horizontal" name="modal_popup" data-toggle="validator" method="post" action="" enctype="multipart/form-data">  
            <div class="modal-header">
              <h5 class="modal-title">Detail Data Element</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body"><i>
			RefNo: <b><?php echo $LOTCODE;?></b><br>
			BON: <b><?php echo $ORDERCODE."-".$ODERLINE;?></b>				
			</i>	
			<table id="lookup1" class="table table-sm table-bordered table-hover table-striped" width="100%" style="font-size: 14px;">
						<thead>
							<tr>
								<th>#</th>
								<th><div align="center">ELEMENTCODE</div></th>
								<th><div align="center">KG</div></th>
								<th><div align="center">LOTCODE</div></th>															
							</tr>
						</thead>
						<tbody>
							<?php
							$no=1;
							$sqlDB22 = "SELECT BALANCE.ELEMENTSCODE,BASEPRIMARYQUANTITYUNIT,BALANCE.LOTCODE  
		FROM DB2ADMIN.STOCKTRANSACTION STOCKTRANSACTION LEFT OUTER JOIN 
		DB2ADMIN.BALANCE  BALANCE ON BALANCE.ELEMENTSCODE =STOCKTRANSACTION.ITEMELEMENTCODE  
		WHERE STOCKTRANSACTION.LOGICALWAREHOUSECODE='M021' AND STOCKTRANSACTION.ORDERCODE='$ORDERCODE'
		AND STOCKTRANSACTION.ORDERLINE ='$ODERLINE' 
		";					  
		$stmt2   = db2_exec($conn1,$sqlDB22, array('cursor'=>DB2_SCROLLABLE));
							while($rD=db2_fetch_assoc($stmt2)){
								
	echo"<tr'>
  	<td align=center>$no</td>
	<td align=center>$rD[ELEMENTSCODE]</td>
	<td align=center>$rD[BASEPRIMARYQUANTITYUNIT]</td>
	<td align=center>$rD[LOTCODE]</td>
	</tr>";
				$no++;				
							}
								

     
  ?>
						</tbody>
					</table>   	
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
              			  	
            </div>
			</form>	
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
               
<script>
  $(function () {	 
	$('.select2sts').select2({
    placeholder: "Select a status",
    allowClear: true
});   
  });
</script>
