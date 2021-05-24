import { Component, OnInit } from '@angular/core';
import {UserService} from "../../../services/user.service";
import {User} from "../../../models/user";
import {Router} from "@angular/router";

@Component({
  selector: 'app-dashboard-admin',
  templateUrl: './dashboard-admin.component.html',
  styleUrls: ['./dashboard-admin.component.scss'],
  providers: [UserService]
})
export class DashboardAdminComponent implements OnInit {

  user: User;
  excel: any = null;
  load: boolean;
  list: any[] = [];

  constructor(private userService: UserService, private router: Router) { }

  ngOnInit() {
    this.user = this.userService.isLogin();
    if (this.user == null || (!this.user && this.user.type === User.ADMIN)) {
      this.router.navigate(['admin/login']);
    }
  }
  
}
