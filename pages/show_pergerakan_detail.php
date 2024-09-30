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
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
			<form class="form-horizontal" name="modal_popup" data-toggle="validator" method="post" action="" enctype="multipart/form-data">  
            <div class="modal-header">
              <h5 class="modal-title">Detail Pergerakaan Greige</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body"><i>
			BON: <b><?php echo $ORDERCODE."-".$ODERLINE;?></b>				
			</i>	
			<table id="lookup1" class="table table-sm table-bordered table-hover table-striped" width="100%" style="font-size: 14px;">
						<thead>
							<tr>
							  <th colspan="6"><div align="center">Masuk</div></th>
							  <th colspan="3"><div align="center">Keluar</div></th>
							  </tr>
							<tr>
								<th width="1%">#</th>
								<th width="14%"><div align="center">TGL</div></th>
								<th width="16%"><div align="center">ELEMENTCODE</div></th>
								<th width="15%"><div align="center">KG</div></th>
								<th width="14%"><div align="center">LOTCODE</div></th>
								<th width="14%"><div align="center">KET</div></th>
								<th width="14%"><div align="center">TGL</div></th>
								<th width="13%"><div align="center">ORDERCODE</div></th>
								<th width="13%"><div align="center">PROJECTCODE</div></th>															
							</tr>
						</thead>
						<tbody>
							<?php
							$no=1;
							$sqlDB22 = "SELECT * FROM DB2ADMIN.STOCKTRANSACTION STOCKTRANSACTION 
		WHERE STOCKTRANSACTION.LOGICALWAREHOUSECODE='M021' AND STOCKTRANSACTION.ORDERCODE='$ORDERCODE'
		AND STOCKTRANSACTION.ORDERLINE ='$ODERLINE'";					  
		$stmt2   = db2_exec($conn1,$sqlDB22, array('cursor'=>DB2_SCROLLABLE));
							while($rD=db2_fetch_assoc($stmt2)){
		$sqlDB23 = "SELECT TRANSACTIONDATE,ORDERCODE,PROJECTCODE FROM DB2ADMIN.STOCKTRANSACTION STOCKTRANSACTION 
		WHERE STOCKTRANSACTION.ITEMELEMENTCODE ='$rD[ITEMELEMENTCODE]' AND STOCKTRANSACTION.ONHANDUPDATE >1 AND 
		STOCKTRANSACTION.LOGICALWAREHOUSECODE ='M021' AND STOCKTRANSACTION.TEMPLATECODE='120'";
		$stmt3   = db2_exec($conn1,$sqlDB23, array('cursor'=>DB2_SCROLLABLE));						
		$rD1=db2_fetch_assoc($stmt3);						
	echo"<tr>
  	<td align=center>$no</td>
	<td align=center>$rD[TRANSACTIONDATE]</td>
	<td align=center>$rD[ITEMELEMENTCODE]</td>
	<td align=center>$rD[BASEPRIMARYQUANTITY]</td>
	<td align=center>$rD[LOTCODE]</td>
	<td align=center></td>
	<td align=center>$rD1[TRANSACTIONDATE]</td>
	<td align=center>$rD1[ORDERCODE]</td>
	<td align=center>$rD1[PROJECTCODE]</td>
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
