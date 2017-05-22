var app = require('express')();
var http = require('http').Server(app);
var io = require('socket.io')(http, {'transports': ['websocket', 'polling']});

app.get('/', function(req, res) {
    res.sendFile(__dirname + '/index.html');
});
var i = 0;
var clients = [];
var prefix = "id";

io.on('connection', function(socket) {
    socket.on('new user', function(id){
        var us;
         clients[prefix+id]=socket.id;
        // console.log(id);
        // console.log(clients);
    });

    socket.on('notification', function(to, from) {
        //io.emit('chat message', msg);
        //io.sockets.in('room').emit('chat message', msg);

        console.log(to, from);
        socket.broadcast.to(clients[prefix+to.id]).emit('notification', {from:from});
    });
    socket.on('notification decline', function(to, from){
        //io.emit('chat message', msg);
        //io.sockets.in('room').emit('chat message', msg);
        socket.broadcast.to(clients[prefix+to.id]).emit('notification decline', {from:from});
    });
    socket.on('notification accept', function(to, from){
        // console.log(to);
        //io.emit('chat message', msg);
        //io.sockets.in('room').emit('chat message', msg);
        socket.broadcast.to(clients[prefix+to.id]).emit('notification accept', {from:from});
    });
    socket.on('chat typing', function(to, from){

        // console.log(to);
        socket.broadcast.to(clients[prefix+to.id]).emit('chat typing', {from:from});
    });

    socket.on('end chat typing', function(to, from) {
            console.log('end typing emit');
        // console.log(to);
        socket.broadcast.to(clients[prefix+to.id]).emit('end chat typing', {from:from});
    });

    socket.on('client chat end', function(to, from){

        // console.log(to);
        socket.broadcast.to(clients[prefix+to.id]).emit('client chat end', {from:from});
    });


    socket.on('expert chat end', function(to, from){

        console.log(to);
        console.log(from);
        socket.broadcast.to(clients[prefix+to.id]).emit('expert chat end', {to:to,from:from});
    });

    socket.on('expert block', function(to, from){

        // console.log(to);
        socket.broadcast.to(clients[prefix+to.id]).emit('expert block', {from:from});
    });

    socket.on('free time end', function(to, from){

        // console.log(to);
        socket.broadcast.to(clients[prefix+to.id]).emit('free time end', {from:from});
    });

    socket.on('chat message', function(msg,msgDate, to, from){
        //io.emit('chat message', msg);
        // console.log(to);
        //io.sockets.in('room').emit('chat message', msg);
        socket.broadcast.to(clients[prefix+to.id]).emit('chat message', {msg:msg,msgDate:msgDate,from:from});
    });
    socket.on('pay_answ', function(to, from, amount){
        socket.broadcast.to(clients[prefix+to.id]).emit('pay_answ', {amount:amount,from:from});
    })
    socket.on('chat stop', function(to, from){
        socket.broadcast.to(clients[prefix+to.id]).emit('chat stop', {from:from});
    })
    socket.on('chat continue', function(to, from){
        socket.broadcast.to(clients[prefix+to.id]).emit('chat continue', {from:from});
    })
    socket.on('chat end', function(to, from, amount){
        socket.broadcast.to(clients[prefix+to.id]).emit('chat end', {amount:amount,from:from});
    })

    socket.on('send message', function(subject, msg, msgDate, to, from) {
        socket.broadcast.to(clients[prefix + to.id]).emit('send message', { subject: subject, msg: msg, msgDate: msgDate, from: from });
    });

    socket.on('disconnect', function() {
        console.log('disconect');
        // socket.broadcast.to(clients[prefix+to.id]).emit('disconnect', {from:from});
    });

});

http.listen(3000, function(){
    console.log('listening on *:3000');
});
