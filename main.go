package main

import (
	"encoding/json"
	"fmt"
	"log"
	"net/http"

	"github.com/gorilla/mux"
	"github.com/jinzhu/gorm"
	_ "github.com/jinzhu/gorm/dialects/mysql"
)

func TroopHandler(w http.ResponseWriter, r *http.Request) {

}

type ILogin struct {
	PasswordCorrect bool
	LodgeName       string
}

func main() {
	//init database

	db, err := gorm.Open("mysql", "autoelect:elengomat@/autoelect?charset=utf8&parseTime=True&loc=Local")
	defer db.Close()

	if err != nil {
		//panic(fmt.Printf("bad things happened", a)
	}

	Init(db)

	//init api
	mx := mux.NewRouter().PathPrefix("/api/1.0/").Subrouter()
	mx.HandleFunc("/login/{email}", func(w http.ResponseWriter, r *http.Request) {

		w.Header().Set("Access-Control-Allow-Origin", "*")
		result := r.URL.Query()
		vars := mux.Vars(r)
		email := vars["email"]
		var admin Admin
		db.Where("email = ?", email).First(&admin)

		encoder := json.NewEncoder(w)
		for key, value := range result {
			if key == "hash" {
				if value[0] == admin.Hash {
					var lodge Lodge
					db.Where("id = ?", admin.LodgeID).First(&lodge)
					result := ILogin{true, lodge.Name}
					err := encoder.Encode(result)
					if err != nil {
						log.Println("Failed to encode json:", err)
						w.WriteHeader(http.StatusInternalServerError)
						return
					}
				} else {
					result := ILogin{false, "blarg"}
					err := encoder.Encode(result)
					if err != nil {
						log.Println("Failed to encode json:", err)
						w.WriteHeader(http.StatusInternalServerError)
						return
					}
				}
			}
		}
	})
	mx.HandleFunc("/{LodgeName}/troops", TroopHandler)
	fmt.Print("server is serving")
	http.ListenAndServe(":8080", mx)
	fmt.Print("server is serving")
}

//for all the table checking and creation on start
func Init(db *gorm.DB) {
	if !db.HasTable(&Admin{}) {
		db.CreateTable(&Admin{})
	}

	if !db.HasTable(&Candidate{}) {
		db.CreateTable(&Candidate{})
	}

	if !db.HasTable(&Event{}) {
		db.CreateTable(&Event{})
	}

	if !db.HasTable(&Lodge{}) {
		db.CreateTable(&Lodge{})
	}

	if !db.HasTable(&Troop{}) {
		db.CreateTable(&Troop{})
	}

	// lodge := Lodge{
	// 	ID:   17,
	// 	Name: "Cuyahoga",
	// }
	//
	// db.NewRecord(lodge)
	// db.Create(&lodge)
	//
	// var resultLodge Lodge
	// db.Where("ID = ?", 17).First(&resultLodge)
	// user := Admin{
	// 	Person: Person{
	// 		FirstName: "Sam",
	// 		LastName:  "Borick",
	// 		BSARank:   "Eagle",
	// 		OARank:    2,
	// 		Address:   "123 blarg st",
	// 		Email:     "Boick.borick@borick.com",
	// 		Birthdate: time.Now(),
	// 		LodgeID:   17,
	// 	},
	// 	Permission: 4,
	// 	Hash:       "21232f297a57a5a743894a0e4a801fc3",
	// }
	// db.NewRecord(user)
	// db.Create(&user)

	//db.Where("ID = ?", 17).First(&resultLodge)
	//fmt.Println("test")
	//fmt.Println("Admins: ", resultLodge.Admins[0])
}
