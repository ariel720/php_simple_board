
<div class="row">
	<div class="col-lg-12">
		<div class="ibox float-e-margins">
			<div class="ibox-title">
				<h5>게시판 목록</h5>
				<div class="ibox-tools">
					<a class="close-link btn btn-white btn-xs" href="/index.php/member/create" data-toggle="tooltip" data-placement="top" title="" data-original-title="Create"><i class="fa fa-plus"></i></a>
				</div>
			</div>


			<div class="ibox-content">

				<div class="hr-line-dashed"></div>
				
					<!-- 목록 --> 
                <div class="table-responsive">		
				<table id="concertList" class="table table-striped table-hover">
					<thead>
						<tr>
							<th scope="col" class="nowr">번호</th>
							<th scope="col" class="nowr">제목</th>
							<th scope="col" class="nowr">글쓴이</th>
							<th scope="col" class="nowr">액션</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($list as $row) { ?>
						<tr class="cell" cid="<?=$row->SEQ ?>">
							<td class="nowr"><?=$row->SEQ ?></td>
							<td class="nowr"><a href="/index.php/member/view/<?=$row->SEQ?>"><?=$row->TITLE ?></a></td>
							<td class="nowr"><?=$row->WRITER ?></td>
							<td class="nowr">
								<button type="button" class="remove btn btn-white btn-sm" onclick="$.remove(this)" data-toggle="tooltip" data-placement="top" title="삭제">
			                    	<i class="fa fa-trash-o"></i>
								</button>
							</td>
						</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
</div>

<script>
	$.remove = function(div) {
		var seq = $(div).parent().parent().attr('cid');
		
		
		showConfirmBox("알림", seq+ "번 글을 삭제하시겠습니까?", function() {
			App1000.post("/index.php/member/ajax_remove", {"seq":seq}, function(response) {
				if (response.r == "ok") {
					document.location.reload();
				}
			});
		});
	}

	$.update = function(vid) {
		document.location.href = '/admin/member/update/'+ vid;
	}
	$.reviews = function(vid) {		
		document.location.href = '/admin/review/lists_member/'+ vid;
	}

	$(document).ready(function(){

	});
</script>

