import { Injectable } from '@angular/core';
import { Http, Response, Headers } from '@angular/http';
import { Observable } from 'rxjs/Observable';
import 'rxjs/add/operator/catch';
import 'rxjs/add/operator/do';
import 'rxjs/add/operator/map';
import 'rxjs/add/observable/throw';

@Injectable()
export class InviteService {

  private _productUrl = 'http://localhost:8080/api/1.0/'

  //http://stackoverflow.com/q/35110690/5971811
  constructor(private _http: Http) {}

  sendEmail(email:string, message:string, lodgeName:string){
    let url = this._productUrl + lodgeName + "/invite";
    let emailObj = {Email: email, Message: message};
    let body = JSON.stringify(emailObj);
    console.log(body);
    //let headers = new Headers({ 'Content-Type': 'application/json' });

    return this._http.post(url, body);
  }

  private handleError(error: Response) {
      console.error(error);
      return Observable.throw(error.json().error || 'Server error');
  }

}
