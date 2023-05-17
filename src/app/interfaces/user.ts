import { Cliente, frmCliente } from "./cliente"
import { Empresa, frmEmpresa } from "./empresa"

export interface User {
    id:number,
    nombre: string,
    email:string,
    tipo:string,
    contrasena:string,
    cliente:Cliente,
    empresa:Empresa
}

export const frmUser: User ={
    id:0,
    nombre: "",
    email:"",
    tipo:"",
    contrasena:"",
    cliente:frmCliente,
    empresa:frmEmpresa
}
