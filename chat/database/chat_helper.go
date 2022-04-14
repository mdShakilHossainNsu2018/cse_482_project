package database

import (
	"database/sql"
	"fmt"
	"log"
)

var db *sql.DB

type Album struct {
	ID     int64
	Title  string
	Artist string
	Price  float32
}

type Channel struct {
	ChannelID int `json:"channel_id"`
	UserID    int `json:"user_id"`
}

func GetOrCreateChanelId(userId int32) (*Channel, error) {
	rows, err := db.Query("select channel_id, users_user_id as user_id from users join channels c on users.user_id = c.users_user_id where user_id = ?;", userId)
	if err != nil {
		return nil, fmt.Errorf("error while getting channel_id %q: %v", userId, err)
	}
	defer func(rows *sql.Rows) {
		err := rows.Close()
		if err != nil {
			log.Println(err)
		}
	}(rows)
	var channel Channel

	if rows.Next() {
		err := rows.Scan(&channel.ChannelID, &channel.UserID)
		if err != nil {
			return nil, err
		}
	} else {
		result, err := db.Exec("INSERT INTO channels (users_user_id) values (?);", userId)
		if err != nil {
			return nil, err
		}
		lastId, _ := result.LastInsertId()
		return &Channel{ChannelID: int(lastId), UserID: int(userId)}, nil
	}

	return &channel, nil
}

type Message struct {
	MessageId int
	Message   string
	ChannelId int
	Sender    int
}

func CreateMessage(message Message) (sql.Result, error) {

	res, err := db.Exec("INSERT INTO messages (message, channels_channel_id,  sender) values (?, ?,  ?)",
		message.Message, message.ChannelId,
		message.Sender,
	)

	if err != nil {
		return nil, err
	}

	return res, nil
}

// AlbumsByArtist queries for albums that have the specified artist name.
func AlbumsByArtist(name string) ([]Album, error) {
	// An albums slice to hold data from returned rows.
	var albums []Album

	rows, err := db.Query("SELECT * FROM album WHERE artist = ?", name)
	if err != nil {
		return nil, fmt.Errorf("albumsByArtist %q: %v", name, err)
	}
	defer rows.Close()
	// Loop through rows, using Scan to assign column data to struct fields.
	for rows.Next() {
		var alb Album
		if err := rows.Scan(&alb.ID, &alb.Title, &alb.Artist, &alb.Price); err != nil {
			return nil, fmt.Errorf("albumsByArtist %q: %v", name, err)
		}
		albums = append(albums, alb)
	}
	if err := rows.Err(); err != nil {
		return nil, fmt.Errorf("albumsByArtist %q: %v", name, err)
	}
	return albums, nil
}
