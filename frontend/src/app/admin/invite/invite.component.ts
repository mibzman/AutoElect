import { Component, OnInit } from '@angular/core';
import { InviteService } from './invite.service';
import { ActivatedRoute, Router } from '@angular/router';

@Component({
  selector: 'app-invite',
  templateUrl: './invite.component.html',
  styleUrls: ['./invite.component.css']
})
export class InviteComponent implements OnInit {

  LodgeName: string;
  emailHolder:string;
  messageHolder:string;
  error:string;// = localStorage.getItem("loginError");
  success:string;
  loading:boolean = false;

  constructor(private _inviteService: InviteService,
              private _route: ActivatedRoute) { }

  ngOnInit() {
    this._route.parent.params.subscribe(params => {
       this.LodgeName = params['LodgeName'];
    });
  }

  send(){
    this.loading = true;
    this._inviteService.sendEmail(this.emailHolder, this.messageHolder, this.LodgeName).subscribe(
       data => {
         this.loading = false;
         this.success = "Email Sent"
       },
       error => {
         this.error = <any>error;
         this.loading = false;
       }
    );
  }

}
