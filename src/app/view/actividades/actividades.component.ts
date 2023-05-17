import { Component } from '@angular/core';
import { Router } from '@angular/router';
import { Actividades, frmActividad } from 'src/app/interfaces/actividades';
import { User, frmUser } from 'src/app/interfaces/user';
import { ActividadService } from 'src/app/services/actividad.service';
import { UserService } from 'src/app/services/user.service';
import { UserSession } from 'src/app/utils/userSession';

@Component({
  selector: 'app-actividades',
  templateUrl: './actividades.component.html',
  styleUrls: ['./actividades.component.css']
})
export class ActividadesComponent {
  constructor(public service: ActividadService, private router: Router, public userSession:UserSession) { }
  public formActividad: Actividades = frmActividad;
  public labelInfo: string = "";
  public comprobar: boolean = true
  

  public comprobarRegistro() {
    if (this.formActividad.nombre == "" || this.formActividad.participantes ==  0) {
      this.labelInfo = "Porfavor rellene todos los campos";
      this.comprobar = false;
    } else{
      this.comprobar=true;
    }
  }

  public onSubmit() {
    this.formActividad.tipoActividad=this.userSession.getUser().empresa.tipoEmpresa;
    this.formActividad.idEmpresa=this.userSession.getUser().empresa.idEmpresa;
    console.log(this.formActividad)
    this.comprobarRegistro();
    if(this.comprobar==true){
      this.service.insertarActividad(this.formActividad).subscribe(response => {
        console.log("Insertado correctamente");
        this.router.navigate(['home']);
      })
    }
  }
}
