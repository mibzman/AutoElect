import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { LoginComponent } from './login/login.component';

import { RouterModule } from '@angular/router';

@NgModule({
  imports: [
    CommonModule,
    RouterModule.forRoot([
      { path: 'login', component: LoginComponent },
    ]),
  ],
  exports: [
    LoginComponent
  ],
  declarations: [LoginComponent]
})
export class EntryModule { }
