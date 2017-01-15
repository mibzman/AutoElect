package main

import (
	"time"
)

type Troop struct {
	ID           int
	Council      string
	LodgeID      int
	Address      string
	ElectionDate time.Time
}
