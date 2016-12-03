$(document).ready(function(){
 
 /* Порядок функций: пользовательские, плагин scrollTo, плагин fancybox, плагины UI, плагин anythingSlider*/
	/* Порядок поключения файлов в HTML: jquery, jquery-ui, jquery.scrollTo, jquery.easing, jquery.fancybox, пользовательский script*/
	
	$('.figure img').click(function() { // анимация изображений основного блока
		$(this).animate(
		{
		  height: 320,
		  width: 480
		},
		{
			duration: 1000, 
            easing: 'swing',
            queue: false
		})
		.delay(5000)
		.animate(
		{
		  height: 160,
		  width: 240
		},
		{
			duration: 1000, 
            easing: 'easeOutBounce'
        });
	});  
	
	$('.gpk').fadeOut(2);
	$('.datepicker').bind('multiclick', {times: 5}, function() { // Вызов события special() - анимация эффекта под календарем
		var delayTime;
		var $gpk = $('.gpk');
		if ($gpk.hasClass('funny')){
				var delayTime = 20000;
			}else{
				var delayTime = 5000;
			}
				
		$gpk
		.fadeIn(2000)
		.delay(delayTime)
		.animate(
			{
				marginTop: '+=200px'
			}, 1800, 'easeOutBounce')
		.animate(
			{
				marginTop: '-=245px',
				color: 'red'					
			}, 1800, 'easeOutBounce')	
		.fadeOut(1500)
	});
  
  /* Таблицы */
  
	$('#eu_shengen_members').hide(); // здесь и далее - сокрытие таблиц, к которым применяется анимация
	$('#hideTable').click(function() { // анимация таблицы ЕС
		$('#eu_shengen_members').slideToggle();
	}); // end click
 
	$('#gpo_money').hide();
	$('#hideTable').click(function() { // зарплаты ГПО
		$('#gpo_money').slideToggle();
	}); // end click

	$('#control_bel').hide();
	$('#hidePpr_bel').click(function() { // лат-бел ППР
		$('#control_bel').slideToggle();
	}); // end click

	$('#control_rus').hide();
		$('#hidePpr_rus').click(function() { // лат-рус ППР
	$('#control_rus').slideToggle();
	}); // end click

	$('#people_quant').hide();
	$('#hideTable').click(function() { // население крупных городов
		$('#people_quant').slideToggle();
	}); // end click
 
 /* end Таблицы */
 
 
	$('a[href=#]').click(function(e) { // прокрутка к началу страницы
		$.scrollTo(0, 1200);
		e.preventDefault();
	}); 
	
	$('.mainInfo h2').hide(1).slideDown(600); // анимация заголовка раздела
 
	$('.nav a').hover(function() { // форматирование панели навигации
		$(this).animate({
		  paddingLeft: '+=20px'
		}, 200);
		}, function(){
		$(this).animate({
		  paddingLeft: '-=20px'
		}, 200);
	});
  
	$('.nav a').click(function() { // Предотвращение сдвига текста ссылки вправо при событии click сразу после события hover
		$(this).css('paddingLeft', '-=20px');
	});
  
  /*** Tooltips ***/
  
	$('.tooltip').hide();
	$('.trigger').mouseover(function() { // подсказки
		var ttLeft,
		    ttTop,
			$this=$(this),
			$tip = $($this.attr('title')),
		    triggerPos = $this.offset(),
		    triggerH = $this.outerHeight(),
		    triggerW = $this.outerWidth(),
			tipW = $tip.outerWidth(),
		    tipH = $tip.outerHeight(),
		    screenW = $(window).width(),
			scrollTop = $(document).scrollTop();
		
		if (triggerPos.top - tipH - scrollTop > 0 ) {
			ttTop = triggerPos.top - tipH - 10;
		} else {
			ttTop = triggerPos.top + triggerH +10 ;			
		}
		
		var overFlowRight = (triggerPos.left + tipW) - screenW;	
		if (overFlowRight > 0) {
			ttLeft = triggerPos.left - overFlowRight - 10;	
		} else {
			ttLeft = triggerPos.left;	
		}
		
		$tip
		   .css({
			left : ttLeft ,
			top : ttTop,
			position: 'absolute'
		    })
			.fadeIn(200);
	}); // end mouseover
	
	$('.trigger').mouseout(function () {
		$('.tooltip').fadeOut(200);
	});
  
  /*** End tooltips ***/
  
	$('a.iframe').fancybox({ // fancybox с загрузкой внешних страниц  !!! применять к ссылкам с классом iframe
		'width': 750,
		'height': 400
	});
  
	$('#gallery a').fancybox({ // fancybox фотогалерей и элементов outside
		overlayColor: '#060',
		overlayOpacity: .3,
		transitionIn: 'elastic',
		transitionOut: 'elastic',
		easingIn: 'easeInSine',
		easingOut: 'easeOutSine',
		titlePosition: 'outside' ,		
		cyclic: true
	}); 
    	
	$('.datepicker').datepicker().fadeOut(1).fadeIn(2500); // виджет datepicker 
	
	$('.tabPanel').tabs(); // виджет tabs (вкладки)
	
	$('.accordion').accordion({ // виджет accordion  
		header: 'h3'
	});
      
	$('#slider').anythingSlider({ // плагин anythingSlider !требует jQuery
		hashTags: true
	}); 
		
}); // end ready


jQuery.event.special.multiclick = { // Инициализация события special() для анимации эффекта под календарем
  setup: function(data, namespaces) {
    // Do when the first event is bound
    $(this)
      .data('times', data && data.times || 3)
      .bind('click', jQuery.event.special.multiclick.handler);
  }, add: function(handler, data, namespaces) {
    // Do every time you bind another event
  }, remove: function(namespaces) {
    // Do when an event is unbound
  }, teardown: function(namespaces) {
    // Do when the last event is unbound
    $(this)
      .removeData('times')
      .unbind('click', jQuery.event.special.multiclick.handler);
  }, handler: function(event) {
    // Do your logic
    var times = $(this).data('times') || 0;
    times--;
    $(this).data('times', times);
    
    if(times <= 0) {
      event.type = 'multiclick';
      jQuery.event.handle.apply(this,arguments);
      
      $(this).unbind('multiclick');
    }
  }
}