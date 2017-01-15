package main

import (
	"time"
)

type Person struct {
	ID        uint
	FirstName string
	LastName  string
	BSARank   string //TODO: make these an enum or iota or whatever
	OARank    int
	Address   string
	Email     string
	Birthdate time.Time
	LodgeID   int
	TroopID   int //not really a troop reference
}
