var messenger={
	
	init : function(){
		this.io = require('socket.io').listen(8080);
		this.io.sockets.on('connection',this.listen);
		this.users=[];
	},
	listen : function(socket){
		socket.on('log',function(datas){
			messenger.users[datas.user]=this.id;
			socket.emit('logged',this.id);
		});
		socket.on('message',function(datas){
			messenger.io.sockets.socket(messenger.users[datas.to]).emit('message',datas);
		});
	}
}
messenger.init();