import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { RouterModule } from '@angular/router';
import { BrowserModule } from '@angular/platform-browser';
import { FormsModule }    from '@angular/forms';

import { UIModule } from '../ui/ui.module';

import { HomeHeaderComponent } from '../ui/homeheader/homeheader.component';
import { LoginComponent } from './login/login.component';

import { LoginService } from './login/login.service';

@NgModule({
  imports: [
    CommonModule,
    BrowserModule,
    FormsModule,
    RouterModule.forRoot([
      { path: 'login', children: [
          { path: '', component: LoginComponent},
          { path: '', component: HomeHeaderComponent, outlet: 'header'}
        ]
      },
    ]),
  ],
  exports: [
    LoginComponent
  ],
  providers: [
    LoginService
  ],
  declarations: [LoginComponent]
})
export class EntryModule { }
