package main

import (
	"database/sql"
	"github.com/gorilla/mux"
	"github.com/gorilla/websocket"
	"log"
	"net/http"
	"time"
)

var upgrader = websocket.Upgrader{
	ReadBufferSize:  1024,
	WriteBufferSize: 1024,
}

const (
	port = ":50051"
)

var db *sql.DB

const (
	secretKey     = "secret"
	tokenDuration = 15 * time.Minute
)

//func readHandler(conn *websocket.Conn) {
//	for {
//		messageType, p, err := conn.ReadMessage()
//		if err != nil {
//			log.Println(err)
//			return
//		}
//		if err := conn.WriteMessage(messageType, p); err != nil {
//			log.Println(err)
//			return
//		}
//	}
//}

//func WebSocketHandler(w http.ResponseWriter, r *http.Request) {
//	upgrader.CheckOrigin = func(r *http.Request) bool {
//		return true
//	}
//	conn, err := upgrader.Upgrade(w, r, nil)
//	if err != nil {
//		log.Println(err)
//		return
//	}
//	log.Println("Connected to websocket")
//	//... Use conn to send and receive messages.
//	readHandler(conn)
//}

func main() {
	// concurrent
	go h.run()
	r := mux.NewRouter()
	r.HandleFunc("/ws/{roomId}", func(w http.ResponseWriter, r *http.Request) {

		vars := mux.Vars(r)
		roomId := vars["roomId"]
		serveWs(w, r, roomId)
	})
	log.Fatal(http.ListenAndServe(":8000", r))

}
