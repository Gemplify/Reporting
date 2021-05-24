import {Component, EventEmitter, Input, OnInit, Output} from '@angular/core';
import {faArrowLeft, faArrowRight} from '@fortawesome/free-solid-svg-icons';

@Component({
  selector: 'app-list-box',
  templateUrl: './list-box.component.html',
  styleUrls: ['./list-box.component.scss']
})
export class ListBoxComponent implements OnInit {
  
  faArrowRight = faArrowRight;
  faArrowLeft = faArrowLeft;
  
  @Input() data: any[];
  @Output() dataOut = new EventEmitter<any[]>();
  dataChoose: any[] = [];
  disabled_: boolean;
  search: string = '';
  searchchoose: string = '';
  
  @Input()
  set disabled(disabled: boolean){
    this.disabled_ = disabled;
    if(disabled){
      this.removeAll()
    }
  }
  
  @Input()
  set clean(clean: boolean){
    if(clean){
      this.removeAll()
    }
  }
  
  constructor() { }

  ngOnInit() {
  }
  
  isSearch(search, item){
    var s = search.toLowerCase();
    var split = s.split(" ");
    var string = "";
    split.forEach( (word, index, array) =>{
      if(index > 0) string += "|";
      string += word;
    });
    var result = ((item.name).toLowerCase()).match(string)
    return (result != null) ? true : false;
  }
  
  choose(item){
    if(!this.disabled_){
      this.dataChoose.push(item);
      this.data.forEach((d, i, o) =>{
        if(item.name === d.name){
          o.splice(i, 1);
        }
      });
      this.dataOut.emit(this.dataChoose);
    }
  }
  
  remove(item){
    this.data.push(item);
    this.dataChoose.forEach((d, i, o) =>{
      if(item.name === d.name){
        o.splice(i, 1);
      }
    });
    this.dataOut.emit(this.dataChoose);
  }
  
  chooseAll(){
    this.data.forEach(item =>{
      this.dataChoose.push(item);
    });
    this.data = [];
    this.dataOut.emit(this.dataChoose);
  }
  
  removeAll(){
    this.dataChoose.forEach(item =>{
      this.data.push(item);
    });
    this.sortDataByCount();
    this.dataChoose = [];
    this.dataOut.emit(this.dataChoose);
  }
  
  sortDataByCount(){
    this.data.sort((a,b) => (parseInt(a.count) < parseInt(b.count)) ? 1 : -1);
  }

}
