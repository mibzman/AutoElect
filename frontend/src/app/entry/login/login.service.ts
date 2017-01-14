import { Injectable } from '@angular/core';
import { Http, Response } from '@angular/http';
import { Observable } from 'rxjs/Observable';
import {Md5} from 'ts-md5/dist/md5';
import 'rxjs/add/operator/catch';
import 'rxjs/add/operator/do';
import 'rxjs/add/operator/map';
import 'rxjs/add/observable/throw';

import {ILogin} from './ILogin';

@Injectable()
export class LoginService {

  private _productUrl = 'http://localhost:8080/api/1.0/login/';
  private response: ILogin;
  constructor(private _http: Http) {}

  canLogin(username:string, password:string): Observable<ILogin> {
    var url = this._productUrl + username + "?hash=" + Md5.hashStr(password);
    console.log(url);
    return this._http.get(url)
        .map((response: Response) => <ILogin> response.json())
        .catch(this.handleError);
  }

  private handleError(error: Response) {
      console.error(error);
      return Observable.throw(error.json().error || 'Server error');
  }

}
