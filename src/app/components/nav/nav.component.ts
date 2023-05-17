import { Component } from '@angular/core';
import { UserSession } from 'src/app/utils/userSession';

@Component({
  selector: 'app-nav',
  templateUrl: './nav.component.html',
  styleUrls: ['./nav.component.css']
})
export class NavComponent {
constructor(public userSession:UserSession){ }

desloguear(){
  this.userSession.desloguear()
}
}
