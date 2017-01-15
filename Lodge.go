package main

type Lodge struct {
	ID         uint
	Name       string //ie cuyahoga
	Admins     []Admin
	Troops     []Troop
	Candidates []Candidate
	Events     []Event
}
