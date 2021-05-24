import {Injectable} from '@angular/core';
import {HttpClient, HttpHeaders, HttpParams} from '@angular/common/http';
import {Router} from '@angular/router';
import {Observable} from 'rxjs/index';
import {Utils} from "../libs/utils";
import {GLOBAL} from '../global';
import {User} from "../models/user";
import {Pref} from "../models/pref";

@Injectable()
export class ProductService {

  public platform: boolean;

  public httpOptions = {
    headers: new HttpHeaders(
      {'Content-Type': 'application/x-www-form-urlencoded'}
    )
  };

  constructor(public _http: HttpClient, private _router: Router) {
  }
  

  getProducts(user: User, types: any, index: number): Observable<any> {
    const json = encodeURIComponent(JSON.stringify({
      'user': user,
      'types': types,
      'index': index
    }));
    // get hash
    const hash = Utils.convert(GLOBAL.api_token, new Date().getTime());
    const params = 'json=' + json + '&t=' + hash.time + '&h=' + hash.token;
    return this._http.post(GLOBAL.api + 'admin/get/products', params, this.httpOptions);
  }
  
  getIsbns(user: User, types: any, step: number, index: number): Observable<any> {
    const json = encodeURIComponent(JSON.stringify({
      'user': user,
      'types': types,
      'step': step,
      'index': index
    }));
    // get hash
    const hash = Utils.convert(GLOBAL.api_token, new Date().getTime());
    const params = 'json=' + json + '&t=' + hash.time + '&h=' + hash.token;
    return this._http.post(GLOBAL.api + 'admin/get/isbns', params, this.httpOptions);
  }
  
  getProductByTitleIsbn(user: User, text: string, type: any): Observable<any> {
    const json = encodeURIComponent(JSON.stringify({
      'user': user,
      'text': text,
      'type': type
    }));
    // get hash
    const hash = Utils.convert(GLOBAL.api_token, new Date().getTime());
    const params = 'json=' + json + '&t=' + hash.time + '&h=' + hash.token;
    return this._http.post(GLOBAL.api + 'admin/get/product/by/title', params, this.httpOptions);
  }
  
  getTypes(user: User): Observable<any> {
    const json = encodeURIComponent(JSON.stringify({
      'user': user
    }));
    // get hash
    const hash = Utils.convert(GLOBAL.api_token, new Date().getTime());
    const params = 'json=' + json + '&t=' + hash.time + '&h=' + hash.token;
    return this._http.post(GLOBAL.api + 'admin/get/product/types', params, this.httpOptions);
  }
  
  getTypesTitle(user: User): Observable<any> {
    const json = encodeURIComponent(JSON.stringify({
      'user': user
    }));
    // get hash
    const hash = Utils.convert(GLOBAL.api_token, new Date().getTime());
    const params = 'json=' + json + '&t=' + hash.time + '&h=' + hash.token;
    return this._http.post(GLOBAL.api + 'admin/get/product/types/by/title', params, this.httpOptions);
  }
  
  getProductByAttribute(user: User, text: string, type: number): Observable<any> {
    const json = encodeURIComponent(JSON.stringify({
      'user': user,
      'text': text,
      'type': type
    }));
    // get hash
    const hash = Utils.convert(GLOBAL.api_token, new Date().getTime());
    const params = 'json=' + json + '&t=' + hash.time + '&h=' + hash.token;
    return this._http.post(GLOBAL.api + 'admin/get/product/by/attribute', params, this.httpOptions);
  }
  
  downloadExcel(user: User, types: any): Observable<any> {
    const json = encodeURIComponent(JSON.stringify({
      'user': user,
      'types': types,
      'step': 3,
      'index': 1,
    }));
    // get hash
    const hash = Utils.convert(GLOBAL.api_token, new Date().getTime());
    const params = 'json=' + json + '&t=' + hash.time + '&h=' + hash.token;
    return this._http.post(GLOBAL.api + 'admin/get/isbns', params, this.httpOptions);
  }
  
  downloadFromTitle(user: User, types: any): Observable<any> {
    const json = encodeURIComponent(JSON.stringify({
      'user': user,
      'types': types,
      'index': 0,
      'download': true
    }));
    // get hash
    const hash = Utils.convert(GLOBAL.api_token, new Date().getTime());
    const params = 'json=' + json + '&t=' + hash.time + '&h=' + hash.token;
    return this._http.post(GLOBAL.api + 'admin/get/products', params, this.httpOptions);
  }


}
