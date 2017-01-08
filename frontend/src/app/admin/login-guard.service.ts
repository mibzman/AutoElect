import { Injectable } from '@angular/core';
import { ActivatedRouteSnapshot, CanActivate, Router } from '@angular/router';

@Injectable()
export class LoginGuard implements CanActivate {

    constructor(private _router: Router) {
    }

    canActivate(route: ActivatedRouteSnapshot): boolean {
        if (localStorage.getItem("isLoggedIn") == null || localStorage.getItem("isLoggedIn") == "false") {
          localStorage.setItem("loginError", 'You are not logged in');
            this._router.navigate(['/login']);
            return false;
        };

        if(this.hasBeenLongerThanTimeout()){
          localStorage.setItem("loginError", 'You have been logged out due to inactivty');
          this._router.navigate(['/login']);
          return false;
        }else{
          localStorage.setItem("sessionTime", new Date().getTime().toString());
        }

        return true;
    }

    hasBeenLongerThanTimeout(): boolean {
      let lastNum = parseInt(localStorage.getItem("sessionTime"));
      let current = new Date().getTime();
      return (current - lastNum > (15 * 60 * 1000));
    }
}
