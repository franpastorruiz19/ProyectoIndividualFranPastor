import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { HeaderComponent } from './components/header/header.component';
import { NavComponent } from './components/nav/nav.component';
import { FooterComponent } from './components/footer/footer.component';
import { HomeComponent } from './view/home/home.component';
import { ProductsComponent } from './view/products/products.component';
import { AboutUsComponent } from './view/about-us/about-us.component';
import { HttpClientModule } from '@angular/common/http';
import { FormsModule } from '@angular/forms';
import { RegisterComponent } from './view/register/register.component';
import { LoginComponent } from './view/login/login.component';
import { DepositComponent } from './view/deposit/deposit.component';
import { ActividadesComponent } from './view/actividades/actividades.component';
import { InfoProductComponent } from './view/info-product/info-product.component';

@NgModule({
  declarations: [
    AppComponent,
    HeaderComponent,
    NavComponent,
    FooterComponent,
    HomeComponent,
    ProductsComponent,
    AboutUsComponent,
    LoginComponent,
    RegisterComponent,
    DepositComponent,
    ActividadesComponent,
    InfoProductComponent
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    HttpClientModule,
    FormsModule
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
