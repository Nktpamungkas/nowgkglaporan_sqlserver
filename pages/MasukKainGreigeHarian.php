<?php
$Awal	= isset($_POST['tgl_awal']) ? $_POST['tgl_awal'] : '';
$Akhir	= isset($_POST['tgl_akhir']) ? $_POST['tgl_akhir'] : '';
?>
<!-- Main content -->
      <div class="container-fluid">
		<form role="form" method="post" enctype="multipart/form-data" name="form1">  
		<div class="card card-success">
          <div class="card-header">
            <h3 class="card-title">Filter Data Tgl Masuk Kain Greige</h3>

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
               <label for="tgl_awal" class="col-md-1">Tgl Awal</label>
               <div class="col-md-2">  
                 <div class="input-group date" id="datepicker1" data-target-input="nearest">
                    <div class="input-group-prepend" data-target="#datepicker1" data-toggle="datetimepicker">
                      <span class="input-group-text btn-info">
                        <i class="far fa-calendar-alt"></i>
                      </span>
                    </div>
                    <input name="tgl_awal" value="<?php echo $Awal;?>" type="text" class="form-control form-control-sm" id=""  autocomplete="off" required>
                 </div>
			   </div>	
            </div>
			 <div class="form-group row">
               <label for="tgl_akhir" class="col-md-1">Tgl Akhir</label>
               <div class="col-md-2">  
                 <div class="input-group date" id="datepicker2" data-target-input="nearest">
                    <div class="input-group-prepend" data-target="#datepicker2" data-toggle="datetimepicker">
                      <span class="input-group-text btn-info">
                        <i class="far fa-calendar-alt"></i>
                      </span>
                    </div>
                    <input name="tgl_akhir" value="<?php echo $Akhir;?>" type="text" class="form-control form-control-sm" id=""  autocomplete="off" required>
                 </div>
			   </div>	
            </div> 
				 
			  <button class="btn btn-info" type="submit">Cari Data</button>
          </div>		  
		  <!-- /.card-body -->          
        </div>  
		<?php if($Awal!="" and $Akhir!=""){ ?>	
		<div class="card card-warning">
              <div class="card-header">
                <h3 class="card-title">Detail Laporan Harian Masuk Kain Greige</h3>
				<a href="pages/cetak/lapgmasuk_excel.php?awal=<?php echo $Awal;?>&akhir=<?php echo $Akhir;?>" class="btn bg-blue float-right" target="_blank">Cetak Excel</a>  
          </div>
              <!-- /.card-header -->
              <div class="card-body">				  
                <table id="example14" width="100%" class="table table-sm table-bordered table-striped" style="font-size: 11px; text-align: center;">
                  <thead>
                  <tr>
                    <th rowspan="2" valign="middle" style="text-align: center">No</th>
                    <th rowspan="2" valign="middle" style="text-align: center">Tgl Masuk</th>
                    <th rowspan="2" valign="middle" style="text-align: center">No BON</th>
                    <th rowspan="2" valign="middle" style="text-align: center">Buyer</th>
                    <th rowspan="2" valign="middle" style="text-align: center">Customer</th>
                    <th rowspan="2" valign="middle" style="text-align: center">Prod. Order</th>
                    <th rowspan="2" valign="middle" style="text-align: center">Code</th>
                    <th rowspan="2" valign="middle" style="text-align: center">Project</th>
                    <th rowspan="2" valign="middle" style="text-align: center">Mesin Rajut</th>
                    <th rowspan="2" valign="middle" style="text-align: center">Lot Benang</th>
                    <th colspan="2" valign="middle" style="text-align: center">Greige</th>
                    <th colspan="2" valign="middle" style="text-align: center">Kain Jadi</th>
                    <th rowspan="2" valign="middle" style="text-align: center">Jenis Kain</th>
                    <th rowspan="2" valign="middle" style="text-align: center">Lot</th>
                    <th colspan="4" valign="middle" style="text-align: center">Jenis Benang</th>
                    <th rowspan="2" valign="middle" style="text-align: center">Qty</th>
                    <th rowspan="2" valign="middle" style="text-align: center">Berat/Kg</th>
                    <th rowspan="2" valign="middle" style="text-align: center">Block</th>
                    <th rowspan="2" valign="middle" style="text-align: center">Balance</th>
                    <th rowspan="2" valign="middle" style="text-align: center">User</th>
                    </tr>
                  <tr>
                    <th valign="middle" style="text-align: center">Lebar</th>
                    <th valign="middle" style="text-align: center">Gramasi</th>
                    <th valign="middle" style="text-align: center">Lebar</th>
                    <th valign="middle" style="text-align: center">Gramasi</th>
                    <th valign="middle" style="text-align: center">1</th>
                    <th valign="middle" style="text-align: center">2</th>
                    <th valign="middle" style="text-align: center">3</th>
                    <th valign="middle" style="text-align: center">4</th>
                    </tr>
                  </thead>
                  <tbody>
				  <?php
	 
$no=1;   
$c=0;
										   
	$sqlDB21 = " SELECT
	STOCKTRANSACTION.TRANSACTIONDATE,
	STOCKTRANSACTION.PROJECTCODE,
	STOCKTRANSACTION.CREATIONUSER,
	INTERNALDOCUMENTLINE.SUBCODE01,
    INTERNALDOCUMENTLINE.SUBCODE02,
    INTERNALDOCUMENTLINE.SUBCODE03,
    INTERNALDOCUMENTLINE.SUBCODE04,
    INTERNALDOCUMENTLINE.ORDERLINE,
    INTERNALDOCUMENTLINE.EXTERNALREFERENCE,
    INTERNALDOCUMENTLINE.ITEMDESCRIPTION,
    STOCKTRANSACTION.LOTCODE, 
    STOCKTRANSACTION.USERPRIMARYUOMCODE,
    INTERNALDOCUMENT.PROVISIONALCOUNTERCODE,    
    STOCKTRANSACTION.WHSLOCATIONWAREHOUSEZONECODE,
    STOCKTRANSACTION.WAREHOUSELOCATIONCODE,
    INTERNALDOCUMENTLINE.DESTINATIONWAREHOUSECODE,
    FULLITEMKEYDECODER.SUMMARIZEDDESCRIPTION,
    INTERNALDOCUMENT.PROVISIONALCODE,
   	SUM(STOCKTRANSACTION.BASEPRIMARYQUANTITY) AS QTY1_KG,
	SUM(STOCKTRANSACTION.WEIGHTNET) AS QTY_KG,
	COUNT(STOCKTRANSACTION.WEIGHTNET) AS QTY_ROL
FROM
    INTERNALDOCUMENT INTERNALDOCUMENT
LEFT JOIN INTERNALDOCUMENTLINE INTERNALDOCUMENTLINE ON
    INTERNALDOCUMENT.PROVISIONALCOUNTERCODE = INTERNALDOCUMENTLINE.INTDOCPROVISIONALCOUNTERCODE
    AND INTERNALDOCUMENT.PROVISIONALCODE = INTERNALDOCUMENTLINE.INTDOCUMENTPROVISIONALCODE
	AND INTERNALDOCUMENTLINE.DESTINATIONWAREHOUSECODE='M021'
LEFT JOIN STOCKTRANSACTION STOCKTRANSACTION ON
    INTERNALDOCUMENTLINE.INTDOCUMENTPROVISIONALCODE = STOCKTRANSACTION.ORDERCODE
    AND INTERNALDOCUMENTLINE.ORDERLINE = STOCKTRANSACTION.ORDERLINE
LEFT JOIN FULLITEMKEYDECODER FULLITEMKEYDECODER ON
    STOCKTRANSACTION.FULLITEMIDENTIFIER = FULLITEMKEYDECODER.IDENTIFIER
WHERE
    STOCKTRANSACTION.TEMPLATECODE = '204'
    AND STOCKTRANSACTION.LOGICALWAREHOUSECODE = 'M021' 
    AND STOCKTRANSACTION.TRANSACTIONDATE BETWEEN '$Awal' AND '$Akhir'
	AND NOT INTERNALDOCUMENTLINE.ORDERLINE IS NULL
GROUP BY
	STOCKTRANSACTION.TRANSACTIONDATE,
	STOCKTRANSACTION.PROJECTCODE,
	STOCKTRANSACTION.CREATIONUSER,
	INTERNALDOCUMENTLINE.SUBCODE01,
    INTERNALDOCUMENTLINE.SUBCODE02,
    INTERNALDOCUMENTLINE.SUBCODE03,
    INTERNALDOCUMENTLINE.SUBCODE04,
    INTERNALDOCUMENTLINE.ORDERLINE,
    INTERNALDOCUMENTLINE.EXTERNALREFERENCE,
    INTERNALDOCUMENTLINE.ITEMDESCRIPTION,
    STOCKTRANSACTION.LOTCODE, 
    STOCKTRANSACTION.USERPRIMARYUOMCODE,
    INTERNALDOCUMENT.PROVISIONALCOUNTERCODE,    
    STOCKTRANSACTION.WHSLOCATIONWAREHOUSEZONECODE,
    STOCKTRANSACTION.WAREHOUSELOCATIONCODE,
    INTERNALDOCUMENTLINE.DESTINATIONWAREHOUSECODE,
    FULLITEMKEYDECODER.SUMMARIZEDDESCRIPTION,
    INTERNALDOCUMENT.PROVISIONALCODE ";
	$stmt1   = db2_exec($conn1,$sqlDB21, array('cursor'=>DB2_SCROLLABLE));
	//}				  
    while($rowdb21 = db2_fetch_assoc($stmt1)){
$sqlDB22 = " SELECT SALESORDER.CODE, SALESORDER.EXTERNALREFERENCE, SALESORDER.ORDPRNCUSTOMERSUPPLIERCODE,
		ITXVIEWAKJ.LEGALNAME1, ITXVIEWAKJ.ORDERPARTNERBRANDCODE, ITXVIEWAKJ.LONGDESCRIPTION
		FROM DB2ADMIN.SALESORDER SALESORDER LEFT OUTER JOIN DB2ADMIN.ITXVIEWAKJ 
       	ITXVIEWAKJ ON SALESORDER.CODE=ITXVIEWAKJ.CODE
		WHERE SALESORDER.CODE='".trim($rowdb21['PROJECTCODE'])."' ";
$stmt2   = db2_exec($conn1,$sqlDB22, array('cursor'=>DB2_SCROLLABLE));
$rowdb22 = db2_fetch_assoc($stmt2);		
$sqlDB23 = " SELECT p.SUBCODE01,p.SUBCODE02,p.SUBCODE03,p.SUBCODE04,p.SUBCODE05,p.SUBCODE06,p.SUBCODE07, p.LONGDESCRIPTION FROM (
SELECT p2.ITEMTYPEAFICODE,p2.SUBCODE01,p2.SUBCODE02,p2.SUBCODE03,p2.SUBCODE04,
p2.SUBCODE05,p2.SUBCODE06,p2.SUBCODE07  FROM PRODUCTIONDEMAND p 
LEFT OUTER JOIN PRODUCTIONRESERVATION p2 ON p.CODE =p2.ORDERCODE 
WHERE p.ITEMTYPEAFICODE ='KGF' AND p.SUBCODE01='".trim($rowdb21['SUBCODE01'])."' 
AND p.SUBCODE02 ='".trim($rowdb21['SUBCODE02'])."' AND p.SUBCODE03 ='".trim($rowdb21['SUBCODE03'])."' AND
p.SUBCODE04='".trim($rowdb21['SUBCODE04'])."' AND (p.PROJECTCODE ='".trim($rowdb21['PROJECTCODE'])."' OR p.ORIGDLVSALORDLINESALORDERCODE  ='".trim($rowdb21['PROJECTCODE'])."')
) a LEFT OUTER JOIN PRODUCT p ON
p.ITEMTYPECODE ='GYR' AND
p.SUBCODE01= a.SUBCODE01 AND p.SUBCODE02= a.SUBCODE02 AND 
p.SUBCODE03= a.SUBCODE03 AND p.SUBCODE04= a.SUBCODE04 AND 
p.SUBCODE05= a.SUBCODE05 AND p.SUBCODE06= a.SUBCODE06 AND
p.SUBCODE07= a.SUBCODE07 
GROUP BY 
p.SUBCODE01,p.SUBCODE02, 
p.SUBCODE03,p.SUBCODE04,
p.SUBCODE05,p.SUBCODE06,
p.SUBCODE07,p.LONGDESCRIPTION ";
$stmt3   = db2_exec($conn1,$sqlDB23, array('cursor'=>DB2_SCROLLABLE));
$ai=0;
$a[0]="";
$a[1]="";
$a[2]="";
$a[3]="";		
while($rowdb23 = db2_fetch_assoc($stmt3)){
	$a[$ai]=$rowdb23['LONGDESCRIPTION'];
	$ai++;
}
		
$bon=trim($rowdb21['PROVISIONALCODE'])."-".trim($rowdb21['ORDERLINE']);
$itemc=trim($rowdb21['SUBCODE02'])."".trim($rowdb21['SUBCODE03'])." ".trim($rowdb21['SUBCODE04']);		
if (trim($rowdb21['PROVISIONALCOUNTERCODE']) =='I02M50') { $knitt = 'KNITTING ITTI- GREIGE'; } 
$sqlDB24 = " SELECT LISTAGG(DISTINCT  TRIM(BLKOKASI.WAREHOUSELOCATIONCODE),', ') AS WAREHOUSELOCATIONCODE
	 FROM
(SELECT DISTINCT STKBLANCE.ELEMENTSCODE,  
       STKBLANCE.WAREHOUSELOCATIONCODE,
	   ITXVIEWLAPMASUKGREIGE.PROVISIONALCODE,ITXVIEWLAPMASUKGREIGE.ORDERLINE
       FROM DB2ADMIN.STOCKTRANSACTION STOCKTRANSACTION LEFT OUTER JOIN
DB2ADMIN.ITXVIEWLAPMASUKGREIGE ITXVIEWLAPMASUKGREIGE ON ITXVIEWLAPMASUKGREIGE.PROVISIONALCODE  = STOCKTRANSACTION.ORDERCODE
AND ITXVIEWLAPMASUKGREIGE.ORDERLINE  = STOCKTRANSACTION.ORDERLINE
AND ITXVIEWLAPMASUKGREIGE.PROVISIONALCOUNTERCODE  = STOCKTRANSACTION.ORDERCOUNTERCODE  
AND ITXVIEWLAPMASUKGREIGE.ITEMTYPEAFICODE = STOCKTRANSACTION.ITEMTYPECODE 
AND ITXVIEWLAPMASUKGREIGE.SUBCODE01= STOCKTRANSACTION.DECOSUBCODE01
AND ITXVIEWLAPMASUKGREIGE.SUBCODE02= STOCKTRANSACTION.DECOSUBCODE02
AND ITXVIEWLAPMASUKGREIGE.SUBCODE03= STOCKTRANSACTION.DECOSUBCODE03
AND ITXVIEWLAPMASUKGREIGE.SUBCODE04= STOCKTRANSACTION.DECOSUBCODE04
INNER JOIN ( SELECT
	b.WAREHOUSELOCATIONCODE,b.ELEMENTSCODE  
FROM BALANCE b  
WHERE b.ITEMTYPECODE ='KGF'  AND b.LOGICALWAREHOUSECODE ='M021' ) AS STKBLANCE ON STKBLANCE.ELEMENTSCODE=STOCKTRANSACTION.ITEMELEMENTCODE
WHERE STOCKTRANSACTION.ORDERCODE ='$rowdb21[PROVISIONALCODE]'  and STOCKTRANSACTION.ORDERLINE ='$rowdb21[ORDERLINE]' AND
STOCKTRANSACTION.LOGICALWAREHOUSECODE ='M021' 
AND NOT ITXVIEWLAPMASUKGREIGE.ORDERLINE IS NULL) AS BLKOKASI ";
$stmt4   = db2_exec($conn1,$sqlDB24, array('cursor'=>DB2_SCROLLABLE));					  
$rowdb24 = db2_fetch_assoc($stmt4);	

$sqlDB25 = " SELECT
   QUALITYDOCLINE.VALUEQUANTITY AS LEBAR1,GSM.VALUEQUANTITY AS GSM1
FROM
    QUALITYDOCLINE 
LEFT OUTER JOIN 
(SELECT
  QUALITYDOCPRODUCTIONORDERCODE,VALUEQUANTITY
FROM
    QUALITYDOCLINE
WHERE
	QUALITYDOCUMENTHEADERNUMBERID ='35' AND
    QUALITYDOCLINE.CHARACTERISTICCODE = 'GSM' AND 
	QUALITYDOCUMENTITEMTYPEAFICODE ='KGF'
	) GSM ON GSM.QUALITYDOCPRODUCTIONORDERCODE=QUALITYDOCLINE.QUALITYDOCPRODUCTIONORDERCODE
WHERE
	QUALITYDOCUMENTHEADERNUMBERID ='35'  AND
	QUALITYDOCLINE.CHARACTERISTICCODE = 'LEBAR1' AND
	QUALITYDOCUMENTITEMTYPEAFICODE ='KGF' AND
	QUALITYDOCLINE.QUALITYDOCPRODUCTIONORDERCODE='$rowdb21[EXTERNALREFERENCE]' ";
$stmt5   = db2_exec($conn1,$sqlDB25, array('cursor'=>DB2_SCROLLABLE));
$rowdb25 = db2_fetch_assoc($stmt5);
		
$sqlDB26 = " SELECT
   QUALITYDOCLINE.VALUEQUANTITY AS LEBAR1,GSM.VALUEQUANTITY AS GSM1
FROM
    QUALITYDOCLINE 
LEFT OUTER JOIN 
(SELECT
  QUALITYDOCPRODUCTIONORDERCODE,VALUEQUANTITY
FROM
    QUALITYDOCLINE
WHERE
	QUALITYDOCUMENTHEADERNUMBERID ='1379' AND
    QUALITYDOCLINE.CHARACTERISTICCODE = 'GSM' AND 
	QUALITYDOCUMENTITEMTYPEAFICODE ='KGF'
	) GSM ON GSM.QUALITYDOCPRODUCTIONORDERCODE=QUALITYDOCLINE.QUALITYDOCPRODUCTIONORDERCODE
WHERE
	QUALITYDOCUMENTHEADERNUMBERID ='1379' AND
	QUALITYDOCLINE.CHARACTERISTICCODE = 'LEBAR1' AND
	QUALITYDOCUMENTITEMTYPEAFICODE ='KGF' AND
	QUALITYDOCLINE.QUALITYDOCPRODUCTIONORDERCODE='$rowdb21[EXTERNALREFERENCE]' ";
$stmt6   = db2_exec($conn1,$sqlDB26, array('cursor'=>DB2_SCROLLABLE));
$rowdb26 = db2_fetch_assoc($stmt6);			
		
$sqlDB27 = " 
SELECT ad.VALUESTRING AS NO_MESIN
FROM PRODUCTIONDEMAND pd 	
LEFT OUTER JOIN ADSTORAGE ad ON ad.UNIQUEID = pd.ABSUNIQUEID AND ad.NAMENAME ='MachineNo'
WHERE  pd.CODE ='$rowdb21[LOTCODE]'
GROUP BY ad.VALUESTRING
";
$stmt7   = db2_exec($conn1,$sqlDB27, array('cursor'=>DB2_SCROLLABLE));					  
$rowdb27 = db2_fetch_assoc($stmt7);	
$sqlDB28 = " SELECT a.VALUEDECIMAL  FROM PRODUCT p 
LEFT OUTER JOIN ADSTORAGE a  ON a.UNIQUEID = p.ABSUNIQUEID 
WHERE p.SUBCODE01='$rowdb21[SUBCODE01]' AND
p.SUBCODE02='$rowdb21[SUBCODE02]' AND
p.SUBCODE03='$rowdb21[SUBCODE03]' AND
p.SUBCODE04='$rowdb21[SUBCODE04]' AND
a.NAMENAME ='Width' AND
p.ITEMTYPECODE ='KFF'  ";
$stmt8   = db2_exec($conn1,$sqlDB28, array('cursor'=>DB2_SCROLLABLE));
$rowdb28 = db2_fetch_assoc($stmt8);	
$sqlDB29 = " SELECT a.VALUEDECIMAL  FROM PRODUCT p 
LEFT OUTER JOIN ADSTORAGE a  ON a.UNIQUEID = p.ABSUNIQUEID 
WHERE p.SUBCODE01='$rowdb21[SUBCODE01]' AND
p.SUBCODE02='$rowdb21[SUBCODE02]' AND
p.SUBCODE03='$rowdb21[SUBCODE03]' AND
p.SUBCODE04='$rowdb21[SUBCODE04]' AND
a.NAMENAME ='GSM' AND
p.ITEMTYPECODE ='KFF'  ";
$stmt9   = db2_exec($conn1,$sqlDB29, array('cursor'=>DB2_SCROLLABLE));
$rowdb29 = db2_fetch_assoc($stmt9);
$sqlDB30 = " 
SELECT e.WIDTHGROSS AS LEBAR1,a.VALUEDECIMAL AS GSM1,s.ORDERCODE,s.ORDERLINE  FROM ELEMENTSINSPECTION e 
LEFT OUTER JOIN ADSTORAGE a ON a.UNIQUEID =e.ABSUNIQUEID AND a.NAMENAME ='GSM'
LEFT OUTER JOIN STOCKTRANSACTION s ON s.ITEMELEMENTCODE =e.ELEMENTCODE
WHERE s.ORDERCODE='".$rowdb21['PROVISIONALCODE']."' AND s.ORDERLINE='".$rowdb21['ORDERLINE']."'
GROUP BY s.ORDERCODE,s.ORDERLINE,e.WIDTHGROSS,a.VALUEDECIMAL
";
$stmt10   = db2_exec($conn1,$sqlDB30, array('cursor'=>DB2_SCROLLABLE));					  
$rowdb30 = db2_fetch_assoc($stmt10);		
if($rowdb22['LEGALNAME1']==""){$langganan="";}else{$langganan=$rowdb22['LEGALNAME1'];}
if($rowdb22['ORDERPARTNERBRANDCODE']==""){$buyer="";}else{$buyer=$rowdb22['ORDERPARTNERBRANDCODE'];}
if($rowdb21['QTY_KG']>0){$qtyB=$rowdb21['QTY_KG'];}else{$qtyB=$rowdb21['QTY1_KG'];}		
?>
	  <tr>
	  <td style="text-align: center"><?php echo $no;?></td>
	  <td style="text-align: center"><?php echo $rowdb21['TRANSACTIONDATE']; ?></td>
      <td style="text-align: center"><?php echo $bon; ?></td>
      <td style="text-align: left"><?php echo $buyer; ?></td>
      <td style="text-align: left"><?php echo $langganan; ?></td>
      <td style="text-align: center"><?php if(substr($rowdb21['EXTERNALREFERENCE'],0,3)=="000" or substr($rowdb21['EXTERNALREFERENCE'],0,2)=="00"){echo $rowdb21['EXTERNALREFERENCE'];} ?></td>
      <td><?php echo $itemc;?></td> 
      <td style="text-align: left"><?php echo $rowdb21['PROJECTCODE']; ?></td>
      <td style="text-align: left"><span style="text-align: center"><?php if($rowdb21['SCHEDULEDRESOURCECODE']!=""){echo $rowdb21['SCHEDULEDRESOURCECODE'];}else{echo $rowdb27['NO_MESIN'];} ?></span></td>
      <td style="text-align: center"><?php if(substr($rowdb21['EXTERNALREFERENCE'],0,3)!="000" or substr($rowdb21['EXTERNALREFERENCE'],0,2)!="00"){echo $rowdb21['EXTERNALREFERENCE'];} ?></td>
      <td style="text-align: left"><span style="text-align: center">
        <?php if($rowdb25['LEBAR1']!=""){echo round($rowdb25['LEBAR1']);}else if($rowdb26['LEBAR1']!=""){echo round($rowdb26['LEBAR1']);}else{ echo round($rowdb30['LEBAR1']);} ?>
      </span></td>
      <td style="text-align: left"><span style="text-align: center">
        <?php if($rowdb25['GSM1']!=""){echo round($rowdb25['GSM1']);}else if($rowdb26['GSM1']!=""){echo round($rowdb26['GSM1']);}else{echo round($rowdb30['GSM1']); } ?>
      </span></td>
      <td style="text-align: left"><span style="text-align: center"><?php echo round($rowdb28['VALUEDECIMAL']); ?></span></td>
      <td style="text-align: left"><span style="text-align: center"><?php echo round($rowdb29['VALUEDECIMAL']); ?></span></td>
      <td style="text-align: left"><?php echo $rowdb21['SUMMARIZEDDESCRIPTION']; ?></td>
      <td style="text-align: center"><?php echo $rowdb21['LOTCODE']; ?></td>
      <td style="text-align: left"><?php echo $a[0]; ?></td>
      <td style="text-align: left"><?php echo $a[1]; ?></td>
      <td style="text-align: left"><?php echo $a[2]; ?></td>
      <td style="text-align: left"><?php echo $a[3]; ?></td>
      <td style="text-align: right"><?php echo $rowdb21['QTY_ROL']; ?></td>
      <td style="text-align: right"><?php echo $qtyB; ?></td>
      <td><?php echo $rowdb21['WHSLOCATIONWAREHOUSEZONECODE']."-".$rowdb21['WAREHOUSELOCATIONCODE']; ?></td>
      <td><?php echo $rowdb24['WAREHOUSELOCATIONCODE']; ?></td>
      <td><?php  echo $rowdb21['CREATIONUSER']; ?></td>
      </tr>
	  				  
	<?php 
	 $no++; 
	$tMRol+=$rowdb21['QTY_ROL'];
	$tMKG +=$qtyB;
	} ?>
				  </tbody>
                  <tfoot>
	 <tr>
	    <td style="text-align: center">&nbsp;</td>
	    <td style="text-align: center">&nbsp;</td>
	    <td style="text-align: center">&nbsp;</td>
	    <td style="text-align: center">&nbsp;</td>
	    <td style="text-align: center">&nbsp;</td>
	    <td style="text-align: center">&nbsp;</td>
	    <td>&nbsp;</td>
	    <td style="text-align: left">&nbsp;</td>
	    <td style="text-align: left">&nbsp;</td>
	    <td style="text-align: center">&nbsp;</td>
	    <td style="text-align: left">&nbsp;</td>
	    <td style="text-align: left">&nbsp;</td>
	    <td style="text-align: left">&nbsp;</td>
	    <td style="text-align: left">&nbsp;</td>
	    <td style="text-align: left">&nbsp;</td>
	    <td style="text-align: center">&nbsp;</td>
	    <td style="text-align: left">&nbsp;</td>
	    <td colspan="3" style="text-align: right"><strong>Total</strong></td>
	    <td style="text-align: right"><strong><?php echo $tMRol;?></strong></td>
	    <td style="text-align: right"><strong><?php echo number_format(round($tMKG,2),2);?></strong></td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    </tr>				
					</tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div> 
		<div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Detail Laporan Retur Produksi</h3>				 
                  <a href="pages/cetak/lapReturUlang_excel.php?awal=<?php echo $Awal;?>&akhir=<?php echo $Akhir;?>" class="btn bg-red float-right" target="_blank">Cetak Excel</a>
          </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example17" width="100%" class="table table-sm table-bordered table-striped" style="font-size: 11px; text-align: center;">
                  <thead>
                  <tr>
                    <th rowspan="2" valign="middle" style="text-align: center">No</th>
                    <th rowspan="2" valign="middle" style="text-align: center">Tgl Masuk</th>
                    <th rowspan="2" valign="middle" style="text-align: center">No BON</th>
                    <th rowspan="2" valign="middle" style="text-align: center">Buyer</th>
                    <th rowspan="2" valign="middle" style="text-align: center">Customer</th>
                    <th rowspan="2" valign="middle" style="text-align: center">Prod. Order</th>
                    <th rowspan="2" valign="middle" style="text-align: center">Code</th>
                    <th rowspan="2" valign="middle" style="text-align: center">Project</th>
                    <th rowspan="2" valign="middle" style="text-align: center">Alur Proses</th>
                    <th rowspan="2" valign="middle" style="text-align: center">Mesin Rajut</th>
                    <th colspan="2" valign="middle" style="text-align: center">Greige</th>
                    <th colspan="2" valign="middle" style="text-align: center">Kain Jadi</th>
                    <th rowspan="2" valign="middle" style="text-align: center">Jenis Kain</th>
                    <th rowspan="2" valign="middle" style="text-align: center">Lot</th>
                    <th colspan="4" valign="middle" style="text-align: center">Jenis Benang</th>
                    <th rowspan="2" valign="middle" style="text-align: center">Qty</th>
                    <th rowspan="2" valign="middle" style="text-align: center">Berat/Kg</th>
                    <th rowspan="2" valign="middle" style="text-align: center">Block</th>
                    <th rowspan="2" valign="middle" style="text-align: center">Balance</th>
                    <th rowspan="2" valign="middle" style="text-align: center">User</th>
                  </tr>
                  <tr>
                    <th valign="middle" style="text-align: center">Lebar</th>
                    <th valign="middle" style="text-align: center">Gramasi</th>
                    <th valign="middle" style="text-align: center">Lebar</th>
                    <th valign="middle" style="text-align: center">Gramasi</th>
                    <th valign="middle" style="text-align: center">1</th>
                    <th valign="middle" style="text-align: center">2</th>
                    <th valign="middle" style="text-align: center">3</th>
                    <th valign="middle" style="text-align: center">4</th>
                    </tr>
                  </thead>
                  <tbody>
				  <?php
	 
$no=1;   
$c=0;
					  
	$sqlDB21R = " SELECT s.PROJECTCODE,f.SUMMARIZEDDESCRIPTION,
s.TRANSACTIONDATE,s.DECOSUBCODE01,s.DECOSUBCODE02,s.DECOSUBCODE03,
s.DECOSUBCODE04,s.WHSLOCATIONWAREHOUSEZONECODE,s.WAREHOUSELOCATIONCODE,
s.LOTCODE,SUM(s.BASEPRIMARYQUANTITY) AS KG,COUNT(s.ITEMELEMENTCODE) AS JML, a2.VALUESTRING AS ALURPROSES,
s.CREATIONUSER,a1.VALUESTRING AS NOMESIN FROM STOCKTRANSACTION s 
LEFT OUTER JOIN ADSTORAGE a ON a.UNIQUEID = s.ABSUNIQUEID AND a.NAMENAME = 'StatusRetur'
LEFT OUTER JOIN PRODUCTIONDEMAND p ON p.CODE = s.LOTCODE
LEFT OUTER JOIN ADSTORAGE a1 ON a1.UNIQUEID = p.ABSUNIQUEID AND a1.NAMENAME = 'MachineNo'
LEFT OUTER JOIN ADSTORAGE a2 ON a2.UNIQUEID = s.ABSUNIQUEID AND a2.NAMENAME = 'AlurProses'
LEFT OUTER JOIN FULLITEMKEYDECODER f ON s.FULLITEMIDENTIFIER = f.IDENTIFIER
WHERE s.TRANSACTIONDATE BETWEEN '$Awal' AND '$Akhir' AND s.ITEMTYPECODE='KGF' AND 
s.LOGICALWAREHOUSECODE ='M021' AND s.TEMPLATECODE = 'OPN' AND a.VALUESTRING =  '1'
GROUP BY s.PROJECTCODE,
s.TRANSACTIONDATE,s.DECOSUBCODE01,s.DECOSUBCODE02,
s.DECOSUBCODE03, s.DECOSUBCODE04,
s.WHSLOCATIONWAREHOUSEZONECODE,
s.WAREHOUSELOCATIONCODE, s.LOTCODE, f.SUMMARIZEDDESCRIPTION, s.CREATIONUSER, a1.VALUESTRING, a2.VALUESTRING";
	$stmt1R   = db2_exec($conn1,$sqlDB21R, array('cursor'=>DB2_SCROLLABLE));
	//}				  
    while($rowdb21R = db2_fetch_assoc($stmt1R)){ 
$itemcR=trim($rowdb21R['DECOSUBCODE02'])."".trim($rowdb21R['DECOSUBCODE03'])." ".trim($rowdb21R['DECOSUBCODE04']);
		
$sqlDB22R1 = " SELECT SALESORDER.CODE, SALESORDER.EXTERNALREFERENCE, SALESORDER.ORDPRNCUSTOMERSUPPLIERCODE,
		ITXVIEWAKJ.LEGALNAME1, ITXVIEWAKJ.ORDERPARTNERBRANDCODE, ITXVIEWAKJ.LONGDESCRIPTION
		FROM DB2ADMIN.SALESORDER SALESORDER LEFT OUTER JOIN DB2ADMIN.ITXVIEWAKJ 
       	ITXVIEWAKJ ON SALESORDER.CODE=ITXVIEWAKJ.CODE
		WHERE SALESORDER.CODE='".trim($rowdb21R['PROJECTCODE'])."' ";
$stmt2R1   = db2_exec($conn1,$sqlDB22R1, array('cursor'=>DB2_SCROLLABLE));
$rowdb22R1 = db2_fetch_assoc($stmt2R1);
		
$sqlDB22R = " SELECT LISTAGG(DISTINCT  TRIM(BALANCE.WAREHOUSELOCATIONCODE),', ') AS WAREHOUSELOCATIONCODE, COUNT(BALANCE.BASEPRIMARYQUANTITYUNIT) AS ROL,SUM(BALANCE.BASEPRIMARYQUANTITYUNIT) AS BERAT,BALANCE.LOTCODE  
		FROM (
		SELECT 
s.ITEMELEMENTCODE  FROM STOCKTRANSACTION s 
LEFT OUTER JOIN ADSTORAGE a ON a.UNIQUEID = s.ABSUNIQUEID AND a.NAMENAME = 'StatusRetur'
WHERE s.PROJECTCODE='".$rowdb21R['PROJECTCODE']."' AND s.ITEMTYPECODE='KGF' AND 
s.DECOSUBCODE02='".$rowdb21R['DECOSUBCODE02']."' AND s.DECOSUBCODE03='".$rowdb21R['DECOSUBCODE03']."' AND 
s.DECOSUBCODE04='".$rowdb21R['DECOSUBCODE04']."' AND s.LOGICALWAREHOUSECODE ='M021' AND
s.LOTCODE='$rowdb21R[LOTCODE]' AND 
s.TEMPLATECODE = 'OPN' AND a.VALUESTRING =  '1'
GROUP BY 
s.ITEMELEMENTCODE
		) STOCKTRANSACTION LEFT OUTER JOIN 
		DB2ADMIN.BALANCE BALANCE ON BALANCE.ELEMENTSCODE =STOCKTRANSACTION.ITEMELEMENTCODE  
		GROUP BY BALANCE.LOTCODE ";					  
		$stmt2R   = db2_exec($conn1,$sqlDB22R, array('cursor'=>DB2_SCROLLABLE));	
		$rowdb22R = db2_fetch_assoc($stmt2R);
$sqlDB23R = " SELECT p.SUBCODE01,p.SUBCODE02,p.SUBCODE03,p.SUBCODE04,p.SUBCODE05,p.SUBCODE06,p.SUBCODE07, p.LONGDESCRIPTION FROM (
SELECT p2.ITEMTYPEAFICODE,p2.SUBCODE01,p2.SUBCODE02,p2.SUBCODE03,p2.SUBCODE04,
p2.SUBCODE05,p2.SUBCODE06,p2.SUBCODE07  FROM PRODUCTIONDEMAND p 
LEFT OUTER JOIN PRODUCTIONRESERVATION p2 ON p.CODE =p2.ORDERCODE 
WHERE p.ITEMTYPEAFICODE ='KGF' AND p.SUBCODE01='".trim($rowdb21R['DECOSUBCODE01'])."' 
AND p.SUBCODE02 ='".trim($rowdb21R['DECOSUBCODE02'])."' AND p.SUBCODE03 ='".trim($rowdb21R['DECOSUBCODE03'])."' AND
p.SUBCODE04='".trim($rowdb21R['DECOSUBCODE04'])."' AND (p.PROJECTCODE ='".trim($rowdb21R['PROJECTCODE'])."' OR p.ORIGDLVSALORDLINESALORDERCODE  ='".trim($rowdb21R['PROJECTCODE'])."')
) a LEFT OUTER JOIN PRODUCT p ON
p.ITEMTYPECODE ='GYR' AND
p.SUBCODE01= a.SUBCODE01 AND p.SUBCODE02= a.SUBCODE02 AND 
p.SUBCODE03= a.SUBCODE03 AND p.SUBCODE04= a.SUBCODE04 AND 
p.SUBCODE05= a.SUBCODE05 AND p.SUBCODE06= a.SUBCODE06 AND
p.SUBCODE07= a.SUBCODE07 
GROUP BY 
p.SUBCODE01,p.SUBCODE02, 
p.SUBCODE03,p.SUBCODE04,
p.SUBCODE05,p.SUBCODE06,
p.SUBCODE07,p.LONGDESCRIPTION ";
$stmt3R   = db2_exec($conn1,$sqlDB23R, array('cursor'=>DB2_SCROLLABLE));
$aiR=0;
$aR[0]="";
$aR[1]="";
$aR[2]="";
$aR[3]="";		
while($rowdb23R = db2_fetch_assoc($stmt3R)){
	$aR[$aiR]=$rowdb23R['LONGDESCRIPTION'];
	$aiR++;
}		
/*$sqlDB26R = " SELECT e.WIDTHGROSS AS LEBAR1,a.VALUEDECIMAL AS GSM1, e.DEMANDCODE  FROM ELEMENTSINSPECTION e 
LEFT OUTER JOIN ADSTORAGE a ON a.UNIQUEID =e.ABSUNIQUEID AND a.NAMENAME ='GSM'
WHERE e.ELEMENTITEMTYPECODE='KGF' AND e.DEMANDCODE='$rowdb21R[LOTCODE]'
GROUP BY e.WIDTHGROSS,a.VALUEDECIMAL,e.DEMANDCODE ";
$stmt6R   = db2_exec($conn1,$sqlDB26R, array('cursor'=>DB2_SCROLLABLE));
$rowdb26R = db2_fetch_assoc($stmt6R);*/

$sqlDB28R = " SELECT a.VALUEDECIMAL  FROM PRODUCT p 
LEFT OUTER JOIN ADSTORAGE a  ON a.UNIQUEID = p.ABSUNIQUEID 
WHERE p.SUBCODE01='".trim($rowdb21R['DECOSUBCODE01'])."' AND
p.SUBCODE02='".trim($rowdb21R['DECOSUBCODE02'])."' AND
p.SUBCODE03='".trim($rowdb21R['DECOSUBCODE03'])."' AND
p.SUBCODE04='".trim($rowdb21R['DECOSUBCODE04'])."' AND
a.NAMENAME ='Width' AND
p.ITEMTYPECODE ='KFF'  ";
$stmt8R   = db2_exec($conn1,$sqlDB28R, array('cursor'=>DB2_SCROLLABLE));
$rowdb28R = db2_fetch_assoc($stmt8R);	
$sqlDB29R = " SELECT a.VALUEDECIMAL  FROM PRODUCT p 
LEFT OUTER JOIN ADSTORAGE a  ON a.UNIQUEID = p.ABSUNIQUEID 
WHERE p.SUBCODE01='".trim($rowdb21R['DECOSUBCODE01'])."' AND
p.SUBCODE02='".trim($rowdb21R['DECOSUBCODE02'])."' AND
p.SUBCODE03='".trim($rowdb21R['DECOSUBCODE03'])."' AND
p.SUBCODE04='".trim($rowdb21R['DECOSUBCODE04'])."' AND
a.NAMENAME ='GSM' AND
p.ITEMTYPECODE ='KFF'  ";
$stmt9R   = db2_exec($conn1,$sqlDB29R, array('cursor'=>DB2_SCROLLABLE));
$rowdb29R = db2_fetch_assoc($stmt9R);		
if($rowdb22R1['LEGALNAME1']==""){$langganan="";}else{$langganan=$rowdb22R1['LEGALNAME1'];}
if($rowdb22R1['ORDERPARTNERBRANDCODE']==""){$buyer="";}else{$buyer=$rowdb22R1['ORDERPARTNERBRANDCODE'];}		
?>
	  <tr>
	  <td style="text-align: center"><?php echo $no;?></td>
	  <td style="text-align: center"><?php echo $rowdb21R['TRANSACTIONDATE']; ?></td>
	  <td style="text-align: center">&nbsp;</td>
	  <td style="text-align: left"><?php echo $buyer; ?></td>
	  <td style="text-align: left"><?php echo $langganan; ?></td>
	  <td style="text-align: center">&nbsp;</td>
      <td style="text-align: center"><?php echo $itemcR; ?></td>
      <td style="text-align: center"><?php echo $rowdb21R['PROJECTCODE']; ?></td>
      <td style="text-align: center"><?php if($rowdb21R['ALURPROSES']=="1"){echo "Steam-Preset";}else if($rowdb21R['ALURPROSES']=="2"){echo "Relaxing-Preset";} ?></td>
      <td style="text-align: center"><?php echo $rowdb21R['NOMESIN']; ?></td> 
      <td style="text-align: center"><?php //echo round($rowdb26R['LEBAR1']); ?></td>
      <td style="text-align: center"><?php //echo round($rowdb26R['GSM1']); ?></td>
      <td style="text-align: center"><?php echo round($rowdb28R['VALUEDECIMAL']); ?></td>
      <td style="text-align: center"><?php echo round($rowdb29R['VALUEDECIMAL']); ?></td>
      <td style="text-align: left"><?php echo $rowdb21R['SUMMARIZEDDESCRIPTION']; ?></td>
      <td style="text-align: center"><?php echo $rowdb21R['LOTCODE']; ?></td>
      <td style="text-align: left"><?php echo $aR[0]; ?></td>
      <td style="text-align: left"><?php echo $aR[1]; ?></td>
      <td style="text-align: left"><?php echo $aR[2]; ?></td>
      <td style="text-align: left"><?php echo $aR[3]; ?></td>
      <td style="text-align: right"><?php echo $rowdb21R['JML']; ?></td>
      <td style="text-align: right"><?php echo $rowdb21R['KG']; ?></td>
      <td style="text-align: center"><?php echo $rowdb21R['WHSLOCATIONWAREHOUSEZONECODE']."-".$rowdb21R['WAREHOUSELOCATIONCODE']; ?></td>
      <td style="text-align: center"><?php echo $rowdb22R['WAREHOUSELOCATIONCODE']; ?></td>
      <td style="text-align: center"><?php  echo $rowdb21R['CREATIONUSER']; ?></td>
      </tr>
	  				  
	<?php 
	 $no++; 
	$tMRolR+=$rowdb21R['JML'];
	$tMKGR +=$rowdb21R['KG'];
	$tKRolR+=$rowdb22R['ROL'];
	$tKKGR +=$rowdb22R['BERAT'];	
	} ?>
				  </tbody>
                  <tfoot>
		<tr>
	    <td style="text-align: center">&nbsp;</td>
	    <td style="text-align: center">&nbsp;</td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    <td style="text-align: center">&nbsp;</td>
	    <td style="text-align: center">&nbsp;</td>
	    <td style="text-align: center">&nbsp;</td>
	    <td style="text-align: right">&nbsp;</td>
	    <td style="text-align: right">&nbsp;</td>
	    <td style="text-align: center">&nbsp;</td>
	    <td style="text-align: center">&nbsp;</td>
	    <td style="text-align: center">&nbsp;</td>
	    <td style="text-align: center">&nbsp;</td>
	    <td style="text-align: right">&nbsp;</td>
	    <td colspan="3" style="text-align: right"><strong>Total</strong></td>
	    <td style="text-align: right"><strong><?php echo $tMRolR;?></strong></td>
	    <td style="text-align: right"><strong><?php echo $tMKGR;?></strong></td>
	    <td style="text-align: right">&nbsp;</td>
	    <td style="text-align: right">&nbsp;</td>
	    <td style="text-align: right">&nbsp;</td>
	    </tr>			
		</tfoot>
                </table>
              </div>
              <!-- /.card-body -->
          </div>
		<div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Detail Laporan Retur Untuk Bagi Ulang</h3>				 
                  <a href="pages/cetak/lapBagiUlang_excel.php?awal=<?php echo $Awal;?>&akhir=<?php echo $Akhir;?>" class="btn bg-red float-right" target="_blank">Cetak Excel</a>  
          </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example18" width="100%" class="table table-sm table-bordered table-striped" style="font-size: 11px; text-align: center;">
                  <thead>
                  <tr>
                    <th rowspan="2" valign="middle" style="text-align: center">No</th>
                    <th rowspan="2" valign="middle" style="text-align: center">Tgl Masuk</th>
                    <th rowspan="2" valign="middle" style="text-align: center">No BON</th>
                    <th rowspan="2" valign="middle" style="text-align: center">Buyer</th>
                    <th rowspan="2" valign="middle" style="text-align: center">Customer</th>
                    <th rowspan="2" valign="middle" style="text-align: center">Prod. Order</th>
                    <th rowspan="2" valign="middle" style="text-align: center">Code</th>
                    <th rowspan="2" valign="middle" style="text-align: center">Project</th>
                    <th rowspan="2" valign="middle" style="text-align: center">Alur Proses</th>
                    <th rowspan="2" valign="middle" style="text-align: center">Mesin Rajut</th>
                    <th colspan="2" valign="middle" style="text-align: center">Greige</th>
                    <th colspan="2" valign="middle" style="text-align: center">Kain Jadi</th>
                    <th rowspan="2" valign="middle" style="text-align: center">Jenis Kain</th>
                    <th rowspan="2" valign="middle" style="text-align: center">Lot</th>
                    <th colspan="4" valign="middle" style="text-align: center">Jenis Benang</th>
                    <th rowspan="2" valign="middle" style="text-align: center">Qty</th>
                    <th rowspan="2" valign="middle" style="text-align: center">Berat/Kg</th>
                    <th rowspan="2" valign="middle" style="text-align: center">Block</th>
                    <th rowspan="2" valign="middle" style="text-align: center">Balance</th>
                    <th rowspan="2" valign="middle" style="text-align: center">User</th>
                  </tr>
                  <tr>
                    <th valign="middle" style="text-align: center">Lebar</th>
                    <th valign="middle" style="text-align: center">Gramasi</th>
                    <th valign="middle" style="text-align: center">Lebar</th>
                    <th valign="middle" style="text-align: center">Gramasi</th>
                    <th valign="middle" style="text-align: center">1</th>
                    <th valign="middle" style="text-align: center">2</th>
                    <th valign="middle" style="text-align: center">3</th>
                    <th valign="middle" style="text-align: center">4</th>
                    </tr>
                  </thead>
                  <tbody>
				  <?php
	 
$no=1;   
$c=0;
					  
	$sqlDB21RBU = " SELECT s.PROJECTCODE,f.SUMMARIZEDDESCRIPTION,
s.TRANSACTIONDATE,s.DECOSUBCODE01,s.DECOSUBCODE02,s.DECOSUBCODE03,
s.DECOSUBCODE04,s.WHSLOCATIONWAREHOUSEZONECODE,s.WAREHOUSELOCATIONCODE,
s.LOTCODE,SUM(s.BASEPRIMARYQUANTITY) AS KG,COUNT(s.ITEMELEMENTCODE) AS JML, a2.VALUESTRING AS ALURPROSES,
s.CREATIONUSER,a1.VALUESTRING AS NOMESIN FROM STOCKTRANSACTION s 
LEFT OUTER JOIN ADSTORAGE a ON a.UNIQUEID = s.ABSUNIQUEID AND a.NAMENAME = 'StatusRetur'
LEFT OUTER JOIN PRODUCTIONDEMAND p ON p.CODE = s.LOTCODE
LEFT OUTER JOIN ADSTORAGE a1 ON a1.UNIQUEID = p.ABSUNIQUEID AND a1.NAMENAME = 'MachineNo'
LEFT OUTER JOIN ADSTORAGE a2 ON a2.UNIQUEID = s.ABSUNIQUEID AND a2.NAMENAME = 'AlurProses'
LEFT OUTER JOIN FULLITEMKEYDECODER f ON s.FULLITEMIDENTIFIER = f.IDENTIFIER
WHERE s.TRANSACTIONDATE BETWEEN '$Awal' AND '$Akhir' AND s.ITEMTYPECODE='KGF' AND 
s.LOGICALWAREHOUSECODE ='M021' AND s.TEMPLATECODE = 'OPN' AND a.VALUESTRING =  '2'
GROUP BY s.PROJECTCODE,
s.TRANSACTIONDATE,s.DECOSUBCODE01,s.DECOSUBCODE02,
s.DECOSUBCODE03, s.DECOSUBCODE04,
s.WHSLOCATIONWAREHOUSEZONECODE,
s.WAREHOUSELOCATIONCODE, s.LOTCODE, f.SUMMARIZEDDESCRIPTION, s.CREATIONUSER, a1.VALUESTRING, a2.VALUESTRING";
	$stmt1RBU   = db2_exec($conn1,$sqlDB21RBU, array('cursor'=>DB2_SCROLLABLE));
	//}				  
    while($rowdb21RBU = db2_fetch_assoc($stmt1RBU)){ 
$itemcRBU=trim($rowdb21RBU['DECOSUBCODE02'])."".trim($rowdb21RBU['DECOSUBCODE03'])." ".trim($rowdb21RBU['DECOSUBCODE04']);
		
$sqlDB22R1BU = " SELECT SALESORDER.CODE, SALESORDER.EXTERNALREFERENCE, SALESORDER.ORDPRNCUSTOMERSUPPLIERCODE,
		ITXVIEWAKJ.LEGALNAME1, ITXVIEWAKJ.ORDERPARTNERBRANDCODE, ITXVIEWAKJ.LONGDESCRIPTION
		FROM DB2ADMIN.SALESORDER SALESORDER LEFT OUTER JOIN DB2ADMIN.ITXVIEWAKJ 
       	ITXVIEWAKJ ON SALESORDER.CODE=ITXVIEWAKJ.CODE
		WHERE SALESORDER.CODE='".trim($rowdb21RBU['PROJECTCODE'])."' ";
$stmt2R1BU   = db2_exec($conn1,$sqlDB22R1BU, array('cursor'=>DB2_SCROLLABLE));
$rowdb22R1BU = db2_fetch_assoc($stmt2R1BU);
		
$sqlDB22RBU = " SELECT LISTAGG(DISTINCT  TRIM(BALANCE.WAREHOUSELOCATIONCODE),', ') AS WAREHOUSELOCATIONCODE, COUNT(BALANCE.BASEPRIMARYQUANTITYUNIT) AS ROL,SUM(BALANCE.BASEPRIMARYQUANTITYUNIT) AS BERAT,BALANCE.LOTCODE  
		FROM (
		SELECT 
s.ITEMELEMENTCODE  FROM STOCKTRANSACTION s 
LEFT OUTER JOIN ADSTORAGE a ON a.UNIQUEID = s.ABSUNIQUEID AND a.NAMENAME = 'StatusRetur'
WHERE s.PROJECTCODE='".$rowdb21RBU['PROJECTCODE']."' AND s.ITEMTYPECODE='KGF' AND 
s.DECOSUBCODE02='".$rowdb21RBU['DECOSUBCODE02']."' AND s.DECOSUBCODE03='".$rowdb21RBU['DECOSUBCODE03']."' AND 
s.DECOSUBCODE04='".$rowdb21RBU['DECOSUBCODE04']."' AND s.LOGICALWAREHOUSECODE ='M021' AND
s.LOTCODE='$rowdb21RBU[LOTCODE]' AND 
s.TEMPLATECODE = 'OPN' AND a.VALUESTRING =  '2'
GROUP BY 
s.ITEMELEMENTCODE
		) STOCKTRANSACTION LEFT OUTER JOIN 
		DB2ADMIN.BALANCE BALANCE ON BALANCE.ELEMENTSCODE =STOCKTRANSACTION.ITEMELEMENTCODE  
		GROUP BY BALANCE.LOTCODE ";					  
		$stmt2RBU   = db2_exec($conn1,$sqlDB22RBU, array('cursor'=>DB2_SCROLLABLE));	
		$rowdb22RBU = db2_fetch_assoc($stmt2RBU);
$sqlDB23RBU = " SELECT p.SUBCODE01,p.SUBCODE02,p.SUBCODE03,p.SUBCODE04,p.SUBCODE05,p.SUBCODE06,p.SUBCODE07, p.LONGDESCRIPTION FROM (
SELECT p2.ITEMTYPEAFICODE,p2.SUBCODE01,p2.SUBCODE02,p2.SUBCODE03,p2.SUBCODE04,
p2.SUBCODE05,p2.SUBCODE06,p2.SUBCODE07  FROM PRODUCTIONDEMAND p 
LEFT OUTER JOIN PRODUCTIONRESERVATION p2 ON p.CODE =p2.ORDERCODE 
WHERE p.ITEMTYPEAFICODE ='KGF' AND p.SUBCODE01='".trim($rowdb21RBU['DECOSUBCODE01'])."' 
AND p.SUBCODE02 ='".trim($rowdb21RBU['DECOSUBCODE02'])."' AND p.SUBCODE03 ='".trim($rowdb21RBU['DECOSUBCODE03'])."' AND
p.SUBCODE04='".trim($rowdb21RBU['DECOSUBCODE04'])."' AND (p.PROJECTCODE ='".trim($rowdb21RBU['PROJECTCODE'])."' OR p.ORIGDLVSALORDLINESALORDERCODE  ='".trim($rowdb21RBU['PROJECTCODE'])."')
) a LEFT OUTER JOIN PRODUCT p ON
p.ITEMTYPECODE ='GYR' AND
p.SUBCODE01= a.SUBCODE01 AND p.SUBCODE02= a.SUBCODE02 AND 
p.SUBCODE03= a.SUBCODE03 AND p.SUBCODE04= a.SUBCODE04 AND 
p.SUBCODE05= a.SUBCODE05 AND p.SUBCODE06= a.SUBCODE06 AND
p.SUBCODE07= a.SUBCODE07 
GROUP BY 
p.SUBCODE01,p.SUBCODE02, 
p.SUBCODE03,p.SUBCODE04,
p.SUBCODE05,p.SUBCODE06,
p.SUBCODE07,p.LONGDESCRIPTION ";
$stmt3RBU   = db2_exec($conn1,$sqlDB23RBU, array('cursor'=>DB2_SCROLLABLE));
$aiRBU=0;
$aRBU[0]="";
$aRBU[1]="";
$aRBU[2]="";
$aRBU[3]="";		
while($rowdb23RBU = db2_fetch_assoc($stmt3RBU)){
	$aRBU[$aiRBU]=$rowdb23RBU['LONGDESCRIPTION'];
	$aiRBU++;
}		
/*$sqlDB26R = " SELECT e.WIDTHGROSS AS LEBAR1,a.VALUEDECIMAL AS GSM1, e.DEMANDCODE  FROM ELEMENTSINSPECTION e 
LEFT OUTER JOIN ADSTORAGE a ON a.UNIQUEID =e.ABSUNIQUEID AND a.NAMENAME ='GSM'
WHERE e.ELEMENTITEMTYPECODE='KGF' AND e.DEMANDCODE='$rowdb21R[LOTCODE]'
GROUP BY e.WIDTHGROSS,a.VALUEDECIMAL,e.DEMANDCODE ";
$stmt6R   = db2_exec($conn1,$sqlDB26R, array('cursor'=>DB2_SCROLLABLE));
$rowdb26R = db2_fetch_assoc($stmt6R);*/

$sqlDB28RBU = " SELECT a.VALUEDECIMAL  FROM PRODUCT p 
LEFT OUTER JOIN ADSTORAGE a  ON a.UNIQUEID = p.ABSUNIQUEID 
WHERE p.SUBCODE01='".trim($rowdb21RBU['DECOSUBCODE01'])."' AND
p.SUBCODE02='".trim($rowdb21RBU['DECOSUBCODE02'])."' AND
p.SUBCODE03='".trim($rowdb21RBU['DECOSUBCODE03'])."' AND
p.SUBCODE04='".trim($rowdb21RBU['DECOSUBCODE04'])."' AND
a.NAMENAME ='Width' AND
p.ITEMTYPECODE ='KFF'  ";
$stmt8RBU   = db2_exec($conn1,$sqlDB28RBU, array('cursor'=>DB2_SCROLLABLE));
$rowdb28RBU = db2_fetch_assoc($stmt8RBU);	
$sqlDB29RBU = " SELECT a.VALUEDECIMAL  FROM PRODUCT p 
LEFT OUTER JOIN ADSTORAGE a  ON a.UNIQUEID = p.ABSUNIQUEID 
WHERE p.SUBCODE01='".trim($rowdb21RBU['DECOSUBCODE01'])."' AND
p.SUBCODE02='".trim($rowdb21RBU['DECOSUBCODE02'])."' AND
p.SUBCODE03='".trim($rowdb21RBU['DECOSUBCODE03'])."' AND
p.SUBCODE04='".trim($rowdb21RBU['DECOSUBCODE04'])."' AND
a.NAMENAME ='GSM' AND
p.ITEMTYPECODE ='KFF'  ";
$stmt9RBU   = db2_exec($conn1,$sqlDB29RBU, array('cursor'=>DB2_SCROLLABLE));
$rowdb29RBU = db2_fetch_assoc($stmt9RBU);		
if($rowdb22R1BU['LEGALNAME1']==""){$langgananBU="";}else{$langgananBU=$rowdb22R1BU['LEGALNAME1'];}
if($rowdb22R1BU['ORDERPARTNERBRANDCODE']==""){$buyerBU="";}else{$buyerBU=$rowdb22R1BU['ORDERPARTNERBRANDCODE'];}		
?>
	  <tr>
	  <td style="text-align: center"><?php echo $no;?></td>
	  <td style="text-align: center"><?php echo $rowdb21RBU['TRANSACTIONDATE']; ?></td>
	  <td style="text-align: center">&nbsp;</td>
	  <td style="text-align: left"><?php echo $buyerBU; ?></td>
	  <td style="text-align: left"><?php echo $langgananBU; ?></td>
	  <td style="text-align: center">&nbsp;</td>
      <td style="text-align: center"><?php echo $itemcRBU; ?></td>
      <td style="text-align: center"><?php echo $rowdb21RBU['PROJECTCODE']; ?></td>
      <td style="text-align: center"><?php if($rowdb21RBU['ALURPROSES']=="1"){echo "Steam-Preset";}else if($rowdb21RBU['ALURPROSES']=="2"){echo "Relaxing-Preset";} ?></td>
      <td style="text-align: center"><?php echo $rowdb21RBU['NOMESIN']; ?></td> 
      <td style="text-align: center"><?php //echo round($rowdb26R['LEBAR1']); ?></td>
      <td style="text-align: center"><?php //echo round($rowdb26R['GSM1']); ?></td>
      <td style="text-align: center"><?php echo round($rowdb28RBU['VALUEDECIMAL']); ?></td>
      <td style="text-align: center"><?php echo round($rowdb29RBU['VALUEDECIMAL']); ?></td>
      <td style="text-align: left"><?php echo $rowdb21RBU['SUMMARIZEDDESCRIPTION']; ?></td>
      <td style="text-align: center"><?php echo $rowdb21RBU['LOTCODE']; ?></td>
      <td style="text-align: left"><?php echo $aRBU[0]; ?></td>
      <td style="text-align: left"><?php echo $aRBU[1]; ?></td>
      <td style="text-align: left"><?php echo $aRBU[2]; ?></td>
      <td style="text-align: left"><?php echo $aRBU[3]; ?></td>
      <td style="text-align: right"><?php echo $rowdb21RBU['JML']; ?></td>
      <td style="text-align: right"><?php echo $rowdb21RBU['KG']; ?></td>
      <td style="text-align: center"><?php echo $rowdb21RBU['WHSLOCATIONWAREHOUSEZONECODE']."-".$rowdb21RBU['WAREHOUSELOCATIONCODE']; ?></td>
      <td style="text-align: center"><?php echo $rowdb22RBU['WAREHOUSELOCATIONCODE']; ?></td>
      <td style="text-align: center"><?php  echo $rowdb21RBU['CREATIONUSER']; ?></td>
      </tr>
	  				  
	<?php 
	 $no++; 
	$tMRolRBU+=$rowdb21RBU['JML'];
	$tMKGRBU +=$rowdb21RBU['KG'];
	$tKRolRBU+=$rowdb22RBU['ROL'];
	$tKKGRBU +=$rowdb22RBU['BERAT'];	
	} ?>
				  </tbody>
                  <tfoot>
		<tr>
	    <td style="text-align: center">&nbsp;</td>
	    <td style="text-align: center">&nbsp;</td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    <td style="text-align: center">&nbsp;</td>
	    <td style="text-align: center">&nbsp;</td>
	    <td style="text-align: center">&nbsp;</td>
	    <td style="text-align: right">&nbsp;</td>
	    <td style="text-align: right">&nbsp;</td>
	    <td style="text-align: center">&nbsp;</td>
	    <td style="text-align: center">&nbsp;</td>
	    <td style="text-align: center">&nbsp;</td>
	    <td style="text-align: center">&nbsp;</td>
	    <td style="text-align: right">&nbsp;</td>
	    <td colspan="3" style="text-align: right"><strong>Total</strong></td>
	    <td style="text-align: right"><strong><?php echo $tMRolRBU;?></strong></td>
	    <td style="text-align: right"><strong><?php echo $tMKGRBU;?></strong></td>
	    <td style="text-align: right">&nbsp;</td>
	    <td style="text-align: right">&nbsp;</td>
	    <td style="text-align: right">&nbsp;</td>
	    </tr>			
		</tfoot>
                </table>
              </div>
              <!-- /.card-body -->
          </div>	
		<div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Detail Laporan Add Stok Flat Knitt</h3>				 
          </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example6" width="100%" class="table table-sm table-bordered table-striped" style="font-size: 11px; text-align: center;">
                  <thead>
                  <tr>
                    <th rowspan="2" valign="middle" style="text-align: center">No</th>
                    <th rowspan="2" valign="middle" style="text-align: center">Tgl Masuk</th>
                    <th rowspan="2" valign="middle" style="text-align: center">No BON</th>
                    <th rowspan="2" valign="middle" style="text-align: center">Buyer</th>
                    <th rowspan="2" valign="middle" style="text-align: center">Customer</th>
                    <th rowspan="2" valign="middle" style="text-align: center">Prod. Order</th>
                    <th rowspan="2" valign="middle" style="text-align: center">Code</th>
                    <th rowspan="2" valign="middle" style="text-align: center">Project</th>
                    <th rowspan="2" valign="middle" style="text-align: center">Mesin Rajut</th>
                    <th colspan="2" valign="middle" style="text-align: center">Greige</th>
                    <th colspan="2" valign="middle" style="text-align: center">Kain Jadi</th>
                    <th rowspan="2" valign="middle" style="text-align: center">Jenis Kain</th>
                    <th rowspan="2" valign="middle" style="text-align: center">Lot</th>
                    <th colspan="4" valign="middle" style="text-align: center">Jenis Benang</th>
                    <th rowspan="2" valign="middle" style="text-align: center">PCS</th>
                    <th rowspan="2" valign="middle" style="text-align: center">Qty</th>
                    <th rowspan="2" valign="middle" style="text-align: center">Berat/Kg</th>
                    <th rowspan="2" valign="middle" style="text-align: center">Block</th>
                    <th rowspan="2" valign="middle" style="text-align: center">Balance</th>
                    <th rowspan="2" valign="middle" style="text-align: center">User</th>
                  </tr>
                  <tr>
                    <th valign="middle" style="text-align: center">Lebar</th>
                    <th valign="middle" style="text-align: center">Gramasi</th>
                    <th valign="middle" style="text-align: center">Lebar</th>
                    <th valign="middle" style="text-align: center">Gramasi</th>
                    <th valign="middle" style="text-align: center">1</th>
                    <th valign="middle" style="text-align: center">2</th>
                    <th valign="middle" style="text-align: center">3</th>
                    <th valign="middle" style="text-align: center">4</th>
                    </tr>
                  </thead>
                  <tbody>
				  <?php
	 
$no=1;   
$c=0;
					  
	$sqlDB21A = " SELECT s.PROJECTCODE,f.SUMMARIZEDDESCRIPTION,
s.TRANSACTIONDATE,s.DECOSUBCODE01,s.DECOSUBCODE02,s.DECOSUBCODE03,
s.DECOSUBCODE04,s.WHSLOCATIONWAREHOUSEZONECODE,s.WAREHOUSELOCATIONCODE,
s.LOTCODE,SUM(s.BASEPRIMARYQUANTITY) AS KG,SUM(s.BASESECONDARYQUANTITY) AS PCS, COUNT(s.ITEMELEMENTCODE) AS JML,
s.CREATIONUSER,a1.VALUESTRING AS NOMESIN FROM STOCKTRANSACTION s 
LEFT OUTER JOIN ADSTORAGE a ON a.UNIQUEID = s.ABSUNIQUEID AND a.NAMENAME = 'StatusFlatKnitt'
LEFT OUTER JOIN PRODUCTIONDEMAND p ON p.CODE = s.LOTCODE
LEFT OUTER JOIN ADSTORAGE a1 ON a1.UNIQUEID = p.ABSUNIQUEID AND a1.NAMENAME = 'MachineNo'
LEFT OUTER JOIN FULLITEMKEYDECODER f ON s.FULLITEMIDENTIFIER = f.IDENTIFIER
WHERE s.TRANSACTIONDATE BETWEEN '$Awal' AND '$Akhir' AND s.ITEMTYPECODE='FKG' AND 
s.LOGICALWAREHOUSECODE ='M021' AND s.TEMPLATECODE = 'OPN' AND a.VALUESTRING =  '1'
GROUP BY s.PROJECTCODE,
s.TRANSACTIONDATE,s.DECOSUBCODE01,s.DECOSUBCODE02,
s.DECOSUBCODE03, s.DECOSUBCODE04,
s.WHSLOCATIONWAREHOUSEZONECODE,
s.WAREHOUSELOCATIONCODE, s.LOTCODE, f.SUMMARIZEDDESCRIPTION, s.CREATIONUSER,a1.VALUESTRING";
	$stmt1A   = db2_exec($conn1,$sqlDB21A, array('cursor'=>DB2_SCROLLABLE));
	//}				  
    while($rowdb21A = db2_fetch_assoc($stmt1A)){ 
$itemcA=trim($rowdb21A['DECOSUBCODE02'])."".trim($rowdb21A['DECOSUBCODE03'])." ".trim($rowdb21A['DECOSUBCODE04']);
		
$sqlDB22A1 = " SELECT SALESORDER.CODE, SALESORDER.EXTERNALREFERENCE, SALESORDER.ORDPRNCUSTOMERSUPPLIERCODE,
		ITXVIEWAKJ.LEGALNAME1, ITXVIEWAKJ.ORDERPARTNERBRANDCODE, ITXVIEWAKJ.LONGDESCRIPTION
		FROM DB2ADMIN.SALESORDER SALESORDER LEFT OUTER JOIN DB2ADMIN.ITXVIEWAKJ 
       	ITXVIEWAKJ ON SALESORDER.CODE=ITXVIEWAKJ.CODE
		WHERE SALESORDER.CODE='".trim($rowdb21A['PROJECTCODE'])."' ";
$stmt2A1   = db2_exec($conn1,$sqlDB22A1, array('cursor'=>DB2_SCROLLABLE));
$rowdb22A1 = db2_fetch_assoc($stmt2A1);
		
$sqlDB22A = " SELECT LISTAGG(DISTINCT  TRIM(BALANCE.WAREHOUSELOCATIONCODE),', ') AS WAREHOUSELOCATIONCODE, COUNT(BALANCE.BASEPRIMARYQUANTITYUNIT) AS ROL,SUM(BALANCE.BASEPRIMARYQUANTITYUNIT) AS BERAT,BALANCE.LOTCODE  
		FROM (
		SELECT 
s.ITEMELEMENTCODE  FROM STOCKTRANSACTION s 
LEFT OUTER JOIN ADSTORAGE a ON a.UNIQUEID = s.ABSUNIQUEID AND a.NAMENAME = 'StatusFlatKnitt'
WHERE s.PROJECTCODE='".$rowdb21A['PROJECTCODE']."' AND s.ITEMTYPECODE='FKG' AND 
s.DECOSUBCODE02='".$rowdb21A['DECOSUBCODE02']."' AND s.DECOSUBCODE03='".$rowdb21A['DECOSUBCODE03']."' AND 
s.DECOSUBCODE04='".$rowdb21A['DECOSUBCODE04']."' AND s.LOGICALWAREHOUSECODE ='M021' AND
s.LOTCODE='$rowdb21A[LOTCODE]' AND 
s.TEMPLATECODE = 'OPN' AND a.VALUESTRING =  '1'
GROUP BY 
s.ITEMELEMENTCODE
		) STOCKTRANSACTION LEFT OUTER JOIN 
		DB2ADMIN.BALANCE BALANCE ON BALANCE.ELEMENTSCODE =STOCKTRANSACTION.ITEMELEMENTCODE  
		GROUP BY BALANCE.LOTCODE ";					  
		$stmt2A   = db2_exec($conn1,$sqlDB22A, array('cursor'=>DB2_SCROLLABLE));	
		$rowdb22A = db2_fetch_assoc($stmt2A);
$sqlDB23A = " SELECT p.SUBCODE01,p.SUBCODE02,p.SUBCODE03,p.SUBCODE04,p.SUBCODE05,p.SUBCODE06,p.SUBCODE07, p.LONGDESCRIPTION FROM (
SELECT p2.ITEMTYPEAFICODE,p2.SUBCODE01,p2.SUBCODE02,p2.SUBCODE03,p2.SUBCODE04,
p2.SUBCODE05,p2.SUBCODE06,p2.SUBCODE07  FROM PRODUCTIONDEMAND p 
LEFT OUTER JOIN PRODUCTIONRESERVATION p2 ON p.CODE =p2.ORDERCODE 
WHERE p.ITEMTYPEAFICODE ='KGF' AND p.SUBCODE01='".trim($rowdb21A['DECOSUBCODE01'])."' 
AND p.SUBCODE02 ='".trim($rowdb21A['DECOSUBCODE02'])."' AND p.SUBCODE03 ='".trim($rowdb21A['DECOSUBCODE03'])."' AND
p.SUBCODE04='".trim($rowdb21A['DECOSUBCODE04'])."' AND (p.PROJECTCODE ='".trim($rowdb21A['PROJECTCODE'])."' OR p.ORIGDLVSALORDLINESALORDERCODE  ='".trim($rowdb21A['PROJECTCODE'])."')
) a LEFT OUTER JOIN PRODUCT p ON
p.ITEMTYPECODE ='GYR' AND
p.SUBCODE01= a.SUBCODE01 AND p.SUBCODE02= a.SUBCODE02 AND 
p.SUBCODE03= a.SUBCODE03 AND p.SUBCODE04= a.SUBCODE04 AND 
p.SUBCODE05= a.SUBCODE05 AND p.SUBCODE06= a.SUBCODE06 AND
p.SUBCODE07= a.SUBCODE07 
GROUP BY 
p.SUBCODE01,p.SUBCODE02, 
p.SUBCODE03,p.SUBCODE04,
p.SUBCODE05,p.SUBCODE06,
p.SUBCODE07,p.LONGDESCRIPTION ";
$stmt3A   = db2_exec($conn1,$sqlDB23A, array('cursor'=>DB2_SCROLLABLE));
$aiA=0;
$aA[0]="";
$aA[1]="";
$aA[2]="";
$aA[3]="";		
while($rowdb23A = db2_fetch_assoc($stmt3A)){
	$aA[$aiA]=$rowdb23A['LONGDESCRIPTION'];
	$aiA++;
}		
/*$sqlDB26R = " SELECT e.WIDTHGROSS AS LEBAR1,a.VALUEDECIMAL AS GSM1, e.DEMANDCODE  FROM ELEMENTSINSPECTION e 
LEFT OUTER JOIN ADSTORAGE a ON a.UNIQUEID =e.ABSUNIQUEID AND a.NAMENAME ='GSM'
WHERE e.ELEMENTITEMTYPECODE='KGF' AND e.DEMANDCODE='$rowdb21R[LOTCODE]'
GROUP BY e.WIDTHGROSS,a.VALUEDECIMAL,e.DEMANDCODE ";
$stmt6R   = db2_exec($conn1,$sqlDB26R, array('cursor'=>DB2_SCROLLABLE));
$rowdb26R = db2_fetch_assoc($stmt6R);*/

$sqlDB28A = " SELECT a.VALUEDECIMAL  FROM PRODUCT p 
LEFT OUTER JOIN ADSTORAGE a  ON a.UNIQUEID = p.ABSUNIQUEID 
WHERE p.SUBCODE01='".trim($rowdb21A['DECOSUBCODE01'])."' AND
p.SUBCODE02='".trim($rowdb21A['DECOSUBCODE02'])."' AND
p.SUBCODE03='".trim($rowdb21A['DECOSUBCODE03'])."' AND
p.SUBCODE04='".trim($rowdb21A['DECOSUBCODE04'])."' AND
a.NAMENAME ='Width' AND
p.ITEMTYPECODE ='FKF'  ";
$stmt8A   = db2_exec($conn1,$sqlDB28A, array('cursor'=>DB2_SCROLLABLE));
$rowdb28A = db2_fetch_assoc($stmt8A);	
$sqlDB29A = " SELECT a.VALUEDECIMAL  FROM PRODUCT p 
LEFT OUTER JOIN ADSTORAGE a  ON a.UNIQUEID = p.ABSUNIQUEID 
WHERE p.SUBCODE01='".trim($rowdb21A['DECOSUBCODE01'])."' AND
p.SUBCODE02='".trim($rowdb21A['DECOSUBCODE02'])."' AND
p.SUBCODE03='".trim($rowdb21A['DECOSUBCODE03'])."' AND
p.SUBCODE04='".trim($rowdb21A['DECOSUBCODE04'])."' AND
a.NAMENAME ='GSM' AND
p.ITEMTYPECODE ='FKF'  ";
$stmt9A   = db2_exec($conn1,$sqlDB29A, array('cursor'=>DB2_SCROLLABLE));
$rowdb29A = db2_fetch_assoc($stmt9A);		
if($rowdb22A1['LEGALNAME1']==""){$langgananA="";}else{$langgananA=$rowdb22A1['LEGALNAME1'];}
if($rowdb22A1['ORDERPARTNERBRANDCODE']==""){$buyerA="";}else{$buyerA=$rowdb22A1['ORDERPARTNERBRANDCODE'];}		
?>
	  <tr>
	  <td style="text-align: center"><?php echo $no;?></td>
	  <td style="text-align: center"><?php echo $rowdb21A['TRANSACTIONDATE']; ?></td>
	  <td style="text-align: center">&nbsp;</td>
	  <td style="text-align: left"><?php echo $buyerA; ?></td>
	  <td style="text-align: left"><?php echo $langgananA; ?></td>
	  <td style="text-align: center">&nbsp;</td>
      <td style="text-align: center"><?php echo $itemcA; ?></td>
      <td style="text-align: center"><?php echo $rowdb21A['PROJECTCODE']; ?></td>
      <td style="text-align: center"><?php echo $rowdb21A['NOMESIN']; ?></td> 
      <td style="text-align: center"><?php //echo round($rowdb26R['LEBAR1']); ?></td>
      <td style="text-align: center"><?php //echo round($rowdb26R['GSM1']); ?></td>
      <td style="text-align: center"><?php echo round($rowdb28A['VALUEDECIMAL']); ?></td>
      <td style="text-align: center"><?php echo round($rowdb29A['VALUEDECIMAL']); ?></td>
      <td style="text-align: left"><?php echo $rowdb21A['SUMMARIZEDDESCRIPTION']; ?></td>
      <td style="text-align: center"><?php echo $rowdb21A['LOTCODE']; ?></td>
      <td style="text-align: left"><?php echo $aA[0]; ?></td>
      <td style="text-align: left"><?php echo $aA[1]; ?></td>
      <td style="text-align: left"><?php echo $aA[2]; ?></td>
      <td style="text-align: left"><?php echo $aA[3]; ?></td>
      <td style="text-align: right"><?php echo $rowdb21A['PCS']; ?></td>
      <td style="text-align: right"><?php echo $rowdb21A['JML']; ?></td>
      <td style="text-align: right"><?php echo $rowdb21A['KG']; ?></td>
      <td style="text-align: center"><?php echo $rowdb21A['WHSLOCATIONWAREHOUSEZONECODE']."-".$rowdb21A['WAREHOUSELOCATIONCODE']; ?></td>
      <td style="text-align: center"><?php echo $rowdb22A['WAREHOUSELOCATIONCODE']; ?></td>
      <td style="text-align: center"><?php  echo $rowdb21A['CREATIONUSER']; ?></td>
      </tr>
	  				  
	<?php 
	 $no++; 
	$tMRolA+=$rowdb21A['JML'];
	$tMPSCA+=$rowdb21A['PCS'];
	$tMKGA +=$rowdb21A['KG'];
	$tKRolA+=$rowdb22A['ROL'];
	$tKKGA +=$rowdb22A['BERAT'];	
	} ?>
				  </tbody>
                  <tfoot>
		<tr>
	    <td style="text-align: center">&nbsp;</td>
	    <td style="text-align: center">&nbsp;</td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    <td style="text-align: center">&nbsp;</td>
	    <td style="text-align: center">&nbsp;</td>
	    <td style="text-align: right">&nbsp;</td>
	    <td style="text-align: right">&nbsp;</td>
	    <td style="text-align: center">&nbsp;</td>
	    <td style="text-align: center">&nbsp;</td>
	    <td style="text-align: center">&nbsp;</td>
	    <td style="text-align: center">&nbsp;</td>
	    <td style="text-align: right">&nbsp;</td>
	    <td colspan="3" style="text-align: right"><strong>Total</strong></td>
	    <td style="text-align: right"><strong><?php echo $tMPCSA;?></strong></td>
	    <td style="text-align: right"><strong><?php echo $tMRolA;?></strong></td>
	    <td style="text-align: right"><strong><?php echo $tMKGA;?></strong></td>
	    <td style="text-align: right">&nbsp;</td>
	    <td style="text-align: right">&nbsp;</td>
	    <td style="text-align: right">&nbsp;</td>
	    </tr>			
		</tfoot>
                </table>
              </div>
              <!-- /.card-body -->
          </div>
		<div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Detail Laporan Add Stok Flat Knitt Maklun</h3>				 
          </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example7" width="100%" class="table table-sm table-bordered table-striped" style="font-size: 11px; text-align: center;">
                  <thead>
                  <tr>
                    <th rowspan="2" valign="middle" style="text-align: center">No</th>
                    <th rowspan="2" valign="middle" style="text-align: center">Tgl Masuk</th>
                    <th rowspan="2" valign="middle" style="text-align: center">No BON</th>
                    <th rowspan="2" valign="middle" style="text-align: center">Buyer</th>
                    <th rowspan="2" valign="middle" style="text-align: center">Customer</th>
                    <th rowspan="2" valign="middle" style="text-align: center">Prod. Order</th>
                    <th rowspan="2" valign="middle" style="text-align: center">Code</th>
                    <th rowspan="2" valign="middle" style="text-align: center">Project</th>
                    <th rowspan="2" valign="middle" style="text-align: center">Mesin Rajut</th>
                    <th colspan="2" valign="middle" style="text-align: center">Greige</th>
                    <th colspan="2" valign="middle" style="text-align: center">Kain Jadi</th>
                    <th rowspan="2" valign="middle" style="text-align: center">Jenis Kain</th>
                    <th rowspan="2" valign="middle" style="text-align: center">Lot</th>
                    <th colspan="4" valign="middle" style="text-align: center">Jenis Benang</th>
                    <th rowspan="2" valign="middle" style="text-align: center">PCS</th>
                    <th rowspan="2" valign="middle" style="text-align: center">Qty</th>
                    <th rowspan="2" valign="middle" style="text-align: center">Berat/Kg</th>
                    <th rowspan="2" valign="middle" style="text-align: center">Block</th>
                    <th rowspan="2" valign="middle" style="text-align: center">Balance</th>
                    <th rowspan="2" valign="middle" style="text-align: center">User</th>
                  </tr>
                  <tr>
                    <th valign="middle" style="text-align: center">Lebar</th>
                    <th valign="middle" style="text-align: center">Gramasi</th>
                    <th valign="middle" style="text-align: center">Lebar</th>
                    <th valign="middle" style="text-align: center">Gramasi</th>
                    <th valign="middle" style="text-align: center">1</th>
                    <th valign="middle" style="text-align: center">2</th>
                    <th valign="middle" style="text-align: center">3</th>
                    <th valign="middle" style="text-align: center">4</th>
                    </tr>
                  </thead>
                  <tbody>
				  <?php
	 
$no=1;   
$c=0;
					  
	$sqlDB21AN = "  SELECT p.PROJECTCODE, p.ORIGDLVSALORDLINESALORDERCODE,s.PRODUCTIONORDERCODE,s.ORDERCODE,f.SUMMARIZEDDESCRIPTION,
s.TRANSACTIONDATE,s.DECOSUBCODE01,s.DECOSUBCODE02,s.DECOSUBCODE03,
s.DECOSUBCODE04,s.WHSLOCATIONWAREHOUSEZONECODE,s.WAREHOUSELOCATIONCODE,
s.LOTCODE,SUM(s.BASEPRIMARYQUANTITY) AS KG, SUM(s.BASESECONDARYQUANTITY) AS PCS, COUNT(s.ITEMELEMENTCODE) AS JML,
s.CREATIONUSER FROM STOCKTRANSACTION s 
LEFT OUTER JOIN PRODUCTIONDEMAND p ON p.CODE = s.ORDERCODE 
LEFT OUTER JOIN FULLITEMKEYDECODER f ON s.FULLITEMIDENTIFIER = f.IDENTIFIER
WHERE s.TRANSACTIONDATE BETWEEN '$Awal' AND '$Akhir' AND s.ITEMTYPECODE='FKG' AND 
s.LOGICALWAREHOUSECODE ='M021' AND s.TEMPLATECODE = '110' 
GROUP BY p.PROJECTCODE,p.ORIGDLVSALORDLINESALORDERCODE,s.PRODUCTIONORDERCODE,s.ORDERCODE,
s.TRANSACTIONDATE,s.DECOSUBCODE01,s.DECOSUBCODE02,
s.DECOSUBCODE03, s.DECOSUBCODE04,
s.WHSLOCATIONWAREHOUSEZONECODE,
s.WAREHOUSELOCATIONCODE, s.LOTCODE, f.SUMMARIZEDDESCRIPTION, s.CREATIONUSER";
	$stmt1AN   = db2_exec($conn1,$sqlDB21AN, array('cursor'=>DB2_SCROLLABLE));
	//}				  
    while($rowdb21AN = db2_fetch_assoc($stmt1AN)){ 
$itemcAN=trim($rowdb21AN['DECOSUBCODE02'])."".trim($rowdb21AN['DECOSUBCODE03'])." ".trim($rowdb21AN['DECOSUBCODE04']);
if($rowdb21AN['PROJECTCODE']!=""){$proj=$rowdb21AN['PROJECTCODE'];}else{$proj=$rowdb21AN['ORIGDLVSALORDLINESALORDERCODE'];}		
		
$sqlDB22A1N = " SELECT SALESORDER.CODE, SALESORDER.EXTERNALREFERENCE, SALESORDER.ORDPRNCUSTOMERSUPPLIERCODE,
		ITXVIEWAKJ.LEGALNAME1, ITXVIEWAKJ.ORDERPARTNERBRANDCODE, ITXVIEWAKJ.LONGDESCRIPTION
		FROM DB2ADMIN.SALESORDER SALESORDER LEFT OUTER JOIN DB2ADMIN.ITXVIEWAKJ 
       	ITXVIEWAKJ ON SALESORDER.CODE=ITXVIEWAKJ.CODE
		WHERE SALESORDER.CODE='".trim($proj)."' ";
$stmt2A1N   = db2_exec($conn1,$sqlDB22A1N, array('cursor'=>DB2_SCROLLABLE));
$rowdb22A1N = db2_fetch_assoc($stmt2A1N);
		
$sqlDB22AN = " SELECT LISTAGG(DISTINCT  TRIM(BALANCE.WAREHOUSELOCATIONCODE),', ') AS WAREHOUSELOCATIONCODE, COUNT(BALANCE.BASEPRIMARYQUANTITYUNIT) AS ROL,SUM(BALANCE.BASEPRIMARYQUANTITYUNIT) AS BERAT,BALANCE.LOTCODE  
		FROM (
		SELECT 
s.ITEMELEMENTCODE  FROM STOCKTRANSACTION s 
LEFT OUTER JOIN ADSTORAGE a ON a.UNIQUEID = s.ABSUNIQUEID AND a.NAMENAME = 'StatusFlatKnitt'
WHERE s.PROJECTCODE='".$proj."' AND s.ITEMTYPECODE='FKG' AND 
s.DECOSUBCODE02='".$rowdb21AN['DECOSUBCODE02']."' AND s.DECOSUBCODE03='".$rowdb21AN['DECOSUBCODE03']."' AND 
s.DECOSUBCODE04='".$rowdb21AN['DECOSUBCODE04']."' AND s.LOGICALWAREHOUSECODE ='M021' AND
s.LOTCODE='$rowdb21AN[LOTCODE]' AND 
s.TEMPLATECODE = 'OPN' AND a.VALUESTRING =  '1'
GROUP BY 
s.ITEMELEMENTCODE
		) STOCKTRANSACTION LEFT OUTER JOIN 
		DB2ADMIN.BALANCE BALANCE ON BALANCE.ELEMENTSCODE =STOCKTRANSACTION.ITEMELEMENTCODE  
		GROUP BY BALANCE.LOTCODE ";					  
		$stmt2AN   = db2_exec($conn1,$sqlDB22AN, array('cursor'=>DB2_SCROLLABLE));	
		$rowdb22AN = db2_fetch_assoc($stmt2AN);
$sqlDB23AN = " SELECT p.SUBCODE01,p.SUBCODE02,p.SUBCODE03,p.SUBCODE04,p.SUBCODE05,p.SUBCODE06,p.SUBCODE07, p.LONGDESCRIPTION FROM (
SELECT p2.ITEMTYPEAFICODE,p2.SUBCODE01,p2.SUBCODE02,p2.SUBCODE03,p2.SUBCODE04,
p2.SUBCODE05,p2.SUBCODE06,p2.SUBCODE07  FROM PRODUCTIONDEMAND p 
LEFT OUTER JOIN PRODUCTIONRESERVATION p2 ON p.CODE =p2.ORDERCODE 
WHERE p.ITEMTYPEAFICODE ='KGF' AND p.SUBCODE01='".trim($rowdb21AN['DECOSUBCODE01'])."' 
AND p.SUBCODE02 ='".trim($rowdb21AN['DECOSUBCODE02'])."' AND p.SUBCODE03 ='".trim($rowdb21AN['DECOSUBCODE03'])."' AND
p.SUBCODE04='".trim($rowdb21AN['DECOSUBCODE04'])."' AND (p.PROJECTCODE ='".trim($proj)."' OR p.ORIGDLVSALORDLINESALORDERCODE  ='".trim($proj)."')
) a LEFT OUTER JOIN PRODUCT p ON
p.ITEMTYPECODE ='GYR' AND
p.SUBCODE01= a.SUBCODE01 AND p.SUBCODE02= a.SUBCODE02 AND 
p.SUBCODE03= a.SUBCODE03 AND p.SUBCODE04= a.SUBCODE04 AND 
p.SUBCODE05= a.SUBCODE05 AND p.SUBCODE06= a.SUBCODE06 AND
p.SUBCODE07= a.SUBCODE07 
GROUP BY 
p.SUBCODE01,p.SUBCODE02, 
p.SUBCODE03,p.SUBCODE04,
p.SUBCODE05,p.SUBCODE06,
p.SUBCODE07,p.LONGDESCRIPTION ";
$stmt3AN   = db2_exec($conn1,$sqlDB23AN, array('cursor'=>DB2_SCROLLABLE));
$aiAN=0;
$aAN[0]="";
$aAN[1]="";
$aAN[2]="";
$aAN[3]="";		
while($rowdb23AN = db2_fetch_assoc($stmt3AN)){
	$aAN[$aiAN]=$rowdb23AN['LONGDESCRIPTION'];
	$aiAN++;
}		
/*$sqlDB26R = " SELECT e.WIDTHGROSS AS LEBAR1,a.VALUEDECIMAL AS GSM1, e.DEMANDCODE  FROM ELEMENTSINSPECTION e 
LEFT OUTER JOIN ADSTORAGE a ON a.UNIQUEID =e.ABSUNIQUEID AND a.NAMENAME ='GSM'
WHERE e.ELEMENTITEMTYPECODE='KGF' AND e.DEMANDCODE='$rowdb21R[LOTCODE]'
GROUP BY e.WIDTHGROSS,a.VALUEDECIMAL,e.DEMANDCODE ";
$stmt6R   = db2_exec($conn1,$sqlDB26R, array('cursor'=>DB2_SCROLLABLE));
$rowdb26R = db2_fetch_assoc($stmt6R);*/

$sqlDB28AN = " SELECT a.VALUEDECIMAL  FROM PRODUCT p 
LEFT OUTER JOIN ADSTORAGE a  ON a.UNIQUEID = p.ABSUNIQUEID 
WHERE p.SUBCODE01='".trim($rowdb21AN['DECOSUBCODE01'])."' AND
p.SUBCODE02='".trim($rowdb21AN['DECOSUBCODE02'])."' AND
p.SUBCODE03='".trim($rowdb21AN['DECOSUBCODE03'])."' AND
p.SUBCODE04='".trim($rowdb21AN['DECOSUBCODE04'])."' AND
a.NAMENAME ='Width' AND
p.ITEMTYPECODE ='FKF'  ";
$stmt8AN   = db2_exec($conn1,$sqlDB28AN, array('cursor'=>DB2_SCROLLABLE));
$rowdb28AN = db2_fetch_assoc($stmt8AN);	
$sqlDB29AN = " SELECT a.VALUEDECIMAL  FROM PRODUCT p 
LEFT OUTER JOIN ADSTORAGE a  ON a.UNIQUEID = p.ABSUNIQUEID 
WHERE p.SUBCODE01='".trim($rowdb21AN['DECOSUBCODE01'])."' AND
p.SUBCODE02='".trim($rowdb21AN['DECOSUBCODE02'])."' AND
p.SUBCODE03='".trim($rowdb21AN['DECOSUBCODE03'])."' AND
p.SUBCODE04='".trim($rowdb21AN['DECOSUBCODE04'])."' AND
a.NAMENAME ='GSM' AND
p.ITEMTYPECODE ='FKF'  ";
$stmt9AN   = db2_exec($conn1,$sqlDB29AN, array('cursor'=>DB2_SCROLLABLE));
$rowdb29AN = db2_fetch_assoc($stmt9AN);		
if($rowdb22A1N['LEGALNAME1']==""){$langgananAN="";}else{$langgananAN=$rowdb22A1N['LEGALNAME1'];}
if($rowdb22A1N['ORDERPARTNERBRANDCODE']==""){$buyerAN="";}else{$buyerAN=$rowdb22A1N['ORDERPARTNERBRANDCODE'];}		
?>
	  <tr>
	  <td style="text-align: center"><?php echo $no;?></td>
	  <td style="text-align: center"><?php echo $rowdb21AN['TRANSACTIONDATE']; ?></td>
	  <td style="text-align: center">&nbsp;</td>
	  <td style="text-align: left"><?php echo $buyerAN; ?></td>
	  <td style="text-align: left"><?php echo $langgananAN; ?></td>
	  <td style="text-align: center"><?php echo $rowdb21AN['PRODUCTIONORDERCODE']; ?></td>
      <td style="text-align: center"><?php echo $itemcAN; ?></td>
      <td style="text-align: center"><?php echo $proj; ?></td>
      <td style="text-align: center"><?php echo "maklun"; ?></td> 
      <td style="text-align: center"><?php //echo round($rowdb26R['LEBAR1']); ?></td>
      <td style="text-align: center"><?php //echo round($rowdb26R['GSM1']); ?></td>
      <td style="text-align: center"><?php echo round($rowdb28AN['VALUEDECIMAL']); ?></td>
      <td style="text-align: center"><?php echo round($rowdb29AN['VALUEDECIMAL']); ?></td>
      <td style="text-align: left"><?php echo $rowdb21AN['SUMMARIZEDDESCRIPTION']; ?></td>
      <td style="text-align: center"><?php echo $rowdb21AN['LOTCODE']; ?></td>
      <td style="text-align: left"><?php echo $aAN[0]; ?></td>
      <td style="text-align: left"><?php echo $aAN[1]; ?></td>
      <td style="text-align: left"><?php echo $aAN[2]; ?></td>
      <td style="text-align: left"><?php echo $aAN[3]; ?></td>
      <td style="text-align: right"><?php echo $rowdb21AN['PCS']; ?></td>
      <td style="text-align: right"><?php echo $rowdb21AN['JML']; ?></td>
      <td style="text-align: right"><?php echo $rowdb21AN['KG']; ?></td>
      <td style="text-align: center"><?php echo $rowdb21AN['WHSLOCATIONWAREHOUSEZONECODE']."-".$rowdb21AN['WAREHOUSELOCATIONCODE']; ?></td>
      <td style="text-align: center"><?php echo $rowdb22AN['WAREHOUSELOCATIONCODE']; ?></td>
      <td style="text-align: center"><?php  echo $rowdb21AN['CREATIONUSER']; ?></td>
      </tr>
	  				  
	<?php 
	 $no++; 
	$tMRolAN+=$rowdb21AN['JML'];
	$tMPCSAN+=$rowdb21AN['PCS'];
	$tMKGAN +=$rowdb21AN['KG'];
	$tKRolAN+=$rowdb22AN['ROL'];
	$tKKGAN +=$rowdb22AN['BERAT'];	
	} ?>
				  </tbody>
                  <tfoot>
		<tr>
	    <td style="text-align: center">&nbsp;</td>
	    <td style="text-align: center">&nbsp;</td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    <td style="text-align: center">&nbsp;</td>
	    <td style="text-align: center">&nbsp;</td>
	    <td style="text-align: right">&nbsp;</td>
	    <td style="text-align: right">&nbsp;</td>
	    <td style="text-align: center">&nbsp;</td>
	    <td style="text-align: center">&nbsp;</td>
	    <td style="text-align: center">&nbsp;</td>
	    <td style="text-align: center">&nbsp;</td>
	    <td style="text-align: right">&nbsp;</td>
	    <td colspan="3" style="text-align: right"><strong>Total</strong></td>
	    <td style="text-align: right"><?php echo $tMPCSAN ;?></td>
	    <td style="text-align: right"><strong><?php echo $tMRolAN;?></strong></td>
	    <td style="text-align: right"><strong><?php echo $tMKGAN;?></strong></td>
	    <td style="text-align: right">&nbsp;</td>
	    <td style="text-align: right">&nbsp;</td>
	    <td style="text-align: right">&nbsp;</td>
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
<?php 
if($_POST['mutasikain']=="MutasiKain"){
	
function mutasiurut(){
include "koneksi.php";		
$format = "20".date("ymd");
$sql=mysqli_query($con,"SELECT no_mutasi FROM tbl_mutasi_kain WHERE substr(no_mutasi,1,8) like '%".$format."%' ORDER BY no_mutasi DESC LIMIT 1 ") or die (mysql_error());
$d=mysqli_num_rows($sql);
if($d>0){
$r=mysqli_fetch_array($sql);
$d=$r['no_mutasi'];
$str=substr($d,8,2);
$Urut = (int)$str;
}else{
$Urut = 0;
}
$Urut = $Urut + 1;
$Nol="";
$nilai=2-strlen($Urut);
for ($i=1;$i<=$nilai;$i++){
$Nol= $Nol."0";
}
$tidbr =$format.$Nol.$Urut;
return $tidbr;
}
$nomid=mutasiurut();	

$sql1=mysqli_query($con,"SELECT *,count(b.transid) as jmlrol,a.transid as kdtrans FROM tbl_mutasi_kain a 
LEFT JOIN tbl_prodemand b ON a.transid=b.transid 
WHERE isnull(a.no_mutasi) AND date_format(a.tgl_buat ,'%Y-%m-%d')='$Awal' AND a.gshift='$Gshift' 
GROUP BY a.transid");
$n1=1;
$noceklist1=1;	
while($r1=mysqli_fetch_array($sql1)){	
	if($_POST['cek'][$n1]!='') 
		{
		$transid1 = $_POST['cek'][$n1];
		mysqli_query($con,"UPDATE tbl_mutasi_kain SET
		no_mutasi='$nomid',
		tgl_mutasi=now()
		WHERE transid='$transid1'
		");
		}else{
			$noceklist1++;
	}
	$n1++;
	}
if($noceklist1==$n1){
	echo "<script>
  	$(function() {
    const Toast = Swal.mixin({
      toast: false,
      position: 'middle',
      showConfirmButton: false,
      timer: 2000
    });
	Toast.fire({
        icon: 'info',
        title: 'Data tidak ada yang di Ceklist',
		
      })
  });
  
</script>";	
}else{	
echo "<script>
	$(function() {
    const Toast = Swal.mixin({
      toast: false,
      position: 'middle',
      showConfirmButton: true,
      timer: 6000
    });
	Toast.fire({
  title: 'Data telah di Mutasi',
  text: 'klik OK untuk Cetak Bukti Mutasi',
  icon: 'success',  
}).then((result) => {
  if (result.isConfirmed) {
    	window.open('pages/cetak/cetak_mutasi_ulang.php?mutasi=$nomid', '_blank');
  }
})
  });
	</script>";
	
/*echo "<script>
	Swal.fire({
  title: 'Data telah di Mutasi',
  text: 'klik OK untuk Cetak Bukti Mutasi',
  icon: 'success',  
}).then((result) => {
  if (result.isConfirmed) {
    	window.location='Mutasi';
  }
});
	</script>";	*/
}
}
?>