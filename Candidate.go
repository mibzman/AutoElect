package main

import (
	"time"
)

type Candidate struct {
	Person
	IsYouth     bool
	ElectedDate time.Time
	OrdealDate  time.Time
	EventID     int
}
