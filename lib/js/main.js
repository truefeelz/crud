$(document).ready(function(){
	$("#tel_fc").mask("+7 (999) 999-99-99");//маска для телефона

	$("#login_form").on('submit',function(event){  //функция клика по кнопке войти в форме авторизации
		event.preventDefault();
			$.ajax({
				url:'src/include/check_login.php',
				type:'post',
				data:$(this).serialize(),
				success:function(printdata){
					if(printdata!=''){
						$('#response').html(printdata);
					}
					else{
						window.location='index.php';
					}
				}
			});			 
		 
	 });

	 $("#reg_form").on('submit',function(event){  //функция клика по кнопке войти в форме авторизации
		event.preventDefault();
			$.ajax({
				url:'src/include/new_user.php',
				type:'post',
				data:$(this).serialize(),
				success:function(printdata){
						$('#response').html(printdata);
						$('#reg_form').trigger("reset");
	

				}
			});			 
		 
	 });

	$('.menu-ico').click(function(){ //клик по кнопке меню
		var check=$('.menu-left').position();
		if(check.left<0){
			$('.menu-left').animate({		
				left:'0px'
			},500);
			$('body').addClass('fix');
		}
		else{
			$('.menu-left').animate({		
				left:'-285px'
			},500);
			$('body').removeClass('fix');	
		}
	});

	$("#print_eq").click(function(){ //функция вывода данных таблицы для оборудования
		var page_id=0;
		load_data(page_id);
	 });

	 $("#print_fc").click(function(){ //функция вывода данных таблицы для оборудования
		var page_id=1;
		load_data(page_id);
	 });

	 $("#print_mrk").click(function(){ //функция вывода данных таблицы для оборудования
		var page_id=2;
		load_data(page_id);
	 });

	$('#search').click(function(){
		var param=$('#search_param').val();	
		var search_id=$('#search_id').val();
		var urls='';
		if(search_id >=0 && search_id<=2){
			if(param == '' ){		
				$('#response').html('<span class="danger">Все поля обязательны</span>');
				$('#search_eq').prop('disabled',false);
			
			}
			else{
				if(search_id==0){
					urls='src/include/equipment/search_eq.php';
				}
				if(search_id==1){
					urls='src/include/factory/search_fc.php';
				}
				if(search_id==2){
					urls='src/include/marks/search_mrk.php';
				}
				$.ajax({
					url:urls,
					type:'post',
					data:$('#search_form').serialize(),
					success:function(printdata){
						$('#print').html(printdata);
					}
				});
			}
	}
	else{
		$('#response').html('<span class="danger">Произошла ошибка!</span>');
		$('#search_eq').prop('disabled',false);	
	}

	});
    
	function load_data(page_id) //функция для вывода всех записей в таблице
	{
		var pageId=page_id;
		$.ajax({
			url:"src/include/fetch.php",
			method:"POST",
			data:{pageId:pageId},
			success:function(data)
			{
				$('#print').html(data);
			}
		});
	}

	function add_data(url){ //функция для добавления записей 
		var urls=url;
		$('#form_action').attr('disabled', 'disabled');
		var form_data = $('#user_form').serialize();
		$.ajax({
			url:urls,
			method:"POST",
			data:form_data,
			success:function(data)
			{
				$('#user_dialog').dialog('close');
				$('#action_alert').html(data);
				$('#action_alert').dialog('open');
				$('#form_action').attr('disabled', false);
			}
		});
	}

	function edit_data(url,id) { //функция для редактирования данных
		var urls=url;
		var action = 'fetch_single';
		$.ajax({
			url:urls,
			method:"POST",
			data:{id:id, action:action},
			dataType:"json",
			success:function(data)
			{		
				jQuery.each(data, function(i, val) {
					$("#" + i).val(val);
				   });
				$('#user_dialog').dialog('option', 'title', 'Редактирование');
				$('#action').val('update');
				$('#hidden_id').val(id);
				$('#form_action').val('Сохранить');
				$('#user_dialog').dialog('open');
			}
			});
	  }

	$("#user_dialog").dialog({ //настройка диалогового окна
		autoOpen:false,
		width:660
	});

	$('#add').click(function(){  //функция клика по кнопке добавить 
		$('#user_dialog').dialog('option', 'title', 'Добавление новой записи');
		$('#action').val('insert');
		$('#form_action').val('Добавить');
		$('#user_form')[0].reset();
		$('#form_action').attr('disabled', false);
		$("#user_dialog").dialog('open');
	});

	$('#user_form').on('submit', function(event){ //клик по кнопке добавить в модульном окне
		event.preventDefault();
		var page_id=$('#page_id').val();
		if(page_id==0){ //список оборудования
			var name=$('#name_eq').val();	   
			var markname=$('#markName').val();
			var count=$('#count').val();
			if(name == ''  || markname=='' || count=="" ){	//проверка заполнены ли поля
				$('#errors').html('<span class="danger">Все поля обязательны</span>');
			
			}
			else{
				var urls='src/include/equipment/action_eq.php'; //передаем сылку на обработчик на сервере
				add_data(urls);
			}		
		}
		if(page_id==1){ //заводы-изготовители
			var name=$('#name_fc').val();
			var city=$('#city_fc').val();
			var address=$('#address_fc').val();
			var tel=$('#tel_fc').val(); 
			if(name == '' || city == '' || address== '' || tel==''){		
				$('#errors').html('<span class="danger">Все поля обязательны</span>');			
			}
			else{
				var urls='src/include/factory/action_fc.php';
				add_data(urls);
			}
		}
		if(page_id==2){ //заводы-изготовители
			var name=$('#name_mrk').val();
			var name_fc=$('#name_factory').val();
			if(name == '' || name_fc == ''){		
				$('#errors').html('<span class="danger">Все поля обязательны</span>');			
			}
			else{
				var urls='src/include/marks/action_mrk.php';
				add_data(urls);
			}
		}	
	});

	$('#action_alert').dialog({ //настройка предупреждений
		autoOpen:false,
		title:'Оповещение'
	});

	$('#delete_confirmation').dialog({ //настройка диалогово окна с потверждением на удаление
		autoOpen:false,
		modal: true,
		buttons:{
			Ok : function(){
				var id=$(this).data('id');
				var urls = $(this).data('urls');
				var action = 'delete';

				$.ajax({
					url:urls,
					method:"POST",
					data:{id:id, action:action},
					success:function(data)
					{
						$('#delete_confirmation').dialog('close');
						$('#action_alert').html(data);
						$('#action_alert').dialog('open');
					}
				});
			},
			Cancel : function(){
				$(this).dialog('close');
			}
		}	
	});

	$('#print').on('click', '.edit', function(){ //клик на кнопку редактировать
		var id = $(this).attr('id');
		var id_table=$('#table_id').val();
		if(id_table==0){
			var urls='src/include/equipment/action_eq.php';
			}		
		if(id_table==1){
			var urls='src/include/factory/action_fc.php';
		}
		if(id_table==2){
			var urls='src/include/marks/action_mrk.php';	
		}
		edit_data(urls,id);
	
	});
	
	$(document).on('click', '.delete', function(){ //клик на кнопку удалить
		var id = $(this).attr("id");
		var id_table=$('#table_id').val();	
			if(id_table==0){
				var urls='src/include/equipment/action_eq.php';
			}
			if(id_table==1){
				var urls='src/include/factory/action_fc.php';
			}
			if(id_table==2){
				var urls='src/include/marks/action_mrk.php';
			}
		$('#delete_confirmation').data('id', id).data('urls',urls).dialog('open');

	});
		

});
	