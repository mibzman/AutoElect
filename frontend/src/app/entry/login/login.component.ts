import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';
import { LoginService } from './login.service';

import { ILogin } from './ILogin';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.css']
})
export class LoginComponent implements OnInit {

  response: ILogin;
  usernameHolder:string;
  passwordHolder:string;
  error:string = localStorage.getItem("loginError");
  loading:boolean = false;

  constructor(private _route: ActivatedRoute,
                private _router: Router,
                private _loginService: LoginService) {
    }

  ngOnInit() {

  }

  login(){
    this.loading = true;
    this.error = "";
    localStorage.setItem("loginError", "");
    this._loginService.canLogin(this.usernameHolder, this.passwordHolder)
            .subscribe(response => {
              this.response = response
              localStorage.setItem("isLoggedIn", this.response.PasswordCorrect.toString());
              localStorage.setItem("sessionTime", new Date().getTime().toString());
              if (localStorage.getItem("isLoggedIn") == "true"){
                this._router.navigate(['/admin/' + this.response.LodgeName]);
              }else{
                this.loading = false;
                this.error = "Username or password is incorrect.";
              }
            },
              error => this.error = <any>error);
  }


}
