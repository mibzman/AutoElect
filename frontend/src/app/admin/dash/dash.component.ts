import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';

@Component({
  selector: 'app-dash',
  templateUrl: './dash.component.html',
  styleUrls: ['./dash.component.css']
})
export class DashComponent implements OnInit {

  lodgeName: string;

  constructor(private _route: ActivatedRoute,
              private _router: Router){
  }

  ngOnInit() {
    this.lodgeName = this._route.snapshot.params['lodgeName'];
  }

}
