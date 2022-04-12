package database

import (
	"database/sql"
	_ "github.com/go-sql-driver/mysql"
	"log"
)

func init() {
	// Capture connection properties.
	//cfg := mysql.Config{
	//	User:   "mysql_user",
	//	Passwd: "password",
	//	Net:    "tcp",
	//	Addr:   "mysql_db:3306",
	//	DBName: "sm_db",
	//}
	// Get a database handle.
	var err error
	db, err = sql.Open("mysql", "user:password@/db")
	if err != nil {
		log.Fatal(err)
	}

	pingErr := db.Ping()
	if pingErr != nil {
		log.Fatal(pingErr)
	}
}
