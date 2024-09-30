<?php
$Zone		= isset($_POST['zone']) ? $_POST['zone'] : '';
$Lokasi		= isset($_POST['lokasi']) ? $_POST['lokasi'] : '';
?>
<!-- Main content -->
      <div class="container-fluid">
		<form role="form" method="post" enctype="multipart/form-data" name="form1">  
		<div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">Filter Data</h3>

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
               <label for="zone" class="col-md-1">Zone</label>               
                 <select class="form-control select2bs4" style="width: 100%;" name="zone">
				   <option value="">Pilih</option>	 
					<?php $sqlZ=mysqli_query($con," SELECT * FROM tbl_zone order by nama ASC"); 
					  while($rZ=mysqli_fetch_array($sqlZ)){
					 ?>
                    <option value="<?php echo $rZ['nama'];?>" <?php if($rZ['nama']==$Zone){ echo "SELECTED"; }?>><?php echo $rZ['nama'];?></option>
                    <?php  } ?>
                  </select>			   
            </div>
				 <div class="form-group row">
                    <label for="lokasi" class="col-md-1">Location</label>
					<select class="form-control select2bs4" style="width: 100%;" name="lokasi">
                    <option value="">Pilih</option>	 
					<?php $sqlL=mysqli_query($con," SELECT * FROM tbl_lokasi WHERE zone='$Zone' order by nama ASC"); 
					  while($rL=mysqli_fetch_array($sqlL)){
					 ?>
                    <option value="<?php echo $rL['nama'];?>" <?php if($rL['nama']==$Lokasi){ echo "SELECTED"; }?>><?php echo $rL['nama'];?></option>
                    <?php  } ?>
                  </select>	
                  </div> 
			  <button class="btn btn-info" type="submit" value="Cari" name="cari">Cari Data</button>
          </div>
		  
		  <!-- /.card-body -->
          
        </div> 
	</form>
		  <div class="card">
              <div class="card-header">
                <h3 class="card-title">Stock</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
          <table id="example1" class="table table-sm table-bordered table-striped" style="font-size:13px;">
                  <thead>
                  <tr>
                    <th style="text-align: center">TGL</th>
                    <th style="text-align: center">No Item</th>
                    <th style="text-align: center">Langganan</th>
                    <th style="text-align: center">Buyer</th>
                    <th style="text-align: center">PO</th>
                    <th style="text-align: center">Order</th>
                    <th style="text-align: center">No Warna</th>
                    <th style="text-align: center">Warna</th>
                    <th style="text-align: center">Element</th>
                    <th style="text-align: center">Lot</th>
                    <th style="text-align: center">Weight</th>
                    <th style="text-align: center">Satuan</th>
                    <th style="text-align: center">Grade</th>
                    <th style="text-align: center">Length</th>
                    <th style="text-align: center">Satuan</th>
                    <th style="text-align: center">Zone</th>
                    <th style="text-align: center">Lokasi</th>
                    <th style="text-align: center">Status</th>
                    </tr>
                  </thead>
                  <tbody>
				  <?php
	if( $Zone!="" and $Lokasi!=""){				  
	$Where= " AND WHSLOCATIONWAREHOUSEZONECODE='$Zone' AND WAREHOUSELOCATIONCODE='$Lokasi' " ;		
	//}else if($Zone!=""){
	//$Where= " AND WHSLOCATIONWAREHOUSEZONECODE='$Zone' " ;	
	}else{
		$Where= " AND WHSLOCATIONWAREHOUSEZONECODE='$Zone' AND WAREHOUSELOCATIONCODE='$Lokasi' " ;
	}
					  
   $no=1;   
   $c=0;
	//if($Zone=="" and $Lokasi==""){
	//	echo"<script>alert('Zone atau Lokasi belum dipilih');</script>";
	//}else{
	$sqlDB21 = " SELECT * FROM 
	BALANCE b WHERE b.ITEMTYPECODE='KFF' AND b.LOGICALWAREHOUSECODE='M031' $Where ";
	$stmt1   = db2_exec($conn1,$sqlDB21, array('cursor'=>DB2_SCROLLABLE));
	//}				  
    while($rowdb21 = db2_fetch_assoc($stmt1)){
		
	$sqlDB22 = " SELECT SALESORDER.CODE, SALESORDER.EXTERNALREFERENCE, SALESORDER.ORDPRNCUSTOMERSUPPLIERCODE,
		ITXVIEWAKJ.LEGALNAME1, ITXVIEWAKJ.ORDERPARTNERBRANDCODE, ITXVIEWAKJ.LONGDESCRIPTION
		FROM DB2ADMIN.SALESORDER SALESORDER LEFT OUTER JOIN DB2ADMIN.ITXVIEWAKJ 
       	ITXVIEWAKJ ON SALESORDER.CODE=ITXVIEWAKJ.CODE
		WHERE SALESORDER.CODE='$rowdb21[PROJECTCODE]' ";
	$stmt2   = db2_exec($conn1,$sqlDB22, array('cursor'=>DB2_SCROLLABLE));
	$rowdb22 = db2_fetch_assoc($stmt2);	
	if($rowdb22['LEGALNAME1']==""){$langganan="";}else{$langganan=$rowdb22['LEGALNAME1'];}
	if($rowdb22['ORDERPARTNERBRANDCODE']==""){$buyer="";}else{$buyer=$rowdb22['LONGDESCRIPTION'];}
		
	$sqlDB23 = " SELECT USERGENERICGROUP.CODE,USERGENERICGROUP.LONGDESCRIPTION 
		FROM DB2ADMIN.USERGENERICGROUP USERGENERICGROUP WHERE USERGENERICGROUP.CODE='$rowdb21[DECOSUBCODE05]' ";
	$stmt3   = db2_exec($conn1,$sqlDB23, array('cursor'=>DB2_SCROLLABLE));
	$rowdb23 = db2_fetch_assoc($stmt3);		
	if($rowdb21['QUALITYLEVELCODE']==1){
		$grade="A";
	}else if($rowdb21['QUALITYLEVELCODE']==2){
		$grade="B";
	}else if($rowdb21['QUALITYLEVELCODE']==3){
		$grade="C";
	} 	
	$sqlDB24 = " SELECT STOCKTRANSACTION.QUALITYREASONCODE,STOCKTRANSACTION.ITEMELEMENTCODE,
    	STOCKTRANSACTION.PROJECTCODE,QUALITYREASON.LONGDESCRIPTION 
		FROM DB2ADMIN.STOCKTRANSACTION STOCKTRANSACTION LEFT OUTER JOIN 
      	DB2ADMIN.QUALITYREASON QUALITYREASON ON 
      	STOCKTRANSACTION.QUALITYREASONCODE=QUALITYREASON.CODE 
		WHERE STOCKTRANSACTION.ITEMELEMENTCODE='$rowdb21[ELEMENTSCODE]' ";
	$stmt4   = db2_exec($conn1,$sqlDB24, array('cursor'=>DB2_SCROLLABLE));
	$rowdb24 = db2_fetch_assoc($stmt4);	
	if ($rowdb24['QUALITYREASONCODE']!="" and $rowdb24['QUALITYREASONCODE']!="."){
		$sts=$rowdb24['LONGDESCRIPTION'];}	
	else if (substr(trim($rowdb24['PROJECTCODE']),0,3)=="OPN" or substr(trim($rowdb24['PROJECTCODE']),0,3)=="STO"){
		$sts="Booking";}
	else if (substr(trim($rowdb24['PROJECTCODE']),0,3)=="RPE"){
		$sts="Ganti Kain";  }
	else {
		$sts="Tunggu Kirim"; }		
		
	$sqlDB25 = " SELECT ORDERITEMORDERPARTNERLINK.ORDPRNCUSTOMERSUPPLIERCODE,
       ORDERITEMORDERPARTNERLINK.LONGDESCRIPTION 
	   FROM DB2ADMIN.ORDERITEMORDERPARTNERLINK ORDERITEMORDERPARTNERLINK WHERE
       ORDERITEMORDERPARTNERLINK.ITEMTYPEAFICODE='$rowdb21[ITEMTYPECODE]' AND
	   ORDERITEMORDERPARTNERLINK.ORDPRNCUSTOMERSUPPLIERCODE='$rowdb22[ORDPRNCUSTOMERSUPPLIERCODE]' AND
	   ORDERITEMORDERPARTNERLINK.SUBCODE01='$rowdb21[DECOSUBCODE01]' AND
       ORDERITEMORDERPARTNERLINK.SUBCODE02='$rowdb21[DECOSUBCODE02]' AND
       ORDERITEMORDERPARTNERLINK.SUBCODE03='$rowdb21[DECOSUBCODE03]' AND
	   ORDERITEMORDERPARTNERLINK.SUBCODE04='$rowdb21[DECOSUBCODE04]' AND
       ORDERITEMORDERPARTNERLINK.SUBCODE05='$rowdb21[DECOSUBCODE05]' AND
	   ORDERITEMORDERPARTNERLINK.SUBCODE06='$rowdb21[DECOSUBCODE06]' AND
       ORDERITEMORDERPARTNERLINK.SUBCODE07='$rowdb21[DECOSUBCODE07]' AND
	   ORDERITEMORDERPARTNERLINK.SUBCODE08='$rowdb21[DECOSUBCODE08]'";
	$stmt5   = db2_exec($conn1,$sqlDB25, array('cursor'=>DB2_SCROLLABLE));
	$rowdb25 = db2_fetch_assoc($stmt5);	
	if($rowdb25['LONGDESCRIPTION']!=""){
		$item=$rowdb25['LONGDESCRIPTION'];
	}else{
		$item=trim($rowdb21['DECOSUBCODE02'])."".trim($rowdb21['DECOSUBCODE03']);
	}	
	$sqlDB26 = " SELECT ITXVIEWKK.PROJECTCODE,ITXVIEWKK.PRODUCTIONORDERCODE,
       ITXVIEWKK.ITEMTYPEAFICODE,ITXVIEWKK.SUBCODE01,ITXVIEWKK.SUBCODE02,
       ITXVIEWKK.SUBCODE03,ITXVIEWKK.SUBCODE04,ITXVIEWKK.SUBCODE05,
       ITXVIEWKK.SUBCODE06,ITXVIEWKK.SUBCODE07,ITXVIEWKK.SUBCODE08,
       SALESORDERLINE.EXTERNALREFERENCE 
       FROM DB2ADMIN.ITXVIEWKK ITXVIEWKK LEFT OUTER JOIN DB2ADMIN.SALESORDERLINE 
       SALESORDERLINE ON 
       ITXVIEWKK.PROJECTCODE=SALESORDERLINE.PROJECTCODE AND 
       ITXVIEWKK.ORIGDLVSALORDERLINEORDERLINE=SALESORDERLINE.ORDERLINE WHERE
       ITXVIEWKK.ITEMTYPEAFICODE='$rowdb21[ITEMTYPECODE]' AND	   
	   ITXVIEWKK.PROJECTCODE='$rowdb21[PROJECTCODE]' AND
	   ITXVIEWKK.SUBCODE01='$rowdb21[DECOSUBCODE01]' AND
       ITXVIEWKK.SUBCODE02='$rowdb21[DECOSUBCODE02]' AND
       ITXVIEWKK.SUBCODE03='$rowdb21[DECOSUBCODE03]' AND
	   ITXVIEWKK.SUBCODE04='$rowdb21[DECOSUBCODE04]' AND
       ITXVIEWKK.SUBCODE05='$rowdb21[DECOSUBCODE05]' AND
	   ITXVIEWKK.SUBCODE06='$rowdb21[DECOSUBCODE06]' AND
       ITXVIEWKK.SUBCODE07='$rowdb21[DECOSUBCODE07]' AND
	   ITXVIEWKK.SUBCODE08='$rowdb21[DECOSUBCODE08]'";
	$stmt6   = db2_exec($conn1,$sqlDB26, array('cursor'=>DB2_SCROLLABLE));
	$rowdb26 = db2_fetch_assoc($stmt6);
	if($stmt2['EXTERNALREFERENCE']!=""){
		$PO=$stmt2['EXTERNALREFERENCE'];
	}else{
		$PO=$rowdb26['EXTERNALREFERENCE'];
	}	
?>
	  <tr>
      <td style="text-align: center"><?php echo substr($rowdb21['CREATIONDATETIME'],0,10); ?></td>
      <td style="text-align: center"><?php echo $item; ?></td>
      <td style="text-align: left"><?php echo $langganan; ?></td>
      <td style="text-align: left"><?php echo $buyer; ?></td>
      <td style="text-align: center"><?php echo $PO; ?></td>
      <td style="text-align: center"><?php echo $rowdb21['PROJECTCODE']; ?></td>
      <td style="text-align: left"><?php echo $rowdb21['DECOSUBCODE05']; ?></td>
      <td style="text-align: center"><?php echo $rowdb23['LONGDESCRIPTION']; ?></td>
      <td style="text-align: center"><?php echo $rowdb21['ELEMENTSCODE'];?></td>
      <td style="text-align: center"><?php echo $rowdb21['LOTCODE'];?></td>
      <td style="text-align: right"><?php echo round($rowdb21['BASEPRIMARYQUANTITYUNIT'],2);?></td>
      <td style="text-align: center"><?php echo $rowdb21['BASEPRIMARYUNITCODE'];?></td>
      <td style="text-align: center"><?php echo $grade;?></td>
      <td style="text-align: right"><?php echo round($rowdb21['BASESECONDARYQUANTITYUNIT'],2);?></td>
      <td style="text-align: center"><?php echo $rowdb21['BASESECONDARYUNITCODE'];?></td>
      <td style="text-align: center"><?php echo $rowdb21['WHSLOCATIONWAREHOUSEZONECODE'];?></td>
      <td style="text-align: center"><?php echo $rowdb21['WAREHOUSELOCATIONCODE'];?></td>
      <td style="text-align: center"><?php echo $sts; ?></td>
      </tr>				  
<?php	$no++;} ?>
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