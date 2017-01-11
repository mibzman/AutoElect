package main

import (
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

func main() {
	mux := mux.NewRouter().PathPrefix("/api/1.0/").Subrouter()
	// staticFiles := rice.MustFindBox("frontend").HTTPBox()
	// mux.Handle("/", http.FileServer(staticFiles))
	mux.HandleFunc("/login/{username}", LoginHandler)
	http.ListenAndServe(":8080", mux)
}
