
	</div>

	<!-- /BODY -->
	<footer class="footer">
	</footer>
</div>

<!-- 팝업 -->	
<div id="popup_confirm" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">알림</h4>
      </div>
      <div class="modal-body">
        <p>삭제하시겠습니까?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">취소</button>
        <button id="ok" type="button" class="btn btn-primary">확인</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script type="text/javascript">
function showConfirmBox(title, content, callbackFunc) {
	$('#popup_confirm .modal-title').text(title);
	$('#popup_confirm .modal-body p').text(content);

	$('#popup_confirm #ok').off("click");
	$('#popup_confirm #ok').on('click', function(){
		$(this).attr('disabled', 'true');
		if (callbackFunc != null) callbackFunc();
	});
	
	$('#popup_confirm').modal();
}

function showConfirmBox2(title, content, ok_txt, callbackFunc) {
	$('#popup_confirm .modal-title').text(title);
	$('#popup_confirm .modal-body p').text(content);

	$('#popup_confirm #ok').off("click");
	$('#popup_confirm #ok').html(ok_txt).on('click', function(){
		$(this).attr('disabled', 'true');
		if (callbackFunc != null) callbackFunc();
	});
	
	$('#popup_confirm').modal();
}

function sendFile(file,editor,welEditable,div) {
	data = new FormData();
  	data.append("file", file);
    $.ajax({
	    data: data,
	    type: "POST",
	    url: '/api/file/ajax_upload',
	        cache: false,
	        contentType: false,
	        processData: false,
	        success: function(json) {
	        	console.log(json);
	        	if (json.r=="ok") {
	        		
	        		var url = '<?= CDN_URL ?>/' + json.d[0];
	            	//editor.insertImage(welEditable, url);
	            	$(div).summernote('editor.insertImage', url);
	          	}
	        }
	    });
}

$(function(){
	$(".dropdown-toggle").dropdown();
 
	$('[data-toggle="tooltip"]').tooltip();
	
	$('.summernote').summernote({
		height: 300,                 // set editor height		
		minHeight: null,             // set minimum height of editor
		maxHeight: null,             // set maximum height of editor		
		focus: true,                 // set focus to editable area after initializing summernote
		onImageUpload: function(files, editor, welEditable) {
	    	sendFile(files[0],editor,welEditable,this);
	    } 
	});
	
	$('.datepicker').datepicker({
        todayBtn: "linked",
        keyboardNavigation: false,
        forceParse: false,
        calendarWeeks: true,
        autoclose: true,
		format: 'yyyy-mm-dd',
    });
    
    $('.clockpicker').clockpicker({
	    placement: 'top',
	    align: 'left',
	    autoclose: true,
	    'default': 'now'
	});
}); 
</script>

</body>
</html>