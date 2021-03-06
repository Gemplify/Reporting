export class Product {
  
  constructor(
    public id: number,
    public isbnoNoissn: string,
    public editionno: string,
    public projectNo: string,
    public prdsrl: string,
    public publisher: string,
    public pubDate: string,
    public author: string,
    public title: string,
    public subtitle: string,
    public shorttitle: string,
    public authors: string,
    public editors: string,
    public divisionmsType: string,
    public subjectgroup: string,
    public language: string,
    public acqeditor: string,
    public pubyear: string,
    public pubmonth: string,
    public mainthemacode: string,
    public mainthematext: string,
    public themacode2: string,
    public thematext2: string,
    public themacode3: string,
    public thematext3: string,
    public mainbiccode: string,
    public mainbictext: string,
    public biccode2: string,
    public bictext2: string,
    public biccode3: string,
    public bictext3: string,
    public mainbisaccode: string,
    public mainbisactext: string,
    public bisaccode2: string,
    public bisactext2: string,
    public bisaccode3: string,
    public bisactext3: string,
    public availability: string,
    public editionsizeplanned: string,
    public seriestitle: string,
    public seriessubtitle: string,
    public seriescode: string,
    public seriesissn: string,
    public volumeno: string,
    public maindesc: string,
    public shortdesc: string,
    public toc: string,
    public authorsbio: string,
    public awards: string,
    public pricesfr: string,
    public priceeurD: string,
    public priceeurA: string,
    public priceeur: string,
    public pricegbp: string,
    public priceusd: string,
    public version: string,
    public binding: string,
    public pages: string,
    public pagesapprox: string,
    public format: string,
    public weight: string,
    public illuscolour: string,
    public illusblackandwhite: string,
    public productlink: string,
    public prePubpriceChf: string,
    public subscriptionpriceChf: string,
    public specialpriceChf: string,
    public multiUserpricelibraryChf: string,
    public chapterpriceChf: string,
    public prePubpriceEur: string,
    public subscriptionpriceEur: string,
    public specialpriceEur: string,
    public multiUserpricelibraryEur: string,
    public chapterpriceEur: string,
    public prePubpriceEura: string,
    public subscriptionpriceEura: string,
    public specialpriceEura: string,
    public multiUserpricelibraryEura: string,
    public chapterpriceEura: string,
    public prePubpriceEurd: string,
    public subscriptionpriceEurd: string,
    public specialpriceEurd: string,
    public multiUserpricelibraryEurd: string,
    public chapterpriceEurd: string,
    public prePubpriceUsd: string,
    public subscriptionpriceUsd: string,
    public specialpriceUsd: string,
    public multiUserpricelibraryUsd: string,
    public chapterpriceUsd: string,
    public subsequentedition: string,
    public stats: any,
  ) {
  }
  
  static make(product: any = new Array()): Product {
    return new Product((product.id) ? product.id : 0,
      (product.isbnoNoissn) ? product.isbnoNoissn : '',
      (product.editionno) ? product.editionno : '',
      (product.projectNo) ? product.projectNo : '',
      (product.prdsrl) ? product.prdsrl : '',
      (product.publisher) ? product.publisher : '',
      (product.pubDate) ? product.pubDate : '',
      (product.author) ? product.author : '',
      (product.title) ? product.title : '',
      (product.subtitle) ? product.subtitle : '',
      (product.shorttitle) ? product.shorttitle : '',
      (product.authors) ? product.authors : '',
      (product.editors) ? product.editors : '',
      (product.divisionmsType) ? product.divisionmsType : '',
      (product.subjectgroup) ? product.subjectgroup : '',
      (product.language) ? product.language : '',
      (product.acqeditor) ? product.acqeditor : '',
      (product.pubyear) ? product.pubyear : '',
      (product.pubmonth) ? product.pubmonth : '',
      (product.mainthemacode) ? product.mainthemacode : '',
      (product.mainthematext) ? product.mainthematext : '',
      (product.themacode2) ? product.themacode2 : '',
      (product.thematext2) ? product.thematext2 : '',
      (product.themacode3) ? product.themacode3 : '',
      (product.thematext3) ? product.thematext3 : '',
      (product.mainbiccode) ? product.mainbiccode : '',
      (product.mainbictext) ? product.mainbictext : '',
      (product.biccode2) ? product.biccode2 : '',
      (product.bictext2) ? product.bictext2 : '',
      (product.biccode3) ? product.biccode3 : '',
      (product.bictext3) ? product.bictext3 : '',
      (product.mainbisaccode) ? product.mainbisaccode : '',
      (product.mainbisactext) ? product.mainbisactext : '',
      (product.bisaccode2) ? product.bisaccode2 : '',
      (product.bisactext2) ? product.bisactext2 : '',
      (product.bisaccode3) ? product.bisaccode3 : '',
      (product.bisactext3) ? product.bisactext3 : '',
      (product.availability) ? product.availability : '',
      (product.editionsizeplanned) ? product.editionsizeplanned : '',
      (product.seriestitle) ? product.seriestitle : '',
      (product.seriessubtitle) ? product.seriessubtitle : '',
      (product.seriescode) ? product.seriescode : '',
      (product.seriesissn) ? product.seriesissn : '',
      (product.volumeno) ? product.volumeno : '',
      (product.maindesc) ? product.maindesc : '',
      (product.shortdesc) ? product.shortdesc : '',
      (product.toc) ? product.toc : '',
      (product.authorsbio) ? product.authorsbio : '',
      (product.awards) ? product.awards : '',
      (product.pricesfr) ? product.pricesfr : '',
      (product.priceeurD) ? product.priceeurD : '',
      (product.priceeurA) ? product.priceeurA : '',
      (product.priceeur) ? product.priceeur : '',
      (product.pricegbp) ? product.pricegbp : '',
      (product.priceusd) ? product.priceusd : '',
      (product.version) ? product.version : '',
      (product.binding) ? product.binding : '',
      (product.pages) ? product.pages : '',
      (product.pagesapprox) ? product.pagesapprox : '',
      (product.format) ? product.format : '',
      (product.weight) ? product.weight : '',
      (product.illuscolour) ? product.illuscolour : '',
      (product.illusblackandwhite) ? product.illusblackandwhite : '',
      (product.productlink) ? product.productlink : '',
      (product.prePubpriceChf) ? product.prePubpriceChf : '',
      (product.subscriptionpriceChf) ? product.subscriptionpriceChf : '',
      (product.specialpriceChf) ? product.specialpriceChf : '',
      (product.multiUserpricelibraryChf) ? product.multiUserpricelibraryChf : '',
      (product.chapterpriceChf) ? product.chapterpriceChf : '',
      (product.prePubpriceEur) ? product.prePubpriceEur : '',
      (product.subscriptionpriceEur) ? product.subscriptionpriceEur : '',
      (product.specialpriceEur) ? product.specialpriceEur : '',
      (product.multiUserpricelibraryEur) ? product.multiUserpricelibraryEur : '',
      (product.chapterpriceEur) ? product.chapterpriceEur : '',
      (product.prePubpriceEura) ? product.prePubpriceEura : '',
      (product.subscriptionpriceEura) ? product.subscriptionpriceEura : '',
      (product.specialpriceEura) ? product.specialpriceEura : '',
      (product.multiUserpricelibraryEura) ? product.multiUserpricelibraryEura : '',
      (product.chapterpriceEura) ? product.chapterpriceEura : '',
      (product.prePubpriceEurd) ? product.prePubpriceEurd : '',
      (product.subscriptionpriceEurd) ? product.subscriptionpriceEurd : '',
      (product.specialpriceEurd) ? product.specialpriceEurd : '',
      (product.multiUserpricelibraryEurd) ? product.multiUserpricelibraryEurd : '',
      (product.chapterpriceEurd) ? product.chapterpriceEurd : '',
      (product.prePubpriceUsd) ? product.prePubpriceUsd : '',
      (product.subscriptionpriceUsd) ? product.subscriptionpriceUsd : '',
      (product.specialpriceUsd) ? product.specialpriceUsd : '',
      (product.multiUserpricelibraryUsd) ? product.multiUserpricelibraryUsd : '',
      (product.chapterpriceUsd) ? product.chapterpriceUsd : '',
      (product.subsequentedition) ? product.subsequentedition : '',
      (product.stats) ? product.stats : null,
    );
  }
  
  getStatic() {
    return {
    };
  }
}
