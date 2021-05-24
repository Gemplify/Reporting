import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import {LoginAdminComponent} from "./modules/admin/login-admin/login-admin.component";
import {DashboardAdminComponent} from "./modules/admin/dashboard-admin/dashboard-admin.component";
import {ProductListAdminComponent} from './modules/admin/product-admin/product-list-admin/product-list-admin.component';


const routes: Routes = [
  {path: '', component: LoginAdminComponent},
  {path: 'admin/login', component: LoginAdminComponent},
  {path: 'admin/dashboard', component: DashboardAdminComponent},
  {path: 'admin/books', component: ProductListAdminComponent},
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
