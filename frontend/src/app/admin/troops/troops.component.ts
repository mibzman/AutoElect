import { Component, OnInit } from '@angular/core';
import { ITroop } from '../ITroop';

@Component({
  selector: 'app-troops',
  templateUrl: './troops.component.html',
  styleUrls: ['./troops.component.css']
})
export class TroopsComponent implements OnInit {
  IsEditing: boolean;
  Troops: ITroop[];

  constructor() { }

  ngOnInit() {
    let troop1 = {IsEditing: false, ID:1, TroopAddress: "123 thing", Scoutmaster: "blarg", ScoutmasterEmail: "blarg@blarg", ComitteeChair: "poop", CommitteeChairEmail: "poop@poop"};
    let troop2 = {IsEditing: false, ID:2, TroopAddress: "123 thing2", Scoutmaster: "blarg2", ScoutmasterEmail: "blarg@blarg2", ComitteeChair: "poop2", CommitteeChairEmail: "poop@poop2"};
    //this.test = troop1;
    this.Troops = [troop1,troop2];
  }

  toggleSave(Troop: ITroop){
    if(Troop.IsEditing){
      //Save Stuff
    }
    Troop.IsEditing = !Troop.IsEditing;
  }

}
