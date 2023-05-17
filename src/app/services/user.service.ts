import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable} from 'rxjs';
import { urlDataBase } from '../utils/constantes';
import { User } from '../interfaces/user';
import { Cliente } from '../interfaces/cliente';
import { Empresa } from '../interfaces/empresa';

@Injectable({
  providedIn: 'root'
})
export class UserService {

  constructor(public http: HttpClient) { }

  public url: string = urlDataBase;

  public userInsert(user:User): Observable<User> {
    return this.http.post<User>((this.url+'user/insert'),user);
  }

  public getUser(user:string,password:string): any {
    return this.http.get<any>((this.url+'user/'+user+"/"+password));
  }

  public userExist(user:string): any {
    return this.http.get<any>((this.url+'user/'+user));
  }

}
