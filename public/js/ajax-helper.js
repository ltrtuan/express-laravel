(function(){	
	$(document).ready(function(){

		$('#delete-user-btn').on('click',function(e){
			e.preventDefault();
			$('.alert-for-ajax').css("display","none");

			var _formParent = $(this).closest('form');
			var _method = _formParent.find('input[name="_method"]').val() || 'POST';
			var _url = _formParent.prop('action');
			$.ajax({
				type : _method,
				url : _url,
				data : _formParent.serialize(),
				success : function(response){					
					if(response > 0)
					{
						$('.alert-success.alert-for-ajax').fadeIn('0').delay('2000').fadeOut('500');
						_formParent.find('tr.had-checked').remove();
						setTimeout(location.reload.bind(location), 1000);
					}
					else
						$('.alert-danger.alert-for-ajax').fadeIn('0').delay('2000').fadeOut('500');
					
				},
				error : function(){
					$('.alert-danger.alert-for-ajax').fadeIn('0').delay('2000').fadeOut('500');
				}
			});
		});

		$('.check-delete-user').on('change',function(){
			$(this).parents('tr').toggleClass('had-checked');
		});

		if($('#extra-user').length > 0){
			$('#role_id').on('change',function(e){				
				$('#extra-user').toggleClass('hidden');				
			});
		}

	});
})();