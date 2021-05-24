import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { BrowserAnimationsModule } from '@angular/platform-browser/animations';

// jquery
declare var $;
import { DragDropModule } from '@angular/cdk/drag-drop';
import {HttpClientModule} from "@angular/common/http";
import { DashboardAdminComponent } from './modules/admin/dashboard-admin/dashboard-admin.component';
import { LoginAdminComponent } from './modules/admin/login-admin/login-admin.component';
import {FormsModule} from "@angular/forms";
import { SideMenuComponent } from './modules/components/side-menu/side-menu.component';
import { HeaderComponent } from './modules/components/header/header.component';
import { ProductListAdminComponent } from './modules/admin/product-admin/product-list-admin/product-list-admin.component';
import {FontAwesomeModule} from '@fortawesome/angular-fontawesome';
import { FooterComponent } from './modules/components/footer/footer.component';
import { ListBoxComponent } from './modules/components/list-box/list-box.component';
import {
  MatDatepickerModule, MatFormFieldModule, MatInputModule, MatNativeDateModule,
  MatSnackBarModule, MatTabsModule
} from '@angular/material';
import { InputListBoxComponent } from './modules/components/input-list-box/input-list-box.component';


@NgModule({
  declarations: [
    AppComponent,
    DashboardAdminComponent,
    LoginAdminComponent,
    SideMenuComponent,
    HeaderComponent,
    ProductListAdminComponent,
    FooterComponent,
    ListBoxComponent,
    InputListBoxComponent
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    BrowserAnimationsModule,
    DragDropModule,
    HttpClientModule,
    FormsModule,
    FontAwesomeModule,
    MatNativeDateModule,
    MatDatepickerModule,
    MatFormFieldModule,
    MatInputModule,
    MatSnackBarModule,
    MatTabsModule
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
