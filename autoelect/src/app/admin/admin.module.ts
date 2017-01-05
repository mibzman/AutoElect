import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { RouterModule } from '@angular/router';


import { DashComponent } from './dash/dash.component';

@NgModule({
  imports: [
    CommonModule,
    RouterModule.forRoot([
      { path: 'dash', component: DashComponent },
    ]),
  ],
  exports: [
    DashComponent,
  ],
  declarations: [
    DashComponent,
  ]
})
export class AdminModule { }
