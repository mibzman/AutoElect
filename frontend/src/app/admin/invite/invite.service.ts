import { Injectable } from '@angular/core';
import { Http, Response, Headers } from '@angular/http';
import { Observable } from 'rxjs/Observable';
import { ActivatedRoute, Router } from '@angular/router';
import 'rxjs/add/operator/catch';
import 'rxjs/add/operator/do';
import 'rxjs/add/operator/map';
import 'rxjs/add/observable/throw';

@Injectable()
export class InviteService {

  private LodgeName: string;
  private _productUrl = 'http://localhost:8080/api/1.0/'

  //http://stackoverflow.com/q/35110690/5971811
  constructor(private _http: Http,
              private _route: ActivatedRoute) {
     //+ LodgeName + '/invite';
    this.LodgeName = this._route.snapshot.params['LodgeName'];
  }

  sendEmail(e:string, m:string){
    let url = this._productUrl + this.LodgeName + "/invite";
    let email = {email: e, message: m};
    let body = JSON.stringify(email);
    let headers = new Headers({ 'Content-Type': 'application/json' });

    return this._http.put(url, body, headers)
      .map((res: Response) => res.json());
  }

  private handleError(error: Response) {
      console.error(error);
      return Observable.throw(error.json().error || 'Server error');
  }

}
