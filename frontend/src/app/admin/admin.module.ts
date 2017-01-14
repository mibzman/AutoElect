import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { RouterModule } from '@angular/router';
import { FormsModule }   from '@angular/forms';

import { UIModule } from '../ui/ui.module';

import { DashComponent } from './dash/dash.component';
import { AdminHeaderComponent } from '../ui/adminheader/adminheader.component';

import { LoginGuard } from './login-guard.service';
import { TroopsComponent } from './troops/troops.component';

@NgModule({
  imports: [
    CommonModule,
    FormsModule,
    RouterModule.forRoot([
      // { path: '', canActivate: [LoginGuard],  component: DashComponent },
      // { path: 'dash/*', component: AdminHeaderComponent, outlet: 'header'}
      { path: 'admin/:lodgeName',  canActivate: [LoginGuard], component: AdminHeaderComponent,
        children: [
          { path: 'dash', component: DashComponent},
          { path: 'troops', component: TroopsComponent},
          { path: '', redirectTo: 'dash', pathMatch: 'full'},
          // { path: '', component: AdminHeaderComponent, outlet: 'header'},
          // { path: '', component: AdminFooterComponent, outlet: 'footer'}
        ]
      },
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
    TroopsComponent,
  ]
})
export class AdminModule { }
