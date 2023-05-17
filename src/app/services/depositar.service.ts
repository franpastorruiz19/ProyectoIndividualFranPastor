import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import { Cliente } from '../interfaces/cliente';
import { Empresa } from '../interfaces/empresa';
import { urlDataBase } from '../utils/constantes';
import { User } from '../interfaces/user';

@Injectable({
  providedIn: 'root'
})
export class DepositarService {
  constructor(public http: HttpClient) { }

  public url: string = urlDataBase;

  public depositarDineroCliente(user:User): Observable<Cliente> {
    return this.http.put<Cliente>((this.url+'user/update'),user);
  }

  public depositarDineroEmpresa(user:Empresa): Observable<Empresa> {
    return this.http.post<Empresa>((this.url+'empresa/ingresar'),user);
  }
}
