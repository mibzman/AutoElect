import { Injectable } from '@angular/core';
import { ActivatedRouteSnapshot, CanActivate, Router } from '@angular/router';

@Injectable()
export class ProductDetailGuard implements CanActivate {

    constructor(private _router: Router) {
    }

    canActivate(route: ActivatedRouteSnapshot): boolean {
        if (localStorage.getItem("isLoggedIn") == "false") {
            alert('You are not logged in');
            this._router.navigate(['/login']);
            return false;
        };
        return true;
    }
}
