import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { RouterModule } from '@angular/router';

import { HomeComponent } from './home/home.component';

@NgModule({
  imports: [
    CommonModule,
    RouterModule.forRoot([
      { path: '', component: HomeComponent },
    ]),
  ],
  exports: [
    HomeComponent
  ],
  declarations: [
    HomeComponent
  ]
})
export class HomeModule { }
