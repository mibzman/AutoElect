import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { RouterModule } from '@angular/router';

import { HomeHeaderComponent } from './homeheader/homeheader.component';
import { AdminHeaderComponent } from './adminheader/adminheader.component';
import { HomeFooterComponent } from './homefooter/homefooter.component';


@NgModule({
  imports: [
    CommonModule,
    RouterModule
    // RouterModule.forRoot([
    //   { path: '', children: [
    //       { path: '', component: HomeHeaderComponent, outlet: 'header'}
    //     ]
    //   },
    //   { path: 'login', children: [
    //       { path: '', component: HomeHeaderComponent, outlet: 'header'}
    //     ]
    //   },
    // ]),
  ],
  exports:[
    HomeHeaderComponent,
    HomeFooterComponent,
    AdminHeaderComponent
  ],
  declarations: [
    HomeHeaderComponent,
    AdminHeaderComponent,
    HomeFooterComponent
  ]
})
export class UIModule { }
