
<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
			<div class="ibox-title">
    			<h5>log 기록(<?=$list_count?>)</h5>
   			</div>
   		
    		<div class="ibox-content">
	
				<div class="hr-line-dashed"></div>
                
				<!-- 목록 --> 
                <div class="table-responsive">		
				<table id="concertList" class="table table-striped table-hover">
					<thead>
						<tr>
							<th scope="col" class="nowr">계정</th>
							<th scope="col" class="nowr">시간</th>
							<th scope="col" class="nowr">영역</th>
							<th scope="col" class="nowr">활동</th>
						</tr>
					</thead>
					<tbody>
						<? foreach ($list as $row) { ?>
						<tr class="cell" cid="<?=$row->SEQ ?>">
							<td class="nowr"><?=$row->ADMIN_EMAIL ?></td>
							<td class="nowr"><?=$row->ACT_DT ?></td>
							<td class="nowr"><?=$row->ACT_TYPE ?></td>
							<td class="nowr"><?=$row->ACT_NAME ?></td>
						</tr>
						<? } ?>
					</tbody>
				</table>
					
				<div class="clearfix"><?php echo $pagination_links ?></div>
			</div>
			</div>
		</div>
	</div>
</div>

<script>
$(document).ready(function(){
	
});
</script>