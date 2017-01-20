(function(){	
	$(document).ready(function(){
		
		$('#delete-option-btn').on('click',function(e){
			e.preventDefault();
			var listIdOption = '';
			$('#form-update-child-option').find('.check-delete-option').each(function(){
				if($(this).is(':checked'))
				{
					listIdOption += $(this).val()+',';
				}
				
			});
			if(listIdOption != '')
			{
				$('#form-delete-option input[name="id_option_delete"]').val(listIdOption);
				$('#form-delete-option').submit();
			}
			
		});

		
	});
})();