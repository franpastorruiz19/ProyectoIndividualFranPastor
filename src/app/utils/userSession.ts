import { Injectable } from '@angular/core';
import { Cliente } from "../interfaces/cliente";
import { Empresa } from "../interfaces/empresa";
import { User } from "../interfaces/user";

@Injectable({
  providedIn: 'root'
})
export class UserSession {
  private cliente: Cliente = {
    idCliente: 0,
    tipoActividad: "",
    dinero: 0
  };

  private empresa: Empresa = {
    idEmpresa: 0,
    tipoEmpresa: "",
    dinero: 0
  };

  private user: User = {
    id: 0,
    nombre: "",
    email: "",
    tipo: "",
    contrasena: "",
    cliente: this.cliente,
    empresa: this.empresa
  };

  private logueado: number = 0;

  constructor() {
    // Recuperar los datos del usuario del localStorage al inicializar el servicio
    const storedUser = localStorage.getItem('user');
    if (storedUser) {
      this.user = JSON.parse(storedUser);
    }

    const storedLogueado = localStorage.getItem('logueado');
    if (storedLogueado) {
      this.logueado = Number(storedLogueado);
    }
  }

  setUser(user: User): void {
    this.user = user;
    // Almacenar los datos del usuario en el localStorage
    localStorage.setItem('user', JSON.stringify(user));
  }

  getUser(): User {
    return this.user;
  }

  setLogueado(logueado: number): void {
    this.logueado = logueado;
    // Almacenar el estado de logueo en el localStorage
    localStorage.setItem('logueado', String(logueado));
  }

  getLogueado(): number {
    return this.logueado;
  }

  desloguear(): void {
    // Limpiar los datos del usuario y el estado de logueo en el localStorage
    localStorage.removeItem('user');
    localStorage.removeItem('logueado');
    this.user = {
      id: 0,
      nombre: "",
      email: "",
      tipo: "",
      contrasena: "",
      cliente: this.cliente,
      empresa: this.empresa
    };
    this.logueado = 0;
  }
  
}