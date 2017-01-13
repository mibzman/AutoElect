package main

import (
	"fmt"
	"net/http"

	"github.com/gorilla/mux"
)

func LoginHandler(w http.ResponseWriter, r *http.Request) {
	w.Header().Set("Access-Control-Allow-Origin", "*")
	result := r.URL.Query()
	vars := mux.Vars(r)
	username := vars["username"]
	for key, value := range result {
		if key == "hash" {
			if value[0] == username {
				w.Write([]byte("[{\"canLogIn\":true,\"lodgeName\":\"cuyahoga\"}]"))
			} else {
				w.Write([]byte("[{\"canLogIn\":false,\"lodgeName\":\"\"}]"))
			}
		}
	}
	//
	// if username == "mibzman" {
	// 	w.Write([]byte("[{\"canLogIn\":false,\"lodgeName\":\"\"}]"))
	// }

}

func TroopHandler(w http.ResponseWriter, r *http.Request) {

}

func main() {
	mx := mux.NewRouter().PathPrefix("/api/1.0/").Subrouter()
	mx.HandleFunc("/login/{username}", LoginHandler)
	mx.HandleFunc("/{lodgeName}/troops", TroopHandler)
	fmt.Print("server is serving")
	http.ListenAndServe(":8080", mx)
	fmt.Print("server is serving")
}
