import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { RouterModule } from '@angular/router';

import { DashComponent } from './dash/dash.component';

import { LoginGuard } from './login-guard.service';

@NgModule({
  imports: [
    CommonModule,
    RouterModule.forRoot([
      { path: 'dash/:lodgeName', canActivate: [LoginGuard],  component: DashComponent },
    ]),
  ],
  providers: [
    LoginGuard
  ],
  exports: [
    DashComponent,
  ],
  declarations: [
    DashComponent,
  ]
})
export class AdminModule { }
