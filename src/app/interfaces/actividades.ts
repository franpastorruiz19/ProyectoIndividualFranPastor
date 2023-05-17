export interface Actividades {
    id:number,
    tipoActividad:string,
    idEmpresa:number,
    precio:number,
    nombre:string,
    descripcion:string,
    participantes:number,
    fechaActividad:Date
}

export const frmActividad: Actividades ={
    id:0,
    tipoActividad:"",
    idEmpresa:0,
    precio:0,
    nombre:"",
    descripcion:"",
    participantes:0,
    fechaActividad:new Date()
}
