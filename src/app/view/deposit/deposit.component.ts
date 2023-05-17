import { Component } from '@angular/core';
import { Router } from '@angular/router';
import { Cliente } from 'src/app/interfaces/cliente';
import { User } from 'src/app/interfaces/user';
import { DepositarService } from 'src/app/services/depositar.service';
import { UserService } from 'src/app/services/user.service';
import { UserSession } from 'src/app/utils/userSession';

@Component({
  selector: 'app-deposit',
  templateUrl: './deposit.component.html',
  styleUrls: ['./deposit.component.css']
})
export class DepositComponent {
  constructor(public service: DepositarService, private router: Router, private userSession:UserSession) { }
  public dinero:number=0;
  public cliente: Cliente =this.userSession.getUser().cliente;
  public user: User=this.userSession.getUser();
  public labelInfo:string="";

  public depositarDinero() {
    this.cliente = this.userSession.getUser().cliente;
    this.cliente.dinero = this.dinero;
  
    this.user = this.userSession.getUser();
    this.user.cliente = this.cliente;
  
    // Actualizar los datos del usuario en el servicio UserSession
    this.userSession.setUser(this.user);
  console.log(this.user)
    // Actualizar los datos del usuario en el backend
    this.service.depositarDineroCliente(this.user).subscribe((res: any) => {
      console.log("Dinero Ingresado");
      this.labelInfo = "Dinero ingresado correctamente";
      this.cliente.dinero=res.dinero;
      this.user.cliente=this.cliente;
      this.userSession.setUser(this.user);
    
    });
  }

  public onSubmit() {
    this.depositarDinero();
  }
}
