import { Component } from '@angular/core';
import { Router } from '@angular/router';
import * as CryptoJS from 'crypto-js';
import { UserService } from 'src/app/services/user.service';
import { UserSession } from 'src/app/utils/userSession';
@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.css']
})
export class LoginComponent {
  constructor(public service: UserService, private router: Router, private userSession:UserSession) { }
  public password: string = "";
  public labelInfo: string = "";
  public comprobar: boolean = true;
  public nombre: string = "";
  // Función para encriptar una contraseña
  public encriptarPassword(password: string): string {
    // Convertir la contraseña a un objeto WordArray
    const passwordWordArray = CryptoJS.enc.Utf8.parse(password);

    // Crear un objeto hash SHA-256
    const hash = CryptoJS.SHA256(passwordWordArray);

    // Devolver el hash en formato hexadecimal
    return hash.toString(CryptoJS.enc.Hex);
  }

  public comprobarLogin() {
    let response;
    this.service.getUser(this.nombre, this.password).subscribe((res:any)=>{
    response=res;
    if(response==0){
      this.comprobar=false;
      this.labelInfo="Credenciales erróneas"
     }else{
      this.comprobar=true;
      this.userSession.setUser(response)
      console.log(this.userSession.getUser())
      this.userSession.setLogueado(1)
      this.router.navigate(['home']);
     }
   });
   
  }

  public onSubmit() {
    this.comprobarLogin()
    console.log(this.userSession.getLogueado())
    ;
  }

}


