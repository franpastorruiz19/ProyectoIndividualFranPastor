import { Component } from '@angular/core';
import { Router } from '@angular/router';
import * as CryptoJS from 'crypto-js';
import { User, frmUser } from 'src/app/interfaces/user';
import { UserService } from 'src/app/services/user.service';
@Component({
  selector: 'app-register',
  templateUrl: './register.component.html',
  styleUrls: ['./register.component.css']
})
export class RegisterComponent {
  constructor(public service: UserService, private router: Router) { }
  public formUser: User = frmUser;
  public passwordConfirm: string = "";
  public labelInfo: string = "";
  public comprobar: boolean = true
  // Función para encriptar una contraseña
  public encriptarPassword(password: string): string {
    // Convertir la contraseña a un objeto WordArray
    const passwordWordArray = CryptoJS.enc.Utf8.parse(password);

    // Crear un objeto hash SHA-256
    const hash = CryptoJS.SHA256(passwordWordArray);

    // Devolver el hash en formato hexadecimal
    return hash.toString(CryptoJS.enc.Hex);
  }

  public comprobarRegistro() {
    if (this.formUser.nombre == "" || this.formUser.email == "" || this.formUser.contrasena == "" || this.formUser.tipo == "") {
      this.labelInfo = "Porfavor rellene todos los campos";
      this.comprobar = false;
    } else if (this.formUser.tipo == "Cliente") {
      if (this.formUser.cliente.tipoActividad == "") {
        this.labelInfo = "Porfavor rellene el campo de tipo de Actividad";
        this.comprobar = false;
      } else {
        this.comprobar = true;
      }

    } else if (this.formUser.tipo == "Empresa") {
      if (this.formUser.empresa.tipoEmpresa == "") {
        this.labelInfo = "Porfavor rellene el campo de tipo de Empresa";
        this.comprobar = false;
      } else {
        this.comprobar = true;
      }
    }

  }

  public comprobarContrasena() {
    if (this.formUser.contrasena != this.passwordConfirm) {
      this.labelInfo = "Las contraseñas no coinciden";
      this.comprobar = false;
    }
  }

  public onSubmit() {
    console.log(this.formUser)
    this.comprobarRegistro();
    if (this.comprobar == true) {
      this.comprobarContrasena();
      if (this.comprobar == true) {
        this.service.userExist(this.formUser.nombre).subscribe((res: any) => {
          console.log(res)
          if (res == 1) {
            this.comprobar = false
            this.labelInfo="Este usuario ya existe"
          } else {
            this.service.userInsert(this.formUser).subscribe(response => {
              console.log("Insertado correctamente");
              this.router.navigate(['login']);
            })
          }
        });
      }
    }
  }

}
