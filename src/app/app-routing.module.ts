import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { AboutUsComponent } from './view/about-us/about-us.component';
import { HomeComponent } from './view/home/home.component';
import { LoginComponent } from './view/login/login.component';
import { ProductsComponent } from './view/products/products.component';
import { RegisterComponent } from './view/register/register.component';
import { DepositComponent } from './view/deposit/deposit.component';
import { ActividadesComponent } from './view/actividades/actividades.component';
import { InfoProductComponent } from './view/info-product/info-product.component';
import { Actividades } from 'src/app/interfaces/actividades';
const routes: Routes = [
  { path: '', redirectTo: 'home', pathMatch: 'full' },
  { path: 'home', component: HomeComponent },
  { path: 'products', component: ProductsComponent },
  { path: 'aboutUs', component: AboutUsComponent },
  { path: 'login', component: LoginComponent },
  { path: 'register', component: RegisterComponent },
  { path: 'deposit', component: DepositComponent },
  { path: 'activities', component: ActividadesComponent },
  { path: 'infoProduct', component: InfoProductComponent ,  }
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
