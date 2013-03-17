!function($, window, document, _undefined)
{    
	XenForo.globalWidthToogle = 
	{
		cookieName: 'widthTgl',
		init: function($e)
		{
			var t = XenForo.globalWidthToogle, fi = 'globalFixedWidth', fl = 'globalFluidWidth', _fi = 'fixed', _fl = 'fluid', isMember = false, state;
			$target = $('.pageWidth');
			$e.addClass('show');

			if(parseInt($e.attr('data-visitor')) === 1){
				isMember = true;
				//This part shouldn't modify the display if the admin has correctly set his style properties
				switch ($e.attr('data-state')) {
					case _fl: $target.addClass(fl); break;
					case _fi: $target.addClass(fi); break;
				}		
			}
			else {
				console.info('Visitor: Check Cookie');
				t.chkCookie($e, $target,_fi,_fl,fi,fl);
			}

			$e.bind('click', function(e){

				state = $e.attr('data-state');
				
				if(state == _fl)
				{
					console.info('Fluid to Fixed');
					$e.attr('data-state', _fi).removeClass(_fl).addClass(_fi).text($e.attr('data-'+_fi));
					$target.addClass(fi).removeClass(fl).removeClass('pageWidthDefault');
					state = _fi;
				}
				else
				{
					console.info('Fixed to Fluid');
					$e.attr('data-state', _fl).removeClass(_fi).addClass(_fl).text($e.attr('data-'+_fl));
					$target.addClass(fl).removeClass(fi).removeClass('pageWidthDefault');
					state = _fl;
				}

				t.doneCallback();

				if(isMember) { 
					t.setDb($e);
				}
				else{
					t.setCookie(state);
				}

				return false;
			});
		},
		chkCookie: function($e,$target,_fi,_fl,fi,fl)
		{
			var val = $.getCookie(this.cookieName);
			
			if(!val) {
				val = $e.attr('data-state');
				console.info('Cookie was empty - default config is:' + val);
			}

			console.info('Cookie config: '+val);
			if (val == _fi){
				$e.attr('data-state', val).removeClass(_fl).addClass(_fi).text($e.attr('data-'+ val));
				$target.addClass(fi).removeClass(fl);
			}
			else if(val == _fl){
				$e.attr('data-state', val).removeClass(_fi).addClass(_fl).text($e.attr('data-'+ val));
				$target.addClass(fl).removeClass(fi);		
			}

		},
		setCookie: function(val)
		{
			var expires = 90;
			expires = new Date(new Date().getTime() + expires * 86400000);
	
			$.setCookie(this.cookieName, val, expires);
		},
		setDb: function($e)
		{
			XenForo.ajax(
					'index.php?misc/set-website-width', 
					{ 
						redirect:$e.attr('data-redirect'),
						value:$e.attr('data-value')						
					},
					this.setDb_success
			);
			
			return false;
		},
		setDb_success: function(ajaxData)
		{
			if (XenForo.hasResponseError(ajaxData))
			{
				console.error('Website Width State was not saved');
				return;
			}
			console.info('Website Width State saved');
			return;
		},
		doneCallback: function()
		{
			//TinyMCE
			$form = $('.mceLayout').closest('form');
			if($form.length > 0){
				var width= $form.width();
				$('.mceLayout').css('width',width+1+'px');
			}
			
			//TaigaChat
			 $('#taigachat_message').css('width', $('#taigachat_controls').width() - $('#taigachat_toolbar').width() - 100 + 'px');
		}
	}

	 XenForo.register('#globalWidthButton', 'XenForo.globalWidthToogle.init');
}
(jQuery, this, document);