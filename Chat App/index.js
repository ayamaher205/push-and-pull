import { createServer } from 'http';
import staticHandler from 'serve-handler';
import ws, { WebSocketServer } from 'ws';
//serve static folder
const server = createServer((req, res) => {   
    return staticHandler(req, res, { public: 'public' })
});
const wss = new WebSocketServer({ server }) 
wss.on('connection', (client) => {
    console.log('Client connected !')
    client.on('message', (msg) => {   
        console.log(`Message:${msg}`);
        broadcast(msg)
    })
})
function broadcast(msg) {      
    for (const client of wss.clients) {
        if (client.readyState === ws.OPEN) {
            client.send(msg)
        }
    }
}
function list_clients(){
const clients = wss.clients;
console.log('clients are: '+Object.keys(clients));

}

server.listen(process.argv[2] || 8000, () => {
    console.log(`server listening...`);
})