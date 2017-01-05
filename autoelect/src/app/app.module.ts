import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';
import { FormsModule } from '@angular/forms';
import { HttpModule } from '@angular/http';
import { AlertModule } from 'ng2-bootstrap/ng2-bootstrap';
import { RouterModule } from '@angular/router';

import { EntryModule } from './entry/entry.module';
import { HomeModule } from './home/home.module';
import { AdminModule } from './admin/admin.module';
import { UIModule } from './ui/ui.module';

import { AppComponent } from './app.component';

@NgModule({
  imports: [
    BrowserModule,
    UIModule,
    FormsModule,
    AlertModule.forRoot(),
    HttpModule,
    EntryModule,
    HomeModule,
    AdminModule,
    RouterModule.forRoot([
      { path: '**', redirectTo: 'home', pathMatch: 'full' }
    ]),
  ],
    declarations: [
      AppComponent,
    ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
