package database

import (
	"database/sql"
	"github.com/go-sql-driver/mysql"
	"log"
)

func init() {
	//Capture connection properties.
	cfg := mysql.Config{
		User:   "user",
		Passwd: "password",
		Net:    "tcp",
		Addr:   "db:3306",
		DBName: "db",
	}
	// Get a database handle.
	var err error
	//db, err = sql.Open("mysql", "user:password@/db")
	db, err = sql.Open("mysql", cfg.FormatDSN())
	if err != nil {
		log.Fatal(err)
	}

	pingErr := db.Ping()
	if pingErr != nil {
		log.Fatal(pingErr)
	}
}
