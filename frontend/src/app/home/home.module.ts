import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { RouterModule } from '@angular/router';
import { UIModule } from '../ui/ui.module';

import { HomeHeaderComponent } from '../ui/homeheader/homeheader.component';
import { HomeFooterComponent } from '../ui/homefooter/homefooter.component';
import { HomeComponent } from './home/home.component';

@NgModule({
  imports: [
    CommonModule,
    UIModule,
    RouterModule.forRoot([
      { path: '', children: [
          { path: '', component: HomeComponent},
          { path: '', component: HomeHeaderComponent, outlet: 'header'},
          { path: '', component: HomeFooterComponent, outlet: 'footer'}
         ]
       },
    ]),
  ],
  exports: [
    HomeComponent,
  ],
  declarations: [
    HomeComponent,
  ]
})
export class HomeModule { }
