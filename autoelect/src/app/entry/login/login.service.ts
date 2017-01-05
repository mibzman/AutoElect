import { Injectable } from '@angular/core';
import { Http, Response } from '@angular/http';
import { Observable } from 'rxjs/Observable';
import 'rxjs/add/operator/catch';
import 'rxjs/add/operator/do';
import 'rxjs/add/operator/map';

import {ILogin} from './ILogin';

@Injectable()
export class LoginService {

  private _productUrl = 'api/login.json';
  private response: ILogin;
  constructor(private _http: Http) {}

  canLogin(): Observable<ILogin> {
    return this._http.get(this._productUrl)
        .map((response: Response) => <ILogin> response.json())
        .do(data => console.log('All: ' +  JSON.stringify(data)))
        .catch(this.handleError);
  }

  private handleError(error: Response) {
      console.error(error);
      return Observable.throw(error.json().error || 'Server error');
  }

}
