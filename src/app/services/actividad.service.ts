import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { urlDataBase } from '../utils/constantes';
import { Actividades } from '../interfaces/actividades';
import { Observable } from 'rxjs';
import { Participante } from '../interfaces/participante';

@Injectable({
  providedIn: 'root'
})
export class ActividadService {

  constructor(public http: HttpClient) { }

  public url: string = urlDataBase;

  public insertarActividad(actividad:Actividades): Observable<Actividades> {
    return this.http.post<Actividades>((this.url+'activities/insert'),actividad);
  }

  public getActividades(): Observable<Actividades[]> {
    return this.http.get<Actividades[]>(this.url + 'activities');
  }

  public insertarParticipante(participante:Participante): Observable<Participante> {
    return this.http.post<Participante>((this.url+'participantes/insert'),participante);
  }

  public participanteExiste(participante:Participante): Observable<number> {
    return this.http.get<number>((this.url+'participantes/'+participante.cliente.idCliente+'/'+participante.actividad.id));
  }
}
