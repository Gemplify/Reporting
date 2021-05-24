import { Component, OnInit } from '@angular/core';
import {faBook} from '@fortawesome/free-solid-svg-icons';



@Component({
  selector: 'app-side-menu',
  templateUrl: './side-menu.component.html',
  styleUrls: ['./side-menu.component.scss']
})
export class SideMenuComponent implements OnInit {
  
  faBook = faBook;
  
  constructor() { }

  ngOnInit() {
  }

}
