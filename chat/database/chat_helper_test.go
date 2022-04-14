package database

import (
	"log"
	"testing"
)

func TestGetChanelID(t *testing.T) {
	channel, err := GetOrCreateChanelId(39)
	if err != nil {
		t.Fatal(err)
	}
	log.Println(channel)
}

func TestCreateMessage(t *testing.T) {
	message := Message{Message: "test message",
		ChannelId: 1,
		IsAdmin:   false,
		Sender:    39}

	result, err := CreateMessage(message)

	if err != nil {
		t.Fatal(err)
	}
	log.Println(result.LastInsertId())
}
