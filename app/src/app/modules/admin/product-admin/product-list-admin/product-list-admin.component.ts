import { Component, OnInit } from '@angular/core';
import {ProductService} from '../../../../services/product.service';
import {User} from '../../../../models/user';
import {UserService} from '../../../../services/user.service';
import {Router} from '@angular/router';
import {Product} from '../../../../models/product';
import {
  faBackward, faChevronDown, faChevronRight, faCircleNotch, faEraser,
  faForward, faFileExcel
} from '@fortawesome/free-solid-svg-icons';
import {DateAdapter, MatDatepickerInputEvent, MatSnackBar, MatSnackBarRef, MatTab} from '@angular/material';
import {animate, state, style, transition, trigger} from '@angular/animations';
import {Utils} from '../../../../libs/utils';
import {faCalendarPlus, faTrashAlt} from '@fortawesome/free-regular-svg-icons';
import {GLOBAL} from '../../../../global';

declare var $:any;


export class TypesByTitle{
  public static VERSIONS_RANGE = 7;
  public static TITLE = 4;
  public static ISBN = 5;
  public static COUNTRIES = 6;
  public static ORDERTYPE = 8;
  constructor(public titles: any[],
              public isbns: any[],
              public versions_range: any[],
              public countries: any[],
              public ordertypes: any[],
              public from_year_range: any,
              public to_year_range: any
             ) {
  }
  getStatic() {
    return {
      'TITLE': TypesByTitle.TITLE,
      'ISBN': TypesByTitle.ISBN,
      'VERSIONS_RANGE': TypesByTitle.VERSIONS_RANGE,
      'COUNTRIES': TypesByTitle.COUNTRIES,
      'ORDERTYPE': TypesByTitle.ORDERTYPE
    };
  }
}

export class Types{
  public static LANGUAGE = 1;
  public static VERSIONS = 2;
  public static DIVISIONS = 3;
  public static MAINTHEMA = 9;
  public static MAINTHEMA2 = 12;
  public static PUBLISHER = 10;
  public static ACQEDITOR = 11;
  public static VERSIONS_RANGE = 7;
  public static COUNTRIES = 6;
  public static ORDERTYPE = 8;
  public static EDITOR = 13;
  public static SUBJECTGROUP = 14;
  public static AVAILABILITY = 15;
  public static SERIESTITLE = 16;
  public static AUTHOR = 17;
  public static FROM_YEAR_CRITERIA = 18;
  public static TO_YEAR_CRITERIA = 19;
  public static FROM_SYEAR_CRITERIA = 20;
  public static TO_SYEAR_CRITERIA = 21;
  public static FROM_SYEAR_TITLE = 22;
  public static TO_SYEAR_TITLE = 23;
  
  constructor(public languages: any[],
              public versions: any[],
              public divisions: any[],
              public mainthema: any[],
              public mainthema2: any[],
              public publisher: any[],
              public acqeditor: any[],
              public editor: any[],
              public subjectgroup: any[],
              public availability: any[],
              public seriestitle: any[],
              public author: any[],
              public from_year: any,
              public to_year: any,
              public versions_range: any[],
              public countries: any[],
              public ordertypes: any[],
              public from_year_range: any,
              public to_year_range: any
  ) {
  }
  getStatic() {
    return {
      'LANGUAGE': Types.LANGUAGE,
      'VERSIONS': Types.VERSIONS,
      'DIVISIONS': Types.DIVISIONS,
      'MAINTHEMA': Types.MAINTHEMA,
      'MAINTHEMA2': Types.MAINTHEMA2,
      'PUBLISHER': Types.PUBLISHER,
      'ACQEDITOR': Types.ACQEDITOR,
      'VERSIONS_RANGE': TypesByTitle.VERSIONS_RANGE,
      'COUNTRIES': TypesByTitle.COUNTRIES,
      'ORDERTYPE': TypesByTitle.ORDERTYPE,
      'EDITOR': Types.EDITOR,
      'SUBJECTGROUP': Types.SUBJECTGROUP,
      'AVAILABILITY': Types.AVAILABILITY,
      'SERIESTITLE': Types.SERIESTITLE,
      'AUTHOR': Types.AUTHOR,
      'FROM_YEAR_CRITERIA': Types.FROM_YEAR_CRITERIA,
      'TO_YEAR_CRITERIA': Types.TO_YEAR_CRITERIA,
      'FROM_SYEAR_CRITERIA': Types.FROM_SYEAR_CRITERIA,
      'TO_SYEAR_CRITERIA': Types.TO_SYEAR_CRITERIA,
      'FROM_SYEAR_TITLE': Types.FROM_SYEAR_TITLE,
      'TO_SYEAR_TITLE': Types.TO_SYEAR_TITLE
    };
  }
}

@Component({
  selector: 'app-product-list-admin',
  templateUrl: './product-list-admin.component.html',
  styleUrls: ['./product-list-admin.component.scss'],
  providers: [UserService, ProductService],
})
export class ProductListAdminComponent implements OnInit {
  
  faCircleNotch = faCircleNotch;
  faChevronRight = faChevronRight;
  faChevronDown = faChevronDown;
  faForward = faForward;
  faBackward = faBackward;
  faTrashAlt = faTrashAlt;
  faCalendarPlus = faCalendarPlus;
  faFileExcel = faFileExcel;
  
  ordertypes: any = {
    'NF': 'Normal',
    'SU2': 'SUBS_FULL_TAX',
    'SU': 'SUBS_Normal',
    'CO': 'Complimentary',
    'FA': 'Complimentary Author',
    '2C': 'Pulp',
    'SP': 'Special Sales',
    'CS': 'Consigment Shipping / Fair',
    'CB': 'Consigment Billing / Fair',
    'SE': 'Service',
    'IT': 'Internal Transfer',
    'OA': 'Open Access Fee',
    'COMP': 'Bundle compoment',
    'SUTS': 'SUBS TaxSplit'
  }
  
  results: any = {
    'quantities': 0,
    'sales': 0
  }
  
  user: User;
  products: Product[] = [];
  index: number = 0;
  count: number = 0;
  countgroup: number = 0;
  isCriteria: boolean = false;
  pagination: Array<number> = [];
  loading: boolean = false;
  loadingtitle: boolean = false;
  loadingisbn: boolean = false;
  loadingeditor: boolean = false;
  loadingseriestitle: boolean = false;
  loadingauthor: boolean = false;
  loadingtotals: boolean = false;
  loadingdownload: boolean = false;
  limit: number = 30;
  types: Types = new Types([], [], [],[], [],[], [], [],[],[],[],[],'', '',[],[],[],'','');
  typesChoose: Types = new Types([], [], [],[], [],[], [],[],[],[],[],[], '', '',[],[],[],'','');
  typesByTitle: TypesByTitle = new TypesByTitle([], [], [], [], [],'', '');
  typesByTitleChoose: TypesByTitle = new TypesByTitle([], [], [], [], [], '', '');
  collapsetitle = true;
  collapsetype = true;
  titlestep = 0;
  criteriastep = 0;
  typescount = 0;
  resultvisible: boolean = false;
  
  
  constructor(private userService: UserService, private productService: ProductService, private router: Router, private snackBar: MatSnackBar,private adapter: DateAdapter<any>) { }

  ngOnInit() {
    this.user = this.userService.isLogin();
    if (this.user == null || (!this.user && this.user.type === User.ADMIN)) {
      this.router.navigate(['admin/login']);
    }
    this.adapter.setLocale('en');
    //this.getProducts()
    this.getTypes();
    this.getTypesTitle();
  }
  
  collapse(type: string){
    
    if(type === 'title'){
      this.collapsetitle = !this.collapsetitle
      $('#collapseTitle').collapse('toggle');
    }else if(type === 'type'){
      this.collapsetype = !this.collapsetype
      $('#collapseType').collapse('toggle');
    }
    
  }
  
  goStep(type, step){
    if(type === 'title'){
      if(this.typesByTitleChoose.isbns.length > 0){
        this.titlestep = step;
      }else if(step !== 0){
        this.snackBar.open('Empty isbn list', 'Ok' , {duration: 2000})
      }
    }else if(type === 'types'){
      if(step == 1){
        this.getIsbns(0, false);
      }else{
        this.criteriastep = step;
      }
    }
    if(step == 0){
      this.resultvisible = false;
    }
  }
  
  getIsbns(step, isNew){
    
    let types = this.typesChoose;
    if(step == 1){
      this.loading = true;
      this.isCriteria = true;
      this.resultvisible = true;
      if(isNew){
        this.loadingtotals = true;
      }
      this.downScroll();
    }
    
    if(isNew){
      this.index = 0;
    }
    
    if(step == 1 && isNew) this.getTotals(types);
    
    this.productService.getIsbns(this.user, types, step, this.index).subscribe(
      result => {
        if (result.code === 200) {
          this.typescount = result.count;
          if(step == 0){
            this.criteriastep = 1;
          }else{
            this.setProduct(result, 'types')
          }
        } else {
          this.loading = false;
        }
      },
      error => {
        console.log(<any> error);
        this.loading = false;
      }
    );
  }
  
  getTotals(types){
  
    this.productService.getIsbns(this.user, types, 2, this.index).subscribe(
      result => {
        if (result.code === 200) {
          this.typescount = result.count;
          this.results.quantities = result.total_quantity;
          this.results.sales = result.total_sales;
          this.results.zero = result.total_group_zero;
          this.loadingtotals = false;
        } else {
          this.loadingtotals = false;
        }
      },
      error => {
        console.log(<any> error);
        this.loadingtotals = false;
      }
    );
    
  }
  
  getProducts(isNew: boolean = false, type: string = 'types'){
    
    this.loading = true;
    this.loadingtotals = true;
    let types = null;
    this.isCriteria = false;
    this.resultvisible = true;
    this.downScroll();
    
    if (isNew) {
      this.index = 0;
    }
    
    switch (type){
      case 'title':
        types = this.typesByTitleChoose;
        break;
      case 'types':
        types = this.typesChoose;
        break;
    }
    
    this.productService.getProducts(this.user, types, this.index).subscribe(
      result => {
        if (result.code === 200) {
          this.setProduct(result, type);
        } else {
          this.loading = false;
          this.loadingtotals = false;
        }
      },
      error => {
        console.log(<any> error);
        this.loading = false;
        this.loadingtotals = false;
      }
    );
    
    
  }
  
  setProduct(result, type = null){
    this.count = result.count;
    this.countgroup = result.countgroup;
    
    const pag = Math.ceil(this.count / this.limit);
    
    if(type != null && type == 'title'){
      this.results.quantities = 0;
      this.results.sales = 0;
    }
    
    this.pagination = [];
    for (let i = 0; i < pag; i++) {
      this.pagination.push(i + 1);
    }
    
    this.products = [];
    
    if(result.products !== null){
      result.products.forEach(product =>{
        let p = Product.make(product.data);
        p.stats = product.stats;
        this.products.push(p);
        if(type != null && type == 'title'){
          this.results.quantities += parseInt(p.stats.quantity);
          this.results.sales += parseFloat(p.stats.total);
        }
      })
      this.results.zero = result.total_group_zero;
    }
    
    
    this.loading = false;
    if(type != null && type == 'title'){
      this.loadingtotals = false;
    }
    
  }
  
  getProductByTitleIsbn(text: string, type: number){
    
    if(type === TypesByTitle.TITLE){
      this.loadingtitle = true;
      this.typesByTitle.titles = [];
    }else if(type === TypesByTitle.ISBN){
      this.loadingisbn = true;
      this.typesByTitle.isbns = [];
    }
    
    this.productService.getProductByTitleIsbn(this.user, text, type).subscribe(
      result => {
        if (result.code === 200) {
          let titles = [];
          if(result.products !== null){
            result.products.forEach(product =>{
              let p = Product.make(product);
              titles.push(p);
            })
          }
  
          if(type === TypesByTitle.TITLE){
            this.typesByTitle.titles = [];
            this.typesByTitle.titles = titles;
          }else if(type === TypesByTitle.ISBN){
            this.typesByTitle.isbns = [];
            this.typesByTitle.isbns = titles;
          }
          this.loadingisbn = false;
          this.loadingtitle = false;
        } else {
          this.loadingisbn = false;
          this.loadingtitle = false;
        }
      },
      error => {
        console.log(<any> error);
        this.loadingisbn = false;
        this.loadingtitle = false;
      }
    );
    
  }
  
  getProductByAttribute(text: string, type: number){
  
    if(type === Types.EDITOR){
      this.loadingeditor = true;
      this.types.editor = [];
    }else if(type === Types.SERIESTITLE){
      this.loadingseriestitle = true;
      this.types.seriestitle = [];
    }else if(type === Types.AUTHOR){
      this.loadingauthor = true;
      this.types.author = [];
    }
    
    this.productService.getProductByAttribute(this.user, text, type).subscribe(
      result => {
        if (result.code === 200) {
          let products = [];
          if (result.products !== null) {
            result.products.forEach(product => {
              let p = Product.make(product);
              products.push(p);
            })
          }
  
          if(type === Types.EDITOR){
            this.types.editor = products;
          }else if(type === Types.SERIESTITLE){
            this.types.seriestitle = products;
          }else if(type === Types.AUTHOR){
            this.types.author = products;
          }
          
          this.loadingeditor = false;
          this.loadingseriestitle = false;
          this.loadingauthor = false;
        }
      },
      error => {
        console.log(<any> error);
        this.loadingeditor = false;
        this.loadingseriestitle = false;
        this.loadingauthor = false;
      }
    );
    
  }
  
  getTypes(){
  
    this.productService.getTypes(this.user).subscribe(
      result => {
        if (result.code === 200) {
          this.types.languages = result.types.languages;
          this.types.versions = result.types.versions;
          this.types.divisions = result.types.divisions;
          this.types.mainthema = result.types.mainthema;
          this.types.mainthema2 = result.types.mainthema2;
          this.types.publisher = result.types.publisher;
          this.types.acqeditor = result.types.acqeditor;
          this.types.subjectgroup = result.types.subjectgroup;
          this.types.availability = result.types.availability;
        } else {
          console.log(result.message);
        }
      },
      error => {
        console.log(<any> error);
      }
    );
    
  }
  
  getTypesTitle(){
    
    this.productService.getTypesTitle(this.user).subscribe(
      result => {
        if (result.code === 200) {
          this.typesByTitle.countries = result.types.countries;
          this.typesByTitle.versions_range = result.types.versions;
          this.types.countries = result.types.countries;
          this.types.versions_range = result.types.versions;
          (result.types.ordertypes).forEach(data =>{
            data.code = data.name;
            data.name = this.ordertypes[data.name];
          })
          this.typesByTitle.ordertypes = result.types.ordertypes;
          this.types.ordertypes = result.types.ordertypes;
        } else {
          console.log(result.message);
        }
      },
      error => {
        console.log(<any> error);
      }
    );
    
  }
  
  onData(data: any[], type: number){
    switch (type) {
      case Types.LANGUAGE:
        this.typesChoose.languages = data;
        break;
      case Types.VERSIONS:
        this.typesChoose.versions = data;
        console.log(this.typesChoose);
        break;
      case Types.DIVISIONS:
        this.typesChoose.divisions = data;
        break;
      case Types.MAINTHEMA:
        this.typesChoose.mainthema = data;
        break;
      case Types.MAINTHEMA2:
        this.typesChoose.mainthema2 = data;
        break;
      case Types.PUBLISHER:
        this.typesChoose.publisher = data;
        break;
      case Types.ACQEDITOR:
        this.typesChoose.acqeditor = data;
        break;
      case Types.EDITOR:
        this.typesChoose.editor = data;
        break;
      case Types.AUTHOR:
        this.typesChoose.author = data;
        break;
      case Types.SUBJECTGROUP:
        this.typesChoose.subjectgroup = data;
        break;
      case Types.AVAILABILITY:
        this.typesChoose.availability = data;
        break;
      case Types.SERIESTITLE:
        this.typesChoose.seriestitle = data;
        break;
      case TypesByTitle.TITLE:
        if(data.length === 0){
          this.typesByTitleChoose.countries = [];
          this.typesByTitleChoose.versions_range = [];
          this.typesByTitleChoose.ordertypes = [];
          this.typesByTitleChoose.from_year_range = '';
          this.typesByTitleChoose.to_year_range = '';
        }
        this.typesByTitleChoose.titles = data;
        break;
      case TypesByTitle.ISBN:
        this.typesByTitleChoose.isbns = data;
        break;
      case TypesByTitle.VERSIONS_RANGE:
        this.typesByTitleChoose.versions_range = data;
        this.typesChoose.versions_range = data;
        break;
      case TypesByTitle.ORDERTYPE:
        console.log(data);
        this.typesByTitleChoose.ordertypes = data;
        this.typesChoose.ordertypes = data;
        break;
      case TypesByTitle.COUNTRIES:
        this.typesByTitleChoose.countries = data;
        this.typesChoose.countries = data;
        break;
    }
  }
  
  onSearch(text: string, type: number){
    
    if(type === TypesByTitle.TITLE || type === TypesByTitle.ISBN){
      this.getProductByTitleIsbn(text, type);
    }else{
      this.getProductByAttribute(text, type);
    }
    
  }
  
  /*dateChange(type: string){
    if(type === 'from' && this.typesChoose.to_year != ""){
      if(this.typesChoose.from_year > this.typesChoose.to_year){
        this.typesChoose.from_year = '';
        this.snackBar.open('The start date of publication may not be longer than the end date.', '' , {duration: 2000})
      }
    }else if(type === 'to' && this.typesChoose.from_year != ""){
    
    }
  }*/
  
  paginar(n: number) {
    if(!this.loading){
      this.index = n - 1;
      (this.isCriteria) ? this.getIsbns(1, false) : this.getProducts();
    }
  }
  
  downScroll(){
    var body = $("html, body");
    body.stop().animate({scrollTop:body.innerHeight()}, 500, 'swing');
  }
  
  changeTab(){
    this.goStep('title', 0);
    this.goStep('types', 0);
    this.resultvisible = false;
    this.cleanData();
  }
  
  cleanData(){
    this.typesByTitleChoose.countries = [];
    this.typesByTitleChoose.versions_range = [];
    this.typesByTitleChoose.ordertypes = [];
    this.typesByTitleChoose.isbns = [];
    this.typesByTitleChoose.titles = [];
    this.typesByTitleChoose.from_year_range = '';
    this.typesByTitleChoose.to_year_range = '';
    this.typesChoose.mainthema2 = [];
    this.typesChoose.mainthema = [];
    this.typesChoose.countries = [];
    this.typesChoose.ordertypes = [];
    this.typesChoose.versions_range = [];
    this.typesChoose.versions = [];
    this.typesChoose.acqeditor = [];
    this.typesChoose.editor = [];
    this.typesChoose.subjectgroup = [];
    this.typesChoose.availability = [];
    this.typesChoose.seriestitle = [];
    this.typesChoose.publisher = [];
    this.typesChoose.author = [];
    this.typesChoose.divisions = [];
    this.typesChoose.to_year_range = '';
    this.typesChoose.to_year = '';
    this.typesChoose.from_year_range = '';
    this.typesChoose.from_year = '';
  }
  
  setToday(type){
    switch (type) {
      case Types.FROM_YEAR_CRITERIA:
        this.typesChoose.from_year = new Date((new Date().getTime()));
        break;
      case Types.TO_YEAR_CRITERIA:
        this.typesChoose.to_year = new Date((new Date().getTime()));
        break;
      case Types.FROM_SYEAR_CRITERIA:
        this.typesChoose.from_year_range = new Date((new Date().getTime()));
        break;
      case Types.TO_SYEAR_CRITERIA:
        this.typesChoose.to_year_range = new Date((new Date().getTime()));
        break;
      case Types.FROM_SYEAR_TITLE:
        this.typesByTitleChoose.from_year_range = new Date((new Date().getTime()));
        break;
      case Types.TO_SYEAR_TITLE:
        this.typesByTitleChoose.to_year_range = new Date((new Date().getTime()));
        break;
    }
  }
  
  clearDate(type){
    switch (type) {
      case Types.FROM_YEAR_CRITERIA:
        this.typesChoose.from_year = '';
        break;
      case Types.TO_YEAR_CRITERIA:
        this.typesChoose.to_year = '';
        break;
      case Types.FROM_SYEAR_CRITERIA:
        this.typesChoose.from_year_range = '';
        break;
      case Types.TO_SYEAR_CRITERIA:
        this.typesChoose.to_year_range = '';
        break;
      case Types.FROM_SYEAR_TITLE:
        this.typesByTitleChoose.from_year_range = '';
        break;
      case Types.TO_SYEAR_TITLE:
        this.typesByTitleChoose.to_year_range = '';
        break;
    }
  }
  
  download(){
    if(this.isCriteria){
      if(!this.loadingdownload){
        this.loadingdownload = true;
        let types = this.typesChoose;
        this.productService.downloadExcel(this.user, types).subscribe(
          result => {
            if (result.code === 200) {
              let snackBarRef = this.snackBar.open("Excel successfully generated", 'Download' , {duration: null})
              snackBarRef.onAction().subscribe(()=> {
                window.open(GLOBAL.api + 'download/file/'+result.excel, '_black');
              });
            } else {
              this.snackBar.open(result.message, 'Ok' , {duration: 2000})
            }
            this.loadingdownload = false;
          },
          error => {
            console.log(<any> error);
            this.loadingdownload = false;
          }
        );
      }
    }else{
      this.downloadFromTitle()
    }
  }
  
  downloadFromTitle(){
    if(!this.loadingdownload){
      this.loadingdownload = true;
      let types = this.typesByTitleChoose;
      this.productService.downloadFromTitle(this.user, types).subscribe(
        result => {
          if (result.code === 200) {
            let snackBarRef = this.snackBar.open("Excel successfully generated", 'Download' , {duration: null})
            snackBarRef.onAction().subscribe(()=> {
              window.open(GLOBAL.assets + 'excel/'+result.excel, '_black');
            });
          } else {
            this.snackBar.open(result.message, 'Ok' , {duration: 2000})
          }
          this.loadingdownload = false;
        },
        error => {
          console.log(<any> error);
          this.loadingdownload = false;
        }
      );
    }
  }
  
}
