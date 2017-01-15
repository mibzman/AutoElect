import { Component, OnInit } from '@angular/core';
import { InviteService } from './invite.service';

@Component({
  selector: 'app-invite',
  templateUrl: './invite.component.html',
  styleUrls: ['./invite.component.css']
})
export class InviteComponent implements OnInit {

  emailHolder:string;
  messageHolder:string;
  error:string;// = localStorage.getItem("loginError");
  success:string;
  loading:boolean = false;

  constructor(private _inviteService: InviteService) { }

  ngOnInit() {
  }

  send(){
    this.loading = true;
    this._inviteService.sendEmail(this.emailHolder, this.messageHolder).subscribe(
       data => {
         this.loading = false;
         this.success = "Email Sent"
       },
       error => this.error = <any>error
    );
  }

}
