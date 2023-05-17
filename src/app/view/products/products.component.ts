import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { Actividades, frmActividad } from 'src/app/interfaces/actividades';
import { User, frmUser } from 'src/app/interfaces/user';
import { ActividadService } from 'src/app/services/actividad.service';

@Component({
  selector: 'app-products',
  templateUrl: './products.component.html',
  styleUrls: ['./products.component.css']
})
export class ProductsComponent implements OnInit {
  constructor(public service: ActividadService, private router: Router) { }
  public formActivities: Actividades[] = [frmActividad, frmActividad];
  public fechaFormateada:string[]=[""];
  public actividadSeleccionada: Actividades=frmActividad;

  ngOnInit(): void {
    this.service.getActividades().subscribe(response => {
      this.formActivities = response;
  
      for(let i=0; i<this.formActivities.length; i++){
        this.fechaFormateada[i] = this.convertirFecha(this.formActivities[i].fechaActividad);
      }
    });
  }

  public convertirFecha(fecha: Date): string {
    const dia = fecha.getDate();
    const mes = fecha.getMonth() + 1;
    const anio = fecha.getFullYear();
    let fechaFormateada=dia +"/"+mes+"/"+anio;
  
    return fechaFormateada;
  }

  navigateToInfoProduct(actividad: Actividades) {
    this.router.navigate(['/infoProduct'], { state: { actividad: actividad } });
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
