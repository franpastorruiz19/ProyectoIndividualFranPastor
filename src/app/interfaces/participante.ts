import { Actividades } from "./actividades";
import { Cliente } from "./cliente";

export interface Participante {
    cliente:Cliente,
    actividad:Actividades
}