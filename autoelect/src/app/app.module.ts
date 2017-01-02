import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';
import { FormsModule } from '@angular/forms';
import { HttpModule } from '@angular/http';
import { AlertModule } from 'ng2-bootstrap/ng2-bootstrap';
import { RouterModule } from '@angular/router';

import {EntryModule} from './entry/entry.module';

import { AppComponent } from './app.component';
import { HomeComponent } from './home/home.component';

@NgModule({
  imports: [
    BrowserModule,
    FormsModule,
    AlertModule.forRoot(),
    HttpModule,
    RouterModule.forRoot([
      { path: '', component: HomeComponent },
      {path: 'login', component: LoginComponent}
      { path: '**', redirectTo: '', pathMatch: 'full' }
    ]),
    EntryModule
  ],
    declarations: [
      LoginComponent,
      AppComponent,
      HomeComponent,
    ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
