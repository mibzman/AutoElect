import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';
import { FormsModule } from '@angular/forms';
import { HttpModule } from '@angular/http';
import { AlertModule } from 'ng2-bootstrap/ng2-bootstrap';
import { RouterModule } from '@angular/router';

import { EntryModule } from './entry/entry.module';
import { HomeModule } from './home/home.module';

import { AppComponent } from './app.component';

@NgModule({
  imports: [
    BrowserModule,
    FormsModule,
    RouterModule.forRoot([
      { path: '**', redirectTo: '', pathMatch: 'full' }
    ]),
    AlertModule.forRoot(),
    HttpModule,
    EntryModule,
    HomeModule
  ],
    declarations: [
      AppComponent,
    ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
