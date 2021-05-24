import { Component, OnInit } from '@angular/core';
import {User} from "../../../models/user";
import {UserService} from "../../../services/user.service";
import {Pref} from "../../../models/pref";
import {Router} from "@angular/router";


@Component({
  selector: 'app-login-admin',
  templateUrl: './login-admin.component.html',
  styleUrls: ['./login-admin.component.scss'],
  providers: [UserService]
})
export class LoginAdminComponent implements OnInit {

  user: User;
  errormsg: string = "";
  

  constructor(private userService: UserService, private router: Router) { }

  ngOnInit() {
    this.user = this.userService.isLogin();
    if(this.user){
      this.router.navigate(['admin/books']);
    }else{
      this.user = User.make();
    }
  }

  submitLogin(){
  
    this.errormsg = "";

    if (this.user.email !== '' && this.user.password !== ''){

      this.userService.loginAdmin(this.user).subscribe(
        result => {
          if (result.code === 200) {
            //seteamos user de bbdd
            let user = User.make(result.user);
            this.user = user;

            //guardamos la sesión de usuario
            Pref.set(Pref.USER, this.user);
            this.router.navigate(['admin/books']);

          } else {
            this.errormsg = result.message;
            console.log(result.message);
          }

        },
        error => {
          this.errormsg = "Ha ocurrido un error.";
          console.log(<any> error);
        }
      );
    }

  }

}
