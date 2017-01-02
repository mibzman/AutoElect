import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { TitlebarComponent } from './titlebar/titlebar.component';
import { HomeComponent } from './home/home.component';

@NgModule({
  imports: [
    CommonModule
  ],
  exports: [
    TitlebarComponent
  ],
  declarations: [
    TitlebarComponent,
    HomeComponent
  ]
})
export class HomeModule { }
