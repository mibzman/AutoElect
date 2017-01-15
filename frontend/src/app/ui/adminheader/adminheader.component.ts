import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';

@Component({
  selector: 'app-adminheader',
  templateUrl: './adminheader.component.html',
  styleUrls: ['./adminheader.component.css']
})
export class AdminHeaderComponent implements OnInit {

  LodgeName:string;

  constructor(private _route: ActivatedRoute,
                private _router: Router) {
    }

  ngOnInit() {
    this.LodgeName = this._route.snapshot.params['LodgeName'];
  }

}
