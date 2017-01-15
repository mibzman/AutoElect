import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { RouterModule } from '@angular/router';
import { FormsModule }   from '@angular/forms';

import { UIModule } from '../ui/ui.module';

import { DashComponent } from './dash/dash.component';
import { InviteComponent } from './invite/invite.component'
import { AdminHeaderComponent } from '../ui/adminheader/adminheader.component';
import { TroopsComponent } from './troops/troops.component';

import { LoginGuard } from './login-guard.service';
import { InviteService } from './invite/invite.service';

@NgModule({
  imports: [
    CommonModule,
    FormsModule,
    RouterModule.forRoot([
      // { path: '', canActivate: [LoginGuard],  component: DashComponent },
      // { path: 'dash/*', component: AdminHeaderComponent, outlet: 'header'}
      { path: 'admin/:LodgeName',  canActivate: [LoginGuard], component: AdminHeaderComponent,
        children: [
          { path: 'dash', component: DashComponent},
          { path: 'troops', component: TroopsComponent},
          { path: 'invite', component: InviteComponent},
          { path: '', redirectTo: 'dash', pathMatch: 'full'},

        ]
      },
    ]),
  ],
  providers: [
    LoginGuard,
    InviteService
  ],
  exports: [
    DashComponent,
  ],
  declarations: [
    DashComponent,
    TroopsComponent,
    InviteComponent,
  ]
})
export class AdminModule { }
