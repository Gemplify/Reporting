import {Component, EventEmitter, Input, OnInit, Output} from '@angular/core';
import {faArrowLeft, faArrowRight, faCircleNotch} from '@fortawesome/free-solid-svg-icons';

@Component({
  selector: 'app-input-list-box',
  templateUrl: './input-list-box.component.html',
  styleUrls: ['./input-list-box.component.scss']
})
export class InputListBoxComponent implements OnInit {
  
  faArrowRight = faArrowRight;
  faArrowLeft = faArrowLeft;
  faCircleNotch = faCircleNotch;
  
  @Input() data: any[];
  @Input() load: boolean;
  @Input() name: string;
  @Output() dataOut = new EventEmitter<any[]>();
  @Output() dataSearch = new EventEmitter<any[]>();
  dataChoose: any[] = [];
  object: any;
  stringsearch: string;
  
  @Input()
  set clean(clean: boolean){
    if(clean){
      this.removeAll()
    }
  }
  
  constructor() { }
  
  ngOnInit() {
  }
  
  search(event: any){
    let string = event.target.value;
    this.dataSearch.emit(string);
  }
  
  choose(item){
    let control = false;
    this.dataChoose.forEach((d, i, o) =>{
      if(item.id === d.id){
        control = true;
      }
    });
    if(!control){
      this.dataChoose.push(item);
      this.data = [];
      this.stringsearch = '';
      this.dataOut.emit(this.dataChoose);
    }
  }
  
  remove(item){
    this.dataChoose.forEach((d, i, o) =>{
      if(item.id === d.id){
        o.splice(i, 1);
      }
    });
    this.dataOut.emit(this.dataChoose);
  }
  
  removeAll(){
    this.dataChoose = [];
    this.dataOut.emit(this.dataChoose);
  }

}
