export class Utils{

  constructor(){}


  // CREAR TOKEN PARA API
  public static convert(token: string, time: number) {
    let new_token = '';
    let number = '';
    for (let i = 0; i < token.length; i++) {
      new_token += token[i].charCodeAt(0);
    }
    number = (parseInt(new_token) + time).toString();
    new_token = '';
    for (let i = 0; i < number.length; i++) {
      if (i % 2 === 0) new_token += String.fromCharCode(65 + parseInt(number[i]));
      else new_token += number[i].toString();
    }
    return {
      token: new_token,
      time: time
    };
  }




}
