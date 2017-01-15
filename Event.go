package main

import (
	"time"
)

type Event struct {
	ID         int
	Date       time.Time
	Candidates []Candidate
	LodgeID    int //host lodge
}
