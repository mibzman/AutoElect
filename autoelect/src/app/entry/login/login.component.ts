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
  errorMessage: string;

  constructor(private _route: ActivatedRoute,
                private _router: Router,
                private _loginService: LoginService) {
    }

  ngOnInit() {
    this._loginService.canLogin()
            .subscribe(response => {
              this.response = response
              this.doThing();
            },
              error => this.errorMessage = <any>error);
    // this._loginService.canLogin()
    //         .subscribe(response => console.log('subscribe hit: ' + response));
    //
  }

  doThing(){
    console.log(this.response);
  }


}
