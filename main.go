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
					result := struct {
						PasswordCorrect bool
						LodgeName       string
					}{
						true,
						lodge.Name,
					}
					err := encoder.Encode(result)
					if err != nil {
						log.Println("Failed to encode json:", err)
						w.WriteHeader(http.StatusInternalServerError)
						return
					}
				} else {
					result := struct {
						PasswordCorrect bool
						LodgeName       string
					}{
						false,
						"",
					}
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
	mx.HandleFunc("/{LodgeName}/invite", func(w http.ResponseWriter, r *http.Request) {
		decoder := json.NewDecoder(r.Body)
		var data struct {
			Email   string
			Message string
		}
		err := decoder.Decode(&data)
		if err != nil {
			log.Println("invite: Failed to read json:", err)
			w.WriteHeader(http.StatusInternalServerError)
			return
		}
		defer r.Body.Close()

		//send email!

		w.WriteHeader(http.StatusOK)

	}).Methods("PUT")
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
}
