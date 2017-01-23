package main

import (
	"encoding/json"
	"fmt"
	"log"
	"net/http"
	"net/smtp"
	"strings"

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
		w.Header().Set("Access-Control-Allow-Origin", "*")
		w.Header().Set("Access-Control-Allow-Headers", "Origin, X-Requested-With, Content-Type, Accept")

		if r.Method == "OPTIONS" {
			return
		}

		var data struct {
			Email   string
			Message string
		}

		//fmt.Println(formatRequest(r))

		// body, err := ioutil.ReadAll(r.Body)
		// if err != nil {
		// 	log.Println("invite: Failed to read request body:", err)
		// 	w.WriteHeader(http.StatusInternalServerError)
		// 	return
		// }
		//
		// err = json.Unmarshal(body, &data)

		err := json.NewDecoder(r.Body).Decode(&data)
		if err != nil {
			log.Println("invite: Failed to read json:", err)
			//n := bytes.IndexByte(body, 0)
			//log.Println(string(body[0]))
			w.WriteHeader(http.StatusInternalServerError)
			return
		}
		defer r.Body.Close()

		err2 := Email(data.Email, "Welcome to AutoElect", data.Message)
		if err2 != nil {
			log.Println("invite: Failed to send email:", err2)
			w.WriteHeader(http.StatusInternalServerError)
			return
		}

		w.WriteHeader(http.StatusOK)

	})

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

type SmtpTemplateData struct {
	From    string
	To      string
	Subject string
	Body    string
}

func Email(Address, Subject, Body string) error {
	auth := smtp.PlainAuth(
		"",
		"autoelect17@gmail.com",
		"Elengomat",
		"smtp.gmail.com",
	)

	//sending
	err := smtp.SendMail(
		"smtp.gmail.com:587",
		auth,
		"autelect17@gmail.com",
		[]string{Address},
		//doc.Bytes(),
		[]byte("To: you cool guy\r\n"+
			"Subject: "+Subject+"\r\n"+
			"\r\n"+
			Body+"\r\n"),
	)
	if err != nil {
		return err
	}
	return nil
}

func formatRequest(r *http.Request) string {
	// Create return string
	var request []string
	// Add the request string
	url := fmt.Sprintf("%v %v %v", r.Method, r.URL, r.Proto)
	request = append(request, url)
	// Add the host
	request = append(request, fmt.Sprintf("Host: %v", r.Host))
	// Loop through headers
	for name, headers := range r.Header {
		name = strings.ToLower(name)
		for _, h := range headers {
			request = append(request, fmt.Sprintf("%v: %v", name, h))
		}
	}

	// If this is a POST, add post data
	if r.Method == "POST" {
		r.ParseForm()
		request = append(request, "\n")
		request = append(request, r.Form.Encode())
	}
	// Return the request as a string
	return strings.Join(request, "\n")
}
