

<div class="content" id="content">

	
	<form class="form-horizontal" method="post" id="submitForm" action="/index.php/member/ajax_create">
		
			
	 	<div class="panel panel-default">
	 		<div class="panel-heading" data-toggle="collapse" href="#collapseOne" style="cursor: pointer">
 				기본 정보
	 		</div>
	 		
	 		<div id="collapseOne" class="panel-collapse collapse in">
		 		
	 			<div class="panel-body">
					
	 				<!-- 내용 -->
	 				<div class="form-group">
						<label class="control-label col-sm-2" for="username"><em style="color: red">*</em> 작성자</label>
						<div class="controls col-sm-6">

							<?= $content[0]->WRITER?>
							
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-sm-2" for="email"><em style="color: red">*</em> 제목</label>
						<div class="controls col-sm-6">
							<?= $content[0]->TITLE?>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-sm-2" for="passwd"><em style="color: red">*</em> 내용</label>
						<div class="controls col-sm-6">
							<?= $content[0]->CONTENTS?>
						</div>
					</div>
	 			</div>
	 		</div>
	 		
	 	</div>
	 		 	
	 	<div class="clearfix btnArea"></div>
	 	<div class="form-group">
	 		<button class="btn btn-white" type="button" onclick="$.back()">목록가기</button>
	 		<button class="btn btn-white" type="button" onclick="$.update(<?= $content[0]->SEQ?>)">수정</button>
		</div>
		</div>
	</form>		
</div>

<script>

$.back = function(){
	location.href = '/index.php/member/board/';
}
$.update = function(seq){
	
	location.href = '/index.php/member/update/'+seq;
}

$(document).ready(function(){
});

</script>