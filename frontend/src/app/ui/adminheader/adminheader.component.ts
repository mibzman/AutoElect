import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';

@Component({
  selector: 'app-adminheader',
  templateUrl: './adminheader.component.html',
  styleUrls: ['./adminheader.component.css']
})
export class AdminHeaderComponent implements OnInit {

  lodgeName:string;

  constructor(private _route: ActivatedRoute,
                private _router: Router) {
    }

  ngOnInit() {
    this.lodgeName = this._route.snapshot.params['lodgeName'];
  }

}
