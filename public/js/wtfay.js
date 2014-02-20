

$('.index a').on('click',function(e){
	e.preventDefault();
	$('input[name="name"]').focus();
	var $this=$(this);
	if($this.hasClass('on')){
		$('.users').html('');
		$this.removeClass('on');
		
	}else{
		$.ajax({
			url:$this.attr('href')
		})
		.success(function(data){
			$('.users').html(data);
			$('.index a.on').removeClass('on');
			$this.addClass('on');
		});
	}
	$('input[name="name"]').val('');
});
$('.users').on('click','a:first-of-type',function(e){
	e.preventDefault();
	$.ajax({
		url:$(this).attr('href')
	})
	.success(function(data){
		$('section + section').html(data);
	});
})
.on('click','a.fav',function(e){
	e.preventDefault();
	var $this=$(this);
	$.getJSON($this.attr('href'))
	.success(function(data){
		if(data.status==false){
			$this.removeClass('on');
		}else{
			$this.addClass('on');
		}
	});
});


$('input[name="name"]').on('keyup',function(){
	var $this=$(this);
	var $form=$this.parent('form');
	var datas={'name':$this.val()};
 	datas.filter=$('.index a.on').data('filter');
console.log(datas); 
	$.ajax({
		url:$form.attr('action'),
		method:$form.attr('method'),
		data:datas
	})
	.success(function(data){
		$('.users').html(data);
	})
});


var user=document.getElementById('user');
user.addEventListener('dragover',function(e){
	e.preventDefault();
	this.classList.add('dragover');
});
user.addEventListener('dragleave',function(e){
	e.preventDefault();
	this.classList.remove('dragover');
});
user.addEventListener('drop',function(e){
	e.preventDefault();
	var files=e.dataTransfer.files;
	var datas=new FormData();
	for(i in files){
		datas.append('file'+i,files[i]);
	}
	/*var xhr = new XMLHttpRequest();
  xhr.open('POST', 'upload/');
	xhr.onload = function () {
	  if(xhr.status === 200) {
	    console.log('ok');
	  }else{
	    console.log('error');
	  }
	}
	xhr.send(datas);*/
	$.ajax({
		url:'upload/',
		type:'POST',
		data:datas,
		processData:false,
		contentType:false
	})
	.success(function(datas){
		console.log('ok'); 
	})
	
});

var messenger={
	init : function(){
		this.socket = io.connect('http://macbook-maraboutee.local:8080');
		this.socket.emit('log',{user:1});
		this.listen();
	},
	listen : function(){
		this.socket.on('logged',function(datas){
			console.log('socket id:'+datas); 
		});
		this.socket.on('message',function(datas){
			console.log(datas); 
		});
	},
	sendMessage : function(datas){
		this.socket.emit('message',datas);
	}
}
messenger.init();
var message={from:1,to:1,message:'Salut !'};
messenger.sendMessage(message);













