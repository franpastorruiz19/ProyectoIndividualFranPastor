import { Component, Input, OnInit } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';
import { Actividades, frmActividad } from 'src/app/interfaces/actividades';
import { Participante } from 'src/app/interfaces/participante';
import { ActividadService } from 'src/app/services/actividad.service';
import { UserSession } from 'src/app/utils/userSession';

@Component({
  selector: 'app-info-product',
  templateUrl: './info-product.component.html',
  styleUrls: ['./info-product.component.css']
})
export class InfoProductComponent {
  constructor(public userSession: UserSession, private router: Router, public service: ActividadService) { }
  public actividad: Actividades = frmActividad;
  public registrado: boolean = false;
  public labelError: string = "";
  public labelInfo: string = "";
  public label: number = 0;
  public participante: Participante = {
    cliente: this.userSession.getUser().cliente,
    actividad: this.actividad
  }


  ngOnInit(): void {
    this.actividad = history.state.actividad;
    console.log(this.actividad);
    this.participante.actividad=this.actividad;
  }

  volver(): void {
    this.router.navigate(['/products']);
  }

  registrarse(): void {
    console.log(this.participante)
    if (this.userSession.getUser().cliente.dinero >= this.actividad.precio) {
      this.service.participanteExiste(this.participante).subscribe(res=>{
        if(res==1){
          this.labelError = "Ya estas registrado en esta actividad"
          this.label = 1;
        }else{
          this.service.insertarParticipante(this.participante).subscribe(r=>{
           this.labelInfo="Te has registrado correctamente en esta actividad";
           this.label=2
          })
        }
      })
    } else {
      this.labelError = "No tienes dinero suficiente"
      this.label = 1;
    }
  }

  public retornarImagen(tipo: string): string {
    switch (tipo) {
      case "paracaidismo":
        return "../../../assets/img/paracaidas2.jpg";
      case "snorkel":
        return "../../../assets/img/snorkel.jpg";
      case "multiaventura":
        return "../../../assets/img/tirolina";

      case "conciertos":
        return "../../../assets/img/conciertos.jpg";

      case "parquesTematicos":
        return "../../../assets/img/parque.jpg";

      case "excursiones":
        return "../../../assets/img/excursin.jpg";

      case "rio":
        return "../../../assets/img/rio.jpg";

      case "deportes":
        return "../../../assets/img/deportes.jpg";

      case "alquiler":
        return "../../../assets/img/alquiler.jpg";

      default:
        return "";
    }
  }
}
