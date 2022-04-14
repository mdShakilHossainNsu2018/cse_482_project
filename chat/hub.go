package main

import (
	"encoding/json"
	"github.com/mdShakilHossainNsu2018/cse_482_project/chat/database"
	"log"
	"strconv"
)

type message struct {
	data []byte
	room string
}

type subscription struct {
	conn *connection
	room string
}

type MyMessage struct {
	Message string
	Sender  int
}

// hub maintains the set of active connections and broadcasts messages to the
// connections.
type hub struct {
	// Registered connections.
	rooms map[string]map[*connection]bool

	// Inbound messages from the connections.
	broadcast chan message

	// Register requests from the connections.
	register chan subscription

	// Unregister requests from connections.
	unregister chan subscription
}

var h = hub{
	broadcast:  make(chan message),
	register:   make(chan subscription),
	unregister: make(chan subscription),
	rooms:      make(map[string]map[*connection]bool),
}

func (h *hub) run() {
	for {
		select {
		case s := <-h.register:
			connections := h.rooms[s.room]
			if connections == nil {
				connections = make(map[*connection]bool)
				h.rooms[s.room] = connections
			}
			h.rooms[s.room][s.conn] = true
		case s := <-h.unregister:
			connections := h.rooms[s.room]
			if connections != nil {
				if _, ok := connections[s.conn]; ok {
					delete(connections, s.conn)
					close(s.conn.send)
					if len(connections) == 0 {
						delete(h.rooms, s.room)
					}
				}
			}
		case m := <-h.broadcast:
			connections := h.rooms[m.room]

			roomId, err := strconv.Atoi(m.room)
			if err != nil {
				return
			}
			channel, err2 := database.GetOrCreateChanelId(int32(roomId))
			if err2 != nil {
				return
			}
			var my_message MyMessage
			err = json.Unmarshal([]byte(m.data), &my_message)
			if err != nil {
				log.Println(err)
				return
			}
			messageLocal := database.Message{
				Sender:    my_message.Sender,
				ChannelId: channel.ChannelID,
				Message:   my_message.Message,
			}
			_, err = database.CreateMessage(messageLocal)
			if err != nil {
				return
			}

			for c := range connections {
				select {
				case c.send <- m.data:
				default:
					close(c.send)
					delete(connections, c)
					if len(connections) == 0 {
						delete(h.rooms, m.room)
					}
				}
			}
		}
	}
}
