

<div class="content" id="content">

	
	<form class="form-horizontal" method="post" id="submitForm" action="/index.php/member/ajax_update">
		
			
	 	<div class="panel panel-default">
	 		<div class="panel-heading" data-toggle="collapse" href="#collapseOne" style="cursor: pointer">
 				기본 정보
	 		</div>
	 		
	 		<div id="collapseOne" class="panel-collapse collapse in">

	 			<div class="panel-body">
					
	 				<input type="hidden" class="form-control" name="seq" value="<?= $content[0]->SEQ?>" />

	 				<div class="form-group">
						<label class="control-label col-sm-2" for="writer"><em style="color: red">*</em> 작성자</label>
						<div class="controls col-sm-6">
							<input type="text" class="form-control" name="writer" value="<?= $content[0]->WRITER?>" />
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-sm-2" for="title"><em style="color: red">*</em> 제목</label>
						<div class="controls col-sm-6">
							<input type="text" class="form-control" name="title" value="<?= $content[0]->TITLE?>" />
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-sm-2" for="content"><em style="color: red">*</em> 내용</label>
						<div class="controls col-sm-6">
							<input type="text" class="form-control" name="content" value="<?= $content[0]->CONTENTS?>" ?>
						</div>
					</div>
	 			</div> 
	 		</div>
	 		
	 	</div>
	 		 	
	 	<div class="clearfix btnArea"></div>
	 	<div class="form-group">
	 		<button class="btn btn-white" type="button" onclick="$.back()">목록가기</button>
	 		<button class="btn btn-white" type="button" onclick="$.submit(<?= $content[0]->SEQ?>)">완료</button>
		</div>
		</div>
	</form>		
</div>

<script>

$.back = function(){
	location.href = '/index.php/member/board/';
}
$.submit = function(seq){

	App1000.postForm($('#submitForm'), function(response) {
		console.log(response);
		if (response.r == "ok") {
			alert(response.m);
			location.href = '/index.php/member/view/'+seq;
		}
	});
}

$(document).ready(function(){
});

</script>